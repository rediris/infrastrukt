<?php
/**
 * Sparkletown Menu Setup
 *
 * Cleaner nav via @https://gist.github.com/zoerooney/6471748#file-no-li-nav-menu-v2-php
 *
 * @package WordPress
 * @subpackage Infrastrukt for WordPress
 * @since Infrastrukt for WordPress 1.0
 */
?>
<header id="masthead" class="masthead content-block" role="banner">
  <div class="header-main">
    <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
    <nav id="sparkletown" class="sparkletown" role="navigation">
      <button class="menu-toggle"><span class="visuallyhidden">Menu</span></button>
      <?php sparkletown_menu() ?>
    </nav>
  </div>
</header><!--.masthead-->
