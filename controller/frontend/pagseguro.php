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
use Questoes\PagSeguro\Bank;
use Questoes\PagSeguro\CreditCard\Holder;
use Questoes\PagSeguro\CreditCard\Installment;

###################### PAGSEGURO #############################

$app->post('/payment/notification', function(){

	Transporter::getNotification($_POST['notificationCode'], $_POST['notificationType']);

});

##################### PAGAR POR CARTÃO DE CRÉDITO ######################
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

	$order->get((int)$order->getid_pedido());

	// buscar o carrinho de compra completo, mesmo se tiver mais de um item
	$cart = [
		0 => [
		'id_produto' 	=> 1,
		'descricao'		=> 'Assinatura Premium',
		'valor_produto'	=> (float)$order->getvalor(),
		'qtd'			=> 1
	]];
	
	// Valor de envio do produto
	// preencher caso necessário
	$valor_envio = 0.0;


	
	###############################################################
	###			CLASSES PARA A CONTRUÇÃO DO ARQUIVO XML 		###

	//passa o tipo de documento e o numero do CPF
	$cpf = new Document(Document::CPF, $_POST['cpf']);

	$_POST['phone'] = str_replace('-', '', $_POST['phone']);
	//Passa o DDD e o numero do telefone
	$phone = new Phone((int)$_POST['ddd'], (int)$_POST['phone']);
	$address = new Address($order->getlogradouro(),
		$order->getnumero(),
		$order->getcomplemento(),
		$order->getbairro(),
		$order->getcep(),
		$order->getcidade(),
		$order->getuf(),
		$order->getpais()
	);

	$birthDate = new DateTime($_POST['birth']);
	

	############## ALTERAR ESSA LINHA QUANDO FOR PARA PRODUÇãAO
	if (Config::SANDBOX === true){
	$sender = new Sender($cliente->getnome(), $cpf, $birthDate, $phone, 'c09040931515743173567@sandbox.pagseguro.com.br', $_POST['hash']);
	} else {
	$sender = new Sender($cliente->getnome(), $cpf, $birthDate, $phone, $cliente->getemail(), $_POST['hash']);
	}
	
	$holder = new Holder($cliente->getnome(), $cpf, $birthDate, $phone);
	//Endereço de entrega
	$shipping = new Shipping($address, (float)$valor_envio, Shipping::SEDEX);
	$installment = new Installment((int)$_POST['installments_qtd'], (float)$_POST['installments_value']);
	//Endereço da fatura
	$billingAddress = new Address(
		$order->getlogradouro(),
		$order->getnumero(),
		$order->getcomplemento(),
		$order->getbairro(),
		$order->getcep(),
		$order->getcidade(),
		$order->getuf(),
		$order->getpais()
	);
	//dados do cartao de crédito
	$creditCard = new CreditCard($_POST['token'], $installment, $holder, $billingAddress);

	$payment = new Payment((int)$order->getid_pedido(), $sender, $shipping);

	foreach ($cart as $produto) {
	
		$item = new Item((int)$produto['id_produto'], $produto['descricao'], (float)$produto['valor_produto'], (int) $produto['qtd']);

		$payment->addItem($item);

	}
	
	$payment->setCreditCard($creditCard);

	//Enviando o XML para o Pagseguro
	Transporter::sendTransaction($payment);

	echo json_encode([
        'success'=>true
    ]);

});

##################### PAGAR POR BOLETO ######################
$app->post('/payment/boleto', function() {

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

	$order->get((int)$order->getid_pedido());

	// buscar o carrinho de compra completo, mesmo se tiver mais de um item
	$cart = [
		0 => [
		'id_produto' 	=> 1,
		'descricao'		=> 'Assinatura Premium',
		'valor_produto'	=> (float)$order->getvalor(),
		'qtd'			=> 1
	]];
	
	// Valor de envio do produto
	// preencher caso necessário
	$valor_envio = 0.0;

	
	###############################################################
	###			CLASSES PARA A CONTRUÇÃO DO ARQUIVO XML 		###

	//passa o tipo de documento e o numero do CPF
	$cpf = new Document(Document::CPF, $_POST['cpf']);

	$_POST['phone'] = str_replace('-', '', $_POST['phone']);
	//Passa o DDD e o numero do telefone
	$phone = new Phone((int)$_POST['ddd'], (int)$_POST['phone']);
	$address = new Address(
		$order->getlogradouro(),
		$order->getnumero(),
		$order->getcomplemento(),
		$order->getbairro(),
		$order->getcep(),
		$order->getcidade(),
		$order->getuf(),
		$order->getpais()
	);
	$birthDate = new DateTime($_POST['birth']);
	
	if (Config::SANDBOX === true){
	$sender = new Sender($cliente->getnome(), $cpf, $birthDate, $phone, 'c09040931515743173567@sandbox.pagseguro.com.br', $_POST['hash']);
	} else {
	$sender = new Sender($cliente->getnome(), $cpf, $birthDate, $phone, $cliente->getemail(), $_POST['hash']);
	}
	
	//Endereço de entrega
	$shipping = new Shipping($address, (float)$valor_envio, Shipping::SEDEX);
	
	$payment = new Payment((int)$order->getid_pedido(), $sender, $shipping);

	foreach ($cart as $produto) {
	
		$item = new Item((int)$produto['id_produto'], $produto['descricao'], (float)$produto['valor_produto'], (int) $produto['qtd']);

		$payment->addItem($item);

	}
	
	$payment->setBoleto();

	//Enviando o XML para o Pagseguro
	Transporter::sendTransaction($payment);

	echo json_encode([
        'success'=>true
    ]);

});

