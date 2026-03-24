<?php
namespace Opencart\Catalog\Controller\Mobile\Product;

class Popular extends \Opencart\System\Engine\Controller {

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

	private function formatProduct(array $p): array {
		$special = $p['special'] ?: null;
		return [
			'product_id'     => (int)$p['product_id'],
			'name'           => $p['name'],
			'model'          => $p['model'],
			'sku'            => $p['sku'],
			'image'          => $this->imageUrl($p['image']),
			'price'          => (float)($p['discount'] ?: $p['price']),
			'special'        => $special !== null ? (float)$special : null,
			'tax_class_id'   => (int)$p['tax_class_id'],
			'quantity'       => (int)$p['quantity'],
			'rating'         => (int)$p['rating'],
			'reviews'        => (int)($p['reviews'] ?? 0),
			'manufacturer'   => $p['manufacturer'] ?? '',
			'date_available' => $p['date_available'],
		];
	}

	/**
	 * GET ?route=mobile/product/popular
	 * Params: page, limit, category_id
	 *
	 * Returns products sorted by rating (highest first).
	 */
	public function index(): void {
		$this->load->model('catalog/product');

		$page  = max(1, (int)($this->request->get['page'] ?? 1));
		$limit = min(100, max(1, (int)($this->request->get['limit'] ?? 20)));

		$filters = [
			'sort'  => 'rating',
			'order' => 'DESC',
			'start' => ($page - 1) * $limit,
			'limit' => $limit,
		];

		if (!empty($this->request->get['category_id'])) {
			$filters['filter_category_id']  = (int)$this->request->get['category_id'];
			$filters['filter_sub_category'] = true;
		}

		$products = $this->model_catalog_product->getProducts($filters);
		$total    = $this->model_catalog_product->getTotalProducts($filters);

		$items = [];
		foreach ($products as $p) {
			$items[] = $this->formatProduct($p);
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
}
