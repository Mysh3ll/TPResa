<?php
session_start();
require '../Autoloader.php';
Autoloader::register();
if(isset($_GET['dateChoisie']))
{
	$_SESSION['dateEvent'] = $_GET['dateChoisie'];
	$event = new Event();
	$tabPersonne = $event->affichePersonneEvent($_GET['dateChoisie']);
	$jsonPersonne = array();
	$tableauHTML = array();
	$titreEvent = $event->getTitreEventByDate($_GET['dateChoisie']);
	$i = 0;
	foreach ($tabPersonne as $personne) {
		$tableauHTML[] = "<tr id='tr$i'>
							  <td>$personne->nomPersonne</td>
							  <td>$personne->prenomPersonne</td>
							  <td>$personne->mailPersonne</td>
							  <td>$personne->nbPlaceAchete</td>
							  <td><button id='idPersonne$i' value='$personne->idPersonne' class='glyphicon glyphicon-trash'></button></td>
	   					  </tr>";
		$i ++;
	}
	$imax = $i;
	$jsonPersonne['imax'] = $imax;
	$jsonPersonne['personne'] = $tableauHTML;
	$jsonPersonne['titreEvent'] = $titreEvent;
	echo json_encode($jsonPersonne);
}
if(isset($_GET['idPersonne']))
{
	$event = new Event();
	$idPersonne = $_GET['idPersonne'];
	$event->supprimeParticipant($_SESSION['dateEvent'],$idPersonne);
}

?>