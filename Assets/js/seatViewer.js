/**
 * seatViewer.js
 * Fichier qui permet d'afficher les places
 * totales/disponibles/réservées
 */
$(document).ready(function () {

    //variable qui permet de connaître le nombre de colonne nécessaire
    var colonne;

    //variable qui définie le nombre de ligne affichées
    var ligne = 5;

    //fonction ajax qui définie le nombre de colonne à afficher selon le nombre de place de l'évent
    $.ajax({
        url: "../Controllers/EventSeatPicker.php",
        dataType: "json",
        async: false,
        success: function (data) {
            var nbrPlace = data.placeEvent;
            colonne = nbrPlace / ligne;
        }
    });

    // variable qui permet d'effectuer les réglages dans la fonction "init"
    var settings = {
        rows: ligne, //total number of rows of seats.
        cols: colonne, //total number of seats in each row.
        rowCssPrefix: 'row-', //will be used to customize row layout using (rowCssPrefix + row number) css class.
        colCssPrefix: 'col-', //will be used to customize column using (colCssPrefix + column number) css class.
        seatWidth: 35, //width of seat.
        seatHeight: 35, //height of seat.
        seatCss: 'seat', //css class of seat.
        selectedSeatCss: 'selectedSeat', //css class of already booked seats.
        selectingSeatCss: 'selectingSeat' //css class of selected seats.
    };

    //fonction qui initialise l'affichage des sièges dans la vue #place
    var init = function (reservedSeat) {
        var str = [], seatNo, className;
        for (i = 0; i < settings.rows; i++) {
            for (j = 0; j < settings.cols; j++) {
                seatNo = (i + j * settings.rows + 1);
                className = settings.seatCss + ' ' + settings.rowCssPrefix + i.toString() + ' ' + settings.colCssPrefix + j.toString();
                if ($.isArray(reservedSeat) && $.inArray(seatNo, reservedSeat) != -1) {
                    className += ' ' + settings.selectedSeatCss;
                }
                str.push('<li class="' + className + '"' +
                    'style="top:' + (i * settings.seatHeight).toString() + 'px;left:' + (j * settings.seatWidth).toString() + 'px">' +
                    '<a title="' + seatNo + '">' + seatNo + '</a>' +
                    '</li>');
            }
        }
        $('#place').html(str.join(''));
    };

    //fonction qui affiche les places déjà réservées en rouge dans la vue #place
    var afficheBookedSeats = function () {
        //Array qui enregistre les places réservées pour l'event
        var bookedSeats = [];
        $.ajax({
            url: "../Controllers/EventSeatBookedPicker.php",
            dataType: "json",
            async: false,
            success: function (data) {
                if (data) {
                    bookedSeats = data.placeReserveEvent; //si places reservées
                } else {
                    bookedSeats = [0]; //si aucunes places réservées
                }
            }
        });
        init(bookedSeats);
    }

    //Appel la fonction "afficheBokkedSeats"
    afficheBookedSeats();


});