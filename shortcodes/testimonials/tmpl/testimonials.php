<?php

defined('TEMPLAZA_FRAMEWORK') or exit();

use TemPlazaFramework\Functions;
use TemPlazaFramework\Templates;
extract(shortcode_atts(array(
    'id'                    => uniqid(),
    'tz_id'                 => '',
    'tz_css'                => '',
    'tz_class'              => '',
    'testimonials_wrap_style'        => '',
    'testimonials_items'             => '',

), $atts));
if(!empty($nav_items)){
    $navs      =   json_decode($nav_items, true);
    if (count($navs)) {
        echo '<ul id="'.esc_attr($tz_id).'" class="uk-nav '.esc_attr($tz_class.(!empty($nav_alignment) ? ' uk-text-'.$nav_alignment.'@m' : '')).' '.$nav_wrap_style.'">';
    }
    for ($i = 0; $i < count($navs); $i++ ) {
        $nav = $navs[$i];
        echo '<li class="tz-nav-item '.esc_attr((!empty($nav_wrap_style) ? ' uk-'.$nav_wrap_style : '')).' '.(isset($nav['nav_item_active']) && $nav['nav_item_active'] != '0' ? ' uk-active' : '').'"><a href="'.esc_url($nav['nav_item_url']).'"'.(!empty($nav_style) && $nav_style != '-' ? ' class="uk-link-'.esc_attr($nav_style).'"' : '').'>'.wp_kses((isset($nav['nav_item_icon']) && $nav['nav_item_icon'] && $nav['nav_item_icon'] != '-' ? '<span data-uk-icon="'.$nav['nav_item_icon'].'"></span> ' : '').$nav['nav_item_title'], 'data').'</a></li>';
    }
    if (count($navs)) {
        echo '</ul>';
    }
}