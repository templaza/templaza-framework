<?php

defined('TEMPLAZA_FRAMEWORK') or exit();

use TemPlazaFramework\Functions;
use TemPlazaFramework\Templates;
use TemPlazaFramework\CSS;

$options = Functions::get_theme_options();

$ap_styles    = array(
    // single
    array(
        'enable'    => true,
        'class'     => '.single .ap-custom-fields',
        'options' => array(
            'ap_product-custom-field-margin',
        ),
    ),
    array(
        'enable'    => true,
        'class'     => '.single .ap-single-box',
        'options' => array(
            'ap_product-box-padding',
            'ap_product-box-margin',
            'ap_product-box-bg-color',
        ),
    ),
    // Archive
    array(
        'enable'    => true,
        'class'     => '.ap-item .ap-inner',
        'options' => array(
            'ap_product-loop-padding',
            'ap_product-loop-bg-color',
            'ap_product-loop-border',
        ),
    ),
    array(
        'enable'    => true,
        'class'     => '.ap-inner .ap-info-inner',
        'options' => array(
            'ap_product-loop-info-padding',
        ),
    ),
    array(
        'enable'    => true,
        'class'     => '.ap-item .ap-inner:hover',
        'options' => array(
            'ap_product-loop-border_hover',
        ),
    ),

);

// Generate design styles.
if(count($ap_styles)) {
    $styles    = array();

    foreach($ap_styles as $design){
        $enable = isset($design['enable']) ? (bool)$design['enable'] : false;
        if ($enable) {
            $ap_css_responsive  = array(
                'desktop' => '',
                'tablet' => '',
                'mobile' => '',
            );
            $ap_css    = Templates::make_css_design_style($design['options'], $options,true);
            if(!empty($ap_css)){
                if(is_array($ap_css)){
                    foreach ($ap_css as $device => $ad_style){
                        if(isset($ap_css_responsive[$device]) && !empty($ap_css_responsive[$device])){
                            $ad_style   .= $ap_css_responsive[$device];
                        }
                        if(!empty($ad_style)) {
                            $ad_style = $design['class'] . '{' . $ad_style . '}';
                            Templates::add_inline_style($ad_style, $device);
                        }
                    }
                }else{
                    Templates::add_inline_style($design['class'].'{'.$ap_css.'}');
                }
            }
        }
    }
}