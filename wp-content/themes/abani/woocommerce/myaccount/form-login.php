<?php
/**
 * Login Form
 *
 * @author        WooThemes
 * @package    WooCommerce/Templates
 * @version     2.2.6
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>

<?php wc_print_notices(); ?>

<?php do_action( 'woocommerce_before_customer_login_form' ); ?>

<div class="row" id="customer_login">


	<?php if ( get_option( 'woocommerce_enable_myaccount_registration' ) === 'yes' ) { ?>
		<div class="col-md-6">
			<h3 class="caption"><?php _e( 'CREATE AN ACCOUNT', 'kysbag' ); ?></h3>
			<h5 class="gray-caption"><?php _e( 'Please enter your email address to create an account.', 'kysbag' ); ?></h5>

			<div class="row">
				<div class="col-md-7">


					<form method="post" class="register-form">

						<?php do_action( 'woocommerce_register_form_start' ); ?>

						<?php if ( 'no' === get_option( 'woocommerce_registration_generate_username' ) ) : ?>

							<div class="form-group">
								<label for="reg_username"><?php _e( 'Username', 'woocommerce' ); ?> <span
										class="required">*</span></label>
								<input type="text" class="input-text" name="username" id="reg_username"
								       value="<?php if ( ! empty( $_POST['username'] ) ) {
									       echo esc_attr( $_POST['username'] );
								       } ?>"/>
							</div>

						<?php endif; ?>

						<div class="form-group">
							<label for="reg_email"><?php _e( 'Email address', 'woocommerce' ); ?> <span
									class="required">*</span></label>
							<input type="email" class="input-text" name="email" id="reg_email"
							       value="<?php if ( ! empty( $_POST['email'] ) ) {
								       echo esc_attr( $_POST['email'] );
							       } ?>"/>
						</div>

						<?php if ( 'no' === get_option( 'woocommerce_registration_generate_password' ) ) : ?>

							<div class="form-group">
								<label for="reg_password"><?php _e( 'Password', 'woocommerce' ); ?> <span
										class="required">*</span></label>
								<input type="password" class="input-text" name="password" id="reg_password"/>
							</div>

						<?php endif; ?>

						<!-- Spam Trap -->
						<div style="<?php echo( ( is_rtl() ) ? 'right' : 'left' ); ?>: -999em; position: absolute;">
							<label
								for="trap"><?php _e( 'Anti-spam', 'woocommerce' ); ?></label><input type="text"
							                                                                        name="email_2"
							                                                                        id="trap"
							                                                                        tabindex="-1"/>
						</div>

						<?php do_action( 'woocommerce_register_form' ); ?>
						<?php do_action( 'register_form' ); ?>

						<div class="form-group">
							<?php wp_nonce_field( 'woocommerce-register' ); ?>
							<input type="submit" class="button orange-btn" name="register"
							       value="<?php _e( 'Create an Account', 'woocommerce' ); ?>"/>
						</div>

						<?php do_action( 'woocommerce_register_form_end' ); ?>

					</form>


				</div>
			</div>
		</div>
	<?php } ?>

	<?php if (get_option( 'woocommerce_enable_myaccount_registration' ) === 'yes') { ?>
	<div class="col-md-6">
		<?php } else { ?>
		<div class="col-md-12">
			<?php } ?>
			<h3 class="caption"><?php _e( 'ALREADY REGISTERED', 'kysbag' ); ?></h3>
			<h5 class="gray-caption"><?php _e( 'Fill all information to login', 'kysbag' ); ?></h5>

			<div class="row">
				<div class="col-md-7">

					<form method="post" class="login-form">

						<?php do_action( 'woocommerce_login_form_start' ); ?>

						<div class="form-group">
							<label for="username"><?php _e( 'Username or email address', 'woocommerce' ); ?> <span
									class="required">*</span></label>
							<input type="text" class="input-text" name="username" id="username"
							       value="<?php if ( ! empty( $_POST['username'] ) ) {
								       echo esc_attr( $_POST['username'] );
							       } ?>"/>
						</div>

						<div class="form-group">
							<label for="password"><?php _e( 'Password', 'woocommerce' ); ?> <span
									class="required">*</span></label>
							<input class="input-text" type="password" name="password" id="password"/>
						</div>

						<div class="form-group">
							<a href="<?php echo esc_url( wc_lostpassword_url() ); ?>"><?php _e( 'Forgot Password?', 'kysbag' ); ?></a>
						</div>
						<?php do_action( 'woocommerce_login_form' ); ?>

						<div class="form-group">
							<?php wp_nonce_field( 'woocommerce-login' ); ?>
							<input type="submit" class="button pink-btn" name="login"
							       value="<?php _e( 'Sign In', 'woocommerce' ); ?>"/>
							<label for="rememberme" class="inline">
								<input name="rememberme" type="checkbox" id="rememberme"
								       value="forever"/> <?php _e( 'Remember me', 'woocommerce' ); ?>
							</label>
						</div>
						<?php do_action( 'woocommerce_login_form_end' ); ?>

					</form>
				</div>
			</div>
		</div>


	</div>


	<?php do_action( 'woocommerce_after_customer_login_form' ); ?>
