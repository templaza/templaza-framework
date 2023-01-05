<?php

defined('TEMPLAZA_FRAMEWORK') or exit();

use TemPlazaFramework\CSS;
use TemPlazaFramework\Functions;
use TemPlazaFramework\Templates;

$options = Functions::get_theme_options();

// Style for main menu
$main_menu_padding_css  = '';
$main_menu_padding  = isset($options['main-menu-padding'])?$options['main-menu-padding']:'';

if(is_array($main_menu_padding) && count($main_menu_padding)) {
    $main_menu_padding_css  = CSS::make_spacing_redux('padding', $main_menu_padding, true);
}

$main_menu_margin_css   = '';
$main_menu_margin  = isset($options['main-menu-margin'])?$options['main-menu-margin']:'';
if(is_array($main_menu_margin) && count($main_menu_margin)) {

    $main_menu_margin_css  = CSS::make_spacing_redux('margin', $main_menu_margin, true);
}

$main_menu_border_css   = '';
$main_menu_border  = isset($options['main-menu-border'])?$options['main-menu-border']:'';
if(is_array($main_menu_border) && count($main_menu_border)) {
    $main_menu_border_css = CSS::make_border_redux($main_menu_border, true);
}

// Style for drop-down menu
$dropdown_menu_padding_css  = '';
$dropdown_menu_padding  = isset($options['dropdown-menu-padding'])?$options['dropdown-menu-padding']:'';
if(is_array($dropdown_menu_padding) && count($dropdown_menu_padding)) {

    $dropdown_menu_padding_css  = CSS::make_spacing_redux('padding', $dropdown_menu_padding, true);
}

$dropdown_menu_margin_css   = '';
$dropdown_menu_margin  = isset($options['dropdown-menu-margin'])?$options['dropdown-menu-margin']:'';
if(is_array($dropdown_menu_margin) && count($dropdown_menu_margin)) {
    $dropdown_menu_margin_css  = CSS::make_spacing_redux('margin', $dropdown_menu_margin, true);
}

// Sticky menu
$sticky_menu_padding_css  = '';
$sticky_menu_padding  = isset($options['sticky-menu-padding'])?$options['sticky-menu-padding']:'';
if(is_array($sticky_menu_padding) && count($sticky_menu_padding)) {

    $sticky_menu_padding_css  = CSS::make_spacing_redux('padding', $sticky_menu_padding, true);
}

$sticky_menu_margin_css   = '';
$sticky_menu_margin  = isset($options['sticky-menu-margin'])?$options['sticky-menu-margin']:'';
if(is_array($sticky_menu_margin) && count($sticky_menu_margin)) {

    $sticky_menu_margin_css  = CSS::make_spacing_redux('margin', $sticky_menu_margin, true);
}

$menu_styles    = [];

// Style for main menu
if (!empty($main_menu_padding_css)) {
    if(is_array($main_menu_padding_css)){
        foreach($main_menu_padding_css as $device => $style){
            $style  = '.templaza-nav > .menu-item > a {' . $style . '}';
            Templates::add_inline_style($style, $device);
        }
    }else {
        $menu_styles[] = '.templaza-nav > .menu-item > a {' . $main_menu_padding_css . '}';
    }
}
if (!empty($main_menu_margin_css)) {
    if(is_array($main_menu_margin_css)){
        foreach($main_menu_margin_css as $device => $style){
            $style  = '.templaza-nav > .menu-item > a {' . $style . '}';
            Templates::add_inline_style($style, $device);
        }
    }else {
        $menu_styles[] = '.templaza-nav > .menu-item > a {' . $main_menu_margin_css . '}';
    }
}
if (!empty($main_menu_border_css)) {
    if(is_array($main_menu_border_css)){
        foreach($main_menu_border_css as $device => $style){
            $style  = '.templaza-nav > .menu-item > a {' . $style . '}';
            Templates::add_inline_style($style, $device);
        }
    }else {
        $menu_styles[] = '.templaza-nav > .menu-item > a {' . $main_menu_border_css . '}';
    }
}

// Style for main drop-down menu
if (!empty($dropdown_menu_padding_css)) {
    if(is_array($dropdown_menu_padding_css)){
        foreach($dropdown_menu_padding_css as $device => $style){
            $style  = '.templaza-nav .sub-menu > .menu-item > a {' . $style . '}';
            Templates::add_inline_style($style, $device);
        }
    }else {
        $menu_styles[] = '.templaza-nav .sub-menu > .menu-item > a {' . $dropdown_menu_padding_css . '}';
    }
}
if (!empty($dropdown_menu_margin_css)) {
    if(is_array($dropdown_menu_margin_css)){
        foreach($dropdown_menu_margin_css as $device => $style){
            $style  = '.templaza-nav .sub-menu > .menu-item > a {' . $style . '}';
            Templates::add_inline_style($style, $device);
        }
    }else {
        $menu_styles[] = '.templaza-nav .sub-menu > .menu-item > a {' . $dropdown_menu_margin_css . '}';
    }
}

// Style for sticky menu
$sticky_menu_styles = [];

if (!empty($sticky_menu_padding_css)) {
    if(is_array($sticky_menu_padding_css)){
        foreach($sticky_menu_padding_css as $device => $style){
            $style  = '#templaza-sticky-header .templaza-nav > .menu-item > a{' . $style . '}';
            Templates::add_inline_style($style, $device);
        }
    }else {
        $sticky_menu_styles[] = '#templaza-sticky-header .templaza-nav > .menu-item > a{' . $sticky_menu_padding_css . '}';
    }
}
if (!empty($sticky_menu_margin_css)) {
    if(is_array($sticky_menu_margin_css)){
        foreach($sticky_menu_margin_css as $device => $style){
            $style  = '#templaza-sticky-header .templaza-nav > .menu-item > a{' . $style . '}';
            Templates::add_inline_style($style, $device);
        }
    }else {
        $sticky_menu_styles[] = '#templaza-sticky-header .templaza-nav > .menu-item > a{' . $sticky_menu_margin_css . '}';
    }
}

if(count($menu_styles)) {
    Templates::add_inline_style(implode('', $menu_styles));
}
if(count($sticky_menu_styles)) {
    Templates::add_inline_style(implode('', $sticky_menu_styles));
}
?>