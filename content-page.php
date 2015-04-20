<?php
/**
 * Content Page
 *
 * Loop content in page template (page.php)
 *
 * @package WordPress
 * @subpackage Infrastrukt for WordPress
 * @since Infrastrukt for WordPress 1.0
 */
?>
<div id="content-block-<?php the_ID(); ?>" class="content-block content-block-<?php the_ID(); ?>">
  <div class="row">
    <div class="<?php echo infrastrukt_foundation_columns() ?>">
      <article id="page-<?php the_ID(); ?>" <?php post_class(); ?>>
        <header>
          <h1><?php the_title(); ?></h1>
        </header>
        <?php if ( has_post_thumbnail()) : ?>
          <a href="<?php the_permalink(); ?>" class="th" title="<?php the_title_attribute(); ?>" ><?php the_post_thumbnail(); ?></a>
        <?php endif; ?>
        <?php the_content(); ?>
      </article>
    </div><!--.columns-->
  </div><!--.row-->
</div><!--.content-block-->
