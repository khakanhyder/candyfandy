<?php
namespace Opencart\Catalog\Controller\Mobile\Category;

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

	private function imageUrl(string $path): string {
		return $path ? HTTP_SERVER . 'image/' . $path : '';
	}

	/**
	 * GET ?route=mobile/category/info&category_id=X
	 */
	public function index(): void {
		$category_id = (int)($this->request->get['category_id'] ?? 0);

		if (!$category_id) {
			$this->json(['success' => false, 'error' => 'category_id is required'], 400);
			return;
		}

		$this->load->model('catalog/category');

		$c = $this->model_catalog_category->getCategory($category_id);

		if (!$c) {
			$this->json(['success' => false, 'error' => 'Category not found'], 400);
			return;
		}

		$children_raw = $this->model_catalog_category->getCategories($category_id);
		$children = [];
		foreach ($children_raw as $child) {
			$children[] = [
				'category_id' => (int)$child['category_id'],
				'name'        => $child['name'],
				'image'       => $this->imageUrl($child['image']),
			];
		}

		$this->json([
			'success' => true,
			'data'    => [
				'category_id' => (int)$c['category_id'],
				'parent_id'   => (int)$c['parent_id'],
				'name'        => $c['name'],
				'description' => html_entity_decode($c['description'] ?? '', ENT_QUOTES, 'UTF-8'),
				'image'       => $this->imageUrl($c['image']),
				'sort_order'  => (int)$c['sort_order'],
				'children'    => $children,
			]
		]);
	}
}
