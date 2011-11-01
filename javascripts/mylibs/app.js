/* Make sure you remember to put jQuery into 'no-conflict' mode. This means replacing '$' with 'jQuery'. */

jQuery(document).ready(function() {

	/* Use this js doc for all application specific JS */

	/* TABS --------------------------------- */
	/* Remove if you don't need :) */
	
	var tabs = jQuery('dl.tabs');
		tabsContent = jQuery('ul.tabs-content')
	
	tabs.each(function(i) {
		//Get all tabs
		var tab = jQuery(this).children('dd').children('a');
		tab.click(function(e) {
			
			//Get Location of tab's content
			var contentLocation = jQuery(this).attr("href")
			contentLocation = contentLocation + "Tab";
			
			//Let go if not a hashed one
			if(contentLocation.charAt(0)=="#") {
			
				e.preventDefault();
			
				//Make Tab Active
				tab.removeClass('active');
				jQuery(this).addClass('active');
				
				//Show Tab Content
				jQuery(contentLocation).parent('.tabs-content').children('li').css({"display":"none"});
				jQuery(contentLocation).css({"display":"block"});
				
			} 
		});
	});
	
	
	/* PLACEHOLDER FOR FORMS ------------- */
	/* Remove this and jquery.placeholder.min.js if you don't need :) */
	
	jQuery('input, textarea').placeholder();
	
	
	/* Initialise Orbit ------------- */
	/* Called from Orbit Slider */
	
	jQuery('#featured').orbit();
	
	/* SlideDown ------------- */
	$(".slideContent").hide();
		$(".slideDown").click(function(){
    	$(this).next(".slideContent").slideToggle("slow");
  	});
		
	
});





 