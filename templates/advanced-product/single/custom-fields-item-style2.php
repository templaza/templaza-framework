<?php

defined('ADVANCED_PRODUCT') or exit();

use Advanced_Product\AP_Functions;
use Advanced_Product\Helper\AP_Custom_Field_Helper;

$field  = isset($args['field'])?$args['field']:'';

if (!empty($field) && ($acf_f = AP_Custom_Field_Helper::get_custom_field_option_by_id($field -> ID))) {

    $product_id  = isset($args['product_id'])?$args['product_id']:'';

    $f_value    = get_field($acf_f['name'], $product_id);
    $f_icon     = isset($acf_f['icon'])?$acf_f['icon']:'';
    $f_icon_image   = isset($acf_f['icon_image']) && !empty($acf_f['icon_image'])?$acf_f['icon_image']:'';
    if(!empty($f_value)){
        $html   = apply_filters('advanced-product/field/value_html/type='.$acf_f['type'], '', $f_value, $acf_f, $field);

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
            <div class="ap-custom-fields ap-custom-field-file uk-width-1-1 ap-custom-fields-style2">
                <div class="ap-field-value">
                    <a href="<?php echo esc_url($file_url); ?>" download>
                        <?php
                        if( !empty($f_icon) || !empty($f_icon_image)){
                            ?>
                            <span>
                            <?php
                            if($f_icon['type'] == 'uikit-icon'){
                                ?>
                                <i data-uk-icon="icon:<?php echo $f_icon['icon']; ?>;"></i>
                                <?php
                            }else if((empty($f_icon['type']) || empty($f_icon['icon'])) && !empty($f_icon_image)){
                                echo wp_get_attachment_image($f_icon_image, 'thumbnail', '',
                                    array('data-uk-svg' => ''));
                            }elseif(!empty($f_icon['icon'])){
                                ?>
                                <i class="<?php echo $f_icon['icon']; ?>"></i>
                                <?php
                            }
                            ?>
                            </span>
                            <?php
                        }
                        echo esc_html($acf_f['label']); ?>
                    </a>
                </div>
            </div>
            <?php
        }else{
            ?>
            <div class="ap-custom-fields uk-width-1-2 ap-custom-fields-style2">
                <div class="ap-field-label"><?php echo esc_html($acf_f['label']); ?></div>
                <div class="ap-field-value">
                    <?php echo !empty($html)?$html:esc_html(the_field($acf_f['name'], $product_id)); ?>
                </div>
            </div>
            <?php
        }
    }
} ?>