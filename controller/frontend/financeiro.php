<?php 

use Questoes\DB\Sql;
use Questoes\Model\Questao;
use Questoes\Model\Clientes;
use Questoes\Model\Disciplinas;
use Questoes\Model\Cursos;
use Questoes\Model\Suporte;
use Questoes\Model\Usuario;
use Questoes\Model\Order;

###################### FINANCEIRO #############################

$app->get('/checkout', function() {/// CHECKOUT

	$cliente = Clientes::verifyLogin();
	
	include "view/frontend/financeiro/checkout.php";

});


$app->get('/carrinho', function() {/// carrinho

	$cliente = Clientes::verifyLogin();

	$clientes = $cliente->getCompleto($cliente->getid_cliente());

	$data = date('d/m/Y', strtotime("+1 month", strtotime($cliente->getdt_expira()))); 
	
	include "view/frontend/financeiro/carrinho_tpl.php";

});

$app->post('/carrinho', function() {/// carrinho

	$cliente = Clientes::verifyLogin();

	//Atualizando os dados
	$cliente->atualizaCadastroPagamento($cliente->getid_cliente(), $_POST);
	$clientes = $cliente->getCompleto($cliente->getid_cliente());
	
	$order = new Order();

	//Registra o Pedido
	$pedido = $order->save($cliente->getid_cliente(), $clientes['id_endereco'], $_POST);
	$pedido['qtd'] = $_POST['qtd'];

	$order->toSession($pedido);

	header('Location: /payment/pagseguro');
	exit;

});


################### FIM FINANCEIRO #############################


?>
