<?php
$return_publish_date = explode(".", $return_publish_date);
$return_publish_date = $return_publish_date[0];
$return_publish_date = substr($return_publish_date, 0, -3);
	
$return_publish_date = explode(" ", $return_publish_date);
$return_publish_time = strval($return_publish_date[1]);
$return_publish_date = strval($return_publish_date[0]);
	
$return_publish_date = explode("-", $return_publish_date);	
$return_publish_day = $return_publish_date[2];
$return_publish_month = $return_publish_date[1];
$return_publish_year = $return_publish_date[0];
	
$return_publish_date = strval($return_publish_day. "." .$return_publish_month.".".$return_publish_year); 
?>