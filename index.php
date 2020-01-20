<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>AlgoCool</title>
	<!--[if IE]> <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> <![endif]-->
	<meta name="viewport" content="width=device-width, minimal-ui, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<meta name="description" content="The unofficial YTS YIFY Movies Torrents website. Download free yify movies torrents in 720p, 1080p and 3D quality. The fastest downloads at the smallest size." />
	<meta name="keywords" content="yts, yify, yify movies, yts movies, yts torrents, yify movies, yify torrents" />
	<meta property="og:title" content="The Unofficial Home of YIFY Movies Torrent Download - YTS"/>
	<meta property="og:image" content="http://www.algocool.xyz/img/commando.jpeg"/>
	<meta property="og:description" content="The unofficial YTS YIFY Movies Torrents website. Download free yify movies torrents in 720p, 1080p and 3D quality. The fastest downloads at the smallest size."/>
	<meta property="og:url" content="http://www.algocool.xyz" />
	<!--[if IE]> <meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1" /> <![endif]-->
	<link rel="stylesheet" type="text/css" href="css/lib.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
</head>
<body>
	<div class="jumbotron jumbotron-fluid" id="search-form-container"></div>
	<div class="row justify-content-md-center" id="pagination"></div>
	<div class="loader col justify-content-md-center text-center" id="loader"><span class="fas fa-redo-alt fa-spin fa-4x"></span></div>
	<div class="container-xl" id="main"></div>
	<div id="footer" class="my-3 row">
		<div class="col text-center">
			<p><em>No copyrights of any kind. None of this is ours and we make no profit of it.</em></p>
		</div>
	</div>
	<script type="text/javascript" src="js/lib.js"></script>
	<script type="text/javascript" src="js/app.js"></script>
	<?php require_once 'js/search-form.php'; ?>
	<?php require_once 'js/homepage.php'; ?>
	<?php require_once 'js/movies.php'; ?>
	<script type="text/javascript">
		App.ShowLoader();
		Backbone.history.start({pushState: false});
		Backbone.history.on('route', function(a, b){
			App.ShowLoader();
		});
		if(Backbone.history.fragment === ''){
			Backbone.history.navigate('?', {trigger: true});
		}
	</script>
</body>
</html>