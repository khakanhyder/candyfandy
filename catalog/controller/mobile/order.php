<?php
namespace Opencart\Catalog\Controller\Mobile;

class Order extends \Opencart\System\Engine\Controller {

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

	/**
	 * GET ?route=mobile/order&page=1&limit=10
	 * Returns paginated order history for the logged-in customer
	 */
	public function index(): void {
		$customer_id = $this->requireAuth();
		if (!$customer_id) return;

		$this->session->data['customer_id'] = $customer_id;

		$page  = max(1, (int)($this->request->get['page'] ?? 1));
		$limit = min(50, max(1, (int)($this->request->get['limit'] ?? 10)));
		$start = ($page - 1) * $limit;

		$this->load->model('account/order');

		$orders = $this->model_account_order->getOrders($customer_id, $start, $limit);
		$total  = $this->model_account_order->getTotalOrders($customer_id);

		$items = [];
		foreach ($orders as $o) {
			$items[] = [
				'order_id'        => (int)$o['order_id'],
				'status'          => $o['status'],
				'date_added'      => $o['date_added'],
				'total'           => $o['total'],
				'currency_code'   => $o['currency_code'],
				'products'        => (int)$o['products'],
			];
		}

		$this->json([
			'success' => true,
			'data'    => $items,
			'pagination' => [
				'page'        => $page,
				'limit'       => $limit,
				'total'       => (int)$total,
				'total_pages' => (int)ceil($total / $limit),
			],
		]);
	}

	/**
	 * GET ?route=mobile/order/info&order_id=X
	 */
	public function info(): void {
		$customer_id = $this->requireAuth();
		if (!$customer_id) return;

		$this->session->data['customer_id'] = $customer_id;

		$order_id = (int)($this->request->get['order_id'] ?? 0);

		if (!$order_id) {
			$this->json(['success' => false, 'error' => 'order_id is required'], 400);
			return;
		}

		$this->load->model('account/order');

		$o = $this->model_account_order->getOrder($order_id);

		if (!$o) {
			$this->json(['success' => false, 'error' => 'Order not found'], 400);
			return;
		}

		// Products in order
		$products_raw = $this->model_account_order->getProducts($order_id);
		$products = [];
		foreach ($products_raw as $p) {
			$options = [];
			foreach ($this->model_account_order->getOptions($order_id, $p['order_product_id']) as $opt) {
				$options[] = ['name' => $opt['name'], 'value' => $opt['value']];
			}
			$products[] = [
				'order_product_id' => (int)$p['order_product_id'],
				'product_id'       => (int)$p['product_id'],
				'name'             => $p['name'],
				'model'            => $p['model'],
				'quantity'         => (int)$p['quantity'],
				'price'            => (float)$p['price'],
				'total'            => (float)$p['total'],
				'options'          => $options,
			];
		}

		// Order totals
		$totals_raw = $this->model_account_order->getTotals($order_id);
		$totals = [];
		foreach ($totals_raw as $t) {
			$totals[] = [
				'code'  => $t['code'],
				'title' => $t['title'],
				'value' => (float)$t['value'],
			];
		}

		// Order history
		$history_raw = $this->model_account_order->getHistories($order_id);
		$history = [];
		foreach ($history_raw as $h) {
			$history[] = [
				'status'     => $h['status'],
				'comment'    => $h['comment'],
				'date_added' => $h['date_added'],
			];
		}

		$this->json([
			'success' => true,
			'data'    => [
				'order_id'         => (int)$o['order_id'],
				'invoice_no'       => $o['invoice_no'],
				'status'           => $o['status'],
				'date_added'       => $o['date_added'],
				'payment_method'   => $o['payment_method']['name'] ?? '',
				'shipping_method'  => $o['shipping_method']['name'] ?? '',
				'payment_address'  => [
					'firstname'  => $o['payment_firstname'],
					'lastname'   => $o['payment_lastname'],
					'address_1'  => $o['payment_address_1'],
					'city'       => $o['payment_city'],
					'country'    => $o['payment_country'],
				],
				'shipping_address' => [
					'firstname'  => $o['shipping_firstname'],
					'lastname'   => $o['shipping_lastname'],
					'address_1'  => $o['shipping_address_1'],
					'city'       => $o['shipping_city'],
					'country'    => $o['shipping_country'],
				],
				'products' => $products,
				'totals'   => $totals,
				'history'  => $history,
				'comment'  => $o['comment'],
				'currency_code'  => $o['currency_code'],
				'currency_value' => (float)$o['currency_value'],
			]
		]);
	}
}
