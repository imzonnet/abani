<?php

namespace Roots\Sage\Assets;

/**
 * Scripts and stylesheets
 *
 * Enqueue stylesheets in the following order:
 * 1. /theme/dist/styles/main.css
 *
 * Enqueue scripts in the following order:
 * 1. Latest jQuery via Google CDN (if enabled in config.php)
 * 2. /theme/dist/scripts/modernizr.js
 * 3. /theme/dist/scripts/main.js
 *
 * Google Analytics is loaded after enqueued scripts if:
 * - An ID has been defined in config.php
 * - You're not logged in as an administrator
 */

class JsonManifest {
	private $manifest;

	public function __construct( $manifest_path ) {
	}

	public function get() {
		return $this->manifest;
	}

	public function getPath( $key = '', $default = null ) {
		$collection = $this->manifest;
		if ( is_null( $key ) ) {
			return $collection;
		}
		if ( isset( $collection[ $key ] ) ) {
			return $collection[ $key ];
		}
		foreach ( explode( '.', $key ) as $segment ) {
			if ( ! isset( $collection[ $segment ] ) ) {
				return $default;
			} else {
				$collection = $collection[ $segment ];
			}
		}

		return $collection;
	}
}

function asset_path( $filename ) {
	$dist_path = get_template_directory_uri() . DIST_DIR;
	$directory = dirname( $filename ) . '/';
	$file      = basename( $filename );

	return $dist_path . $directory . $file;
}

function bower_map_to_cdn( $dependency, $fallback ) {
	static $bower;

	if ( empty( $bower ) ) {
		$bower_path = get_template_directory() . '/bower.json';
		$bower      = new JsonManifest( $bower_path );
	}

	$templates = array(
		'google' => '//ajax.googleapis.com/ajax/libs/%name%/%version%/%file%'
	);

	$version = $bower->getPath( 'dependencies.' . $dependency['name'] );

	if ( isset( $version ) && preg_match( '/^(\d+\.){2}\d+$/', $version ) ) {
		$search  = array( '%name%', '%version%', '%file%' );
		$replace = array( $dependency['name'], $version, $dependency['file'] );

		return str_replace( $search, $replace, $templates[ $dependency['cdn'] ] );
	} else {
		return $fallback;
	}

}

