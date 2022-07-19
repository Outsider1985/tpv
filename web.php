<?php

    require_once 'app/Controllers/TicketController.php';
    require_once 'app/Controllers/TableController.php';
    require_once 'app/Controllers/IvaController.php';
  
    use app\Controllers\TicketController;
    use app\Controllers\TableController;
    use app\Controllers\IvaController;

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

                // casos PANEL del IVA

                case 'storeIva':

                    $iva = new IvaController();
                    $new_iva = $iva->store($json->id, $json->tipo_iva, $json->vigente);
    
                    $response = array(
                        'status' => 'ok',
                        'id' => $json->id,
                        'newElement' => $new_iva
                    );
    
                    echo json_encode($response);
    
                    break;
                
                case 'showIva':
    
                    $iva = new IvaController();
                    $iva = $iva->show($json->id);
                    
                    $response = array(
                        'status' => 'ok',
                        'element' => $iva,
                    );
    
                    echo json_encode($response);
    
                    break;
                
                case 'deleteIva':
    
                    $iva = new IvaController();
                    $iva->delete($json->id);
    
                    $response = array(
                        'status' => 'ok',
                        'id' => $json->id
                    );
    
                    echo json_encode($response);
    
                    break;
        }


    } else {
        echo json_encode(array('error' => 'No action'));
    }    

?>