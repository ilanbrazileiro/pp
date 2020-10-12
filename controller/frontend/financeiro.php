<?php 

use Questoes\DB\Sql;
use Questoes\Model\Questao;
use Questoes\Model\Clientes;
use Questoes\Model\Disciplinas;
use Questoes\Model\Cursos;
use Questoes\Model\Suporte;
use Questoes\Model\Usuario;

###################### FINANCEIRO #############################

$app->get('/checkout', function() {/// CHECKOUT

	$cliente = Clientes::verifyLogin();
	
	include "view/frontend/financeiro/checkout.php";

});


$app->get('/carrinho', function() {/// carrinho

	$cliente = Clientes::verifyLogin();

	$data = date('d/m/Y', strtotime("+1 month")); 
	
	include "view/frontend/financeiro/carrinho_tpl.php";

});


################### FIM FINANCEIRO #############################


?>
