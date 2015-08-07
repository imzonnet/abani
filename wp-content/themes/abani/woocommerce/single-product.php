<?php
/**
 * The Template for displaying all single products.
 *
 * Override this template by copying it to yourtheme/woocommerce/single-product.php
 *
 * @author        WooThemes
 * @package    WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
//get_header( 'shop' );
get_template_part( 'templates/head' );
?>

<div class="main">
	<div class="page-header">
		<div class="wrap-page-title">
			<div class="bottom">
				<div>
					<div class="container">
						<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>
							<div class="page-title">
								<?php

								if ( get_post_meta( get_the_ID(), 'oss_meta_box_sub_title', true ) ) {
									echo '<h4>' . get_post_meta( get_the_ID(), 'oss_meta_box_sub_title', true ) . '</h4>';
								}

								?>

								<h2><?php the_title(); ?></h2>
							</div>

						<?php endif; ?>
					</div>
					<!-- /.page-title -->
				</div>
			</div>
		</div>
		<!-- /.wrap-page-title -->
        
		<?php get_template_part('inc/woo-breadcrumb'); ?>
		<!-- /.wrap-breadcrumb -->
	</div>
	<!-- /.page-header -->
	<!-- /.wrap-page-header -->

	<div class="main-content">
		<div class="container">
			<?php while ( have_posts() ) : the_post(); ?>

				<?php wc_get_template_part( 'content', 'single-product' ); ?>

			<?php endwhile; // end of the loop. ?>
		</div>
	</div>
	<!-- /.main-content -->


</div>
<!-- /.main -->