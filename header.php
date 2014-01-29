<?php
/**
 * Header
 *
 * Setup the header for our theme
 *
 * @package WordPress
 * @subpackage Infrastrukt for WordPress
 * @since Infrastrukt for WordPress 1.0
 */
?>

<!DOCTYPE html>
<!--[if lte IE 8]><html <?php body_class('no-js lt-ie9'); ?> <?php language_attributes(); ?> xmlns:fb="http://ogp.me/ns/fb#"> <![endif]-->
<!--[if IE 9]><html <?php body_class('no-js ie9'); ?> <?php language_attributes(); ?> xmlns:fb="http://ogp.me/ns/fb#"> <![endif]-->
<!--[if gt IE 9]><!--> <html <?php body_class('no-js'); ?> <?php language_attributes(); ?> xmlns:fb='http://ogp.me/ns/fb#'> <!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" >
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<title><?php wp_title('|',true,'right'); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" >
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" >
<?php wp_head(); ?>
</head>
<body>
<div class="off-canvas-wrap">
<div class="inner-wrap">
<?php
/**
 * SETUP TOP BAR CUSTOMIZATION INCLUDE
 */
$infrastrukt_topbar = trailingslashit( get_template_directory() ) . 'inc/topbar.php';
if (file_exists($infrastrukt_topbar)):
	require( $infrastrukt_topbar );
endif;
?>
<div class="nav-wrapper <?php echo $topbar_classes;?>">
	<nav class="top-bar" data-topbar data-options="is_hover:<?php echo $topbar_hover;?>">
		<ul class="title-area">
			<li class="name"><h1><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo('name'); ?></a></h1></li>
			<li class="toggle-topbar menu-icon"><a href="#"><span><?php echo $topbar_menu_title; ?></span></a></li>
		</ul>
		<section class="top-bar-section" role="navigation">
			<?php wp_nav_menu( array( 'theme_location' => 'header-menu', 'menu_class' => 'left', 'container' => '', 'fallback_cb' => 'foundation_page_menu', 'walker' => new foundation_navigation() ) ); ?>
		</section>
	</nav>
</div><!--/.nav-wrapper-->
<?php $header =  get_header_textcolor();
if ( $header !== "blank" ) : ?>
<header class="site-header" <?php $header_image = get_header_image(); if ( ! empty( $header_image ) ) : ?> style="background:url('<?php echo esc_url( $header_image ); ?>');" <?php endif; ?>>
	<div class="row">
		<div class="large-12 columns">
			<h2><a style="color:#<?php header_textcolor(); ?>;" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'description' ); ?></a></h2>
		</div>
	</div>
</header>
<?php endif; ?>