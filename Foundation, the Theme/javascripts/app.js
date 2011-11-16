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


	/* DISABLED BUTTONS ------------- */
	/* Gives elements with a class of 'disabled' a return: false; */
	
	jQuery('#featured').orbit({
     	animation: 'horizontal-push',                  // fade, horizontal-slide, vertical-slide, horizontal-push
	     animationSpeed: 800,                // how fast animtions are
	     timer: true, 			 // true or false to have the timer
	     advanceSpeed: 4000, 		 // if timer is enabled, time between transitions 
	     pauseOnHover: false, 		 // if you hover pauses the slider
	     startClockOnMouseOut: false, 	 // if clock should start on MouseOut
	     startClockOnMouseOutAfter: 1000, 	 // how long after MouseOut should the timer start again
	     directionalNav: true, 		 // manual advancing directional navs
	     captions: true, 			 // do you want captions?
	     captionAnimation: 'fade', 		 // fade, slideOpen, none
	     captionAnimationSpeed: 800, 	 // if so how quickly should they animate in
	     bullets: true,			 // true or false to activate the bullet navigation
	     bulletThumbs: true,		 // thumbnails for the bullets
	     bulletThumbLocation: '',		 // location from this file where thumbs will be
	     afterSlideChange: function(){} 	 // empty function 
	
	});



});