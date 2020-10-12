<?php 

namespace Questoes\Model;

use \Questoes\DB\Sql;
use \Questoes\Model;
use \Questoes\Model\Usuario;
use \Questoes\Mailer;

class Suporte extends Model {

	
	/*
	Parametros: $id_chamado = ID do chamado desejado
	Retorna: Array do chamado desejado
	*/
	public function get($id_chamado)
	{
		$sql = new Sql();
		$result = $sql->select("SELECT * FROM chamados WHERE id_chamado = '$id_chamado'");
		return $result[0];
	}
	public function getConversas($id_chamado)
	{
		$sql = new Sql();
		$result = $sql->select("SELECT * FROM conversas_chamado WHERE id_chamado = '$id_chamado'");
		return $result;
	}
	/*
	Retorna todos os chamados cadastrados
	*/
	public function listarTodosPendentes($id_cliente = 0){
		$sql = new Sql();
		if ($id_cliente == 0){
			$result = $sql->select("SELECT * FROM chamados WHERE situacao != 'FECHADO' ORDER BY id_chamado DESC");
			return $result;
		} else {
			$result = $sql->select("SELECT * FROM chamados WHERE id_cliente = $id_cliente AND situacao != 'FECHADO' ORDER BY id_chamado DESC");
			return $result;
		}
	}

	/*
	Retorna todos os chamados cadastrados
	*/
	public function novaMensagem($dados, $id_chamado, $quem){
		$sql = new Sql();

		if ($quem == 'CLIENTE'){
			$result = $sql->query("INSERT INTO conversas_chamado (id_chamado, conversa, dt_conversa, hr_conversa, quem, id_quem, visto)
								VALUES
							(:ID_CHAMADO, :CONVERSA, NOW(), NOW(), :QUEM, :ID_QUEM, 'NAO')", array (
								':ID_CHAMADO' => $id_chamado,
								':CONVERSA' => $dados['conversa'],
								':QUEM' => $quem,
								':ID_QUEM' => $dados['id_cliente']
								));
			$sql->query("UPDATE chamados SET situacao = 'SISTEMA' WHERE id_chamado = '$id_chamado'");
		} else {
			$result = $sql->query("INSERT INTO conversas_chamado (id_chamado, conversa, dt_conversa, hr_conversa, quem, id_quem, visto, dt_visto, hr_visto, id_quemviu)
								VALUES
							(:ID_CHAMADO, :CONVERSA, NOW(), NOW(), :QUEM, :ID_QUEM, 'SIM', NOW(), NOW(), :ID_QUEMVIU)", array (
								':ID_CHAMADO' => $id_chamado,
								':CONVERSA' => $dados['conversa'],
								':QUEM' => $quem,
								':ID_QUEM' => $dados['id_usuario'],
								':ID_QUEMVIU' => $dados['id_usuario']
								));
			$sql->query("UPDATE chamados SET situacao = 'CLIENTE' WHERE id_chamado = '$id_chamado'");
		}
		return $result;


	}
	/*
	Retorna todos os chamados cadastrados
	*/
	public function listarTodosFechados($id_cliente = 0){
		$sql = new Sql();

		$result = $sql->select("SELECT * FROM chamados WHERE id_cliente = $id_cliente AND situacao = 'FECHADO' ORDER BY id_chamado DESC");
		return $result;
	}

	public function fecharChamado($id_chamado){
		$sql = new Sql();
		$result = $sql->query("UPDATE chamados SET situacao = 'FECHADO' WHERE id_chamado = $id_chamado");

	}
	
	/*
		Primeiro cadastro do chamado no site
	*/
	public function cadastrar($data){
		$sql = new Sql();

		$result = $sql->select('CALL cadastrar_chamado(:ID_CLIENTE, :MOTIVO, :COD_QUESTAO, :CONVERSA)', array(
			':ID_CLIENTE' => $data['id_cliente'],
			':MOTIVO' => $data['tipo'],
			':COD_QUESTAO' => $data['cod_questao'],
			':CONVERSA' => $data['conversa']
			
		));

		if (count($result) >= 1){
			return $result[2];
		} else {
			return true;
		}


	}// FIM CADASTRAR

	
	

	public function deletar($id_chamado){
		$sql = new Sql();
		$result = $sql->query("DELETE FROM chamados WHERE id_chamado = ".$id_chamado);
		if ($result === true){
			Model::setSuccess('chamado deletado com sucesso!');	
		}
	}

}//FIM DA CLASSE
?>