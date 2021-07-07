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
					echo '<img uk-img="data-src:'.$image->url.'" uk-svg>';
				} else {
					echo '<img data-src="'.$image->url.'" uk-img>';
				}
				echo '</div>';
			}
		}
	}
}