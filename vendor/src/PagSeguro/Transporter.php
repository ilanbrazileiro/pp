<?php

namespace Questoes\PagSeguro;

use \GuzzleHttp\Client;
use \Questoes\Model\Order;
use Exception;

/*
*	Classe para transportar as informações para o PagSeguro
*/
class Transporter {

	public static function createSession()
	{

		$client = new Client();

		$res = $client->request('POST', Config::getUrlSessions() . "?" . http_build_query(Config::getAuthentication()), [
			"verify"=>false
		]);
		
		$xml = simplexml_load_string($res->getBody()->getContents());

		return ((string)$xml->id);

	}

	public static function sendTransaction(Payment $payment)
	{

		$client = new Client();
		
		$res = $client->request('POST', Config::getUrlTransaction() . "?" . http_build_query
		(Config::getAuthentication()), [
			"verify"=>false,
			"headers"=>[
				"Content-Type"=>"application/xml"
			],
			"body"=>$payment->getDOMDocument()->saveXml()
		]);
		
		$xml = simplexml_load_string($res->getBody()->getContents());

		
		$order = new Order();

		$order->get((int)$xml->reference);

		$test = $order->setPagSeguroTransactionResponse(
			(string)$xml->code,
			(float)$xml->grossAmount,
			(float)$xml->discountAmount,
			(float)$xml->feeAmount,
			(float)$xml->netAmount,
			(float)$xml->extraAmount,
			(string)$xml->paymentLink
		);

		return $xml;

	}

	public static function getNotification(string $code, string $type)
	{

		switch ($type)
		{
			case "transaction":
			$url = Config::getNotificationTransactionURL();
			break;
	
			default:
			throw new Exception("Notificação inválida");
			break;
		}

		$client = new Client();
		
		$res = $client->request('GET', $url . $code . "?" . http_build_query(Config::getAuthentication()), [
			"verify"=>false
		]);
		
		$xml = simplexml_load_string($res->getBody()->getContents());

		//Carrega o Pedido Pela referencia do PagSeguro 
		$order = new Order();
		$order->get((int)$xml->reference);
		
		### Verifica se o Status do pedido é o mesmo que já está no banco de dados. Se for diferente, muda o Status
		### Adaptar para a realidade de cada sistema!
		if ($order->getid_situacao() !== (int)$xml->status){
			$pedido = $order->updateSituacao((int)$xml->reference, (int)$xml->status);

			var_dump($pedido);
		}

		$filename = $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . "res" . DIRECTORY_SEPARATOR . "logs" . DIRECTORY_SEPARATOR . date("YmdHis") . ".json";

		$file = fopen($filename, "a+");
		fwrite($file, json_encode(array(
			"post"=>$_POST,
			"xml"=>$xml
		)));
		fclose($file);

		return $xml;

	}

}