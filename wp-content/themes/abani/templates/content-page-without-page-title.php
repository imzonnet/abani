<div class="main">
	<div class="main-content">
		<div class="container">
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<?php the_content(); ?>
			<?php wp_link_pages( array(
				'before' => '<nav class="page-nav"><p>' . __( 'Pages:', 'sage' ),
				'after'  => '</p></nav>'
			) ); ?>
			</article>
		</div>
	</div>
	<!-- /.main-content -->
</div>
<!-- /.main -->
