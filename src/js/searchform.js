'use strict';

App.View.SearchForm = App.View.extend({
	initialize: function(options) {
        App.View.prototype.initialize.apply(this, [options]);
    },
    className: 'SearchForm',
    element: '#search-form-container',
    template: '#AppViewSearchForm',
    wait: false,
    events: {
    	'submit .search-form' : function(e){
    		let form = this.$el.find(e.currentTarget),
    			HomaPage = $('.HomePage').data('view'),
    			data = form.serialize();
    		Backbone.history.navigate(`?${data}`, {trigger: true});
    	},
    	'change select': function(){
    		this.$el.find('.search-form').trigger('submit');
    	}
    }
});