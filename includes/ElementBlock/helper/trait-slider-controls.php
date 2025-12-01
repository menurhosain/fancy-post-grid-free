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

trait FPG_Slider_Controls {

	protected function fpg_sl_config_control( $condition = false ) {
        $sec_condition = [];

        if ($condition) {
           $sec_condition['layout'] = 'slider';
        }

		$this->start_controls_section(
			'slider_config',
			[
				'label' => esc_html__('Slider Configuration', 'fancy-post-grid'),
				'tab' => Controls_Manager::TAB_CONTENT,
                'condition' => $sec_condition
			]
		);
			$this->add_responsive_control(
				'sl_column',
				[
					'label'     => esc_html__( 'Column', 'fancy-post-grid' ),
					'type'      => Controls_Manager::NUMBER,
					'min'       => 1,
					'max'       => 10,
					'step'      => 1,
					'frontend_available' => true
				]
			);
			$this->add_responsive_control(
				'sl_column_gap',
				[
					'label'     => esc_html__( 'Item Gap', 'fancy-post-grid' ),
					'type'      => Controls_Manager::NUMBER,
					'min'       => -0.1,
					'max'       => 200,
					'step'      => 0.1,
					'frontend_available' => true
				]
			);
			$this->add_responsive_control(
				'sl_vertical',
				[
					'label' => esc_html__( 'Vertical Mode', 'fancy-post-grid' ),
					'type' => Controls_Manager::SELECT,
					'default' => 'horizontal',
					'options' => [
						'horizontal' => esc_html__( 'False', 'fancy-post-grid' ),
						'vertical' => esc_html__( 'True', 'fancy-post-grid' ),
					],
					'frontend_available' => true
				]
			);

            $this->add_control(
                'slides_to_scroll',
                [
                    'label'   => esc_html__('Slide To Scroll', 'fancy-post-grid'),
                    'type'    => Controls_Manager::SELECT,
                    'default' => '1',
                    'options' => [
                        '1' => esc_html__('1 Item', 'fancy-post-grid'),
                        '2' => esc_html__('2 Item', 'fancy-post-grid'),
                        '3' => esc_html__('3 Item', 'fancy-post-grid'),
                        '4' => esc_html__('4 Item', 'fancy-post-grid'),
                    ],
                    'separator' => 'before',
					'frontend_available' => true
                ]
            );
            $this->add_control(
                'slider_initial_slide',
                [
                    'label'   => esc_html__('Initial Slide', 'fancy-post-grid'),
                    'type'    => Controls_Manager::SELECT,
                    'default' => '0',
                    'options' => [
                        '0' => esc_html__('1st Item', 'fancy-post-grid'),
                        '1' => esc_html__('2nd Item', 'fancy-post-grid'),
                        '2' => esc_html__('3rd Item', 'fancy-post-grid'),
                        '3' => esc_html__('4th Item', 'fancy-post-grid'),
                        '4' => esc_html__('5th Item', 'fancy-post-grid'),
                        '5' => esc_html__('6th Item', 'fancy-post-grid'),
                        '6' => esc_html__('7th Item', 'fancy-post-grid'),
                        '7' => esc_html__('8th Item', 'fancy-post-grid'),
                        '8' => esc_html__('9th Item', 'fancy-post-grid'),
                        '9' => esc_html__('10th Item', 'fancy-post-grid'),
                    ],
                    'separator' => 'before',
					'frontend_available' => true
                ]
            );
            $this->add_control(
                'slider_speed',
                [
                    'label'   => esc_html__('Slide Transition', 'fancy-post-grid'),
                    'type'    => Controls_Manager::SELECT,
                    'default' => 500,
                    'options' => [
                        '300' => esc_html__('300 ms', 'fancy-post-grid'),
                        '500' => esc_html__('500 ms', 'fancy-post-grid'),
                        '700' => esc_html__('700 ms', 'fancy-post-grid'),
                        '1000' => esc_html__('1000 ms', 'fancy-post-grid'),
                        '1500' => esc_html__('1500 ms', 'fancy-post-grid'),
                        '2000' => esc_html__('2000 ms', 'fancy-post-grid'),
                        '2500' => esc_html__('2500 ms', 'fancy-post-grid'),
                        '3000' => esc_html__('3000 ms', 'fancy-post-grid'),
                        '3500' => esc_html__('3500 ms', 'fancy-post-grid'),
                        '4000' => esc_html__('4000 ms', 'fancy-post-grid'),
                        '4500' => esc_html__('4500 ms', 'fancy-post-grid'),
                        '5000' => esc_html__('5000 ms', 'fancy-post-grid'),
                    ],
                    'separator' => 'before',
					'frontend_available' => true
                ]
            );
            $this->add_control(
                'slider_direction',
                [
                    'label'   => esc_html__('Direction', 'fancy-post-grid'),
                    'type'    => Controls_Manager::SELECT,
                    'default' => '',
                    'options' => [
                        '' => esc_html__('Left', 'fancy-post-grid'),
                        'right' => esc_html__('Right', 'fancy-post-grid'),
                    ],
                    'separator' => 'before',
					'frontend_available' => true
                ]
            );
            $this->add_control(
                'slider_effect',
                [
                    'label'   => esc_html__('Slide Effect', 'fancy-post-grid'),
                    'type'    => Controls_Manager::SELECT,
                    'default' => '',
                    'options' => [
                        '' => esc_html__('Default', 'fancy-post-grid'),
                        'fade' => esc_html__('Fade', 'fancy-post-grid'),
                        'cube' => esc_html__('Cube', 'fancy-post-grid'),
                        'coverflow' => esc_html__('Coverflow', 'fancy-post-grid'),
                        'flip' => esc_html__('Flip', 'fancy-post-grid'),
                        'cards' => esc_html__('Cards', 'fancy-post-grid'),
                        'creative' => esc_html__('Creative', 'fancy-post-grid')
                    ],
                    'separator' => 'before',
					'frontend_available' => true
                ]
            );
            $this->add_control(
                'slider_cards_rotation_value',
                [
                    'label' => esc_html__( 'Rotation Value', 'fancy-post-grid' ),
                    'type' => Controls_Manager::NUMBER,
                    'min' => 0,
                    'max' => 40,
                    'step' => 0.01,
                    'default' => 2,
                    'condition' => [
                        'slider_effect' => 'cards'
                    ],
					'frontend_available' => true
                ]
            );
            $this->add_control(
                'slider_cards_rotation_spacing_value',
                [
                    'label' => esc_html__( 'Rotation Spacing', 'fancy-post-grid' ),
                    'type' => Controls_Manager::NUMBER,
                    'min' => -150,
                    'max' => 150,
                    'step' => 1,
                    'default' => 8,
                    'condition' => [
                        'slider_effect' => 'cards'
                    ],
					'frontend_available' => true
                ]
            );
            $this->add_control(
                'slider_coverflow_style',
                [
                    'label'   => esc_html__('Coverflow Style', 'fancy-post-grid'),
                    'type'    => Controls_Manager::SELECT,
                    'default' => '',
                    'options' => [
                        '' => esc_html__('One', 'fancy-post-grid'),
                        'two' => esc_html__('Two', 'fancy-post-grid')
                    ],
                    'condition' => [
                        'slider_effect' => 'coverflow'
                    ],
					'frontend_available' => true
                ]
            );
            $this->add_control(
                'slider_creative_style',
                [
                    'label'   => esc_html__('Creative Style', 'fancy-post-grid'),
                    'type'    => Controls_Manager::SELECT,
                    'default' => '',
                    'options' => [
                        '' => esc_html__('One', 'fancy-post-grid'),
                        'two' => esc_html__('Two', 'fancy-post-grid'),
                        'three' => esc_html__('Three', 'fancy-post-grid'),
                        'four' => esc_html__('Four', 'fancy-post-grid')
                    ],
                    'condition' => [
                        'slider_effect' => 'creative'
                    ],
					'frontend_available' => true
                ]
            );
            $this->add_control(
                'slider_effect_warning',
                [
                    'type'            => Controls_Manager::RAW_HTML,
                    'raw'             => __('The <strong>cube effect</strong> may not function correctly when displaying more than <strong>one item</strong> simultaneously.', 'fancy-post-grid'),
                    'content_classes' => 'fpg-panel-notice',
                    'condition' => [
                        'col_desktop!' => '1',
                        'slider_effect' => 'cube'
                    ]
                ]
            );
            $this->add_control(
                'slider_dots',
                [
                    'label'   => esc_html__('Navigation Bullets', 'fancy-post-grid'),
                    'type'    => Controls_Manager::SELECT,
                    'default' => 'false',
                    'options' => [
                        'true' => esc_html__('Enable', 'fancy-post-grid'),
                        'false' => esc_html__('Disable', 'fancy-post-grid'),
                    ],
                    'separator' => 'before',
					'frontend_available' => true
                ]

            );
            $this->add_control(
                'slider_bullet_type',
                [
                    'label'   => esc_html__('Bullets Type', 'fancy-post-grid'),
                    'type'    => Controls_Manager::SELECT,
                    'default' => '',
                    'options' => [
                        '' => esc_html__('Dots', 'fancy-post-grid'),
                        'progressbar' => esc_html__('Progressbar', 'fancy-post-grid'),
                        'fraction' => esc_html__('Fraction Number', 'fancy-post-grid'),
                    ],
                    'condition' => [
                        'slider_dots' => 'true',
					],
					'frontend_available' => true
                ]
            );
            $this->add_control(
                'slider_decimal_fraction',
                [
                    'label' => esc_html__( 'Decimal Count (01-10)', 'fancy-post-grid' ),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__( 'Yes', 'fancy-post-grid' ),
                    'label_off' => esc_html__( 'No', 'fancy-post-grid' ),
                    'return_value' => 'yes',
                    'default' => 'no',
                    'render_type'  => 'template',
                    'condition' => [
                        'slider_dots' => 'true',
                        'slider_bullet_type' => 'fraction'
					],
					'frontend_available' => true
                ]
            );
            $this->add_control(
                'slider_current_fraction',
                [
                    'label' => esc_html__( 'Hide Total Count', 'fancy-post-grid' ),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__( 'Yes', 'fancy-post-grid' ),
                    'label_off' => esc_html__( 'No', 'fancy-post-grid' ),
                    'return_value' => 'yes',
                    'default' => 'no',
                    'render_type'  => 'template',
                    'condition' => [
                        'slider_dots' => 'true',
                        'slider_bullet_type' => 'fraction'
					],
					'frontend_available' => true
                ]
            );
            $this->add_control(
                'slider_dynamic_bullets',
                [
                    'label'   => esc_html__('Dynamic Bullets', 'fancy-post-grid'),
                    'type'    => Controls_Manager::SELECT,
                    'default' => 'false',
                    'options' => [
                        'true' => esc_html__('Enable', 'fancy-post-grid'),
                        'false' => esc_html__('Disable', 'fancy-post-grid'),
                    ],
                    'condition' => [
                        'slider_dots' => 'true',
                        'slider_bullet_type!' => ['progressbar', 'fraction']
					],
					'frontend_available' => true
                ]
            );
            $this->add_control(
                'slider_dots_style',
                [
                    'label'   => esc_html__('Bullets Style', 'fancy-post-grid'),
                    'type'    => Controls_Manager::SELECT,
                    'default' => 'default',
                    'options' => [
                        'default' => esc_html__('Default', 'fancy-post-grid'),
                        '2' => esc_html__('Style 2', 'fancy-post-grid')
                    ],
                    'condition' => [
                        'slider_dots' => 'true',
                        'slider_bullet_type!' => ['progressbar', 'fraction']
                    ]
                ]
            );

            $this->add_control(
                'slider_nav',
                [
                    'label'   => esc_html__('Navigation Nav', 'fancy-post-grid'),
                    'type'    => Controls_Manager::SELECT,
                    'default' => 'false',
                    'options' => [
                        'true' => esc_html__('Enable', 'fancy-post-grid'),
                        'false' => esc_html__('Disable', 'fancy-post-grid'),
                    ],
                    'separator' => 'before',
					'frontend_available' => true
                ]

            );
            $this->add_control(
                'slider_nav_style',
                [
                    'label'   => esc_html__('Nav Style', 'fancy-post-grid'),
                    'type'    => Controls_Manager::SELECT,
                    'default' => '',
                    'options' => [
                        '' => esc_html__('Style 1', 'fancy-post-grid'),
                        '2' => esc_html__('Style 2', 'fancy-post-grid')
                    ],
                    'condition' => [
                        'slider_nav' => 'true'
                    ]
                ]

            );
            $this->add_control(
                'slider_nav_icon_style',
                [
                    'label'   => esc_html__('Icon Style', 'fancy-post-grid'),
                    'type'    => Controls_Manager::SELECT,
                    'default' => '',
                    'options' => [
                        '' => esc_html__('Icon 1', 'fancy-post-grid'),
                        '2' => esc_html__('Icon 2', 'fancy-post-grid'),
                        '3' => esc_html__('Icon 3', 'fancy-post-grid'),
                        '4' => esc_html__('Icon 4', 'fancy-post-grid'),
                        '5' => esc_html__('Icon 5', 'fancy-post-grid'),
                    ],
                    'condition' => [
                        'slider_nav' => 'true'
                    ]
                ]

            );
            $this->add_control(
                'slider_scrollbar',
                [
                    'label'   => esc_html__('Scrollbar', 'fancy-post-grid'),
                    'type'    => Controls_Manager::SELECT,
                    'default' => 'false',
                    'options' => [
                        'true' => esc_html__('Enable', 'fancy-post-grid'),
                        'false' => esc_html__('Disable', 'fancy-post-grid'),
                    ],
                    'separator' => 'before',
					'frontend_available' => true
                ]
            );
            $this->add_control(
                'slider_scrollbar_warning',
                [
                    'type'            => Controls_Manager::RAW_HTML,
                    'raw'             => __('The <strong>Scrollbar</strong> functionality may not operate as expected when the <strong>loop</strong>  feature is enabled.', 'fancy-post-grid'),
                    'content_classes' => 'fpg-panel-notice',
                    'condition' => [
                        'slider_loop' => 'true',
                        'slider_scrollbar' => 'true'
                    ]
                ]
            );
            $this->add_control(
                'slider_autoplay',
                [
                    'label'   => esc_html__('Autoplay', 'fancy-post-grid'),
                    'type'    => Controls_Manager::SELECT,
                    'default' => 'false',
                    'options' => [
                        'true' => esc_html__('Enable', 'fancy-post-grid'),
                        'false' => esc_html__('Disable', 'fancy-post-grid'),
                    ],
                    'separator' => 'before',
					'frontend_available' => true
                ]
            );
            $this->add_control(
                'slide_item_circle_progress',
                [
                    'label'   => esc_html__('Auto Play Progress', 'fancy-post-grid'),
                    'type'    => Controls_Manager::SELECT,
                    'default' => 'false',
                    'options' => [
                        'true' => esc_html__('Enable', 'fancy-post-grid'),
                        'false' => esc_html__('Disable', 'fancy-post-grid'),
                    ],
                    'condition' => [
                        'slider_autoplay' => 'true'
					],
					'frontend_available' => true
                ]
            );
            $this->add_control(
                'slider_stop_on_hover',
                [
                    'label'   => esc_html__('Stop on Hover', 'fancy-post-grid'),
                    'type'    => Controls_Manager::SELECT,
                    'default' => 'false',
                    'options' => [
                        'true' => esc_html__('Enable', 'fancy-post-grid'),
                        'false' => esc_html__('Disable', 'fancy-post-grid'),
                    ],
                    'condition' => [
                        'slider_autoplay' => 'true'
					],
					'frontend_available' => true
                ]
            );
            $this->add_control(
                'slider_interval',
                [
                    'label'   => esc_html__('Autoplay Interval', 'fancy-post-grid'),
                    'type'    => Controls_Manager::SELECT,
                    'default' => 3000,
                    'options' => [
                        '500' => esc_html__('500 ms', 'fancy-post-grid'),
                        '700' => esc_html__('700 ms', 'fancy-post-grid'),
                        '1000' => esc_html__('1000 ms', 'fancy-post-grid'),
                        '1500' => esc_html__('1500 ms', 'fancy-post-grid'),
                        '2000' => esc_html__('2000 ms', 'fancy-post-grid'),
                        '2500' => esc_html__('2500 ms', 'fancy-post-grid'),
                        '3000' => esc_html__('3000 ms', 'fancy-post-grid'),
                        '3500' => esc_html__('3500 ms', 'fancy-post-grid'),
                        '4000' => esc_html__('4000 ms', 'fancy-post-grid'),
                        '4500' => esc_html__('4500 ms', 'fancy-post-grid'),
                        '5000' => esc_html__('5000 ms', 'fancy-post-grid'),
                        '5500' => esc_html__('5500 ms', 'fancy-post-grid'),
                        '6000' => esc_html__('6000 ms', 'fancy-post-grid'),
                        '6500' => esc_html__('6500 ms', 'fancy-post-grid'),
                        '7000' => esc_html__('7000 ms', 'fancy-post-grid'),
                        '7500' => esc_html__('7500 ms', 'fancy-post-grid'),
                        '8000' => esc_html__('8000 ms', 'fancy-post-grid'),
                        '8500' => esc_html__('8500 ms', 'fancy-post-grid'),
                        '9000' => esc_html__('9000 ms', 'fancy-post-grid'),
                        '9500' => esc_html__('9500 ms', 'fancy-post-grid'),
                        '10000' => esc_html__('10000 ms', 'fancy-post-grid'),
                    ],
                    'condition' => [
                        'slider_autoplay' => 'true'
					],
					'frontend_available' => true
                ]
            );
            $this->add_control(
                'slider_loop',
                [
                    'label'   => esc_html__('Loop', 'fancy-post-grid'),
                    'type'    => Controls_Manager::SELECT,
                    'default' => 'true',
                    'options' => [
                        'true' => esc_html__('Enable', 'fancy-post-grid'),
                        'false' => esc_html__('Disable', 'fancy-post-grid'),
                    ],
                    'separator' => 'before',
					'frontend_available' => true
                ]
            );
            $this->add_control(
                'slider_auto_height',
                [
                    'label'   => esc_html__('Auto Height', 'fancy-post-grid'),
                    'type'    => Controls_Manager::SELECT,
                    'default' => 'false',
                    'options' => [
                        'true' => esc_html__('Enable', 'fancy-post-grid'),
                        'false' => esc_html__('Disable', 'fancy-post-grid'),
                    ],
                    'separator' => 'before',
					'frontend_available' => true
                ]
            );
            $this->add_control(
                'slider_free_mode',
                [
                    'label'   => esc_html__('Free Mode', 'fancy-post-grid'),
                    'type'    => Controls_Manager::SELECT,
                    'default' => 'false',
                    'options' => [
                        'true' => esc_html__('Enable', 'fancy-post-grid'),
                        'false' => esc_html__('Disable', 'fancy-post-grid'),
                    ],
                    'separator' => 'before',
					'frontend_available' => true
                ]
            );
            $this->add_control(
                'slider_grab_cursor',
                [
                    'label'   => esc_html__('Grab Cursor', 'fancy-post-grid'),
                    'type'    => Controls_Manager::SELECT,
                    'default' => 'false',
                    'options' => [
                        'true' => esc_html__('Enable', 'fancy-post-grid'),
                        'false' => esc_html__('Disable', 'fancy-post-grid'),
                    ],
                    'separator' => 'before',
					'frontend_available' => true
                ]
            );
            $this->add_control(
                'slider_mousewheel',
                [
                    'label'   => esc_html__('Mousewheel', 'fancy-post-grid'),
                    'type'    => Controls_Manager::SELECT,
                    'default' => 'false',
                    'options' => [
                        'true' => esc_html__('Enable', 'fancy-post-grid'),
                        'false' => esc_html__('Disable', 'fancy-post-grid'),
                    ],
                    'separator' => 'before',
					'frontend_available' => true
                ]
            );
            $this->add_control(
                'slider_keyboard_control',
                [
                    'label'   => esc_html__('Keyboard Control', 'fancy-post-grid'),
                    'type'    => Controls_Manager::SELECT,
                    'default' => 'false',
                    'options' => [
                        'true' => esc_html__('Enable', 'fancy-post-grid'),
                        'false' => esc_html__('Disable', 'fancy-post-grid'),
                    ],
                    'separator' => 'before',
					'frontend_available' => true
                ]
            );
            $this->add_control(
                'slider_center_mode',
                [
                    'label'   => esc_html__('Center Mode', 'fancy-post-grid'),
                    'type'    => Controls_Manager::SELECT,
                    'default' => 'false',
                    'options' => [
                        'true' => esc_html__('Enable', 'fancy-post-grid'),
                        'false' => esc_html__('Disable', 'fancy-post-grid'),
                    ],
                    'separator' => 'before',
					'frontend_available' => true
                ]
            );
            $this->add_control(
                'slider_slider_center_mode_warning',
                [
                    'type'            => Controls_Manager::RAW_HTML,
                    'raw'             => __("If <strong>center mode</strong> doesn't work as expected, enable the <strong>loop</strong> feature and ensure there are <strong>enough items</strong> to center one properly.", 'fancy-post-grid'),
                    'content_classes' => 'fpg-panel-notice',
                    'condition' => [
                        'slider_center_mode' => 'true'
                    ]
                ]
            );
            $this->add_responsive_control(
                'slider_vertical_height',
                [
                    'label' => esc_html__( 'Vertical Height', 'fancy-post-grid' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%', 'custom' ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 2000,
                        ],
                        '%' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 400,
                    ],
                    'separator' => 'before',
                    'selectors' => [
                        '{{WRAPPER}} .fpg-unique-slider .swiper.swiper-vertical' => 'height: {{SIZE}}{{UNIT}} !important;',
                    ],
					'condition' => [
						'sl_vertical' => 'vertical'
					]
                ]
            );
            $this->add_control(
                'swiper_item_wrapper_padding',
                [
                    'label' => esc_html__( 'Swiper Wrapper Padding', 'fancy-post-grid' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'custom' ],
                    'selectors' => [
                        '{{WRAPPER}} .fpg-unique-slider .swiper .swiper-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' => 'before',
                ]
            );
		$this->end_controls_section();
	}

