<!DOCTYPE html>

<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7"<?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 8]><!--> <html <?php language_attributes(); ?>> <!--<![endif]-->
<head>
	<meta charset="utf-8" />
	
	<title><?php bloginfo('name'); ?> | <?php is_home() ? bloginfo('description') : wp_title(''); ?></title>
	
	<!-- Set the viewport width to device width for mobile -->
    <meta name="viewport" content="initial-scale=1.6; maximum-scale=1.0; width=device-width; "/>
	
	<!-- Schema.org Description -->
	<meta itemprop="name" content="">
	<meta itemprop="description" content="">
	  
  	<!-- Setting favicon and Apple Touch Icon -->
  	<link rel="apple-touch-icon" href="<?php bloginfo ("template_url");?>/images/misc/apple-touch-icon.png">
 	<link rel="icon" type="image/png" href="<?php bloginfo ("template_url"); ?>/images/misc/favicon.ico">
 	
 	<!-- Apple Developer Options -->
 	<meta name="apple-mobile-web-app-status-bar-style" content="black">
 	<meta name="apple-mobile-web-app-capable" content="yes">
 	  
	<!-- Included CSS Files -->
	<link rel="stylesheet" href="<?php bloginfo ("stylesheet_url"); ?>">

	<!--[if lt IE 9]>
		<link rel="stylesheet" href="stylesheets/ie.css">
	<![endif]-->

	<!-- IE Fix for HTML5 Tags -->
	<!--[if lt IE 9]>
		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	
	<!-- Orbit IE Settings -->
	<!--[if IE]>
    <style type="text/css">
         .timer { display: none !important; }
         div.caption { background:transparent; filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=#99000000,endColorstr=#99000000);zoom: 1; }
    </style>
	<![endif]-->
	
	<?php wp_head(); ?>

</head>
<body>

<!-- Begin Container -->
<div class="container" role="main">

	<!-- Begin Skip Content -->
	<nav class="row">
		<div class="twelve columns hide-on-desktops"><a href="#skipcontent">Skip Content? &darr;</a></div>
	</nav>
	<!-- End Skip Content -->

	<!-- Begin Header -->
	<header class="row">
			<hgroup class="twelve columns">
				<h1><a href="<?php echo home_url( '/' ); ?>" rel="home"><?php bloginfo('name'); ?></a></h1>
				<h4 class="subheader"><?php bloginfo('description'); ?></h4>
			</hgroup>
	</header>
	<!-- End Header -->
	
	<!-- Begin Navigation -->
	<div class="row">
		<nav class="menu twelve columns">
			<?php wp_nav_menu( array( 'theme_location' => 'header-menu') ); ?>
			<hr>
		</nav>
	</div>
	<!-- End Navigation -->
	
	
	