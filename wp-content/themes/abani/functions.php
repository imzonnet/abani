<?php
//$P$BTLuBfQHK0PNduNTMgF8JitFxMI0tP.
/**
 * Sage includes
 *
 * The $sage_includes array determines the code library included in your theme.
 * Add or remove files to the array as needed. Supports child theme overrides.
 *
 * Please note that missing files will produce a fatal error.
 *
 * @link https://github.com/roots/sage/pull/1042
 */
define( 'THEME_URI', get_template_directory_uri() );
define( 'THEME_DIR', get_template_directory() );
if( !defined('TEXTDOMAIN') ){

    $themename = get_option( 'stylesheet' );
    $themename = preg_replace("/\W/", "_", strtolower($themename) );
    define( 'TEXTDOMAIN', $themename );
}
define( 'THEME_NAME', TEXTDOMAIN );
define( 'TEMPLATES', THEME_DIR.'/templates/' );
if(!function_exists('breadcrumb')){
    function ct_breadcrumb(){
        require (TEMPLATES.'breadcrumb.php');
    }
}

$sage_includes = array(
	'lib/utils.php',                 // Utility functions
	'lib/init.php',                  // Initial theme setup and constants
	'lib/wrapper.php',               // Theme wrapper class
	'lib/conditional-tag-check.php', // ConditionalTagCheck class
	'lib/config.php',                // Configuration
	'lib/assets.php',                // Scripts and stylesheets
	'lib/titles.php',                // Page titles
	'lib/nav.php',                   // Custom nav modifications
	'lib/gallery.php',               // Custom [gallery] modifications
	'lib/extras.php',                // Custom functions

	'lib/tgm/class-tgm-plugin-activation.php', //tgm class
	'lib/tgm/plugins.php', //tgm plugin required
	'lib/osvn_panel/framework.php',                // Custom functions
	'lib/osvn_panel/config.php',                // Custom functions
	'lib/oss_functions.php',                // Custom functions
	'lib/widgets/oss-text.php',                // Custom functions
	'lib/widgets/oss-live-chat.php',                // Custom functions
    'lib/widgets/oss-signup.php',                // Custom functions
	'lib/icons.php',                // Custom functions
	// 'lib/vc_init.php',                // Custom functions
    'lib/my_functions.php',
);

foreach ( $sage_includes as $file ) {
	if ( ! $filepath = locate_template( $file ) ) {
		trigger_error( sprintf( __( 'Error locating %s for inclusion', 'sage' ), $file ), E_USER_ERROR );
	}

	require_once $filepath;
}
unset( $file, $filepath );

add_filter( 'post_class', 'oss_product_post_class' );
function oss_product_post_class( $classes ) {

	foreach ( $classes as $key => $value ) {
		if ( $value == 'product' ) {
			unset( $classes[ $key ] );
		}
	}

	return $classes;

}

add_filter( 'style_loader_tag', function ( $link, $handle ) {
	if ( 'open-sans' === $handle ) {
		$link = str_replace( '/>', ' data-noprefix />', $link );
	}

	return $link;
}, 10, 2 );


add_filter( 'woocommerce_product_single_add_to_cart_text', 'oss_woo_custom_cart_button_text' );    // 2.1 +

function oss_woo_custom_cart_button_text() {

	return __( '<i class="icon-cart"></i>Add to Cart', 'woocommerce' );

}

function woocommerce_button_proceed_to_checkout() {
	$checkout_url = WC()->cart->get_checkout_url(); ?>
	<a href="<?php echo esc_url(WC()->cart->get_cart_url()); ?>"
	   class="continue-shopping"><?php _e( 'CONTINUE SHOPPING', 'kysbag' ); ?></a>
	<a href="<?php echo esc_url($checkout_url); ?>"
	   class="checkout-button button alt wc-forward"><?php _e( 'PROCESS TO CHECKOUT<i class="fa fa-chevron-right"></i>', 'woocommerce' ); ?></a>
<?php }


