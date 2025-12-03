<?php
class Fancy_Post_Grid_Ajax {

    private static $_instance = null;

    public static function init() {
        if ( is_null( self::$_instance ) ) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }
    public function __construct() {
        add_action( 'wp_enqueue_scripts', [ $this, 'fpg_free_ajax_post_load_call_script' ] );
        add_action( 'wp_ajax_fpg_ajax_post_load', [ $this, 'fpg_free_ajax_post_load_call_handler' ] );
        add_action( 'wp_ajax_nopriv_fpg_ajax_post_load', [ $this, 'fpg_free_ajax_post_load_call_handler' ] );
        add_filter( 'wp_ajax_fpg_ajax_category_filter', [ $this, 'fpg_free_ajax_category_filter_handler' ] );
        add_action( 'wp_ajax_nopriv_fpg_ajax_category_filter', [ $this, 'fpg_free_ajax_category_filter_handler' ] ,10,2);
    }

    // Ajax Post Load Scripts
	public function fpg_free_ajax_post_load_call_script() {
		wp_enqueue_script(
			'fpg-ajax-post-load',
			FANCY_POST_GRID_URL . 'public/assets/js/ajax-post-load.js',
			['jquery'],
			FANCY_POST_GRID_VERSION,
			true
		);

		wp_localize_script( 'fpg-ajax-post-load', 'fpgAjaxPostLoad', array(
			'ajax_url' => admin_url( 'admin-ajax.php' ),
			'nonce'    => wp_create_nonce( 'fpg_ajax_post_load_nonce' ),
		) );
	}

