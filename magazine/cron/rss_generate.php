<?php  
   $root_server_path = $_SERVER['DOCUMENT_ROOT'];
   $mag_f = ($root_server_path."/magazine/");
   $rss_f = ($mag_f."rss/");
   $load_s_f = ($mag_f."load_scripts/");
   
   
   if(isset($_GET['u'])){
		$search_query = ($_GET['u']);
		$search_query = htmlspecialchars_decode($search_query);
		if ($search_query != "uyjgk84z32mle0gsnga6b9vvbqvgbn"){
			header('Location: https://www.alt2media.eu/magazine/');
		}
	}else{
		header('Location: https://www.alt2media.eu/magazine/');
	}
  
   require_once($load_s_f."conn_int.php");

	$output_xml = ('<?xml version="1.0" encoding="UTF-8" ?>
<rss version="2.0">
<channel>
	<title>Alt2 Media Magazine</title>
	<link>https://www.alt2media.eu/magazine/</link>
	<description>A magazine exploring the startup scene in Northern Europe.</description>
	<language>en-us</language>
	<image>
		<url>https://www.alt2media.eu/rss-icon.gif</url>
		<title>Alt2 Media Magazine</title>
		<link>https://www.alt2media.eu/magazine/</link>
	</image>
	<category>Business</category>');

	//start dynamic content
try{
	// create a PostgreSQL database connection
	$conn = new PDO($dsn);
 
	// display a message if connected to the PostgreSQL successfully
	if($conn){
		// set the PDO error mode to exception
    	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    	// prepare sql and bind parameters
    	
    	
    	$sql = "SELECT * FROM articles ORDER BY publish_date DESC";
    	$stmt = $conn->prepare($sql);
    	$stmt->execute();
		$search_result = $stmt->fetchAll();
		
		$total = count($search_result);
		
		if ($total < 1){
			//echo "Ain't nothing here.";
		} else {
			//$output_xml = $rss_header."\n";
			$output_xml = ($output_xml. "\n	<pubdate>". date(DATE_RSS). "</pubdate>\n");
			foreach($search_result as $search_row){
    			$output_xml = ($output_xml. "\n	<item>\n");
    			$output_xml = ($output_xml. "		<title>{$search_row['title']}</title>\n");
    			$output_xml = ($output_xml. "		<link>https://www.alt2media.eu/magazine/article?aid={$search_row['id']}</link>\n");
				$output_xml = ($output_xml. "		<description>{$search_row['subtitle']}</description>\n");
				$output_xml = ($output_xml. "		<pubdate>". date(DATE_RSS, strtotime( "{$search_row['publish_date']}" )). "</pubdate>\n");
				$this_tags = ("{$search_row['tags']}");
				
				$this_tags = explode(", ", $this_tags);
				$loop_i = 0;
				$output_tags = "";
				while($loop_i < (count($this_tags)-1)) {
					$output_tags = ($output_tags. "		<category>" .$this_tags[$loop_i]. "</category>\n");
					$loop_i ++;
				}				
				 
				$output_xml = ($output_xml. $output_tags);
    			
    			$output_xml = ($output_xml. "	</item>\n");
    			
			}
			$output_xml = ($output_xml."</channel>\n</rss>");
			
		}
	}
}catch (PDOException $e){
	
	/* Hide error messages except while testing	
	// report error message
	echo $e->getMessage();
	*/
}

$conn = null;


//output xml to file
$feed_file = fopen($rss_f."feed.xml", "w");
fwrite($feed_file, $output_xml);
fclose($feed_file);

header('Location: https://www.alt2media.eu/magazine/');

?>