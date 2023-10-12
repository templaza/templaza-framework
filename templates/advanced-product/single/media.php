<?php

use Advanced_Product\AP_Functions;
use Advanced_Product\AP_Templates;
use TemPlazaFramework\Functions;
defined('ADVANCED_PRODUCT') or exit();

$options    = array();
$ap_video   = get_field('ap_video', get_the_ID());
$ap_gallery = get_field('ap_gallery', get_the_ID());
if ( !class_exists( 'TemPlazaFramework\TemPlazaFramework' )){
    $templaza_options = array();
}else{
    $templaza_options = Functions::get_theme_options();
}
$ap_single_media = isset($templaza_options['ap_product-single-media']) ? $templaza_options['ap_product-single-media'] : '';
$ap_single_slider = isset($templaza_options['ap_product-single-slider']) ? $templaza_options['ap_product-single-slider'] : 'gallery-tiny';
if($ap_single_media){
?>
<div class="ap-media entry-image full-image  uk-container-expand">
    <?php
    if ((!empty($ap_video) && !empty($ap_gallery)) ||
        (empty($ap_video) && !empty($ap_gallery))) {
        AP_Templates::load_my_layout('single.media.'.$ap_single_slider.'');
    } elseif (!empty($ap_video) && empty($ap_gallery)) {
        AP_Templates::load_my_layout('single.media.video');
    } else {
        AP_Templates::load_my_layout('single.media.image');
    }
    ?>
</div>
<?php
}