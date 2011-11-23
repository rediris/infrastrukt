<?php get_header(); ?>

		<div class="row">
					
			<!-- Begin Post Loop, includes: date, author, category, comment, edit & post -->
			
				<!-- Begin Error Message, display if no posts are found -->
				<?php if ( ! have_posts() ) : ?>
					<div class="twelve columns">
        				<h1>Not Foundddd</h1>  
            			<h4 class="subheader">Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post?</h4>
            		</div>
				<?php endif; ?>
				<!-- End Error Message -->
			
				<article class="nine columns">
				
				<!-- Loop Through Posts -->
				<?php while ( have_posts() ) : the_post(); ?>
			
			        <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
	  			
	        		<?php if ( is_archive() || is_search() ) : // Only display excerpts for archives and search. ?>  
	            	<?php the_excerpt(); ?>  
	        			<?php else : ?>  
	            		<?php the_content('Read More'); ?>  
	        		<?php endif; ?>
	        		
	        		<!-- End Looping Through Posts -->
	        		
	        		<?php endwhile; ?>  
	        	
	        	
        		</article>
        		
        		<!-- Begin Sidebar -->
        		<?php get_sidebar(); ?>
        		<!-- End Sidebar -->
        		        	
        	<!-- End Post Loop -->
			
		</div>
		
<?php get_footer(); ?>