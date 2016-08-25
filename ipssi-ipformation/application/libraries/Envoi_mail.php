<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Envoi_mail
{
	public function envoyer_email($mailEnvoi, $sujet, $body)
	{
		require($_SERVER['DOCUMENT_ROOT'].'/PHPMailer/PHPMailerAutoload.php');
		
		$mail = new PHPMailer();
		$mail->CharSet = 'UTF-8';
		$mail->IsSMTP();
		$mail->SMTPDebug = 0;
		$mail->Host = 'smtp.julienalexandre.fr';
		$mail->SMTPAuth = true;  
		$mail->Port = 587;
		$mail->SetFrom('ipssi@julienalexandre.fr','IPSSI');
		$mail->Username = "ipssi@julienalexandre.fr";
		$mail->Password = "ipformation";
		$mail->AddAddress($mailEnvoi, $mailEnvoi);
		$mail->IsHTML(true);
		$mail->Subject = $sujet;
		$mail->Body = $body; 

		if(!$mail->Send())
			return 1;
		else
			return 0;
	}
}