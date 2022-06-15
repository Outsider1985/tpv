<?php

// 1º No hay ningún ticket creado hoy, por lo que se crea uno nuevo
// con fecha de hoy y empieza por el 0001

// 2 Si hay un ticket creado hoy, por lo que tengo que añadir uno nuevo
// con fecha de hoy y empieza por el último ticket creado + 1

    

$tickets = ['2205290001', '2205290002', '2206150001', '2206150002'];
var_dump($tickets);

function getNextTicket($tickets) {

    $date=date('ymd');
    $lastTicket = end($tickets);
    $nextTicket = strval($lastTicket + 1);

    if(substr($lastTicket, 0, 6) == $date){

        array_push($tickets, $nextTicket);        

    }else {

        $newTicket = $date."0001";
        array_push($tickets, $newTicket);
    }
    
    return $tickets;
}

$tickets = getNextTicket($tickets);
echo "Último ticket: ".end($tickets)."<br>";
var_dump($tickets);

?>