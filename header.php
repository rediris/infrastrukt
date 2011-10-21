<!DOCTYPE html>

<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if lt IE 7 ]> <html class="ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]>    <html class="ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]>    <html class="ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--> <html <?php language_attributes(); ?>> <!--<![endif]-->
<head>
	<meta charset="utf-8" />
	
	<!--[if lt IE 9]>
		<link rel="stylesheet" href="public/css/ie.css">
	<![endif]-->
	
	<!-- Uncomment to make IE8 render like IE7 -->
	<!-- <meta http-equiv="X-UA-Compatible" content="IE=7" /> -->
	
	<!-- Set the viewport width to device width for mobile -->
	<meta name="viewport" content="width=device-width" />
	
	<title><?php bloginfo('name'); ?> | <?php is_home() ? bloginfo('description') : wp_title(''); ?></title>
  
 	<link rel="icon" type="image/png" href="<?php bloginfo ("template_url"); ?>/images/misc/favicon.ico">
  
	<!-- Included CSS Files -->
	<link rel="stylesheet" href="<?php bloginfo( 'stylesheet_url' ); ?>">
	
	<?php wp_head(); ?>
	
</head>
<body>

	<header>
	
		<nav class="row">
		
		</nav>
	
	</header>