add_action( 'add_meta_boxes', 'oss_meta_box_add' );
function oss_meta_box_add() {
	add_meta_box( 'oss-meta-box-post', 'OSS Meta Box', 'oss_meta_box', 'post', 'normal', 'high' );
	add_meta_box( 'oss-meta-box-page', 'OSS Meta Box', 'oss_meta_box', 'page', 'normal', 'high' );
	add_meta_box( 'oss-meta-box-product', 'OSS Meta Box', 'oss_meta_box', 'product', 'normal', 'high' );
}

function oss_meta_box( $post ) {
	$values    = get_post_custom( $post->ID );
	$sub_title = isset( $values['oss_meta_box_sub_title'] ) ? esc_attr( $values['oss_meta_box_sub_title'][0] ) : '';
	wp_nonce_field( 'oss_meta_box_nonce', 'meta_box_nonce' );
	?>
	<p>
		<label for="oss_meta_box_sub_title"><?php _e( 'Subtitle ', 'kysbag' ); ?></label>
		<input type="text" name="oss_meta_box_sub_title" id="oss_meta_box_sub_title" value="<?php echo esc_attr($sub_title); ?>"/>
	</p>
<?php
}


add_action( 'save_post', 'oss_meta_box_save' );
function oss_meta_box_save( $post_id ) {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	if ( ! isset( $_POST['meta_box_nonce'] ) || ! wp_verify_nonce( $_POST['meta_box_nonce'], 'oss_meta_box_nonce' ) ) {
		return;
	}

	if ( ! current_user_can( 'edit_post' ) ) {
		return;
	}

	$allowed = array(
		'a' => array(
			'href' => array()
		)
	);

	if ( isset( $_POST['oss_meta_box_sub_title'] ) ) {
		update_post_meta( $post_id, 'oss_meta_box_sub_title', wp_kses( $_POST['oss_meta_box_sub_title'], $allowed ) );
	}


}

function oss_payment_steps( $step = 1 ) {

	$steps = array(
		__( 'Summary', 'kysbag' ),
		__( 'Checkout', 'kysbag' ),
		__( 'Thankyou', 'kysbag' ),
	);

	$step_max = count( $steps );
	$step     = ( 100 / $step_max ) * $step;
	?>
	<div class="payment-steps">
		<div class="wrap-progress">
			<div class="progress">
				<div class="progress-bar" role="progressbar" aria-valuenow="<?php echo esc_attr($step); ?>" aria-valuemin="0"
				     aria-valuemax="100"
				     style="width: <?php echo esc_attr($step); ?>%;">
					<span class="sr-only"><?php echo esc_attr($step);
						_e( '% Complete', 'kysbag' ); ?></span>
				</div>
			</div>
		</div>
		<ul>
			<?php foreach ( $steps as $key => $val ) {
				echo '<li ';
				if ( ( $step * $step_max / 100 ) >= ( $key + 1 ) ) {
					echo 'class="active"';
				}
				echo '>' . sprintf( '%02d', ( $key + 1 ) ) . '. ' . $val . '</li>';
			} ?>
		</ul>
	</div>
	<!-- /.payment-steps -->
<?php }

add_filter( 'wp_nav_menu_items', 'oss_add_wishlist_to_top_menu', 10, 2 );
function oss_add_wishlist_to_top_menu( $nav, $args ) {
	if ( in_array( 'yith-woocommerce-wishlist/init.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
		if ( $args->theme_location == 'top_navigation' ) {
			return '<li><a href="' . esc_url(get_permalink( get_option( 'yith_wcwl_wishlist_page_id' ) )) . '" class="top-wishlist">' . __( 'Wish list', 'kysbag' ) . '<span>' . YITH_WCWL()->count_products() . '</span></a></li>' . $nav;
		}
	}

	return $nav;
}
