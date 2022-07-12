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

        public function addProduct($price_id, $table_id) 
        {

                $query =  "INSERT INTO ticket (price_id, table_id, active, created_at, updated_at) VALUES (". $price_id.", ".$table_id.", 1, NOW(), NOW())";

                file_put_contents("fichero.txt", $query);

                $stmt = $this->pdo->prepare($query);
                $result = $stmt->execute();
                $id = $this->pdo->lastInsertId();

                $query =  "SELECT tickets.id AS id, productos.nombre AS nombre, precios.precio_base AS precio_base, productos.imagen_url 
                AS imagen_url, productos_categorias.nombre AS categoria
                FROM tickets 
                INNER JOIN precios ON tickets.precio_id = precios.id 
                INNER JOIN productos ON precios.producto_id = productos.id 
                INNER JOIN productos_categorias ON productos.categoria_id = productos_categorias.id
                WHERE tickets.id = ".$id;


                $stmt = $this->pdo->prepare($query);
                $result = $stmt->execute();

                return $stmt->fetch(PDO::FETCH_ASSOC);
        }

}
?>