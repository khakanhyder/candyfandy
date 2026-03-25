<?php
namespace Opencart\Catalog\Controller\Mobile\Auth;

class Logout extends \Opencart\System\Engine\Controller {
	public function index(): void {
		$auth = $this->request->server['HTTP_AUTHORIZATION'] ?? $_SERVER['HTTP_AUTHORIZATION'] ?? $_SERVER['REDIRECT_HTTP_AUTHORIZATION'] ?? '';
		if (!$auth && function_exists('apache_request_headers')) {
			$h = apache_request_headers();
			$auth = $h['Authorization'] ?? $h['authorization'] ?? '';
		}
		if (preg_match('/Bearer\s+(.+)/i', $auth, $m)) {
			$this->db->query("DELETE FROM `" . DB_PREFIX . "mobile_token` WHERE `token` = '" . $this->db->escape(trim($m[1])) . "'");
		}

		$this->json(['success' => true, 'message' => 'Logged out successfully']);
	}

	private function json(array $data, int $status = 200): void {
		$protocol = $this->request->server['SERVER_PROTOCOL'] ?? 'HTTP/1.1';
		if ($status !== 200) {
			$this->response->addHeader($protocol . ' ' . $status);
		}
		$this->response->addHeader('Content-Type: application/json');
		$this->response->addHeader('Access-Control-Allow-Origin: *');
		$this->response->addHeader('Access-Control-Allow-Headers: Authorization, Content-Type');
		$this->response->setOutput(json_encode($data));
	}
}
