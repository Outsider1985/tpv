<?php

namespace app\Controllers;

require_once 'app/Models/ProductCategory.php';

use app\Models\ProductCategory;

class ProductCategoryController {

	protected $category;

	public function __construct(){  

		$this->category = new ProductCategory();
	}

	public function index(){
		return $this->category->index();
	}

	public function filter() {
		return $this->category->filter();
	}
	
	public function show($id) {
		return $this->category->show($id);
	}

	public function delete($id) {
		return $this->category->delete($id);
	}
	
	public function store($id, $nombre) {
		return $this->category->store($id, $nombre);
	}

}

?>