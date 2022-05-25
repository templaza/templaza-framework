<?php

use Advanced_Product\AP_Functions;

defined('ADVANCED_PRODUCT') or exit();

$options    = array();
$autoshowroom_video = get_post_meta(get_the_ID(), 'video',true);
$autoshowroom_gallery = get_post_meta(get_the_ID(), 'images');
?>
<div class="single_auto_image">
    <?php the_post_thumbnail('full', array('data-uk-img' => '')); ?>
</div>