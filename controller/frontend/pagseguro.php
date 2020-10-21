<?php 

use Questoes\DB\Sql;
use Questoes\Model\Questao;
use Questoes\Model\Clientes;
use Questoes\Model\Order;
use GuzzleHttp\Client;
use Questoes\PagSeguro\Config;
use Questoes\PagSeguro\Transporter;
use Questoes\PagSeguro\Document;
use Questoes\PagSeguro\Phone;
use Questoes\PagSeguro\Address;
use Questoes\PagSeguro\Sender;

###################### PAGSEGURO #############################

$app->post('/payment/credit', function() {

	$cliente = Clientes::verifyLogin();

	$order = new Order();

	$order->getFromSession();

	//buscar o endereço de fatura
	$endereco = [
		'logradouro'	=> 'rua blâ bla blá',
		'numero'		=> '440',
		'bairro'		=> 'Vila Capri Á é ço',
		'cep'			=> '21211123',
		'cidade'		=> 'Rio de Janeiro',
		'uf'			=> 'RJ',
		'pais'			=> 'Brasil',
		'complemento'	=> 'Bloco C Apto 203 lote XV',

	];

	//buscar o carrinho de compra
	$cart = '';

	//Classes de construção dos Nodes de XML

	//passa o tipo de documento e o numero do CPF
	$cpf = new Document(Document::CPF, $_POST['cpf']);
	//Passa o DDD e o numero do telefone
	$phone = new Phone($_POST['ddd'], $_POST['phone']);

	$address = new Address(
		$endereco['logradouro'],
		$endereco['numero'],
		$endereco['complemento'],
		$endereco['bairro'],
		$endereco['cep'],
		$endereco['cidade'],
		$endereco['uf'],
		$endereco['pais']
	);

	$birthDate = new DateTime($_POST['birth']);



	///////////////////    PAREI AQUI.. FALTA COMPLETAR O SENDER E TESTAR ESSE NÓ   //////////////
	$sender = new Sender(

	);

	//gera documento XML
	$dom = new DOMDocument();

	$test = $address->getDOMElement();

	$testNode = $dom->importNode($test, true);

	$dom->appendChild($testNode);

	echo $dom->saveXML();

});


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
		'urlJS' => Config::getUrlJS(),
		'id'	=> Transporter::createSession(),
		'maxInstallmentNoInterest'	=> Config::MAX_INSTALLMENT_NO_INTEREST,
		'maxInstallment'	=> Config::MAX_INSTALLMENT
	];


	
	/*
	echo '<pre>';
	var_dump($pedido['vlTotal']);
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
