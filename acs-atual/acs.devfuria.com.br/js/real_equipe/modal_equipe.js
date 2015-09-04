$(function() {
    
    /* Evento que abre o modal para formar uma equipe.
     */
    $("a.real-equipe-form-equipe").click(function(e) {
        var url  = 'real_equipe/formulario_equipe/';
        var href = $(this).attr('href');
        
        e.preventDefault()
        
        if(href != '#novaEquipe'){
            url = href;
        }
        $.ajax({
            url: url,
            type: 'GET',
            dataType: 'html',
            async: false,
            success: function(data) {
                 $('#real-equipe-armazena-modal').html(data);
                 
                 $("#real-equipe-dialog-modal").dialog({
                    autoOpen: true,
                    height: 580,
                    width: 900,
                    modal: true,
                    close: function() {
                        $(this).dialog("destroy");
                        window.location.reload();
                    },
                    buttons: {
                        "Salvar": function() {
                            
                            var nr_pesquisados = $('#real-equipe-dialog-equipe li').length;
                            
                            var nome_equipe    = $('#real-equipe-dialog-nome-equipe').val();
                            var id_cliente     = $('#real-equipe-dialog-id-cliente').val();
                            var status         = $('#real-equipe-dialog-status-equipe').val();
                            var id_real_equipe = $('#real-equipe-dialog-id').val();
                            
                            if(nr_pesquisados == 0 || nome_equipe == ''){
                                $('.erro').html('<p>Dê um nome há equipe e/ou insira um pesquisado na equipe.</p>');
                            } else {
                                var data = $('#real-equipe-dialog-equipe input').serialize();
                                data = data+'&real-equipe-dialog-nome-equipe='+nome_equipe+'&real-equipe-dialog-id-cliente='+id_cliente+'&real-equipe-dialog-status-equipe='+status+'&real-equipe-dialog-id='+id_real_equipe;
                            
                                $.ajax({
                                    url: 'real_equipe/formulario_equipe_salvar/',
                                    type: 'POST',
                                    data: data,
                                    dataType: 'html',
                                    async: false,
                                    success: function(data) {
                                        $(this).dialog("destroy");
                                        window.location.reload();
                                    },
                                    error: function() {
                                        $('.erro').html('Desculpa, aconteceu ao salvar os dados da equipe!');
                                    }
                                });
                            }
                            
                        },
                        "Fechar": function() {
                            $(this).dialog("destroy");
                            window.location.reload();
                        }
                    }
                 });
             },
             error: function() {
                 $('#real-equipe-mensagens-erro').html('Desculpa, aconteceu um problema ao carregar o modal!');
             }
        });        
    });
    
});