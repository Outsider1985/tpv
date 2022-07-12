<?php

namespace app\Models;
require_once 'core/Connection.php';

use PDO;
use core\Connection;

class Product extends Connection{

	public function index($category){

                $query =  "SELECT product.name AS pn, product.image_url AS image_url, price.id AS price_id, product_category.id AS category_id
                FROM product
                INNER JOIN price ON product.id = price.product_id
                INNER JOIN product_category ON product_category.id = product.category_id
                WHERE product.active = 1 AND category_id = $category";
                        
                $stmt = $this->pdo->prepare($query);
                $result = $stmt->execute();

                return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

        public function show($category){

                $query =        "SELECT product_category.name AS CATEGORIA
                                FROM product
                                INNER JOIN product_category ON product_category.id = product.category_id
                                WHERE product.active = 1 AND product.category_id= $category";
                        
                $stmt = $this->pdo->prepare($query);
                $result = $stmt->execute();

                return $stmt->fetch(PDO::FETCH_ASSOC);

        }

}

?>