<?php
// You can write code here for meta_box

//register_post_meta(
//    'post',
//    '_my_data',
//    [
//        'show_in_rest' => true,
//        'single'       => true,
//        'type'         => 'string',
//        'auth_callback' => function() {
//            return current_user_can( 'edit_posts' );
//        }
//    ]
//);

//var_dump('432432');

add_action( 'init', function() {
    var_dump('432432');
    register_post_meta(
        'post',
        '_my_data',
        [
            'show_in_rest' => true,
            'single'       => true,
            'type'         => 'string',
            'auth_callback' => function() {
                return current_user_can( 'edit_posts' );
            }
        ]
    );
    add_action( 'enqueue_block_editor_assets', function() {
        wp_enqueue_script(
            'my-data',
            trailingslashit( plugin_dir_url( __FILE__ ) ) . 'gutenberg.js',
            [ 'wp-element', 'wp-blocks', 'wp-components', 'wp-editor' ],
            '0.1.0',
            true
        );
    } );
} );