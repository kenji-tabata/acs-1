Profissional = Backbone.Model.extend({
    urlRoot: '/_acs/poms/profissional/'
});

Formulario = Backbone.Model.extend({
    urlRoot: '/_acs/poms/formulario/',   
});

var prof = new Profissional(
    {
        name:      $("#txt-nome").val(),
        email:     $("#txt-email").val(),
        cpf:       $("#txt-cpf").val(),
        genero:    $('input[name=genero]:checked').val(),
    }
);
var formulario = new Formulario(
    {
        id: 123,
        adjetivos: "string-separada-por-virgula, ex: 1-1, 2-1, 3-1, etc...",
        eDepois: $('input[name=depois-de-salvar]:checked').val(),
    }
);

var FormularioView = Backbone.View.extend({
    el: $("form"),  
    initialize: function(){
        this.render();
    },
    render: function(){
//         this.template = _.template( $("#formulario-template").html(), {} );
//         this.$el.html( this.template );
    },
    events: {
        "click #btn-salvar-dados": "salvar_dados",
        "click #btn-salvar-e":     "salvar_e"
    },
    salvar_dados: function(event) {
        event.preventDefault();
        this.model.prof.save({}, {
            success: function() {
                console.log('profissional salvo com suceso!');
            },
            error: function() {
                console.log('falho ao salvar profissional!');
            }
        });  
    },
    salvar_e: function(event) {
        event.preventDefault();
        this.model.formulario.set(
            {'adjetivos': this.converteCampoAdjetivosEmString($('input[name="adjetivos[]"]'))}
        )
        this.model.formulario.save({}, {
            success: function() {
                console.log('preenchimento salvo com suceso!');
            },
            error: function() {
                console.log('falho ao salvar o preenchimento!');
            }
        });          
    },
    converteCampoAdjetivosEmString: function(ColectionJquery) {
        var adjetivos = [];
        var i = 0;
        for (; i < 66; i++) {
            if (ColectionJquery[i]) {
                if(ColectionJquery[i].value) {
                    adjetivos.push((i+1) + '-' + ColectionJquery[i].value);
                } else {
                    adjetivos.push((i+1) + '-0');
                }
            }
        }
        return adjetivos.join(', ');
    } 
});

// var formulario_view = new FormularioView({model: [prof]});
var formulario_view = new FormularioView(
    {
        model: {
            prof: prof,
            formulario: formulario
        }
    }
);
