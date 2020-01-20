<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>AlgoCool</title>
	<link rel="stylesheet" type="text/css" href="node_modules/bootswatch/dist/darkly/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
</head>
<body>
	<div class="jumbotron jumbotron-fluid" id="search-form-container"></div>

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
	<script type="text/javascript" src="node_modules/jquery-deparam/jquery-deparam.js"></script>
	<script type="text/javascript" src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/main.js"></script>
	<?php require_once 'js/search-form.php'; ?>
	<?php require_once 'js/homepage.php'; ?>
	<script type="text/javascript">Backbone.history.start({pushState: false});</script>
</body>
</html>