<?php

use Elementor\Controls_Manager;
use Elementor\Plugin;

defined( 'ABSPATH' ) || die();

class FPG_Post_Grid extends \Elementor\Widget_Base {

	use FPG_Query_Builder;
	use FPG_Common_Controls;

	public function get_name() {
		return 'fpg-post-grid';
	}

	public function get_title() {
		return __( 'FPG - Post Grid', 'fancy-post-grid' );
	}

	public function get_icon() {
		return 'eicon-posts-grid';
	}

	public function get_categories() {
		return [ 'fancy_post_grid_category' ];
	}

	public function get_keywords() {
		return [ 'post', 'fpg', 'grid' ];
	}

	protected function register_controls() {
		// General Section Start
		$this->start_controls_section(
			'_section_general',
			[
				'label' => __( 'General', 'fancy-post-grid' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);
			$this->add_control(
				'style',
				[
					'label'   => esc_html__( 'Style', 'fancy-post-grid' ),
					'type'    => Controls_Manager::SELECT,
					'default' => 'one',
					'options' => [
						'one'      => esc_html__( 'Style 1', 'fancy-post-grid' ),
						'two'      => esc_html__( 'Style 2', 'fancy-post-grid' ),
						'three'    => esc_html__( 'Style 3', 'fancy-post-grid' ),
						'floating' => esc_html__( 'Style 4', 'fancy-post-grid' ),
					],
				]
			);
			$this->add_control(
				'query_type',
				[
					'label'       => esc_html__( 'Query Type', 'fancy-post-grid' ),
					'description' => esc_html__( 'Choose "Archive" if this widget is used on an archive template to display the current page’s posts.', 'fancy-post-grid' ),
					'type'        => Controls_Manager::SELECT,
					'default'     => 'custom',
					'options'     => [
						'custom'  => esc_html__( 'Custom', 'fancy-post-grid' ),
						'archive' => esc_html__( 'Archive', 'fancy-post-grid' ),
					],
					'separator'   => 'before',
				]
			);
			$this->add_control(
				'column_ctrl_heading',
				[
					'label'     => esc_html__( 'Column Control', 'fancy-post-grid' ),
					'type'      => Controls_Manager::HEADING,
					'classes'   => 'fpg-control-type-heading',
					'separator' => 'before',
				]
			);
			$this->add_responsive_control(
				'column_count',
				[
					'label'     => esc_html__( 'Column', 'fancy-post-grid' ),
					'type'      => Controls_Manager::SLIDER,
					'selectors' => [
						'{{WRAPPER}} .fpg-post-grid' => 'grid-template-columns: repeat({{SIZE}}, 1fr);',
					],
				]
			);
			$this->add_responsive_control(
				'col_gaps',
				[
					'label'      => esc_html__( 'Gap', 'fancy-post-grid' ),
					'type'       => Controls_Manager::GAPS,
					'size_units' => [ 'px', 'em', 'rem', 'custom' ],
					'selectors'  => [
						'{{WRAPPER}} .fpg-post-grid' => 'gap: {{ROW}}{{UNIT}} {{COLUMN}}{{UNIT}};',
					],
				]
			);
		$this->end_controls_section();
		// General Section Start

		// Query Builder Controls Start
		$this->fpg_register_query_controls_el( true );
		// Query Builder Controls End

		// Pagination Controls Start
		$this->fpg_register_post_pagination_controls_el( true );
		// Pagination Controls End

		// Thumbnail Section Start
		$this->fpg_register_thumbnail_content_controls_el();
		// Thumbnail Section Start

		// Title Section Start
		$this->fpg_register_title_content_controls_el( [
			'parent_selector' => '.fpg-post-grid'
		] );
		// Title Section End

		// Meta Conditions Section Start
		$this->fpg_register_meta_content_controls_el();
		// Meta Conditions Section End

		// Button Section Start
		$this->fpg_register_button_content_controls_el();
		// Button Section End

		// General Style Section Start
		$this->fpg_register_general_style_controls_el( [
			'parent_selector' => '.fpg-post-grid'
		] );
		// General Style Section End

		// Content Wrapper Style Section Start
		$this->start_controls_section(
			'_content_wrapper_style_section',
			[
				'label' => __( 'Content Wrapper Style', 'fancy-post-grid' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'content_wrapper_display_style',
			[
				'label' => esc_html__( 'Display Style', 'fancy-post-grid' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'' => esc_html__( 'Default', 'fancy-post-grid' ),
					'block' => esc_html__( 'Block', 'fancy-post-grid' ),
					'flex' => esc_html__( 'Flex', 'fancy-post-grid' ),
				],
				'toggle' => true,
				'selectors' => [
					'{{WRAPPER}} .fpg-post-grid .fpg-card-style .fpg-post-content' => 'display: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'content_wrapper_flex_v_align',
			[
				'label'     => esc_html__( 'Vertical Align', 'fancy-post-grid' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => [
					'flex-start' => [ 'title' => esc_html__( 'Top', 'fancy-post-grid' ), 'icon' => 'eicon-align-start-v' ],
					'center'     => [ 'title' => esc_html__( 'Middle', 'fancy-post-grid' ), 'icon' => 'eicon-align-center-v' ],
					'flex-end'   => [ 'title' => esc_html__( 'Bottom', 'fancy-post-grid' ), 'icon' => 'eicon-align-end-v' ],
				],
				'toggle'    => true,
				'selectors' => [
					'{{WRAPPER}} .fpg-post-grid .fpg-card-style .fpg-post-content' => 'align-items: {{VALUE}};',
				],
				'condition' => [
					'content_wrapper_display_style' => 'flex'
				],
			]
		);
		$this->add_responsive_control(
			'content_wrapper_flex_h_align',
			[
				'label'     => esc_html__( 'Horizontal Align', 'fancy-post-grid' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => [
					'flex-start'    => [ 'title' => esc_html__( 'Start', 'fancy-post-grid' ), 'icon' => 'eicon-align-start-h' ],
					'center'        => [ 'title' => esc_html__( 'Center', 'fancy-post-grid' ), 'icon' => 'eicon-align-center-h' ],
					'flex-end'      => [ 'title' => esc_html__( 'End', 'fancy-post-grid' ), 'icon' => 'eicon-align-end-h' ],
					'space-between' => [ 'title' => esc_html__( 'Space Between', 'fancy-post-grid' ), 'icon' => 'eicon-justify-space-between-h' ],
				],
				'toggle'    => true,
				'selectors' => [
					'{{WRAPPER}} .fpg-post-grid .fpg-card-style .fpg-post-content' => 'justify-content: {{VALUE}};',
				],
				'condition' => [
					'content_wrapper_display_style' => 'flex'
				],
			]
		);
		$this->add_responsive_control(
			'content_wrapper_flex_dir',
			[
				'label'     => esc_html__( 'Column Direction', 'fancy-post-grid' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => [
					'row'            => [ 'title' => esc_html__( 'Row', 'fancy-post-grid' ), 'icon' => 'eicon-justify-start-h' ],
					'row-reverse'    => [ 'title' => esc_html__( 'Row Reverse', 'fancy-post-grid' ), 'icon' => 'eicon-wrap' ],
					'column'         => [ 'title' => esc_html__( 'Column', 'fancy-post-grid' ), 'icon' => 'eicon-justify-start-v' ],
					'column-reverse' => [ 'title' => esc_html__( 'Column Reverse', 'fancy-post-grid' ), 'icon' => 'eicon-wrap' ],
				],
				'toggle'    => true,
				'selectors' => [
					'{{WRAPPER}} .fpg-post-grid .fpg-card-style .fpg-post-content' => 'flex-direction: {{VALUE}};',
				],
				'condition' => [
					'content_wrapper_display_style' => 'flex'
				],
			]
		);
		$this->add_responsive_control(
			'content_wrapper_flex_wrap',
			[
				'label'     => esc_html__( 'Flex Wrap', 'fancy-post-grid' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => [
					'nowrap' => [ 'title' => esc_html__( 'No Wrap', 'fancy-post-grid' ), 'icon' => 'eicon-nowrap' ],
					'wrap'   => [ 'title' => esc_html__( 'Wrap', 'fancy-post-grid' ), 'icon' => 'eicon-wrap' ],
				],
				'toggle'    => true,
				'selectors' => [
					'{{WRAPPER}} .fpg-post-grid .fpg-card-style .fpg-post-content' => 'flex-wrap: {{VALUE}};',
				],
				'condition' => [
					'content_wrapper_display_style' => 'flex'
				],
			]
		);
		$this->add_responsive_control(
			'content_wrapper_flex_gap',
			[
				'label'      => esc_html__( 'Gap Between', 'fancy-post-grid' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'custom' ],
				'range'      => [
					'px' => [ 'min' => 0, 'max' => 1000 ],
					'%'  => [ 'min' => 0, 'max' => 100 ],
				],
				'selectors'  => [
					'{{WRAPPER}} .fpg-post-grid .fpg-card-style .fpg-post-content' => 'gap: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'content_wrapper_display_style' => 'flex'
				],
			]
		);

		$this->add_responsive_control(
			'content_wrapper_height',
			[
				'label'      => esc_html__( 'Height', 'fancy-post-grid' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'range'      => [
					'px' => [
						'min' => 0,
						'max' => 1000,
					],
					'%'  => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .fpg-post-grid .fpg-card-style .fpg-post-content' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'content_wrapper_padding',
			[
				'label'      => esc_html__( 'Padding', 'fancy-post-grid' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', 'rem', 'custom' ],
				'selectors'  => [
					'{{WRAPPER}} .fpg-post-grid .fpg-card-style .fpg-post-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'content_wrapper_margin',
			[
				'label'      => esc_html__( 'Margin', 'fancy-post-grid' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', 'rem', 'custom' ],
				'selectors'  => [
					'{{WRAPPER}} .fpg-post-grid .fpg-card-style .fpg-post-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();
		// Content Wrapper Style Section End

		// Thumbnail Style Section Start
		$this->fpg_register_thumbnail_style_controls_el( [
			'parent_selector' => '.fpg-post-grid'
		] );
		// Thumbnail Style Section End

		// Category Style Section Start
		$this->fpg_register_category_style_controls_el( [
			'parent_selector' => '.fpg-post-grid'
		] );
		// Category Style Section End

		// Title Style Section Start
		$this->fpg_register_title_style_controls_el( [
			'parent_selector' => '.fpg-post-grid'
		] );
		// Title Style Section End

		// Description Style Section Start
		$this->fpg_register_desc_style_controls_el( [
			'parent_selector' => '.fpg-post-grid'
		] );
		// Description Style Section End

		// Meta Style Section Start
		$this->fpg_register_meta_style_controls_el( [
			'parent_selector' => '.fpg-post-grid'
		] );
		// Meta Style Section End

		// Button Style Section Start
		$this->fpg_register_button_style_controls_el( [
			'parent_selector' => '.fpg-post-grid'
		] );
		// Button Style Section End

		// Pagination Style Start
		$this->fpg_register_pagination_style_controls_el( [
			'parent_selector' => '.fpg-post-parent'
		] );
		// Pagination Style Start

		// Button Style Section Start
		$this->fpg_register_load_more_style_controls_el( [
			'parent_selector' => '.fpg-post-parent'
		] );
		// Button Style Section End

	}

	protected function render() {
		$settings            = $this->get_settings_for_display();
		$id                  = 'id_' . $this->get_id();
		$cardStyle           = $settings[ 'style' ];
		$titleWord           = ! empty( $settings[ 'title_length' ] ) ? $settings[ 'title_length' ] : 500;
		$titleWordDot        = ( 'yes' === $settings[ 'title_length_double_dot' ] ) ? '...' : '';
		$titleHoverUnderline = ( 'yes' === $settings[ 'title_hover_underline' ] ) ? 'underline' : '';
		$descWord            = ! empty( $settings[ 'post_desc_word' ] ) ? $settings[ 'post_desc_word' ] : 50;
		$ajaxConfig          = [];
		$ajaxCls             = '';

		$separator_value = ! empty( $settings[ 'meta_separator' ] ) ? $settings[ 'meta_separator' ] : '';

		$btnTxt = ! empty( $settings[ 'btn_text' ] ) ? $settings[ 'btn_text' ] : 'Read More';

		$is_builder_preview = Plugin::$instance->editor->is_edit_mode() || 'rstb_template' === get_post_type();
		$is_archive_query   = ( 'archive' === $settings[ 'query_type' ] );

		if ( $is_archive_query && ! $is_builder_preview ) {
			global $wp_query;
			$query = $wp_query;
		} else {
			$query    = $this->fpg_get_query( $settings, 'post', $paged = 1 );
			$queryArg = $this->fpg_build_query_args( $settings, 'post' );
			if ( ( 'yes' === $settings[ 'show_pagination' ] ) && ( 'load_more' === $settings[ 'pagination_type' ] ) ) {
				$queryArg[ 'post_per_click' ] = $settings[ 'post_per_click' ];
				$ajaxConfig                   = [
					'data-settings' => wp_json_encode( [
						'query_arg'   => $queryArg,
						'el_settings' => [
							'id'                       => $id,
							'style'                    => $cardStyle,
							'show_post_thumbnail'      => $settings[ 'show_post_thumbnail' ],
							'thumbnail_size'           => $settings[ 'thumbnail_size' ],
							'thumbnail_type'           => $settings[ 'thumbnail_type' ],
							'show_thumbnail_overlay'   => $settings[ 'show_thumbnail_overlay' ],
							'show_post_categories'     => $settings[ 'show_post_categories' ],
							'show_post_title'          => $settings[ 'show_post_title' ],
							'title_tag'                => $settings[ 'title_tag' ],
							'title_length'             => $settings[ 'title_length' ],
							'title_length_double_dot'  => $settings[ 'title_length_double_dot' ],
							'title_hover_underline'    => $settings[ 'title_hover_underline' ],
							'show_post_desc'           => $settings[ 'show_post_desc' ],
							'post_desc_word'           => $settings[ 'post_desc_word' ],
							'show_meta_data'           => $settings[ 'show_meta_data' ],
							'meta_separator'           => $settings[ 'meta_separator' ],
							'show_meta_data_icon'      => $settings[ 'show_meta_data_icon' ],
							'show_post_author'         => $settings[ 'show_post_author' ],
							'author_icon_visibility'   => $settings[ 'author_icon_visibility' ],
							'author_image_icon'        => $settings[ 'author_image_icon' ],
							'author_prefix'            => $settings[ 'author_prefix' ],
							'show_post_views'          => $settings[ 'show_post_views' ],
							'show_post_views_icon'     => $settings[ 'show_post_views_icon' ],
							'show_post_tags'           => $settings[ 'show_post_tags' ],
							'show_post_tags_icon'      => $settings[ 'show_post_tags_icon' ],
							'show_comments_count'      => $settings[ 'show_comments_count' ],
							'show_comments_count_icon' => $settings[ 'show_comments_count_icon' ],
							'show_post_date'           => $settings[ 'show_post_date' ],
							'show_post_date_icon'      => $settings[ 'show_post_date_icon' ],

							'show_button'      => $settings[ 'show_button' ],
							'btn_text'         => $settings[ 'btn_text' ],
							'show_button_icon' => $settings[ 'show_button_icon' ],
							'btn_icon'         => $settings[ 'btn_icon' ],
						]
					] ),
				];
				$ajaxCls                      = 'fpg-ajax';
			}
		}

		$this->add_render_attribute( 'main', array_merge(
			[
				'class' => 'fpg-post-grid' . ' ' . $ajaxCls
			],
			$ajaxConfig
		) );
		?>

        <div class="fpg-post-parent">
            <div <?php $this->print_render_attribute_string( 'main' ); ?>>
				<?php
				if ( $query->in_the_loop ) {
					echo esc_html__('This page already in a loop & not archive page.', 'fancy-post-grid');
				} else {
					if ( $query->have_posts() ) {
						while ( $query->have_posts() ) : $query->the_post();
							$post_id         = get_the_ID();
							$post_categories = get_the_category();

							$postView = ! empty( get_post_meta( $post_id, '_fpg_post_views_count', true ) ) ? get_post_meta( $post_id, '_fpg_post_views_count', true ) : '';
							$postView = ! empty( $postView ) ? str_pad( $postView, 2, '0', STR_PAD_LEFT ) : 0;

							$postVideo = ! empty( get_post_meta( $post_id, '_fpg_video_link', true ) ) ? get_post_meta( $post_id, '_fpg_video_link', true ) : '';

							include FANCY_POST_GRID_PATH . "includes/ElementBlock/cards/card-style.php";
						endwhile;

						$this->fpg_reset_query();
					}
				}
				?>
            </div>

			<?php if ( 'yes' === $settings[ 'show_pagination' ] ) {
				if ( 'load_more' === $settings[ 'pagination_type' ] ) { ?>
                    <div class="fpg-loadmore-wrapper">
                        <button class="fpg-loadmore-btn"><?php echo esc_html( $settings[ 'load_more_btn_text' ] ); ?> <i class="ri-loop-left-line"></i></button>
                        <span class="fpg-load-complete-text" style="display: none;"><?php echo wp_kses_post( $settings[ 'load_complete_message' ] ) ?></span>
                    </div>
				<?php } else {
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
				}
			} ?>
        </div>
		<?php
	}
}