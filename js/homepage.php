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
        		$('#pagination').slideDown();
        		if(self.collection.toJSON()[0].data.hasOwnProperty('movies')){
        			let number = Math.floor(Math.random() * self.collection.toJSON()[0].data.movies.length),
	        			background;
	        		_.forEach(self.collection.toJSON()[0].data.movies, function(movie, key){
	        			if(key === number){
	        				background = movie.large_cover_image;
	        			}
	        		});
	        		$('#search-form-container').css({
			    		'background': `url(${background})`,
			    		'background-size': 'cover',
			    		'background-repeat': 'no-repeat',
			    		'background-position': 'center center'
			    	});
        		} else {
        			App.Render404();
        		}
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
    events: {
    	'click .show-movie-details': function(e){
    		e.preventDefault();
    		Backbone.history.navigate(`movie/${this.$el.find(e.currentTarget).data('id')}`, {trigger: true});
    	}
    },
    renderPagination: function(xhr){
    	let fetchData = this.options.fetchData,
    		pages = Math.floor(xhr.data.movie_count / 20),
    		currentPage = xhr.data.page_number,
    		html = '<div class="col-md-8"><nav aria-label="..." id="pagination"><ul class="pagination justify-content-center">';
    	if(pages > 10){
    		fetchData.page = 1;
    		html += `<li class="page-item"><a class="page-link" href="#?${$.param(fetchData)}">first</a></li>`;
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
    		html += `</nav></div>`;
    	}

    	html += '</ul>';
    	$('#pagination').html(html);
    },
    preRender: function(){
    	const el = $('.SearchForm');
    	_.forEach(this.options.fetchData, function(val, key){
    		el.find(`[name="${key}"]`).val(val);
    	});
    },
    postRender: function(){
    	App.View.prototype.postRender.apply(this);
    	sessionStorage.setItem('goBackURL', window.location.hash);
    }
});

App.Router.HomePage = Backbone.Router.extend({
	routes: {
		'?*': function(params){
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
	},
	initialize: function(){
        Backbone.Router.prototype.initialize.call(this);
    }
});

let HomePage = new App.Router.HomePage();
</script>

<script type="x-tmpl-mustache" id="AppViewHomePage" class="d-none">
	<div class="row justify-content-md-center">
		<h3 class="page-title">{{data.movie_count}} {{movie_word}} found</h3>
	</div>
	<hr class="mb-2">
	<div class="row row-cols-4">
		{{#data.movies}}
		<div class="col-3-md show-movie-details cursor-pointer mb-3" style="text-align:center;" data-id="{{id}}">
			<div class="thumbnail" title="{{title}} Rating: ({{rating}})">
				<img src="{{medium_cover_image}}" class="img-fluid">
				<div>{{title}} ({{rating}})</div>
			</div>
		</div>
		{{/data.movies}}
	</div>
	<a href="#?" style="position: absolute; top:5px; left:5px; color: white;"><span class="fas fa-home fa-4x"></span></a>
</script>