<?php
/**
 * Single Product Thumbnails
 *
 * @author        WooThemes
 * @package    WooCommerce/Templates
 * @version     2.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $post, $product, $woocommerce;

$attachment_ids = $product->get_gallery_attachment_ids();

if ( $attachment_ids ) {
	?>
	<div class="previews always-visible">
		<?php

		foreach ( $attachment_ids as $attachment_id ) {

			$image_title   = esc_attr( get_the_title( $attachment_id ) );
			$img           = wp_get_attachment_image_src( $attachment_id, 'single_product_full_thumbnail_size' );
			$img_src       = $img[0];
			$img_thumb     = wp_get_attachment_image_src( $attachment_id, 'single_product_full_thumbnail_size' );
			$img_thumb_src = $img_thumb[0];
			echo '<a href="' . $img_thumb_src . '" data-full="' . $img_src . '"><img src="' . $img_thumb_src . '" alt="' . $image_title . '"/></a>';
		}

		?>
	</div>
<?php
}
