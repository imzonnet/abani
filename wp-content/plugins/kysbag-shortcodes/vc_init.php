<?php
if (class_exists('Vc_Manager')) {

	require_once( 'vc_functions.php' );
	require_once( 'vc_templates.php' );


	if ( ! ( function_exists( 'oss_products_query_shortcode' ) ) ) {
		require_once( 'vc_blocks/oss_products_query_shortcode.php' );
	}

	if ( ! ( function_exists( 'oss_recent_posts_shortcode' ) ) ) {
		require_once( 'vc_blocks/oss_recent_posts_shortcode.php' );
	}

	if ( ! ( function_exists( 'oss_testimonials_shortcode' ) ) ) {
		require_once( 'vc_blocks/oss_testimonials_shortcode.php' );
	}

	if ( ! ( function_exists( 'oss_video_bags_shortcode' ) ) ) {
		require_once( 'vc_blocks/oss_video_bags_shortcode.php' );
	}

	if ( ! ( function_exists( 'oss_services_shortcode' ) ) ) {
		require_once( 'vc_blocks/oss_services_shortcode.php' );
	}

}