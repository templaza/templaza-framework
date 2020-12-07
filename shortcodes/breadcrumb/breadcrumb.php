<?php

defined('TEMPLAZA_FRAMEWORK') or exit();

use TemPlazaFramework\Functions;

if(!class_exists('TemplazaFramework_ShortCode_Breadcrumb')){
    class TemplazaFramework_ShortCode_Breadcrumb extends TemplazaFramework_ShortCode {

        public function register(){
            return array(
                'id'          => $this -> get_shortcode_name(),
                'icon'        => 'el el-tag rotate-132',
                'title'       => __('Breadcrumb'),
                'desc'        => __('Load a breadcrumb.'),
                'param_title' => __('Breadcrumb settings'),
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