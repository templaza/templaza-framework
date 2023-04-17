<?php

defined('ADVANCED_PRODUCT') or exit();

use Advanced_Product\AP_Templates;
use TemPlazaFramework\Functions;

if ( !class_exists( 'TemPlazaFramework\TemPlazaFramework' )){
    $templaza_options = array();
}else{
    $templaza_options = Functions::get_theme_options();
}
$ap_compare_layout = isset($templaza_options['ap_product-compare-layout']) ? $templaza_options['ap_product-compare-layout'] : 'default';
extract($args);

if(isset($products) && !empty($products) && $products -> have_posts()){
    do_action('advanced-product/compare/before_content');
?>
<div class="uk-container uk-container-large uk-width-1-1 uk-padding" data-uk-slider>
    <div class="ap-product-compare-items uk-slider-items uk-child-width-1-2@m uk-child-width-1-2@l uk-child-width-1-3@xl uk-grid">
        <?php while($products -> have_posts()){ ?>
            <div class="ap-product-compare-item">
                <?php $products -> the_post();
                AP_Templates::load_my_layout('archive.content-item-'.$ap_compare_layout.'',true,false,$args);
                ?>
            </div>
            <?php }?>
    </div>

    <a class="uk-position-center-left-out uk-position-small uk-hidden-hover" href="#" data-uk-slidenav-previous data-uk-slider-item="previous"></a>
    <a class="uk-position-center-right-out uk-position-small uk-hidden-hover" href="#" data-uk-slidenav-next data-uk-slider-item="next"></a>
</div>
<?php
    do_action('advanced-product/compare/after_content');
} ?>
