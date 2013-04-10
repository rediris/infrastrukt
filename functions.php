<?php

/**
 * Functions
 *
 * Core functionality and initial theme setup
 *
 * @package WordPress
 * @subpackage Foundation, for WordPress
 * @since Foundation, for WordPress 4.0
 */

/**
 * Initiate Foundation, for WordPress
 */

function foundation_setup() {

	// Language Translations
	load_theme_textdomain( 'foundation', get_template_directory() . '/languages' );

	// Custom Editor Style Support
	add_editor_style();

	// Support for Featured Images
	add_theme_support( 'post-thumbnails' ); 

	// Automatic Feed Links & Post Formats
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'post-formats', array( 'aside', 'image', 'link', 'quote', 'status' ) );

	// Custom Background
	add_theme_support( 'custom-background', array(
		'default-color' => 'FFFFFF',
	) );

	// Custom Header
	add_theme_support( 'custom-header', array(
		'width'         => 980,
		'height'        => 60,
		'default-image' => get_template_directory_uri() . '/images/header.jpg',
		'uploads'       => true,
	) );

}
add_action( 'after_setup_theme', 'foundation_setup' );

/**
 * Enqueue Scripts and Styles for Front-End
 */

function foundation_assets() {

	if (!is_admin()) {

		wp_deregister_script('jquery');

		// Load JavaScripts
		wp_enqueue_script( 'foundation', get_template_directory_uri() . '/js/foundation.min.js', array(), '4.0', true );
		wp_enqueue_script( 'modernizr', get_template_directory_uri().'/js/vendor/custom.modernizr.js', '2.1.0' );

		// Load Stylesheets
		wp_enqueue_style( 'normalize', get_template_directory_uri().'/css/normalize.css' );
		wp_enqueue_style( 'foundation', get_template_directory_uri().'/css/foundation.min.css' );
		wp_enqueue_style( 'app', get_stylesheet_uri(), array('foundation') );

		// Load Google Fonts API
		wp_enqueue_style( 'google-fonts', 'http://fonts.googleapis.com/css?family=Open+Sans:400,300' );
	
	}

}

add_action( 'wp_enqueue_scripts', 'foundation_assets' );

/**
 * Enqueue Zepto JS with jQuery Fallback
 */

function zeptojs () {
	echo "document.write('<script src=' +"
	echo "('__proto__' in {} ? '".get_template_directory_uri()."/js/vendor/zepto' : '".get_template_directory_uri()."/js/vendor/jquery') +"
	echo "'.js><\/script>')"
}

add_action('wp_footer', 'zeptojs');


/**
 * Register Navigation Menus
 */

// Register wp_nav_menus
function foundation_menus() {

	register_nav_menus(
		array(
			'header-menu' => __( 'Header Menu', 'foundation' )
		)
	);
	
}
add_action( 'init', 'foundation_menus' );

// Create a graceful fallback to wp_page_menu
function foundation_page_menu() {

	$args = array(
	'sort_column' => 'menu_order, post_title',
	'menu_class'  => 'large-12 columns',
	'include'     => '',
	'exclude'     => '',
	'echo'        => true,
	'show_home'   => false,
	'link_before' => '',
	'link_after'  => ''
	);

	wp_page_menu($args);

}

/**
 * Navigation Menu Adjustments
 */


// Add class to navigation sub-menu
class foundation_navigation extends Walker_Nav_Menu {

function start_lvl(&$output, $depth) {
	$indent = str_repeat("\t", $depth);
	$output .= "\n$indent<a href=\"#\" class=\"flyout-toggle\"><span> </span></a><ul class=\"flyout\">\n";
}

function display_element( $element, &$children_elements, $max_depth, $depth=0, $args, &$output ) {
	$id_field = $this->db_fields['id'];
	if ( !empty( $children_elements[ $element->$id_field ] ) ) {
		$element->classes[] = 'has-flyout';
	}
		Walker_Nav_Menu::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
	}
}

