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
            <div class="row">
                <div class="col-lg-12">
                    <form class="form-horizontal" action="../Controllers/????.php" method="post">
                        <fieldset>
                            <!-- Form Name -->
                            <legend><h1>Demande de modification des places</h1></legend>

                            <!-- Text input-->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="mailUser">Adresse e-mail</label>
                                <div class="col-md-4">
                                    <input id="mailUser" name="mailUser" placeholder="Saisir votre adresse e-mail"
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

    