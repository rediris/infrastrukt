<?php

/**
 * Top Bar Setup
 *
 * Setup theme customization options for Foundation's Top Bar Navigation
 *
 * @package WordPress
 * @subpackage Infrastrukt for WordPress
 * @since Infrastrukt for WordPress 1.0
 */

$topbar_classes = get_theme_mod( 'topbar_position' );
$topbar_menu_title = get_theme_mod( 'set_menu_title' );
if (get_theme_mod( 'contain_to_grid' ) == 1):
	if ($topbar_classes == '' || $topbar_classes == null):
		$topbar_classes = 'contain-to-grid';
	else:
		$topbar_classes = $topbar_classes . ' contain-to-grid';
	endif;
endif;
if (get_theme_mod( 'clickable_menu' ) == 1): 
	$topbar_hover = 'false';
else:
	$topbar_hover = 'true';
endif;
?>