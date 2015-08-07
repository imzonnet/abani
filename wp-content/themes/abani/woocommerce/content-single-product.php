<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * Override this template by copying it to yourtheme/woocommerce/content-single-product.php
 *
 * @author        WooThemes
 * @package    WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>

<?php
/**
 * woocommerce_before_single_product hook
 *
 * @hooked wc_print_notices - 10
 */
do_action( 'woocommerce_before_single_product' );

if ( post_password_required() ) {
	echo get_the_password_form();

	return;
}
global $product;
?>

<div itemscope itemtype="<?php echo woocommerce_get_product_schema(); ?>"
     id="product-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="row">
		<div class="col-md-6">

			<?php
			woocommerce_show_product_images();
			?>


		</div>
		<div class="col-md-6">
			<div class="summary">

				<div class="short-desc">
					<?php the_excerpt(); ?>
				</div>
				<?php woocommerce_template_single_sharing(); ?>
				<div class="actions">
					<a href="#" class="sendto" data-toggle="modal"
					   data-target="#email-popup"><?php _e( 'Send to my friends', 'kysbag' ); ?></a><br/>
					<a href="javascript:window.print()" class="print"><?php _e( 'Print', 'kysbag' ); ?></a>
				</div>
				<div class="price">
					<?php echo $product->get_price_html(); ?>
				</div>

				<?php woocommerce_template_single_add_to_cart(); ?>
			</div>
		</div>
	</div>
	<?php woocommerce_output_product_data_tabs(); ?>

	<meta itemprop="url" content="<?php the_permalink(); ?>"/>
</div>
<?php woocommerce_output_related_products(); ?>
<!-- Modal -->
<div class="modal fade" id="email-popup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
						aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel"><?php _e( 'Send to my friends', 'kysbag' ); ?></h4>
			</div>
			<div class="modal-body">
				<p class="subject">
					<label for="subject"><?php _e( 'Subject: ', 'kysbag' ); ?>
						<input type="text" name="subject" value="<?php _e( 'Send to my friends', 'kysbag' ); ?>"/>
					</label>
				</p>
				<!-- /.subject -->
				<p class="email">
					<label for="email"><?php _e( 'Email to: ', 'kysbag' ); ?>
						<input type="email" name="email" value="<?php _e( 'demo@domain.com', 'kysbag' ); ?>"/>
					</label>
				</p>
				<!-- /.email -->
				<p class="content">
					<label for="ctn"><?php _e( 'Content: ', 'kysbag' ); ?>
						<textarea name="ctn" id="" cols="30" rows="10">
							<?php the_permalink() ?>
						</textarea>
					</label>
				</p>
				<!-- /.content -->
				<button id="email-link" class="pink-btn" type="submit"><?php _e( 'Send', 'kysbag' ); ?></button>
				<script>
					jQuery('#email-link').click(function () {
						var email_to = jQuery('p.email input').val();
						var email_subject = jQuery('p.subject input').val();
						var email_ctn = jQuery('p.content textarea').val();
						var email_link = 'mailto:' + email_to + '?subject=' + email_subject + '&body=' + email_ctn;
						window.open(email_link);
					});
				</script>
			</div>
		</div>
	</div>
</div>