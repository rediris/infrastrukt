<?php
/**
 * Content
 *
 * Displays content shown in the 'index.php' loop, default for 'standard' post format
 *
 * @package WordPress
 * @subpackage Infrastrukt for WordPress
 * @since Infrastrukt for WordPress 1.0
 */
?>
<?php if ( has_post_thumbnail()) : ?>
<style type="text/css">

</style>
<?php endif; ?>
<div id="content-block-<?php the_ID(); ?>" class="content-block content-block-<?php the_ID(); ?>">
  <div class="row">
    <div class="<?php echo infrastrukt_foundation_columns() ?>">
      <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <header>
          <h1><a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'infrastrukt' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
          <?php if ( is_sticky() ) : ?><span class="right radius secondary label"><?php _e( 'Sticky', 'infrastrukt' ); ?></span><?php endif; ?>
          <h6>Written by <?php the_author_link(); ?> on <?php the_time(get_option('date_format')); ?></h6>
        </header>
        <?php if ( has_post_thumbnail()) : ?>
          <a href="<?php the_permalink(); ?>" class="th" title="<?php the_title_attribute(); ?>" ><?php the_post_thumbnail(); ?></a>
        <?php endif; ?>
        <?php the_excerpt(); ?>
      </article>
    </div><!--.columns-->
  </div><!--.row-->
</div><!--.content-block-->
