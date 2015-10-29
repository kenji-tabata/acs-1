/*
 * Este é o JavaScript Scratchpad.
 *
 * Escreva JavaScript, e depois clique com o botão direito ou selecione no menu Execução:
 * 1. Executar: para avaliar o texto selecionado (Ctrl+R),
 * 2. Inspecionar: para abrir o resultado em uma janela de inspeção (Ctrl+I)
 * 3. Visualizar: para inserir o resultado em um comentário depois da seleção. (Ctrl+L)
 */
var JumbotronModel = Backbone.Model.extend({
    defaults: {
        titulo:    'ACS',
        paragrafo: 'Sistemas ACS'
    }
});

var JumbotronView = Backbone.View.extend({
    el: $('.jumbotron'),
    template: _.template("<h1><%= titulo %></h1><p><%= paragrafo %></p>"),
    initialize: function () {
        this.render();
    },    
    render: function() {
        this.$el.html(this.template(this.model.attributes));
        return this;
    }
});

var jumbo_model = new JumbotronModel(
    {
        'titulo':    "POMS",
        'paragrafo': "Lista de profissionais que preencheram o formulário POMS."
    }
); 
var jumbo_view  = new JumbotronView({'model': jumbo_model});

