<?php
/**
 * Content Single - Left Sidebar
 *
 * Loop content in single post template (single.php)
 *
 * @package WordPress
 * @subpackage Infrastrukt for WordPress
 * @since Infrastrukt for WordPress 1.0
 */
?>
<div class="content-block">
  <div class="row">
    <div class="<?php echo infrastrukt_main_push() ?>">
      <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <header>
          <h1><a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'infrastrukt' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
          <h6><?php _e('Written by', 'infrastrukt' );?> <?php the_author_link(); ?> on <?php the_time(get_option('date_format')); ?></h6>
        </header>

        <?php if ( has_post_thumbnail()) : ?>
        <a href="<?php the_permalink(); ?>" class="th" title="<?php the_title_attribute(); ?>" ><?php the_post_thumbnail(); ?></a>
        <?php endif; ?>
        
        <?php the_content(); ?>

        <footer>
          <p><?php wp_link_pages(); ?></p>
          <small><?php _e('Posted Under:', 'infrastrukt' );?> <?php the_category(', '); ?></small>
          <?php the_tags('<span class="radius secondary label">','</span><span class="radius secondary label">','</span>'); ?>
        </footer>
      </article>
    </div><!--.columns-->
    <div class="<?php echo infrastrukt_sidebar_pull() ?> sidebar">
      <?php get_sidebar( 'left' ); ?>
    </div><!--.columns-->
  </div><!--.row-->
</div><!--.content-block-->
<?php get_template_part('author-box'); ?>
<?php comments_template(); ?>
