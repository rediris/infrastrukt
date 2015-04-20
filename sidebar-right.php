<?php
/**
 * Sidebar Right
 *
 * Content for our sidebar, provides prompt for logged in users to create widgets
 *
 * @package WordPress
 * @subpackage Infrastrukt for WordPress
 * @since Infrastrukt for WordPress 1.0
 */
?>
<?php if ( dynamic_sidebar('Sidebar Right') ) : elseif( current_user_can( 'edit_theme_options' ) ) : ?>

  <h5><?php _e( 'No widgets found.', 'infrastrukt' ); ?></h5>
  <p><?php printf( __( 'It seems you don&rsquo;t have any widgets in your sidebar! Would you like to %s now?', 'infrastrukt' ), '<a href=" '. get_admin_url( '', 'widgets.php' ) .' ">populate your sidebar</a>' ); ?></p>

<?php endif; ?>
