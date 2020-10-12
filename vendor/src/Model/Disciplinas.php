<?php 

namespace Questoes\Model;

use \Questoes\DB\Sql;
use \Questoes\Model;


class Disciplinas extends Model {

	/*
		Retorna todos os Disciplinas cadastrados
	*/
	public function listarTodos(){
		$sql = new Sql();
		$results = $sql->select("SELECT * FROM disciplina ORDER BY titulo ASC");
		return (array)$results;
	}

	public static function getDisciplinas(){
		$sql = new Sql();
		$results = $sql->select("SELECT id_disciplina, titulo FROM disciplina ORDER BY titulo ASC");
		$data = array();
		foreach ($results as $key => $value) {
			$id = $value['id_disciplina'];
	        $text = $value['titulo'];
	        $data[] = array('id'=>$id, 'text'=>$text);
		}
		return json_encode($data);
	}

	public function get($id_disciplina)
	{
		$sql = new Sql();
		$result = $sql->select("SELECT * FROM disciplina WHERE id_disciplina = '$id_disciplina'");
		return $result[0];
	}

	public function getCursos($id_disciplina)
	{
		$sql = new Sql();
		$result = $sql->select("SELECT b.id_curso, c.titulo FROM curso_disciplina as b INNER JOIN curso as c ON b.id_curso = c.id_curso WHERE b.id_disciplina = '$id_disciplina'");
		return (array)$result;

	}

	public function checkCurso($id_curso, $id_disciplina){
		$sql = new Sql();
		$result = $sql->select("SELECT * FROM curso_disciplina WHERE id_disciplina = '$id_disciplina' AND id_curso = '$id_curso'");
		if (count($result) > 0){
			return true;
		} else {
			return false;
		}
	}

	public function adicionar($data){
		
		$sql = new Sql();

		//tratando os dados para inserir no banco
		$data = $this->trataDados($data);

		//insere no banco
		$result = $sql->query("INSERT INTO disciplina (
							titulo,
							slug,
							descricao
					) VALUES (
							'".$data['titulo']."',
							'".$data['slug']."',
							'".$data['descricao']."'
						);");

		if ($result === true){
			$nova_disciplina = $sql->select("SELECT * FROM disciplina WHERE id_disciplina = LAST_INSERT_ID()");
			
			foreach ($data['cursos'] as $value) {
			$result = $sql->query("INSERT INTO curso_disciplina (id_curso, id_disciplina) VALUES (
							'".$value."',
							'".$nova_disciplina[0]['id_disciplina']."'
						);");
			}

			Model::setSuccess('Disciplina cadastrada com sucesso!');
			return true;
		} else {
			Model::setError('Ocorreu um erro ao cadastrar esta Disciplina, informe ao administrador do sistema o erro abaixo: <br>'.$result[2]);
			return false ;
		}		
	}// FIM CADASTRAR

	public function alterar($data){
		
		$sql = new Sql();

		//tratando os dados para inserir no banco
		$data = $this->trataDados($data);

		//insere no banco
		$result = $sql->query("UPDATE disciplina SET 
			titulo = '".$data['titulo']."',	
			slug = '".$data['slug']."', 
			descricao = '".$data['descricao']."'
						
			WHERE id_disciplina = ".$data['id_disciplina']);
		
			$result = $sql->query("DELETE FROM curso_disciplina WHERE id_disciplina = ".$data['id_disciplina']);
			foreach ($data['cursos'] as $value) {
				$result = $sql->select("INSERT INTO curso_disciplina (id_curso, id_disciplina) VALUES (
							'".$value."',
							'".$data['id_disciplina']."'
						);");
			}

			Model::setSuccess('Disciplina alterada com sucesso!');
			return true;		
	}// FIM ALTERAR

	public function trataDados($data){

		$data['titulo'] = addslashes($data['titulo']);
		$data['descricao'] = addslashes($data['descricao']);

		return $data;
	}

	public function getTitulo($id_disciplina){
		if ($id_disciplina == '0'){
			return 'Sem disciplina';
		} else {
			$sql = new Sql();
			$result = $sql->select("SELECT titulo FROM disciplina WHERE id_disciplina = '$id_disciplina'");
			return $result[0]['titulo'];
		}
	}

	public function deletar($id_disciplina){
		$sql = new Sql();
		$result = $sql->query("DELETE FROM curso_disciplina WHERE id_disciplina = ".$id_disciplina);
		$result = $sql->query("DELETE FROM disciplina WHERE id_disciplina = ".$id_disciplina);
		if ($result === true){
			Model::setSuccess('Curso deletado com sucesso!');	
		}
	}

	public function qtdQuestoes($id_disciplina){
		$sql = new Sql();
		$result = $sql->select("SELECT COUNT(*) as total FROM questoes WHERE id_disciplina = ".$id_disciplina);
		return $result[0]['total'];
	}

	public function searchDisciplinas($search){
		$sql = new Sql();
		$result = $sql->select("SELECT id_disciplina, titulo FROM disciplina WHERE titulo like '%$search%'");
		return $result[0];
	}
	


}

?>