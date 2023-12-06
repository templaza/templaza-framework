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
$compare_layout  = isset($args['compare_layout'])?$args['compare_layout']:'';
$price = get_field('ap_price', get_the_ID());
if(isset($args['ap_class'])){
    $ap_class = $args['ap_class'];
}else{
    $ap_class = ' templazaFadeInUp';
}
if(isset($args['show_intro'])){
    $ap_intro = isset($args['show_intro'])?filter_var($args['show_intro'], FILTER_VALIDATE_BOOLEAN):false;
}else{
    $ap_intro       = isset($templaza_options['ap_product-loop-desc'])?filter_var($templaza_options['ap_product-loop-desc'], FILTER_VALIDATE_BOOLEAN):false;
}
if(isset($_GET['description'])){
    $ap_desc_limit = $_GET['description'];
}else{
    $ap_desc_limit       = isset($templaza_options['ap_product-loop-desc-limit'])?$templaza_options['ap_product-loop-desc-limit']:100;
}
?>
<div class="ap-item ap-item-style1 <?php echo esc_attr($ap_class);?>">
    <div class="ap-inner ">
        <div class="uk-inline uk-position-relative">
            <?php AP_Templates::load_my_layout('archive.badges'); ?>
            <?php AP_Templates::load_my_layout('archive.media',true,false,array('compare_layout'    => $compare_layout)); ?>
        </div>
        <div class="ap-info">
            <div class="ap-info-inner ap-info-top">
                <h2 class="ap-title">
                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                </h2>
                <?php AP_Templates::load_my_layout('archive.price');?>
            </div>
            <?php
            if($ap_intro){
                ?>
            <div class="ap-info-inner ap-info-desc">
            <?php
                if (isset($ap_desc_limit) && $ap_desc_limit !='') { ?>
                    <p><?php echo wp_trim_words(strip_tags(get_the_excerpt()), $ap_desc_limit); ?></p>
                <?php } else {
                    the_excerpt();
                }
                ?>
            </div>
            <?php
            }
            ?>
            <div class="ap-info-inner  ap-info-bottom">
                <?php AP_Templates::load_my_layout('archive.custom-fields'); ?>
            </div>
        </div>
    </div>
</div>