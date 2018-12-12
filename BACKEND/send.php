<?php
include "phpmailer/src/PHPMailer.php";
include "phpmailer/src/SMTP.php";


/**
* 
*/
class EnviarMail
{
	
	function __construct()
	{
			
	}

	function mail($destino,$id_usuario)
	{
		$email_user = "operacionesboxtracker@gmail.com";
		$email_password = "myboxtracker15";
		$the_subject = "Activación de cuenta BoxTracker";
		$address_to = $destino;
		$from_name = "BoxTracker";
		$phpmailer = new PHPMailer \ PHPMailer \ PHPMailer ();
		// ---------- datos de la cuenta de Gmail -------------------------------
		$phpmailer->Username = $email_user;
		$phpmailer->Password = $email_password; 
		//-----------------------------------------------------------------------
		// $phpmailer->SMTPDebug = 1;
		$phpmailer->SMTPSecure = 'ssl';
		$phpmailer->Host = "smtp.gmail.com"; // GMail
		$phpmailer->Port = 465;
		$phpmailer->IsSMTP(); // use SMTP
		$phpmailer->SMTPAuth = true;
		$phpmailer->setFrom($phpmailer->Username,$from_name);
		$phpmailer->AddAddress($address_to); // recipients email
		$phpmailer->Subject = $the_subject;	
		$phpmailer->Body = "hola";
		$phpmailer->IsHTML(true);
		$phpmailer->Send();

		/*if(!$phpmailer->Send()) {
  		return "Error: " . $phpmailer->ErrorInfo;
		}else{
  						return "Enviado!";
					}*/
		}
		
}
?>