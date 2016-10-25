<?php
require '../Autoloader.php';
Autoloader::register();

$myEvent = new Event();

$tabEvent = $myEvent->getTypesEvent();
$htmlSelectList = ' ' ;

foreach ($tabEvent as $event) {
	$htmlSelectList .= '<option value=' . $event->idType . '>'.$event->libelleType .'</option>';
}



//On verifie que tous les champs ont été remplis, et que l'utilisateur a cliqué sur 'Valider'
if (isset($_POST['TitreEvent'], $_POST['inputDate'] , $_POST['TypeEvent'] , $_POST['NbrePlace'], $_POST['ValiderCreationEvent']))  {

	// on stocke dans des variables les infos rentrés par l'utilisateur
	$titre    = $_POST['TitreEvent'];
	$date     = $_POST['inputDate'];
	$type     = $_POST['TypeEvent'];
	$nbPlaces = $_POST['NbrePlace'];
        
	$eventToCreate = new Event();
	$returnInsertion = $eventToCreate->insertNewEvent($titre, $date, $type, $nbPlaces);

	$message = $returnInsertion;
	
}

include '../Views/CreationEvenement.php';
