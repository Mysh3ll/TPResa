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
                <!-- Title Name -->
                <legend><h1>Annulation inscription</h1></legend>

                <!-- DatePicker -->
                <div class="col-md-12">
                    <label class="col-md-4 control-label text-right" for="datepicker">Choissisez un évènement : </label>
                    <div class="col-md-4" id='datepicker'></div>

                    <h1 id='titre'>Annulation de certains participants pour l'évènement:<span id='titreEvent'></span>
                    </h1>
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

                    <span id='eventVide'></span></div>
            </div>
        </div>
        <!-- /.row -->

<?php include '../Assets/includes/backOffice/footer-b.php'; ?>