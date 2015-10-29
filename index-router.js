/*
 * Este é o JavaScript Scratchpad.
 *
 * Escreva JavaScript, e depois clique com o botão direito ou selecione no menu Execução:
 * 1. Executar: para avaliar o texto selecionado (Ctrl+R),
 * 2. Inspecionar: para abrir o resultado em uma janela de inspeção (Ctrl+I)
 * 3. Visualizar: para inserir o resultado em um comentário depois da seleção. (Ctrl+L)
 */

var AppRouter = Backbone.Router.extend({

    routes: {
        '': 'index',
        'poms': 'listar_profissionais',
        'poms-formulario': 'formulario_poms',
    },
    index: function () {
        console.log('index');
    },
    listar_profissionais: function () {
        console.log('listar_profissionais');
    },
    formulario_poms: function () {
        console.log('formulario_poms');
    },
});

var app_router = new AppRouter();
Backbone.history.start();

