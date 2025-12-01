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

defined( 'ABSPATH' ) || die();

class FPG_Post_Categories extends \Elementor\Widget_Base {

    use FPG_Query_Builder;
    use FPG_Slider_Controls;

    public function get_name() {
		return 'fpg-post-categories';
	}

    public function get_title() {
		return __( 'FPG - Post Categories', 'fancy-post-grid' );
	}

    public function get_icon() {
		return 'eicon-sitemap';
	}

    public function get_categories() {
		return [ 'fancy_post_grid_category' ];
	}

    public function get_keywords() {
        return ['post', 'fpg', 'grid', 'categories'];
    }

    protected function register_controls() {
        // General Content Section Start
        $this->start_controls_section(
			'_section_general',
			[
				'label' => __( 'General', 'fancy-post-grid' ),
                'tab' => Controls_Manager::TAB_CONTENT,
			]
		);
            $this->add_control(
                'layout',
                [
                    'label' => esc_html__( 'Layout', 'fancy-post-grid' ),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'grid',
                    'options' => [
                        'grid' => esc_html__( 'Grid', 'fancy-post-grid' ),
                        'slider' => esc_html__( 'Slider', 'fancy-post-grid' ),
                    ],
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
                    ],
                    'separator' => 'before'
                ]
            );
            $this->add_control(
                'show_image',
                [
                    'label' => esc_html__( 'Show Image', 'fancy-post-grid' ),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__( 'Show', 'fancy-post-grid' ),
                    'label_off' => esc_html__( 'Hide', 'fancy-post-grid' ),
                    'return_value' => 'yes',
                    'default' => 'yes',
                    'separator' => 'before',
                    'condition' => [
                        'style!' => 'two'
                    ]
                ]
            );
            $this->add_group_control(
                Group_Control_Image_Size::get_type(),
                [
                    'name' => 'thumbnail',
                    'default' => 'full',
                    'separator' => 'before',
                    'conditions' => [
                        'relation' => 'or',
                        'terms' => [
                            [
                                'name' => 'show_image',
                                'operator' => '===',
                                'value' => 'yes',
                            ],
                            [
                                'name' => 'style',
                                'operator' => '===',
                                'value' => 'two',
                            ],
                        ],
                    ],
                ]
            );
            $this->add_control(
                'show_count',
                [
                    'label' => esc_html__( 'Show Count', 'fancy-post-grid' ),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__( 'Show', 'fancy-post-grid' ),
                    'label_off' => esc_html__( 'Hide', 'fancy-post-grid' ),
                    'return_value' => 'yes',
                    'default' => 'yes',
                    'separator' => 'before'
                ]
            );
            $this->add_control(
                'count_prefix',
                [
                    'label' => esc_html__( 'Prefix', 'fancy-post-grid' ),
                    'type' => Controls_Manager::TEXT,
                    'placeholder' => __( 'Articles', 'fancy-post-grid' ),
                    'label_block' => true,
                    'condition' => [
                        'show_count' => 'yes'
                    ]
                ]
            );
            $this->add_control(
                'count_suffix',
                [
                    'label' => esc_html__( 'Suffix', 'fancy-post-grid' ),
                    'type' => Controls_Manager::TEXT,
                    'default' => __( ' Articles', 'fancy-post-grid' ),
                    'placeholder' => __( 'Articles', 'fancy-post-grid' ),
                    'label_block' => true,
                    'condition' => [
                        'show_count' => 'yes'
                    ]
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
                    'default' => 'yes',
                    'separator' => 'before'
                ]
            );
            
