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
$price = get_field('ap_price', get_the_ID());
$show_compare_button= get_field('ap_show_archive_compare_button', 'option');
$show_compare_button= $show_compare_button!==false?(bool)$show_compare_button:true;
$show_compare_button= isset($args['show_archive_compare_button'])?(bool)$args['show_archive_compare_button']:$show_compare_button;
// phpcs:disable WordPress.Security.NonceVerification.Recommended
if(is_post_type_archive('product')){
    $ap_loop_layout = isset($templaza_options['ap_product-loop-layout']) ? $templaza_options['ap_product-loop-layout'] : 'style1';
}else{
    if(isset($_GET['product_loop'])){
        $ap_loop_layout = $_GET['product_loop'];
    }else {
        $ap_loop_layout = isset($templaza_options['ap_product-loop-layout']) ? $templaza_options['ap_product-loop-layout'] : 'style1';
    }
}

if($ap_loop_layout){
    AP_Templates::load_my_layout('archive.content-item-'.$ap_loop_layout.'',true,false,$args);
}else{
    ?>
    <div class="ap-item">
        <div class="ap-inner ">
            <?php AP_Templates::load_my_layout('archive.media'); ?>
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
    <?php
}