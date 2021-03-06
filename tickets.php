<?php
require_once 'app/Controllers/TicketController.php';

use app\Controllers\TicketController;

if(isset($_GET['mesa'])):
$ticket = new TicketController();
$tickets = $ticket->index($_GET['mesa']);
$totales = $ticket->total($_GET['mesa']);
$tables = $ticket->show($_GET['mesa']);
endif;

?>

<div class="col-12 col-lg-5 col-xl-4 mt-5">
    <aside>
    <?php if(isset($_GET['mesa'])):?>
        <h2 class="text-center">TICKET MESA <?=$tables['NUMERO']?></h2>
        
        <ul class="list-group shadow mt-4">
            <?php if(empty($tickets)):?>
                <div class="p-4"> <h4>MESA SIN PRODUCTOS</h4> </div>
            <?php else: ?>
            <?php foreach($tickets as $ticket):?>
                <li class="list-group-item d-flex align-items-center">
                    <button class="delete-product btn btn-light btn-sm me-2" 
                    data-ticket="<?= $ticket['TICKET'] ?>"
					data-table="<?php echo $_GET['mesa'] ?>"
                    type="button"><i class="la la-close"></i></button>
                    <img class="img-ticket" src="<?= $ticket['IMAGEN'] ?>">
                    <div class="flex-grow-1">
                        <span class="categoria-prod"><?= $ticket['CATEGORIA'] ?></span>
                        <h4 class="nombre-prod mb-0"><?= $ticket['PRODUCTO'] ?></h4>
                    </div>
                    <p class="precio-prod"><?= $ticket['BASE_IMPONIBLE_INDEX'] ?> €</p>
                </li>
            <?php endforeach;?>
            <?php endif; ?>
        </ul>
        
        <div class="row mt-3">
            <div class="col">
                <div class="bg-secondary">
                    <div class="row justify-content-between g-0">
                        <div class="col">
                            <h5 class="text-center text-white mb-0 pt-1">B. IMPONIBLE</h5>
                        </div>
                        <div class="col">
                            <h5 class="text-center text-white mb-0 border-start pt-1">IVA</h5>
                        </div>
                        <div class="col">
                            <h5 class="text-center text-white mb-0 bg-dark pt-1">TOTAL</h5>
                        </div>
                    </div>
                    <?php if(isset($totales)&&$totales['BASE_IMPONIBLE_TOTALES']>0):?>
                    <div class="row justify-content-between g-0">
                        <div class="col">
                            <h5 class="text-center text-white mb-0 pb-1"><?=$totales['BASE_IMPONIBLE_TOTALES']?>€</h5>
                        </div>
                        <div class="col">
                            <h5 class="text-center text-white mb-0 border-start pb-1"><?=$totales['IVA']?> €</h5>
                        </div>
                        <div class="col">
                            <h5 class="text-center text-white mb-0 bg-dark pb-1"><?=$totales['TOTAL']?> €</h5>
                        </div>
                    </div>
                    <?php else: ?>
                    <div class="row justify-content-between g-0">
                        <div class="col">
                            <h5 class="text-center text-white mb-0 pb-1">0€</h5>
                        </div>
                        <div class="col">
                            <h5 class="text-center text-white mb-0 border-start pb-1">0€</h5>
                        </div>
                        <div class="col">
                            <h5 class="text-center text-white mb-0 bg-dark pb-1">0€</h5>
                        </div>
                    </div>
                    <?php endif;?>
                </div>
            </div>
        </div>
        
        <div class="row mt-3 mb-3">
            <div class="col-6">
                <div><a class="btn btn-danger btn-lg w-100" role="button" href="#myModal" data-bs-toggle="modal">ELIMINAR</a>
                    <div class="modal fade" role="dialog" tabindex="-1" id="myModal">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4>Eliminar ticket</h4><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p class="text-center text-muted">Está a punto de borrar el pedido sin ser cobrado. ¿Está completamente seguro de realizar esta acción?</p>
                                </div>
                                <div class="modal-footer"><button class="btn btn-light" type="button" data-bs-dismiss="modal">CERRAR</button><button class="delete-all-products  btn btn-success" type="button" data-table="<?php echo $_GET['mesa'] ?>">ELIMINAR</button></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div><a class="btn btn-success btn-lg w-100" role="button" href="#myModal-2" data-bs-toggle="modal">COBRAR</a>
                    <div class="modal fade" role="dialog" tabindex="-1" id="myModal-2">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4>Metodo de pago</h4><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row align-items-center flex-column">
                                        <div class="col-6 d-lg-flex m-2"><button class="btn btn-primary w-100" type="button">EFECTIVO</button></div>
                                        <div class="col-6 d-lg-flex m-2"><button class="btn btn-success w-100" type="button">TARJETA CRÉDITO</button></div>
                                        <div class="col-6 d-lg-flex m-2"><button class="btn btn-danger w-100" type="button">BIZUM</button></div>
                                    </div>
                                </div>
                                <div class="modal-footer"><button class="btn btn-light" type="button" data-bs-dismiss="modal">CERRAR</button></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif;?>
    </aside>
</div>