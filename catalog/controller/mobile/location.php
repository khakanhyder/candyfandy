<?php
namespace Opencart\Catalog\Controller\Mobile;

class Location extends \Opencart\System\Engine\Controller {

	private function json(array $data, int $status = 200): void {
		$protocol = $this->request->server['SERVER_PROTOCOL'] ?? 'HTTP/1.1';
		if ($status !== 200) {
			$texts = [400 => '400 Bad Request', 404 => '404 Not Found'];
			$this->response->addHeader($protocol . ' ' . ($texts[$status] ?? $status));
		}
		$this->response->addHeader('Content-Type: application/json');
		$this->response->addHeader('Access-Control-Allow-Origin: *');
		$this->response->addHeader('Access-Control-Allow-Headers: Authorization, Content-Type');
		$this->response->setOutput(json_encode($data));
	}

	/**
	 * GET ?route=mobile/location/countries
	 * Returns all active countries.
	 */
	public function countries(): void {
		$this->load->model('localisation/country');

		$results = $this->model_localisation_country->getCountries();

		$countries = [];
		foreach ($results as $row) {
			$countries[] = [
				'country_id'  => (int)$row['country_id'],
				'name'        => $row['name'],
				'iso_code_2'  => $row['iso_code_2'],
				'iso_code_3'  => $row['iso_code_3'],
				'postcode_required' => (bool)$row['postcode_required'],
			];
		}

		$this->json(['success' => true, 'countries' => $countries]);
	}

	/**
	 * GET ?route=mobile/location/zones&country_id=X
	 * Returns all active zones/states for the given country.
	 */
	public function zones(): void {
		$country_id = (int)($this->request->get['country_id'] ?? 0);

		if (!$country_id) {
			$this->json(['success' => false, 'error' => 'country_id is required'], 400);
			return;
		}

		$this->load->model('localisation/country');
		$this->load->model('localisation/zone');

		$country_info = $this->model_localisation_country->getCountry($country_id);

		if (!$country_info) {
			$this->json(['success' => false, 'error' => 'Country not found'], 404);
			return;
		}

		$results = $this->model_localisation_zone->getZonesByCountryId($country_id);

		$zones = [];
		foreach ($results as $row) {
			$zones[] = [
				'zone_id' => (int)$row['zone_id'],
				'name'    => $row['name'],
				'code'    => $row['code'],
			];
		}

		$this->json([
			'success'    => true,
			'country_id' => $country_id,
			'zones'      => $zones,
		]);
	}
}
