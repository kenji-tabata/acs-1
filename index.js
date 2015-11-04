var AppRouter = Backbone.Router.extend({
    routes: {
        '': 'index',
        'poms': 'listar_profissionais',
        'poms-formulario/': 'formulario_poms',
        'poms-formulario/:id': 'abrir_formulario_poms',
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
    abrir_formulario_poms: function (id) {
        console.log('abrir_formulario_poms:' + id);
    },
});

var app_router = new AppRouter();
Backbone.history.start();