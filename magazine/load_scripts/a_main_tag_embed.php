<?php
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
    	$sql = "SELECT * FROM articles WHERE id = :id";
    	$stmt = $conn->prepare($sql);
    	$stmt->bindParam(':id', $article_id, PDO::PARAM_INT); 
    	$stmt->execute();
		$result = $stmt->fetchAll();

		$total = count($result);
		if($total > 0) {
			
			foreach($result as $search_row){
    			$output_category = "{$search_row['menu_category']}";
    			$output_tags = "{$search_row['tags']}";
    		}
			
			include("output_category_color.php");		
			
			//convert tags to blocks
			$output_tags_final = "";
			$output_tags_array = explode(" ", $output_tags);
			//$rl_e = (count($output_tags_array))-1;
			$rl_s = 0;
			while ($rl_s < 1) {
				$output_tags_final = strval(($output_tags_final."<a href=\"/magazine/search?q=".$output_tags_array[$rl_s]."\"><div class=\"alt2-button w3-large w3-margin-bottom ". $cat_color ."\" style=\"font-weight:bold; padding:0 2px 0 2px; text-transform: uppercase;\">#".$output_tags_array[$rl_s]."</div></a>\n"));
				
				$rl_s ++;
			}
			echo strval($output_tags_final);
		} else {
			echo "";
		}
		
	}
}catch (PDOException $e){

}

$conn = null;
?>