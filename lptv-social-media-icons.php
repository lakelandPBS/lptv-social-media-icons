<?php
/*
Plugin Name:  LPTV Social Media Icons
Description:  A widget that displays social media icons based on the URLs provided. 
Plugin URI:   https://github.com/lakelandPBS/lptv-widgets
Version:      1.0.1
Author:       Jason Raveling
Author URI:   http://webunraveling.com
 */

// Register the widget stylesheets
add_action( 'wp_enqueue_scripts', 'lptv_widgets_register_css' ); // front-end
add_action( 'admin_enqueue_scripts', 'lptv_widgets_register_admin_css' ); // admin

function lptv_widgets_register_css() {
    wp_register_style(
        'lptv-social-media-icons',
        get_template_directory_uri() . '/include/lptv-functions/social-media-icons/style/css/lptv-social-media-icons.css',
        array(),
        filemtime( dirname(__FILE__) . '/style/css/lptv-social-media-icons.css' )
    );

    wp_enqueue_style( 'lptv-social-media-icons' );
}

function lptv_widgets_register_admin_css() {
    wp_register_style(
        'lptv-social-media-icons-admin',
        get_template_directory_uri() . '/include/lptv-functions/social-media-icons/style/css/lptv-social-media-icons-admin.css',
        array(),
        filemtime( dirname(__FILE__) . '/style/css/lptv-social-media-icons-admin.css' )
    );

    wp_enqueue_style( 'lptv-social-media-icons-admin' );
}

// Register and get the widget
require_once( 'widget.php' );

?>
