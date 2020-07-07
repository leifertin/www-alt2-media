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
    	$sql = "SELECT menu_category FROM articles WHERE id = :id";
    	$stmt = $conn->prepare($sql);
    	$stmt->bindParam(':id', $article_id, PDO::PARAM_INT); 
    	$stmt->execute();
		$result = $stmt->fetchObject();

		$total = count($result->menu_category);
		if($total > 0) {
			$output_category = ($result->menu_category);
		} else {
			echo "";
		}
	
    	$output_category = "{$search_row['menu_category']}";
    			
		include("output_category_color.php");		        			
        		
	}
}catch (PDOException $e){
	
}

$conn = null;

?>
