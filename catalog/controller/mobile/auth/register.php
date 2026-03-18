<?php
namespace Opencart\Catalog\Controller\Mobile\Auth;

class Register extends \Opencart\System\Engine\Controller {
	public function index(): void {
		if ($this->request->server['REQUEST_METHOD'] !== 'POST') {
			$this->json(['success' => false, 'error' => 'Method not allowed'], 400);
			return;
		}

		$post = $this->request->post;
		$errors = [];

		if (!oc_validate_length(($post['firstname'] ?? ''), 1, 32)) $errors['firstname'] = 'First name must be between 1 and 32 characters';
		if (!oc_validate_length(($post['lastname'] ?? ''), 1, 32))  $errors['lastname']  = 'Last name must be between 1 and 32 characters';
		if (!oc_validate_email(($post['email'] ?? '')))             $errors['email']     = 'Valid email is required';
		
		if ($this->config->get('config_telephone_required') && !oc_validate_length(($post['telephone'] ?? ''), 3, 32)) {
			$errors['telephone'] = 'Telephone must be between 3 and 32 characters';
		}
		
		if (!oc_validate_length(($post['password'] ?? ''), 4, 40))  $errors['password']  = 'Password must be between 4 and 40 characters';
		if (($post['password'] ?? '') !== ($post['confirm'] ?? '')) $errors['confirm']   = 'Passwords do not match';

		$this->load->model('account/customer');
		if (!$errors && $this->model_account_customer->getTotalCustomersByEmail($post['email'])) {
			$errors['email'] = 'Email is already registered';
		}

		if ($errors) {
			$this->json(['success' => false, 'errors' => $errors], 422);
			return;
		}

		$customer_id = $this->model_account_customer->addCustomer([
			'firstname'  => $post['firstname'],
			'lastname'   => $post['lastname'],
			'email'      => $post['email'],
			'telephone'  => $post['telephone'] ?? '',
			'password'   => $post['password'],
			'customer_group_id' => (int)$this->config->get('config_customer_group_id'),
			'newsletter' => 0,
			'status'     => 1,
			'safe'       => 1,
			'custom_field' => [],
		]);

		$token = bin2hex(random_bytes(32));
		$this->db->query("INSERT INTO `" . DB_PREFIX . "mobile_token` SET `customer_id` = '" . (int)$customer_id . "', `token` = '" . $this->db->escape($token) . "', `date_added` = NOW(), `date_expire` = DATE_ADD(NOW(), INTERVAL 30 DAY)");

		$this->json([
			'success'     => true,
			'token'       => $token,
			'customer_id' => $customer_id,
			'message'     => 'Account created successfully'
		]);
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
