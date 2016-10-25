<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

session_start();
require '../Autoloader.php';
Autoloader::register();
$currYear = date('Y');

$Events = new Event();
$tabEvent = $Events->getListeEvent($currYear);


$jsonDate = array();
foreach ($tabEvent as $event) {
    $jsonDate[] = array("dateEvent" => $event->dateEvent , 'titreEvent' => $event->titreEvent , 'nbPlaceEvent' => $event->nbPlaceEvent , 'libelleType' => $event->libelleType);
}
echo json_encode($jsonDate);