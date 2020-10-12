<?php 
use \Slim\Slim;
use Questoes\DB\Sql;
use Questoes\Model\Usuario;
use Questoes\Model\Questao;
use Questoes\Model\Cursos;
use Questoes\Model\Disciplinas;
use Questoes\Model\Clientes;
use Questoes\Model;


$app->get('/admin', function() {////////////////////

	Usuario::verifyLogin();

	$cliente = new Clientes();
	$questoes = new Questao();

	$totalClientes = $cliente->totalClientes();
	$clientesAtivos = $cliente->totalClientesAtivos();
	$clientesInativos = $cliente->totalClientesInativos();
	$totalQuestoes = $questoes->totalQuestoes();
	$pativo = ($clientesAtivos/$totalClientes)*100;
	$pinativo = ($clientesInativos/$totalClientes)*100;

	include "view/backend/index.php";
	
});

$app->get('/admin/login', function() {////////////////////

	if (Usuario::checkLogin() === true){
		header("Location: /admin");
		exit;
	} else {
		include "view/backend/login.php";	
	}
});

$app->post('/admin/login', function() {
	try{
		Usuario::login($_POST["login"], $_POST["password"]);
		header("Location: /admin");
		exit;
	} catch (\Exception $e) {
		$erro = $e->getMessage();
		include "view/backend/login.php";
	}

});



$app->get('/admin/logout', function() {

	Usuario::logout();
	header("Location: /admin/login");
	exit;
});

$app->get('/admin/minha-conta', function() {

	Usuario::verifyLogin();

	$user = new Usuario();
	$usuario = $user->getUsuario();
	include "view/backend/minha-conta.php";
});

$app->post('/admin/minha-conta', function() {

	Usuario::verifyLogin();
	$user = new Usuario();

	$_POST['id_usuario'] = $_SESSION[Usuario::SESSION]["id_usuario"];
		
	if ($_POST['btn'] == 'alteraSenha'){
		if($user->alterarSenha($_POST)){
			$msgsucesso = Model::getSuccess();	
		} else { $erro = Model::getError(); }
		
	} else if ($_POST['btn'] == 'alteraDados'){
		if ($user->alterarUsuario($_POST)){
			$msgsucesso = Model::getSuccess();	
		} else { $erro = Model::getError();}
	}

	$usuario = $user->getUsuario();
	include "view/backend/minha-conta.php";
});


#################### CURSOS ####################
$app->get('/admin/cursos/listar', function() {////////////////////
	Usuario::verifyLogin();
	$curso = new Cursos();
	$cursos = $curso->listarTodos();

	$msgSucesso = Model::getSuccess();
	include "view/backend/cursos/listar_cursos.php";
});

$app->get('/admin/cursos/adicionar', function() {////////////////////
	Usuario::verifyLogin();
	include "view/backend/cursos/cadastrar_cursos.php";
});

$app->post('/admin/cursos/adicionar', function() {////////////////////
	Usuario::verifyLogin();
	$cursos = new Cursos();
	$result = $cursos->adicionar($_POST);
	
	if ($result === true){
		header("Location: /admin/cursos/listar");
		exit;
	} else {
		$erro = Model::getError();
		include "view/backend/cursos/cadastrar_cursos.php";
	}
});

$app->get('/admin/cursos/deletar/:id_curso', function($id_curso) {////////////////////
	Usuario::verifyLogin();
	$curso = new Cursos();
	$cursos = $curso->deletar($id_curso);
	header("Location: /admin/cursos/listar");
	exit;
	
});

$app->get('/admin/cursos/editar/:id_curso', function($id_curso) {////////////////////
	Usuario::verifyLogin();
	$cursos = new Cursos();
	$curso = $cursos->get($id_curso);
	$curso['valor'] = number_format($curso['valor'], 2, ",", ".");
	include "view/backend/cursos/editar_cursos.php";
	
});

$app->post('/admin/cursos/editar/:id_curso', function($id_curso) {////////////////////
Usuario::verifyLogin();
	$cursos = new Cursos();
	$_POST['id_curso'] = $id_curso;
	$result = $cursos->alterar($_POST);

	$curso = $cursos->get($id_curso);
	$curso['valor'] = number_format($curso['valor'], 2, ",", ".");

	if ($result === true){
		$msgsucesso = Model::getSuccess();
		include "view/backend/cursos/editar_cursos.php";
	} else {
		$erro = Model::getError();
		include "view/backend/cursos/editar_cursos.php";
	}
});


### FIM CURSOS ###

#################### DISCIPLINAS ####################
$app->get('/admin/disciplinas/listar', function() {
	Usuario::verifyLogin();
	$disciplina = new Disciplinas();
	$disciplinas = $disciplina->listarTodos();
	$msgSucesso = Model::getSuccess();
	include "view/backend/disciplinas/listar_disciplinas.php";
});

