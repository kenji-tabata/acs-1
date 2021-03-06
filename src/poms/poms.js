// Backbone.sync = function (method, model, success, error) {
//     console.log("Backbone.sync(" + method + ")" + " model.id=" + model.id);
// };

var App = {
    grupo: [] // array com os pesquisados selecionados
};

App.JumbotronView = Backbone.View.extend({
    el: $('.jumbotron'),
    templates: [],
    initialize: function (conteudo) {
        this.template = _.template("<%= content %>");
        this.render(conteudo);
    },
    render: function (html) {
        this.$el.html(this.template(html));
        return this;
    }
});

App.ProfissionalView = Backbone.Model.extend({
    urlRoot: 'poms/',
    defaults: {
        nome:      '',
        email:     '',
        cpf:       '',
        genero:    '' // m ou f
    },
});

App.Poms = Backbone.Collection.extend({
    url: "poms/",
    model: App.ProfissionalView
});

App.PomsListaItemView = Backbone.View.extend({
    tagName:   "tr",
    className: "",
    template:  _.template($("#poms-lista-item").html()),
    initialize: function () {
    },
    events: {
        'click .btn-selecionar': 'selecionar',
        'click .btn-delete':     'unrender',
        'click .btn-relatorio':  'relatorio',
        'click .btn-formulario': 'formulario'
    },
    selecionar: function () {
        // console.log(this.model.id);
        var valor = this.model.id;
        // já tem ?
        if (_.contains(App.grupo, valor)) {
            // então remova!
            App.grupo = _.without(App.grupo, valor) ;
        } 
        // se não tem...
        else {
            // então insira !
           App.grupo.push(valor); 
        }
        // console.log(App.grupo);
    },
    render: function () {
        this.$el.html(this.template({prof: this.model.attributes}));
        return this;
    },
    unrender: function () {
        if (window.confirm("Você deseja realmente deletar?")) { 
            console.log('view: deletando:' + this.model.get('id'))
            this.remove();
            this.model.destroy();
        }
    },
    relatorio: function () {
        console.log("view: emitir relatorio:" + this.model.get('id'));
        window.location.href = "poms/relatorio/" + this.model.get('id');
    },
    formulario: function () {
        console.log("view: abrir formulario:" + this.model.get('id'));
        App.router.navigate("#poms-formulario/" + this.model.get('id'), {trigger: true});
    }
});

App.PomsListaView = Backbone.View.extend({
    tagName: "table",
    className: "table",
    template: _.template($("#poms-lista").html()),
    initialize: function () {
        this.render();
    },
    events: {
        'click .btn-relatorio-grupo':   'relatorio_grupo',
        'click .btn-relatorio-parecer': 'relatorio_grupo_parecer'
    },    
    render: function () {
        console.log('render()');
        var me = this,
            elem_tbody = {},
            item_view  = {};

        me.$el.html(this.template);
        elem_tbody = this.$el.find('tbody');
        this.collection.forEach(function (profissional, index) {
            // console.log(profissional.attributes);
            item_view = new App.PomsListaItemView({model: profissional})
            elem_tbody.append(item_view.render().el);
        });
        return this;
    },
    relatorio_grupo: function () {
        console.log("view: emitir relatorio em grupo:" + App.grupo);
        window.location.href = "poms/relatorio/grupo/" + JSON.stringify(App.grupo);
    },    
    relatorio_grupo_parecer: function () {
        console.log("view: emitir relatorio em grupo com parecer:" + App.grupo);
        //window.location.href = "poms/relatorio/grupo/" + JSON.stringify(App.grupo);
        $('#myModal').modal();
        $('#laudo-parecer').click(function() {
            console.log('emitir laudo com o seguinte parecer:');
            console.log($('textarea').val());
            window.location.href = "poms/relatorio/grupo/" + JSON.stringify(App.grupo) + "/?p=" + encodeURI($('textarea').val());
        });
    },    

});

