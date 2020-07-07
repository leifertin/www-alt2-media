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
    	$sql = "SELECT publish_date FROM articles WHERE id = :id";
    	$stmt = $conn->prepare($sql);
    	$stmt->bindParam(':id', $article_id, PDO::PARAM_INT); 
    	$stmt->execute();
		$result = $stmt->fetchObject();

		$total = count($result->publish_date);
		if($total > 0) {
			$return_publish_date = ($result->publish_date);
		} else {
			echo "";
		}
		
	}
}catch (PDOException $e){
	
	/* Hide error messages except while testing	
	// report error message
	echo $e->getMessage();
	*/
}

$conn = null;

include("return_publish_date.php"); 
	
$return_publish_date = strval($return_publish_day. "." .$return_publish_month.".".$return_publish_year. ", " .$return_publish_time);
	
?>