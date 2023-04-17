<?php

defined('ADVANCED_PRODUCT') or exit();

use Advanced_Product\AP_Templates;
use Advanced_Product\AP_Functions;
use Advanced_Product\Helper\AP_Product_Helper;
use Advanced_Product\Helper\AP_Custom_Field_Helper;
use TemPlazaFramework\Functions;
if ( !class_exists( 'TemPlazaFramework\TemPlazaFramework' )){
    $templaza_options = array();
}else{
    $templaza_options = Functions::get_theme_options();
}
$widget_heading_style       = isset($templaza_options['widget_box_heading_style'])?$templaza_options['widget_box_heading_style']:'';
$ap_office_price           = isset($templaza_options['ap_product-office-price'])?$templaza_options['ap_product-office-price']:true;
$ap_office_price_label     = isset($templaza_options['ap_product-office-price-label'])?$templaza_options['ap_product-office-price-label']:'MAKE AN OFFICE PRICE';
$ap_office_price_form      = isset($templaza_options['ap_product-office-price-form'])?$templaza_options['ap_product-office-price-form']:'';
$ap_office_form_custom     = isset($templaza_options['ap_product-office-price-form-custom'])?$templaza_options['ap_product-office-price-form-custom']:'';
$ap_vendor_contact     = isset($templaza_options['ap_product-vendor-contact'])?$templaza_options['ap_product-vendor-contact']:'';
$show_compare_button= get_field('ap_show_archive_compare_button', 'option');
$show_compare_button= $show_compare_button!==false?(bool)$show_compare_button:true;
$show_compare_button= isset($args['show_archive_compare_button'])?(bool)$args['show_archive_compare_button']:$show_compare_button;
if(isset($_GET['customfield_layout'])){
    $ap_single_customfield_layout = $_GET['customfield_layout'];
}else {
    $ap_single_customfield_layout = isset($templaza_options['ap_product-single-customfield-style']) ? $templaza_options['ap_product-single-customfield-style'] : 'style1';
}
do_action('templaza_set_postviews',get_the_ID());
$author_id = get_post_field( 'post_author', get_the_ID() );
$ap_count = count_user_posts( $author_id,'ap_product' );
?>
<div class="templaza-ap-single uk-article  ap-single-style3">
    <div class="ap-single-box ap-single-box-media">
        <?php AP_Templates::load_my_layout('single.media'); ?>
    </div>
    <div class="ap-sticky-wrap">
        <div id="ap-single-nav" class="ap-single-nav" data-uk-sticky="end: !.ap-sticky-wrap; offset: 117;">
            <div class="uk-container uk-container-large">
                <?php
                $product_id = get_the_ID();
                $gfields_assigned   = AP_Custom_Field_Helper::get_group_fields_by_product();
                if($gfields_assigned && count($gfields_assigned)){
                    $html = '';
                    foreach ($gfields_assigned as $group) {
                        if($group->slug != 'pricing' && $group->slug != 'content-group' ){
                            $html .='
                                    <li><a href="#'.esc_html($group->slug).'" data-uk-scroll>
                                            '. esc_html($group -> name).'
                                        </a>
                                    </li>';
                        }
                        if($group->slug=='content-group'){
                            $fields = AP_Custom_Field_Helper::get_fields_by_group_fields($group);
                            if($fields && count($fields)) {
                                foreach ($fields as $field) {
                                    if (!empty($field) && ($acf_f = AP_Custom_Field_Helper::get_custom_field_option_by_id($field -> ID))) {

                                        $product_id  = isset($args['product_id'])?$args['product_id']:'';
                                        $f_value    = get_field($acf_f['name'], $product_id);
                                        if(!empty($f_value)){
                                            if($acf_f['type'] !='taxonomy'){
                                                $html .='
                                                        <li><a href="#'. esc_html($acf_f['name']).'" data-uk-scroll>
                                                                '. esc_html($acf_f['label']).'
                                                            </a>
                                                        </li>';
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                    if(!empty($html)){
                        ?>
                        <ul class="ap-single-nav-scroll uk-flex uk-flex-middle">
                            <?php echo wp_kses($html,'post');?>
                        </ul>
                        <?php
                    }
                }
                ?>
            </div>
        </div>
        <div id="ap-wrap-content" class="uk-container uk-container-large">
        <div class="ap-content-single" data-uk-grid>
            <div class="uk-width-expand@m ap-content">

                <?php AP_Templates::load_my_layout('single.meta');?>

                <?php
                if ( !empty( get_the_content() ) ){
                    ?>
                    <div class="ap-single-box ap-single-content">
                        <?php the_content(); ?>
                    </div>
                    <?php
                }
                ?>

                <div class="ap-single-box ap-single-content">
                    <?php
                    if($gfields_assigned && count($gfields_assigned)){
                        foreach ($gfields_assigned as $group) {
                            if($group->slug != 'pricing' && $group->slug != 'content-group'){
                                $fields = AP_Custom_Field_Helper::get_fields_by_group_fields($group);
                                if($fields && count($fields)) {
                                    ob_start();
                                    foreach ($fields as $field) {
                                        AP_Templates::load_my_layout('single.custom-fields-item-'.$ap_single_customfield_layout.'', true, false, array(
                                            'field'         => $field,
                                            'product_id'    => $product_id
                                        ));
                                    }
                                    $html = ob_get_contents();
                                    ob_end_clean();

                                    $html = trim($html);
                                }
                                if(!empty($html)){
                                    ?>
                                    <div class=" ap-specs ap-box ap-group ap-group-<?php echo esc_attr($group -> slug); ?>">
                                        <div class="widget-content">
                                            <h3 id="<?php echo esc_attr($group -> slug); ?>" class="widget-title ap-group-title is-style-templaza-heading-style4">
                                                <span><?php echo esc_html($group -> name); ?></span>
                                            </h3>
                                            <div class="ap-group-content uk-column-1-2" ><?php echo wp_kses($html,'post');?></div>
                                        </div>
                                    </div>
                                    <?php
                                }
                            }
                            if($group->slug == 'content-group'){
                                $fields = AP_Custom_Field_Helper::get_fields_by_group_fields($group);
                                if($fields && count($fields)) {
                                    foreach ($fields as $field) {
                                        if (!empty($field) && ($acf_f = AP_Custom_Field_Helper::get_custom_field_option_by_id($field -> ID))) {

                                            $f_value    = get_field($acf_f['name'], $product_id);
                                            if(!empty($f_value)){
                                                if($acf_f['type'] !='taxonomy'){
                                                    ?>
                                                    <div class="ap-specs ap-box ap-group ap-group-<?php echo esc_attr($group -> slug); ?>">
                                                        <div class="widget-content">
                                                            <div class="ap-group-content">
                                                            <h3 id="<?php echo esc_attr($acf_f['name']); ?>" class="widget-title ap-group-title is-style-templaza-heading-style4">
                                                            <span><?php echo esc_html($acf_f['label']); ?></span>
                                                            </h3>
                                                            <?php
                                                            if($acf_f['type'] == 'file'){
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
                                                                    echo esc_html__('Download', 'tzautoshowroom')?></a>
                                                                <?php
                                                            }else{
                                                                ?><?php the_field($acf_f['name'], $product_id); ?>
                                                            <?php } ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                    ?>
                </div>

                <div class="templaza-single-comment ap-single-box">
                    <?php comments_template('', true); ?>
                </div>
            </div>
            <div class="uk-width-1-3@m ap-templaza-sidebar uk-visible@m">
                <div class="ap-sidebar-inner" data-uk-sticky="end: .ap-content-single; offset: 200">
                    <div class="ap-single-price-box ap-single-side-box">
                        <div class="ap-single-price">
                            <?php
                            AP_Templates::load_my_layout('single.price');
                            ?>
                        </div>

                        <?php if($ap_office_price){ ?>
                            <div class=" hightlight-box uk-margin-top">
                                <a class="highlight uk-flex uk-flex-between uk-flex-middle" href="#modal-center" data-uk-toggle>
                                <span>
                                    <?php echo esc_html($ap_office_price_label);?>
                                </span>
                                </a>
                            </div>
                        <?php } ?>
                    </div>

                    <div class=" ap-single-side-box ap-single-author-box widget">
                        <h3 class="widget-title ap-group-title is-style-templaza-heading-style3">
                            <span><?php esc_html_e('Vendor Profile','templaza-framework');?></span>
                        </h3>
                        <div class="uk-card">
                            <div class="author-header">
                                <div class="uk-grid-small uk-flex-middle" data-uk-grid>
                                    <div class="uk-width-auto">
                                        <a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID')));?>">
                                            <img class="" width="70" height="70" src="<?php echo esc_url( get_avatar_url( get_the_author_meta('ID'),150) ); ?>">
                                        </a>
                                    </div>
                                    <div class="uk-width-expand">
                                        <h3 class="uk-card-title uk-margin-remove-bottom">
                                            <a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID')));?>">
                                                <?php the_author();?>
                                            </a>
                                        </h3>
                                        <p class="uk-text-meta uk-margin-remove-top"><?php echo esc_html($ap_count);?> <?php esc_html_e('Products','templaza-framework');?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="author-description">
                                <?php the_author_meta('description'); ?>
                                <div class="templaza-block-author-social uk-text-meta  uk-margin-top">
                                    <?php do_action('templaza_author_social');?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
        AP_Templates::load_my_layout('single.related');
        ?>
    </div>
    </div>
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