<?php
require '../Autoloader.php';
Autoloader::register();

if (isset($_GET['mailPersonne'],$_GET['tokenToken'])) {

	$mailUrl = $_GET['mailPersonne'];
	$tokenUrl= $_GET['tokenToken'];

	$tokenPerson = new Token($mailUrl);
	$verifPerson = $tokenPerson->isExistsUser();
	$verifToken = $tokenPerson->isValidToken($tokenUrl);

	$htmlSelectListEvent = '' ;

	//Si la personne à un token val
	if ($verifPerson) {

		// si le token entré en url est le meme que celui en base pour cet personne
		if ($verifToken) {

			$tabEventsPerson = $tokenPerson->getEventsByUser();
			foreach ($tabEventsPerson as $anEvent ) {
				$htmlSelectListEvent .= '<option value='.$anEvent->idEvent.'>'.$anEvent->titreEvent.'</option>';
			}
		}else{
			header('location:DemandeModifEventClient.php');
		}
	}else{
			header('location:DemandeModifEventClient.php');
	}



}else{
	header('location:DemandeModifEventClient.php');
}

include '../Views/ListeModifEvenementClient.php';