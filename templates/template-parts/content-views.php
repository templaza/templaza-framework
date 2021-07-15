<?php
defined('ABSPATH') or exit();
$count_key = 'post_views_count';
$count = get_post_meta($args['postID'], $count_key, true);
if ($count == '' || empty($count)) { // If such views are not
    delete_post_meta($args['postID'], $count_key);
    add_post_meta($args['postID'], $count_key, '0');
    echo esc_html__('View: 0','templaza-framework'); // return value of 0
}else{
    echo esc_html__('Views:','templaza-framework').' '.$count;
}