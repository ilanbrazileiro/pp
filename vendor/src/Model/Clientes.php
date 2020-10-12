<?php 

namespace Questoes\Model;

use \Questoes\DB\Sql;
use \Questoes\Model;
use \Questoes\Model\Usuario;
use \Questoes\Mailer;

class Clientes extends Model {

	const SESSION = "Cliente";

	/*
	Parametros: $id_cliente = ID do cliente desejado
	Retorna: Array do Cliente desejado
	*/
	public function get($id_cliente)
	{
		$sql = new Sql();
		$result = $sql->select("SELECT * FROM clientes WHERE id_cliente = '$id_cliente'");
		return $result[0];
	}
	/*
	Retorna todos os clientes cadastrados
	*/
	public function listarTodos(){
		$sql = new Sql();
		$result = $sql->select("SELECT * FROM clientes ORDER BY id_cliente DESC");
		return $result;
	}

	public function totalClientesAtivos(){
		$sql = new Sql();
		$result = $sql->select("SELECT COUNT(id_cliente) as total FROM clientes WHERE situacao = 'A'");
		return $result[0]['total'];
	}

	public function totalClientesInativos(){
		$sql = new Sql();
		$result = $sql->select("SELECT COUNT(id_cliente) as total FROM clientes WHERE situacao = 'I'");
		return $result[0]['total'];
	}

	public function totalClientes(){
		$sql = new Sql();
		$result = $sql->select("SELECT COUNT(id_cliente) as total FROM clientes");
		return $result[0]['total'];
	}

	/*
	Verificar se cliente já está logado, ou se ainda existe sessão do Cliente
	*/
	public static function verifyLogin(){

		if (!Clientes::checkLogin()) {
			header("Location: /");
			exit;
		} else {
			$clientes = new Clientes();
			return $clientes->getFromSession();
		}

	}

	/*
		Desloga um Cliente
	*/
	public static function logout()
	{
		$_SESSION[Clientes::SESSION] = NULL;
		$_SESSION['filtro'] = NULL;
	}

	/*
		Retorna true se existir sessão do Clientes e false caso não exista
	*/
	public static function checkLogin(){
		if (
			!isset($_SESSION[Clientes::SESSION])
			||
			!$_SESSION[Clientes::SESSION]
			||
			!(int)$_SESSION[Clientes::SESSION]["id_cliente"] > 0
		) {
			//Não está logado
			return false;
		} else {
			return true;
		} 
	}
	/*
		Primeiro cadastro do Cliente no site
	*/
	public function cadastrar($data){
		$sql = new Sql();

		//tratando os dados para inserir no banco
		$data['nome'] = addslashes($data['nome']);
		$data['senha'] = Usuario::getPasswordHash($data['senha']);
		$codigo = $this->getCodEmail($data['email']);

		$novo_usuario = $sql->select('CALL cadastrar_cliente(:NOME, :EMAIL, :SENHA, :CODIGO)', array(
			':NOME' => $data['nome'],
			':EMAIL' => $data['email'],
			':SENHA' => $data['senha'],
			':CODIGO' => $codigo
						
		));

		//return $novo_usuario;
		
		if (count($novo_usuario) >= 1){

			//Loga o Cliente na sessão		
			$clientes = new Clientes();
			$clientes->setData($novo_usuario[0]);
			$_SESSION[Clientes::SESSION] = $clientes->getValues();

			$resultado = $this->emailVerificacao($clientes->getid_cliente(), $clientes->getemail(), $codigo);
			
			return $resultado;
		
		} else {
			return $novo_usuario;
		}
		
		
	}// FIM CADASTRAR

	public function getCodEmail($email){
		 //Gera o codigo de verificação
		return $code = base64_encode(base64_encode($email.'-'.date('Y-m-d')));
	}

	/*
	* 	Gera e atualiza um codigo de verificação de E-mail,
	*	Envia o Email para verificação
	*/
	public function emailVerificacao($id_cliente, $email, $codigo){
		
		//busca o cliente pelo id
		$cliente = $this->get($id_cliente);
		//atualiza no banco o codigo gerado
		$sql = new Sql();
		
		//cria o link para ser enviado pelo email
		$link = 'http://www.papirar.com.br/ativa-email/'.$codigo;

		//Gera o email para ser enviado
		$mailer = new Mailer($email, $cliente["nome"], "Ative seu e-mail no PAPIRAR", "verificacao", array(
					"nome"=>$cliente["nome"],
					"link"=>$link
		));

		try{
			$mailer->send();
			return true;
		} catch (Exception $e){
			return $e->Message();
		}
	
	}

	public function getCodigoEmail($id_cliente, $code){

		$sql = new Sql();
		$result = $sql->select("SELECT codigo FROM subscribe WHERE id_cliente = :ID_CLIENTE", array(":ID_CLIENTE"=>$id_cliente));
		if ($result[0]['codigo'] === $code){
			$sql->query("UPDATE subscribe SET verificado = 1 , dt_verificacao = NOW() WHERE id_cliente = :ID_CLIENTE", array(":ID_CLIENTE"=>$id_cliente));
			Model::setSuccess('Obrigado.... e-mail verificado com sucesso!');
			return true;
		} else {
			return false;
		}
	}

	/*
		Loga o Cliente na Sessão
	*/
	public static function login($login, $password){

		$sql = new Sql();
		$results = $sql->select("SELECT * FROM clientes WHERE email = :EMAIL OR login = :LOGIN", array(":EMAIL"=>$login,":LOGIN"=>$login)); 

		if (count($results) === 0){
			throw new \Exception("Usuário não encontrado. Experimente fazer o cadastro!");
		}

		if (password_verify($password, $results[0]["senha"]) === true){

			$clientes = new Clientes();
			$clientes->setData($results[0]);
			$_SESSION[Clientes::SESSION] = $clientes->getValues();
			return $clientes;

		} else {
			throw new \Exception("Senha inválida. Tente novamente!");
		}
	}



	public function emailExistente($email){
		$sql = new Sql();
		$result = $sql->select("SELECT * FROM clientes WHERE email = '$email'");

		if (count($result) === 0){
			return false;
		} else {
			return true;
		}

	}

	/*
		Retorna o cliente pela sessão
	*/
	public static function getFromSession(){

		$clientes = new Clientes();

		if (isset($_SESSION[Clientes::SESSION]) && (int)$_SESSION[Clientes::SESSION]['id_cliente'] > 0) {

			$clientes->setData($_SESSION[Clientes::SESSION]);
		}
		return $clientes;
	}
	

	public function deletar($id_cliente){
		$sql = new Sql();
		$result = $sql->query("DELETE FROM clientes WHERE id_cliente = ".$id_cliente);
		if ($result === true){
			Model::setSuccess('Cliente deletado com sucesso!');	
		}
	}

	public function atualizaCadastro($dados){

		if (isset($dados['cpf'])){
			$query_cpf = "cpf = '".$dados['cpf']."' ";
		}

		$sql = new Sql();

		$result = $sql->query("UPDATE clientes SET telefone = '".$dados['telefone']."' ".$query_cpf." WHERE id_cliente = '".$dados['id_cliente']."'");

	}

	public static function verificaEmail($id_cliente){
		$sql = new Sql();
		$result = $sql->select("SELECT verificado FROM subscribe WHERE id_cliente = :ID_CLIENTE", array(":ID_CLIENTE"=>$id_cliente));

		if ($result[0]['verificado'] == 0 ){
			return "Por favor, verifique seu e-mail para continuar acessando nossas questões!";
		} else {
			return false;
		}
	}

}//FIM DA CLASSE
?>