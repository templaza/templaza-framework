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
            <div class="ap-info-inner  ap-info-bottom">
                <?php AP_Templates::load_my_layout('archive.custom-fields'); ?>
            </div>
        </div>
    </div>
</div>