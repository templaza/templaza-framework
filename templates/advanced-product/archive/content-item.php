<?php

defined('ADVANCED_PRODUCT') or exit();

use Advanced_Product\AP_Templates;

$price = get_field('ap_price', get_the_ID());
?>
<div class="ap-item">
    <div class="ap-inner uk-box-shadow-small">
        <?php AP_Templates::load_my_layout('archive.media'); ?>
        <div class="ap-info">
            <div class="ap-info-inner ap-info-top">
                <h3 class="ap-title">
                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                </h3>
                <?php AP_Templates::load_my_layout('archive.price');?>
            </div>
            <div class="ap-info-inner  ap-info-bottom">
                <?php AP_Templates::load_my_layout('archive.custom-fields'); ?>
            </div>
        </div>
    </div>
</div>
<?php