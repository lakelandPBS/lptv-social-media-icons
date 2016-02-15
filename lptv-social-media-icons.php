<?php
/*
Plugin Name:  LPTV Social Media Icons
Description:  Produces sidebar widget with social media icons that link to LPTV's social media accounts.
Plugin URI:   https://github.com/lakelandPBS/lptv-widgets
Version:      1.0
Author:       Jason Raveling
Author URI:   http://webunraveling.com
*/

add_action( 'wp_enqueue_scripts', 'lptv_widgets_register_css' );

function lptv_widgets_register_css() {
	wp_register_style(
    'lptv-social-media-icons',
    plugins_url( '/lptv-widgets/widgets/lptv-social-media-icons/include/style/css/lptv-social-media-icons.css' ),
    array(),
    date( 'Ymd', filemtime(dirname(__FILE__) . '/widgets/lptv-social-media-icons/include/style/css/lptv-social-media-icons.css') )
  );
	wp_enqueue_style( 'lptv-social-media-icons' );
}

// include
include_once plugins_url('/lptv-widgets/widgets/lptv-social-media-icons/lptv-social-media-icons.php');


?>
