<?php
/**
 * Related Products
 *
 * @author        WooThemes
 * @package    WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product, $woocommerce_loop;

if ( empty( $product ) || ! $product->exists() ) {
	return;
}

$related = $product->get_related( $posts_per_page );

if ( sizeof( $related ) == 0 ) {
	return;
}

$args = apply_filters( 'woocommerce_related_products_args', array(
	'post_type'           => 'product',
	'ignore_sticky_posts' => 1,
	'no_found_rows'       => 1,
	'posts_per_page'      => $posts_per_page,
	'orderby'             => $orderby,
	'post__in'            => $related,
	'post__not_in'        => array( $product->id )
) );

$products = new WP_Query( $args );

$woocommerce_loop['columns'] = $columns;

if ( $products->have_posts() ) : ?>
	<div class="related-bags">
		<div class="container">
			<h3 class="border-caption with-dots"><?php _e( 'RELATED BAGS', 'kysbag' ); ?></h3>

			<div class="jcarousel-wrapper">
				<div class="jcarousel">
					<ul>
						<?php while ( $products->have_posts() ) : $products->the_post(); ?>

							<?php wc_get_template_part( 'content', 'product' ); ?>

						<?php endwhile; // end of the loop. ?>
					</ul>
				</div>
				<a href="#" class="jcarousel-control-prev">&lsaquo;</a>
				<a href="#" class="jcarousel-control-next">&rsaquo;</a>

				<p class="pages"><?php _e( 'Page', 'kysbag' ); ?> <span class="current">1</span>/<span class="max">10</span></p>
				<div class="jcarousel-pagination"></div>
			</div>
		</div>
	</div>
	<!-- /.related-bags -->

<?php endif;

wp_reset_postdata();
