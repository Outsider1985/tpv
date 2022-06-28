<?php

namespace app\Controllers;

require_once 'app/Models/Sale.php';

use app\Models\Sale;

class SaleController {

	protected $sale;

	public function __construct(){  

		$this->sale = new Sale();
	}

	public function index(){
		return $this->sale->index();
	}

    public function show($sale){
        return $this->sale->show($sale);
    }

}

?>