<?php echo ('
	<noscript>Please enable javascript to properly view this site.</noscript>
	<script src="/magazine/js/nav-functions.js"></script>	
	
	<div class="w3-row w3-black">
		<div class="w3-row" style="margin-top:8px; margin-bottom: 24px;">
			<div class="w3-medium" id="search-div2" style="display:none; padding-top:8px;">
				<form action="/magazine/search" method="get">
  					<p class="w3-hide-small" style="margin:8px 0 4px 0;">Search:</p>
  					<input type="text" maxlength="89" id="search-bar" name="q" placeholder="search..." value="'. htmlspecialchars($search_query). '">
				</form>
			</div>
			<div class="w3-medium" id="newsletter-div2" style="display:none; padding-top:8px;">
				<form action="/magazine/newsletter_submit.php" method="post">
  					<p class="w3-hide-small" style="margin:8px 0 4px 0;">Sign up for the newsletter:</p>
  					<input type="text" maxlength="255" id="search-bar" name="e" placeholder="your email">
				</form>
			</div>
		</div>
		
		<div class="w3-row w3-xlarge" style="margin-bottom: 8px;">
			<div id="search-div1" style="padding-bottom:16px; margin-right:24px; display:inline;">
				<i class="fa fa-search" aria-hidden="true" title="Search the magazine"></i>
			</div>
			<div id="newsletter-div1" style="padding-bottom:16px; margin-right:24px; display:inline;">
				<i class="fa fa-envelope" aria-hidden="true" title="Sign up for the newsletter"></i>
			</div>
			<div id="suggest-div1" style="padding-bottom:16px; margin-right:24px; display:inline;">
				<i class="fa fa-hand-paper-o" aria-hidden="true" title="Take a survey"></i>
			</div>
			<div id="rss-div1" style="padding-bottom:16px; display:inline;">
				<i class="fa fa-rss" aria-hidden="true" title="Subscribe to the RSS feed"></i>
			</div>
		</div>
	</div>
	




	<!-- Navbar (large) -->
	<div class="w3-hide-small" id="myNavbar">
  			<div class="w3-row" style="margin:16px 0 -24px 0;">
    				<a href="/magazine/">
						<img class="w3-hide-medium" src="./images/logo.svg" type="image/svg" height="75" width="100%" alt="Alt2 Logo"/>
						<img class="w3-hide-large" src="./images/logo.svg" type="image/svg" height="50" width="100%" alt="Alt2 Logo"/>
					</a>
			</div><br>
			
			
			<div class="w3-hide-medium w3-row w3-medium" style=" margin-bottom: 8px;">
    			<a href="/magazine/category?c=Business" class="nav-menu-item" style="padding:2px 6px;"><div class="alt2-nav-button alt2-border-lblue nav-business">Business</div></a>
				<a href="/magazine/category?c=Entrepreneurship" class="nav-menu-item" style="padding:2px 6px;"><div class="alt2-nav-button alt2-border-lgreen nav-entrepreneurship">Entrepreneurship</div></a>
				<a href="/magazine/category?c=Finance" class="nav-menu-item" style="padding:2px 6px;"><div class="alt2-nav-button alt2-border-lorange nav-finance">Finance</div></a>
				<a href="/magazine/category?c=Innovation" class="nav-menu-item" style="padding:2px 6px;"><div class="alt2-nav-button alt2-border-lred nav-innovation">Innovation</div></a>
				<a href="/magazine/category?c=Technology" class="nav-menu-item" style="padding:2px 6px;"><div class="alt2-nav-button alt2-border-lpink nav-technology">Technology</div></a>
  			</div>
  			
  			
			<div class="w3-hide-large w3-row w3-small" style=" margin-bottom: 8px;">
    			<a href="/magazine/category?c=Business" class="nav-menu-item" style="padding:2px 6px;"><div class="alt2-nav-button alt2-border-lblue nav-business">Business</div></a>
				<a href="/magazine/category?c=Entrepreneurship" class="nav-menu-item" style="padding:2px 6px;"><div class="alt2-nav-button alt2-border-lgreen nav-entrepreneurship">Entrepreneurship</div></a>
				<a href="/magazine/category?c=Finance" class="nav-menu-item" style="padding:2px 6px;"><div class="alt2-nav-button alt2-border-lorange nav-finance">Finance</div></a>
				<a href="/magazine/category?c=Innovation" class="nav-menu-item" style="padding:2px 6px;"><div class="alt2-nav-button alt2-border-lred nav-innovation">Innovation</div></a>
				<a href="/magazine/category?c=Technology" class="nav-menu-item" style="padding:2px 6px;"><div class="alt2-nav-button alt2-border-lpink nav-technology">Technology</div></a>
  			</div>
  			
	</div>
	
	
	
	
	<!-- Navbar (small) -->
	<div class="w3-hide-large w3-hide-medium" id="myNavbar">
		<div class="w3-row alt2-align-cm" style="padding-bottom:24px;">
    		<a href="/magazine/">
				<img src="./images/logo.svg" height="50" width="100%" alt="Alt2 Logo"/>
			</a>
		</div>	
		<div id="drop-down-nav" style="cursor:pointer;">
			<div id="drop-down-nav1" style="margin-top:16px;">
			
			<hr class="hr-hamburger alt2-lblue">
			<hr class="hr-hamburger alt2-lgreen">
			<hr class="hr-hamburger alt2-lorange">
			<hr class="hr-hamburger alt2-lred">
			<hr class="hr-hamburger alt2-lpink">			
			</div>
			<div class="w3-row w3-large alt2-align-cm" id="drop-down-nav2" style="margin-bottom: 32px; margin-top:-8px; display:none;">
    			<ul>
    				<li class="alt2-align-cm">
    					<a href="/magazine/category?c=Business" class="nav-menu-item"><div class="alt2-nav-button alt2-border-lblue nav-business">Business</div></a>
    				</li>
    				<li class="alt2-align-cm">
						<a href="/magazine/category?c=Entrepreneurship" class="nav-menu-item"><div class="alt2-nav-button alt2-border-lgreen nav-entrepreneurship">Entrepreneurship</div></a>
					</li>
					<li class="alt2-align-cm">
						<a href="/magazine/category?c=Finance" class="nav-menu-item"><div class="alt2-nav-button alt2-border-lorange nav-finance">Finance</div></a>
					</li>
					<li class="alt2-align-cm">
						<a href="/magazine/category?c=Innovation" class="nav-menu-item"><div class="alt2-nav-button alt2-border-lred nav-innovation">Innovation</div></a>
					</li>
					<li class="alt2-align-cm">
						<a href="/magazine/category?c=Technology" class="nav-menu-item"><div class="alt2-nav-button alt2-border-lpink nav-technology">Technology</div></a>
					</li>
				</ul>
			</div>
		</div>
	</div>   
   ');
   
?>
