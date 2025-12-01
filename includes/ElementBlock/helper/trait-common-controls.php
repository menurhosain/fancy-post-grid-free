<?php
use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Widget_Base;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Text_Stroke;

trait FPG_Common_Controls {

    // Register Elementor Meta Control For Meta Condition
    protected function fpg_register_meta_content_controls_el() {
        $this->start_controls_section(
			'_section_meta_condition',
			[
				'label' => __( 'Meta Conditions', 'fancy-post-grid' ),
                'tab' => Controls_Manager::TAB_CONTENT,
			]
		);
            $this->add_control(
                'category_meta_ctrl_heading',
                [
                    'label' => esc_html__( 'Category', 'fancy-post-grid' ),
                    'type' => Controls_Manager::HEADING,
                    'classes' => 'fpg-control-type-heading',
                ]
            );
            $this->add_control(
                'show_post_categories',
                [
                    'label'   => esc_html__( 'Show Post Categories', 'fancy-post-grid' ),
                    'type'    => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__( 'Show', 'fancy-post-grid' ),
                    'label_off' => esc_html__( 'Hide', 'fancy-post-grid' ),
                    'return_value' => 'yes',
                    'default' => 'yes'
                ]
            );
            $this->add_control(
                'meta_list_ctrl_heading',
                [
                    'label' => esc_html__( 'Meta List', 'fancy-post-grid' ),
                    'type' => Controls_Manager::HEADING,
                    'classes' => 'fpg-control-type-heading',
                    'separator' => 'before',
                ]
            );
            $this->add_control(
                'show_meta_data',
                [
                    'label'   => esc_html__( 'Show Meta', 'fancy-post-grid' ),
                    'type'    => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__( 'Show', 'fancy-post-grid' ),
                    'label_off' => esc_html__( 'Hide', 'fancy-post-grid' ),
                    'return_value' => 'yes',
                    'default' => 'yes',
                ]
            );
            $this->add_control(
                'meta_appearance',
                [
                    'label' => esc_html__( 'Meta Position', 'fancy-post-grid' ),
                    'type' => Controls_Manager::SELECT,
                    'default' => '',
                    'options' => [
                        '' => esc_html__( 'Default', 'fancy-post-grid' ),
                        'after_title' => esc_html__( 'After Title', 'fancy-post-grid' ),
                        'before_content' => esc_html__( 'Before Content', 'fancy-post-grid' ),
                    ],
                    'condition' => [
                        'show_meta_data' => 'yes'
                    ],
                    'separator' => 'before',
                ]
            );
            $this->add_control(
                'show_meta_separator',
                [
                    'label'   => esc_html__( 'Show Meta Separator', 'fancy-post-grid' ),
                    'type'    => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__( 'Show', 'fancy-post-grid' ),
                    'label_off' => esc_html__( 'Hide', 'fancy-post-grid' ),
                    'return_value' => 'yes',
                    'default' => 'no',
                    'separator' => 'before',
                    'condition' => [
                        'show_meta_data' => 'yes'
                    ],
                ]
            );
            $this->add_control(
                'meta_separator',
                [
                    'label' => esc_html__( 'Separator', 'fancy-post-grid' ),
                    'placeholder' => esc_html__( '/', 'fancy-post-grid' ),
                    'type' => Controls_Manager::TEXT,
                    'condition' => [
                        'show_meta_data' => 'yes',
                        'show_meta_separator' => 'yes'
                    ]
                ]
            );
            $this->add_control(
                'show_meta_data_icon',
                [
                    'label'   => esc_html__( 'Show Meta Icon', 'fancy-post-grid' ),
                    'type'    => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__( 'Show', 'fancy-post-grid' ),
                    'label_off' => esc_html__( 'Hide', 'fancy-post-grid' ),
                    'return_value' => 'yes',
                    'default' => 'yes',
                    'separator' => 'before',
                    'condition' => [
                        'show_meta_data' => 'yes'
                    ]
                ]
            );
            $this->add_control(
                'show_post_author',
                [
                    'label'   => esc_html__( 'Show Post Author', 'fancy-post-grid' ),
                    'type'    => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__( 'Show', 'fancy-post-grid' ),
                    'label_off' => esc_html__( 'Hide', 'fancy-post-grid' ),
                    'return_value' => 'yes',
                    'default' => 'yes',
                    'separator' => 'before',
                    'condition' => [
                        'show_meta_data' => 'yes'
                    ]
                ]
            );
            $this->add_control(
                'author_prefix',
                [
                    'label'       => esc_html__( 'Author Prefix', 'fancy-post-grid' ),
                    'type'        => Controls_Manager::TEXT,
                    'default'     => esc_html__( 'By', 'fancy-post-grid' ),
                    'placeholder' => esc_html__( 'Enter prefix text', 'fancy-post-grid' ),
                    'condition' => [
                        'show_meta_data' => 'yes',
                        'show_post_author' => 'yes'
                    ]
                ]
            );
            $this->add_control(
                'author_icon_visibility',
                [
                    'label'        => esc_html__( 'Show Author Icon', 'fancy-post-grid' ),
                    'type'         => Controls_Manager::SWITCHER,
                    'label_on'     => esc_html__( 'Show', 'fancy-post-grid' ),
                    'label_off'    => esc_html__( 'Hide', 'fancy-post-grid' ),
                    'return_value' => 'yes',
                    'default'      => 'yes',
                    'condition' => [
                        'show_meta_data' => 'yes',
                        'show_post_author' => 'yes'
                    ]
                ]
            );
            $this->add_control(
                'author_image_icon',
                [
                    'label'   => esc_html__( 'Author Image/Icon', 'fancy-post-grid' ),
                    'type'    => Controls_Manager::SELECT,
                    'options' => [
                        'image' => esc_html__( 'Image', 'fancy-post-grid' ),
                        'icon'  => esc_html__( 'Icon', 'fancy-post-grid' ),
                    ],
                    'default' => 'icon',
                    'condition' => [
                        'show_meta_data' => 'yes',
                        'author_icon_visibility' => 'yes',
                        'show_post_author' => 'yes'
                    ],
                ]
            );
            $this->add_control(
                'show_post_views',
                [
                    'label'   => esc_html__( 'Show Post Views', 'fancy-post-grid' ),
                    'type'    => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__( 'Show', 'fancy-post-grid' ),
                    'label_off' => esc_html__( 'Hide', 'fancy-post-grid' ),
                    'return_value' => 'yes',
                    'default' => 'yes',
                    'separator' => 'before',
                    'condition' => [
                        'show_meta_data' => 'yes'
                    ]
                ]
            );
            $this->add_control(
                'show_post_views_icon',
                [
                    'label'   => esc_html__( 'Show Post Views icon', 'fancy-post-grid' ),
                    'type'    => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__( 'Show', 'fancy-post-grid' ),
                    'label_off' => esc_html__( 'Hide', 'fancy-post-grid' ),
                    'return_value' => 'yes',
                    'default' => 'yes',
                    'condition' => [
                        'show_meta_data' => 'yes',
                        'show_post_views' => 'yes',
                    ],
                ]
            );
            $this->add_control(
                'show_post_tags',
                [
                    'label'   => esc_html__( 'Show Post Tags', 'fancy-post-grid' ),
                    'type'    => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__( 'Show', 'fancy-post-grid' ),
                    'label_off' => esc_html__( 'Hide', 'fancy-post-grid' ),
                    'return_value' => 'yes',
                    'default' => 'no',
                    'separator' => 'before',
                    'condition' => [
                        'show_meta_data' => 'yes'
                    ]
                ]
            );
            $this->add_control(
                'show_post_tags_icon',
                [
                    'label'   => esc_html__( 'Show Post Tags icon', 'fancy-post-grid' ),
                    'type'    => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__( 'Show', 'fancy-post-grid' ),
                    'label_off' => esc_html__( 'Hide', 'fancy-post-grid' ),
                    'return_value' => 'yes',
                    'default' => 'yes',
                    'condition' => [
                        'show_meta_data' => 'yes',
                        'show_post_tags' => 'yes',
                    ],
                ]
            );
            $this->add_control(
                'show_comments_count',
                [
                    'label'   => esc_html__( 'Show Comment Count', 'fancy-post-grid' ),
                    'type'    => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__( 'Show', 'fancy-post-grid' ),
                    'label_off' => esc_html__( 'Hide', 'fancy-post-grid' ),
                    'return_value' => 'yes',
                    'default' => 'no',
                    'separator' => 'before',
                    'condition' => [
                        'show_meta_data' => 'yes'
                    ]
                ]
            );
            $this->add_control(
                'show_comments_count_icon',
                [
                    'label'   => esc_html__( 'Show Comment Count icon', 'fancy-post-grid' ),
                    'type'    => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__( 'Show', 'fancy-post-grid' ),
                    'label_off' => esc_html__( 'Hide', 'fancy-post-grid' ),
                    'return_value' => 'yes',
                    'default' => 'yes',
                    'condition' => [
                        'show_meta_data' => 'yes',
                        'show_comments_count' => 'yes',
                    ],
                ]
            );
            $this->add_control(
                'show_post_date',
                [
                    'label'   => esc_html__( 'Show Post Date', 'fancy-post-grid' ),
                    'type'    => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__( 'Show', 'fancy-post-grid' ),
                    'label_off' => esc_html__( 'Hide', 'fancy-post-grid' ),
                    'return_value' => 'yes',
                    'default' => 'no',
                    'separator' => 'before',
                    'condition' => [
                        'show_meta_data' => 'yes'
                    ]
                ]
            );
            $this->add_control(
                'show_post_date_icon',
                [
                    'label'   => esc_html__( 'Show Post Date icon', 'fancy-post-grid' ),
                    'type'    => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__( 'Show', 'fancy-post-grid' ),
                    'label_off' => esc_html__( 'Hide', 'fancy-post-grid' ),
                    'return_value' => 'yes',
                    'default' => 'yes',
                    'condition' => [
                        'show_meta_data' => 'yes',
                        'show_post_date' => 'yes',
                    ],
                ]
            );
        $this->end_controls_section();
    }

    // Register Elementor Post Pagination Control
    protected function fpg_register_post_pagination_controls_el($condition = false) {
	    $type_condition = [
		    'show_pagination' => 'yes'
	    ];

	    if ( $condition ) {
		    $type_condition[ 'query_type!' ] = 'archive';
	    }
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
                    'label' => esc_html__( 'Show Pagination', 'fancy-post-grid' ),
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
                    'options' => [
                        'default' => esc_html__( 'Default', 'fancy-post-grid' ),
                        'load_more' => esc_html__( 'Load More', 'fancy-post-grid' ),
                    ],
                    'condition' => $type_condition
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

            $this->add_control(
                'load_more_btn_text',
                [
                    'label' => esc_html__( 'Button Text', 'fancy-post-grid' ),
                    'type' => Controls_Manager::TEXT,
                    'default' => __( 'Load More', 'fancy-post-grid' ),
                    'label_block' => true,
                    'condition' => [
                        'show_pagination' => 'yes',
                        'pagination_type' => 'load_more'
                    ]
                ]
            );
            $this->add_control(
                'post_per_click',
                [
                    'label' => esc_html__( 'Post Per Click', 'fancy-post-grid' ),
                    'type' => Controls_Manager::NUMBER,
                    'min' => 1,
                    'default' => 3,
                    'condition' => [
                        'show_pagination' => 'yes',
                        'pagination_type' => 'load_more'
                    ]
                ]
            );
            $this->add_control(
                'load_complete_ctrl_heading',
                [
                    'label' => esc_html__( 'Load Complete Message', 'fancy-post-grid' ),
                    'type' => Controls_Manager::HEADING,
                    'classes' => 'fpg-control-type-heading',
                    'separator' => 'before',
                    'condition' => [
                        'show_pagination' => 'yes',
                        'pagination_type' => 'load_more'
                    ]
                ]
            );
            $this->add_control(
                'load_complete_message',
                [
                    'label' => esc_html__( 'Text', 'fancy-post-grid' ),
                    'type' => Controls_Manager::TEXT,
                    'default' => __( "🥰 That's all for now!", 'fancy-post-grid' ),
                    'label_block' => true,
                    'condition' => [
                        'show_pagination' => 'yes',
                        'pagination_type' => 'load_more'
                    ]
                ]
            );
        $this->end_controls_section();
    }

    // Register Elementor Button Control For Meta Condition
    protected function fpg_register_button_content_controls_el() {
        $this->start_controls_section(
			'_section_button_content',
			[
				'label' => __( 'Button', 'fancy-post-grid' ),
                'tab' => Controls_Manager::TAB_CONTENT,
			]
		);
            $this->add_control(
                'show_button',
                [
                    'label' => esc_html__( 'Show Button', 'fancy-post-grid' ),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__( 'Show', 'fancy-post-grid' ),
                    'label_off' => esc_html__( 'Hide', 'fancy-post-grid' ),
                    'return_value' => 'yes',
                    'default' => 'no',
                ]
            );
            $this->add_control(
                'btn_text',
                [
                    'label' => esc_html__( 'Text', 'fancy-post-grid' ),
                    'type' => Controls_Manager::TEXT,
                    'placeholder' => __( 'Read More', 'fancy-post-grid' ),
                    'label_block' => true,
                    'condition' => [
                        'show_button' => 'yes'
                    ]
                ]
            );
            $this->add_control(
                'show_button_icon',
                [
                    'label' => esc_html__( 'Show Icon', 'fancy-post-grid' ),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__( 'Show', 'fancy-post-grid' ),
                    'label_off' => esc_html__( 'Hide', 'fancy-post-grid' ),
                    'return_value' => 'yes',
                    'default' => 'yes',
                    'condition' => [
                        'show_button' => 'yes'
                    ]
                ]
            );
            $this->add_control(
                'btn_icon',
                [
                    'label' => esc_html__( 'Icon', 'fancy-post-grid' ),
                    'type' => Controls_Manager::ICONS,
                    'default' => [
                        'value' => 'fas fa-arrow-right',
                        'library' => 'fa-solid',
                    ],
                    'condition' => [
                        'show_button' => 'yes',
                        'show_button_icon' => 'yes'
                    ]
                ]
            );
        $this->end_controls_section();
    }

