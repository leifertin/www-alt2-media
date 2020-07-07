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
    	$sql = "SELECT author_folder FROM articles WHERE id = :id";
    	$stmt = $conn->prepare($sql);
    	$stmt->bindParam(':id', $article_id, PDO::PARAM_INT); 
    	$stmt->execute();
		$result = $stmt->fetchObject();
		
		$total = count($result->author_folder);
		if($total > 0) {
			$embed_author_url = ($result->author_folder);
		
		} else {
			echo "";
		}
		
	}
}catch (PDOException $e){
	
}

$conn = null;

$embed_author_url = strval("/magazine/authors/".$embed_author_url."/profile.jpg");
echo $embed_author_url;
?>