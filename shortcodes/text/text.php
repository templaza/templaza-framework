<?php

defined('TEMPLAZA_FRAMEWORK') or exit();

use TemPlazaFramework\Functions;

if(!class_exists('TemplazaFramework_ShortCode_Text')){
    class TemplazaFramework_ShortCode_Text extends TemplazaFramework_ShortCode {

        public function register(){
            return array(
                'id'          => 'text',
                'icon'        => 'el el-text-width',
                'title'       => __('Text Block'),
                'param_title' => esc_html__('Text Block Settings'),
                'desc'        => __('Load a text block.'),
                'admin_label' => true,
                'params'      => array(
                    array(
                        'id'       => 'title',
                        'type'     => 'text',
                        'title'    => __( 'Widget Title', $this -> text_domain ),
                        'subtitle' => __( 'What text use as a widget title. Leave blank to use default widget title..', $this -> text_domain ),
                    ),
                    array(
                        'id'       => 'text',
                        'type'     => 'editor',
                        'title'    => __( 'Text', $this -> text_domain ),
                    ),
                )
            );
        }

        public function enqueue() {
            if (!wp_script_is('templaza-shortcode-text-js')) {
                wp_enqueue_script(
                    'templaza-shortcode-text-js',
                    \TemPlazaFramework\Functions::get_my_url() . '/shortcodes/text/text.js',
                    array( 'jquery', 'jquery-ui-tabs', 'wp-util', 'redux-js', TEMPLAZA_FRAMEWORK_NAME.'__js'),
                    time(),
                    'all'
                );
            }
        }
    }

}

?>