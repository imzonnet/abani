<?php

/**
 * The Shortcode
 */
function oss_products_query_shortcode( $atts, $content = null ) {
	$atts       = shortcode_atts(
		array(
			'title'         => '',
			'per_page'      => 30,
			'exclude'       => false,
			'exclude_posts' => '',
			'orderby'       => 'title',
			'order'         => 'asc'
		), $atts );
	$meta_query = WC()->query->get_meta_query();

	$args = array(
		'post_type'           => 'product',
		'post_status'         => 'publish',
		'ignore_sticky_posts' => 1,
		'orderby'             => $atts['orderby'],
		'order'               => $atts['order'],
		'posts_per_page'      => $atts['per_page'],
		'meta_query'          => $meta_query
	);

	if ( $atts['exclude'] == true ) {
		$exclude_posts        = trim( $atts['exclude_posts'] );
		$exclude_posts        = explode( ',', $exclude_posts );
		$args['post__not_in'] = $exclude_posts;
	}

	add_filter( 'posts_clauses',  array( WC()->query, 'order_by_rating_post_clauses' ) );

	$products = new WP_Query( apply_filters( 'woocommerce_shortcode_products_query', $args, $atts ) );

	remove_filter( 'posts_clauses', array( WC()->query, 'order_by_rating_post_clauses' ) );

	ob_start(); ?>

	<div class="hot-bags">

		<?php if ( $atts['title'] ) { ?>
			<h3 class="border-caption with-dots">
				<?php echo htmlspecialchars_decode( $atts['title'] ); ?>
			</h3>
		<?php } ?>

		<?php

		if ( $products->have_posts() ) {

			?>
			<div class="jcarousel-wrapper">
				<div class="jcarousel">
					<ul>

						<?php
						$hb_i = 1;

						while ( $products->have_posts() ) : $products->the_post();
							global $product;

							?>
							<li class="product-item">
								<div class="wrap-product-img">
									<a href="<?php the_permalink(); ?>">
										<?php the_post_thumbnail( 'product-block-thumb' ); ?>
									</a>
									<?php if ( $product->is_on_sale() ) { ?>
										<span
											class="saleoff style<?php echo( $hb_i % 2 == 1 ? '1' : '2' ); ?>"><?php _e( 'sale off', 'kysbag' ); ?></span>


									<?php } ?>
								</div>
								<div class="wrap-product-content">
									<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
									<span class="price"><?php echo $product->get_price_html(); ?></span>
									<?php if ( $rating_html = $product->get_rating_html() ) : ?>
										<?php echo $rating_html; ?>
									<?php endif; ?>
								</div>
								<div class="wrap-links">
									<?php
									if ( $product->is_type( 'variable' ) ) { ?>
										<a href="<?php the_permalink(); ?>"><?php _e( 'Select options', 'kysbag' ); ?></a>
									<?php } else { ?>
										<button class="ajax-add-to-cart"
										        data-id="<?php the_ID(); ?>"><?php _e( 'Add to Cart', 'kysbag' ); ?></button>
									<?php }
									?>
									<button class="ajax-add-to-wishlist" data-product-id="<?php echo get_the_ID(); ?>"
									        data-product-type="<?php echo $product->product_type; ?>">
										<?php _e( 'Wish List', 'kysbag' ); ?>
									</button>
								</div>
							</li>
							<?php $hb_i ++;

						endwhile;
						?>
					</ul>
				</div>
				<a href="#" class="jcarousel-control-prev">&lsaquo;</a>
				<a href="#" class="jcarousel-control-next">&rsaquo;</a>

				<p class="pages"><?php _e( 'Page', 'kysbag' ); ?> <span class="current">1</span>/<span
						class="max">1</span></p>

				<div class="jcarousel-pagination"></div>

			</div>

		<?php
		}
        wp_reset_postdata() ;
		?>


	</div>
	<!-- /.new-bags -->
	<?php
	$output = ob_get_contents();
	ob_end_clean();

	return $output;
}

add_shortcode( 'oss_products_query', 'oss_products_query_shortcode' );

/**
 * The VC Functions
 */
function oss_products_query_shortcode_vc() {
	$order_by_values = array(
		'',
		__( 'Date', 'kysbag' )          => 'date',
		__( 'ID', 'kysbag' )            => 'ID',
		__( 'Author', 'kysbag' )        => 'author',
		__( 'Title', 'kysbag' )         => 'title',
		__( 'Modified', 'kysbag' )      => 'modified',
		__( 'Random', 'kysbag' )        => 'rand',
		__( 'Comment count', 'kysbag' ) => 'comment_count',
		__( 'Menu order', 'kysbag' )    => 'menu_order',
	);

	$order_way_values = array(
		'',
		__( 'Descending', 'kysbag' ) => 'DESC',
		__( 'Ascending', 'kysbag' )  => 'ASC',
	);
	vc_map(
		array(
			'icon'     => 'oss-vc-products-query',
			'name'     => __( 'OSS - Products Query', 'kysbag' ),
			'base'     => 'oss_products_query',
			'category' => __( 'OSS - Woocommerce', 'kysbag' ),
			'params'   => array(
				array(
					'type'       => 'textfield',
					'heading'    => __( 'Title', 'kysbag' ),
					'param_name' => 'title',
					'value'      => 'Hot Bags',
				),
				array(
					'type'       => 'textfield',
					'heading'    => __( 'Show How Many Posts?', 'kysbag' ),
					'param_name' => 'per_page',
					'value'      => 30,
				),
				array(
					'type'       => 'checkbox',
					'heading'    => __( 'Exclude Products?', 'kysbag' ),
					'param_name' => 'exclude',
					'value'      => array( __( 'Yes, please', 'kysbag' ) => true ),
				),
				array(
					'type'        => 'textfield',
					'heading'     => __( 'Exclude Product IDs', 'kysbag' ),
					'param_name'  => 'exclude_posts',
					'Description' => __( 'Enter product ids to exclude, separated by commas. Ex: 1,2,3', 'kysbag' ),
					'value'       => '',
				),
				array(
					'type'       => 'dropdown',
					'heading'    => __( 'Order by', 'kysbag' ),
					'param_name' => 'orderby',
					'value'      => $order_by_values,
				),
				array(
					'type'       => 'dropdown',
					'heading'    => __( 'Order way', 'kysbag' ),
					'param_name' => 'order',
					'value'      => $order_way_values,
				),

			)
		)
	);
}

add_action( 'vc_before_init', 'oss_products_query_shortcode_vc' );