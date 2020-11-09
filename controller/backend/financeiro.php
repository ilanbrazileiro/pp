<?php 

use Questoes\DB\Sql;
use Questoes\Model\Usuario;
use Questoes\Model\Order;

###################### FINANCEIRO #############################

$app->get('/admin/financeiro/listar-pedidos', function() {

	$usuario = Usuario::verifyLogin();

	$order = new Order();
	$pedidos = $order->listarTodos();

	include "view/backend/financeiro/listar-pedidos_tpl.php";

});




?>