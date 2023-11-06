<?php
/**
 * Plugin Name: 	Marquees Text Elementor Widget
 * Description: 	A custom Elementor widget for adding a Marquees Text
 * Version: 		1.0
 * Author: 			Kostas Ntamas
 * Author URI: 		https://github.com/kostasntamas
 * text Domain:     Marquee-Widget
 */

// If this file is called directly, abort.
if (!defined("ABSPATH")) {
    exit();
}

function register_marquee_widget($widgets_manager)
{
    require_once __DIR__ . "/widgets/marquee-widget.php";

    $widgets_manager->register(new \Elementor_Marquee_Widget());
}
add_action("elementor/widgets/register", "register_marquee_widget");

// Style sheet
function register_widget_styles()
{
    wp_register_style("widget-style", plugins_url("/css/marquee-style.css", __FILE__));
}

add_action("wp_enqueue_scripts", "register_widget_styles");
