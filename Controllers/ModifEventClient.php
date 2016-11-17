<?php
require '../Autoloader.php';
Autoloader::register();


if (isset($_POST['ListeModifEvent'],$_POST['mail'])) {

	$idEvent = $_POST['ListeModifEvent'];
	$mailPersonne = $_POST['mail'];

	$tokenPerson = new Token($mailPersonne);
	$nbPlaces = $tokenPerson->getNbSeatsBookedByUser($idEvent);

	$idPersonne = $tokenPerson->getIdPersonne();

	$event = new Event();
	$idSalle = $event->getSalleEvent($idEvent);



}else{
	header('location:DemandeModifEventClient.php');
}

include '../Views/ModificationEvenementClient.php';