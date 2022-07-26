<?php

namespace app\Controllers;

require_once 'app/Models/Sale.php';

use app\Models\Sale;

class SaleController {

	protected $sale;

	public function __construct(){  

		$this->sale = new Sale();
	}

	public function index($date, $table){
		return $this->sale->index($date, $table);
	}

    public function showSale($sale){
        return $this->sale->showSale($sale);
    }

	public function showProducts($sale){
		return $this->sale->showProducts($sale);
	}

	public function getChartData($chart_data){
		return $this->venta->getChartData($chart_data);
	}

	

}

?>