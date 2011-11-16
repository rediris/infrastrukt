# Foundation, for WordPress

Foundation, for WordPress, is a blank starter theme with the exceptional capabilities of [ZURB's Foundation Framework](http://foundation.zurb.com/) and [HTML5 Boilerplate](http://html5boilerplate.com/).

As a neat-freak designer, it's sometimes intimidating and frustrating looking at a WordPress theme framework that's jam-packed with unnecessary extras and bloated code. That's why I created Foundation, for WordPress, which offers only the necessary essentials to get your site running, with all the jazz of responsive web-design.

"The ability to simplify means to eliminate the unnecessary so that the necessary may speak." ~ Hans Hofmann, Introduction to the Bootstrap, 1993

## Features

Foundation, for WordPress, features everything ZURB's Foundation Framework and HTML5 Boilerplate have to offer, however, some changes have been made to tailer it to WordPress, these include:

* All your common WordPress template files
* Orbit for WordPress, ZURB's image and content slider tailored for WordPress, with the ability to manage your slider through WordPress
* A ySlow score of 95 (in regards to 'Small Site or Blog')
* SEO features such as an optimised Google Analytics snippet, robots.txt and Schema.org attributes
* Beautiful, coda-style tooltips
* Reveal for WordPress, a simple modal box by ZURB made to work in WordPress
* A function to provide Google's jQuery CDN over WordPress' local copy
* Failsafe jQuery, with a fallback to WordPress' local copy

## Download

Clone the git repo - `git clone git://github.com/drewsymo/Foundation.git` - or, [download the archive](https://github.com/drewsymo/Foundation/zipball/master). 

## Snippets

### Orbit, for WordPress

Orbit, for WordPress, is Foundation's awesome slider built to work in WordPress. It allows you to manage your slider images through the backend. Neat, right? 

Just head into your admin panel, and:

* Create a post category named 'Orbit'
* Click the link named 'Orbit' in the left hand side navigation
* Create a new post within that category
* Click 'Featured Image' on the right hand side
* Upload your image and click 'Set as featured image'
* Hit publish, and you're done!

```HTML
<h3>Orbit, for WordPress</h3>
	<div class="row">
		<div class="twelve columns">
			<div id="featured"> 
				<?php sliderContent(); ?>
			</div>
		</div>
	</div>
```

### Tooltips

Tooltips require a trigger and a data container. Just wrap your entire tooltip, including its trigger, in a class called `bubbleInfo`, and create a trigger with a class of `trigger`. 

```HTML
<h3>Tooltips</h3>
<div class="bubbleInfo">
  	<a href="#" class="trigger nice button">Tooltips, anyone?</a>
  		<div class="popup">
   			Just a tooltip!
   			<sub>I'm all CSS3.</sub>
   			<div class="popup-arrow-border"></div>
   			<div class="popup-arrow"></div>
 		</div>
</div>
```

You can view elements of ZURB's Foundation in their [documentation section](http://foundation.zurb.com/docs/). This includes Orbit, Reveal, Tabs etc.

## Authors

**ZURB**

+ Foundation was made by ZURB, an interaction design and design strategy firm in Campbell, CA.
+ Follow [ZURB on Twitter](http://twitter.com/#!/foundationzurb)

**Drew Morris**

+ Drew Morris is a Website Development student currently studying at the Central Institute of Technology in Perth, W.A.
+ Follow [Drew on Twitter](http://www.twitter.com/drewsymo)
+ Follow [Drew on Google +](https://plus.google.com/114153589610660530694?rel=author)
+ View [Drew's Website](http://www.drewsymo.com)

## License

### Foundation, for WordPress

Foundation, for WordPress, is listed under Public Domain.

### Major Components

For more information about the licensing involved with Foundation, for WordPress' major components, please see:

* [ZURB's Foundation Framework](http://foundation.zurb.com/) (MIT Open License)
* [HTML5 Boilerplate](http://html5boilerplate.com/) (Public Domain)

