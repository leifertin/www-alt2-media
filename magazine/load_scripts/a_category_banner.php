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
    	$sql = "SELECT * FROM articles WHERE id = :id";
    	$stmt = $conn->prepare($sql);
    	$stmt->bindParam(':id', $article_id, PDO::PARAM_INT); 
    	$stmt->execute();
		$result = $stmt->fetchAll();

		$total = count($result);
		if($total > 0) {
			foreach($result as $search_row){
    			$output_category = "{$search_row['menu_category']}";
    		}
		} else {
			echo "";
		}
		
	}
}catch (PDOException $e){

}

$conn = null;
?>

<?php
echo('
<div class="w3-row w3-padding alt2-align-cm">
	<div class="w3-col m12">
		<div class="w3-row">
			<picture class="category-banner">
				<source srcset="/magazine/images/category_banners/'. $output_category .'.webp" type="image/webp">
				<img width="100%" src="/magazine/images/category_banners/'. $output_category .'.png">
			</picture>
		</div>
	</div>
</div>
');
?>