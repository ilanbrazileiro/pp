<?php 

require '../../vendor/autoload.php';
include 'funcoes.php';

use \Questoes\DB\Sql;
use \Questoes\Model\Questao;
use \Questoes\Model\Disciplinas;

if (isset($_POST['verifica_resposta']) && $_POST['verifica_resposta'] == 'ok'){

	$q = new Questao();
	$result = $q->getResposta($_POST['id_resposta']);

	if ($result['certa'] == 'C'){
		echo 'certa';
	} else {
		echo 'errada';
	}
	
} else if (isset($_POST['id_disciplina'])) {
	$d = new Disciplinas();
	$cursos = $d->getCursos($_POST['id_disciplina']);
	foreach ($cursos as $value) {
    	echo "<input type='checkbox' value='".$value['id_curso']."' name='cursos[]'> ".$value['titulo']."&nbsp;&nbsp;|&nbsp;&nbsp;";
    }

} else if (isset($_POST['s_instituicao'])){

	$search = $_POST['s_instituicao'];
	
	$sql = new Sql();
	$instituicao = $sql->select("SELECT DISTINCT orgao FROM questoes 
			WHERE orgao like '%$search%'");

	$data = array();
	foreach ($instituicao as $key => $value) {
		$id = $value['orgao'];
        $text = $value['orgao'];
        $data[] = array('id'=>$id, 'text'=>$text);
	}
	echo json_encode($data);

} else if (isset($_POST['estatistica']) && $_POST['estatistica'] === 'ok'){

	$id_cliente = $_POST['cliente'];
	$id_questao = $_POST['questao'];
	if ($_POST['msg'] == 'certa'){
		$resposta = 'CERTA';
	} else {
		$resposta = 'ERRADA';
	}

	$sql = new Sql();
	$result = $sql->query("INSERT INTO respondidas (id_cliente, id_questao, resposta, dt_respondida) VALUES(
		'$id_cliente',
		'$id_questao',
		'$resposta',
		NOW()
	);");


}


 ?>