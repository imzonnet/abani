<?php
	/*
	Plugin Name: Kysbag shortcodes
	Plugin URI: http://wordpress.org/
	Description: Shortcode Visual Composer.
	Version: 1.0
	Text Domain: kysbag
	License: GPL version 2 or later - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
	*/

	define('KYSBAG_SHORTCODES_VERSION', '1.0');
	define('KYSBAG_SHORTCODES_PATH', dirname(__FILE__));

	/**
	* Load vc shortcode
	*/
	if (class_exists('Vc_Manager')) {
		require KYSBAG_SHORTCODES_PATH . '/vc_init.php';
	}