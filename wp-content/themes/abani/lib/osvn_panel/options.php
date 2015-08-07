<?php
// elusive icons webfont demo: http://shoestrap.org/downloads/elusive-icons-webfont/
global $wp_filesystem;
define( 'THEME_ADMIN_ASSETS_URI', get_template_directory_uri() . '/lib/assets' );

// General
$this->sections[] = array(
	'title'  => __( 'General Settings', 'redux-framework-demo' ),
	'desc'   => __( '', 'redux-framework-demo' ),
	'icon'   => 'el-icon-globe-alt',
	// 'submenu' => false, // Setting submenu to false on a given section will hide it from the WordPress sidebar menu!
	'fields' => array(

		array(
			'id'       => 'favicon',
			'type'     => 'media',
			'url'      => true,
			'title'    => __( 'Upload Favicon', 'redux-framework-demo' ),
			'mode'     => false,
			'desc'     => __( 'Using this option, You can upload your own custom favicon. This size should be 16X16 but if you want to support retina devices upload 32X32 png file.', 'redux-framework-demo' ),
			'subtitle' => __( '', 'redux-framework-demo' ),
			'default'  => false,
		),
		array(
			'id'       => 'logo',
			'type'     => 'media',
			'url'      => true,
			'title'    => __( 'Upload Logo', 'redux-framework-demo' ),
			'mode'     => false,
			'desc'     => __( '', 'redux-framework-demo' ),
			'subtitle' => __( '', 'redux-framework-demo' ),
			'default'  => false,
		),
	),
);

// Header
$this->sections[] = array(
	'title'  => __( 'Header', 'redux-framework-demo' ),
	'desc'   => __( '', 'redux-framework-demo' ),
	'icon'   => 'el-icon-website',
	// 'submenu' => false, // Setting submenu to false on a given section will hide it from the WordPress sidebar menu!
	'fields' => array(
		array(
			'id'       => 'header-search',
			'type'     => 'switch',
			'title'    => __( 'Header Search Form', 'redux-framework-demo' ),
			'subtitle' => __( 'Will stay on right hand of main navigation.', 'redux-framework-demo' ),
			'desc'     => __( 'If you don\'t want this feature just disable it from this option.', 'redux-framework-demo' ),
			"default"  => 1,
			'on'       => 'Enable',
			'off'      => 'Disable',
		),
		array(
			'id'       => 'page-title-pages',
			'type'     => 'switch',
			'title'    => __( 'Page Title : Pages', 'redux-framework-demo' ),
			'subtitle' => __( 'This option will affect Pages.', 'redux-framework-demo' ),
			'desc'     => __( 'If you don\'t want to show page title section (title, breadcrumb) in Pages disable this option. this option will not affect archive, search, 404, category templates as well as blog and portfolio single posts.', 'redux-framework-demo' ),
			"default"  => 1,
			'on'       => 'Enable',
			'off'      => 'Disable',
		),


	),
);


