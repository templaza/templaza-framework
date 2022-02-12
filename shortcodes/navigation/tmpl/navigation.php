<?php

defined('TEMPLAZA_FRAMEWORK') or exit();

use TemPlazaFramework\Functions;
use TemPlazaFramework\Templates;
extract(shortcode_atts(array(
	'id'                    => uniqid(),
	'tz_id'                 => '',
	'tz_css'                => '',
	'tz_class'              => '',
	'nav_wrap_style'        => '',
	'nav_items'             => '',
	'nav_alignment'         => '',
	'nav_style'             => '',
	'nav_color'             => '',
	'nav_background'        => '',
	'nav_border'            => '',
	'nav_color_hover'       => '',
	'nav_background_hover'  => '',
	'nav_border_hover'      => '',
	'nav_decoration'        => '',
	'nav_decoration_hover'  => '',
	'nav_item_margin'  => '',
	'nav_item_padding'  => '',
), $atts));
if(!empty($nav_items)){
	$navs      =   json_decode($nav_items, true);
	if (count($navs)) {
		echo '<ul id="'.esc_attr($tz_id).'" class="uk-nav '.esc_attr($tz_class.(!empty($nav_alignment) ? ' uk-text-'.$nav_alignment.'@m' : '')).'">';
	}
	for ($i = 0; $i < count($navs); $i++ ) {
		$nav = $navs[$i];
		echo '<li class="tz-nav-item '.esc_attr((!empty($nav_wrap_style) ? ' uk-'.$nav_wrap_style : '')).' '.(isset($nav['nav_item_active']) && $nav['nav_item_active'] != '0' ? ' uk-active' : '').'"><a href="'.esc_url($nav['nav_item_url']).'"'.(!empty($nav_style) && $nav_style != '-' ? ' class="uk-link-'.esc_attr($nav_style).'"' : '').'>'.wp_kses((isset($nav['nav_item_icon']) && $nav['nav_item_icon'] && $nav['nav_item_icon'] != '-' ? '<span data-uk-icon="'.$nav['nav_item_icon'].'"></span> ' : '').$nav['nav_item_title'], 'data').'</a></li>';
	}
	if (count($navs)) {
		echo '</ul>';
	}

	// Custom style
	if (count($navs)) {
		if (!empty($nav_item_margin)) {
			$nav_item_margin    =   json_decode($nav_item_margin, true);
			$nav_css    =   Functions::get_margin($nav_item_margin);
			if (!empty($nav_css['desktop'])) {
				Templates::add_inline_style('#'.$tz_id.' .tz-nav-item > a {'.$nav_css['desktop'].'}');
			}
			if (!empty($nav_css['tablet'])) {
				Templates::add_inline_style('@media (min-width: 768px) and (max-width: 991px) { #'.$tz_id.' .tz-nav-item > a {'.$nav_css['tablet'].'}}');
			}
			if (!empty($nav_css['mobile'])) {
				Templates::add_inline_style('@media (max-width: 767px) { #'.$tz_id.' .tz-nav-item > a {'.$nav_css['mobile'].'}}');
			}
		}

		if (!empty($nav_item_padding)) {
			$nav_item_padding    =   json_decode($nav_item_padding, true);
			$nav_css    =   Functions::get_padding($nav_item_padding);
			if (!empty($nav_css['desktop'])) {
				Templates::add_inline_style('#'.$tz_id.' .tz-nav-item > a {'.$nav_css['desktop'].'}');
			}
			if (!empty($nav_css['tablet'])) {
				Templates::add_inline_style('@media (min-width: 768px) and (max-width: 991px) { #'.$tz_id.' .tz-nav-item > a {'.$nav_css['tablet'].'}}');
			}
			if (!empty($nav_css['mobile'])) {
				Templates::add_inline_style('@media (max-width: 767px) { #'.$tz_id.' .tz-nav-item > a {'.$nav_css['mobile'].'}}');
			}
		}

		if (!empty($nav_decoration)) {
			Templates::add_inline_style('#'.$tz_id.' .tz-nav-item > a {text-decoration: '.$nav_decoration.';}');
		}
		if (!empty($nav_color)) {
			Templates::add_inline_style('#'.$tz_id.' .tz-nav-item > a {color: '.$nav_color.';}');
		}
		if (!empty($nav_background)) {
			$background = Functions::get_background(json_decode($nav_background, true));
			if ($background) Templates::add_inline_style('#'.$tz_id.' .tz-nav-item > a {'.$background.'}');
		}
		if (!empty($nav_border)) {
			$border     =  Functions::get_border(json_decode($nav_border, true));
			if ($border) Templates::add_inline_style('#'.$tz_id.' .tz-nav-item > a {'.$border.'}');
		}

		//Hover style
		if (!empty($nav_decoration_hover)) {
			Templates::add_inline_style('#'.$tz_id.' .tz-nav-item > a:hover {text-decoration: '.$nav_decoration_hover.';}');
		}
		if (!empty($nav_color_hover)) {
			Templates::add_inline_style('#'.$tz_id.' .tz-nav-item > a:hover {color: '.$nav_color_hover.';}');
		}
		if (!empty($nav_background_hover)) {
			$background = Functions::get_background(json_decode($nav_background_hover, true));
			if ($background) Templates::add_inline_style('#'.$tz_id.' .tz-nav-item > a:hover {'.$background.'}');
		}
		if (!empty($nav_border_hover)) {
			$border     =  Functions::get_border(json_decode($nav_border_hover, true));
			if ($border) Templates::add_inline_style('#'.$tz_id.' .tz-nav-item > a:hover {'.$border.'}');
		}
	}
}