	/*
	 * AJAX Load More
	 */
	public function fpg_free_ajax_post_load_call_handler() {
		check_ajax_referer( 'fpg_ajax_post_load_nonce', 'nonce' );
		$settings = [];
		$args = [];
		
		if ( ! empty( $_POST['settings'] ) && is_array( $_POST['settings'] ) ) {
			$raw      = $_POST['settings'];
	        $args = $raw['query_arg'];
			$elSettings = $raw['el_settings'];
			$settings = [
				'style' => sanitize_text_field( $elSettings['style'] ),
	            'show_post_thumbnail' => sanitize_text_field( $elSettings['show_post_thumbnail'] ),
				'thumbnail_size' => sanitize_text_field( $elSettings['thumbnail_size'] ),
				'thumbnail_type' => sanitize_text_field( $elSettings['thumbnail_type'] ),
				'show_thumbnail_overlay' => sanitize_text_field( $elSettings['show_thumbnail_overlay'] ),
	            'show_post_categories' => sanitize_text_field( $elSettings['show_post_categories'] ),
	            'show_post_title' => sanitize_text_field( $elSettings['show_post_title'] ),
	            'title_tag' => sanitize_text_field( $elSettings['title_tag'] ),
				'title_length' => sanitize_text_field( $elSettings['title_length'] ),
				'title_length_double_dot' => sanitize_text_field( $elSettings['title_length_double_dot'] ),
				'title_hover_underline' => sanitize_text_field( $elSettings['title_hover_underline'] ),
				'show_post_desc' => sanitize_text_field( $elSettings['show_post_desc'] ),
				'post_desc_word' => sanitize_text_field( $elSettings['post_desc_word'] ),
				'show_meta_data' => sanitize_text_field( $elSettings['show_meta_data'] ),
				'meta_separator' => sanitize_text_field( $elSettings['meta_separator'] ),
				'show_meta_data_icon' => sanitize_text_field( $elSettings['show_meta_data_icon'] ),
				'show_post_author' => sanitize_text_field( $elSettings['show_post_author'] ),
				'author_icon_visibility' => sanitize_text_field( $elSettings['author_icon_visibility'] ),
				'author_image_icon' => sanitize_text_field( $elSettings['author_image_icon'] ),
				'author_prefix' => sanitize_text_field( $elSettings['author_prefix'] ),
				'show_post_views' => sanitize_text_field( $elSettings['show_post_views'] ),
				'show_post_views_icon' => sanitize_text_field( $elSettings['show_post_views_icon'] ),
				'show_post_tags' => sanitize_text_field( $elSettings['show_post_tags'] ),
				'show_post_tags_icon' => sanitize_text_field( $elSettings['show_post_tags_icon'] ),
				'show_comments_count' => sanitize_text_field( $elSettings['show_comments_count'] ),
				'show_comments_count_icon' => sanitize_text_field( $elSettings['show_comments_count_icon'] ),
				'show_post_date' => sanitize_text_field( $elSettings['show_post_date'] ),
				'show_post_date_icon' => sanitize_text_field( $elSettings['show_post_date_icon'] ),
				'show_button' => sanitize_text_field( $elSettings['show_button'] ),
				'btn_text' => sanitize_text_field( $elSettings['btn_text'] ),
				'show_button_icon' => sanitize_text_field( $elSettings['show_button_icon'] ),
				'btn_icon'     => [
					'value'   => isset( $elSettings['btn_icon']['value'] ) ? wp_unslash( $elSettings['btn_icon']['value'] ) : '',
					'library' => sanitize_text_field( $elSettings['btn_icon']['library'] ?? '' ),
				],
			];
			$args['offset'] = $_POST['offset'];
			$args['posts_per_page'] = $_POST['posts_per_page'];
			
			if ( ! empty($_POST['category_slug']) ) {
				$args['category_name'] = sanitize_text_field($_POST['category_slug']);
			}
		}

		$cardStyle = $settings['style'] ?? 'one';
		$titleWord = !empty($settings['title_length']) ? $settings['title_length'] : 500;
		$titleWordDot = ('yes' === $settings['title_length_double_dot']) ? '...' : '';
		$titleHoverUnderline = ('yes' === $settings['title_hover_underline']) ? 'underline' : '';
		$descWord = !empty($settings['post_desc_word']) ? $settings['post_desc_word'] : 50;
		$separator_value = !empty($settings['meta_separator']) ? $settings['meta_separator'] : '';
		$btnTxt = !empty($settings['btn_text']) ? $settings['btn_text'] : 'Read More';

		$custom_query = new WP_Query( $args );

		if ( $custom_query->have_posts() ) {
			ob_start();
			while ( $custom_query->have_posts() ) : $custom_query->the_post();
				$post_id = get_the_ID();
				$post_categories = get_the_category();

				$postView = !empty(get_post_meta( $post_id, '_fpg_post_views_count', true )) ? get_post_meta( $post_id, '_fpg_post_views_count', true ) : '';
				$postView = !empty($postView) ? str_pad( $postView, 2, '0', STR_PAD_LEFT ) : 0;

				$postVideo = !empty( get_post_meta( $post_id, '_fpg_video_link', true ) ) ? get_post_meta( $post_id, '_fpg_video_link', true ) : '';
	            include FANCY_POST_GRID_PATH."includes/ElementBlock/cards/card-style.php";
			endwhile;
			wp_reset_postdata();
			echo ob_get_clean();
		} else {
			echo '';
		}
		wp_die();
	}

