<?php
if(isset($_POST['e'])){
   $email = ($_POST['e']);
   $emailErr = "";
	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		$emailErr = "Invalid email format"; 
	}
    
   if (strlen($email) < 3){
    	$emailErr = "Invalid email format"; 
   } else if (strlen($email) > 256) {
   	$emailErr = "Invalid email format"; 
   }
}else{
    header('Location: https://www.alt2media.eu/magazine');
}
?>