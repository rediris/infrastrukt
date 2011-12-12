	</div>
	<!-- Main Row -->
	
	<!-- Footer -->
	<footer class="row">
	
		<div class="twelve columns"><hr></div>
	
			<div class="row">
				
				<div class="four columns">
				<?php wp_list_bookmarks('title_li=&category_before=&category_after=&title_before=<h6>&title_after=</h6><br>&category_name=Footer Links 1'); ?>
				</div>
				
				<div class="four columns">
				<?php wp_list_bookmarks('title_li=&category_before=&category_after=&title_before=<h6>&title_after=</h6><br>&category_name=Footer Links 2'); ?>
				</div>
				
				<div class="four columns">
				<?php wp_list_bookmarks('title_li=&category_before=&category_after=&title_before=<h6>&title_after=</h6><br>&category_name=Footer Links 3'); ?>
				</div>
				
			</div>
	
	</footer>
	<!-- Footer -->

	</div>
	<!-- container -->

	<!-- Included JS Files -->
	<script src="<?php bloginfo('template_url'); ?>/javascripts/foundation.js"></script>
	<script src="<?php bloginfo('template_url'); ?>/javascripts/app.js"></script>
	<script src="<?php bloginfo('template_url'); ?>/javascripts/orbit.js"></script>	
	
	<script type="text/javascript">
	     $(window).load(function() {
	         $('#featured').orbit();
	     });
	</script>

	<?php wp_footer(); ?>
	
</body>
</html>