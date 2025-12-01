<?php
defined( 'ABSPATH' ) || die();

$cardStyle = !empty($cardStyle) ? $cardStyle : 'one';

if ('yes' === $settings['show_meta_data']) {
    $separator = !empty($separator_value) ? '<span class="fpg-meta-separator">' . $separator_value . '</span>' : '';
    $meta_items = [
        'post_author' => [
            'condition' => ('yes' === $settings['show_post_author']),
            'class'     => 'fpg-meta',
            'icon'      => (
                'yes' === $settings['show_meta_data_icon'] &&
                'yes' === $settings['author_icon_visibility']
            )
                ? (
                    'icon' === $settings['author_image_icon']
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
            'condition' => 'yes' === $settings['show_post_views'],
            'class'     => 'fpg-meta',
            'icon'      => ('yes' === $settings['show_meta_data_icon'] && 'yes' === $settings['show_post_views_icon']) 
                            ? '<i class="ri-pulse-fill"></i>' 
                            : '',
            'content'   => esc_html($postView) . ' ' . esc_html__('Views', 'fancy-post-grid'),
        ],
        'post_tags' => [
            'condition' => 'yes' === $settings['show_post_tags'] && !empty(get_the_tag_list('', ', ')),
            'class'     => 'fpg-meta',
            'icon'      => ('yes' === $settings['show_meta_data_icon'] && 'yes' === $settings['show_post_tags_icon']) ? '<i class="ri-price-tag-3-line"></i>' : '',
            'content'   => get_the_tag_list('', ', '),
        ],
        'comments_count' => [
            'condition' => 'yes' === $settings['show_comments_count'],
            'class'     => 'fpg-meta',
            'icon'      => ('yes' === $settings['show_meta_data_icon'] && 'yes' === $settings['show_comments_count_icon']) ? '<i class="ri-message-3-line"></i>' : '',
            'content'   => sprintf(
                '<a href="%s">%s</a>',
                esc_url(get_comments_link()),
                esc_html(get_comments_number_text(__('0 Comments', 'fancy-post-grid'), __('1 Comment', 'fancy-post-grid'), __('% Comments', 'fancy-post-grid')))
            ),
        ],
        'post_date' => [
            'condition' => 'yes' === $settings['show_post_date'],
            'class'     => 'fpg-meta',
            'icon'      => ('yes' === $settings['show_meta_data_icon'] && 'yes' === $settings['show_post_date_icon']) ? '<i class="ri-calendar-line"></i>' : '',
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
}
?>

<div class="fpg-card-style style-<?php echo esc_attr($cardStyle); ?>">
    <?php if (has_post_thumbnail() && ('yes' === $settings['show_post_thumbnail'])) { ?>
        <div class="fpg-post-thumb">
            <?php if (!empty($postVideo) && ('play_btn' === $settings['thumbnail_type'])) { ?>
                <?php the_post_thumbnail($settings['thumbnail_size']); ?>
                <a href="<?php echo esc_url($postVideo); ?>" class="fpg-play-btn popup-video">
                    <i class="ri-play-fill"></i>
                </a>
            <?php } elseif (!empty($postVideo) && ('video' === $settings['thumbnail_type'])) {
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
                    <?php the_post_thumbnail($settings['thumbnail_size']); ?>
                </a>
            <?php }
            if ('yes' === $settings['show_thumbnail_overlay']) {
                echo '<div class="thumb-overlay"></div>';
            } ?>
        </div>
    <?php } ?>
    <div class="fpg-post-content">
        <?php if (('yes' === $settings['show_meta_data']) && ('before_content' === $settings['meta_appearance'])) {
            echo $metadata;
        } ?>
        <div class="fpg-post-content-inner">
            <?php
                if ( 'yes' === $settings['show_post_categories'] && !empty( $post_categories ) ) {
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
                if ('yes' === $settings['show_post_title']) {
                    printf(
                        '<%1$s class="%2$s"><a href="%3$s">%4$s</a></%1$s>',
                        $settings['title_tag'],
                        'fpg-post-title '.$titleHoverUnderline,
                        get_permalink(),
                        esc_html(wp_trim_words(get_the_title(), $titleWord, $titleWordDot))
                    );
                }
                if (('yes' === $settings['show_meta_data']) && ('after_title' === $settings['meta_appearance'])) {
                    echo $metadata;
                }
                if ('yes' === $settings['show_post_desc']) {
                    $raw_excerpt = has_excerpt() ? get_the_excerpt() : wp_strip_all_tags( get_the_content() );
                    $the_excerpt = wp_trim_words( $raw_excerpt, $descWord, '...' );
                    printf( '<p class="fpg-post-excerpt">%1$s</p>',
                        $the_excerpt
                    );
                }
            ?>
        </div>
        <?php if (('yes' === $settings['show_meta_data']) && empty($settings['meta_appearance'])) {
            echo $metadata;
        }
        if ('yes' === $settings['show_button']) {?>
            <div class="fpg-btn-wrapper">
                <a href="<?php the_permalink(); ?>">
                    <?php
                        echo esc_html($btnTxt);
                        if ('yes' === $settings['show_button_icon']) {
                            \Elementor\Icons_Manager::render_icon( $settings['btn_icon'], [ 'aria-hidden' => 'true' ] );
                        }
                    ?>
                </a>
            </div>
        <?php } ?>
    </div>
</div>