<?php
	require_once("load_scripts/c_category_check.php");
	require_once("load_scripts/s_search_check_not_req.php");
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Alt2 Magazine - <?php echo $category_query; ?></title>
		<meta name="description" content="Alt2 Magazine - <?php echo $category_query; ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		
		<!--JS and CSS-->
		<?php include_once("load_scripts/js_and_css.php") ?>
		<!-- Favicon -->
		<?php include_once("load_scripts/favicon.php") ?>
		
	</head>
	<body>
	
	<?php include_once("load_scripts/google_analytics.php") ?>
	<?php include_once("load_scripts/nav_menu.php") ?>
	<?php include("load_scripts/c_category_embed.php");?>
	<?php include_once("load_scripts/footer.php") ?>		
	
	</body>
</html>
