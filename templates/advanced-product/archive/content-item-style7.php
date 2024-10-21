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
$ap_category = wp_get_object_terms( get_the_ID(), 'ap_category', array( 'fields' => 'names' ) );
$show_compare_button= get_field('ap_show_archive_compare_button', 'option');
$show_compare_button= $show_compare_button!==false?(bool)$show_compare_button:true;
$show_compare_button= isset($args['show_archive_compare_button'])?(bool)$args['show_archive_compare_button']:$show_compare_button;
$pid            = get_the_ID();
$compare_layout  = isset($args['compare_layout'])?$args['compare_layout']:'';
$ap_desc      = isset($templaza_options['ap_product-loop-desc'])?filter_var($templaza_options['ap_product-loop-desc'], FILTER_VALIDATE_BOOLEAN):false;
$ap_desc_limit       = isset($templaza_options['ap_product-loop-desc-limit'])?$templaza_options['ap_product-loop-desc-limit']:100;

if(isset($args['ap_class'])){
    $ap_class = $args['ap_class'];
}else{
    $ap_class = ' templazaFadeInUp';
}
?>
    <div class="ap-item ap-item-style7 <?php echo esc_attr($ap_class);?>">
        <div class="ap-inner ">
            <div class="uk-inline uk-position-relative">
                <?php AP_Templates::load_my_layout('archive.badges'); ?>
                <?php AP_Templates::load_my_layout('archive.media',true,false,array('compare_layout'    => $compare_layout)); ?>
            </div>
            <div class="ap-info">
                <div class="ap-info-inner ap-info-top">
                    <div class="ap-title-info">
                        <h2 class="ap-title">
                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        </h2>
                        <?php
                        if($ap_desc){
                            ?>
                            <div class="ap-info-desc">
                                <?php
                                if (isset($ap_desc_limit) && $ap_desc_limit !='') { ?>
                                    <p><?php echo esc_html(wp_trim_words(wp_strip_all_tags(get_the_excerpt()), $ap_desc_limit)); ?></p>
                                <?php } else {
                                    the_excerpt();
                                }
                                ?>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                    <div class="ap-info-price">
                        <?php AP_Templates::load_my_layout('archive.price');?>
                    </div>
                </div>
                <div class="ap-info-inner ap-info-fields">
                    <?php AP_Templates::load_my_layout('archive.custom-fields-style7',true,false,array('loop_layout'    => 'style7')); ?>
                </div>
                <div class="ap-info-btn">
                    <div class="ap-readmore-box">
                        <a href="<?php the_permalink(); ?>" class="templaza-btn uk-flex"><?php esc_html_e('View more','templaza-framework');?></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php