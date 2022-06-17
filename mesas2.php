<?php
require_once 'app/Controllers/TableController.php';

use app\Controllers\TableController;

$mesa = new TableController();
$mesas = $mesa->index();
?>

<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>diseño tpv</title>
    <style>
        .mesa {
            border: 0.1rem solid black;
            display: inline-block;
            margin: 0.5rem;
            padding: 4rem;
            font-size: 2rem;
        }

        .mesa.ocupada {
            background-color: red;
        }

        .mesa.libre {
            background-color: green;
        }
    </style>
</head>

<body>
    <ul>
        <?php foreach ($mesas as $mesa): ?>
            <?php if( $mesa['estado'] == 1): ?>
               <li class="mesa libre"> <?=$mesa["numero"];?> </li>
               <?php else: ?>
                <li class="mesa ocupada"> <?=$mesa["numero"];?> </li>
            <?php endif; ?>
        <?php endforeach; ?> 
    </ul>
</body>

</html>