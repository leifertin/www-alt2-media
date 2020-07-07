<?php
function writesearchtitle($search_title){
	echo ('<div style="margin-top:32px;" class="w3-xxlarge w3-hide-small w3-hide-medium">'. $search_title ."</div>\n");
	echo ('<div style="margin-top:16px;" class="w3-large w3-hide-large w3-hide-medium">'. $search_title ."</div>\n");
	echo ('<div style="margin-top:32px;" class="w3-xlarge w3-hide-large w3-hide-small">'. $search_title ."</div>\n");
}
if(isset($_GET['e'])){
	$search_error = $_GET["e"];
	$search_error = (filter_var($search_error, FILTER_SANITIZE_NUMBER_INT));
	
	//echo ('<p style="padding-bottom:32px;"></p>');
	if ($search_error == 1){
		writesearchtitle("Search query too short.");
	} elseif ($search_error == 2) {
		writesearchtitle("Search query too long.");
	} else {
		echo ("<script>window.location = 'https://www.alt2media.eu/magazine/';</script>");
		writesearchtitle("Your search could not be completed.");
	}
	//echo ('</div></div>');
} else {

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
    	
    	//replace spaces in search with wildcard
    	$search_query_wc = str_replace(" ", "%", $search_query);
    	$search_query_wc = "%".$search_query_wc."%";
    	$sql = "SELECT * FROM articles WHERE UPPER(tags) LIKE UPPER(:tagsearch) OR UPPER(title) LIKE UPPER(:titlesearch) OR UPPER(author) LIKE UPPER(:authorsearch) OR UPPER(subtitle) LIKE UPPER(:subtitlesearch) OR UPPER(source) LIKE UPPER(:sourcesearch) OR UPPER(caption) LIKE UPPER(:captionsearch) ORDER BY publish_date DESC";
    	$stmt = $conn->prepare($sql);
    	$stmt->bindParam(':tagsearch', $search_query_wc, PDO::PARAM_STR);
		$stmt->bindParam(':titlesearch', $search_query_wc, PDO::PARAM_STR); 
		$stmt->bindParam(':authorsearch', $search_query_wc, PDO::PARAM_STR);
		$stmt->bindParam(':subtitlesearch', $search_query_wc, PDO::PARAM_STR); 
		$stmt->bindParam(':sourcesearch', $search_query_wc, PDO::PARAM_STR); 
		$stmt->bindParam(':captionsearch', $search_query_wc, PDO::PARAM_STR); 
    	$stmt->execute();
		$search_result = $stmt->fetchAll();
		
		$total = count($search_result);
		
		if ($total < 1){
			writesearchtitle("No results.");
		} else {
			$result_word = "result";
			if ($total != 1){
				$result_word = $result_word."s";
			}
			
			/*main search embed code*/
			writesearchtitle(($total. " search ". $result_word ." for ". $search_query));
			echo '<ul style="margin-top:32px;">'."\n";
			foreach($search_result as $search_row){
				
    			$output_category = "{$search_row['menu_category']}";
    			
    			include("search_and_category_grid.php");
			}
			echo "</ul>\n";
			/*end main search embed code*/
		}
	}
}catch (PDOException $e){
	//
}

$conn = null;

}

?>