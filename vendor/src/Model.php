<?php 

namespace Questoes;

use \Questoes\DB\Sql;

class Model {

	private $values = [];

	public function __call($name, $args)//Diferencia o Metodo chamado entre o GET e o POST
	{

		$method = substr($name, 0, 3);
		$fieldName = substr($name, 3,strlen($name));

		switch ($method)
		{
			case 'get':
				return $this->values[$fieldName];
				break;

			default:
				$this->values[$fieldName] = $args[0];
				break;
		}
	}

	public function setData($data = array())//Seta os valores com as chaves correspondentes
	{
		foreach ($data as $key => $value) {
			$this->{"set".$key}($value);
		}
	}

	public function getValues()
	{
		return $this->values;
	}

	###### ATUALIZAÇÃO DAS FUNÇÕES DE MENSAGEM
	public static function setError($msg)
	{
			$_SESSION['msgError'] = $msg;
	}

	public static function getError()
	{
		$msg = (isset($_SESSION['msgError']) && $_SESSION['msgError']) ? $_SESSION['msgError'] : '';
		Model::clearError();
		return $msg;
	}

	public static function clearError()
	{
		$_SESSION['msgError'] = NULL;
	}

	public static function setSuccess($msg)
	{
		$_SESSION['msgSuccess'] = $msg;
	}

	public static function getSuccess()
	{
		$msg = (isset($_SESSION['msgSuccess']) && $_SESSION['msgSuccess']) ? $_SESSION['msgSuccess'] : '';
		Model::clearSuccess();
		return $msg;
	}

	public static function clearSuccess()
	{
		$_SESSION['msgSuccess'] = NULL;
	}

	/*
	Retorna todos os clientes cadastrados
	*/
	public static function listAll($tabela, $col, $order = 'DESC'){
		$sql = new Sql();
		$result = $sql->select("SELECT * FROM $tabela ORDER BY $col $order");
		return $result[0];
	}

	public static function getForCol($tabela, $col, $id)
	{
		$sql = new Sql();
		$result = $sql->select("SELECT * FROM $tabela WHERE $col = '$id'");
		return $result[0];
	}

}//FIM DA CLASSE


?>