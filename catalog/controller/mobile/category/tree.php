<?php
namespace Opencart\Catalog\Controller\Mobile\Category;

class Tree extends \Opencart\System\Engine\Controller {

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
		if (!$path) return '';
		return file_exists(DIR_IMAGE . $path) ? HTTP_SERVER . 'image/' . $path : '';
	}

	/**
	 * GET ?route=mobile/category/tree
	 * Returns all top-level categories with their subcategories nested inside.
	 */
	public function index(): void {
		$this->load->model('catalog/category');

		$categories = [];

		foreach ($this->model_catalog_category->getCategories(0) as $parent) {
			$subcategories = [];

			foreach ($this->model_catalog_category->getCategories((int)$parent['category_id']) as $child) {
				$subcategories[] = [
					'category_id' => (int)$child['category_id'],
					'name'        => $child['name'],
					'image'       => $this->imageUrl($child['image']),
					'sort_order'  => (int)$child['sort_order'],
				];
			}

			$categories[] = [
				'category_id'   => (int)$parent['category_id'],
				'name'          => $parent['name'],
				'description'   => html_entity_decode($parent['description'] ?? '', ENT_QUOTES, 'UTF-8'),
				'image'         => $this->imageUrl($parent['image']),
				'sort_order'    => (int)$parent['sort_order'],
				'subcategories' => $subcategories,
			];
		}

		$this->json(['success' => true, 'data' => $categories]);
	}
}
