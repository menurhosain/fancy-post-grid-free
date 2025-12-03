<?php
if (!defined('ABSPATH')) exit;
ob_start();
?>

<section class="fpg-blog-layout-5">
    <div class="container">
        <div class="row">

            <?php
            // Load query builder
            $dir = plugin_dir_path(__FILE__);
            require $dir . 'common-query-grid.php';
            ?>

            <?php if ($query->have_posts()) : ?>
                <?php while ($query->have_posts()) : $query->the_post(); ?>

                    <?php
                    // Build column classes
                    $main_cl_lg = empty($fancy_post_cl_lg) ? 'col-lg-4' : 'col-lg-' . $fancy_post_cl_lg;
                    $main_cl_md = empty($fancy_post_cl_md) ? 'col-md-4' : 'col-md-' . $fancy_post_cl_md;
                    $main_cl_sm = empty($fancy_post_cl_sm) ? 'col-sm-6' : 'col-sm-' . $fancy_post_cl_sm;
                    $main_cl_mobile = empty($fancy_post_cl_mobile) ? 'col-sm-12' : 'col-sm-' . $fancy_post_cl_mobile;

                    // Target
                    $target_blank = ($fancy_link_target === 'new') ? 'target="_blank"' : '';

                    // Title tag
                    $title_tag = !empty($fancy_post_title_tag) ? $fancy_post_title_tag : 'h3';

                    // Feature image hide
                    $hide_feature_image = isset($fancy_post_hide_feature_image) && $fancy_post_hide_feature_image === 'off';

                    // Feature image
                    $feature_image_size = isset($fancy_post_feature_image_size) ? $fancy_post_feature_image_size : 'full';

                    // Media source
                    $media_source = isset($fancy_post_media_source) ? $fancy_post_media_source : 'feature_image';

                    // Hover animation
                    $hover_animation = !empty($fancy_post_hover_animation) ? $fancy_post_hover_animation : 'none';
                    $hover_class = $hover_animation !== 'none' ? 'hover-' . esc_attr($hover_animation) : '';

                    // Get feature / first image
                    if ($media_source === 'first_image') {
                        $content = get_the_content();
                        preg_match_all('/<img[^>]+>/i', $content, $matches);
                        $first_image = !empty($matches[0][0]) ? $matches[0][0] : '';
                        preg_match('/src="([^"]+)"/i', $first_image, $img_src);
                        $feature_image_url = !empty($img_src[1]) ? $img_src[1] :
                            get_the_post_thumbnail_url(get_the_ID(), $feature_image_size);
                    } else {
                        $feature_image_url = get_the_post_thumbnail_url(get_the_ID(), $feature_image_size);
                    }
                    ?>

                    <div class="<?php echo esc_attr("$main_cl_lg $main_cl_md $main_cl_sm $main_cl_mobile"); ?>">
                        <div class="fpg-blog__single mt-30 <?php echo esc_attr($hover_class); ?>">

                            <?php if (!$hide_feature_image && $feature_image_url) : ?>
                                <div class="fpg-thumb">
                                    <a href="<?php the_permalink(); ?>" <?php echo $target_blank; ?>>
                                        <?php
                                        $thumbnail_id = get_post_thumbnail_id(get_the_ID());
                                        $image_alt = get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true);
                                        $image_title = get_the_title($thumbnail_id);
                                        $alt_text = !empty($image_alt) ? $image_alt : $image_title;
                                        ?>
                                        <img src="<?php echo esc_url($feature_image_url); ?>"
                                             alt="<?php echo esc_attr($alt_text); ?>">
                                    </a>
                                </div>
                            <?php endif; ?>

                            <div class="fpg-content">
                                <ul class="meta-data-list">
                                    <?php if ($fpg_field_group_post_date) : ?>
                                        <li class="meta-date">
                                            <i class="ri-calendar-2-line"></i>
                                            <?php echo get_the_date('M d, Y'); ?>
                                        </li>
                                    <?php endif; ?>

                                    <?php if ($fpg_field_group_author) : ?>
                                        <li class="meta-author">
                                            <i class="ri-user-line"></i>
                                            <a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>"
                                                <?php echo $target_blank; ?>>
                                                <?php the_author(); ?>
                                            </a>
                                        </li>
                                    <?php endif; ?>

                                    <?php if ($fpg_field_group_categories) : ?>
                                        <li class="meta-categories">
                                            <i class="ri-folder-line"></i>
                                            <?php the_category(', '); ?>
                                        </li>
                                    <?php endif; ?>

                                    <?php if ($fpg_field_group_comment_count && get_comments_number() > 0) : ?>
                                        <li class="meta-comment-count">
                                            <i class="ri-chat-3-line"></i>
                                            <?php comments_number('0 Comments', '1 Comment', '% Comments'); ?>
                                        </li>
                                    <?php endif; ?>

                                    <?php if ($fpg_field_group_tag && has_tag()) : ?>
                                        <li class="meta-tags">
                                            <i class="ri-price-tag-3-line"></i>
                                            <?php the_tags('', ', ', ''); ?>
                                        </li>
                                    <?php endif; ?>
                                </ul>

                                <<?php echo $title_tag; ?> class="title">
                                    <a href="<?php the_permalink(); ?>" <?php echo $target_blank; ?>>
                                        <?php echo esc_html(wp_trim_words(get_the_title(), $fancy_post_title_limit, $title_more_text)); ?>
                                    </a>
                                </<?php echo $title_tag; ?>>

                                <?php if ($fpg_field_group_excerpt) : ?>
                                    <div class="fpg-excerpt">
                                        <p>
                                            <?php
                                            $excerpt = wp_strip_all_tags(get_the_content());
                                            echo esc_html(wp_trim_words($excerpt, $fancy_post_excerpt_limit, $excerpt_more_text));
                                            ?>
                                        </p>
                                    </div>
                                <?php endif; ?>

                                <?php if ($fpg_field_group_read_more) : ?>
                                    <div class="btn-wrapper">
                                        <a class="fpg-link read-more" href="<?php the_permalink(); ?>" <?php echo $target_blank; ?>>
                                            <?php echo esc_html($fancy_post_read_more_text); ?>
                                            <i class="ri-arrow-right-line"></i>
                                        </a>
                                    </div>
                                <?php endif; ?>

                            </div>
                        </div>
                    </div>

                <?php endwhile; ?>
                <?php wp_reset_postdata(); ?>
            <?php endif; ?>

        </div>

        <?php if ($fancy_post_pagination === 'on') : ?>
            <div class="fpg-pagination">
                <?php
                echo paginate_links(array(
                    'total'     => $query->max_num_pages,
                    'current'   => max(1, get_query_var('paged')),
                    'format'    => '?paged=%#%',
                    'type'      => 'list',
                    'prev_text' => __('« Prev'),
                    'next_text' => __('Next »'),
                ));
                ?>
            </div>
        <?php endif; ?>

    </div>
