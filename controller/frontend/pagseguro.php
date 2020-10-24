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
use Questoes\PagSeguro\Shipping;
use Questoes\PagSeguro\CreditCard;
use Questoes\PagSeguro\Item;
use Questoes\PagSeguro\Payment;
use Questoes\PagSeguro\CreditCard\Holder;
use Questoes\PagSeguro\CreditCard\Installment;

###################### PAGSEGURO #############################

$app->post('/payment/credit', function() {

	/*
	**	ROTA PARA O DESENVOLVIMENTO DO XML E ENVIO PARA O PAGSEGURO
	**	Todas as classes devem ser preenchidas conforme a ordem.
	**	Basicamente os dados encontrados aqui são:
	**	Do carrinho de compra, Identificação do cliente, Cartão de Crédito
	**	e produtos adicionados ao carrinho.
	**
	**	Atentar de passar todas essa informações para utilizar essa rota
	*/

	$cliente = Clientes::verifyLogin();

	$order = new Order();
	//Pegar o Pedido da Sessão
	$order->getFromSession();

	//Carregar o endereço do cliente e consequente endereço da fatura do cartão
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

	// buscar o carrinho de compra completo, mesmo se tiver mais de um item
	$cart = [
		0 => [
		'id_produto' 	=> 1,
		'descricao'		=> 'Mensalidades',
		'valor_produto'	=> 30.00,
		'qtd'			=> 1
	]];
	
	// Valor de envio do produto
	// preencher caso necessário
	$valor_envio = 0.0;

	
	###############################################################
	###			CLASSES PARA A CONTRUÇÃO DO ARQUIVO XML 		###

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
	

	############## ALTERAR ESSA LINHA QUANDO FOR PARA PRODUÇãAO
	$sender = new Sender($cliente->getnome(), $cpf, $birthDate, $phone, 'c09040931515743173567@sandbox.pagseguro.com.br', $_POST['hash']);
	//$sender = new Sender($cliente->getnome(), $cpf, $birthDate, $phone, $cliente->getemail(), $_POST['hash']);
	
	$holder = new Holder($cliente->getnome(), $cpf, $birthDate, $phone);
	//Endereço de entrega
	$shipping = new Shipping($address, (float)$valor_envio, Shipping::SEDEX);
	$installment = new Installment((int)$_POST['installments_qtd'], (float)$_POST['installments_value']);
	//Endereço da fatura
	$billingAddress = new Address(
		$endereco['logradouro'],
		$endereco['numero'],
		$endereco['complemento'],
		$endereco['bairro'],
		$endereco['cep'],
		$endereco['cidade'],
		$endereco['uf'],
		$endereco['pais']
	);
	//dados do cartao de crédito
	$creditCard = new CreditCard($_POST['token'], $installment, $holder, $billingAddress);

	$payment = new Payment((int)$order->getid_order(), $sender, $shipping);

	foreach ($cart as $produto) {
	
		$item = new Item((int)$produto['id_produto'], $produto['descricao'], (float)$produto['valor_produto'], (int) $produto['qtd']);

		$payment->addItem($item);

	}
	
	$payment->setCreditCard($creditCard);

	//Enviando o XML para o Pagseguro
	Transporter::sendTransaction($payment);


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
