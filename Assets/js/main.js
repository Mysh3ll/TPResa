/**
 * Created by Michel on 10/10/2016.
 */
$(document).ready(function () {
// Fonction qui permet de mettre en majuscule la première lettre
    String.prototype.Majuscule = function () {

        return this.toLowerCase().replace(/(^|\s|\-)([a-zéèêë])/g, function (u, v, w) {
            return v + w.toUpperCase()
        });
    }
});