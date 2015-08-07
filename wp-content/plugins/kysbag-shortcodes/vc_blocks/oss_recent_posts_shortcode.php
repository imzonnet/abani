<?php

/**
 * The Shortcode
 */
function oss_recent_posts_shortcode( $atts, $content = null ) {
	$atts = shortcode_atts(
		array(
			'title'         => '',
			'per_page'      => 2,
			'load_more'     => false,
			'exclude'       => false,
			'exclude_posts' => '',
			'exclude_cat'   => false,
			'exclude_cats'  => '',
			'orderby'       => 'date',
			'order'         => 'desc'
		), $atts );

	$args = array(
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

	if ( $atts['exclude_cat'] == true ) {
		$exclude_cats             = trim( $atts['exclude_cats'] );
		$exclude_cats             = explode( ',', $exclude_cats );
		$args['category__not_in'] = $exclude_cats;
	}
	$recent_posts = new WP_Query( $args );

	ob_start(); ?>
	<div class="custom-blocks">
		<?php if ( $atts['title'] ) { ?>
			<h3 class="border-caption">
				<?php echo htmlspecialchars_decode( $atts['title'] ); ?>
			</h3>
		<?php } ?>
		<?php
		if ( $recent_posts->have_posts() ) {
			$max_pages = $recent_posts->max_num_pages;
			?>

			<div class="list-blogs">
				<?php
				while ( $recent_posts->have_posts() ): $recent_posts->the_post(); ?>
					<div class="media blog-item">
						<div class="media-body">
							<span class="blog-date"><?php echo oss_relative_date( strtotime( get_the_date() ) ); ?>
								, <?php the_time( 'g.i A' ); ?></span>
							<h4 class="blog-name"><a href="<?php the_permalink(); ?>"
							                         title="<?php the_title(); ?>"><?php the_title(); ?></a></h4>

							<div>
								<?php the_excerpt(); ?>
								<p class="blog-by">- by
									<mark><?php the_author(); ?></mark>
								</p>
							</div>
						</div>
						<?php if ( has_post_thumbnail() ) { ?>
							<div class="media-right">
								<?php the_post_thumbnail( 'small-thumb' ); ?>
							</div>
						<?php } ?>
					</div>
				<?php endwhile; ?>
			</div>
		<?php
		if ($atts['load_more'] == true) { ?>
			<span class="loadmore mgl-30" data-page="1" data-atts='<?php echo json_encode( $atts ); ?>'
			      data-max-page="<?php echo esc_attr($max_pages); ?>"><?php _e( 'LOAD MORE', 'kysbag' ); ?></span>
			<script type="application/javascript">
				(function ($) {
					"use strict";
					$('.loadmore').click(function () {
						var atts = $(this).attr('data-atts');
						var per_page = parseInt(<?php echo esc_attr($atts['per_page']) ?>);
						var page = parseInt($(this).attr('data-page'));
						var max_page = parseInt($(this).attr('data-max-page'));

						if (page == max_page) {
							$(this).remove();
						} else {
							$.ajax({
								type: 'post',
								url: '<?php echo admin_url( 'admin-ajax.php' ); ?>',
								data: {
									action: 'oss_load_more',
									page: page,
									per_page: per_page,
									atts: atts,
									nonce: '<?php echo wp_create_nonce('oss_load_more'); ?>',
								},
								success: function (data) {
									data = $.parseJSON(data);
									$('.list-blogs').append(data);
									var new_page = page + 1;
									if (new_page == max_page) {
										$('.loadmore').remove();
									} else {
										$('.loadmore').attr('data-page', new_page);
									}

								}
							});
						}

					});
				})(jQuery);


			</script>
		<?php }
			?>
		<?php }
		?>
	</div>
	<!-- /.custom-blocks -->

	<?php
    wp_reset_postdata();

	$output = ob_get_contents();
	ob_end_clean();

	return $output;
}

add_shortcode( 'oss_recent_posts', 'oss_recent_posts_shortcode' );

/**
 * The VC Functions
 */
function oss_recent_posts_shortcode_vc() {
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
			'icon'     => 'oss-vc-recent-posts',
			'name'     => __( 'OSS - Recent Posts', 'kysbag' ),
			'base'     => 'oss_recent_posts',
			'category' => __( 'OSS - Post', 'kysbag' ),
			'params'   => array(
				array(
					'type'       => 'textfield',
					'heading'    => __( 'Title', 'kysbag' ),
					'param_name' => 'title',
					'value'      => __( 'From Blog', 'kysbag' ),
				),
				array(
					'type'       => 'textfield',
					'heading'    => __( 'How many post to show?', 'kysbag' ),
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
					'type'       => 'checkbox',
					'heading'    => __( 'Exclude Categories?', 'kysbag' ),
					'param_name' => 'exclude_cat',
					'value'      => array( __( 'Yes, please', 'kysbag' ) => true ),
				),
				array(
					'type'        => 'textfield',
					'heading'     => __( 'Exclude Category IDs', 'kysbag' ),
					'param_name'  => 'exclude_cats',
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
				array(
					'type'       => 'checkbox',
					'heading'    => __( 'Load more?', 'kysbag' ),
					'param_name' => 'load_more',
					'value'      => array( __( 'Yes, please', 'kysbag' ) => true ),
				),

			)
		)
	);
}

add_action( 'vc_before_init', 'oss_recent_posts_shortcode_vc' );