// Footer
$this->sections[] = array(
	'title'  => __( 'Footer', 'redux-framework-demo' ),
	'desc'   => __( '', 'redux-framework-demo' ),
	'icon'   => 'el-icon-photo',
	// 'submenu' => false, // Setting submenu to false on a given section will hide it from the WordPress sidebar menu!
	'fields' => array(

		array(
			'id'       => 'footer',
			'type'     => 'switch',
			'title'    => __( 'Footer', 'redux-framework-demo' ),
			'subtitle' => __( 'Will be located after content. Please note that sub footer will not be affected by this option.', 'redux-framework-demo' ),
			'desc'     => __( 'If you don\'t want to have footer section you can disable it.', 'redux-framework-demo' ),
			"default"  => 1,
			'on'       => 'Enable',
			'off'      => 'Disable',
		),
		array(
			'id'       => 'sub-footer',
			'type'     => 'switch',
			'title'    => __( 'Sub Footer', 'redux-framework-demo' ),
			'subtitle' => __( 'Locates below footer.', 'redux-framework-demo' ),
			'desc'     => __( 'If you don\'t want to have sub footer section you can disable it.', 'redux-framework-demo' ),
			"default"  => 1,
			'on'       => 'Enable',
			'off'      => 'Disable',
		),
		array(
			'id'       => 'footer-copyright',
			'type'     => 'editor',
			'required' => array( 'sub-footer', 'equals', '1' ),
			'title'    => __( 'Sub Footer Copyright text', 'redux-framework-demo' ),
			'subtitle' => __( 'You may write your site copyright information.', 'redux-framework-demo' ),
			'desc'     => '',
			'default'  => 'Copyright All Rights Reserved'
		),
		array(
			'id'       => 'social-facebook',
			'required' => array( 'sub-footer', 'equals', '1' ),
			'type'     => 'text',
			'title'    => __( 'Facebook', 'redux-framework-demo' ),
			'desc'     => __( 'Including http://', 'redux-framework-demo' ),
			'subtitle' => __( 'Sub Footer Social Networks', 'redux-framework-demo' ),
			'default'  => '',
		),
		array(
			'id'       => 'social-twitter',
			'required' => array( 'sub-footer', 'equals', '1' ),
			'type'     => 'text',
			'title'    => __( 'Twitter', 'redux-framework-demo' ),
			'desc'     => __( 'Including http://', 'redux-framework-demo' ),
			'subtitle' => __( 'Sub Footer Social Networks', 'redux-framework-demo' ),
			'default'  => '',
		),
		array(
			'id'       => 'social-rss',
			'required' => array( 'sub-footer', 'equals', '1' ),
			'type'     => 'text',
			'title'    => __( 'RSS', 'redux-framework-demo' ),
			'desc'     => __( 'Including http://', 'redux-framework-demo' ),
			'subtitle' => __( 'Sub Footer Social Networks', 'redux-framework-demo' ),
			'default'  => '',
		),
		array(
			'id'       => 'social-dribbble',
			'required' => array( 'sub-footer', 'equals', '1' ),
			'type'     => 'text',
			'title'    => __( 'Dribbble', 'redux-framework-demo' ),
			'desc'     => __( 'Including http://', 'redux-framework-demo' ),
			'subtitle' => __( 'Sub Footer Social Networks', 'redux-framework-demo' ),
			'default'  => '',
		),
		array(
			'id'       => 'social-pinterest',
			'required' => array( 'sub-footer', 'equals', '1' ),
			'type'     => 'text',
			'title'    => __( 'Pinterest', 'redux-framework-demo' ),
			'desc'     => __( 'Including http://', 'redux-framework-demo' ),
			'subtitle' => __( 'Sub Footer Social Networks', 'redux-framework-demo' ),
			'default'  => '',
		),
		array(
			'id'       => 'social-instagram',
			'required' => array( 'sub-footer', 'equals', '1' ),
			'type'     => 'text',
			'title'    => __( 'Instagram', 'redux-framework-demo' ),
			'desc'     => __( 'Including http://', 'redux-framework-demo' ),
			'subtitle' => __( 'Sub Footer Social Networks', 'redux-framework-demo' ),
			'default'  => '',
		),
		array(
			'id'       => 'social-google-plus',
			'required' => array( 'sub-footer', 'equals', '1' ),
			'type'     => 'text',
			'title'    => __( 'Google Plus', 'redux-framework-demo' ),
			'desc'     => __( 'Including http://', 'redux-framework-demo' ),
			'subtitle' => __( 'Sub Footer Social Networks', 'redux-framework-demo' ),
			'default'  => '',
		),
		array(
			'id'       => 'social-linkedin',
			'required' => array( 'sub-footer', 'equals', '1' ),
			'type'     => 'text',
			'title'    => __( 'Linkedin', 'redux-framework-demo' ),
			'desc'     => __( 'Including http://', 'redux-framework-demo' ),
			'subtitle' => __( 'Sub Footer Social Networks', 'redux-framework-demo' ),
			'default'  => '',
		),
		array(
			'id'       => 'social-youtube',
			'required' => array( 'sub-footer', 'equals', '1' ),
			'type'     => 'text',
			'title'    => __( 'Youtube', 'redux-framework-demo' ),
			'desc'     => __( 'Including http://', 'redux-framework-demo' ),
			'subtitle' => __( 'Sub Footer Social Networks', 'redux-framework-demo' ),
			'default'  => '',
		),
		array(
			'id'       => 'social-tumblr',
			'required' => array( 'sub-footer', 'equals', '1' ),
			'type'     => 'text',
			'title'    => __( 'Tumblr', 'redux-framework-demo' ),
			'desc'     => __( 'Including http://', 'redux-framework-demo' ),
			'subtitle' => __( 'Sub Footer Social Networks', 'redux-framework-demo' ),
			'default'  => '',
		),


	),
);


