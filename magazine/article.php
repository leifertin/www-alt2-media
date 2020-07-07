<?php
	require_once("load_scripts/a_id_check.php");
	include_once("load_scripts/a_this_article.php");
	include_once("load_scripts/a_author.php");
	include_once("load_scripts/a_edited_date.php");
	include_once("load_scripts/a_publish_date.php");
	include_once("load_scripts/s_search_check_not_req.php");
	include_once("load_scripts/a_source.php");
	include_once("load_scripts/a_subtitle.php");
	include_once("load_scripts/a_page_number.php");
	include_once('load_scripts/a_tags.php');
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Alt2 Magazine - <?php require_once("load_scripts/a_title.php");?></title>
		<meta name="description" content="<?php echo $article_subtitle;?>">
		<meta name="keywords" content="<?php echo $out_tags_comma; ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta property="og:image" content="<?php require_once('load_scripts/a_preview_pic.php'); ?>" />		
		
		<!--JS and CSS-->
		<?php include_once("load_scripts/js_and_css.php") ?>
		<!-- Favicon -->
		<?php include_once("load_scripts/favicon.php") ?>
		
	</head>
	
	<body>
	
	<?php include_once("load_scripts/google_analytics.php") ?>
	<?php include_once("load_scripts/nav_menu.php") ?>
	<?php include_once("load_scripts/a_category_banner.php") ?>	
	
	<div class="w3-container" id="article-body-container">
		
		<div style="<?php if($page_number != 1){echo 'display:none;';} ?>" class="w3-row w3-padding alt2-align-cm">
			<div class="w3-col m12">
				<div class="w3-row w3-medium w3-left-align">
					<?php require_once("load_scripts/a_main_tag_embed.php"); ?>
				</div>
				<!--title-->
				<div class="w3-row w3-left-align" style="padding: 2px 8px 2px 0px;">
					<span class="w3-xxxlarge w3-hide-small article-title">
						<?php echo $article_title; ?>
					</span>
					<span class="w3-xxlarge w3-hide-medium w3-hide-large article-title">
						<?php echo $article_title; ?>
					</span>
				</div>
				<div class="w3-row w3-left-align">
					<span class="w3-large w3-text-black">
						<?php echo $article_subtitle; ?>
					</span>
				</div>
				<br>
				<div class="w3-row w3-left-align">
					<span class="w3-large w3-text-black">
						<?php echo $page_author_text; ?>				
					</span>
				</div>
				<div class="w3-row w3-left-align">
					<span class="w3-medium w3-text-black">
						<i>Published: <?php echo $return_publish_date;
							if ($return_publish_date != $return_edited_date){
								if($return_edited_date != "") {
									echo (" / Edited: ". $return_edited_date);
								}
							}
							?>						
					<?php echo $page_source_text; ?> / <a href="#comments">Comments &nbsp;<i class="fa fa-caret-down" aria-hidden="true"></i></a></i>
					</span>
				</div>
			</div>

		</div>
		<div style="<?php if($page_number != 1){echo 'display:none;';} ?>" class="w3-row w3-padding alt2-align-cm">
			<div class="w3-col m12">
				<div class="w3-row">
					<picture>
  						<source srcset="<?php require_once('load_scripts/a_featured_pic_webp.php'); ?>" type="image/webp">
  						<img width="100%" src="<?php require_once('load_scripts/a_featured_pic.php'); ?>" alt="">
					</picture>
				</div>
			</div>
		</div>
		
		<?php require_once("load_scripts/a_caption.php"); ?>
				
		<div style="<?php if($page_number != 1){echo 'display:none;';} ?>" class="w3-row w3-padding alt2-align-cm">
			<div class="w3-col m12 w3-black w3-left-align w3-padding" id="picture-caption">
				<span class="w3-small w3-text-white w3-hide-large w3-hide-medium">
					<i><?php echo $article_caption_sm; ?></i>
				</span>
				<span class="w3-small w3-text-white w3-hide-small w3-hide-large">
					<i><?php echo $article_caption_md; ?></i>
				</span>
				<span class="w3-medium w3-text-white w3-hide-small w3-hide-medium">
					<i><?php echo $article_caption_lg; ?></i>
				</span>
			</div>
		</div>
		<div id="read" class="w3-row w3-padding alt2-align-cm" style="margin-top: 8px;">
			<div class="w3-col m12 w3-left-align" style="line-height:32px;">
				<!--Left align for mobile-->
				<span class="w3-hide-large w3-hide-medium w3-large w3-text-black">
					<?php include("load_scripts/a_embed.php"); ?>
				</span>
				<!--Justify for desktop-->				
				<span class="w3-hide-small w3-large w3-text-black w3-justify">
					<?php include("load_scripts/a_embed.php"); ?>
				</span>
			</div>
		</div>
		<div class="w3-row w3-padding alt2-align-cm">
			<div class="w3-col m12">
				<hr>
			</div>
		</div>

		
		<?php include_once("load_scripts/a_share_color.php") ?>
		<!--Social-->
		<div class="w3-row w3-padding alt2-align-cm">
			<div class="w3-xxlarge w3-col m12 w3-text-black" style="margin-top:-16px;">
				Share<br>
			<a href="<?php echo	('https://www.facebook.com/sharer/sharer.php?u='.$this_article_url); ?>"><i class="w3-xxxlarge <?php echo $cat_color; ?> fa fa-facebook-square" aria-hidden="true"></i></a>
			<a href="<?php echo	('https://twitter.com/home?status='.$this_article_url); ?>"><i class="w3-xxxlarge <?php echo $cat_color; ?> fa fa-twitter-square" aria-hidden="true"></i></a>
				
			<?php
				//generate LinkedIn share
				$this_article_url_linkedin = ("https://www.linkedin.com/shareArticle?mini=true&url=") . $this_article_url . ("&title=". rawurlencode($article_title) ."&summary=". rawurlencode($article_subtitle). "&source=Alt2%20Media");
			?>	
			<a href="<?php echo	($this_article_url_linkedin); ?>"><i class="w3-xxxlarge <?php echo $cat_color; ?> fa fa-linkedin-square" aria-hidden="true"></i></a>	
			
			<a href="<?php echo ('mailto:'.('?&subject=Alt2 Magazine - '.$article_title.'&body=https://www.alt2media.eu/magazine/article?aid=3'));?>"><i class="w3-xxxlarge <?php echo $cat_color; ?> fa fa-envelope-square" aria-hidden="true"></i></a>			
				</div>

		</div>
		
		
		<div class="w3-row w3-padding alt2-align-cm">
			<div class="w3-col m12 w3-left-align w3-text-black">
				<b>Tags</b>
				<p></p>
				<span class="w3-medium">
					<?php require_once("load_scripts/a_tags_embed.php"); ?>
				</span>
			</div>
		</div>
		<div class="w3-row w3-padding alt2-align-cm">
			<div class="w3-col m12">
				<hr>
			</div>
		</div>
		<div class="w3-row w3-padding alt2-align-cm" id="comments">
			<div class="w3-col m12 w3-left-align">
				<span class="w3-medium w3-text-black">
					<!--comments-->
					<div id="disqus_thread"></div>
					<script>
						var disqus_config = function () {
							this.page.url = '<?php echo $this_article_url; ?>';  
						};
						(function() {
							var d = document, s = d.createElement('script');
							s.src = 'https://alt2media.disqus.com/embed.js';
							s.setAttribute('data-timestamp', +new Date());
							(d.head || d.body).appendChild(s);
						})();
					</script>
					<noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
				</span>
			</div>
		</div>				
	</div>
	
	<?php include_once("load_scripts/footer.php") ?>	
		
	<script id="dsq-count-scr" src="//alt2media.disqus.com/count.js" async></script>
	
	
	</body>
</html>
