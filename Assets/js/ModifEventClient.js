/**
 * Created by Michel on 10/11/2016.
 */

$(document).ready(function () {

    //Annule l'envoi du formulaire
    $('#FormModifEvent').submit(function (event) {
        event.preventDefault();
    })

    //Affiche le modal de confirmation
    $("#ValiderModifEvent").on('click', function () {
            //ouverture du modal de confirmation
            $("#modifModal").modal();
            //Action effectuée après avoir confirmer la suppression dans le modal
            $("#modalConfirmModif").on('click', function () {
                console.log('ok');
            })
        })
})
