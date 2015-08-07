<?php use Roots\Sage\Nav;

global $osvn_opt;
?>
<div class="topbar">
	<div class="container">
		<div class="left-topbar">
			<?php
			if ( is_user_logged_in() ) {
				_e( 'Welcome ', 'kysbag' );
				global $current_user;
				echo esc_attr($current_user->display_name);
			} else { ?>
				<?php _e( 'Welcome visitor, you can ', 'kysbag' ); ?>
				<a href="<?php echo esc_url(wp_login_url( get_permalink() )); ?>">
					<?php _e( 'login ', 'kysbag' ); ?>
				</a>
				<?php _e( ' or  ', 'kysbag' ); ?>
				<a href="<?php echo esc_url(wp_registration_url()); ?>">
					<?php _e( 'create an account', 'kysbag' ); ?>
				</a>.
			<?php }
			?>

		</div>
		<!-- /.left-topbar -->
		<?php
		if (has_nav_menu('top_navigation')) :
		// Top Menu
		wp_nav_menu( array(
			'theme_location' => 'top_navigation',
			'menu_class'     => 'right-topbar',
			'container'      => '',
		) );
		endif;
		?>
		<!-- /.right-topbar -->
	</div>
</div>
<!-- /.topbar -->
<header
	<?php
	$header_image = get_header_image();
	if ( ! empty( $header_image ) ) { ?>
		style="background-image: url(<?php header_image(); ?>)"
	<?php } ?>
	>
	<div class="container">
		<a class="logo" href="<?php echo esc_url( home_url() ); ?>">
			<?php if(isset($osvn_opt['logo']['url']) && !empty($osvn_opt['logo']['url'])):?>
			<img src="<?php echo esc_attr( $osvn_opt['logo']['url'] ); ?>" alt="img"/>
			<?php else:?>
			<img src="<?php echo get_template_directory_uri();?>/assets/images/logo.png" alt="img"/>
			<?php endif;?>
		</a>
		<!-- /.logo -->
		<nav class="main-nav">
			<div class="minimal-menu">
				<?php
				if (has_nav_menu('primary_navigation')) :
				// Main Menu
				wp_nav_menu( array(
					'theme_location' => 'primary_navigation',
					'menu_class'     => 'menu',
					'container'      => '',
				) );
				endif;
				?>
			</div>
			<!-- /.minimal-menu -->
		</nav>
		<!-- /.main-nav -->
		<?php if ( $osvn_opt['header-search'] == true ) { ?>
			<div class="wrap-search">
				<form action="<?php echo esc_url( home_url( '/' ) ); ?>" class="search-form">
					<input type="text" placeholder="<?php _e( 'Search Bags..', 'kysbag' ); ?>"
					       value="<?php echo esc_attr(get_search_query()); ?>" name="s" required/>
					<button type="submit"><i class="fa fa-search"></i></button>
				</form>
			</div>
			<!-- /.search-form -->
		<?php } ?>
		<?php
		/**
		 * Check if WooCommerce is active
		 **/
		if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) { ?>
			<div class="top-cart">
				<a href="<?php echo esc_url( WC()->cart->get_cart_url() ); ?>" class="top-cart">
					<?php _e( 'YOUR CART', 'kysbag' ); ?>
					<span id="cart-num"><?php echo WC()->cart->cart_contents_count; ?></span>
				</a>
			</div>
			<!-- /.top-cart -->
		<?php }
		?>

	</div>
</header>