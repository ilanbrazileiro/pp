<?php 

use Questoes\DB\Sql;
use Questoes\Model\Questao;
use Questoes\Model\Clientes;
use Questoes\Model\Disciplinas;
use Questoes\Model\Cursos;
use Questoes\Model\Suporte;
use Questoes\Model\Usuario;

###################### SUPORTE #############################

$app->get('/suporte', function() {// Suporte

	$cliente = Clientes::verifyLogin();

	$s = new Suporte();

	$chamados_abertos = $s->listarTodosPendentes($cliente->getid_cliente());
	$chamados_fechados = $s->listarTodosFechados($cliente->getid_cliente());

	include "view/frontend/suporte/suporte.php";

});

$app->get('/suporte/:id_chamado/fechar', function($id_chamado) {// Suporte

	$cliente = Clientes::verifyLogin();

	$s = new Suporte();

	$s->fecharChamado($id_chamado);
	
	header("Location: /suporte");
	exit;

});


$app->get('/suporte/abrir-chamado', function() {// Abrir Chamado

	$cliente = Clientes::verifyLogin();
	include "view/frontend/suporte/abrir_chamado.php";

});

$app->post('/suporte/abrir-chamado', function() {// Abrir Chamado

	$cliente = Clientes::verifyLogin();

	$_POST['id_cliente'] = $cliente->getid_cliente();
	($_POST['cod_questao'] == '')? $_POST['cod_questao'] = 0 : '';

	$s = new Suporte();

	$result = $s->cadastrar($_POST);

	if ($result === true){
		header("Location: /suporte");
		exit;
	} else {
		//var_dump($result);
		$erro = 'Ocorreu um erro ao Abrir o Chamado, por favor entre em contato conosco por outro meio! Desde já pedimos desculpas pelo acontecido.';
		include "view/frontend/suporte/abrir_chamado.php";	
	}

	
});


$app->get('/suporte/chamado/', function() {// Ver Chamado // TEMPORÀRIO ATÈ SER FEITA A PROGRAMAçÂO

	$cliente = Clientes::verifyLogin();
	include "view/frontend/suporte/chamado.php";

});

$app->get('/suporte/chamado/:id_chamado', function($id_chamado) {// Ver Chamado

	$cliente = Clientes::verifyLogin();

	$s = new Suporte();

	$chamado = $s->get($id_chamado);
	$conversas = $s->getConversas($id_chamado);

	include "view/frontend/suporte/chamado.php";

});

$app->post('/suporte/chamado/:id_chamado', function($id_chamado) {// Ver Chamado

	$cliente = Clientes::verifyLogin();

	$_POST['id_cliente'] = $cliente->getid_cliente();

	$s = new Suporte();

	$result = $s->novaMensagem($_POST, $id_chamado, 'CLIENTE');

	if ($result === true){
		header("Location: /suporte/chamado/$id_chamado");
		exit;
	} else {
		//var_dump($result);
		$erro = 'Ocorreu um erro ao enviar a mensagem, por favor tente novamente. Se o erro persistir, por favor faça contato conosco por outro meio!';
		$chamado = $s->get($id_chamado);
		$conversas = $s->getConversas($id_chamado);

		include "view/frontend/suporte/chamado.php";	
	}

});

################### FIM SUPORTE #############################


?>
