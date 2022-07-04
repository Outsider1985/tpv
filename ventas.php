<?php
require_once 'app/Controllers/SaleController.php';
require_once 'app/Controllers/TableController.php';

use app\Controllers\SaleController;
use app\Controllers\TableController;

//Creating objects
$sale = new SaleController();
$table_controller = new TableController();
//Setting variables
$table = empty($_GET['mesa']) ?  null : $_GET['mesa'];
$date = empty($_GET['fecha']) ?  date('Y-m-d') : $_GET['fecha'];
//Calling methods
$sales = $sale->index($date, $table);
$table_numbers = $table_controller->index();
if(isset($_GET['venta'])){
    $showSale = $sale->showSale($_GET['venta']);
    $showProducts = $sale->showProducts($_GET['venta']);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>diseño tpv</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/Abel.css">
    <link rel="stylesheet" href="assets/fonts/ionicons.min.css">
    <link rel="stylesheet" href="assets/fonts/line-awesome.min.css">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1 class="text-center mt-3 border titular">TPV</h1>
            </div>
            <div class="col-12 col-lg-7 col-xl-8 order-lg-1 mt-5">
                <section>
                <?php if(isset($_GET['venta'])):?>
                    <h2 class="text-center">VENTA <?=$showSale['tn']?></h2>

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Datos de la venta</h5>
                                    <p class="card-text">
                                        <strong>Mesa:</strong> <?=$showSale['mesa']?><br>
                                        <strong>Método de pago:</strong> <?=$showSale['pago']?><br>
                                        <strong>Total base:</strong> <?=$showSale['tbp']?>€<br>
                                        <strong>Total IVA:</strong> <?=$showSale['tip']?>€<br>
                                        <strong>Total:</strong> <?=$showSale['tp']?>€
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
                </section>
                <table class="table">
                        <thead>
                                <tr>
                                    <th class="text-center"scope="col"></th>
                                    <th class="text-center" scope="col">Nombre</th>
                                    <th class="text-center" scope="col">Precio Base</th>
                                    <th class="text-center" scope="col">Cantidad</th>
                                </tr>
                        </thead>
                        <tbody>
                        <?php if(isset($_GET['venta'])):?>

                        <?php foreach($showProducts as $product):?>
                                <tr>
                                    <td class="text-center"><img class="img-ticket" src="<?=$product['pimg']?>"></td>
                                    <td class="text-center"><?=$product['pn']?></td>
                                    <td class="text-center"><?=$product['bp']?> €</td>
                                    <td class="text-center"><?=$product['q']?></td>
                                </tr>
                        <?php endforeach; ?>
                        <?php endif; ?>

                        </tbody>    
                </table>
            </div>

            <div class="col-12 col-lg-5 col-xl-4 mt-5">
                <aside>
                    <h2 class="text-center">VENTAS</h2>

                    <form action="ventas.php" method="GET">

                        <div class="row mt-3 mb-3">
                            <div class="col-6">
                                <p>Filtrar por fecha:</p>
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <input type="date" name="fecha" value="<?=$date?>" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="row mt-3 mb-3">
                            <div class="col-6">
                                <p>Filtrar por mesa:</p>
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <select name="mesa" class="form-control">
                                        <option value="">Todas</option>
                                        <?php foreach($table_numbers as $table_number):?>
                                            <option value="<?= $table_number['number'] ?>" <?= $table_number['number'] == $table ? 'selected': ''  ?> > <?= $table_number['number'] ?></option>
                                        <?php endforeach;?>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-3 mb-3">
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary w-100">Filtrar</button>
                            </div>
                        </div>

                    </form>

                    <div class="list-group">

                    <?php foreach($sales as $sale):?>

                        <?php if(isset($_GET['venta']) && $_GET['venta']==$sale['idx']): ?>

                        <a class="sale-item list-group-item list-group-item-action active" href="ventas.php?venta=<?=$sale['idx']?>&fecha=<?=$_GET['fecha']?>&mesa=<?=$_GET['mesa']?>" aria-current="true">
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1">Ticket: <?=$sale['tnx']?></h5>
                                <small>Hora: <?=$sale['tix']?></small>
                                <small>Mesa: <?=$sale['mesax']?></small>
                            </div>
                            <p class="mb-1"><?=$sale['tpx']?>€</p>
                        </a>

                    <?php else: ?>

                        <a class="sale-item list-group-item list-group-item-action" href="ventas.php?venta=<?=$sale['idx']?>&fecha=<?=$_GET['fecha']?>&mesa=<?=$_GET['mesa']?>" aria-current="true">
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1">Ticket: <?=$sale['tnx']?></h5>
                                <small>Hora: <?=$sale['tix']?></small>
                                <small>Mesa: <?=$sale['mesax']?></small>
                            </div>
                            <p class="mb-1"><?=$sale['tpx']?>€</p>
                        </a>
                    
                    <?php endif; ?>

                    <?php endforeach;?>
                    </div>

                </aside>
                
            </div>

        </div>
    </div>

    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>