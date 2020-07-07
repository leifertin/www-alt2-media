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
    	$sql = "SELECT caption FROM articles WHERE id = :id";
    	$stmt = $conn->prepare($sql);
    	$stmt->bindParam(':id', $article_id, PDO::PARAM_INT); 
    	$stmt->execute();
		$result = $stmt->fetchObject();

		$total = count($result->caption);
		if($total > 0) {
			$article_caption = ($result->caption);
			$article_caption_sm = (wordwrap($article_caption, 39, "\n", TRUE));
			$article_caption_md = (wordwrap($article_caption, 65, "\n", TRUE));
			$article_caption_lg = $article_caption;
		} else {
			echo "";
		}
		
	}
}catch (PDOException $e){
	
}

$conn = null;
?>