##################### PAGAR POR DEBITO ######################
$app->post('/payment/debito', function() {

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

	$order->get((int)$order->getid_pedido());

	// buscar o carrinho de compra completo, mesmo se tiver mais de um item
	$cart = [
		0 => [
		'id_produto' 	=> 1,
		'descricao'		=> 'Assinatura Premium',
		'valor_produto'	=> (float)$order->getvalor(),
		'qtd'			=> 1
	]];
	
	// Valor de envio do produto
	// preencher caso necessário
	$valor_envio = 0.0;

	
	###############################################################
	###			CLASSES PARA A CONTRUÇÃO DO ARQUIVO XML 		###

	//passa o tipo de documento e o numero do CPF
	$cpf = new Document(Document::CPF, $_POST['cpf']);
	$_POST['phone'] = str_replace('-', '', $_POST['phone']);
	//Passa o DDD e o numero do telefone
	$phone = new Phone((int)$_POST['ddd'], (int)$_POST['phone']);
	$address = new Address(
		$order->getlogradouro(),
		$order->getnumero(),
		$order->getcomplemento(),
		$order->getbairro(),
		$order->getcep(),
		$order->getcidade(),
		$order->getuf(),
		$order->getpais()
	);
	$birthDate = new DateTime($_POST['birth']);
	
	if (Config::SANDBOX === true){
	$sender = new Sender($cliente->getnome(), $cpf, $birthDate, $phone, 'c09040931515743173567@sandbox.pagseguro.com.br', $_POST['hash']);
	} else {
	$sender = new Sender($cliente->getnome(), $cpf, $birthDate, $phone, $cliente->getemail(), $_POST['hash']);
	}

	//Endereço de entrega
	$shipping = new Shipping($address, (float)$valor_envio, Shipping::SEDEX);
	
	$payment = new Payment((int)$order->getid_pedido(), $sender, $shipping);

	foreach ($cart as $produto) {
	
		$item = new Item((int)$produto['id_produto'], $produto['descricao'], (float)$produto['valor_produto'], (int) $produto['qtd']);

		$payment->addItem($item);

	}
	
	$bank = new Bank($_POST['bank']);

	$payment->setBank($bank);

	//Enviando o XML para o Pagseguro
	Transporter::sendTransaction($payment);

	echo json_encode([
        'success'=>true
    ]);

});


######### SUCESSO CARTÃO DE CRÉDITO
$app->get('/payment/success', function(){

    $cliente = Clientes::verifyLogin();

    $order = new Order();

    $order->getFromSession();

    $pedido = $order->getValues();
    
  	include "view/frontend/pagseguro/payment-success.php";

});

######### SUCESSO BOLETO 
$app->get('/payment/success/boleto', function(){

    $cliente = Clientes::verifyLogin();

    $order = new Order();

    $order->getFromSession();

    $order->get((int)$order->getid_pedido());

    $pedido = $order->getValues();
    
  	include "view/frontend/pagseguro/payment-success-boleto.php";

});

######### SUCESSO Debito 
$app->get('/payment/success/debit', function(){

    $cliente = Clientes::verifyLogin();

    $order = new Order();

    $order->getFromSession();

    $order->get((int)$order->getid_pedido());

    $pedido = $order->getValues();
    
  	include "view/frontend/pagseguro/payment-success-debito.php";

});

$app->get('/payment/pagseguro', function() {

	$cliente = Clientes::verifyLogin();
	$clientes = $cliente->getCompleto($cliente->getid_cliente());

	$order = new Order();

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

	include "view/frontend/pagseguro/payment.php";

});

################### FIM PAGSEGURO #############################


?>
