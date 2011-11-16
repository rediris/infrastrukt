<?php
/*
Template Name: Archives
*/
?>

<?php get_header(); ?>

		<div class="row">
			
				<div class="nine columns">
				
				<?php the_post(); ?>
												
						<h3>Archives</h3>
						<h4 class="subheader"> by Month:</h4>
						<ul>
							<?php wp_get_archives('type=monthly'); ?>
						</ul>
						
						<h3>Archives</h3>
						<h4 class="subheader"> by Subject:</h4>
						<ul>
							 <?php wp_list_categories(); ?>
						</ul>
				
				</div>
	        	
	        	<!-- Begin Pagination -->
	        	<?php if (function_exists("emm_paginate")) {
	        	    emm_paginate();
	        	} ?>
	        	<!-- End Pagination -->
	        	
        		</article>
        		
        		<!-- Begin Sidebar -->
        		<?php get_sidebar(); ?>
        		<!-- End Sidebar -->
        		
        		<hr>
        		        	
        	<!-- End Post Loop -->
			
		</div>
		
<?php get_footer(); ?>