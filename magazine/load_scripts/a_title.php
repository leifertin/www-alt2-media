<?php
	require_once("conn_int.php");

try{
	// create a PostgreSQL database connection
	$conn = new PDO($dsn);
 
	// display a message if connected to the PostgreSQL successfully
	if($conn){
		// set the PDO error mode to exception
		$conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    	// prepare sql and bind parameters
    	$sql = "SELECT title FROM articles WHERE id = :id";
    	$stmt = $conn->prepare($sql);
    	$stmt->bindParam(':id', $article_id, PDO::PARAM_INT); 
    	$stmt->execute();
		$result = $stmt->fetchObject();
		
		$total = count($result->title);
		if($total > 0) {
			$article_title = ($result->title);
			echo $article_title;
		} else {
			echo "";
		}	
	}
}catch (PDOException $e){

}

$conn = null;
?>