<?php

defined('ADVANCED_PRODUCT') or exit();

use Advanced_Product\AP_Functions;
use Advanced_Product\AP_Templates;
use Advanced_Product\Helper\AP_Custom_Field_Helper;
use TemPlazaFramework\Functions;

if ( !class_exists( 'TemPlazaFramework\TemPlazaFramework' )){
    $templaza_options = array();
}else{
    $templaza_options = Functions::get_theme_options();
}

$ap_content_group     = isset($templaza_options['ap_product-single-group-content'])?$templaza_options['ap_product-single-group-content']:'';
$ap_content_group_sticky_offset     = isset($templaza_options['ap_product-single-group-content-sticky-offset'])?$templaza_options['ap_product-single-group-content-sticky-offset']:117;
$ap_group_title      = isset($templaza_options['ap_product-single-group-content-title'])?filter_var($templaza_options['ap_product-single-group-content-title'], FILTER_VALIDATE_BOOLEAN):true;
if(isset($_GET['customfield_layout'])){
    $ap_single_customfield_layout = $_GET['customfield_layout'];
}else {
    $ap_single_customfield_layout = isset($templaza_options['ap_product-single-customfield-style']) ? $templaza_options['ap_product-single-customfield-style'] : 'style1';
}
$ap_comment           = isset($templaza_options['ap_product-single-comment'])?$templaza_options['ap_product-single-comment']:true;
$ap_group_sticky_responsive           = isset($templaza_options['ap_product-single-group-content-sticky-responsive'])?$templaza_options['ap_product-single-group-content-sticky-responsive']:1200;
$product_id = get_the_ID();
$gfields_assigned   = AP_Custom_Field_Helper::get_group_fields_by_product();
if($gfields_assigned && count($gfields_assigned)){
    ?>
    <div class="ap-group-scroll-wrap">
    <div class="ap-content-group-scroll uk-visible@s" data-uk-sticky="start: 100%; offset: <?php echo esc_attr($ap_content_group_sticky_offset);?>; end: !.ap-content-single; media: <?php echo esc_attr($ap_group_sticky_responsive);?>">
        <ul class="uk-nav uk-nav-default uk-flex uk-width-1-1" data-uk-scrollspy-nav="closest: li; offset:80; scroll: true">
        <?php
        foreach ($gfields_assigned as $group) {
            if($group->slug !='pricing'){
                ?>
                <li class="uk-margin-remove">
                    <a class="ap-scroll-item" href="#<?php echo esc_attr($group -> slug); ?>">
                    <?php echo esc_html($group -> name); ?>
                    </a>
                </li>
                <?php
            }
        }
        if($ap_comment){
        ?>
            <li class="uk-margin-remove"><a class="ap-scroll-item" href="#comments"><?php esc_html_e( 'Leave a Comment','templaza-framework'); ?></a> </li>
            <?php
        }
            ?>
        </ul>
    </div>
    <?php
    foreach ($gfields_assigned as $group) {
        if($group->slug !='pricing'){
            $fields = AP_Custom_Field_Helper::get_fields_by_group_fields($group);
            if($fields && count($fields)) {
                ob_start();
                foreach ($fields as $field) {
                    AP_Templates::load_my_layout('single.custom-fields-item-content-style2', true, false, array(
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
                <div id="<?php echo esc_attr($group -> slug); ?>" class="ap-single-box  ap-specs uk-margin-medium-top ap-box ap-group ap-group-<?php echo esc_attr($group -> slug); ?>" >
                    <div class="widget-content">
                        <?php
                        if($ap_group_title){
                            ?>
                            <h3 class="widget-title ap-group-title box-title">
                                <span><?php echo esc_html($group -> name); ?></span>
                            </h3>
                            <?php
                        }
                        ?>

                        <div class="ap-group-content uk-grid-medium uk-grid" data-uk-grid>
                            <?php echo wp_kses($html,'post');?>
                        </div>
                    </div>
                </div>
                <?php
            }
        }
    }
    if($ap_comment){
    ?>
        <div class="ap-single-box ap-specs uk-margin-medium-top ap-box ap-group ap-group-comments">
            <?php comments_template('', true); ?>
        </div>
        <?php
    }
        ?>
    </div>
    <?php
}