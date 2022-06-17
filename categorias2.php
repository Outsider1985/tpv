<?php
require_once 'app/Controllers/ProductCategoryController.php';

use app\Controllers\ProductCategoryController;

$category = new ProductCategoryController();
$categories = $category->index();
?>

<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>diseño tpv</title>
    <style>
        .category {
            border: 0.1rem solid black;
            display: inline-block;
            margin: 0.5rem;
            padding: 4rem;
            font-size: 2rem;
            background-color: hsla(0, 50%, 50%, 0.5);
        }
    </style>
</head>

<body>

    <ul>
        <?php foreach ($categories as $category): ?>
               <li class="category"> <?=$category["nombre"];?> </li>
        <?php endforeach; ?> 
    </ul>

</body>

</html>