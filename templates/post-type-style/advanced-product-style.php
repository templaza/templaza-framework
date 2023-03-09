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
    array(
        'enable'    => true,
        'class'     => '.single .ap-single-box.ap-single-box-media',
        'options' => array(
            'ap_product-media-padding',
            'ap_product-media-margin',
        ),
    ),
    array(
        'enable'    => true,
        'class'     => '.single .ap-single-side-box',
        'options' => array(
            'ap_product-side-box-padding',
            'ap_product-side-box-margin',
            'ap_product-side-box-bg-color',
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
            'ap_product-loop-border-radius',
            'ap_product-loop-shadow',
        ),
    ),
    array(
        'enable'    => true,
        'class'     => '.ap-item .ap-inner .ap-info-inner',
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
    array(
        'enable'    => true,
        'class'     => '.rental .ap-ribbon-content',
        'options' => array(
            'ap_product-rent-color',
            'ap_product-rent-bg-color',
        ),
    ),
    array(
        'enable'    => true,
        'class'     => '.sale .ap-ribbon-content',
        'options' => array(
            'ap_product-sale-color',
            'ap_product-sale-bg-color',
        ),
    ),
    array(
        'enable'    => true,
        'class'     => '.sale-rent .ap-ribbon-content',
        'options' => array(
            'ap_product-sale-rent-color',
            'ap_product-sale-rent-bg-color',
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
            if($index = array_search('ap_product-loop-shadow', $design['options'])){
                $box_shadow = isset($options['ap_product-loop-shadow'])?$options['ap_product-loop-shadow']:'';
                $ap_css_responsive['desktop'] .= CSS::box_shadow($box_shadow);
                unset($design['options'][$index]);
            }
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