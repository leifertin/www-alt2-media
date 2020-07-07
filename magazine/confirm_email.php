<?php 
	if(isset($_GET['email']) && isset($_GET['code'])){
   $email = ($_GET['email']);
	$code = ($_GET['code']);
	
	$code = htmlspecialchars_decode($code);
	
	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		header('Location: https://www.alt2media.eu/magazine/');
	}
    
    if (strlen($email) < 3){
    	header('Location: https://www.alt2media.eu/magazine/');
    } else if (strlen($email) > 256) {
    	header('Location: https://www.alt2media.eu/magazine/');
    } else if (strlen($code) > 30){
    	header('Location: https://www.alt2media.eu/magazine/');
    } else if (strlen($code) < 9){
    	header('Location: https://www.alt2media.eu/magazine/');
    } 
	}else{
    header('Location: https://www.alt2media.eu/magazine/');
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>

<?php

	require_once("load_scripts/conn_int.php");
	
	$last_action = "NOW();";
	$redirect_home = 'window.location.href="https://www.alt2media.eu/magazine/";';
	
	function sendmail($email){
		// the message
		$msg = "Thank you for subscribing to the Alt2 Media Magazine newsletter!";

		// use wordwrap() if lines are longer than 70 characters
		$msg = wordwrap($msg,70);
			
		//headers
		$headers .= 'From: Alt2 Media <info@alt2media.eu>' . "\r\n";

		// send email
		mail($email, "Thank you!" ,$msg, $headers);		
	}
	
			
	try{
		// create a PostgreSQL database connection
		$conn = new PDO($dsn);

		// display a message if connected to the PostgreSQL successfully
		if($conn){
			// set the PDO error mode to exception
			$conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    		// prepare sql and bind parameters
			$sql = "SELECT * FROM newsletter WHERE UPPER(email) LIKE UPPER(:email)";
    		$stmt = $conn->prepare($sql);
    		$stmt->bindParam(':email', $email, PDO::PARAM_STR);  
    		$stmt->execute();    				
    				
    		$search_result = $stmt->fetchAll();
			$total = count($search_result);
		
			if ($total > 0 ){
				//email exists - check if confirmed
				foreach($search_result as $search_row){
					if ("{$search_row['code']}" == "confirmed"){
						if ($code == "unsubscribe") {
							//remove from list
							$new_code = "unsubscribe";
							$new_email = "unsubscribe";
							
							$sql = "UPDATE newsletter SET email=:new_email, code=:code, last_action=:last_action WHERE UPPER(email) = UPPER(:email)";
    						$stmt = $conn->prepare($sql);
    						$stmt->bindParam(':email', $email, PDO::PARAM_STR); 
							$stmt->bindParam(':new_email', $new_email, PDO::PARAM_STR); 
    						$stmt->bindParam(':code', $new_code, PDO::PARAM_STR);
							$stmt->bindParam(':last_action', $last_action, PDO::PARAM_STR); 
    						$stmt->execute();
    					
    						//javascript saying confirmed
    						echo('
								<script>
    							alert("You will no longer receive our newsletter.");
    							'.$redirect_home.'
								</script>
							');
    					
    					
						} else {
							//email already confirmed, notify then exit
							echo('
								<script>
    							alert("You are already on our mailing list.");
    							'.$redirect_home.'
								</script>
								');
						}
					} else if ("{$search_row['code']}" == $code) {
						//email is confirmed now change code to confirmed
						$new_code = "confirmed";
						$sql = "UPDATE newsletter SET code=:code, last_action=:last_action WHERE UPPER(email) = UPPER(:email)";
    					$stmt = $conn->prepare($sql);
    					$stmt->bindParam(':email', $email, PDO::PARAM_STR); 
    					$stmt->bindParam(':code', $new_code, PDO::PARAM_STR);
						$stmt->bindParam(':last_action', $last_action, PDO::PARAM_STR); 
    					$stmt->execute();
    					
    					//javascript saying confirmed
    					echo('
							<script>
    						alert("You are now subscribed.");
    						'.$redirect_home.'
							</script>
							');
    					
    					//send email
    					sendmail($email);
    					
					} else {
						//javascript redirect
						echo ('
							<script>
    							'.$redirect_home.'
							</script>	
						');				
					}
				}
			} else {
				//javascript redirect
				echo ('
					<script>
    					'.$redirect_home.'
					</script>	
				');
    				
    		}
		
		}
	}catch (PDOException $e){
	
		//Hide error messages except while testing	
		// report error message
		//echo $e->getMessage();
			
	}

	$conn = null;
	
?>
</head>
<body>
</body>
</html>