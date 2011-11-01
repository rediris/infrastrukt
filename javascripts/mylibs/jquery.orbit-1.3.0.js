/*
 * jQuery Orbit Plugin 1.3.0
 * www.ZURB.com/playground
 * Copyright 2010, ZURB
 * Free to use under the MIT license.
 * http://www.opensource.org/licenses/mit-license.php
*/


(function(jQuery) {
  
  var ORBIT = {
    
    defaults: {  
      animation: 'horizontal-push', 		// fade, horizontal-slide, vertical-slide, horizontal-push, vertical-push
      animationSpeed: 600, 				// how fast animtions are
      timer: true, 						// true or false to have the timer
      advanceSpeed: 4000, 				// if timer is enabled, time between transitions 
      pauseOnHover: false, 				// if you hover pauses the slider
      startClockOnMouseOut: false, 		// if clock should start on MouseOut
      startClockOnMouseOutAfter: 1000, 	// how long after MouseOut should the timer start again
      directionalNav: true, 				// manual advancing directional navs
      captions: true, 					// do you want captions?
      captionAnimation: 'fade', 			// fade, slideOpen, none
      captionAnimationSpeed: 600, 		// if so how quickly should they animate in
      bullets: false,						// true or false to activate the bullet navigation
      bulletThumbs: false,				// thumbnails for the bullets
      bulletThumbLocation: '',			// location from this file where thumbs will be
      afterSlideChange: jQuery.noop,		// empty function 
      fluid: true,
      centerBullets: true    // center bullet nav with js, turn this off if you want to position the bullet nav manually
 	  },
 	  
 	  activeSlide: 0,
    numberSlides: 0,
    orbitWidth: null,
    orbitHeight: null,
    locked: null,
    timerRunning: null,
    degrees: 0,
    wrapperHTML: '<div class="orbit-wrapper" />',
    timerHTML: '<div class="timer"><span class="mask"><span class="rotator"></span></span><span class="pause"></span></div>',
    captionHTML: '<div class="orbit-caption"></div>',
    directionalNavHTML: '<div class="slider-nav"><span class="right">Right</span><span class="left">Left</span></div>',
    bulletHTML: '<ul class="orbit-bullets"></ul>',
    
    init: function (element, options) {
      var jQueryimageSlides,
          imagesLoadedCount = 0,
          self = this;
      
      // Bind functions to correct context
      this.clickTimer = jQuery.proxy(this.clickTimer, this);
      this.addBullet = jQuery.proxy(this.addBullet, this);
      this.resetAndUnlock = jQuery.proxy(this.resetAndUnlock, this);
      this.stopClock = jQuery.proxy(this.stopClock, this);
      this.startTimerAfterMouseLeave = jQuery.proxy(this.startTimerAfterMouseLeave, this);
      this.clearClockMouseLeaveTimer = jQuery.proxy(this.clearClockMouseLeaveTimer, this);
      this.rotateTimer = jQuery.proxy(this.rotateTimer, this);
      
      this.options = jQuery.extend({}, this.defaults, options);
      if (this.options.timer === 'false') this.options.timer = false;
      if (this.options.captions === 'false') this.options.captions = false;
      if (this.options.directionalNav === 'false') this.options.directionalNav = false;
      
      this.jQueryelement = jQuery(element);
      this.jQuerywrapper = this.jQueryelement.wrap(this.wrapperHTML).parent();
      this.jQueryslides = this.jQueryelement.children('img, a, div');
      
      this.jQueryelement.bind('orbit.next', function () {
        self.shift('next');
      });
      
      this.jQueryelement.bind('orbit.prev', function () {
        self.shift('prev');
      });
      
      this.jQueryelement.bind('orbit.goto', function (event, index) {
        self.shift(index);
      });
      
      this.jQueryelement.bind('orbit.start', function (event, index) {
        self.startClock();
      });
      
      this.jQueryelement.bind('orbit.stop', function (event, index) {
        self.stopClock();
      });
      
      jQueryimageSlides = this.jQueryslides.filter('img');
      
      if (jQueryimageSlides.length === 0) {
        this.loaded();
      } else {
        jQueryimageSlides.bind('imageready', function () {
          imagesLoadedCount += 1;
          if (imagesLoadedCount === jQueryimageSlides.length) {
            self.loaded();
          }
        });
      }
    },
    
    loaded: function () {
      this.jQueryelement
        .addClass('orbit')
        .css({width: '1px', height: '1px'});
        
      this.setDimentionsFromLargestSlide();
      this.updateOptionsIfOnlyOneSlide();
      this.setupFirstSlide();
      
      if (this.options.timer) {
        this.setupTimer();
        this.startClock();
      }
      
      if (this.options.captions) {
        this.setupCaptions();
      }
      
      if (this.options.directionalNav) {
        this.setupDirectionalNav();
      }
      
      if (this.options.bullets) {
        this.setupBulletNav();
        this.setActiveBullet();
      }
    },
    
    currentSlide: function () {
      return this.jQueryslides.eq(this.activeSlide);
    },
    
    setDimentionsFromLargestSlide: function () {
      //Collect all slides and set slider size of largest image
      var self = this,
          jQueryfluidPlaceholder;
          
      self.jQueryelement.add(self.jQuerywrapper).width(this.jQueryslides.first().width());
      self.jQueryelement.add(self.jQuerywrapper).height(this.jQueryslides.first().height());
      self.orbitWidth = this.jQueryslides.first().width();
      self.orbitHeight = this.jQueryslides.first().height();
      jQueryfluidPlaceholder = this.jQueryslides.first().clone();
      
      this.jQueryslides.each(function () {
        var slide = jQuery(this),
            slideWidth = slide.width(),
            slideHeight = slide.height();

        if (slideWidth > self.jQueryelement.width()) {
          self.jQueryelement.add(self.jQuerywrapper).width(slideWidth);
          self.orbitWidth = self.jQueryelement.width();	       			
        }
        if (slideHeight > self.jQueryelement.height()) {
          self.jQueryelement.add(self.jQuerywrapper).height(slideHeight);
          self.orbitHeight = self.jQueryelement.height();
          jQueryfluidPlaceholder = jQuery(this).clone();
	      }
        self.numberSlides += 1;
      });
      
      if (this.options.fluid) {
        if (typeof this.options.fluid === "string") {
          jQueryfluidPlaceholder = jQuery('<img src="http://placehold.it/' + this.options.fluid + '" />')
        }
        
        self.jQueryelement.prepend(jQueryfluidPlaceholder);
        jQueryfluidPlaceholder.addClass('fluid-placeholder');
        self.jQueryelement.add(self.jQuerywrapper).css({width: 'inherit'});
        self.jQueryelement.add(self.jQuerywrapper).css({height: 'inherit'});
        
        jQuery(window).bind('resize', function () {
          self.orbitWidth = self.jQueryelement.width();
          self.orbitHeight = self.jQueryelement.height();
        });
      }
    },
    
    //Animation locking functions
    lock: function () {
      this.locked = true;
    },
    
    unlock: function () { 
      this.locked = false;
    },
    
    updateOptionsIfOnlyOneSlide: function () {
      if(this.jQueryslides.length === 1) {
      	this.options.directionalNav = false;
      	this.options.timer = false;
      	this.options.bullets = false;
      }
    },
    
    setupFirstSlide: function () {
      //Set initial front photo z-index and fades it in
      var self = this;
      this.jQueryslides.first()
      	.css({"z-index" : 3})
      	.fadeIn(function() {
      		//brings in all other slides IF css declares a display: none
      		self.jQueryslides.css({"display":"block"})
      });
    },
    
    startClock: function () {
      var self = this;
      
      if(!this.options.timer) { 
    		return false;
    	} 

    	if (this.jQuerytimer.is(':hidden')) {
        this.clock = setInterval(function () {
          this.jQueryelement.trigger('orbit.next');
        }, this.options.advanceSpeed);            		
    	} else {
        this.timerRunning = true;
        this.jQuerypause.removeClass('active')
        this.clock = setInterval(this.rotateTimer, this.options.advanceSpeed / 180);
      }
    },
    
    rotateTimer: function () {
      var degreeCSS = "rotate(" + this.degrees + "deg)"
      this.degrees += 2;
      this.jQueryrotator.css({ 
        "-webkit-transform": degreeCSS,
        "-moz-transform": degreeCSS,
        "-o-transform": degreeCSS
      });
      if(this.degrees > 180) {
        this.jQueryrotator.addClass('move');
        this.jQuerymask.addClass('move');
      }
      if(this.degrees > 360) {
        this.jQueryrotator.removeClass('move');
        this.jQuerymask.removeClass('move');
        this.degrees = 0;
        this.jQueryelement.trigger('orbit.next');
      }
    },
    
    stopClock: function () {
      if (!this.options.timer) { 
        return false; 
      } else {
        this.timerRunning = false;
        clearInterval(this.clock);
        this.jQuerypause.addClass('active');
      }
    },
    
    setupTimer: function () {
      this.jQuerytimer = jQuery(this.timerHTML);
      this.jQuerywrapper.append(this.jQuerytimer);

      this.jQueryrotator = this.jQuerytimer.find('.rotator');
      this.jQuerymask = this.jQuerytimer.find('.mask');
      this.jQuerypause = this.jQuerytimer.find('.pause');
      
      this.jQuerytimer.click(this.clickTimer);

      if (this.options.startClockOnMouseOut) {
        this.jQuerywrapper.mouseleave(this.startTimerAfterMouseLeave);
        this.jQuerywrapper.mouseenter(this.clearClockMouseLeaveTimer);
      }
      
      if (this.options.pauseOnHover) {
        this.jQuerywrapper.mouseenter(this.stopClock);
      }
    },
    
    startTimerAfterMouseLeave: function () {
      var self = this;

      this.outTimer = setTimeout(function() {
        if(!self.timerRunning){
          self.startClock();
        }
      }, this.options.startClockOnMouseOutAfter)
    },
    
    clearClockMouseLeaveTimer: function () {
      clearTimeout(this.outTimer);
    },
    
    clickTimer: function () {
      if(!this.timerRunning) {
          this.startClock();
      } else { 
          this.stopClock();
      }
    },
    
    setupCaptions: function () {
      this.jQuerycaption = jQuery(this.captionHTML);
      this.jQuerywrapper.append(this.jQuerycaption);
  	  this.setCaption();
    },
    
    setCaption: function () {
      var captionLocation = this.currentSlide().attr('data-caption'),
          captionHTML;
    		
      if (!this.options.captions) {
    		return false; 
    	} 
    	        		
    	//Set HTML for the caption if it exists
    	if (captionLocation) {
    	  captionHTML = jQuery(captionLocation).html(); //get HTML from the matching HTML entity
    		this.jQuerycaption
      		.attr('id', captionLocation) // Add ID caption TODO why is the id being set?
          .html(captionHTML); // Change HTML in Caption 
          //Animations for Caption entrances
        switch (this.options.captionAnimation) {
          case 'none':
            this.jQuerycaption.show();
            break;
          case 'fade':
            this.jQuerycaption.fadeIn(this.options.captionAnimationSpeed);
            break;
          case 'slideOpen':
            this.jQuerycaption.slideDown(this.options.captionAnimationSpeed);
            break;
        }
    	} else {
    		//Animations for Caption exits
    		switch (this.options.captionAnimation) {
          case 'none':
            this.jQuerycaption.hide();
            break;
          case 'fade':
            this.jQuerycaption.fadeOut(this.options.captionAnimationSpeed);
            break;
          case 'slideOpen':
            this.jQuerycaption.slideUp(this.options.captionAnimationSpeed);
            break;
        }
    	}
    },
    
    setupDirectionalNav: function () {
      var self = this;

      this.jQuerywrapper.append(this.directionalNavHTML);
      
      this.jQuerywrapper.find('.left').click(function () { 
        self.stopClock();
        self.jQueryelement.trigger('orbit.prev');
      });
      
      this.jQuerywrapper.find('.right').click(function () {
        self.stopClock();
        self.jQueryelement.trigger('orbit.next');
      });
    },
    
    setupBulletNav: function () {
      this.jQuerybullets = jQuery(this.bulletHTML);
    	this.jQuerywrapper.append(this.jQuerybullets);
    	this.jQueryslides.each(this.addBullet);
    	if (this.options.centerBullets) this.jQuerybullets.css('margin-left', -this.jQuerybullets.width() / 2);
    },
    
    addBullet: function (index, slide) {
      var position = index + 1,
          jQueryli = jQuery('<li>' + (position) + '</li>'),
          thumbName,
          self = this;

  		if (this.options.bulletThumbs) {
  			thumbName = jQuery(slide).attr('data-thumb');
  			if (thumbName) {
          jQueryli
            .addClass('has-thumb')
            .css({background: "url(" + this.options.bulletThumbLocation + thumbName + ") no-repeat"});;
  			}
  		}
  		this.jQuerybullets.append(jQueryli);
  		jQueryli.data('index', index);
  		jQueryli.click(function () {
  			self.stopClock();
  			self.jQueryelement.trigger('orbit.goto', [jQueryli.data('index')])
  		});
    },
    
    setActiveBullet: function () {
      if(!this.options.bullets) { return false; } else {
    		this.jQuerybullets.find('li')
    		  .removeClass('active')
    		  .eq(this.activeSlide)
    		  .addClass('active');
    	}
    },
    
    resetAndUnlock: function () {
      this.jQueryslides
      	.eq(this.prevActiveSlide)
      	.css({"z-index" : 1});
      this.unlock();
      this.options.afterSlideChange.call(this, this.jQueryslides.eq(this.prevActiveSlide), this.jQueryslides.eq(this.activeSlide));
    },
    
    shift: function (direction) {
      var slideDirection = direction;
      
      //remember previous activeSlide
      this.prevActiveSlide = this.activeSlide;
      
      //exit function if bullet clicked is same as the current image
      if (this.prevActiveSlide == slideDirection) { return false; }
      
      if (this.jQueryslides.length == "1") { return false; }
      if (!this.locked) {
        this.lock();
	      //deduce the proper activeImage
        if (direction == "next") {
          this.activeSlide++;
          if (this.activeSlide == this.numberSlides) {
              this.activeSlide = 0;
          }
        } else if (direction == "prev") {
          this.activeSlide--
          if (this.activeSlide < 0) {
            this.activeSlide = this.numberSlides - 1;
          }
        } else {
          this.activeSlide = direction;
          if (this.prevActiveSlide < this.activeSlide) { 
            slideDirection = "next";
          } else if (this.prevActiveSlide > this.activeSlide) { 
            slideDirection = "prev"
          }
        }

        //set to correct bullet
        this.setActiveBullet();  
             
        //set previous slide z-index to one below what new activeSlide will be
        this.jQueryslides
          .eq(this.prevActiveSlide)
          .css({"z-index" : 2});    
            
        //fade
        if (this.options.animation == "fade") {
          this.jQueryslides
            .eq(this.activeSlide)
            .css({"opacity" : 0, "z-index" : 3})
            .animate({"opacity" : 1}, this.options.animationSpeed, this.resetAndUnlock);
        }
        
        //horizontal-slide
        if (this.options.animation == "horizontal-slide") {
          if (slideDirection == "next") {
            this.jQueryslides
              .eq(this.activeSlide)
              .css({"left": this.orbitWidth, "z-index" : 3})
              .animate({"left" : 0}, this.options.animationSpeed, this.resetAndUnlock);
          }
          if (slideDirection == "prev") {
            this.jQueryslides
              .eq(this.activeSlide)
              .css({"left": -this.orbitWidth, "z-index" : 3})
              .animate({"left" : 0}, this.options.animationSpeed, this.resetAndUnlock);
          }
        }
            
        //vertical-slide
        if (this.options.animation == "vertical-slide") { 
          if (slideDirection == "prev") {
            this.jQueryslides
              .eq(this.activeSlide)
              .css({"top": this.orbitHeight, "z-index" : 3})
              .animate({"top" : 0}, this.options.animationSpeed, this.resetAndUnlock);
          }
          if (slideDirection == "next") {
            this.jQueryslides
              .eq(this.activeSlide)
              .css({"top": -this.orbitHeight, "z-index" : 3})
              .animate({"top" : 0}, this.options.animationSpeed, this.resetAndUnlock);
          }
        }
        
        //horizontal-push
        if (this.options.animation == "horizontal-push") {
          if (slideDirection == "next") {
            this.jQueryslides
              .eq(this.activeSlide)
              .css({"left": this.orbitWidth, "z-index" : 3})
              .animate({"left" : 0}, this.options.animationSpeed, this.resetAndUnlock);
            this.jQueryslides
              .eq(this.prevActiveSlide)
              .animate({"left" : -this.orbitWidth}, this.options.animationSpeed);
          }
          if (slideDirection == "prev") {
            this.jQueryslides
              .eq(this.activeSlide)
              .css({"left": -this.orbitWidth, "z-index" : 3})
              .animate({"left" : 0}, this.options.animationSpeed, this.resetAndUnlock);
		        this.jQueryslides
              .eq(this.prevActiveSlide)
              .animate({"left" : this.orbitWidth}, this.options.animationSpeed);
          }
        }
        
        //vertical-push
        if (this.options.animation == "vertical-push") {
          if (slideDirection == "next") {
            this.jQueryslides
              .eq(this.activeSlide)
              .css({top: -this.orbitHeight, "z-index" : 3})
              .animate({top : 0}, this.options.animationSpeed, this.resetAndUnlock);
            this.jQueryslides
              .eq(this.prevActiveSlide)
              .animate({top : this.orbitHeight}, this.options.animationSpeed);
          }
          if (slideDirection == "prev") {
            this.jQueryslides
              .eq(this.activeSlide)
              .css({top: this.orbitHeight, "z-index" : 3})
              .animate({top : 0}, this.options.animationSpeed, this.resetAndUnlock);
		        this.jQueryslides
              .eq(this.prevActiveSlide)
              .animate({top : -this.orbitHeight}, this.options.animationSpeed);
          }
        }
        
        this.setCaption();
      }
    }
  };

  jQuery.fn.orbit = function (options) {
    return this.each(function () {
      var orbit = jQuery.extend({}, ORBIT);
      orbit.init(this, options);
    });
  };

})(jQuery);
        
