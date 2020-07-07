<?php  
   $root_server_path = $_SERVER['DOCUMENT_ROOT'];
   $mag_f = ($root_server_path."/magazine/");
   $load_s_f = ($mag_f."load_scripts/");
  	
  	if(isset($_GET['u'])){
		$search_query = ($_GET['u']);
		$search_query = htmlspecialchars_decode($search_query);
		if ($search_query != "jmedp0x4hzjgp4b1futdtgcp"){
			header('Location: https://www.alt2media.eu/magazine/');
		}
	}else{
		header('Location: https://www.alt2media.eu/magazine/');
	}
	
   require_once($load_s_f."conn_int.php");
	
	//date_default_timezone_set('Europe/Helsinki');
	$last_action = date('Y-m-d H:i:s');
	
			
	try{
		// create a PostgreSQL database connection
		$conn = new PDO($dsn);

		// display a message if connected to the PostgreSQL successfully
		if($conn){
			// set the PDO error mode to exception
			$conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			
			
    		// prepare sql and bind parameters
			$sql = "SELECT * FROM newsletter";
    		$stmt = $conn->prepare($sql);
    		$stmt->execute();    				
    				
    		$search_result = $stmt->fetchAll();
			$total = count($search_result);
		
			if ($total > 0 ){
				//email exists - check if confirmed
				foreach($search_result as $search_row){
					if ("{$search_row['code']}" != "confirmed"){
						//not confirmed, check time
						
						 $timediff = strtotime($last_action) - strtotime("{$search_row['last_action']}");
						$this_row = "{$search_row['id']}";
						
						if($timediff > 86400){ 
							//24hrs old, delete entry
							$sql = "DELETE FROM newsletter WHERE id=:del_id";
    						$stmt = $conn->prepare($sql);
    						$stmt->bindParam(':del_id', $this_row, PDO::PARAM_STR);  
    						$stmt->execute();
    						
    						//echo "deleted row".$this_row."<br>";
						} else {
							// NOT 24hrs old, keep entry
							
						}		
			
					}
				}
				header('Location: https://www.alt2media.eu/magazine/');
			} else {
				//PHP REDIRECT
				header('Location: https://www.alt2media.eu/magazine/');
    		}
		
		}
	}catch (PDOException $e){
	
		//Hide error messages except while testing	
		// report error message
		//echo $e->getMessage();
			
	}

	$conn = null;
	
?>
