<?php

defined('ADVANCED_PRODUCT') or exit();

use Advanced_Product\AP_Templates;
use Advanced_Product\AP_Functions;

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
$ap_product_related_number    = isset($templaza_options['ap_product-related-number'])?$templaza_options['ap_product-related-number']:3;
do_action('templaza_set_postviews',get_the_ID());
?>
    <div class="templaza-ap-single uk-article">
        <div id="ap-wrap-content" data-uk-grid>
            <div class="uk-width-expand@m">
                <div class="ap-single-box">
                <?php AP_Templates::load_my_layout('single.media'); ?>
                </div>

                <?php AP_Templates::load_my_layout('single.meta');?>

                <div class="ap-single-box"><?php the_content(); ?></div>

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
                            <h3 class="box-title">
                                <?php esc_html($ap_product_related_title);?>
                            </h3>
                            <div class="templaza-ap-archive uk-child-width-1-1 uk-grid-medium uk-child-width-1-3@l uk-child-width-1-3@m uk-child-width-1-2@s" data-uk-grid>
                                <?php
                                while ( $related -> have_posts() ): $related -> the_post() ;
                                    ?>
                                    <div class="ap-item">
                                        <div class="ap-inner uk-box-shadow-small">
                                            <?php AP_Templates::load_my_layout('archive.media'); ?>
                                            <div class="ap-info">
                                                <div class="ap-info-inner ap-info-top">
                                                    <h4 class="ap-title">
                                                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                                    </h4>
                                                    <?php AP_Templates::load_my_layout('archive.price');?>
                                                </div>
                                                <div class="ap-info-inner  ap-info-bottom">
                                                    <?php AP_Templates::load_my_layout('archive.custom-fields'); ?>
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
                <div class="templaza-single-comment ap-single-box">
                    <?php comments_template('', true); ?>
                </div>
            </div>
            <div class="uk-width-1-3@m templaza-sidebar" >
                <div class="ap-sidebar-inner" >
                    <div class="ap-single-price-box ap-single-side-box">
                        <?php
                        AP_Templates::load_my_layout('single.price');
                        ?>
                    </div>
                    <?php if($ap_office_price){ ?>
                        <div class="ap-single-side-box">
                            <a class="highlight uk-flex uk-flex-between uk-flex-middle" href="#modal-center" data-uk-toggle>
                        <span>
                            <?php echo esc_html($ap_office_price_label);?>
                        </span>
                                <span class="currency uk-flex uk-flex-center uk-flex-middle"><i class="fas fa-dollar-sign"></i></span>
                            </a>
                        </div>
                    <?php } ?>

                    <?php
                    AP_Templates::load_my_layout('single.custom-fields');
                    ?>
                </div>
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