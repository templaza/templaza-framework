<?php

defined('TEMPLAZA_FRAMEWORK') or exit();

use TemPlazaFramework\Functions;
use TemPlazaFramework\Templates;
use TemPlazaFramework\CSS;

extract(shortcode_atts(array(
    'tz_id'  => '',
    'tz_class'  => '',
    'enable_breadcrumb_single'    => false,
    'breadcrumb_color'            => '',
    'breadcrumb_color_hover'      => '',
    'breadcrumb_color_active'      => '',
), $atts));

if (is_single() && $enable_breadcrumb_single == false){
    return;
}
$tz_class = '';
?>
<div <?php echo isset($atts['tz_id'])?' id="'.$atts['tz_id'].'"':''; ?> class="<?php
echo isset($atts['tz_class'])?trim($atts['tz_class']):''; ?>">
<?php
get_template_part( 'template-parts/breadcrumb' );
?>
</div>
<?php
$bread_css =$bread_css_hover=$bread_css_active='';
if($breadcrumb_color){
    $breadcrumb_color = json_decode($breadcrumb_color,true);
    $breadcrumb_cl = CSS::make_color_rgba_redux($breadcrumb_color);
    if($breadcrumb_cl !=''){
        $bread_css .= '#'.$tz_id.' .templaza-breadcrumb li a{color:'.$breadcrumb_cl.'}';
        Templates::add_inline_style($bread_css);
    }
}
if($breadcrumb_color_hover){
    $breadcrumb_color_hover = json_decode($breadcrumb_color_hover,true);
    $breadcrumb_cl_hover = CSS::make_color_rgba_redux($breadcrumb_color_hover);
    if($breadcrumb_cl_hover !=''){
        $bread_css_hover .= '#'.$tz_id.' .templaza-breadcrumb li a:hover{color:'.$breadcrumb_cl_hover.'}';
        Templates::add_inline_style($bread_css_hover);
    }
}
if($breadcrumb_color_active){
    $breadcrumb_color_active = json_decode($breadcrumb_color_active,true);
    $breadcrumb_cl_active = CSS::make_color_rgba_redux($breadcrumb_color_active);
    if($breadcrumb_cl_active !=''){
        $bread_css_active .= '#'.$tz_id.' .templaza-breadcrumb li.item-current span{color:'.$breadcrumb_cl_active.'}';
        Templates::add_inline_style($bread_css_active);
    }
}