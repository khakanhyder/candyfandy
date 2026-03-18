<?php
namespace Opencart\Catalog\Controller\Mobile\Auth;

class Login extends \Opencart\System\Engine\Controller {
	public function index(): void {
		if ($this->request->server['REQUEST_METHOD'] !== 'POST') {
			$this->json(['success' => false, 'error' => 'Method not allowed'], 400);
			return;
		}

		$email    = trim((string)($this->request->post['email'] ?? ''));
		$password = (string)($this->request->post['password'] ?? '');

		$this->load->model('account/customer');
		$customer_info = $this->model_account_customer->getCustomerByEmail($email);

		if ($customer_info && $customer_info['status'] && password_verify(html_entity_decode($password, ENT_QUOTES, 'UTF-8'), $customer_info['password'])) {
			$token = bin2hex(random_bytes(32));
			$this->db->query("INSERT INTO `" . DB_PREFIX . "mobile_token` SET `customer_id` = '" . (int)$customer_info['customer_id'] . "', `token` = '" . $this->db->escape($token) . "', `date_added` = NOW(), `date_expire` = DATE_ADD(NOW(), INTERVAL 30 DAY)");

			$this->json([
				'success'  => true,
				'token'    => $token,
				'customer' => [
					'customer_id' => (int)$customer_info['customer_id'],
					'firstname'   => $customer_info['firstname'],
					'lastname'    => $customer_info['lastname'],
					'email'       => $customer_info['email'],
					'telephone'   => $customer_info['telephone'],
				]
			]);
		} else {
			$this->json(['success' => false, 'error' => 'Invalid email or password'], 401);
		}
	}

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
}
