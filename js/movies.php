<script type="text/javascript">
'use strict';

App.View.Movie = App.View.extend({
	initialize: function(options) {
        App.View.prototype.initialize.apply(this, [options]);
    },
    className: 'Movie',
    element: '#main',
    template: '#AppViewMovie',
    waitFunction: function(model){
    	this.data = model.toJSON().data.movie;
    	$('#search-form-container').css({
    		'background': `url(${this.data.background_image_original})`,
    		'background-size': 'cover',
    		'background-repeat': 'no-repeat',
    		'background-position': 'top center'
    	});
    	$('#pagination').slideUp();
    },
    listen: 'model'
});

App.Router.Movies = Backbone.Router.extend({
	routes: {
		'movie/:id': function(id){
			let model = new App.Model.Movie();
			model.set('id', id);
			let view = new App.View.Movie({
				model: model
			});
			App.Render(view);
			model.fetch();
		}
	},
	initialize: function(){
        Backbone.Router.prototype.initialize.call(this);
    }
});

let Movie = new App.Router.Movies();
</script>

<script type="x-tmpl-mustache" id="AppViewMovie" class="d-none">
	<div class="row text-center">
		<div class="col">
			<h2>{{title}} - {{year}}<sup><small>{{rating}}</small></sup></h2>
			{{#genres}}
				<span class="badge badge-success badge-pill">{{.}}</span>
			{{/genres}}
		</div>
	</div>
	<div class="row row-cols-2">
		<div class="col-md-4">
			<img src="{{large_cover_image}}" class="img-fluid">
		</div>
		<div class="col-md-8">
			{{description_full}}
			<hr>
			<div class="row">
				{{#torrents}}
					<div class="col text-center">
						<ul class="list-unstyled">
							<li>Quality: {{quality}}</li>
							<li>Type: {{type}}</li>
							<li>Size: {{size}}</li>
							<li>Last Update: {{date_uploaded}}</li>
						</ul>
						<a class="btn btn-block btn-info" href="{{url}}">Download</a>
					</div>
				{{/torrents}}
			</div>
		</div>
	</div>
	<div class="row">

	</div>
</script>