$app->get('/admin/disciplinas/adicionar', function() {
Usuario::verifyLogin();
	$curso = new Cursos();
	$cursos = $curso->listarTodos();

	include "view/backend/disciplinas/cadastrar_disciplinas.php";
});

$app->post('/admin/disciplinas/adicionar', function() {
Usuario::verifyLogin();
	$disciplinas = new Disciplinas();
	$curso = new Cursos();
	$cursos = $curso->listarTodos();

	$result = $disciplinas->adicionar($_POST);

	if ($result === true){
		$msgSucesso = Model::getSuccess();
		header("Location: /admin/disciplinas/listar");
		exit;
	} else {
		$erro = Model::getError();
		include "view/backend/disciplinas/cadastrar_disciplinas.php";
	}
});

$app->get('/admin/disciplinas/deletar/:id_disciplina', function($id_disciplina) {
Usuario::verifyLogin();
	$disciplina = new Disciplinas();
	$disciplinas = $disciplina->deletar($id_disciplina);
	header("Location: /admin/disciplinas/listar");
	exit;
	
});

$app->get('/admin/disciplinas/editar/:id_disciplina', function($id_disciplina) {
Usuario::verifyLogin();
	$disciplinas = new Disciplinas();
	//$cursos = $disciplinas->getCursos($id_disciplina);
	$disciplina = $disciplinas->get($id_disciplina);

	$curso = new Cursos();
	$cursos = $curso->listarTodos();
	
	include "view/backend/disciplinas/editar_disciplinas.php";
	
});

$app->post('/admin/disciplinas/editar/:id_disciplina', function($id_disciplina) {
Usuario::verifyLogin();
	$disciplinas = new Disciplinas();
	$_POST['id_disciplina'] = $id_disciplina;
	$result = $disciplinas->alterar($_POST);

	$disciplina = $disciplinas->get($id_disciplina);

	$curso = new Cursos();
	$cursos = $curso->listarTodos();

	if ($result === true){
		$msgsucesso = Model::getSuccess();
		include "view/backend/disciplinas/editar_disciplinas.php";
	} else {
		$erro = Model::getError();
		include "view/backend/disciplinas/editar_disciplinas.php";
	}
});

### FIM DISCIPLINAS ###

/*
#####################	QUESTOES ######################
*/
$app->get('/admin/questoes/listar', function() {
Usuario::verifyLogin();
	$questao = new Questao();
	$questoes = $questao->listarTodos();
	$d = new Disciplinas();
	$msgSucesso = Model::getSuccess();
	include "view/backend/questoes/listarquestoes.php";
});

$app->get('/admin/questoes/adicionar', function() {
	$disciplina = new Disciplinas();
	$disciplinas = $disciplina->listarTodos();
	include "view/backend/questoes/cadastrarquestoes.php";
});

$app->post('/admin/questoes/adicionar', function() {
Usuario::verifyLogin();
	$questao = new Questao();
	$result = $questao->adicionar($_POST);
	header("Location: /admin/questoes/listar");
	exit;
});

$app->get('/admin/questoes/editar/:id_questao', function($id_questao) {
Usuario::verifyLogin();
	$questoes = new Questao();
	$questao = $questoes->get($id_questao);
	$respostas = $questoes->getTodasRespostas($id_questao);
	$disciplina = new Disciplinas();
	$disciplinas = $disciplina->listarTodos();

	$cursos = $disciplina->getCursos($questao['id_disciplina']);

	foreach ($respostas as $key => $value) {
		if ($value['certa'] == 'C'){
			$certa = array(
				'resposta' => $value['resposta'],
				'id_resposta' => $value['id_resposta']
			);
		} else if ($value['certa'] == 'E') {
			$errada[] = array(
				'resposta' => $value['resposta'],
				'id_resposta' => $value['id_resposta']
			);
		}
	}

	include "view/backend/questoes/editarquestoes.php";
	
});

$app->post('/admin/questoes/editar/:id_questao', function($id_questao) {
Usuario::verifyLogin();
	$questoes = new Questao();
	$_POST['id_questao'] = $id_questao;
	$result = $questoes->alterar($_POST);

	$questao = $questoes->get($id_questao);
	$respostas = $questoes->getTodasRespostas($id_questao);
	$disciplina = new Disciplinas();
	$disciplinas = $disciplina->listarTodos();

	$cursos = $disciplina->getCursos($questao['id_disciplina']);//todos os cursos para a disciplina
	

	foreach ($respostas as $key => $value) {
		if ($value['certa'] == 'C'){
			$certa = array(
				'resposta' => $value['resposta'],
				'id_resposta' => $value['id_resposta']
			);
		} else if ($value['certa'] == 'E') {
			$errada[] = array(
				'resposta' => $value['resposta'],
				'id_resposta' => $value['id_resposta']
			);
		}
	}

	if ($result == true){
		$msgsucesso = Model::getSuccess();
		include "view/backend/questoes/editarquestoes.php";
	} else {
		$erro = Model::getError();
		include "view/backend/questoes/editarquestoes.php";
	}

});

