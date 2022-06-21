<?php
require_once 'app/Controllers/TableController.php';

use app\Controllers\TableController;

$table = new TableController();
$tables = $table->index();

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
                    <h2 class="text-center">MESAS</h2>
                    <div class="row mb-5">
                        <?php foreach ($tables as $table): ?>
                            <?php if(isset($_GET['mesa']) && $_GET['mesa']==$table["id"]): ?>
                                <div class="col-4 gy-4"><a class="btn btn-primary w-100 p-4 p-sm-5 shadow-sm mesas rounded-0" role="button" href="categorias.php?mesa=<?= $table["id"]?> "> <?=$table["number"]?> </a></div>
                            <?php elseif($table['status'] == 1): ?>
                                <div class="col-4 gy-4"><a class="btn btn-success w-100 p-4 p-sm-5 shadow-sm mesas rounded-0" role="button" href="categorias.php?mesa=<?= $table["id"]?> "> <?=$table["number"]?> </a></div>
                            <?php else: ?>
                                <div class="col-4 gy-4"><a class="btn btn-danger w-100 p-4 p-sm-5 shadow-sm mesas rounded-0" role="button" href="categorias.php?mesa=<?= $table["id"]?> "> <?=$table["number"]?> </a></div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                </section>
            </div>
            
            <?php include('tickets.php') ?>
        </div>
    </div>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>