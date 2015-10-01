$(function() {
    // Caso o status seja processado.
    if($("#status-poms-form").hasClass('processado')){
        // Mostra alerta com mensagem.
        $("#dialog-poms-form").dialog({
            width: 600, 
            modal: true, 
            buttons: {
                Ok: function() {
                    $(this).dialog("close");
                }
            }
        }) 
    } else {
        // Não abre o alerta.
        $("#dialog-poms-form").dialog( {autoOpen: false} );
    }
});