<?php
namespace Opencart\Catalog\Controller\Mobile;

class Checkout extends \Opencart\System\Engine\Controller {

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

	private function loginCustomer(int $customer_id): void {
		$this->session->data['customer_id'] = $customer_id;
		if (!isset($this->session->data['customer_token'])) {
			$this->session->data['customer_token'] = bin2hex(random_bytes(16));
		}
		$this->registry->set('customer', new \Opencart\System\Library\Cart\Customer($this->registry));
		$this->registry->set('cart', new \Opencart\System\Library\Cart\Cart($this->registry));
	}

	/**
	 * Resolve a shipping/payment address from address_id (saved) or inline fields.
	 * On failure returns [] and sets $error.
	 */
	private function resolveAddress(int $customer_id, array $params, string &$error): array {
		$address_id = (int)($params['address_id'] ?? 0);

		if ($address_id) {
			$this->load->model('account/address');
			$addr = $this->model_account_address->getAddress($customer_id, $address_id);
			if (!$addr) {
				$error = 'Address not found';
				return [];
			}
			return $addr;
		}

		// Inline address
		foreach (['firstname', 'lastname', 'address_1', 'city', 'country_id'] as $field) {
			if (empty($params[$field])) {
				$error = "Field '{$field}' is required";
				return [];
			}
		}

		$country_id = (int)$params['country_id'];
		$zone_id    = (int)($params['zone_id'] ?? 0);

		$this->load->model('localisation/country');
		$country_info = $this->model_localisation_country->getCountry($country_id);
		if (!$country_info) {
			$error = 'Invalid country_id';
			return [];
		}

		$zone = '';
		$zone_code = '';
		if ($zone_id) {
			$this->load->model('localisation/zone');
			$zone_info = $this->model_localisation_zone->getZone($zone_id);
			if ($zone_info) {
				$zone      = $zone_info['name'];
				$zone_code = $zone_info['code'];
			}
		}

		$this->load->model('localisation/address_format');
		$fmt_info = $this->model_localisation_address_format->getAddressFormat($country_info['address_format_id'] ?? 0);

		return [
			'address_id'     => 0,
			'firstname'      => (string)$params['firstname'],
			'lastname'       => (string)$params['lastname'],
			'company'        => (string)($params['company'] ?? ''),
			'address_1'      => (string)$params['address_1'],
			'address_2'      => (string)($params['address_2'] ?? ''),
			'city'           => (string)$params['city'],
			'postcode'       => (string)($params['postcode'] ?? ''),
			'zone_id'        => $zone_id,
			'zone'           => $zone,
			'zone_code'      => $zone_code,
			'country_id'     => $country_id,
			'country'        => $country_info['name'],
			'iso_code_2'     => $country_info['iso_code_2'],
			'iso_code_3'     => $country_info['iso_code_3'],
			'address_format' => $fmt_info['address_format'] ?? '',
			'custom_field'   => [],
		];
	}

	/** Load minimal customer data into session for shipping/payment model queries. */
	private function setCustomerSession(int $customer_id): void {
		$this->load->model('account/customer');
		$info = $this->model_account_customer->getCustomer($customer_id);

		$this->session->data['customer'] = [
			'customer_id'       => $customer_id,
			'customer_group_id' => (int)$info['customer_group_id'],
			'firstname'         => $info['firstname'],
			'lastname'          => $info['lastname'],
			'email'             => $info['email'],
			'telephone'         => $info['telephone'],
			'custom_field'      => [],
		];
	}

