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

class FPG_Post_Slider extends \Elementor\Widget_Base {

    use FPG_Query_Builder;
    use FPG_Common_Controls;
    use FPG_Slider_Controls;

    public function get_name() {
		return 'fpg-post-slider';
	}

    public function get_title() {
		return __( 'FPG - Post Slider', 'fancy-post-grid' );
	}

    public function get_icon() {
		return 'eicon-post-slider';
	}

    public function get_categories() {
		return [ 'fancy_post_grid_category' ];
	}

    public function get_keywords() {
        return ['post', 'fpg', 'slider'];
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
                        'floating' => esc_html__( 'Style 4', 'fancy-post-grid' ),
                    ],
                ]
            );
        $this->end_controls_section();
        // General Section Start

        // Query Builder Controls Start
        $this->fpg_register_query_controls_el();
        // Query Builder Controls End

        // Thumbnail Section Start
        $this->fpg_register_thumbnail_content_controls_el();
        // Thumbnail Section Start

        // Title Section Start
        $this->fpg_register_title_content_controls_el([
            'parent_selector' => '.fpg-post-slider'
        ]);
        // Title Section End
        
        // Meta Conditions Section Start
        $this->fpg_register_meta_content_controls_el();
        // Meta Conditions Section End

        // Button Section Start
        $this->fpg_register_button_content_controls_el();
        // Button Section End

        // Slider Config Start
        $this->fpg_sl_config_control();
        // Slider Config End

        // General Style Section Start
        $this->fpg_register_general_style_controls_el([
            'parent_selector' => '.fpg-post-slider'
        ]);
        // General Style Section End

        // Content Wrapper Style Section Start
        $this->start_controls_section(
			'_content_wrapper_style_section',
			[
				'label' => __( 'Content Wrapper Style', 'fancy-post-grid' ),
                'tab' => Controls_Manager::TAB_STYLE,
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
                        '{{WRAPPER}} .fpg-post-slider .fpg-card-style .fpg-post-content' => 'align-items: {{VALUE}};',
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
                        '{{WRAPPER}} .fpg-post-slider .fpg-card-style .fpg-post-content' => 'justify-content: {{VALUE}};',
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
                        '{{WRAPPER}} .fpg-post-slider .fpg-card-style .fpg-post-content' => 'flex-direction: {{VALUE}};',
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
                        '{{WRAPPER}} .fpg-post-slider .fpg-card-style .fpg-post-content' => 'flex-wrap: {{VALUE}};',
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
                        '{{WRAPPER}} .fpg-post-slider .fpg-card-style .fpg-post-content' => 'gap: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'content_wrapper_height',
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
                        '{{WRAPPER}} .fpg-post-slider .fpg-card-style .fpg-post-content' => 'height: {{SIZE}}{{UNIT}};',
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
                        '{{WRAPPER}} .fpg-post-slider .fpg-card-style .fpg-post-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'content_wrapper_margin',
                [
                    'label' => esc_html__( 'Margin', 'fancy-post-grid' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', 'em', 'rem', 'custom' ],
                    'selectors' => [
                        '{{WRAPPER}} .fpg-post-slider .fpg-card-style .fpg-post-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
        $this->end_controls_section();
        // Content Wrapper Style Section End

        // Thumbnail Style Section Start
        $this->fpg_register_thumbnail_style_controls_el([
            'parent_selector' => '.fpg-post-slider'
        ]);
        // Thumbnail Style Section End

        // Category Style Section Start
        $this->fpg_register_category_style_controls_el([
            'parent_selector' => '.fpg-post-slider'
        ]);
        // Category Style Section End

        // Title Style Section Start
        $this->fpg_register_title_style_controls_el([
            'parent_selector' => '.fpg-post-slider'
        ]);
        // Title Style Section End
        
        // Description Style Section Start
        $this->fpg_register_desc_style_controls_el([
            'parent_selector' => '.fpg-post-slider'
        ]);
        // Description Style Section End

        // Meta Style Section Start
        $this->fpg_register_meta_style_controls_el([
            'parent_selector' => '.fpg-post-slider'
        ]);
        // Meta Style Section End

        // Button Style Section Start
        $this->fpg_register_button_style_controls_el([
            'parent_selector' => '.fpg-post-slider'
        ]);
        // Button Style Section End

        // Nav's Style Section Start
        $this->fpg_sl_nav_style_control();
        // Nav's Style Section End

    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $unique = 'id-'.$this->get_id();
        $cardStyle = $settings['style'];
        $query = $this->fpg_get_query($settings, 'post');

        $titleWord = !empty($settings['title_length']) ? $settings['title_length'] : 500;
        $titleWordDot = ('yes' === $settings['title_length_double_dot']) ? '...' : '';
        $titleHoverUnderline = ('yes' === $settings['title_hover_underline']) ? 'underline' : '';
        $descWord = !empty($settings['post_desc_word']) ? $settings['post_desc_word'] : 50;

        $separator_value = !empty($settings['meta_separator']) ? $settings['meta_separator'] : '';

        $btnTxt = !empty($settings['btn_text']) ? $settings['btn_text'] : 'Read More';

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
        $rtl = ('right' === $settings['slider_direction']) ? 'true' : 'false';

        $this->add_render_attribute( 'main', [
			'id' => 'fpg-unique-slider-'.$unique,
			'class' => [
				'fpg-unique-slider',
				$sliderNavCls,
				$sliderDotsCls
			],
		]);
        $this->add_render_attribute( 'wrapper', [
			'class' => [
				'fpg-post-slider swiper',
			],
            'dir' => ('true' === $rtl) ? 'rtl' : 'ltr'
		]);
        
        ?>
        <div <?php $this->print_render_attribute_string( 'main' ); ?>>
            <div <?php $this->print_render_attribute_string( 'wrapper' ); ?>>
                <div class="swiper-wrapper">
                    <?php if ($query->have_posts()) {
                        while ($query->have_posts()) : $query->the_post();
                            $post_id = get_the_ID();
                            $post_categories = get_the_category();

                            $postView = !empty(get_post_meta( $post_id, '_fpg_post_views_count', true )) ? get_post_meta( $post_id, '_fpg_post_views_count', true ) : '';
                            $postView = !empty($postView) ? str_pad( $postView, 2, '0', STR_PAD_LEFT ) : 0;

                            $postVideo = !empty( get_post_meta( $post_id, '_fpg_video_link', true ) ) ? get_post_meta( $post_id, '_fpg_video_link', true ) : '';
                            echo '<div class="swiper-slide">';
                                include FANCY_POST_GRID_PATH . "includes/ElementBlock/cards/card-style.php";
                            echo '</div>';
                        endwhile;

                        $this->fpg_reset_query();
                    } ?>
                </div>
            </div>
            <?php $this->fpg_render_sl_nav_content(); ?>
        </div>

    <?php }
}