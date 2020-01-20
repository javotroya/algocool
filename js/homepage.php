<script type="text/javascript">
'use strict';

App.View.HomePage = App.View.extend({
	initialize: function(options) {
        App.View.prototype.initialize.apply(this, [options]);
        const self = this;
        this.collection.fetch({
        	data: options.fetchData,
        	success: function(collection, xhr){
        		self.renderPagination(xhr);
        	}
        });
    },
    className: 'HomePage',
    element: '#main',
    template: '#AppViewHomePage',
    renderPagination: function(xhr){
    	let pages = Math.floor(xhr.data.movie_count / 20),
    		currentPage = xhr.data.page_number,
    		html = '<ul class="pagination justify-content-center">';
    	if(pages > 20){
    		for(var i = 1; i <= 20; i++){
    			html += [
    			`<li class="page-item${currentPage === i ? ' active' : ''}">`,
    				`<a class="page-link" href="#movies/${i}">`,
    					i,
    				`</a>`,
    			`</li>`
    			].join('\n');

    		}
    	}

    	html += '</ul>';
    	$('#pagination').html(html);
    }
});

App.Router.HomePage = Backbone.Router.extend({
	routes: {
		'' : function(){
			let collection = new App.Collection.Movies(),
			view = new App.View.HomePage({
				collection: collection,
				fetchData: {
	        		with_rt_ratings: true
	        	}
			});
			App.Render(view);
		},
		'movies/:page': function(page){
			let collection = new App.Collection.Movies(),
			view = new App.View.HomePage({
				collection: collection,
				fetchData: {
	        		with_rt_ratings: true,
	        		page: page
	        	}
			});
			App.Render(view);
		}
	},
	initialize: function(){
        Backbone.Router.prototype.initialize.call(this);
    }
});

let HomePage = new App.Router.HomePage();
</script>

<script type="x-tmpl-mustache" id="AppViewHomePage" class="d-none">
	<div class="row justify-content-md-center">
		<h3>{{data.movie_count}} Movie(s) found</h3>
	</div>
	<div class="row row-cols-4">
		{{#data.movies}}
		<div class="col-4-md" style="text-align:center;">
			<div class="thumbnail">
				<img src="{{medium_cover_image}}" class="img-responsive">
				<hr>
				<h5>{{title}}</h4>
			</div>
		</div>
		{{/data.movies}}
	</div>
</script>