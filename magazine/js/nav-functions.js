$(function(){
	$("#rss-div1").click(function() {
   	window.location = "https://www.alt2media.eu/magazine/rss/feed";
   });
   $("#suggest-div1").click(function() {
   	window.location = "https://goo.gl/forms/XGVGAU7Xhi5dyIMM2";
   });
	
   
   $('#drop-down-nav1').click(function (e) {
		
		//toggle this row
		$('#drop-down-nav2').slideToggle();
		e.preventDefault();
		
	});
	
   $('#search-div1').click(function (e) {
		
		//hide newsletter		
		if($('#newsletter-div2').is(':visible')) { $('#newsletter-div2').slideToggle(); }
		
		//toggle this row
		$('#search-div2').slideToggle();
		e.preventDefault();
		
	});
	
	$('#newsletter-div1').click(function (e) {
		
		//hide search				
		if($('#search-div2').is(':visible')) { $('#search-div2').slideToggle(); }
		
		//toggle this row
		$('#newsletter-div2').slideToggle();
		e.preventDefault();
		
	});
	
});

