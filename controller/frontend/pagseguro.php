<?php 

use Questoes\DB\Sql;
use Questoes\Model\Questao;
use Questoes\Model\Clientes;
use Questoes\Model\Order;
use GuzzleHttp\Client;
use Questoes\PagSeguro\Config;

###################### PAGSEGURO #############################


$app->get('/payment/pagseguro', function() {// Suporte

	$cliente = Clientes::verifyLogin();

	$order = new Order();

	$order->toSession();//Esse comando deve estar na rota do carrinho ou do Checkout

	$order->getFromSession();

	//Variável com os dados do pedido
	$pedido = $order->getValues();

	//Variáveis utilizadas no Template
	$years = geraAnosCartao();
	$msgError = '';
	$pagseguro = [
		'urlJS' => Config::getUrlJS()
	];


	
	/*
	echo '<pre>';
	var_dump($_SESSION['OrderSession']);
	echo '</pre>';
	*/


	include "view/frontend/pagseguro/payment.php";

});


$app->get('/payment/pagseguro1', function() {// Suporte

	$cliente = Clientes::verifyLogin();

	$client = new Client();

	$response = $client->request('POST', Config::getUrlSessions() . "?". http_build_query(Config::getAuthentication()), [
		"verify" => false
	]);

	echo $response->getBody()->getContents(); 

	$order = new Order();

	$order->toSession();

	echo '<pre>';
	var_dump($_SESSION['OrderSession']);
	echo '</pre>';



	include "view/frontend/pagseguro/payment.php";

});



################### FIM PAGSEGURO #############################


?>