// Skin
$this->sections[] = array(
	'title'  => __( 'Skin', 'redux-framework-demo' ),
	'desc'   => __( '', 'redux-framework-demo' ),
	'icon'   => 'el-icon-tint',
	'fields' => array(

		array(
			'id'       => 'custom-css',
			'type'     => 'ace_editor',
			'title'    => __( 'Custom CSS', 'redux-framework-demo' ),
			'subtitle' => __( 'Add some quick css into this box.', 'redux-framework-demo' ),
			'mode'     => 'css',
			'theme'    => 'monokai',
			'default'  => ""
		),
		array(
			'id'       => 'custom-js',
			'type'     => 'ace_editor',
			'title'    => __( 'Custom JS', 'redux-framework-demo' ),
			'subtitle' => __( 'Script will be placed in an script tag in document footer', 'redux-framework-demo' ),
			'mode'     => 'javascript',
			'theme'    => 'chrome',
			'default'  => ""
		),

	),
);



// Blog
$this->sections[] = array(
	'title'  => __( 'Blog', 'redux-framework-demo' ),
	'desc'   => __( '', 'redux-framework-demo' ),
	'icon'   => 'el-icon-pencil',
	'fields' => array(

		array(
			'id'       => 'page-title-blog',
			'type'     => 'switch',
			'title'    => __( 'Page Title : Blog Posts', 'redux-framework-demo' ),
			'subtitle' => __( 'This option will affect Blog single posts.', 'redux-framework-demo' ),
			'desc'     => __( 'If you don\'t want to show page title section (title, breadcrumb) in blog single posts disable this option.', 'redux-framework-demo' ),
			"default"  => 1,
			'on'       => 'Enable',
			'off'      => 'Disable',
		),
		array(
			'id'       => 'single-blog-layout',
			'type'     => 'image_select',
			'title'    => __( 'Single Layout', 'redux-framework-demo' ),
			'subtitle' => __( 'Defines Single layout.', 'redux-framework-demo' ),
			'desc'     => __( '', 'redux-framework-demo' ),
			'options'  => array(
				'left'  => array( 'alt' => '1 Column', 'img' => THEME_ADMIN_ASSETS_URI . '/img/left_layout.png' ),
				'right' => array( 'alt' => '2 Column', 'img' => THEME_ADMIN_ASSETS_URI . '/img/right_layout.png' ),
				'full'  => array( 'alt' => '3 Column', 'img' => THEME_ADMIN_ASSETS_URI . '/img/full_layout.png' ),
			),
			'default'  => 'right'
		),
		array(
			'id'       => 'archive-layout',
			'type'     => 'image_select',
			'title'    => __( 'Archive Layout', 'redux-framework-demo' ),
			'subtitle' => __( 'Defines archive loop layout.', 'redux-framework-demo' ),
			'desc'     => __( '', 'redux-framework-demo' ),
			'options'  => array(
				'left'  => array( 'alt' => '1 Column', 'img' => THEME_ADMIN_ASSETS_URI . '/img/left_layout.png' ),
				'right' => array( 'alt' => '2 Column', 'img' => THEME_ADMIN_ASSETS_URI . '/img/right_layout.png' ),
				'full'  => array( 'alt' => '3 Column', 'img' => THEME_ADMIN_ASSETS_URI . '/img/full_layout.png' ),
			),
			'default'  => 'right'
		),
		array(
			'id'       => 'archive-page-title',
			'type'     => 'switch',
			'title'    => __( 'Archive Loop Page Title', 'redux-framework-demo' ),
			'subtitle' => __( 'Using this option you can enable/disable page title section (including breadcrumbs)', 'redux-framework-demo' ),
			"default"  => 1,
			'on'       => 'Enable',
			'off'      => 'Disable',
		),

	),
);

