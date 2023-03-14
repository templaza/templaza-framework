<?php

defined('TEMPLAZA_FRAMEWORK') or exit();

use TemPlazaFramework\CSS;
use TemPlazaFramework\Templates;
use TemPlazaFramework\Functions;

if(!class_exists('TemplazaFramework_ShortCode_Social')){
    class TemplazaFramework_ShortCode_Social extends TemplazaFramework_ShortCode {

        public function register(){
            return array(
                'id'          => 'social',
                'icon'        => 'fas fa-share-alt',
                'title'       => __('Social','templaza-framework'),
                'desc'        => __('Load a social.','templaza-framework'),
                'param_title' => __('Social settings','templaza-framework'),
                'admin_label' => true,
                'params'      => array(
                    array(
                        'id'     => 'social-item-margin',
                        'type'   => 'spacing',
                        'mode'   => 'margin',
                        'all'    => false,
                        'allow_responsive'    => true,
                        'units'  => array( 'em', 'px', '%' ),      // You can specify a unit value. Possible: px, em, %
                        'title'  => esc_html__('Social Item Margin', 'templaza-framework'),
                        'default' => array(
                            'units' => 'px',
                        ),
                    ),
                    array(
                        'id'     => 'social-item-padding',
                        'type'   => 'spacing',
                        'mode'   => 'padding',
                        'all'    => false,
                        'allow_responsive'    => true,
                        'units'  => array( 'em', 'px', '%' ),      // You can specify a unit value. Possible: px, em, %
                        'title'  => esc_html__('Social Item Padding', 'templaza-framework'),
                        'default' => array(
                            'units' => 'px',
                        ),
                    ),
                    array(
                        'id'       => 'social-item-border-radius',
                        'type'     => 'text',
                        'title'    => __('Social Border Radius', 'templaza-framework'),
                        'subtitle' => esc_html__( 'Set border radius, example: 5px or 50%.', 'templaza-framework' ),
                        'default'  => '',
                    ),
                    array(
                        'id'       => 'social-color',
                        'type'     => 'color_rgba',
                        'title'    => esc_html__( 'Social Color', 'templaza-framework' ),
                        'subtitle' => esc_html__( 'Set the color of social.', 'templaza-framework' ),
                    ),
                    array(
                        'id'       => 'social-color-hover',
                        'type'     => 'color_rgba',
                        'title'    => esc_html__( 'Social Hover Color', 'templaza-framework' ),
                        'subtitle' => esc_html__( 'Set the color hover of social.', 'templaza-framework' ),
                    ),
                    array(
                        'id'       => 'social-bg-color',
                        'type'     => 'color',
                        'title'    => esc_html__( 'Social Background Color', 'templaza-framework' ),
                        'subtitle' => esc_html__( 'Set the background color of social.', 'templaza-framework' ),
                    ),
                    array(
                        'id'       => 'social-bg-color-hover',
                        'type'     => 'color_rgba',
                        'title'    => esc_html__( 'Social Background Hover Color', 'templaza-framework' ),
                        'subtitle' => esc_html__( 'Set the color background hover of social.', 'templaza-framework' ),
                    ),
                    array(
                        'id'       => 'social-fix-width-height',
                        'type'     => 'switch',
                        'title'    => esc_html__('Social Fix Width Height', 'templaza-framework'),
                        'default'  => true,
                    ),
                    array(
                        'id'       => 'social-width-height',
                        'type'     => 'dimensions',
                        'title'    => esc_html__('Social Width Height', 'templaza-framework'),
                        'default'  => array(
                            'Width'   => '40',
                            'Height'  => '40'
                        ),
                        'required'                => array('social-fix-width-height', '=', 'true'),
                    ),
                )
            );
        }

        public function prepare_params($params, $element, $parent_el){
            $css = Templates::$_devices;

            $params = parent::prepare_params($params, $element, $parent_el);

            $custom_css_name    = 'tz_custom_'.$element['id'];
            $social_color     = isset($params['social-color'])?$params['social-color']:'';
            $social_color     = CSS::make_color_rgba_redux($social_color);

            $social_color_hover     = isset($params['social-color-hover'])?$params['social-color-hover']:'';
            $social_color_hover     = CSS::make_color_rgba_redux($social_color_hover);

            $social_bg_color     = isset($params['social-bg-color'])?$params['social-bg-color']:'';
            $social_bg_color     = CSS::make_color_rgba_redux($social_bg_color);

            $social_bg_color_hover     = isset($params['social-bg-color-hover'])?$params['social-bg-color-hover']:'';
            $social_bg_color_hover     = CSS::make_color_rgba_redux($social_bg_color_hover);

            $social_fix_size     = isset($params['social-fix-width-height'])?$params['social-fix-width-height']:'';

            $social_styles = [];
            if (!empty($social_color)) {
                $social_styles[] = '.'. $custom_css_name . ' li a{ color: ' . $social_color . ' !important;}';
            }
            if (!empty($social_color_hover)) {
                $social_styles[] = '.'. $custom_css_name . ' li a:hover{ color: ' . $social_color_hover . ' !important;}';
            }
            if (!empty($social_bg_color)) {
                $social_styles[] = '.'. $custom_css_name . ' li a{ background-color: ' . $social_bg_color . ' !important;}';
            }
            if (!empty($social_bg_color_hover)) {
                $social_styles[] = '.'. $custom_css_name . ' li a:hover{ background-color: ' . $social_bg_color_hover . ' !important;}';
            }
            if (!empty($params['social-item-border-radius'])) {
                $social_styles[] = '.'. $custom_css_name . ' li a{ border-radius: ' . $params['social-item-border-radius'] . ' !important;}';
            }
            if($social_fix_size ==1 || $social_fix_size == true){
                $social_size = isset($params['social-width-height'])?$params['social-width-height']:'';
                if($social_size['width']){
                    $social_styles[] = '.'. $custom_css_name . ' li a{ width: ' . $social_size['width'] . ' !important;}';
                }
                if($social_size['height']){
                    $social_styles[] = '.'. $custom_css_name . ' li a{ height: ' . $social_size['height'] . ' !important;}';
                }
            }
            Templates::add_inline_style(implode('', $social_styles));

            if(isset($params['social-item-margin']) && !empty($params['social-item-margin'])){

                $margin    = CSS::make_spacing_redux('margin', $params['social-item-margin'], true, 'px');

                if(!empty($margin)){
                    if(is_array($margin)){
                        foreach($css as $device => $pcss){
                            if(!empty($margin[$device])) {
                                $style =  '.' . $custom_css_name . ' li{' . $margin[$device] . '}';
                                Templates::add_inline_style($style, $device);
                            }
                        }
                    }
                    else{
                        Templates::add_inline_style('.' . $custom_css_name . ' li{' . $margin . '}');
                    }
                }
            }

            if(isset($params['social-item-padding']) && !empty($params['social-item-padding'])){

                $padding    = CSS::make_spacing_redux('padding', $params['social-item-padding'], true, 'px');

                if(!empty($padding)){
                    if(is_array($padding)){
                        foreach($css as $device => $pcss){
                            if(!empty($padding[$device])) {
                                $style =  '.' . $custom_css_name . ' li{' . $padding[$device] . '}';
                                Templates::add_inline_style($style, $device);
                            }
                        }
                    }
                    else{
                        Templates::add_inline_style('.' . $custom_css_name . ' li{' . $padding . '}');
                    }
                }
            }

            return $params;
        }


    }

}

?>