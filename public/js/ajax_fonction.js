$(document).ready(function () {

    /*====== CHANGE QUALITE ======*/

    $('.column4 select').change(function () {
        var id = $(this).attr('data-id');

        var val_select = $(this).val();

        $.ajax({
            type: "GET", //le type de ma requete
            url: "/admin/"+val_select+"/"+id, // l'url vers laquelle la requete sera envoyé

            success: function (data, textStatus, jaXHR) {
                toastr.success('Qualité modifiée.');
            },

            error: function (jaXHR, textStatus, errorThrown) {
                //une erreur s'est produite lors de la requete
                toastr.error('Il y a eu un problème.');

            }
        });

    });
});