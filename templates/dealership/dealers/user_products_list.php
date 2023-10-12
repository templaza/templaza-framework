<?php

defined('DEALERSHIP') or die();

use DealerShip\Helpers\QueryHelper;
use DealerShip\Helpers\ProductHelper;
use Advanced_Product\AP_Templates;
use TemPlazaFramework\Functions;

if ( !class_exists( 'TemPlazaFramework\TemPlazaFramework' )){
    $templaza_options = array();
}else{
    $templaza_options = Functions::get_theme_options();
}
$dealer_form     = isset($templaza_options['ap_product-dealer-form'])?$templaza_options['ap_product-dealer-form']:'';
$dealer_form_title     = isset($templaza_options['ap_product-dealer-form-title'])?$templaza_options['ap_product-dealer-form-title']:'';
$dealer_listing_label     = isset($templaza_options['ap_product-dealer-listing'])?$templaza_options['ap_product-dealer-listing']:'';
$dealer_form_url     = isset($templaza_options['ap_product-dealer-form-url'])?$templaza_options['ap_product-dealer-form-url']:'';

$endpoint   = QueryHelper::get_current_endpoint();

if($endpoint){
    $author = get_user_by('login', $endpoint);

    if(!empty($author) && !is_wp_error($author)){
        $products   = ProductHelper::get_products(array(
            'author'    => $author -> ID,
            'post_status' => 'publish',
        ));

        if(class_exists('Advanced_Product\AP_Templates')) {

            $pageid         = (int)get_option('options_dealership_dealer_page_id',0);
            $pageid         = !empty($pageid)?$pageid:get_the_ID();
            $avatar         = get_avatar_url($author -> ID);
            $url            = get_permalink($pageid).$author -> user_login;
            $author_desc    =  get_user_meta($author->ID, 'description', true);
            ?>
            <div class="dealer-page " data-uk-grid>
                <div class="uk-width-3-4@m">
                    <div class="uk-card">
                        <div class="dealer-info-box sidebar-bg">
                            <div class=" uk-flex-top uk-grid" data-uk-grid="">
                                <?php if(!empty($avatar)){?>
                                    <div class="uk-width-1-4@s">
                                        <img class="dealer-image" src="<?php echo $avatar; ?>" width="300" height="300" alt="">
                                    </div>
                                <?php } ?>
                                <div class="uk-width-expand">
                                    <h3 class="uk-card-title uk-margin-remove-bottom">
                                        <?php echo $author -> get('display_name');?>
                                    </h3>
                                    <p class="uk-text-meta uk-margin-remove-top">
                                        <?php
                                        if(ProductHelper::get_total_by_user_id($author -> ID) == 1){
                                            echo sprintf(__('%s Product', 'dealership'), ProductHelper::get_total_by_user_id($author -> ID));
                                        }else{
                                            echo sprintf(__('%s Products', 'dealership'), ProductHelper::get_total_by_user_id($author -> ID));
                                        }
                                        ?>
                                    </p>
                                    <?php if(!empty($author_desc)){ ?>
                                        <div class="description uk-margin-bottom"><?php echo $author_desc; ?></div>
                                    <?php }?>
                                    <div class="uk-grid-small uk-child-width-1-3 " data-uk-grid>
                                        <div>
                                            <label class="uk-text-default uk-text-bold uk-margin-small"><?php echo __('Email', 'dealership'); ?></label>
                                            <div class="uk-text-small"><?php echo $author -> user_email; ?></div>
                                        </div>
                                        <?php if($author -> user_url) { ?>
                                        <div>
                                            <label class="uk-text-default uk-text-bold uk-margin-small"><?php echo __('Website', 'dealership'); ?></label>
                                            <div class="uk-text-small"><a target="_blank" href="<?php echo $author -> user_url; ?>"><?php
                                                    echo $author -> user_url; ?></a></div>
                                        </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php if($products){
                        ?>
                        <h3 class="widget-title"><?php echo esc_html($dealer_listing_label);?></h3>
                        <?php
                    }
                    ?>

                    <div class="dls-product-items uk-margin-medium-top uk-child-width-1-2@l uk-child-width-1-3@xl uk-child-width-1-2@m uk-child-width-1-2@s uk-child-width-1-1 uk-grid-default" data-uk-grid>
                        <?php
                        if($products && $products -> have_posts()){
                            while($products -> have_posts()){ ?>
                                <div class="dls-product-item uk-transition-toggle">

                                    <?php
                                    do_action('dealership/my-account/products/before_content');
                                    $products -> the_post();
                                    AP_Templates::load_my_layout('archive.content-item');

                                    do_action('dealership/my-account/products/after_content');
                                    ?>
                                </div>
                            <?php }
                        }else{
                            ?>
                            <div class="uk-width-1-1">
                                <div class="uk-card uk-card-default uk-padding">
                                    <p><?php _e('Products is coming.', 'dealership');?></p>
                                </div>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                </div>
                <div class="uk-width-1-4@m ">
                    <div class="dealer-info-sidebar-box" data-uk-sticky="end: !.dealer-page; offset: 100">
                        <?php if($dealer_form_title || $dealer_form ){?>
                            <div class="dealer-contact-box">
                        <?php
                            if($dealer_form_title){
                                ?>
                                <h3 class="widget-title"><?php echo esc_html($dealer_form_title);?></h3>
                                <?php
                            }
                            if($dealer_form =='custom'){
                                echo do_shortcode($dealer_form);
                            }elseif($dealer_form =='custom_url'){
                                ?>
                                <a class="templaza-btn dealer-contact-url" href="<?php echo esc_url($dealer_form_url);?>">
                                <?php echo esc_html($dealer_form_title);?>
                                </a>
                                <?php
                            }else{
                                echo do_shortcode('[wpforms id="' . $dealer_form . '"]');
                            }
                        ?>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>

            <?php

            wp_reset_postdata();
        }
    }else{
        ?>
        <div class="uk-alert-primary" data-uk-alert>
            <p><?php _e('No matching results.', 'dealership');?></p>
        </div>
    <?php }
}