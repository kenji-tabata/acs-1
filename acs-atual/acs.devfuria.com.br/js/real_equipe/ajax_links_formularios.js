$(function() {
    
    /* Evento que cria uma linha com os links para os formularios dos pesquisados.
     */
    $("a.real-equipe-equipe-pesquisados").click(function(e) {
        
        e.preventDefault()
        
        var $this   = $(this);
        var url     = $this.attr('href');
        
        $.ajax({
            url: url,
            type: 'GET',
            dataType: 'html',
            async: false,
            success: function(data) {
                 var $tr = $this.parent('td').parent('tr');
                 if($tr.hasClass('aberto')){
                     $tr.removeClass('aberto');
                     $tr.next().remove();
                     $tr.find('td').eq(0).text('+');
                 } else {
                     $tr.addClass('aberto');
                     $(data).insertAfter($tr);
                     $tr.find('td').eq(0).text('-');
                 }
             },
             error: function() {
                 $('#real-equipe-mensagens-erro').html('Desculpa, aconteceu um problema ao carregar a lista de pesquisados!');
             }
        });        
    });
    
});