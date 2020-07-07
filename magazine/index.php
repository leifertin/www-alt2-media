<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Alt2 Magazine</title>
		<meta name="description" content="Your #1 Source for the Startup Scene in Northern Europe">
		<meta name="keywords" content="alt2, media, magazine, startup, nordic, finland, estonia, latvia, business, innovation">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		
		<!--JS and CSS-->
		<?php include_once("load_scripts/js_and_css.php") ?>
		<!-- Favicon -->
		<?php include_once("load_scripts/favicon.php") ?>
		
	</head>
	
	<body>	
	
	<?php include_once("load_scripts/google_analytics.php") ?>
	<?php include_once("load_scripts/nav_menu.php") ?>
	
	<div >
	<div id="myCarousel" style="margin:2.5% auto 0 auto; max-width:1280px;" class="carousel slide" data-ride="carousel">
		<!-- Indicators -->
		<ol class="carousel-indicators" style="position:absolute; bottom:4px;">
			<?php include("load_scripts/home_image_carousel_bubbles.php") ?>
		</ol>

		<!-- Wrapper for slides -->
		<div class="carousel-inner" style="text-shadow: 6px 6px rgba(0,0,0,0.8);">
			<?php include("load_scripts/home_image_carousel.php") ?>
		</div>

		<!-- Left and right controls -->
		<a class="left carousel-control" style="width:10%;" href="#myCarousel" data-slide="prev">
			<span class="glyphicon glyphicon-chevron-left"></span>
			<span class="sr-only">Previous</span>
		</a>
		<a class="right carousel-control" style="width:10%;" href="#myCarousel" data-slide="next">
			<span class="glyphicon glyphicon-chevron-right"></span>
			<span class="sr-only">Next</span>
		</a>
	</div>	
	</div>
	<?php include_once("load_scripts/footer.php") ?>	
	
	</body>
</html>
