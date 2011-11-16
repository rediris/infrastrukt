<?php
/*
Template Name: Sample
*/
?>

<?php get_header(); ?>

		<div class="row">
			<div class="nine columns">
				<h3>The Grid</h3>
				
				<!-- Grid Example -->
				<div class="row">
					<div class="twelve columns">
						<div class="panel">
							<p>This is a twelve column section in a row. Each of these includes a div.panel element so you can see where the columns are - it's not required at all for the grid.</p>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="six columns">
						<div class="panel">
							<p>Six columns</p>
						</div>
					</div>
					<div class="six columns">
						<div class="panel">
							<p>Six columns</p>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="four columns">
						<div class="panel">
							<p>Four columns</p>
						</div>
					</div>
					<div class="four columns">
						<div class="panel">
							<p>Four columns</p>
						</div>
					</div>
					<div class="four columns">
						<div class="panel">
							<p>Four columns</p>
						</div>
					</div>
				</div>
				
				
				<h3>Orbit, for WordPress</h3>
				<div class="row">
				<div class="twelve columns">
					<div id="featured">
							<?php sliderContent(); ?>
					</div>
				</div>
				</div>
				

				<h3>Tabs</h3>
				<dl class="dl nice tabs mobile">
					<dd><a href="#simple1" class="active">Simple Tab 1</a></dd>
					<dd><a href="#simple2">Simple Tab 2</a></dd>
					<dd><a href="#simple3">Simple Tab 3</a></dd>
				</dl>
				
				<ul class="tabs-content">
					<li class="active" id="simple1Tab">This is simple tab 1's content. Pretty neat, huh?</li>
					<li id="simple2Tab">This is simple tab 2's content. Now you see it!</li>
					<li id="simple3Tab">This is simple tab 3's content. It's, you know...okay.</li>
				</ul>
				
				<h3>Buttons</h3>
				
				<p><a href="#" class="small blue button">Small Blue Button</a></p>
				<p><a href="#" class="blue button">Medium Blue Button</a></p>
				<p><a href="#" class="large blue button">Large Blue Button</a></p>
				
				<p><a href="#" class="nice radius small blue button">Nice Blue Button</a></p>
				<p><a href="#" class="nice radius blue button">Nice Blue Button</a></p>
				<p><a href="#" class="nice radius large blue button">Nice Blue Button</a></p>
				
				<hr>

			</div>
		

			<!-- Begin Sidebar -->
			<?php get_sidebar(); ?>
			<!-- End Sidebar -->
			
			

		</div>
		
	</div>
	<!-- container -->
		
<?php get_footer(); ?>