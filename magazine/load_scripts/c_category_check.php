<?php
if(isset($_GET['c'])){
    $category_query = ($_GET['c']);
    $category_query = htmlspecialchars_decode($category_query);
    
    if (strlen($category_query) < 6){
    	header('Location: https://www.alt2media.eu/magazine/');
    } else if (strlen($category_query) > 18) {
    	header('Location: https://www.alt2media.eu/magazine/');
    }
}else{
    header('Location: https://www.alt2media.eu/magazine/');
}
?>