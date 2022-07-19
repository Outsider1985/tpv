<?php

	namespace app\Models;
	
	require_once 'core/Connection.php';

	use PDO;
	
	use core\Connection;


	class Iva extends Connection {

        public function index() {

			$query = "SELECT * FROM iva WHERE active = 1";
					
			$stmt = $this->pdo->prepare($query);
			$result = $stmt->execute();

			return $stmt->fetchAll(PDO::FETCH_ASSOC);
		
		}

        public function show($id) {
			
			$query = "SELECT * FROM iva WHERE id = $id";
				
			$stmt = $this->pdo->prepare($query);
			$result = $stmt->execute();

			return $stmt->fetch(PDO::FETCH_ASSOC); 
		
		}

        public function store($id, $tipo_iva, $vigente) {

			if (empty($id)) {
				
				$query = "INSERT INTO iva (type, count, valid, active, created_at, updated_at)
						VALUES ($tipo_iva, 1+($tipo_iva/100), $vigente, 1, NOW(), NOW())";
                       

				$stmt = $this->pdo->prepare($query);
				$result = $stmt->execute();
				$id = $this->pdo->lastInsertId();
			
			} else {

				$query = "UPDATE iva SET type = $tipo_iva, valid = $vigente, count = 1+($tipo_iva/100), updated_at = NOW() WHERE id = $id";
				
				$stmt = $this->pdo->prepare($query);
				$result = $stmt->execute();
				
				

			};
			
			$query = "SELECT * FROM iva WHERE id = $id";

			$stmt = $this->pdo->prepare($query);
			$result = $stmt->execute();

			return $stmt->fetch(PDO::FETCH_ASSOC);
		
		}

		public function delete($id) {
			
			$query =    "UPDATE iva 
                        SET valid = 0, active = 0, updated_at = NOW() 
                        WHERE id = $id";
			
            file_put_contents("fichero.txt", $query);

				
			$stmt = $this->pdo->prepare($query);
			$result = $stmt->execute();

			return $stmt->fetch(PDO::FETCH_ASSOC); 
		
		}
		
	}

?>