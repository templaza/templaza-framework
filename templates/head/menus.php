<?php

defined('TEMPLAZA_FRAMEWORK') or exit();

use TemPlazaFramework\Functions;
use TemPlazaFramework\Templates;

$options = Functions::get_theme_options();

// Style for main menu
$main_menu_padding_css  = '';
$main_menu_padding  = isset($options['main-menu-padding'])?$options['main-menu-padding']:'';
if(is_array($main_menu_padding) && count($main_menu_padding)) {
    if(isset($main_menu_padding['padding-top']) && strlen($main_menu_padding['padding-top'])){
        $main_menu_padding_css    .= 'padding-top: '.$main_menu_padding['padding-top'].' !important;';
    }
    if(isset($main_menu_padding['padding-right']) && strlen($main_menu_padding['padding-right'])){
        $main_menu_padding_css    .= 'padding-right: '.$main_menu_padding['padding-right'].' !important;';
    }
    if(isset($main_menu_padding['padding-bottom']) && strlen($main_menu_padding['padding-bottom'])){
        $main_menu_padding_css    .= 'padding-bottom: '.$main_menu_padding['padding-bottom'].' !important;';
    }
    if(isset($main_menu_padding['padding-left']) && strlen($main_menu_padding['padding-left'])){
        $main_menu_padding_css    .= 'padding-left: '.$main_menu_padding['padding-left'].' !important;';
    }
}

$main_menu_margin_css   = '';
$main_menu_margin  = isset($options['main-menu-margin'])?$options['main-menu-margin']:'';
if(is_array($main_menu_margin) && count($main_menu_margin)) {
    if(isset($main_menu_margin['margin-top']) && strlen($main_menu_margin['margin-top'])){
        $main_menu_margin_css    .= 'margin-top: '.$main_menu_margin['margin-top'].' !important;';
    }
    if(isset($main_menu_margin['margin-right']) && strlen($main_menu_margin['margin-right'])){
        $main_menu_margin_css    .= 'margin-right: '.$main_menu_margin['margin-right'].' !important;';
    }
    if(isset($main_menu_margin['margin-bottom']) && strlen($main_menu_margin['margin-bottom'])){
        $main_menu_margin_css    .= 'margin-bottom: '.$main_menu_margin['margin-bottom'].' !important;';
    }
    if(isset($main_menu_margin['margin-left']) && strlen($main_menu_margin['margin-left'])){
        $main_menu_margin_css    .= 'margin-left: '.$main_menu_margin['margin-left'].' !important;';
    }
}

// Style for drop-down menu
$dropdown_menu_padding_css  = '';
$dropdown_menu_padding  = isset($options['dropdown-menu-padding'])?$options['dropdown-menu-padding']:'';
if(is_array($dropdown_menu_padding) && count($dropdown_menu_padding)) {
	if(isset($dropdown_menu_padding['padding-top']) && strlen($dropdown_menu_padding['padding-top'])){
		$dropdown_menu_padding_css    .= 'padding-top: '.$dropdown_menu_padding['padding-top'].' !important;';
	}
	if(isset($dropdown_menu_padding['padding-right']) && strlen($dropdown_menu_padding['padding-right'])){
		$dropdown_menu_padding_css    .= 'padding-right: '.$dropdown_menu_padding['padding-right'].' !important;';
	}
	if(isset($dropdown_menu_padding['padding-bottom']) && strlen($dropdown_menu_padding['padding-bottom'])){
		$dropdown_menu_padding_css    .= 'padding-bottom: '.$dropdown_menu_padding['padding-bottom'].' !important;';
	}
	if(isset($dropdown_menu_padding['padding-left']) && strlen($dropdown_menu_padding['padding-left'])){
		$dropdown_menu_padding_css    .= 'padding-left: '.$dropdown_menu_padding['padding-left'].' !important;';
	}
}

$dropdown_menu_margin_css   = '';
$dropdown_menu_margin  = isset($options['dropdown-menu-margin'])?$options['dropdown-menu-margin']:'';
if(is_array($dropdown_menu_margin) && count($dropdown_menu_margin)) {
	if(isset($dropdown_menu_margin['margin-top']) && strlen($dropdown_menu_margin['margin-top'])){
		$dropdown_menu_margin_css    .= 'margin-top: '.$dropdown_menu_margin['margin-top'].' !important;';
	}
	if(isset($dropdown_menu_margin['margin-right']) && strlen($dropdown_menu_margin['margin-right'])){
		$dropdown_menu_margin_css    .= 'margin-right: '.$dropdown_menu_margin['margin-right'].' !important;';
	}
	if(isset($dropdown_menu_margin['margin-bottom']) && strlen($dropdown_menu_margin['margin-bottom'])){
		$dropdown_menu_margin_css    .= 'margin-bottom: '.$dropdown_menu_margin['margin-bottom'].' !important;';
	}
	if(isset($dropdown_menu_margin['margin-left']) && strlen($dropdown_menu_margin['margin-left'])){
		$dropdown_menu_margin_css    .= 'margin-left: '.$dropdown_menu_margin['margin-left'].' !important;';
	}
}

