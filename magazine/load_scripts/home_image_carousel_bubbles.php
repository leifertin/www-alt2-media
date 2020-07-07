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
    	
    	$sql = "SELECT menu_category FROM articles ORDER BY publish_date DESC LIMIT 50";
    	$stmt = $conn->prepare($sql);
    	$stmt->execute();
		$search_result = $stmt->fetchAll();
		
		$total = count($search_result);
		
		if ($total < 1){
			echo "Unable to load images.";
		} else {
			$i_repeat = 0;
			$used_cat = "";
			$bubble_count = 0;
			
			foreach($search_result as $search_row){
				if ($bubble_count == 5){
					break;
				}
				$current_cat = "{$search_row['menu_category']}";
								
				if (strpos($used_cat, ('?'.$current_cat.'?')) !== FALSE) {
 					//echo 'Found it';
				} else {
					
 					if ($i_repeat == 0){
						echo ('<li data-target="#myCarousel" class="active" ');
					} else {
						echo ('<li data-target="#myCarousel" ');
					}

    				$output_category = "{$search_row['menu_category']}";
    			
					include("output_category_color_hex.php");	
						        			
        			echo ('data-slide-to="'. $bubble_count .'" style="background: '.$cat_color .';"></li>');	
        			$used_cat .= "?"."{$search_row['menu_category']}"."?";
        			$bubble_count ++;
				}        		
				$i_repeat ++;	
    		}
    		
		}
	}
}catch (PDOException $e){
	
}

$conn = null;

?>
