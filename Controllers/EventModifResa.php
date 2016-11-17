<?php
session_start();
require '../Autoloader.php';
Autoloader::register();

if (isset( $_GET['idPersonne'],$_GET['idEvent'],$_GET['mailPersonne'])) {

	$idPersonne   = $_GET['idPersonne'];
	$idEvent 	  = $_GET['idEvent'];
	$mailPersonne = $_GET['mailPersonne'];

	$event = new Event();
	$event->deleteReservation($idEvent,$mailPersonne);

	//returns a boolean
	$resultDelete = $event->getStatusLastQuery();


	$placesAchetees = $_GET['placesAchetees'];
	$tabPlacesAchetees = explode(",", $placesAchetees);


	/* Boucle qui insert pour chaque place choisi:
	- l'id de l'event
	- l'id de la personne
	- le numéro de la place
    */
    foreach ($tabPlacesAchetees as $numPlace) {
      	$event->insertParticipation($idEvent, $idPersonne, $numPlace);
    }

    $returnMessage = 'La modification a été prise en compte';
    $statut = true;
}

    header('Content-type: application/json');
	echo json_encode(array('message'       => $returnMessage ,
                           'statusRequest' => $statut,
                           'statusDelete'  => $resultDelete
                           )
					 ) ;
