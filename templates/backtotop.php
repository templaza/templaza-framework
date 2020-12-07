<?php

defined('TEMPLAZA_FRAMEWORK') or exit();

use TemPlazaFramework\Functions;
use TemPlazaFramework\Templates;

$options = Functions::get_theme_options();

$enable_backtotop = isset($options['backtotop'])?(bool) $options['backtotop']:true;

//$enable_backtotop = $template->params->get('backtotop', 1);
if (!$enable_backtotop) {
   return;
}

$style = '';
$astyle = '';
$class = [];
$html = '';
$backtotop_icon             = isset($options['backtotop-icon'])?$options['backtotop-icon']:'fas fa-arrow-up';
$backtotop_icon_size        = isset($options['backtotop-icon-size'])?(int) $options['backtotop-icon-size']:20;
$backtotop_icon_color       = isset($options['backtotop-icon-color'])?$options['backtotop-icon-color']: '#000';
if(is_array($backtotop_icon_color) && isset($backtotop_icon_color['rgba'])) {
    $backtotop_icon_color    = $backtotop_icon_color['rgba'];
}
$backtotop_icon_bgcolor     = isset($options['backtotop-icon-bgcolor'])?$options['backtotop-icon-bgcolor']: '';
if(is_array($backtotop_icon_bgcolor) && isset($backtotop_icon_bgcolor['rgba'])) {
    $backtotop_icon_bgcolor    = $backtotop_icon_bgcolor['rgba'];
}
$backtotop_icon_style       = isset($options['backtotop-icon-shape'])?$options['backtotop-icon-shape']: 'circle';
$backtotop_on_mobile        = isset($options['backtotop-on-mobile'])?(bool) $options['backtotop-on-mobile']: true;

$paddingpercent = 10;
$padding = ($backtotop_icon_size / $paddingpercent);
$style .= 'font-size:' . $backtotop_icon_size . 'px; color:' . $backtotop_icon_color . ';';

switch ($backtotop_icon_style) {
   case 'rounded':
      $astyle .= 'border-radius : ' . round($padding) . 'px;';
      break;
   case 'square':
      $style .= 'line-height:' . $backtotop_icon_size . 'px;  padding: ' . round($padding) . 'px';
      break;
   default:
      $style .= 'height:' . $backtotop_icon_size . 'px; width:' . $backtotop_icon_size . 'px; line-height:' . $backtotop_icon_size . 'px; text-align:center;';
      break;
}
$astyle .= 'background:' . $backtotop_icon_bgcolor . ';';
$class[] = $backtotop_icon_style;

if (!$backtotop_on_mobile) {
   $class[] = 'hideonsm';
   $class[] = 'hideonxs';
}

$html .= '<a id="templaza-backtotop" class="' . implode(' ', $class) . '" href="javascript:void(0)" style="' . $astyle . '"><i class="' . $backtotop_icon . '" style="' . $style . '"></i></a>';
echo $html;
?>