/**
 * En cliquant sur un avatar à modifier dans le profil d'un utilisateur connecté,
 * l'avatar sélectionné est mis en surbrillance et le bouton prendra la value de l'avatar sélectionné
 * afin de remplacer l'ancien par celui-ici en PHP
 */
$('.newavatar').click(function () {
    event.preventDefault();
    $('li').css("box-shadow", "none");
    $(this).parent().css("box-shadow", "0 0 5px grey");
    var sImgSrcAttr = $(this).children().attr('src');   //récupère l'attribut src de l'image
    $('input#newavatar').attr("value", sImgSrcAttr);    //le colle dans le champ value="" de l'input ayant l'id #newavatar
});


/**
 * AJAX servant au moteur de recherche. envoie des informations vers index.php (donc toutes les pages), pour permettre l'autocomplétion en temps réel
 */
$("#search").autocomplete({

    source: function (request, response) {
        $.ajax({
            url: "index.php",
            dataType: "json",
            data: {
                page: 'search',
                mot: request.term,
                type: 'webservice'
            },
            success: function (data) {
                response(data);
            }
        });
    },

    minLength: 2,
    select: function (event, ui) {
        window.location = ui.item.id;
    }
});

/**
 * Lorsque l'utilisateur écrit dans le champ Password et Confirm Password du formulaire d'enregistrement, la fonction check password se lance
 */
$('form#subscribeform input[type="password"]').on('keyup', function (oEvent) {
    checkPassword();
});

/**
 * Change la couleur entourant les deux input Password et Confirm Password du formulaire d'enregistrement, si les deux valeurs ne correspondent pas
 * @returns {boolean}
 */
function checkPassword() {
    var $oForm = $('form#subscribeform');

    var $oPassword = $oForm.find('input[name="password"]');
    var $oConfirmPassword = $oForm.find('input[name="confirmPassword"]');

    var bMatch = (($oPassword.val() === $oConfirmPassword.val()));
    if (!bMatch || ($oPassword.val() === '' && $oConfirmPassword.val() === '')) {
        $oPassword.css('border-color', '#f00');
        $oConfirmPassword.css('border-color', '#f00');
    } else {
        $oPassword.css('border-color', '#0f0');
        $oConfirmPassword.css('border-color', '#0f0');
    }
    return bMatch;
}


