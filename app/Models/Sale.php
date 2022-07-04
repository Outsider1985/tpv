<?php

namespace app\Models;
require_once 'core/Connection.php';

use PDO;
use core\Connection;

class Sale extends Connection{

	public function index($date, $table){

        if($table == null){

            $query =
                "SELECT sales.id AS idx,
                ticket_number AS tnx,  
                time_issue AS tix, 
                date_issue AS dix, 
                tables.number AS mesax, 
                total_price AS tpx 
                FROM sales 
                INNER JOIN tables ON tables.id = sales.table_id
                WHERE sales.active = 1 AND sales.date_issue ='$date'";
                
        }else{

            $query =
                "SELECT sales.id AS idx,
                ticket_number AS tnx,  
                time_issue AS tix, 
                date_issue AS dix, 
                tables.number AS mesax, 
                total_price AS tpx 
                FROM sales 
                INNER JOIN tables ON tables.id = sales.table_id
                WHERE sales.active = 1 AND sales.date_issue ='$date' AND sales.table_id = $table";
        }

        
                
        $stmt = $this->pdo->prepare($query);
        $result = $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function showSale($sale){

        $query =
                        "SELECT sales.id AS id, 
                        ticket_number AS tn,  
                        time_issue AS ti, 
                        date_issue AS di, 
                        tables.number AS mesa, 
                        total_price AS tp, 
                        total_iva_price AS tip, 
                        total_base_price AS tbp,
                        pay_method.name AS pago
                        FROM sales 
                        INNER JOIN tables ON tables.id = sales.table_id
                        INNER JOIN pay_method ON pay_method.id = sales.pay_method_id
                        WHERE sales.active = 1 AND sales.id = $sale";
                        
        $stmt = $this->pdo->prepare($query);
        $result = $stmt->execute();
        
        return $stmt->fetch(PDO::FETCH_ASSOC);

    }

    public function showProducts($sale){

        $query =
        
        "SELECT product.name AS pn, SUM(price.base_price) AS bp, product.image_url AS pimg, COUNT(product.name) AS q
        FROM sales 
        INNER JOIN `ticket` ON sales.id = ticket.sales_id
        INNER JOIN `price` ON ticket.price_id = price.id
        INNER JOIN `product` ON price.product_id = product.id
        WHERE sales.active = 1 AND sales.id = $sale
        GROUP BY product.id";
                        
                $stmt = $this->pdo->prepare($query);
                $result = $stmt->execute();
        
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}