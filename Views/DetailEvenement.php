<?php
/**
 * Created by PhpStorm.
 * User: Michel
 * Date: 06/10/2016
 * Time: 09:12
 */
include '../Assets/includes/backOffice/header-b.php';
?>
<!-- Page Content -->
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <form class="form-horizontal">
                <fieldset>

                    <!-- Form Name -->
                    <legend><h1>Détail de l'événement</h1></legend>

                    <!-- Text input-->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="TitreEvent">Nom de l'événement</label>
                        <div class="col-md-4">
                            <input disabled id="TitreEvent" name="TitreEvent" placeholder="" class="form-control input-md"
                                   type="text" value=" <?php echo $titreEvent ?> ">

                        </div>
                    </div>

                    <!-- Text input-->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="TypeEvent">Type de l'événement</label>
                        <div class="col-md-4">
                            <input disabled id="TypeEvent" name="TypeEvent" placeholder="" class="form-control input-md"
                                   type="text" value= "<?php echo $typeEvent ?>">

                        </div>
                    </div>

                    <!-- Text input-->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="DateEvent">Date de l'événement</label>
                        <div class="col-md-4">
                            <input disabled id="DateEvent" name="DateEvent" placeholder="" class="form-control input-md"
                                   type="text" value= "<?php echo $dateEvent ?>">

                        </div>
                    </div>

                    <!-- Text input-->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="NbrePlacesRestantes">Nombre de places
                            restantes</label>
                        <div class="col-md-4">
                            <input disabled id="NbrePlacesRestantes" id="NbrePlacesRestantes" name="NbrePlacesRestantes" placeholder=""
                                   class="form-control input-md"
                                   type="text" value= "<?php echo $nbPlacesLeft ?>">

                        </div>
                    </div>

                    <!-- Text input-->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="NbreParticipants">Nombre de participants</label>
                        <div class="col-md-4">
                            <input disabled id="NbreParticipants" name="NbreParticipants" placeholder=""
                                   class="form-control input-md"
                                   type="text" value="<?php echo $nbParticipants ?>">

                        </div>
                    </div>
                    
                            <div class="form-group">
                                <h1> Places réservées et disponibles sur l'évènement</h1>
                                <hr>
                                <div id="holder">
                                    <ul id="place">
                                    </ul>
                                </div>
                                <div style="float:left;">
                                    <ul id="seatDescription">
                                        <li id="seatAvailable" >Place disponible</li>
                                        <li id="seatBooked" >Place réservée</li>
                                    </ul>
                                </div>
                            </div>
                  

                    <!-- Button -->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="Retour"></label>
                        <div class="col-md-4">
                            <a href="../Controllers/ListeEvent.php" class="btn btn-info" role="button">Retour</a>
                        </div>
                    </div>

                </fieldset>
            </form>
        </div>
    </div>

    <!-- /.row -->

<?php include '../Assets/includes/backOffice/footer-b.php'; ?>