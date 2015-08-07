<?php get_template_part( 'templates/page', 'header' ); ?>
<div class="main">

	<?php if ( $osvn_opt['archive-page-title'] == true ) { ?>
		<div class="page-header">
			<div class="wrap-page-title">
				<div class="bottom">
					<div>
						<div class="container">

							<div class="page-title">
								<h2><?php
									if ( ! have_posts() ) {
										_e( 'Not Found', 'kysbag' );
									} else {
										the_archive_title();
									}
									?></h2>
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
				<?php if ( $osvn_opt['archive-layout'] == 'right' ) { ?>

					<div class="col-md-9">
						<?php get_template_part( 'templates/archive' ); ?>
						<?php the_posts_navigation(); ?>
					</div>
					<div class="col-md-3">
						<?php get_template_part( 'templates/sidebar' ); ?>
					</div>
				<?php } elseif ( $osvn_opt['archive-layout'] == 'left' ) { ?>
					<div class="col-md-3">
						<?php get_template_part( 'templates/sidebar' ); ?>
					</div>
					<div class="col-md-9">
						<?php get_template_part( 'templates/archive' ); ?>
						<?php the_posts_navigation(); ?>
					</div>

				<?php } else { ?>
					<div class="col-md-12">
						<?php get_template_part( 'templates/archive' ); ?>
						<?php the_posts_navigation(); ?>
					</div>
				<?php } ?>
			</div>
		</div>
	</div>
	<!-- /.main-content -->


</div>
<!-- /.main -->



