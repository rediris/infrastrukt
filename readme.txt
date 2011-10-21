This theme serves as a back-bone for your next WordPress project. It contains a bunch of scripts and CSS sourced from the Foundation framework for rapid prototyping. 

Foundation for WordPress, 1.0

It's fast, with a YSlow score of 95, it gZips all of your components. It makes little HTTP requests as most of the JS is bundled in one file (plugins.js).

It's simple, with absolutely nothing but a fresh canvas to start on, it's perfect for your next WordPress project. The only elements that have been added are simple HTML5 semantics, such as <header>, <nav>, <footer>, and a wrapper - also, just a little bit of grid demonstration to head you in the right direction.

It's ready to rock, with HTML5 Boilerplate built in, and ZURB's Foundation Framework, it's ready to go. I'm not kidding, this thing is deadly.

There are a few things you should note:

* In using wp_head(), WordPress places most of it's JS files up the top of the page. I've placed all other JS components in the footer for fast loading. The site doesn't use WordPress' own jQuery, instead, it uses Googles CDN (this was achieved through functions.php).

* You'll need to plugin your Google Analytics key in the footer section, you'll see the comment - the snippet I'm using is based on a faster, more optimised version of the snippet. 

* It's absolutely vital you use the .htaccess provided within the 'server' folder. Place this in your root server directory, and rename it to: .htaccess.

In the future: 

* I'll be converting all the CSS files to LESS.. Because LESS is awesome. I'm just scared Foundation will roll out a massive CSS update making mine redundant. 

* I'll be adding roll-back jQuery support if the CDN fails. 

Happy coding,

Drew



