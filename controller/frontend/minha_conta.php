<?php 

use Questoes\DB\Sql;
use Questoes\Model\Questao;
use Questoes\Model\Clientes;
use Questoes\Model\Disciplinas;
use Questoes\Model\Cursos;

$app->get('/minha-conta', function() {

	$cliente = Clientes::verifyLogin();
	$q = new Questao();
	$estatistica = $q->getEstatistica($cliente->getid_cliente());

	include "view/frontend/minha-conta/minha-conta.php";

});

$app->post('/minha-conta', function() {

	$cliente = Clientes::verifyLogin();
	$q = new Questao();
	$estatistica = $q->getEstatistica($cliente->getid_cliente());

	if (isset($_POST['zerar'])){
		$q->zerar($cliente->getid_cliente());
		$estatistica = $q->getEstatistica($cliente->getid_cliente());
	}

	if (isset($_POST['alterar_cadastro'])){
		var_dump($_POST);
		$_POST['id_cliente'] = $cliente->getid_cliente();
		$cliente->atualizaCadastro($_POST);
	}


	include "view/frontend/minha-conta/minha-conta.php";

});

$app->get('/minha-conta/estatistica', function() {

	$cliente = Clientes::verifyLogin();

	include "view/frontend/minha-conta/estatisticas.php";

});

$app->get('/minha-conta/meus-cadernos', function() {////////////////////

	$cliente = Clientes::verifyLogin();

	include "view/frontend/minha-conta/cadernos.php";

});



 ?>