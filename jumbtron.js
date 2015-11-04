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

