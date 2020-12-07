<?php

defined('TEMPLAZA_FRAMEWORK') or exit();

use TemPlazaFramework\Functions;

if(!class_exists('TemplazaFramework_ShortCode_Social')){
    class TemplazaFramework_ShortCode_Social extends TemplazaFramework_ShortCode {

        public function register(){
            return array(
                'id'          => 'social',
//                'type'        => 'tz_element',
                'icon'        => 'fas fa-share-alt',
                'title'       => __('Social'),
                'desc'        => __('Load a social.'),
                'param_title' => __('Social settings'),
                'admin_label' => true,
                'params'      => array(
//                    array(
//                        'id'    => 'customclass',
//                        'type'  => 'text',
//                        'title' => esc_html__('Custom Class', $this -> text_domain),
//                        'desc' => esc_html__('Custom Class can be used for writing custom CSS or JS.', $this -> text_domain),
//                    ),
//                    array(
//                        'id'    => 'customid',
//                        'type'  => 'text',
//                        'title' => esc_html__('Custom ID', $this -> text_domain),
//                        'desc' => esc_html__('Custom ID can be used for overriding the auto-generated id.', $this -> text_domain),
//                    ),
                )
            );
        }


    }

}

?>