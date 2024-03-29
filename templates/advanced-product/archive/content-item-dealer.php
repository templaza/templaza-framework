<?php

defined('ADVANCED_PRODUCT') or exit();

use Advanced_Product\AP_Templates;
use Advanced_Product\AP_Functions;
use Advanced_Product\Helper\AP_Product_Helper;
use TemPlazaFramework\Functions;

if ( !class_exists( 'TemPlazaFramework\TemPlazaFramework' )){
    $templaza_options = array();
}else{
    $templaza_options            = Functions::get_theme_options();
}
$price = get_field('ap_price', get_the_ID());
$ap_category = wp_get_object_terms( get_the_ID(), 'ap_category', array( 'fields' => 'names' ) );
$compare_layout  = isset($args['compare_layout'])?$args['compare_layout']:'';
if(isset($args['ap_class'])){
    $ap_class = $args['ap_class'];
}else{
    $ap_class = ' templazaFadeInUp';
}
$thumbnail       = isset($templaza_options['ap_product-thumbnail-size'])?$templaza_options['ap_product-thumbnail-size']:'large';
?>
<div class="ap-item ap-item-style2 <?php echo esc_attr($ap_class);?>">
    <div class="ap-inner ">
        <div class="uk-inline uk-position-relative">
            <?php AP_Templates::load_my_layout('archive.badges'); ?>
            <div class="uk-card-media-top uk-position-relative uk-transition-toggle">
                <a href="<?php the_permalink(); ?>">
                    <?php the_post_thumbnail($thumbnail);?>
                </a>
                <?php
                    AP_Templates::load_my_layout('archive.btn-actions');
                ?>
            </div>
        </div>
        <div class="ap-info">
            <div class="ap-info-inner ap-info-top">
                <?php
                if($ap_category){
                    foreach ($ap_category as $item){
                    ?>
                        <div class="ap-meta-top"><?php echo esc_html($item); ?></div>
                    <?php
                    }
                }
                ?>
                <h2 class="ap-title">
                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                </h2>
            </div>
            <div class="ap-info-inner  ap-info-bottom">
                <?php AP_Templates::load_my_layout('archive.custom-fields-style2'); ?>
            </div>
            <div class="ap-info-inner  ap-info-bottom uk-flex uk-flex-between uk-flex-middle">
                <?php AP_Templates::load_my_layout('archive.price');?>
                <div class="ap-readmore-box">
                    <a href="<?php the_permalink(); ?>" class="templaza-btn"><?php esc_html_e('View more','templaza-framework');?></a>
                </div>

            </div>
        </div>
    </div>
</div>
<?php