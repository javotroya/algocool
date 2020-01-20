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

App.ShowLoader = function(){
	$('#loader').show();
	$('#main').hide();
};

App.HideLoader = function(){
	$('#loader').hide();
	$('#main').show();
};

App.View = Backbone.View.extend({
	initialize: function(options) {
        let self = this;
        _.bindAll(this, 'render');
        this.options = options || {};
        if (!_.isUndefined(this.options.model)) {
            this.model = this.options.model;
        }
        this.postRender = this.postRender || function(){};
        this.preRender = this.preRender || function(){};
        this.render = _.wrap(this.render, function (render) {
        	self.preRender();
        	render();
        	if(!this.wait){
        		self.postRender();
        	}
            return self;
        });
    },
    wait: this.wait || true,
    preRender: function(){},
    render: function() {
    	let self = this, 
    		template = $(this.template).html();
    	if(this.wait){
    		this.listenTo(this[this.listen], 'sync', function(data){
    			if(_.isFunction(self.waitFunction)){
    				self.waitFunction(data);
    			} else {
    				self.data = self[this.listen].toJSON();
    				if(!_.isUndefined(self.data[0])){
    					self.data = self.data[0];
    				}
    			}
    			self.$el.html(Mustache.render(template, self.data));
    			$(self.element).html(self.el);
    			self.postRender();
    		});
    	} else {
    		self.$el.html(Mustache.render(template, self.data));
    		$(this.element).html(this.el);
    		App.HideLoader();
    	}
    	return this;
    },
    listen: 'collection',
    postRender: function(){
    	this.delegateEvents(this.events);
    	$(this.el).data('view', this);
    	App.HideLoader();
    }
});

App.Model.Movie = Backbone.Model.extend({
	url: function(){
		return `https://yts.lt/api/v2/movie_details.json?movie_id=${this.id}`
	}
});

App.Collection.Movies = Backbone.Collection.extend({
    model: App.Model.Movie,
    url: 'https://yts.lt/api/v2/list_movies.json'
});