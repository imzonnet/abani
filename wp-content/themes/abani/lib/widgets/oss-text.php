<?php
add_action( 'widgets_init', 'oss_widget_text' );

function oss_widget_text() {
	register_widget( 'OSS_Widget_Text' );
}

class OSS_Widget_Text extends WP_Widget {

	function OSS_Widget_Text() {
		$widget_ops = array(
			'classname'   => 'oss-widget-text',
			'description' => __( 'Arbitrary text or HTML.', 'kysbag' )
		);

		$control_ops = array( 'id_base' => 'oss-widget-text' );

		$this->WP_Widget( 'oss-widget-text', __( 'OSS Text ', 'kysbag' ), $widget_ops, $control_ops );
	}

	function widget( $args, $instance ) {
		extract( $args );

		//Our variables from the widget settings.
		$title  = apply_filters( 'widget_title', $instance['title'] );
		$icon   = $instance['icon'];
		$ctn    = do_shortcode( $instance['ctn'] );
		$filter = isset( $instance['filter'] ) ? $instance['filter'] : false;


		echo $before_widget;


		//Display icon
		if ( $icon ) {
			$before_title = preg_replace( '/class="(.*)"/', 'class="$1 ' . $icon . '"', $before_title );
		}

		// Display the widget title
		if ( $title ) {
			echo $before_title . $title . $after_title;
		}

		// Content
		if ( $filter ) {
			echo wpautop( $ctn );
		} else {
			echo $ctn;
		}


		echo $after_widget;
	}

	//Update the widget

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		//Strip tags from title and name to remove HTML
		$instance['title']  = strip_tags( $new_instance['title'] );
		$instance['icon']   = strip_tags( $new_instance['icon'] );
		$instance['ctn']    = stripcslashes( $new_instance['ctn'] );
		$instance['filter'] = $new_instance['filter'];


		return $instance;
	}


	function form( $instance ) {

		//Set up some default widget settings.
		$defaults = array(
			'title'  => __( 'FAQs', 'kysbag' ),
			'icon'   => __( 'briefcase-icon', 'kysbag' ),
			'ctn'    => __( '<ul><li><a href="#">Duis aute irure dolor in..</a></li><li><a href="#">Henderit in voluptate velit</a></li><li><a href="#">Cllum dolore eu fugiat..</a></li><li><a href="#">Henderit in voluptate</a></li><li><a href="#">Voluptate velit esse cillum</a></li></ul><p>More questions in <a href="#" class="border-link">Help Center</a></p>', 'kysbag' ),
			'filter' => false,
		);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php _e( 'Title:', 'kysbag' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"
			       name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" value="<?php echo esc_attr($instance['title']); ?>"
			       style="width:100%;"/>
		</p>


		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'icon' )); ?>"><?php _e( 'Icon:', 'kysbag' ); ?></label>
			<select class="widefat" name="<?php echo esc_attr($this->get_field_name( 'icon' )); ?>"
			        id="<?php echo esc_attr($this->get_field_id( 'icon' )); ?>">
				<?php
				global $oss_icons;
				foreach ( $oss_icons as $icon ) { ?>
					<option value="<?php echo esc_attr($icon); ?>"
						<?php
						if ( $icon == $instance['icon'] ) {
							echo 'selected';
						}
						?>
						><?php echo esc_attr($icon); ?><i class="<?php echo esc_attr($icon); ?>"></i></option>
				<?php }
				?>
			</select>
		</p>

		<p>
			<textarea class="widefat" rows="16" cols="20" id="<?php echo esc_attr($this->get_field_id( 'ctn' )); ?>"
			          name="<?php echo esc_attr($this->get_field_name( 'ctn' )); ?>"><?php echo esc_textarea($instance['ctn']); ?></textarea>
		</p>

		<p>
			<input class="checkbox" type="checkbox" value="1" <?php checked( $instance['filter'], '1', true ); ?>
			       id="<?php echo esc_attr($this->get_field_id( 'filter' )); ?>"
			       name="<?php echo esc_attr($this->get_field_name( 'filter' )); ?>"/>
			<label
				for="<?php echo esc_attr($this->get_field_id( 'filter' )); ?>"><?php _e( 'Automatically add paragraphs', 'kysbag' ); ?></label>
		</p>




	<?php
	}
}

?>