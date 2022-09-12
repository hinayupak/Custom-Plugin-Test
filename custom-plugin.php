<?php
/**
 *
 * @wordpress-plugin
 * Plugin Name:       Custom Plugin Test
 * Description:       Test plugin only
 * Version:           1.0.0
 * Author:            Joshua Hernandez
 * Text Domain:       custom-plugin
 */

// Load style
function cp_styles()
{
    wp_register_style('custom-plugin', plugin_dir_url( __FILE__ ) . 'assets/custom-plugin.css');
    wp_enqueue_style( 'custom-plugin' );
}
add_action('wp_enqueue_scripts', 'cp_styles');

// Shortcode for Lawyers in grid
function custom_plugin() {

  
    $result = 'Custom Plugin Test';
  
    return $result;            
}
  
add_shortcode( 'custom-plugin', 'custom_plugin' );