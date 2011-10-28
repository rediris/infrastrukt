<!DOCTYPE html>

<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if lt IE 7 ]> <html class="ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]>    <html class="ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]>    <html class="ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--> <html <?php language_attributes(); ?>> <!--<![endif]-->
<head>
	<meta charset="utf-8" />
	
	<!--[if lt IE 9]>
		<link rel="stylesheet" href="stylesheets/ie.css">
	<![endif]-->
		
	<!-- Uncomment to make IE8 render like IE7 -->
	<!-- <meta http-equiv="X-UA-Compatible" content="IE=7" /> -->
	
	<title><?php bloginfo('name'); ?> | <?php is_home() ? bloginfo('description') : wp_title(''); ?></title>
	
	<!-- Set the viewport width to device width for mobile -->
	<meta name="viewport" content="width=device-width" />
	
	<!-- Schema.org Description -->
	<meta itemprop="name" content="">
	<meta itemprop="description" content="">
	  
  	<!-- Setting favicon and Apple Touch Icon -->
  	<link rel="apple-touch-icon" href="<?php bloginfo ("template_url");?>/images/misc/apple-touch-icon.png">
 	<link rel="icon" type="image/png" href="<?php bloginfo ("template_url"); ?>/images/misc/favicon.ico">
	
	<?php wp_enqueue_script('jquery'); ?>
	
	<!-- Included CSS Files -->
	<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>?v=1">
	
	<?php wp_head(); ?>
	
</head>
<body>

	<header role="banner">

		<nav></nav>
	
	</header>