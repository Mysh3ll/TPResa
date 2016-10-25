<?php
//Démarre une nouvelle session ou reprend une session existante
session_start();

require '../Autoloader.php';
Autoloader::register();

 if (isset($_POST['ChoixEvent'], $_POST['ValiderChoixEvent'])) {
	
	$idEvent = $_POST['ChoixEvent'] ;
	$_SESSION['idEvent'] = $idEvent;

	$myEvent = new Event();

	//la methode getInfosEvent renvoie sous forme de tableau les informations de l'evenement $idEvent souhaité
	$tabInfosEvent = $myEvent->getInfosEvent($idEvent);

	//la methode getNbParticipants() renvoie le nb de participants à un evenement $idEvent
	$nbParticipants = $myEvent->getNbParticipants($idEvent);

	// On stocke dans des variables destinés à l'affichage dans la vue les infos de l'event contenues dans le tableau
	$titreEvent = $tabInfosEvent['titreEvent'];
	$dateEvent  = $tabInfosEvent['dateEvent'];
	$nbPlacesLeft = $tabInfosEvent['nbPlaceEventRestante'];
	$typeEvent  = $tabInfosEvent['typeEvent'];
	
}else{
	header('location:ListeEvent.php');
}

include '../Views/DetailEvenement.php';



