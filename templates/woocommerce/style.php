<?php

defined('TEMPLAZA_FRAMEWORK') or exit();

use TemPlazaFramework\CSS;
use TemPlazaFramework\Functions;
use TemPlazaFramework\Templates;

$options = Functions::get_theme_options();

// Style for main menu
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
$loop_summary_styles    = [];
// Style for loop summary
if (!empty($loop_summary_padding_css)) {
    if(is_array($loop_summary_padding_css)){
        foreach($loop_summary_padding_css as $device => $style){
            $style  = 'ul.products li.product .product-summary{' . $style . '}';
            Templates::add_inline_style($style, $device);
        }
    }else {
        $loop_summary_styles[] = 'ul.products li.product .product-summary {' . $loop_summary_padding_css . '}';
    }
}
if (!empty($loop_summary_margin_css)) {
    if(is_array($loop_summary_margin_css)){
        foreach($loop_summary_margin_css as $device => $style){
            $style  = '.templaza-nav > .menu-item > a {' . $style . '}';
            Templates::add_inline_style($style, $device);
        }
    }else {
        $loop_summary_styles[] = 'ul.products li.product .product-summary {' . $loop_summary_margin_css . '}';
    }
}

if(count($loop_summary_styles)) {
    Templates::add_inline_style(implode('', $loop_summary_styles));
}

?>