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
if(isset($_GET['customfield_layout'])){
    $ap_single_customfield_layout = $_GET['customfield_layout'];
}else {
    $ap_single_customfield_layout = isset($templaza_options['ap_product-single-customfield-style']) ? $templaza_options['ap_product-single-customfield-style'] : 'style1';
}

$widget_heading_style       = isset($templaza_options['widget_box_heading_style'])?$templaza_options['widget_box_heading_style']:'';
$product_id     = get_the_ID();

$gfields_assigned   = AP_Custom_Field_Helper::get_group_fields_by_product();

if($gfields_assigned && count($gfields_assigned)){
    foreach ($gfields_assigned as $group) {
        if($group->slug != 'pricing'){
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
                    <h3 class="widget-title ap-group-title is-style-templaza-heading-style3">
                        <span><?php echo esc_html($group -> name); ?></span>
                    </h3>
                    <div class="ap-group-content"><?php echo wp_kses($html,'post');?></div>
                </div>
            </div>
            <?php
            }
        }
    }
}

if($fields_wgs = AP_Custom_Field_Helper::get_fields_without_group_field()){
    ob_start();
    foreach ($fields_wgs as $field) {
        AP_Templates::load_my_layout('single.custom-fields-item-'.$ap_single_customfield_layout.'', true, false, array(
            'field'         => $field,
            'product_id'    => $product_id
        ));
    }
    $html   = ob_get_contents();
    ob_end_clean();

    $html   = trim($html);

    if(!empty($html)){
        ?>
        <div class="widget ap-box ap-group ap-group-empty ap-single-side-box ap-specs">
            <div class="widget-content">
                <h3 class="widget-title is-style-templaza-heading-style1">
                    <span><?php esc_html_e('Specifications', 'templaza-framework'); ?></span>
                </h3>
                <div class="ap-group-content"><?php echo wp_kses($html,'post'); ?></div>
            </div>
        </div>
        <?php
    }
}
?>