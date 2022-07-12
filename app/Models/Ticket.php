<?php

namespace app\Models;
require_once 'core/Connection.php';

use PDO;
use core\Connection;

class Ticket extends Connection{

	public function index($table){

                $query =
                        "SELECT ticket.id AS TICKET, 
                        product_category.name AS CATEGORIA,
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

        public function addProduct($price_id, $table_id) 
        {

                $query =  "INSERT INTO ticket (price_id, table_id, active, created_at, updated_at) VALUES (". $price_id.", ".$table_id.", 1, NOW(), NOW())";

                $stmt = $this->pdo->prepare($query);
                $result = $stmt->execute();
                $id = $this->pdo->lastInsertId();

                $query =  "SELECT ticket.id AS id, product.name AS name, price.base_price AS bp, product.image_url 
                AS image_url, product_category.name AS category
                FROM ticket 
                INNER JOIN price ON ticket.price_id = price.id 
                INNER JOIN product ON price.product_id = product.id 
                INNER JOIN product_category ON product.category_id = product_category.id
                WHERE ticket.id = ".$id;


                $stmt = $this->pdo->prepare($query);
                $result = $stmt->execute();

                return $stmt->fetch(PDO::FETCH_ASSOC);
        }

        public function deleteProduct($ticket_id) 
        {

                $query =        "UPDATE ticket 
                                SET active=0
                                WHERE id = $ticket_id";
                
                file_put_contents("fichero.txt", $query);


                $stmt = $this->pdo->prepare($query);
                $result = $stmt->execute();

                return 'ok';
        }

        public function deleteAllProducts($table_id) 
        {

                $query =        "UPDATE ticket 
                                SET active=0
                                WHERE table_id = $table_id
                                AND sales_id IS NULL";

                $stmt = $this->pdo->prepare($query);
                $result = $stmt->execute();

                return 'ok';
        }


}
?>