function assets() {
	global $wp_styles, $wp_scripts;;

	wp_enqueue_style( 'minimal-menu-ie', asset_path( 'styles/minimal-menu-ie.css' ), false, null );
	$wp_styles->add_data( 'minimal-menu-ie', 'conditional', 'lte IE 8' );
	wp_enqueue_style( 'styles-main', get_template_directory_uri(). '/style.css', false, null );


	if ( is_single() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	wp_enqueue_script( 'prefixfree', asset_path( 'scripts/libs/prefixfree.min.js' ), array(), null, false );
	wp_enqueue_script( 'modernizr', asset_path( 'scripts/libs/modernizr.js' ), array(), null, false );

	
    
	wp_enqueue_script( 'fancySelect', asset_path( 'scripts/libs/fancySelect.js' ), array(), null, true );
    wp_enqueue_script( 'fancybox', asset_path( 'scripts/libs/jquery.fancybox.pack.js' ), array(), null, true );

    
    if(is_singular('product')) {
        wp_enqueue_script( 'responsiveTabs', asset_path( 'scripts/libs/jquery.responsiveTabs.min.js' ), array(), null, true );
    }
    
    if(is_front_page()) {
	   wp_enqueue_script( 'jcarousel', asset_path( 'scripts/libs/jquery.jcarousel.min.js' ), array(), null, true );
	   wp_enqueue_script( 'jcarousel-responsive', asset_path( 'scripts/jcarousel.responsive.js' ), array(), null, true );
    }
    
    if(is_page(1176)) {
        wp_enqueue_script( 'maps', '//maps.google.com/maps/api/js?sensor=true', array(), null, true );
        wp_enqueue_script( 'gmaps', asset_path( 'scripts/libs/gmaps.js' ), array(), null, true );
    }
    
    wp_enqueue_script( 'bootstrap', asset_path( 'scripts/libs/bootstrap.min.js' ), array(), null, true );
    wp_enqueue_script( 'bootstrap-slider', asset_path( 'scripts/libs/bootstrap-slider.min.js' ), array(), null, true );
    wp_enqueue_script( 'raty-fa', asset_path( 'scripts/libs/jquery.raty-fa.js' ), array(), null, true );
	wp_enqueue_script( 'sticky-kit', asset_path( 'scripts/libs/jquery.sticky-kit.js' ), array(), null, true );
	
	wp_enqueue_script( 'jspatch', asset_path( 'scripts/jspatch.js' ), array(), null, true );
	
    wp_enqueue_script( 'jquery-touch-punch' );
    
	wp_enqueue_script( 'mousewheel', asset_path( 'scripts/libs/jquery.mousewheel.min.js' ), array(), null, true );
	wp_enqueue_script( 'allinone_bannerRotator', asset_path( 'scripts/libs/allinone_bannerRotator.js' ), array(), null, true );
	wp_enqueue_script( 'allinone_bannerWithPlaylist', asset_path( 'scripts/libs/allinone_bannerWithPlaylist.js' ), array(), null, true );
	wp_enqueue_script( 'perfect-scrollbar', asset_path( 'scripts/libs/perfect-scrollbar.min.js' ), array(), null, true );
	wp_enqueue_script( 'functions', asset_path( 'scripts/functions.js' ), array(), null, true );


}

add_action( 'wp_enqueue_scripts', __NAMESPACE__ . '\\assets', 100 );

/** Scripts for IE */
function script_for_ie() {

	echo ' <!--[if lt IE 9]>';
	echo '<script src="' . asset_path( 'scripts/libs/html5shiv.js' ) . '"></script>';
	echo '<script src="' . asset_path( 'scripts/libs/respond.js' ) . '"></script>';
	echo '<![endif]-->';

}

add_action( 'wp_head', __NAMESPACE__ . '\\script_for_ie' );


// http://wordpress.stackexchange.com/a/12450
function jquery_local_fallback( $src, $handle = null ) {
	static $add_jquery_fallback = false;

	if ( $add_jquery_fallback ) {
		echo '<script>window.jQuery || document.write(\'<script src="' . $add_jquery_fallback . '"><\/script>\')</script>' . "\n";
		$add_jquery_fallback = false;
	}

	if ( $handle === 'jquery' ) {
		$add_jquery_fallback = apply_filters( 'script_loader_src', asset_path( 'scripts/jquery.js' ), 'jquery-fallback' );
	}

	return $src;
}

add_action( 'wp_head', __NAMESPACE__ . '\\jquery_local_fallback' );

/**
 * Google Analytics snippet from HTML5 Boilerplate
 *
 * Cookie domain is 'auto' configured. See: http://goo.gl/VUCHKM
 */
function google_analytics() {
	?>
	<script>
		<?php if (WP_ENV === 'production' && !current_user_can('manage_options')) : ?>
		(function (b, o, i, l, e, r) {
			b.GoogleAnalyticsObject = l;
			b[l] || (b[l] =
				function () {
					(b[l].q = b[l].q || []).push(arguments)
				});
			b[l].l = +new Date;
			e = o.createElement(i);
			r = o.getElementsByTagName(i)[0];
			e.src = '//www.google-analytics.com/analytics.js';
			r.parentNode.insertBefore(e, r)
		}(window, document, 'script', 'ga'));
		<?php else : ?>
		function ga() {
			if (window.console) {
				console.log('Google Analytics: ' + [].slice.call(arguments));
			}
		}
		<?php endif; ?>
		ga('create', '<?php echo GOOGLE_ANALYTICS_ID; ?>', 'auto');
		ga('send', 'pageview');
	</script>
<?php
}

if ( GOOGLE_ANALYTICS_ID ) {
	add_action( 'wp_footer', __NAMESPACE__ . '\\google_analytics', 20 );
}