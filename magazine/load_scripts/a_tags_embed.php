<?php
	require("a_tags.php");
	//convert tags to blocks
	
	$output_tags_final = "";
	$output_tags_array = explode(" ", $output_tags);
	$rl_e = count($output_tags_array);
	$rl_s = 0;
	while ($rl_s < $rl_e) {
		$output_tags_final = strval(($output_tags_final."<a href=\"/magazine/search?q=".$output_tags_array[$rl_s]."\"><button type=\"submit\" class=\"w3-button w3-white w3-margin-bottom\"><i class=\"fa fa-hashtag w3-margin-right\"></i>".$output_tags_array[$rl_s]."</button></a>\n"));
				
		$rl_s ++;
	}
	echo strval($output_tags_final);
?>