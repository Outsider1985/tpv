<?php

    require_once 'app/Controllers/TicketController.php';
  
    use app\Controllers\TicketController;

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

                $newProduct = $ticket->addProduct($json->price_id, $json->table_id);

                $response = array(
                    'status' => 'ok',
                    'newProduct' => $newProduct,
                );

                echo json_encode($response);

                break;

            }


    } else {
        echo json_encode(array('error' => 'No action'));
    }    

?>