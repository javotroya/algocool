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
			<p class="my-4">You might like:</p>
			<div class="row row-cols-4" id="movie-recommendation">
				
			</div>
		</div>
	</div>
	<div class="row my-3">
		<div class="col">
			<h3>Trailer {{title}}</h3>
			<div class="embed-responsive embed-responsive-16by9">
			  <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/{{yt_trailer_code}}?rel=0&autoplay=0&controls=0" allowfullscreen></iframe>
			</div>
		</div>
	</div>
<a href="{{goBackURL}}" style="position: absolute; top:5px; left:5px; color: white;"><span class="fas fa-arrow-left fa-4x"></span></a>
</script>