    // Register Elementor Content Control For Thumbnail
    protected function fpg_register_thumbnail_content_controls_el() {
        $this->start_controls_section(
			'_section_thumbnail',
			[
				'label' => __( 'Thumbnail', 'fancy-post-grid' ),
                'tab' => Controls_Manager::TAB_CONTENT,
			]
		);
            $this->add_control(
                'show_post_thumbnail',
                [                    
                    'label'   => esc_html__( 'Show Thumbnail', 'fancy-post-grid' ),
                    'type'    => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__( 'Show', 'fancy-post-grid' ),
                    'label_off' => esc_html__( 'Hide', 'fancy-post-grid' ),
                    'return_value' => 'yes',
                    'default' => 'yes',
                    'separator' => 'before'
                ]
            );
            $this->add_control(
                'thumbnail_type',
                [
                    'label' => esc_html__( 'Thumbnail Type', 'fancy-post-grid' ),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'image',
                    'options' => [
                        'image' => esc_html__( 'Image Only', 'fancy-post-grid' ),
                        'video' => esc_html__( 'Video', 'fancy-post-grid' ),
                        'play_btn' => esc_html__( 'Play Button', 'fancy-post-grid' ),
                    ],
                    'condition' => [
                        'show_post_thumbnail' => 'yes'
                    ],
                    'frontend_available' => true,
                    'render_type' => 'template'
                ]
            );
            $this->add_group_control(
                Group_Control_Image_Size::get_type(),
                [
                    'name' => 'thumbnail',
                    'default' => 'full',
                    'condition' => [
                        'show_post_thumbnail' => 'yes',
                    ]
                ]
            );
            $this->add_control(
                'thumbnail_type_video_warning',
                [
                    'type'            => Controls_Manager::RAW_HTML,
                    'raw'             => __('Video link should exist with post.', 'fancy-post-grid'),
                    'content_classes' => 'fpg-panel-notice',
                    'condition' => [
                        'show_post_thumbnail' => 'yes',
                        'thumbnail_type' => ['play_btn', 'video'],
                    ],
                ]
            );
            $this->add_control(
                'video_autoplay',
                [
                    'label' => esc_html__( 'Autoplay', 'fancy-post-grid' ),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__( 'Yes', 'fancy-post-grid' ),
                    'label_off' => esc_html__( 'No', 'fancy-post-grid' ),
                    'return_value' => 'yes',
                    'default' => 'no',
                    'frontend_available' => true,
                    'render_type' => 'template',
                    'condition' => [
                        'show_post_thumbnail' => 'yes',
                        'thumbnail_type' => 'video',
                    ],
                ]
            );
            $this->add_control(
                'video_muted',
                [
                    'label' => esc_html__( 'Muted', 'fancy-post-grid' ),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__( 'Yes', 'fancy-post-grid' ),
                    'label_off' => esc_html__( 'No', 'fancy-post-grid' ),
                    'return_value' => 'yes',
                    'default' => 'yes',
                    'frontend_available' => true,
                    'render_type' => 'template',
                    'condition' => [
                        'show_post_thumbnail' => 'yes',
                        'thumbnail_type' => 'video'
                    ],
                ]
            );
            $this->add_control(
                'video_auto_play_mute_warning',
                [
                    'type'            => Controls_Manager::RAW_HTML,
                    'content_classes' => 'fpg-panel-notice',
                    'raw'             => __('Autoplay required muted state.', 'fancy-post-grid'),
                    'condition' => [
                        'show_post_thumbnail' => 'yes',
                        'thumbnail_type' => 'video',
                        'video_autoplay' => 'yes',
                        'video_muted!' => 'yes',
                    ],
                ]
            );
            $this->add_control(
                'video_loop',
                [
                    'label' => esc_html__( 'Loop', 'fancy-post-grid' ),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__( 'True', 'fancy-post-grid' ),
                    'label_off' => esc_html__( 'False', 'fancy-post-grid' ),
                    'return_value' => 'yes',
                    'default' => 'yes',
                    'frontend_available' => true,
                    'render_type' => 'template',
                    'condition' => [
                        'show_post_thumbnail' => 'yes',
                        'thumbnail_type' => 'video',
                    ],
                ]
            );
            $this->add_control(
                'video_click_to_play',
                [
                    'label' => esc_html__( 'Click To Play', 'fancy-post-grid' ),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__( 'True', 'fancy-post-grid' ),
                    'label_off' => esc_html__( 'False', 'fancy-post-grid' ),
                    'return_value' => 'yes',
                    'default' => 'yes',
                    'frontend_available' => true,
                    'render_type' => 'template',
                    'condition' => [
                        'show_post_thumbnail' => 'yes',
                        'thumbnail_type' => 'video',
                    ],
                ]
            );
            $this->add_control(
                'video_controls',
                [
                    'label' => esc_html__('Video Controls', 'fancy-post-grid'),
                    'type' => Controls_Manager::SELECT2,
                    'multiple' => true,
                    'label_block' => true,
                    'options' => [
                        'play'      => 'Play',
                        'progress'  => 'Progress',
                        'mute'      => 'Mute',
                        'volume'    => 'Volume',
                        'fullscreen'=> 'Fullscreen',
                        'settings'  => 'Settings',
                    ],
                    'default' => ['play', 'progress', 'mute'],
                    'frontend_available' => true,
                    'render_type' => 'template',
                    'condition' => [
                        'show_post_thumbnail' => 'yes',
                        'thumbnail_type' => 'video',
                    ],
                ]
            );
            $this->add_control(
                'video_controls_hide',
                [
                    'label' => esc_html__( 'Auto Hide Controls', 'fancy-post-grid' ),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__( 'True', 'fancy-post-grid' ),
                    'label_off' => esc_html__( 'False', 'fancy-post-grid' ),
                    'return_value' => 'yes',
                    'default' => 'yes',
                    'frontend_available' => true,
                    'render_type' => 'template',
                    'condition' => [
                        'show_post_thumbnail' => 'yes',
                        'thumbnail_type' => 'video',
                        'video_controls!' => '',
                    ],
                ]
            );
            $this->add_responsive_control(
                'video_scale_to_fit',
                [
                    'label' => esc_html__( 'Scale To Zoom', 'fancy-post-grid' ),
                    'type' => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 1000,
                            'step' => 0.1,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .fpg-card-style .fpg-post-thumb iframe,
                        {{WRAPPER}} .fpg-card-style .fpg-post-thumb video' => 'transform: scale({{SIZE}});',
                    ],
                    'condition' => [
                        'show_post_thumbnail' => 'yes',
                        'thumbnail_type' => 'video',
                    ],
                ]
            );
            $this->add_control(
                'aspect_ratio',
                [
                    'label' => esc_html__( 'Aspect Ratio', 'fancy-post-grid' ),
                    'type' => Controls_Manager::SELECT,
                    'default' => '',
                    'options' => [
                        '' => esc_html__( 'Default', 'fancy-post-grid' ),
                        '16 / 9' => esc_html__( '16:9', 'fancy-post-grid' ),
                        '4 / 3'  => esc_html__( '4:3', 'fancy-post-grid' ),
                        '1 / 1'  => esc_html__( '1:1', 'fancy-post-grid' ),
                        '21 / 9' => esc_html__( '21:9', 'fancy-post-grid' ),
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .fpg-card-style .fpg-post-thumb iframe,
                        {{WRAPPER}} .fpg-card-style .fpg-post-thumb video' => 'aspect-ratio: {{VALUE}} !important;',
                    ],
                    'condition' => [
                        'show_post_thumbnail' => 'yes',
                        'thumbnail_type' => 'video',
                    ],
                ]
            );
        $this->end_controls_section();
    }

    // Register Elementor Content Control For Title & Description
    protected function fpg_register_title_content_controls_el($args = []) {
        $args = wp_parse_args( $args, [
            'parent_selector' => ''
        ] );

        $this->start_controls_section(
			'_section_title_desc',
			[
				'label' => __( 'Title / Description', 'fancy-post-grid' ),
                'tab' => Controls_Manager::TAB_CONTENT,
			]
		);
            $this->add_control(
                'show_post_title',
                [
                    'label'   => esc_html__( 'Show Post Title', 'fancy-post-grid' ),
                    'type'    => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__( 'Show', 'fancy-post-grid' ),
                    'label_off' => esc_html__( 'Hide', 'fancy-post-grid' ),
                    'return_value' => 'yes',
                    'default' => 'yes'
                ]
            );
            $this->add_control(
                'title_tag',
                [
                    'label'   => esc_html__( 'Title Tag', 'fancy-post-grid' ),
                    'type'    => Controls_Manager::SELECT,
                    'default' => 'h6',
                    'options' => [
                        'h1' => esc_html__( 'H1', 'fancy-post-grid' ),
                        'h2'  => esc_html__( 'H2', 'fancy-post-grid' ),
                        'h3' => esc_html__( 'H3', 'fancy-post-grid' ),
                        'h4'  => esc_html__( 'H4', 'fancy-post-grid' ),
                        'h5' => esc_html__( 'H5', 'fancy-post-grid' ),
                        'h6'  => esc_html__( 'H6', 'fancy-post-grid' ),
                    ],
                    'condition' => [
                        'show_post_title' => 'yes'
                    ]
                ]
            );
            $this->add_responsive_control(
                'title_line_length',
                [
                    'label' => esc_html__( 'Title Line Length', 'fancy-post-grid' ),
                    'type' => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 1000,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style .fpg-post-title a' => '-webkit-line-clamp: {{SIZE}}; display: -webkit-box; -webkit-box-orient: vertical; overflow: hidden;',
                    ],
                    'condition' => [
                        'show_post_title' => 'yes'
                    ]
                ]
            );
            $this->add_control(
                'title_length',
                [
                    'label'   => esc_html__( 'Title Word Length', 'fancy-post-grid' ),
                    'type'    => Controls_Manager::NUMBER,
                    'min'     => 1,
                    'condition' => [
                        'show_post_title' => 'yes'
                    ]
                ]
            );
            $this->add_control(
                'title_length_double_dot',
                [
                    'label' => esc_html__( 'Show Double Dot', 'fancy-post-grid' ),
                    'Description' => esc_html__( 'Show double dot after title length', 'fancy-post-grid' ),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__( 'Show', 'fancy-post-grid' ),
                    'label_off' => esc_html__( 'Hide', 'fancy-post-grid' ),
                    'return_value' => 'yes',
                    'default' => 'yes',
                    'condition' => [
                        'show_post_title' => 'yes',
                        'title_length!' => ''
                    ]
                ]
            );
            // Description
            $this->add_control(
                'desc_content_ctrl_heading',
                [
                    'label' => esc_html__( 'Description', 'fancy-post-grid' ),
                    'type' => Controls_Manager::HEADING,
                    'classes' => 'fpg-control-type-heading',
                    'separator' => 'before',
                ]
            );
            $this->add_control(
                'show_post_desc',
                [
                    'label'   => esc_html__( 'Show Post Description', 'fancy-post-grid' ),
                    'type'    => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__( 'Show', 'fancy-post-grid' ),
                    'label_off' => esc_html__( 'Hide', 'fancy-post-grid' ),
                    'return_value' => 'yes',
                    'default' => 'no',
                ]
            );
            $this->add_responsive_control(
                'desc_line_length',
                [
                    'label' => esc_html__( 'Excerpt Line Length', 'fancy-post-grid' ),
                    'type' => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 1000,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style .fpg-post-excerpt' => '-webkit-line-clamp: {{SIZE}}; display: -webkit-box; -webkit-box-orient: vertical; overflow: hidden;',
                    ],
                    'condition' => [
                        'show_post_desc' => 'yes'
                    ]
                ]
            );
            $this->add_control(
                'post_desc_word',
                [
                    'label'     => esc_html__( 'Excerpt Word Length', 'fancy-post-grid' ),
                    'type'      => Controls_Manager::NUMBER,
                    'condition' => [
                        'show_post_desc' => 'yes',
                    ],
                ]
            );
        $this->end_controls_section();
    }

    // Register Elementor Style Control For General
    protected function fpg_register_general_style_controls_el($args = []) {
        $args = wp_parse_args( $args, [
            'parent_selector' => ''
        ] );

        $this->start_controls_section(
			'_general_style_section',
			[
				'label' => __( 'General Style', 'fancy-post-grid' ),
                'tab' => Controls_Manager::TAB_STYLE,
			]
		);
            $this->add_responsive_control(
                'card_text_align',
                [
                    'label' => esc_html__( 'Alignment', 'fancy-post-grid' ),
                    'type' => Controls_Manager::CHOOSE,
                    'options' => [
                        'left' => [
                            'title' => esc_html__( 'Left', 'fancy-post-grid' ),
                            'icon' => 'eicon-text-align-left',
                        ],
                        'center' => [
                            'title' => esc_html__( 'Center', 'fancy-post-grid' ),
                            'icon' => 'eicon-text-align-center',
                        ],
                        'right' => [
                            'title' => esc_html__( 'Right', 'fancy-post-grid' ),
                            'icon' => 'eicon-text-align-right',
                        ],
                    ],
                    'default' => '',
                    'toggle' => true,
                    'selectors' => [
                        '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style' => 'text-align: {{VALUE}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'card_flex_v_align',
                [
                    'label' => esc_html__( 'Vertical Align', 'fancy-post-grid' ),
                    'type' => Controls_Manager::CHOOSE,
                    'options' => [
                        'flex-start' => [ 'title' => esc_html__( 'Top', 'fancy-post-grid' ), 'icon' => 'eicon-align-start-v' ],
                        'center'     => [ 'title' => esc_html__( 'Middle', 'fancy-post-grid' ), 'icon' => 'eicon-align-center-v' ],
                        'flex-end'   => [ 'title' => esc_html__( 'Bottom', 'fancy-post-grid' ), 'icon' => 'eicon-align-end-v' ],
                    ],
                    'toggle' => true,
                    'selectors' => [
                        '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style' => 'align-items: {{VALUE}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'card_flex_h_align',
                [
                    'label' => esc_html__( 'Horizontal Align', 'fancy-post-grid' ),
                    'type' => Controls_Manager::CHOOSE,
                    'options' => [
                        'flex-start'     => [ 'title' => esc_html__( 'Start', 'fancy-post-grid' ), 'icon' => 'eicon-align-start-h' ],
                        'center'         => [ 'title' => esc_html__( 'Center', 'fancy-post-grid' ), 'icon' => 'eicon-align-center-h' ],
                        'flex-end'       => [ 'title' => esc_html__( 'End', 'fancy-post-grid' ), 'icon' => 'eicon-align-end-h' ],
                        'space-between'  => [ 'title' => esc_html__( 'Space Between', 'fancy-post-grid' ), 'icon' => 'eicon-justify-space-between-h' ],
                    ],
                    'toggle' => true,
                    'selectors' => [
                        '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style' => 'justify-content: {{VALUE}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'card_flex_dir',
                [
                    'label' => esc_html__( 'Column Direction', 'fancy-post-grid' ),
                    'type' => Controls_Manager::CHOOSE,
                    'options' => [
                        'row'            => [ 'title' => esc_html__( 'Row', 'fancy-post-grid' ), 'icon' => 'eicon-justify-start-h' ],
                        'row-reverse'    => [ 'title' => esc_html__( 'Row Reverse', 'fancy-post-grid' ), 'icon' => 'eicon-wrap' ],
                        'column'         => [ 'title' => esc_html__( 'Column', 'fancy-post-grid' ), 'icon' => 'eicon-justify-start-v' ],
                        'column-reverse' => [ 'title' => esc_html__( 'Column Reverse', 'fancy-post-grid' ), 'icon' => 'eicon-wrap' ],
                    ],
                    'toggle' => true,
                    'selectors' => [
                        '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style' => 'flex-direction: {{VALUE}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'card_flex_wrap',
                [
                    'label' => esc_html__( 'Flex Wrap', 'fancy-post-grid' ),
                    'type' => Controls_Manager::CHOOSE,
                    'options' => [
                        'nowrap' => [ 'title' => esc_html__( 'No Wrap', 'fancy-post-grid' ), 'icon' => 'eicon-nowrap' ],
                        'wrap'   => [ 'title' => esc_html__( 'Wrap', 'fancy-post-grid' ), 'icon' => 'eicon-wrap' ],
                    ],
                    'toggle' => true,
                    'selectors' => [
                        '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style' => 'flex-wrap: {{VALUE}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'card_flex_gap',
                [
                    'label' => esc_html__( 'Gap Between', 'fancy-post-grid' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%', 'custom' ],
                    'range' => [
                        'px' => [ 'min' => 0, 'max' => 1000 ],
                        '%' => [ 'min' => 0, 'max' => 100 ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style' => 'gap: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_control(
                'card_filter_blur_control',
                [
                    'label' => esc_html__( 'Backdrop Blur', 'fancy-post-grid' ),
                    'type' => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 100,
                            'step' => 1,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style' => 'backdrop-filter: blur({{SIZE}}px);',
                    ],
                ]
            );
            $this->add_responsive_control(
                'card_padding',
                [
                    'label' => esc_html__( 'Padding', 'fancy-post-grid' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', 'em', 'rem', 'custom' ],
                    'selectors' => [
                        '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'card_radius',
                [
                    'label' => esc_html__( 'Border Radius', 'fancy-post-grid' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                    'selectors' => [
                        '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'card_margin',
                [
                    'label' => esc_html__( 'Margin', 'fancy-post-grid' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', 'em', 'rem', 'custom' ],
                    'selectors' => [
                        '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->start_controls_tabs( 'card_style_tabs' );
                $this->start_controls_tab(
                    'card_style_normal_tab',
                    [
                        'label' => esc_html__( 'Normal', 'fancy-post-grid' ),
                    ]
                );
                    $this->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name' => 'card_background',
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style',
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name' => 'card_border',
                            'selector' => '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style',
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Box_Shadow::get_type(),
                        [
                            'name' => 'card_box_shadow',
                            'selector' => '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style',
                        ]
                    );

                    // First Child
                    $this->add_control(
                        'card_first_child_popover_toggle',
                        [
                            'label' => esc_html__( 'First Item', 'fancy-post-grid' ),
                            'type' => Controls_Manager::POPOVER_TOGGLE,
                            'label_off' => esc_html__( 'Default', 'fancy-post-grid' ),
                            'label_on' => esc_html__( 'Custom', 'fancy-post-grid' ),
                            'return_value' => 'yes',
                            'default' => 'no',
                            'separator' => 'before'
                        ]
                    );
                    $this->start_popover();
                        $this->add_group_control(
                            Group_Control_Border::get_type(),
                            [
                                'name' => 'card_border_first_child',
                                'selector' => '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style:first-child',
                            ]
                        );
                        $this->add_responsive_control(
                            'card_padding_first_child',
                            [
                                'label' => esc_html__( 'Padding', 'fancy-post-grid' ),
                                'type' => Controls_Manager::DIMENSIONS,
                                'size_units' => [ 'px', 'em', 'rem', 'custom' ],
                                'selectors' => [
                                    '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style:first-child' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                ],
                            ]
                        );
                        $this->add_responsive_control(
                            'card_margin_first_child',
                            [
                                'label' => esc_html__( 'Margin', 'fancy-post-grid' ),
                                'type' => Controls_Manager::DIMENSIONS,
                                'size_units' => [ 'px', 'em', 'rem', 'custom' ],
                                'selectors' => [
                                    '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style:first-child' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                ],
                            ]
                        );
                    $this->end_popover();

                    // Last Child
                    $this->add_control(
                        'card_last_child_popover_toggle',
                        [
                            'label' => esc_html__( 'Last Item', 'fancy-post-grid' ),
                            'type' => Controls_Manager::POPOVER_TOGGLE,
                            'label_off' => esc_html__( 'Default', 'fancy-post-grid' ),
                            'label_on' => esc_html__( 'Custom', 'fancy-post-grid' ),
                            'return_value' => 'yes',
                            'default' => 'no',
                            'separator' => 'before'
                        ]
                    );
                    $this->start_popover();
                        $this->add_group_control(
                            Group_Control_Border::get_type(),
                            [
                                'name' => 'card_border_last_child',
                                'selector' => '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style:last-child',
                            ]
                        );
                        $this->add_responsive_control(
                            'card_padding_last_child',
                            [
                                'label' => esc_html__( 'Padding', 'fancy-post-grid' ),
                                'type' => Controls_Manager::DIMENSIONS,
                                'size_units' => [ 'px', 'em', 'rem', 'custom' ],
                                'selectors' => [
                                    '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style:last-child' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                ],
                            ]
                        );
                        $this->add_responsive_control(
                            'card_margin_last_child',
                            [
                                'label' => esc_html__( 'Margin', 'fancy-post-grid' ),
                                'type' => Controls_Manager::DIMENSIONS,
                                'size_units' => [ 'px', 'em', 'rem', 'custom' ],
                                'selectors' => [
                                    '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style:last-child' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                ],
                            ]
                        );
                    $this->end_popover();

                $this->end_controls_tab();
                $this->start_controls_tab(
                    'card_style_hover_tab',
                    [
                        'label' => esc_html__( 'Hover', 'fancy-post-grid' ),
                    ]
                );
                    $this->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name' => 'card_background_hover',
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style:hover',
                        ]
                    );
                    $this->add_control(
                        'card_border_color_hover',
                        [
                            'label' => esc_html__( 'Border Color', 'fancy-post-grid' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style:hover' => 'border-color: {{VALUE}};',
                            ],
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Box_Shadow::get_type(),
                        [
                            'name' => 'card_box_shadow_hover',
                            'selector' => '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style:hover',
                        ]
                    );
                $this->end_controls_tab();
            $this->end_controls_tabs();
        $this->end_controls_section();
    }

    // Register Elementor Style Control For Category
    protected function fpg_register_category_style_controls_el($args = []) {
        $args = wp_parse_args( $args, [
            'parent_selector' => ''
        ] );
        $this->start_controls_section(
			'_category_style_section',
			[
				'label' => __( 'Category Style', 'fancy-post-grid' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_post_categories' => 'yes'
                ]
			]
		);
            $this->add_control(
                'category_wrapper_ctrl_heading',
                [
                    'label' => esc_html__( 'Wrapper', 'fancy-post-grid' ),
                    'type' => Controls_Manager::HEADING,
                    'classes' => 'fpg-control-type-heading',
                ]
            );
            // Flex Control
            $this->add_control(
                'category_flex_control',
                [
                    'label' => esc_html__( 'Flex Control', 'fancy-post-grid' ),
                    'type' => Controls_Manager::POPOVER_TOGGLE,
                    'label_off' => esc_html__( 'Default', 'fancy-post-grid' ),
                    'label_on' => esc_html__( 'Custom', 'fancy-post-grid' ),
                    'return_value' => 'yes',
                    'default' => 'no',
                ]
            );
            $this->start_popover();
                $this->add_responsive_control(
                    'category_wrapper_flex_v_align',
                    [
                        'label' => esc_html__( 'Vertical Align', 'fancy-post-grid' ),
                        'type' => Controls_Manager::CHOOSE,
                        'options' => [
                            'flex-start' => [ 'title' => esc_html__( 'Top', 'fancy-post-grid' ), 'icon' => 'eicon-align-start-v' ],
                            'center'     => [ 'title' => esc_html__( 'Middle', 'fancy-post-grid' ), 'icon' => 'eicon-align-center-v' ],
                            'flex-end'   => [ 'title' => esc_html__( 'Bottom', 'fancy-post-grid' ), 'icon' => 'eicon-align-end-v' ],
                        ],
                        'toggle' => true,
                        'selectors' => [
                            '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style .fpg-card-style .fpg-post-cat' => 'align-items: {{VALUE}};',
                        ],
                    ]
                );
                $this->add_responsive_control(
                    'category_wrapper_flex_h_align',
                    [
                        'label' => esc_html__( 'Horizontal Align', 'fancy-post-grid' ),
                        'type' => Controls_Manager::CHOOSE,
                        'options' => [
                            'flex-start'     => [ 'title' => esc_html__( 'Start', 'fancy-post-grid' ), 'icon' => 'eicon-align-start-h' ],
                            'center'         => [ 'title' => esc_html__( 'Center', 'fancy-post-grid' ), 'icon' => 'eicon-align-center-h' ],
                            'flex-end'       => [ 'title' => esc_html__( 'End', 'fancy-post-grid' ), 'icon' => 'eicon-align-end-h' ],
                            'space-between'  => [ 'title' => esc_html__( 'Space Between', 'fancy-post-grid' ), 'icon' => 'eicon-justify-space-between-h' ],
                        ],
                        'toggle' => true,
                        'selectors' => [
                            '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style .fpg-post-cat' => 'justify-content: {{VALUE}};',
                        ],
                    ]
                );
                $this->add_responsive_control(
                    'category_wrapper_flex_dir',
                    [
                        'label' => esc_html__( 'Column Direction', 'fancy-post-grid' ),
                        'type' => Controls_Manager::CHOOSE,
                        'options' => [
                            'row'            => [ 'title' => esc_html__( 'Row', 'fancy-post-grid' ), 'icon' => 'eicon-justify-start-h' ],
                            'row-reverse'    => [ 'title' => esc_html__( 'Row Reverse', 'fancy-post-grid' ), 'icon' => 'eicon-wrap' ],
                            'column'         => [ 'title' => esc_html__( 'Column', 'fancy-post-grid' ), 'icon' => 'eicon-justify-start-v' ],
                            'column-reverse' => [ 'title' => esc_html__( 'Column Reverse', 'fancy-post-grid' ), 'icon' => 'eicon-wrap' ],
                        ],
                        'toggle' => true,
                        'selectors' => [
                            '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style .fpg-post-cat' => 'flex-direction: {{VALUE}};',
                        ],
                    ]
                );
                $this->add_responsive_control(
                    'category_wrapper_flex_wrap',
                    [
                        'label' => esc_html__( 'Flex Wrap', 'fancy-post-grid' ),
                        'type' => Controls_Manager::CHOOSE,
                        'options' => [
                            'nowrap' => [ 'title' => esc_html__( 'No Wrap', 'fancy-post-grid' ), 'icon' => 'eicon-nowrap' ],
                            'wrap'   => [ 'title' => esc_html__( 'Wrap', 'fancy-post-grid' ), 'icon' => 'eicon-wrap' ],
                        ],
                        'toggle' => true,
                        'selectors' => [
                            '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style .fpg-post-cat' => 'flex-wrap: {{VALUE}};',
                        ],
                    ]
                );
                $this->add_responsive_control(
                    'category_wrapper_flex_gap',
                    [
                        'label' => esc_html__( 'Gap Between', 'fancy-post-grid' ),
                        'type' => Controls_Manager::SLIDER,
                        'size_units' => [ 'px', '%', 'custom' ],
                        'range' => [
                            'px' => [ 'min' => 0, 'max' => 1000 ],
                            '%' => [ 'min' => 0, 'max' => 100 ],
                        ],
                        'selectors' => [
                            '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style .fpg-post-cat' => 'gap: {{SIZE}}{{UNIT}};',
                        ],
                    ]
                );
            $this->end_popover();

            // Position Maker
            $this->add_control(
                'category_position_maker',
                [
                    'label' => esc_html__( 'Position Maker', 'fancy-post-grid' ),
                    'type' => Controls_Manager::POPOVER_TOGGLE,
                    'label_off' => esc_html__( 'Default', 'fancy-post-grid' ),
                    'label_on' => esc_html__( 'Custom', 'fancy-post-grid' ),
                    'return_value' => 'yes',
                    'default' => 'no',
                ]
            );
            $this->start_popover();
                $this->add_responsive_control(
                    'category_position',
                    [
                        'label' => esc_html__( 'Position', 'fancy-post-grid' ),
                        'type' => Controls_Manager::SELECT,
                        'default' => '',
                        'options' => [
                            '' => esc_html__( 'Default', 'fancy-post-grid' ),
                            'unset' => esc_html__( 'Unset', 'fancy-post-grid' ),
                            'absolute' => esc_html__( 'Absolute', 'fancy-post-grid' ),
                            'relative'  => esc_html__( 'Relative', 'fancy-post-grid' ),
                        ],
                        'selectors' => [
                            '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style .fpg-post-cat' => 'position: {{VALUE}};',
                        ],
                    ]
                );
                $this->add_responsive_control(
                    'category_p_top',
                    [
                        'label' => esc_html__( 'Top', 'fancy-post-grid' ),
                        'type' => Controls_Manager::SLIDER,
                        'size_units' => [ 'px', '%', 'custom' ],
                        'range' => [
                            'px' => [ 'min' => -1000, 'max' => 1000 ],
                            '%' => [ 'min' => -100, 'max' => 100 ],
                        ],
                        'condition' => [ 'category_position' => ['absolute', 'relative'] ],
                        'selectors' => [
                            '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style .fpg-post-cat' => 'top: {{SIZE}}{{UNIT}};',
                        ],
                    ]
                );
                $this->add_responsive_control(
                    'category_p_right',
                    [
                        'label' => esc_html__( 'Right', 'fancy-post-grid' ),
                        'type' => Controls_Manager::SLIDER,
                        'size_units' => [ 'px', '%', 'custom' ],
                        'range' => [
                            'px' => [ 'min' => -1000, 'max' => 1000 ],
                            '%' => [ 'min' => -100, 'max' => 100 ],
                        ],
                        'condition' => [ 'category_position' => ['absolute', 'relative'] ],
                        'selectors' => [
                            '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style .fpg-post-cat' => 'right: {{SIZE}}{{UNIT}};',
                        ],
                    ]
                );
                $this->add_responsive_control(
                    'category_p_bottom',
                    [
                        'label' => esc_html__( 'Bottom', 'fancy-post-grid' ),
                        'type' => Controls_Manager::SLIDER,
                        'size_units' => [ 'px', '%', 'custom' ],
                        'range' => [
                            'px' => [ 'min' => -1000, 'max' => 1000 ],
                            '%' => [ 'min' => -100, 'max' => 100 ],
                        ],
                        'condition' => [ 'category_position' => ['absolute', 'relative'] ],
                        'selectors' => [
                            '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style .fpg-post-cat' => 'bottom: {{SIZE}}{{UNIT}};',
                        ],
                    ]
                );
                $this->add_responsive_control(
                    'category_p_left',
                    [
                        'label' => esc_html__( 'Left', 'fancy-post-grid' ),
                        'type' => Controls_Manager::SLIDER,
                        'size_units' => [ 'px', '%', 'custom' ],
                        'range' => [
                            'px' => [ 'min' => -1000, 'max' => 1000 ],
                            '%' => [ 'min' => -100, 'max' => 100 ],
                        ],
                        'condition' => [ 'category_position' => ['absolute', 'relative'] ],
                        'selectors' => [
                            '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style .fpg-post-cat' => 'left: {{SIZE}}{{UNIT}};',
                        ],
                    ]
                );
            $this->end_popover();

            $this->add_responsive_control(
                'category_margin',
                [
                    'label' => esc_html__( 'Margin', 'fancy-post-grid' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', 'em', 'rem', 'custom' ],
                    'selectors' => [
                        '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style .fpg-post-cat' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            
            // Category Items
            $this->add_control(
                'category_item_ctrl_heading',
                [
                    'label' => esc_html__( 'Category Item', 'fancy-post-grid' ),
                    'type' => Controls_Manager::HEADING,
                    'classes' => 'fpg-control-type-heading',
                    'separator' => 'before',
                ]
            );
            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'category_typography',
                    'selector' => '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style .fpg-post-cat .post-cat',
                ]
            );
            $this->add_responsive_control(
                'category_item_padding',
                [
                    'label' => esc_html__( 'Padding', 'fancy-post-grid' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', 'em', 'rem', 'custom' ],
                    'selectors' => [
                        '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style .fpg-post-cat .post-cat' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'category_item_radius',
                [
                    'label' => esc_html__( 'Border Radius', 'fancy-post-grid' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                    'selectors' => [
                        '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style .fpg-post-cat .post-cat' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'category_item_margin',
                [
                    'label' => esc_html__( 'Margin', 'fancy-post-grid' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', 'em', 'rem', 'custom' ],
                    'selectors' => [
                        '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style .fpg-post-cat .post-cat' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_control(
                'show_category_item_dot',
                [
                    'label' => esc_html__( 'Show Dot', 'fancy-post-grid' ),
                    'type' => Controls_Manager::CHOOSE,
                    'options' => [
                        'none' => [
                            'title' => esc_html__( 'Hide', 'fancy-post-grid' ),
                            'icon' => 'eicon-editor-close',
                        ],
                        'block' => [
                            'title' => esc_html__( 'Show', 'fancy-post-grid' ),
                            'icon' => 'eicon-check',
                        ],
                    ],
                    'default' => 'none',
                    'toggle' => true,
                    'selectors' => [
                        '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style .fpg-post-cat .post-cat:before' => 'display: {{VALUE}};',
                    ],
                ]
            );
            $this->add_control(
                'cat_item_dot_popover_toggle',
                [
                    'label' => esc_html__( 'Dot Configuration', 'fancy-post-grid' ),
                    'type' => Controls_Manager::POPOVER_TOGGLE,
                    'label_off' => esc_html__( 'Default', 'fancy-post-grid' ),
                    'label_on' => esc_html__( 'Custom', 'fancy-post-grid' ),
                    'return_value' => 'yes',
                    'default' => 'yes',
                    'condition' => [
                        'show_category_item_dot' => 'block'
                    ]
                ]
            );
            $this->start_popover();
                $this->add_responsive_control(
                    'category_item_dot_size',
                    [
                        'label' => esc_html__( 'Size', 'fancy-post-grid' ),
                        'type' => Controls_Manager::SLIDER,
                        'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                        'range' => [
                            'px' => [
                                'min' => 0,
                                'max' => 1000,
                            ],
                            '%' => [
                                'min' => 0,
                                'max' => 100,
                            ],
                        ],
                        'selectors' => [
                            '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style .fpg-post-cat .post-cat:before' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                        ],
                    ]
                );
                $this->add_responsive_control(
                    'category_item_dot_radius',
                    [
                        'label' => esc_html__( 'Border Radius', 'fancy-post-grid' ),
                        'type' => Controls_Manager::DIMENSIONS,
                        'size_units' => [ 'px', 'em', 'rem', 'custom' ],
                        'selectors' => [
                            '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style .fpg-post-cat .post-cat:before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ],
                    ]
                );
                $this->add_control(
                    'category_item_dot_color',
                    [
                        'label' => esc_html__( 'Color', 'fancy-post-grid' ),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style .fpg-post-cat .post-cat:before' => 'background: {{VALUE}};',
                        ],
                    ]
                );
                $this->add_responsive_control(
                    'category_item_dot_p_y',
                    [
                        'label' => esc_html__( 'Position Y', 'fancy-post-grid' ),
                        'type' => Controls_Manager::SLIDER,
                        'size_units' => [ 'px', '%', 'custom' ],
                        'range' => [
                            'px' => [ 'min' => -1000, 'max' => 1000 ],
                            '%' => [ 'min' => -1000, 'max' => 1000 ],
                        ],
                        'selectors' => [
                            '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style .fpg-post-cat .post-cat:before' => 'top: {{SIZE}}{{UNIT}};',
                        ],
                    ]
                );
                $this->add_responsive_control(
                    'category_item_dot_p_x',
                    [
                        'label' => esc_html__( 'Position X', 'fancy-post-grid' ),
                        'type' => Controls_Manager::SLIDER,
                        'size_units' => [ 'px', '%', 'custom' ],
                        'range' => [
                            'px' => [ 'min' => -1000, 'max' => 1000 ],
                            '%' => [ 'min' => -1000, 'max' => 1000 ],
                        ],
                        'selectors' => [
                            '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style .fpg-post-cat .post-cat:before' => 'left: {{SIZE}}{{UNIT}};',
                        ],
                    ]
                );
            $this->end_popover();

            $this->start_controls_tabs( 'category_style_tabs' );
                $this->start_controls_tab(
                    'category_style_normal_tab',
                    [
                        'label' => esc_html__( 'Normal', 'fancy-post-grid' ),
                    ]
                );
                    $this->add_control(
                        'category_item_color',
                        [
                            'label' => esc_html__( 'Color', 'fancy-post-grid' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style .fpg-post-cat .post-cat' => 'color: {{VALUE}}',
                            ],
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name' => 'category_item_background',
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style .fpg-post-cat .post-cat',
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name' => 'category_item_border',
                            'selector' => '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style .fpg-post-cat .post-cat',
                        ]
                    );
                $this->end_controls_tab();
                $this->start_controls_tab(
                    'category_style_hover_tab',
                    [
                        'label' => esc_html__( 'Hover', 'fancy-post-grid' ),
                    ]
                );
                    $this->add_control(
                        'category_item_color_hover',
                        [
                            'label' => esc_html__( 'Color', 'fancy-post-grid' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style .fpg-post-cat .post-cat:hover' => 'color: {{VALUE}}',
                            ],
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name' => 'category_item_background_hover',
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style .fpg-post-cat .post-cat:hover',
                        ]
                    );
                    $this->add_control(
                        'category_item_border_color_hover',
                        [
                            'label' => esc_html__( 'Border Color', 'fancy-post-grid' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style .fpg-post-cat .post-cat:hover' => 'border-color: {{VALUE}}',
                            ],
                        ]
                    );
                $this->end_controls_tab();
            $this->end_controls_tabs();
        $this->end_controls_section();
    }

    // Register Elementor Style Control For Title
    protected function fpg_register_title_style_controls_el($args = []) {
        $args = wp_parse_args( $args, [
            'parent_selector' => ''
        ] );
        $this->start_controls_section(
			'_title_style_section',
			[
				'label' => __( 'Title Style', 'fancy-post-grid' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_post_title' => 'yes'
                ]
			]
		);
            $this->add_control(
                'title_hover_underline',
                [
                    'label' => esc_html__( 'Title Hover Underline', 'fancy-post-grid' ),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__( 'Show', 'fancy-post-grid' ),
                    'label_off' => esc_html__( 'Hide', 'fancy-post-grid' ),
                    'return_value' => 'yes',
                    'default' => 'no',
                ]
            );
            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'title_typography',
                    'selector' => '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style .fpg-post-title',
                ]
            );
            $this->add_responsive_control(
                'title_margin',
                [
                    'label' => esc_html__( 'Margin', 'fancy-post-grid' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', 'em', 'rem', 'custom' ],
                    'selectors' => [
                        '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style .fpg-post-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->start_controls_tabs( 'title_style_tabs' );
                $this->start_controls_tab(
                    'title_style_normal_tab',
                    [
                        'label' => esc_html__( 'Normal', 'fancy-post-grid' ),
                    ]
                );
                    $this->add_control(
                        'title_color',
                        [
                            'label' => esc_html__( 'Color', 'fancy-post-grid' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style .fpg-post-title a' => 'color: {{VALUE}}',
                            ],
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Text_Stroke::get_type(),
                        [
                            'name' => 'title_text_stroke',
                            'selector' => '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style .fpg-post-title a',
                        ]
                    );
                $this->end_controls_tab();
                $this->start_controls_tab(
                    'title_style_hover_tab',
                    [
                        'label' => esc_html__( 'Hover', 'fancy-post-grid' ),
                    ]
                );
                    $this->add_control(
                        'title_color_hover',
                        [
                            'label' => esc_html__( 'Color', 'fancy-post-grid' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style .fpg-post-title a:hover' => 'color: {{VALUE}}',
                            ],
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Text_Stroke::get_type(),
                        [
                            'name' => 'title_text_stroke_hover',
                            'selector' => '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style .fpg-post-title a',
                        ]
                    );
                $this->end_controls_tab();
            $this->end_controls_tabs();
        $this->end_controls_section();
    }

    // Register Elementor Style Control For Description
    protected function fpg_register_desc_style_controls_el($args = []) {
        $args = wp_parse_args( $args, [
            'parent_selector' => ''
        ] );
        $this->start_controls_section(
			'_desc_style_section',
			[
				'label' => __( 'Description Style', 'fancy-post-grid' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_post_desc' => 'yes'
                ]
			]
		);
            $this->add_control(
                'desc_color',
                [
                    'label' => esc_html__( 'Color', 'fancy-post-grid' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style .fpg-post-excerpt' => 'color: {{VALUE}}',
                    ],
                ]
            );
            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'desc_typography',
                    'selector' => '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style .fpg-post-excerpt',
                ]
            );
            $this->add_responsive_control(
                'desc_max_width',
                [
                    'label' => esc_html__( 'Max Width', 'fancy-post-grid' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 1000,
                        ],
                        '%' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style .fpg-post-excerpt' => 'max-width: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'desc_margin',
                [
                    'label' => esc_html__( 'Margin', 'fancy-post-grid' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', 'em', 'rem', 'custom' ],
                    'selectors' => [
                        '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style .fpg-post-excerpt' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
        $this->end_controls_section();
    }

    // Register Elementor Style Control For Meta Data
    protected function fpg_register_meta_style_controls_el($args = []) {
        $args = wp_parse_args( $args, [
            'parent_selector' => ''
        ] );
        $this->start_controls_section(
			'_meta_style_section',
			[
				'label' => __( 'Meta Data Style', 'fancy-post-grid' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_meta_data' => 'yes'
                ]
			]
		);
            // Meta Wrapper
            $this->add_control(
                'meta_wrapper_ctrl_heading',
                [
                    'label' => esc_html__( 'Wrapper', 'fancy-post-grid' ),
                    'type' => Controls_Manager::HEADING,
                    'classes' => 'fpg-control-type-heading'
                ]
            );
            $this->add_responsive_control(
                'meta_wrapper_flex_v_align',
                [
                    'label' => esc_html__( 'Vertical Align', 'fancy-post-grid' ),
                    'type' => Controls_Manager::CHOOSE,
                    'options' => [
                        'flex-start' => [ 'title' => esc_html__( 'Top', 'fancy-post-grid' ), 'icon' => 'eicon-align-start-v' ],
                        'center'     => [ 'title' => esc_html__( 'Middle', 'fancy-post-grid' ), 'icon' => 'eicon-align-center-v' ],
                        'flex-end'   => [ 'title' => esc_html__( 'Bottom', 'fancy-post-grid' ), 'icon' => 'eicon-align-end-v' ],
                    ],
                    'toggle' => true,
                    'selectors' => [
                        '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style .fpg-post-meta' => 'align-items: {{VALUE}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'meta_wrapper_flex_h_align',
                [
                    'label' => esc_html__( 'Horizontal Align', 'fancy-post-grid' ),
                    'type' => Controls_Manager::CHOOSE,
                    'options' => [
                        'flex-start'     => [ 'title' => esc_html__( 'Start', 'fancy-post-grid' ), 'icon' => 'eicon-align-start-h' ],
                        'center'         => [ 'title' => esc_html__( 'Center', 'fancy-post-grid' ), 'icon' => 'eicon-align-center-h' ],
                        'flex-end'       => [ 'title' => esc_html__( 'End', 'fancy-post-grid' ), 'icon' => 'eicon-align-end-h' ],
                        'space-between'  => [ 'title' => esc_html__( 'Space Between', 'fancy-post-grid' ), 'icon' => 'eicon-justify-space-between-h' ],
                    ],
                    'toggle' => true,
                    'selectors' => [
                        '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style .fpg-post-meta' => 'justify-content: {{VALUE}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'meta_wrapper_flex_dir',
                [
                    'label' => esc_html__( 'Column Direction', 'fancy-post-grid' ),
                    'type' => Controls_Manager::CHOOSE,
                    'options' => [
                        'row'            => [ 'title' => esc_html__( 'Row', 'fancy-post-grid' ), 'icon' => 'eicon-justify-start-h' ],
                        'row-reverse'    => [ 'title' => esc_html__( 'Row Reverse', 'fancy-post-grid' ), 'icon' => 'eicon-wrap' ],
                        'column'         => [ 'title' => esc_html__( 'Column', 'fancy-post-grid' ), 'icon' => 'eicon-justify-start-v' ],
                        'column-reverse' => [ 'title' => esc_html__( 'Column Reverse', 'fancy-post-grid' ), 'icon' => 'eicon-wrap' ],
                    ],
                    'toggle' => true,
                    'selectors' => [
                        '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style .fpg-post-meta' => 'flex-direction: {{VALUE}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'meta_wrapper_flex_wrap',
                [
                    'label' => esc_html__( 'Flex Wrap', 'fancy-post-grid' ),
                    'type' => Controls_Manager::CHOOSE,
                    'options' => [
                        'nowrap' => [ 'title' => esc_html__( 'No Wrap', 'fancy-post-grid' ), 'icon' => 'eicon-nowrap' ],
                        'wrap'   => [ 'title' => esc_html__( 'Wrap', 'fancy-post-grid' ), 'icon' => 'eicon-wrap' ],
                    ],
                    'toggle' => true,
                    'selectors' => [
                        '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style .fpg-post-meta' => 'flex-wrap: {{VALUE}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'meta_wrapper_flex_gap',
                [
                    'label' => esc_html__( 'Gap Between', 'fancy-post-grid' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%', 'custom' ],
                    'range' => [
                        'px' => [ 'min' => 0, 'max' => 1000 ],
                        '%' => [ 'min' => 0, 'max' => 100 ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style .fpg-post-meta' => 'gap: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'meta_wrapper_padding',
                [
                    'label' => esc_html__( 'Padding', 'fancy-post-grid' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', 'em', 'rem', 'custom' ],
                    'selectors' => [
                        '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style .fpg-post-meta' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                    ],
                ]
            );
            $this->add_responsive_control(
                'meta_wrapper_margin',
                [
                    'label' => esc_html__( 'Margin', 'fancy-post-grid' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', 'em', 'rem', 'custom' ],
                    'selectors' => [
                        '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style .fpg-post-meta' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'meta_wrapper_border',
                    'selector' => '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style .fpg-post-meta',
                ]
            );

            // Position Maker
            $this->add_control(
                'meta_wrapper_position_maker',
                [
                    'label' => esc_html__( 'Position Maker', 'fancy-post-grid' ),
                    'type' => Controls_Manager::POPOVER_TOGGLE,
                    'label_off' => esc_html__( 'Default', 'fancy-post-grid' ),
                    'label_on' => esc_html__( 'Custom', 'fancy-post-grid' ),
                    'return_value' => 'yes',
                    'default' => 'no',
                ]
            );
            $this->start_popover();
                $this->add_responsive_control(
                    'meta_wrapper_position',
                    [
                        'label' => esc_html__( 'Position', 'fancy-post-grid' ),
                        'type' => Controls_Manager::SELECT,
                        'default' => '',
                        'options' => [
                            '' => esc_html__( 'Default', 'fancy-post-grid' ),
                            'unset' => esc_html__( 'Unset', 'fancy-post-grid' ),
                            'absolute' => esc_html__( 'Absolute', 'fancy-post-grid' ),
                            'relative'  => esc_html__( 'Relative', 'fancy-post-grid' ),
                        ],
                        'selectors' => [
                            '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style .fpg-post-meta' => 'position: {{VALUE}};',
                        ],
                    ]
                );
                $this->add_responsive_control(
                    'meta_wrapper_p_top',
                    [
                        'label' => esc_html__( 'Top', 'fancy-post-grid' ),
                        'type' => Controls_Manager::SLIDER,
                        'size_units' => [ 'px', '%', 'custom' ],
                        'range' => [
                            'px' => [ 'min' => -1000, 'max' => 1000 ],
                            '%' => [ 'min' => -100, 'max' => 100 ],
                        ],
                        'condition' => [ 'meta_wrapper_position' => ['absolute', 'relative'] ],
                        'selectors' => [
                            '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style .fpg-post-meta' => 'top: {{SIZE}}{{UNIT}};',
                        ],
                    ]
                );
                $this->add_responsive_control(
                    'meta_wrapper_p_right',
                    [
                        'label' => esc_html__( 'Right', 'fancy-post-grid' ),
                        'type' => Controls_Manager::SLIDER,
                        'size_units' => [ 'px', '%', 'custom' ],
                        'range' => [
                            'px' => [ 'min' => -1000, 'max' => 1000 ],
                            '%' => [ 'min' => -100, 'max' => 100 ],
                        ],
                        'condition' => [ 'meta_wrapper_position' => ['absolute', 'relative'] ],
                        'selectors' => [
                            '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style .fpg-post-meta' => 'right: {{SIZE}}{{UNIT}};',
                        ],
                    ]
                );
                $this->add_responsive_control(
                    'meta_wrapper_p_bottom',
                    [
                        'label' => esc_html__( 'Bottom', 'fancy-post-grid' ),
                        'type' => Controls_Manager::SLIDER,
                        'size_units' => [ 'px', '%', 'custom' ],
                        'range' => [
                            'px' => [ 'min' => -1000, 'max' => 1000 ],
                            '%' => [ 'min' => -100, 'max' => 100 ],
                        ],
                        'condition' => [ 'meta_wrapper_position' => ['absolute', 'relative'] ],
                        'selectors' => [
                            '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style .fpg-post-meta' => 'bottom: {{SIZE}}{{UNIT}};',
                        ],
                    ]
                );
                $this->add_responsive_control(
                    'meta_wrapper_p_left',
                    [
                        'label' => esc_html__( 'Left', 'fancy-post-grid' ),
                        'type' => Controls_Manager::SLIDER,
                        'size_units' => [ 'px', '%', 'custom' ],
                        'range' => [
                            'px' => [ 'min' => -1000, 'max' => 1000 ],
                            '%' => [ 'min' => -100, 'max' => 100 ],
                        ],
                        'condition' => [ 'meta_wrapper_position' => ['absolute', 'relative'] ],
                        'selectors' => [
                            '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style .fpg-post-meta' => 'left: {{SIZE}}{{UNIT}};',
                        ],
                    ]
                );
            $this->end_popover();

            // Separator
            $this->add_control(
                'meta_separator_ctrl_heading',
                [
                    'label' => esc_html__( 'Separator', 'fancy-post-grid' ),
                    'type' => Controls_Manager::HEADING,
                    'classes' => 'fpg-control-type-heading',
                    'separator' => 'before',
                    'condition' => [
                        'show_meta_separator' => 'yes'
                    ]
                ]
            );
            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'meta_separator_typography',
                    'selector' => '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style .fpg-post-meta .fpg-meta-separator',
                    'condition' => [
                        'show_meta_separator' => 'yes'
                    ]
                ]
            );
            $this->add_control(
                'meta_separator_color',
                [
                    'label' => esc_html__( 'Color', 'fancy-post-grid' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style .fpg-meta-separator' => 'color: {{VALUE}};',
                    ],
                    'condition' => [
                        'show_meta_separator' => 'yes'
                    ]
                ]
            );

            // Meta Item
            $this->add_control(
                'meta_item_ctrl_heading',
                [
                    'label' => esc_html__( 'Meta Item', 'fancy-post-grid' ),
                    'type' => Controls_Manager::HEADING,
                    'classes' => 'fpg-control-type-heading',
                    'separator' => 'before'
                ]
            );
            $this->add_responsive_control(
                'meta_item_flex_v_align',
                [
                    'label' => esc_html__( 'Vertical Align', 'fancy-post-grid' ),
                    'type' => Controls_Manager::CHOOSE,
                    'options' => [
                        'flex-start' => [ 'title' => esc_html__( 'Top', 'fancy-post-grid' ), 'icon' => 'eicon-align-start-v' ],
                        'center'     => [ 'title' => esc_html__( 'Middle', 'fancy-post-grid' ), 'icon' => 'eicon-align-center-v' ],
                        'flex-end'   => [ 'title' => esc_html__( 'Bottom', 'fancy-post-grid' ), 'icon' => 'eicon-align-end-v' ],
                    ],
                    'toggle' => true,
                    'selectors' => [
                        '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style .fpg-post-meta .fpg-meta' => 'align-items: {{VALUE}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'meta_item_flex_h_align',
                [
                    'label' => esc_html__( 'Horizontal Align', 'fancy-post-grid' ),
                    'type' => Controls_Manager::CHOOSE,
                    'options' => [
                        'flex-start'     => [ 'title' => esc_html__( 'Start', 'fancy-post-grid' ), 'icon' => 'eicon-align-start-h' ],
                        'center'         => [ 'title' => esc_html__( 'Center', 'fancy-post-grid' ), 'icon' => 'eicon-align-center-h' ],
                        'flex-end'       => [ 'title' => esc_html__( 'End', 'fancy-post-grid' ), 'icon' => 'eicon-align-end-h' ],
                        'space-between'  => [ 'title' => esc_html__( 'Space Between', 'fancy-post-grid' ), 'icon' => 'eicon-justify-space-between-h' ],
                    ],
                    'toggle' => true,
                    'selectors' => [
                        '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style .fpg-post-meta .fpg-meta' => 'justify-content: {{VALUE}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'meta_item_flex_dir',
                [
                    'label' => esc_html__( 'Column Direction', 'fancy-post-grid' ),
                    'type' => Controls_Manager::CHOOSE,
                    'options' => [
                        'row'            => [ 'title' => esc_html__( 'Row', 'fancy-post-grid' ), 'icon' => 'eicon-justify-start-h' ],
                        'row-reverse'    => [ 'title' => esc_html__( 'Row Reverse', 'fancy-post-grid' ), 'icon' => 'eicon-wrap' ],
                        'column'         => [ 'title' => esc_html__( 'Column', 'fancy-post-grid' ), 'icon' => 'eicon-justify-start-v' ],
                        'column-reverse' => [ 'title' => esc_html__( 'Column Reverse', 'fancy-post-grid' ), 'icon' => 'eicon-wrap' ],
                    ],
                    'toggle' => true,
                    'selectors' => [
                        '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style .fpg-post-meta .fpg-meta' => 'flex-direction: {{VALUE}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'meta_item_flex_wrap',
                [
                    'label' => esc_html__( 'Flex Wrap', 'fancy-post-grid' ),
                    'type' => Controls_Manager::CHOOSE,
                    'options' => [
                        'nowrap' => [ 'title' => esc_html__( 'No Wrap', 'fancy-post-grid' ), 'icon' => 'eicon-nowrap' ],
                        'wrap'   => [ 'title' => esc_html__( 'Wrap', 'fancy-post-grid' ), 'icon' => 'eicon-wrap' ],
                    ],
                    'toggle' => true,
                    'selectors' => [
                        '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style .fpg-post-meta .fpg-meta' => 'flex-wrap: {{VALUE}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'meta_item_flex_gap',
                [
                    'label' => esc_html__( 'Gap Between', 'fancy-post-grid' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%', 'custom' ],
                    'range' => [
                        'px' => [ 'min' => 0, 'max' => 1000 ],
                        '%' => [ 'min' => 0, 'max' => 100 ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style .fpg-post-meta .fpg-meta' => 'gap: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'meta_item_typography',
                    'selector' => '{{WRAPPER}} .fpg-card-style .fpg-post-meta .fpg-meta',
                    'separator' => 'before',
                ]
            );
            $this->add_control(
                'meta_item_text_color',
                [
                    'label' => esc_html__( 'Text Color', 'fancy-post-grid' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style .fpg-post-meta .fpg-meta' => 'color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_control(
                'meta_author_img_ctrl_heading',
                [
                    'label' => esc_html__( 'Author Image', 'fancy-post-grid' ),
                    'type' => Controls_Manager::HEADING,
                    'classes' => 'fpg-control-type-heading',
                    'separator' => 'before',
                    'condition' => [
                        'show_meta_data' => 'yes',
                        'show_post_author' => 'yes',
                        'author_icon_visibility' => 'yes',
                        'author_image_icon' => 'image'
                    ]
                ]
            );
            $this->add_responsive_control(
                'author_image_size',
                [
                    'label' => esc_html__( 'Size', 'fancy-post-grid' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 1000,
                        ],
                        '%' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-post-meta .fpg-meta img' => 'width: {{SIZE}}{{UNIT}}; height: auto;',
                    ],
                    'condition' => [
                        'show_meta_data' => 'yes',
                        'show_post_author' => 'yes',
                        'author_icon_visibility' => 'yes',
                        'author_image_icon' => 'image'
                    ],
                ]
            );
            $this->add_responsive_control(
                'author_image_border',
                [
                    'label' => esc_html__( 'Border Radius', 'fancy-post-grid' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                    'selectors' => [
                        '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-post-meta .fpg-meta img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'condition' => [
                        'show_meta_data' => 'yes',
                        'show_post_author' => 'yes',
                        'author_icon_visibility' => 'yes',
                        'author_image_icon' => 'image'
                    ],
                ]
            );

            $this->add_control(
                'meta_icon_ctrl_heading',
                [
                    'label' => esc_html__( 'Icon', 'fancy-post-grid' ),
                    'type' => Controls_Manager::HEADING,
                    'classes' => 'fpg-control-type-heading',
                    'separator' => 'before',
                    'condition' => [
                        'show_meta_data_icon' => 'yes'
                    ]
                ]
            );
            $this->add_responsive_control(
                'meta_item_icon_size',
                [
                    'label' => esc_html__( 'Icon Size', 'fancy-post-grid' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', 'em', 'rem', 'custom' ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 1000,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style .fpg-post-meta .fpg-meta i' => 'font-size: {{SIZE}}{{UNIT}};',
                        '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style .fpg-post-meta .fpg-meta svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                    ],
                    'condition' => [
                        'show_meta_data_icon' => 'yes'
                    ]
                ]
            );
            $this->add_control(
                'meta_item_icon_color',
                [
                    'label' => esc_html__( 'Icon Color', 'fancy-post-grid' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style .fpg-post-meta .fpg-meta i' => 'color: {{VALUE}};',
                        '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style .fpg-post-meta .fpg-meta svg path' => 'fill: {{VALUE}};',
                    ],
                    'condition' => [
                        'show_meta_data_icon' => 'yes'
                    ]
                ]
            );
        $this->end_controls_section();
    }

    // Register Elementor Style Control For Thumbnail
    protected function fpg_register_thumbnail_style_controls_el($args = []) {
        $args = wp_parse_args( $args, [
            'parent_selector' => ''
        ] );
        $this->start_controls_section(
			'_thumbnail_style_section',
			[
				'label' => __( 'Thumbnail Style', 'fancy-post-grid' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_post_thumbnail' => 'yes'
                ]
			]
		);
            $this->add_responsive_control(
                'card_thumb_width',
                [
                    'label' => esc_html__( 'Width', 'fancy-post-grid' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 1000,
                        ],
                        '%' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style .fpg-post-thumb' => 'max-width: {{SIZE}}{{UNIT}}; flex-shrink: 0;',
                    ],
                ]
            );
            $this->add_responsive_control(
                'card_thumb_height',
                [
                    'label' => esc_html__( 'Height', 'fancy-post-grid' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 1000,
                        ],
                        '%' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style .fpg-post-thumb' => 'height: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'card_thumb_margin',
                [
                    'label' => esc_html__( 'Margin', 'fancy-post-grid' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', 'em', 'rem', 'custom' ],
                    'selectors' => [
                        '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style .fpg-post-thumb' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'card_thumb_border_radius',
                [
                    'label' => esc_html__( 'Border Radius', 'fancy-post-grid' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                    'selectors' => [
                        '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style .fpg-post-thumb' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            // Play Button
            $this->add_control(
                'thumbnail_play_btn_ctrl_heading',
                [
                    'label' => esc_html__( 'Play Button', 'fancy-post-grid' ),
                    'type' => Controls_Manager::HEADING,
                    'classes' => 'fpg-control-type-heading',
                    'separator' => 'before',
                    'condition' => [
                        'thumbnail_type' => 'play_btn'
                    ]
                ]
            );
            $this->add_responsive_control(
                'thumbnail_play_btn_size',
                [
                    'label' => esc_html__( 'Size', 'fancy-post-grid' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 1000,
                        ],
                        '%' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style .fpg-post-thumb .fpg-play-btn' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                    ],
                    'condition' => [
                        'thumbnail_type' => 'play_btn'
                    ]
                ]
            );
            $this->add_responsive_control(
                'thumbnail_play_btn_icon_size',
                [
                    'label' => esc_html__( 'Icon Size', 'fancy-post-grid' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 1000,
                        ],
                        '%' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style .fpg-post-thumb .fpg-play-btn i' => 'font-size: {{SIZE}}{{UNIT}};',
                        '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style .fpg-post-thumb .fpg-play-btn svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                    ],
                    'condition' => [
                        'thumbnail_type' => 'play_btn'
                    ]
                ]
            );
            $this->add_control(
                'thumbnail_play_btn_color',
                [
                    'label' => esc_html__( 'Color', 'fancy-post-grid' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style .fpg-post-thumb .fpg-play-btn' => '--primaryFgColor: {{VALUE}};',
                    ],
                    'condition' => [
                        'thumbnail_type' => 'play_btn'
                    ]
                ]
            );
            $this->add_control(
                'thumbnail_play_btn_bg',
                [
                    'label' => esc_html__( 'Background', 'fancy-post-grid' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style .fpg-post-thumb .fpg-play-btn' => '--primaryColor: {{VALUE}};',
                    ],
                    'condition' => [
                        'thumbnail_type' => 'play_btn'
                    ]
                ]
            );
            $this->add_responsive_control(
                'thumbnail_play_btn_p_y',
                [
                    'label' => esc_html__( 'Position Y', 'fancy-post-grid' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                    'range' => [
                        'px' => [
                            'min' => -1000,
                            'max' => 1000,
                        ],
                        '%' => [
                            'min' => -1000,
                            'max' => 1000,
                        ],
                    ],
                    'default' => [
                        'unit' => '%',
                    ],
                    'selectors' => [
                        '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style .fpg-post-thumb .fpg-play-btn' => 'top: {{SIZE}}{{UNIT}};',
                    ],
                    'condition' => [
                        'thumbnail_type' => 'play_btn'
                    ]
                ]
            );

            // Overlay
            $this->add_control(
                'thumbnail_overlay_ctrl_heading',
                [
                    'label' => esc_html__( 'Overlay', 'fancy-post-grid' ),
                    'type' => Controls_Manager::HEADING,
                    'classes' => 'fpg-control-type-heading',
                    'separator' => 'before',
                ]
            );
            $this->add_control(
                'show_thumbnail_overlay',
                [
                    'label' => esc_html__( 'Show Overlay', 'fancy-post-grid' ),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__( 'Show', 'fancy-post-grid' ),
                    'label_off' => esc_html__( 'Hide', 'fancy-post-grid' ),
                    'return_value' => 'yes',
                    'default' => 'no',
                ]
            );
            $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => 'thumbnail_overlay_background',
                    'types' => [ 'gradient' ],
                    'selector' => '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style .fpg-post-thumb .thumb-overlay',
                    'condition' => [
                        'show_thumbnail_overlay' => 'yes'
                    ]
                ]
            );
            $this->add_responsive_control(
                'thumbnail_opacity_control',
                [
                    'label' => esc_html__( 'Opacity', 'fancy-post-grid' ),
                    'type' => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 10,
                            'step' => 0.1,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style .fpg-post-thumb .thumb-overlay ' => 'opacity: {{SIZE}};',
                    ],
                    'condition' => [
                        'show_thumbnail_overlay' => 'yes'
                    ]
                ]
            );
            $this->add_responsive_control(
                'thumbnail_opacity_control_hover',
                [
                    'label' => esc_html__( 'Opacity (Hover)', 'fancy-post-grid' ),
                    'type' => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 10,
                            'step' => 0.1,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style:hover .fpg-post-thumb .thumb-overlay ' => 'opacity: {{SIZE}};',
                    ],
                    'condition' => [
                        'show_thumbnail_overlay' => 'yes'
                    ]
                ]
            );
        $this->end_controls_section();
    }

    // Register Elementor Style Control For Button
    protected function fpg_register_button_style_controls_el($args = []) {
        $args = wp_parse_args( $args, [
            'parent_selector' => ''
        ] );
        $this->start_controls_section(
			'_button_style_section',
			[
				'label' => __( 'Button Style', 'fancy-post-grid' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_button' => 'yes'
                ]
			]
		);
            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'button_typography',
                    'selector' => '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style .fpg-post-content .fpg-btn-wrapper a',
                ]
            );
            $this->add_responsive_control(
                'button_padding',
                [
                    'label' => esc_html__( 'Padding', 'fancy-post-grid' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', 'em', 'rem', 'custom' ],
                    'selectors' => [
                        '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style .fpg-post-content .fpg-btn-wrapper a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'button_radius',
                [
                    'label' => esc_html__( 'Border Radius', 'fancy-post-grid' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', 'em', 'rem', 'custom' ],
                    'selectors' => [
                        '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style .fpg-post-content .fpg-btn-wrapper a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'button_wrapper_margin',
                [
                    'label' => esc_html__( 'Margin', 'fancy-post-grid' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', 'em', 'rem', 'custom' ],
                    'selectors' => [
                        '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style .fpg-post-content .fpg-btn-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'button_icon_size',
                [
                    'label' => esc_html__( 'Icon Size', 'fancy-post-grid' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 1000,
                        ],
                        '%' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style .fpg-post-content .fpg-btn-wrapper a svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                        '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style .fpg-post-content .fpg-btn-wrapper a i' => 'font-size: {{SIZE}}{{UNIT}};',
                    ],
                    'condition' => [
                        'show_button_icon' => 'yes'
                    ]
                ]
            );
            $this->add_responsive_control(
                'button_icon_dir',
                [
                    'label' => esc_html__( 'Icon Position', 'fancy-post-grid' ),
                    'type' => Controls_Manager::CHOOSE,
                    'options' => [
                        'row-reverse' => [
                            'title' => esc_html__( 'Left', 'fancy-post-grid' ),
                            'icon' => 'eicon-arrow-left'
                        ],
                        'row'   => [
                            'title' => esc_html__( 'Right', 'fancy-post-grid' ),
                            'icon' => 'eicon-arrow-right'
                        ],
                    ],
                    'toggle' => true,
                    'selectors' => [
                        '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style .fpg-post-content .fpg-btn-wrapper a' => 'flex-direction: {{VALUE}};',
                    ],
                    'condition' => [
                        'show_button_icon' => 'yes'
                    ]
                ]
            );
            $this->add_responsive_control(
                'button_icon_text_gap',
                [
                    'label' => esc_html__( 'Gap Between Icon/Text', 'fancy-post-grid' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 1000,
                        ],
                        '%' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style .fpg-post-content .fpg-btn-wrapper a' => 'gap: {{SIZE}}{{UNIT}};',
                    ],
                    'condition' => [
                        'show_button_icon' => 'yes'
                    ]
                ]
            );
            $this->add_control(
                'button_color',
                [
                    'label' => esc_html__( 'Color', 'fancy-post-grid' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style .fpg-post-content .fpg-btn-wrapper a' => 'color: {{VALUE}};',
                    ],
                    'separator' => 'before'
                ]
            );
            $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => 'button_background',
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style .fpg-post-content .fpg-btn-wrapper a',
                ]
            );
            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'button_border',
                    'selector' => '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style .fpg-post-content .fpg-btn-wrapper a',
                ]
            );
            $this->add_control(
                'button_hover_ctrl_heading',
                [
                    'label' => esc_html__( 'Hover', 'fancy-post-grid' ),
                    'type' => Controls_Manager::HEADING,
                    'classes' => 'fpg-control-type-heading',
                ]
            );
            $this->add_control(
                'button_color_hover',
                [
                    'label' => esc_html__( 'Color', 'fancy-post-grid' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style .fpg-post-content .fpg-btn-wrapper a:hover' => 'color: {{VALUE}};',
                    ],
                ]
            );
            $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => 'button_background_hover',
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style .fpg-post-content .fpg-btn-wrapper a:hover',
                ]
            );
            $this->add_control(
                'button_border_hover',
                [
                    'label' => esc_html__( 'Border Color', 'fancy-post-grid' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style .fpg-post-content .fpg-btn-wrapper a:hover' => 'border-color: {{VALUE}};',
                    ],
                ]
            );
        $this->end_controls_section();
    }

    // Register Elementor Style Control For Pagination
    protected function fpg_register_pagination_style_controls_el($args = []) {
        $args = wp_parse_args( $args, [
            'parent_selector' => ''
        ] );
        $this->start_controls_section(
			'_pagination_style_section',
			[
				'label' => __( 'Pagination Style', 'fancy-post-grid' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_pagination' => 'yes',
                    'pagination_type!' => 'load_more'
                ]
			]
		);
            $this->add_responsive_control(
                'page_pagination_wrapper_align',
                [
                    'label' => esc_html__( 'Alignment', 'fancy-post-grid' ),
                    'type' => Controls_Manager::CHOOSE,
                    'options' => [
                        'left' => [
                            'title' => esc_html__( 'Left', 'fancy-post-grid' ),
                            'icon' => 'eicon-text-align-left',
                        ],
                        'center' => [
                            'title' => esc_html__( 'Center', 'fancy-post-grid' ),
                            'icon' => 'eicon-text-align-center',
                        ],
                        'right' => [
                            'title' => esc_html__( 'Right', 'fancy-post-grid' ),
                            'icon' => 'eicon-text-align-right',
                        ],
                    ],
                    'default' => '',
                    'toggle' => true,
                    'selectors' => [
                        '{{WRAPPER}} .fpg-pagination' => 'text-align: {{VALUE}};',
                    ],
                ]
            );
            $this->add_control(
                'page_pagination_wrapper_ctrl_heading',
                [
                    'label' => esc_html__( 'Wrapper', 'fancy-post-grid' ),
                    'type' => Controls_Manager::HEADING,
                    'classes' => 'fpg-control-type-heading',
                    'separator' => 'before'
                ]
            );
            $this->add_responsive_control(
                'page_pagination_wrapper_flex_h_align',
                [
                    'label' => esc_html__( 'Horizontal Align', 'fancy-post-grid' ),
                    'type' => Controls_Manager::CHOOSE,
                    'options' => [
                        'flex-start'     => [ 'title' => esc_html__( 'Start', 'fancy-post-grid' ), 'icon' => 'eicon-align-start-h' ],
                        'center'         => [ 'title' => esc_html__( 'Center', 'fancy-post-grid' ), 'icon' => 'eicon-align-center-h' ],
                        'flex-end'       => [ 'title' => esc_html__( 'End', 'fancy-post-grid' ), 'icon' => 'eicon-align-end-h' ],
                        'space-between'  => [ 'title' => esc_html__( 'Space Between', 'fancy-post-grid' ), 'icon' => 'eicon-justify-space-between-h' ],
                    ],
                    'toggle' => true,
                    'selectors' => [
                        '{{WRAPPER}} .fpg-pagination .fancy-page-numbers' => 'justify-content: {{VALUE}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'page_pagination_wrapper_flex_wrap',
                [
                    'label' => esc_html__( 'Flex Wrap', 'fancy-post-grid' ),
                    'type' => Controls_Manager::CHOOSE,
                    'options' => [
                        'nowrap' => [ 'title' => esc_html__( 'No Wrap', 'fancy-post-grid' ), 'icon' => 'eicon-nowrap' ],
                        'wrap'   => [ 'title' => esc_html__( 'Wrap', 'fancy-post-grid' ), 'icon' => 'eicon-wrap' ],
                    ],
                    'toggle' => true,
                    'selectors' => [
                        '{{WRAPPER}} .fpg-pagination .fancy-page-numbers' => 'flex-wrap: {{VALUE}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'page_pagination_wrapper_flex_gap',
                [
                    'label' => esc_html__( 'Gap Between', 'fancy-post-grid' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%', 'custom' ],
                    'range' => [
                        'px' => [ 'min' => 0, 'max' => 1000 ],
                        '%' => [ 'min' => 0, 'max' => 100 ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .fpg-pagination .fancy-page-numbers' => 'gap: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'page_pagination_wrapper_width',
                [
                    'label' => esc_html__( 'Width', 'fancy-post-grid' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%', 'custom' ],
                    'range' => [
                        'px' => [ 'min' => 0, 'max' => 100 ],
                        '%' => [ 'min' => 0, 'max' => 100 ],
                    ],
                    'default' => [
                        'unit' => '%',
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .fpg-pagination .fancy-page-numbers' => 'width: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'page_pagination_wrapper_padding',
                [
                    'label' => esc_html__( 'Padding', 'fancy-post-grid' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', 'em', 'rem', 'custom' ],
                    'selectors' => [
                        '{{WRAPPER}} .fpg-pagination .fancy-page-numbers' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'page_pagination_wrapper_margin',
                [
                    'label' => esc_html__( 'Margin', 'fancy-post-grid' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', 'em', 'rem', 'custom' ],
                    'selectors' => [
                        '{{WRAPPER}} .fpg-pagination' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'page_pagination_wrapper_radius',
                [
                    'label' => esc_html__( 'Border Radius', 'fancy-post-grid' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', 'em', 'rem', 'custom' ],
                    'selectors' => [
                        '{{WRAPPER}} .fpg-pagination .fancy-page-numbers' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow: hidden;',
                    ],
                ]
            );
            $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => 'page_pagination_wrapper_background',
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .fpg-pagination .fancy-page-numbers',
                ]
            );
            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'page_pagination_wrapper_border',
                    'selector' => '{{WRAPPER}} .fpg-pagination .fancy-page-numbers',
                ]
            );
            $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'page_pagination_wrapper_shadow',
                    'selector' => '{{WRAPPER}} .fpg-pagination .fancy-page-numbers',
                ]
            );
            $this->add_control(
                'page_pagination_item_ctrl_heading',
                [
                    'label' => esc_html__( 'Item', 'fancy-post-grid' ),
                    'type' => Controls_Manager::HEADING,
                    'classes' => 'fpg-control-type-heading',
                    'separator' => 'before'
                ]
            );
            $this->add_responsive_control(
                'page_pagination_item_width',
                [
                    'label' => esc_html__( 'Width', 'fancy-post-grid' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%', 'custom' ],
                    'range' => [
                        'px' => [ 'min' => 0, 'max' => 100 ],
                        '%' => [ 'min' => 0, 'max' => 100 ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .fpg-pagination ul.fancy-page-numbers li .fpg-page-numbers' => 'width: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'page_pagination_item_height',
                [
                    'label' => esc_html__( 'Height', 'fancy-post-grid' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%', 'custom' ],
                    'range' => [
                        'px' => [ 'min' => 0, 'max' => 100 ],
                        '%' => [ 'min' => 0, 'max' => 100 ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .fpg-pagination ul.fancy-page-numbers li .fpg-page-numbers' => 'height: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'page_pagination_item_padding',
                [
                    'label' => esc_html__( 'Padding', 'fancy-post-grid' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', 'em', 'rem', 'custom' ],
                    'selectors' => [
                        '{{WRAPPER}} .fpg-pagination ul.fancy-page-numbers li .fpg-page-numbers' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'page_pagination_item_radius',
                [
                    'label' => esc_html__( 'Border Radius', 'fancy-post-grid' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', 'em', 'rem', 'custom' ],
                    'selectors' => [
                        '{{WRAPPER}} .fpg-pagination ul.fancy-page-numbers li .fpg-page-numbers' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'page_pagination_item_typography',
                    'selector' => '{{WRAPPER}} .fpg-pagination ul.fancy-page-numbers li .fpg-page-numbers',
                ]
            );
            $this->start_controls_tabs( 'page_pagination_item_style_tabs' );
                $this->start_controls_tab(
                    'page_pagination_item_style_normal_tab',
                    [
                        'label' => esc_html__( 'Normal', 'fancy-post-grid' ),
                    ]
                );
                    $this->add_control(
                        'page_pagination_item_font_color',
                        [
                            'label' => esc_html__( 'Font Color', 'fancy-post-grid' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .fpg-pagination ul.fancy-page-numbers li .fpg-page-numbers' => 'color: {{VALUE}}',
                            ],
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name' => 'page_pagination_item_background',
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .fpg-pagination ul.fancy-page-numbers li .fpg-page-numbers',
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name' => 'page_pagination_item_border',
                            'selector' => '{{WRAPPER}} .fpg-pagination ul.fancy-page-numbers li .fpg-page-numbers',
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Box_Shadow::get_type(),
                        [
                            'name' => 'page_pagination_item_shadow',
                            'selector' => '{{WRAPPER}} .fpg-pagination ul.fancy-page-numbers li .fpg-page-numbers',
                        ]
                    );
                $this->end_controls_tab();
                $this->start_controls_tab(
                    'page_pagination_item_style_hover_tab',
                    [
                        'label' => esc_html__( 'Hover', 'fancy-post-grid' ),
                    ]
                );
                    $this->add_control(
                        'page_pagination_item_font_color_hover',
                        [
                            'label' => esc_html__( 'Font Color', 'fancy-post-grid' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .fpg-pagination ul.fancy-page-numbers li .fpg-page-numbers:hover' => 'color: {{VALUE}}',
                            ],
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name' => 'page_pagination_item_background_hover',
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .fpg-pagination ul.fancy-page-numbers li .fpg-page-numbers:hover',
                        ]
                    );
                    $this->add_control(
                        'page_pagination_item_border_color_hover',
                        [
                            'label' => esc_html__( 'Border Color', 'fancy-post-grid' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .fpg-pagination ul.fancy-page-numbers li .fpg-page-numbers:hover' => 'border-color: {{VALUE}}',
                            ],
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Box_Shadow::get_type(),
                        [
                            'name' => 'page_pagination_item_shadow_hover',
                            'selector' => '{{WRAPPER}} .fpg-pagination ul.fancy-page-numbers li .fpg-page-numbers:hover',
                        ]
                    );
                $this->end_controls_tab();
                $this->start_controls_tab(
                    'page_pagination_item_style_active_tab',
                    [
                        'label' => esc_html__( 'Active', 'fancy-post-grid' ),
                    ]
                );
                    $this->add_control(
                        'page_pagination_item_font_color_active',
                        [
                            'label' => esc_html__( 'Font Color', 'fancy-post-grid' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .fpg-pagination ul.fancy-page-numbers li .fpg-page-numbers.current' => 'color: {{VALUE}}',
                            ],
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name' => 'page_pagination_item_background_active',
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .fpg-pagination ul.fancy-page-numbers li .fpg-page-numbers.current',
                        ]
                    );
                    $this->add_control(
                        'page_pagination_item_border_color_active',
                        [
                            'label' => esc_html__( 'Border Color', 'fancy-post-grid' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .fpg-pagination ul.fancy-page-numbers li .fpg-page-numbers.current' => 'border-color: {{VALUE}}',
                            ],
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Box_Shadow::get_type(),
                        [
                            'name' => 'page_pagination_item_shadow_active',
                            'selector' => '{{WRAPPER}} .fpg-pagination ul.fancy-page-numbers li .fpg-page-numbers.current',
                        ]
                    );
                $this->end_controls_tab();
            $this->end_controls_tabs();
        $this->end_controls_section();
    }

    // Register Elementor Style Control For Load More Button
    protected function fpg_register_load_more_style_controls_el($args = []) {
        $args = wp_parse_args( $args, [
            'parent_selector' => ''
        ] );
        $this->start_controls_section(
			'_load_more_style_section',
			[
				'label' => __( 'Load More Style', 'fancy-post-grid' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_pagination' => 'yes',
                    'pagination_type' => 'load_more'
                ]
			]
		);
            $this->add_control(
                'load_more_button_align',
                [
                    'label' => esc_html__( 'Text Align', 'fancy-post-grid' ),
                    'type' => Controls_Manager::CHOOSE,
                    'options' => [
                        'left' => [
                            'title' => esc_html__( 'Left', 'fancy-post-grid' ),
                            'icon' => 'eicon-text-align-left',
                        ],
                        'center' => [
                            'title' => esc_html__( 'Center', 'fancy-post-grid' ),
                            'icon' => 'eicon-text-align-center',
                        ],
                        'right' => [
                            'title' => esc_html__( 'Right', 'fancy-post-grid' ),
                            'icon' => 'eicon-text-align-right',
                        ],
                    ],
                    'default' => '',
                    'toggle' => true,
                    'selectors' => [
                        '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-loadmore-wrapper' => 'text-align: {{VALUE}};',
                    ],
                ]
            );
            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'load_more_button_typography',
                    'selector' => '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-loadmore-wrapper .fpg-loadmore-btn',
                ]
            );
            $this->add_responsive_control(
                'load_more_button_padding',
                [
                    'label' => esc_html__( 'Padding', 'fancy-post-grid' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', 'em', 'rem', 'custom' ],
                    'selectors' => [
                        '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-loadmore-wrapper .fpg-loadmore-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'load_more_button_radius',
                [
                    'label' => esc_html__( 'Border Radius', 'fancy-post-grid' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', 'em', 'rem', 'custom' ],
                    'selectors' => [
                        '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-loadmore-wrapper .fpg-loadmore-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'load_more_button_wrapper_margin',
                [
                    'label' => esc_html__( 'Margin', 'fancy-post-grid' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', 'em', 'rem', 'custom' ],
                    'selectors' => [
                        '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-loadmore-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'load_more_button_icon_size',
                [
                    'label' => esc_html__( 'Icon Size', 'fancy-post-grid' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 1000,
                        ],
                        '%' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-loadmore-wrapper .fpg-loadmore-btn svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                        '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-loadmore-wrapper .fpg-loadmore-btn i' => 'font-size: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'load_more_button_icon_dir',
                [
                    'label' => esc_html__( 'Icon Position', 'fancy-post-grid' ),
                    'type' => Controls_Manager::CHOOSE,
                    'options' => [
                        'row-reverse' => [
                            'title' => esc_html__( 'Left', 'fancy-post-grid' ),
                            'icon' => 'eicon-arrow-left'
                        ],
                        'row'   => [
                            'title' => esc_html__( 'Right', 'fancy-post-grid' ),
                            'icon' => 'eicon-arrow-right'
                        ],
                    ],
                    'toggle' => true,
                    'selectors' => [
                        '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-loadmore-wrapper .fpg-loadmore-btn' => 'flex-direction: {{VALUE}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'load_more_button_icon_text_gap',
                [
                    'label' => esc_html__( 'Gap Between Icon/Text', 'fancy-post-grid' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 1000,
                        ],
                        '%' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-loadmore-wrapper .fpg-loadmore-btn' => 'gap: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_control(
                'load_more_button_color',
                [
                    'label' => esc_html__( 'Color', 'fancy-post-grid' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-loadmore-wrapper .fpg-loadmore-btn' => 'color: {{VALUE}};',
                    ],
                    'separator' => 'before'
                ]
            );
            $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => 'load_more_button_background',
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-loadmore-wrapper .fpg-loadmore-btn'
                ]
            );
            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'load_more_button_border',
                    'selector' => '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-loadmore-wrapper .fpg-loadmore-btn'
                ]
            );
            $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'load_more_button_box_shadow',
                    'selector' => '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-loadmore-wrapper .fpg-loadmore-btn'
                ]
            );

            $this->add_control(
                'load_more_button_hover_ctrl_heading',
                [
                    'label' => esc_html__( 'Hover', 'fancy-post-grid' ),
                    'type' => Controls_Manager::HEADING,
                    'classes' => 'fpg-control-type-heading',
                ]
            );
            $this->add_control(
                'load_more_button_color_hover',
                [
                    'label' => esc_html__( 'Color', 'fancy-post-grid' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-loadmore-wrapper .fpg-loadmore-btn:hover' => 'color: {{VALUE}};',
                    ],
                ]
            );
            $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => 'load_more_button_background_hover',
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-loadmore-wrapper .fpg-loadmore-btn:hover',
                ]
            );
            $this->add_control(
                'load_more_button_border_hover',
                [
                    'label' => esc_html__( 'Border Color', 'fancy-post-grid' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-loadmore-wrapper .fpg-loadmore-btn:hover' => 'border-color: {{VALUE}};',
                    ],
                ]
            );
            $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'load_more_button_box_shadow_hover',
                    'selector' => '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-loadmore-wrapper .fpg-loadmore-btn:hover'
                ]
            );

            $this->add_control(
                'load_complete_style_ctrl_heading',
                [
                    'label' => esc_html__( 'Load Complete Message', 'fancy-post-grid' ),
                    'type' => Controls_Manager::HEADING,
                    'classes' => 'fpg-control-type-heading',
                    'separator' => 'before',
                    'condition' => [
                        'show_pagination' => 'yes',
                        'pagination_type' => 'load_more'
                    ]
                ]
            );
            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'load_complete_message_typography',
                    'selector' => '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-loadmore-wrapper .fpg-load-complete-text',
                ]
            );
            $this->add_control(
                'load_complete_message_color',
                [
                    'label' => esc_html__( 'Color', 'fancy-post-grid' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-loadmore-wrapper .fpg-load-complete-text' => 'color: {{VALUE}};',
                    ],
                ]
            );
        $this->end_controls_section();
    }

    // Register Elementor Style Control For Ajax Filter
    protected function fpg_register_filter_btn_style_controls_el($args = []) {
        $args = wp_parse_args( $args, [
            'parent_selector' => ''
        ] );
        $this->start_controls_section(
			'_filter_button_style_section',
			[
				'label' => __( 'Filter Button Style', 'fancy-post-grid' ),
                'tab' => Controls_Manager::TAB_STYLE,
			]
		);
            $this->add_control(
                'filter_btn_wrapper_ctrl_heading',
                [
                    'label' => esc_html__( 'Wrapper', 'fancy-post-grid' ),
                    'type' => Controls_Manager::HEADING,
                    'classes' => 'fpg-control-type-heading',
                ]
            );
            $this->add_responsive_control(
                'filter_btn_wrapper_flex_v_align',
                [
                    'label' => esc_html__( 'Vertical Align', 'fancy-post-grid' ),
                    'type' => Controls_Manager::CHOOSE,
                    'options' => [
                        'flex-start' => [ 'title' => esc_html__( 'Top', 'fancy-post-grid' ), 'icon' => 'eicon-align-start-v' ],
                        'center'     => [ 'title' => esc_html__( 'Middle', 'fancy-post-grid' ), 'icon' => 'eicon-align-center-v' ],
                        'flex-end'   => [ 'title' => esc_html__( 'Bottom', 'fancy-post-grid' ), 'icon' => 'eicon-align-end-v' ],
                    ],
                    'toggle' => true,
                    'selectors' => [
                        '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-filter-wrapper' => 'align-items: {{VALUE}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'filter_btn_wrapper_flex_h_align',
                [
                    'label' => esc_html__( 'Horizontal Align', 'fancy-post-grid' ),
                    'type' => Controls_Manager::CHOOSE,
                    'options' => [
                        'flex-start'     => [ 'title' => esc_html__( 'Start', 'fancy-post-grid' ), 'icon' => 'eicon-align-start-h' ],
                        'center'         => [ 'title' => esc_html__( 'Center', 'fancy-post-grid' ), 'icon' => 'eicon-align-center-h' ],
                        'flex-end'       => [ 'title' => esc_html__( 'End', 'fancy-post-grid' ), 'icon' => 'eicon-align-end-h' ],
                        'space-between'  => [ 'title' => esc_html__( 'Space Between', 'fancy-post-grid' ), 'icon' => 'eicon-justify-space-between-h' ],
                    ],
                    'toggle' => true,
                    'selectors' => [
                        '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-filter-wrapper' => 'justify-content: {{VALUE}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'filter_btn_wrapper_flex_dir',
                [
                    'label' => esc_html__( 'Column Direction', 'fancy-post-grid' ),
                    'type' => Controls_Manager::CHOOSE,
                    'options' => [
                        'row'            => [ 'title' => esc_html__( 'Row', 'fancy-post-grid' ), 'icon' => 'eicon-justify-start-h' ],
                        'row-reverse'    => [ 'title' => esc_html__( 'Row Reverse', 'fancy-post-grid' ), 'icon' => 'eicon-wrap' ],
                        'column'         => [ 'title' => esc_html__( 'Column', 'fancy-post-grid' ), 'icon' => 'eicon-justify-start-v' ],
                        'column-reverse' => [ 'title' => esc_html__( 'Column Reverse', 'fancy-post-grid' ), 'icon' => 'eicon-wrap' ],
                    ],
                    'toggle' => true,
                    'selectors' => [
                        '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-filter-wrapper' => 'flex-direction: {{VALUE}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'filter_btn_wrapper_flex_wrap',
                [
                    'label' => esc_html__( 'Flex Wrap', 'fancy-post-grid' ),
                    'type' => Controls_Manager::CHOOSE,
                    'options' => [
                        'nowrap' => [ 'title' => esc_html__( 'No Wrap', 'fancy-post-grid' ), 'icon' => 'eicon-nowrap' ],
                        'wrap'   => [ 'title' => esc_html__( 'Wrap', 'fancy-post-grid' ), 'icon' => 'eicon-wrap' ],
                    ],
                    'toggle' => true,
                    'selectors' => [
                        '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-filter-wrapper' => 'flex-wrap: {{VALUE}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'filter_btn_wrapper_flex_gap',
                [
                    'label' => esc_html__( 'Gap Between', 'fancy-post-grid' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%', 'custom' ],
                    'range' => [
                        'px' => [ 'min' => 0, 'max' => 1000 ],
                        '%' => [ 'min' => 0, 'max' => 100 ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-filter-wrapper' => 'gap: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'filter_btn_wrapper_margin',
                [
                    'label' => esc_html__( 'Margin', 'fancy-post-grid' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', 'em', 'rem', 'custom' ],
                    'selectors' => [
                        '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-filter-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_control(
                'filter_btn_ctrl_heading',
                [
                    'label' => esc_html__( 'Buttons', 'fancy-post-grid' ),
                    'type' => Controls_Manager::HEADING,
                    'classes' => 'fpg-control-type-heading',
                    'separator' => 'before',
                ]
            );
            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'filter_btn_typography',
                    'selector' => '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-filter-wrapper button',
                ]
            );
            $this->add_responsive_control(
                'filter_btn_padding',
                [
                    'label' => esc_html__( 'Padding', 'fancy-post-grid' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', 'em', 'rem', 'custom' ],
                    'selectors' => [
                        '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-filter-wrapper button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'filter_btn_radius',
                [
                    'label' => esc_html__( 'Border Radius', 'fancy-post-grid' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', 'em', 'rem', 'custom' ],
                    'selectors' => [
                        '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-filter-wrapper button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'filter_btn_min_width',
                [
                    'label' => esc_html__( 'Min Width', 'fancy-post-grid' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 1000,
                        ],
                        '%' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-filter-wrapper button' => 'min-width: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );
            $this->start_controls_tabs( 'filter_btn_style_tabs' );
                $this->start_controls_tab(
                    'filter_btn_style_normal_tab',
                    [
                        'label' => esc_html__( 'Normal', 'fancy-post-grid' ),
                    ]
                );
                    $this->add_control(
                        'filter_btn_color',
                        [
                            'label' => esc_html__( 'Color', 'fancy-post-grid' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-filter-wrapper button' => 'color: {{VALUE}}',
                            ],
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name' => 'filter_btn_background',
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-filter-wrapper button',
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name' => 'filter_btn_border',
                            'selector' => '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-filter-wrapper button',
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Box_Shadow::get_type(),
                        [
                            'name' => 'filter_btn_box_shadow',
                            'selector' => '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-filter-wrapper button',
                        ]
                    );
                $this->end_controls_tab();
                $this->start_controls_tab(
                    'filter_btn_style_hover_tab',
                    [
                        'label' => esc_html__( 'Hover', 'fancy-post-grid' ),
                    ]
                );
                    $this->add_control(
                        'filter_btn_color_hover',
                        [
                            'label' => esc_html__( 'Color', 'fancy-post-grid' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-filter-wrapper button:hover' => 'color: {{VALUE}}',
                            ],
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name' => 'filter_btn_background_hover',
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-filter-wrapper button:hover',
                        ]
                    );
                    $this->add_control(
                        'filter_btn_border_color_hover',
                        [
                            'label' => esc_html__( 'Border Color', 'fancy-post-grid' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-filter-wrapper button:hover' => 'border-color: {{VALUE}}',
                            ],
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Box_Shadow::get_type(),
                        [
                            'name' => 'filter_btn_box_shadow_hover',
                            'selector' => '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-filter-wrapper button:hover',
                        ]
                    );
                $this->end_controls_tab();
                $this->start_controls_tab(
                    'filter_btn_style_active_tab',
                    [
                        'label' => esc_html__( 'Active', 'fancy-post-grid' ),
                    ]
                );
                    $this->add_control(
                        'filter_btn_color_active',
                        [
                            'label' => esc_html__( 'Color', 'fancy-post-grid' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-filter-wrapper button.active' => 'color: {{VALUE}}',
                            ],
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name' => 'filter_btn_background_active',
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-filter-wrapper button.active',
                        ]
                    );
                    $this->add_control(
                        'filter_btn_border_color_active',
                        [
                            'label' => esc_html__( 'Border Color', 'fancy-post-grid' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-filter-wrapper button.active' => 'border-color: {{VALUE}}',
                            ],
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Box_Shadow::get_type(),
                        [
                            'name' => 'filter_btn_box_shadow_active',
                            'selector' => '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-filter-wrapper button.active',
                        ]
                    );
                $this->end_controls_tab();
            $this->end_controls_tabs();
        $this->end_controls_section();
    }
}
