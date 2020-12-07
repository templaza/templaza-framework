<?php

defined('TEMPLAZA_FRAMEWORK') or exit();

use TemPlazaFramework\Functions;

if(!class_exists('TemplazaFramework_ShortCode_Header')){
    class TemplazaFramework_ShortCode_Header extends TemplazaFramework_ShortCode {

        public function register(){
            return array(
                'id'          => 'header',
                'icon'        => 'el el-tasks',
                'title'       => __('Header'),
                'param_title' => __('Header settings'),
                'desc'        => __('Load a header.'),
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
        public function prepare_params($params, $element){
            $params = parent::prepare_params($params, $element);


            return $params;
        }
    }

}

?>