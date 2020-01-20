'use strict';

let App = {
	Template: {},
	Model: {},
	Collection: {},
	View: {},
	Router: {},
	Render: {},
	Clear: {}
};

App.Render = (view, element) => {
    element = element || view.element || '#main';
    let classList = $(element + ' > [class]');
    _.each(classList, (index) => {
        let dataView = $('.' + index.className).data('view');
        if (!_.isUndefined(dataView)) {
            App.Clear(dataView);
        }
    });
    $(element).html(view.el);
    view.render();
};

App.Clear = function (view) {
    if (!_.isUndefined(view)) {
        view.onClose = view.onClose || function () {
            };

        view.onClose();
        if (view.rivets) {
            view.rivets.unbind();
        }
        view.unbind(); // Unbind all local event bindings

        if (view.model) {
            view.model.unbind('change', view.render, view); // Unbind reference to the model
        }

        if (view.collection) {
            view.collection.unbind('change', view.render, view); // Unbind reference to the model
        }

        view.remove(); // Remove view from DOM

        delete view.$el; // Delete the jQuery wrapped object variable
        delete view.el; // Delete the variable reference to view node
    }
};

App.View = Backbone.View.extend({
	initialize: function(options) {
        let self = this;
        _.bindAll(this, 'render');
        this.postRender = this.postRender || function(){};
        this.preRender = this.preRender || function(){};
        this.render = _.wrap(this.render, function (render) {
        	self.preRender();
        	render();
            self.postRender();
            return self;
        });
        $(this.el).data('view', this);
    },
    wait: this.wait || true,
    preRender: function(){},
    render: function() {
    	let self = this, 
    		template = $(this.template).html();
    	if(this.wait){
    		this.listenTo(this.collection, 'sync', function(collection){
    			if(_.isFunction(self.waitFunction)){
    				self.waitFunction(collection);
    			} else {
    				self.data = self.collection.toJSON()[0];
    			}
    			self.$el.html(Mustache.render(template, self.data));
    			$(self.element).html(self.el);
    		});
    	} else {
    		self.$el.html(Mustache.render(template, self.data));
    		$(this.element).html(this.el);
    	}
    	return this;
    },
    postRender: function(){}
});

App.Model.Movie = Backbone.Model.extend({
	url: `https://yts.lt/api/v2/movie_details.json?movie_id=${this.id}`
});

App.Collection.Movies = Backbone.Collection.extend({
    model: App.Model.Movie,
    url: 'https://yts.lt/api/v2/list_movies.json'
});