<?php
/**
 * Searchform
 *
 * Custom template for search form
 *
 * @package WordPress
 * @subpackage Foundation, for WordPress
 * @since Foundation, for WordPress 1.0
 */
?>

<form method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<div class="row">
		<div class="twelve columns">
			<div class="row collapse">
				<div class="eight mobile-three columns">
					<input type="text" name="s" id="s" placeholder="<?php esc_attr_e( 'Search', 'foundation' ); ?>" />
				</div>
				<div class="four mobile-one columns">
					<input type="submit" class="postfix button expand" name="submit" id="searchsubmit" value="<?php esc_attr_e( 'Search', 'foundation' ); ?>" />
				</div>
			</div>
		</div>
	</div>
</form>
