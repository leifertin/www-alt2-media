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
    	
    	$sql = "SELECT * FROM articles ORDER BY publish_date DESC LIMIT 50";
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
						echo ('<div class="item active">');
					} else {
						echo ('<div class="item">');
					}
				
					$picture_url = strval("/magazine/articles{$search_row['url']}images/1280x720featured.");				
					$article_id = "{$search_row['id']}";
					$article_title = "{$search_row['title']}";
				
					echo ('
					<a href="article?aid='. $article_id .'">
					<picture>
						<source srcset="'. $picture_url .'webp" type="image/webp">
						<img width="100%" src="'. $picture_url .'jpg" alt="">
					</picture>
				
					<div class="carousel-caption" style="margin-bottom:12px;">
        				<p style="padding:4px;" class="w3-hide-small w3-xlarge">'. $article_title .'</p>
        				');
        			
    				$output_category = "{$search_row['menu_category']}";
    			
					include("output_category_color.php");			        			
        		
        			$main_tag = "{$search_row['tags']}";
					$main_tag = explode(" ", $main_tag);
					$main_tag = strval($main_tag[0]);
        			
        			echo ('<p><span style="text-transform:uppercase; padding:4px; background-color:black;" class="w3-large '. $cat_color .'">#'. $main_tag .'</span></p> ');
        			echo('</div>
      			</a>
				</div>');
					$bubble_count ++;
        			$used_cat .= "?"."{$search_row['menu_category']}"."?";
        		}
        		$i_repeat ++;
    		}
		}
	}
}catch (PDOException $e){
	
}

$conn = null;

?>
