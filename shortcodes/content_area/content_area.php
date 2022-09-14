<?php

defined('TEMPLAZA_FRAMEWORK') or exit();

use TemPlazaFramework\Functions;

if(!class_exists('TemplazaFramework_ShortCode_Content_Area')){
    class TemplazaFramework_ShortCode_Content_Area extends TemplazaFramework_ShortCode {

        public function register(){
            return array(
                'id'          => 'content_area',
                'icon'        => 'far fa-file-alt',
                'title'       => __('Content Area'),
                'desc'        => __('Load a content area.'),
                'param_title' => __('Content area settings'),
                'admin_label' => true,
                'params'      => array(
//                    array(
//                        'id'       => 'enable-header-title',
//                        'type'     => 'switch',
//                        'title'    => esc_html__('Enable Header Title', 'templaza-framework'),
//                        'subtitle' => esc_html__('Display header title.', 'templaza-framework'),
//                        'default'  => true,
//                    ),
//                    array(
//                        'id'       => 'enable-pagination',
//                        'type'     => 'switch',
//                        'title'    => esc_html__('Enable Pagination', 'templaza-framework'),
//                        'subtitle' => esc_html__('Display pagination area.', 'templaza-framework'),
//                        'default'  => true,
//                    ),
//                    array(
//                        'id'       => 'pagination-position',
//                        'type'     => 'select',
//                        'required' => array('enable-pagination', '=', true),
//                        'title'    => esc_html__('Pagination Position', 'templaza-framework'),
//                        'subtitle' => esc_html__('Display pagination before or after content.', 'templaza-framework'),
//                        'options'  => array(
//                            'top'    => esc_html__('Top', 'templaza-framework'),
//                            'bottom' => esc_html__('Bottom', 'templaza-framework'),
//                        ),
//                        'default'  => 'bottom',
//                    ),
                    array(
                        'id'       => 'custom_container_class',
                        'type'     => 'text',
                        'title'    => esc_html__('Container Custom Class', 'templaza-framework'),
                        'subtitle' => esc_html__('Custom class of container', 'templaza-framework'),
                    ),
                )
            );
        }


    }

}

?>