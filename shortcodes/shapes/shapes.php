<?php

defined('TEMPLAZA_FRAMEWORK') or exit();

use TemPlazaFramework\CSS;
use TemPlazaFramework\Templates;
use TemPlazaFramework\Functions;

if(!class_exists('TemplazaFramework_ShortCode_Shapes')){
    class TemplazaFramework_ShortCode_Shapes extends TemplazaFramework_ShortCode {

        public function register(){
            return array(
                'id'          => 'shapes',
                'icon'        => 'fa-solid fa-shapes',
                'title'       => __('Shapes','templaza-framework'),
                'desc'        => __('Load a Shape.','templaza-framework'),
                'param_title' => __('Shapes settings','templaza-framework'),
                'admin_label' => true,
                'params'      => array(
                    array(
                        'id'       => 'shapes_type',
                        'type'     => 'select',
                        'title'    => esc_html__('Choose Shape', 'templaza-framework'),
                        'options'  => array(
                            '' => esc_html__( 'None','templaza-framework' ),
                            'truck' => esc_html__( 'Truck','templaza-framework' ),
                            'wave' => esc_html__( 'Wave Style1','templaza-framework' ),
                            'wave2' => esc_html__( 'Wave Style2','templaza-framework' ),
                        ),
                        'default'  => '',
                    ),
                    array(
                        'id'        => 'width',
                        'type'      => 'slider',
                        'title'     => esc_html__('Width', 'templaza-framework'),
                        "default"   => 100,
                        "min"       => 1,
                        "step"      => 1,
                        "max"       => 1000,
                        'display_value' => 'label',
                        'output_units' => '%'
                    ),
                    array(
                        'id'        => 'height',
                        'type'      => 'slider',
                        'title'     => esc_html__('Height', 'templaza-framework'),
                        "default"   => 50,
                        "min"       => 1,
                        "step"      => 1,
                        "max"       => 1000,
                        'display_value' => 'label',
                        'output_units' => 'px'
                    ),
                    array(
                        'id'        => 'text_align',
                        'type'      => 'select',
                        'title'     => esc_html__('Alignment', 'templaza-framework'),
                        'options'   => array(
                            'left'          => esc_html__('Left', 'templaza-framework'),
                            'center'        => esc_html__('Center', 'templaza-framework'),
                            'right'         => esc_html__('Right', 'templaza-framework'),
                        )
                    ),
                    array(
                        'id'       => 'shape_bg_color',
                        'type'     => 'color',
                        'title'    => esc_html__( 'Shape Background Color', 'templaza-framework' ),
                        'subtitle' => esc_html__( 'Set the background color of social.', 'templaza-framework' ),
                    ),
                    array(
                        'id'         => 'border',
                        'type'       => 'border',
                        'color_alpha'=> 'true',
                        'title'      => __('Border', 'templaza-framework'),
                    ),
                )
            );
        }

        public function prepare_params($params, $element, $parent_el){
            $css = Templates::$_devices;

            $params = parent::prepare_params($params, $element, $parent_el);

            $custom_css_name    = 'tz_custom_'.$element['id'];

            $shape_bg_color     = isset($params['shape_bg_color'])?$params['shape_bg_color']:'';
            $shape_bg_color     = CSS::make_color_rgba_redux($shape_bg_color);

            $shape_border     = isset($params['border'])?$params['border']:'';


            $shape_styles = [];

            if (!empty($shape_border['border-top'])) {
                $shape_styles[] = '.'. $custom_css_name . ' .tz-shape{ border-top: ' . $shape_border['border-top'] . ' !important;}';
            }
            if (!empty($social_border['border-right'])) {
                $shape_styles[] = '.'. $custom_css_name . ' .tz-shape{ border-right: ' . $shape_border['border-right'] . ' !important;}';
            }
            if (!empty($social_border['border-bottom'])) {
                $shape_styles[] = '.'. $custom_css_name . ' .tz-shape{ border-bottom: ' . $shape_border['border-bottom'] . ' !important;}';
            }
            if (!empty($social_border['border-left'])) {
                $shape_styles[] = '.'. $custom_css_name . ' .tz-shape{ border-left: ' . $shape_border['border-left'] . ' !important;}';
            }
            if (!empty($social_border['border-color'])) {
                $shape_styles[] = '.'. $custom_css_name . ' .tz-shape{ border-color: ' . $shape_border['border-color'] . ' !important;}';
            }
            if (!empty($social_border['border-style'])) {
                $shape_styles[] = '.'. $custom_css_name . ' .tz-shape{ border-style: ' . $shape_border['border-style'] . ' !important;}';
            }
            if (!empty($shape_bg_color)) {
                $shape_styles[] = '.'. $custom_css_name . ' .tz-shape{ background-color: ' . $shape_bg_color . ' !important;}';
                $shape_styles[] = '.'. $custom_css_name . ' .truck:before{ background-color: ' . $shape_bg_color . ' !important;}';
                $shape_styles[] = '.'. $custom_css_name . ' .wave_fill{ fill: ' . $shape_bg_color . ' !important;}';
            }
            Templates::add_inline_style(implode('', $shape_styles));


            return $params;
        }


    }

}

?>