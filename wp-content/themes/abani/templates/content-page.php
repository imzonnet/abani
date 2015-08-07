<?php global $osvn_opt; ?>
<div class="main">
	<?php if ( $osvn_opt['page-title-pages'] == true ) { ?>
	<div class="page-header">
		<div class="wrap-page-title">
			<div class="bottom">
				<div>
					<div class="container">
						<div class="page-title">
							<?php

							if ( get_post_meta( get_the_ID(), 'oss_meta_box_sub_title', true ) ) {
								echo '<h4>' . get_post_meta( get_the_ID(), 'oss_meta_box_sub_title', true ) . '</h4>';
							}

							?>
							<h2><?php the_title(); ?></h2>
						</div>
					</div>
					<!-- /.page-title -->
				</div>
			</div>
		</div>
		<!-- /.wrap-page-title -->

		<?php get_template_part('inc/wrap-breadcrumb'); ?>
		<!-- /.wrap-breadcrumb -->

	</div>
	<!-- /.page-header -->
	<!-- /.wrap-page-header -->
	<?php } ?>
	<div class="main-content">
		<div class="container">
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<?php the_content(); ?>
				<?php wp_link_pages( array(
					'before' => '<nav class="page-nav"><p>' . __( 'Pages:', 'sage' ),
					'after'  => '</p></nav>'
				) ); ?>
				<?php if(comments_open()) comments_template(); ?>
			</article>
		</div>
	</div>
	<!-- /.main-content -->
</div>
<!-- /.main -->
