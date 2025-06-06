<?php

defined('ADVANCED_PRODUCT') or exit();

use Advanced_Product\AP_Functions;
use Advanced_Product\Helper\AP_Custom_Field_Helper;

$field  = isset($args['field'])?$args['field']:'';
$product_id  = isset($args['product_id'])?$args['product_id']:'';
$show_icon  = get_field('ap_show_single_custom_field_icon', 'option');
$taxonomy  = isset($args['ap_taxonomy'])?$args['ap_taxonomy']:'';
$ap_taxonomy_show  = isset($args['ap_taxonomy_show'])?$args['ap_taxonomy_show']:array();
if($taxonomy == true){
    $all_tax = AP_Custom_Field_Helper::get_al_taxonomy_by_product_id($product_id,$ap_taxonomy_show);
    if($all_tax){
        foreach ($all_tax as $key=>$tax){
            ?>
            <div class=" uk-width-1-2@s ap-custom-fields-style3">
                <div class="uk-width-1-1 uk-grid-collapse" data-uk-grid>
                    <div class=" uk-width-2-5 ap-field-label"><?php echo esc_html($key); ?></div>
                    <div class=" uk-width-3-5 uk-text-right ap-field-value field-value">
                        <?php echo esc_html($tax); ?>
                    </div>
                </div>
            </div>
            <?php
        }
    }
}else{
if (!empty($field) && ($acf_f = AP_Custom_Field_Helper::get_custom_field_option_by_id($field -> ID))) {

    $product_id  = isset($args['product_id'])?$args['product_id']:'';
    $f_value    = get_field($acf_f['name'], $product_id);
    $f_icon     = isset($acf_f['icon'])?$acf_f['icon']:'';
    $f_icon_image   = isset($acf_f['icon_image']) && !empty($acf_f['icon_image'])?$acf_f['icon_image']:'';
    if(!empty($f_value)){
        if($acf_f['type'] == 'taxonomy' && $taxonomy == false){
            $html   = apply_filters('advanced-product/field/value_html/type='.$acf_f['type'], '', $f_value, $acf_f, $field);
            ?>
            <div class=" uk-width-1-2@s ap-custom-fields-style3">
                <div class="uk-width-1-1 uk-grid-collapse" data-uk-grid>
                    <div class=" uk-width-2-5 ap-field-label"><?php echo esc_html($acf_f['label']); ?></div>
                    <div class=" uk-width-3-5 uk-text-right ap-field-value field-value">
                        <?php echo $html;?>
                    </div>
                </div>
            </div>
            <?php
        }elseif($acf_f['type'] =='true_false'){
        ?>
            <div class="uk-width-1-2 uk-width-1-3@s">
                <div class="ap-single-field-content">
                    <?php
                    if( !empty($f_icon)){
                        if($f_icon['type'] == 'uikit-icon'){
                            ?>
                            <i data-uk-icon="icon:<?php echo esc_attr($f_icon['icon']); ?>;"></i>
                            <?php
                        }else if((empty($f_icon['type']) || empty($f_icon['icon'])) && !empty($f_icon_image)){
                            echo wp_get_attachment_image($f_icon_image, 'thumbnail', '',
                                array('data-uk-svg' => ''));
                        }else{
                            ?>
                            <i class="<?php echo esc_attr($f_icon['icon']); ?>"></i>
                            <?php
                        }
                    }
                    echo esc_html($acf_f['label']); ?>
                </div>
            </div>
        <?php
        }elseif($acf_f['type']=='wysiwyg'){
            ?>
            <div class="uk-width-1-1">
                <?php echo esc_html(the_field($acf_f['name'], $product_id)); ?>
            </div>
            <?php
        }else{
            ?>
            <div class=" uk-width-1-2@s ap-custom-fields-style3">
                <div class="uk-width-1-1 uk-grid-collapse" data-uk-grid>
                    <div class=" uk-width-2-5 ap-field-label"><?php echo esc_html($acf_f['label']); ?></div>
                    <div class=" uk-width-3-5 uk-text-right ap-field-value field-value">
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
                                echo esc_html__('Download', 'templaza-framework')?></a>
                            <?php
                        }elseif($acf_f['type'] == 'date_picker'){
                            $date_val = date_create(get_field($acf_f['name'],$product_id));
                            if($acf_f['display_format']){
                                $unixtimestamp = strtotime( get_field( $acf_f['name'] ) );
                                echo date_i18n( $acf_f['display_format'], $unixtimestamp );
                            }else{
                                $unixtimestamp = strtotime( get_field( $acf_f['name'] ) );
                                echo date_i18n( get_option('date_format'), $unixtimestamp );
                            }
                        }else{
                            ?><?php echo esc_html(the_field($acf_f['name'], $product_id)); ?>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <?php
        }
    }
}
}
?>