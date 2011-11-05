<?php

// Load a copy of jQuery from Google's CDN instead of the local copy.

function my_scripts_method() {
    wp_deregister_script( 'jquery' );
    wp_register_script( 'jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js');
    wp_enqueue_script( 'jquery' );
}    
 
add_action('wp_enqueue_scripts', 'my_scripts_method');

// Disable the admin bar, set to true if you want it to be visible.

show_admin_bar(FALSE);

// Orbit, for WordPress

add_theme_support( 'post-thumbnails' );

add_action('init', 'Orbit');

function Orbit(){
	$Orbit_args = array(
		'label'	=> __('Orbit'),
		'singular_label' =>	__('Orbit'),
		'public'	=>	true,
		'show_ui'	=>	true,
		'capability_type'	=>	'post',
		'hierarchical'	=>	false,
		'rewrite'	=>	true,
		'supports'	=>	array('title', 'editor','page-attributes','thumbnail')
		);
		register_post_type('Orbit', $Orbit_args);
}

// Orbit, for WordPress
// Call this where you want the slider

function SliderContent(){

	$args = array( 'post_type' => 'Orbit');
	$loop = new WP_Query( $args );
		while ( $loop->have_posts() ) : $loop->the_post();
						the_post_thumbnail();
		endwhile;

}
?>