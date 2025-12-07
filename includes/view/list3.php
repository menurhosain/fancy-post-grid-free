<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
ob_start();
?>
<!-- ==== Blog Grid Layout 3 ==== -->
<section class="fpg-blog-layout-17 grey">
    <div class="container">
        <div class="row">

            <?php              
                $dir = plugin_dir_path(__FILE__);
                require $dir . 'common-query-list.php';
                if ($query->have_posts()) : 

                // Loop through the custom query
                while ($query->have_posts()) : $query->the_post();

                    // Check if the link should open in a new tab
                    $target_blank = ($fancy_link_target === 'new') ? 'target="_blank"' : '';
                    
                    // Determine the title tag
                    $title_tag = !empty($fancy_post_title_tag) ? $fancy_post_title_tag : 'h3';
                    
                    // Determine if the feature image should be hidden
                    $hide_feature_image = isset($fancy_post_hide_feature_image) && $fancy_post_hide_feature_image === 'off';
                    
                    // Determine the feature image size                    
                    $feature_image_left_size = isset($fancy_post_feature_image_left) ? (string) $fancy_post_feature_image_left : '';  

                    $feature_image_right_size = isset($fancy_post_feature_image_right) ? (string) $fancy_post_feature_image_right : ''; 
                  
                    // Determine the media source
                    $media_source = isset($fancy_post_media_source) ? $fancy_post_media_source : 'feature_image';
                    
                    // Determine the hover animation
                    $hover_animation = !empty($fancy_post_hover_animation) ? $fancy_post_hover_animation : 'none';
                    
                    // Get the feature image or first image from content
                    if ($media_source === 'first_image') {

                        $content = get_the_content();
                        preg_match_all('/<img[^>]+>/i', $content, $matches);
                        $first_image = !empty($matches[0][0]) ? $matches[0][0] : '';
                        preg_match('/src="([^"]+)"/i', $first_image, $img_src);
                        $feature_image_left_url = !empty($img_src[1]) ? $img_src[1] : get_the_post_thumbnail_url(get_the_ID(), $feature_image_left_size);
                    } else {
                        $feature_image_left_url = get_the_post_thumbnail_url(get_the_ID(), $feature_image_left_size);
                    }

                    // Get the feature image or first image from content
                    if ($media_source === 'first_image') {

                        $content = get_the_content();
                        preg_match_all('/<img[^>]+>/i', $content, $matches);
                        $first_image = !empty($matches[0][0]) ? $matches[0][0] : '';
                        preg_match('/src="([^"]+)"/i', $first_image, $img_src);
                        $feature_image_right_url = !empty($img_src[1]) ? $img_src[1] : get_the_post_thumbnail_url(get_the_ID(), $feature_image_right_size);
                    } else {
                        $feature_image_right_url = get_the_post_thumbnail_url(get_the_ID(), $feature_image_right_size);
                    }

                    // Apply hover animation class if needed
                    $hover_class = $hover_animation !== 'none' ? 'hover-' . esc_attr($hover_animation) : '';
            ?>
                <?php if ($query->current_post === 0) : ?>
                <div class="col-lg-6 md-mb-50">

                    <div class="fpg-blog-layout-17-item <?php echo esc_attr($main_alignment_class); ?> <?php echo esc_attr($hover_class); ?>">
                        <!-- Image -->
                        <?php if (!$hide_feature_image && $fpg_field_group_image) : ?>    
                        <div class="fpg-thumb">
                            <?php if ($feature_image_left_url) : ?>
                                <?php
                                    $post_id = get_the_ID();
                                    // Get the thumbnail ID
                                    $thumbnail_id = get_post_thumbnail_id($post_id);
                                    
                                    // Get the image alt text and title text
                                    $image_alt = get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true);
                                    $image_title = get_the_title($thumbnail_id);
                                    // Use alt text if available; otherwise, use title text
                                    $alt_text = !empty($image_alt) ? esc_attr($image_alt) : esc_attr($image_title);

                                ?>
                                <a href="<?php the_permalink(); ?>" <?php echo esc_attr($target_blank); ?>>
                                    <img src="<?php echo esc_url( $feature_image_left_url ); ?>" alt="<?php echo esc_attr( $alt_text ); ?>">
                                </a>
                            <?php endif; ?>
                        </div>
                        <?php endif; ?>
                        
                        <div class="fpg-content">
                            <div class="fpg-meta">
                                <ul class="blog-meta <?php echo esc_attr($meta_alignment_class); ?>">
                                    <?php if ($fpg_field_group_post_date) : ?>
                                        <li class="meta-date">
                                            <?php if (!empty($fpg_field_group_date_icon) && empty($disabled_meta_icons['date_icon'])) {?>
                                            <i class="ri-calendar-2-line"></i>
                                            <?php } ?>
                                            <?php echo get_the_date('M d, Y'); ?>
                                        </li>
                                    <?php endif; ?>
                                    
                                    <?php if ($fpg_field_group_author) : ?>
                                        <li class="meta-author">
                                            <?php if (!empty($fpg_field_group_author_icon) && empty($disabled_meta_icons['author_icon'])) { ?>
                                            <i class="ri-user-line"></i>
                                            <?php } ?>
                                            <a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>"
                                                <?php echo esc_attr($target_blank); ?>>
                                                <?php the_author(); ?>
                                            </a> 
                                        </li>
                                    <?php endif; ?>
                                    
                                    <?php if ($fpg_field_group_categories) : ?>
                                        <li class="meta-categories">
                                            <?php if (!empty($fpg_field_group_category_icon) && empty($disabled_meta_icons['category_icon'])) {?>
                                            <i class="ri-folder-line"></i>
                                            <?php } ?>
                                            <?php the_category(', '); ?>
                                        </li>
                                    <?php endif; ?>                                  
                                    <?php if ($fpg_field_group_comment_count && get_comments_number() > 0) : ?>
                                        <li class="meta-comment-count">
                                            <?php if (!empty($fpg_field_group_comment_count_icon) && empty($disabled_meta_icons['comment_count_icon'])) {?>
                                            <i class="ri-chat-3-line"></i>
                                            <?php } ?>
                                            <?php comments_number('0 Comments', '1 Comment', '% Comments'); ?>
                                        </li>
                                    <?php endif; ?>
                                    <?php if ($fpg_field_group_tag && has_tag()) : ?>
                                        <li class="meta-tags">
                                            <?php if (!empty($fpg_field_group_tags_icon) && empty($disabled_meta_icons['tags_icon'])) {?>
                                            <i class="ri-price-tag-3-line"></i>
                                            <?php } ?>
                                            <?php the_tags('', ', ', ''); ?>
                                        </li>
                                    <?php endif; ?>
                                </ul>
                            </div>
                            <!-- Title -->
                            <?php if ($fpg_field_group_title) : ?>
                                <<?php echo esc_attr($title_tag); ?> class="blog-title <?php echo esc_attr($title_alignment_class); ?>">
                                <?php if ($fancy_link_details === 'on') : ?>
                                        <a href="<?php the_permalink(); ?>"
                                           <?php echo esc_attr($target_blank); ?>
                                           class="title-link">
                                            <?php
                                                if ($fancy_post_title_limit_type === 'words') {
                                                    echo esc_html(wp_trim_words(get_the_title(), $fancy_post_title_limit, $title_more_text));
                                                } elseif ($fancy_post_title_limit_type === 'characters') {
                                                    echo esc_html(mb_strimwidth(get_the_title(), 0, $fancy_post_title_limit, $title_more_text));
                                                }
                                            ?>
                                        </a>
                                    <?php else : ?>
                                        <?php
                                        if ($fancy_post_title_limit_type === 'words') {
                                            echo esc_html(wp_trim_words(get_the_title(), $fancy_post_title_limit, $title_more_text));
                                        } elseif ($fancy_post_title_limit_type === 'characters') {
                                            echo esc_html(mb_strimwidth(get_the_title(), 0, $fancy_post_title_limit, $title_more_text));
                                        }
                                        ?>
                                    <?php endif; ?>
                                </<?php echo esc_attr($title_tag); ?>>
                            <?php endif; ?>
                            
                            <!-- Button -->
                            <?php if ($fpg_field_group_read_more) : ?>
                                
                                <div class="blog-btn <?php echo esc_attr($button_alignment_class); ?>" >

                                    <a class="fpg-btn <?php echo esc_attr($button_class); ?>" 
                                       href="<?php the_permalink(); ?>" 
                                       <?php echo esc_attr($target_blank); ?> >    
                                        <?php echo esc_html($fancy_post_read_more_text); ?> 
                                    </a>
                                </div>
                            <?php endif; ?>
                            <!-- END Button -->
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="fpg-blog-layout-17-item fpg-blog-layout-17-item-list <?php echo esc_attr($main_alignment_class); ?> <?php echo esc_attr($hover_class); ?>" >
                        <?php elseif ($query->current_post === 1) : ?>
                        
                            <!-- Image -->
                            <?php if (!$hide_feature_image && $fpg_field_group_image) : ?> 
                               <div class="fpg-thumb">
                                    <?php if ($feature_image_right_url) : ?>
                                        <?php
                                            $post_id = get_the_ID();
                                            // Get the thumbnail ID
                                            $thumbnail_id = get_post_thumbnail_id($post_id);
                                            
                                            // Get the image alt text and title text
                                            $image_alt = get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true);
                                            $image_title = get_the_title($thumbnail_id);
                                            // Use alt text if available; otherwise, use title text
                                            $alt_text = !empty($image_alt) ? esc_attr($image_alt) : esc_attr($image_title);
                                        ?>
                                        <a href="<?php the_permalink(); ?>" <?php echo esc_attr($target_blank); ?>>
                                            <img src="<?php echo esc_url( $feature_image_right_url ); ?>" alt="<?php echo esc_attr( $alt_text ); ?>">
                                        </a>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>

                            <div class="fpg-content">
                                <div class="fpg-meta">
                                    <ul class="blog-meta <?php echo esc_attr($meta_alignment_class); ?>">
                                        <?php if ($fpg_field_group_post_date) : ?>
                                            <li class="meta-date">
                                                <?php if (!empty($fpg_field_group_date_icon) && empty($disabled_meta_icons['date_icon'])) {?>
                                                <i class="ri-calendar-2-line"></i>
                                                <?php } ?>
                                                <?php echo get_the_date('M d, Y'); ?>
                                            </li>
                                        <?php endif; ?>

                                        <?php if ($fpg_field_group_author) : ?>
                                            <li class="meta-author">
                                                <?php if (!empty($fpg_field_group_author_icon) && empty($disabled_meta_icons['author_icon'])) { ?>
                                                <i class="ri-user-line"></i>
                                                <?php } ?>
                                                <a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>"
                                                    <?php echo esc_attr($target_blank); ?>>
                                                    <?php the_author(); ?>
                                                </a> 
                                            </li>
                                        <?php endif; ?>
                                        
                                        <?php if ($fpg_field_group_categories) : ?>
                                            <li class="meta-categories">
                                                <?php if (!empty($fpg_field_group_category_icon) && empty($disabled_meta_icons['category_icon'])) {?>
                                                <i class="ri-folder-line"></i>
                                                <?php } ?>
                                                <?php the_category(', '); ?>
                                            </li>
                                        <?php endif; ?>                                  
                                        <?php if ($fpg_field_group_comment_count && get_comments_number() > 0) : ?>
                                            <li class="meta-comment-count">
                                                <?php if (!empty($fpg_field_group_comment_count_icon) && empty($disabled_meta_icons['comment_count_icon'])) {?>
                                                <i class="ri-chat-3-line"></i>
                                                <?php } ?>
                                                <?php comments_number('0 Comments', '1 Comment', '% Comments'); ?>
                                            </li>
                                        <?php endif; ?>
                                        <?php if ($fpg_field_group_tag && has_tag()) : ?>
                                            <li class="meta-tags">
                                                <?php if (!empty($fpg_field_group_tags_icon) && empty($disabled_meta_icons['tags_icon'])) {?>
                                                <i class="ri-price-tag-3-line"></i>
                                                <?php } ?>
                                                <?php the_tags('', ', ', ''); ?>
                                            </li>
                                        <?php endif; ?>
                                    </ul>
                                </div>

                                <!-- Title -->
                                <?php if ($fpg_field_group_title) : ?>
                                    <<?php echo esc_attr($title_tag); ?> class="title <?php echo esc_attr($title_alignment_class); ?>">
                                        <?php if ($fancy_link_details === 'on') : ?>
                                            <a href="<?php the_permalink(); ?>"
                                               <?php echo esc_attr($target_blank); ?>
                                               class="title-link">
                                                <?php
                                                    if ($fancy_post_title_limit_type === 'words') {
                                                        echo esc_html(wp_trim_words(get_the_title(), $fancy_post_title_limit, $title_more_text));
                                                    } elseif ($fancy_post_title_limit_type === 'characters') {
                                                        echo esc_html(mb_strimwidth(get_the_title(), 0, $fancy_post_title_limit, $title_more_text));
                                                    }
                                                ?>
                                            </a>
                                        <?php else : ?>
                                            <?php
                                            if ($fancy_post_title_limit_type === 'words') {
                                                echo esc_html(wp_trim_words(get_the_title(), $fancy_post_title_limit, $title_more_text));
                                            } elseif ($fancy_post_title_limit_type === 'characters') {
                                                echo esc_html(mb_strimwidth(get_the_title(), 0, $fancy_post_title_limit, $title_more_text));
                                            }
                                            ?>
                                        <?php endif; ?>
                                    </<?php echo esc_attr($title_tag); ?>>
                                <?php endif; ?>

                                <!-- Excerpt -->
                                <?php if ($fpg_field_group_excerpt) : ?>
                                    <div class="fpg-excerpt <?php echo esc_attr($excerpt_alignment_class); ?>">

                                        <p>
                                        <?php
                                            $excerpt = get_the_content();

                                            if ($fancy_post_excerpt_limit_type === 'words') {
                                                echo esc_html(wp_trim_words($excerpt, $fancy_post_excerpt_limit, $excerpt_more_text));
                                            } else {
                                                // Strip tags to avoid breaking HTML, then apply character limit
                                                $excerpt = wp_strip_all_tags($excerpt);
                                                echo esc_html(mb_strimwidth($excerpt, 0, $fancy_post_excerpt_limit, $excerpt_more_text));
                                            }
                                        ?>
                                        </p>
                                    </div>
                                <?php endif; ?>

                                <!-- Button -->
                                <?php if ($fpg_field_group_read_more) : ?>
                                    
                                    <div class="blog-btn <?php echo esc_attr($button_alignment_class); ?>">

                                        <a class="fpg-btn <?php echo esc_attr($button_class); ?>" 
                                           href="<?php the_permalink(); ?>" 
                                           <?php echo esc_attr($target_blank); ?>>
                                           
                                            <?php echo esc_html($fancy_post_read_more_text); ?>
                                            
                                        </a>
                                    </div>
                                <?php endif; ?>
                                <!-- END Button -->
                            </div>
                    </div>
                    <div class="fpg-blog-layout-17-item fpg-blog-layout-17-item-list <?php echo esc_attr($main_alignment_class); ?> <?php echo esc_attr($hover_class); ?>" >
                        <?php elseif ($query->current_post === 2) : ?>
                        
                            <!-- Image -->
                            <?php if (!$hide_feature_image && $fpg_field_group_image) : ?>    
                                <div class="fpg-thumb">
                                    <?php if ($feature_image_right_url) : ?>
                                        <?php
                                            $post_id = get_the_ID();
                                            // Get the thumbnail ID
                                            $thumbnail_id = get_post_thumbnail_id($post_id);
                                            
                                            // Get the image alt text and title text
                                            $image_alt = get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true);
                                            $image_title = get_the_title($thumbnail_id);
                                            // Use alt text if available; otherwise, use title text
                                            $alt_text = !empty($image_alt) ? esc_attr($image_alt) : esc_attr($image_title);
                                        ?>
                                        <a href="<?php the_permalink(); ?>" <?php echo esc_attr($target_blank); ?>>
                                            <img src="<?php echo esc_url( $feature_image_right_url ); ?>" alt="<?php echo esc_attr( $alt_text ); ?>">
                                        </a>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>

                            <div class="fpg-content">
                                <div class="fpg-meta">
                                    <ul class="blog-meta <?php echo esc_attr($meta_alignment_class); ?>">
                                        <?php if ($fpg_field_group_post_date) : ?>
                                            <li class="meta-date">
                                                <?php if (!empty($fpg_field_group_date_icon) && empty($disabled_meta_icons['date_icon'])) {?>
                                                <i class="ri-calendar-2-line"></i>
                                                <?php } ?>
                                                <?php echo get_the_date('M d, Y'); ?>
                                            </li>
                                        <?php endif; ?>
                                        
                                        <?php if ($fpg_field_group_author) : ?>
                                            <li class="meta-author">
                                                <?php if (!empty($fpg_field_group_author_icon) && empty($disabled_meta_icons['author_icon'])) { ?>
                                                <i class="ri-user-line"></i>
                                                <?php } ?>
                                                <a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>"
                                                    <?php echo esc_attr($target_blank); ?>>
                                                    <?php the_author(); ?>
                                                </a> 
                                            </li>
                                        <?php endif; ?>
                                        
                                        <?php if ($fpg_field_group_categories) : ?>
                                            <li class="meta-categories">
                                                <?php if (!empty($fpg_field_group_category_icon) && empty($disabled_meta_icons['category_icon'])) {?>
                                                <i class="ri-folder-line"></i>
                                                <?php } ?>
                                                <?php the_category(', '); ?>
                                            </li>
                                        <?php endif; ?>                                  
                                        <?php if ($fpg_field_group_comment_count && get_comments_number() > 0) : ?>
                                            <li class="meta-comment-count">
                                                <?php if (!empty($fpg_field_group_comment_count_icon) && empty($disabled_meta_icons['comment_count_icon'])) {?>
                                                <i class="ri-chat-3-line"></i>
                                                <?php } ?>
                                                <?php comments_number('0 Comments', '1 Comment', '% Comments'); ?>
                                            </li>
                                        <?php endif; ?>
                                        <?php if ($fpg_field_group_tag && has_tag()) : ?>
                                            <li class="meta-tags">
                                                <?php if (!empty($fpg_field_group_tags_icon) && empty($disabled_meta_icons['tags_icon'])) {?>
                                                <i class="ri-price-tag-3-line"></i>
                                                <?php } ?>
                                                <?php the_tags('', ', ', ''); ?>
                                            </li>
                                        <?php endif; ?>
                                    </ul>
                                </div>

                                <!-- Title -->
                                <?php if ($fpg_field_group_title) : ?>
                                    <<?php echo esc_attr($title_tag); ?> class="title <?php echo esc_attr($title_alignment_class); ?>">
                                    <?php if ($fancy_link_details === 'on') : ?>
                                            <a href="<?php the_permalink(); ?>"
                                               <?php echo esc_attr($target_blank); ?>
                                               class="title-link">
                                                <?php
                                                    if ($fancy_post_title_limit_type === 'words') {
                                                        echo esc_html(wp_trim_words(get_the_title(), $fancy_post_title_limit, $title_more_text));
                                                    } elseif ($fancy_post_title_limit_type === 'characters') {
                                                        echo esc_html(mb_strimwidth(get_the_title(), 0, $fancy_post_title_limit, $title_more_text));
                                                    }
                                                ?>
                                            </a>
                                        <?php else : ?>
                                            <?php
                                            if ($fancy_post_title_limit_type === 'words') {
                                                echo esc_html(wp_trim_words(get_the_title(), $fancy_post_title_limit, $title_more_text));
                                            } elseif ($fancy_post_title_limit_type === 'characters') {
                                                echo esc_html(mb_strimwidth(get_the_title(), 0, $fancy_post_title_limit, $title_more_text));
                                            }
                                            ?>
                                        <?php endif; ?>
                                    </<?php echo esc_attr($title_tag); ?>>
                                <?php endif; ?>
                                <!-- Excerpt -->
                                <?php if ($fpg_field_group_excerpt) : ?>
                                    <div class="fpg-excerpt <?php echo esc_attr($excerpt_alignment_class); ?> ">
                                        <p>
                                        <?php
                                            $excerpt = get_the_content();

                                            if ($fancy_post_excerpt_limit_type === 'words') {
                                                echo esc_html(wp_trim_words($excerpt, $fancy_post_excerpt_limit, $excerpt_more_text));
                                            } else {
                                                // Strip tags to avoid breaking HTML, then apply character limit
                                                $excerpt = wp_strip_all_tags($excerpt);
                                                echo esc_html(mb_strimwidth($excerpt, 0, $fancy_post_excerpt_limit, $excerpt_more_text));
                                            }
                                        ?>
                                        </p>
                                    </div>
                                <?php endif; ?>
                                <!-- Button -->
                                <?php if ($fpg_field_group_read_more) : ?>
                                    
                                    <div class="blog-btn <?php echo esc_attr($button_alignment_class); ?>">

                                        <a class="fpg-btn <?php echo esc_attr($button_class); ?>" 
                                           href="<?php the_permalink(); ?>" 
                                           <?php echo esc_attr($target_blank); ?>>
                                           
                                            <?php echo esc_html($fancy_post_read_more_text); ?>
                                        </a>
                                    </div>
                                <?php endif; ?>
                                <!-- END Button -->
                            </div>
                    </div>
                </div>
                <?php endif; ?>

            <?php
                endwhile;
                wp_reset_postdata(); // Reset the post data
                endif;
            ?>
        </div>
    </div>
