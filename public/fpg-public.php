<?php
/**
 * Include public styles
 */
function fancy_post_grid_public_styles() {

    $ufpg_version = defined( 'FANCY_POST_GRID_VERSION' ) ? FANCY_POST_GRID_VERSION : '1.0.0'; // Define version number
    $settings_options = get_option( 'fpg_settings_option' );
    
    wp_enqueue_style( 'fpg-bootstrap', plugins_url('/assets/css/fpg_bootstrap.css', __FILE__), array(), $ufpg_version, 'all' );
    wp_enqueue_style( 'fpg-bootstrap-main', plugins_url('/assets/css/bootstrap.min.css', __FILE__), array(), $ufpg_version, 'all' );
    wp_enqueue_style( 'fpg-font-awesome', plugins_url('/assets/css/all.min.css', __FILE__), array(), $ufpg_version, 'all' );
          
    wp_enqueue_style('remixicon', plugins_url('/assets/css/remixicon.css',__FILE__), array(), $ufpg_version, 'all');
    wp_enqueue_style('rs-swiper', plugins_url('/assets/css/swiper-bundle.min.css',__FILE__), array(), $ufpg_version, 'all');
    // wp_enqueue_style('fpg-layout', plugins_url('/assets/css/rs-layout.css',__FILE__), array(), $ufpg_version, 'all');
    wp_enqueue_style('fpg-custom-style', plugins_url('/assets/css/fpg-style.css',__FILE__), array(), $ufpg_version, 'all');
    wp_enqueue_style('fpg-card-style', plugins_url('/assets/css/fpg-card-style.css',__FILE__), array(), $ufpg_version, 'all');
    wp_enqueue_style('animate', plugins_url('/assets/css/animate.min.css',__FILE__), array(), $ufpg_version, 'all');
    wp_enqueue_style('magnific', plugins_url('/assets/css/magnific-popup.css',__FILE__), array(), $ufpg_version, 'all');
    wp_enqueue_style('plyr', plugins_url('/assets/css/plyr.css',__FILE__), array(), $ufpg_version, 'all');

}
add_action( 'wp_enqueue_scripts', 'fancy_post_grid_public_styles' );

/**
 * Include public scripts
*/

function fancy_post_grid_public_scripts(){
    $ufpg_version = defined( 'FANCY_POST_GRID_VERSION' ) ? FANCY_POST_GRID_VERSION : '1.0.0'; // Define version number

    // Enqueue the necessary scripts
    wp_enqueue_script('jquery');
    wp_enqueue_script('swiper');
    wp_enqueue_script('fpg-swiper-bundle', plugins_url('/assets/js/swiper-bundle.min.js', __FILE__), array('jquery'), $ufpg_version, true);
    wp_enqueue_script('fpg-bootstrap-main', plugins_url('/assets/js/bootstrap.bundle.min.js', __FILE__), array( 'jquery'), $ufpg_version, true);
    wp_enqueue_script( 'isotope', plugins_url('/assets/js/isotope.pkgd.min.js', __FILE__) , array('jquery','imagesloaded'), $ufpg_version, true );
    wp_enqueue_script( 'magnific', plugins_url('/assets/js/magnific-popup.min.js', __FILE__) , array('jquery','imagesloaded'), $ufpg_version, true );
    wp_enqueue_script( 'plyr', plugins_url('/assets/js/plyr.polyfilled.js', __FILE__) , array('jquery'), $ufpg_version, true );
    wp_enqueue_script('fpg-main-js', plugins_url('/assets/js/fpg-main.js', __FILE__), array('fpg-swiper-bundle', 'jquery','magnific'), $ufpg_version, true);
    
}
add_action( 'wp_enqueue_scripts', 'fancy_post_grid_public_scripts' );

