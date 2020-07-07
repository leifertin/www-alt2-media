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
    	$sql = "SELECT url FROM articles WHERE id = :id";
    	$stmt = $conn->prepare($sql);
    	$stmt->bindParam(':id', $article_id, PDO::PARAM_INT); 
    	$stmt->execute();
		$result = $stmt->fetchObject();
		
		$total = count($result->url);
		if($total > 0) {
			$embed_article_url = ($result->url);
		
		} else {
			echo "";
		}
		
	}
}catch (PDOException $e){

}

$conn = null;
?>
<?php 
   $embed_article_url = strval("/magazine/articles".$embed_article_url."images/720x405featured.jpg");
	$embed_article_url = "https://www.alt2media.eu".$embed_article_url;  
   echo $embed_article_url;  
?>