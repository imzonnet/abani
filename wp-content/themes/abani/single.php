<?php global $osvn_opt; ?>
<div class="main">
	<?php if ( $osvn_opt['page-title-blog'] == true ) { ?>
		<div class="page-header">
			<div class="wrap-page-title">
				<div class="bottom">
					<div>
						<div class="container">

							<div class="page-title">
								<?php

								if ( get_post_meta( get_the_ID(), 'oss_meta_box_sub_title', true ) ) {
									echo '<h4>' . get_post_meta( get_the_ID(), 'oss_meta_box_sub_title', true ) . '</h4>';
								} else {
									printf( __( '<h4>News and updates from %s</h4>', 'kysbag' ), get_bloginfo( 'name' ) );
								}

								?>

								<h2><?php _e( 'Blog Posts', 'kysbag' ); ?></h2>
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

			<div class="row">
				<?php if ( $osvn_opt['single-blog-layout'] == 'right' ) { ?>

					<div class="col-md-9">
						<?php get_template_part( 'templates/content-single', get_post_type() ); ?>
					</div>
					<div class="col-md-3">
						<?php get_template_part( 'templates/sidebar' ); ?>
					</div>
				<?php } elseif ( $osvn_opt['single-blog-layout'] == 'left' ) { ?>
					<div class="col-md-3">
						<?php get_template_part( 'templates/sidebar' ); ?>
					</div>
					<div class="col-md-9">
						<?php get_template_part( 'templates/content-single', get_post_type() ); ?>
					</div>

				<?php } else { ?>
					<div class="col-md-12">
						<?php get_template_part( 'templates/content-single', get_post_type() ); ?>
					</div>
				<?php } ?>
			</div>
		</div>
	</div>
	<!-- /.main-content -->


</div>
<!-- /.main -->

