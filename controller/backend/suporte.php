<?php 

use Questoes\DB\Sql;
use Questoes\Model\Questao;
use Questoes\Model\Clientes;
use Questoes\Model\Disciplinas;
use Questoes\Model\Cursos;
use Questoes\Model\Suporte;
use Questoes\Model\Usuario;

###################### SUPORTE #############################

$app->get('/admin/suporte/listar-abertos', function() {// Suporte

	Usuario::verifyLogin();

	$s = new Suporte();

	$chamados = $s->listarTodosPendentes();
	$pg = 'pendentes';
	
	include "view/backend/suporte/listarchamados.php";

});

$app->get('/admin/suporte/listar-fechados', function() {// Suporte

	Usuario::verifyLogin();

	$s = new Suporte();

	$chamados = $s->listarTodosFechados();
	$pg = 'fechados';
	
	include "view/backend/suporte/listarchamados.php";

});

$app->get('/admin/suporte/ver-chamado/:id_chamado', function($id_chamado) {// Suporte

	Usuario::verifyLogin();

	$s = new Suporte();
	$c = new Clientes();

	$chamado = $s->get($id_chamado);
	$cliente = $c->get($chamado['id_cliente']);
	$conversas = $s->getConversas($id_chamado);
		
	include "view/backend/suporte/verchamado.php";

});

$app->post('/admin/suporte/ver-chamado/:id_chamado', function($id_chamado) {// Suporte

	$usuario = Usuario::verifyLogin();

	$s = new Suporte();

	$_POST['id_usuario'] = $usuario->getid_usuario();

	$result = $s->novaMensagem($_POST, $id_chamado, 'SISTEMA');

	if ($result === true){
		header("Location: /admin/suporte/ver-chamado/$id_chamado");
		exit;
	} else {
		$c = new Clientes();
		//var_dump($result);
		$erro = 'Ocorreu um erro ao enviar a mensagem, por favor tente novamente. Se o erro persistir, por favor faça contato com seu superior!';
		$chamado = $s->get($id_chamado);
		$cliente = $c->get($chamado['id_cliente']);
		$conversas = $s->getConversas($id_chamado);
			
		include "view/backend/suporte/verchamado.php";	
	}

});



################### FIM SUPORTE #############################


?>
