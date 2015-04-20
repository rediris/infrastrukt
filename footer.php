<?php
/**
 * Footer
 *
 * Displays content shown in the footer section
 *
 * @package WordPress
 * @subpackage Infrastrukt for WordPress
 * @since Infrastrukt for WordPress 1.0
 */
?>
<footer id="footer" class="footer">
  <div class="row">
    <?php
      $infrastrukt_sidebars = array('infrastrukt_sidebar_footer_one','infrastrukt_sidebar_footer_two','infrastrukt_sidebar_footer_three','infrastrukt_sidebar_footer_four');
      $count = 0;
      /*
        Check to see how many columns the footer is required to support
        and unset inactive sidebars
      */
      foreach($infrastrukt_sidebars as $x=>$sidebar) {
        if( is_active_sidebar($sidebar) ) {
          $count++;
        } else {
          unset($infrastrukt_sidebars[$x]);
        }
      }
      /*
        Display active sidebars with the appropriate column width
        The widgets in the sidebars stack in their column
      */
      if($count) {
        $col_width = 12/$count;
        foreach( $infrastrukt_sidebars as $sidebar ) { ?>
          <div id="<?php echo $sidebar;?>" class="large-<?php echo $col_width;?> columns">
          <?php dynamic_sidebar($sidebar); ?>
          </div><!--.columns-->
        <?php }
      } else { ?>
        <div class="column columns">
          <ul class="inline-list">
          <?php wp_list_pages('title_li='); ?>
          </ul><!--.inline-list-->
        </div><!--.columns-->
      <?php } 
      if( get_theme_mod( 'hide_copyright' ) == ''): ?>
        <div class="large-12 columns">
          <div class="copyright">
            <p>&copy; <?php echo date('Y'); ?> <?php echo get_theme_mod( 'copyright_textbox', 'No copyright information has been saved yet.', 'infrastrukt' ); ?></p>
          </div><!--.copyright-->
        </div><!--.columns-->
      <?php endif; ?>
  </div><!--.row-->
</footer>
<a class="exit-off-canvas"></a>
</div><!--.inner-wrap-->
</div><!--.off-canvas-wrap-->
<?php wp_footer(); ?>
</body>
</html>
