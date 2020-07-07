<?php
if(isset($_GET['q'])){
	$search_query = ($_GET['q']);
	$search_query = htmlspecialchars_decode($search_query);
	if(!isset($_GET['e'])){
		if (strlen($search_query) < 4){
    		header('Location: https://www.alt2media.eu/magazine/search?e=1&q='.$search_query);
    	} else if (strlen($search_query) > 89) {
    		header('Location: https://www.alt2media.eu/magazine/search?e=2&q='.$search_query);
    	}
	}
} else {
	header('Location: https://www.alt2media.eu/magazine/');
}
?>