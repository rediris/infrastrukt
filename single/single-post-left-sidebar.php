<?php
/*
Single Post Template: Left Sidebar
*/
get_header(); ?>
<?php if ( have_posts() ) : ?>
  <?php while ( have_posts() ) : the_post(); ?>
    <?php get_template_part( 'content', 'single-post-left-sidebar' ); ?>
  <?php endwhile; ?>
<?php endif; ?>
<?php get_footer(); ?>
