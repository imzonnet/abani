<?php
global $osvn_opt;
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive.
 *
 * Override this template by copying it to yourtheme/woocommerce/archive-product.php
 *
 * @author        WooThemes
 * @package    WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

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

								<h2><?php woocommerce_page_title(); ?></h2>
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
		<div class="wrap-viewby">
			<div class="bottom">
				<div>
					<div class="container">
						<div class="viewby">
							<h4><?php _e( 'View:', 'kysbag' ); ?></h4>
							<a href="#" class="bygrid active"></a>
							<a href="#" class="bylist"></a>
						</div>
					</div>
					<!-- /.viewby -->
				</div>
			</div>
		</div>
		<!-- /.wrap-viewby -->
	</div>
	<!-- /.page-header -->
	<!-- /.wrap-page-header -->
	<div class="main-content">
		<div class="container">
			<div class="row">
				<div class="col-md-3">
					<?php get_template_part( 'templates/sidebar-woo' ); ?>
				</div>
				<div class="col-md-9">
					<div class="top-products">
						<div class="sortby">
							<h4><?php _e( 'Sort by', 'kysbag' ); ?></h4>
							<?php woocommerce_catalog_ordering(); ?>
						</div>
						<?php
						if ( in_array( 'yith-woocommerce-wishlist/init.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) { ?>
							<a href="<?php echo esc_url(get_permalink( get_option( 'yith_wcwl_wishlist_page_id' ) )); ?>"
							   class="compare-btn"><?php printf( __( 'Wishlist (<span>%s</span>)<i class="fa fa-chevron-right"></i>', 'kysbag' ), YITH_WCWL()->count_products() ) ?></a>
						<?php }
						?>

					</div>

					<?php if ( have_posts() ) : ?>
						<?php woocommerce_product_loop_start(); ?>
						<?php while ( have_posts() ) : the_post(); ?>

							<?php wc_get_template_part( 'content', 'product' ); ?>

						<?php endwhile; // end of the loop.						?>

						<?php woocommerce_product_loop_end(); ?>

					<?php elseif ( ! woocommerce_product_subcategories( array(
						'before' => woocommerce_product_loop_start( false ),
						'after'  => woocommerce_product_loop_end( false )
					) )
					) : ?>

						<?php wc_get_template( 'loop/no-products-found.php' ); ?>

					<?php endif; ?>
					<?php
					woocommerce_pagination();
					?>
				</div>
			</div>
			<?php
			if ($osvn_opt['random-box']==true) {
				echo do_shortcode($osvn_opt['random-box-sc']);
			}
			?>
		</div>
	</div>
	<!-- /.main-content -->
</div>
<!-- /.main -->
