<?php

/**
 * The Shortcode
 */
function oss_services_shortcode( $atts, $content = null ) {
	$atts = shortcode_atts(
		array(
			'bg'    => '',
			'class' => 'sale',
		), $atts );

	ob_start(); ?>
	<div class="services">
		<div class="<?php echo esc_attr($atts['class']) ?>"
			<?php
			if ( ! empty( $atts['bg'] ) ) {
				$bg     = wp_get_attachment_image_src( $atts['bg'], array( 380, 300 ) );
				$bg_src = $bg[0];
				echo 'style="background: url(' . $bg_src . ') no-repeat;"';
			}
			?>><p>
			<?php 
			//echo wpautop( do_shortcode( str_replace( '`', '', $content ) ) ); 
			echo apply_filters( 'the_content', $content );
			?>

		</div>
		<!-- /.<?php echo $atts['class'] ?> -->
	</div>
	<!-- /.services -->

	<?php
	$output = ob_get_contents();
	ob_end_clean();

	return $output;
}

add_shortcode( 'oss_services', 'oss_services_shortcode' );

/**
 * The VC Functions
 */
function oss_services_shortcode_vc() {

	$classes = array(
		'sale',
		'trending',
		'shipping',
	);

	vc_map(
		array(
			'icon'     => 'oss-vc-services',
			'name'     => __( 'OSS - Services', 'kysbag' ),
			'base'     => 'oss_services',
			'category' => __( 'OSS - Content', 'kysbag' ),
			'params'   => array(
				array(
					'type'       => 'textarea_html',
					'holder'     => 'div',
					'heading'    => __( 'Content', 'kysbag' ),
					'param_name' => 'content',
					'value'      => ''
				),
				array(
					'type'        => 'attach_image',
					'heading'     => __( 'Background', 'kysbag' ),
					'param_name'  => 'bg',
					'description' => __( 'Select images from media library.', 'kysbag' )
				),
				array(
					'type'       => 'dropdown',
					'heading'    => __( 'Type', 'kysbag' ),
					'param_name' => 'class',
					'value'      => $classes,
				),

			)
		)
	);
}

add_action( 'vc_before_init', 'oss_services_shortcode_vc' );


function oss_discount_shortcode( $atts, $content = null ) {
	$atts = shortcode_atts(
		array(
			'value' => '10',
			'type'  => '%',
			'text'  => 'off'
		), $atts );

	return '<div class=discount><span class=big>' . $atts['value'] . '</span><span class=small>' . $atts['type'] . '</span><br />' . $atts['text'] . '</div>';

}

add_shortcode( 'discount', 'oss_discount_shortcode' );