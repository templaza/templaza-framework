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
$ap_content_group     = isset($templaza_options['ap_product-single-group-content'])?$templaza_options['ap_product-single-group-content']:'';
$ap_content_group_sticky     = isset($templaza_options['ap_product-single-group-content-sticky'])?$templaza_options['ap_product-single-group-content-sticky']:false;
$ap_vendor_contact     = isset($templaza_options['ap_product-vendor-contact'])?$templaza_options['ap_product-vendor-contact']:'';
$ap_vendor_title     = isset($templaza_options['ap_product-vendor-contact-label'])?$templaza_options['ap_product-vendor-contact-label']:__('Contact Vendor','templaza-framework');
$show_compare_button= get_field('ap_show_archive_compare_button', 'option');
$show_compare_button= $show_compare_button!==false?(bool)$show_compare_button:true;
$show_compare_button= isset($args['show_archive_compare_button'])?(bool)$args['show_archive_compare_button']:$show_compare_button;
$ap_show_vendor           = isset($templaza_options['ap_product-single-vendor'])?$templaza_options['ap_product-single-vendor']:true;
$ap_share           = isset($templaza_options['ap_product-single-share'])?$templaza_options['ap_product-single-share']:false;
$ap_share_label     = isset($templaza_options['ap_product-single-share-label'])?$templaza_options['ap_product-single-share-label']:'';

do_action('templaza_set_postviews',get_the_ID());
$author_id = get_post_field( 'post_author', get_the_ID() );
$ap_count = count_user_posts( $author_id,'ap_product' );
?>
    <div class="templaza-ap-single uk-article">
        <?php
        if($ap_content_group_sticky){
            ?>
            <div id="ap-single-wrap-sticky" class="uk-flex">
            <?php
        }
        ?>
        <div id="ap-wrap-content" class="ap-content-single" data-uk-grid>
            <div class="uk-width-expand@m ap-content">
                <div class="uk-inline uk-position-relative ap-single-box ap-single-box-media">
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
                </div>
                <div class="uk-width-1-3@m ap-templaza-sidebar uk-hidden@m">
                    <div class="ap-sidebar-inner">
                        <div class="ap-single-price-box ap-single-side-box ap-single-box uk-flex  uk-flex-middle  uk-flex-between">
                            <div class="ap-single-price">
                                <?php
                                AP_Templates::load_my_layout('single.price');
                                ?>
                            </div>
                            <?php if($ap_office_price){ ?>
                                <div class=" hightlight-box uk-margin-left">
                                    <a class="highlight uk-flex uk-flex-between uk-flex-middle" href="#modal-center" data-uk-toggle>
                                        <span>
                                            <?php echo esc_html($ap_office_price_label);?>
                                        </span>
                                    </a>
                                </div>
                            <?php } ?>

                        </div>
                        <?php
                        if($ap_show_vendor){
                            ?>
                            <div class="ap-single-price-box ap-single-side-box ap-single-author-box ap-single-box">
                                <div class="uk-card">
                                    <div class="author-header">
                                        <div class="uk-grid-small uk-flex-middle" data-uk-grid>
                                            <div class="uk-width-auto">
                                                <a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID')));?>">
                                                    <img class="uk-border-circle" width="70" height="70" src="<?php echo esc_url( get_avatar_url( get_the_author_meta('ID'),150) ); ?>">
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
                            <?php
                        }
                        ?>
                        <div class="widget  ap-single-side-box ap-single-box">
                        <?php
                        AP_Templates::load_my_layout('single.custom-fields');
                        ?>
                        </div>
                        <?php if(function_exists('wpforms') && $ap_vendor_contact !='') { ?>
                            <div class="widget ap-single-side-box  ap-box ap-single-box ap-contact-vendor">
                                <div class="widget-content">
                                    <?php if($ap_vendor_title !=''){
                                        ?>
                                        <h3 class="widget-title ap-group-title is-style-templaza-heading-style1">
                                            <span><?php echo esc_html($ap_vendor_title);?></span>
                                        </h3>
                                    <?php
                                    }
                                    ?>
                                    <div class="ap-group-content">
                                        <?php
                                        echo do_shortcode('[wpforms id="' . $ap_vendor_contact . '"]');
                                        ?>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
                <?php AP_Templates::load_my_layout('single.meta');?>

                <div class="ap-single-box ap-single-content">
                    <?php
                    the_content();
                    if($ap_content_group !=''){
                        AP_Templates::load_my_layout('single.group-fields-content');
                    }
                    ?>

                </div>
                <?php
                if($ap_content_group ==''){
                    ?>
                    <div class="templaza-single-comment ap-single-box">
                        <?php comments_template('', true); ?>
                    </div>
                    <?php
                }
                ?>

            </div>
            <div class="uk-width-1-3@m ap-templaza-sidebar uk-visible@m">
                <div class="ap-sidebar-inner">
                    <div class="ap-single-price-box ap-single-side-box uk-flex uk-flex-middle uk-flex-between">
                        <div class="ap-single-price">
                            <?php
                            AP_Templates::load_my_layout('single.price');
                            ?>
                        </div>

                        <?php if($ap_office_price){ ?>
                            <div class=" hightlight-box uk-margin-left">
                                <a class="highlight uk-flex uk-flex-between uk-flex-middle" href="#modal-center" data-uk-toggle>
                                    <span>
                                        <?php echo esc_html($ap_office_price_label);?>
                                    </span>
                                </a>
                            </div>
                        <?php } ?>

                    </div>
                    <?php
                    AP_Templates::load_my_layout('single.custom-fields');
                    ?>
                    <?php
                    if($ap_show_vendor){
                        ?>
                        <div class="ap-single-price-box ap-single-side-box ap-single-author-box widget">
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
                        <?php
                    }
                    ?>
                    <?php if(function_exists('wpforms') && $ap_vendor_contact !='') { ?>
                        <div class="widget ap-single-side-box ap-box ap-specs ap-contact-vendor">
                            <div class="widget-content">
                                <?php if($ap_vendor_title !=''){
                                    ?>
                                    <h3 class="widget-title ap-group-title ">
                                        <span><?php echo esc_html($ap_vendor_title);?></span>
                                    </h3>
                                    <?php
                                }
                                ?>
                                <div class="ap-group-content">
                                    <?php
                                    echo do_shortcode('[wpforms id="' . $ap_vendor_contact . '"]');
                                    ?>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
        <?php
        AP_Templates::load_my_layout('single.related');
        ?>
        <?php
        if($ap_content_group_sticky){
            ?>
            </div>
            <?php
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