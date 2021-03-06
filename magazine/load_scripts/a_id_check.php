<?php
	
if(isset($_GET['aid'])){
   $article_id = ($_GET['aid']);
	if(strlen($article_id) > 10){
    	header('Location: https://www.alt2media.eu/magazine/');
	} else {
		$article_id = filter_var($article_id, FILTER_SANITIZE_NUMBER_INT);
	}	
}else{
    header('Location: https://www.alt2media.eu/magazine/');
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
    	$sql = "SELECT title FROM articles WHERE id = :id";
    	$stmt = $conn->prepare($sql);
    	$stmt->bindParam(':id', $article_id, PDO::PARAM_INT); 
    	$stmt->execute();
		$result = $stmt->fetchObject();
		
		$total = count($result->title);
		if($total > 0) {
			//echo $result->title;
			
		} else {
			
			header('Location: https://www.alt2media.eu/magazine/');
		}
		
	}
}catch (PDOException $e){
	
}

$conn = null;
?>