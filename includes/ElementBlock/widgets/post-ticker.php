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

class FPG_Post_Ticker extends \Elementor\Widget_Base {

    use FPG_Query_Builder;

    public function get_name() {
		return 'fpg-post-ticker';
	}

    public function get_title() {
		return __( 'FPG - Post Ticker', 'fancy-post-grid' );
	}

    public function get_icon() {
		return 'eicon-posts-ticker';
	}

    public function get_categories() {
		return [ 'fancy_post_grid_category' ];
	}

    public function get_keywords() {
        return ['post', 'fpg', 'ticker'];
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
                'label_ctrl_heading',
                [
                    'label' => esc_html__( 'Label', 'fancy-post-grid' ),
                    'type' => Controls_Manager::HEADING,
                    'classes' => 'fpg-control-type-heading',
                ]
            );
            $this->add_control(
                'ticker_label',
                [
                    'label' => esc_html__( 'Text', 'fancy-post-grid' ),
                    'type' => Controls_Manager::TEXT,
                    'placeholder' => __( 'Live News', 'fancy-post-grid' ),
                    'label_block' => true,
                ]
            );
            $this->add_control(
                'show_label_animation',
                [
                    'label' => esc_html__( 'Show Label Animation', 'fancy-post-grid' ),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__( 'Show', 'fancy-post-grid' ),
                    'label_off' => esc_html__( 'Hide', 'fancy-post-grid' ),
                    'return_value' => 'yes',
                    'default' => 'yes',
                ]
            );
            $this->add_control(
                'ticker_config_ctrl_heading',
                [
                    'label' => esc_html__( 'Configuration', 'fancy-post-grid' ),
                    'type' => Controls_Manager::HEADING,
                    'classes' => 'fpg-control-type-heading',
                    'separator' => 'before',
                ]
            );
            $this->add_control(
                'switching_duration',
                [
                    'label' => esc_html__( 'Switching Duration', 'fancy-post-grid' ),
                    'type' => Controls_Manager::NUMBER,
                    'min' => 200,
                    'step' => 100,
                    'default' => 4000,
                    'render_type' => 'template'
                ]
            );
            $this->add_control(
                'hover_pause',
                [
                    'label' => esc_html__( 'Pause On Hover', 'fancy-post-grid' ),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__( 'True', 'fancy-post-grid' ),
                    'label_off' => esc_html__( 'False', 'fancy-post-grid' ),
                    'return_value' => 'yes',
                    'default' => 'yes',
                    'render_type' => 'template'
                ]
            );
            $this->add_control(
                'title_ctrl_heading',
                [
                    'label' => esc_html__( 'Title', 'fancy-post-grid' ),
                    'type' => Controls_Manager::HEADING,
                    'classes' => 'fpg-control-type-heading',
                    'separator' => 'before',
                ]
            );
            $this->add_control(
                'title_tag',
                [
                    'label'   => esc_html__( 'Title Tag', 'fancy-post-grid' ),
                    'type'    => Controls_Manager::SELECT,
                    'default' => 'p',
                    'options' => [
                        'h1' => esc_html__( 'H1', 'fancy-post-grid' ),
                        'h2'  => esc_html__( 'H2', 'fancy-post-grid' ),
                        'h3' => esc_html__( 'H3', 'fancy-post-grid' ),
                        'h4'  => esc_html__( 'H4', 'fancy-post-grid' ),
                        'h5' => esc_html__( 'H5', 'fancy-post-grid' ),
                        'h6'  => esc_html__( 'H6', 'fancy-post-grid' ),
                        'p'  => esc_html__( 'P', 'fancy-post-grid' ),
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
                        '{{WRAPPER}} .fpg-post-ticker .fpg-ticker-content .fpg-ticker-title a' => '-webkit-line-clamp: {{SIZE}}; display: -webkit-box; -webkit-box-orient: vertical; overflow: hidden;',
                    ],
                ]
            );
            $this->add_control(
                'title_length',
                [
                    'label'   => esc_html__( 'Title Word Length', 'fancy-post-grid' ),
                    'type'    => Controls_Manager::NUMBER,
                    'min'     => 1,
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
                ]
            );
        $this->end_controls_section();
        // General Section Start

