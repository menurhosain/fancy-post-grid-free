<?php
if ( ! defined( 'ABSPATH' ) ) exit;

class Fancy_Post_Grid_Admin_Menus {

    private static $_instance = null;

    public static function init() {
        if ( is_null( self::$_instance ) ) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function __construct() {
        add_action( 'admin_menu', [ $this, 'register_menus' ] );
    }

    /**
     * Register admin submenus
     */
    public function register_menus() {

        // -----------------------------
        // Lite / Free submenus
        // -----------------------------
        $this->add_submenu(
            'fancy_post_grid_advanced_settings',
            __( 'Settings', 'fancy-post-grid' ),
            'fancy_post_grid_render_advanced_settings_page_lite'
        );

        $this->add_submenu(
            'fancy_post_grid_get_help',
            __( 'Get Help', 'fancy-post-grid' ),
            'fancy_post_grid_render_get_help_page_lite'
        );
    }

    /**
     * Helper to add submenu under Fancy Post Grid CPT
     */
    protected function add_submenu( $slug, $title, $callback ) {
        add_submenu_page(
            'edit.php?post_type=fancy-post-grid-fpg', // Parent slug
            $title,                                   // Page title
            $title,                                   // Menu title
            'manage_options',                         // Capability
            $slug,                                    // Menu slug
            $callback                                 // Callback function
        );
    }
}

// Initialize admin menus
Fancy_Post_Grid_Admin_Menus::init();

// -----------------------------
// Include submenu files
// -----------------------------
require_once FANCY_POST_GRID_PATH . 'admin/submenu/settings/advanced-settings.php';
require_once FANCY_POST_GRID_PATH . 'admin/submenu/settings/get-help.php';