	/*
	 * AJAX Category Filter
	 */
	public function fpg_free_ajax_category_filter_handler() {
		check_ajax_referer( 'fpg_ajax_post_load_nonce', 'nonce' );

		$settings = [];
		$args = [];
		$cat_slug = '';
		
		if ( ! empty( $_POST['settings'] ) && is_array( $_POST['settings'] ) ) {
			$raw = $_POST['settings'];
			$args = $raw['query_arg'];
			$elSettings = $raw['el_settings'] ?? [];
			$settings = [
					'style' => sanitize_text_field( $elSettings['style'] ),
					'show_post_thumbnail' => sanitize_text_field( $elSettings['show_post_thumbnail'] ),
					'thumbnail_size' => sanitize_text_field( $elSettings['thumbnail_size'] ),
					'thumbnail_type' => sanitize_text_field( $elSettings['thumbnail_type'] ),
					'show_thumbnail_overlay' => sanitize_text_field( $elSettings['show_thumbnail_overlay'] ),
					'show_post_categories' => sanitize_text_field( $elSettings['show_post_categories'] ),
					'show_post_title' => sanitize_text_field( $elSettings['show_post_title'] ),
					'title_tag' => sanitize_text_field( $elSettings['title_tag'] ),
					'title_length' => sanitize_text_field( $elSettings['title_length'] ),
					'title_length_double_dot' => sanitize_text_field( $elSettings['title_length_double_dot'] ),
					'title_hover_underline' => sanitize_text_field( $elSettings['title_hover_underline'] ),
					'show_post_desc' => sanitize_text_field( $elSettings['show_post_desc'] ),
					'post_desc_word' => sanitize_text_field( $elSettings['post_desc_word'] ),
					'show_meta_data' => sanitize_text_field( $elSettings['show_meta_data'] ),
					'meta_separator' => sanitize_text_field( $elSettings['meta_separator'] ),
					'show_meta_data_icon' => sanitize_text_field( $elSettings['show_meta_data_icon'] ),
					'show_post_author' => sanitize_text_field( $elSettings['show_post_author'] ),
					'author_icon_visibility' => sanitize_text_field( $elSettings['author_icon_visibility'] ),
					'author_image_icon' => sanitize_text_field( $elSettings['author_image_icon'] ),
					'author_prefix' => sanitize_text_field( $elSettings['author_prefix'] ),
					'show_post_views' => sanitize_text_field( $elSettings['show_post_views'] ),
					'show_post_views_icon' => sanitize_text_field( $elSettings['show_post_views_icon'] ),
					'show_post_tags' => sanitize_text_field( $elSettings['show_post_tags'] ),
					'show_post_tags_icon' => sanitize_text_field( $elSettings['show_post_tags_icon'] ),
					'show_comments_count' => sanitize_text_field( $elSettings['show_comments_count'] ),
					'show_comments_count_icon' => sanitize_text_field( $elSettings['show_comments_count_icon'] ),
					'show_post_date' => sanitize_text_field( $elSettings['show_post_date'] ),
					'show_post_date_icon' => sanitize_text_field( $elSettings['show_post_date_icon'] ),
					'show_button' => sanitize_text_field( $elSettings['show_button'] ),
					'btn_text' => sanitize_text_field( $elSettings['btn_text'] ),
					'show_button_icon' => sanitize_text_field( $elSettings['show_button_icon'] ),
					'btn_icon'     => [
						'value'   => isset( $elSettings['btn_icon']['value'] ) ? wp_unslash( $elSettings['btn_icon']['value'] ) : '',
						'library' => sanitize_text_field( $elSettings['btn_icon']['library'] ?? '' ),
					],
				];

			$cat_slug = sanitize_text_field($_POST['category_slug'] ?? '');
		}

		$cardStyle = $settings['style'] ?? 'one';
		$titleWord = !empty($settings['title_length']) ? $settings['title_length'] : 500;
		$titleWordDot = ('yes' === $settings['title_length_double_dot']) ? '...' : '';
		$titleHoverUnderline = ('yes' === $settings['title_hover_underline']) ? 'underline' : '';
		$descWord = !empty($settings['post_desc_word']) ? $settings['post_desc_word'] : 50;
		$separator_value = !empty($settings['meta_separator']) ? $settings['meta_separator'] : '';
		$btnTxt = !empty($settings['btn_text']) ? $settings['btn_text'] : 'Read More';

		if ( ! empty($cat_slug) ) {
			$args['category_name'] = $cat_slug;
		} else {
			unset($args['category_name']);
		}

		$args['offset'] = 0;

		$custom_query = new WP_Query($args);

		if ( $custom_query->have_posts() ) {
			ob_start();
			while ( $custom_query->have_posts() ) {
				$custom_query->the_post();
				$post_id = get_the_ID();
				$post_categories = get_the_category();
				include FANCY_POST_GRID_PATH . "includes/ElementBlock/cards/card-style.php";
			}
			wp_reset_postdata();
			echo ob_get_clean();
		} else {
			echo '';
		}

		wp_die();
	}

}

Fancy_Post_Grid_Ajax::init();