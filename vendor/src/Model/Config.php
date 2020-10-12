<?php 

namespace Questoes\Model;

use \Questoes\DB\Sql;
use \Questoes\Model;

class Config extends Model {
	
	/*
		Lista todos os bancos cadastrados
	*/
	public function listarConfig(){
		$sql = new Sql();
		$config = $sql->select("SELECT * FROM config");
		return $config[0];
	}
	/*
		Executa a query passada e retorna o array
	*/
	public static function executaQuery($query){
		$sql = new Sql();
		$result = (array)$sql->select($query);
		return $result;
	}

		
	

}

?>