<?php
use Elementor\Controls_Manager;

trait FPG_Query_Builder {

    public function get_categories_list() {
        $categories = get_categories();
        $list = [];
        foreach ($categories as $cat) {
            $list[$cat->slug] = $cat->name;
        }
        return $list;
    }

    public function get_tags_list() {
        $tags = get_tags();
        $list = [];
        foreach ($tags as $tag) {
            $list[$tag->slug] = $tag->name;
        }
        return $list;
    }

    public function get_all_posts_list($post_type = 'post') {
        $posts = get_posts([
            'post_type'      => $post_type,
            'post_status'    => 'publish',
            'posts_per_page' => -1,
        ]);
        $list = [];
        foreach ($posts as $post) {
            $list[$post->ID] = $post->post_title;
        }
        return $list;
    }

    public function get_authors_list() {
        $authors = get_users(['capability' => 'edit_posts']);
        $list = [];
        foreach ($authors as $user) {
            $list[$user->ID] = $user->display_name;
        }
        return $list;
    }

    protected function fpg_register_query_controls_el( $condition = false ) {
        $sec_condition = [];

	    if ( $condition ) {
		    $sec_condition[ 'query_type!' ] = 'archive';
	    }

        $this->start_controls_section(
            '_section_query_options',
            [
                'label' => __('Query Builder', 'fancy-post-grid'),
                'tab' => Controls_Manager::TAB_CONTENT,
                'condition' => $sec_condition
            ]
        );
            $this->add_control('featured_filter', [
                'label' => __('Featured Posts Only', 'fancy-post-grid'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'fancy-post-grid'),
                'label_off' => __('No', 'fancy-post-grid'),
                'return_value' => 'yes',
                'default' => '',
            ]);

            $this->add_control('trending_filter', [
                'label' => __('Trending Posts Only', 'fancy-post-grid'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'fancy-post-grid'),
                'label_off' => __('No', 'fancy-post-grid'),
                'return_value' => 'yes',
                'default' => '',
            ]);
            $this->add_control('editor_picks_filter', [
                'label' => __('Editor Picks Only', 'fancy-post-grid'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'fancy-post-grid'),
                'label_off' => __('No', 'fancy-post-grid'),
                'return_value' => 'yes',
                'default' => '',
            ]);

            // TODO:: Prevent removing zero viewed items
            $this->add_control('popular_filter', [
                'label' => __('Popular Posts by Views', 'fancy-post-grid'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'fancy-post-grid'),
                'label_off' => __('No', 'fancy-post-grid'),
                'return_value' => 'yes',
                'default' => '',
            ]);

            $this->add_control('popular_order', [
                'label' => __('Order By Views', 'fancy-post-grid'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'DESC' => __('Descending', 'fancy-post-grid'),
                    'ASC'  => __('Ascending', 'fancy-post-grid'),
                ],
                'default' => 'DESC',
                'condition' => ['popular_filter' => 'yes'],
            ]);

            $this->add_control(
                'get_post_by',
                [
                    'label' => esc_html__( 'Get Post By', 'fancy-post-grid' ),
                    'type' => Controls_Manager::SELECT,
                    'default' => '',
                    'options' => [
                        '' => esc_html__( 'Default', 'fancy-post-grid' ),
                        'selected' => esc_html__( 'Specific Posts', 'fancy-post-grid' ),
                    ],
                ]
            );
            $this->add_control('posts_per_page', [
                'label' => __('Posts per Page', 'fancy-post-grid'),
                'type' => Controls_Manager::NUMBER,
                'default' => 6,
                'min' => -1,
            ]);

            $this->add_control('offset', [
                'label' => __('Offset', 'fancy-post-grid'),
                'type' => Controls_Manager::NUMBER,
                'default' => 0,
                'min' => 0,
                'condition' => [
                    'get_post_by!' => 'selected'
                ],
            ]);
            $this->add_control('selected_posts', [
                'label' => __('Select Specific Posts', 'fancy-post-grid'),
                'type' => Controls_Manager::SELECT2,
                'options' => $this->get_all_posts_list(),
                'label_block' => true,
                'multiple' => true,
                'condition' => [
                    'get_post_by' => 'selected'
                ]
            ]);
            
            $this->add_control('category_filter', [
                'label' => __('Select Category', 'fancy-post-grid'),
                'type' => Controls_Manager::SELECT2,
                'options' => $this->get_categories_list(),
                'label_block' => true,
                'multiple' => true,
                'condition' => [
                    'get_post_by!' => 'selected'
                ]
            ]);

            $this->add_control('exclude_category_filter', [
                'label' => __('Exclude Category', 'fancy-post-grid'),
                'type' => Controls_Manager::SELECT2,
                'options' => $this->get_categories_list(),
                'label_block' => true,
                'multiple' => true,
                'condition' => [
                    'get_post_by!' => 'selected'
                ]
            ]);

            $this->add_control('tag_filter', [
                'label' => __('Select Tags', 'fancy-post-grid'),
                'type' => Controls_Manager::SELECT2,
                'options' => $this->get_tags_list(),
                'label_block' => true,
                'multiple' => true,
                'condition' => [
                    'get_post_by!' => 'selected'
                ]
            ]);

            $this->add_control('author_filter', [
                'label' => __('Select Author', 'fancy-post-grid'),
                'type' => Controls_Manager::SELECT2,
                'options' => $this->get_authors_list(),
                'label_block' => true,
                'condition' => [
                    'get_post_by!' => 'selected'
                ]
            ]);

            $this->add_control('sort_order', [
                'label' => __('Sort Order', 'fancy-post-grid'),
                'type' => Controls_Manager::SELECT,
                'options' => ['desc' => 'Descending', 'asc' => 'Ascending'],
                'default' => 'desc',
                'condition' => [
                    'popular_filter!' => 'yes',
                ],
            ]);

            $this->add_control('exclude_selected_posts', [
                'label' => __('Exclude Posts', 'fancy-post-grid'),
                'description' => __('Select posts you want to exclude from query.', 'fancy-post-grid'),
                'type' => Controls_Manager::SELECT2,
                'options' => $this->get_all_posts_list(),
                'label_block' => true,
                'multiple' => true,
                'condition' => [
                    'get_post_by!' => 'selected'
                ]
            ]);

        $this->end_controls_section();
    }

