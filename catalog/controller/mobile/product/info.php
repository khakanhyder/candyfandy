<?php
namespace Opencart\Catalog\Controller\Mobile\Product;

class Info extends \Opencart\System\Engine\Controller {

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

	private function imageUrl(?string $path): string {
		return $path ? HTTP_SERVER . 'image/' . $path : '';
	}

	/**
	 * GET ?route=mobile/product/info&product_id=X
	 */
	public function index(): void {
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
					'name'         => $v['name'],
					'image'        => $this->imageUrl($v['image']),
					'price'        => (float)$v['price'],
					'price_prefix' => $v['price_prefix'],
					'quantity'     => (int)$v['quantity'],
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
		$reviews = [];
		foreach ($this->model_catalog_review->getReviewsByProductId($product_id, 0, 5) as $r) {
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

		$special = $p['special'] ?: null;

		$this->json([
			'success' => true,
			'data'    => [
				'product_id'    => (int)$p['product_id'],
				'name'          => $p['name'],
				'model'         => $p['model'],
				'sku'           => $p['sku'],
				'image'         => $this->imageUrl($p['image']),
				'price'         => (float)$p['price'],
				'special'       => $special !== null ? (float)$special : null,
				'tax_class_id'  => (int)$p['tax_class_id'],
				'quantity'      => (int)$p['quantity'],
				'rating'        => (int)$p['rating'],
				'reviews'       => (int)$p['reviews'],
				'manufacturer'  => $p['manufacturer'] ?? '',
				'date_available'=> $p['date_available'],
				'description'   => html_entity_decode($p['description'] ?? '', ENT_QUOTES, 'UTF-8'),
				'minimum'       => (int)$p['minimum'],
				'weight'        => $p['weight'],
				'weight_class'  => $p['weight_class'] ?? '',
				'length'        => $p['length'],
				'width'         => $p['width'],
				'height'        => $p['height'],
				'length_class'  => $p['length_class'] ?? '',
				'images'        => $images,
				'options'       => $options,
				'reviews'       => $reviews,
				'related'       => $related,
			]
		]);
	}
}