</section>


<style type="text/css">
    /* General Styles */
    .fpg-blog-layout-5 {
        <?php if (!empty($fpg_section_background_color)) : ?>
            background-color: <?php echo esc_attr($fpg_section_background_color); ?>;
        <?php endif; ?>
        <?php if (!empty($fpg_section_margin)) : ?>
            margin: <?php echo esc_attr($fpg_section_margin); ?>;
        <?php endif; ?>
        <?php if (!empty($fpg_section_padding)) : ?>
            padding: <?php echo esc_attr($fpg_section_padding); ?>;
        <?php endif; ?>
    }

    /* Single Item Styles */
    .fpg-blog-layout-5 .fpg-blog__single {
        <?php if (!empty($fpg_single_section_background_color)) : ?>
            background-color: <?php echo esc_attr($fpg_single_section_background_color); ?>;
        <?php endif; ?>
        <?php if (!empty($fpg_single_section_margin)) : ?>
            margin: <?php echo esc_attr($fpg_single_section_margin); ?>;
        <?php endif; ?>
        <?php if (!empty($fpg_single_section_padding)) : ?>
            padding: <?php echo esc_attr($fpg_single_section_padding); ?>;
        <?php endif; ?>
        <?php if (!empty($fancy_post_section_border_radius)) : ?>
            border-radius: <?php echo esc_attr($fancy_post_section_border_radius); ?>;
        <?php endif; ?>
    }
    .fpg-blog-layout-5 .fpg-blog__single .fpg-thumb{
        <?php if (!empty($fancy_post_image_border_radius)) : ?>
            border-radius: <?php echo esc_attr($fancy_post_image_border_radius); ?>;
        <?php endif; ?>
    }

    .fpg-blog-layout-5 .fpg-blog__single .fpg-content {
        <?php if (!empty($fpg_single_section_border_color)) : ?>
            border-color: <?php echo esc_attr($fpg_single_section_border_color); ?>;
        <?php endif; ?>
        <?php if (!empty($fancy_post_border_style)) : ?>
            border-style: <?php echo esc_attr($fancy_post_border_style); ?>;
        <?php endif; ?>
        <?php if (!empty($fancy_post_border_width)) : ?>
            border-width: <?php echo esc_attr($fancy_post_border_width); ?>;
        <?php endif; ?>
        <?php if (!empty($fpg_single_content_section_padding)) : ?>
            padding: <?php echo esc_attr($fpg_single_content_section_padding); ?>;
        <?php endif; ?>
    }

    /* Title Styles */
    .fpg-blog-layout-5 .fpg-blog__single .fpg-content .title {
        
        <?php if (!empty($fpg_title_order)) : ?>
            order: <?php echo esc_attr($fpg_title_order); ?>;
        <?php endif; ?>
        
        <?php if (!empty($fpg_title_border_color)) : ?>
            border-color: <?php echo esc_attr($fpg_title_border_color); ?>;
        <?php endif; ?>
        <?php if (!empty($fpg_title_border_style)) : ?>
            border-style: <?php echo esc_attr($fpg_title_border_style); ?>;
        <?php endif; ?>
        <?php if (!empty($fpg_title_border_width)) : ?>
            border-width: <?php echo esc_attr($fpg_title_border_width); ?>;
        <?php endif; ?>
        <?php if (!empty($fpg_title_line_height)) : ?>
            line-height: <?php echo esc_attr($fpg_title_line_height); ?>;
        <?php endif; ?>
    }

    /* Title Styles */
    .fpg-blog-layout-5 .fpg-blog__single .fpg-content .title a {
    	padding: <?php echo esc_attr($fpg_title_padding); ?>;
        margin: <?php echo esc_attr($fpg_title_margin); ?>;
        <?php if (!empty($fpg_secondary_color) || !empty($fpg_title_color)) : ?>
            color: <?php echo esc_attr(!empty($fpg_secondary_color) ? $fpg_secondary_color : $fpg_title_color); ?>;
        <?php endif; ?>

        <?php if (!empty($fpg_title_font_size)) : ?>
            font-size: <?php echo esc_attr($fpg_title_font_size); ?>px;
        <?php endif; ?>
        <?php if (!empty($fpg_title_font_weight)) : ?>
            font-weight: <?php echo esc_attr($fpg_title_font_weight); ?>;
        <?php endif; ?>
        
    }

    .fpg-blog-layout-5 .fpg-blog__single .fpg-content .title a:hover {
        <?php if (!empty($fpg_title_hover_color)) : ?>
            color: <?php echo esc_attr($fpg_title_hover_color); ?>;
        <?php endif; ?>
    }

    .fpg-blog-layout-5 .title-link {
        <?php if (!empty($fpg_title_color)) : ?>
            color: <?php echo esc_attr($fpg_title_color); ?>;
        <?php endif; ?>
    }

    .fpg-blog-layout-5 .title-link:hover {
        <?php if (!empty($fpg_title_hover_color)) : ?>
            color: <?php echo esc_attr($fpg_title_hover_color); ?>;
        <?php endif; ?>
    }

    /* Excerpt Styles */
    .fpg-blog-layout-5 .fpg-excerpt {
        
        <?php if (!empty($fpg_body_color) || !empty($fpg_excerpt_color)) : ?>
            color: <?php echo esc_attr(!empty($fpg_body_color) ? $fpg_body_color : $fpg_excerpt_color); ?>;
        <?php endif; ?>
        <?php if (!empty($fpg_excerpt_size)) : ?>
            font-size: <?php echo esc_attr($fpg_excerpt_size); ?>px;
        <?php endif; ?>
        <?php if (!empty($fpg_excerpt_font_weight)) : ?>
            font-weight: <?php echo esc_attr($fpg_excerpt_font_weight); ?>;
        <?php endif; ?>
        <?php if (!empty($fpg_excerpt_line_height)) : ?>
            line-height: <?php echo esc_attr($fpg_excerpt_line_height); ?>;
        <?php endif; ?>
        
        
    }
    .fpg-blog-layout-5 .fpg-blog__single .fpg-content .fpg-excerpt{
        <?php if (!empty($fpg_excerpt_order)) : ?>
            order: <?php echo esc_attr($fpg_excerpt_order); ?>;
        <?php endif; ?>

    }
    .fpg-blog-layout-5 .fpg-blog__single .fpg-content .fpg-excerpt p{
        
        <?php if (!empty($fpg_excerpt_padding)) : ?>
            padding: <?php echo esc_attr($fpg_excerpt_padding); ?>;
        <?php endif; ?>
        <?php if (!empty($fpg_excerpt_margin)) : ?>
            margin: <?php echo esc_attr($fpg_excerpt_margin); ?>;
        <?php endif; ?>
    }

    .fpg-blog-layout-5 .fpg-blog__single .fpg-content .btn-wrapper{
        <?php if (!empty($fpg_button_padding)) : ?>
            padding: <?php echo esc_attr($fpg_button_padding); ?>;
        <?php endif; ?>
        <?php if (!empty($fpg_button_margin)) : ?>
            margin: <?php echo esc_attr($fpg_button_margin); ?>;
        <?php endif; ?>
    }
    /* Meta Data Styles */

    .fpg-blog-layout-5 .fpg-blog__single .fpg-content ul{
        <?php if (!empty($fpg_meta_order)) : ?>
            order: <?php echo esc_attr($fpg_meta_order); ?>;
        <?php endif; ?>
        <?php if (!empty($fpg_meta_padding)) : ?>
            padding: <?php echo esc_attr($fpg_meta_padding); ?>;
        <?php endif; ?>
        <?php if (!empty($fpg_meta_margin)) : ?>
            margin: <?php echo esc_attr($fpg_meta_margin); ?>;
        <?php endif; ?>
    }

    .fpg-blog-layout-5 .fpg-blog__single .fpg-content ul{
        <?php if (!empty($fpg_meta_gap)) : ?>
            gap: <?php echo esc_attr($fpg_meta_gap); ?>;
        <?php endif; ?>
        <?php if (!empty($fpg_meta_line_height)) : ?>
            line-height: <?php echo esc_attr($fpg_meta_line_height); ?>;
        <?php endif; ?>
    }

    .fpg-blog-layout-5 .fpg-blog__single .fpg-content ul li,
    .fpg-blog-layout-5 .fpg-blog__single .fpg-content ul li a,
    .fpg-blog-layout-5 .meta-data-list .meta-date i,
    .fpg-blog-layout-5 .meta-data-list .meta-author i,
    .fpg-blog-layout-5 .meta-data-list .meta-categories i,
    .fpg-blog-layout-5 .meta-data-list .meta-comment-count i,
    .fpg-blog-layout-5 .meta-data-list .meta-tags i
    {
        <?php if (!empty($fpg_meta_color)) : ?>
            color: <?php echo esc_attr($fpg_meta_color); ?>;
        <?php endif; ?>

        <?php if (!empty($fpg_meta_size)) : ?>
            font-size: <?php echo esc_attr($fpg_meta_size); ?>px;
        <?php endif; ?>
        <?php if (!empty($fpg_meta_font_weight)) : ?>
            font-weight: <?php echo esc_attr($fpg_meta_font_weight); ?>;
        <?php endif; ?>
    }

    .fpg-blog-layout-5 .fpg-blog__single .fpg-content ul li i{
        
        <?php if (!empty($fpg_primary_color) || !empty($fpg_meta_icon_color)) : ?>
            color: <?php echo esc_attr(!empty($fpg_primary_color) ? $fpg_primary_color : $fpg_meta_icon_color); ?>;
        <?php endif; ?>
        <?php if (!empty($fpg_meta_size)) : ?>
            font-size: <?php echo esc_attr($fpg_meta_size); ?>px;
        <?php endif; ?>
        <?php if (!empty($fpg_meta_font_weight)) : ?>
            font-weight: <?php echo esc_attr($fpg_meta_font_weight); ?>;
        <?php endif; ?>
    }
    .fpg-blog-layout-5 .fpg-blog__single .fpg-content ul li a:hover{
        
        <?php if (!empty($fpg_meta_hover_color)) : ?>
            color: <?php echo esc_attr($fpg_meta_hover_color); ?>;
        <?php endif; ?>
    }

    /* Button Styles */
    .fpg-blog-layout-5 .fpg-blog__single .fpg-content .fpg-link.<?php echo esc_attr($button_class); ?>{
        <?php if (!empty($fpg_button_background_color)) : ?>
            background-color: <?php echo esc_attr($fpg_button_background_color); ?>;
        <?php endif; ?>

        <?php if (!empty($fpg_secondary_color) || !empty($fpg_button_text_color)) : ?>
            color: <?php echo esc_attr(!empty($fpg_secondary_color) ? $fpg_secondary_color : $fpg_button_text_color); ?>;
        <?php endif; ?>

        <?php if (!empty($fancy_post_read_more_border_radius)) : ?>
            border-radius: <?php echo esc_attr($fancy_post_read_more_border_radius); ?>;
        <?php endif; ?>
        <?php if (!empty($fpg_border_color)) : ?>
            border-color: <?php echo esc_attr($fpg_border_color); ?>;
        <?php endif; ?>
        <?php if (!empty($fancy_button_border_style)) : ?>
            border-style: <?php echo esc_attr($fancy_button_border_style); ?>;
        <?php endif; ?>
        <?php if (!empty($fancy_post_border_width)) : ?>
            border-width: <?php echo esc_attr($fancy_post_border_width); ?>;
        <?php endif; ?>
        <?php if (!empty($fpg_button_font_size)) : ?>
            font-size: <?php echo esc_attr($fpg_button_font_size); ?>;
        <?php endif; ?>
        <?php if (!empty($fpg_button_font_weight)) : ?>
            font-weight: <?php echo esc_attr($fpg_button_font_weight); ?>;
        <?php endif; ?>

    }

    .fpg-blog-layout-5 .fpg-blog__single .fpg-content .btn-wrapper{
        <?php if (!empty($fpg_button_order)) : ?>
            order: <?php echo esc_attr($fpg_button_order); ?>;
        <?php endif; ?>

    }
    .fpg-blog-layout-5 .fpg-blog__single .fpg-content .fpg-link.<?php echo esc_attr($button_class); ?>:hover {
        <?php if (!empty($fpg_button_hover_background_color)) : ?>
            background-color: <?php echo esc_attr($fpg_button_hover_background_color); ?>;
        <?php endif; ?>
        <?php if (!empty($fpg_button_text_hover_color)) : ?>
            color: <?php echo esc_attr($fpg_button_text_hover_color); ?>;
        <?php endif; ?>
    }
    .fpg-blog-layout-5 .fpg-blog__single .fpg-content .fpg-link.<?php echo esc_attr($button_class); ?>::before{
        <?php if (!empty($fpg_button_border_color)) : ?>
            background: <?php echo esc_attr($fpg_button_border_color); ?>;
        <?php endif; ?>
    }

    /*Pagination*/
    .fpg-pagination ul.fancy-page-numbers{
        <?php if (!empty($fpg_pagination_gap)) : ?>
            gap: <?php echo esc_attr($fpg_pagination_gap); ?>;
        <?php endif; ?> 
    }
    .fpg-pagination ul.fancy-page-numbers li .fpg-page-numbers {

        <?php if (!empty($fpg_pagination_background)) : ?>
            background-color: <?php echo esc_attr($fpg_pagination_background); ?>;
        <?php endif; ?>
        <?php if (!empty($fpg_pagination_color)) : ?>
            color: <?php echo esc_attr($fpg_pagination_color); ?>;
        <?php endif; ?>
        <?php if (!empty($fpg_pagination_border_color)) : ?>
            border-color: <?php echo esc_attr($fpg_pagination_border_color); ?>;
        <?php endif; ?>
        

        <?php if (!empty($fpg_pagination_border_width)) : ?>
            border-width: <?php echo esc_attr($fpg_pagination_border_width); ?>;
        <?php endif; ?>

        <?php if (!empty($fpg_pagination_border_style)) : ?>
            border-style: <?php echo esc_attr($fpg_pagination_border_style); ?>;
        <?php endif; ?>

        <?php if (!empty($fpg_pagination_border_radius)) : ?>
            border-radius: <?php echo esc_attr($fpg_pagination_border_radius); ?>;
        <?php endif; ?>
        <?php if (!empty($fpg_pagination_height)) : ?>
            height: <?php echo esc_attr($fpg_pagination_height); ?>;
        <?php endif; ?>

        <?php if (!empty($fpg_pagination_width)) : ?>
            width: <?php echo esc_attr($fpg_pagination_width); ?>;
        <?php endif; ?>

        <?php if (!empty($fpg_pagination_padding)) : ?>
            padding: <?php echo esc_attr($fpg_pagination_padding); ?>;
        <?php endif; ?>
        <?php if (!empty($fpg_pagination_margin)) : ?>
            margin: <?php echo esc_attr($fpg_pagination_margin); ?>;
        <?php endif; ?> 
    }
    .fpg-pagination ul.fancy-page-numbers li .fpg-page-numbers:hover{
        <?php if (!empty($fpg_pagination_hover_background)) : ?>
            background-color: <?php echo esc_attr($fpg_pagination_hover_background); ?>;
        <?php endif; ?>
        <?php if (!empty($fpg_pagination_hover_color)) : ?>
            color: <?php echo esc_attr($fpg_pagination_hover_color); ?>;
        <?php endif; ?>
        <?php if (!empty($fpg_pagination_hover_border_color)) : ?>
            border-color: <?php echo esc_attr($fpg_pagination_hover_border_color); ?>;
        <?php endif; ?>
    }
    .fpg-pagination ul.fancy-page-numbers li .fpg-page-numbers.current{
        <?php if (!empty($fpg_pagination_active_background)) : ?>
            background-color: <?php echo esc_attr($fpg_pagination_active_background); ?>;
        <?php endif; ?>
        <?php if (!empty($fpg_pagination_active_color)) : ?>
            color: <?php echo esc_attr($fpg_pagination_active_color); ?>;
        <?php endif; ?>
        <?php if (!empty($fpg_pagination_active_border_color)) : ?>
            border-color: <?php echo esc_attr($fpg_pagination_active_border_color); ?>;
        <?php endif; ?>
    }
</style>


<!-- End Blog Grid Layout 1 -->
<?php
$grid1 = ob_get_clean();
?>