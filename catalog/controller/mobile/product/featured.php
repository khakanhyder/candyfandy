<?php
namespace Opencart\Catalog\Controller\Mobile\Product;

class Featured extends \Opencart\System\Engine\Controller {

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
	 * GET ?route=mobile/product/featured
	 * Params: page, limit
	 *
	 * Returns products configured in the Featured module(s) in admin.
	 */
	public function index(): void {
		$this->load->model('catalog/product');

		$page  = max(1, (int)($this->request->get['page'] ?? 1));
		$limit = min(100, max(1, (int)($this->request->get['limit'] ?? 20)));

		// Collect product IDs from all featured modules (status is inside the JSON setting)
		$query = $this->db->query(
			"SELECT `setting` FROM `" . DB_PREFIX . "module`
			 WHERE `code` = 'opencart.featured'"
		);

		$product_ids = [];
		foreach ($query->rows as $row) {
			$setting = json_decode($row['setting'], true);
			if (empty($setting['status'])) {
				continue;
			}
			if (!empty($setting['product']) && is_array($setting['product'])) {
				foreach ($setting['product'] as $id) {
					$product_ids[(int)$id] = true;
				}
			}
		}

		$product_ids = array_keys($product_ids);
		$total       = count($product_ids);

		// Paginate manually
		$paged_ids = array_slice($product_ids, ($page - 1) * $limit, $limit);

		$items = [];
		foreach ($paged_ids as $product_id) {
			$p = $this->model_catalog_product->getProduct($product_id);
			if ($p) {
				$items[] = $this->formatProduct($p);
			}
		}

		$this->json([
			'success' => true,
			'data'    => $items,
			'pagination' => [
				'page'        => $page,
				'limit'       => $limit,
				'total'       => $total,
				'total_pages' => (int)ceil($total / $limit),
			],
		]);
	}
}
