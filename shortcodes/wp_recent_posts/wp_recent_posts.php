<?php

defined('TEMPLAZA_FRAMEWORK') or exit();

use TemPlazaFramework\Functions;

if(!class_exists('TemplazaFramework_ShortCode_WP_Recent_Posts')){
    class TemplazaFramework_ShortCode_WP_Recent_Posts extends TemplazaFramework_ShortCode {

        public function register(){
            return array(
                'id'          => 'wp_recent_posts',
                'icon'        => 'el el-list-alt',
                'title'       => __('WP Recent Posts'),
                'param_title' => esc_html__('WP Recent Posts Settings'),
                'desc'        => __('Load a WP Recent Posts.'),
                'admin_label' => true,
                'params'      => array(
                    array(
                        'id'       => 'title',
                        'type'     => 'text',
                        'title'    => __( 'Widget Title', $this -> text_domain ),
                        'subtitle' => __( 'What text use as a widget title. Leave blank to use default widget title.', $this -> text_domain ),
                    ),
                    array(
                        'id'       => 'number',
                        'type'     => 'spinner',
                        'title'    => __( 'Number of posts', $this -> text_domain ),
                        'subtitle' => __( 'Enter number of posts to display.', $this -> text_domain ),
                        'default'  => 5,
                    ),
                    array(
                        'id'       => 'show_date',
                        'type'     => 'switch',
                        'title'    => __( 'Display post date?', $this -> text_domain ),
                        'subtitle' => __( 'If set to On, date will be displayed.', $this -> text_domain ),
                    ),
                )
            );
        }

//        public function enqueue() {
//            if (!wp_script_is('templaza-shortcode-text-js')) {
//                wp_enqueue_script(
//                    'templaza-shortcode-text-js',
//                    \TemPlazaFramework\Functions::get_my_url() . '/shortcodes/text/text.js',
//                    array( 'jquery', 'jquery-ui-tabs', 'wp-util', 'redux-js', TEMPLAZA_FRAMEWORK_NAME.'__js'),
//                    time(),
//                    'all'
//                );
//            }
//        }
    }

}

?>