<?php
defined('TEMPLAZA_FRAMEWORK') or exit();

use TemPlazaFramework\CSS;
use TemPlazaFramework\Functions;
use TemPlazaFramework\Templates;
$options = Functions::get_theme_options();

// Style for product catalog
$product_padding_css  = '';
$product_padding  = isset($options['templaza-shop-padding'])?$options['templaza-shop-padding']:'';

if(is_array($product_padding) && count($product_padding)) {
    $product_padding_css  = CSS::make_spacing_redux('padding', $product_padding, true);
}

$product_margin_css   = '';
$product_margin  = isset($options['templaza-shop-margin'])?$options['templaza-shop-margin']:'';
if(is_array($product_margin) && count($product_margin)) {
    $product_margin_css  = CSS::make_spacing_redux('margin', $product_margin, true);
}
// Create css
$product_styles    = [];

if (!empty($product_padding_css)) {
    if(is_array($product_padding_css)){
        foreach($product_padding_css as $device => $style){
            $style  = 'ul.products li.product {' . $style . '}';
            Templates::add_inline_style($style, $device);
        }
    }else {
        $product_styles[] = 'ul.products li.product {' . $product_padding_css . '}';
    }
}
if (!empty($product_margin_css)) {
    if(is_array($product_margin_css)){
        foreach($product_margin_css as $device => $style){
            $style  = 'ul.products li.product {' . $style . '}';
            Templates::add_inline_style($style, $device);
        }
    }else {
        $product_styles[] = 'ul.products li.product {' . $product_margin_css . '}';
    }
}

if(count($product_styles)) {
    Templates::add_inline_style(implode('', $product_styles));
}