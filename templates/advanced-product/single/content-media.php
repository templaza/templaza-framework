<?php

use Advanced_Product\AP_Functions;
use Advanced_Product\AP_Templates;

defined('ADVANCED_PRODUCT') or exit();

$options    = array();
$agruco_video = get_post_meta(get_the_ID(), 'video',true);
$agruco_gallery = get_post_meta(get_the_ID(), 'images');
?>
<div class="ap-media entry-image full-image uk-container-expand">
    <?php
    $agruco_video = get_post_meta(get_the_ID(), 'video',true);
    $agruco_gallery = get_post_meta(get_the_ID(), 'images', true);
    if ((!empty($agruco_video) && !empty($agruco_gallery)) ||
        (empty($agruco_video) && !empty($agruco_gallery))) {
        AP_Templates::load_my_layout('single.media.gallery');
    } elseif (!empty($agruco_video) && empty($agruco_gallery)) {
        AP_Templates::load_my_layout('single.media.video');
    } else {
        AP_Templates::load_my_layout('single.media.image');
    }
    ?>
</div>