<?php

namespace app\Controllers;

require_once 'app/Models/Product.php';

use app\Models\Product;

class ProductController {

	protected $product;

	public function __construct(){  

		$this->product = new Product();
	}

	public function index($category){
		return $this->product->index($category);
	}

	public function show($category){
		return $this->product->show($category);
	}
}

?>