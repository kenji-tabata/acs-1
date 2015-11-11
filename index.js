Backbone.sync = function (method, model, success, error) {
    console.log(method + " model.id=" + model.id);
};

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
    render: function () {
        this.$el.html(this.template(this.model.attributes));
        return this;
    }
});

var ProfissionalModel = Backbone.Model.extend({
    url: "poms/"
});

var poms_preenchidos = new Backbone.Collection(
    //
    // carregar lista de pessoas que preencheram poms
    //
    [
        new ProfissionalModel({id: 1, nome: 'john'}),
        new ProfissionalModel({id: 2, nome: 'paul'}),
        new ProfissionalModel({id: 3, nome: 'george'}),
        new ProfissionalModel({id: 4, nome: 'ringo'})
    ]
);

var PomsListaItemView = Backbone.View.extend({
    tagName: "tr",
    className: "",
    template: _.template($("#poms-lista-item").html()),
    initialize: function () {
    },
    render: function () {
        this.$el.html(this.template({prof: this.model}));
        return this;
    },
    events: {
        'click .btn-delete':     'unrender',
        'click .btn-relatorio':  'relatorio',
        'click .btn-formulario': 'formulario'
    },
    unrender: function () {
        this.remove();
        this.model.destroy();
    },
    relatorio: function () {
        console.log("emitir-relatorio:" + this.model.get('id'));
    },
    formulario: function () {
        console.log("abrir-formulario:" + this.model.get('id'));
        window.location.hash = "#poms-formulario/" + this.model.get('id');
    }
});

var PomsListaView = Backbone.View.extend({
    tagName: "table",
    className: "table",
    template: _.template($("#poms-lista").html()),
    initialize: function () {
        this.render();
    },
    render: function () {
        var me = this,
            elem_tbody = {},
            item_view  = {};

        me.$el.html(this.template);
        elem_tbody = this.$el.find('tbody');
        poms_preenchidos.forEach(function (profissional, index) {
            item_view = new PomsListaItemView({model: profissional})
            elem_tbody.append(item_view.render().el);
        });
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
    template: _.template($("#poms-formulario").html()),
    initialize: function () {
        this.render();
    },
    render: function () {
        this.$el.html(this.template);
    },
    events: {
        "click #btn-salvar": "salvar"
    }
});


var AppRouter = Backbone.Router.extend({
    routes: {
        '':                     'index',
        'poms':                 'listar_profissionais',
        'poms-formulario':      'formulario_poms',
        'poms-formulario/:id':  'abrir_formulario_poms',
    },
    index: function () {
        console.log('index()');
        var jumbo_model = new JumbotronModel(
                {
                    'titulo': "Sistemas ACS",
                    'paragrafo': "Poms, ACS 1"
                }
        );
        var jumbo_view = new JumbotronView({'model': jumbo_model});
        $('#content').html(null);
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
        var lista_view = new PomsListaView();
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
        var jumbo_view = new JumbotronView({'model': jumbo_model});
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
        var jumbo_view = new JumbotronView({'model': jumbo_model});
        var formulario_view = new FormularioView({'model': formulario});
        $('#content').html(formulario_view.el);
    },
});

var app_router = new AppRouter();
Backbone.history.start();