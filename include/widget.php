<?php
// Register the widget
add_action( 'widgets_init', 'lptv_social_media_icons_register' );

function lptv_social_media_icons_register() {
	register_widget( "LPTV_Social_Media_Icons" );
}

// Register the widget stylesheet
add_action( 'wp_enqueue_scripts', 'lptv_widgets_register_css' );

function lptv_widgets_register_css() {
	wp_register_style(
    'lptv-social-media-icons',
    plugins_url( '/lptv-social-media-icons/style/css/lptv-social-media-icons.css' ),
    array(),
    date( 'Ymd', filemtime(esc_url(plugins_url('/style/css/lptv-social-media-icons.css', dirname(__FILE__)))) )
  );
	wp_enqueue_style( 'lptv-social-media-icons' );
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

		echo "socialize.";

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
		$title = ! empty( $instance['title'] ) ? $instance['title'] : __( 'Connect with LPTV', 'lptv-sociail-media-icons' );
		?>
		<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
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

		return $instance;
	}
}