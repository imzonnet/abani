<?php
function oss_language_selector() {
	if ( in_array( 'sitepress-multilingual-cms/sitepress.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
		$languages = icl_get_languages( 'skip_missing=0&orderby=code' );
		if ( ! empty( $languages ) ) {
			echo '<div class="wrap-select-country">';
			echo '<form action="#" method="post">';
			echo '<select class="custom-select country-switch" onChange="window.location.href=this.value">';
			foreach ( $languages as $l ) {
				echo '<option value="' . esc_attr($l['url']) . '" data-icon="' . esc_attr($l['language_code']) . '-flag"';
				if ( $l['active'] ) {
					echo ' selected="selected" ';
				}
				echo '>' . $l['native_name'] . '</option>';
			}
			echo '</select>';
			echo '</form>';
			echo '</div>';
		}
	}

}


add_action( 'wp_ajax_oss_load_more', 'oss_load_more' );
add_action( 'wp_ajax_nopriv_oss_load_more', 'oss_load_more' );

function oss_load_more() {
	check_ajax_referer( 'oss_load_more', 'nonce' );
	if ( isset( $_REQUEST ) ) {
		$page     = $_REQUEST['page'] + 1;
		$per_page = $_REQUEST['per_page'];

		$atts = str_replace( '\\', '', $_REQUEST['atts'] );
		$atts = json_decode( $atts, true );


		$args = array(
			'post_status'         => 'publish',
			'ignore_sticky_posts' => 1,
			'posts_per_page'      => $per_page,
			'paged'               => $page,
		);

		if ( $atts['orderby'] ) {
			$args['orderby'] = $atts['orderby'];
		}

		if ( $atts['order'] ) {
			$args['order'] = $atts['order'];
		}


		if ( $atts['exclude'] == true ) {
			$exclude_posts        = trim( $atts['exclude_posts'] );
			$exclude_posts        = explode( ',', $exclude_posts );
			$args['post__not_in'] = $exclude_posts;
		}

		if ( $atts['exclude_cat'] == true ) {
			$exclude_cats             = trim( $atts['exclude_cats'] );
			$exclude_cats             = explode( ',', $exclude_cats );
			$args['category__not_in'] = $exclude_cats;
		}

		$recent_posts = new WP_Query( $args );
		ob_start();
		if ( $recent_posts->have_posts() ) {
			while ( $recent_posts->have_posts() ): $recent_posts->the_post(); ?>
				<div class="media blog-item">
					<div class="media-body">
						<span class="blog-date"><?php echo oss_relative_date( strtotime( get_the_date() ) ); ?>
							, <?php the_time( 'g.i A' ); ?></span>
						<h4 class="blog-name"><a href="<?php the_permalink() ?>"
						                         title="<?php the_title() ?>"><?php the_title(); ?></a></h4>

						<div>
							<?php the_excerpt(); ?>
							<p class="blog-by">- by
								<mark><?php the_author(); ?></mark>
							</p>
						</div>
					</div>
					<div class="media-right">
						<?php the_post_thumbnail( 'small-thumb' ); ?>
					</div>
				</div>
			<?php endwhile;
		}
		wp_reset_postdata();
		$output = ob_get_contents();
		ob_end_clean();
		echo json_encode( $output );
	}
	die();
}


//Relative Date Function

function oss_relative_date( $time ) {

	$today = strtotime( date( 'M j, Y' ) );

	$reldays = ( $time - $today ) / 86400;

	if ( $reldays >= 0 && $reldays < 1 ) {

		return __( 'Today', 'kysbag' );

	} else if ( $reldays >= 1 && $reldays < 2 ) {

		return __( 'Tomorrow', 'kysbag' );

	} else if ( $reldays >= - 1 && $reldays < 0 ) {

		return __( 'Yesterday', 'kysbag' );

	} else {
		return date( 'F j, Y', $time ? $time : time() );
	}


}


add_action( 'wp_ajax_oss_add_simgple_product', 'oss_add_simgple_product' );
add_action( 'wp_ajax_nopriv_oss_add_simgple_product', 'oss_add_simgple_product' );

function oss_add_simgple_product() {
	check_ajax_referer( 'oss_add_simgple_product', 'nonce' );
	if ( isset( $_REQUEST ) ) {
		global $woocommerce;

		$product_id = $_REQUEST['product_id'];
		$quantity   = 1;

		$pd   = get_post( $product_id );
		$name = $pd->post_title;

		if ( $woocommerce->cart->add_to_cart( $product_id, $quantity ) ) {
			$mess = true;
		} else {
			$mess = false;
		}
		ob_start();
		?>

		<?php
		if ( $mess == true ) { ?>
			<div class="alert alert-success"
			     role="alert"><?php printf( __( '"%s" was successfully added to your cart.', 'kysbag' ), $name ); ?>
			</div>
		<?php } else { ?>
			<div class="alert alert-danger" role="alert">
				<?php printf( __( '"%s"  didn\'t add to your cart.', 'kysbag' ), $name ); ?>
			</div>
		<?php } ?>

		<?php
		$output = ob_get_contents();
		ob_end_clean();
		$cart_num = $woocommerce->cart->cart_contents_count;
		$output   = array(
			'body' => $output,
			'menu' => $cart_num
		);
		echo json_encode( $output );

	}
	die();
}


add_action( 'wp_ajax_oss_wl_count', 'oss_wl_count' );
add_action( 'wp_ajax_nopriv_oss_wl_count', 'oss_wl_count' );

function oss_wl_count() {

	$wishlist_num = YITH_WCWL()->count_products();
	echo esc_attr($wishlist_num);

	die();
}