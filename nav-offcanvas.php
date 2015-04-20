<?php
/**
 * Off-Canvas Setup
 *
 * Setup theme customization options for Foundation's Off-Canvas Navigation
 *
 * @package WordPress
 * @subpackage Infrastrukt for WordPress
 * @since Infrastrukt for WordPress 1.0
 */
$offcanvas_menu_left   = get_theme_mod( 'infrastrukt_offcanvas_menu_left_label' );
$offcanvas_menu_right  = get_theme_mod( 'infrastrukt_offcanvas_menu_right_label' );
?>
<nav class="tab-bar">
  <?php if( get_theme_mod( 'offcanvas_position' ) == 'left' || get_theme_mod( 'offcanvas_position' ) == 'both') : ?>
    <section class="left-small">
      <a class="left-off-canvas-toggle menu-icon"><span></span></a>
    </section>
  <?php endif; ?>
    <section class="middle tab-bar-section">
      <h1><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo('name'); ?></a></h1>
    </section>
  <?php if( get_theme_mod( 'offcanvas_position' ) == 'right' || get_theme_mod( 'offcanvas_position' ) == 'both') : ?>
    <section class="right-small">
      <a class="right-off-canvas-toggle menu-icon"><span></span></a>
    </section>
  <?php endif; ?>
</nav>
<?php if( get_theme_mod( 'offcanvas_position' ) == 'left' || get_theme_mod( 'offcanvas_position' ) == 'both') : 

  offcanvas_menu('menu-one',$offcanvas_menu_left,'left-off-canvas-menu');

endif; ?>

<?php if( get_theme_mod( 'offcanvas_position' ) == 'right' || get_theme_mod( 'offcanvas_position' ) == 'both') : 

  offcanvas_menu('menu-two',$offcanvas_menu_right,'right-off-canvas-menu');

endif; ?>