	protected function fpg_sl_nav_style_control() {
		// Arrow Section
		$this->start_controls_section(
			'section_slider_style_arrow_control',
			[
				'label' => esc_html__('Arrow Control', 'fancy-post-grid'),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'slider_nav' => 'true'
				]
			]
		);
            // positioning start
            $this->add_control(
                'arrow_position_maker',
                [
                    'label' => esc_html__('Arrow Position Style', 'fancy-post-grid'),
                    'type' => Controls_Manager::SELECT,
                    'default' => '',
                    'options' => [
                        '' => esc_html__('Default', 'fancy-post-grid'),
                        'custom' => esc_html__('Custom', 'fancy-post-grid'),
                    ],
                    'condition' => [
                        'slider_nav_style!' => '2'
                    ]
                ]
            );
            $this->add_responsive_control(
                'arrow_prev_x_select',
                [
                    'label' => esc_html__('Prev Position X', 'fancy-post-grid'),
                    'type' => Controls_Manager::SELECT,
                    'default' => '',
                    'options' => [
                        '' => esc_html__('Default', 'fancy-post-grid'),
                        'left' => esc_html__('Left', 'fancy-post-grid'),
                        'right' => esc_html__('Right', 'fancy-post-grid'),
                    ],
                    'condition' => [
                        'arrow_position_maker' => 'custom'
                    ]
                ]
            );
            $this->add_responsive_control(
                'arrow_prev_left_position',
                [
                    'label' => esc_html__('Prev Left Position', 'fancy-post-grid'),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => ['px', '%', 'custom'],
                    'range' => [
                        'px' => [
                            'min' => -1000,
                            'max' => 1000,
                        ],
                        '%' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .fpg-unique-slider .swiper-button-prev' => 'left: {{SIZE}}{{UNIT}}; right: unset;',
                    ],
                    'condition' => [
                        'arrow_prev_x_select' => 'left',
                        'arrow_position_maker' => 'custom'
                    ]
                ]
            );
            $this->add_responsive_control(
                'arrow_prev_right_position',
                [
                    'label' => esc_html__('Prev Right Position', 'fancy-post-grid'),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => ['px', '%', 'custom'],
                    'range' => [
                        'px' => [
                            'min' => -1000,
                            'max' => 1000,
                        ],
                        '%' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .fpg-unique-slider .swiper-button-prev' => 'right: {{SIZE}}{{UNIT}}; left: unset;',
                    ],
                    'condition' => [
                        'arrow_prev_x_select' => 'right',
                        'arrow_position_maker' => 'custom'
                    ]
                ]
            );

