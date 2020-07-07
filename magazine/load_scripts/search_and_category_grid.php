<?php
   $output_tags = "{$search_row['tags']}";
			
	include("output_category_color.php");			
	//convert tags to blocks
	$output_tags_final = "";
	$output_tags_array = explode(" ", $output_tags);
	$output_tags_final = strval($output_tags_array[0]);
			
	$art_url = "{$search_row['url']}";
	$art_id = "{$search_row['id']}";
	$sm_subtitle = "{$search_row['subtitle']}";
	if (strlen($sm_subtitle) > 105){
		$sm_subtitle = substr($sm_subtitle, 0, 105);
		$sm_subtitle = ($sm_subtitle."...");
	}				
	echo('<li>
				<div class="w3-row ">
				<div class="w3-col m5" style="padding-top:16px;">
				<a href="/magazine/article?aid='. $art_id .'">				
					<picture>
						<source srcset="/magazine/articles'. $art_url .'images/720x405featured.webp" type="image/webp">
						<img width="100%" src="/magazine/articles'. $art_url .'images/720x405featured.jpg" alt="">
					</picture>
				</a>
				</div>
				<div class="w3-col m7 w3-left-align" style="padding:16px;">');
    			
    echo ('<span style="text-transform:uppercase;" class="'. $cat_color .'">#'. $output_tags_final. "</span><br>");
    echo ('<a href="/magazine/article?aid='. $art_id .'">');
    echo ("<b>{$search_row['title']}</b></a><br>". '<span class="w3-text-grey">' .$sm_subtitle."</span></a>\n<br>");
    if ("{$search_row['author']}" == "" OR "{$search_row['author']}" == NULL){
    	//no author
    	if ("{$search_row['source']}" == "" OR "{$search_row['source']}" == NULL){
    		//no author or source
    		echo "";
    	} else {
    		//no author yes source
    		echo " From <a href=\"/magazine/search?q={$search_row['source']}\">{$search_row['source']}";
    	}
    } else {
    	echo " By <a href=\"/magazine/search?q={$search_row['author']}\">{$search_row['author']}";
    }
	echo "</a> / ";
    			
   $return_publish_date = "{$search_row['publish_date']}";
	include("return_publish_date.php");   
	$return_publish_date = strval($return_publish_day. "." .$return_publish_month.".".$return_publish_year); 			
    			
   echo $return_publish_date;
   echo "</div></li><br>\n";
?>