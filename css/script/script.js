// JavaScript Document

$(function() {
		
			$("#slideshow > div:gt(0)").hide();
	
			setInterval(function() { 
			  $('#slideshow > div:first')
			    .fadeOut(300)
			    .next()
			    .fadeIn(500)
			    .end()
			    .appendTo('#slideshow');
			},  2000);
			
		});