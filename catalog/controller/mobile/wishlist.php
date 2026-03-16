<?php
namespace Opencart\Catalog\Controller\Mobile;

class Wishlist extends \Opencart\System\Engine\Controller {

	private function json(array $data, int $status = 200): void {
		$protocol = $this->request->server['SERVER_PROTOCOL'] ?? 'HTTP/1.1';
		if ($status !== 200) {
			$texts = [400 => '400 Bad Request', 401 => '401 Unauthorized'];
			$this->response->addHeader($protocol . ' ' . ($texts[$status] ?? $status));
		}
		$this->response->addHeader('Content-Type: application/json');
		$this->response->addHeader('Access-Control-Allow-Origin: *');
		$this->response->addHeader('Access-Control-Allow-Headers: Authorization, Content-Type');
		$this->response->setOutput(json_encode($data));
	}

	private function getCustomerId(): int {
		$auth = $this->request->server['HTTP_AUTHORIZATION'] ?? '';
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

	/**
	 * GET ?route=mobile/wishlist
	 */
	public function index(): void {
		$customer_id = $this->requireAuth();
		if (!$customer_id) return;

		$this->session->data['customer_id'] = $customer_id;

		$wishlist_ids = $this->db->query("SELECT `product_id` FROM `" . DB_PREFIX . "customer_wishlist` WHERE `customer_id` = '" . (int)$customer_id . "'");

		$this->load->model('catalog/product');

		$items = [];
		foreach ($wishlist_ids->rows as $row) {
			$p = $this->model_catalog_product->getProduct((int)$row['product_id']);
			if ($p) {
				$items[] = [
					'product_id' => (int)$p['product_id'],
					'name'       => $p['name'],
					'model'      => $p['model'],
					'image'      => $this->imageUrl($p['image']),
					'price'      => (float)$p['price'],
					'special'    => $p['special'] ? (float)$p['special'] : null,
					'rating'     => (int)$p['rating'],
				];
			}
		}

		$this->json(['success' => true, 'data' => $items]);
	}

	/**
	 * POST ?route=mobile/wishlist/add
	 * Body: product_id
	 */
	public function add(): void {
		$customer_id = $this->requireAuth();
		if (!$customer_id) return;

		if ($this->request->server['REQUEST_METHOD'] !== 'POST') {
			$this->json(['success' => false, 'error' => 'Method not allowed'], 400);
			return;
		}

		$product_id = (int)($this->request->post['product_id'] ?? 0);

		if (!$product_id) {
			$this->json(['success' => false, 'error' => 'product_id is required'], 400);
			return;
		}

		// Check product exists
		$this->load->model('catalog/product');
		$product = $this->model_catalog_product->getProduct($product_id);

		if (!$product) {
			$this->json(['success' => false, 'error' => 'Product not found'], 400);
			return;
		}

		// Check if already in wishlist
		$exists = $this->db->query("SELECT COUNT(*) AS `total` FROM `" . DB_PREFIX . "customer_wishlist` WHERE `customer_id` = '" . (int)$customer_id . "' AND `product_id` = '" . (int)$product_id . "'");

		if ((int)$exists->row['total'] === 0) {
			$this->db->query("INSERT INTO `" . DB_PREFIX . "customer_wishlist` SET `customer_id` = '" . (int)$customer_id . "', `product_id` = '" . (int)$product_id . "', `date_added` = NOW()");
		}

		$this->json(['success' => true, 'message' => 'Product added to wishlist']);
	}

	/**
	 * POST ?route=mobile/wishlist/remove
	 * Body: product_id
	 */
	public function remove(): void {
		$customer_id = $this->requireAuth();
		if (!$customer_id) return;

		$product_id = (int)($this->request->post['product_id'] ?? 0);

		if (!$product_id) {
			$this->json(['success' => false, 'error' => 'product_id is required'], 400);
			return;
		}

		$this->db->query("DELETE FROM `" . DB_PREFIX . "customer_wishlist` WHERE `customer_id` = '" . (int)$customer_id . "' AND `product_id` = '" . (int)$product_id . "'");

		$this->json(['success' => true, 'message' => 'Product removed from wishlist']);
	}
}
