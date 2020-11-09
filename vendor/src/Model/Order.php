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
	public function toSession($pedido){

		$this->setData($pedido);

		$_SESSION[Order::SESSION] = $this->getValues();

	}

	//Seta o pedido
	public function getFromSession(){

		$this->setData($_SESSION[Order::SESSION]);

	}

	public function getAddress($id_endereco){

		$sql = new Sql();

		$endereco = $sql->select('SELECT * FROM endereco WHERE id_endereco = :ID_ENDERECO', array(
			':ID_ENDERECO' 	=> (int)$id_endereco
		));

		return $endereco[0];
		
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
				a.id_pedido, a.id_cliente, a.id_endereco, a.valor, a.id_situacao, 
				c.nome, c.email, c.celular,
				e.logradouro, e.numero, e.complemento, e.bairro, e.cidade, e.uf, e.cep, e.pais, 
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

	public function save($id_cliente, $id_endereco, $dados)
	{
		$sql = new Sql();

		$pedido = $sql->select('CALL cadastrar_pedido(:ID_CLIENTE, :VALOR, :ID_ENDERECO, :DT_EXPIRA)', array(
			':ID_CLIENTE' 	=> (int)$id_cliente,
			':VALOR'		=> (float)$dados['valor_total'],
			':ID_ENDERECO'	=> (int)$id_endereco,
			':DT_EXPIRA'	=> dataBanco($dados['data_expira'])
		));

		return $pedido[0];
	}

	public function updateSituacao($id_pedido, $situacao){
		$sql = new Sql();

		$pedido = $sql->select('CALL atualizar_situacao_pedido(:ID_PEDIDO, :SITUACAO)', array(
			':ID_PEDIDO' 	=> (int)$id_pedido,
			':SITUACAO'		=> (int)$situacao
		));

		return $pedido;
	}

	public function ListarTodos(){

		$sql = new Sql();

		$pedidos = $sql->select('SELECT p.*, c.nome, c.id_cliente FROM pedido as p INNER JOIN clientes as c ON p.id_cliente = c.id_cliente ORDER BY id_pedido DESC');

		return $pedidos;
	}


}

?>