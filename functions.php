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
?>