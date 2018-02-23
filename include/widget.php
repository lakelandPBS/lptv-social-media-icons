<?php
// Register the widget
add_action( 'widgets_init', 'lptv_social_media_icons_register' );

function lptv_social_media_icons_register() {
    register_widget( "LPTV_Social_Media_Icons" );
}

// Create the widget output
class LPTV_Social_Media_Icons extends WP_Widget
{
    /**
     * Register widget with WordPress.
     */
    function __construct() {

        parent::__construct(
            'lptv_social_media_icons', // Base ID
            __( "LPTV Social Media Icons", 'lptv-sociail-media-icons' ), // Name
            array( 'description' => __( "Display social media icons as links to your social media accounts.", 'lptv-sociail-media-icons' ) ) // Args
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
        $out = $args['before_widget'];
        $out .= ( ! empty($instance['title']) ? $args['before_title'] . apply_filters('widget_title', $instance['title']) . $args['after_title'] : '' );
        $out .= '<div class="lptv-social-media-icons">';

        $accts = array_keys($instance);

        foreach ($accts as $acct) {

            if ( ! empty($instance[$acct]) && $acct != 'title' && $acct != 'about' && $acct != 'about-text' ) {
                $out .= '<a class="lptv-social-media-icons-link" target="_blank" href="' . $instance[$acct] . '">';
                $out .= '<img class="lptv-social-media-icons-icon" src="' . plugins_url('/lptv-social-media-icons/images/icon-' . $acct . '.png') . '" />';
                $out .= '</a>';
            } elseif ( $acct == 'about' && $instance[$acct] ) {
                $out .= '<a class="lptv-social-media-icons-button" href="' . $instance[$acct] . '">' . $instance['about-text'] . '</a>';
            }
        }

        $out .= '</div>'; // end lptv-social-media-icons
        $out .= $args['after_widget'];

        return $out;
    }

    /**
     * Back-end widget form.
     *
     * @see WP_Widget::form()
     *
     * @param array $instance Previously saved values from database.
     */
    public function form( $instance ) {
        $title = ( ! empty($instance['title']) ? $instance['title'] : __('Connect with LPTV', 'lptv-social-media-icons') );
        $facebook = ( ! empty($instance['facebook']) ? $instance['facebook'] : '' );
        $twitter = ( ! empty($instance['twitter']) ? $instance['twitter'] : '' );
        $youtube = ( ! empty($instance['youtube']) ? $instance['youtube'] : '' );
        $instagram = ( ! empty($instance['instagram']) ? $instance['instagram'] : '' );
        $about = ( ! empty($instance['about']) ? $instance['about'] : '' );
        $aboutText = ( ! empty($instance['about-text']) ? $instance['about-text'] : __('About', 'lptv-social-media-icons') );

        echo '<p>'; // not sure we need this 
        
        echo '<label for="' . $this->get_field_id('title') . '">' . _e('Title:') . '</label>';
        echo '<input class="widefat" id="' . $this->get_field_id('title') . '" name="' . $this->get_field_name('title') . '" type="text" value="' . esc_attr($title) . '">';
        echo '<p class="smi-giving-instructions">Enter the URL for each social media account you would like displayed.</p>';

        echo '<label class="smi-label smi-first" for="' . $this->get_field_id('facebook') . '">' . _e('Facebook:') . '</label>';
        echo '<input class="widefat" id="' . $this->get_field_id('facebook') . '" name="' . $this->get_field_name('facebook') . '" type="text" value="' . esc_attr($facebook) . '">';

        echo '<label class="smi-label" for="' . $this->get_field_id('twitter') . '">' . _e('Twitter:') . '</label>';
        echo '<input class="widefat" id="' . $this->get_field_id('twitter') . '" name="' . $this->get_field_name('twitter') . '" type="text" value="' . esc_attr($twitter) . '">';

        echo '<label class="smi-label" for="' . $this->get_field_id('youtube') . '">' . _e('YouTube:') . '</label>';
        echo '<input class="widefat" id="' . $this->get_field_id('youtube') . '" name="' . $this->get_field_name('youtube') . '" type="text" value="' . esc_attr($youtube) . '">';

        echo '<label class="smi-label" for="' . $this->get_field_id('instagram') . '"' . _e('Instagram:') . '</label>';
        echo '<input class="widefat" id="' . $this->get_field_id('instagram') . '" name="' . $this->get_field_name('instagram') . '>" type="text" value="' . esc_attr($instagram) . '">';

        echo '<label class="smi-label" for="' . $this->get_field_id('about') . '">' . _e( 'About Page:' ) . '</label>';
        echo '<input class="widefat" id="' . $this->get_field_id('about') . '" name="' . $this->get_field_name('about') . '>" type="text" value="' . esc_attr($about) . '">';

        echo '<label class="smi-label" for="' . $this->get_field_id('about-text') . '">' . _e('About Button Text:') . '</label>';
        echo '<input class="widefat" id="' . $this->get_field_id('about-text') . '" name="' . $this->get_field_name('about-text') . '>" type="text" value="' . esc_attr($aboutText) . '">';

        echo '</p>'; // not sure we need this
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
        $instance['title'] = ( ! empty($new_instance['title']) ? strip_tags($new_instance['title']) : '' );
        $instance['twitter'] = ( ! empty($new_instance['twitter']) ? strip_tags($new_instance['twitter']) : '' );
        $instance['facebook'] = ( ! empty($new_instance['facebook']) ? strip_tags($new_instance['facebook']) : '' );
        $instance['youtube'] = ( ! empty($new_instance['youtube']) ? strip_tags($new_instance['youtube']) : '' ) ;
        $instance['instagram'] = ( ! empty($new_instance['instagram']) ? strip_tags($new_instance['instagram']) : '';
        $instance['about'] = ( ! empty($new_instance['about']) ? strip_tags($new_instance['about']) : '' );
        $instance['about-text'] = ( ! empty($new_instance['about-text']) ? strip_tags($new_instance['about-text'])  : '' );

        return $instance;
    }
}
