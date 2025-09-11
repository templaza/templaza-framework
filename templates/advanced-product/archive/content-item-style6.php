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
$ap_desc      = isset($templaza_options['ap_product-loop-desc'])?filter_var($templaza_options['ap_product-loop-desc'], FILTER_VALIDATE_BOOLEAN):false;
$ap_desc_limit       = isset($templaza_options['ap_product-loop-desc-limit'])?$templaza_options['ap_product-loop-desc-limit']:100;
$price = get_field('ap_price', get_the_ID());
$ap_category = wp_get_object_terms( get_the_ID(), 'ap_category', array( 'fields' => 'names' ) );
$show_compare_button= get_field('ap_show_archive_compare_button', 'option');
$show_compare_button= $show_compare_button!==false?(bool)$show_compare_button:true;
$show_compare_button= isset($args['show_archive_compare_button'])?(bool)$args['show_archive_compare_button']:$show_compare_button;
$pid    = get_the_ID();
$compare_layout  = isset($args['compare_layout'])?$args['compare_layout']:'';
$ap_tax_before     = isset($templaza_options['ap_product-tax-style6'])?$templaza_options['ap_product-tax-style6']:'';
if($ap_tax_before !=''){
    $ap_taxs = get_the_terms( $pid, $ap_tax_before );
    $terms_string = join(', ', wp_list_pluck($ap_taxs, 'name'));
}else{
    $terms_string = '';
}
?>
    <div class="ap-item ap-item-style5 ap-item-style6 <?php echo esc_attr($ap_class);?>">
        <div class="ap-inner">
            <div class="uk-inline uk-position-relative uk-width-1-1">
                <?php AP_Templates::load_my_layout('archive.badges'); ?>
                <?php AP_Templates::load_my_layout('archive.media',true,false,array('compare_layout'    => $compare_layout)); ?>
            </div>
            <div class="ap-info">
                <div class="ap-info-inner ap-info-top">
                    <?php
                    if($terms_string !=''){
                        ?>
                        <span class="ap-before-title"><?php echo esc_html($terms_string);?></span>
                        <?php
                    }
                    ?>
                    <h2 class="ap-title">
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </h2>
                </div>
                <?php
                if($ap_desc || $ap_author){
                    ?>
                    <div class="ap-info-inner ap-info-desc">
                        <?php
                        if (isset($ap_desc_limit) && $ap_desc_limit !='') { ?>
                            <p><?php echo esc_html(wp_trim_words(wp_strip_all_tags(get_the_excerpt()), $ap_desc_limit)); ?></p>
                        <?php } else {
                            the_excerpt();
                        }
                        if($ap_author){
                            AP_Templates::load_my_layout('archive.author.style1');
                        }
                        ?>
                    </div>
                    <?php
                }
                ?>
                <div class="ap-info-inner  ap-info-bottom">
                    <?php AP_Templates::load_my_layout('archive.custom-fields-style5'); ?>
                </div>
                <div class="ap-info-inner ap-info-button">
                    <div class="ap-readmore-box">
                        <span class="readmore-label"><?php esc_html_e('View more','templaza-framework');?></span>
                        <a href="<?php the_permalink($pid); ?>" class="ap-view-detail"></a>
                        <span class="before-price"><?php esc_html_e('(','templaza-framework');?></span><?php AP_Templates::load_my_layout('archive.price');?><span class="after-price"><?php esc_html_e(')','templaza-framework');?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php