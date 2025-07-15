<?php

defined('TEMPLAZA_FRAMEWORK') or exit();

use \TemPlazaFramework\CSS;
use TemPlazaFramework\Functions;
use TemPlazaFramework\Templates;

$options        = Functions::get_theme_options();

$enable_preloader   = isset($options['preloader'])?filter_var($options['preloader'], FILTER_VALIDATE_BOOLEAN):true;

if (!$enable_preloader) {
    return;
}

$preloder_setting       = isset($options['preloader-setting'])?$options['preloader-setting']:'animations';
$preloader_animation    = isset($options['preloader-animation'])?$options['preloader-animation']:'circle';
$preloader_size         = isset($options['preloader-size']) && $options['preloader-size']?$options['preloader-size'].'px':'50px';
$preloader_color        = isset($options['preloader-color'])?$options['preloader-color']:'';
$preloader_color_2      = isset($options['preloader-color-2'])?$options['preloader-color-2']:'';
$preloader_color_3      = isset($options['preloader-color-3'])?$options['preloader-color-3']:'';
$preloader_color = CSS::make_color_rgba_redux($preloader_color);
$preloader_color_2 = CSS::make_color_rgba_redux($preloader_color_2);
$preloader_color_3 = CSS::make_color_rgba_redux($preloader_color_3);

$preloader_bgcolor      = isset($options['preloader-bgcolor'])?$options['preloader-bgcolor']:'';
$preloader_bgcolor = CSS::make_color_rgba_redux($preloader_bgcolor);
$preloader_process_bgcolor      = isset($options['preloader-process-bgcolor'])?$options['preloader-process-bgcolor']:'';
$preloader_process_bgcolor = CSS::make_color_rgba_redux($preloader_process_bgcolor);
if(is_array($preloader_bgcolor) && isset($preloader_bgcolor['rgba'])) {
    if($preloader_bgcolor['alpha'] == 1){
        $preloader_bgcolor  = $preloader_bgcolor['color'];
    }else {
        $preloader_bgcolor  = $preloader_bgcolor['rgba'];
    }
}

$preloader_image        = isset($options['preloader-image'])?$options['preloader-image']:'';
Templates::add_inline_style('#templaza-preloader {'.($preloader_size?'--tztheme-preloader-size: '.$preloader_size.';':'')
    .($preloader_color?'--tztheme-preloader-color: '.$preloader_color.';':'')
    .($preloader_color_2?'--tztheme-preloader-color-2: '.$preloader_color_2.';':'')
    .($preloader_color_3?'--tztheme-preloader-color-3: '.$preloader_color_3.';':'')
    .($preloader_bgcolor?'--tztheme-preloader-bgcolor: '.$preloader_bgcolor.';':'')
    .($preloader_process_bgcolor?'--tztheme-preloader-process-bgcolor: '.$preloader_process_bgcolor.';':'')
    .($preloader_image && !empty($preloader_image['background-image'])?'--tztheme-preloader-image: url('.$preloader_image['background-image'].');':'')
    .($preloader_image && !empty($preloader_image['background-repeat'])?'--tztheme-preloader-bg-repeat: '.$preloader_image['background-repeat'].';':'')
    .($preloader_image && !empty($preloader_image['background-size'])?'--tztheme-preloader-bg-size: '.$preloader_image['background-size'].';':'')
    .($preloader_image && !empty($preloader_image['background-position'])?'--tztheme-preloader-bg-position: '.$preloader_image['background-position'].';':'')
    .($preloader_image && !empty($preloader_image['background-attachment'])?'--tztheme-preloader-bg-attachment: '.$preloader_image['background-attachment'].';':'')
    .'}');