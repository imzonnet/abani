<?php
add_action( 'widgets_init', 'oss_widget_live_chat' );

function oss_widget_live_chat() {
	register_widget( 'OSS_Widget_Live_Chat' );
}

class OSS_Widget_Live_Chat extends WP_Widget {

	function OSS_Widget_Live_Chat() {
		$widget_ops = array(
			'classname'   => 'oss-widget-live-chat',
			'description' => __( 'Arbitrary text or HTML.', 'kysbag' )
		);

		$control_ops = array( 'id_base' => 'oss-widget-live-chat' );

		$this->WP_Widget( 'oss-widget-live-chat', __( 'OSS Live Chat ', 'kysbag' ), $widget_ops, $control_ops );
	}

	function widget( $args, $instance ) {
		extract( $args );

		//Our variables from the widget settings.
		$title         = apply_filters( 'widget_title', $instance['title'] );
		$icon          = $instance['icon'];
		$ctn           = do_shortcode( $instance['ctn'] );
		$live_chat_ctn = do_shortcode( $instance['live_chat_ctn'] );
		$bt_info_ctn   = do_shortcode( $instance['bt_info_ctn'] );
		$filter        = isset( $instance['filter'] ) ? $instance['filter'] : false;


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
			echo '<div class="live-chat">' . wpautop( $live_chat_ctn ) . '</div>';
			echo '<div class="bottom-info">' . wpautop( $bt_info_ctn ) . '</div>';
		} else {
			echo $ctn;
			echo '<div class="live-chat">' . $live_chat_ctn . '</div>';
			echo '<div class="bottom-info">' . $bt_info_ctn . '</div>';
		}


		echo $after_widget;
	}

	//Update the widget

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		//Strip tags from title and name to remove HTML
		$instance['title']         = strip_tags( $new_instance['title'] );
		$instance['icon']          = strip_tags( $new_instance['icon'] );
		$instance['ctn']           = stripcslashes( $new_instance['ctn'] );
		$instance['live_chat_ctn'] = stripcslashes( $new_instance['live_chat_ctn'] );
		$instance['bt_info_ctn']   = stripcslashes( $new_instance['bt_info_ctn'] );
		$instance['filter']        = $new_instance['filter'];


		return $instance;
	}


	function form( $instance ) {

		//Set up some default widget settings.
		$defaults = array(
			'title'         => __( 'NEED HELP?', 'kysbag' ),
			'icon'          => __( 'comments-icon', 'kysbag' ),
			'ctn'           => __( '<p>Monday to Sunday., 9h AM - 6h PM</p>', 'kysbag' ),
			'live_chat_ctn' => __( '<a href="#"><i class="icon-headphones"></i>LiveChat</a>', 'kysbag' ),
			'bt_info_ctn'   => __( '<p><a href="mailto:kysbag@email.com"><i class="fa fa-envelope"></i>kysbag@email.com</a></p><p><a href="tel:(+000)-0000-000"><i class="fa fa-phone"></i>(+000)-0000-000</a></p>', 'kysbag' ),
			'filter'        => false,
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
						><?php echo esc_attr($icon) ?><i class="<?php echo esc_attr($icon); ?>"></i></option>
				<?php }
				?>
			</select>
		</p>

		<p>
			<textarea class="widefat" rows="16" cols="20" id="<?php echo esc_attr($this->get_field_id( 'ctn' )); ?>"
			          name="<?php echo esc_attr($this->get_field_name( 'ctn' )); ?>"><?php echo esc_textarea($instance['ctn']); ?></textarea>
		</p>

		<p>
			<label
				for="<?php echo esc_attr($this->get_field_id( 'live_chat_ctn' )); ?>"><?php _e( 'Live chat:', 'kysbag' ); ?></label>
			<textarea class="widefat" rows="16" cols="20" id="<?php echo esc_attr($this->get_field_id( 'live_chat_ctn' )); ?>"
			          name="<?php echo esc_attr($this->get_field_name( 'live_chat_ctn' )); ?>"><?php echo esc_textarea($instance['live_chat_ctn']); ?></textarea>
		</p>
		<p>
			<label
				for="<?php echo esc_attr($this->get_field_id( 'bt_info_ctn' )); ?>"><?php _e( 'Bottom info:', 'kysbag' ); ?></label>
			<textarea class="widefat" rows="16" cols="20" id="<?php echo esc_attr($this->get_field_id( 'bt_info_ctn' )); ?>"
			          name="<?php echo esc_attr($this->get_field_name( 'bt_info_ctn' )); ?>"><?php echo esc_textarea($instance['bt_info_ctn']); ?></textarea>
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