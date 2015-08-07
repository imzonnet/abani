<?php

/**
 * The Shortcode
 */
function oss_testimonials_shortcode( $atts, $content = null ) {
	$atts = shortcode_atts(
		array(
			'per_page'      => 2,
			'exclude'       => false,
			'exclude_posts' => '',
			'orderby'       => 'title',
			'order'         => 'asc'
		), $atts );

	$args = array(
		'post_type'           => 'testimonial',
		'post_status'         => 'publish',
		'ignore_sticky_posts' => 1,
		'posts_per_page'      => $atts['per_page'],
		'orderby'             => $atts['orderby'],
		'order'               => $atts['order'],
	);

	if ( $atts['exclude'] == true ) {
		$exclude_posts        = trim( $atts['exclude_posts'] );
		$exclude_posts        = explode( ',', $exclude_posts );
		$args['post__not_in'] = $exclude_posts;
	}

	$testimonials = new WP_Query( $args );

	ob_start(); ?>

	<?php
	if ( $testimonials->have_posts() ) { ?>
		<div class="testimonials">
			<div class="row">
				<?php while ( $testimonials->have_posts() ): $testimonials->the_post(); ?>
					<div class="col-md-6">
						<div class="testimonials-item">
							<div class="testimonials-left">
								<span><?php _e( '&ldquo;', 'kysbag' ); ?></span>
							</div>
							<div class="testimonials-body">
								<div><?php the_content(); ?></div>
								<p class="testimonials-name">- <?php the_title(); ?></p>
							</div>
						</div>
					</div>
				<?php endwhile; ?>
			</div>
		</div>
		<!-- /.testimonials -->
	<?php }
    wp_reset_postdata() ;
	$output = ob_get_contents();
	ob_end_clean();

	return $output;
}

add_shortcode( 'oss_testimonials', 'oss_testimonials_shortcode' );

/**
 * The VC Functions
 */
function oss_testimonials_shortcode_vc() {
	$order_by_values = array(
		'',
		__( 'Date', 'kysbag' )          => 'date',
		__( 'ID', 'kysbag' )            => 'ID',
		__( 'Author', 'kysbag' )        => 'author',
		__( 'Title', 'kysbag' )         => 'title',
		__( 'Modified', 'kysbag' )      => 'modified',
		__( 'Random', 'kysbag' )        => 'rand',
		__( 'Comment count', 'kysbag' ) => 'comment_count',
		__( 'Menu order', 'kysbag' )    => 'menu_order',
	);

	$order_way_values = array(
		'',
		__( 'Descending', 'kysbag' ) => 'DESC',
		__( 'Ascending', 'kysbag' )  => 'ASC',
	);
	vc_map(
		array(
			'icon'     => 'oss-vc-testimonials',
			'name'     => __( 'OSS - Testimonials', 'kysbag' ),
			'base'     => 'oss_testimonials',
			'category' => __( 'OSS - Post', 'kysbag' ),
			'params'   => array(
				array(
					'type'       => 'textfield',
					'heading'    => __( 'How many testimonial to show?', 'kysbag' ),
					'param_name' => 'per_page',
					'value'      => 2,
				),
				array(
					'type'       => 'checkbox',
					'heading'    => __( 'Exclude?', 'kysbag' ),
					'param_name' => 'exclude',
					'value'      => array( __( 'Yes, please', 'kysbag' ) => true ),
				),
				array(
					'type'        => 'textfield',
					'heading'     => __( 'Exclude IDs', 'kysbag' ),
					'param_name'  => 'exclude_posts',
					'Description' => __( 'Enter ids to exclude, separated by commas. Ex: 1,2,3', 'kysbag' ),
					'value'       => '',
				),
				array(
					'type'       => 'dropdown',
					'heading'    => __( 'Order by', 'kysbag' ),
					'param_name' => 'orderby',
					'value'      => $order_by_values,
				),
				array(
					'type'       => 'dropdown',
					'heading'    => __( 'Order way', 'kysbag' ),
					'param_name' => 'order',
					'value'      => $order_way_values,
				),
			)
		)
	);
}

add_action( 'vc_before_init', 'oss_testimonials_shortcode_vc' );

