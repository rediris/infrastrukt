<?php
/**
 * Searchform
 *
 * Custom template for search form
 *
 * @package WordPress
 * @subpackage Infrastrukt for WordPress
 * @since Infrastrukt for WordPress 1.0
 */
?>
<form method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
  <div class="row">
    <div class="column columns">
      <div class="row collapse">
        <div class="large-8 mobile-three columns">
          <input type="text" name="s" id="s" placeholder="<?php esc_attr_e( 'Search', 'infrastrukt' ); ?>" />
        </div><!--.columns-->
        <div class="large-4 mobile-one columns">
          <button type="submit" class="button prefix" name="submit" id="searchsubmit"><?php esc_attr_e( 'Search', 'infrastrukt' ); ?></button>
        </div><!--.columns-->
      </div><!--.row.collapse-->
    </div><!--.columns-->
  </div><!--.row-->
</form>
