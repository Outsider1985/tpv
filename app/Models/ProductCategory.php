<?php

namespace app\Models;
require_once 'core/Connection.php';

use PDO;
use core\Connection;

class ProductCategory extends Connection{

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
}

?>