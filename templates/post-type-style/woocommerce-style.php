<?php

defined('TEMPLAZA_FRAMEWORK') or exit();

use TemPlazaFramework\CSS;
use TemPlazaFramework\Functions;
use TemPlazaFramework\Templates;

$options = Functions::get_theme_options();

// Style Padding for loop summary
$loop_summary_padding_css  = '';
$loop_summary_padding  = isset($options['templaza-shop-padding'])?$options['templaza-shop-padding']:'';

if(is_array($loop_summary_padding) && count($loop_summary_padding)) {
    $loop_summary_padding_css  = CSS::make_spacing_redux('padding', $loop_summary_padding, true);
}

$loop_summary_margin_css   = '';
$loop_summary_margin  = isset($options['templaza-shop-margin'])?$options['templaza-shop-margin']:'';
if(is_array($loop_summary_margin) && count($loop_summary_margin)) {
    $loop_summary_margin_css  = CSS::make_spacing_redux('margin', $loop_summary_margin, true);
}
$templaza_shop_styles    = [];
// Style for loop summary
if (!empty($loop_summary_padding_css)) {
    if(is_array($loop_summary_padding_css)){
        foreach($loop_summary_padding_css as $device => $style){
            $style  = 'ul.products li.product .product-summary{' . $style . '}';
            Templates::add_inline_style($style, $device);
        }
    }else {
        $templaza_shop_styles[] = 'ul.products li.product .product-summary {' . $loop_summary_padding_css . '}';
    }
}
if (!empty($loop_summary_margin_css)) {
    if(is_array($loop_summary_margin_css)){
        foreach($loop_summary_margin_css as $device => $style){
            $style  = 'ul.products li.product .product-summary {' . $style . '}';
            Templates::add_inline_style($style, $device);
        }
    }else {
        $templaza_shop_styles[] = 'ul.products li.product .product-summary {' . $loop_summary_margin_css . '}';
    }
}
// Style for Single Shop Box

$single_box_padding  = isset($options['templaza-shop-single-box-padding'])?$options['templaza-shop-single-box-padding']:'';

if(is_array($single_box_padding) && count($single_box_padding)) {
    $single_box_padding_css  = CSS::make_spacing_redux('padding', $single_box_padding, true);
}
if (!empty($single_box_padding_css)) {
    if(is_array($single_box_padding_css)){
        foreach($single_box_padding_css as $device => $style){
            $style  = '.templaza-shop-box, .woocommerce-tabs{' . $style . '}';
            Templates::add_inline_style($style, $device);
        }
    }else {
        $templaza_shop_styles[] = '.templaza-shop-box, .woocommerce-tabs{' . $single_box_padding_css . '}';
    }
}
$single_box_margin  = isset($options['templaza-shop-single-box-margin'])?$options['templaza-shop-single-box-margin']:'';

if(is_array($single_box_margin) && count($single_box_margin)) {
    $single_box_margin_css  = CSS::make_spacing_redux('margin', $single_box_margin, true);
}
if (!empty($single_box_margin_css)) {
    if(is_array($single_box_margin_css)){
        foreach($single_box_margin_css as $device => $style){
            $style  = '.templaza-shop-box, .woocommerce-tabs{' . $style . '}';
            Templates::add_inline_style($style, $device);
        }
    }else {
        $templaza_shop_styles[] = '.templaza-shop-box, .woocommerce-tabs{' . $single_box_margin_css . '}';
    }
}
$shop_css               = '';
$templaza_shop_background_color  = isset($options['templaza-shop-background-color'])?$options['templaza-shop-background-color']:'';
$templaza_shop_background_color  = CSS::make_color_rgba_redux($templaza_shop_background_color);
$shop_css              .= !empty($templaza_shop_background_color)?'background-color:'.$templaza_shop_background_color.';':'';

if($templaza_shop_background_color){
    $templaza_shop_styles[] = 'ul.products li.product .product-summary,
     ul.products.product-loop-layout-4 li.product .product-loop__buttons,
     .templaza-sticky-add-to-cart{ ' . $shop_css . '}';
}

$single_css               = '';
$single_box_background_color  = isset($options['templaza-shop-single-box-background-color'])?$options['templaza-shop-single-box-background-color']:'';
$single_box_background_color  = CSS::make_color_rgba_redux($single_box_background_color);
$single_css              .= !empty($single_box_background_color)?'background-color:'.$single_box_background_color.';':'';

if($single_box_background_color){
    $templaza_shop_styles[] = '.templaza-shop-box, .woocommerce-tabs{ ' . $single_css . '}';
}
// Style for Single Shop Description max width

$single_shop_max_width  = isset($options['templaza-shop-single-content-max-width'])?$options['templaza-shop-single-content-max-width']:70;
if((int)$single_shop_max_width['width'] > 0 ){
    $templaza_shop_styles[] = '.single-product div.product .woocommerce-tabs .panel{ max-width:' . $single_shop_max_width['width'] . '}';
}
if(count($templaza_shop_styles)) {
    Templates::add_inline_style(implode('', $templaza_shop_styles));
}
?>