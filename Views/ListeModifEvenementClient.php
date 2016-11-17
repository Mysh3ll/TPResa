<?php
/**
 * Created by PhpStorm.
 * User: Michel
 * Date: 06/10/2016
 * Time: 09:12
 */
include '../Assets/includes/frontOffice/header-f.php';
?>
    <!-- Confirm Modal -->
    <div class="container">
        <div class="row">
            <div id="modifModal" class="modal fade in">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <a class="btn btn-default" data-dismiss="modal"><span
                                    class="glyphicon glyphicon-remove"></span></a>
                            <h4 class="modal-title">ATTENTION</h4>
                        </div>
                        <div class="modal-body">
                            <h4>Confirmation de modification</h4>
                            <p>Vous êtes sur le point de supprimer l'ensemble de vos places réservées pour cet évènement.</p>
                            <p> Vous pourrez reserver à nouveau dans la limite des stocks disponibles.</p>
                            <p>Cette opération est irréversible, veuillez confirmer votre choix !</p>
                        </div>
                        <div class="modal-footer">
                            <div class="btn-group">
                                <button class="btn btn-danger" data-dismiss="modal"><span
                                        class="glyphicon glyphicon-remove"></span> Annuler
                                </button>
                                <button id="modalConfirmModif" class="btn btn-primary"><span class="glyphicon
                                glyphicon-check"></span>
                                    Confirmer
                                </button>
                            </div>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dalog -->
            </div><!-- /.modal -->
        </div>
    </div>

    <!-- Page Content -->
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <form class="form-horizontal" id="FormModifEvent" action="../Controllers/ModifEventClient.php" method="post">
                    <fieldset>

                        <!-- Form Name -->
                        <legend><h1>Liste des événements réservés</h1></legend>

                        <!-- Select Basic -->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="ListeModifEvent">Choix de l'événement</label>
                            <div class="col-md-4">
                                <select id="ListeModifEvent" name="ListeModifEvent" class="form-control">
                                <?php echo $htmlSelectListEvent ?>
                                </select>
                            </div>
                        </div>
                        <input hidden id="mail" name="mail" value = <?php echo $mailUrl?> />
                        <!-- Button -->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="ValiderModifEvent"></label>
                            <div class="col-md-4">
                                <button id="ValiderModifEvent" name="ValiderModifEvent" class="btn btn-primary">Valider
                                </button>
                            </div>
                        </div>

                    </fieldset>
                </form>
            </div>
        </div>
        <!-- /.row -->

<?php include '../Assets/includes/frontOffice/footer-f.php'; ?>