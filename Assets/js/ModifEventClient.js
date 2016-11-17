/**
 * Created by Michel on 10/11/2016.
 */

$(document).ready(function () {

var typeSalle = $('#typeSalle').val();

console.log(typeSalle);
$('.salle'+typeSalle).show();

    //Annule l'envoi du formulaire
    $('#FormModifEvent').submit(function (event) {
        event.preventDefault();
    });

    //Affiche le modal de confirmation
    $("#ValiderModifEvent").on('click', function () {

            //ouverture du modal de confirmation
            $("#modifModal").modal();

            //Action effectuée après avoir confirmer la suppression dans le modal
            $("#modalConfirmModif").on('click', function () {
                //Permet d'annuler le prevent default du formulaire pour envoyer les données une fois que la requete ajax a été effectuée
                $("#FormModifEvent").unbind('submit').submit();
            })
    })

    // var count = 0;
    var maxPlaces = $('#NbrPlaces').val();    

    $('.seat').on('click',function(){
        var count = (
                    $('label').filter(function(){
                        return $(this).css('backgroundColor') == 'rgb(186, 218, 85)';
                    }).length
                );

          if(count == maxPlaces){
            $('li .seat').each(function(){
                if ($(this).children('label').css('backgroundColor') != 'rgb(186, 218, 85)')
                {
                    $(this).children('input').prop('disabled', true);
                }
            })

          }
    });

            $('#reinscriptionEvent').submit(function (event) //soumission du formulaire 
            {
                event.preventDefault();
                var placesAchetees = [];
                i = 0;
                $('li .seat').each(function () // je boucle sur la liste pour voir lesquels ont été selectionnés
                {
                    if ($(this).children('label').css('backgroundColor') === 'rgb(186, 218, 85)') //couleur de la chaise selectionnée
                    {
                        placesAchetees[i] = $(this).children('input').attr('id'); //id de la chaise
                        i++;
                    }

                })
            
                var idPersonne = $('#idPersonne').val();
                var idEvent    = $('#idEvent').val();
                var mailPersonne = $('#mailPersonne').val();

                //Postage des données

                $.get("../Controllers/EventModifResa.php?placesAchetees=" + placesAchetees + "&idEvent=" + idEvent + "&idPersonne=" + idPersonne +"&mailPersonne=" + mailPersonne, function (data) {
                    resultRequest = data.statusRequest;
                    returnMessage = data.message;


                    if (resultRequest == true) {
                        var nbBooked = placesAchetees.length;
                        maxPlaces-= nbBooked;

                        $('#NbrPlaces').val(maxPlaces);
                        //Affiche le message de confirmation de réservation si l'user a choisi des places
                        $('#confirmReservation').show();
                        $('#confirmReservation').append(returnMessage);
                        $('#ValiderReBooking').hide();
                        viewBookedSeats();

                    } else {
                        $('#errorMessage').show();
                        $('#errorMessage').append(returnMessage);
                        $('#ValiderReBooking').hide();
                }
                    
                }, "json")
            })


    viewBookedSeats = function () {
        //Array qui enregistre les places réservées pour l'event
        var bookedSeats = [];

        $.ajax({
            url: "../Controllers/EventSeatBookedPicker.php",
            dataType: "json",
            async: false,
            success: function (data) {
                if (data) {
                    bookedSeats = data.placeReserveEvent; //si places reservées
                    for (var i = 0; i < bookedSeats.length; i++) {
                        //var placeHtmlCheckbox = $("#"+bookedSeats[i]);
                        //var parentHtmlLi = placeHtmlCheckbox.parent();
                        //parentHtmlLi.find('label').attr('disabled',true);
                        $("#" + bookedSeats[i]).prop('disabled', true); //permet de mettre en rouge les places
                        // réservées
                    }

                } else {
                    bookedSeats = [0]; //si aucunes places réservées
                }
            }
        });

    };



})