App.Formulario = Backbone.Model.extend({
    urlRoot: 'poms/',
    defaults: {
        nome:      '',
        preench:   '',
        email:     '',
        cpf:       '',
        genero:    '', // m ou f
        adjetivos: '', // string-separada-por-virgula, ex: 1-1, 2-1, 3-1, etc...
        eDepois:   'voltar-para-lista', // depois de salvar o que fazer ?
    },
    initialize: function() {
    },
    // Serve para carregar com ou sem id
    carregar: function(callback) {
        this.fetch({
            success: function (_model) {
                console.log("xhr-fetch: fetch OK");
                //console.log(_model.attributes);
                callback(_model);
            },
            error: function (model, xhr, options) {
                console.log("xhr-fetch: fetch erro");
            }
        });
    },
    salvar: function(callback) {
        this.save(null, {
            success: function(_model) {
                console.log('xhr-save: formulário salvo com sucesso!');
                callback(_model);
            },
            error: function(model, xhr, options) {
                console.log('xhr-save: erro ao persistir formulário');
                console.log(this.validationError);
            },
        });

    },
    validate: function(attrs, options) {
        console.log('validate()');

        var err = [];
        if (!attrs.nome) {
            err.push({
                'oque'   : 'nome',
                'porque' : 'Campo \"nome\" requirido!',
            });
        }

        // vieram todos os 65 adjetivos ?
        var adjetivos = attrs.adjetivos.split(', ')
        if (adjetivos.length != 65) {
            err.push({
                'oque'   : 'adjetivos',
                'porque' : 'Faltaram alguns adjetivos!',
            });
        } else {
            // OK, vieram todos! Então...
            // vou checar o valor de cada adjetivo
            var indice, valor, invalidos = [], self = this;
            adjetivos.forEach(function(value, key) {
                indice = value.split('-')[0];
                value  = value.split('-')[1];
                //console.log(indice + "-" + value);
                if (!self.validar_adjetivo(value)) {
                    invalidos.push(indice);
                }
            });
            // há algum inválido ?
            if (invalidos.length > 0){
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
    },

});

App.FormularioView = Backbone.View.extend({
    tagName: "form",
    attributes: {
        "action": "salvar/",
        "method": "post"
    },
    template: _.template($("#poms-formulario").html()),
    initialize: function () {
        this.model.on("invalid", function(model, validationError) {
            console.log('view.salvar(): Formulário não validou! Erros:');
            console.log(this.model.validationError);
            // 'this' é esta visão
            this.assinalar_erros();
        }, this);
        this.render();
    },
    render: function () {
        console.log("view: render(" + this.model.id + ")");
        this.$el.html(this.template(this.model.attributes));
        var JQuery_questoes = this.$el.find('input[name="adjetivos"]');
        this.unserializeAdjetivos(this.model.get('adjetivos'), JQuery_questoes);
    },
    events: {
        "change": "change",
        "click #btn-salvar": "salvar"
    },
    change: function(event) {
        var target = event.target;
        var ctrl = {
            name:  target.name,
            value: target.value,
        }
        console.log(ctrl);
        this.model.set(ctrl.name, ctrl.value);
    },
    serializeAdjetivos: function(ColectionJquery) {
        var adjetivos = [];
        var i = 0;
        for (; i < 66; i++) {
            if (ColectionJquery[i]) {
                if(ColectionJquery[i].value) {
                    adjetivos.push((i+1) + '-' + ColectionJquery[i].value);
                }
                //else {
                //    adjetivos.push((i+1) + '-0');
                //}
            }
        }
        return adjetivos.join(', ');
    },
    unserializeAdjetivos: function(strForm, ColectionJquery) {
        if (strForm === "") return null
        var indice, valor, adjetivos = strForm.split(', ');
        adjetivos.forEach(function(value, key) {
            indice = value.split('-')[0];
            value  = value.split('-')[1];
            //console.log(indice + "-" + value);
            ColectionJquery[indice-1].value = value;
        });
    },
    // Esta função apenas sinaliza os erros,
    // quem valida de fato é o modelo.
    assinalar_erros: function() {
        var self = this;
        var controle = {};

        // adjetivos
        controle = $('input[name="adjetivos"]');
        var elem, valor;
        $.each(controle, function (index, value) {
            elem  = $(value).parent().parent();
            valor = $(value).val();
            if (self.model.validar_adjetivo(valor)) {
                elem.removeClass('has-error');
            } else {
                elem.addClass('has-error');
            }
        });

        // nome
        controle = $("#txt-nome");
        if(controle.val()) {
            controle.parent().removeClass('has-error');
        } else {
            controle.parent().addClass('has-error');
        }
    },
    salvar: function(evt) {
        console.log('view.salvar()');
        evt.preventDefault();
        self = this;
        this.model.set('adjetivos', this.serializeAdjetivos($('input[name="adjetivos"]')));
        // console.log(this.model.attributes);
        this.model.salvar(function(_model) {
            // console.log('callback do save');
            // console.log(_model.attributes);
            switch (_model.get('eDepois')) {
                case "voltar-para-lista":
                    console.log('view.salvar(): faça voltar para a lista')
                    App.router.navigate("#poms", {trigger: true});
                    // window.location.hash = "#poms";
                    break;
                case "ver-laudo":
                    console.log('view.salvar(): emitir laudo!')
                    _model.set('id', _model.get('id_profissional'));
                    if (_model.get('id_profissional')) {
                        window.location.href = "poms/relatorio/" + _model.get('id_profissional');
                        App.router.navigate("#poms-formulario/" + _model.get('id_profissional'), {trigger: true});
                        // window.location.hash = "#poms-formulario/" + _model.get('id_profissional');
                    } else {
                        console.log('view.salvar(): ... mas não temos o id!');
                        console.log(_model.attributes);
                        console.log(_model.get('adjetivos'));
                    }
                    break;
                case "continuar-inserindo":
                    console.log('view.salvar(): limpe o formulário')
                    App.router.navigate("#poms-formulario", {trigger: true});
                    // window.location.hash = "#poms-formulario";
                    break;
            }
        })
    }
});

App.Router = Backbone.Router.extend({
    routes: {
        '':                     'index',
        'poms':                 'listar_profissionais',
        'poms-formulario':      'formulario_poms',
        'poms-formulario/:id':  'abrir_formulario_poms',
    },
    index: function () {
        console.log('router: index()');
        var jumbo_view = new App.JumbotronView({
            'content':
                '<h1>Sistemas ACS</h1>' +
                '<p>' +
                    '<ul>' +
                        '<li><a href="#poms">POMS</a></li>' +
                        '<li><a href="#acs-1">ACS -1</a></li>' +
                    '</ul>' +
                '</p>'
        });
        $('#content').html(null);
    },
    listar_profissionais: function () {
        console.log('router: listar_profissionais()');
        var jumbo_view = new App.JumbotronView({
            'content':
                '<h1>POMS</h1>' +
                '<p>Lista de profissionais que preencheram o formulário POMS.</p>' +
                '<p><a href="#poms-formulario">Preencher formulário</a>'
        });
        App.poms = new App.Poms();
        App.poms.fetch({
            success: function (collection, response) {
                console.log('xhr: lista poms carregada!');
                var listaView = new App.PomsListaView({collection: App.poms});
                $('#content').html(listaView.el);
            },
            error: function (collection, response) {
                console.log('xhr: falha ao carregar lista poms!');
            },
        });
    },
    formulario_poms: function () {
        console.log('router: formulario_poms()');
        var jumbo_view = new App.JumbotronView({
            'content':
                '<h1>POMS</h1>' +
                '<p>Preenchendo formulário POMS.</p>' +
                '<p><a href="#poms">Voltar para lista</a>'
        });
        var formulario = new App.Formulario(); // form sem id
        var formularioView = new App.FormularioView({model: formulario});
        $('#content').html(formularioView.el);
    },
    abrir_formulario_poms: function (id) {
        console.log('router: abrir_formulario_poms(' + id + ')');
        var jumbo_view = new App.JumbotronView({
            'content':
                '<h1>POMS</h1>' +
                '<p>Abrindo formulário POMS.</p>' +
                '<p><a href="#poms">Voltar para lista</a>'
        });
        var formulario = new App.Formulario({id: id});
        formulario.carregar(function(model) {
            var formularioView = new App.FormularioView({model: model});
            $('#content').html(formularioView.el);
        });
    },
});

App.router = new App.Router;
Backbone.history.start();