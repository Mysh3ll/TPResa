<?php
/**
 * Vue ListeEvenementClient.php
 * Permet à l'utilisateur de visualiser les événements disponibles
 * et de basculer sur la page de réservation
 */
include '../Assets/includes/frontOffice/header-f.php';
?>
<!-- Page Content -->
<div class="container">
    <div class="row">
        <div class="col-lg-12">
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
        </div>
        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-12">
                    <form class="form-horizontal" action="../Controllers/DemandeModifEventClient.php" method="post">
                        <fieldset>
                            <!-- Form Name -->
                            <legend><h1>Demande de modification des places</h1></legend>

                            <!-- Text input-->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="mailPersonne">Adresse e-mail</label>
                                <div class="col-md-4">
                                    <input id="mailPersonne" name="mailPersonne" placeholder="Saisir votre adresse e-mail"
                                           class="form-control input-md" required="" type="email">
                                </div>
                            </div>

                            <!-- Button -->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="ValiderEnvoiEmail"></label>
                                <div class="col-md-4">
                                    <button id="ValiderEnvoiEmail" name="ValiderEnvoiEmail"
                                            class="btn btn-primary">
                                        Valider
                                    </button>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.row -->


        <?php include '../Assets/includes/frontOffice/footer-f.php'; ?>

    