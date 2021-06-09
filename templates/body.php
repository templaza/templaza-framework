<?php
defined('TEMPLAZA_FRAMEWORK') or exit();

use TemPlazaFramework\Functions;
use TemPlazaFramework\Templates;

$options        = Functions::get_theme_options();

if($options && isset($options['layout']) && $options['layout']){

    $shortcode  = Functions::generate_option_to_shortcode($options['layout']);

    if(!empty($shortcode)) {
        do{
            $shortcode = trim(do_shortcode($shortcode));
        }while(preg_match_all( '/' . get_shortcode_regex() . '/', $shortcode, $matches, PREG_SET_ORDER ));
        echo $shortcode;
    }
}