            $this->add_responsive_control(
                'arrow_prev_y_select',
                [
                    'label' => esc_html__('Prev Position Y', 'fancy-post-grid'),
                    'type' => Controls_Manager::SELECT,
                    'default' => '',
                    'options' => [
                        '' => esc_html__('Default', 'fancy-post-grid'),
                        'top' => esc_html__('Top', 'fancy-post-grid'),
                        'bottom' => esc_html__('Bottom', 'fancy-post-grid'),
                    ],
                    'condition' => [
                        'arrow_position_maker' => 'custom'
                    ]
                ]
            );
            $this->add_responsive_control(
                'arrow_prev_top_position',
                [
                    'label' => esc_html__('Prev Top Position', 'fancy-post-grid'),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => ['px', '%', 'custom'],
                    'range' => [
                        'px' => [
                            'min' => -1000,
                            'max' => 1000,
                        ],
                        '%' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .fpg-unique-slider .swiper-button-prev' => 'top: {{SIZE}}{{UNIT}}; bottom: unset;',
                    ],
                    'condition' => [
                        'arrow_prev_y_select' => 'top',
                        'arrow_position_maker' => 'custom'
                    ]
                ]
            );
            $this->add_responsive_control(
                'arrow_prev_bottom_position',
                [
                    'label' => esc_html__('Prev Bottom Position', 'fancy-post-grid'),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => ['px', '%', 'custom'],
                    'range' => [
                        'px' => [
                            'min' => -1000,
                            'max' => 1000,
                        ],
                        '%' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .fpg-unique-slider .swiper-button-prev' => 'bottom: {{SIZE}}{{UNIT}}; top: unset;',
                    ],
                    'condition' => [
                        'arrow_prev_y_select' => 'bottom',
                        'arrow_position_maker' => 'custom'
                    ]
                ]
            );

            $this->add_responsive_control(
                'arrow_next_x_select',
                [
                    'label' => esc_html__('Next Position X', 'fancy-post-grid'),
                    'type' => Controls_Manager::SELECT,
                    'default' => '',
                    'options' => [
                        '' => esc_html__('Default', 'fancy-post-grid'),
                        'left' => esc_html__('Left', 'fancy-post-grid'),
                        'right' => esc_html__('Right', 'fancy-post-grid'),
                    ],
                    'condition' => [
                        'arrow_position_maker' => 'custom'
                    ]
                ]
            );
            $this->add_responsive_control(
                'arrow_next_left_position',
                [
                    'label' => esc_html__('Next Left Position', 'fancy-post-grid'),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => ['px', '%', 'custom'],
                    'range' => [
                        'px' => [
                            'min' => -1000,
                            'max' => 1000,
                        ],
                        '%' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .fpg-unique-slider .swiper-button-next' => 'left: {{SIZE}}{{UNIT}}; right: unset;',
                    ],
                    'condition' => [
                        'arrow_next_x_select' => 'left',
                        'arrow_position_maker' => 'custom'
                    ]
                ]
            );
            $this->add_responsive_control(
                'arrow_next_right_position',
                [
                    'label' => esc_html__('Next Right Position', 'fancy-post-grid'),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => ['px', '%', 'custom'],
                    'range' => [
                        'px' => [
                            'min' => -1000,
                            'max' => 1000,
                        ],
                        '%' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .fpg-unique-slider .swiper-button-next' => 'right: {{SIZE}}{{UNIT}}; left: unset;',
                    ],
                    'condition' => [
                        'arrow_next_x_select' => 'right',
                        'arrow_position_maker' => 'custom'
                    ]
                ]
            );

