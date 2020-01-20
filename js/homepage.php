<script type="text/javascript">
'use strict';

App.View.HomePage = App.View.extend({
	initialize: function(options) {
        App.View.prototype.initialize.apply(this, [options]);
        const self = this;
        this.collection.fetch({
        	data: this.options.fetchData,
        	success: function(collection, xhr){
        		self.renderPagination(xhr);
        	}
        });
    },
    waitFunction: function(collection){
    	let response = collection.toJSON()[0];
    	response.movie_word = response.movie_count === 1 ? 'Movie' : 'Movies';
    	this.data = response;
    },
    className: 'HomePage',
    element: '#main',
    template: '#AppViewHomePage',
    renderPagination: function(xhr){
    	let fetchData = this.options.fetchData,
    		pages = Math.floor(xhr.data.movie_count / 20),
    		currentPage = xhr.data.page_number,
    		html = '<ul class="pagination justify-content-center">';
    	if(pages > 10){
    		html += `<li class="page-item"><a class="page-link" href="#?">first</a></li>`;
    		let n = currentPage > 10 ? currentPage - 5 : 1,
    			target = n + 10;
    		for(let i = n; i <= target; i++){
    			if(i < pages){
    				fetchData.page = i;
    				html += [
	    			`<li class="page-item${currentPage === i ? ' active' : ''}">`,
	    				`<a class="page-link" href="#?${$.param(fetchData)}">`,
	    					i,
	    				`</a>`,
	    			`</li>`
	    			].join('\n');
    			}
    		}
    		fetchData.page = pages;
    		html += `<li class="page-item"><a class="page-link" href="#?${$.param(fetchData)}">last</a></li>`;
    	}

    	html += '</ul>';
    	$('#pagination').html(html);
    },
    postRender: function(){
    	_.forEach(this.options.fetchData, function(key, val){
    		console.log(key, val);
    	});
    }
});

App.Router.HomePage = Backbone.Router.extend({
	routes: {
		'?*': 'HomePage'
	},
	initialize: function(){
        Backbone.Router.prototype.initialize.call(this);
    },
    HomePage: function(params){
    	let filterParams = params || {};
    	if(_.size(params) > 0){
            filterParams = $.deparam(params);
        }
        filterParams.with_rt_ratings = true;
		let collection = new App.Collection.Movies(),
		view = new App.View.HomePage({
			collection: collection,
			fetchData: filterParams
		});
		App.Render(view);
	}
});

let HomePage = new App.Router.HomePage();
</script>

<script type="x-tmpl-mustache" id="AppViewHomePage" class="d-none">
	<div class="row justify-content-md-center">
		<h3>{{data.movie_count}} {{movie_word}} found</h3>
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