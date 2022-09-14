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
                'title'       => __('Social'),
                'desc'        => __('Load a social.'),
                'param_title' => __('Social settings'),
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
                )
            );
        }

        public function prepare_params($params, $element, $parent_el){
            $css = Templates::$_devices;

            $params = parent::prepare_params($params, $element, $parent_el);

            $custom_css_name    = 'tz_custom_'.$element['id'];

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

            return $params;
        }


    }

}

?>