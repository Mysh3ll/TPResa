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
                    <form class="form-horizontal" action="../Controllers/actualiseEvent.php" method="post">
                        <fieldset>
                            <!-- Form Name -->
                            <legend><h1 id='listEvent'>Liste des événements disponibles</h1></legend>
                            <div id='datepicker' name="datePicker"/>
                </div>
                <input type="text" hidden="true" name="datePicked" id="datePicked"/>

                <div class="form-group">
                    <label class="col-md-4 control-label" for="ValiderEvent"></label>
                    <div class="col-md-4">
                        <button id="ValiderEvent" name="ValiderEvent" class="btn btn-primary">
                            Participer à cet événement !
                        </button>
                    </div>
                </div>
                </fieldset>
                </form>
            </div>
        </div>
    </div>
    <!-- /.row -->
</div>

<?php include '../Assets/includes/frontOffice/footer-f.php'; ?>

    