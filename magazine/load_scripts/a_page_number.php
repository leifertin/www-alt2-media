<?php
	if (isset($_GET["p"])){ 
		$page_number = $_GET["p"];
		$page_number = (filter_var($page_number, FILTER_SANITIZE_NUMBER_INT));
	}else{
		$page_number = 1;
	}
	include("conn_int.php");
	try{
	// create a PostgreSQL database connection
	$conn = new PDO($dsn);
 
	// display a message if connected to the PostgreSQL successfully
	if($conn){
		// set the PDO error mode to exception
		$conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    	// prepare sql and bind parameters
    	$sql = "SELECT url FROM articles WHERE id = :id";
    	$stmt = $conn->prepare($sql);
    	$stmt->bindParam(':id', $article_id, PDO::PARAM_INT); 
    	$stmt->execute();
		$result = $stmt->fetchObject();
		
		$total = count($result->url);
		$embed_article_data = 0;
		if($total > 0) {
			$embed_article_data = strval($result->url);			
		}
		
	}
}catch (PDOException $e){
	
}

$conn = null;	
	if ($embed_article_data != 0){
		$root_server_path = $_SERVER['DOCUMENT_ROOT'];
   	$ea_path = $root_server_path."/magazine/articles".$embed_article_data."article". $page_number .".php";
		if(!file_exists($ea_path)) {
  			//file not found, revert to page one
  			$page_number = 1;
  			$r_url = strval(("https://www.alt2media.eu/magazine/article?aid=". $article_id));
  			header('Location: '.$r_url);
		} 
	}
?>
