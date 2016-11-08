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

	//PARTIE API YT PHP 

	if (isset($titreEvent)){

	  /*
	   * Set $DEVELOPER_KEY to the "API key" value from the "Access" tab of the
	   * Google API Console <https://console.developers.google.com/>
	   * Please ensure that you have enabled the YouTube Data API for your project.
	   */
	  $DEVELOPER_KEY = 'AIzaSyBQ0jcFXIsUYswGavQ46ur6zrP6TQLAmeg';


	  //Creation d'un objet client google utilisant une clé API
	  $client = new Google_Client();
	  $client->setDeveloperKey($DEVELOPER_KEY);

	  // Define an object that will be used to make all API requests.
	  $youtube = new Google_Service_YouTube($client);


	  // DISABLE SSL CERTIFICATE VERIFYING  - DEV MODE
	  $guzzleClient = new \GuzzleHttp\Client(array( 'curl' => array( CURLOPT_SSL_VERIFYPEER => false, ), ));
	  $client->setHttpClient($guzzleClient);

	  try {

	    // Call the search.list method to retrieve results matching the specified
	    // query term.
	    $searchResponse = $youtube->search->listSearch('id,snippet', array(
	      'q' => $titreEvent,
	      'maxResults' => 1,
	      'relevanceLanguage' => 'fr',
	      'order' => 'relevance',
	      'type'  => 'video'
	    ));

	    $videos = '';
	    $channels = '';
	    $playlists = '';

	    //on verifie que le tab $searchResponse['items'] contient un item au moins ($searchResponse['items'][0])
	    if(!empty($searchResponse['items'][0])){
	    	//On stocke dans une variable l'id de la video pour l'afficher dans une iframe dans la vue
	    	// like <iframe src="https://youtube.com/embed/$videoId"
	    	$searchFirstResult = $searchResponse['items'][0];
	    	$videoId = $searchFirstResult['id']['videoId'];

	    }else{

	    	$videoId = null;
	    }

	   
	  } catch (Google_Service_Exception $e) {
	    $message = sprintf('<p>A service error occurred: <code>%s</code></p>',
	      htmlspecialchars($e->getMessage()));
	  } catch (Google_Exception $e) {
	    $message = sprintf('<p>An client error occurred: <code>%s</code></p>',
	      htmlspecialchars($e->getMessage()));
	  }
	}

	
}else{
	header('location:ListeEvent.php');
}

include '../Views/DetailEvenement.php';



