<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>AlgoCool</title>
	<link rel="stylesheet" type="text/css" href="node_modules/bootswatch/dist/darkly/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
</head>
<body>
	<div class="jumbotron jumbotron-fluid">
		<div class="container">
			<form method="post" action="javascript:void(null);" accept-charset="UTF-8">
				<div class="row justify-content-md-center">
					<div class="col-md-8">
						<p class="term">Search Term:</p>
						<input name="keyword" class="form-control" autocomplete="off" type="search">
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
						<select name="rating" class="form-control">
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
						<select name="order_by" class="form-control">
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
	</div>

	<div class="row justify-content-md-center">
		<div class="col-md-8">
			<nav aria-label="..." id="pagination">
				
			</nav>
		</div>
	</div>
	<div class="container-xl" id="main"></div>

	<script type="text/javascript" src="node_modules/jquery/dist/jquery.min.js"></script>
	<script type="text/javascript" src="node_modules/mustache/mustache.min.js"></script>
	<script type="text/javascript" src="node_modules/underscore/underscore-min.js"></script>
	<script type="text/javascript" src="node_modules/backbone/backbone-min.js"></script>
	<script type="text/javascript" src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/main.js"></script>
	<?php require_once 'js/homepage.php'; ?>
	<script type="text/javascript">Backbone.history.start({pushState: false});</script>
</body>
</html>