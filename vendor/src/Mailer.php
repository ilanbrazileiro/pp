<?php 

namespace Questoes;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
/**
 * 
 */
class Mailer {

	const USERNAME = "papirar@papirar.com.br";
	const PASSWORD = "P@pirar";
	const NAME_FROM = "Papirar";
	const SMTP = "mail.papirar.com.br";
	const PORTA = "587";

	private $mail;
	
	public function __construct($toAddress, $toName, $subject, $tplName, $data = array()){
		
		$html = $this->getHtml($tplName, $data);

		$this->mail = new PHPMailer();

		//Tell PHPMailer to use SMTP
		$this->mail->isSMTP();

		//Enable SMTP debugging
		// 0 = off (for production use)
		// 1 = client messages
		// 2 = client and server messages
		$this->mail->SMTPDebug = 0;

		//Ask for HTML-friendly debug output
		$this->mail->Debugoutput = 'html';

		//Set the hostname of the mail server
		$this->mail->Host = Mailer::SMTP;

		//use
		//$this->mail->Host = gethostbyname('smtp.gmail.com');
		//if your network does not support SMTP over IPv6
		//Set the SMTP port number = 587 for authenticated TLS, a.k.a RFC4409 SMTP submission
		$this->mail->Port = Mailer::PORTA;
		//Set the encryption system to use - ssl (deprecated) or tls
		$this->mail->SMTPSecure = 'tls';
		//Whether to use SMTP authentication
		$this->mail->SMTPAuth = true;
		//Username to use for SMTP
		$this->mail->Username = Mailer::USERNAME;
		//Password to use for SMTP authentication
		$this->mail->Password = Mailer::PASSWORD;
		//Set who the message is to be sent from
		$this->mail->setFrom(Mailer::USERNAME, Mailer::NAME_FROM);
		$this->mail->addAddress($toAddress, $toName);

		//Assunto do email
		$this->mail->Subject = $subject;

		$this->mail->msgHTML($html);

		$this->mail->AltBody = 'This is a plain-text message body';

		//Attach an image file
		//$mail->addAttachment(images/phpmailer_mini.png);

	}

	public function send()
	{
		try {
    		return $this->mail->send();
		} catch (Exception $e) {
		    return $e->getMessage();
		}
		
	}

	public function getHtml($tplName, $data)
	{
		$html = file_get_contents($_SERVER['DOCUMENT_ROOT']."/view/template_email/".$tplName.".html"); //Caminho dos templates do sistema)

		foreach ($data as $key => $value) {
			$html = str_replace('{%'.$key.'%}', $value, $html);
		}

		return $html;

	}

}

?>