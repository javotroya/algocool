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
    	this.data.goBackURL = sessionStorage.getItem('goBackURL');
    	this.generateMagnet();
    	console.log(this.data);
    	$('#search-form-container').css({
    		'background': `url(${this.data.background_image_original})`,
    		'background-size': 'cover',
    		'background-repeat': 'no-repeat',
    		'background-position': 'top center'
    	});
    	$('#pagination').slideUp();
    },
    listen: 'model',
    generateMagnet: function(){
    	const self = this;
    	let trackers = 'tr=' + [
	    	'udp://open.demonii.com:1337/announce',
	    	'udp://tracker.openbittorrent.com:80',
	    	'udp://tracker.coppersurfer.tk:6969',
	    	'udp://glotorrents.pw:6969/announce',
	    	'udp://tracker.opentrackr.org:1337/announce',
	    	'udp://torrent.gresille.org:80/announce',
	    	'udp://p4p.arenabg.com:1337',
	    	'udp://tracker.leechers-paradise.org:6969'
    	].join('&tr=');
    	console.log(trackers);
    	let torrents = [];
    	_.forEach(this.data.torrents, function(torrent){
    		torrent.magnet = `magnet:?xt=urn:btih:${torrent.hash}&dn=${encodeURI(self.data.title)}&${trackers}`;
    		torrents.push(torrent);
    	});

    	this.data.torrents = torrents;
    }
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
				<span class="badge badge-success badge-pill">
					<a href="#?genre={{.}}" class="text-reset">{{.}}</a>
				</span>
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
							<li><small>Last Update: {{date_uploaded}}</small></li>
						</ul>
						<a class="btn btn-block btn-info" href="{{url}}">Download</a>
						<a class="btn btn-block btn-warning" href="{{magnet}}">Get Magnet</a>
					</div>
				{{/torrents}}
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col">
			<h3>Trailer {{title}}</h3>
			<div class="embed-responsive embed-responsive-16by9">
			  <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/{{yt_trailer_code}}?rel=0&autoplay=0&controls=0" allowfullscreen></iframe>
			</div>
		</div>
	</div>
<a href="{{goBackURL}}" style="position: absolute; top:5px; left:5px; color: white;"><span class="fas fa-arrow-left fa-4x"></span></a>
</script>
