<?php
/**
 * Model EventSelectedSeatPicker.php
 * Permet d'insérer chaque place choisi par la personne dans le BDD
 * selon l'event sélectionné
 */
//Démarre une nouvelle session ou reprend une session existante
session_start();
//Autoloader permettant de charger les classes automatiquement
require '../Autoloader.php';
Autoloader::register();

/* Récupération des données POST envoyées par la requête AJAX */

//Récupération des numéros de places choisi
$selectedSeat = $_POST['selectedSeat'];
$tabSelectedSeat = explode(",", $selectedSeat);
//Récupération de l'id de l'event
$idEvent = $_SESSION['idEvent'];
//Récupération du nom de la personne
$nomPersonne = $_POST['nomPersonne'];
//Récupération du prénom de la personne
$prenomPersonne = $_POST['prenomPersonne'];
//Récupération du mail de la personne
$mailPersonne = $_POST['mailPersonne'];


//Instanciation de l'objet Personne
$Personne = new Personne($mailPersonne, $nomPersonne, $prenomPersonne);
//On utilise la methode isMailAvailable sur l'objet Personne pour vérifier la disponibilité du mail
$isMailAvailable = $Personne->isMailAvailable();


if ($isMailAvailable) {
    //Méthode qui permet d'insérer une nouvelle personne en BDD
    $Personne->setNewPersonne();
    //Récuparation de l'id de la personne
    $idPersonne = $Personne->getIdPersonne();
}


//VERIFICATION DE LA VALIDITE DES INFOS ENVOYEES
//On cree un nouvel objet regular expression
$verifM = new Regexp($mailPersonne);
$verifM->regexpMail(); //methode qui verifie la conformité de l'expression 
$isValidMail = $verifM->getIsValid(); // retourne un boolean True si expression ok False sinon

$verifNom = new Regexp($nomPersonne);
$verifNom->regexpNames();
$isValidNom = $verifNom->getIsValid();

$verifPrenom = new Regexp($prenomPersonne);
$verifPrenom->regexpNames();
$isValidPrenom = $verifPrenom->getIsValid();




//On verifie la validité de l'email, nom ,prenom ainsi que la disponibilité de ce mail
if($isValidPrenom && $isValidNom && $isValidMail && $isMailAvailable ){
    
    $event = new Event(); 
  
    /* Boucle qui insert pour chaque place choisi:
    - l'id de l'event
    - l'id de la personne
    - le numéro de la place
    */
    foreach ($tabSelectedSeat as $numPlace) {
      $event->insertParticipation($idEvent, $idPersonne, $numPlace);
    }
    
}



