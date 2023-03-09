<?php

defined('ADVANCED_PRODUCT') or exit();

use Advanced_Product\AP_Functions;
use Advanced_Product\AP_Templates;
use Advanced_Product\Helper\AP_Custom_Field_Helper;
use TemPlazaFramework\Functions;
$options    = array();

$widget_heading_style       = isset($options['widget_box_heading_style'])?$options['widget_box_heading_style']:'';

if ( !class_exists( 'TemPlazaFramework\TemPlazaFramework' )){
    $templaza_options = array();
}else{
    $templaza_options = Functions::get_theme_options();
}
$ap_content_group     = isset($templaza_options['ap_product-quickview-group'])?$templaza_options['ap_product-quickview-group']:array();

$product_id     = get_the_ID();

$gfields_assigned   = AP_Custom_Field_Helper::get_group_fields_by_product();
if(empty($ap_content_group)){
    if($gfields_assigned && count($gfields_assigned)){
        foreach ($gfields_assigned as $group) {
            if($group->slug != 'pricing'){
                $fields = AP_Custom_Field_Helper::get_fields_by_group_fields($group);
                if($fields && count($fields)) {
                    ob_start();
                    foreach ($fields as $field) {
                        AP_Templates::load_my_layout('shortcodes.advanced-product.quickview-custom-fields-item', true, false, array(
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
                    <div class="widget <?php echo esc_attr($widget_heading_style);?> ap-box ap-group ap-group-<?php echo $group -> slug; ?>">
                        <div class="widget-content">
                            <h3 class="widget-title">
                                <span><?php esc_html_e($group -> name, 'templaza-framework'); ?></span>
                            </h3>
                            <div class="ap-group-content"><?php echo $html;?></div>
                        </div>
                    </div>
                    <?php
                }
            }
        }
    }
}else{
    if($gfields_assigned && count($gfields_assigned)){
        foreach ($gfields_assigned as $group) {
            if(in_array($group->slug, $ap_content_group)){
                $fields = AP_Custom_Field_Helper::get_fields_by_group_fields($group);
                if($fields && count($fields)) {
                    ob_start();
                    foreach ($fields as $field) {
                        AP_Templates::load_my_layout('shortcodes.advanced-product.quickview-custom-fields-item', true, false, array(
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
                    <div class="widget <?php echo esc_attr($widget_heading_style);?> ap-box ap-group ap-group-<?php echo $group -> slug; ?>">
                        <div class="widget-content">
                            <h3 class="widget-title">
                                <span><?php esc_html_e($group -> name, 'templaza-framework'); ?></span>
                            </h3>
                            <div class="ap-group-content"><?php echo $html;?></div>
                        </div>
                    </div>
                    <?php
                }
            }
        }
    }
}
$ap_content_group[]='pricing';

?>