// Sticky menu
$sticky_menu_padding_css  = '';
$sticky_menu_padding  = isset($options['sticky-menu-padding'])?$options['sticky-menu-padding']:'';
if(is_array($sticky_menu_padding) && count($sticky_menu_padding)) {
    if(isset($sticky_menu_padding['padding-top']) && strlen($sticky_menu_padding['padding-top'])){
        $sticky_menu_padding_css    .= 'padding-top: '.$sticky_menu_padding['padding-top'].' !important;';
    }
    if(isset($sticky_menu_padding['padding-right']) && strlen($sticky_menu_padding['padding-right'])){
        $sticky_menu_padding_css    .= 'padding-right: '.$sticky_menu_padding['padding-right'].' !important;';
    }
    if(isset($sticky_menu_padding['padding-bottom']) && strlen($sticky_menu_padding['padding-bottom'])){
        $sticky_menu_padding_css    .= 'padding-bottom: '.$sticky_menu_padding['padding-bottom'].' !important;';
    }
    if(isset($sticky_menu_padding['padding-left']) && strlen($sticky_menu_padding['padding-left'])){
        $sticky_menu_padding_css    .= 'padding-left: '.$sticky_menu_padding['padding-left'].' !important;';
    }
}

$sticky_menu_margin_css   = '';
$sticky_menu_margin  = isset($options['sticky-menu-margin'])?$options['sticky-menu-margin']:'';
if(is_array($sticky_menu_margin) && count($sticky_menu_margin)) {
    if(isset($sticky_menu_margin['margin-top']) && strlen($sticky_menu_margin['margin-top'])){
        $sticky_menu_margin_css    .= 'margin-top: '.$sticky_menu_margin['margin-top'].' !important;';
    }
    if(isset($sticky_menu_margin['margin-right']) && strlen($sticky_menu_margin['margin-right'])){
        $sticky_menu_margin_css    .= 'margin-right: '.$sticky_menu_margin['margin-right'].' !important;';
    }
    if(isset($sticky_menu_margin['margin-bottom']) && strlen($sticky_menu_margin['margin-bottom'])){
        $sticky_menu_margin_css    .= 'margin-bottom: '.$sticky_menu_margin['margin-bottom'].' !important;';
    }
    if(isset($sticky_menu_margin['margin-left']) && strlen($sticky_menu_margin['margin-left'])){
        $sticky_menu_margin_css    .= 'margin-left: '.$sticky_menu_margin['margin-left'].' !important;';
    }
}

$menu_styles    = [];

// Style for main menu
if (!empty($main_menu_padding_css)) {
    $menu_styles[]  = '.templaza-nav > .menu-item > a {'.$main_menu_padding_css.'}';
}
if (!empty($main_menu_margin_css)) {
    $menu_styles[]  = '.templaza-nav > .menu-item > a {'.$main_menu_margin_css.'}';
}

// Style for main drop-down menu
if (!empty($dropdown_menu_padding_css)) {
	$menu_styles[]  = '.templaza-nav .sub-menu > .menu-item > a {'.$dropdown_menu_padding_css.'}';
}
if (!empty($dropdown_menu_margin_css)) {
	$menu_styles[]  = '.templaza-nav .sub-menu > .menu-item > a {'.$dropdown_menu_margin_css.'}';
}

// Style for sticky menu
$sticky_menu_styles = [];

if (!empty($sticky_menu_padding_css)) {
    $sticky_menu_styles[] = '#templaza-sticky-header .templaza-nav > .menu-item > a{' . $sticky_menu_padding_css . '}';
}
if (!empty($sticky_menu_margin_css)) {
    $sticky_menu_styles[] = '#templaza-sticky-header .templaza-nav > .menu-item > a{' . $sticky_menu_margin_css . '}';
}

Templates::add_inline_style(implode('', $menu_styles));
Templates::add_inline_style(implode('', $sticky_menu_styles));
?>