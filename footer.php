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

<!-- Footer -->
<footer class="row">

<?php
        $foundation_sidebars = array('foundation_sidebar_footer_one','foundation_sidebar_footer_two','foundation_sidebar_footer_three','foundation_sidebar_footer_four');
        $count = 0;
        /*
                Check to see how many columns the footer is required to support
                and unset inactive sidebars
        */
        foreach($foundation_sidebars as $x=>$sidebar)
        {
                if(is_active_sidebar($sidebar)) {
                        $count++;
                } else {
                        unset($foundation_sidebars[$x]);
                }

        }
        /*
                Display active sidebars with the approprite column width
                The widgets in the sidebars stack in their column
        */
        if($count){
                $col_width = 12/$count;
                foreach($foundation_sidebars as $sidebar)
                {
?>
                <div id="<?php echo $sidebar;?>" class="large-<?php echo $col_width;?> columns">
                        <?php dynamic_sidebar($sidebar); ?>
                </div>
<?php
                }

        } else {
?>

<div class="large-12 columns">
        <ul class="inline-list">
        <?php wp_list_pages('title_li='); ?>
        </ul>
</div>

<?php } ?>

</footer><!-- End Footer -->
</div><!--.inner-wrap-->
</div><!--.off-canvas-wrap-->
<?php wp_footer(); ?>

</body>
</html>