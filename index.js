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

var ProfissionalModel = Backbone.Model.extend({});

var PomsPreenchidos = new Backbone.Collection(
    [
        new ProfissionalModel({id: 1, nome: 'john'}), 
        new ProfissionalModel({id: 2, nome: 'paul'}), 
        new ProfissionalModel({id: 3, nome: 'george'}), 
        new ProfissionalModel({id: 4, nome: 'ringo'})
    ]
);

var ListaView = Backbone.View.extend({
    tagName: "table",
    className: "table",
    template: _.template($("#poms-lista-de-profissionais").html()),
    initialize: function () {
        this.render();
    },
    render: function() {
        this.$el.html(this.template({profissionais: PomsPreenchidos.models}));
        return this;
    }
});


Formulario = Backbone.Model.extend({
    urlRoot: '/_acs/poms/formulario/',   
});

var formulario = new Formulario(
    {
//         id: 123,
        name:      $("#txt-nome").val(),
        email:     $("#txt-email").val(),
        cpf:       $("#txt-cpf").val(),
        genero:    $('input[name=genero]:checked').val(),        
        adjetivos: "string-separada-por-virgula, ex: 1-1, 2-1, 3-1, etc...",
        eDepois:   $('input[name=depois-de-salvar]:checked').val(),
    }
);

var FormularioView = Backbone.View.extend({
    tagName: "form",
    attributes: {
        "action": "salvar/",
        "method": "post"
    },    
    template: _.template( $("#poms-formulario").html()),
    initialize: function(){
        this.render();
    },
    render: function(){
         this.$el.html(this.template);
    },
    events: {
        "click #btn-salvar": "salvar"
    }
});


var AppRouter = Backbone.Router.extend({
    routes: {
        '': 'index',
        'poms': 'listar_profissionais',
        'poms-formulario': 'formulario_poms',
        'poms-formulario/:id': 'abrir_formulario_poms',
    },
    index: function () {
        console.log('index()');
        var jumbo_model = new JumbotronModel(
            {
                'titulo':    "Sistemas ACS",
                'paragrafo': "Poms, ACS 1"
            }
        );
        var jumbo_view    = new JumbotronView({'model': jumbo_model});         
    },
    listar_profissionais: function () {
        console.log('listar_profissionais()');
        var jumbo_model = new JumbotronModel(
            {
                'titulo':    "POMS",
                'paragrafo': "Lista de profissionais que preencheram o formulário POMS."
            }
        );
        var jumbo_view = new JumbotronView({'model': jumbo_model});        
        var lista_view = new ListaView();
        $('#content').html(lista_view.el);
    },
    formulario_poms: function () {
        console.log('formulario_poms()');
        var jumbo_model = new JumbotronModel(
            {
                'titulo':    "POMS",
                'paragrafo': "Formulário POMS."
            }
        );
        var jumbo_view      = new JumbotronView({'model': jumbo_model});        
        var formulario_view = new FormularioView({'model': formulario});
        $('#content').html(formulario_view.el);
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