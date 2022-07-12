<?php
require_once 'app/Controllers/ProductController.php';

use app\Controllers\ProductController;

$product = new ProductController();
$products = $product->index($_GET['categorias']);
$category = $product->show($_GET['categorias']);

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
                    <h2 class="text-center"><?= strtoupper($category['CATEGORIA'])?></h2>
                    <div class="row">
                        <div class="col">
                            <ol class="breadcrumb mb-0 mt-3">
                                <li class="breadcrumb-item"><a href="mesas.php?mesa=<?= $_GET['mesa'] ?>"><span><i class="icon ion-android-home me-2"></i>INICIO</span></a></li>
                                <li class="breadcrumb-item"><a href="categorias.php?mesa=<?= $_GET['mesa'] ?>&categorias=<?= $_GET['categorias'] ?>"><span><i class="icon ion-social-buffer-outline me-2"></i>Categoría</span></a></li>
                                <li class="breadcrumb-item active" aria-current="page"><span><i class="icon ion-android-apps me-2"></i><?=$category['CATEGORIA']?></span></li>
                            </ol>
                        </div>
                    </div>
                    <div class="row mb-5">
                    <?php foreach ($products as $product): ?>
                        <?php if(isset($_GET['categorias']) && $_GET['categorias']==$product["category_id"]): ?>
                        <div class="add-product col-6 col-md-4 gy-4" data-table="<?= $_GET['mesa'] ?>" data-price="<?= $product['price_id'];?>">
                            <a class="btn g-4 w-100 shadow cat-prod rounded-0 p-0" role="button" href="#medidas">
                                <img src="<?=$product['image_url']?>">
                            </a>
                            <h5 class="text-center mb-0"><?=$product['pn']?></h5>
                        </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                    </div>
                </section>
            </div>
            
            <?php include('tickets.php') ?>

        </div>
    </div>

    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script type="module" src="dist/main.js"></script>

</body>

</html>