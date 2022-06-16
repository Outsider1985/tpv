<?php

namespace app\Controllers;

// require_once 'app/Models/Table.php';

// use app\Models\Table;

class TableController {

    // protected $table;

    // public function __construct() {
    //     $this->table = new Table();
    // }

	public function index(){
        $mesas = [
            "1" => [
                "numero" => "1",
                "estado" => "0"
            ],
            "2" => [
                "numero" => "2",
                "estado" => "1"
            ],
            "3" => [
                "numero" => "3",
                "estado" => "1"
            ],
            "4" => [
                "numero" => "4",
                "estado" => "1"
            ],
            "5" => [
                "numero" => "5",
                "estado" => "0"
            ],
            "6" => [
                "numero" => "6",
                "estado" => "1"
            ],
            "7" => [
                "numero" => "7",
                "estado" => "0"
            ],
            "8" => [
                "numero" => "8",
                "estado" => "1"
            ],
            "9" => [
                "numero" => "9",
                "estado" => "0"
            ]
        ];

        return $mesas;
	}

}

?>