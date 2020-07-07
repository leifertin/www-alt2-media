<?php
	require("conn_int.php");

try{
	// create a PostgreSQL database connection
	$conn = new PDO($dsn);
 
	include("a_source_url.php");
	// display a message if connected to the PostgreSQL successfully
	
	if($conn){
		// set the PDO error mode to exception
		$conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    	// prepare sql and bind parameters
    	$sql = "SELECT source FROM articles WHERE id = :id";
    	$stmt = $conn->prepare($sql);
    	$stmt->bindParam(':id', $article_id, PDO::PARAM_INT); 
    	$stmt->execute();
		$result = $stmt->fetchObject();

		$total = count($result->source);
		if($total > 0) {
			$article_source = ($result->source);
			if ($article_source != "") {
				//echo ("/ Source: ".$article_source);
				$page_source_text = ("<br>Source: <a href=\"".$article_source_url."\"><b>". $article_source."</b></a>");
			}
		} else {
			//echo "";
		}
		
	}
}catch (PDOException $e){

}

$conn = null;
?>