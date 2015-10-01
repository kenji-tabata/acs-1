$(function(){

    /* Valicao */
    $("form").submit(function() {
        
        var erro = 0;
        
        $('#adjetivos-poms .adjetivo-poms').each(function(indice, tagAdjetivo){
            // Transformando a conjunto de tags capturado em obj jQuery
            conjTagsAdjetivo = $(tagAdjetivo);
            valorAdjetivo = conjTagsAdjetivo.find('.valor-adjetivo-poms').val();
            
            if(valorAdjetivo == 0){
                erro++;
                conjTagsAdjetivo.find('.adjetivos-nomes-poms').css('color', '#FF0000');
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
    
});
        