function prixproduit(indiceprod) {
    $.ajax({
        type: 'POST', //La méthode cible (POST ou GET)
        url: 'action.php', //Script Cible
        data: { indiceprod: indiceprod, action: 'prixproduit' },
        beforeSend: function() {
            //Code à appeler avant l'appel ajax en lui même
        },
        success: function(data) {
            //console.log(data);
            $("#prix").val(data);
        }
    });
}

function deleteproduit(indicevente) {
    var totalv = parseFloat($('#total_' + indicevente).html());
    var net = parseFloat($('#net').html());

    $.ajax({
        type: 'POST', //La méthode cible (POST ou GET)
        url: 'action.php', //Script Cible
        data: { indicevente: indicevente, action: 'deleteproduit' },
        beforeSend: function() {
            //Code à appeler avant l'appel ajax en lui même
        },
        success: function() {
            $('#tr_' + indicevente).remove();
            net -= totalv;
            $('#net').html(net.toFixed(3));
        }
    });
}

function editproduit(indicevente) {
    var qte = parseFloat($('#qte_' + indicevente).html());
    var prix = parseFloat($('#prix_' + indicevente).html());

    $('#qte_' + indicevente).html("<input type='number' style='width:50px' id='qteedit_" + indicevente + "' value='" + qte + "'>");
    $('#prix_' + indicevente).html("<input type='number' style='width:120px' step='0.001' id='prixedit_" + indicevente + "' value='" + prix + "'>");
    $('#btnedit_' + indicevente).attr('value', 'Valider');
    $('#btnedit_' + indicevente).attr('class', 'btn btn-success mx-2');
    $('#btnedit_' + indicevente).attr('onclick', "valideditproduit(" + indicevente + ")");
    

}

function valideditproduit(indicevente) {
    var qteedit = parseFloat($('#qteedit_' + indicevente).val());
    var prixedit = parseFloat($('#prixedit_' + indicevente).val());
    var totalvold = parseFloat($('#total_' + indicevente).html());
    var net = parseFloat($('#net').html());

    var totalv = qteedit * prixedit;

    $('#total_' + indicevente).html(totalv.toFixed(3));
    var new_net = (net - totalvold) + totalv;
    $('#net').html(new_net.toFixed(3));

    $.ajax({
        type: 'POST', //La méthode cible (POST ou GET)
        url: 'action.php', //Script Cible
        data: { indicevente: indicevente, qteedit: qteedit, prixedit: prixedit, action: 'editproduit' },
        beforeSend: function() {
            //Code à appeler avant l'appel ajax en lui même
        },
        success: function() {
            //remettre le tr vente comme il etait
            $('#qte_' + indicevente).html(qteedit);
            $('#prix_' + indicevente).html(prixedit);
            $('#btnedit_' + indicevente).attr('value', 'Modifier');
            $('#btnedit_' + indicevente).attr('onclick', "editproduit(" + indicevente + ")");
            $('#btnedit_' + indicevente).attr('class', "btn btn-primary mx-2");


        }
    });
}