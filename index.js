// Backbone.sync = function (method, model, success, error) {
//     console.log("Backbone.sync(" + method + ")" + " model.id=" + model.id);
// };

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
    urlRoot: '/_acs/poms/',
    defaults: {
        nome:      '',
        email:     '',
        cpf:       '',
        genero:    '' // m ou f
    },
});

//
// carregar lista de pessoas que preencheram poms
//
var PomsColecction = Backbone.Collection.extend({
    url: "/_acs/poms/"
});
    
var poms_preenchidos = new PomsColecction([
    new ProfissionalModel({id: 1, nome: 'john'}),
    new ProfissionalModel({id: 2, nome: 'paul'}),
    new ProfissionalModel({id: 3, nome: 'george'}),
    new ProfissionalModel({id: 4, nome: 'ringo'})
]);

var PomsListaItemView = Backbone.View.extend({
    tagName:   "tr",
    className: "",
    template:  _.template($("#poms-lista-item").html()),
    initialize: function () {
    },
    events: {
        'click .btn-delete':     'unrender',
        'click .btn-relatorio':  'relatorio',
        'click .btn-formulario': 'formulario'
    },
    render: function () {
        this.$el.html(this.template({prof: this.model}));
        return this;
    },
    unrender: function () {
        this.remove();
        this.model.destroy();
    },
    relatorio: function () {
        console.log("PomsListaItemView: emitir-relatorio:" + this.model.get('id'));
        window.location.href = "poms/relatorio/" + this.model.get('id');
    },
    formulario: function () {
        console.log("PomsListaItemView: abrir-formulario:" + this.model.get('id'));
        window.location.hash = "#poms-formulario/" + this.model.get('id');
    }
});

