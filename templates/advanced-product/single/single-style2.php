<?php

defined('ADVANCED_PRODUCT') or exit();

use Advanced_Product\AP_Templates;
use Advanced_Product\AP_Functions;
use Advanced_Product\Helper\AP_Custom_Field_Helper;
use TemPlazaFramework\Functions;

if ( !class_exists( 'TemPlazaFramework\TemPlazaFramework' )){
    $templaza_options = array();
}else{
    $templaza_options = Functions::get_theme_options();
}
$ap_office_price           = isset($templaza_options['ap_product-office-price'])?$templaza_options['ap_product-office-price']:true;
$ap_office_price_label     = isset($templaza_options['ap_product-office-price-label'])?$templaza_options['ap_product-office-price-label']:'MAKE AN OFFICE PRICE';
$ap_office_price_form      = isset($templaza_options['ap_product-office-price-form'])?$templaza_options['ap_product-office-price-form']:'';
$ap_office_form_custom     = isset($templaza_options['ap_product-office-price-form-custom'])?$templaza_options['ap_product-office-price-form-custom']:'';

$ap_product_related           = isset($templaza_options['ap_product-related'])?$templaza_options['ap_product-related']:true;
$ap_product_related_title     = isset($templaza_options['ap_product-related-title'])?$templaza_options['ap_product-related-title']:'RELATED PRODUCT';
$ap_product_related_column     = isset($templaza_options['ap_product-related-columns'])?$templaza_options['ap_product-related-columns']:3;
$show_compare_button= get_field('ap_show_archive_compare_button', 'option');
$show_compare_button= $show_compare_button!==false?(bool)$show_compare_button:true;
$show_compare_button= isset($args['show_archive_compare_button'])?(bool)$args['show_archive_compare_button']:$show_compare_button;
$ap_show_vendor           = isset($templaza_options['ap_product-single-vendor'])?$templaza_options['ap_product-single-vendor']:true;
$ap_share           = isset($templaza_options['ap_product-single-share'])?$templaza_options['ap_product-single-share']:false;
$ap_share_label     = isset($templaza_options['ap_product-single-share-label'])?$templaza_options['ap_product-single-share-label']:'';


if(isset($_GET['related_number'])){
    $ap_product_related_number = $_GET['related_number'];
}else {
    $ap_product_related_number = isset($templaza_options['ap_product-related-number']) ? $templaza_options['ap_product-related-number'] : 3;
}
$ap_single_fields_top         = isset($templaza_options['ap_product-single-style2-top'])?$templaza_options['ap_product-single-style2-top']:array();

$ap_content_group     = isset($templaza_options['ap_product-single-group-content'])?$templaza_options['ap_product-single-group-content']:'';
$gfields_assigned   = AP_Custom_Field_Helper::get_group_fields_by_product();
$ap_fields_in_content = array();
if($ap_content_group !='' && is_array($ap_content_group)) {
    foreach ($gfields_assigned as $group) {
        if (in_array($group->slug, $ap_content_group)) {
            $fields = AP_Custom_Field_Helper::get_fields_by_group_fields($group);
            if($fields && count($fields)) {
                foreach ($fields as $field) {
                    $ap_fields_in_content[] =$field->post_excerpt;
                }
            }
        }
    }
}
do_action('templaza_set_postviews',get_the_ID());
$call2buy_value     = get_field('call-to-buy', get_the_ID());
$call2buy = AP_Custom_Field_Helper::get_custom_field_option_by_field_name('call-to-buy');

$arr_fields = array();
$default_arr = array('ap_price','ap_product_type','ap_price_contact','ap_price_sold','ap_rental_price','ap_rental_unit','ap_gallery','ap_video','ap_category','ap_branch','call-to-buy');

