$(function(){

    $('#resultado-grupo-poms-lista').click(function(event){
        event.preventDefault();
        
        var $resultado_grupo = $(this);

        var $checkbox = $("input:checked");

        if($checkbox.length < 2){
            $('div.erro')
                .html('<p>Selecione ao menos dois pesquisados para ver o resultado por grupo.</p>');
        } else {
            $('div.erro').html('');
            
            var data = $checkbox.serialize();
            var url  = $resultado_grupo.attr('href');

            window.open(url+'?'+data);
        }
    });    
    
});
        