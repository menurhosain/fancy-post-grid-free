<?php

/**
 * Plugin Name:       Fancy Post Grid - Ultimate Post Grid Builder
 * Plugin URI:        https://wordpress.org/plugins/fancy-post-grid/
 * Description:       Fancy Post Grid lets you showcase posts in 9+ modern styles with full support for Gutenberg blocks, Elementor widgets, and shortcodes — simple, responsive, and customizable.
 * Version:           1.0.2
 * License:           GPLv2 or later
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       fancy-post-grid
 * Domain Path:       /languages
 * Requires PHP:      7.4
 * Requires at least: 6.3
 */

/**
 * Defines constants
 */
define( 'FANCY_POST_GRID_VERSION', '1.0.2' );
define( 'FANCY_POST_GRID_PATH', plugin_dir_path( __FILE__ ) );
define( 'FANCY_POST_GRID_URL', plugin_dir_url( __FILE__ ) );
define( 'FANCY_POST_GRID_BASENAME_LITE', plugin_basename(__FILE__));

/**
 * Load Textdomain
 */
function fancy_post_grid_load_textdomain() {
    load_plugin_textdomain('fancy-post-grid', false, dirname(__FILE__)."/languages");
}
add_action('plugins_loaded', 'fancy_post_grid_load_textdomain');

/**
 * Conditional Logic for Pro Plugin
 */
function fancy_post_grid_initialize_plugin() {
    // Include the plugin.php file to use is_plugin_active()
    if ( ! function_exists( 'is_plugin_active' ) ) {
        include_once ABSPATH . 'wp-admin/includes/plugin.php';
    }

    /**
     * Include styles and scripts for public part
     */
    include_once FANCY_POST_GRID_PATH . 'public/fpg-public.php';

    /**
     * Include styles and scripts for admin part
     */
    include_once FANCY_POST_GRID_PATH . 'admin/fpg-admin.php';

    // Check if the Pro version is active
    if ( ! is_plugin_active( 'fancy-post-grid-pro/fancy-post-grid-pro.php' ) ) {
        
        /**
         * Include file for admin
         */
        
        include_once FANCY_POST_GRID_PATH . 'includes/ajax_config.php';
        include_once FANCY_POST_GRID_PATH . 'includes/shortcode_generate.php';
        include_once FANCY_POST_GRID_PATH . 'includes/metabox/fancy-post-gird-metabox.php';
        
    } else {
        
    }
    
}
include_once FANCY_POST_GRID_PATH . 'includes/template.php';
new FPG_Template();
// Gutenberg Widget
include_once FANCY_POST_GRID_PATH . 'includes/Gutenberg/gutenberg-init.php';
new FPG_Blocks_Free();

include_once FANCY_POST_GRID_PATH . 'admin/submenu/admin-submenu.php';
add_action( 'plugins_loaded', 'fancy_post_grid_initialize_plugin' );
if (did_action( 'elementor/loaded' )) {
    include_once  FANCY_POST_GRID_PATH.'includes/ElementBlock/elementor_widgets.php';
}
/**
 * Redirect to settings page after plugin activate
 *
 */

function fpg_free_activation_redirect( $plugin ) {
    if( $plugin == plugin_basename( __FILE__ ) ) {
        exit( esc_url_raw(wp_safe_redirect( admin_url( 'edit.php?post_type=fancy-post-grid-fpg&page=fancy_post_grid_get_help' ) )) );
    }
}
add_action( 'activated_plugin', 'fpg_free_activation_redirect' );

// Add settings links to the plugin page
function fpg_free_custom_setting_page_links($links) {
    $settings_links = array(
        sprintf("<a href='%s'>%s</a>", admin_url('edit.php?post_type=fancy-post-grid-fpg&page=fancy_post_grid_advanced_settings'), __('Settings', 'fancy-post-grid')),
        
        sprintf("<a href='%s' target='_blank'>%s</a>", 'https://rstheme.com/support/', __('Support', 'fancy-post-grid')),
  
    );

    $links = array_merge($links, $settings_links);
    return $links;
}

add_filter('plugin_action_links_' . FANCY_POST_GRID_BASENAME_LITE, 'fpg_free_custom_setting_page_links');

/**
 * Register custom image sizes for Fancy Post Grid
 */
function fancy_post_grid_register_image_sizes() {
     
    add_image_size( 'fancy_post_custom_size', 768, 500, true ); // Custom size with 768x500 dimensions and hard crop
    add_image_size( 'fancy_post_square', 500, 500, true );      // Square size with 500x500 dimensions
    add_image_size( 'fancy_post_landscape', 834, 550, true );   // Landscape size with 834x550 dimensions
    add_image_size( 'fancy_post_portrait', 421, 550, true );    // Portrait size with 421x550 dimensions
    add_image_size( 'fancy_post_list', 1200, 650, true );       // Portrait size with 1200x650 dimensions
}
add_action( 'after_setup_theme', 'fancy_post_grid_register_image_sizes' );

