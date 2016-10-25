<?php
session_start();
require '../Autoloader.php';
Autoloader::register();

        if(isset($_POST['ValiderEvent'], $_POST['datePicked'])){

            //On recupere l'id de l'event grace à la date envoyée.
            //Il servira a la requete d'insert ajax effectuée sur EventSelectedSeatPicker-Front.php
            
           $event = new Event();
           $idEvent = $event->getIdEvent($_POST['datePicked']);
           $_SESSION['idEvent'] = $idEvent;
                 
           include "../Views/InscriptionEvenementClient.php";

        }else{
            header( "Location:ListeEventClient.php" ); 
        }
 ?>