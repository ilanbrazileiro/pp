<?php 
namespace Questoes\Model;

use \Questoes\DB\Sql;
use \Questoes\Model;


class Questao extends Model {

	public function totalQuestoes(){
		$sql = new Sql();
		$result = $sql->select("SELECT COUNT(id_questao) as total FROM questoes");
		return $result[0]['total'];
	}

	/*
		retorna uma quantidade de questões
	*/
	public function getQuestoesPorQuantidade($qtd){

		$questao = [];
		
		$sql = new Sql();

		$results = (array)$sql->select("SELECT * FROM questoes ORDER BY RAND() LIMIT $qtd");
		
		foreach ($results as $key => $value) {

			$respostas = (array)$sql->select("SELECT * FROM respostas 
				WHERE id_questao = '".$value['id_questao']."' ORDER BY RAND()");

			$simulado[] = array(
				'id_questao' => $value['id_questao'],
				'pergunta' => $value['pergunta'],
				'id_resposta1' => $respostas[0]['id_resposta'],
				'id_resposta2' => $respostas[1]['id_resposta'],
				'id_resposta3' => $respostas[2]['id_resposta'],
				'id_resposta4' => $respostas[3]['id_resposta'],
				'id_resposta5' => $respostas[4]['id_resposta'],

				'resposta1' => $respostas[0]['resposta'],
				'resposta2' => $respostas[1]['resposta'],
				'resposta3' => $respostas[2]['resposta'],
				'resposta4' => $respostas[3]['resposta'],
				'resposta5' => $respostas[4]['resposta']
			);
			
		}

		return $simulado;

	}

	
	/*
		retorna todas as questões
	*/
	public function listarTodos(){

		$sql = new Sql();

		$results = $sql->select("SELECT codigo, pergunta, id_disciplina, id_questao FROM questoes ORDER BY id_questao DESC");

		return (array)$results;

	}

	public function getRespostaCerta($id_questao){

		$sql = new Sql();
		$results = $sql->select("SELECT resposta FROM respostas WHERE id_questao = $id_questao AND certa = 'C'");
		if (count($results) > 0){
			return $results[0]['resposta'];
		} else {
			return false;
		}
	}
	/*
		Retorna todas as resposta de determinada questão
	*/
	public function getTodasRespostas($id_questao){

		$sql = new Sql();
		$results = $sql->select("SELECT * FROM respostas WHERE id_questao = $id_questao");
		return (array)$results;
	}
	/*
		Retorna a resposta	
	*/
	public function getResposta($id_resposta){

		$sql = new Sql();
		$results = $sql->select("SELECT * FROM respostas WHERE id_resposta = $id_resposta");
		return (array)$results[0];

	}
	/*
		Adiciona uma questão
		$data = array com os dados da questão
	*/
	public function adicionar($data){
		
		// Tratando as variaveis e separando para inserir
		$data = $this->trataDados($data);

		$sql = new Sql();
		$result = $sql->query("INSERT INTO questoes (pergunta, id_disciplina, files, comentario, ano, banca, orgao, prova, nivel, escolaridade, descricao) VALUES (
								'".$data['pergunta']."',
								'".$data['disciplina']."',
								'".$data['files']."',
								'".$data['comentario']."',
								'".$data['ano']."',
								'".$data['banca']."',
								'".$data['orgao']."',
								'".$data['prova']."',
								'".$data['nivel']."',
								'".$data['escolaridade']."',
								'".$data['descricao']."'
							)");

		if ($result == true){
			//busca o ultimo adicionado
			$id_questao = $sql->select("SELECT id_questao FROM questoes WHERE id_questao = LAST_INSERT_ID()");
			$codigo_questao = 'Q'.rand(100,999).$id_questao[0]['id_questao'];
			$result = $sql->query("UPDATE questoes SET codigo = '".$codigo_questao."' WHERE id_questao = '".$id_questao[0]['id_questao']."'");
			//insere as respostas
			 $this->insereResposta($id_questao[0]['id_questao'], $data['certa'], 'C');//CERTA
			 $this->insereResposta($id_questao[0]['id_questao'], $data['errada1'], 'E');//ERRADA1
			 $this->insereResposta($id_questao[0]['id_questao'], $data['errada2'], 'E');//ERRADA2
			 $this->insereResposta($id_questao[0]['id_questao'], $data['errada3'], 'E');//ERRADA3
			 $this->insereResposta($id_questao[0]['id_questao'], $data['errada4'], 'E');//ERRADA4

			// Adicionando os Cursos
			foreach ($data['cursos'] as $value) {
			$result = $sql->query("INSERT INTO questao_curso (id_curso, id_questao) VALUES (
							'".$value."',
							'".$id_questao[0]['id_questao']."'
						);");
			}

			Model::setSuccess('Questão cadastrada com sucesso! '.$codigo_questao);
			return true;
		} else {
			Model::setError('Ocorreu um erro ao cadastrar esta Disciplina, informe ao administrador do sistema o erro abaixo: <br>'.$result[2]);
			return false ;
		}
		
	}//Fim do adicionar questão

	public function alterar($data){

		// Tratando as variaveis e separando para inserir
		$data = $this->trataDados($data);

		$sql = new Sql();
		$result = $sql->query("UPDATE questoes SET 
			pergunta = '".$data['pergunta']."',
			id_disciplina = '".$data['disciplina']."',
			files = '".$data['files']."',
			comentario = '".$data['comentario']."',
			ano = '".$data['ano']."',
			banca = '".$data['banca']."',
			orgao = '".$data['orgao']."',
			prova = '".$data['prova']."',
			nivel = '".$data['nivel']."',
			escolaridade = '".$data['escolaridade']."',
			descricao = '".$data['descricao']."'

			WHERE id_questao = ".$data['id_questao']);
		
		if ($result == true){
			$this->alteraResposta($data['certa_id'], $data['certa']);
			$this->alteraResposta($data['errada1_id'], $data['errada1']);
			$this->alteraResposta($data['errada2_id'], $data['errada2']);
			$this->alteraResposta($data['errada3_id'], $data['errada3']);
			$this->alteraResposta($data['errada4_id'], $data['errada4']);

			$result = $sql->query("DELETE FROM questao_curso WHERE id_questao = ".$data['id_questao']);
			// Adicionando os Cursos
			foreach ($data['cursos'] as $value) {
			$result = $sql->query("INSERT INTO questao_curso (id_curso, id_questao) VALUES (
							'".$value."',
							'".$data['id_questao']."'
						);");
			}

			Model::setSuccess('Questão alterada com sucesso!');
			return true;
		} else {
			Model::setError('Ocorreu um erro ao cadastrar esta Disciplina, informe ao administrador do sistema o erro abaixo: <br>'.$result[2]);
			return false ;
		}

	}

	public function alteraResposta($id_resposta, $resposta){

		$sql = new Sql();
		$result = $sql->query("UPDATE respostas SET resposta = '".$resposta."' WHERE id_resposta = ".$id_resposta);
	}

	public function trataDados($data){
		
		$data['pergunta'] 	= addslashes($data['pergunta']);
		$data['certa'] 		= addslashes($data['certa']);
		$data['errada1'] 	= addslashes($data['errada1']);
		$data['errada2'] 	= addslashes($data['errada2']);
		$data['errada3'] 	= addslashes($data['errada3']);
		$data['errada4'] 	= addslashes($data['errada4']);
		$data['banca'] 		= addslashes($data['banca']);
		$data['orgao'] 		= addslashes($data['orgao']);
		$data['prova'] 		= addslashes($data['prova']);
		$data['descricao']	= addslashes($data['descricao']);

		return $data;
	}

	private function insereResposta($id_questao, $resposta, $tipo){

		$sql = new Sql();
		$result = $sql->query("INSERT INTO `respostas`(`id_resposta`, `id_questao`, `resposta`, `certa`) VALUES ('',$id_questao,'$resposta','$tipo') ");
		return $result;

	}

	public function insereCursos($id_questao,$cursos){

	}

	/*
	Parametros: $id_cliente = ID do cliente desejado
	Retorna: Array do Cliente desejado
	*/
	public function get($id_questao)
	{
		$sql = new Sql();
		$result = $sql->select("SELECT * FROM questoes as q INNER JOIN respostas as r ON q.id_questao = r.id_questao WHERE q.id_questao = '$id_questao'");
		return (array)$result[0];
	}

	public function getCursos($id_questao){
		$sql = new Sql();
		$result = $sql->select("SELECT id_curso FROM questao_curso WHERE id_questao = '$id_questao'");
		return (array)$result[0];
	}

	public function deletar($id_questao){
		$sql = new Sql();

		$result = $sql->query("DELETE FROM questao_curso WHERE id_questao = ".$id_questao);
		$result = $sql->query("DELETE FROM respostas WHERE id_questao = ".$id_questao);
		$result = $sql->query("DELETE FROM questoes WHERE id_questao = ".$id_questao);
		if ($result === true){
			Model::setSuccess('Questão deletada com sucesso!');	
		}
	}

	public function checkCurso($id_curso, $id_questao){
		$sql = new Sql();
		$result = $sql->select("SELECT * FROM questao_curso WHERE id_questao = '$id_questao' AND id_curso = '$id_curso'");
		if (count($result) > 0){
			return true;
		} else {
			return false;
		}
	}

	public function qtdEncontradas($filtro, $qtd = 0){

		$condicao = '';
		
		if (isset($filtro['id_disciplina'])){
			foreach ($filtro['id_disciplina'] as $value) {
				$condicao .= " q.id_disciplina = '$value' OR";
			}
			$condicao = substr($condicao, 0, -3);
			$condicao .= ' AND';
			
		}

		if (isset($filtro['instituicao'])){

			foreach ($filtro['instituicao'] as $value) {
				$condicao .= " q.orgao = '$value' OR";
			}
			$condicao = substr($condicao, 0, -3);
			$condicao .= ' AND';
			
		}

		if (isset($filtro['id_curso'])){

			foreach ($filtro['id_curso'] as $value) {
				$condicao .= " c.id_curso = '$value' OR";
			}
			$condicao = substr($condicao, 0, -3);
			$condicao .= ' AND';
			
		}

		if ($condicao != ''){
			
			$condicao = substr($condicao, 0, -4);
						
			$sql = new Sql();

			if ($qtd == 1){
				$result = $sql->select("SELECT COUNT(q.id_questao) as total FROM questoes as q INNER JOIN questao_curso as c ON q.id_questao = c.id_questao
				WHERE ".$condicao." ORDER BY RAND()");
			
				return $result[0]['total'];
			
			} else {

				$questao = $this->getQuestaoUnica($condicao);

				return $questao;

			}
			
		
		} else {

			return false;
		}
		
		
	}//FIM DA FUNÇÂO

	/*
		retorna UMA Questão Randomica / Sem Filtro!
	*/
	public function getQuestaoUnica($condicao){

		$questao = [];
		
		$sql = new Sql();

		if ($condicao === 0){

			$results = (array)$sql->select("SELECT * FROM questoes ORDER BY RAND() limit 1");

		} else {

			$results = (array)$sql->select("SELECT q.* FROM questoes as q INNER JOIN questao_curso as c ON q.id_questao = c.id_questao
				WHERE ".$condicao." ORDER BY RAND() limit 1");
		}


			$respostas = (array)$sql->select("SELECT * FROM respostas 
				WHERE id_questao = '".$results[0]['id_questao']."' ORDER BY RAND()");
			$questao = $results[0];
			
			$questao['id_resposta1'] = $respostas[0]['id_resposta'];
			$questao['id_resposta2'] = $respostas[1]['id_resposta'];
			$questao['id_resposta3'] = $respostas[2]['id_resposta'];
			$questao['id_resposta4'] = $respostas[3]['id_resposta'];
			$questao['id_resposta5'] = $respostas[4]['id_resposta'];

			$questao['resposta1'] = $respostas[0]['resposta'];
			$questao['resposta2'] = $respostas[1]['resposta'];
			$questao['resposta3'] = $respostas[2]['resposta'];
			$questao['resposta4'] = $respostas[3]['resposta'];
			$questao['resposta5'] = $respostas[4]['resposta'];
			
		return $questao;

	}

	public function getFilter(){
		if (isset($_SESSION['filtro'])){
			return $_SESSION['filtro'];
		} else {
			return false;
		}
	}

	public function totalRespondida($id_cliente){
		$sql = new Sql();
		$result = $sql->select("SELECT COUNT(id_cliente) as total FROM respondidas WHERE id_cliente = '$id_cliente'");
		return $result[0]['total'];
	}

	public function totalRespondidaCertas($id_cliente){
		$sql = new Sql();
		$result = $sql->select("SELECT COUNT(id_cliente) as total FROM respondidas WHERE id_cliente = '$id_cliente' AND resposta = 'CERTA'");
		return $result[0]['total'];
	}

	public function getEstatistica($id_cliente){

		$qtd_respondidas = $this->totalRespondida($id_cliente);
		$qtd_certas = $this->totalRespondidaCertas($id_cliente);
		$qtd_erradas = $qtd_respondidas - $qtd_certas;

		//convertendo em Porcentagem (%)
		if ($qtd_respondidas != 0){
			$qtd_certas = round(($qtd_certas * 100) / $qtd_respondidas);
			$qtd_erradas = round(($qtd_erradas * 100) / $qtd_respondidas);
		}

		$estatistica = array(
			'respondidas' 	=> $qtd_respondidas,
			'certas' 		=> $qtd_certas,
			'erradas'		=> $qtd_erradas
		);

		return $estatistica;

	}

	public function zerar($id_cliente){
		$sql = new Sql();
		$result = $sql->query("DELETE FROM respondidas WHERE id_cliente = '$id_cliente'");
	}


}
 ?>