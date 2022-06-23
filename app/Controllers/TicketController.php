<?php

namespace app\Controllers;

require_once 'app/Models/Ticket.php';

use app\Models\Ticket;

class TicketController {

	protected $ticket;

	public function __construct(){  

		$this->ticket = new Ticket();
	}

	public function index($table){
		return $this->ticket->index($table);
	}

	public function total($table){
		return $this->ticket->total($table);
	}

	public function show($table){
		return $this->table->show($table);
	}
}

?>