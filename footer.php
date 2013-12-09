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

<?php if ( dynamic_sidebar('Sidebar Footer One') + dynamic_sidebar('Sidebar Footer Two') + dynamic_sidebar('Sidebar Footer Three') + dynamic_sidebar('Sidebar Footer Four')  ) : else : ?>

<div class="large-12 columns">
	<ul class="inline-list">
	<?php wp_list_pages('title_li='); ?>
	</ul>
</div>

<?php endif; ?>

</footer>
<!-- End Footer -->

<?php wp_footer(); ?>

</body>
</html>