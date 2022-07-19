<?php

	namespace app\Models;
	
	require_once 'core/Connection.php';

	use PDO;
	
	use core\Connection;

	class MetodoPago extends Connection {

		public function index() {

			$query = "SELECT * FROM pay_method WHERE active = 1";
					
			$stmt = $this->pdo->prepare($query);
			$result = $stmt->execute();

			return $stmt->fetchAll(PDO::FETCH_ASSOC);
		
		}

		public function store($id, $nombre) {

			if (empty($id)) {
				
				$query = "INSERT INTO pay_method (name, active, created_at, updated_at)
						VALUES ('$nombre', 1, NOW(), NOW())";
						
                       

				$stmt = $this->pdo->prepare($query);
				$result = $stmt->execute();
				$id = $this->pdo->lastInsertId();
			
			} else {

				$query = "UPDATE pay_method SET name = '$nombre', updated_at = NOW() WHERE id = $id";
				
				$stmt = $this->pdo->prepare($query);
				$result = $stmt->execute();
				
				

			};
			
			$query = "SELECT * FROM pay_method WHERE id = $id";

			$stmt = $this->pdo->prepare($query);
			$result = $stmt->execute();

			return $stmt->fetch(PDO::FETCH_ASSOC);
		
		}

		public function show($id) {
			
			$query = "SELECT * FROM pay_method WHERE id = $id";
			
			$stmt = $this->pdo->prepare($query);
			$result = $stmt->execute();

			return $stmt->fetch(PDO::FETCH_ASSOC); 
		
		}

		public function delete($id) {
			
			$query = "UPDATE pay_method SET active = 0, updated_at = NOW() WHERE id = $id";
				
				
			$stmt = $this->pdo->prepare($query);
			$result = $stmt->execute();

			return $stmt->fetch(PDO::FETCH_ASSOC); 
		
		}
	
	}

?>