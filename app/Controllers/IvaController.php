<?php

	namespace app\Controllers;

	require_once 'app/Models/Iva.php';

	use app\Models\Iva;


	class IvaController {

		protected $iva;

		public function __construct() {  
			$this->iva = new Iva();
		}

		public function index() {
			return $this->iva->index();
		}

		public function show($id) {
			return $this->iva->show($id);
		}

		public function delete($id) {
			return $this->iva->delete($id);
		}
		
		public function store($id, $tipo_iva, $vigente) {
			return $this->iva->store($id, $tipo_iva, $vigente);
		}

	}

?>