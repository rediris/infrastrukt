<?php

/*
 * Template Name: Sidebar Left Template
 */

get_header(); ?>
<!-- Begin Page -->
<div class="row">
<?php get_sidebar(); ?>
    <!-- Main Content -->
    <div class="large-9 columns" role="content">

		<?php if ( have_posts() ) : ?>

			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'content', 'page' ); ?>
			<?php endwhile; ?>
			
		<?php endif; ?>

    </div>
    <!-- End Main Content -->
</div>
<!-- End Page -->
<?php get_footer(); ?>