        // Query Builder Controls Start
        $this->fpg_register_query_controls_el();
        // Query Builder Controls End

        $this->start_controls_section(
            'g_style_section',
            [
                'label' => esc_html__( 'Style',  'fancy-post-grid'  ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
            $this->add_control(
                'wrapper_style_ctrl_heading',
                [
                    'label' => esc_html__( 'Wrapper Style', 'fancy-post-grid' ),
                    'type' => Controls_Manager::HEADING,
                    'classes' => 'fpg-control-type-heading',
                ]
            );
            $this->add_responsive_control(
                'wrapper__flex_v_align',
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
                        '{{WRAPPER}} .fpg-post-ticker' => 'align-items: {{VALUE}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'wrapper_flex_h_align',
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
                        '{{WRAPPER}} .fpg-post-ticker' => 'justify-content: {{VALUE}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'wrapper_flex_dir',
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
                        '{{WRAPPER}} .fpg-post-ticker' => 'flex-direction: {{VALUE}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'wrapper_flex_wrap',
                [
                    'label' => esc_html__( 'Flex Wrap', 'fancy-post-grid' ),
                    'type' => Controls_Manager::CHOOSE,
                    'options' => [
                        'nowrap' => [ 'title' => esc_html__( 'No Wrap', 'fancy-post-grid' ), 'icon' => 'eicon-nowrap' ],
                        'wrap'   => [ 'title' => esc_html__( 'Wrap', 'fancy-post-grid' ), 'icon' => 'eicon-wrap' ],
                    ],
                    'toggle' => true,
                    'selectors' => [
                        '{{WRAPPER}} .fpg-post-ticker' => 'flex-wrap: {{VALUE}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'wrapper_flex_gap',
                [
                    'label' => esc_html__( 'Gap Between', 'fancy-post-grid' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%', 'custom' ],
                    'range' => [
                        'px' => [ 'min' => 0, 'max' => 1000 ],
                        '%' => [ 'min' => 0, 'max' => 100 ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .fpg-post-ticker' => 'gap: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_control(
                'label_style_ctrl_heading',
                [
                    'label' => esc_html__( 'Label Style', 'fancy-post-grid' ),
                    'type' => Controls_Manager::HEADING,
                    'classes' => 'fpg-control-type-heading',
                    'separator' => 'before',
                ]
            );
            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'label_typography',
                    'selector' => '{{WRAPPER}} .fpg-post-ticker .fpg-ticker-top .fpg-ticker-label',
                ]
            );
            $this->add_control(
                'label_color',
                [
                    'label' => esc_html__( 'Color', 'fancy-post-grid' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .fpg-post-ticker .fpg-ticker-top .fpg-ticker-label' => 'color: {{VALUE}}',
                    ],
                ]
            );
            $this->add_responsive_control(
                'label_padding',
                [
                    'label' => esc_html__( 'Padding', 'fancy-post-grid' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', 'em', 'rem', 'custom' ],
                    'selectors' => [
                        '{{WRAPPER}} .fpg-post-ticker .fpg-ticker-top .fpg-ticker-label' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'label_margin',
                [
                    'label' => esc_html__( 'Margin', 'fancy-post-grid' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', 'em', 'rem', 'custom' ],
                    'selectors' => [
                        '{{WRAPPER}} .fpg-post-ticker .fpg-ticker-top .fpg-ticker-label' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'ticker_label_border',
                    'selector' => '{{WRAPPER}} .fpg-post-ticker .fpg-ticker-top .fpg-ticker-label',
                ]
            );
            $this->add_control(
                'label_anim_color',
                [
                    'label' => esc_html__( 'Animation Color', 'fancy-post-grid' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .fpg-post-ticker .fpg-ticker-top .fpg-popup-circle,
                        {{WRAPPER}} .fpg-post-ticker .fpg-ticker-top .fpg-popup-circle:after' => 'background-color: {{VALUE}}',
                    ],
                    'condition' => [
                        'show_label_animation' => 'yes'
                    ]
                ]
            );
            $this->add_control(
                'title_style_ctrl_heading',
                [
                    'label' => esc_html__( 'Title Style', 'fancy-post-grid' ),
                    'type' => Controls_Manager::HEADING,
                    'classes' => 'fpg-control-type-heading',
                    'separator' => 'before',
                ]
            );
            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'title_typography',
                    'selector' => '{{WRAPPER}} .fpg-post-ticker .fpg-ticker-content .fpg-ticker-title',
                ]
            );
            $this->add_control(
                'title_color',
                [
                    'label' => esc_html__( 'Color', 'fancy-post-grid' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .fpg-post-ticker .fpg-ticker-content .fpg-ticker-title a' => 'color: {{VALUE}}',
                    ],
                ]
            );
            $this->add_control(
                'title_color_hover',
                [
                    'label' => esc_html__( 'Color (Hover)', 'fancy-post-grid' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .fpg-post-ticker .fpg-ticker-content .fpg-ticker-title a:hover' => 'color: {{VALUE}}',
                    ],
                ]
            );
        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $query = $this->fpg_get_query($settings, 'post');
        $id = 'id-'.$this->get_id();

        $tickerLabel = !empty($settings['ticker_label']) ? $settings['ticker_label'] : 'Live News';
        $titleWord = !empty($settings['title_length']) ? $settings['title_length'] : 500;
        $titleWordDot = ('yes' === $settings['title_length_double_dot']) ? '...' : '';
        $switchingDuration = !empty($settings['switching_duration']) ? $settings['switching_duration'] : 4000;
        ?>

        <div id="<?php echo esc_attr($id); ?>" class="fpg-post-ticker">
            <div class="fpg-ticker-top">
                <?php if ('yes' === $settings['show_label_animation']) { ?>
                    <span class="fpg-popup-circle"></span>
                <?php } ?>
                <p class="fpg-ticker-label"><?php echo esc_html($tickerLabel); ?></p>
            </div>
            <div class="fpg-ticker-content">
                <div class="fpg-ticker-content-inner">
                    <?php if ($query->have_posts()) {
                        $post_index = 0;
                        while ($query->have_posts()) : $query->the_post();
                            $post_index++;
                            $active_class = ($post_index === 1) ? 'is-active' : '';
                            ?>
                                <?php printf(
                                    '<%1$s class="%2$s"><a href="%3$s">%4$s</a></%1$s>',
                                    $settings['title_tag'],
                                    'fpg-ticker-title '.$active_class,
                                    get_permalink(),
                                    esc_html(wp_trim_words(get_the_title(), $titleWord, $titleWordDot))
                                ); ?>
                            
                        <?php endwhile;
                        $this->fpg_reset_query();
                    } ?>
                </div>
            </div>
        </div>
        <script>
            jQuery(document).ready(function($) {
                $('#<?php echo esc_attr($id); ?>').each(function () { 
                    const tickerParent = $(this);
                    var items = tickerParent.find('.fpg-ticker-title');
                    var current = 0;
                    var total = items.length;
                    var intervalTiming = <?php echo esc_js($switchingDuration); ?>;
                    var removeDuration = intervalTiming / 2;
                    var tickerInterval;
                    var hoverPause = <?php echo ('yes' === $settings['hover_pause']) ? 'true' : 'false'; ?>;
                    function rotateText() {
                        if (total === 0) return;
                        items.eq(current).addClass('is-removing');
                        current = (current + 1) % total;
                        items.eq(current).removeClass('is-removing').addClass('is-active');
                        setTimeout(() => {
                            items.not(':eq(' + current + ')').removeClass('is-active is-removing');
                        }, removeDuration);
                    }
                    tickerInterval = setInterval(rotateText, intervalTiming);
                    if (hoverPause) {
                        tickerParent.on('mouseenter', function() {
                            clearInterval(tickerInterval);
                        });
                        tickerParent.on('mouseleave', function() {
                            tickerInterval = setInterval(rotateText, intervalTiming);
                        });
                    }
                });
            });

        </script>
    <?php }
}