var PomsListaView = Backbone.View.extend({
    tagName: "table",
    className: "table",
    template: _.template($("#poms-lista").html()),
    initialize: function () {
        poms_preenchidos.fetch({
            success: function (collection, response) {
                console.log('xhr: lista poms carregada!');
                console.log(JSON.stringify(poms_preenchidos.toJSON()));
            },
            error: function (collection, response) {
                console.log('xhr: falha a carregar lista poms!');
            },
        });        
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

FormularioModel = Backbone.Model.extend({
    urlRoot: '/_acs/poms/formulario/',
    defaults: {
        nome:      '',
        email:     '',
        cpf:       '',
        genero:    '', // m ou f
        adjetivos: '', // string-separada-por-virgula, ex: 1-1, 2-1, 3-1, etc...
        eDepois:   '', // depois de salvar o que fazer ?
    },
    validate: function(attrs, options) {
        var err = [];
        if (!attrs.nome) {
            err.push({
                'oque'   : 'nome',
                'porque' : 'Campo \"nome\" requirido!',
            });
        }

        // vieram todos os 65 adjetivos ?
        adjetivos = attrs.adjetivos.split(', ')
        if (adjetivos.length != 3) {
            err.push({
                'oque'   : 'adjetivos',
                'porque' : 'Faltaram alguns adjetivos!',
            });
        } else {
            // OK, vieram todos! Então...
            // vou checar o valor de cada adjetivo
            var indice, valor, invalidos = [], self = this;
            adjetivos.forEach(function (value, key) {
                indice = value.split('-')[0];
                value  = value.split('-')[1];
                //console.log(indice + "-" + value);
                if (!self.validar_adjetivo(value)) {
                    invalidos.push(indice);
                }
            });
            // há algum inválido ?
            if (invalidos.length > 0) {
                keys = keys.join(', ');
                err.push({
                    'oque'   : 'adjetivos',
                    'porque' : 'Adjetivos com valores inválidos [' + keys + ']',
                });        
            }
        }
        
        if (err.length > 0) return err;
    },
    validar_adjetivo: function (valor) {
        if (valor > 0 && valor < 6) {
            return true;
        } else {
            return false;
        }
    }     
});

var FormularioView = Backbone.View.extend({
    tagName: "form",
    attributes: {
        "action": "salvar/",
        "method": "post"
    },
    template: _.template($("#poms-formulario").html()),
    initialize: function () {
        if (this.id) {
            console.log('ler dados formulário');
            this.bind(this.id);
        }
        this.render();
    },
    render: function () {
        this.$el.html(this.template);
    },
    events: {
        "click #btn-salvar": "salvar"
    },
    bind: function (id) {
        console.log('carregando dados...');
        var self = this;
        this.model = new FormularioModel({id: id});
        this.model.fetch({
            success: function (model_resposta) {
                console.log("xhr: formulário retornado com sucesso!");
                // estamos exibindo o retorno da requisição
                console.log(model_resposta.get('nome'));
                $("#txt-nome").val(model_resposta.get('nome'));
                $("#txt-email").val(model_resposta.get('email'));
                $("#txt-cpf").val(model_resposta.get('cpf'));
                if (model_resposta.get('genero') == "masc") {
                    $('#genero-masc').prop("checked", true);
                } else {
                    $('#genero-fem').prop("checked", true);                    
                }
                self.unserializeAdjetivos("1-5, 2-5, 3-5", $('input[name="adjetivos[]"]'));
            },
            error: function (model, xhr, options) {
                console.log("Erro");
            }
        });
    },
    serialize: function () {
        this.model = new FormularioModel({
            nome:      $("#txt-nome").val(),
            email:     $("#txt-email").val(),
            cpf:       $("#txt-cpf").val(),
            genero:    $('input[name=genero]:checked').val(),
            adjetivos: this.serializeAdjetivos($('input[name="adjetivos[]"]')),
            eDepois:   $('input[name=depois-de-salvar]:checked').val(),
        });
    },
    serializeAdjetivos: function(ColectionJquery) {
        var adjetivos = [];
        var i = 0;
        for (; i < 66; i++) {
            if (ColectionJquery[i]) {
                if (ColectionJquery[i].value) {
                    adjetivos.push((i + 1) + '-' + ColectionJquery[i].value);
                }
                //else {
                //    adjetivos.push((i+1) + '-0');
                //}
            }
        }
        return adjetivos.join(', ');
    },
    unserializeAdjetivos: function (strForm, ColectionJquery) {
        var indice, valor, adjetivos = strForm.split(', ');
        adjetivos.forEach(function (value, key) {
            indice = value.split('-')[0];
            value  = value.split('-')[1];
            //console.log(indice + "-" + value);
            ColectionJquery[indice - 1].value = value;
        });
    },
    // Esta função apenas sinaliza os erros, 
    // quem valida de fato é o modelo.
    assinalar_erros: function() {
        var self = this;
        $.each($('input[name="adjetivos[]"]'), function (index, value) {
            var controle = $(value).parent().parent();
            var valor    = $(value).val();
            if (self.model.validar_adjetivo(valor)) {
                controle.removeClass('has-error');
            } else {
                controle.addClass('has-error');
            }
        });
       
    },
    salvar: function(evt) {
        evt.preventDefault();
        console.log('FormularioView.salvar()');
        this.serialize();
        
        if (this.model.isValid()) {
            console.log('FormularioView.salvar(): salvando modelo!');
            this.model.save({}, {
                success: function () {
                    console.log('xhr: formulário salvo com sucesso!');
                }
            });            
            //console.log(this.model.get('adjetivos'));
            switch (this.model.get('eDepois')) {
                case "voltar-para-lista":
                    console.log('FormularioView.salvar(): faça voltar para a lista')
                    window.location.hash = "#poms";
                    //AppRouter.listar_profissionais();
                    break;
                case "ver-laudo":
                    console.log('FormularioView.salvar(): emitir laudo!')
                    if (this.model.get('id')) {
                        window.location.href = "poms/relatorio/" + this.model.get('id');
                    } else {
                        console.log('FormularioView.salvar(): sem id!');
                    }
                    break;
                case "continuar-inserindo":
                    console.log('FormularioView.salvar(): limpe o formulário')
                    window.location.hash = "#poms-formulario";
                    break;
            }
        } else {
            console.log('FormularioView.salvar(): Formulário não validou...');
            console.log(this.model.validationError);
            this.assinalar_erros();
        }
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
        console.log('AppRouter: index()');
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
        console.log('AppRouter: listar_profissionais()');
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
        console.log('AppRouter: formulario_poms()');
        var jumbo_model = new JumbotronModel(
                {
                    'titulo':    "POMS",
                    'paragrafo': "Formulário POMS."
                }
        );
        var jumbo_view = new JumbotronView({'model': jumbo_model});
        var formulario_view = new FormularioView();
        $('#content').html(formulario_view.el);
    },
    abrir_formulario_poms: function (id) {
        console.log('AppRouter: abrir_formulario_poms:' + id);
        var jumbo_model = new JumbotronModel(
                {
                    'titulo':    "POMS",
                    'paragrafo': "Abrindo formulário POMS."
                }
        );
        var jumbo_view = new JumbotronView({'model': jumbo_model});
        var formulario_view = new FormularioView({id: id});
        $('#content').html(formulario_view.el);
    },
});
var app_router = new AppRouter();
Backbone.history.start();