$arr_fields_none = array_merge($ap_single_fields_top,$default_arr,$ap_fields_in_content);
$args = array(
    'numberposts' => -1,
    'post_type'   => 'ap_custom_field'
);
$wpfields = get_posts( $args );
if ( $wpfields ) {
    foreach ( $wpfields as $post ){
        $arr_fields[] = $post->post_excerpt;
    }
    wp_reset_postdata();
}
$display_fields = array_diff($arr_fields,$arr_fields_none);
$ap_category = wp_get_object_terms( get_the_ID(), 'ap_category', array( 'fields' => 'names' ) );
?>
<div class="templaza-ap-single uk-article ap-single-style2 ap-content-single">
    <div class="ap-single-box">
        <div class="ap-wrap-content">
            <div class="ap-single-left uk-position-relative ">
                <?php AP_Templates::load_my_layout('single.media'); ?>
                <div class="ap-single-button-wrap uk-flex uk-flex-middle uk-position-absolute uk-margin uk-margin-right uk-position-top-right" >
                <?php
                if($show_compare_button) {
                    AP_Templates::load_my_layout('shortcodes.advanced-product.compare-button', true, false,
                        array('atts' => array('id' => get_the_ID())));
                }
                ?>
                <?php if($ap_share){ ?>
                    <div class="ap-btn ap-share uk-flex uk-flex-center  uk-flex-middle uk-animation-toggle uk-transition-toggle  uk-margin-small-left  uk-position-relative">
                        <i class="fas fa-share-alt"></i>
                        <?php echo esc_html($ap_share_label);?>
                        <div class="ap-share-item  uk-transition-slide-bottom-small">
                            <a class="facebook" title="<?php esc_attr_e('Share on Facebook','amanus');?>" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(get_the_permalink(get_the_ID())); ?>">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a class="twitter" title="<?php esc_attr_e('Share on Twitter','amanus');?>" target="_blank" href="https://twitter.com/home?status=Check%20out%20this%20article:%20<?php print esc_attr($tweet_title); ?>%20-%20<?php echo urlencode(get_the_permalink(get_the_ID())); ?>">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <?php $templaza_pin_image = wp_get_attachment_url( get_post_thumbnail_id(get_the_ID())); ?>
                            <a class="pinterest" title="<?php esc_attr_e('Share on Pinterest','amanus');?>"  data-pin-do="skipLink" target="_blank" href="https://pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>&media=<?php echo esc_attr($templaza_pin_image); ?>&description=<?php echo urlencode(get_the_title(get_the_ID())); ?>">
                                <i class="fab fa-pinterest"></i>
                            </a>
                            <a class="linkedin" title="<?php esc_attr_e('Share on Linkedin','amanus');?>"  target="_blank" href="https://www.linkedin.com/sharing/share-offsite/?url=<?php the_permalink(get_the_ID()); ?>">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                        </div>
                    </div>
                <?php } ?>
                </div>

                <?php AP_Templates::load_my_layout('single.meta');?>

            </div>
            <div class="ap-single-right templaza-sidebar" >
                <div class="ap-sidebar-inner" >
                    <div class="ap-single-price-box ap-single-side-box">
                        <?php
                        if($ap_category){
                            foreach ($ap_category as $item){
                                ?>
                                <div class="ap-meta-top"><?php echo esc_html($item); ?></div>
                                <?php
                            }
                        }
                        ?>
                        <?php
                        AP_Templates::load_my_layout('single.price');
                        ?>
                    </div>
                    <?php if($ap_single_fields_top){
                        ?>
                        <div class="uk-flex uk-flex-between@s  ap-single-top-fields">
                        <?php
                        foreach ($ap_single_fields_top as $field_item){
                            $item = AP_Custom_Field_Helper::get_custom_field_option_by_field_name($field_item);
                            $product_id = get_the_ID();
                            $f_value    = get_field($item['name'], $product_id);
                            if(!empty($f_value)){
                                if($item['type'] !='taxonomy'){
                                    ?>
                                    <div class="ap-custom-fields">
                                        <div class="ap-field-label"><?php echo esc_html($item['label']); ?></div>
                                        <div class="ap-field-value">
                                            <?php
                                            if($item['type'] == 'file'){
                                                $file_url   = '';
                                                if(is_array($f_value)){
                                                    $file_url   = $f_value['url'];
                                                }elseif(is_numeric($f_value)){
                                                    $file_url   = wp_get_attachment_url($f_value);
                                                }else{
                                                    $file_url   = $f_value;
                                                }
                                                ?>
                                                <a href="<?php echo esc_url($file_url); ?>" download><?php
                                                    echo esc_html__('Download', 'templaza-framework')?></a>
                                                <?php
                                            }else{
                                                ?><?php echo esc_html(the_field($item['name'], $product_id)); ?>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <?php
                                }elseif($item['type'] == 'taxonomy'){
                                    ?>
                                    <div class="ap-custom-fields">
                                        <div class="ap-field-label"><?php echo esc_html($item['label']); ?></div>
                                        <div class="ap-field-value">
                                            <?php
                                            $ap_taxonomy = get_field($item['name'], $product_id);
                                            if(is_array($ap_taxonomy) && isset($ap_taxonomy) && !empty($ap_taxonomy)){
                                                foreach ($ap_taxonomy as $item_tax){
                                                    if(is_object($item_tax)){
                                                        echo esc_html($item_tax->name);
                                                    }else{
                                                        $ap_term = get_term_by('id', $item_tax, $item['name']);
                                                        if(is_object($ap_term)){
                                                            echo esc_html($ap_term->name);
                                                        }
                                                    }
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <?php
                                }
                            }
                        }
                        ?>
                        </div>
                        <?php
                        if($display_fields){
                        ?>
                        <div class="ap-single-other-field">
                        <?php
                            foreach ($display_fields as $field_item){
                                $item = AP_Custom_Field_Helper::get_custom_field_option_by_field_name($field_item);
                                $product_id = get_the_ID();
                                $f_value    = get_field($field_item, $product_id);
                                if(!empty($f_value)){
                                    if($item['type'] !='taxonomy'){
                                        ?>
                                        <div class="ap-custom-fields uk-grid-collapse" data-uk-grid>
                                            <div class="ap-field-label uk-width-1-4@s"><?php echo esc_html($item['label']); ?></div>
                                            <div class="ap-field-value uk-width-expand">
                                                <?php
                                                if($item['type'] == 'file'){
                                                    $file_url   = '';
                                                    if(is_array($f_value)){
                                                        $file_url   = $f_value['url'];
                                                    }elseif(is_numeric($f_value)){
                                                        $file_url   = wp_get_attachment_url($f_value);
                                                    }else{
                                                        $file_url   = $f_value;
                                                    }
                                                    ?>
                                                    <a href="<?php echo esc_url($file_url); ?>" download><?php
                                                        echo esc_html__('Download', 'templaza-framework')?></a>
                                                    <?php
                                                }else{
                                                    ?><?php echo esc_html(the_field($item['name'], $product_id)); ?>
                                                <?php } ?>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                }
                            }
                        }
                        ?>
                        </div>
                        <?php
                        if($call2buy_value){
                            ?>
<!--                            <div class="call-to-buy">-->
<!--                                <span class="label uk-display-block uk-margin-small-bottom">--><?php //echo esc_html($call2buy['label']);?><!--</span>-->
<!--                                <div class="phone-box templaza-btn">-->
<!--                                    <i class="fas fa-phone-alt"></i> --><?php //echo esc_html($call2buy_value);?>
<!--                                </div>-->
<!--                            </div>-->
                            <?php
                        }
                    }
                    ?>

                    <?php if($ap_office_price){ ?>
                        <div class="ap-single-side-box uk-margin-medium-top">
                            <a class="highlight uk-flex uk-flex-between uk-flex-middle" href="#modal-center" data-uk-toggle>
                        <span>
                            <?php echo esc_html($ap_office_price_label);?>
                        </span>
                                <span class="currency uk-flex uk-flex-center uk-flex-middle"><i class="fas fa-dollar-sign"></i></span>
                            </a>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
    <?php
        if($ap_content_group !=''){
            ?>
            <div class="ap-single-box">
                <?php the_content();
                if($ap_content_group !=''){
                    AP_Templates::load_my_layout('single.group-fields-content');
                }
                ?>
            </div>
            <?php
        }else{
            ?>
            <div class="ap-single-box ap-single-content-tab">
                <ul class="uk-flex-center ap-tab-title" data-uk-tab>
                    <li class="uk-active"><a href="#"><?php esc_html_e('Description','templaza-framework');?></a></li>
                    <li><a href="#"><?php esc_html_e('Comment','templaza-framework');?></a></li>
                </ul>
                <ul class="uk-switcher">
                    <li class="uk-active">
                        <?php the_content();
                        if($ap_content_group !=''){
                            AP_Templates::load_my_layout('single.group-fields-content');
                        }
                        ?>
                    </li>
                    <li>
                        <div class="templaza-single-comment">
                            <?php comments_template('', true); ?>
                        </div>
                    </li>
                </ul>
            </div>
            <?php
        }
    AP_Templates::load_my_layout('single.related');
    ?>

</div>
<?php if($ap_office_price){ ?>
    <div id="modal-center" class="uk-flex-top ap-modal" data-uk-modal>
        <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical">

            <button class="uk-modal-close-default" type="button" data-uk-close></button>

            <div class="get-price">
                <?php
                if($ap_office_price_form == 'custom'){
                    echo do_shortcode($ap_office_form_custom);
                }else{
                    if(function_exists('wpforms')) {
                        echo do_shortcode('[wpforms id="' . $ap_office_price_form . '"]');
                    }
                }
                ?>
            </div>

        </div>
    </div>
<?php } ?>