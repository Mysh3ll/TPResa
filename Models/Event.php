<?php

/**
 * Class Event
 */
class Event
{
    private $cnx;
    /**
     * Event constructor.
     */
    public function __construct()
    {
        $db = BDD::getPDOInstance();
        $this->cnx = $db->getDbh();
    }

    /**
     * Permet de récupérer la liste des events avec:
     * idEvent + titre + date + libelle
     * @return array Retourne un tableau contenant toutes les infos de l'event
     */
    public function getListeEvent($year)
    {
        $selectEvent = "SELECT idEvent,nbPlaceEvent,titreEvent,dateEvent,libelleType 
                        FROM event,typeevent 
                        WHERE event.idType = typeevent.idType 
                        AND dateEvent BETWEEN '$year-01-01' AND '$year-12-31' 
                        ORDER BY dateEvent,libelleType";

        $requestEvent = $this->cnx->query($selectEvent);

        $tabEvent = array();
        
        while ($repEvent = $requestEvent->fetchObject()) {
            $tabEvent[] = $repEvent;
        }

        return $tabEvent;
    }

    /**
     * Permet d'obtenir le nombre de places restantes selon un event
     * @param $idEvent Le numéro de l'id de l'event
     * @return mixed Retourne le nombre de place restantes
     */
    public function getNbPlaceRestante($idEvent)
    {
        
        $sqlNb = "SELECT nbPlaceEvent FROM event WHERE idEvent = :idEvent";
        $valNb = array("idEvent" => $idEvent);
        $reqNb = $this->cnx->prepare($sqlNb);
        $reqNb->execute($valNb);
        
        if ($repNb = $reqNb->fetch(PDO::FETCH_OBJ)) { //Si evenement
            
            $totalSeats = $repNb->nbPlaceEvent;
            $reservedSeats = $this->getNbParticipants($idEvent);
            $leftSeats = $totalSeats - $reservedSeats;
        }else{
            $leftSeats = 0;
        }
        
        return $leftSeats;
    }

    /**
     * Permet d'insérer dans la BDD la personne qui participe à l'event
     * ainsi que le numéro des places choisi
     * @param $idEvent Le numéro de l'id de l'event
     * @param $nbPlace Le nombre de place choisi
     * @param $idPersonne Le numéro de l'id de la personne
     * @param $numPlace Array des places selectionnees
     */
    public function insertParticipation($idEvent, $idPersonne, $numPlace)
    {
            
            $sqlParticipation = "INSERT INTO participer VALUES(:idEvent,:idPersonne,:numPlace)";
            $valueParticipation = array(":idEvent"    => $idEvent,
                                        ":idPersonne" => $idPersonne,
                                        ":numPlace"   => $numPlace
                                        );
            
            $reqParticipation = $this->cnx->prepare($sqlParticipation);
            $reqParticipation->execute($valueParticipation); 
            

    }

    /**
     * Permet de mettre à jour le nombre de place disponibles après une réservation
     * @param $nbPlace Le nombre de place choisi
     * @param $idEvent Le numéro de l'id de l'event
     * @param $nbPlaceRestanteAvant Le nombre de place disponible avant réservation
     */
    public function updateNbPlaceEvent($nbPlace, $idEvent, $nbPlaceRestanteAvant)
    {

        $nbPlaceRestanteApres = $nbPlaceRestanteAvant - $nbPlace;
        $sqlUpdate = "UPDATE event SET nbPlaceEventRestante = :nbPlace WHERE idEvent = :idEvent";
        $valUpdate = array(":nbPlace" => $nbPlaceRestanteApres,
                           ":idEvent" => $idEvent
        );
        $reqUpdate = $this->cnx->prepare($sqlUpdate);
        $reqUpdate->execute($valUpdate);
    }

    /**
     * Permet d'obtenir la liste des events de la BDD en format JSON
     * pour les requêtes AJAX
     */
    public function getListeEventJson()
    {
        $selectEvent = "SELECT dateEvent,titreEvent,libelleType,idEvent FROM event,typeevent WHERE event.idType = typeevent.idType ORDER BY dateEvent,libelleType";
        $requestEvent = $this->cnx->query($selectEvent);
        $tabEvent = array();
        while ($repEvent = $requestEvent->fetchObject()) {
            $tabEvent[] = $repEvent;
        }

        echo json_encode($tabEvent, JSON_UNESCAPED_UNICODE);
    }

    /**
     * Permet d'obtenir le nombre de places restantes d'un event en format JSON
     * pour les requêtes AJAX
     * @param $idEvent Le numéro de l'id de l'event
     */
    public function getNbPlaceRestanteJson($idEvent)
    {
        $sqlNb = "SELECT nbPlaceEvent FROM event WHERE idEvent = :idEvent";
        $valNb = array("idEvent" => $idEvent);
        $reqNb = $this->cnx->prepare($sqlNb);
        $reqNb->execute($valNb);
        while ($repNb = $reqNb->fetch(PDO::FETCH_OBJ)) {
            $nbrePlace['placeEvent'] = $repNb->nbPlaceEvent;
        }

        echo json_encode($nbrePlace, JSON_UNESCAPED_UNICODE);
    }

    /**
     * Permet d'obtenir le nombre de places réservées d'un event en format JSON
     * pour les requêtes AJAX
     * @param $idEvent Le numéro de l'id de l'event
     */
    public function getNbPlaceReserveJson($idEvent)
    {
        $sqlNb = "SELECT numPlaceAchete FROM participer WHERE idEvent = :idEvent";
        $valNb = array("idEvent" => $idEvent);
        $reqNb = $this->cnx->prepare($sqlNb);
        $reqNb->execute($valNb);
        $i = 0;
        while ($repNb = $reqNb->fetch(PDO::FETCH_OBJ)) {
            $nbrePlaceReserve['placeReserveEvent'][$i] = $repNb->numPlaceAchete;
            $i++;
        }

        echo json_encode($nbrePlaceReserve, JSON_NUMERIC_CHECK);
    }

