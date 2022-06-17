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
}

?>