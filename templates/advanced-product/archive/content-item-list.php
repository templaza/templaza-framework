<?php

defined('ADVANCED_PRODUCT') or exit();

use Advanced_Product\AP_Templates;
use Advanced_Product\AP_Functions;
use Advanced_Product\Helper\AP_Product_Helper;
use TemPlazaFramework\Functions;
/*
 * Get uk-options
 * This hook used in uiadvancedproducts widget of elementor
 * */
$uk_options    = apply_filters('advanced-product/archive/uk-options', array());

if ( !class_exists( 'TemPlazaFramework\TemPlazaFramework' )){
    $templaza_options = array();
}else{
    $templaza_options = Functions::get_theme_options();
}
$price = get_field('ap_price', get_the_ID());
$thumbnail       = isset($templaza_options['ap_product-thumbnail-size'])?$templaza_options['ap_product-thumbnail-size']:'large';

if(isset($args['show_author'])){
    $ap_author = isset($args['show_author'])?filter_var($args['show_author'], FILTER_VALIDATE_BOOLEAN):false;
}else{
    $ap_author       = isset($templaza_options['ap_product-loop-author'])?filter_var($templaza_options['ap_product-loop-author'], FILTER_VALIDATE_BOOLEAN):false;
}
if(isset($args['ap_class'])){
    $ap_class = $args['ap_class'];
}else{
    $ap_class = ' templazaFadeInUp';
}

while (have_posts()): the_post();
    ?>
    <div class="ap-item  ap-item-style5 ap-item-list <?php echo esc_attr($ap_class);?>">
        <div class="ap-inner">
            <div class="uk-card uk-child-width-1-2@s uk-grid" data-uk-grid>
                <div class="uk-card-media-left uk-cover-container uk-width-2-5@s uk-transition-toggle">
                    <div class="uk-position-relative uk-height-1-1">
                        <?php AP_Templates::load_my_layout('archive.badges'); ?>
                        <?php the_post_thumbnail($thumbnail,['data-uk-cover' => '']);?>
                        <a class="uk-position-absolute uk-position-top-left uk-width-1-1 uk-height-1-1" href="<?php the_permalink(); ?>">
                        </a>
                        <canvas width="" height="300"></canvas>
                        <?php AP_Templates::load_my_layout('archive.btn-actions'); ?>
                    </div>
                </div>
                <div class="ap-info uk-width-3-5@s">
                    <div class="ap-info-inner ap-info-top">
                        <h2 class="ap-title">
                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        </h2>
                    </div>
                    <div class="ap-info-inner ap-info-desc">
                        <?php if (isset($ap_desc_limit) && $ap_desc_limit !='') { ?>
                            <p><?php echo wp_trim_words(strip_tags(get_the_excerpt()), $ap_desc_limit); ?></p>
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
                    <div class="ap-info-inner ap">
                        <?php AP_Templates::load_my_layout('archive.custom-fields-style5'); ?>
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
    </div>
<?php
endwhile;
?>