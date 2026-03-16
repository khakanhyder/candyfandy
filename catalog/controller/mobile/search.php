<?php
namespace Opencart\Catalog\Controller\Mobile;

class Search extends \Opencart\System\Engine\Controller {

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

	/**
	 * GET ?route=mobile/search&q=keyword&page=1&limit=20&category_id=X&description=1
	 */
	public function index(): void {
		$query = trim((string)($this->request->get['q'] ?? ''));

		if (!$query) {
			$this->json(['success' => false, 'error' => 'Search query (q) is required'], 400);
			return;
		}

		$this->load->model('catalog/product');

		$page  = max(1, (int)($this->request->get['page'] ?? 1));
		$limit = min(100, max(1, (int)($this->request->get['limit'] ?? 20)));

		$filters = [
			'filter_search'      => $query,
			'filter_category_id' => (int)($this->request->get['category_id'] ?? 0) ?: null,
			'filter_description' => !empty($this->request->get['description']),
			'sort'               => 'p.date_added',
			'order'              => 'DESC',
			'start'              => ($page - 1) * $limit,
			'limit'              => $limit,
		];

		$filters = array_filter($filters, fn($v) => $v !== null && $v !== false && $v !== 0);

		$products = $this->model_catalog_product->getProducts($filters);
		$total    = $this->model_catalog_product->getTotalProducts($filters);

		$items = [];
		foreach ($products as $p) {
			$items[] = [
				'product_id' => (int)$p['product_id'],
				'name'       => $p['name'],
				'model'      => $p['model'],
				'image'      => $this->imageUrl($p['image']),
				'price'      => (float)$p['price'],
				'special'    => $p['special'] ? (float)$p['special'] : null,
				'rating'     => (int)$p['rating'],
				'reviews'    => (int)$p['reviews'],
			];
		}

		$this->json([
			'success' => true,
			'query'   => $query,
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