// Woo
$this->sections[] = array(
	'title'  => __( 'Woocommerce', 'redux-framework-demo' ),
	'desc'   => __( '', 'redux-framework-demo' ),
	'icon'   => 'el-icon-shopping-cart',
	'fields' => array(
		array(
			'id'      => 'random-box',
			'type'    => 'switch',
			'title'   => __( 'Display Random Products on Shop/Categories', 'redux-framework-demo' ),
			"default" => 1,
			'on'      => 'Enable',
			'off'     => 'Disable',
		),
		array(
			'id'      => 'random-box-sc',
			'type'    => 'text',
			'title'   => __( 'Random Products Shortcode', 'redux-framework-demo' ),
			'default' => '[oss_products_query title="YOU MIGHT ALSO LIKE" per_page="30" exclude="" orderby="rand"]',

		),

	),
);


$theme_info = '<div class="redux-framework-section-desc">';
$theme_info .= '<p class="redux-framework-theme-data description theme-uri">' . __( '<strong>Theme URL:</strong> ', 'redux-framework-demo' ) . '<a href="' . $this->theme->get( 'ThemeURI' ) . '" target="_blank">' . $this->theme->get( 'ThemeURI' ) . '</a></p>';
$theme_info .= '<p class="redux-framework-theme-data description theme-author">' . __( '<strong>Author:</strong> ', 'redux-framework-demo' ) . $this->theme->get( 'Author' ) . '</p>';
$theme_info .= '<p class="redux-framework-theme-data description theme-version">' . __( '<strong>Version:</strong> ', 'redux-framework-demo' ) . $this->theme->get( 'Version' ) . '</p>';
$theme_info .= '<p class="redux-framework-theme-data description theme-description">' . $this->theme->get( 'Description' ) . '</p>';
$tabs = $this->theme->get( 'Tags' );
if ( ! empty( $tabs ) ) {
	$theme_info .= '<p class="redux-framework-theme-data description theme-tags">' . __( '<strong>Tags:</strong> ', 'redux-framework-demo' ) . implode( ', ', $tabs ) . '</p>';
}
$theme_info .= '</div>';

if ( file_exists( dirname( __FILE__ ) . '/../README.md' ) ) {
	$this->sections['theme_docs'] = array(
		'icon'   => 'el-icon-list-alt',
		'title'  => __( 'Documentation', 'redux-framework-demo' ),
		'fields' => array(
			array(
				'id'       => '17',
				'type'     => 'raw',
				'markdown' => true,
				'content'  => $wp_filesystem->get_contents( dirname( __FILE__ ) . '/../README.md' )
			),
		),
	);
}
$this->sections[] = array(
	'title'  => __( 'Import / Export', 'redux-framework-demo' ),
	'desc'   => __( 'Import and Export your Redux Framework settings from file, text or URL.', 'redux-framework-demo' ),
	'icon'   => 'el-icon-refresh',
	'fields' => array(
		array(
			'id'         => 'opt-import-export',
			'type'       => 'import_export',
			'title'      => 'Import Export',
			'subtitle'   => 'Save and restore your Redux options',
			'full_width' => false,
		),
	),
);

$this->sections[] = array(
	'type' => 'divide',
);

$this->sections[] = array(
	'icon'   => 'el-icon-info-sign',
	'title'  => __( 'Theme Information', 'redux-framework-demo' ),
	'desc'   => __( '<p class="description">This is the Description. Again HTML is allowed</p>', 'redux-framework-demo' ),
	'fields' => array(
		array(
			'id'      => 'opt-raw-info',
			'type'    => 'raw',
			'content' => $item_info,
		)
	),
);