            $this->add_responsive_control(
                'arrow_next_y_select',
                [
                    'label' => esc_html__('Next Position Y', 'fancy-post-grid'),
                    'type' => Controls_Manager::SELECT,
                    'default' => '',
                    'options' => [
                        '' => esc_html__('Default', 'fancy-post-grid'),
                        'top' => esc_html__('Top', 'fancy-post-grid'),
                        'bottom' => esc_html__('Bottom', 'fancy-post-grid'),
                    ],
                    'condition' => [
                        'arrow_position_maker' => 'custom'
                    ]
                ]
            );
            $this->add_responsive_control(
                'arrow_next_top_position',
                [
                    'label' => esc_html__('Next Top Position', 'fancy-post-grid'),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => ['px', '%', 'custom'],
                    'range' => [
                        'px' => [
                            'min' => -1000,
                            'max' => 1000,
                        ],
                        '%' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .fpg-unique-slider .swiper-button-next' => 'top: {{SIZE}}{{UNIT}}; bottom: unset;',
                    ],
                    'condition' => [
                        'arrow_next_y_select' => 'top',
                        'arrow_position_maker' => 'custom'
                    ]
                ]
            );
            $this->add_responsive_control(
                'arrow_next_bottom_position',
                [
                    'label' => esc_html__('Next Bottom Position', 'fancy-post-grid'),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => ['px', '%', 'custom'],
                    'range' => [
                        'px' => [
                            'min' => -1000,
                            'max' => 1000,
                        ],
                        '%' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .fpg-unique-slider .swiper-button-next' => 'bottom: {{SIZE}}{{UNIT}}; top: unset;',
                    ],
                    'condition' => [
                        'arrow_next_y_select' => 'bottom',
                        'arrow_position_maker' => 'custom'
                    ]
                ]
            );

