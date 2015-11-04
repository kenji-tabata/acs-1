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