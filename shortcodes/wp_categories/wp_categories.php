<?php

defined('TEMPLAZA_FRAMEWORK') or exit();

use TemPlazaFramework\Functions;

if(!class_exists('TemplazaFramework_ShortCode_WP_Categories')){
    class TemplazaFramework_ShortCode_WP_Categories extends TemplazaFramework_ShortCode {

        public function register(){
            return array(
                'id'          => 'wp_categories',
                'icon'        => 'el el-folder-open',
                'title'       => __('WP Categories'),
                'param_title' => esc_html__('WP Categories Settings'),
                'desc'        => __('Load a WP Categories.'),
                'admin_label' => true,
                'params'      => array(
                    array(
                        'id'       => 'title',
                        'type'     => 'text',
                        'title'    => __( 'Widget Title', $this -> text_domain ),
                        'subtitle' => __( 'What text use as a widget title. Leave blank to use default widget title.', $this -> text_domain ),
                    ),
                    array(
                        'id'       => 'dropdown',
                        'type'     => 'switch',
                        'title'    => __( 'Dropdown', $this -> text_domain ),
                        'subtitle' => __( 'If set to On, archives will be display by dropdown.', $this -> text_domain ),
                    ),
                    array(
                        'id'       => 'count',
                        'type'     => 'switch',
                        'title'    => __( 'Show post counts', $this -> text_domain ),
                        'subtitle' => __( 'If set to On, the post count will be display.', $this -> text_domain ),
                    ),
                    array(
                        'id'       => 'hierarchical',
                        'type'     => 'switch',
                        'title'    => __( 'Show hierarchy', $this -> text_domain ),
                        'subtitle' => __( 'If set to On, the hierarchy will be display.', $this -> text_domain ),
                    ),
//                    array(
//                        'id'       => 'options',
//                        'type'     => 'checkbox',
//                        'title'    => __( 'Display options', $this -> text_domain ),
//                        'subtitle' => __( 'Select display options for categories.', $this -> text_domain ),
//                        'options'  => array(
//                            'dropdown'     => __( 'Dropdown', $this -> text_domain ),
//                            'count'        => __( 'Show post counts', $this -> text_domain ),
//                            'hierarchical' => __( 'Show hierarchy', $this -> text_domain ),
//                        ),
//                    ),
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