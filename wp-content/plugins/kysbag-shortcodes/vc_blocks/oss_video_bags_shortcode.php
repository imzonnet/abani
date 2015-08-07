<?php

/**
 * The Shortcode
 */
function oss_video_bags_shortcode( $atts, $content = null ) {
	$atts = shortcode_atts(
		array(
			'title' => '',
			'link'  => '',
			'ctn'   => ''
		), $atts );

	ob_start(); ?>
	<div class="custom-blocks">
		<?php if ( $atts['title'] ) { ?>
			<h3 class="border-caption">
				<?php echo htmlspecialchars_decode( $atts['title'] ); ?>
			</h3>
		<?php } ?>
		<div class="wrap-video-bags">
			<div class="video-player-link">
				<?php global $wp_embed;
				$embed = $wp_embed->run_shortcode( '[embed]' . $atts['link'] . '[/embed]' );
				echo $embed;
				?>
			</div>
			<?php echo wpautop( do_shortcode( $atts['ctn'] ) ); ?>
		</div>
	</div>
	<!-- /.custom-blocks -->

	<?php
	$output = ob_get_contents();
	ob_end_clean();

	return $output;
}

add_shortcode( 'oss_video_bags', 'oss_video_bags_shortcode' );

/**
 * The VC Functions
 */
function oss_video_bags_shortcode_vc() {
	vc_map(
		array(
			'icon'     => 'oss-vc-video-bags',
			'name'     => __( 'OSS - Video Bags', 'kysbag' ),
			'base'     => 'oss_video_bags',
			'category' => __( 'OSS - Content', 'kysbag' ),
			'params'   => array(
				array(
					'type'       => 'textfield',
					'heading'    => __( 'Title', 'kysbag' ),
					'param_name' => 'title',
					'value'      => 'Video Bags',
				),
				array(
					'type'        => 'textfield',
					'heading'     => __( 'Video link', 'kysbag' ),
					'param_name'  => 'link',
					'admin_label' => true,
					'description' => sprintf( __( 'Link to the video. More about supported formats at %s.', 'kysbag' ), '<a href="http://codex.wordpress.org/Embeds#Okay.2C_So_What_Sites_Can_I_Embed_From.3F" target="_blank">WordPress codex page</a>' )
				),
				array(
					'type'       => 'textarea_html',
					'holder'     => 'div',
					'heading'    => __( 'Text', 'js_composer' ),
					'param_name' => 'ctn',
					'value'      => __( '<p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>', 'kysbag' )
				),
			)
		)
	);
}

add_action( 'vc_before_init', 'oss_video_bags_shortcode_vc' );