<?php

defined('TEMPLAZA_FRAMEWORK') or exit();

use TemPlazaFramework\Functions;
use TemPlazaFramework\Templates;

$options        = Functions::get_theme_options();

$enable_preloader   = isset($options['preloader'])?(bool) $options['preloader']:true;

if (!$enable_preloader) {
	return;
}

$preloder_setting       = isset($options['preloader-setting'])?$options['preloader-setting']:'animations';
$preloader_animation    = isset($options['preloader-animation'])?$options['preloader-animation']:'circle';

if($preloder_setting == "animations"){
	switch ($preloader_animation) {
		case 'rotating-plane':
			$preloaderHTML = '<div class="sk-rotating-plane"></div>';
			break;
		case 'double-bounce':
			$preloaderHTML = '<div class="sk-double-bounce"><div class="sk-child sk-double-bounce1"></div><div class="sk-child sk-double-bounce2"></div></div>';
			break;
		case 'wave':
			$preloaderHTML = '<div class="sk-wave"><div class="sk-rect sk-rect1"></div><div class="sk-rect sk-rect2"></div><div class="sk-rect sk-rect3"></div><div class="sk-rect sk-rect4"></div><div class="sk-rect sk-rect5"></div></div>';
			break;
		case 'wandering-cubes':
			$preloaderHTML = '<div class="sk-wandering-cubes"><div class="sk-cube sk-cube1"></div><div class="sk-cube sk-cube2"></div></div>';
			break;
		case 'pulse':
			$preloaderHTML = '<div class="sk-spinner sk-spinner-pulse"></div>';
			break;
		case 'chase':
			$preloaderHTML = '<div class="sk-chase"><div class="sk-chase-dot"></div><div class="sk-chase-dot"></div><div class="sk-chase-dot"></div><div class="sk-chase-dot"></div><div class="sk-chase-dot"></div><div class="sk-chase-dot"></div></div>';
			break;
		case 'chasing-dots':
			$preloaderHTML = '<div class="sk-chasing-dots"><div class="sk-child sk-dot1"></div><div class="sk-child sk-dot2"></div></div>';
			break;
		case 'three-bounce':
			$preloaderHTML = '<div class="sk-three-bounce"> <div class="sk-child sk-bounce1"></div><div class="sk-child sk-bounce2"></div><div class="sk-child sk-bounce3"></div></div>';
			break;
		case 'circle':
			$preloaderHTML = '<div class="sk-circle"> <div class="sk-circle1 sk-child"></div><div class="sk-circle2 sk-child"></div><div class="sk-circle3 sk-child"></div><div class="sk-circle4 sk-child"></div><div class="sk-circle5 sk-child"></div><div class="sk-circle6 sk-child"></div><div class="sk-circle7 sk-child"></div><div class="sk-circle8 sk-child"></div><div class="sk-circle9 sk-child"></div><div class="sk-circle10 sk-child"></div><div class="sk-circle11 sk-child"></div><div class="sk-circle12 sk-child"></div></div>';
			break;
		case 'cube-grid':
			$preloaderHTML = '<div class="sk-cube-grid"> <div class="sk-cube sk-cube1"></div><div class="sk-cube sk-cube2"></div><div class="sk-cube sk-cube3"></div><div class="sk-cube sk-cube4"></div><div class="sk-cube sk-cube5"></div><div class="sk-cube sk-cube6"></div><div class="sk-cube sk-cube7"></div><div class="sk-cube sk-cube8"></div><div class="sk-cube sk-cube9"></div></div>';
			break;
		case 'fading-circle':
			$preloaderHTML = '<div class="sk-fading-circle"> <div class="sk-circle1 sk-circle"></div><div class="sk-circle2 sk-circle"></div><div class="sk-circle3 sk-circle"></div><div class="sk-circle4 sk-circle"></div><div class="sk-circle5 sk-circle"></div><div class="sk-circle6 sk-circle"></div><div class="sk-circle7 sk-circle"></div><div class="sk-circle8 sk-circle"></div><div class="sk-circle9 sk-circle"></div><div class="sk-circle10 sk-circle"></div><div class="sk-circle11 sk-circle"></div><div class="sk-circle12 sk-circle"></div></div>';
			break;
		case 'folding-cube':
			$preloaderHTML = '<div class="sk-folding-cube"> <div class="sk-cube1 sk-cube"></div><div class="sk-cube2 sk-cube"></div><div class="sk-cube4 sk-cube"></div><div class="sk-cube3 sk-cube"></div></div>';
			break;
		case 'bouncing-loader':
			$preloaderHTML = '<div class="bouncing-loader"><div></div><div></div><div></div></div>';
			break;
		case 'donut':
			$preloaderHTML = '<div class="donut"></div>';
			break;
		default:
			$preloaderHTML = '';
			break;
	}
}elseif($preloder_setting == "image"){
	$preloaderHTML = '<div class="preloader-image"></div>';

}elseif($preloder_setting == "fontawesome"){
    $preloader_fontawesome = isset($options['preloader-fontawesome'])?$options['preloader-fontawesome']:'';
	$preloaderHTML = '<div class="'.$preloader_fontawesome.'" style="font-size:'.$preloader_size.'px; color: '.$preloader_color.'; display: flex;justify-content: center;margin: 0 auto;"></div>';
	$preloaderStyles = '';
}

?>
<div id="templaza-preloader" class="d-flex align-items-center">
	<?php echo $preloaderHTML; ?>
</div>