// Add a class to the wp_page_menu fallback
function foundation_page_menu_class($ulclass) {
	return preg_replace('/<ul>/', '<ul class="nav-bar">', $ulclass, 1);
}

add_filter('wp_page_menu','foundation_page_menu_class');

/**
 * Create pagination
 */

function foundation_pagination() {

global $wp_query;

$big = 999999999;

$links = paginate_links( array(
	'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
	'format' => '?paged=%#%',
	'prev_next' => true,
	'prev_text' => '&laquo;',
	'next_text' => '&raquo;',
	'current' => max( 1, get_query_var('paged') ),
	'total' => $wp_query->max_num_pages,
	'type' => 'list'
)
);

$pagination = str_replace('page-numbers','pagination',$links);

echo $pagination;

}

/**
 * Register Sidebars
 */

function foundation_widgets() {

	// Sidebar Right
	register_sidebar( array(
			'id' => 'foundation_sidebar_right',
			'name' => __( 'Sidebar Right', 'foundation' ),
			'description' => __( 'This sidebar is located on the right-hand side of each page.', 'foundation' ),
			'before_widget' => '<div>',
			'after_widget' => '</div>',
			'before_title' => '<h5>',
			'after_title' => '</h5>',
		) );

	// Sidebar Footer Column One
	register_sidebar( array(
			'id' => 'foundation_sidebar_footer_one',
			'name' => __( 'Sidebar Footer One', 'foundation' ),
			'description' => __( 'This sidebar is located in column one of your theme footer.', 'foundation' ),
			'before_widget' => '<div class="large-3 columns">',
			'after_widget' => '</div>',
			'before_title' => '<h5>',
			'after_title' => '</h5>',
		) );

	// Sidebar Footer Column Two
	register_sidebar( array(
			'id' => 'foundation_sidebar_footer_two',
			'name' => __( 'Sidebar Footer Two', 'foundation' ),
			'description' => __( 'This sidebar is located in column two of your theme footer.', 'foundation' ),
			'before_widget' => '<div class="large-3 columns">',
			'after_widget' => '</div>',
			'before_title' => '<h5>',
			'after_title' => '</h5>',
		) );

	// Sidebar Footer Column Three
	register_sidebar( array(
			'id' => 'foundation_sidebar_footer_three',
			'name' => __( 'Sidebar Footer Three', 'foundation' ),
			'description' => __( 'This sidebar is located in column three of your theme footer.', 'foundation' ),
			'before_widget' => '<div class="large-3 columns">',
			'after_widget' => '</div>',
			'before_title' => '<h5>',
			'after_title' => '</h5>',
		) );

	// Sidebar Footer Column Four
	register_sidebar( array(
			'id' => 'foundation_sidebar_footer_four',
			'name' => __( 'Sidebar Footer Four', 'foundation' ),
			'description' => __( 'This sidebar is located in column four of your theme footer.', 'foundation' ),
			'before_widget' => '<div class="large-3 columns">',
			'after_widget' => '</div>',
			'before_title' => '<h5>',
			'after_title' => '</h5>',
		) );

	}

add_action( 'widgets_init', 'foundation_widgets' );

/**
 * HTML5 IE Shim
 */

function foundation_shim () {
    echo '<!--[if lt IE 9]>';
    echo '<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>';
    echo '<![endif]-->';
}

add_action('wp_head', 'foundation_shim');

/**
 * Custom Avatar Classes
 */

function foundation_avatar_css($class) {
	$class = str_replace("class='avatar", "class='author_gravatar left ", $class) ;
	return $class;
}

add_filter('get_avatar','foundation_avatar_css');

/**
 * Custom Post Excerpt
 */

function new_excerpt_more($more) {
    global $post;
	return '... <br><br><a class="small button secondary" href="'. get_permalink($post->ID) . '">Continue Reading</a>';
}
add_filter('excerpt_more', 'new_excerpt_more');

/**
 * Retrieve Shortcodes
 */

require( get_template_directory() . '/inc/shortcodes.php' );

?>