</section>

<!-- End Blog list Layout 3 -->
<style type="text/css">
    .fpg-blog-layout-17{
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
    .fpg-blog-layout-17 .fpg-blog-layout-17-item,.fpg-blog-layout-17 .fpg-blog-layout-17-item.fpg-blog-layout-17-item-list{
        <?php if (!empty($fpg_single_section_background_color)) : ?>
            background-color: <?php echo esc_attr($fpg_single_section_background_color); ?>;
        <?php endif; ?>
        <?php if (!empty($fpg_single_section_margin)) : ?>
            margin: <?php echo esc_attr($fpg_single_section_margin); ?>;
        <?php endif; ?>
        <?php if (!empty($fpg_single_section_padding)) : ?>
            padding: <?php echo esc_attr($fpg_single_section_padding); ?>;
        <?php endif; ?>
    }
    .fpg-blog-layout-17 .fpg-blog-layout-17-item .fpg-content{
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
    
    .fpg-blog-layout-17 .fpg-blog-layout-17-item .fpg-content .fpg-meta ul ,.fpg-blog-layout-17 .fpg-blog-layout-17-item.fpg-blog-layout-17-item-list .fpg-content .fpg-meta ul{
        <?php if (!empty($fpg_meta_order)) : ?>
            order: <?php echo esc_attr($fpg_meta_order); ?>;
        <?php endif; ?>
        <?php if (!empty($fpg_meta_padding)) : ?>
            padding: <?php echo esc_attr($fpg_meta_padding); ?>;
        <?php endif; ?>
        <?php if (!empty($fpg_meta_margin)) : ?>
            margin: <?php echo esc_attr($fpg_meta_margin); ?>;
        <?php endif; ?>
        <?php if (!empty($fpg_meta_gap)) : ?>
            gap: <?php echo esc_attr($fpg_meta_gap); ?>;
        <?php endif; ?>
    }
    .fpg-blog-layout-17 .fpg-blog-layout-17-item .fpg-content .fpg-meta ul li,.fpg-blog-layout-17 .fpg-blog-layout-17-item.fpg-blog-layout-17-item-list .fpg-content .fpg-meta ul li{
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
    .fpg-blog-layout-17-item .fpg-content .fpg-meta ul li a:hover{
        <?php if (!empty($fpg_primary_color) || !empty($fpg_meta_hover_color)) : ?>
            color: <?php echo esc_attr(!empty($fpg_primary_color) ? $fpg_primary_color : $fpg_meta_hover_color); ?>;
        <?php endif; ?>
    }
    
    .fpg-blog-layout-17 .fpg-blog-layout-17-item .fpg-content .blog-title,.fpg-blog-layout-17 .fpg-blog-layout-17-item.fpg-blog-layout-17-item-list .fpg-content .title{
        <?php if (!empty($fpg_title_order)) : ?>
            order: <?php echo esc_attr($fpg_title_order); ?>;
        <?php endif; ?>
        padding: <?php echo esc_attr($fpg_title_padding); ?>;
        margin: <?php echo esc_attr($fpg_title_margin); ?>;
        <?php if (!empty($fpg_title_border_color)) : ?>
            border-color: <?php echo esc_attr($fpg_title_border_color); ?>;
        <?php endif; ?>
        <?php if (!empty($fpg_title_border_style)) : ?>
            border-style: <?php echo esc_attr($fpg_title_border_style); ?>;
        <?php endif; ?>
        <?php if (!empty($fpg_title_border_width)) : ?>
            border-width: <?php echo esc_attr($fpg_title_border_width); ?>;
        <?php endif; ?>
    }
    .fpg-blog-layout-17 .fpg-blog-layout-17-item .fpg-content .blog-title a {
        <?php if (!empty($fpg_title_color)) : ?>
          color: <?php echo esc_attr($fpg_title_color); ?>;
       <?php endif; ?>
       <?php if (!empty($fpg_title_font_size)) : ?>
          font-size: <?php echo esc_attr($fpg_title_font_size); ?>px;
       <?php endif; ?>
       <?php if (!empty($fpg_title_font_weight)) : ?>
          font-weight: <?php echo esc_attr($fpg_title_font_weight); ?>;
       <?php endif; ?>
    }
    .fpg-blog-layout-17 .fpg-blog-layout-17-item.fpg-blog-layout-17-item-list .fpg-content .title a{
        <?php if (!empty($fpg_title_color)) : ?>
          color: <?php echo esc_attr($fpg_title_color); ?>;
       <?php endif; ?>
       
       <?php if (!empty($fpg_title_font_weight)) : ?>
          font-weight: <?php echo esc_attr($fpg_title_font_weight); ?>;
       <?php endif; ?>
    }
    .fpg-blog-layout-17 .fpg-blog-layout-17-item .fpg-content .blog-title a:hover, .fpg-blog-layout-17 .fpg-blog-layout-17-item.fpg-blog-layout-17-item-list .fpg-content .title a:hover{
        <?php if (!empty($fpg_primary_color) || !empty($fpg_title_hover_color)) : ?>
            color: <?php echo esc_attr(!empty($fpg_primary_color) ? $fpg_primary_color : $fpg_title_hover_color); ?>;
        <?php endif; ?> 
       
    }
    .fpg-blog-layout-17 .fpg-blog-layout-17-item .fpg-content .fpg-excerpt,.fpg-blog-layout-17 .fpg-blog-layout-17-item.fpg-blog-layout-17-item-list .fpg-content .fpg-excerpt{
        <?php if (!empty($fpg_excerpt_order)) : ?>
            order: <?php echo esc_attr($fpg_excerpt_order); ?>;
        <?php endif; ?>
    }
    .fpg-blog-layout-17 .fpg-blog-layout-17-item .fpg-content .fpg-excerpt p,.fpg-blog-layout-17 .fpg-blog-layout-17-item.fpg-blog-layout-17-item-list .fpg-content .fpg-excerpt p{
        
        <?php if (!empty($fpg_body_color) || !empty($fpg_excerpt_color)) : ?>
            color: <?php echo esc_attr(!empty($fpg_body_color) ? $fpg_body_color : $fpg_excerpt_color); ?>;
        <?php endif; ?>
        <?php if (!empty($fpg_excerpt_size)) : ?>
            font-size: <?php echo esc_attr($fpg_excerpt_size); ?>px;
        <?php endif; ?>
        <?php if (!empty($fpg_excerpt_font_weight)) : ?>
            font-weight: <?php echo esc_attr($fpg_excerpt_font_weight); ?>;
        <?php endif; ?>
        <?php if (!empty($fpg_excerpt_padding)) : ?>
            padding: <?php echo esc_attr($fpg_excerpt_padding); ?>;
        <?php endif; ?>
        <?php if (!empty($fpg_excerpt_margin)) : ?>
            margin: <?php echo esc_attr($fpg_excerpt_margin); ?>;
        <?php endif; ?>
    }
    .fpg-blog-layout-17 .fpg-blog-layout-17-item .fpg-content .blog-btn,.fpg-blog-layout-17 .fpg-blog-layout-17-item.fpg-blog-layout-17-item-list .fpg-content .btn-wrapper{
        <?php if (!empty($fpg_button_padding)) : ?>
            padding: <?php echo esc_attr($fpg_button_padding); ?>;
        <?php endif; ?>
        <?php if (!empty($fpg_button_margin)) : ?>
            margin: <?php echo esc_attr($fpg_button_margin); ?>;
        <?php endif; ?>
        <?php if (!empty($fpg_button_order)) : ?>
            order: <?php echo esc_attr($fpg_button_order); ?>;
        <?php endif; ?>
    }
    .fpg-blog-layout-17 .fpg-blog-layout-17-item .fpg-content .blog-btn a, .fpg-blog-layout-17 .fpg-blog-layout-17-item.fpg-blog-layout-17-item-list .fpg-content .btn-wrapper a{
        <?php if (!empty($fpg_button_background_color)) : ?>
            background-color: <?php echo esc_attr($fpg_button_background_color); ?>;
        <?php endif; ?>
        <?php if (!empty($fpg_button_text_color)) : ?>
            color: <?php echo esc_attr($fpg_button_text_color); ?>;
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
    }
    .fpg-blog-layout-17 .fpg-blog-layout-17-item .fpg-content .blog-btn a:hover, .fpg-blog-layout-17 .fpg-blog-layout-17-item.fpg-blog-layout-17-item-list .fpg-content .btn-wrapper a:hover{
        <?php if (!empty($fpg_button_hover_background_color)) : ?>
            background-color: <?php echo esc_attr($fpg_button_hover_background_color); ?>;
        <?php endif; ?>
        
        <?php if (!empty($fpg_primary_color) || !empty($fpg_button_text_hover_color)) : ?>
            color: <?php echo esc_attr(!empty($fpg_primary_color) ? $fpg_primary_color : $fpg_button_text_hover_color); ?>;
        <?php endif; ?> 
    }
</style>

<?php
$list3 = ob_get_clean();
?>