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
                    array(
                        'id'         => 'background',
                        'type'       => 'background',
//                                        'color_rgba' => true,
                        'title'      => __('Background'),
                    ),
                    array(
                        'id'       => 'breadcrumb_color',
                        'type'     => 'color_rgba',
                        'title'    => esc_html__( 'Breadcrumb Color', 'templaza-framework' ),
                        'subtitle' => esc_html__( 'Set the color of Breadcrumb.', 'templaza-framework' ),
                    ),
                    array(
                        'id'       => 'breadcrumb_color_hover',
                        'type'     => 'color_rgba',
                        'title'    => esc_html__( 'Breadcrumb Hover Color', 'templaza-framework' ),
                        'subtitle' => esc_html__( 'Set the color hover of Breadcrumb.', 'templaza-framework' ),
                    ),
                    array(
                        'id'       => 'breadcrumb_color_active',
                        'type'     => 'color_rgba',
                        'title'    => esc_html__( 'Breadcrumb active Color', 'templaza-framework' ),
                    ),
                    array(
                        'id'       => 'enable_breadcrumb_single',
                        'type'     => 'switch',
                        'title'    => esc_html__('Show Breadcrumb in single post', 'templaza-framework'),
                        'subtitle' => esc_html__('The Breadcrumb will be show in single post', 'templaza-framework'),
                        'default'  => false,
                    ),

                )
            );
        }


    }

}

?>