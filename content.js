/*
 * Este é o JavaScript Scratchpad.
 *
 * Escreva JavaScript, e depois clique com o botão direito ou selecione no menu Execução:
 * 1. Executar: para avaliar o texto selecionado (Ctrl+R),
 * 2. Inspecionar: para abrir o resultado em uma janela de inspeção (Ctrl+I)
 * 3. Visualizar: para inserir o resultado em um comentário depois da seleção. (Ctrl+L)
 */

                
                
var ContentView = Backbone.View.extend({
    el: $('#content'),
//     template: _.template($("#lista-poms-profissionais").html()),
    initialize: function () {
        this.render();
    },
});


var Profissional = Backbone.Model.extend({});
var PomsPreenchidos = new Backbone.Collection(
    [
        new Profissional({id: 1, nome: 'john'}), 
        new Profissional({id: 2, nome: 'paul'}), 
        new Profissional({id: 3, nome: 'george'}), 
        new Profissional({id: 4, nome: 'ringo'})
    ]
);


/*
Exception: SyntaxError: expected expression, got '<'
@Scratchpad/4:10
*/