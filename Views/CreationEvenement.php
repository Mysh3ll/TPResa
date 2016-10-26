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
            <form class="form-horizontal" action="CreationEvent.php" method="post" enctype="multipart/form-data">
                <fieldset>

                    <!-- Form Name -->
                    <legend><h1>Création d'événement</h1></legend>

                    <!-- Text input-->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="TitreEvent">Nom de l'événement</label>
                        <div class="col-md-4">
                            <input id="TitreEvent" name="TitreEvent" placeholder="Titre événement"
                                   class="form-control input-md" required="" type="text"
                                   onblur="this.value=this.value.Majuscule()">

                        </div>
                    </div>

                    <!-- DatePicker -->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="TitreEvent">Date de l'événement</label>

                        <div class="col-md-4" id="datepicker"><input type="text" hidden value="" id="inputDate"
                                                                     name="inputDate"/></div>

                    </div>

                    <!-- Select Basic -->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="TypeEvent">Type de l'événement</label>
                        <div class="col-md-4">
                            <select id="TypeEvent" name="TypeEvent" class="form-control">
                                <?php echo $htmlSelectList; ?>
                            </select>
                        </div>
                    </div>

                    <!-- Text input-->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="NbrePlace">Nombre de place</label>
                        <div class="col-md-4">
                            <input id="NbrePlace" name="NbrePlace" placeholder="Disponibilité"
                                   class="form-control input-md"
                                   required="" type="text">

                        </div>
                    </div>

                    <!-- Upload File -->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="affiche">Sélection de l'affiche</label>
                        <div class="col-md-4">
                            <span class="fileinput-button">
                                <i class="glyphicon glyphicon-plus"></i>
                                <span >Choisissez un fichier</span>
                                <input type="file" size="32" name="uploadAffiche" value="">
                                <input type="hidden" name="upload" value="simple"/>
                            </span>
                        </div>
                    </div>

                    <!-- Button -->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="ValiderCreationEvent"></label>
                        <div class="col-md-4">
                            <button id="ValiderCreationEvent" name="ValiderCreationEvent" class="btn btn-primary">
                                Valider
                            </button>
                        </div>
                    </div>

                    <?php
                    if (isset($message)) {
                        echo
                            //<!-- Message -->
                        "<div class='col-md-4 col-md-offset-4 alert alert-success fade in'>
                         <a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
                            <strong>$message</strong>
                        </div>";
                    }
                    ?>

                </fieldset>
            </form>
        </div>
    </div>
    <!-- /.row -->

<?php include '../Assets/includes/backOffice/footer-b.php'; ?>