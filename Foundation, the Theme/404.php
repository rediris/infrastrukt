<?php get_header(); ?>

		<div class="row">
			<div class="five columns centered">
			<div class="alert-box error">404</div>
			<h2>:(</h2>  
            		<p>404's are such a lovely thing. But you know, I'm not going to leave you stranded.</p>
			<p>Why don't you try a search?</p>
            		<?php get_search_form(); ?>
            		<a href="<?php echo home_url( '/' ); ?>">&larr; Go Home?</a>
           </div>
		</div>
		
<?php get_footer(); ?>