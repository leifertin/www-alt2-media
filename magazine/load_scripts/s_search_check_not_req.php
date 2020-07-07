
<?php
if(isset($_GET['q'])){
    $search_query = ($_GET['q']);
    $search_query = htmlspecialchars_decode($search_query);
}else{
    $search_query = "";
}

?>