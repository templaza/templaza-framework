<?php

defined('ADVANCED_PRODUCT') or exit();

use Advanced_Product\AP_Functions;
use Advanced_Product\Helper\AP_Custom_Field_Helper;

$field  = isset($args['field'])?$args['field']:'';

if (!empty($field) && ($acf_f = AP_Custom_Field_Helper::get_custom_field_option_by_id($field -> ID))) {

    $product_id  = isset($args['product_id'])?$args['product_id']:'';

    $f_value    = get_field($acf_f['name'], $product_id);
    if(!empty($f_value)){
        if($acf_f['type'] !='taxonomy'){
    ?>
    <div class="ap-custom-fields">
        <div class="ap-field-label"><?php echo esc_html($acf_f['label']); ?></div>
        <div class="ap-field-value">
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
                    echo esc_html__('Download', 'baressco')?></a>
                <?php
            }else{
                ?><?php echo esc_html(the_field($acf_f['name'], $product_id)); ?>
            <?php } ?>
        </div>
    </div>
    <?php
    }
    }
} ?>