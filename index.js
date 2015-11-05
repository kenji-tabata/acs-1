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

var ContentView = Backbone.View.extend({
    el: $('#content'),
    //     template: _.template($("#lista-poms-profissionais").html()),
    initialize: function () {
        this.render();
    },
    render: function() {
        this.$el.html('foi');
        return this;
    }    
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


var AppRouter = Backbone.Router.extend({
    routes: {
        '': 'index',
        'poms': 'listar_profissionais',
        'poms-formulario': 'formulario_poms',
        'poms-formulario/:id': 'abrir_formulario_poms',
    },
    index: function () {
        console.log('index');
    },
    listar_profissionais: function () {
        console.log('listar_profissionais');
        var jumbo_model = new JumbotronModel(
            {
                'titulo':    "POMS",
                'paragrafo': "Lista de profissionais que preencheram o formulário POMS."
            }
        );
        var jumbo_view    = new JumbotronView({'model': jumbo_model});        
        var content_view  = new ContentView({'model': jumbo_model});

    },
    formulario_poms: function () {
        console.log('formulario_poms');
        var jumbo_model = new JumbotronModel(
            {
                'titulo':    "POMS",
                'paragrafo': "Formulário POMS."
            }
        );
        var jumbo_view  = new JumbotronView({'model': jumbo_model});        
    },
    abrir_formulario_poms: function (id) {
        console.log('abrir_formulario_poms:' + id);
        var jumbo_model = new JumbotronModel(
            {
                'titulo':    "POMS",
                'paragrafo': "Abrindo formulário POMS."
            }
        );
        var jumbo_view  = new JumbotronView({'model': jumbo_model});        
    },
});

var app_router = new AppRouter();
Backbone.history.start();