    protected function fpg_get_paged( $settings ) {
        $pagination = !empty($settings['show_pagination']) ? $settings['show_pagination'] : '';
        $type = !empty($settings['pagination_type']) ? $settings['pagination_type'] : '';
        
        if (('yes' === $pagination) && ('load_more' !== $type)) {
            $paged = get_query_var('paged');
            if ( empty($paged) ) {
                $paged = get_query_var('page');
            }
            return max(1, (int) $paged);
        } else {
            return 1;
        }
    }

    protected function fpg_build_query_args($settings, $post_type = 'post', $paged = 1) {

        $paged = $this->fpg_get_paged( $settings );

        // Default values for safety
        $settings = wp_parse_args($settings, [
            'posts_per_page' => 6,
            'sort_order' => 'DESC',
            'orderby' => 'date',
            'category_filter' => [],
            'exclude_category_filter' => [],
            'tag_filter' => [],
            'author_filter' => [],
            'selected_posts' => [],
            'exclude_selected_posts' => [],
            'featured_filter' => '',
            'trending_filter' => '',
            'editor_picks_filter' => '',
            'popular_filter' => '',
            'popular_order' => 'DESC',
            'offset'              => 0,
        ]);

        $args = [
            'post_type'      => $post_type,
            'post_status'    => 'publish',
            'posts_per_page' => $settings['posts_per_page'] ?? 6,
            'orderby'        => 'date',
            'order'          => $settings['sort_order'] ?? 'desc',
            'paged'          => $paged,
        ];

        if (!empty($settings['offset'])) {
            $offset = (int) $settings['offset'];
            $args['offset'] = $offset + ( ($args['paged'] - 1) * (int) $settings['posts_per_page'] );
        }

        if (!empty($settings['selected_posts'])) {
            $args['post__in'] = array_map('intval', (array) $settings['selected_posts']);
            return $args;
        }

        if (!empty($settings['category_filter'])) {
            $args['category_name'] = implode(',', $settings['category_filter']);
        }

        if (!empty($settings['exclude_category_filter'])) {
            $args['category__not_in'] = [];
            foreach ($settings['exclude_category_filter'] as $slug) {
                $term = get_category_by_slug($slug);
                if ($term) {
                    $args['category__not_in'][] = $term->term_id;
                }
            }
        }

        if (!empty($settings['tag_filter'])) {
            $args['tag_slug__in'] = $settings['tag_filter'];
        }

        if (!empty($settings['author_filter'])) {
            $args['author'] = intval($settings['author_filter']);
        }

        if (!empty($settings['include_posts'])) {
            $args['post__in'] = array_map('intval', explode(',', $settings['include_posts']));
        }

        if (!empty($settings['exclude_selected_posts'])) {
            $args['post__not_in'] = array_map('intval', (array) $settings['exclude_selected_posts']);
        }

        if ($settings['featured_filter'] === 'yes') {
            $args['meta_query'][] = [
                'key'     => '_fpg_featured_post',
                'value'   => '1',
                'compare' => '=',
            ];
        }
        if ($settings['trending_filter'] === 'yes') {
            $args['meta_query'][] = [
                'key'     => '_fpg_trending_post',
                'value'   => '1',
                'compare' => '=',
            ];
        }
        if ($settings['editor_picks_filter'] === 'yes') {
            $args['meta_query'][] = [
                'key'     => '_fpg_editor_picks_post',
                'value'   => '1',
                'compare' => '=',
            ];
        }
        if ($settings['popular_filter'] === 'yes') {
            $args['meta_key'] = '_fpg_post_views_count';
            $args['orderby']  = 'meta_value_num';
            $args['order']    = $settings['popular_order'] ?? 'DESC';
        }

        return $args;
    }

    protected function fpg_get_query($settings, $post_type = 'post', $paged = 1) {
        return new \WP_Query( $this->fpg_build_query_args( $settings, $post_type, $paged ) );
    }

    protected function fpg_reset_query() {
        wp_reset_postdata();
    }
}
