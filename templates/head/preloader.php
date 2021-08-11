<?php

defined('TEMPLAZA_FRAMEWORK') or exit();

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
if(is_array($preloader_color) && isset($preloader_color['rgba'])) {
    if($preloader_color['alpha'] == 1){
        $preloader_color  = $preloader_color['color'];
    }else {
        $preloader_color  = $preloader_color['rgba'];
    }
}

$preloader_color    = !empty($preloader_color)?$preloader_color:'#000';

$preloader_bgcolor      = isset($options['preloader-bgcolor'])?$options['preloader-bgcolor']:'';
if(is_array($preloader_bgcolor) && isset($preloader_bgcolor['rgba'])) {
    if($preloader_bgcolor['alpha'] == 1){
        $preloader_bgcolor  = $preloader_bgcolor['color'];
    }else {
        $preloader_bgcolor  = $preloader_bgcolor['rgba'];
    }
}

$preloader_image        = isset($options['preloader-image'])?$options['preloader-image']:'';

Templates::add_inline_style('#templaza-preloader {--tztheme-preloader-size: '.$preloader_size.';'
    .'--tztheme-preloader-color: '.$preloader_color.';'
    .($preloader_bgcolor?'--tztheme-preloader-bgcolor: '.$preloader_bgcolor.';':'')
    .($preloader_image && !empty($preloader_image['background-image'])?'--tztheme-preloader-image: url('.$preloader_image['background-image'].');':'')
    .($preloader_image && !empty($preloader_image['background-repeat'])?'--tztheme-preloader-bg-repeat: '.$preloader_image['background-repeat'].';':'')
    .($preloader_image && !empty($preloader_image['background-size'])?'--tztheme-preloader-bg-size: '.$preloader_image['background-size'].';':'')
    .($preloader_image && !empty($preloader_image['background-position'])?'--tztheme-preloader-bg-position: '.$preloader_image['background-position'].';':'')
    .($preloader_image && !empty($preloader_image['background-attachment'])?'--tztheme-preloader-bg-attachment: '.$preloader_image['background-attachment'].';':'')
    .'}');