<?php
if ( function_exists( 'vc_set_as_theme' ) ) {
	function oss_vcSetAsTheme() {
		vc_set_as_theme();
	}

	add_action( 'vc_before_init', 'oss_vcSetAsTheme' );
}