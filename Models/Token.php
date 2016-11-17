<?php


class Token {
	private $cnx;
	private $mailPersonne;

	/**
     * Token constructor.
     */
    public function __construct($mailPersonne)
    {
        $db = BDD::getPDOInstance();
        $this->cnx = $db->getDbh();
        $this->mailPersonne = $mailPersonne;

    }

    public function getIdPersonne()
    {
        $mail = $this->mailPersonne;
        $s = "SELECT idPersonne FROM personne WHERE mailPersonne = :mail";
        $r = $this->cnx->prepare($s);
        $r->bindParam(':mail',$mail,PDO::PARAM_STR);
        $r->execute();
        while($rep = $r->fetch(PDO::FETCH_OBJ))
        {
            return $rep->idPersonne;
        }
    }

    public function getNbSeatsBookedByUser($idEvt){
       
        $idPersonne = $this->getIdPersonne();
        $idEvent    = $idEvt;

        $s = "SELECT COUNT(idPersonne) AS totalPlaces 
              FROM participer 
              WHERE idPersonne = :idPersonne 
              AND idEvent = :idEvent";

        $r = $this->cnx->prepare($s);
        $params = array(':idPersonne' => $idPersonne,
                        ':idEvent'    => $idEvent
                        );
        $r->execute($params);

        while ($rep = $r->fetchObject()) {
            $nbPlaces = $rep->totalPlaces;
        }
            return $nbPlaces;
    }

    public function getTokenAndDate()
    {
    	$mail = $this->mailPersonne;
        $idPersonne = $this->getIdPersonne();
    	$s = "SELECT tokenToken, dateToken FROM token WHERE idPersonne = :idPersonne";
    	$r = $this->cnx->prepare($s);
        $r->bindParam(':idPersonne', $idPersonne ,PDO::PARAM_INT);
        $r->execute();
        $tab = array();
        while ($rep = $r->fetchObject()) {
        	$tab[] = $rep;
        }
        return $tab;
    }
    
    public function getTokenDate()
    {
        $mail = $this->mailPersonne;
        $idPersonne = $this->getIdPersonne();
        $s = 'SELECT dateToken FROM token WHERE idPersonne = :idPersonne';
        $r = $this->cnx->prepare($s);
        $r->bindParam(':idPersonne',$idPersonne,PDO::PARAM_INT);
        $r->execute();
        while($rep = $r->fetch(PDO::FETCH_OBJ))
        {
            return $rep->dateToken;
        }
    }
    public function getDateInscription()
    {
        $mail = $this->mailPersonne;
        $s = 'SELECT dateInscriptionPersonne FROM personne WHERE mailPersonne = :mail';
        $r = $this->cnx->prepare($s);
        $r->bindParam(':mail',$mail,PDO::PARAM_STR);
        $r->execute();
        while ($rep = $r->fetch(PDO::FETCH_OBJ)) 
        {
            return $rep->dateInscriptionPersonne;
        }
    }

    public function isExistsUser(){
        $mail = $this->mailPersonne;

        $s = "SELECT idPersonne FROM personne WHERE mailPersonne = :mail";
        $r = $this->cnx->prepare($s);
        $r->bindParam(':mail',$mail,PDO::PARAM_STR);
        $r->execute();
        if($r->rowCount() > 0){
            return true;
        }else{
            return false;
        }
    }

    public function isValidToken($tokenToCheck){
        $mail = $this->mailPersonne;
        $idPersonne = $this->getIdPersonne();

        $s = "SELECT dateToken FROM token WHERE tokenToken = :tokenToCheck AND idPersonne = :idPersonne";
        $r = $this->cnx->prepare($s);
        $params = array(':tokenToCheck' => $tokenToCheck,
                        ':idPersonne'   => $idPersonne
                        );
        $r->execute($params);

        if($r->rowCount() > 0 ) {
            return true;
        }else{
            return false;
        }
    }

    public function verifPerson()
    {
    	$mail = $this->mailPersonne;
    	$s = "SELECT token.idPersonne,tokenToken FROM personne,token WHERE token.idPersonne = personne.idPersonne AND mailPersonne = :mail";
    	$r = $this->cnx->prepare($s);
        $r->bindParam(':mail',$mail,PDO::PARAM_STR);
        $r->execute();
        if($r->rowCount() > 0)
        {
        	return true;
        }
        else
        {
        	$s = "SELECT idPersonne FROM personne WHERE mailPersonne = :mail";
        	$r = $this->cnx->prepare($s);
        	$r->bindParam(':mail',$mail,PDO::PARAM_STR);
        	$r->execute();
        	if($r->rowCount() > 0)
        	{
        		while($rep = $r->fetch(PDO::FETCH_OBJ))
        		{
        			$idPersonne = $rep->idPersonne;
        			$newToken = md5(uniqid());
        			$currDate = date('Y-m-d H:i:s');
        			$ins = 'INSERT INTO token(idPersonne,tokenToken,dateToken) VALUES(:idPersonne, :token, :dateToken)';
        			$val = array(':idPersonne' => $idPersonne,
        						 ':token'      => $newToken ,
        						 ':dateToken'  => $currDate 
        						 );
        			$r = $this->cnx->prepare($ins);
        			$r->execute($val);
        			return true;
        		}
        	}
        	else
        	{
        		return false;
        	}
        }
    }

    public function generateUpdateToken()
    {
    	$mail = $this->mailPersonne;
        $idPersonne = $this->getIdPersonne();
        $token = md5(uniqid());
        $dateToken = date('Y-m-d H:m:s');
        $ups = 'UPDATE token SET tokenToken = :tokenToken , dateToken = :dateToken WHERE idPersonne = :idPersonne ';
        $val = array(':tokenToken' => $token ,
                     ':dateToken'  => $dateToken,
                     ':idPersonne' => $idPersonne 
                     );
        $r = $this->cnx->prepare($ups);
        $r->execute($val);
    }
 

    public function getEventsByUser(){
        $mail = $this->mailPersonne;
        $idPersonne = $this->getIdPersonne();
      
        $s = "SELECT DISTINCT event.idEvent,event.titreEvent,personne.idPersonne 
              FROM participer,event,personne 
              WHERE  participer.idEvent = event.idEvent
              AND participer.idPersonne   = personne.idPersonne
              AND mailPersonne = :mail";

        $r = $this->cnx->prepare($s);
        $r->bindParam(':mail',$mail,PDO::PARAM_STR);
        $r->execute();

        $tabResults = [];

        while($rep = $r->fetch()){
            $tabResults[] = $rep;

        }

        return $tabResults;
    }  

    public function setValidation(){
        $mail = $this->mailPersonne;

        $s = "UPDATE personne 
              SET validation = 1 
              WHERE mailPersonne = :mailPersonne";

        $r = $this->cnx->prepare($s);
        $r->bindParam(':mailPersonne',$mail,PDO::PARAM_STR);
        $r->execute();

        if($r->rowCount() > 0 ) {
            return true;
        }else{
            return false;
        }
    }

    public function getValidation(){
        $mail = $this->mailPersonne;

        $s = "SELECT validation 
              FROM personne 
              WHERE mailPersonne = :mailPersonne";

        $r = $this->cnx->prepare($s);
        $r->bindParam(':mailPersonne',$mail,PDO::PARAM_STR);
        $r->execute();

        if($res = $r->fetch()) {
            return $res->validation;
        }else{
            return false;
        }
    }
}
?>