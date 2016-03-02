<?php
// Register the widget
add_action( 'widgets_init', 'lptv_social_media_icons_register' );

function lptv_social_media_icons_register() {
	register_widget( "LPTV_Social_Media_Icons" );
}

// Create the widget output
class LPTV_Social_Media_Icons extends WP_Widget {
	/**
	 * Register widget with WordPress.
	 */
	function __construct() {

		parent::__construct(
			'lptv_social_media_icons', // Base ID
			__( "LPTV Social Media Icons", 'lptv-sociail-media-icons' ), // Name
			array( 'description' => __( "Display social media icons with links to LPTV's social media accounts.", 'lptv-sociail-media-icons' ) ) // Args
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		echo $args['before_widget'];

		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ). $args['after_title'];
		}

		echo '<div class="lptv-social-media-icons">';

		$accts = array_keys($instance);

		foreach ($accts as $acct) {
			if ( ! empty($instance[$acct]) && $acct != 'title' && $acct != 'about' ) {
				?>
				<a class="lptv-social-media-icons-link" target="_blank" href="<?php echo $instance[$acct]; ?>">
					<img class="lptv-social-media-icons-icon" src="<?php echo plugins_url('/lptv-social-media-icons/images/icon-' . $acct . '.png'); ?>" />
				</a>
				<?
			} elseif ( $acct == 'about' && $instance[$acct] ) {
				?>
				<a class="lptv-social-media-icons-button" href="<?php echo $instance[$acct]; ?>">About Page</a>
				<?
			}
		}

		echo '</div>'; // end lptv-social-media-icons

		echo $args['after_widget'];
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		$title = ! empty( $instance['title'] ) ? $instance['title'] : __( 'Connect with LPTV', 'lptv-social-media-icons' );
		$facebook = ! empty( $instance['facebook'] ) ? $instance['facebook'] : '';
		$twitter = ! empty( $instance['twitter'] ) ? $instance['twitter'] : '';
		$youtube = ! empty( $instance['youtube'] ) ? $instance['youtube'] : '';
		$instagram = ! empty( $instance['instagram'] ) ? $instance['instagram'] : '';
		$about = ! empty( $instance['about'] ) ? $instance['about'] : '';
		?>
		<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">

		<span class="smi-giving-instructions">Enter the URL for each social media account you would like displayed.</span>

		<label class="smi-label smi-first" for="<?php echo $this->get_field_id( 'facebook' ); ?>"><?php _e( 'Facebook:' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'facebook' ); ?>" name="<?php echo $this->get_field_name( 'facebook' ); ?>" type="text" value="<?php echo esc_attr( $facebook ); ?>">

		<label class="smi-label" for="<?php echo $this->get_field_id( 'twitter' ); ?>"><?php _e( 'Twitter:' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'twitter' ); ?>" name="<?php echo $this->get_field_name( 'twitter' ); ?>" type="text" value="<?php echo esc_attr( $twitter ); ?>">

		<label class="smi-label" for="<?php echo $this->get_field_id( 'youtube' ); ?>"><?php _e( 'YouTube:' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'youtube' ); ?>" name="<?php echo $this->get_field_name( 'youtube' ); ?>" type="text" value="<?php echo esc_attr( $youtube ); ?>">

		<label class="smi-label" for="<?php echo $this->get_field_id( 'instagram' ); ?>"><?php _e( 'Instagram:' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'instagram' ); ?>" name="<?php echo $this->get_field_name( 'instagram' ); ?>" type="text" value="<?php echo esc_attr( $instagram ); ?>">

		<label class="smi-label" for="<?php echo $this->get_field_id( 'about' ); ?>"><?php _e( 'About Page:' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'about' ); ?>" name="<?php echo $this->get_field_name( 'about' ); ?>" type="text" value="<?php echo esc_attr( $about ); ?>">
		</p>
		<?php
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['twitter'] = ( ! empty( $new_instance['twitter'] ) ) ? strip_tags( $new_instance['twitter'] ) : '';
		$instance['facebook'] = ( ! empty( $new_instance['facebook'] ) ) ? strip_tags( $new_instance['facebook'] ) : '';
		$instance['youtube'] = ( ! empty( $new_instance['youtube'] ) ) ? strip_tags( $new_instance['youtube'] ) : '';
		$instance['instagram'] = ( ! empty( $new_instance['instagram'] ) ) ? strip_tags( $new_instance['instagram'] ) : '';
		$instance['about'] = ( ! empty( $new_instance['about'] ) ) ? strip_tags( $new_instance['about'] ) : '';

		return $instance;
	}
}
