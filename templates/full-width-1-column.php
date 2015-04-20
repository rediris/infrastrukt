<?php
/*
 * Template Name: Full Width, One Column
 */
get_header(); ?>
<?php if ( have_posts() ) : ?>
  <?php while ( have_posts() ) : the_post(); ?>
    <?php get_template_part( 'content', 'page' ); ?>
  <?php endwhile; ?>
<?php endif; ?>
<?php get_footer(); ?>
