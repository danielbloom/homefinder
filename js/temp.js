


var app = {}; // create namespace for our app

    app.Home = Backbone.Model.extend({
      defaults: {
        type: 'single family home',
        bed: 1,
        price: 100
      }
    });

    app.HomeList = Backbone.Collection.extend({
      model: app.Home
    });

    var home = new app.Home();
    var homes = new app.HomeList();

//console.log(homes);
homes.add(home);
//console.log(homes);
//var homes = '[{type: "Daniel", bed: 1, price: 100}]';
    var AppView = Backbone.View.extend({
      // el - stands for element. Every view has a element associate in with HTML 
      //      content will be rendered.
      el: '#container',
     
      template: _.template($("#houses").html()),
      // It's the first function called when this view it's instantiated.
      initialize: function(){
        console.log(this.collection);
        this.render();
      },
      // $el - it's a cached jQuery object (el), in which you can use jQuery functions 
      //       to push content. Like the Hello World in this case.
      render: function(){
        console.log(this.coll.toJSON());
        this.$el.html(this.template({homes: this.collection.toJSON()}));
      }
    });


<% _.each(homes, function(home) { %>
      <tr>
        <td><%= home.get('type') %></td>
        <td><%= home.get('bed') %></td>
        <td><%= home.get('price') %></td>
      </tr>
    <% }); %>