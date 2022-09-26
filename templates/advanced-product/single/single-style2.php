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
if(isset($_GET['related_number'])){
    $ap_product_related_number = $_GET['related_number'];
}else {
    $ap_product_related_number = isset($templaza_options['ap_product-related-number']) ? $templaza_options['ap_product-related-number'] : 3;
}
$ap_single_fields_top         = isset($templaza_options['ap_product-single-style2-top'])?$templaza_options['ap_product-single-style2-top']:array();
var_dump($ap_single_fields_top);
do_action('templaza_set_postviews',get_the_ID());
$call2buy_value     = get_field('call-to-buy', get_the_ID());
$call2buy = AP_Custom_Field_Helper::get_custom_field_option_by_field_name('call-to-buy');

$arr_fields = array();
$default_arr = array('ap_price','ap_gallery','ap_video','ap_category','ap_branch','call-to-buy');

$arr_fields_none = array_merge($ap_single_fields_top,$default_arr);
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
<div class="templaza-ap-single uk-article ap-single-style2">
    <div class="ap-single-box">
        <div class="ap-wrap-content">
            <div class="ap-single-left">
                <?php AP_Templates::load_my_layout('single.media'); ?>

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
                            $item = get_field($field_item, get_the_ID());
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
                                $item = get_field($field_item, get_the_ID());
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
    <div class="ap-single-box ap-single-content-tab">
        <ul class="uk-flex-center ap-tab-title" data-uk-tab>
            <li class="uk-active"><a href="#"><?php esc_html_e('Description','templaza-framework');?></a></li>
            <li><a href="#"><?php esc_html_e('Comment','templaza-framework');?></a></li>
        </ul>
        <ul class="uk-switcher">
            <li class="uk-active">
                <?php the_content(); ?>
            </li>
            <li>
                <div class="templaza-single-comment">
                    <?php comments_template('', true); ?>
                </div>
            </li>
        </ul>
    </div>

    <?php
    if($ap_product_related){
        $ap_cat = '';
        $ap_cats = wp_get_post_terms(get_the_ID(), 'ap_category');
        foreach ($ap_cats as $item) {
            $ap_cat = $item->slug;
        }
        $related_args =
            array(
                'post_type' => 'ap_product',
                'posts_per_page' => $ap_product_related_number,
                'post__not_in' => array(get_the_ID())
            );

        $related = new WP_Query( $related_args ) ;
        if ( $related -> have_posts() ):?>
            <div class="ap-related-product uk-margin-large-top">
                <h2 class="box-title">
                    <?php echo esc_html($ap_product_related_title);?>
                </h2>
                <div class="templaza-ap-archive uk-child-width-1-1 uk-grid-medium uk-child-width-1-<?php echo esc_attr($ap_product_related_column); ?>@l uk-child-width-1-3@m uk-child-width-1-2@s" data-uk-grid>
                    <?php
                    while ( $related -> have_posts() ): $related -> the_post() ;
                        ?>
                        <div class="ap-item ap-item-style2">
                            <div class="ap-inner ">
                                <?php AP_Templates::load_my_layout('archive.media'); ?>
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
                    endwhile;
                    ?>
                </div>
            </div>
        <?php
        endif;
        wp_reset_postdata();
    }
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