	/**
	 * POST ?route=mobile/checkout/shipping_methods
	 * Body: address_id OR (firstname, lastname, address_1, city, country_id, [zone_id, postcode, company, address_2])
	 * Returns available shipping methods for the given address.
	 */
	public function shippingMethods(): void {
		$customer_id = $this->requireAuth();
		if (!$customer_id) return;

		$params = array_merge($this->request->get, $this->request->post);

		$this->loginCustomer($customer_id);
		$this->setCustomerSession($customer_id);

		if (!$this->cart->hasShipping()) {
			$this->json(['success' => true, 'data' => [], 'message' => 'Cart does not require shipping']);
			return;
		}

		$error = '';
		$address = $this->resolveAddress($customer_id, $params, $error);
		if (!$address) {
			$this->json(['success' => false, 'error' => $error], 422);
			return;
		}

		$this->session->data['shipping_address'] = $address;

		$this->load->model('checkout/shipping_method');
		$methods_raw = $this->model_checkout_shipping_method->getMethods($address);

		if (!$methods_raw) {
			$this->json(['success' => false, 'error' => 'No shipping methods available for this address'], 422);
			return;
		}

		$methods = [];
		foreach ($methods_raw as $group) {
			if (empty($group['error']) && !empty($group['quote'])) {
				foreach ($group['quote'] as $quote) {
					$methods[] = [
						'code' => $quote['code'],
						'name' => $quote['name'],
						'cost' => (float)$quote['cost'],
						'text' => $quote['text'],
					];
				}
			}
		}

		$this->json(['success' => true, 'data' => $methods]);
	}

	/**
	 * GET/POST ?route=mobile/checkout/payment_methods
	 * Optional body: address_id (or inline address fields) — used as billing address
	 * Returns available payment methods.
	 */
	public function paymentMethods(): void {
		$customer_id = $this->requireAuth();
		if (!$customer_id) return;

		$params = array_merge($this->request->get, $this->request->post);

		$this->loginCustomer($customer_id);
		$this->setCustomerSession($customer_id);

		// Set payment address if provided
		$payment_address = [];
		if (!empty($params['address_id']) || !empty($params['country_id'])) {
			$error = '';
			$address = $this->resolveAddress($customer_id, $params, $error);
			if ($address) {
				$payment_address = $address;
				$this->session->data['payment_address'] = $address;
			}
		}

		// Shipping placeholders so payment method models don't error out
		if ($this->cart->hasShipping()) {
			if (!isset($this->session->data['shipping_address'])) {
				$this->session->data['shipping_address'] = [];
			}
			if (!isset($this->session->data['shipping_method'])) {
				$this->session->data['shipping_method'] = ['name' => '', 'code' => '', 'cost' => 0, 'tax_class_id' => 0, 'text' => ''];
			}
		}

		$this->load->model('checkout/payment_method');
		$methods_raw = $this->model_checkout_payment_method->getMethods($payment_address);

		if (!$methods_raw) {
			$this->json(['success' => false, 'error' => 'No payment methods available'], 422);
			return;
		}

		$methods = [];
		foreach ($methods_raw as $code => $method) {
			if (empty($method['error'])) {
				$methods[] = [
					'code' => $code,
					'name' => $method['name'],
				];
			}
		}

		$this->json(['success' => true, 'data' => $methods]);
	}