/*!
 * jQuery imageready Plugin
 * http://www.zurb.com/playground/
 *
 * Copyright 2011, ZURB
 * Released under the MIT License
 */
(function (jQuery) {
  
  var options = {};
  
  jQuery.event.special.imageready = {
    
    setup: function (data, namespaces, eventHandle) {
      options = data || options;
    },
		
		add: function (handleObj) {
		  var jQuerythis = jQuery(this),
		      src;
		      
	    if ( this.nodeType === 1 && this.tagName.toLowerCase() === 'img' && this.src !== '' ) {
  			if (options.forceLoad) {
  			  src = jQuerythis.attr('src');
  			  jQuerythis.attr('src', '');
  			  bindToLoad(this, handleObj.handler);
          jQuerythis.attr('src', src);
  			} else if ( this.complete || this.readyState === 4 ) {
          handleObj.handler.apply(this, arguments);
  			} else {
  			  bindToLoad(this, handleObj.handler);
  			}
  		}
		},
		
		teardown: function (namespaces) {
		  jQuery(this).unbind('.imageready');
		}
	};
	
	function bindToLoad(element, callback) {
	  var jQuerythis = jQuery(element);

    jQuerythis.bind('load.imageready', function () {
       callback.apply(element, arguments);
       jQuerythis.unbind('load.imageready');
     });
	}

}(jQuery));