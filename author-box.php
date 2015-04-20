<?php
/**
 * Author Box
 *
 * Displays author box with author description and thumbnail on single posts
 *
 * @package WordPress
 * @subpackage Infrastrukt for WordPress
 * @since Infrastrukt for WordPress 1.0
 */
?>
<?php if ( get_the_author_meta('description') ) : ?>
  <section class="content-block">
    <div class="row">
      <div class="<?php echo infrastrukt_foundation_columns() ?>">
        <div class="panel author-box">
          <a href="<?php get_the_author_meta('url'); ?>"><?php echo get_avatar( get_the_author_meta('user_email'),'60' ); ?></a>
          <h5><?php _e('About', 'infrastrukt' ); ?> <?php the_author_link(); ?></h5>
          <p><?php echo get_the_author_meta('description'); ?></p>
        </div>
      </div>
    </div>
  </section><!--.content-block-->
<?php endif; ?>
