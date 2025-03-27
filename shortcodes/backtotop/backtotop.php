<?php

defined('TEMPLAZA_FRAMEWORK') or exit();

use TemPlazaFramework\CSS;
use TemPlazaFramework\Templates;
use TemPlazaFramework\Functions;

if(!class_exists('TemplazaFramework_ShortCode_Backtotop')){
    class TemplazaFramework_ShortCode_Backtotop extends TemplazaFramework_ShortCode {

        public function register(){
            return array(
                'id'          => 'backtotop',
                'icon'        => 'fa-solid fa-arrow-up-from-bracket',
                'title'       => __('Back to top','templaza-framework'),
                'desc'        => __('Back to top button.','templaza-framework'),
                'param_title' => __('settings','templaza-framework'),
                'admin_label' => true,
                'params'      => array(
                    array(
                        'id'     => 'backtotop-padding',
                        'type'   => 'spacing',
                        'mode'   => 'padding',
                        'all'    => false,
                        'allow_responsive'    => true,
                        'units'  => array( 'em', 'px', '%' ),      // You can specify a unit value. Possible: px, em, %
                        'title'  => esc_html__('Padding', 'templaza-framework'),
                        'default' => array(
                            'units' => 'px',
                        ),
                    ),
                    array(
                        'id'         => 'backtotop-border',
                        'type'       => 'border',
                        'color_alpha'=> 'true',
                        'title'      => __('Border', 'templaza-framework'),
                    ),
                    array(
                        'id'       => 'backtotop-border-radius',
                        'type'     => 'text',
                        'title'    => __('Border Radius', 'templaza-framework'),
                        'subtitle' => esc_html__( 'Set border radius, example: 5px or 50%.', 'templaza-framework' ),
                        'default'  => '',
                    ),
                    array(
                        'id'       => 'backtotop-color',
                        'type'     => 'color_rgba',
                        'title'    => esc_html__( 'Color', 'templaza-framework' ),
                        'subtitle' => esc_html__( 'Set the color.', 'templaza-framework' ),
                    ),
                    array(
                        'id'       => 'backtotop-color-hover',
                        'type'     => 'color_rgba',
                        'title'    => esc_html__( ' Hover Color', 'templaza-framework' ),
                        'subtitle' => esc_html__( 'Set the color hover.', 'templaza-framework' ),
                    ),
                    array(
                        'id'       => 'backtotop-bg-color',
                        'type'     => 'color_rgba',
                        'title'    => esc_html__( 'Background Color', 'templaza-framework' ),
                    ),
                    array(
                        'id'       => 'backtotop-bg-color-hover',
                        'type'     => 'color_rgba',
                        'title'    => esc_html__( 'Background Hover Color', 'templaza-framework' ),
                    ),
                    array(
                        'id'       => 'backtotop-fix-width-height',
                        'type'     => 'switch',
                        'title'    => esc_html__('Fix Width Height', 'templaza-framework'),
                        'default'  => true,
                    ),
                    array(
                        'id'       => 'backtotop-width-height',
                        'type'     => 'dimensions',
                        'title'    => esc_html__('Width Height', 'templaza-framework'),
                        'default'  => array(
                            'Width'   => '40',
                            'Height'  => '40'
                        ),
                        'required' => array(
                            array('backtotop-fix-width-height', '=', true),
                        )
                    ),
                )
            );
        }

        public function prepare_params($params, $element, $parent_el){
            $css = Templates::$_devices;

            $params = parent::prepare_params($params, $element, $parent_el);

            $custom_css_name    = 'tz_custom_'.$element['id'];
            $backtotop_color     = isset($params['backtotop-color'])?$params['backtotop-color']:'';
            $backtotop_color     = CSS::make_color_rgba_redux($backtotop_color);


            $backtotop_color_hover     = isset($params['backtotop-color-hover'])?$params['backtotop-color-hover']:'';
            $backtotop_color_hover     = CSS::make_color_rgba_redux($backtotop_color_hover);

            $backtotop_bg_color     = isset($params['backtotop-bg-color'])?$params['backtotop-bg-color']:'';
            $backtotop_bg_color     = CSS::make_color_rgba_redux($backtotop_bg_color);

            $backtotop_bg_color_hover     = isset($params['backtotop-bg-color-hover'])?$params['backtotop-bg-color-hover']:'';
            $backtotop_bg_color_hover     = CSS::make_color_rgba_redux($backtotop_bg_color_hover);

            $backtotop_fix_size     = isset($params['backtotop-fix-width-height'])?$params['backtotop-fix-width-height']:'';

            $backtotop_border     = isset($params['backtotop-border'])?$params['backtotop-border']:'';

            $backtotop_styles = [];
            if (!empty($backtotop_color)) {
                $backtotop_styles[] = '.'. $custom_css_name . ' .templaza-backtotop-element{ color: ' . $backtotop_color . ' !important;}';
            }
            if (!empty($backtotop_color_hover)) {
                $backtotop_styles[] = '.'. $custom_css_name . ' .templaza-backtotop-element:hover i{ color: ' . $backtotop_color_hover . ' !important;}';
            }
            if (!empty($backtotop_border['border-top'])) {
                $backtotop_styles[] = '.'. $custom_css_name . ' .templaza-backtotop-element{ border-top: ' . $backtotop_border['border-top'] . ' !important;}';
            }
            if (!empty($backtotop_border['border-right'])) {
                $backtotop_styles[] = '.'. $custom_css_name . ' .templaza-backtotop-element{ border-right: ' . $backtotop_border['border-right'] . ' !important;}';
            }
            if (!empty($backtotop_border['border-bottom'])) {
                $backtotop_styles[] = '.'. $custom_css_name . ' .templaza-backtotop-element{ border-bottom: ' . $backtotop_border['border-bottom'] . ' !important;}';
            }
            if (!empty($backtotop_border['border-left'])) {
                $backtotop_styles[] = '.'. $custom_css_name . ' .templaza-backtotop-element{ border-left: ' . $backtotop_border['border-left'] . ' !important;}';
            }
            if (!empty($backtotop_border['border-color'])) {
                $backtotop_styles[] = '.'. $custom_css_name . ' .templaza-backtotop-element{ border-color: ' . $backtotop_border['border-color'] . ' !important;}';
            }
            if (!empty($backtotop_border['border-style'])) {
                $backtotop_styles[] = '.'. $custom_css_name . ' .templaza-backtotop-element{ border-style: ' . $backtotop_border['border-style'] . ' !important;}';
            }
            if (!empty($backtotop_bg_color)) {
                $backtotop_styles[] = '.'. $custom_css_name . ' .templaza-backtotop-element{ background-color: ' . $backtotop_bg_color . ' !important;}';
            }
            if (!empty($backtotop_bg_color_hover)) {
                $backtotop_styles[] = '.'. $custom_css_name . ' .templaza-backtotop-element:hover{ background-color: ' . $backtotop_bg_color_hover . ' !important;}';
            }
            if (!empty($params['backtotop-border-radius'])) {
                $backtotop_styles[] = '.'. $custom_css_name . ' .templaza-backtotop-element{ border-radius: ' . $params['backtotop-border-radius'] . ' !important;}';
            }
            if($backtotop_fix_size ==1 || $backtotop_fix_size == true){
                $backtotop_size = isset($params['backtotop-width-height'])?$params['backtotop-width-height']:'';
                if($backtotop_size['width']){
                    $backtotop_styles[] = '.'. $custom_css_name . ' .templaza-backtotop-element{ width: ' . $backtotop_size['width'] . ' !important;}';
                }
                if($backtotop_size['height']){
                    $backtotop_styles[] = '.'. $custom_css_name . ' .templaza-backtotop-element{ height: ' . $backtotop_size['height'] . ' !important;}';
                }
            }
            Templates::add_inline_style(implode('', $backtotop_styles));

            if(isset($params['backtotop-padding']) && !empty($params['backtotop-padding'])){

                $padding    = CSS::make_spacing_redux('padding', $params['backtotop-padding'], true, 'px');

                if(!empty($padding)){
                    if(is_array($padding)){
                        foreach($css as $device => $pcss){
                            if(!empty($padding[$device])) {
                                $style =  '.' . $custom_css_name . ' .templaza-backtotop-element{' . $padding[$device] . '}';
                                Templates::add_inline_style($style, $device);
                            }
                        }
                    }
                    else{
                        Templates::add_inline_style('.' . $custom_css_name . ' .templaza-backtotop-element{' . $padding . '}');
                    }
                }
            }

            return $params;
        }


    }

}

?>