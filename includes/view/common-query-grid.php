<?php
if (!defined('ABSPATH')) exit;
// ======= Pagination ==========
if ($fancy_post_pagination === 'off') {
    $fpg_post_per_page = -1;
}

// ======= STATUS ==============
if (!is_array($fpg_filter_statuses)) {
    if (is_string($fpg_filter_statuses)) {
        $fpg_filter_statuses = explode(',', $fpg_filter_statuses);
    } else {
        $fpg_filter_statuses = array();
    }
}

// ======= AUTHOR ==============
if (is_string($fpg_filter_authors)) {
    $fpg_filter_authors = maybe_unserialize($fpg_filter_authors);
}
if (!is_array($fpg_filter_authors)) {
    $fpg_filter_authors = array();
}
$selected_authors = array_map('intval', $fpg_filter_authors);

// ======= INCLUDE / EXCLUDE =======
$selected_post_in = !empty($fpg_include_only) ? explode(',', $fpg_include_only) : array();
$selected_post_not_in = !empty($fpg_exclude) ? explode(',', $fpg_exclude) : array();

// More text
$excerpt_more_text = isset($fancy_post_excerpt_more_text) ? $fancy_post_excerpt_more_text : '...';
$title_more_text   = isset($fancy_post_title_more_text) ? $fancy_post_title_more_text : '...';

// Taxonomies
$category_terms = array_map('intval', $fpg_filter_category_terms);
$tag_terms      = array_map('intval', $fpg_filter_tags_terms);

// Build query args
$args = array(
    'post_type'      => $fancy_post_type,
    'post_status'    => $fpg_filter_statuses,
    'posts_per_page' => $fpg_post_per_page,
    'paged'          => get_query_var('paged') ? get_query_var('paged') : 1,
    'orderby'        => $fpg_order_by,
    'order'          => $fpg_order,
    'author__in'     => $selected_authors,
);

if (!empty($selected_post_in)) {
    $args['post__in'] = $selected_post_in;
}
if (!empty($selected_post_not_in)) {
    $args['post__not_in'] = $selected_post_not_in;
}

// Limit posts using a pre-query
if ($fpg_limit > 0) {
    $pre_query = new WP_Query(array_merge($args, array('posts_per_page' => $fpg_limit, 'fields' => 'ids')));
    $post_ids  = $pre_query->posts;
    $args['post__in'] = $post_ids;
}

// Tax query
$tax_query = array('relation' => $fpg_relation);

if (!empty($fpg_field_group_taxonomy) && in_array('category', $fpg_field_group_taxonomy) && !empty($category_terms)) {
    $tax_query[] = array(
        'taxonomy' => 'category',
        'field'    => 'term_id',
        'terms'    => $category_terms,
        'operator' => $fpg_category_operator,
    );
}

if (!empty($fpg_field_group_taxonomy) && in_array('tags', $fpg_field_group_taxonomy) && !empty($tag_terms)) {
    $tax_query[] = array(
        'taxonomy' => 'post_tag',
        'field'    => 'term_id',
        'terms'    => $tag_terms,
        'operator' => $fpg_tags_operator,
    );
}

if (!empty($tax_query)) {
    $args['tax_query'] = $tax_query;
}

// Final query
$query = new WP_Query($args);
