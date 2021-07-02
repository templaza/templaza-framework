<?php

defined('TEMPLAZA_FRAMEWORK') or exit();

use TemPlazaFramework\Functions;
use TemPlazaFramework\Templates;

extract(shortcode_atts(array(
    'enable_breadcrumb_single'    => false,

), $atts));
if (is_single() && $enable_breadcrumb_single == false){
    return;
}
get_template_part( 'template-parts/breadcrumb' );