<?php 
	require_once("load_scripts/newsletter_check.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php

	if ($emailErr != "Invalid email format"){	
		
			require_once("load_scripts/conn_int.php");
			
			$last_action = "NOW();";
			//generate confirmation code
			$characters = '0123456789abcdefghijklmnopqrstuvwxyz';
    		$charactersLength = strlen($characters);
    		$randomString = '';
    		for ($i = 0; $i < 30; $i++) {
        		$randomString .= $characters[rand(0, $charactersLength - 1)];
    		}
			
			function sendmail($email, $randomString){
			// the message
			$msg = "This email is to confirm that you wish to subscribe to the Alt2 Media Magazine newsletter.\n\n<br><br>To continue, follow this link within 24 hours:\n\n<br><br><a href='https://www.alt2media.eu/magazine/confirm_email.php?email=". $email ."&code=". $randomString ."'>Confirm email</a>\n\n<br><br>Otherwise, just ignore this email.";

			// use wordwrap() if lines are longer than 70 characters
			$msg = wordwrap($msg,70);
			
			
			$headers = "MIME-Version: 1.0" . "\r\n";
			$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
			$headers .= 'From: Alt2 Media <info@alt2media.eu>' . "\r\n";
		

			// send email
			mail($email, "Confirm your subscription to the Alt2 Media Magazine newsletter!" ,$msg, $headers);		
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
								//email already confirmed, notify then exit
								echo('
									<script>
    								alert("You are already on our mailing list.");
    								window.history.go(-1);
									</script>
									');
							} else {
								//generate new confirmation code
								
								$sql = "UPDATE newsletter SET code=:code, last_action=:last_action WHERE UPPER(email) = UPPER(:email)";
    							$stmt = $conn->prepare($sql);
    							$stmt->bindParam(':email', $email, PDO::PARAM_STR); 
    							$stmt->bindParam(':code', $randomString, PDO::PARAM_STR);
								$stmt->bindParam(':last_action', $last_action, PDO::PARAM_STR); 
    							$stmt->execute();
								
								//echo "made new code.";
								//email new code
								sendmail($email, $randomString);		
								
								//javascript saying check email
								echo ('
									<script>
    									alert("Please check your email to confirm.");
									</script>	
								');
								//javascript redirect
								echo ('
									<script>
    									window.history.go(-1);
									</script>	
								');				
							}
						}
					} else {
    				
    				//Confirm they want to sign up
					
    				$sql = "INSERT INTO newsletter (email, code, last_action) VALUES (:email, :code, :last_action)";
    				$stmt = $conn->prepare($sql);
    				$stmt->bindParam(':email', $email, PDO::PARAM_STR); 
    				$stmt->bindParam(':code', $randomString, PDO::PARAM_STR);
					$stmt->bindParam(':last_action', $last_action, PDO::PARAM_STR); 
    				$stmt->execute();
					
					sendmail($email, $randomString);
					//javascript saying check email
					echo ('
						<script>
    						alert("Please check your email to confirm.");
						</script>	
						');
					//javascript redirect
					echo ('
						<script>
    						window.history.go(-1);
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
			
	} else {
		//javascript dialog saying bad email
		echo ('
			<script>
    			alert("Invalid email format");
			</script>	
		');
		//javascript redirect
		echo ('
			<script>
    			window.history.go(-1);
			</script>	
		');
	}
	
?>
</head>
<body>
</body>
</html>