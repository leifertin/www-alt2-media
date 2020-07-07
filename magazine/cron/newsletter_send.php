<?php

$this_month = date('F');
$this_year = date('Y');
	
function sendmail($to, $this_month, $this_year, $message){
	
	
	$subject = "Alt2 Magazine Newsletter - ".$this_month." ".$this_year;
	//$message = "go";

	// Always set content-type when sending HTML email
	$headers = "MIME-Version: 1.0" . "\r\n";
	$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

	// More headers
	$headers .= 'From: Alt2 Media <info@alt2media.eu>' . "\r\n";
	//$headers .= 'Cc: myboss@example.com' . "\r\n";

	mail($to,$subject,$message,$headers);
}

$root_server_path = $_SERVER['DOCUMENT_ROOT'];
$mag_f = ($root_server_path."/magazine/");
$load_s_f = ($mag_f."load_scripts/");

$news_file = ("newsletter/" .$this_year ."/" .$this_month. "/current.html");
$news_file_lp = ($mag_f.$news_file);

if(file_exists($news_file_lp)) {
	$news_read = file_get_contents(__DIR__ . '/../' . $news_file);


	if(isset($_GET['u'])){
		$search_query = ($_GET['u']);
		$search_query = htmlspecialchars_decode($search_query);
		if ($search_query != "1dvmf2d3xck1g4wfkfh8bklbkr9yuh"){
			header('Location: https://www.alt2media.eu/magazine/');
		}
	}else{
		header('Location: https://www.alt2media.eu/magazine/');
	}
	
	require_once($load_s_f."conn_int.php");

	try{
		// create a PostgreSQL database connection
		$conn = new PDO($dsn);
 
		// display a message if connected to the PostgreSQL successfully
		if($conn){
			// set the PDO error mode to exception
			$conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
			$code = "confirmed";
    		// prepare sql and bind parameters
			$sql = "SELECT * FROM newsletter WHERE code=:code";
    		$stmt = $conn->prepare($sql);
    		$stmt->bindParam(':code', $code, PDO::PARAM_STR);  
    		$stmt->execute();    				
    				
    		$search_result = $stmt->fetchAll();
			$total = count($search_result);
		
			if ($total > 0 ){
				//email exists - check if confirmed
				foreach($search_result as $search_row){				
					$mailing_list = "{$search_row['email']}";
					sendmail($mailing_list, $this_month, $this_year, $news_read);
				}
			}
		
		}
	}catch (PDOException $e){
			
	}
	$conn = null;
}else{
	header('Location: https://www.alt2media.eu/magazine/');
}

?>