<?php

defined('TEMPLAZA_FRAMEWORK') or exit();

use TemPlazaFramework\Functions;
use TemPlazaFramework\CSS;
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
$backtotop_icon_color       = CSS::make_color_rgba_redux($backtotop_icon_color);
$backtotop_icon_color       = !empty($backtotop_icon_color)?$backtotop_icon_color: '#000';
$backtotop_icon_border      = isset($options['backtotop-icon-border'])?$options['backtotop-icon-border']:'';
$backtotop_icon_padding     = isset($options['backtotop-icon-padding'])?$options['backtotop-icon-padding']:'';
//if(is_array($backtotop_icon_color) && isset($backtotop_icon_color['rgba'])) {
//    $backtotop_icon_color    = $backtotop_icon_color['rgba'];
//}
$backtotop_icon_bgcolor     = isset($options['backtotop-icon-bgcolor'])?$options['backtotop-icon-bgcolor']: '';
$backtotop_icon_bgcolor = CSS::make_color_rgba_redux($backtotop_icon_bgcolor);
//if(is_array($backtotop_icon_bgcolor) && isset($backtotop_icon_bgcolor['rgba'])) {
//    $backtotop_icon_bgcolor    = $backtotop_icon_bgcolor['rgba'];
//}

$backtotop_icon_style       = isset($options['backtotop-icon-shape'])?$options['backtotop-icon-shape']: 'circle';
$backtotop_on_mobile        = isset($options['backtotop-on-mobile'])?(bool) $options['backtotop-on-mobile']: true;

$paddingpercent = 10;
$padding = ($backtotop_icon_size / $paddingpercent);
$style .= $backtotop_icon_size?'font-size:' . $backtotop_icon_size . 'px;':'';
$style .= $backtotop_icon_color?'color:' . $backtotop_icon_color . ';':'';

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
$astyle .= $backtotop_icon_bgcolor?'background:' . $backtotop_icon_bgcolor . ';':'';
$astyle .= CSS::make_border_redux($backtotop_icon_border);

if($icon_padding = CSS::make_spacing_redux('padding', $backtotop_icon_padding)){
    if (!empty($icon_padding)) {
        if(is_array($icon_padding)){
            foreach($icon_padding as $device => $style){
                $style  = '#templaza-backtotop{' . $style . '}';
                Templates::add_inline_style($style, $device);
            }
        }else {
            $astyle .= $icon_padding;
        }
    }
}

//$astyle .= CSS::make_border($backtotop_icon_border);
$class[] = $backtotop_icon_style;

if (!$backtotop_on_mobile) {
   $class[] = 'hideonsm';
   $class[] = 'hideonxs';
}

if(!empty($astyle)){
    Templates::add_inline_style('#templaza-backtotop{'.$astyle.'}');
}
if(!empty($style)){
    Templates::add_inline_style('#templaza-backtotop > i{'.$style.'}');
}

$html .= '<a id="templaza-backtotop" class="' . implode(' ', $class) . '" href="javascript:void(0)"><i class="' . $backtotop_icon . '" ></i></a>';
echo $html;
?>