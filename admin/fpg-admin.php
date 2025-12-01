<?php
/**
 * Include admin styles
 */
function fancy_post_grid_admin_styles( $screen ) {

    $ufpg_version = defined( 'FANCY_POST_GRID_VERSION' ) ? FANCY_POST_GRID_VERSION : '1.0.0'; // Define version number
    
    wp_enqueue_style( 'fancy_post_grid_jquery_ui', plugins_url('/assets/css/jquery-ui.css', __FILE__), array(), $ufpg_version, 'all' );
	wp_enqueue_style( 'fancy_post_grid_main_admin', plugins_url('/assets/css/admin.css', __FILE__), array(), $ufpg_version, 'all' );
	wp_enqueue_style( 'fpg_admin-font-awesome', plugins_url('/assets/css/all.min.css', __FILE__), array(), $ufpg_version, 'all' );
	wp_enqueue_style( 'fpg-bootstrap-admin', plugins_url('/assets/css/fpg_bootstrap.css', __FILE__), array(), $ufpg_version, 'all' );
    // Enqueue Select2 CSS
    wp_enqueue_style( 'select2-css', plugins_url('/assets/css/select2.min.css', __FILE__), array(), $ufpg_version, 'all' );

}
add_action( 'admin_enqueue_scripts', 'fancy_post_grid_admin_styles' );

/**
 * Include admin scripts
 */
function fancy_post_grid_admin_script( $screen ){
	$ufpg_version = defined( 'FANCY_POST_GRID_VERSION' ) ? FANCY_POST_GRID_VERSION : '1.0.0'; // Define version number

    wp_enqueue_style( 'wp-color-picker' ); // Enqueue WordPress core color picker stylesheet
    wp_enqueue_script( 'fpg-color-picker', plugins_url( '/assets/js/color-picker.js', __FILE__ ), array( 'wp-color-picker' ),  $ufpg_version, true );
    wp_enqueue_script( 'select2-js', plugins_url('/assets/js/select2.min.js', __FILE__), array('jquery'), $ufpg_version, null, true );	
    wp_enqueue_script( 'fpg-main', plugins_url('/assets/js/admin.js', __FILE__), array( 'jquery', 'jquery-ui-tabs', 'wp-color-picker','select2-js' ), $ufpg_version, true );
    
    if ( defined('FPG_PRO_ACTIVE') ) {
        return;
    }
    wp_enqueue_script('fpg-admin-pro', plugins_url('/assets/js/admin-pro.js', __FILE__), array(), $ufpg_version, true);
}
add_action( 'admin_enqueue_scripts', 'fancy_post_grid_admin_script' );

/**
 * Enqueue Elementor editor styles
 */
add_action( 'elementor/editor/after_enqueue_styles', 'rs_elementor_editor_free_css' );
function rs_elementor_editor_free_css() {
    $dir = plugin_dir_url( __FILE__ );
    wp_enqueue_style( 'rs-elementor-editor-css', $dir . 'assets/css/rs-elementor-editor.css', array(), '1.0.0', 'all' );
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css');
    // Enqueue editor-specific JS
    wp_enqueue_script( 'rs-elementor-editor-js', $dir . 'assets/js/rs-elementor-editor.js', array('jquery'), '1.0.0', true // Load in footer
    );
}
