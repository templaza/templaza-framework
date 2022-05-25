<?php

use Advanced_Product\AP_Functions;
use Advanced_Product\AP_Templates;

defined('ADVANCED_PRODUCT') or exit();

$options    = array();
$ap_video   = get_field('ap_video', get_the_ID());
$ap_gallery = get_field('ap_gallery', get_the_ID());
?>
<div class="ap-media entry-image full-image  uk-container-expand">
    <?php
    if ((!empty($ap_video) && !empty($ap_gallery)) ||
        (empty($ap_video) && !empty($ap_gallery))) {
        AP_Templates::load_my_layout('single.media.gallery-tiny');
    } elseif (!empty($ap_video) && empty($ap_gallery)) {
        AP_Templates::load_my_layout('single.media.video');
    } else {
        AP_Templates::load_my_layout('single.media.image');
    }
    ?>
</div>