<?php
defined( 'ABSPATH' ) || exit;

class Fancy_Post_Grid_Elementor {

    private static $_instance = null;

    public function __construct() {
        add_action( 'elementor/elements/categories_registered', [ $this, 'fpg_register_elementor_category' ] );
        add_action( 'elementor/widgets/register', [ $this, 'fpg_register_elementor_widget' ] );
        add_action( 'elementor/frontend/after_register_scripts', [ $this, 'fpg_el_editor_scripts' ] );
        $this->fpg_el_include_files();
        // Todo:: Move to better place
        add_action('template_redirect', [$this, 'fpg_track_views']);
    }

    public static function instance() {
        if ( is_null( self::$_instance ) ) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function fpg_el_editor_scripts () {
        wp_enqueue_script( 'fpg-el-frontend-editor-js', FANCY_POST_GRID_URL.'public/assets/js/frontend-el.js', ['jquery'], time(), true);
    }

    public function fpg_el_include_files() {
        require_once __DIR__ . '/helper/trait-query-builder.php';
        require_once __DIR__ . '/helper/trait-common-controls.php';
        require_once __DIR__ . '/helper/trait-slider-controls.php';
        require_once __DIR__ . '/helper/trait-group-layout-controls.php';
    }

    public function fpg_register_elementor_category( $elements_manager ) {
        $elements_manager->add_category(
            'fancy_post_grid_category',
            [
                'title' => esc_html__( 'Fancy Post Grid', 'fancy-post-grid' ),
                'icon'  => 'eicon-archive',
            ]
        );
    }

	// Todo:: Move to better place
    // Post View Count Start
    public function fpg_set_post_views($post_id) {
        $meta_key = '_fpg_post_views_count';
        $count = get_post_meta($post_id, $meta_key, true);
        $count = intval($count);

        if ($count < 1) {
            $count = 1;
            update_post_meta($post_id, $meta_key, $count);
        } else {
            $count++;
            update_post_meta($post_id, $meta_key, $count);
        }
    }
    public function fpg_get_post_views($post_id) {
        $meta_key = '_fpg_post_views_count';
        $count = get_post_meta($post_id, $meta_key, true);
        return $count ? intval($count) : 0;
    }
    public function fpg_track_views() {
        if (is_single() && !is_admin()) {
            global $post;

            if (isset($post->ID) && !current_user_can('manage_options')) {
                $this->fpg_set_post_views($post->ID);
            }
        }
    }
    // Post View Count End

    // Register Widgets
    public function fpg_register_elementor_widget( $widgets_manager ) {
        require_once __DIR__ . '/widgets/post-grid.php';
        $widgets_manager->register( new \FPG_Post_Grid() );
        
        // require_once __DIR__ . '/widgets/post-group.php';
        // $widgets_manager->register( new \FPG_Post_Group() );
        
        require_once __DIR__ . '/widgets/post-slider.php';
        $widgets_manager->register( new \FPG_Post_Slider() );
        
        // require_once __DIR__ . '/widgets/post-filter.php';
        // $widgets_manager->register( new \FPG_Post_Filter() );
        
        // require_once __DIR__ . '/widgets/post-categories.php';
        // $widgets_manager->register( new \FPG_Post_Categories() );
        
        // require_once __DIR__ . '/widgets/post-ticker.php';
        // $widgets_manager->register( new \FPG_Post_Ticker() );
    }
}

// Start Elementor Widgets
return Fancy_Post_Grid_Elementor::instance();
