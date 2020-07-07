<?php
	require("load_scripts/s_search_check.php");
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Alt2 Magazine - Search Results</title>
		<meta name="description" content="Alt2 Magazine - Search Results">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		
		<!--JS and CSS-->
		<?php include_once("load_scripts/js_and_css.php") ?>
		<!-- Favicon -->
		<?php include_once("load_scripts/favicon.php") ?>
		
	</head>
	<body>
	
	<?php include_once("load_scripts/google_analytics.php") ?>
	<?php include_once("load_scripts/nav_menu.php") ?>
	
	<div class="w3-container" id="article-body-container">	
		<div class="w3-row alt2-align-cm">
			<div class="w3-col m12 w3-medium" >
				<?php include("load_scripts/s_search_embed.php");?>
			</div>
		</div>
		
	</div>
	
	<?php include_once("load_scripts/footer.php") ?>		
	
	</body>
</html>
