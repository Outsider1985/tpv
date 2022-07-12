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
		return $this->ticket->show($table);
	}

	public function addProduct($price_id, $table_id)
	{
		return $this->ticket->addProduct($price_id, $table_id);
	}

	public function deleteProduct($ticket_id)
	{

		return $this->ticket->deleteProduct($ticket_id);
	}

	public function deleteAllProducts($table_id)
	{
		return $this->ticket->deleteAllProducts($table_id);
	}
}

?>