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
$topbar_classes     = get_theme_mod( 'topbar_position' );
$topbar_menu_title  = get_theme_mod( 'set_menu_title' );
if (get_theme_mod( 'contain_to_grid' ) == 1):
  if ($topbar_classes == '' || $topbar_classes == null):
    $topbar_classes = ' contain-to-grid';
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
<header class="nav-wrapper<?php echo $topbar_classes;?>">
  <nav class="top-bar" data-topbar data-options="is_hover:<?php echo $topbar_hover;?>">
    <ul class="title-area">
      <li class="name"><h1><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo('name'); ?></a></h1></li>
      <li class="toggle-topbar menu-icon"><a href="#"><span><?php echo $topbar_menu_title; ?></span></a></li>
    </ul>
    <section class="top-bar-section" role="navigation">
      <?php wp_nav_menu( array( 'theme_location' => 'menu-one', 'menu_class' => 'left', 'container' => '', 'container_class' => '', 'fallback_cb' => 'infrastrukt_page_menu', 'walker' => new infrastrukt_navigation() ) ); ?>
    </section>
  </nav>
</header><!--.nav-wrapper-->
