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
?><!DOCTYPE html>
<!--[if lte IE 8]><html class="no-js lt-ie9" <?php language_attributes(); ?> xmlns:fb="http://ogp.me/ns/fb#"><![endif]-->
<!--[if IE 9]><html class="no-js ie9" <?php language_attributes(); ?> xmlns:fb="http://ogp.me/ns/fb#"><![endif]-->
<!--[if gt IE 9]><!--><html class="no-js" <?php language_attributes(); ?> xmlns:fb='http://ogp.me/ns/fb#'><!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" >
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" >
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<div class="off-canvas-wrap" data-offcanvas>
<div class="inner-wrap">
<?php // THREE MENU TYPES TO CHOOSE FROM
  if (get_theme_mod( 'infrastrukt_menu_type' ) == "offcanvas"):
    get_template_part( 'nav', 'offcanvas' );
  endif;
  if (get_theme_mod( 'infrastrukt_menu_type' ) == "topbar"):
    get_template_part( 'nav', 'topbar' );
  endif;
  if (get_theme_mod( 'infrastrukt_menu_type' ) == "sparkletown"):
    get_template_part( 'nav', 'sparkletown' );
  endif;
?>
<?php $header =  get_header_textcolor();
if ( $header !== "blank" ) : ?>
  <div class="site-header content-block" <?php $header_image = get_header_image(); if ( ! empty( $header_image ) ) : ?> style="background-image:url('<?php echo esc_url( $header_image ); ?>');" <?php endif; ?>>
    <div class="row">
      <div class="large-12 columns">
        <h2><a style="color:#<?php header_textcolor(); ?>;" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'description' ); ?></a></h2>
      </div>
    </div>
  </div>
<?php endif; ?>