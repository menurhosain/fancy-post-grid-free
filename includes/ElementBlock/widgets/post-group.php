<?php
use Elementor\Controls_Manager;
use Elementor\Plugin;
use Elementor\Utils;
use Elementor\Widget_Base;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Text_Stroke;

defined( 'ABSPATH' ) || die();

class FPG_Post_Group extends \Elementor\Widget_Base {

    use FPG_Query_Builder;
    use FPG_Common_Controls;
    use FPG_Group_Layout_Controls;

    public function get_name() {
		return 'fpg-post-group';
	}

    public function get_title() {
		return __( 'FPG - Post Group', 'fancy-post-grid' );
	}

    public function get_icon() {
		return 'eicon-posts-group';
	}

    public function get_categories() {
		return [ 'fancy_post_grid_category' ];
	}

    public function get_keywords() {
        return ['post', 'fpg', 'group', 'masonry'];
    }

    protected function register_controls() {
        // General Section Start
        $this->start_controls_section(
			'_section_general',
			[
				'label' => __( 'General', 'fancy-post-grid' ),
                'tab' => Controls_Manager::TAB_CONTENT,
			]
		);
            $this->add_control(
                'style',
                [
                    'label' => esc_html__( 'Style', 'fancy-post-grid' ),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'one',
                    'options' => [
                        'one' => esc_html__( 'Style 1', 'fancy-post-grid' ),
                        'two' => esc_html__( 'Style 2', 'fancy-post-grid' ),
                        'three' => esc_html__( 'Style 3', 'fancy-post-grid' ),
                        'four' => esc_html__( 'Style 4', 'fancy-post-grid' ),
                    ],
                ]
            );
            $this->add_control(
                'query_type',
                [
                    'label' => esc_html__( 'Query Type', 'fancy-post-grid' ),
                    'description' => esc_html__( 'Choose "Archive" if this widget is used on an archive template to display the current page’s posts.', 'fancy-post-grid' ),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'custom',
                    'options' => [
                        'custom'  => esc_html__( 'Custom', 'fancy-post-grid' ),
                        'archive' => esc_html__( 'Archive', 'fancy-post-grid' ),
                    ],
                    'separator' => 'before',
                ]
            );

            $this->add_control(
                'column_ctrl_heading',
                [
                    'label' => esc_html__( 'Column Control', 'fancy-post-grid' ),
                    'type' => Controls_Manager::HEADING,
                    'classes' => 'fpg-control-type-heading',
                    'separator' => 'before',
                ]
            );
            $this->add_responsive_control(
                'column_count_large',
                [
                    'label' => esc_html__( 'Column (Large)', 'fancy-post-grid' ),
                    'type' => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 13,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .fpg-post-group .fpg-card-style:nth-child(4n+1)' => 'grid-column: 1 / {{SIZE}};',
                        '{{WRAPPER}} .fpg-post-group .fpg-card-style' => 'grid-column: {{SIZE}} / 13;',
                    ],
                    'condition' => [
                        'style' => 'one'
                    ]
                ]
            );
            $this->add_responsive_control(
                'column_count_small',
                [
                    'label' => esc_html__( 'Column (Small)', 'fancy-post-grid' ),
                    'type' => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 13,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .fpg-post-group .fpg-card-style' => 'grid-column: {{SIZE}} / 13;',
                    ],
                    'condition' => [
                        'style' => 'one'
                    ]
                ]
            );

            $this->add_responsive_control(
                'column_count_large_two',
                [
                    'label' => esc_html__( 'Column (Large)', 'fancy-post-grid' ),
                    'type' => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 12,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .fpg-post-group .fpg-card-style:first-child' => 'grid-column: span {{SIZE}};',
                    ],
                    'condition' => [
                        'style' => 'two'
                    ]
                ]
            );
            $this->add_responsive_control(
                'column_count_medium_two',
                [
                    'label' => esc_html__( 'Column (Medium)', 'fancy-post-grid' ),
                    'type' => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 12,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .fpg-post-group .fpg-card-style:nth-child(2)' => 'grid-column: span {{SIZE}};',
                    ],
                    'condition' => [
                        'style' => 'two'
                    ]
                ]
            );
            $this->add_responsive_control(
                'column_count_small_two',
                [
                    'label' => esc_html__( 'Column (Small)', 'fancy-post-grid' ),
                    'type' => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 12,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .fpg-post-group .fpg-card-style' => 'grid-column: span {{SIZE}};',
                    ],
                    'condition' => [
                        'style' => 'two'
                    ]
                ]
            );
            $this->add_responsive_control(
                'row_count_large_four',
                [
                    'label' => esc_html__( 'Row (Large)', 'fancy-post-grid' ),
                    'type' => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 12,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .fpg-post-group .fpg-card-style:first-child' => 'grid-row: span {{SIZE}};',
                    ],
                    'condition' => [
                        'style' => 'four'
                    ]
                ]
            );
            $this->add_responsive_control(
                'column_count_three',
                [
                    'label' => esc_html__( 'Column', 'fancy-post-grid' ),
                    'type' => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 12,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .fpg-post-group' => 'grid-template-columns: repeat({{SIZE}}, 1fr);',
                    ],
                    'condition' => [
                        'style' => ['three','four']
                    ]
                ]
            );
            $this->add_responsive_control(
                'col_gaps',
                [
                    'label' => esc_html__( 'Gap', 'fancy-post-grid' ),
                    'type' => Controls_Manager::GAPS,
                    'size_units' => [ 'px', 'em', 'rem', 'custom' ],
                    'selectors' => [
                        '{{WRAPPER}} .fpg-post-group' => 'gap: {{ROW}}{{UNIT}} {{COLUMN}}{{UNIT}};',
                    ],
                ]
            );

        $this->end_controls_section();
        // General Section Start

        // Query Builder Controls Start
        $this->fpg_register_query_controls_el(true);
        // Query Builder Controls End

        // Pagination Controls Start
        $this->start_controls_section(
			'_section_post_pagination_condition',
			[
				'label' => __( 'Pagination', 'fancy-post-grid' ),
                'tab' => Controls_Manager::TAB_CONTENT,
			]
		);
            $this->add_control(
                'show_pagination',
                [
                    'label' => esc_html__( 'Show Load More', 'fancy-post-grid' ),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__( 'Show', 'fancy-post-grid' ),
                    'label_off' => esc_html__( 'Hide', 'fancy-post-grid' ),
                    'return_value' => 'yes',
                    'default' => 'no',
                ]
            );
            $this->add_control(
                'pagination_type',
                [
                    'label' => esc_html__( 'Type', 'fancy-post-grid' ),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'default',
                    'condition' => [
                        'show_pagination' => 'yes'
                    ],
                    'options' => [
                        'default' => esc_html__( 'Default', 'fancy-post-grid' ),
                    ],
                ]
            );
            $this->add_control(
                'page_next_prev_icon_type',
                [
                    'label' => esc_html__( 'Type Next/Prev', 'fancy-post-grid' ),
                    'type' => Controls_Manager::SELECT,
                    'default' => '',
                    'options' => [
                        '' => esc_html__( 'Icon', 'fancy-post-grid' ),
                        'text' => esc_html__( 'Text', 'fancy-post-grid' ),
                    ],
                    'condition' => [
                        'show_pagination' => 'yes',
                        'pagination_type!' => 'load_more'
                    ]
                ]
            );
            $this->add_control(
                'page_next_ctrl_heading',
                [
                    'label' => esc_html__( 'Next', 'fancy-post-grid' ),
                    'type' => Controls_Manager::HEADING,
                    'classes' => 'fpg-control-type-heading',
                    'separator' => 'before',
                    'condition' => [
                        'show_pagination' => 'yes',
                        'pagination_type!' => 'load_more'
                    ]
                ]
            );
            $this->add_control(
                'page_next_icon',
                [
                    'label' => esc_html__( 'Icon', 'fancy-post-grid' ),
                    'type' => Controls_Manager::SELECT,
                    'default' => '',
                    'options' => [
                        '' => esc_html__( 'Default', 'fancy-post-grid' ),
                        'ri-arrow-right-line'        => esc_html__( 'Arrow Right', 'fancy-post-grid' ),
                        'ri-arrow-right-circle-line' => esc_html__( 'Arrow Right Circle', 'fancy-post-grid' ),
                        'ri-arrow-right-fill'        => esc_html__( 'Arrow Right Solid', 'fancy-post-grid' ),
                        'ri-arrow-right-s-line'        => esc_html__( 'Arrow Right Small', 'fancy-post-grid' ),
                        'ri-arrow-right-wide-fill'        => esc_html__( 'Arrow Right Wide', 'fancy-post-grid' ),
                        'ri-arrow-right-long-line'        => esc_html__( 'Arrow Right Long', 'fancy-post-grid' ),
                        'ri-arrow-right-double-line' => esc_html__( 'Double Arrow Right', 'fancy-post-grid' ),
                        'ri-arrow-go-forward-line'   => esc_html__( 'Go Forward', 'fancy-post-grid' ),
                        'ri-skip-forward-line'       => esc_html__( 'Skip Forward', 'fancy-post-grid' ),
                    ],
                    'condition' => [
                        'show_pagination' => 'yes',
                        'page_next_prev_icon_type!' => 'text',
                        'pagination_type!' => 'load_more',
                    ]
                ]
            );
            $this->add_control(
                'page_next_text',
                [
                    'label' => esc_html__( 'Text', 'fancy-post-grid' ),
                    'type' => Controls_Manager::TEXT,
                    'placeholder' => __( 'Next', 'fancy-post-grid' ),
                    'label_block' => true,
                    'condition' => [
                        'show_pagination' => 'yes',
                        'page_next_prev_icon_type' => 'text',
                        'pagination_type!' => 'load_more',
                    ]
                ]
            );
            $this->add_control(
                'page_prev_ctrl_heading',
                [
                    'label' => esc_html__( 'Prev', 'fancy-post-grid' ),
                    'type' => Controls_Manager::HEADING,
                    'classes' => 'fpg-control-type-heading',
                    'separator' => 'before',
                    'condition' => [
                        'show_pagination' => 'yes',
                        'pagination_type!' => 'load_more'
                    ]
                ]
            );
            $this->add_control(
                'page_prev_icon',
                [
                    'label' => esc_html__( 'Icon', 'fancy-post-grid' ),
                    'type' => Controls_Manager::SELECT,
                    'default' => '',
                    'options' => [
                        ''                          => esc_html__( 'Default', 'fancy-post-grid' ),
                        'ri-arrow-left-line'        => esc_html__( 'Arrow Left', 'fancy-post-grid' ),
                        'ri-arrow-left-circle-line' => esc_html__( 'Arrow Left Circle', 'fancy-post-grid' ),
                        'ri-arrow-left-fill'        => esc_html__( 'Arrow Left Solid', 'fancy-post-grid' ),
                        'ri-arrow-left-s-line'      => esc_html__( 'Arrow Left Small', 'fancy-post-grid' ),
                        'ri-arrow-left-wide-fill'   => esc_html__( 'Arrow Left Wide', 'fancy-post-grid' ),
                        'ri-arrow-left-long-line'   => esc_html__( 'Arrow Left Long', 'fancy-post-grid' ),
                        'ri-arrow-left-double-line' => esc_html__( 'Double Arrow Left', 'fancy-post-grid' ),
                        'ri-arrow-go-back-line'     => esc_html__( 'Go Back', 'fancy-post-grid' ),
                        'ri-skip-back-line'         => esc_html__( 'Skip Back', 'fancy-post-grid' ),
                    ],
                    'condition' => [
                        'show_pagination' => 'yes',
                        'page_next_prev_icon_type!' => 'text',
                        'pagination_type!' => 'load_more',
                    ]
                ]
            );
            $this->add_control(
                'page_prev_text',
                [
                    'label' => esc_html__( 'Text', 'fancy-post-grid' ),
                    'type' => Controls_Manager::TEXT,
                    'placeholder' => __( 'Prev', 'fancy-post-grid' ),
                    'label_block' => true,
                    'condition' => [
                        'show_pagination' => 'yes',
                        'page_next_prev_icon_type' => 'text',
                        'pagination_type!' => 'load_more',
                    ]
                ]
            );
        $this->end_controls_section();
		// Pagination Controls End

        // Thumbnail Section Start
        $this->fpg_register_group_thumbnail_content_controls_el();
        // Thumbnail Section Start

        // Title Section Start
        $this->fpg_register_group_title_content_controls_el([
            'parent_selector' => '.fpg-post-group'
        ]);
        // Title Section End
        
        // Meta Conditions Section Start
        $this->fpg_register_group_meta_content_controls_el();
        // Meta Conditions Section End

        // Button Section Start
        $this->fpg_register_group_button_content_controls_el();
        // Button Section End

        // General Style Section Start
        $this->fpg_register_group_general_style_controls_el([
            'parent_selector' => '.fpg-post-group'
        ]);
        // General Style Section End

        // Thumbnail Style Section Start
        $this->fpg_register_group_thumbnail_style_controls_el([
            'parent_selector' => '.fpg-post-group'
        ]);
        // Thumbnail Style Section End

        // Category Style Section Start
        $this->fpg_register_category_style_controls_el([
            'parent_selector' => '.fpg-post-group'
        ]);
        // Category Style Section End

        // Title Style Section Start
        $this->fpg_register_group_title_style_controls_el([
            'parent_selector' => '.fpg-post-group'
        ]);
        // Title Style Section End

        // Meta Style Section Start
        $this->fpg_register_group_meta_style_controls_el([
            'parent_selector' => '.fpg-post-group'
        ]);
        // Meta Style Section End
        
        // Button Style Section Start
        $this->fpg_register_group_button_style_controls_el([
            'parent_selector' => '.fpg-post-group'
        ]);
        // Button Style Section End

        // Pagination Style Start
		$this->fpg_register_pagination_style_controls_el( [
			'parent_selector' => '.fpg-post-parent'
		] );
		// Pagination Style Start

    }

    protected function render() {
        $settings = $this->get_settings_for_display();

	    $is_builder_preview = Plugin::$instance->editor->is_edit_mode() || 'rstb_template' === get_post_type();
	    $is_archive_query   = ( 'archive' === $settings[ 'query_type' ] );

	    if ( $is_archive_query && ! $is_builder_preview ) {
		    global $wp_query;
		    $query = $wp_query;
	    } else {
		    $query = $this->fpg_get_query( $settings, 'post' );
	    }

        $titleWord = !empty($settings['title_length']) ? $settings['title_length'] : 500;
        $titleWordDot = ('yes' === $settings['title_length_double_dot']) ? '...' : '';
        $titleWordLarge = !empty($settings['title_length_group_large']) ? $settings['title_length_group_large'] : 500;
        $titleWordDotLarge = ('yes' === $settings['title_length_double_dot_group_large']) ? '..' : '';
        $titleHoverUnderline = ('yes' === $settings['title_hover_underline']) ? 'underline' : '';

        $descWord = !empty($settings['post_desc_word']) ? $settings['post_desc_word'] : 50;
        $descWordLarge = !empty($settings['post_desc_word_group_large']) ? $settings['post_desc_word_group_large'] : 50;

        $separator_value = !empty($settings['meta_separator']) ? $settings['meta_separator'] : '';
        $separator_value_large = !empty($settings['meta_separator_group_large']) ? $settings['meta_separator_group_large'] : '';

        $btnTxt = !empty($settings['btn_text']) ? $settings['btn_text'] : 'Read More';
        $btnTxtLarge = !empty($settings['btn_text_group_large']) ? $settings['btn_text_group_large'] : 'Read More';

        $total_posts = $query->have_posts() ? $query->post_count : '';
        $row_count = !empty($total_posts) ? ceil($total_posts / 4) * 3 : 0;

        $this->add_render_attribute(
            'main',
            [
                'class' => 'fpg-post-group fpg-post-group-'.$settings['style'],
                'style' => '--total-post:'.$row_count
            ]
        );
        ?>

        <div <?php $this->print_render_attribute_string( 'main' ); ?>>
            <?php
                if ( $query->in_the_loop ) {
					echo esc_html__('This page already in a loop & not archive page.', 'fancy-post-grid');
				} else {
                    if ($query->have_posts()) {
                        $post_index = 0;
                        while ($query->have_posts()) : $query->the_post();
                            $post_id = get_the_ID();
                            $post_categories = get_the_category();

                            $postView = !empty(get_post_meta( $post_id, '_fpg_post_views_count', true )) ? get_post_meta( $post_id, '_fpg_post_views_count', true ) : '';
                            $postView = !empty($postView) ? str_pad( $postView, 2, '0', STR_PAD_LEFT ) : 0;

                            $postVideo = !empty( get_post_meta( $post_id, '_fpg_video_link', true ) ) ? get_post_meta( $post_id, '_fpg_video_link', true ) : '';

                            $post_index++;
                            if ('two' === $settings['style']) {
                                if ( in_array( $post_index, [1, 2] ) ) {
                                    $this->large_card_content(
                                        $titleWordLarge,
                                        $titleWordDotLarge,
                                        $titleHoverUnderline,
                                        $descWordLarge,
                                        $separator_value_large,
                                        $post_categories,
                                        $postView,
                                        $postVideo,
                                        $btnTxtLarge
                                    );
                                } else {
                                    $cardStyle = 'two';
                                    include FANCY_POST_GRID_PATH
."includes/ElementBlock/cards/card-style.php";
                                }
                            } elseif ('three' === $settings['style']) {
                                if ( in_array( $post_index, [1] ) ) {
                                    $this->large_card_content(
                                        $titleWordLarge,
                                        $titleWordDotLarge,
                                        $titleHoverUnderline,
                                        $descWordLarge,
                                        $separator_value_large,
                                        $post_categories,
                                        $postView,
                                        $postVideo,
                                        $btnTxtLarge
                                    );
                                } else {
                                    $cardStyle = 'one';
                                    include FANCY_POST_GRID_PATH
."includes/ElementBlock/cards/card-style.php";
                                }
                            } elseif ('four' === $settings['style']) {
                                if ( in_array( $post_index, [1] ) ) {
                                    $this->large_card_content(
                                        $titleWordLarge,
                                        $titleWordDotLarge,
                                        $titleHoverUnderline,
                                        $descWordLarge,
                                        $separator_value_large,
                                        $post_categories,
                                        $postView,
                                        $postVideo,
                                        $btnTxtLarge
                                    );
                                } else {
                                    $cardStyle = 'two';
                                    include FANCY_POST_GRID_PATH
."includes/ElementBlock/cards/card-style.php";
                                }
                            } else {
                                if ( $post_index === 1 || ($post_index - 1) % 4 === 0 ) {
                                    $this->large_card_content(
                                        $titleWordLarge,
                                        $titleWordDotLarge,
                                        $titleHoverUnderline,
                                        $descWordLarge,
                                        $separator_value_large,
                                        $post_categories,
                                        $postView,
                                        $postVideo,
                                        $btnTxtLarge
                                    );
                                } else {
                                    $cardStyle = 'two';
                                    include FANCY_POST_GRID_PATH
."includes/ElementBlock/cards/card-style.php";
                                }
                            }
                        endwhile;
                        $this->fpg_reset_query();
                    }
                }
            ?>
        </div>
        <?php if ( 'yes' === $settings[ 'show_pagination' ] ) {
            $paged = $this->fpg_get_paged( $settings );
            $big = 999999999;

            $p_nav_type = !empty($settings['page_next_prev_icon_type']) ? $settings['page_next_prev_icon_type'] : '';

            if ('text' === $p_nav_type) {
                $next = !empty($settings['page_next_text']) ? $settings['page_next_text'] : 'Next';
                $prev = !empty($settings['page_prev_text']) ? $settings['page_prev_text'] : 'Prev';
            } else {
                $next = ! empty( $settings['page_next_icon'] ) 
                    ? '<i class="' . $settings['page_next_icon'] . '"></i>'
                    : '<i class="ri-arrow-right-line"></i>';
                $prev = ! empty( $settings['page_prev_icon'] ) 
                    ? '<i class="' . $settings['page_prev_icon'] . '"></i>'
                    : '<i class="ri-arrow-left-line"></i>';
            }
            
            $pagination_links = paginate_links( [
                'base'      => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
                'format'    => '/page/%#%/',
                'current'   => $paged,
                'total'     => $query->max_num_pages,
                'prev_text' => wp_kses_post($prev),
                'next_text' => wp_kses_post($next),
                'type'      => 'array',
                'show_all'  => false,
            ] );

            if (!empty($pagination_links)) {
                echo '<div class="fpg-pagination">';
                    echo '<ul class="fancy-page-numbers">';
                        foreach ($pagination_links as $links) {
                            $links = str_replace(
                                [
                                    'class="next page-numbers',
                                    'class="prev page-numbers',
                                    'class="page-numbers current',
                                    'class="page-numbers',
                                ],
                                [
                                    'class="fpg-page-numbers next',
                                    'class="fpg-page-numbers prev',
                                    'class="fpg-page-numbers current',
                                    'class="fpg-page-numbers',
                                ],
                                $links
                            );
                            echo '<li>' . wp_kses_post($links) . '</li>';
                        }
                    echo '</ul>';
                echo '</div>';
            }
        } ?>

    <?php }

    public function large_card_content(
        $titleWordLarge,
        $titleWordDotLarge,
        $titleHoverUnderline,
        $descWordLarge,
        $separator_value_large,
        $post_categories,
        $postView,
        $postVideo,
        $btnTxtLarge,
        $groupCardStyle = 'floating card-large'
    ) {
        $settings = $this->get_settings_for_display();
        if ('yes' === $settings['show_meta_data']) {
            $separator = !empty($separator_value_large) ? '<span class="fpg-meta-separator">' . $separator_value_large . '</span>' : '';
            $meta_items = [
                'post_author' => [
                    'condition' => ('yes' === $settings['show_post_author_group_large']),
                    'class'     => 'fpg-meta',
                    'icon'      => (
                        'yes' === $settings['show_meta_data_icon_group_large'] &&
                        'yes' === $settings['author_icon_visibility_group_large']
                    )
                        ? (
                            'icon' === $settings['author_image_icon_group_large']
                                ? '<i class="fa fa-user"></i>'
                                : '<img src="' . esc_url(get_avatar_url(get_the_author_meta('ID'))) . '" alt="' . esc_attr__('Author', 'fancy-post-grid') . '" class="author-avatar" />'
                        )
                        : '',
                    'content'   => sprintf(
                        '<span>%s <a href="%s" class="fpg-author-link">%s</span></a>',
                        esc_html($settings['author_prefix']),
                        esc_url(get_author_posts_url(get_the_author_meta('ID'))),
                        esc_html(get_the_author())
                    ),
                ],
                'post_views' => [
                    'condition' => 'yes' === $settings['show_post_views_group_large'],
                    'class'     => 'fpg-meta',
                    'icon'      => ('yes' === $settings['show_meta_data_icon_group_large'] && 'yes' === $settings['show_post_views_icon_group_large']) 
                                    ? '<i class="ri-pulse-fill"></i>' 
                                    : '',
                    'content'   => esc_html($postView) . ' ' . esc_html__('Views', 'fancy-post-grid'),
                ],
                'post_tags' => array(
                    'condition' => 'yes' === $settings['show_post_tags_group_large'] && !empty(get_the_tag_list('', ', ')),
                    'class'     => 'fpg-meta',
                    'icon'      => ('yes' === $settings['show_meta_data_icon_group_large'] && 'yes' === $settings['show_post_tags_icon_group_large']) ? '<i class="ri-price-tag-3-line"></i>' : '',
                    'content'   => get_the_tag_list('', ', '),
                ),
                'comments_count' => array(
                    'condition' => 'yes' === $settings['show_comments_count_group_large'],
                    'class'     => 'fpg-meta',
                    'icon'      => ('yes' === $settings['show_meta_data_icon_group_large'] && 'yes' === $settings['show_comments_count_icon_group_large']) ? '<i class="ri-message-3-line"></i>' : '',
                    'content'   => sprintf(
                        '<a href="%s">%s</a>',
                        esc_url(get_comments_link()),
                        esc_html(get_comments_number_text(__('0 Comments', 'fancy-post-grid'), __('1 Comment', 'fancy-post-grid'), __('% Comments', 'fancy-post-grid')))
                    ),
                ),
                'post_date' => [
                    'condition' => 'yes' === $settings['show_post_date_group_large'],
                    'class'     => 'fpg-meta',
                    'icon'      => ('yes' === $settings['show_meta_data_icon_group_large'] && 'yes' === $settings['show_post_date_icon_group_large']) ? '<i class="ri-calendar-line"></i>' : '',
                    'content'   => esc_html(get_the_date('M j, Y')),
                ],
            ];

            ob_start(); ?>
            <ul class="fpg-post-meta">
                <?php
                    $meta_items_output = [];
                    foreach ($meta_items as $meta) {
                        if ($meta['condition']) {
                            $meta_items_output[] = '<li>'
                                . '<span class="' . esc_attr($meta['class']) . '">'
                                    . $meta['icon'] . ' ' . $meta['content']
                                . '</span>'
                            . '</li>';
                        }
                    }

                    echo wp_kses_post(implode(wp_kses_post($separator), $meta_items_output));
                ?>
            </ul>
            <?php
            $metadata = ob_get_clean();
        } ?>

        <div class="fpg-card-style style-<?php echo esc_attr($groupCardStyle); ?>">
            <?php if (has_post_thumbnail() && ('yes' === $settings['show_post_thumbnail_group_large'])) {
                ?>
                <div class="fpg-post-thumb">
                    <?php if (!empty($postVideo) && ('play_btn' === $settings['thumbnail_type_group_large'])) { ?>
                        <?php the_post_thumbnail($settings['thumbnail_group_large_size']); ?>
                        <a href="<?php echo esc_url($postVideo); ?>" class="fpg-play-btn popup-video">
                            <i class="ri-play-fill"></i>
                        </a>
                    <?php } elseif (!empty($postVideo) && ('video' === $settings['thumbnail_type_group_large'])) {
                        if ( strpos( $postVideo, 'youtube.com' ) !== false || strpos( $postVideo, 'youtu.be' ) !== false ) {
                            $youtube_id = '';
                            if ( preg_match( '/(?:youtube\.com\/.*v=|youtu\.be\/)([^&]+)/', $postVideo, $matches ) ) {
                                $youtube_id = $matches[1];
                            }
                            if ( $youtube_id ) { ?>
                                <div class="fpg-player plyr__video-embed" data-plyr-provider="youtube" data-plyr-embed-id="<?php echo esc_html($youtube_id); ?>"></div>
                            <?php }
                        } elseif ( strpos( $postVideo, 'vimeo.com' ) !== false ) {
                            $vimeo_id = '';
                            if ( preg_match( '/vimeo\.com\/(\d+)/', $postVideo, $matches ) ) {
                                $vimeo_id = $matches[1];
                            }
                            if ( $vimeo_id ) { ?>
                                <div class="fpg-player plyr__video-embed" data-plyr-provider="vimeo" data-plyr-embed-id="<?php echo esc_html($vimeo_id); ?>"></div>
                            <?php }
                        } else { ?>
                            <video class="fpg-player plyr" autoplay muted loop controls>
                                <source src="<?php echo esc_url( $postVideo ); ?>" type="video/mp4">
                            </video>
                            <?php
                        }
                    } else { ?>
                        <a href="<?php the_permalink(); ?>" class="image-link">
                            <?php the_post_thumbnail($settings['thumbnail_group_large_size']); ?>
                        </a>
                    <?php }
                    if ('yes' === $settings['show_thumbnail_overlay_large']) {
                        echo '<div class="thumb-overlay"></div>';
                    } ?>
                </div>
            <?php } ?>
            <div class="fpg-post-content">
                <?php if (('yes' === $settings['show_meta_data_group_large']) && ('before_content' === $settings['meta_appearance_group_large'])) {
                    echo $metadata;
                } ?>
                <div class="fpg-post-content-inner">
                    <?php
                        if ( 'yes' === $settings['show_post_categories_group_large'] && !empty( $post_categories ) ) {
                            echo '<div class="fpg-post-cat">';
                                foreach ( $post_categories as $cat ) :
                                    $cat_bg = get_term_meta( $cat->term_id, 'fpg_bg_color', true );
                                    $style = $cat_bg ? '--catCurrentColor: ' . esc_attr( $cat_bg ) . ';' : '';
                                ?>
                                    <a href="<?php echo esc_url( get_category_link( $cat->term_id ) ); ?>" 
                                    class="post-cat"
                                    style="<?php echo esc_attr( $style ); ?>">
                                        <?php echo esc_html( $cat->name ); ?>
                                    </a>
                                <?php endforeach;
                            echo '</div>';
                        }
                        if ('yes' === $settings['show_post_title_group_large']) {
                            printf(
                                '<%1$s class="%2$s"><a href="%3$s">%4$s</a></%1$s>',
                                $settings['title_tag_group_large'],
                                'fpg-post-title '.$titleHoverUnderline,
                                esc_url(get_permalink()),
                                esc_html(wp_trim_words(get_the_title(), $titleWordLarge, $titleWordDotLarge))
                            );
                        }
                        if (('yes' === $settings['show_meta_data_group_large']) && ('after_title' === $settings['meta_appearance_group_large'])) {
                            echo $metadata;
                        }
                        if ('yes' === $settings['show_post_desc_group_large']) {
                            $raw_excerpt = has_excerpt() ? get_the_excerpt() : wp_strip_all_tags( get_the_content() );
                            $the_excerpt = wp_trim_words( $raw_excerpt, $descWordLarge, '...' );
                            printf( '<p class="fpg-post-excerpt">%1$s</p>',
                                $the_excerpt
                            );
                        } ?>
                </div>
                <?php
                if (('yes' === $settings['show_meta_data_group_large']) && empty($settings['meta_appearance_group_large'])) {
                    echo $metadata;
                }
                if ('yes' === $settings['show_button_group_large']) { ?>
                    <div class="fpg-btn-wrapper">
                        <a href="<?php the_permalink(); ?>">
                            <?php
                                echo esc_html($btnTxtLarge);
                                if ('yes' === $settings['show_button_icon_group_large']) {
                                    \Elementor\Icons_Manager::render_icon( $settings['btn_icon_group_large'], [ 'aria-hidden' => 'true' ] );
                                }
                            ?>
                        </a>
                    </div>
                <?php } ?>
            </div>
        </div>
    <?php }
}