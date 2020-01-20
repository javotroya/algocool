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
	<a href="#?" style="position: absolute; top:5px; left:5px; color: white;" title="Home">
		<span class="fas fa-home fa-4x"></span>
	</a>
</script>
