<?php
function writesearchtitle($search_title){
	echo ('<div style="margin-top:64px;" class="w3-xxlarge w3-hide-small w3-hide-medium">'. $search_title ."</div>\n");
	echo ('<div style="margin-top:32px;" class="w3-large w3-hide-large w3-hide-medium">'. $search_title ."</div>\n");
	echo ('<div style="margin-top:64px;" class="w3-xlarge w3-hide-large w3-hide-small">'. $search_title ."</div>\n");
}

require("conn_int.php");

try{
	// create a PostgreSQL database connection
	$conn = new PDO($dsn);
 
	// display a message if connected to the PostgreSQL successfully
	if($conn){
		// set the PDO error mode to exception
		$conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    	// prepare sql and bind parameters
    	
    	//$category_query_wc = "%".$category_query."%";
		$category_query_wc = $category_query;
    	$sql = "SELECT * FROM articles WHERE menu_category LIKE :categorysearch ORDER BY publish_date DESC";
    	$stmt = $conn->prepare($sql);
    	$stmt->bindParam(':categorysearch', $category_query_wc, PDO::PARAM_STR);
    	$stmt->execute();
		$search_result = $stmt->fetchAll();
		
		$total = count($search_result);
			
		if ($total < 1){
			
			echo('
		<div class="w3-container" id="article-body-container">	
		<div class="w3-row alt2-align-cm">
			<div class="w3-col m12 w3-medium" >');
			
			writesearchtitle("Either this category does not exist, or no articles have been added to this category.");
			
			
		} else {
			include_once("load_scripts/c_category_banner.php");
			
			echo('
		<div class="w3-container" id="article-body-container">	
		<div class="w3-row alt2-align-cm">
			<div class="w3-col m12 w3-medium" >');
			
			/*main search embed code*/
			writesearchtitle("");
			echo '<ul style="margin-top:32px;">'."\n";
			foreach($search_result as $search_row){
				
    			$output_category = $category_query;
    			
    			include("search_and_category_grid.php");
			}
			echo "</ul>\n";
			/*end main search embed code*/			
			
		}
		
		echo ("
			</div>
		</div>
		</div>");
	}
}catch (PDOException $e){

}

$conn = null;

?>