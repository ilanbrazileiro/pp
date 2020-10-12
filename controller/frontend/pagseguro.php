<?php 

use Questoes\DB\Sql;
use Questoes\Model\Questao;
use Questoes\Model\Clientes;
use GuzzleHttp\Client;
use Questoes\PagSeguro\Config;

###################### PAGSEGURO #############################

$app->get('/payment/pagseguro', function() {// Suporte

	$cliente = Clientes::verifyLogin();

	$client = new Client();

	$response = $client->request('POST', Config::getUrlSessions() . "?". http_build_query(Config::getAuthentication()), [
		"verify" => false
	]);

	echo $response->getBody()->getContents(); 

	



	//include "view/frontend/suporte/suporte.php";

});



################### FIM PAGSEGURO #############################


?>
