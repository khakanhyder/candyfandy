<?php
namespace Opencart\Catalog\Controller\Mobile;

class Product extends \Opencart\System\Engine\Controller {

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
			'product_id'  => (int)$p['product_id'],
			'name'        => $p['name'],
			'model'       => $p['model'],
			'sku'         => $p['sku'],
			'image'       => $this->imageUrl($p['image']),
			'price'       => (float)$p['price'],
			'special'     => $special !== null ? (float)$special : null,
			'tax_class_id'=> (int)$p['tax_class_id'],
			'quantity'    => (int)$p['quantity'],
			'rating'      => (int)$p['rating'],
			'reviews'     => (int)$p['reviews'],
			'manufacturer'=> $p['manufacturer'] ?? '',
			'date_available' => $p['date_available'],
		];
	}

	/**
	 * GET ?route=mobile/product
	 * Params: page, limit, category_id, manufacturer_id, sort, order
	 */
	public function index(): void {
		$this->load->model('catalog/product');

		$page     = max(1, (int)($this->request->get['page'] ?? 1));
		$limit    = min(100, max(1, (int)($this->request->get['limit'] ?? 20)));

		$filters = [
			'filter_category_id'    => (int)($this->request->get['category_id'] ?? 0) ?: null,
			'filter_manufacturer_id'=> (int)($this->request->get['manufacturer_id'] ?? 0) ?: null,
			'sort'                  => $this->request->get['sort'] ?? 'p.date_added',
			'order'                 => strtoupper($this->request->get['order'] ?? 'DESC') === 'ASC' ? 'ASC' : 'DESC',
			'start'                 => ($page - 1) * $limit,
			'limit'                 => $limit,
		];

		// Remove null filters
		$filters = array_filter($filters, fn($v) => $v !== null);

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

	/**
	 * GET ?route=mobile/product/info&product_id=X
	 */
	public function info(): void {
		$product_id = (int)($this->request->get['product_id'] ?? 0);

		if (!$product_id) {
			$this->json(['success' => false, 'error' => 'product_id is required'], 400);
			return;
		}

		$this->load->model('catalog/product');

		$p = $this->model_catalog_product->getProduct($product_id);

		if (!$p) {
			$this->json(['success' => false, 'error' => 'Product not found'], 400);
			return;
		}

		// Images
		$images = [];
		foreach ($this->model_catalog_product->getImages($product_id) as $img) {
			$images[] = $this->imageUrl($img['image']);
		}

		// Options
		$options = [];
		foreach ($this->model_catalog_product->getOptions($product_id) as $option) {
			$values = [];
			foreach ($option['product_option_value'] as $v) {
				$values[] = [
					'product_option_value_id' => (int)$v['product_option_value_id'],
					'name'     => $v['name'],
					'image'    => $this->imageUrl($v['image']),
					'price'    => (float)$v['price'],
					'price_prefix' => $v['price_prefix'],
					'quantity' => (int)$v['quantity'],
				];
			}
			$options[] = [
				'product_option_id' => (int)$option['product_option_id'],
				'name'     => $option['name'],
				'type'     => $option['type'],
				'required' => (bool)$option['required'],
				'values'   => $values,
			];
		}

		// Reviews
		$this->load->model('catalog/review');
		$reviews_raw = $this->model_catalog_review->getReviewsByProductId($product_id, 0, 5);
		$reviews = [];
		foreach ($reviews_raw as $r) {
			$reviews[] = [
				'author'     => $r['author'],
				'rating'     => (int)$r['rating'],
				'text'       => $r['text'],
				'date_added' => $r['date_added'],
			];
		}

		// Related
		$related = [];
		foreach ($this->model_catalog_product->getRelated($product_id) as $rel) {
			$related[] = [
				'product_id' => (int)$rel['product_id'],
				'name'       => $rel['name'],
				'image'      => $this->imageUrl($rel['image']),
				'price'      => (float)$rel['price'],
				'special'    => $rel['special'] ? (float)$rel['special'] : null,
			];
		}

		$data = $this->formatProduct($p);
		$data['description'] = html_entity_decode($p['description'] ?? '', ENT_QUOTES, 'UTF-8');
		$data['images']      = $images;
		$data['options']     = $options;
		$data['reviews']     = $reviews;
		$data['related']     = $related;
		$data['weight']      = $p['weight'];
		$data['weight_class']= $p['weight_class'] ?? '';
		$data['length']      = $p['length'];
		$data['width']       = $p['width'];
		$data['height']      = $p['height'];
		$data['length_class']= $p['length_class'] ?? '';
		$data['minimum']     = (int)$p['minimum'];

		$this->json(['success' => true, 'data' => $data]);
	}
}
