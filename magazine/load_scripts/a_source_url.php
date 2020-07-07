<?php
if($conn){
		// set the PDO error mode to exception
		$conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    	// prepare sql and bind parameters
    	$sql = "SELECT source_url FROM articles WHERE id = :id";
    	$stmt = $conn->prepare($sql);
    	$stmt->bindParam(':id', $article_id, PDO::PARAM_INT); 
    	$stmt->execute();
		$result = $stmt->fetchObject();

		$total = count($result->source_url);
		if($total > 0) {
			$article_source_url = ($result->source_url);
			if ($article_source_url == ""){
				$article_source_url = "#";
			}
		}
		
	}
?>