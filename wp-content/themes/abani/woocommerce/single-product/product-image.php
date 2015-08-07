<?php
/**
 * Single Product Image
 *
 * @author        WooThemes
 * @package    WooCommerce/Templates
 * @version     2.0.14
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $post, $woocommerce, $product;

?>
<div class="images">

	<div id="product-showcase">
		<div class="gallery">
			<div class="full">
				<?php
				if ( has_post_thumbnail() ) {

					$image_title = esc_attr( get_the_title( get_post_thumbnail_id() ) );
					$img         = wp_get_attachment_image_src( get_post_thumbnail_id(), 'single_product_full_thumbnail_size' );
					$img_src     = $img[0];
					echo '<img src="' . $img_src . '" alt="' . $image_title . '" />';

				} else {
					echo '<img src="' . wc_placeholder_img_src() . '" alt="' . __( 'Placeholder', 'woocommerce' ) . '" />';
				}
				?>
			</div>
			<?php do_action( 'woocommerce_product_thumbnails' ); ?>
		</div>
	</div>


</div>
