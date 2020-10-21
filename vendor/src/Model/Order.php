<?php 

namespace Questoes\Model;

use \Questoes\DB\Sql;
use \Questoes\Model;


class Order extends Model {

	const SESSION = 'OrderSession';

	//Variaveis do Pedido de pagamento
	private $vlTotal = 0;


	//Carrega o Pedido na Sessão
	public function toSession(){

		$this->setvlTotal(30.00);

		$_SESSION[Order::SESSION] = $this->getValues();

	}

	//Seta o pedido
	public function getFromSession(){

		$this->setData($_SESSION[Order::SESSION]);

	}

	public function getAddress(){

		
		
	}



}

?>