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

    public function getChartData($chart_data){

        switch($chart_data) {
            
            case 'sales_by_hour':
                $query =  "SELECT	HOUR(created_at) AS labels,
                                    COUNT(id) AS quantity,
                                    SUM(total_price) AS data
                                    FROM sales
                                    GROUP BY HOUR(created_at)
                                    ORDER BY labels";
                break;

            case 'sales_by_day':

                $query =  "SELECT	COUNT(id) AS quantity,
                                    DAYNAME(created_at) AS labels,
                                    SUM(total_price) AS data
                                    FROM sales
                                    GROUP BY labels
                                    ORDER BY FIELD(labels, 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo')";

                break;

            case 'sales_by_month':
                
                $query ="SELECT	COUNT(id) AS quantity,
                                MONTHNAME(created_at) AS labels,
                                SUM(total_price) AS data
                                FROM sales
                                GROUP BY labels
                                ORDER BY FIELD(labels, 'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre')";
       

                break;

            case 'sales_by_year':

                $query ="SELECT	year(created_at) AS labels,
                                COUNT(id) AS quantity,
                                SUM(total_price) AS data
                                FROM ventas
                                GROUP BY labels
                                ORDER BY labels";

                break;

            case 'popular_payment_methods':

                $query ="SELECT pay_method.name AS labels,
                                COUNT(pay_method.name) AS data FROM sales
                                INNER JOIN pay_method ON pay_method.id = sales.pay_method_id
                                GROUP BY sales.pay_method_id
                                ORDER BY sales.pay_method_id";

                break;

            case 'average_service_duration':

                $query ="SELECT tables.number AS labels,
                                ROUND(AVG(ocupancy)) AS data
                                FROM sales
                                INNER JOIN tables ON tables.id = sales.table_id
                                GROUP BY tables.id
                                ORDER BY data DESC";

                break;
            
            case 'average_sale_year':

                $query ="SELECT	
                                YEAR(created_at) AS labels,
                                ROUND(AVG(total_price),2) AS data
                                FROM sales
                                GROUP BY labels
                                ORDER BY labels";

                break;

            case 'average_sale_month':

                $query ="SELECT	
                        MONTHNAME(created_at) AS labels,
                        ROUND(AVG(total_price),2) AS data
                        FROM sales
                        GROUP BY labels
                        ORDER BY FIELD(labels, 'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre')";

                break;
            
            case 'average_sale_day':

                    $query ="SELECT
                            DAYNAME(created_at) AS labels,
                            ROUND(AVG(total_price),2) AS data
                            FROM sales
                            GROUP BY labels
                            ORDER BY FIELD(labels, 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo')";
    
                    break;
        }
    
        
        $stmt = $this->pdo->prepare($query);
        $result = $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}

?>