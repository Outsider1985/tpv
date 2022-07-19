<?php

	namespace app\Controllers;

	require_once 'app/Models/MetodoPago.php';

	use app\Models\MetodoPago;

	class MetodoPagoController {

		protected $metodo_pago;

		public function __construct() {  
			$this->metodo_pago = new MetodoPago();
		}

		public function index() {
			return $this->metodo_pago->index();
		}

		public function show($id) {
			return $this->metodo_pago->show($id);
		}

		public function delete($id) {
			return $this->metodo_pago->delete($id);
		}
		
		public function store($id, $nombre) {
			return $this->metodo_pago->store($id, $nombre);
		}

	}

?>