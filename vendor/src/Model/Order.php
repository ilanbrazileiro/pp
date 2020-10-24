<?php 

namespace Questoes\Model;

use \Questoes\DB\Sql;
use \Questoes\Model;


class Order extends Model {

	const SESSION = 'OrderSession';

	//Variaveis do Pedido de pagamento
	private $vlTotal = 0;
	private $id_order = 0;


	//Carrega o Pedido na Sessão
	public function toSession(){

		$this->setvlTotal(30.00);
		$this->setid_order(1);

		$_SESSION[Order::SESSION] = $this->getValues();

	}

	//Seta o pedido
	public function getFromSession(){

		$this->setData($_SESSION[Order::SESSION]);

	}

	public function getAddress(){

		
		
	}

	public function setPagSeguroTransactionResponse(
		string $descode, 
		float $vlgrossamount,
		float $vldisccountamount,
		float $vlfeeamont,
		float $vlnetamount,
		float $extraamount,
		string $despaymentlink = ""	
	)
	{

		
		$sql = new Sql();

		$sql->query("CALL sp_orderspagseguro_save(:idorder, :descode, :vlgrossamount, :vldisccountamount, :vlfeeamont, :vlnetamount, :extraamount, :despaymentlink)", [
			':idorder'=>$this->getid_pedido(),
			':descode'=>$descode,
			':vlgrossamount'=>$vlgrossamount,
			':vldisccountamount'=>$vldisccountamount,
			':vlfeeamont'=>$vlfeeamont,
			':vlnetamount'=>$vlnetamount,
			':extraamount'=>$extraamount,
			':despaymentlink'=>$despaymentlink
		]);

		
	}

	public function get($idorder)
	{

		$sql = new Sql();

		$results = $sql->select("
			SELECT 
				a.id_pedido, a.id_cliente, a.id_endereco, a.valor, a.situacao, 
				c.nome, c.email, c.celular,
				e.logradouro, e.numero, e.complemento, e.bairro, e.cidade, e.uf, e.cep, 
				g.descode, g.vlgrossamount, g.vldiscountamount, g.vlfeeamount, g.vlnetamount, g.vlextraamount, g.despaymentlink
			FROM pedido a 
			INNER JOIN clientes c USING(id_cliente)  
			INNER JOIN endereco e USING(id_endereco) 
			LEFT JOIN tb_orderspagseguro g ON g.idorder = a.id_pedido
			WHERE a.id_pedido = :idorder
		", [
			':idorder'=>$idorder
		]);

		if (count($results) > 0) {
			$this->setData($results[0]);
		} 

	}


}

?>