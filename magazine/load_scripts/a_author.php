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
    	$sql = "SELECT author FROM articles WHERE id = :id";
    	$stmt = $conn->prepare($sql);
    	$stmt->bindParam(':id', $article_id, PDO::PARAM_INT); 
    	$stmt->execute();
		$result = $stmt->fetchObject();

		$total = count($result->author);
		if($total > 0) {
			$page_author = ($result->author);
			//echo $page_author;
			if ($page_author != ""){			
				$page_author_text = ("By <a href=\"/magazine/search?q=".$page_author."\"><b>". $page_author."</b></a>");
			}
		} else {
			//echo "";
		}
		
	}
}catch (PDOException $e){
	
	/* Hide error messages except while testing	
	// report error message
	echo $e->getMessage();
	*/
}

$conn = null;
?>