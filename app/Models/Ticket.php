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
                        price.base_price AS BASE_IMPONIBLE_INDEX,
                        product.image_url AS IMAGEN
                        FROM ticket
                        INNER JOIN price ON price.id = ticket.price_id
                        INNER JOIN tables ON tables.id = ticket.table_id
                        INNER JOIN product ON product.id = price.product_id
                        INNER JOIN product_category ON product_category.id = product.category_id
                        WHERE tables.id = $table AND sales_id IS NULL AND ticket.active = 1";
                        
                $stmt = $this->pdo->prepare($query);
                $result = $stmt->execute();
        
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function total($table){

                $query =
                        "SELECT round(SUM(price.base_price),2) AS BASE_IMPONIBLE_TOTALES,
                        round(SUM(price.base_price * iva.count)-SUM(price.base_price),2) AS IVA,
                        round(SUM(price.base_price * iva.count),2) AS TOTAL
                        FROM ticket
                        INNER JOIN price ON price.id = ticket.price_id
                        INNER JOIN tables ON tables.id = ticket.table_id
                        INNER JOIN iva ON iva.id = price.iva_id
                        WHERE tables.id = $table AND sales_id IS NULL AND ticket.active = 1";

                $stmt = $this->pdo->prepare($query);
                $result = $stmt->execute();

                return $stmt->fetch(PDO::FETCH_ASSOC);
                        
        }

        public function show($table){

                $query =        "SELECT tables.number AS NUMERO
                                FROM tables
                                WHERE tables.active = 1 AND tables.id= $table";
                        
                $stmt = $this->pdo->prepare($query);
                $result = $stmt->execute();
        
                return $stmt->fetch(PDO::FETCH_ASSOC);
        
        }

}
?>