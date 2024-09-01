<?php
/*
Plugin Name: WooCommerce Product Slider
Description: A simple product slider for WooCommerce.
Version: 1.0.0
Author: Abdullah Basar
Author URI: https://www.facebook.com/hmabdullahbasar
License: GPLv2 or later
*/
/*
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.

Copyright 2005-2023 Automattic, Inc.
*/

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Include the main class
require_once plugin_dir_path( __FILE__ ) . 'includes/class-wps-product-slider.php';

// Initialize the plugin
function wps_product_slider_init() {
    $wps_product_slider = new WPS_Product_Slider();
}
add_action( 'plugins_loaded', 'wps_product_slider_init' );

// Enqueue the plugin's styles and scripts
function wps_enqueue_styles_scripts() {
    // Enqueue CSS
    wp_enqueue_style( 'wps-slider-style', plugins_url('assets/css/slider.css', __FILE__ ));

    // Enqueue JS
    wp_enqueue_script( 'wps-slider-script', plugins_url( 'assets/js/slider.js', __FILE__ ), array( 'jquery' ), '1.0', true );
}
add_action( 'wp_enqueue_scripts', 'wps_enqueue_styles_scripts' );

// Activation hook
function wps_plugin_activation() {
    // Actions to perform on plugin activation
    // For example, you can create options, custom database tables, etc.
}
register_activation_hook( __FILE__, 'wps_plugin_activation' );

// Deactivation hook
function wps_plugin_deactivation() {
    // Actions to perform on plugin deactivation
    // For example, you can clean up options, remove custom database tables, etc.
}
register_deactivation_hook( __FILE__, 'wps_plugin_deactivation' );

// Uninstall hook
function wps_plugin_uninstall() {
    // Actions to perform on plugin uninstall
    // For example, you can delete options, custom database tables, etc.
    // Note: This function should be in a separate file or use a check to avoid direct access
}
register_uninstall_hook( __FILE__, 'wps_plugin_uninstall' );
