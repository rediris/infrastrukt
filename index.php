<?php get_header(); ?>

		<div class="row">					
					
			<!-- Begin Post Loop, includes: date, author, category, comment, edit & post -->
			
				<!-- Begin Error Message, display if no posts are found -->
				<?php if ( ! have_posts() ) : ?>
					<div class="twelve columns">
        				<h3>Not Found</h1>  
            			<p>Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post?</p>
            		</div>
				<?php endif; ?>
				<!-- End Error Message -->
					
					<div class="nine columns">
					
					<!-- Loop Through Posts -->
					<?php query_posts( 'posts_per_page=2' ); ?>
				
					<?php while ( have_posts() ) : the_post(); ?>
					
					<article>
					
						<a href="#" class="hide-on-desktops" style="float: right;" alt="Back to Top">Top &uarr;</a>
						
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
		            		<hr>
		        		<?php endif; ?>
		        		
		        	</article>
	     
	        		<?php endwhile; ?>
	        		<!-- End Looping Through Posts -->  	        		
	        	
		        	<!-- Begin Pagination -->
		        	<?php if (function_exists("emm_paginate")) {
		        	    emm_paginate();
		        	} ?>	        	
		        	<!-- End Pagination -->
		        	
		        	<!-- Reset Query -->
		        	<?php wp_reset_query(); ?>
		        	<!-- End Reset Query -->
	        	
        		</div>
        		
        		<!-- Begin Sidebar -->
        		<?php get_sidebar(); ?>
        		<!-- End Sidebar -->
        		
        		<hr>
        		        	
        	<!-- End Post Loop -->
			
		</div>
		
<?php get_footer(); ?>