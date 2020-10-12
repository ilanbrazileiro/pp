<?php 

namespace Questoes\DB;

class Sql {

	##### CONFIGURAÇÕES DE ACESSO AO BANCO DE DADOS - LOCAL ####
	/*
	const HOSTNAME = "localhost";//Servidor do Banco
	const USERNAME = "root"; //Nome de Usuário
	const PASSWORD = ""; //Senha do Usuário
	const DBNAME = "uucab_boletos"; //nome do Banco de Dados
	*/
	##### CONFIGURAÇÕES DE ACESSO AO BANCO DE DADOS - WEB ####
	
	const HOSTNAME = "papirar.com.br:3306/";//Servidor do Banco
	const USERNAME = "papirarc_papiro"; //Nome de Usuário
	const PASSWORD = "P@pirar"; //Senha do Usuário
	const DBNAME = "papirarc_papirar"; //nome do Banco de Dados
	

	private $conn;

	public function __construct()
	{
		/*
		if ($metodo == 'mysqli'){
			$this->conn = mysqli_connect(Sql::HOSTNAME, Sql::USERNAME, Sql::PASSWORD, Sql::DBNAME) or die("Error " . mysqli_error($conn));;
		} else {
		*/
			$opcoes = array(
							    \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8'
							);

			$this->conn = new \PDO(
			"mysql:dbname=".Sql::DBNAME.";host=".Sql::HOSTNAME, 
			Sql::USERNAME,
			Sql::PASSWORD,
			$opcoes
			);
		//}
	}

	public function testaConexao()
	{
		return $this->conn;
	}

	public function selectMysqli($query)
	{
		$res = mysqli_query($this->conn, $query);

		$itens = mysqli_fetch_all($res, MYSQLI_ASSOC);
		return $itens;
	}
/*
public function __construct()
	{

		$this->conn = new \PDO(
			"mysql:dbname=".Sql::DBNAME.";host=".Sql::HOSTNAME.";charset=utf8", 
			Sql::USERNAME,
			Sql::PASSWORD, 
			array(\PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")
		);
	}

*/
	private function setParams($statement, $parameters = array())
	{
		foreach ($parameters as $key => $value) {
			$this->bindParam($statement, $key, $value);
		}
	}

	private function bindParam($statement, $key, $value)
	{

		$statement->bindParam($key, $value);

	}

	public function query($rawQuery, $params = array())
	{

		$stmt = $this->conn->prepare($rawQuery);

		$this->setParams($stmt, $params);

		$stmt->execute();

		if ($stmt->rowCount() > 0) {

			return true;

		} else {
			return $stmt->errorInfo();
		}
	}

	//public function select($rawQuery, $params = array()):array
	public function select($rawQuery, $params = array())
	{

		$stmt = $this->conn->prepare($rawQuery);

		$this->setParams($stmt, $params);

		if($stmt->execute()){

 		   	return (array)$stmt->fetchAll(\PDO::FETCH_ASSOC);
 		   	
		}else{

    		return $stmt->errorInfo();
		}
	}


	public function geraQueryInsert($tabela, $dados){

		// PEGAR CAMPOS DA ARRAY
		$arrCampo = array_keys($dados);

		//PEGAR VALORES DA ARRAY
		$arrValores = array_values($dados);

		// CONTAR CAMPOS DA ARRAY
		$numCampo = count($arrCampo);

		// CONTAR OS VALORES DA ARRAY
		$numValores = count($arrValores);

		// VALIDAÇÃO
		if($numCampo == $numValores){ // if insert
			$SQL = "INSERT INTO	".$tabela." (";
			foreach($arrCampo as $campo){
				$SQL .= "$campo, ";	
			}

			$SQL = substr_replace($SQL, ")", -2, 1);

			$SQL .="VALUES (";

				foreach($arrValores as $valores){

				$SQL .= "'".$valores."', ";	

				}

			$SQL = substr_replace($SQL, ")", -2, 1);

		}else{

			return 'Erro ao checar valores';

		}

		return $SQL;

	}//FIM DA FUCTION geraQueryInsert


}//FIM DA CLASSE



 ?>