$app->get('/admin/questoes/deletar/:id_questao', function($id_questao) {
Usuario::verifyLogin();
	$questao = new Questao();
	$questoes = $questao->deletar($id_questao);
	header("Location: /admin/questoes/listar");
	exit;
	
});



/*
	USUÁRIOS
*/
$app->get('/admin/usuarios/listar', function() {
Usuario::verifyLogin();
	$usuario = new Usuario();
	$usuarios = $usuario->listarTodos();
	include "view/backend/usuarios/listar_usuarios.php";
});

$app->get('/admin/usuarios/adicionar', function() {
Usuario::verifyLogin();
	include "view/backend/usuarios/cadastrar_usuarios.php";
});

$app->post('/admin/usuarios/adicionar', function() {
Usuario::verifyLogin();
	$usuario = new Usuario();
	$result = $usuario->adicionar($_POST);

	if ($result === true){
		$msgSucesso = Model::getSuccess();
		header("Location: /admin/usuarios/listar");
		exit;
	} else {
		$erro = Model::getError();
		include "view/backend/usuarios/cadastrar_usuarios.php";
	}

});

$app->get('/admin/usuarios/deletar/:id_usuario', function($id_usuario) {
Usuario::verifyLogin();
	$usuario = new usuario();
	$usuarios = $usuario->deletar($id_usuario);
	header("Location: /admin/usuarios/listar");
	exit;
});

$app->get('/admin/usuarios/editar/:id_usuario', function($id_usuario) {
Usuario::verifyLogin();
	$usuarios = new Usuario();
	$usuario = $usuarios->get($id_usuario);
	include "view/backend/usuarios/editar_usuarios.php";
});

$app->post('/admin/usuarios/editar/:id_usuario', function($id_usuario) {
Usuario::verifyLogin();
	$usuarios = new Usuario();
	$_POST['id_usuario'] = $id_usuario;
	$result = $usuarios->alterar($_POST);

	$usuario = $usuarios->get($id_usuario);

	if ($result === true){
		$msgsucesso = Model::getSuccess();
		include "view/backend/usuarios/editar_usuarios.php";
	} else {
		$erro = Model::getError();
		include "view/backend/usuarios/editar_usuarios.php";
	}
});



#################### CLIENTES ####################
$app->get('/admin/clientes/listar', function() {////////////////////
	Usuario::verifyLogin();
	$cliente = new Clientes();
	$clientes = $cliente->listarTodos();

	//var_dump($clientes);

	$msgSucesso = Model::getSuccess();
	include "view/backend/clientes/listar_clientes.php";
});

$app->get('/admin/clientes/deletar/:id_cliente', function($id_cliente) {////////////////////
	Usuario::verifyLogin();
	$cliente = new Clientes();
	$clientes = $cliente->deletar($id_cliente);
	header("Location: /admin/clientes/listar");
	exit;
	
});

include 'controller/backend/suporte.php'; //Inclui páginas do Suporte

/*
$app->get('/admin/cursos/adicionar', function() {////////////////////
	Usuario::verifyLogin();
	include "view/backend/cursos/cadastrar_cursos.php";
});

$app->post('/admin/cursos/adicionar', function() {////////////////////
	Usuario::verifyLogin();
	$cursos = new Cursos();
	$result = $cursos->adicionar($_POST);
	
	if ($result === true){
		header("Location: /admin/cursos/listar");
		exit;
	} else {
		$erro = Model::getError();
		include "view/backend/cursos/cadastrar_cursos.php";
	}
});



$app->get('/admin/cursos/editar/:id_curso', function($id_curso) {////////////////////
	Usuario::verifyLogin();
	$cursos = new Cursos();
	$curso = $cursos->get($id_curso);
	$curso['valor'] = number_format($curso['valor'], 2, ",", ".");
	include "view/backend/cursos/editar_cursos.php";
	
});

$app->post('/admin/cursos/editar/:id_curso', function($id_curso) {////////////////////
Usuario::verifyLogin();
	$cursos = new Cursos();
	$_POST['id_curso'] = $id_curso;
	$result = $cursos->alterar($_POST);

	$curso = $cursos->get($id_curso);
	$curso['valor'] = number_format($curso['valor'], 2, ",", ".");

	if ($result === true){
		$msgsucesso = Model::getSuccess();
		include "view/backend/cursos/editar_cursos.php";
	} else {
		$erro = Model::getError();
		include "view/backend/cursos/editar_cursos.php";
	}
});

*/
### FIM CLIENTES ###

?>