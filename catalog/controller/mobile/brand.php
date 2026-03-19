<?php
namespace Opencart\Catalog\Controller\Mobile;

class Brand extends \Opencart\System\Engine\Controller {

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

	private function imageUrl(string $path): string {
		return $path ? HTTP_SERVER . 'image/' . $path : '';
	}

	private function formatBrand(array $m): array {
		return [
			'manufacturer_id' => (int)$m['manufacturer_id'],
			'name'            => $m['name'],
			'image'           => $this->imageUrl($m['image']),
			'sort_order'      => (int)$m['sort_order'],
		];
	}

	/**
	 * GET ?route=mobile/brand
	 * Params: category_id (required) — returns brands that have products in that category
	 */
	public function index(): void {
		$category_id = (int)($this->request->get['category_id'] ?? 0);

		if (!$category_id) {
			$this->json(['success' => false, 'error' => 'category_id is required'], 400);
			return;
		}

		$this->load->model('catalog/manufacturer');

		$results = $this->model_catalog_manufacturer->getManufacturersByCategory($category_id);

		$brands = [];
		foreach ($results as $m) {
			$brands[] = $this->formatBrand($m);
		}

		$this->json(['success' => true, 'data' => $brands]);
	}

	/**
	 * GET ?route=mobile/brand/info&manufacturer_id=X
	 * Returns single brand details
	 */
	public function info(): void {
		$manufacturer_id = (int)($this->request->get['manufacturer_id'] ?? 0);

		if (!$manufacturer_id) {
			$this->json(['success' => false, 'error' => 'manufacturer_id is required'], 400);
			return;
		}

		$this->load->model('catalog/manufacturer');

		$m = $this->model_catalog_manufacturer->getManufacturer($manufacturer_id);

		if (!$m) {
			$this->json(['success' => false, 'error' => 'Brand not found'], 400);
			return;
		}

		$this->json(['success' => true, 'data' => $this->formatBrand($m)]);
	}
}
