<?php

    require_once 'app/Controllers/TicketController.php';
    require_once 'app/Controllers/TableController.php';
    require_once 'app/Controllers/IvaController.php';
    require_once 'app/Controllers/MetodoPagoController.php';
    require_once 'app/Controllers/ProductCategoryController.php';
  
    use app\Controllers\TicketController;
    use app\Controllers\TableController;
    use app\Controllers\IvaController;
    use app\Controllers\MetodoPagoController;
    use app\Controllers\ProductCategoryController;

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

                    // casos para la administracion de los metodos de pago

                case 'storeMetodoPago':

                    $metodo_pago = new MetodoPagoController();
                    $new_metodo_pago = $metodo_pago->store($json->id, $json->nombre);
    
                    $response = array(
                        'status' => 'ok',
                        'id' => $json->id,
                        'newElement' => $new_metodo_pago
                    );
    
                    echo json_encode($response);
    
                    break;
                
                case 'showMetodoPago':
    
                    $metodo_pago = new MetodoPagoController();
                    $metodo_pago = $metodo_pago->show($json->id);
                    
                    $response = array(
                        'status' => 'ok',
                        'element' => $metodo_pago,
                    );
    
                    echo json_encode($response);
    
                    break;
                
                case 'deleteMetodoPago':
    
                    $metodo_pago = new MetodoPagoController();
                    $metodo_pago->delete($json->id);
    
                    $response = array(
                        'status' => 'ok',
                        'id' => $json->id
                    );
    
                    echo json_encode($response);
    
                    break;


                // casos para la administracion de las categorias de productos

                case 'storeProductCategory':

                    $categoria = new ProductCategoryController();
                    $new_categoria = $categoria->store($json->id, $json->nombre);
    
                    $response = array(
                        'status' => 'ok',
                        'id' => $json->id,
                        'newElement' => $new_categoria
                    );
    
                    echo json_encode($response);
    
                    break;
                
                case 'showProductCategory':
    
                    $categoria = new ProductCategoryController();
                    $categoria = $categoria->show($json->id);
                    
                    $response = array(
                        'status' => 'ok',
                        'element' => $categoria,
                    );
    
                    echo json_encode($response);
    
                    break;
                
                case 'deleteProductCategory':
    
                    $categoria = new ProductCategoryController();
                    $categoria->delete($json->id);
    
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