    public function insertNewEvent($titre, $date, $type, $nbPlaces)
    {

        $returnMessage = '';
        
        // On verifie qu'un evenemenet n'existe pas a la date rentrée par l'user
        $requestDateFree = "SELECT titreEvent FROM event WHERE dateEvent = :dateEventUser";
        
        $ret = $this->cnx->prepare($requestDateFree);
        $ret->bindParam(':dateEventUser', $date);
        $ret->execute();
                
        if ($ret->rowCount() > 0 ){
           $returnMessage = 'Evènement déjà existant';
           
        }else{
        //Si la date entrée par l'utilisateur comme jour d'event n'est pas dans la base on insert l'event
      
            $paramsEvent = array(':titre'    => $titre,
                                 ':dateE'    => $date,
                                 ':nbPlaces' => $nbPlaces,
                                 ':type'     => $type
            );

            $r = 'INSERT INTO event( titreEvent, dateEvent, nbPlaceEvent, idType)
                  VALUES (:titre,:dateE,:nbPlaces,:type)';

            $ret = $this->cnx->prepare($r);
            $ret->execute($paramsEvent);

            if($ret->rowCount() > 0 ){
                $returnMessage = "L'évènement a été ajouté avec succès";
            }else{
                $returnMessage ="Echec requête";
            }
        }
        return $returnMessage;

    }

    public function getInfosEvent($idEvent)
    {
    	$r = "SELECT titreEvent,nbPlaceEvent,dateEvent,libelleType
    		  FROM event,typeevent
    		  WHERE idEvent = :idEvent
    		  AND event.idType = typeevent.idType";

        $ret = $this->cnx->prepare($r);
        $ret->bindParam(':idEvent', $idEvent, PDO::PARAM_INT);
        $ret->execute();
        $tab = [];

        if ($o = $ret->fetch()){
            
            $nbParticipants = $this->getNbParticipants($idEvent);
            
            $tab['titreEvent']    = $o->titreEvent;
            $tab['dateEvent']     = $o->dateEvent;
            $tab['typeEvent']     = $o->libelleType;
            $tab['nbPlaceEventRestante']  = $o->nbPlaceEvent - $nbParticipants;
        }

        return $tab;
    }


    public function getNbParticipants($idEvent){
    	$nbParticipants = 0;

        $sqlNbParticipants = "SELECT COUNT(numPlaceAchete) AS nbParticipants
              FROM participer
              WHERE idEvent = :idEvent";

        $ret = $this->cnx->prepare($sqlNbParticipants);
        $ret->bindParam(':idEvent', $idEvent, PDO::PARAM_INT);
        $ret->execute();

        if ($o = $ret->fetch()){
            $nbParticipants = $o->nbParticipants;
        }
        return $nbParticipants;
    }
     public function getIdEvent($dateEvent)
    {
        $s = "SELECT idEvent FROM event WHERE dateEvent = :dateEvent";
        $val = array("dateEvent" => $dateEvent);
        $r = $this->cnx->prepare($s);
        $r->execute($val);
        while($rep = $r->fetch(PDO::FETCH_OBJ))
        {
            return $rep->idEvent;
        }
    }
    public function getTitreEvent($idEvent)
    {
        $s = "SELECT titreEvent FROM event WHERE idEvent = :idEvent";
        $val = array("idEvent" => $idEvent);
        $r = $this->cnx->prepare($s);
        $r->execute($val);
        while($rep = $r->fetch(PDO::FETCH_OBJ))
        {
            return $rep->titreEvent;
        }
    }
    // public function getPlacesReservees($idEvent){

    //     $tabPlacesReservees = [];

    //     $r = "SELECT numPlace
    //           FROM participer
    //           WHERE idEvent = :idEvent
    //           ";

    //     $ret = $this->cnx->prepare($r);
    //     $ret->bindParam(':idEvent', $idEvent, PDO::PARAM_INT);
    //     $ret->execute();

    //     while ($o = $ret->fetch()){
    //         $tabPlacesReservees[] = $o->numPlace;
    //     }
    //     return  $tabPlacesReservees;

    // }

    public function getTypesEvent(){

    	$selectTypes = "SELECT idType, libelleType
    					FROM typeevent
    					";

    	$request = $this->cnx->query($selectTypes);

        $tabTypeEvent = array();

        while ($repEvent = $request->fetchObject())
        {
            $tabTypeEvent[] = $repEvent;
        }
        return $tabTypeEvent;
    }

    /**
     * Permet d'obtenir le nombre de places restantes d'un event en format JSON
     * pour les requêtes AJAX
     * @param $idEvent Le numéro de l'id de l'event
     */
    public function getNbPlaceJson($idEvent)
    {
        $sqlNb = "SELECT nbPlaceEvent FROM event WHERE idEvent = :idEvent";
        $valNb = array("idEvent" => $idEvent);
        $reqNb = $this->cnx->prepare($sqlNb);
        $reqNb->execute($valNb);
        while ($repNb = $reqNb->fetch(PDO::FETCH_OBJ)) {
            $nbrePlace['placeEvent'] = $repNb->nbPlaceEvent;
        }

        echo json_encode($nbrePlace, JSON_UNESCAPED_UNICODE);
    }
    


}