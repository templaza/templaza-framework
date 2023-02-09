<?php
defined('ADVANCED_PRODUCT') or exit();
use Advanced_Product\AP_Templates;
use Advanced_Product\AP_Functions;
use Advanced_Product\Helper\AP_Product_Helper;
use TemPlazaFramework\Functions;
if ( !class_exists( 'TemPlazaFramework\TemPlazaFramework' )){
    $templaza_options = array();
}else{
    $templaza_options            = Functions::get_theme_options();
}
$thumbnail       = isset($templaza_options['ap_product-thumbnail-size'])?$templaza_options['ap_product-thumbnail-size']:'large';

?>
<div class="ap-ribbon"><span class="ap-ribbon-content">For Rent</span></div>