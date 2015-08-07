<?php if ( ! have_posts() ) { ?>

	<article <?php post_class(); ?>>
		<div class="entry-summary">
			<div class="alert alert-warning">
				<?php _e( 'Sorry, no results were found.', 'sage' ); ?>
			</div>
			<?php get_search_form(); ?>
		</div>
	</article>
<?php } else {
	while ( have_posts() ) : the_post();
		if ( is_search() ) {
			get_template_part( 'templates/content', get_post_format());
		}else{
			get_template_part( 'templates/content', get_post_type() != 'post' ? get_post_type() : get_post_format() );
		}
	endwhile;
}