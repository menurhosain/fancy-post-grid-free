<?php
if (!defined('ABSPATH')) exit;
//==============STATUS==============
// Ensure it's an array
if (!is_array($fpg_filter_statuses)) {
    // Convert string to array if necessary
    if (is_string($fpg_filter_statuses)) {
        $fpg_filter_statuses = explode(',', $fpg_filter_statuses);
    } else {
        $fpg_filter_statuses = array(); // Default to empty array if not an array or string
    }
}

// ==============AUTHOR==========
// Unserialize the data if necessary
if (is_string($fpg_filter_authors)) {
    $fpg_filter_authors = maybe_unserialize($fpg_filter_authors);
}

// Ensure it's an array
if (!is_array($fpg_filter_authors)) {
    $fpg_filter_authors = array(); // Default to empty array if not an array
}

// Sanitize and convert to integers
$selected_authors = array_map('intval', $fpg_filter_authors);

//==========Include only==========
$selected_post_in = !empty($fpg_include_only) ? explode(',', $fpg_include_only) : array();

//=======Exclude===============
$selected_post_not_in = !empty($fpg_exclude) ? explode(',', $fpg_exclude) : array();

//=================More Text==========
$excerpt_more_text = isset($fancy_post_excerpt_more_text) ? $fancy_post_excerpt_more_text : '...'; 
$title_more_text = isset($fancy_post_title_more_text) ? $fancy_post_title_more_text : '...'; 

// ===========Advanced Filter==============
// Capture and sanitize category terms if 'category' taxonomy is selected
$category_terms = array_map('intval', $fpg_filter_category_terms); 

// Capture and sanitize tag terms if 'tags' taxonomy is selected
$tag_terms = array_map('intval', $fpg_filter_tags_terms);           

// Get values from the form inputs           
$args = array(
    'post_type'      => $fancy_post_type,
    'post_status'    => $fpg_filter_statuses, // Add status filter
    'posts_per_page' => -1, // Number of posts to display
    'paged'          => get_query_var('paged') ? get_query_var('paged') : 1, // Get current page number
    'orderby'        => $fpg_order_by, // Order by
    'order'          => $fpg_order,   // Order direction
    'author__in'     => $selected_authors, // Add author filter                                          
);
// Add 'post__in' to the query if not empty
if (!empty($selected_post_in)) {
    $args['post__in'] = $selected_post_in;
}

// Add 'post__not_in' to the query if not empty
if (!empty($selected_post_not_in)) {
    $args['post__not_in'] = $selected_post_not_in;// phpcs:ignore WordPressVIPMinimum.Performance.WPQueryParams.PostNotIn_post__not_in
}

// Run a preliminary query to get all matching post IDs
if ($fpg_limit > 0) {
    $pre_query = new WP_Query(array_merge($args, array('posts_per_page' => $fpg_limit, 'fields' => 'ids')));
    $post_ids = $pre_query->posts;

    // Modify the main query to limit the posts
    $args['post__in'] = $post_ids;
}

// Add taxonomy queries
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


$query = new WP_Query($args);
