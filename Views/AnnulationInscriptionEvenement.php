<html>
<head>
	<meta charset='utf-8'>
	<title>Annulation d'un évènement</title>
	<link rel="stylesheet" type="text/css" href="../Assets/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../Assets/css/custom.css">
	<link rel="stylesheet" type="text/css" href="../Assets/js/jqueryUI/jquery-ui.min.css">
</head>
<body>
	<legend>Annulation d'un évenement</legend>
		<label for='datepicker'>Choissisez un évènement : </label>
		<div id='datepicker'></div>
	    <h1 id='titre'>Annulation de certains participants pour l'évènement:<span id='titreEvent'></span> </h1>
		<table class='table table-striped table-bordered' id='personne'>
			<thead class="thead-inverse">
				<td>Nom Participant</td>
				<td>Prénom Participant</td>
				<td>Mail Participant</td>
				<td>Nombre de places Achetées</td>
				<td>Supprimer</td>
			</thead>
			<tbody id='tbody'>
			</tbody>
		</table>

		<span id='eventVide'></span>
</body>
<script type="text/javascript" src="../Assets/js/jquery-1.12.3.js"></script>
<script type="text/javascript" src='../Assets/js/jqueryUI/jquery-ui.js'></script>
<script type="text/javascript" src="../Assets/js/dateAnnulation.js"></script>
<script type="text/javascript" src='../Assets/js/bootstrap.min.js'></script>
</html>