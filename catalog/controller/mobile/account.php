<?php
namespace Opencart\Catalog\Controller\Mobile;

class Account extends \Opencart\System\Engine\Controller {

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

	/**
	 * GET ?route=mobile/account
	 * Returns customer profile
	 */
	public function index(): void {
		$customer_id = $this->requireAuth();
		if (!$customer_id) return;

		$this->load->model('account/customer');
		$c = $this->model_account_customer->getCustomer($customer_id);

		if (!$c) {
			$this->json(['success' => false, 'error' => 'Customer not found'], 400);
			return;
		}

		$this->json([
			'success' => true,
			'data'    => [
				'customer_id'       => (int)$c['customer_id'],
				'firstname'         => $c['firstname'],
				'lastname'          => $c['lastname'],
				'email'             => $c['email'],
				'telephone'         => $c['telephone'],
				'newsletter'        => (bool)$c['newsletter'],
				'customer_group_id' => (int)$c['customer_group_id'],
				'date_added'        => $c['date_added'],
			]
		]);
	}

	/**
	 * POST ?route=mobile/account/edit
	 * Body: firstname, lastname, telephone, (optionally: password, confirm)
	 */
	public function edit(): void {
		$customer_id = $this->requireAuth();
		if (!$customer_id) return;

		if ($this->request->server['REQUEST_METHOD'] !== 'POST') {
			$this->json(['success' => false, 'error' => 'Method not allowed'], 400);
			return;
		}

		$firstname = trim((string)($this->request->post['firstname'] ?? ''));
		$lastname  = trim((string)($this->request->post['lastname'] ?? ''));
		$telephone = trim((string)($this->request->post['telephone'] ?? ''));
		$password  = (string)($this->request->post['password'] ?? '');
		$confirm   = (string)($this->request->post['confirm'] ?? '');

		$errors = [];

		if (!oc_validate_length($firstname, 1, 32)) {
			$errors['firstname'] = 'First name must be between 1 and 32 characters';
		}
		if (!oc_validate_length($lastname, 1, 32)) {
			$errors['lastname'] = 'Last name must be between 1 and 32 characters';
		}
		if ($password && !oc_validate_length($password, 4, 40)) {
			$errors['password'] = 'Password must be between 4 and 40 characters';
		}
		if ($password && $password !== $confirm) {
			$errors['confirm'] = 'Passwords do not match';
		}

		if ($errors) {
			$this->json(['success' => false, 'errors' => $errors], 422);
			return;
		}

		$this->load->model('account/customer');
		$existing = $this->model_account_customer->getCustomer($customer_id);

		$data = [
			'firstname'  => $firstname,
			'lastname'   => $lastname,
			'email'      => $existing['email'],
			'telephone'  => $telephone ?: $existing['telephone'],
			'newsletter' => (int)($this->request->post['newsletter'] ?? $existing['newsletter']),
		];

		if ($password) {
			$data['password'] = $password;
		}

		$this->model_account_customer->editCustomer($customer_id, $data);

		$this->json(['success' => true, 'message' => 'Profile updated successfully']);
	}

	/**
	 * GET ?route=mobile/account/addresses
	 */
	public function addresses(): void {
		$customer_id = $this->requireAuth();
		if (!$customer_id) return;

		$this->load->model('account/address');
		$results = $this->model_account_address->getAddresses($customer_id);

		$addresses = [];
		foreach ($results as $a) {
			$addresses[] = [
				'address_id' => (int)$a['address_id'],
				'firstname'  => $a['firstname'],
				'lastname'   => $a['lastname'],
				'company'    => $a['company'],
				'address_1'  => $a['address_1'],
				'address_2'  => $a['address_2'],
				'city'       => $a['city'],
				'postcode'   => $a['postcode'],
				'zone'       => $a['zone'],
				'zone_id'    => (int)$a['zone_id'],
				'country'    => $a['country'],
				'country_id' => (int)$a['country_id'],
				'default'    => (bool)$a['default'],
			];
		}

		$this->json(['success' => true, 'data' => $addresses]);
	}

	/**
	 * POST ?route=mobile/account/address_delete
	 * Body: address_id
	 */
	public function address_delete(): void {
		$customer_id = $this->requireAuth();
		if (!$customer_id) return;

		if ($this->request->server['REQUEST_METHOD'] !== 'POST') {
			$this->json(['success' => false, 'error' => 'Method not allowed'], 400);
			return;
		}

		$address_id = (int)($this->request->post['address_id'] ?? 0);

		if (!$address_id) {
			$this->json(['success' => false, 'error' => 'address_id is required'], 422);
			return;
		}

		$this->load->model('account/address');

		// Verify address belongs to this customer
		$address = $this->model_account_address->getAddress($customer_id, $address_id);

		if (!$address) {
			$this->json(['success' => false, 'error' => 'Address not found'], 400);
			return;
		}

		// Cannot delete the only address
		if ($this->model_account_address->getTotalAddresses($customer_id) <= 1) {
			$this->json(['success' => false, 'error' => 'Cannot delete your only address'], 422);
			return;
		}

		$this->model_account_address->deleteAddress($customer_id, $address_id);

		$this->json(['success' => true, 'message' => 'Address deleted successfully']);
	}

	/**
	 * POST ?route=mobile/account/address_add
	 * Body: firstname, lastname, address_1, city, postcode, country_id, zone_id
	 */
	public function address_add(): void {
		$customer_id = $this->requireAuth();
		if (!$customer_id) return;

		if ($this->request->server['REQUEST_METHOD'] !== 'POST') {
			$this->json(['success' => false, 'error' => 'Method not allowed'], 400);
			return;
		}

		$post = $this->request->post;

		$errors = [];
		if (empty($post['firstname'])) $errors['firstname'] = 'First name is required';
		if (empty($post['lastname']))  $errors['lastname']  = 'Last name is required';
		if (empty($post['address_1'])) $errors['address_1'] = 'Address is required';
		if (empty($post['city']))      $errors['city']      = 'City is required';
		if (empty($post['country_id'])) $errors['country_id'] = 'Country is required';

		if ($errors) {
			$this->json(['success' => false, 'errors' => $errors], 422);
			return;
		}

		$this->load->model('account/address');

		$address_id = $this->model_account_address->addAddress($customer_id, [
			'firstname'  => $post['firstname'],
			'lastname'   => $post['lastname'],
			'company'    => $post['company'] ?? '',
			'address_1'  => $post['address_1'],
			'address_2'  => $post['address_2'] ?? '',
			'city'       => $post['city'],
			'postcode'   => $post['postcode'] ?? '',
			'country_id' => (int)$post['country_id'],
			'zone_id'    => (int)($post['zone_id'] ?? 0),
			'default'    => !empty($post['default']),
			'custom_field' => [],
		]);

		$this->json(['success' => true, 'address_id' => $address_id, 'message' => 'Address added']);
	}
}
