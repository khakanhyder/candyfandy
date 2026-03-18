<?php
namespace Opencart\Catalog\Controller\Mobile;

class Auth extends \Opencart\System\Engine\Controller {

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

	private function createToken(int $customer_id): string {
		$token = bin2hex(random_bytes(32));
		$this->db->query("INSERT INTO `" . DB_PREFIX . "mobile_token` SET `customer_id` = '" . (int)$customer_id . "', `token` = '" . $this->db->escape($token) . "', `date_added` = NOW(), `date_expire` = DATE_ADD(NOW(), INTERVAL 30 DAY)");
		return $token;
	}

	public function login(): void {
		if ($this->request->server['REQUEST_METHOD'] !== 'POST') {
			$this->json(['success' => false, 'error' => 'Method not allowed'], 400);
			return;
		}

		$email    = trim((string)($this->request->post['email'] ?? ''));
		$password = (string)($this->request->post['password'] ?? '');

		$this->load->model('account/customer');
		$customer_info = $this->model_account_customer->getCustomerByEmail($email);

		if ($customer_info && $customer_info['status'] && password_verify(html_entity_decode($password, ENT_QUOTES, 'UTF-8'), $customer_info['password'])) {
			$token = $this->createToken((int)$customer_info['customer_id']);
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

	public function register(): void {
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

		$token = $this->createToken($customer_id);

		$this->json([
			'success'     => true,
			'token'       => $token,
			'customer_id' => $customer_id,
			'message'     => 'Account created successfully'
		]);
	}

	public function logout(): void {
		$auth = $this->request->server['HTTP_AUTHORIZATION'] ?? '';
		if (preg_match('/Bearer\s+(.+)/i', $auth, $m)) {
			$this->db->query("DELETE FROM `" . DB_PREFIX . "mobile_token` WHERE `token` = '" . $this->db->escape(trim($m[1])) . "'");
		}
		$this->json(['success' => true, 'message' => 'Logged out successfully']);
	}

	public function forgotPassword(): void {
		if ($this->request->server['REQUEST_METHOD'] !== 'POST') {
			$this->json(['success' => false, 'error' => 'Method not allowed'], 400);
			return;
		}

		$email = trim((string)($this->request->post['email'] ?? ''));

		if (!oc_validate_email($email)) {
			$this->json(['success' => false, 'errors' => ['email' => 'Valid email is required']], 422);
			return;
		}

		$this->load->model('account/customer');
		$customer_info = $this->model_account_customer->getCustomerByEmail($email);

		// Always return success to avoid revealing whether email is registered
		if ($customer_info && $customer_info['status']) {
			$code = oc_token(40);
			$this->model_account_customer->addToken((int)$customer_info['customer_id'], 'password', $code);
			$this->sendPasswordResetEmail($customer_info, $code);
		}

		$this->json(['success' => true, 'message' => 'If an account with that email exists, a password reset email has been sent.']);
	}

	public function resetPassword(): void {
		if ($this->request->server['REQUEST_METHOD'] !== 'POST') {
			$this->json(['success' => false, 'error' => 'Method not allowed'], 400);
			return;
		}

		$email    = trim((string)($this->request->post['email'] ?? ''));
		$code     = trim((string)($this->request->post['code'] ?? ''));
		$password = (string)($this->request->post['password'] ?? '');
		$confirm  = (string)($this->request->post['confirm'] ?? '');

		if (!$email || !$code) {
			$this->json(['success' => false, 'error' => 'Email and reset code are required'], 422);
			return;
		}

		$this->load->model('account/customer');
		$token_info = $this->model_account_customer->getTokenByCode($code);

		if (!$token_info || $token_info['email'] !== $email || $token_info['type'] !== 'password') {
			$this->json(['success' => false, 'error' => 'Invalid or expired reset code'], 422);
			return;
		}

		$errors = [];
		if (!oc_validate_length($password, 4, 40)) {
			$errors['password'] = 'Password must be between 4 and 40 characters';
		}
		if ($password !== $confirm) {
			$errors['confirm'] = 'Passwords do not match';
		}

		if ($errors) {
			$this->json(['success' => false, 'errors' => $errors], 422);
			return;
		}

		$this->model_account_customer->editPassword($email, $password);
		$this->model_account_customer->deleteTokenByCode($code);

		$this->json(['success' => true, 'message' => 'Password has been reset successfully']);
	}

	private function sendPasswordResetEmail(array $customer_info, string $code): void {
		if (!$this->config->get('config_mail_engine')) {
			return;
		}

		$store_name = html_entity_decode($this->config->get('config_name'), ENT_QUOTES, 'UTF-8');

		$mail_option = [
			'parameter'     => $this->config->get('config_mail_parameter'),
			'smtp_hostname' => $this->config->get('config_mail_smtp_hostname'),
			'smtp_username' => $this->config->get('config_mail_smtp_username'),
			'smtp_password' => html_entity_decode($this->config->get('config_mail_smtp_password'), ENT_QUOTES, 'UTF-8'),
			'smtp_port'     => $this->config->get('config_mail_smtp_port'),
			'smtp_timeout'  => $this->config->get('config_mail_smtp_timeout'),
		];

		$firstname = html_entity_decode($customer_info['firstname'], ENT_QUOTES, 'UTF-8');

		$subject = 'Password Reset Request - ' . $store_name;

		$body  = 'Hello ' . $firstname . ',' . "\n\n";
		$body .= 'We received a request to reset your password for your ' . $store_name . ' account.' . "\n\n";
		$body .= 'Your password reset code is:' . "\n\n";
		$body .= '    ' . $code . "\n\n";
		$body .= 'Enter this code in the app to reset your password.' . "\n";
		$body .= 'This code expires in 10 minutes.' . "\n\n";
		$body .= 'If you did not request a password reset, please ignore this email.' . "\n\n";
		$body .= 'Thanks,' . "\n";
		$body .= $store_name;

		$mail = new \Opencart\System\Library\Mail($this->config->get('config_mail_engine'), $mail_option);
		$mail->setTo($customer_info['email']);
		$mail->setFrom($this->config->get('config_email'));
		$mail->setSender($store_name);
		$mail->setSubject($subject);
		$mail->setText($body);
		$mail->send();
	}
}
