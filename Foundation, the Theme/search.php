<?php get_header(); ?>

		<div class="row">
					
			<!-- Begin Post Loop, includes: date, author, category, comment, edit & post -->
			
				<!-- Begin Error Message, display if no posts are found -->
				<?php if ( ! have_posts() ) : ?>
					<div class="twelve columns">
        				<h2>Not Found</h1>  
            			<p>Apologies, but no results were found for your search. </p>
            			<?php get_search_form(); ?>
            			<a href="<?php echo home_url( '/' ); ?>">&larr; Go Home?</a>
            			<br>
            		</div>
				<?php endif; ?>
				<!-- End Error Message -->
			
				<article class="nine columns">
				
				<!-- Loop Through Posts -->
				<?php while ( have_posts() ) : the_post(); ?>
			
			        <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>  
					
	        		<div>
	               		Posted on <strong><?php the_date(); ?></strong>
	               		by <span class="author"><?php the_author(); ?></span>
	                	under <span class="author"><?php the_category(', '); ?></span>  
	                </div> 
	                
	                <div>
						<?php edit_post_link('Edit', '<span>  ' , '</span>'); ?>
						<span class="comment-count"><?php comments_popup_link('Leave a comment', '1 Comment', '% Comments'); ?></span>  
					</div> 
	  			
	        		<?php if ( is_archive() || is_search() ) : // Only display excerpts for archives and search. ?>  
	            	<?php the_excerpt(); ?>  
	        			<?php else : ?>  
	            		<?php the_content('Read More'); ?>  
	        		<?php endif; ?>
	        		
	        		<!-- End Looping Through Posts -->
	        		
	        		<?php endwhile; ?>  
	        	
	        	
        		</article>
        		
        		<hr>
       	
       			<!-- Begin Pagination -->
       			<?php if (function_exists("emm_paginate")) {
       			    emm_paginate();
       			} ?>
       			<!-- End Pagination -->
        		        	
        	<!-- End Post Loop -->
			
		</div>
		
<?php get_footer(); ?>