$(function(){

    /* Radio para as frases */
    $('.real-equipe-frases').buttonset();
    
    /* Validacao */
    $("form#form-real-equipe-pesquisados").submit(function() {
        var erro = 0;
        
        $('.real-equipe-pontuacao').each(function(indice, tag){
            var $divPontuacao = $(tag);
            var checks = $divPontuacao.children('input:checked').length;

            if (checks == 0) {
                erro++;
                $divPontuacao.parent().find('.real-equipe-frase label').css('color', '#FF0000');
            } else {
                $divPontuacao.parent().find('.real-equipe-frase label').css('color', '#787878');
            }
        });
        
        if(erro == 0){
            return true;
        } else {
            $('.erro').show();
            $('html, body').animate({
                scrollTop: $("#wrapper").offset().top
            }, 2000);
            return false; 
        }
    });
    
    /* Caso o status seja processado. */
    if($("#equipe_status").val() == 'processado'){
        // Mostra alerta com mensagem.
        $("#dialog-real-equipe-form").dialog({
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
        $("#dialog-real-equipe-form").dialog( {autoOpen: false} );
    }
});