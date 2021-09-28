<?php

defined('TEMPLAZA_FRAMEWORK') or exit();

use TemPlazaFramework\Functions;
use TemPlazaFramework\Templates;
extract(shortcode_atts(array(
	'id'                    => uniqid(),
	'tz_id'                 => '',
	'tz_css'                => '',
	'tz_class'              => '',
	'image'              => '',
), $atts));
if(!empty($image)){
	$image      =   json_decode($image);
	if (isset($image->url) && $image->url) {
		// String manipulation should be faster than pathinfo() on newer PHP versions.
		$dot = strrpos($image->url, '.');

		if ($dot !== false)
		{
			$ext = substr($image->url, $dot + 1);

			// Extension cannot contain slashes.
			if (strpos($ext, '/') === false && strpos($ext, '\\') === false)
			{
				$svg    =    $ext == 'svg' ? 'uk-svg' : '';
				echo '<div id="'.$tz_id.'" class="'.$tz_class.'">';
				if ($svg) {
					echo '<img data-uk-img="data-src:'.esc_url($image->url).'" src="'.esc_url($image->url).'" alt="'.esc_attr('Logo').'" data-uk-svg>';
				} else {
					echo '<img data-src="'.esc_url($image->url).'" src="'.esc_url($image->url).'" alt="'.esc_attr('Logo').'" data-uk-img>';
				}
				echo '</div>';
			}
		}
	} elseif (file_exists(get_template_directory().'/assets/images/logo.svg')) {
		echo '<img data-uk-img="data-src:'.esc_url(get_template_directory_uri().'/assets/images/logo.svg').'" src="'.esc_url(get_template_directory_uri().'/assets/images/logo.svg').'" alt="'.esc_attr('Logo').'" data-uk-svg>';
	}
}