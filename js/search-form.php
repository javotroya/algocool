<script type="text/javascript">
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
    	}
    }
});
</script>

<script type="x-tmpl-mustache" id="AppViewSearchForm" class="d-none">
	<div class="container">
		<form method="post" action="javascript:void(null);" accept-charset="UTF-8" class="search-form">
			<div class="row justify-content-md-center mb-3">
				<div class="col-md-7">
					<input name="query_term" class="form-control" autocomplete="off" type="search" placeholder="Search term...">
				</div>
				<div class="col-md-1">
					<button class="btn btn-primary btn-block" type="submit">Search</button>
				</div>
			</div>
			<div class="row justify-content-md-center">
				<div class="col-md-2">
					<p>Quality:</p>
					<select name="quality" class="form-control">
						<option value="all" selected="selected">All</option>
						<option value="720p">720p</option>
						<option value="1080p">1080p</option>
						<option value="3D">3D</option>
					</select>
				</div>
				<div class="col-md-2">
					<p>Genre:</p>
					<select name="genre" class="form-control">
						<option value="all">All</option>
						<option value="action" selected="selected">Action</option>
						<option value="adventure">Adventure</option>
						<option value="animation">Animation</option>
						<option value="biography">Biography</option>
						<option value="comedy">Comedy</option>
						<option value="crime">Crime</option>
						<option value="documentary">Documentary</option>
						<option value="drama">Drama</option>
						<option value="family">Family</option>
						<option value="fantasy">Fantasy</option>
						<option value="film-noir">Film-Noir</option>
						<option value="game-show">Game-Show</option>
						<option value="history">History</option>
						<option value="horror">Horror</option>
						<option value="music">Music</option>
						<option value="musical">Musical</option>
						<option value="mystery">Mystery</option>
						<option value="news">News</option>
						<option value="reality-tv">Reality-TV</option>
						<option value="romance">Romance</option>
						<option value="sci-fi">Sci-Fi</option>
						<option value="sport">Sport</option>
						<option value="talk-show">Talk-Show</option>
						<option value="thriller">Thriller</option>
						<option value="war">War</option>
						<option value="western">Western</option>
					</select>
				</div>
				<div class="col-md-2">
					<p>Rating:</p>
					<select name="minimum_rating" class="form-control">
						<option value="0" selected="selected">All</option>
						<option value="9">9+</option>
						<option value="8">8+</option>
						<option value="7">7+</option>
						<option value="6">6+</option>
						<option value="5">5+</option>
						<option value="4">4+</option>
						<option value="3">3+</option>
						<option value="2">2+</option>
						<option value="1">1+</option>
					</select>
				</div>
				<div class="col-md-2">
					<p>Order By:</p>
					<select name="sort_by" class="form-control">
						<option value="latest" selected="selected">Latest</option>
						<option value="oldest">Oldest</option>
						<option value="seeds">Seeds</option>
						<option value="peers">Peers</option>
						<option value="year">Year</option>
						<option value="rating">Rating</option>
						<option value="likes">Likes</option>
						<option value="alphabetical">Alphabetical</option>
						<option value="downloads">Downloads</option>
					</select>
				</div>
			</div>
		</form>
	</div>
</script>

<script type="text/javascript">
	'use strict';
	App.Render(new App.View.SearchForm());
</script>