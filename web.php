<?php

    require_once 'app/Controllers/TicketController.php';
    require_once 'app/Controllers/TableController.php';
  
    use app\Controllers\TicketController;
    use app\Controllers\TableController;

    //recibirá un json
    header("Content-Type: application/json");

    if(isset($_GET['data'])){
        $json = json_decode($_GET['data']);
    }else{
        //solo las llamadas fetch de javascript, para capturar datos en la variable $json
        $json = json_decode(file_get_contents('php://input'));
    }

    if(isset($json->route)) {

        switch($json->route) {

            case 'addProduct':

                $ticket = new TicketController();
                $table = new TableController();

                $newProduct = $ticket->addProduct($json->price_id, $json->table_id);
                $newTable = $table->updateTable(0, $json->table_id);

                $response = array(
                    'status' => 'ok',
                    'newProduct' => $newProduct,
                    'newTable' => $newTable,
                );

                echo json_encode($response);

                break;

            case 'deleteProduct':

                $ticket = new TicketController();
                $mesa = new TableController();

                $delete_product = $ticket->deleteProduct($json->ticket_id);
                $total = $ticket->total($json->table_id);

                if(empty($total)){
                    $mesa->updateTable(1, $json->table_id);
                }
                
                $response = array(
                    'status' => 'ok',
                    'totales' => $total
                );

                echo json_encode($response);

                break;

            case 'deleteAllProducts':

                $ticket = new TicketController();
                $mesa = new TableController();

                $delete_products = $ticket->deleteAllProducts($json->table_id);
                $total = $ticket->total($json->table_id);
                $mesa->updateTable(1, $json->table_id);
                
                $response = array(
                    'total' => $total,
                    'status' => 'ok'
                );

                echo json_encode($response);

                break;
        }


    } else {
        echo json_encode(array('error' => 'No action'));
    }    

?>