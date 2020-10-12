<?php 
use \Slim\Slim;
use Questoes\DB\Sql;
use Questoes\Model;
use Questoes\Model\Questao;
use Questoes\Model\Clientes;
use Questoes\Model\Disciplinas;
use Questoes\Model\Cursos;


$app->get('/teste', function() {////////////////////


});



$app->get('/', function() {////////////////////

	if (Clientes::checkLogin()) {
		header("Location: /inicio");
		exit;
	} 

	include "view/frontend/index.php";

});

$app->post('/', function() {////////////////////

	$clientes = new Clientes();

	//Verifica se o e-mail já existe no banco
	if (!$clientes->emailExistente($_POST['email'])){
		$cliente = $clientes->cadastrar($_POST);
				
		header("Location: /inicio");
		exit;
	} else {
		$erro = 'O e-mail já existe em nossos cadastros, experimente recuperar sua senha!';
		include "view/frontend/index.php";
	}

});

$app->get('/ativa-email/:code', function($code) {

	$cliente = Clientes::verifyLogin();
	$c = new Clientes();

	if ($c->getCodigoEmail($cliente->getid_cliente(), $code)){
		header("Location: /inicio");
		exit;
	} else {
		//não valida
	}

});

$app->get('/login', function() {////////////////////

	if (Clientes::checkLogin()) {
		header("Location: /inicio");
		exit;
	} 

	include "view/frontend/login.php";

});

$app->post('/login', function() {////////////////////

	$clientes = new Clientes();

	////Tenta logar, senão apresenta errro
	try {
		$clientes->login($_POST['email'], $_POST['senha']);
		header("Location: /inicio");
		exit;
	}  catch (Exception $e) {
	    $erro = $e->getMessage();
	    include "view/frontend/login.php";
	}

});

$app->get('/forgout', function() {////////////////////

	include "view/frontend/forgout.php";	
	
});

$app->get('/forgout-sucess', function() {////////////////////
	$success = true;
	include "view/frontend/forgout.php";
});

$app->post('/forgout', function() {////////////////////

	$clientes = new Clientes();

	//Verifica se o e-mail existe no banco
	if ($clientes->emailExistente($_POST['email'])){
		//$cliente = $clientes->cadastrar($_POST);
		//header("Location: /forgout-sucess");
		//exit;
	} else {
		$erro = 'E-mail não encontrado, favor efetue seu cadastro!';
		include "view/frontend/forgout.php";
	}

});




////////////////////////////////////// AREA DO CLIENTE ///////////////////////////////////////

$app->get('/inicio', function() {////////////////////

	$cliente = Clientes::verifyLogin();
	
	$q = new Questao();

	$disciplinas = Disciplinas::getDisciplinas();
	$cursos = Cursos::getCursos();

	$estatistica = $q->getEstatistica($cliente->getid_cliente());

	$msgSucesso = Model::getSuccess();

	$msgVerificaEmail = Clientes::verificaEmail($cliente->getid_cliente());

	include "view/frontend/inicio.php";

});

$app->post('/inicio', function() {////////////////////

	$cliente = Clientes::verifyLogin();

	$q = new Questao();

	$disciplinas = Disciplinas::getDisciplinas();
	$cursos = Cursos::getCursos();

	$estatistica = $q->getEstatistica($cliente->getid_cliente());

	$msgSucesso = Model::getSuccess();

	$msgVerificaEmail = Clientes::verificaEmail($cliente->getid_cliente());
	
	if (isset($_POST['btn_buscar']) && $_POST['btn_buscar'] == 'buscar'){
		$qtd_encontradas = $q->qtdEncontradas($_POST, 1);
		$_SESSION['filtro'] = $_POST;
	}

	if (isset($_POST['zerar'])){
		$q->zerar($cliente->getid_cliente());
		$estatistica = $q->getEstatistica($cliente->getid_cliente());
	}

	include "view/frontend/inicio.php";

});


$app->get('/questoes', function() {////////////////////

	$cliente = Clientes::verifyLogin();

	$questoes = new Questao();

	$filtro = $questoes->getFilter();

	if ($filtro === false){

		$questao = $questoes->getQuestaoUnica(0);
		$msgErro = "Você não selecionou nenhum filtro!";
	
	} else {

		$questao = $questoes->qtdEncontradas($filtro);

	}

	$d = new Disciplinas();
	$disciplina = $d->get($questao['id_disciplina']);

	$id_cliente = $cliente->getid_cliente();
	$id_questao = $questao['id_questao'];

	include "view/frontend/questao/questao.php";

});


include 'controller/frontend/minha_conta.php';


$app->get('/estatisticas', function() {////////////////////

	$cliente = Clientes::verifyLogin();

	include "view/frontend/suporte/suporte.php";

});

$app->get('/simulados', function() {////////////////////

	$cliente = Clientes::verifyLogin();

	include "view/frontend/simulados/simulados.php";

});

$app->get('/logout', function() {////////////////////

	$clientes = new Clientes();
	$cliente = $clientes->logout();
	header("Location: /");
	exit;
});


include 'controller/frontend/suporte.php';
include 'controller/frontend/financeiro.php';
include 'controller/frontend/pagseguro.php';

?>