            // Style 3 Wrapper Position
            $this->add_control(
                'arrow_wrapper_control_heading',
                [
                    'label' => esc_html__( 'Arrow Wrapper Options', 'fancy-post-grid' ),
                    'type' => Controls_Manager::HEADING,
                    'classes' => 'fpg-control-type-heading',
                    'condition' => [
                        'slider_nav_style' => '2'
                    ]
                ]
            );
            $this->add_responsive_control(
                'arrow_wrapper_text_align',
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
                    'condition' => [
                        'slider_nav_style' => '2'
                    ],
                    'toggle' => true,
                    'selectors' => [
                        '{{WRAPPER}} .fpg-unique-slider.nav-style-2' => 'text-align: {{VALUE}};',
                    ],
                ]
            );
            $this->add_responsive_control(
				'arrow_wrapper_column_align',
				[
					'label' => esc_html__( 'Button Direction', 'fancy-post-grid' ),
					'type' => Controls_Manager::CHOOSE,
					'options' => [
						'row' => [
							'title' => esc_html__( 'Row', 'fancy-post-grid' ),
							'icon' => 'eicon-justify-start-h',
						],
						'row-reverse' => [
							'title' => esc_html__( 'Row Reverse', 'fancy-post-grid' ),
							'icon' => 'eicon-wrap',
						],
						'column' => [
							'title' => esc_html__( 'Column', 'fancy-post-grid' ),
							'icon' => 'eicon-justify-start-v',
						],
						'column-reverse' => [
							'title' => esc_html__( 'Column Reverse', 'fancy-post-grid' ),
							'icon' => 'eicon-wrap',
						],
					],
					'toggle' => true,
                    'condition' => [
                        'slider_nav_style' => '2'
                    ],
					'selectors' => [
						'{{WRAPPER}} .fpg-unique-slider .swiper-btn-wrapper' => 'flex-direction: {{VALUE}};',
					],
				]
			);
            $this->add_responsive_control(
                'arrow_wrapper_gap_between',
                [
                    'label' => esc_html__( 'Space Between', 'fancy-post-grid' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%', 'custom' ],
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
                        '{{WRAPPER}} .fpg-unique-slider .swiper-btn-wrapper' => 'gap: {{SIZE}}{{UNIT}};',
                    ],
                    'condition' => [
                        'slider_nav_style' => '2'
                    ],
                ]
            );
            $this->add_control(
                'arrow_wrapper_position_maker',
                [
                    'label' => esc_html__('Position', 'fancy-post-grid'),
                    'type' => Controls_Manager::SELECT,
                    'default' => '',
                    'options' => [
                        '' => esc_html__('Default', 'fancy-post-grid'),
                        'absolute' => esc_html__('Absolute', 'fancy-post-grid'),
                        'relative' => esc_html__('Relative', 'fancy-post-grid'),
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .fpg-unique-slider .swiper-btn-wrapper' => 'position: {{VALUE}};',
                    ],
                    'condition' => [
                        'slider_nav_style' => '2'
                    ]
                ]
            );
            $this->add_responsive_control(
                'arrow_wrapper_top_position',
                [
                    'label' => esc_html__('Top Position', 'fancy-post-grid'),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => ['px', '%', 'custom'],
                    'range' => [
                        'px' => [
                            'min' => -1000,
                            'max' => 1000,
                        ],
                        '%' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 10,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .fpg-unique-slider .swiper-btn-wrapper' => 'top: {{SIZE}}{{UNIT}};',
                    ],
                    'condition' => [
                        'arrow_wrapper_position_maker' => ['absolute', 'relative']
                    ]
                ]
            );
            $this->add_responsive_control(
                'arrow_wrapper_right_position',
                [
                    'label' => esc_html__('Right Position', 'fancy-post-grid'),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => ['px', '%', 'custom'],
                    'range' => [
                        'px' => [
                            'min' => -1000,
                            'max' => 1000,
                        ],
                        '%' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 10,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .fpg-unique-slider .swiper-btn-wrapper' => 'right: {{SIZE}}{{UNIT}};',
                    ],
                    'condition' => [
                        'arrow_wrapper_position_maker' => ['absolute', 'relative']
                    ]
                ]
            );
            $this->add_responsive_control(
                'arrow_wrapper_bottom_position',
                [
                    'label' => esc_html__('Bottom Position', 'fancy-post-grid'),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => ['px', '%', 'custom'],
                    'range' => [
                        'px' => [
                            'min' => -1000,
                            'max' => 1000,
                        ],
                        '%' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .fpg-unique-slider .swiper-btn-wrapper' => 'bottom: {{SIZE}}{{UNIT}};',
                    ],
                    'condition' => [
                        'arrow_wrapper_position_maker' => ['absolute', 'relative']
                    ]
                ]
            );
            $this->add_responsive_control(
                'arrow_wrapper_left_position',
                [
                    'label' => esc_html__('Left Position', 'fancy-post-grid'),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => ['px', '%', 'custom'],
                    'range' => [
                        'px' => [
                            'min' => -1000,
                            'max' => 1000,
                        ],
                        '%' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .fpg-unique-slider .swiper-btn-wrapper' => 'left: {{SIZE}}{{UNIT}};',
                    ],
                    'condition' => [
                        'arrow_wrapper_position_maker' => ['absolute', 'relative']
                    ]
                ]
            );
            // positioning end
            $this->add_responsive_control(
                'arrow_wrapper_padding',
                [
                    'label' => esc_html__( 'Padding', 'fancy-post-grid' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'custom' ],
                    'condition' => [
                        'slider_nav_style' => '2'
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .fpg-unique-slider .swiper-btn-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'arrow_wrapper_margin',
                [
                    'label' => esc_html__( 'Margin', 'fancy-post-grid' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'custom' ],
                    'condition' => [
                        'slider_nav_style' => '2'
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .fpg-unique-slider .swiper-btn-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'arrow_wrapper_radius',
                [
                    'label' => esc_html__( 'Border Radius', 'fancy-post-grid' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'custom' ],
                    'condition' => [
                        'slider_nav_style' => '2'
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .fpg-unique-slider .swiper-btn-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => 'arrow_wrapper_background',
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .fpg-unique-slider .swiper-btn-wrapper',
                    'condition' => [
                        'slider_nav_style' => '2'
                    ],
                ]
            );
            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'arrow_wrapper_border',
                    'selector' => '{{WRAPPER}} .fpg-unique-slider .swiper-btn-wrapper',
                    'condition' => [
                        'slider_nav_style' => '2'
                    ],
                ]
            );
            $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'arrow_wrapper_box_shadow',
                    'selector' => '{{WRAPPER}} .fpg-unique-slider .swiper-btn-wrapper',
                    'condition' => [
                        'slider_nav_style' => '2'
                    ],
                ]
            );

            $this->add_control(
                'arrow_after_hr',
                [
                    'type' => \Elementor\Controls_Manager::DIVIDER,
                ]
            );

            $this->add_responsive_control(
                'navigation_arrow_width',
                [
                    'label' => esc_html__('Arrow Width', 'fancy-post-grid'),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => ['px', '%', 'custom'],
                    'selectors' => [
                        '{{WRAPPER}} .fpg-unique-slider .swiper-button-prev,
                        {{WRAPPER}} .fpg-unique-slider .swiper-button-next' => 'width: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'navigation_arrow_height',
                [
                    'label' => esc_html__('Arrow Height', 'fancy-post-grid'),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => ['px', '%', 'custom'],
                    'selectors' => [
                        '{{WRAPPER}} .fpg-unique-slider .swiper-button-prev,
                        {{WRAPPER}} .fpg-unique-slider .swiper-button-next' => 'height: {{SIZE}}{{UNIT}}; line-height: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'navigation_arrow_line_height',
                [
                    'label' => esc_html__('Arrow Line Height', 'fancy-post-grid'),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => ['px', '%', 'custom'],
                    'selectors' => [
                        '{{WRAPPER}} .fpg-unique-slider .swiper-button-prev,
                        {{WRAPPER}} .fpg-unique-slider .swiper-button-next' => 'line-height: {{SIZE}}{{UNIT}} !important;',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'nav_icon_typography',
                    'label' => esc_html__('Icon Typography', 'fancy-post-grid'),
                    'selector' => '
                        {{WRAPPER}} .fpg-unique-slider .swiper-button-prev::after,
                        {{WRAPPER}} .fpg-unique-slider .swiper-button-next::after
                    ',
                ]
            );

            $this->add_control(
                'arrow_border_radius_',
                [
                    'label' => esc_html__('Border Radius', 'fancy-post-grid'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%', 'custom'],
                    'selectors' => [
                        '{{WRAPPER}} .fpg-unique-slider .swiper-button-prev,
                        {{WRAPPER}} .fpg-unique-slider .swiper-button-next' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_control(
                'next_arrow_border_radius_',
                [
                    'label' => esc_html__('Next Arrow Border Radius', 'fancy-post-grid'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%', 'custom'],
                    'selectors' => [
                        '{{WRAPPER}} .fpg-unique-slider .swiper-button-next' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                    ],
                ]
            );
            $this->add_control(
                'arrow_border_padding_',
                [
                    'label' => esc_html__('Padding', 'fancy-post-grid'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%', 'custom'],
                    'selectors' => [
                        '{{WRAPPER}} .fpg-unique-slider .swiper-button-prev,
                        {{WRAPPER}} .fpg-unique-slider .swiper-button-next' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            // Arrow Hover Normal Tab Start
            $this->start_controls_tabs('_tabs_slider_arrow');
                // Normal Bullet Start
                $this->start_controls_tab(
                    'slider_arrow_normal_tab',
                    [
                        'label' => esc_html__('Normal', 'fancy-post-grid'),
                    ]
                );
                    $this->add_control(
                        'navigation_arrow_color',
                        [
                            'label' => esc_html__('Icon Color', 'fancy-post-grid'),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .fpg-unique-slider .swiper-button-prev::after,
                                {{WRAPPER}} .fpg-unique-slider .swiper-button-next::after' => 'color: {{VALUE}};',
                            ],
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name' => 'navigation_arrow_background',
                            'types' => ['classic', 'gradient'],
                            'selector' => '
                                {{WRAPPER}} .fpg-unique-slider .swiper-button-prev,
                                {{WRAPPER}} .fpg-unique-slider .swiper-button-next
                            ',
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name' => 'nav_arrow_border',
                            'selector' => '
                                {{WRAPPER}} .fpg-unique-slider .swiper-button-prev,
                                {{WRAPPER}} .fpg-unique-slider .swiper-button-next
                            ',
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Box_Shadow::get_type(),
                        [
                            'name' => 'arrow_shadow_custom',
                            'selector' => '
                                {{WRAPPER}} .fpg-unique-slider .swiper-button-prev,
                                {{WRAPPER}} .fpg-unique-slider .swiper-button-next
                            ',
                        ]
                    );
                    $this->add_responsive_control(
                        'arrow_opacity',
                        [
                            'label' => esc_html__('Opacity', 'fancy-post-grid'),
                            'type' => Controls_Manager::SLIDER,
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 1,
                                    'step' => 0.1,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .fpg-unique-slider .swiper-button-prev,
                                {{WRAPPER}} .fpg-unique-slider .swiper-button-next' => 'opacity: {{SIZE}}',
                            ]
                        ]
                    );
                $this->end_controls_tab();

                // Hover Bullet Start
                $this->start_controls_tab(
                    'slider_arrow_hover_tab',
                    [
                        'label' => esc_html__('Hover', 'fancy-post-grid'),
                    ]
                );
                    $this->add_control(
                        'navigation_arrow_color_hover',
                        [
                            'label' => esc_html__('Icon Color', 'fancy-post-grid'),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .fpg-unique-slider .swiper-button-prev:hover::after,
                                {{WRAPPER}} .fpg-unique-slider .swiper-button-next:hover::after' => 'color: {{VALUE}};',
                            ],
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name' => 'navigation_arrow_background_hover',
                            'types' => ['classic', 'gradient'],
                            'selector' => '
                                {{WRAPPER}} .fpg-unique-slider .swiper-button-prev:hover,
                                {{WRAPPER}} .fpg-unique-slider .swiper-button-next:hover
                            ',
                        ]
                    );
                    $this->add_control(
                        'nav_arrow_border_hover',
                        [
                            'label' => esc_html__('Border Color', 'fancy-post-grid'),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .fpg-unique-slider .swiper-button-prev:hover,
                                {{WRAPPER}} .fpg-unique-slider .swiper-button-next:hover' => 'border-color: {{VALUE}};',
                            ],
                        ]
                    );
                    $this->add_responsive_control(
                        'arrow_opacity_hover',
                        [
                            'label' => esc_html__('Opacity', 'fancy-post-grid'),
                            'type' => Controls_Manager::SLIDER,
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 1,
                                    'step' => 0.1,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .fpg-unique-slider:hover .swiper-button-prev,
                                {{WRAPPER}} .fpg-unique-slider:hover .swiper-button-next' => 'opacity: {{SIZE}}',
                            ]
                        ]
                    );
                $this->end_controls_tab();
            $this->end_controls_tabs();
            // Arrow Hover Normal Tab End
		$this->end_controls_section();

		// Bullet Style
		$this->start_controls_section(
			'section_slider_style_dots_control',
			[
				'label' => esc_html__('Bullets Control', 'fancy-post-grid'),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'slider_dots' => 'true',
                    'slider_bullet_type!' => ['progressbar', 'fraction']
				]
			]
		);
            $this->add_responsive_control(
                'dots_alignments',
                [
                    'label' => esc_html__('Alignment', 'fancy-post-grid'),
                    'type' => Controls_Manager::CHOOSE,
                    'options' => [
                        'left' => [
                            'title' => esc_html__('Left', 'fancy-post-grid'),
                            'icon' => 'eicon-text-align-left',
                        ],
                        'center' => [
                            'title' => esc_html__('Center', 'fancy-post-grid'),
                            'icon' => 'eicon-text-align-center',
                        ],
                        'right' => [
                            'title' => esc_html__('Right', 'fancy-post-grid'),
                            'icon' => 'eicon-text-align-right',
                        ],
                        'justify' => [
                            'title' => esc_html__('Justify', 'fancy-post-grid'),
                            'icon' => 'eicon-text-align-justify',
                        ],
                    ],
                    'toggle' => true,
                    'selectors' => [
                        '{{WRAPPER}} .fpg-unique-slider .swiper-pagination' => 'text-align: {{VALUE}}'
                    ],
                ]
            );
            $this->add_control(
                'bullet_wrapper_box_style',
                [
                    'label' => esc_html__('Dots Wrapper Box', 'fancy-post-grid'),
                    'type' => Controls_Manager::HEADING,
                    'classes' => 'fpg-control-type-heading',
                ]
            );
            $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => 'bullet_wrapper_box_bg',
                    'types' => ['classic', 'gradient'],
                    'selector' => '{{WRAPPER}} .fpg-unique-slider .swiper-pagination',
                ]
            );
            $this->add_responsive_control(
                'bullet_wrapper_box_padding',
                [
                    'label' => esc_html__('Padding', 'fancy-post-grid'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%', 'custom'],
                    'selectors' => [
                        '{{WRAPPER}} .fpg-unique-slider .swiper-pagination' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'bullet_wrapper_box_margin',
                [
                    'label' => esc_html__('Margin', 'fancy-post-grid'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%', 'custom'],
                    'selectors' => [
                        '{{WRAPPER}} .fpg-unique-slider .swiper-pagination .swiper-pagination-bullet' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'bullet_wrapper_box_radius',
                [
                    'label' => esc_html__('Border Radius', 'fancy-post-grid'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%', 'custom'],
                    'selectors' => [
                        '{{WRAPPER}} .fpg-unique-slider .swiper-pagination .swiper-pagination-bullet' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'bullet_wrapper_width',
                [
                    'label' => esc_html__( 'Wrapper Width', 'fancy-post-grid' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%', 'custom' ],
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
                        '{{WRAPPER}} .fpg-unique-slider .swiper-pagination' => 'width: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_control(
                '_hr',
                [
                    'type' => Controls_Manager::DIVIDER,
                    'style' => 'thick',
                ]
            );
            $this->add_control(
                'bullet_item_options',
                [
                    'label' => esc_html__('Bullet Item Style', 'fancy-post-grid'),
                    'type' => Controls_Manager::HEADING,
                    'classes' => 'fpg-control-type-heading',
                ]
            );
            $this->start_controls_tabs('_tabs_slider_dots');
                // Normal Bullet Start
                $this->start_controls_tab(
                    'slider_dots_normal_tab',
                    [
                        'label' => esc_html__('Normal', 'fancy-post-grid'),
                    ]
                );
                    $this->add_control(
                        'navigation_dot_inner_color',
                        [
                            'label' => esc_html__('Inner Dot Color', 'fancy-post-grid'),
                            'type' => Controls_Manager::COLOR,
                            'condition' => [
                                'slider_dots_style' => '2',
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .fpg-unique-slider .swiper-pagination .swiper-pagination-bullet:after' => 'background: {{VALUE}}',
                            ],
                        ]
                    );
                    $this->add_responsive_control(
                        'bullet_inner_dot_height_custom',
                        [
                            'label' => esc_html__('Inner Dot Height', 'fancy-post-grid'),
                            'type' => Controls_Manager::SLIDER,
                            'size_units' => ['px', '%', 'custom'],
                            'selectors' => [
                                '{{WRAPPER}} .fpg-unique-slider .swiper-pagination .swiper-pagination-bullet:after' => 'height: {{SIZE}}{{UNIT}};',
                            ],
                            'condition' => [
                                'slider_dots_style' => '2',
                            ],
                        ]
                    );
                    $this->add_responsive_control(
                        'bullet_inner_dot_normal_width_custom',
                        [
                            'label' => esc_html__('Inner Dot Width', 'fancy-post-grid'),
                            'type' => Controls_Manager::SLIDER,
                            'size_units' => ['px', '%', 'custom'],
                            'selectors' => [
                                '{{WRAPPER}} .fpg-unique-slider .swiper-pagination .swiper-pagination-bullet:after' => 'width: {{SIZE}}{{UNIT}};',
                            ],
                            'condition' => [
                                'slider_dots_style' => '2',
                            ],
                        ]
                    );
                    $this->add_responsive_control(
                        'bullet_inner_dot_border_radius',
                        [
                            'label' => esc_html__('Inner Dot Radius', 'fancy-post-grid'),
                            'type' => Controls_Manager::SLIDER,
                            'size_units' => ['px', '%', 'custom'],
                            'selectors' => [
                                '{{WRAPPER}} .fpg-unique-slider .swiper-pagination .swiper-pagination-bullet:after' => 'border-radius: {{SIZE}}{{UNIT}};',
                            ],
                            'condition' => [
                                'slider_dots_style' => '2',
                            ],
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name'     => 'navigation_dot_icon_background',
                            'selector' => '{{WRAPPER}} .fpg-unique-slider .swiper-pagination .swiper-pagination-bullet',
                        ]
                    );
                    $this->add_responsive_control(
                        'bullet_height_custom',
                        [
                            'label' => esc_html__('Bullet Height', 'fancy-post-grid'),
                            'type' => Controls_Manager::SLIDER,
                            'size_units' => ['px', '%', 'custom'],
                            'selectors' => [
                                '{{WRAPPER}} .fpg-unique-slider .swiper-pagination .swiper-pagination-bullet' => 'height: {{SIZE}}{{UNIT}};',
                            ],
                        ]
                    );
                    $this->add_responsive_control(
                        'bullet_normal_width_custom',
                        [
                            'label' => esc_html__('Bullet Width', 'fancy-post-grid'),
                            'type' => Controls_Manager::SLIDER,
                            'size_units' => ['px', '%', 'custom'],
                            'selectors' => [
                                '{{WRAPPER}} .fpg-unique-slider .swiper-pagination .swiper-pagination-bullet' => 'width: {{SIZE}}{{UNIT}};',
                            ],
                        ]
                    );
                    $this->add_control(
                        'bullet_border_radius_custom',
                        [
                            'label' => esc_html__('Border Radius', 'fancy-post-grid'),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => ['px', '%', 'custom'],
                            'selectors' => [
                                '{{WRAPPER}} .fpg-unique-slider .swiper-pagination .swiper-pagination-bullet' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name' => 'bullet_border_custom',
                            'selector' => '{{WRAPPER}} .fpg-unique-slider .swiper-pagination .swiper-pagination-bullet',
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Box_Shadow::get_type(),
                        [
                            'name' => 'bullet_shadow_custom',
                            'selector' => '{{WRAPPER}} .fpg-unique-slider .swiper-pagination .swiper-pagination-bullet'
                        ]
                    );
                $this->end_controls_tab();
                // Normal Bullet End

                // Active Bullet Start
                $this->start_controls_tab(
                    'slider_dots_active_tab',
                    [
                        'label' => esc_html__('Active', 'fancy-post-grid'),
                    ]
                );
                    $this->add_control(
                        'navigation_dot_inner_color_active',
                        [
                            'label' => esc_html__('Inner Dot Color', 'fancy-post-grid'),
                            'type' => Controls_Manager::COLOR,
                            'condition' => [
                                'slider_dots_style' => '2',
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .fpg-unique-slider .swiper-pagination .swiper-pagination-bullet:hover:after,
                                {{WRAPPER}} .fpg-unique-slider .swiper-pagination .swiper-pagination-bullet.swiper-pagination-bullet-active:after' => 'background: {{VALUE}}',
                            ],
                        ]
                    );
                    $this->add_responsive_control(
                        'bullet_inner_dot_height_custom_active',
                        [
                            'label' => esc_html__('Inner Dot Height', 'fancy-post-grid'),
                            'type' => Controls_Manager::SLIDER,
                            'size_units' => ['px', '%', 'custom'],
                            'selectors' => [
                                '{{WRAPPER}} .fpg-unique-slider .swiper-pagination .swiper-pagination-bullet:hover:after,
                                {{WRAPPER}} .fpg-unique-slider .swiper-pagination .swiper-pagination-bullet:after' => 'height: {{SIZE}}{{UNIT}};',
                            ],
                            'condition' => [
                                'slider_dots_style' => '2',
                            ],
                        ]
                    );
                    $this->add_responsive_control(
                        'bullet_inner_dot_active_width_custom',
                        [
                            'label' => esc_html__('Inner Dot Width', 'fancy-post-grid'),
                            'type' => Controls_Manager::SLIDER,
                            'size_units' => ['px', '%', 'custom'],
                            'selectors' => [
                                '{{WRAPPER}} .fpg-unique-slider .swiper-pagination .swiper-pagination-bullet:hover:after,
                                {{WRAPPER}} .fpg-unique-slider .swiper-pagination .swiper-pagination-bullet:after' => 'width: {{SIZE}}{{UNIT}};',
                            ],
                            'condition' => [
                                'slider_dots_style' => '2',
                            ],
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name'     => 'navigation_dot_icon_background_active',
                            'selector' => '{{WRAPPER}} .fpg-unique-slider .swiper-pagination .swiper-pagination-bullet:hover, {{WRAPPER}} .fpg-unique-slider .swiper-pagination .swiper-pagination-bullet.swiper-pagination-bullet-active',
                        ]
                    );
                    $this->add_responsive_control(
                        'bullet_active_width_custom',
                        [
                            'label' => esc_html__('Bullet Width', 'fancy-post-grid'),
                            'type' => Controls_Manager::SLIDER,
                            'size_units' => ['px', '%', 'custom'],
                            'selectors' => [
                                '{{WRAPPER}} .fpg-unique-slider .swiper-pagination .swiper-pagination-bullet.swiper-pagination-bullet-active' => 'width: {{SIZE}}{{UNIT}};',
                            ],
                        ]
                    );
                    $this->add_responsive_control(
                        'bullet_active_height_custom',
                        [
                            'label' => esc_html__('Bullet Height', 'fancy-post-grid'),
                            'type' => Controls_Manager::SLIDER,
                            'size_units' => ['px', '%', 'custom'],
                            'selectors' => [
                                '{{WRAPPER}} .fpg-unique-slider .swiper-pagination .swiper-pagination-bullet.swiper-pagination-bullet-active' => 'height: {{SIZE}}{{UNIT}};',
                            ],
                        ]
                    );
                    $this->add_responsive_control(
                        'bullet_active_scale_custom',
                        [
                            'label' => esc_html__('Bullet Scale', 'fancy-post-grid'),
                            'type' => Controls_Manager::SLIDER,
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 1000,
                                    'step' => 0.1,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .fpg-unique-slider .swiper-pagination .swiper-pagination-bullet.swiper-pagination-bullet-active' => 'transform: scale({{SIZE}})',
                            ],
                        ]
                    );
                    $this->add_control(
                        'navigation_dot_active_border_color',
                        [
                            'label' => esc_html__('Border Color', 'fancy-post-grid'),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .fpg-unique-slider .swiper-pagination .swiper-pagination-bullet:hover' => 'border-color: {{VALUE}};',
                                '{{WRAPPER}} .fpg-unique-slider .swiper-pagination .swiper-pagination-bullet.swiper-pagination-bullet-active' => 'border-color: {{VALUE}};',

                            ],
                        ]
                    );
                $this->end_controls_tab();
            $this->end_controls_tabs();
            // Active Bullet End
            $this->add_responsive_control(
                'bullet_spacing_custom_position',
                [
                    'label' => esc_html__('Top Position', 'fancy-post-grid'),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => ['px', '%', 'custom'],
                    'show_label' => true,
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
                    'separator' => 'before',
                    'selectors' => [
                        '{{WRAPPER}} .fpg-unique-slider .swiper-pagination' => 'top: {{SIZE}}{{UNIT}} !important; bottom: unset !important;',
                    ],
                ]
            );
            $this->add_responsive_control(
                'bullet_spacing_custom_position_bottom',
                [
                    'label' => esc_html__('Bottom Position', 'fancy-post-grid'),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => ['px', '%', 'custom'],
                    'show_label' => true,
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
                        'size' => 0,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .fpg-unique-slider .swiper-pagination' => 'bottom: {{SIZE}}{{UNIT}} !important; top: unset !important;',
                    ],
                ]
            );
		$this->end_controls_section();

        // Progress Pagination
		$this->start_controls_section(
			'section_slider_style_dots_progress',
			[
				'label' => esc_html__('Bullet Progress Control', 'fancy-post-grid'),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'slider_dots' => 'true',
                    'slider_bullet_type' => 'progressbar'
				]
			]
		);
            $this->add_control(
                'dots_progress_control_heading',
                [
                    'label' => esc_html__( 'Progress Options', 'fancy-post-grid' ),
                    'type' => Controls_Manager::HEADING,
                    'classes' => 'fpg-control-type-heading',
                ]
            );
            $this->add_responsive_control(
                'dots_progress_width',
                [
                    'label' => esc_html__( 'Width', 'fancy-post-grid' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%', 'custom' ],
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
                        '{{WRAPPER}} .fpg-unique-slider .swiper-pagination' => 'width: {{SIZE}}{{UNIT}} !important;',
                    ],
                ]
            );
            $this->add_responsive_control(
                'dots_progress_height',
                [
                    'label' => esc_html__( 'Height', 'fancy-post-grid' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%', 'custom' ],
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
                        '{{WRAPPER}} .fpg-unique-slider .swiper-pagination' => 'height: {{SIZE}}{{UNIT}} !important;',
                    ],
                ]
            );
            $this->add_control(
                'dots_progress_track_color',
                [
                    'label' => esc_html__( 'Track Background Color', 'fancy-post-grid' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .fpg-unique-slider .swiper-pagination' => 'background-color: {{VALUE}}',
                    ],
                ]
            );
            $this->add_control(
                'dots_progress_color',
                [
                    'label' => esc_html__( 'Progress Color', 'fancy-post-grid' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .fpg-unique-slider .swiper-pagination .swiper-pagination-progressbar-fill' => 'background-color: {{VALUE}}',
                    ],
                ]
            );
            $this->add_responsive_control(
                'dots_progress_radius',
                [
                    'label' => esc_html__( 'Border Radius', 'fancy-post-grid' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'custom' ],
                    'selectors' => [
                        '{{WRAPPER}} .fpg-unique-slider .swiper-pagination' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'dots_progress_border',
                    'selector' => '{{WRAPPER}} .fpg-unique-slider .swiper-pagination',
                ]
            );
            $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'dots_progress_box_shadow',
                    'selector' => '{{WRAPPER}} .fpg-unique-slider .swiper-pagination',
                ]
            );

            // Position Control
            $this->add_control(
                'dots_progress_control_position_heading',
                [
                    'label' => esc_html__( 'Position Options', 'fancy-post-grid' ),
                    'type' => Controls_Manager::HEADING,
                    'classes' => 'fpg-control-type-heading',
                    'separator' => 'before',
                ]
            );
            $this->add_responsive_control(
                'dots_progress_position_top',
                [
                    'label' => esc_html__( 'Position Top', 'fancy-post-grid' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%', 'custom' ],
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
                        '{{WRAPPER}} .fpg-unique-slider .swiper-pagination' => 'top: {{SIZE}}{{UNIT}} !important; bottom: unset !important;',
                    ],
                ]
            );
            $this->add_responsive_control(
                'dots_progress_position_right',
                [
                    'label' => esc_html__( 'Position Right', 'fancy-post-grid' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%', 'custom' ],
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
                        '{{WRAPPER}} .fpg-unique-slider .swiper-pagination' => 'right: {{SIZE}}{{UNIT}} !important; left: unset !important;',
                    ],
                ]
            );
            $this->add_responsive_control(
                'dots_progress_position_bottom',
                [
                    'label' => esc_html__( 'Position Bottom', 'fancy-post-grid' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%', 'custom' ],
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
                        '{{WRAPPER}} .fpg-unique-slider .swiper-pagination' => 'bottom: {{SIZE}}{{UNIT}} !important; top: unset !important;',
                    ],
                ]
            );
            $this->add_responsive_control(
                'dots_progress_position_left',
                [
                    'label' => esc_html__( 'Position Left', 'fancy-post-grid' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%', 'custom' ],
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
                        '{{WRAPPER}} .fpg-unique-slider .swiper-pagination' => 'left: {{SIZE}}{{UNIT}} !important; right: unset !important;',
                    ],
                ]
            );
        $this->end_controls_section();

        // Fraction Pagination
		$this->start_controls_section(
			'section_slider_style_dots_fraction',
			[
				'label' => esc_html__('Bullet Fraction Control', 'fancy-post-grid'),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'slider_dots' => 'true',
                    'slider_bullet_type' => 'fraction'
				]
			]
		);
            $this->add_responsive_control(
                'dots_fraction_wrapper_alignments',
                [
                    'label' => esc_html__('Alignment', 'fancy-post-grid'),
                    'type' => Controls_Manager::CHOOSE,
                    'options' => [
                        'left' => [
                            'title' => esc_html__('Left', 'fancy-post-grid'),
                            'icon' => 'eicon-text-align-left',
                        ],
                        'center' => [
                            'title' => esc_html__('Center', 'fancy-post-grid'),
                            'icon' => 'eicon-text-align-center',
                        ],
                        'right' => [
                            'title' => esc_html__('Right', 'fancy-post-grid'),
                            'icon' => 'eicon-text-align-right',
                        ],
                        'justify' => [
                            'title' => esc_html__('Justify', 'fancy-post-grid'),
                            'icon' => 'eicon-text-align-justify',
                        ],
                    ],
                    'toggle' => true,
                    'selectors' => [
                        '{{WRAPPER}} .fpg-unique-slider .swiper-pagination' => 'text-align: {{VALUE}}'
                    ],
                ]
            );
            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'dots_fraction_typography',
                    'selector' => '{{WRAPPER}} .fpg-unique-slider .swiper-pagination',
                ]
            );
            $this->add_control(
                'dots_fraction_text_color',
                [
                    'label' => esc_html__( 'Text Color', 'fancy-post-grid' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .fpg-unique-slider .swiper-pagination' => 'color: {{VALUE}}',
                    ],
                ]
            );
            $this->add_control(
                'dots_fraction_text_color_current',
                [
                    'label' => esc_html__( 'Text Color (Current)', 'fancy-post-grid' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .fpg-unique-slider .swiper-pagination .swiper-pagination-current' => 'color: {{VALUE}}',
                    ],
                ]
            );

            $this->add_responsive_control(
                'dots_fraction_wrapper_width',
                [
                    'label' => esc_html__('Width', 'fancy-post-grid'),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => ['px', '%', 'custom'],
                    'show_label' => true,
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 1000,
                        ],
                        '%' => [
                            'min' => 0,
                            'max' => 1000,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .fpg-unique-slider .swiper-pagination' => 'width: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'dots_fraction_wrapper_height',
                [
                    'label' => esc_html__('Height', 'fancy-post-grid'),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => ['px', '%', 'custom'],
                    'show_label' => true,
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 1000,
                        ],
                        '%' => [
                            'min' => 0,
                            'max' => 1000,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .fpg-unique-slider .swiper-pagination' => 'height: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'dots_fraction_wrapper_padding',
                [
                    'label' => esc_html__( 'Padding', 'fancy-post-grid' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'custom' ],
                    'selectors' => [
                        '{{WRAPPER}} .fpg-unique-slider .swiper-pagination' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'dots_fraction_wrapper_radius',
                [
                    'label' => esc_html__( 'Border Radius', 'fancy-post-grid' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'custom' ],
                    'selectors' => [
                        '{{WRAPPER}} .fpg-unique-slider .swiper-pagination' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => 'dots_fraction_wrapper_background',
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .fpg-unique-slider .swiper-pagination',
                ]
            );
            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'dots_fraction_wrapper_border',
                    'selector' => '{{WRAPPER}} .fpg-unique-slider .swiper-pagination',
                ]
            );
            $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'dots_fraction_wrapper_box_shadow',
                    'selector' => '{{WRAPPER}} .fpg-unique-slider .swiper-pagination',
                ]
            );

            // Position Control
            $this->add_control(
                'dots_fraction_control_position_heading',
                [
                    'label' => esc_html__( 'Position Options', 'fancy-post-grid' ),
                    'type' => Controls_Manager::HEADING,
                    'classes' => 'fpg-control-type-heading',
                    'separator' => 'before',
                ]
            );
            $this->add_responsive_control(
                'dots_fraction_position_top',
                [
                    'label' => esc_html__('Top Position', 'fancy-post-grid'),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => ['px', '%', 'custom'],
                    'show_label' => true,
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
                    'selectors' => [
                        '{{WRAPPER}} .fpg-unique-slider .swiper-pagination' => 'top: {{SIZE}}{{UNIT}} !important; bottom: unset !important;',
                    ],
                ]
            );
            $this->add_responsive_control(
                'dots_fraction_position_right',
                [
                    'label' => esc_html__('Right Position', 'fancy-post-grid'),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => ['px', '%', 'custom'],
                    'show_label' => true,
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
                    'selectors' => [
                        '{{WRAPPER}} .fpg-unique-slider .swiper-pagination' => 'right: {{SIZE}}{{UNIT}} !important; left: unset !important;',
                    ],
                ]
            );
            $this->add_responsive_control(
                'dots_fraction_position_bottom',
                [
                    'label' => esc_html__('Bottom Position', 'fancy-post-grid'),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => ['px', '%', 'custom'],
                    'show_label' => true,
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
                    'selectors' => [
                        '{{WRAPPER}} .fpg-unique-slider .swiper-pagination' => 'bottom: {{SIZE}}{{UNIT}} !important; top: unset !important;',
                    ],
                ]
            );
            $this->add_responsive_control(
                'dots_fraction_position_left',
                [
                    'label' => esc_html__('Left Position', 'fancy-post-grid'),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => ['px', '%', 'custom'],
                    'show_label' => true,
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
                    'selectors' => [
                        '{{WRAPPER}} .fpg-unique-slider .swiper-pagination' => 'left: {{SIZE}}{{UNIT}} !important; right: unset !important;',
                    ],
                ]
            );
        $this->end_controls_section();

        // Autoplay Progress
		$this->start_controls_section(
			'section_slider_autoplay_progress',
			[
				'label' => esc_html__('Autoplay Progress Control', 'fancy-post-grid'),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'slider_autoplay' => 'true',
                    'slide_item_circle_progress' => 'true'
				]
			]
		);
            $this->add_control(
                'autoplay_progress_circle_heading',
                [
                    'label' => esc_html__( 'Circle Options', 'fancy-post-grid' ),
                    'type' => Controls_Manager::HEADING,
                    'classes' => 'fpg-control-type-heading',
                ]
            );
            $this->add_responsive_control(
                'autoplay_progress_size',
                [
                    'label' => esc_html__( 'Size', 'fancy-post-grid' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%', 'custom' ],
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
                        '{{WRAPPER}} .fpg-unique-slider .autoplay-progress' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'autoplay_progress_stroke_width',
                [
                    'label' => esc_html__( 'Stroke Width', 'fancy-post-grid' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%', 'custom' ],
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
                        '{{WRAPPER}} .fpg-unique-slider .autoplay-progress svg' => 'stroke-width: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_control(
                'autoplay_progress_stroke_color',
                [
                    'label' => esc_html__( 'Stroke Color', 'fancy-post-grid' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .fpg-unique-slider .autoplay-progress svg' => 'stroke: {{VALUE}}',
                    ],
                ]
            );
            $this->add_control(
                'autoplay_progress_stroke_color_solid',
                [
                    'label' => esc_html__( 'Stroke Color (Solid)', 'fancy-post-grid' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .fpg-unique-slider .autoplay-progress svg circle.normal' => 'stroke: {{VALUE}}',
                    ],
                ]
            );
            $this->add_control(
                'autoplay_progress_bg_color',
                [
                    'label' => esc_html__( 'Background Color', 'fancy-post-grid' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .fpg-unique-slider .autoplay-progress svg' => 'fill: {{VALUE}}',
                    ],
                ]
            );

            // Number Control
            $this->add_control(
                'autoplay_progress_number_heading',
                [
                    'label' => esc_html__( 'Number Options', 'fancy-post-grid' ),
                    'type' => Controls_Manager::HEADING,
                    'classes' => 'fpg-control-type-heading',
                    'separator' => 'before',
                ]
            );
            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'autoplay_progress_number_typography',
                    'selector' => '{{WRAPPER}} .fpg-unique-slider .autoplay-progress',
                ]
            );
            $this->add_control(
                'autoplay_progress_number_color',
                [
                    'label' => esc_html__( 'Text Color', 'fancy-post-grid' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .fpg-unique-slider .autoplay-progress' => 'color: {{VALUE}}',
                    ],
                ]
            );

            // Position Control
            $this->add_control(
                'autoplay_progress_position_heading',
                [
                    'label' => esc_html__( 'Position Options', 'fancy-post-grid' ),
                    'type' => Controls_Manager::HEADING,
                    'classes' => 'fpg-control-type-heading',
                    'separator' => 'before',
                ]
            );
            $this->add_responsive_control(
                'autoplay_progress_position_top',
                [
                    'label' => esc_html__('Top Position', 'fancy-post-grid'),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => ['px', '%', 'custom'],
                    'show_label' => true,
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
                    'selectors' => [
                        '{{WRAPPER}} .fpg-unique-slider .autoplay-progress' => 'top: {{SIZE}}{{UNIT}} !important; bottom: unset !important;',
                    ],
                ]
            );
            $this->add_responsive_control(
                'autoplay_progress_position_right',
                [
                    'label' => esc_html__('Right Position', 'fancy-post-grid'),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => ['px', '%', 'custom'],
                    'show_label' => true,
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
                    'selectors' => [
                        '{{WRAPPER}} .fpg-unique-slider .autoplay-progress' => 'right: {{SIZE}}{{UNIT}} !important; left: unset !important;',
                    ],
                ]
            );
            $this->add_responsive_control(
                'autoplay_progress_position_bottom',
                [
                    'label' => esc_html__('Bottom Position', 'fancy-post-grid'),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => ['px', '%', 'custom'],
                    'show_label' => true,
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
                    'selectors' => [
                        '{{WRAPPER}} .fpg-unique-slider .autoplay-progress' => 'bottom: {{SIZE}}{{UNIT}} !important; top: unset !important;',
                    ],
                ]
            );
            $this->add_responsive_control(
                'autoplay_progress_position_left',
                [
                    'label' => esc_html__('Left Position', 'fancy-post-grid'),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => ['px', '%', 'custom'],
                    'show_label' => true,
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
                    'selectors' => [
                        '{{WRAPPER}} .fpg-unique-slider .autoplay-progress' => 'left: {{SIZE}}{{UNIT}} !important; right: unset !important;',
                    ],
                ]
            );
        $this->end_controls_section();

        // Scrollbar
		$this->start_controls_section(
			'section_slider_scrollbar',
			[
				'label' => esc_html__('Scrollbar Control', 'fancy-post-grid'),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'slider_scrollbar' => 'true'
				]
			]
		);
            $this->add_responsive_control(
                'scrollbar_width',
                [
                    'label' => esc_html__( 'Width', 'fancy-post-grid' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%', 'custom' ],
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
                        '{{WRAPPER}} .fpg-unique-slider .swiper-scrollbar' => 'width: {{SIZE}}{{UNIT}} !important;',
                    ],
                ]
            );
            $this->add_responsive_control(
                'scrollbar_height',
                [
                    'label' => esc_html__( 'Height', 'fancy-post-grid' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%', 'custom' ],
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
                        '{{WRAPPER}} .fpg-unique-slider .swiper-scrollbar' => 'height: {{SIZE}}{{UNIT}} !important;',
                    ],
                ]
            );
            $this->add_control(
                'scrollbar_track_color',
                [
                    'label' => esc_html__( 'Track Background Color', 'fancy-post-grid' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .fpg-unique-slider .swiper-scrollbar' => 'background-color: {{VALUE}}',
                    ],
                ]
            );
            $this->add_control(
                'scrollbar_color',
                [
                    'label' => esc_html__( 'Scrollbar Color', 'fancy-post-grid' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .fpg-unique-slider .swiper-scrollbar .swiper-scrollbar-drag' => 'background-color: {{VALUE}}',
                    ],
                ]
            );
            $this->add_responsive_control(
                'scrollbar_margin',
                [
                    'label' => esc_html__( 'Margin', 'fancy-post-grid' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'custom' ],
                    'selectors' => [
                        '{{WRAPPER}} .fpg-unique-slider .swiper-scrollbar' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'scrollbar_border',
                    'selector' => '{{WRAPPER}} .fpg-unique-slider .swiper-scrollbar',
                ]
            );
            $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'scrollbar_box_shadow',
                    'selector' => '{{WRAPPER}} .fpg-unique-slider .swiper-scrollbar',
                ]
            );
            // Position Control
            $this->add_control(
                'scrollbar_position_heading',
                [
                    'label' => esc_html__( 'Position Options', 'fancy-post-grid' ),
                    'type' => Controls_Manager::HEADING,
                    'classes' => 'fpg-control-type-heading',
                    'separator' => 'before',
                ]
            );
            $this->add_responsive_control(
                'scrollbar_position_top',
                [
                    'label' => esc_html__('Top Position', 'fancy-post-grid'),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => ['px', '%', 'custom'],
                    'show_label' => true,
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
                    'selectors' => [
                        '{{WRAPPER}} .fpg-unique-slider .swiper-scrollbar' => 'top: {{SIZE}}{{UNIT}} !important; bottom: unset !important;',
                    ],
                ]
            );
            $this->add_responsive_control(
                'scrollbar_position_right',
                [
                    'label' => esc_html__('Right Position', 'fancy-post-grid'),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => ['px', '%', 'custom'],
                    'show_label' => true,
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
                    'selectors' => [
                        '{{WRAPPER}} .fpg-unique-slider .swiper-scrollbar' => 'right: {{SIZE}}{{UNIT}} !important; left: unset !important;',
                    ],
                ]
            );
            $this->add_responsive_control(
                'scrollbar_position_bottom',
                [
                    'label' => esc_html__('Bottom Position', 'fancy-post-grid'),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => ['px', '%', 'custom'],
                    'show_label' => true,
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
                    'selectors' => [
                        '{{WRAPPER}} .fpg-unique-slider .swiper-scrollbar' => 'bottom: {{SIZE}}{{UNIT}} !important; top: unset !important;',
                    ],
                ]
            );
            $this->add_responsive_control(
                'scrollbar_position_left',
                [
                    'label' => esc_html__('Left Position', 'fancy-post-grid'),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => ['px', '%', 'custom'],
                    'show_label' => true,
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
                    'selectors' => [
                        '{{WRAPPER}} .fpg-unique-slider .swiper-scrollbar' => 'left: {{SIZE}}{{UNIT}} !important; right: unset !important;',
                    ],
                ]
            );
        $this->end_controls_section();
	}

	protected function fpg_render_sl_nav_content() {
        $settings = $this->get_settings_for_display();
        if ('true' === $settings['slider_nav']) {
            if ('2' === $settings['slider_nav_style']) { ?>
                <div class="swiper-btn-wrapper">
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-button-next"></div>
                </div>
            <?php } else { ?>
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
            <?php }
        }
        if ('true' === $settings['slider_dots']) { ?>
            <div class="swiper-pagination"></div>
        <?php }
        if ('true' === $settings['slider_scrollbar']) { ?>
            <div class="swiper-scrollbar"></div>
        <?php }
        if ('true' === $settings['slide_item_circle_progress']) { ?>
            <div class="autoplay-progress">
                <svg viewBox="0 0 48 48">
                    <circle class="normal" cx="24" cy="24" r="20"></circle>
                    <circle cx="24" cy="24" r="20"></circle>
                </svg>
                <span></span>
            </div>
        <?php }
    }
}