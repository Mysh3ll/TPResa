<?php
//Démarre une nouvelle session ou reprend une session existante
session_start();

require '../Autoloader.php';
Autoloader::register();

//Exception dependencies autoload not ok
if (!file_exists(__DIR__ . '/../vendor/autoload.php')) {
	 throw new \Exception('please run "composer require google/apiclient:~2.0" in "' . __DIR__ .'"');
}
//Utilisation de l'autoloader composer 
require_once __DIR__ . '/../vendor/autoload.php';


//Si l'utilisateur a bien choisi un event dans la liste -listeEvent.php- et cliqué sur valider
 if (isset($_POST['ChoixEvent'], $_POST['ValiderChoixEvent'])) {
	
	$idEvent = $_POST['ChoixEvent'] ;
	$_SESSION['idEvent'] = $idEvent;

	$myEvent = new Event();

	//la methode getInfosEvent renvoie sous forme de tableau les informations de l'evenement $idEvent souhaité
	$tabInfosEvent = $myEvent->getInfosEvent($idEvent);

	//la methode getNbParticipants() renvoie le nb de participants à un evenement $idEvent
	$nbParticipants = $myEvent->getNbParticipants($idEvent);


	// On stocke dans des variables destinés à l'affichage dans la vue les infos de l'event contenues dans le tableau
	$idSalle = $tabInfosEvent['idSalle'];
	$titreEvent = $tabInfosEvent['titreEvent'];
	$dateEvent  = $tabInfosEvent['dateEvent'];
	$nbPlacesLeft = $tabInfosEvent['nbPlaceEventRestante'];
	$typeEvent  = $tabInfosEvent['typeEvent'];

}else{
	header('location:ListeEvent.php');
}

include '../Views/DetailEvenement.php';