            // Column
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
                'column_count',
                [
                    'label' => esc_html__( 'Column', 'fancy-post-grid' ),
                    'type' => Controls_Manager::SLIDER,
                    'selectors' => [
                        '{{WRAPPER}} .fpg-post-categories' => 'grid-template-columns: repeat({{SIZE}}, 1fr);',
                    ],
                ]
            );
            $this->add_responsive_control(
                'col_gaps',
                [
                    'label' => esc_html__( 'Gap', 'fancy-post-grid' ),
                    'type' => Controls_Manager::GAPS,
                    'size_units' => [ 'px', 'em', 'rem', 'custom' ],
                    'selectors' => [
                        '{{WRAPPER}} .fpg-post-categories' => 'gap: {{ROW}}{{UNIT}} {{COLUMN}}{{UNIT}};',
                    ],
                ]
            );

            // Query
            $this->add_control(
                'query_settings_ctrl_heading',
                [
                    'label' => esc_html__( 'Query Settings', 'fancy-post-grid' ),
                    'type' => Controls_Manager::HEADING,
                    'classes' => 'fpg-control-type-heading',
                    'separator' => 'before',
                ]
            );
            $this->add_control(
                'category_filter',
                [
                    'label' => __('Select Category', 'fancy-post-grid'),
                    'type' => Controls_Manager::SELECT2,
                    'options' => $this->get_categories_list(),
                    'label_block' => true,
                    'multiple' => true,
                ]
            );
            $this->add_control(
                'exclude_categories',
                [
                    'label' => __('Exclude Categories', 'fancy-post-grid'),
                    'type' => Controls_Manager::SELECT2,
                    'options' => $this->get_categories_list(),
                    'label_block' => true,
                    'multiple' => true,
                ]
            );
            $this->add_control(
                'item_limit',
                [
                    'label' => __( 'Item Limit', 'fancy-post-grid' ),
                    'type' => Controls_Manager::NUMBER,
                ]
            );
            $this->add_control(
                'hide_empty',
                [
                    'label'       => __( 'Hide Empty', 'fancy-post-grid' ),
                    'type'        => Controls_Manager::SELECT,
                    'label_block' => true,
                    'options'     => [
                        'true'        => __( 'True', 'fancy-post-grid' ),
                        'false'        => __( 'False', 'fancy-post-grid' ),
                    ],
                    'default'     => 'true'
                ]
            );
            $this->add_control(
                'order_by',
                [
                    'label'       => __( 'Order By', 'fancy-post-grid' ),
                    'type'        => Controls_Manager::SELECT,
                    'label_block' => true,
                    'options'     => [
                        'none'        => __( 'None', 'fancy-post-grid' ),
                        'name'        => __( 'Name Alphabetically', 'fancy-post-grid' ),
                        'slug'        => __( 'Slug Alphabetically', 'fancy-post-grid' ),
                        'ID'          => __( 'Term ID', 'fancy-post-grid' ),
                        'count'       => __( 'Posts Number', 'fancy-post-grid' ),
                    ],
                    'default'     => 'none'
                ]
            );
            $this->add_control(
                'order',
                [
                    'label'       => __( 'Order', 'fancy-post-grid' ),
                    'type'        => Controls_Manager::SELECT,
                    'label_block' => true,
                    'options'     => [
                        'ASC'  => __( 'Ascending', 'fancy-post-grid' ),
                        'DESC' => __( 'Descending', 'fancy-post-grid' ),
                    ],
                    'default'     => 'ASC'
                ]
            );

        $this->end_controls_section();
        // General Content Section Start

        // Slider Config Start
        $this->fpg_sl_config_control(true);
        // Slider Config End

        // General Style Section Start
        $this->start_controls_section(
            '_style_general_style',
            [
                'label' => esc_html__( 'General Style',  'fancy-post-grid'  ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
            $this->add_responsive_control(
                'g_flex_v_align',
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
                        '{{WRAPPER}} .fpg-post-categories .fpg-cat-item' => 'align-items: {{VALUE}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'g_flex_h_align',
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
                        '{{WRAPPER}} .fpg-post-categories .fpg-cat-item' => 'justify-content: {{VALUE}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'g_flex_dir',
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
                        '{{WRAPPER}} .fpg-post-categories .fpg-cat-item' => 'flex-direction: {{VALUE}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'g_flex_wrap',
                [
                    'label' => esc_html__( 'Flex Wrap', 'fancy-post-grid' ),
                    'type' => Controls_Manager::CHOOSE,
                    'options' => [
                        'nowrap' => [ 'title' => esc_html__( 'No Wrap', 'fancy-post-grid' ), 'icon' => 'eicon-nowrap' ],
                        'wrap'   => [ 'title' => esc_html__( 'Wrap', 'fancy-post-grid' ), 'icon' => 'eicon-wrap' ],
                    ],
                    'toggle' => true,
                    'selectors' => [
                        '{{WRAPPER}} .fpg-post-categories .fpg-cat-item' => 'flex-wrap: {{VALUE}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'g_flex_gap',
                [
                    'label' => esc_html__( 'Gap Between', 'fancy-post-grid' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%', 'custom' ],
                    'range' => [
                        'px' => [ 'min' => 0, 'max' => 1000 ],
                        '%' => [ 'min' => 0, 'max' => 100 ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .fpg-post-categories .fpg-cat-item' => 'gap: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'g_padding',
                [
                    'label' => esc_html__( 'Padding', 'fancy-post-grid' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', 'em', 'rem', 'custom' ],
                    'selectors' => [
                        '{{WRAPPER}} .fpg-post-categories .fpg-cat-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'g_margin',
                [
                    'label' => esc_html__( 'Margin', 'fancy-post-grid' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', 'em', 'rem', 'custom' ],
                    'selectors' => [
                        '{{WRAPPER}} .fpg-post-categories .fpg-cat-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'g_radius',
                [
                    'label' => esc_html__( 'Border Radius', 'fancy-post-grid' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                    'selectors' => [
                        '{{WRAPPER}} .fpg-post-categories .fpg-cat-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'g_min_height',
                [
                    'label' => esc_html__( 'Min Height', 'fancy-post-grid' ),
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
                        '{{WRAPPER}} .fpg-post-categories .fpg-cat-item' => 'min-height: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );
            $this->start_controls_tabs( 'g_style_tabs' );
                $this->start_controls_tab(
                    'g_style_normal_tab',
                    [
                        'label' => esc_html__( 'Normal', 'fancy-post-grid' ),
                    ]
                );
                    $this->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name' => 'g_background',
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .fpg-post-categories .fpg-cat-item',
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name' => 'g_border',
                            'selector' => '{{WRAPPER}} .fpg-post-categories .fpg-cat-item',
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Box_Shadow::get_type(),
                        [
                            'name' => 'g_box_shadow',
                            'selector' => '{{WRAPPER}} .fpg-post-categories .fpg-cat-item',
                        ]
                    );
                    // Overlay
                    $this->add_control(
                        'g_overlay_ctrl_heading',
                        [
                            'label' => esc_html__( 'Overlay', 'fancy-post-grid' ),
                            'type' => Controls_Manager::HEADING,
                            'classes' => 'fpg-control-type-heading',
                            'condition' => [
                                'style' => 'two'
                            ]
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name' => 'g_overlay_background',
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .fpg-post-categories .fpg-cat-item::after',
                            'condition' => [
                                'style' => 'two'
                            ]
                        ]
                    );
                $this->end_controls_tab();
                $this->start_controls_tab(
                    'g_style_hover_tab',
                    [
                        'label' => esc_html__( 'Hover', 'fancy-post-grid' ),
                    ]
                );
                    $this->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name' => 'g_background_hover',
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .fpg-post-categories .fpg-cat-item:hover',
                        ]
                    );
                    $this->add_control(
                        'g_border_color_hover',
                        [
                            'label' => esc_html__( 'Border Color', 'fancy-post-grid' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .fpg-post-categories .fpg-cat-item' => 'border-color: {{VALUE}}',
                            ],
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Box_Shadow::get_type(),
                        [
                            'name' => 'g_box_shadow_hover',
                            'selector' => '{{WRAPPER}} .fpg-post-categories .fpg-cat-item:hover',
                        ]
                    );
                    // Overlay
                    $this->add_control(
                        'g_overlay_ctrl_heading_hover',
                        [
                            'label' => esc_html__( 'Overlay', 'fancy-post-grid' ),
                            'type' => Controls_Manager::HEADING,
                            'classes' => 'fpg-control-type-heading',
                            'condition' => [
                                'style' => 'two'
                            ]
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name' => 'g_overlay_background_hover',
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .fpg-post-categories .fpg-cat-item:hover::after',
                            'condition' => [
                                'style' => 'two'
                            ]
                        ]
            );
                $this->end_controls_tab();
            $this->end_controls_tabs();
        $this->end_controls_section();
        // General Style Section End

        // Image Style Section Start
        $this->start_controls_section(
            '_style_image_style',
            [
                'label' => esc_html__( 'Image Style',  'fancy-post-grid'  ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_image' => 'yes'
                ]
            ]
        );
            $this->add_responsive_control(
                'img_wrapper_max_width',
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
                        '{{WRAPPER}} .fpg-post-categories .fpg-cat-item .fpg-cat-image' => 'max-width: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'img_wrapper_height',
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
                        '{{WRAPPER}} .fpg-post-categories .fpg-cat-item .fpg-cat-image' => 'height: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'img_wrapper_padding',
                [
                    'label' => esc_html__( 'Padding', 'fancy-post-grid' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', 'em', 'rem', 'custom' ],
                    'selectors' => [
                        '{{WRAPPER}} .fpg-post-categories .fpg-cat-item .fpg-cat-image' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'img_wrapper_border_radius',
                [
                    'label' => esc_html__( 'Border Radius', 'fancy-post-grid' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                    'selectors' => [
                        '{{WRAPPER}} .fpg-post-categories .fpg-cat-item .fpg-cat-image' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'img_wrapper_border',
                    'selector' => '{{WRAPPER}} .fpg-post-categories .fpg-cat-item .fpg-cat-image',
                ]
            );
        $this->end_controls_section();
        // Image Style Section End

        // Content Style Section Start
        $this->start_controls_section(
            '_style_content_style',
            [
                'label' => esc_html__( 'Content Style',  'fancy-post-grid'  ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
            $this->add_control(
                'content_wrapper_ctrl_heading',
                [
                    'label' => esc_html__( 'Wrapper Options', 'fancy-post-grid' ),
                    'type' => Controls_Manager::HEADING,
                    'classes' => 'fpg-control-type-heading'
                ]
            );
            $this->add_responsive_control(
                'content_wrapper_flex_v_align',
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
                        '{{WRAPPER}} .fpg-post-categories .fpg-cat-item .fpg-cat-content' => 'align-items: {{VALUE}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'content_wrapper_flex_h_align',
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
                        '{{WRAPPER}} .fpg-post-categories .fpg-cat-item .fpg-cat-content' => 'justify-content: {{VALUE}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'content_wrapper_flex_dir',
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
                        '{{WRAPPER}} .fpg-post-categories .fpg-cat-item .fpg-cat-content' => 'flex-direction: {{VALUE}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'content_wrapper_flex_wrap',
                [
                    'label' => esc_html__( 'Flex Wrap', 'fancy-post-grid' ),
                    'type' => Controls_Manager::CHOOSE,
                    'options' => [
                        'nowrap' => [ 'title' => esc_html__( 'No Wrap', 'fancy-post-grid' ), 'icon' => 'eicon-nowrap' ],
                        'wrap'   => [ 'title' => esc_html__( 'Wrap', 'fancy-post-grid' ), 'icon' => 'eicon-wrap' ],
                    ],
                    'toggle' => true,
                    'selectors' => [
                        '{{WRAPPER}} .fpg-post-categories .fpg-cat-item .fpg-cat-content' => 'flex-wrap: {{VALUE}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'content_wrapper_flex_gap',
                [
                    'label' => esc_html__( 'Gap Between', 'fancy-post-grid' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%', 'custom' ],
                    'range' => [
                        'px' => [ 'min' => 0, 'max' => 1000 ],
                        '%' => [ 'min' => 0, 'max' => 100 ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .fpg-post-categories .fpg-cat-item .fpg-cat-content' => 'gap: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'content_wrapper_padding',
                [
                    'label' => esc_html__( 'Padding', 'fancy-post-grid' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', 'em', 'rem', 'custom' ],
                    'selectors' => [
                        '{{WRAPPER}} .fpg-post-categories .fpg-cat-item .fpg-cat-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            // Title
            $this->add_control(
                'title_ctrl_heading',
                [
                    'label' => esc_html__( 'Title Options', 'fancy-post-grid' ),
                    'type' => Controls_Manager::HEADING,
                    'classes' => 'fpg-control-type-heading',
                    'separator' => 'before'
                ]
            );
            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'title_typography',
                    'selector' => '{{WRAPPER}} .fpg-post-categories .fpg-cat-item .fpg-cat-content .fpg-cat-title',
                ]
            );
            $this->add_control(
                'title_color',
                [
                    'label' => esc_html__( 'Color', 'fancy-post-grid' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .fpg-post-categories .fpg-cat-item .fpg-cat-content .fpg-cat-title' => 'color: {{VALUE}};',
                    ],
                ]
            );
            $this->add_control(
                'title_color_hover',
                [
                    'label' => esc_html__( 'Color (Hover)', 'fancy-post-grid' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .fpg-post-categories .fpg-cat-item:hover .fpg-cat-content .fpg-cat-title' => 'color: {{VALUE}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'title_margin',
                [
                    'label' => esc_html__( 'Margin', 'fancy-post-grid' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', 'em', 'rem', 'custom' ],
                    'selectors' => [
                        '{{WRAPPER}} .fpg-post-categories .fpg-cat-item .fpg-cat-content .fpg-cat-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            // Count
            $this->add_control(
                'count_ctrl_heading',
                [
                    'label' => esc_html__( 'Count Options', 'fancy-post-grid' ),
                    'type' => Controls_Manager::HEADING,
                    'classes' => 'fpg-control-type-heading',
                    'separator' => 'before',
                    'condition' => [
                        'show_count' => 'yes'
                    ]
                ]
            );
            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'count_typography',
                    'selector' => '{{WRAPPER}} .fpg-post-categories .fpg-cat-item .fpg-cat-content .fpg-cat-count',
                    'condition' => [
                        'show_count' => 'yes'
                    ]
                ]
            );
            $this->add_control(
                'count_color',
                [
                    'label' => esc_html__( 'Color', 'fancy-post-grid' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .fpg-post-categories .fpg-cat-item .fpg-cat-content .fpg-cat-count' => 'color: {{VALUE}};',
                    ],
                    'condition' => [
                        'show_count' => 'yes'
                    ]
                ]
            );
            $this->add_control(
                'count_color_hover',
                [
                    'label' => esc_html__( 'Color (Hover)', 'fancy-post-grid' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .fpg-post-categories .fpg-cat-item:hover .fpg-cat-content .fpg-cat-count' => 'color: {{VALUE}};',
                    ],
                    'condition' => [
                        'show_count' => 'yes'
                    ]
                ]
            );
        $this->end_controls_section();
        // Content Style Section End

        // Button Style Section Start
        $this->start_controls_section(
            '_button_style',
            [
                'label' => esc_html__( 'Button Style',  'fancy-post-grid'  ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_button' => 'yes'
                ]
            ]
        );
            $this->add_responsive_control(
                'button_size',
                [
                    'label' => esc_html__( 'Button Size', 'fancy-post-grid' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 1000
                        ],
                        '%' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .fpg-post-categories .fpg-cat-item .fpg-cat-btn' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
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
                            'max' => 1000
                        ],
                        '%' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .fpg-post-categories .fpg-cat-item .fpg-cat-btn span i' => 'font-size: {{SIZE}}{{UNIT}};',
                        '{{WRAPPER}} .fpg-post-categories .fpg-cat-item .fpg-cat-btn span svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'button_border_radius',
                [
                    'label' => esc_html__( 'Border Radius', 'fancy-post-grid' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                    'selectors' => [
                        '{{WRAPPER}} .fpg-post-categories .fpg-cat-item .fpg-cat-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->start_controls_tabs( 'button_style_tabs' );
                $this->start_controls_tab(
                    'button_style_normal_tab',
                    [
                        'label' => esc_html__( 'Normal', 'fancy-post-grid' ),
                    ]
                );
                    $this->add_control(
                        'button_icon_color',
                        [
                            'label' => esc_html__( 'Icon Color', 'fancy-post-grid' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .fpg-post-categories .fpg-cat-item .fpg-cat-btn span i' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .fpg-post-categories .fpg-cat-item .fpg-cat-btn span svg path' => 'fill: {{VALUE}};',
                            ],
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name' => 'button_background',
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .fpg-post-categories .fpg-cat-item .fpg-cat-btn',
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name' => 'button_border',
                            'selector' => '{{WRAPPER}} .fpg-post-categories .fpg-cat-item .fpg-cat-btn',
                        ]
                    );
                $this->end_controls_tab();
                $this->start_controls_tab(
                    'button_style_hover_tab',
                    [
                        'label' => esc_html__( 'Hover', 'fancy-post-grid' ),
                    ]
                );
                    $this->add_control(
                        'button_icon_color_hover',
                        [
                            'label' => esc_html__( 'Icon Color', 'fancy-post-grid' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .fpg-post-categories .fpg-cat-item:hover .fpg-cat-btn span i' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .fpg-post-categories .fpg-cat-item:hover .fpg-cat-btn span svg path' => 'fill: {{VALUE}};',
                            ],
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name' => 'button_background_hover',
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .fpg-post-categories .fpg-cat-item:hover .fpg-cat-btn',
                        ]
                    );
                    $this->add_control(
                        'button_border_color_hover',
                        [
                            'label' => esc_html__( 'Border Color', 'fancy-post-grid' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .fpg-post-categories .fpg-cat-item:hover .fpg-cat-btn' => 'border-color: {{VALUE}};',
                            ],
                        ]
                    );
                $this->end_controls_tab();
            $this->end_controls_tabs();
        $this->end_controls_section();
        // Button Style Section End

        // Nav's Style Section Start
        $this->fpg_sl_nav_style_control();
        // Nav's Style Section End
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $unique = 'id-'.$this->get_id();
        
        $style = 'fpg-post-categories-'.$settings['style'];

        $taxonomy = 'category';

        $order_by = $settings['order_by'];
        $order = $settings['order'];
        $hide_empty = $settings['hide_empty'] === 'false' ? false : true;
        $item_limit = $settings['item_limit'];

        $manual_include = !empty($settings['category_filter']) ? $settings['category_filter'] : [];
        $manual_exclude = !empty($settings['exclude_categories']) ? $settings['exclude_categories'] : [];

        $args = [
            'taxonomy'   => $taxonomy,
            'hide_empty' => $hide_empty,
            'orderby'    => $order_by,
            'order'      => $order,
            'number'     => $item_limit,
        ];
        if (!empty($manual_include)) {
            $args['slug'] = $manual_include;
        }
        if (!empty($manual_exclude)) {
            $args['exclude'] = [];
            foreach ($manual_exclude as $slug) {
                $term = get_term_by('slug', $slug, $taxonomy);
                if ($term) {
                    $args['exclude'][] = $term->term_id;
                }
            }
        }
        $terms = get_terms($args);
        if (empty($terms) || is_wp_error($terms)) {
            return;
        }
        $style_attr = '';
        $slItemCls = '';
        if ('slider' === $settings['layout']) {
            $sliderDots = $settings['slider_dots'] == 'true' ? 'true' : 'false';
            $sliderNav = $settings['slider_nav'] == 'true' ? 'true' : 'false';
            if ($sliderNav == 'true') {
                $sliderNavStyleCls = !empty($settings['slider_nav_style']) ? 'nav-style-' . $settings['slider_nav_style'] : '';
                $sliderNavIconCls = !empty($settings['slider_nav_icon_style']) ? 'nav-icon-' . $settings['slider_nav_icon_style'] : '';
                $sliderNavCls = $sliderNavStyleCls . ' ' . $sliderNavIconCls;
            } else {
                $sliderNavCls = '';
            }
            $sliderDotsCls = ($sliderDots == 'true') ? 'swiper-dots-'.$settings['slider_dots_style'] : '';
            $rtl = ('right' === $settings['slider_direction']) ? 'rtl' : 'ltr';
            $slItemCls = 'swiper-slide';

            $this->add_render_attribute( 'sl_parent', [
                'id' => 'fpg-unique-slider-'.$unique,
                'class' => [
                    'fpg-unique-slider',
                    $sliderNavCls,
                    $sliderDotsCls
                ],
            ]);
        }

        // Item Markup
        ob_start();
            foreach ($terms as $cat) :
                $get_image = !empty(get_term_meta($cat->term_id, 'fpg_bg_image', true)) ? get_term_meta($cat->term_id, 'fpg_bg_image', true) : '';

                if (!empty($get_image)) {
                    $attachment_id = attachment_url_to_postid($get_image);
                    $image_data = wp_get_attachment_image_src($attachment_id, $settings['thumbnail_size']);
                    $attachment_url = !empty($image_data) ? $image_data[0] : '';
                    $attachment_alt = get_post_meta($attachment_id, '_wp_attachment_image_alt', true);

                    if ('two' === $settings['style']) {
                        $attr_img = sprintf('--fpgCatItemImage: url(%s);', esc_url($attachment_url));
                        $style_attr = sprintf(' style="%s"', $attr_img);
                    }
                }
                ?>
                
                <a class="fpg-cat-item <?php echo esc_attr($slItemCls); ?>" 
                href="<?php echo esc_url(get_category_link($cat->term_id)); ?>" <?php echo $style_attr; ?>>
                    
                    <?php if (!empty($get_image) && 'yes' === $settings['show_image']) : ?>
                        <div class="fpg-cat-image">
                            <img src="<?php echo esc_url($attachment_url); ?>" alt="<?php echo esc_attr($attachment_alt); ?>">
                        </div>
                    <?php endif; ?>

                    <div class="fpg-cat-content">
                        <div class="fpg-cat-text-wrapper">
                            <h6 class="fpg-cat-title"><?php echo esc_html($cat->name); ?></h6>
                            <?php if ('yes' === $settings['show_count']) : ?>
                                <span class="fpg-cat-count">
                                    <?php 
                                    echo wp_kses_post($settings['count_prefix']) . intval($cat->count) . wp_kses_post($settings['count_suffix']); 
                                    ?>
                                </span>
                            <?php endif; ?>
                        </div>

                        <?php if ('yes' === $settings['show_button']) : ?>
                            <div class="fpg-cat-btn">
                                <span>
                                    <i class="ri-arrow-right-line"></i>
                                    <i class="ri-arrow-right-line"></i>
                                </span>
                            </div>
                        <?php endif; ?>
                    </div>
                </a>
            <?php
            endforeach;
        $html_output = ob_get_clean();
        ?>
        
        <?php if ('slider' === $settings['layout']) { ?>
            <div <?php $this->print_render_attribute_string( 'sl_parent' ); ?>>
                <div class="fpg-post-categories swiper <?php echo esc_attr($style); ?>" dir="<?php echo esc_attr($rtl); ?>">
                    <div class="swiper-wrapper">
                        <?php echo $html_output; ?>
                    </div>
                </div>
                <?php $this->fpg_render_sl_nav_content(); ?>
            </div>
        <?php } else { ?>
            <div class="fpg-post-categories <?php echo esc_attr($style); ?>">
                <?php echo $html_output; ?>
            </div>
        <?php }
    }
}