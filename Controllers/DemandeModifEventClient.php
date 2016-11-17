<?php 
require '../Autoloader.php';
Autoloader::register();
require '../PHPMailer/PHPMailerAutoload.php';

if (isset($_POST['mailPersonne']))
{

	$mailPersonne = $_POST['mailPersonne'];
	$tokenToken = new Token($mailPersonne);
	$verifPerson = $tokenToken->verifPerson();
	
	if(!$verifPerson)
	{
		$message = 'ACCESS DENIED !';
	}
	else
	{
		$tabToken = $tokenToken->getTokenAndDate();
		foreach ($tabToken as $infoToken) {
			$token = $infoToken->tokenToken;
			$dateToken = $infoToken->dateToken;
		}
		$currDate = date('Y-m-d H:i:s'); 
		$currDate = strtotime($currDate);
		$dateToken = strtotime($dateToken);	
		echo $token;
		$validation = $tokenToken->getValidation();

		if($currDate - $dateToken > 86400 )
		{
			$newToken = $tokenToken->generateUpdateToken();
			$mail = new PHPmailer();
			$mail->isSMTP();                                      // Set mailer to use SMTP
			$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
			$mail->SMTPAuth = true;                   					// Enable SMTP authentication
			$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
			$mail->Username = 'PUT YOUR MAIL HERE';                 // SMTP username
			$mail->Password = 'PASSWORD HERE';                           // SMTP password
			$mail->Port = 587;                                    // TCP port to connect to

			$mail->setFrom('resaEvent@webmaster.com', 'Resa Event');
			$mail->addAddress($mailPersonne);     // Add a recipient
			// $mail->addReplyTo('info@example.com', 'Information');
			// $mail->addCC('cc@example.com');
			// $mail->addBCC('bcc@example.com');

			$mail->Subject = "Changement de vos emplacements pour vos spectacles";
			$mail->Body    = "Veuillez cliquer sur le lien ci-dessous pour accéder à la page de changement de vos emplacements: <br />
							  <a href='localhost/test/TPResa/Controllers/ListeModifEventClient.php?mailPersonne=$mailPersonne&tokenToken=$newToken'>CLIQUEZ ICI NYARK NYARK NYARK</a>"; //A MODIFIER
			// $mail->AltBody = "<a href='localhost:8080/TPResa-master/Controllers/changementPlaces.php?mailPersonne=$mailPersonne&tokenToken=$newToken'>CLIQUEZ ICI NYARK NYARK NYARK</a>";

			$mail->isHTML(true);                                  // Set email format to HTML

			if(!$mail->send()) 
			{
			    $message  = 'Message could not be sent.';
			    $message .= 'Mailer Error: ' . $mail->ErrorInfo;
			} 
			else
			{
			    $message  = 'Message has been sent';
			}
		}
		else if(strtotime($tokenToken->getTokenDate()) - strtotime($tokenToken->getDateInscription()) < 60 && !$validation )
		{
			echo $token;


			$mail = new PHPmailer();
			$mail->isSMTP();                                      // Set mailer to use SMTP
			$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
			$mail->SMTPAuth = true;                               // Enable SMTP authentication
			$mail->Username = 'PUT YOUR MAIL HERE';                 // SMTP username
			$mail->Password = 'PASSWORD HERE';                           // SMTP password
			$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
			$mail->Port = 587;                                  // TCP port to connect to

			$mail->setFrom('resaEvent@webmaster.com', 'Resa Event');
			$mail->addAddress($mailPersonne);     // Add a recipient
			// $mail->addReplyTo('info@example.com', 'Information');
			// $mail->addCC('cc@example.com');
			// $mail->addBCC('bcc@example.com');
			$mail->isHTML(true);                                  // Set email format to HTML

			$mail->Subject = "Changement de vos emplacements pour vos spectacles";
			$mail->Body    = "Veuillez cliquer sur le lien ci-dessous pour accéder à la page de changement de vos emplacements: <br />
							  <a href='localhost/test/TPResa/Controllers/ListeModifEventClient.php?mailPersonne=$mailPersonne&tokenToken=$token'>CLIQUEZ ICI NYARK NYARK NYARK</a>
							  <br />";
			// $mail->AltBody = "<a href='localhost:8080/TPResa-master/Controllers/changementPlaces.php?mailPersonne=$mailPersonne&tokenToken=$token'>CLIQUEZ ICI NYARK NYARK NYARK</a>";
            
            if(!$mail->send()) 
			{
			    $message   = 'Message could not be sent.';
			    $message  .= 'Mailer Error: ' . $mail->ErrorInfo;
			} 
			else
			{
				$tokenToken->setValidation();
			    $message  = 'Message has been sent';
			}
		}
		else
		{
			$message  = 'Vous avez déja effectué une demande de modification dans les dernieres 24h. <br/>';
			$message .=  'Veuillez utiliser le lien qui vous a été envoyé dans le dernier mail.';
		}
	}
	
}	
include '../Views/DemandeModifEvenementClient.php';
