<?php
   $root_server_path = $_SERVER['DOCUMENT_ROOT'];
   $embed_article_path = $root_server_path."/magazine/articles".$embed_article_data."article". $page_number .".php";
	if(!file_exists($embed_article_path)) {
  		//file not found, revert to page one
  		$page_number = 1;
	}  
	$embed_article_path = $root_server_path."/magazine/articles".$embed_article_data."article". $page_number .".php";
	include($embed_article_path);
   
   $guess_next_page = ($root_server_path."/magazine/articles".$embed_article_data."article". ($page_number+1) .".php");
   $guess_prev_page = ($root_server_path."/magazine/articles".$embed_article_data."article". ($page_number-1) .".php");
   
   echo ('<div class="alt2-align-cm" style="margin-top:32px;">');
   
   if(file_exists($guess_prev_page)) {
  		//there is a previous page
  		
  		if ($page_number == 2){
  			$prev_page = ('article?aid='. $article_id);
  		} else {
  			$prev_page = ('article?aid='. $article_id .'&p='. ($page_number-1).'#read');
  		}
  		echo ('<a href="'. $prev_page .'"><i class="w3-large fa fa-chevron-left" aria-hidden="true"></i> '. ($page_number-1) .'</a>&nbsp;..');
  		
	}
	
   if(file_exists($guess_next_page)) {
  		//there is a next page
  		echo ('..&nbsp;<a href="article?aid='. $article_id .'&p='. ($page_number+1) .'#read"> '. ($page_number+1) .' <i class="w3-large fa fa-chevron-right" aria-hidden="true"></i></a>');
	}
	
	echo ('</div>');
?>
