<?php
/**
 * The template for displaying product content within loops.
 *
 * Override this template by copying it to yourtheme/woocommerce/content-product.php
 *
 * @author        WooThemes
 * @package    WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product, $woocommerce_loop;

// Store loop count we're currently on
if ( empty( $woocommerce_loop['loop'] ) ) {
	$woocommerce_loop['loop'] = 0;
}

// Store column count for displaying the grid
if ( empty( $woocommerce_loop['columns'] ) ) {
	$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 2 );
}

// Ensure visibility
if ( ! $product || ! $product->is_visible() ) {
	return;
}

// Increase loop count
$woocommerce_loop['loop'] ++;

// Extra post classes
$classes = array();

$classes[] = 'product-item';
?>
<li <?php post_class( $classes ); ?>>
	<div class="wrap-product-img">
		<a href="<?php the_permalink(); ?>">
			<?php the_post_thumbnail( 'product-cat-thumb' ); ?>
		</a>
		<?php if ( $product->is_on_sale() ) { ?>
			<span
				class="saleoff style<?php echo esc_attr( $woocommerce_loop['loop'] % 2 == 1 ? '1' : '2' ); ?>"><?php _e( 'sale off', 'kysbag' ); ?></span>


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
			<button class="ajax-add-to-cart" data-id="<?php the_ID(); ?>"><?php _e( 'Add to Cart', 'kysbag' ); ?></button>
		<?php }
		?>
		<button class="ajax-add-to-wishlist" data-product-id="<?php echo get_the_ID(); ?>"
		        data-product-type="<?php echo esc_attr($product->product_type); ?>">
			<?php _e( 'Wish List', 'kysbag' ); ?>
		</button>
	</div>


</li>
