<?php
/**
 * Template Name: Page Without Page Title
 */
?>
<?php while ( have_posts() ) : the_post(); ?>
	<?php get_template_part( 'templates/content', 'page-without-page-title' ); ?>
<?php endwhile; ?>
<?php
