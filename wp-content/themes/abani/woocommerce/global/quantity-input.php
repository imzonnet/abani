<?php
/**
 * Product quantity inputs
 *
 * @author        WooThemes
 * @package    WooCommerce/Templates
 * @version     2.1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>
<div class="quantity">
	<?php if ( is_single() ) { ?>
		<h4 class="options-caption"><?php _e( 'Qty', 'kysbag' ); ?></h4>
	<?php } ?>
	<input type="number" step="<?php echo esc_attr( $step ); ?>"
	       <?php if (is_numeric( $min_value )) : ?>min="<?php echo esc_attr( $min_value ); ?>"<?php endif; ?>
	       <?php if (is_numeric( $max_value )) : ?>max="<?php echo esc_attr( $max_value ); ?>"<?php endif; ?>
	       name="<?php echo esc_attr( $input_name ); ?>"
	       value="<?php echo esc_attr( $input_value ); ?>"
	       title="<?php _ex( 'Qty', 'Product quantity input tooltip', 'woocommerce' ) ?>"
	       class="input-text qty text" size="4"/>
	<button class="minus-btn"><?php _e( '-', 'kysbag' ); ?></button>
	<button class="plus-btn"><?php _e( '+', 'kysbag' ); ?></button>
</div>