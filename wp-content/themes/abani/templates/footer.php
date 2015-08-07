<?php
global $osvn_opt;
?>
<?php if ( $osvn_opt['footer'] == true ) { ?>
	<div class="usertip">
		<div class="container">
			<div class="row">
				<div class="col-md-4 pdr-70">
					<?php 
					if(is_active_sidebar('sidebar-footer-1')){
						dynamic_sidebar( 'sidebar-footer-1' ); 
					}
					?>
				</div>
				<div class="col-md-4 pdlr-50">
					<?php 
					if(is_active_sidebar('sidebar-footer-2')){
						dynamic_sidebar( 'sidebar-footer-2' ); 
					}
					?>
				</div>
				<div class="col-md-4 pdl-70">
					<?php 
					if(is_active_sidebar('sidebar-footer-3')){
						dynamic_sidebar( 'sidebar-footer-3' ); 
					}
					?>
				</div>
			</div>
            
            <div class="row">
                <div class="col-md-12">
                    <?php
                    if(is_active_sidebar('sidebar-footer')) {
                        dynamic_sidebar( 'sidebar-footer' ); 
                    }
                    ?>
                </div>
            </div>
		</div>
	</div>
	<!-- /.usertip -->
	<?php if ( $osvn_opt['sub-footer'] == true ) { ?>
		<footer>
			<div class="container">
				<div class="row">
					<div class="col-md-6 left-footer clearfix">
						<h3><?php _e( 'Join Our Communication', 'kysbag' ); ?></h3>
						<ul class="list-social">
							<?php if ( isset( $osvn_opt['social-facebook'] ) && ! empty( $osvn_opt['social-facebook'] ) ) { ?>
								<li><a class="facebook"
								       href="<?php echo esc_url( $osvn_opt['social-facebook'] ); ?>">facebook</a>
								</li>

							<?php }
							if ( isset( $osvn_opt['social-twitter'] ) && ! empty( $osvn_opt['social-twitter'] ) ) { ?>
								<li><a class="twitter" href="<?php echo esc_url( $osvn_opt['social-twitter'] ); ?>">twitter</a>
								</li>

							<?php }
							if ( isset( $osvn_opt['social-google-plus'] ) && ! empty( $osvn_opt['social-google-plus'] ) ) { ?>
								<li><a class="googleplus"
								       href="<?php echo esc_url( $osvn_opt['social-google-plus'] ); ?>">googleplus</a>
								</li>

							<?php }
							if ( isset( $osvn_opt['social-pinterest'] ) && ! empty( $osvn_opt['social-pinterest'] ) ) { ?>
								<li><a class="pinterest" href="<?php echo esc_url( $osvn_opt['social-pinterest'] ); ?>">pinterest</a>
								</li>

							<?php }
							if ( isset( $osvn_opt['social-instagram'] ) && ! empty( $osvn_opt['social-instagram'] ) ) { ?>
								<li><a class="instagram" href="<?php echo esc_url( $osvn_opt['social-instagram'] ); ?>">instagram</a>
								</li>
							<?php } ?>
						</ul>
					</div>
					<div class="col-md-6 right-footer">
						<div class="clearfix">
							<?php
							if ( in_array( 'woocommerce-currency-switcher/index.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) { ?>
								<div class="wrap-select-currency">
									<?php echo do_shortcode( '[woocs show_flags=0]' ); ?>
								</div>
							<?php } ?>


							<?php oss_language_selector(); ?>
						</div>
						<div class="copyright"><?php echo wpautop( $osvn_opt['footer-copyright'] ); ?></div>

					</div>
				</div>
			</div>
		</footer>
	<?php } ?>
<?php } ?>
<div id="alert-ajax">
	<div class="modal fade" id="alert-ajax-modal" tabindex="-1" role="dialog" aria-labelledby="alert-ajax" aria-hidden="true">
		<div class="modal-dialog" style="margin-top: 150px">
		</div>
	</div>
</div>
<!-- /#alert-ajax -->

<script type="application/javascript">
	(function ($) {
		"use strict";
		$('.logo').attr('name', 'pcs_team_social_[]');

		$('.ajax-add-to-cart').click(function () {
			var p_id = $(this).attr('data-id');

			$.ajax({
				type: 'post',
				url: '<?php echo admin_url( 'admin-ajax.php' ); ?>',
				data: {
					action: 'oss_add_simgple_product',
					product_id: p_id,
					nonce: '<?php echo wp_create_nonce('oss_add_simgple_product'); ?>'
				},
				success: function (data) {
					data = $.parseJSON(data);
					$('#alert-ajax .modal-dialog').html(data['body']);
					$('#alert-ajax-modal').modal();
					$('#cart-num').html(data['menu']);
				}
			});
		});
		$('.ajax-add-to-wishlist').click(function () {
			var c = {
				add_to_wishlist: $(this).attr('data-product-id'),
				product_type: $(this).attr('data-product-type'),
				action: yith_wcwl_l10n.actions.add_to_wishlist_action
			};

			$.ajax({
				type: "POST",
				url: yith_wcwl_l10n.ajax_url,
				data: c,
				dataType: "json",
				success: function (a) {
					console.log(a);
					var box_ctn_class;
					if (a.result == 'true') {
						box_ctn_class = 'alert-success';
					}
					else if (a.result == 'exists') {
						box_ctn_class = 'alert-warning';
					}
					else {
						box_ctn_class = 'alert-danger';
					}
					$('#alert-ajax .modal-dialog').html('<div class="alert ' + box_ctn_class + '"	role = "alert" >' + a.message + '</div>');
					$('#alert-ajax-modal').modal();
					$.ajax({
						type: 'post',
						url: '<?php echo admin_url( 'admin-ajax.php' ); ?>',
						data: {
							action: 'oss_wl_count'
						},
						success: function (a) {
							$('a.top-wishlist span').html(a);
							$('a.compare-btn span').html(a);
						}
					});


				}
			});


		});


	})(jQuery);

	<?php echo esc_js($osvn_opt['custom-js']); ?>

</script>

