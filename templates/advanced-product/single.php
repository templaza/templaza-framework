<?php
defined('ADVANCED_PRODUCT') or exit();

use Advanced_Product\AP_Templates;
use Advanced_Product\AP_Functions;
use TemPlazaFramework\Functions;
if ( !class_exists( 'TemPlazaFramework\TemPlazaFramework' )){
    $templaza_options = array();
}else{
    $templaza_options = Functions::get_theme_options();
}
if(isset($_GET['single_layout'])){
    $ap_single_layout = $_GET['single_layout'];
}else {
    $ap_single_layout = isset($templaza_options['ap_product-single-layout']) ? $templaza_options['ap_product-single-layout'] : 'style1';
}

AP_Templates::load_my_layout('single.single-'.$ap_single_layout.'');