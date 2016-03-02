<?php
/*
Plugin Name:  LPTV Social Media Icons
Description:  Produces sidebar widget with social media icons that link to LPTV's social media accounts.
Plugin URI:   https://github.com/lakelandPBS/lptv-widgets
Version:      1.0
Author:       Jason Raveling
Author URI:   http://webunraveling.com
*/

/* Yep, not much here. Setting up this file structure to allow for future
 * modifications in case we want to make it more complex
 */

// Register the widget stylesheet
add_action( 'wp_enqueue_scripts', 'lptv_widgets_register_css' ); // front-end
add_action('admin_enqueue_scripts', 'lptv_widgets_register_admin_css'); // admin

function lptv_widgets_register_css() {
	wp_register_style(
   'lptv-social-media-icons',
   plugins_url( '/lptv-social-media-icons/style/css/lptv-social-media-icons.css' ),
   array(),
   filemtime( dirname(__FILE__) . '/style/css/lptv-social-media-icons.css' )
 );

 wp_enqueue_style( 'lptv-social-media-icons' );
}

function lptv_widgets_register_admin_css() {
	wp_register_style(
   'lptv-social-media-icons-admin',
   plugins_url( '/lptv-social-media-icons/style/css/lptv-social-media-icons-admin.css' ),
   array(),
   filemtime( dirname(__FILE__) . '/style/css/lptv-social-media-icons-admin.css' )
 );

 wp_enqueue_style( 'lptv-social-media-icons-admin' );
}

// Register and get the widget
require_once( dirname(__file__) . '/include/widget.php' );

?>
