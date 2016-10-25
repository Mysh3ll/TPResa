<?php
/**
 * Vue InscriptionEvenementClient.php
 * Permet à l'utilisateur de visualiser les places disponibles
 * et d'effectuer la réservation
 */
include '../Assets/includes/frontOffice/header-f.php';
?>
    <!-- Page Content -->
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <form id="inscriptionEvent" class="form-horizontal" method="post">
                    <fieldset>

                        <!-- Form Name -->
                        <legend><h1>Inscription à un événement</h1></legend>

                        <!-- Text input-->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="NomUser">Nom</label>
                            <div class="col-md-4">
                                <input id="NomUser" name="NomUser" placeholder="Votre nom" class="form-control input-md"
                                       required="" type="text" onblur="this.value=this.value.Majuscule()">
                            </div>
                        </div>

                        <!-- Text input-->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="PrenomUser">Prénom</label>
                            <div class="col-md-4">
                                <input id="PrenomUser" name="PrenomUser" placeholder="Votre prénom"
                                       class="form-control input-md"
                                       required="" type="text" onblur="this.value=this.value.Majuscule()">
                            </div>
                        </div>

                        <!-- Text input-->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="MailUser">E-mail</label>
                            <div class="col-md-4">
                                <input id="MailUser" name="MailUser" placeholder="Votre e-mail"
                                       class="form-control input-md"
                                       required="" type="email">
                            </div>
                        </div>



                        <div class="row">
                            <div class="form-group">
                                <h1> Choisir vos numéros de place dans le plan ci-dessous:</h1>
                                <hr>
                                <div id="holder">
                                    <ul  id="place">
                                    </ul>
                                </div>
                                <div style="float:left;">
                                    <ul id="seatDescription">
                                        <li id="seatAvailable" >Place disponible</li>
                                        <li id="seatBooked" >Place réservée</li>
                                        <li id="seatSelect" >Place sélectionnée</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- /.row -->
                        
                        
                        <!-- Message error -->
                        <div id='errorMessage' class='col-md-4 col-md-offset-4 alert alert-danger fade in'>
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        </div>
                        
                        
                        <!-- Message cnfirm-->
                        <div id='confirmReservation' class='col-md-4 col-md-offset-4 alert alert-success fade in'>
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        </div>
                    </fieldset>
                    
                                            <!-- Button (Double) -->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="ValiderEvent"></label>
                            <div class="col-md-8">
                                <input id="ValiderParticipation" name="ValiderParticipation" type="submit" class="btn btn-success" /
>                                
                                <a href="../Controllers/ListeEventClient.php" class="btn btn-danger" role="button">Retour</a>
                            </div>
                        </div>
                                            
 
                </form>
            </div>
        </div>
        <!-- /.row -->

<?php include '../Assets/includes/frontOffice/footer-f.php'; ?>