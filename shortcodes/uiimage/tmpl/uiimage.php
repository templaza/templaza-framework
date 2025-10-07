<?php

defined('TEMPLAZA_FRAMEWORK') or exit();

use TemPlazaFramework\Functions;
use TemPlazaFramework\Templates;
use TemPlazaFramework\CSS;
extract(shortcode_atts(array(
	'id'                    => uniqid(),
	'tz_id'                 => '',
	'tz_css'                => '',
	'tz_class'              => '',
	'image'                 => '',
	'image_url'             => '',
	'image_target'          => '',
	'image_radius'          => '',
	'image_custom_height'   => '',
	'image_height'          => '',
	'image_transition'      => '',
), $atts));
if(!empty($image)){
	$image      =   json_decode($image);
	$image_large = wp_get_attachment_image_url($image->id,'large');
    $cover = $toggle = $transition_opaque = $ripple_html = $ripple_cl ='';
	if($image_custom_height){
	    $cover = 'data-uk-cover';
    }
	if($image_transition){
	    $toggle = 'uk-transition-toggle';
	    $transition_opaque = ' uk-transition-opaque';
    }
    if($image_transition =='ripple'){
        $ripple_html = '<div class="templaza-ripple-circles uk-position-center uk-transition-fade">
                        <div class="circle1"></div>
                        <div class="circle2"></div>
                        <div class="circle3"></div>
                    </div>';
        $ripple_cl = ' templaza-thumb-ripple ';
    }
	if (isset($image_large) && $image_large) {
		// String manipulation should be faster than pathinfo() on newer PHP versions.
		$dot = strrpos($image->url, '.');

		if ($dot !== false)
		{
			$ext = substr($image->url, $dot + 1);

			// Extension cannot contain slashes.
			if (strpos($ext, '/') === false && strpos($ext, '\\') === false)
			{
				$svg    =    $ext == 'svg' ? 'uk-svg' : '';
				echo '<div id="'.esc_attr($tz_id).'" class="'.esc_attr($tz_class).'"><div class="tz-image-el uk-cover-container '.$toggle.$ripple_cl.'" >';
				if(isset($image_url) && $image_url !=''){
                echo '<a class="tz-img  uk-display-block" target="'.$image_target.'" href="'.esc_url($image_url).'">';
                }
				if ($svg) {
					echo '<img class="uk-preserve '.$image_transition.' " data-uk-img="data-src:'.esc_url($image_large).'" src="'.esc_url($image_large).'" alt="'.esc_attr('Logo').'" data-uk-svg>';
				} else {
					echo '<img class="'.$image_transition.$transition_opaque.'" '.$cover.' data-src="'.esc_url($image_large).'" src="'.esc_url($image_large).'" alt="'.esc_attr('Logo').'" data-uk-img>';
				}
                echo wp_kses($ripple_html, 'post');
				if(isset($image_url)){
                echo '</a>';
                }
                echo '</div></div>';
			}
		}
	}
}