	/**
	 * POST ?route=mobile/checkout/confirm
	 *
	 * Required body fields:
	 *   - address_id (int)  — use saved address; OR provide inline address fields:
	 *       firstname, lastname, address_1, city, country_id, [zone_id, postcode, company, address_2]
	 *   - payment_method (string) — payment method code, e.g. "cod"
	 *   - shipping_method (string) — required when cart has shippable items, e.g. "flat.flat"
	 *
	 * Optional body fields:
	 *   - comment (string)
	 */
	public function confirm(): void {
		$customer_id = $this->requireAuth();
		if (!$customer_id) return;

		if ($this->request->server['REQUEST_METHOD'] !== 'POST') {
			$this->json(['success' => false, 'error' => 'Method not allowed'], 400);
			return;
		}

		$post = $this->request->post;

		$this->loginCustomer($customer_id);

		// Validate cart
		if (!$this->cart->hasProducts()) {
			$this->json(['success' => false, 'error' => 'Cart is empty'], 422);
			return;
		}

		if (!$this->cart->hasStock() && !$this->config->get('config_stock_checkout')) {
			$this->json(['success' => false, 'error' => 'Some products are out of stock'], 422);
			return;
		}

		if (!$this->cart->hasMinimum()) {
			$this->json(['success' => false, 'error' => 'Minimum order quantity not met'], 422);
			return;
		}

		$this->setCustomerSession($customer_id);
		$customer_info = $this->session->data['customer'];

		// Resolve address
		$error = '';
		$address = $this->resolveAddress($customer_id, $post, $error);
		if (!$address) {
			$this->json(['success' => false, 'error' => $error], 422);
			return;
		}

		$this->session->data['shipping_address'] = $address;
		$this->session->data['payment_address']  = $address;

		// Shipping method
		if ($this->cart->hasShipping()) {
			$shipping_code = trim((string)($post['shipping_method'] ?? ''));
			if (!$shipping_code) {
				$this->json(['success' => false, 'error' => 'shipping_method is required'], 422);
				return;
			}

			$this->load->model('checkout/shipping_method');
			$shipping_groups = $this->model_checkout_shipping_method->getMethods($address);

			$found_shipping = null;
			foreach ($shipping_groups as $group) {
				if (!empty($group['quote'])) {
					foreach ($group['quote'] as $quote) {
						if ($quote['code'] === $shipping_code) {
							$found_shipping = $quote;
							break 2;
						}
					}
				}
			}

			if (!$found_shipping) {
				$this->json(['success' => false, 'error' => 'Invalid shipping_method code'], 422);
				return;
			}

			$this->session->data['shipping_method'] = [
				'name'         => $found_shipping['name'],
				'code'         => $found_shipping['code'],
				'cost'         => (float)$found_shipping['cost'],
				'tax_class_id' => (int)($found_shipping['tax_class_id'] ?? 0),
				'text'         => $found_shipping['text'],
			];
		}

		// Payment method
		$payment_code = trim((string)($post['payment_method'] ?? ''));
		if (!$payment_code) {
			$this->json(['success' => false, 'error' => 'payment_method is required'], 422);
			return;
		}

		$this->load->model('checkout/payment_method');
		$payment_methods = $this->model_checkout_payment_method->getMethods($address);

		if (!isset($payment_methods[$payment_code]) || !empty($payment_methods[$payment_code]['error'])) {
			$this->json(['success' => false, 'error' => 'Invalid payment_method code'], 422);
			return;
		}

		$this->session->data['payment_method'] = [
			'name' => $payment_methods[$payment_code]['name'],
			'code' => $payment_code,
		];

		// Build order
		$order_data = [];

		$order_data['invoice_prefix']  = $this->config->get('config_invoice_prefix');
		$order_data['subscription_id'] = 0;
		$order_data['store_id']        = $this->config->get('config_store_id');
		$order_data['store_name']      = $this->config->get('config_name');
		$order_data['store_url']       = $this->config->get('config_url');

		// Customer
		$order_data['customer_id']       = $customer_id;
		$order_data['customer_group_id'] = (int)$customer_info['customer_group_id'];
		$order_data['firstname']         = $customer_info['firstname'];
		$order_data['lastname']          = $customer_info['lastname'];
		$order_data['email']             = $customer_info['email'];
		$order_data['telephone']         = $customer_info['telephone'];
		$order_data['custom_field']      = [];

		// Payment address (same as shipping address)
		$order_data['payment_address_id']     = (int)($address['address_id'] ?? 0);
		$order_data['payment_firstname']      = $address['firstname'];
		$order_data['payment_lastname']       = $address['lastname'];
		$order_data['payment_company']        = $address['company'] ?? '';
		$order_data['payment_address_1']      = $address['address_1'];
		$order_data['payment_address_2']      = $address['address_2'] ?? '';
		$order_data['payment_city']           = $address['city'];
		$order_data['payment_postcode']       = $address['postcode'] ?? '';
		$order_data['payment_zone']           = $address['zone'] ?? '';
		$order_data['payment_zone_id']        = (int)($address['zone_id'] ?? 0);
		$order_data['payment_country']        = $address['country'];
		$order_data['payment_country_id']     = (int)$address['country_id'];
		$order_data['payment_address_format'] = $address['address_format'] ?? '';
		$order_data['payment_custom_field']   = [];
		$order_data['payment_method']         = $this->session->data['payment_method'];

		// Shipping address
		if ($this->cart->hasShipping()) {
			$order_data['shipping_address_id']     = (int)($address['address_id'] ?? 0);
			$order_data['shipping_firstname']      = $address['firstname'];
			$order_data['shipping_lastname']       = $address['lastname'];
			$order_data['shipping_company']        = $address['company'] ?? '';
			$order_data['shipping_address_1']      = $address['address_1'];
			$order_data['shipping_address_2']      = $address['address_2'] ?? '';
			$order_data['shipping_city']           = $address['city'];
			$order_data['shipping_postcode']       = $address['postcode'] ?? '';
			$order_data['shipping_zone']           = $address['zone'] ?? '';
			$order_data['shipping_zone_id']        = (int)($address['zone_id'] ?? 0);
			$order_data['shipping_country']        = $address['country'];
			$order_data['shipping_country_id']     = (int)$address['country_id'];
			$order_data['shipping_address_format'] = $address['address_format'] ?? '';
			$order_data['shipping_custom_field']   = [];
			$order_data['shipping_method']         = $this->session->data['shipping_method'];
		} else {
			$order_data['shipping_address_id']     = 0;
			$order_data['shipping_firstname']      = '';
			$order_data['shipping_lastname']       = '';
			$order_data['shipping_company']        = '';
			$order_data['shipping_address_1']      = '';
			$order_data['shipping_address_2']      = '';
			$order_data['shipping_city']           = '';
			$order_data['shipping_postcode']       = '';
			$order_data['shipping_zone']           = '';
			$order_data['shipping_zone_id']        = 0;
			$order_data['shipping_country']        = '';
			$order_data['shipping_country_id']     = 0;
			$order_data['shipping_address_format'] = '';
			$order_data['shipping_custom_field']   = [];
			$order_data['shipping_method']         = [];
		}

		// Products
		$order_data['products'] = [];
		foreach ($this->cart->getProducts() as $product) {
			$subscription_data = [];
			if ($product['subscription']) {
				$subscription_data = [
					'trial_tax' => $this->tax->getTax($product['subscription']['trial_price'], $product['tax_class_id']),
					'tax'       => $this->tax->getTax($product['subscription']['price'], $product['tax_class_id'])
				] + $product['subscription'];
			}
			$order_data['products'][] = [
				'subscription' => $subscription_data,
				'tax'          => $this->tax->getTax($product['price'], $product['tax_class_id'])
			] + $product;
		}

		$order_data['comment'] = (string)($post['comment'] ?? '');

		// Totals
		$totals = [];
		$taxes  = $this->cart->getTaxes();
		$total  = 0;
		$this->load->model('checkout/cart');
		($this->model_checkout_cart->getTotals)($totals, $taxes, $total);

		$order_data['totals'] = $totals;
		$order_data['taxes']  = $taxes;
		$order_data['total']  = $total;

		// Affiliate / marketing
		$order_data['affiliate_id'] = 0;
		$order_data['commission']   = 0;
		$order_data['marketing_id'] = 0;
		$order_data['tracking']     = '';

		// Locale / currency
		$order_data['language_id']   = $this->config->get('config_language_id');
		$order_data['language_code'] = $this->config->get('config_language');

		$currency_code = $this->session->data['currency'] ?? $this->config->get('config_currency');
		$order_data['currency_id']    = $this->currency->getId($currency_code);
		$order_data['currency_code']  = $currency_code;
		$order_data['currency_value'] = $this->currency->getValue($currency_code);

		// IP / user-agent
		$order_data['ip']              = oc_get_ip();
		$order_data['forwarded_ip']    = $this->request->server['HTTP_X_FORWARDED_FOR'] ?? $this->request->server['HTTP_CLIENT_IP'] ?? '';
		$order_data['user_agent']      = $this->request->server['HTTP_USER_AGENT'] ?? '';
		$order_data['accept_language'] = $this->request->server['HTTP_ACCEPT_LANGUAGE'] ?? '';

		// Save order
		$this->load->model('checkout/order');
		$order_id = $this->model_checkout_order->addOrder($order_data);
		$this->model_checkout_order->addHistory($order_id, (int)$this->config->get('config_order_status_id'));

		// Empty the cart
		$this->cart->clear();

		$this->json([
			'success'  => true,
			'message'  => 'Order placed successfully',
			'order_id' => $order_id,
		]);
	}
}
