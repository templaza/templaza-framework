<?php
defined('TEMPLAZA_FRAMEWORK') or exit();

use TemPlazaFramework\Functions;
use TemPlazaFramework\Templates;
use TemPlazaFramework\CSS;

$options        = Functions::get_theme_options();
$layout_padding     = isset($options['layout-padding'])?$options['layout-padding']:'';

if($options && isset($options['layout']) && $options['layout']){

    $shortcode  = Functions::generate_option_to_shortcode($options['layout']);

    if(!empty($shortcode)) {
        do{
            $shortcode = trim(do_shortcode($shortcode));
        }while(preg_match_all( '/' . get_shortcode_regex() . '/', $shortcode, $matches, PREG_SET_ORDER ));
        echo $shortcode;
    }
}
if(is_array($layout_padding) && count($layout_padding)) {
    if($site_padding = CSS::make_spacing_redux('padding', $layout_padding)){
        if (!empty($site_padding)) {
            if(is_array($site_padding)){
                foreach($site_padding as $device => $p_style){
                    $p_style  = '.templaza-wrapper{' . $p_style . '}';
                    Templates::add_inline_style($p_style, $device);
                }
            }
        }
    }
}