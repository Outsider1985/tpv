<?php

namespace app\Models;
require_once 'core/Connection.php';

use PDO;
use core\Connection;

class Ticket extends Connection{

	public function index($table){

                $query =
                        "SELECT product_category.name AS CATEGORIA,
                        product.name AS PRODUCTO,
                        price.base_price AS BASE_IMPONIBLE,
                        iva.type AS IVA,
                        product.image_url AS IMAGEN
                        FROM ticket
                        INNER JOIN price ON price.id = ticket.price_id
                        INNER JOIN tables ON tables.id = ticket.table_id
                        INNER JOIN product ON product.id = price.product_id
                        INNER JOIN iva ON iva.id = price.iva_id
                        INNER JOIN product_category ON product_category.id = product.category_id
                        WHERE tables.id = $table AND sales_id IS NULL AND ticket.active = 1";
                        
                $stmt = $this->pdo->prepare($query);
                $result = $stmt->execute();
        
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
                }
}

?>