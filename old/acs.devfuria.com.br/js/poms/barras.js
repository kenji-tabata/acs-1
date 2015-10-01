$(function(){

    /* Slider */

    /* Adjetivos */
    $('#adjetivos-poms .adjetivo-poms').each(function(indice, tagAdjetivo){
        // Transformando a conjunto de tags capturado em obj jQuery
        conjTagsAdjetivo = $(tagAdjetivo);
        valorAdjetivo = conjTagsAdjetivo.find('.valor-adjetivo-poms').val();
        conjTagsAdjetivo.find('.adjetivos-barras-poms').slider({
            range: 'min',
            value: valorAdjetivo,
            min: 0,
            max: 5,
            slide: function(event, ui) {
                $(event.target).parent().find('.valor-adjetivo-poms').val(ui.value);
                $(event.target).parent().find('.adjetivos-pontucao-poms').text(ui.value);
                if(ui.value != 0){
                    $(event.target).parent().find('.adjetivos-nomes-poms').css('color', '#787878');
                }
            }
        });
    });

});
        