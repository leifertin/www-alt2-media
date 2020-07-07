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
    	$sql = "SELECT edited_date FROM articles WHERE id = :id";
    	$stmt = $conn->prepare($sql);
    	$stmt->bindParam(':id', $article_id, PDO::PARAM_INT); 
    	$stmt->execute();
		$result = $stmt->fetchObject();

		$total = count($result->edited_date);
		if($total > 0) {
			$return_edited_date = ($result->edited_date);
		} else {
			//echo "";
		}
		
	}
}catch (PDOException $e){

}

$conn = null;
?>
<?php
	if($return_edited_date != "") {
		$return_edited_date = explode(".", $return_edited_date);
		$return_edited_date = $return_edited_date[0];
		$return_edited_date = substr($return_edited_date, 0, -3);
	
		$return_edited_date = explode(" ", $return_edited_date);
		$return_edited_time = strval($return_edited_date[1]);
		$return_edited_date = strval($return_edited_date[0]);
	
		$return_edited_date = explode("-", $return_edited_date);	
		$return_edited_day = $return_edited_date[2];
		$return_edited_month = $return_edited_date[1];
		$return_edited_year = $return_edited_date[0];
	
		$return_edited_date = strval($return_edited_day. "." .$return_edited_month. ".".$return_edited_year. ", " .$return_edited_time);
	
	}
	//echo $return_edited_date;
	
?>