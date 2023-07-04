<?php

defined('ADVANCED_PRODUCT') or exit();

use Advanced_Product\AP_Templates;
use Advanced_Product\AP_Functions;
use Advanced_Product\Helper\AP_Product_Helper;
use TemPlazaFramework\Functions;
if ( !class_exists( 'TemPlazaFramework\TemPlazaFramework' )){
    $templaza_options = array();
}else{
    $templaza_options = Functions::get_theme_options();
}
if(isset($args['ap_class'])){
    $ap_class = $args['ap_class'];
}else{
    $ap_class = ' templazaFadeInUp';
}
if(isset($args['show_author'])){
    $ap_author = isset($args['show_author'])?filter_var($args['show_author'], FILTER_VALIDATE_BOOLEAN):false;
}else{
    $ap_author       = isset($templaza_options['ap_product-loop-author'])?filter_var($templaza_options['ap_product-loop-author'], FILTER_VALIDATE_BOOLEAN):false;
}
$ap_desc_limit       = isset($templaza_options['ap_product-loop-desc-limit'])?$templaza_options['ap_product-loop-desc-limit']:100;
$price = get_field('ap_price', get_the_ID());
$rental         = get_field('ap_rental_price', get_the_ID());
$price_sold = get_field('ap_price_sold', get_the_ID());
$price_contact = get_field('ap_price_contact', get_the_ID());
$ap_category = wp_get_object_terms( get_the_ID(), 'ap_category', array( 'fields' => 'names' ) );
$show_compare_button= get_field('ap_show_archive_compare_button', 'option');
$show_compare_button= $show_compare_button!==false?(bool)$show_compare_button:true;
$show_compare_button= isset($args['show_archive_compare_button'])?(bool)$args['show_archive_compare_button']:$show_compare_button;
$pid    = get_the_ID();
$compare_layout  = isset($args['compare_layout'])?$args['compare_layout']:'';
?>
<div class="ap-item ap-item-style4 <?php echo esc_attr($ap_class);?>">
    <div class="ap-inner ">
        <div class="ap-info">
            <div class="uk-inline">
                <?php AP_Templates::load_my_layout('archive.badges'); ?>
                <?php AP_Templates::load_my_layout('archive.media',true,false,array('compare_layout'    => $compare_layout)); ?>
                <?php
                if(isset($price) && $price !='' || $rental !='' || $price_contact !='' || $price_sold !=''){
                  ?>
                    <div class="uk-position-bottom-left uk-padding-small tz-theme-bg-color ap-price-wrap">
                        <?php AP_Templates::load_my_layout('archive.price');?>
                    </div>
                <?php
                }
                ?>
            </div>
            <div class="ap-info-inner ap-info-top uk-flex uk-flex-middle uk-flex-between">
                <div class="ap-title-info">
                    <h2 class="ap-title">
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </h2>
                </div>
            </div>

            <div class="ap-info-inner ap-info-desc">
                <?php if (isset($ap_desc_limit) && $ap_desc_limit !='') { ?>
                    <p><?php echo substr(strip_tags(get_the_excerpt()), 0, $ap_desc_limit); ?></p>
                <?php } else {
                        the_excerpt();
                    }
                ?>
                <?php
                if($ap_author){
                    AP_Templates::load_my_layout('archive.author.style1');
                }
                ?>
            </div>

            <div class="ap-info-inner ap-info-bottom">
                <?php AP_Templates::load_my_layout('archive.custom-fields-style4'); ?>
            </div>
        </div>
    </div>
</div>
<?php