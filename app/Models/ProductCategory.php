<?php

namespace app\Models;
require_once 'core/Connection.php';

use PDO;
use core\Connection;

class ProductCategory extends Connection{

        public function filter() {

                $query =  "SELECT * FROM product_category WHERE active = 1";
				
			$stmt = $this->pdo->prepare($query);
			$result = $stmt->execute();

			return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

	public function index(){

        $query =  "SELECT product_category.name AS NOMBRE_CATEGORIA, product_category.id AS ID_CATEGORIA, product_category.image_url AS IMAGEN_CATEGORIA
        FROM product_category
        INNER JOIN product ON product_category.id = product.category_id
        WHERE product_category.active = 1 AND product.visible = 1
        GROUP BY product_category.id";
                
        $stmt = $this->pdo->prepare($query);
        $result = $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

        public function store($id, $nombre) {

                if (empty($id)) {
                        
                        $query = "INSERT INTO product_category (name, active, created_at, updated_at)
                                        VALUES ('$nombre', 1, NOW(), NOW())";
                                        
               

                        $stmt = $this->pdo->prepare($query);
                        $result = $stmt->execute();
                        $id = $this->pdo->lastInsertId();
                
                } else {

                        $query = "UPDATE product_category SET name = '$nombre', updated_at = NOW() WHERE id = $id";
                        
                        $stmt = $this->pdo->prepare($query);
                        $result = $stmt->execute();
                        
                        

                };
                
                $query = "SELECT * FROM product_category WHERE id = $id";

                $stmt = $this->pdo->prepare($query);
                $result = $stmt->execute();

                return $stmt->fetch(PDO::FETCH_ASSOC);
        
        }

        public function show($id) {
                
                $query = "SELECT * FROM product_category WHERE id = $id";
                
                $stmt = $this->pdo->prepare($query);
                $result = $stmt->execute();

                return $stmt->fetch(PDO::FETCH_ASSOC); 
        
        }

        public function delete($id) {
                
                $query = "UPDATE product_category SET active = 0, updated_at = NOW() WHERE id = $id";
                        
                        
                $stmt = $this->pdo->prepare($query);
                $result = $stmt->execute();

                return $stmt->fetch(PDO::FETCH_ASSOC); 
        
        }

}

?>