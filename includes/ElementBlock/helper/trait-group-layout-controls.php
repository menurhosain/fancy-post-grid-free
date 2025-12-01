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

trait FPG_Group_Layout_Controls {

    // Register Elementor Content Control For Thumbnail
    protected function fpg_register_group_thumbnail_content_controls_el() {
        $this->start_controls_section(
			'_section_thumbnail',
			[
				'label' => __( 'Thumbnail', 'fancy-post-grid' ),
                'tab' => Controls_Manager::TAB_CONTENT,
			]
		);
            $this->start_controls_tabs( 'thumbnail_content_tabs' );
                $this->start_controls_tab(
                    'thumbnail_content_large_card_tab',
                    [
                        'label' => esc_html__( 'Large Card', 'fancy-post-grid' ),
                    ]
                );
                    $this->add_control(
                        'show_post_thumbnail_group_large',
                        [                    
                            'label'   => esc_html__( 'Show Thumbnail', 'fancy-post-grid' ),
                            'type'    => Controls_Manager::SWITCHER,
                            'label_on' => esc_html__( 'Show', 'fancy-post-grid' ),
                            'label_off' => esc_html__( 'Hide', 'fancy-post-grid' ),
                            'return_value' => 'yes',
                            'default' => 'yes'
                        ]
                    );
                    $this->add_control(
                        'thumbnail_type_group_large',
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
                                'show_post_thumbnail_group_large' => 'yes'
                            ],
                            'frontend_available' => true,
                            'render_type' => 'template'
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Image_Size::get_type(),
                        [
                            'name' => 'thumbnail_group_large',
                            'default' => 'full',
                            'condition' => [
                                'show_post_thumbnail_group_large' => 'yes',
                            ]
                        ]
                    );
                    $this->add_responsive_control(
                        'video_scale_to_fit_group_large',
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
                                '{{WRAPPER}} .fpg-card-style.card-large .fpg-post-thumb iframe,
                                {{WRAPPER}} .fpg-card-style.card-large .fpg-post-thumb video' => 'transform: scale({{SIZE}});',
                            ],
                            'condition' => [
                                'thumbnail_type_group_large' => 'video'
                            ],
                        ]
                    );
                    $this->add_control(
                        'video_aspect_ratio_group_large',
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
                                '{{WRAPPER}} .fpg-card-style.card-large .fpg-post-thumb iframe,
                                {{WRAPPER}} .fpg-card-style.card-large .fpg-post-thumb video' => 'aspect-ratio: {{VALUE}} !important;',
                            ],
                            'condition' => [
                                'thumbnail_type_group_large' => 'video'
                            ],
                        ]
                    );
                $this->end_controls_tab();
                $this->start_controls_tab(
                    'thumbnail_content_common_card_tab',
                    [
                        'label' => esc_html__( 'Common Card', 'fancy-post-grid' ),
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
                            'default' => 'yes'
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
                            'condition' => [
                                'show_post_thumbnail' => 'yes',
                            ]
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
                                '{{WRAPPER}} .fpg-card-style:not(.card-large) .fpg-post-thumb iframe,
                                {{WRAPPER}} .fpg-card-style:not(.card-large) .fpg-post-thumb video' => 'transform: scale({{SIZE}});',
                            ],
                            'condition' => [
                                'thumbnail_type' => 'video'
                            ],
                        ]
                    );
                    $this->add_control(
                        'video_aspect_ratio',
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
                                '{{WRAPPER}} .fpg-card-style:not(.card-large) .fpg-post-thumb iframe,
                                {{WRAPPER}} .fpg-card-style:not(.card-large) .fpg-post-thumb video' => 'aspect-ratio: {{VALUE}} !important;',
                            ],
                            'condition' => [
                                'thumbnail_type' => 'video'
                            ],
                        ]
                    );
                $this->end_controls_tab();
            $this->end_controls_tabs();

            // Video Control
            $this->add_control(
                'thumbnail_video_ctrl_heading',
                [
                    'label' => esc_html__( 'Video Controls', 'fancy-post-grid' ),
                    'type' => Controls_Manager::HEADING,
                    'classes' => 'fpg-control-type-heading',
                    'separator' => 'before',
                    'conditions' => [
                        'relation' => 'or',
                        'terms' => [
                            [
                                'name' => 'thumbnail_type',
                                'value' => 'video',
                            ],
                            [
                                'name' => 'thumbnail_type_group_large',
                                'operator' => 'in',
                                'value' => ['video'],
                            ],
                        ],
                    ],
                ]
            );
            $this->add_control(
                'thumbnail_type_video_warning',
                [
                    'type'            => Controls_Manager::RAW_HTML,
                    'raw'             => __('Video link should exist with post.', 'fancy-post-grid'),
                    'content_classes' => 'fpg-panel-notice',
                    'conditions' => [
                        'relation' => 'or',
                        'terms' => [
                            [
                                'name' => 'thumbnail_type',
                                'value' => 'video',
                            ],
                            [
                                'name' => 'thumbnail_type_group_large',
                                'operator' => 'in',
                                'value' => ['video'],
                            ],
                        ],
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
                    'conditions' => [
                        'relation' => 'or',
                        'terms' => [
                            [
                                'name' => 'thumbnail_type',
                                'value' => 'video',
                            ],
                            [
                                'name' => 'thumbnail_type_group_large',
                                'operator' => 'in',
                                'value' => ['video'],
                            ],
                        ],
                    ],
                ]
            );
            $this->add_control(
                'video_muted',
                [
                    'label' => esc_html__( 'Muted', 'fancy-post-grid' ),
                    'description' => esc_html__( 'Autoplay required muted state.', 'fancy-post-grid' ),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__( 'Yes', 'fancy-post-grid' ),
                    'label_off' => esc_html__( 'No', 'fancy-post-grid' ),
                    'return_value' => 'yes',
                    'default' => 'yes',
                    'frontend_available' => true,
                    'render_type' => 'template',
                    'conditions' => [
                        'relation' => 'or',
                        'terms' => [
                            [
                                'name' => 'thumbnail_type',
                                'value' => 'video',
                            ],
                            [
                                'name' => 'thumbnail_type_group_large',
                                'operator' => 'in',
                                'value' => ['video'],
                            ],
                        ],
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
                    'conditions' => [
                        'relation' => 'or',
                        'terms' => [
                            [
                                'name' => 'thumbnail_type',
                                'value' => 'video',
                            ],
                            [
                                'name' => 'thumbnail_type_group_large',
                                'operator' => 'in',
                                'value' => ['video'],
                            ],
                        ],
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
                    'conditions' => [
                        'relation' => 'or',
                        'terms' => [
                            [
                                'name' => 'thumbnail_type',
                                'value' => 'video',
                            ],
                            [
                                'name' => 'thumbnail_type_group_large',
                                'operator' => 'in',
                                'value' => ['video'],
                            ],
                        ],
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
                    'conditions' => [
                        'relation' => 'or',
                        'terms' => [
                            [
                                'name' => 'thumbnail_type',
                                'value' => 'video',
                            ],
                            [
                                'name' => 'thumbnail_type_group_large',
                                'operator' => 'in',
                                'value' => ['video'],
                            ],
                        ],
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
                    'conditions' => [
                        'relation' => 'or',
                        'terms' => [
                            [
                                'name' => 'thumbnail_type',
                                'value' => 'video',
                            ],
                            [
                                'name' => 'thumbnail_type_group_large',
                                'operator' => 'in',
                                'value' => ['video'],
                            ],
                        ],
                    ],
                ]
            );
        $this->end_controls_section();
    }

    // Register Elementor Content Control For Title & Description
    protected function fpg_register_group_title_content_controls_el($args = []) {
        $args = wp_parse_args( $args, [
            'parent_selector' => ''
        ] );

        $this->start_controls_section(
			'_section_title',
			[
				'label' => __( 'Title / Description', 'fancy-post-grid' ),
                'tab' => Controls_Manager::TAB_CONTENT,
			]
		);
            $this->start_controls_tabs( 'title_content_tabs' );
                $this->start_controls_tab(
                    'title_content_large_card_tab',
                    [
                        'label' => esc_html__( 'Large Card', 'fancy-post-grid' ),
                    ]
                );
                    $this->add_control(
                        'show_post_title_group_large',
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
                        'title_tag_group_large',
                        [
                            'label'   => esc_html__( 'Title Tag', 'fancy-post-grid' ),
                            'type'    => Controls_Manager::SELECT,
                            'default' => 'h3',
                            'options' => [
                                'h1' => esc_html__( 'H1', 'fancy-post-grid' ),
                                'h2'  => esc_html__( 'H2', 'fancy-post-grid' ),
                                'h3' => esc_html__( 'H3', 'fancy-post-grid' ),
                                'h4'  => esc_html__( 'H4', 'fancy-post-grid' ),
                                'h5' => esc_html__( 'H5', 'fancy-post-grid' ),
                                'h6'  => esc_html__( 'H6', 'fancy-post-grid' ),
                            ],
                            'condition' => [
                                'show_post_title_group_large' => 'yes'
                            ]
                        ]
                    );
                    $this->add_responsive_control(
                        'title_line_length_group_large',
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
                                '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style.card-large .fpg-post-title a' => '-webkit-line-clamp: {{SIZE}}; display: -webkit-box; -webkit-box-orient: vertical; overflow: hidden;',
                            ],
                            'condition' => [
                                'show_post_title_group_large' => 'yes'
                            ]
                        ]
                    );
                    $this->add_control(
                        'title_length_group_large',
                        [
                            'label'   => esc_html__( 'Title Word Length', 'fancy-post-grid' ),
                            'type'    => Controls_Manager::NUMBER,
                            'min'     => 1,
                            'condition' => [
                                'show_post_title_group_large' => 'yes'
                            ]
                            
                        ]
                    );
                    $this->add_control(
                        'title_length_double_dot_group_large',
                        [
                            'label' => esc_html__( 'Show Double Dot', 'fancy-post-grid' ),
                            'Description' => esc_html__( 'Show double dot after title length', 'fancy-post-grid' ),
                            'type' => Controls_Manager::SWITCHER,
                            'label_on' => esc_html__( 'Show', 'fancy-post-grid' ),
                            'label_off' => esc_html__( 'Hide', 'fancy-post-grid' ),
                            'return_value' => 'yes',
                            'default' => 'yes',
                            'condition' => [
                                'show_post_title_group_large' => 'yes',
                                'title_length_group_large!' => ''
                            ]
                        ]
                    );

                    // Description
                    $this->add_control(
                        'desc_content_ctrl_heading_group_large',
                        [
                            'label' => esc_html__( 'Description', 'fancy-post-grid' ),
                            'type' => Controls_Manager::HEADING,
                            'classes' => 'fpg-control-type-heading',
                            'separator' => 'before',
                        ]
                    );
                    $this->add_control(
                        'show_post_desc_group_large',
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
                        'desc_line_length_group_large',
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
                                '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style.card-large .fpg-post-excerpt' => '-webkit-line-clamp: {{SIZE}}; display: -webkit-box; -webkit-box-orient: vertical; overflow: hidden;',
                            ],
                            'condition' => [
                                'show_post_desc_group_large' => 'yes'
                            ]
                        ]
                    );
                    $this->add_control(
                        'post_desc_word_group_large',
                        [
                            'label'     => esc_html__( 'Excerpt Word Length', 'fancy-post-grid' ),
                            'type'      => Controls_Manager::NUMBER,
                            'condition' => [
                                'show_post_desc_group_large' => 'yes',
                            ],
                        ]
                    );
                $this->end_controls_tab();
                $this->start_controls_tab(
                    'title_content_common_card_tab',
                    [
                        'label' => esc_html__( 'Common Card', 'fancy-post-grid' ),
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
                                '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style:not(.card-large) .fpg-post-title a' => '-webkit-line-clamp: {{SIZE}}; display: -webkit-box; -webkit-box-orient: vertical; overflow: hidden;',
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
                            'default' => 30,
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
                                '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style:not(.card-large) .fpg-post-excerpt' => '-webkit-line-clamp: {{SIZE}}; display: -webkit-box; -webkit-box-orient: vertical; overflow: hidden;',
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
                $this->end_controls_tab();
            $this->end_controls_tabs();
        $this->end_controls_section();
    }

    // Register Elementor Meta Control For Meta Condition
    protected function fpg_register_group_meta_content_controls_el() {
        $this->start_controls_section(
			'_section_meta_condition',
			[
				'label' => __( 'Meta Conditions', 'fancy-post-grid' ),
                'tab' => Controls_Manager::TAB_CONTENT,
			]
		);
            $this->start_controls_tabs( 'meta_content_tabs' );
                $this->start_controls_tab(
                    'meta_content_large_card_tab',
                    [
                        'label' => esc_html__( 'Large Card', 'fancy-post-grid' ),
                    ]
                );
                    $this->add_control(
                        'category_meta_ctrl_heading_group_large',
                        [
                            'label' => esc_html__( 'Category', 'fancy-post-grid' ),
                            'type' => Controls_Manager::HEADING,
                            'classes' => 'rs-control-type-heading',
                        ]
                    );
                    $this->add_control(
                        'show_post_categories_group_large',
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
                        'meta_list_ctrl_heading_group_large',
                        [
                            'label' => esc_html__( 'Meta List', 'fancy-post-grid' ),
                            'type' => Controls_Manager::HEADING,
                            'classes' => 'rs-control-type-heading',
                            'separator' => 'before',
                        ]
                    );
                    $this->add_control(
                        'show_meta_data_group_large',
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
                        'meta_appearance_group_large',
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
                                'show_meta_data_group_large' => 'yes'
                            ],
                            'separator' => 'before',
                        ]
                    );
                    $this->add_control(
                        'show_meta_separator_group_large',
                        [
                            'label'   => esc_html__( 'Show Meta Separator', 'fancy-post-grid' ),
                            'type'    => Controls_Manager::SWITCHER,
                            'label_on' => esc_html__( 'Show', 'fancy-post-grid' ),
                            'label_off' => esc_html__( 'Hide', 'fancy-post-grid' ),
                            'return_value' => 'yes',
                            'default' => 'no',
                            'separator' => 'before',
                            'condition' => [
                                'show_meta_data_group_large' => 'yes'
                            ],
                        ]
                    );
                    $this->add_control(
                        'meta_separator_group_large',
                        [
                            'label' => esc_html__( 'Separator', 'fancy-post-grid' ),
                            'placeholder' => esc_html__( '/', 'fancy-post-grid' ),
                            'type' => Controls_Manager::TEXT,
                            'condition' => [
                                'show_meta_data_group_large' => 'yes',
                                'show_meta_separator_group_large' => 'yes'
                            ]
                        ]
                    );
                    $this->add_control(
                        'show_meta_data_icon_group_large',
                        [
                            'label'   => esc_html__( 'Show Meta Icon', 'fancy-post-grid' ),
                            'type'    => Controls_Manager::SWITCHER,
                            'label_on' => esc_html__( 'Show', 'fancy-post-grid' ),
                            'label_off' => esc_html__( 'Hide', 'fancy-post-grid' ),
                            'return_value' => 'yes',
                            'default' => 'yes',
                            'separator' => 'before',
                            'condition' => [
                                'show_meta_data_group_large' => 'yes'
                            ]
                        ]
                    );
                    $this->add_control(
                        'show_post_author_group_large',
                        [
                            'label'   => esc_html__( 'Show Post Author', 'fancy-post-grid' ),
                            'type'    => Controls_Manager::SWITCHER,
                            'label_on' => esc_html__( 'Show', 'fancy-post-grid' ),
                            'label_off' => esc_html__( 'Hide', 'fancy-post-grid' ),
                            'return_value' => 'yes',
                            'default' => 'yes',
                            'separator' => 'before',
                            'condition' => [
                                'show_meta_data_group_large' => 'yes'
                            ]
                        ]
                    );
                    $this->add_control(
                        'author_prefix_group_large',
                        [
                            'label'       => esc_html__( 'Author Prefix', 'fancy-post-grid' ),
                            'type'        => Controls_Manager::TEXT,
                            'default'     => esc_html__( 'By', 'fancy-post-grid' ),
                            'placeholder' => esc_html__( 'Enter prefix text', 'fancy-post-grid' ),
                            'condition' => [
                                'show_meta_data_group_large' => 'yes',
                                'show_post_author_group_large' => 'yes'
                            ]
                        ]
                    );
                    $this->add_control(
                        'author_icon_visibility_group_large',
                        [
                            'label'        => esc_html__( 'Show Author Icon', 'fancy-post-grid' ),
                            'type'         => Controls_Manager::SWITCHER,
                            'label_on'     => esc_html__( 'Show', 'fancy-post-grid' ),
                            'label_off'    => esc_html__( 'Hide', 'fancy-post-grid' ),
                            'return_value' => 'yes',
                            'default'      => 'yes',
                            'condition' => [
                                'show_meta_data_group_large' => 'yes',
                                'show_post_author_group_large' => 'yes'
                            ]
                        ]
                    );
                    $this->add_control(
                        'author_image_icon_group_large',
                        [
                            'label'   => esc_html__( 'Author Image/Icon', 'fancy-post-grid' ),
                            'type'    => Controls_Manager::SELECT,
                            'options' => [
                                'image' => esc_html__( 'Image', 'fancy-post-grid' ),
                                'icon'  => esc_html__( 'Icon', 'fancy-post-grid' ),
                            ],
                            'default' => 'icon',
                            'condition' => [
                                'show_meta_data_group_large' => 'yes',
                                'author_icon_visibility_group_large' => 'yes',
                                'show_post_author_group_large' => 'yes'
                            ],
                        ]
                    );
                    $this->add_control(
                        'show_post_views_group_large',
                        [
                            'label'   => esc_html__( 'Show Post Views', 'fancy-post-grid' ),
                            'type'    => Controls_Manager::SWITCHER,
                            'label_on' => esc_html__( 'Show', 'fancy-post-grid' ),
                            'label_off' => esc_html__( 'Hide', 'fancy-post-grid' ),
                            'return_value' => 'yes',
                            'default' => 'yes',
                            'separator' => 'before',
                            'condition' => [
                                'show_meta_data_group_large' => 'yes'
                            ]
                        ]
                    );
                    $this->add_control(
                        'show_post_views_icon_group_large',
                        [
                            'label'   => esc_html__( 'Show Post Views icon', 'fancy-post-grid' ),
                            'type'    => Controls_Manager::SWITCHER,
                            'label_on' => esc_html__( 'Show', 'fancy-post-grid' ),
                            'label_off' => esc_html__( 'Hide', 'fancy-post-grid' ),
                            'return_value' => 'yes',
                            'default' => 'yes',
                            'condition' => [
                                'show_meta_data_group_large' => 'yes',
                                'show_post_views_group_large' => 'yes',
                            ],
                        ]
                    );
                    $this->add_control(
                        'show_post_tags_group_large',
                        [
                            'label'   => esc_html__( 'Show Post Tags', 'fancy-post-grid' ),
                            'type'    => Controls_Manager::SWITCHER,
                            'label_on' => esc_html__( 'Show', 'fancy-post-grid' ),
                            'label_off' => esc_html__( 'Hide', 'fancy-post-grid' ),
                            'return_value' => 'yes',
                            'default' => 'no',
                            'separator' => 'before',
                            'condition' => [
                                'show_meta_data_group_large' => 'yes'
                            ]
                        ]
                    );
                    $this->add_control(
                        'show_post_tags_icon_group_large',
                        [
                            'label'   => esc_html__( 'Show Post Tags icon', 'fancy-post-grid' ),
                            'type'    => Controls_Manager::SWITCHER,
                            'label_on' => esc_html__( 'Show', 'fancy-post-grid' ),
                            'label_off' => esc_html__( 'Hide', 'fancy-post-grid' ),
                            'return_value' => 'yes',
                            'default' => 'yes',
                            'condition' => [
                                'show_meta_data_group_large' => 'yes',
                                'show_post_tags_group_large' => 'yes',
                            ],
                        ]
                    );
                    $this->add_control(
                        'show_comments_count_group_large',
                        [
                            'label'   => esc_html__( 'Show Comment Count', 'fancy-post-grid' ),
                            'type'    => Controls_Manager::SWITCHER,
                            'label_on' => esc_html__( 'Show', 'fancy-post-grid' ),
                            'label_off' => esc_html__( 'Hide', 'fancy-post-grid' ),
                            'return_value' => 'yes',
                            'default' => 'no',
                            'separator' => 'before',
                            'condition' => [
                                'show_meta_data_group_large' => 'yes'
                            ]
                        ]
                    );
                    $this->add_control(
                        'show_comments_count_icon_group_large',
                        [
                            'label'   => esc_html__( 'Show Comment Count icon', 'fancy-post-grid' ),
                            'type'    => Controls_Manager::SWITCHER,
                            'label_on' => esc_html__( 'Show', 'fancy-post-grid' ),
                            'label_off' => esc_html__( 'Hide', 'fancy-post-grid' ),
                            'return_value' => 'yes',
                            'default' => 'yes',
                            'condition' => [
                                'show_meta_data_group_large' => 'yes',
                                'show_comments_count_group_large' => 'yes',
                            ],
                        ]
                    );
                    $this->add_control(
                        'show_post_date_group_large',
                        [
                            'label'   => esc_html__( 'Show Post Date', 'fancy-post-grid' ),
                            'type'    => Controls_Manager::SWITCHER,
                            'label_on' => esc_html__( 'Show', 'fancy-post-grid' ),
                            'label_off' => esc_html__( 'Hide', 'fancy-post-grid' ),
                            'return_value' => 'yes',
                            'default' => 'no',
                            'separator' => 'before',
                            'condition' => [
                                'show_meta_data_group_large' => 'yes'
                            ]
                        ]
                    );
                    $this->add_control(
                        'show_post_date_icon_group_large',
                        [
                            'label'   => esc_html__( 'Show Post Date icon', 'fancy-post-grid' ),
                            'type'    => Controls_Manager::SWITCHER,
                            'label_on' => esc_html__( 'Show', 'fancy-post-grid' ),
                            'label_off' => esc_html__( 'Hide', 'fancy-post-grid' ),
                            'return_value' => 'yes',
                            'default' => 'yes',
                            'condition' => [
                                'show_meta_data_group_large' => 'yes',
                                'show_post_date_group_large' => 'yes',
                            ],
                        ]
                    );
                $this->end_controls_tab();
                $this->start_controls_tab(
                    'meta_content_common_card_tab',
                    [
                        'label' => esc_html__( 'Common Card', 'fancy-post-grid' ),
                    ]
                );
                    $this->add_control(
                        'category_meta_ctrl_heading',
                        [
                            'label' => esc_html__( 'Category', 'fancy-post-grid' ),
                            'type' => Controls_Manager::HEADING,
                            'classes' => 'rs-control-type-heading',
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
                            'classes' => 'rs-control-type-heading',
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
                $this->end_controls_tab();
            $this->end_controls_tabs();
        $this->end_controls_section();
    }

    // Register Elementor Button Control For Meta Condition
    protected function fpg_register_group_button_content_controls_el() {
        $this->start_controls_section(
			'_section_button_content',
			[
				'label' => __( 'Button', 'fancy-post-grid' ),
                'tab' => Controls_Manager::TAB_CONTENT,
			]
		);
            $this->start_controls_tabs( 'button_content_tabs' );
                $this->start_controls_tab(
                    'button_large_card_tab',
                    [
                        'label' => esc_html__( 'Large Card', 'fancy-post-grid' ),
                    ]
                );
                    $this->add_control(
                        'show_button_group_large',
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
                        'btn_text_group_large',
                        [
                            'label' => esc_html__( 'Text', 'fancy-post-grid' ),
                            'type' => Controls_Manager::TEXT,
                            'placeholder' => __( 'Read More', 'fancy-post-grid' ),
                            'label_block' => true,
                            'condition' => [
                                'show_button_group_large' => 'yes'
                            ]
                        ]
                    );
                    $this->add_control(
                        'show_button_icon_group_large',
                        [
                            'label' => esc_html__( 'Show Icon', 'fancy-post-grid' ),
                            'type' => Controls_Manager::SWITCHER,
                            'label_on' => esc_html__( 'Show', 'fancy-post-grid' ),
                            'label_off' => esc_html__( 'Hide', 'fancy-post-grid' ),
                            'return_value' => 'yes',
                            'default' => 'yes',
                            'condition' => [
                                'show_button_group_large' => 'yes'
                            ]
                        ]
                    );
                    $this->add_control(
                        'btn_icon_group_large',
                        [
                            'label' => esc_html__( 'Icon', 'fancy-post-grid' ),
                            'type' => Controls_Manager::ICONS,
                            'default' => [
                                'value' => 'fas fa-arrow-right',
                                'library' => 'fa-solid',
                            ],
                            'condition' => [
                                'show_button_group_large' => 'yes',
                                'show_button_icon_group_large' => 'yes'
                            ]
                        ]
                    );
                $this->end_controls_tab();
                $this->start_controls_tab(
                    'button_common_card_tab',
                    [
                        'label' => esc_html__( 'Common Card', 'fancy-post-grid' ),
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
                $this->end_controls_tab();
            $this->end_controls_tabs();
        $this->end_controls_section();
    }

    // Register Elementor Style Control For General
    protected function fpg_register_group_general_style_controls_el($args = []) {
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
            $this->start_controls_tabs( 'general_style_tabs' );
                $this->start_controls_tab(
                    'general_style_large_card_tab',
                    [
                        'label' => esc_html__( 'Large Card', 'fancy-post-grid' ),
                    ]
                );
                    $this->add_responsive_control(
                        'card_text_align_group_large',
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
                                '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style.card-large' => 'text-align: {{VALUE}};',
                            ],
                        ]
                    );
                    $this->add_responsive_control(
                        'card_padding_group_large',
                        [
                            'label' => esc_html__( 'Padding', 'fancy-post-grid' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', 'em', 'rem', 'custom' ],
                            'selectors' => [
                                '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style.card-large' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ]
                    );
                    $this->add_responsive_control(
                        'card_radius_group_large',
                        [
                            'label' => esc_html__( 'Border Radius', 'fancy-post-grid' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                            'selectors' => [
                                '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style.card-large' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ]
                    );
                    $this->add_responsive_control(
                        'card_margin_group_large',
                        [
                            'label' => esc_html__( 'Margin', 'fancy-post-grid' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', 'em', 'rem', 'custom' ],
                            'selectors' => [
                                '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style.card-large' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name' => 'card_background_group_large',
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style.card-large',
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name' => 'card_border_group_large',
                            'selector' => '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style.card-large',
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Box_Shadow::get_type(),
                        [
                            'name' => 'card_box_shadow_group_large',
                            'selector' => '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style.card-large',
                        ]
                    );
                    // Content Area
                    $this->add_control(
                        'card_content_ctrl_heading_group_large',
                        [
                            'label' => esc_html__( 'Content Area', 'fancy-post-grid' ),
                            'type' => Controls_Manager::HEADING,
                            'classes' => 'fpg-control-type-heading',
                            'separator' => 'before',
                        ]
                    );
                    $this->add_responsive_control(
                        'card_content_padding_group_large',
                        [
                            'label' => esc_html__( 'Padding', 'fancy-post-grid' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', 'em', 'rem', 'custom' ],
                            'selectors' => [
                                '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style.card-large .fpg-post-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ]
                    );
                $this->end_controls_tab();
                $this->start_controls_tab(
                    'general_style_common_card_tab',
                    [
                        'label' => esc_html__( 'Common Card', 'fancy-post-grid' ),
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
                                '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style:not(.card-large)' => 'text-align: {{VALUE}};',
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
                                '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style:not(.card-large)' => 'align-items: {{VALUE}};',
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
                                '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style:not(.card-large)' => 'justify-content: {{VALUE}};',
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
                                '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style:not(.card-large)' => 'flex-direction: {{VALUE}};',
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
                                '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style:not(.card-large)' => 'flex-wrap: {{VALUE}};',
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
                                '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style:not(.card-large)' => 'gap: {{SIZE}}{{UNIT}};',
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
                                '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style:not(.card-large)' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                                '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style:not(.card-large)' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ]
                    );
                    $this->add_responsive_control(
                        'card_margin_group',
                        [
                            'label' => esc_html__( 'Margin', 'fancy-post-grid' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                            'selectors' => [
                                '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style:not(.card-large)' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name' => 'card_background',
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style:not(.card-large)',
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name' => 'card_border',
                            'selector' => '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style:not(.card-large)',
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Box_Shadow::get_type(),
                        [
                            'name' => 'card_box_shadow',
                            'selector' => '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style:not(.card-large)',
                        ]
                    );
                $this->end_controls_tab();
            $this->end_controls_tabs();
        $this->end_controls_section();
    }

    // Register Elementor Style Control For Thumbnail
    protected function fpg_register_group_thumbnail_style_controls_el($args = []) {
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
            $this->start_controls_tabs( 'thumbnail_style_tabs' );
                $this->start_controls_tab(
                    'thumbnail_style_large_card_tab',
                    [
                        'label' => esc_html__( 'Large Card', 'fancy-post-grid' ),
                    ]
                );
                    $this->add_responsive_control(
                        'card_thumb_width_large',
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
                                '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style.card-large .fpg-post-thumb' => 'max-width: {{SIZE}}{{UNIT}}; flex-shrink: 0;',
                            ],
                        ]
                    );
                    $this->add_responsive_control(
                        'card_thumb_height_large',
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
                                '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style.card-large .fpg-post-thumb' => 'height: {{SIZE}}{{UNIT}};',
                            ],
                        ]
                    );
                    $this->add_responsive_control(
                        'card_thumb_margin_large',
                        [
                            'label' => esc_html__( 'Margin', 'fancy-post-grid' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', 'em', 'rem', 'custom' ],
                            'selectors' => [
                                '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style.card-large .fpg-post-thumb' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ]
                    );
                    $this->add_responsive_control(
                        'card_thumb_border_radius_large',
                        [
                            'label' => esc_html__( 'Border Radius', 'fancy-post-grid' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                            'selectors' => [
                                '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style.card-large .fpg-post-thumb' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ]
                    );

                    // Play Button
                    $this->add_control(
                        'thumbnail_play_btn_ctrl_heading_large',
                        [
                            'label' => esc_html__( 'Play Button', 'fancy-post-grid' ),
                            'type' => Controls_Manager::HEADING,
                            'classes' => 'fpg-control-type-heading',
                            'separator' => 'before',
                            'condition' => [
                                'thumbnail_type_group_large' => 'play_btn'
                            ]
                        ]
                    );
                    $this->add_responsive_control(
                        'thumbnail_play_btn_size_large',
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
                                '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style.card-large .fpg-post-thumb .fpg-play-btn' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                            ],
                            'condition' => [
                                'thumbnail_type_group_large' => 'play_btn'
                            ]
                        ]
                    );
                    $this->add_responsive_control(
                        'thumbnail_play_btn_icon_size_large',
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
                                '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style.card-large .fpg-post-thumb .fpg-play-btn i' => 'font-size: {{SIZE}}{{UNIT}};',
                                '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style.card-large .fpg-post-thumb .fpg-play-btn svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                            ],
                            'condition' => [
                                'thumbnail_type_group_large' => 'play_btn'
                            ]
                        ]
                    );
                    $this->add_control(
                        'thumbnail_play_btn_color_large',
                        [
                            'label' => esc_html__( 'Color', 'fancy-post-grid' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style.card-large .fpg-post-thumb .fpg-play-btn' => '--primaryFgColor: {{VALUE}};',
                            ],
                            'condition' => [
                                'thumbnail_type_group_large' => 'play_btn'
                            ]
                        ]
                    );
                    $this->add_control(
                        'thumbnail_play_btn_bg_large',
                        [
                            'label' => esc_html__( 'Background', 'fancy-post-grid' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style.card-large .fpg-post-thumb .fpg-play-btn' => '--primaryColor: {{VALUE}};',
                            ],
                            'condition' => [
                                'thumbnail_type_group_large' => 'play_btn'
                            ]
                        ]
                    );
                    $this->add_responsive_control(
                        'thumbnail_play_btn_p_y_large',
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
                                '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style.card-large .fpg-post-thumb .fpg-play-btn' => 'top: {{SIZE}}{{UNIT}};',
                            ],
                            'condition' => [
                                'thumbnail_type_group_large' => 'play_btn'
                            ]
                        ]
                    );

                    // Overlay
                    $this->add_control(
                        'thumbnail_overlay_ctrl_heading_large',
                        [
                            'label' => esc_html__( 'Overlay', 'fancy-post-grid' ),
                            'type' => Controls_Manager::HEADING,
                            'classes' => 'fpg-control-type-heading',
                            'separator' => 'before',
                        ]
                    );
                    $this->add_control(
                        'show_thumbnail_overlay_large',
                        [
                            'label' => esc_html__( 'Show Overlay', 'fancy-post-grid' ),
                            'type' => Controls_Manager::SWITCHER,
                            'label_on' => esc_html__( 'Show', 'fancy-post-grid' ),
                            'label_off' => esc_html__( 'Hide', 'fancy-post-grid' ),
                            'return_value' => 'yes',
                            'default' => 'yes',
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name' => 'thumbnail_overlay_background_large',
                            'types' => [ 'gradient' ],
                            'selector' => '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style.card-large .fpg-post-thumb .thumb-overlay',
                            'condition' => [
                                'show_thumbnail_overlay_large' => 'yes'
                            ]
                        ]
                    );
                    $this->add_responsive_control(
                        'thumbnail_opacity_control_large',
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
                                '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style.card-large .fpg-post-thumb .thumb-overlay ' => 'opacity: {{SIZE}};',
                            ],
                            'condition' => [
                                'show_thumbnail_overlay_large' => 'yes'
                            ]
                        ]
                    );
                    $this->add_responsive_control(
                        'thumbnail_opacity_control_hover_large',
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
                                '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style.card-large:hover .fpg-post-thumb .thumb-overlay ' => 'opacity: {{SIZE}};',
                            ],
                            'condition' => [
                                'show_thumbnail_overlay_large' => 'yes'
                            ]
                        ]
                    );
                $this->end_controls_tab();
                $this->start_controls_tab(
                    'thumbnail_style_common_card_tab',
                    [
                        'label' => esc_html__( 'Common Card', 'fancy-post-grid' ),
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
                                '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style:not(.card-large) .fpg-post-thumb' => 'max-width: {{SIZE}}{{UNIT}}; flex-shrink: 0;',
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
                                '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style:not(.card-large) .fpg-post-thumb' => 'height: {{SIZE}}{{UNIT}};',
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
                                '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style:not(.card-large) .fpg-post-thumb' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                                '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style:not(.card-large) .fpg-post-thumb' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                                '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style:not(.card-large) .fpg-post-thumb .fpg-play-btn' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
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
                                '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style:not(.card-large) .fpg-post-thumb .fpg-play-btn i' => 'font-size: {{SIZE}}{{UNIT}};',
                                '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style:not(.card-large) .fpg-post-thumb .fpg-play-btn svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
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
                                '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style:not(.card-large) .fpg-post-thumb .fpg-play-btn' => '--primaryFgColor: {{VALUE}};',
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
                                '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style:not(.card-large) .fpg-post-thumb .fpg-play-btn' => '--primaryColor: {{VALUE}};',
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
                                '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style:not(.card-large) .fpg-post-thumb .fpg-play-btn' => 'top: {{SIZE}}{{UNIT}};',
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
                            'selector' => '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style:not(.card-large) .fpg-post-thumb .thumb-overlay',
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
                                '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style:not(.card-large) .fpg-post-thumb .thumb-overlay ' => 'opacity: {{SIZE}};',
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
                                '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style:not(.card-large):hover .fpg-post-thumb .thumb-overlay ' => 'opacity: {{SIZE}};',
                            ],
                            'condition' => [
                                'show_thumbnail_overlay' => 'yes'
                            ]
                        ]
                    );
                $this->end_controls_tab();
            $this->end_controls_tabs();
        $this->end_controls_section();
    }

    // Register Elementor Style Control For Title
    protected function fpg_register_group_title_style_controls_el($args = []) {
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

            $this->start_controls_tabs( 'title_style_tabs' );
                $this->start_controls_tab(
                    'title_style_large_card_tab',
                    [
                        'label' => esc_html__( 'Large Card', 'fancy-post-grid' ),
                    ]
                );

                    $this->add_group_control(
                        Group_Control_Typography::get_type(),
                        [
                            'name' => 'title_typography_group_large',
                            'selector' => '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style.card-large .fpg-post-title',
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Typography::get_type(),
                        [
                            'name' => 'title_typography_group_large_two',
                            'label' => esc_html__( 'Typography Medium Card', 'fancy-post-grid' ),
                            'selector' => '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style:nth-child(2) .fpg-post-title',
                            'condition' => [
                                'style' => 'two'
                            ]
                        ]
                    );
                    $this->add_responsive_control(
                        'title_margin_group_large',
                        [
                            'label' => esc_html__( 'Margin', 'fancy-post-grid' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', 'em', 'rem', 'custom' ],
                            'selectors' => [
                                '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style.card-large .fpg-post-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ]
                    );
                    $this->add_control(
                        'title_color_group_large',
                        [
                            'label' => esc_html__( 'Color', 'fancy-post-grid' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style.card-large .fpg-post-title a' => 'color: {{VALUE}}',
                            ],
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Text_Stroke::get_type(),
                        [
                            'name' => 'title_text_stroke_group_large',
                            'selector' => '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style.card-large .fpg-post-title a',
                        ]
                    );
                    $this->add_control(
                        'title_hover_ctrl_heading_group_large',
                        [
                            'label' => esc_html__( 'Hover', 'fancy-post-grid' ),
                            'type' => Controls_Manager::HEADING,
                            'classes' => 'fpg-control-type-heading',
                            'separator' => 'before',
                        ]
                    );
                    $this->add_control(
                        'title_color_hover_group_large',
                        [
                            'label' => esc_html__( 'Color', 'fancy-post-grid' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style.card-large .fpg-post-title a:hover' => 'color: {{VALUE}}',
                            ],
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Text_Stroke::get_type(),
                        [
                            'name' => 'title_text_stroke_hover_group_large',
                            'selector' => '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style.card-large .fpg-post-title a:hover',
                        ]
                    );
                $this->end_controls_tab();
                $this->start_controls_tab(
                    'title_style_common_card_tab',
                    [
                        'label' => esc_html__( 'Common Card', 'fancy-post-grid' ),
                    ]
                );
                    $this->add_group_control(
                        Group_Control_Typography::get_type(),
                        [
                            'name' => 'title_typography',
                            'selector' => '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style:not(.card-large) .fpg-post-title',
                        ]
                    );
                    $this->add_responsive_control(
                        'title_margin',
                        [
                            'label' => esc_html__( 'Margin', 'fancy-post-grid' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', 'em', 'rem', 'custom' ],
                            'selectors' => [
                                '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style:not(.card-large) .fpg-post-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ]
                    );
                    $this->add_control(
                        'title_color',
                        [
                            'label' => esc_html__( 'Color', 'fancy-post-grid' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style:not(.card-large) .fpg-post-title a' => 'color: {{VALUE}}',
                            ],
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Text_Stroke::get_type(),
                        [
                            'name' => 'title_text_stroke',
                            'selector' => '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style:not(.card-large) .fpg-post-title a',
                        ]
                    );
                    $this->add_control(
                        'title_hover_ctrl_heading',
                        [
                            'label' => esc_html__( 'Hover', 'fancy-post-grid' ),
                            'type' => Controls_Manager::HEADING,
                            'classes' => 'fpg-control-type-heading',
                            'separator' => 'before',
                        ]
                    );
                    $this->add_control(
                        'title_color_hover',
                        [
                            'label' => esc_html__( 'Color', 'fancy-post-grid' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style:not(.card-large) .fpg-post-title a:hover' => 'color: {{VALUE}}',
                            ],
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Text_Stroke::get_type(),
                        [
                            'name' => 'title_text_stroke_hover',
                            'selector' => '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style:not(.card-large) .fpg-post-title a:hover',
                        ]
                    );
                $this->end_controls_tab();
            $this->end_controls_tabs();
        $this->end_controls_section();
    }

    // Register Elementor Style Control For Description
    protected function fpg_register_group_desc_style_controls_el($args = []) {
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
            $this->start_controls_tabs( 'title_style_tabs' );
                $this->start_controls_tab(
                    'desc_style_large_card_tab',
                    [
                        'label' => esc_html__( 'Large Card', 'fancy-post-grid' ),
                    ]
                );
                    $this->add_control(
                        'desc_color_group_large',
                        [
                            'label' => esc_html__( 'Color', 'fancy-post-grid' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style.card-large .fpg-post-excerpt' => 'color: {{VALUE}}',
                            ],
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Typography::get_type(),
                        [
                            'name' => 'desc_typography_group_large',
                            'selector' => '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style.card-large .fpg-post-excerpt',
                        ]
                    );
                    $this->add_responsive_control(
                        'desc_max_width_group_large',
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
                                '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style.card-large .fpg-post-excerpt' => 'max-width: {{SIZE}}{{UNIT}};',
                            ],
                        ]
                    );
                    $this->add_responsive_control(
                        'desc_margin_group_large',
                        [
                            'label' => esc_html__( 'Margin', 'fancy-post-grid' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', 'em', 'rem', 'custom' ],
                            'selectors' => [
                                '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style.card-large .fpg-post-excerpt' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ]
                    );
                $this->end_controls_tab();
                $this->start_controls_tab(
                    'desc_style_common_card_tab',
                    [
                        'label' => esc_html__( 'Common Card', 'fancy-post-grid' ),
                    ]
                );
                    $this->add_control(
                        'desc_color',
                        [
                            'label' => esc_html__( 'Color', 'fancy-post-grid' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style:not(.card-large) .fpg-post-excerpt' => 'color: {{VALUE}}',
                            ],
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Typography::get_type(),
                        [
                            'name' => 'desc_typography',
                            'selector' => '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style:not(.card-large) .fpg-post-excerpt',
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
                                '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style:not(.card-large) .fpg-post-excerpt' => 'max-width: {{SIZE}}{{UNIT}};',
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
                                '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style:not(.card-large) .fpg-post-excerpt' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ]
                    );
                $this->end_controls_tab();
            $this->end_controls_tabs();
        $this->end_controls_section();
    }

    // Register Elementor Style Control For Meta Data
    protected function fpg_register_group_meta_style_controls_el($args = []) {
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

            $this->start_controls_tabs( 'meta_style_tabs' );
                $this->start_controls_tab(
                    'meta_style_large_card_tab',
                    [
                        'label' => esc_html__( 'Large Card', 'fancy-post-grid' ),
                    ]
                );
                    // Separator
                    $this->add_control(
                        'meta_separator_ctrl_heading_group_large',
                        [
                            'label' => esc_html__( 'Separator', 'fancy-post-grid' ),
                            'type' => Controls_Manager::HEADING,
                            'classes' => 'fpg-control-type-heading',
                            'separator' => 'before',
                            'condition' => [
                                'show_meta_separator_group_large' => 'yes'
                            ]
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Typography::get_type(),
                        [
                            'name' => 'meta_separator_typography_group_large',
                            'selector' => '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style.card-large .fpg-post-meta .fpg-meta-separator',
                            'condition' => [
                                'show_meta_separator_group_large' => 'yes'
                            ]
                        ]
                    );
                    $this->add_control(
                        'meta_separator_color_group_large',
                        [
                            'label' => esc_html__( 'Color', 'fancy-post-grid' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style.card-large .fpg-meta-separator' => 'color: {{VALUE}};',
                            ],
                            'condition' => [
                                'show_meta_separator_group_large' => 'yes'
                            ]
                        ]
                    );

                    // Meta Item
                    $this->add_control(
                        'meta_item_ctrl_heading_group_large',
                        [
                            'label' => esc_html__( 'Meta Item', 'fancy-post-grid' ),
                            'type' => Controls_Manager::HEADING,
                            'classes' => 'fpg-control-type-heading'
                        ]
                    );
                    $this->add_responsive_control(
                        'meta_item_flex_v_align_group_large',
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
                                '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style.card-large .fpg-post-meta .fpg-meta' => 'align-items: {{VALUE}};',
                            ],
                        ]
                    );
                    $this->add_responsive_control(
                        'meta_item_flex_h_align_group_large',
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
                                '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style.card-large .fpg-post-meta .fpg-meta' => 'justify-content: {{VALUE}};',
                            ],
                        ]
                    );
                    $this->add_responsive_control(
                        'meta_item_flex_dir_group_large',
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
                                '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style.card-large .fpg-post-meta .fpg-meta' => 'flex-direction: {{VALUE}};',
                            ],
                        ]
                    );
                    $this->add_responsive_control(
                        'meta_item_flex_wrap_group_large',
                        [
                            'label' => esc_html__( 'Flex Wrap', 'fancy-post-grid' ),
                            'type' => Controls_Manager::CHOOSE,
                            'options' => [
                                'nowrap' => [ 'title' => esc_html__( 'No Wrap', 'fancy-post-grid' ), 'icon' => 'eicon-nowrap' ],
                                'wrap'   => [ 'title' => esc_html__( 'Wrap', 'fancy-post-grid' ), 'icon' => 'eicon-wrap' ],
                            ],
                            'toggle' => true,
                            'selectors' => [
                                '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style.card-large .fpg-post-meta .fpg-meta' => 'flex-wrap: {{VALUE}};',
                            ],
                        ]
                    );
                    $this->add_responsive_control(
                        'meta_item_flex_gap_group_large',
                        [
                            'label' => esc_html__( 'Gap Between', 'fancy-post-grid' ),
                            'type' => Controls_Manager::SLIDER,
                            'size_units' => [ 'px', '%', 'custom' ],
                            'range' => [
                                'px' => [ 'min' => 0, 'max' => 1000 ],
                                '%' => [ 'min' => 0, 'max' => 100 ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style.card-large .fpg-post-meta .fpg-meta' => 'gap: {{SIZE}}{{UNIT}};',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Typography::get_type(),
                        [
                            'name' => 'meta_item_typography_group_large',
                            'selector' => '{{WRAPPER}} .fpg-card-style.card-large .fpg-post-meta .fpg-meta',
                            'separator' => 'before',
                        ]
                    );
                    $this->add_control(
                        'meta_item_text_color_group_large',
                        [
                            'label' => esc_html__( 'Text Color', 'fancy-post-grid' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style.card-large .fpg-post-meta .fpg-meta' => 'color: {{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_control(
                        'meta_author_img_ctrl_heading_group_large',
                        [
                            'label' => esc_html__( 'Author Image', 'fancy-post-grid' ),
                            'type' => Controls_Manager::HEADING,
                            'classes' => 'fpg-control-type-heading',
                            'separator' => 'before',
                            'condition' => [
                                'condition' => [
                                    'show_meta_data_group_large' => 'yes',
                                    'show_post_author_group_large' => 'yes',
                                    'author_icon_visibility_group_large' => 'yes',
                                    'author_image_icon_group_large' => 'image'
                                ],
                            ]
                        ]
                    );
                    $this->add_responsive_control(
                        'author_image_size_group_large',
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
                                '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style.card-large .fpg-post-meta .fpg-meta img' => 'width: {{SIZE}}{{UNIT}}; height: auto;',
                            ],
                            'condition' => [
                                'show_meta_data_group_large' => 'yes',
                                'show_post_author_group_large' => 'yes',
                                'author_icon_visibility_group_large' => 'yes',
                                'author_image_icon_group_large' => 'image'
                            ],
                        ]
                    );
                    $this->add_responsive_control(
                        'author_image_border_group_large',
                        [
                            'label' => esc_html__( 'Border Radius', 'fancy-post-grid' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                            'selectors' => [
                                '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style.card-large .fpg-post-meta .fpg-meta img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                            'condition' => [
                                'show_meta_data_group_large' => 'yes',
                                'show_post_author_group_large' => 'yes',
                                'author_icon_visibility_group_large' => 'yes',
                                'author_image_icon_group_large' => 'image'
                            ],
                        ]
                    );

                    $this->add_control(
                        'meta_icon_ctrl_heading_group_large',
                        [
                            'label' => esc_html__( 'Icon', 'fancy-post-grid' ),
                            'type' => Controls_Manager::HEADING,
                            'classes' => 'fpg-control-type-heading',
                            'separator' => 'before',
                            'condition' => [
                                'show_meta_data_icon_group_large' => 'yes'
                            ]
                        ]
                    );
                    $this->add_responsive_control(
                        'meta_item_icon_size_group_large',
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
                                '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style.card-large .fpg-post-meta .fpg-meta i' => 'font-size: {{SIZE}}{{UNIT}};',
                                '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style.card-large .fpg-post-meta .fpg-meta svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                            ],
                            'condition' => [
                                'show_meta_data_icon_group_large' => 'yes'
                            ]
                        ]
                    );
                    $this->add_control(
                        'meta_item_icon_color_group_large',
                        [
                            'label' => esc_html__( 'Icon Color', 'fancy-post-grid' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style.card-large .fpg-post-meta .fpg-meta i' => 'color: {{VALUE}};',
                                '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style.card-large .fpg-post-meta .fpg-meta svg path' => 'fill: {{VALUE}};',
                            ],
                            'condition' => [
                                'show_meta_data_icon_group_large' => 'yes'
                            ]
                        ]
                    );
                $this->end_controls_tab();
                $this->start_controls_tab(
                    'meta_style_common_card_tab',
                    [
                        'label' => esc_html__( 'Common Card', 'fancy-post-grid' ),
                    ]
                );
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
                            'selector' => '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style:not(.card-large) .fpg-post-meta .fpg-meta-separator',
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
                                '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style:not(.card-large) .fpg-meta-separator' => 'color: {{VALUE}};',
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
                            'classes' => 'fpg-control-type-heading'
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
                                '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style:not(.card-large) .fpg-post-meta .fpg-meta' => 'align-items: {{VALUE}};',
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
                                '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style:not(.card-large) .fpg-post-meta .fpg-meta' => 'justify-content: {{VALUE}};',
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
                                '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style:not(.card-large) .fpg-post-meta .fpg-meta' => 'flex-direction: {{VALUE}};',
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
                                '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style:not(.card-large) .fpg-post-meta .fpg-meta' => 'flex-wrap: {{VALUE}};',
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
                                '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style:not(.card-large) .fpg-post-meta .fpg-meta' => 'gap: {{SIZE}}{{UNIT}};',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Typography::get_type(),
                        [
                            'name' => 'meta_item_typography',
                            'selector' => '{{WRAPPER}} .fpg-card-style:not(.card-large) .fpg-post-meta .fpg-meta',
                            'separator' => 'before',
                        ]
                    );
                    $this->add_control(
                        'meta_item_text_color',
                        [
                            'label' => esc_html__( 'Text Color', 'fancy-post-grid' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style:not(.card-large) .fpg-post-meta .fpg-meta' => 'color: {{VALUE}};',
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
                                'condition' => [
                                    'show_meta_data' => 'yes',
                                    'show_post_author' => 'yes',
                                    'author_icon_visibility' => 'yes',
                                    'author_image_icon' => 'image'
                                ],
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
                                '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style:not(.card-large) .fpg-post-meta .fpg-meta img' => 'width: {{SIZE}}{{UNIT}}; height: auto;',
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
                                '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style:not(.card-large) .fpg-post-meta .fpg-meta img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                                '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style:not(.card-large) .fpg-post-meta .fpg-meta i' => 'font-size: {{SIZE}}{{UNIT}};',
                                '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style:not(.card-large) .fpg-post-meta .fpg-meta svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
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
                                '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style:not(.card-large) .fpg-post-meta .fpg-meta i' => 'color: {{VALUE}};',
                                '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style:not(.card-large) .fpg-post-meta .fpg-meta svg path' => 'fill: {{VALUE}};',
                            ],
                            'condition' => [
                                'show_meta_data_icon' => 'yes'
                            ]
                        ]
                    );
                $this->end_controls_tab();
            $this->end_controls_tabs();
        $this->end_controls_section();
    }

    // Register Elementor Style Control For Button
    protected function fpg_register_group_button_style_controls_el($args = []) {
        $args = wp_parse_args( $args, [
            'parent_selector' => ''
        ] );
        $this->start_controls_section(
			'_button_style_section',
			[
				'label' => __( 'Button Style', 'fancy-post-grid' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'conditions' => [
                    'relation' => 'or',
                    'terms' => [
                        [
                            'name' => 'show_button_group_large',
                            'operator' => '===',
                            'value' => 'yes',
                        ],
                        [
                            'name' => 'show_button',
                            'operator' => '===',
                            'value' => 'yes',
                        ],
                    ],
                ],
            ]
		);
            $this->start_controls_tabs( 'button_style_tabs' );
                $this->start_controls_tab(
                    'button_style_large_card_tab',
                    [
                        'label' => esc_html__( 'Large Card', 'fancy-post-grid' ),
                    ]
                );
                    $this->add_group_control(
                        Group_Control_Typography::get_type(),
                        [
                            'name' => 'button_typography_group_large',
                            'selector' => '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style.card-large .fpg-post-content .fpg-btn-wrapper a',
                        ]
                    );
                    $this->add_responsive_control(
                        'button_padding_group_large',
                        [
                            'label' => esc_html__( 'Padding', 'fancy-post-grid' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', 'em', 'rem', 'custom' ],
                            'selectors' => [
                                '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style.card-large .fpg-post-content .fpg-btn-wrapper a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ]
                    );
                    $this->add_responsive_control(
                        'button_radius_group_large',
                        [
                            'label' => esc_html__( 'Border Radius', 'fancy-post-grid' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', 'em', 'rem', 'custom' ],
                            'selectors' => [
                                '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style.card-large .fpg-post-content .fpg-btn-wrapper a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ]
                    );
                    $this->add_responsive_control(
                        'button_wrapper_margin_group_large',
                        [
                            'label' => esc_html__( 'Margin', 'fancy-post-grid' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', 'em', 'rem', 'custom' ],
                            'selectors' => [
                                '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style.card-large .fpg-post-content .fpg-btn-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ]
                    );
                    $this->add_responsive_control(
                        'button_icon_size_group_large',
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
                                '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style.card-large .fpg-post-content .fpg-btn-wrapper a svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                                '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style.card-large .fpg-post-content .fpg-btn-wrapper a i' => 'font-size: {{SIZE}}{{UNIT}};',
                            ],
                            'condition' => [
                                'show_button_icon_group_large' => 'yes'
                            ]
                        ]
                    );
                    $this->add_responsive_control(
                        'button_icon_dir_group_large',
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
                                '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style.card-large .fpg-post-content .fpg-btn-wrapper a' => 'flex-direction: {{VALUE}};',
                            ],
                            'condition' => [
                                'show_button_icon_group_large' => 'yes'
                            ]
                        ]
                    );
                    $this->add_responsive_control(
                        'button_icon_text_gap_group_large',
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
                                '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style.card-large .fpg-post-content .fpg-btn-wrapper a' => 'gap: {{SIZE}}{{UNIT}};',
                            ],
                            'condition' => [
                                'show_button_icon_group_large' => 'yes'
                            ]
                        ]
                    );
                    $this->add_control(
                        'button_color_group_large',
                        [
                            'label' => esc_html__( 'Color', 'fancy-post-grid' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style.card-large .fpg-post-content .fpg-btn-wrapper a' => 'color: {{VALUE}};',
                            ],
                            'separator' => 'before'
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name' => 'button_background_group_large',
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style.card-large .fpg-post-content .fpg-btn-wrapper a',
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name' => 'button_border_group_large',
                            'selector' => '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style.card-large .fpg-post-content .fpg-btn-wrapper a',
                        ]
                    );
                    $this->add_control(
                        'button_hover_ctrl_heading_group_large',
                        [
                            'label' => esc_html__( 'Hover', 'fancy-post-grid' ),
                            'type' => Controls_Manager::HEADING,
                            'classes' => 'fpg-control-type-heading',
                        ]
                    );
                    $this->add_control(
                        'button_color_hover_group_large',
                        [
                            'label' => esc_html__( 'Color', 'fancy-post-grid' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style.card-large .fpg-post-content .fpg-btn-wrapper a:hover' => 'color: {{VALUE}};',
                            ],
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name' => 'button_background_hover_group_large',
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style.card-large .fpg-post-content .fpg-btn-wrapper a:hover',
                        ]
                    );
                    $this->add_control(
                        'button_border_hover_group_large',
                        [
                            'label' => esc_html__( 'Border Color', 'fancy-post-grid' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style.card-large .fpg-post-content .fpg-btn-wrapper a:hover' => 'border-color: {{VALUE}};',
                            ],
                        ]
                    );
                $this->end_controls_tab();
                $this->start_controls_tab(
                    'button_style_common_card_tab',
                    [
                        'label' => esc_html__( 'Common Card', 'fancy-post-grid' ),
                    ]
                );
                    $this->add_group_control(
                        Group_Control_Typography::get_type(),
                        [
                            'name' => 'button_typography',
                            'selector' => '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style:not(.card-large) .fpg-post-content .fpg-btn-wrapper a',
                        ]
                    );
                    $this->add_responsive_control(
                        'button_padding',
                        [
                            'label' => esc_html__( 'Padding', 'fancy-post-grid' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', 'em', 'rem', 'custom' ],
                            'selectors' => [
                                '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style:not(.card-large) .fpg-post-content .fpg-btn-wrapper a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                                '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style:not(.card-large) .fpg-post-content .fpg-btn-wrapper a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                                '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style:not(.card-large) .fpg-post-content .fpg-btn-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                                '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style:not(.card-large) .fpg-post-content .fpg-btn-wrapper a svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                                '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style:not(.card-large) .fpg-post-content .fpg-btn-wrapper a i' => 'font-size: {{SIZE}}{{UNIT}};',
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
                                '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style:not(.card-large) .fpg-post-content .fpg-btn-wrapper a' => 'flex-direction: {{VALUE}};',
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
                                '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style:not(.card-large) .fpg-post-content .fpg-btn-wrapper a' => 'gap: {{SIZE}}{{UNIT}};',
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
                                '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style:not(.card-large) .fpg-post-content .fpg-btn-wrapper a' => 'color: {{VALUE}};',
                            ],
                            'separator' => 'before'
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name' => 'button_background',
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style:not(.card-large) .fpg-post-content .fpg-btn-wrapper a',
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name' => 'button_border',
                            'selector' => '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style:not(.card-large) .fpg-post-content .fpg-btn-wrapper a',
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
                                '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style:not(.card-large) .fpg-post-content .fpg-btn-wrapper a:hover' => 'color: {{VALUE}};',
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
                                '{{WRAPPER}} ' . $args['parent_selector'] . ' .fpg-card-style:not(.card-large) .fpg-post-content .fpg-btn-wrapper a:hover' => 'border-color: {{VALUE}};',
                            ],
                        ]
                    );
                $this->end_controls_tab();
            $this->end_controls_tabs();
        $this->end_controls_section();
    }
}
