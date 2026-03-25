<?php
namespace Opencart\Catalog\Controller\Mobile;

class Cart extends \Opencart\System\Engine\Controller {

	private function json(array $data, int $status = 200): void {
		$protocol = $this->request->server['SERVER_PROTOCOL'] ?? 'HTTP/1.1';
		if ($status !== 200) {
			$texts = [400 => '400 Bad Request', 401 => '401 Unauthorized', 422 => '422 Unprocessable Entity'];
			$this->response->addHeader($protocol . ' ' . ($texts[$status] ?? $status));
		}
		$this->response->addHeader('Content-Type: application/json');
		$this->response->addHeader('Access-Control-Allow-Origin: *');
		$this->response->addHeader('Access-Control-Allow-Headers: Authorization, Content-Type');
		$this->response->setOutput(json_encode($data));
	}

	private function getCustomerId(): int {
		$auth = $this->request->server['HTTP_AUTHORIZATION'] ?? $_SERVER['HTTP_AUTHORIZATION'] ?? $_SERVER['REDIRECT_HTTP_AUTHORIZATION'] ?? '';
		if (!$auth && function_exists('apache_request_headers')) {
			$h = apache_request_headers();
			$auth = $h['Authorization'] ?? $h['authorization'] ?? '';
		}
		if (!preg_match('/Bearer\s+(.+)/i', $auth, $m)) {
			return 0;
		}
		$query = $this->db->query("SELECT `customer_id` FROM `" . DB_PREFIX . "mobile_token` WHERE `token` = '" . $this->db->escape(trim($m[1])) . "' AND `date_expire` > NOW()");
		return $query->num_rows ? (int)$query->row['customer_id'] : 0;
	}

	private function requireAuth(): int {
		$customer_id = $this->getCustomerId();
		if (!$customer_id) {
			$this->json(['success' => false, 'error' => 'Unauthorized. Please login.'], 401);
		}
		return $customer_id;
	}

	private function imageUrl(string $path): string {
		return $path ? HTTP_SERVER . 'image/' . $path : '';
	}

	/** Inject customer into session so $this->cart works correctly */
	private function loginCustomer(int $customer_id): void {
		$this->session->data['customer_id'] = $customer_id;
	}

	private function buildCartResponse(): array {
		$this->load->model('checkout/cart');
		$products = $this->model_checkout_cart->getProducts();

		$items = [];
		foreach ($products as $p) {
			$options = [];
			foreach ($p['option'] as $opt) {
				$options[] = [
					'name'  => $opt['name'],
					'value' => $opt['value'],
				];
			}
			$items[] = [
				'cart_id'    => (int)$p['cart_id'],
				'product_id' => (int)$p['product_id'],
				'name'       => $p['name'],
				'model'      => $p['model'],
				'image'      => $this->imageUrl($p['image']),
				'quantity'   => (int)$p['quantity'],
				'price'      => (float)$p['price'],
				'total'      => (float)$p['total'],
				'options'    => $options,
			];
		}

		$totals = [];
		$taxes  = $this->cart->getTaxes();
		$total  = 0;
		($this->model_checkout_cart->getTotals)($totals, $taxes, $total);

		$total_lines = [];
		foreach ($totals as $t) {
			$total_lines[] = [
				'code'  => $t['code'],
				'title' => $t['title'],
				'value' => (float)$t['value'],
			];
		}

		return [
			'items'       => $items,
			'totals'      => $total_lines,
			'total'       => (float)$total,
			'item_count'  => $this->cart->countProducts(),
			'has_shipping'=> $this->cart->hasShipping(),
		];
	}

	/**
	 * GET ?route=mobile/cart
	 */
	public function index(): void {
		$customer_id = $this->requireAuth();
		if (!$customer_id) return;

		$this->loginCustomer($customer_id);
		$this->json(['success' => true, 'data' => $this->buildCartResponse()]);
	}

	/**
	 * POST ?route=mobile/cart/add
	 * Body: product_id, quantity (default 1), option[] (optional)
	 */
	public function add(): void {
		$customer_id = $this->requireAuth();
		if (!$customer_id) return;

		if ($this->request->server['REQUEST_METHOD'] !== 'POST') {
			$this->json(['success' => false, 'error' => 'Method not allowed'], 400);
			return;
		}

		$this->loginCustomer($customer_id);

		$product_id = (int)($this->request->post['product_id'] ?? 0);
		$quantity   = max(1, (int)($this->request->post['quantity'] ?? 1));
		$option     = array_filter((array)($this->request->post['option'] ?? []));

		if (!$product_id) {
			$this->json(['success' => false, 'error' => 'product_id is required'], 422);
			return;
		}

		$this->load->model('catalog/product');
		$product_info = $this->model_catalog_product->getProduct($product_id);

		if (!$product_info) {
			$this->json(['success' => false, 'error' => 'Product not found'], 400);
			return;
		}

		// Check stock
		if (!$this->config->get('config_stock_checkout') && $product_info['quantity'] < $quantity) {
			$this->json(['success' => false, 'error' => 'Insufficient stock'], 422);
			return;
		}

		// Merge variant options
		foreach ($product_info['variant'] as $option_id => $value) {
			$option[$option_id] = $value;
		}

		$this->cart->add($product_id, $quantity, $option);

		$this->json([
			'success' => true,
			'message' => 'Product added to cart',
			'data'    => $this->buildCartResponse(),
		]);
	}

	/**
	 * POST ?route=mobile/cart/remove
	 * Body: cart_id
	 */
	public function remove(): void {
		$customer_id = $this->requireAuth();
		if (!$customer_id) return;

		$this->loginCustomer($customer_id);

		$cart_id = (int)($this->request->post['cart_id'] ?? 0);

		if (!$cart_id) {
			$this->json(['success' => false, 'error' => 'cart_id is required'], 422);
			return;
		}

		$this->cart->remove($cart_id);

		$this->json([
			'success' => true,
			'message' => 'Item removed from cart',
			'data'    => $this->buildCartResponse(),
		]);
	}

	/**
	 * POST ?route=mobile/cart/update
	 * Body: cart_id, quantity
	 */
	public function update(): void {
		$customer_id = $this->requireAuth();
		if (!$customer_id) return;

		$this->loginCustomer($customer_id);

		$cart_id  = (int)($this->request->post['cart_id'] ?? 0);
		$quantity = max(0, (int)($this->request->post['quantity'] ?? 0));

		if (!$cart_id) {
			$this->json(['success' => false, 'error' => 'cart_id is required'], 422);
			return;
		}

		if ($quantity === 0) {
			$this->cart->remove($cart_id);
		} else {
			$this->cart->update($cart_id, $quantity);
		}

		$this->json([
			'success' => true,
			'message' => 'Cart updated',
			'data'    => $this->buildCartResponse(),
		]);
	}

	/**
	 * POST ?route=mobile/cart/clear
	 */
	public function clear(): void {
		$customer_id = $this->requireAuth();
		if (!$customer_id) return;

		$this->loginCustomer($customer_id);
		$this->cart->clear();

		$this->json(['success' => true, 'message' => 'Cart cleared']);
	}
}
