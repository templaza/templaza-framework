<?php

defined('ADVANCED_PRODUCT') or exit();

use Advanced_Product\AP_Functions;
use Advanced_Product\Helper\AP_Custom_Field_Helper;

// Get custom fields
use TemPlazaFramework\Functions;
if ( !class_exists( 'TemPlazaFramework\TemPlazaFramework' )){
    $templaza_options = array();
}else{
    $templaza_options = Functions::get_theme_options();
}
$fields     = AP_Custom_Field_Helper::get_custom_fields_display_flag_by_product_id('show_in_listing',get_the_ID());

// Get custom fields with no group
$fields_no_group    = AP_Custom_Field_Helper::get_custom_fields_without_group_display_flag_by_product_id('show_in_listing', get_the_ID());
if(is_array($fields_no_group) && !empty($fields_no_group)){
    $fields = !empty($fields)?array_merge($fields_no_group, $fields):$fields_no_group;
}
// phpcs:disable WordPress.Security.NonceVerification.Recommended
$ap_product_related_spec      = isset($templaza_options['ap_product-related-spec-limit'])?$templaza_options['ap_product-related-spec-limit']:3;

if(!empty($fields)){
?>
<div class="ap-specification ap-specification-style3 uk-child-width-1-2 uk-grid-collapse uk-grid" data-uk-grid>
    <?php foreach($fields as $field){
        $f_attr         = AP_Custom_Field_Helper::get_custom_field_option_by_id($field -> ID);
        $f_value        = (!empty($f_attr) && isset($f_attr['name']))?get_field($f_attr['name']):null;
        $f_icon         = isset($f_attr['icon'])?$f_attr['icon']:'';
        if(isset($_GET['show_icon'])){
            $show_icon = $_GET['show_icon'];
        }else {
            $show_icon      = get_field('ap_show_archive_custom_field_icon', 'option');
        }
        $f_icon_image   = isset($f_attr['icon_image']) && !empty($f_attr['icon_image'])?$f_attr['icon_image']:'';
        if($f_value){
            $c_class = ' uk-flex uk-flex-column';
            ?>
            <div class="ap-spec-item uk-flex uk-flex-left" >
                <?php
                if((!empty($f_icon) || !empty($f_icon_image)) && $show_icon){
                    echo '<div class="uk-width-auto ap-style3-icon">';
                    if($f_icon['type'] == 'uikit-icon'){
                        ?>
                        <i data-uk-icon="icon:<?php echo esc_attr($f_icon['icon']); ?>;"></i>
                        <?php
                    }else if((empty($f_icon['type']) || empty($f_icon['icon'])) && !empty($f_icon_image)){
                        echo wp_get_attachment_image($f_icon_image, 'thumbnail', '',
                            array('data-uk-svg' => ''));
                    }elseif(!empty($f_icon['icon'])){
                        ?>
                        <i class="<?php echo esc_attr($f_icon['icon']); ?>"></i>
                        <?php
                    }
                    echo '</div>';
                }
                ?>
                <div class="<?php echo esc_attr($c_class);?>">
                    <span class="ap-spec-value"><?php
                        $html   = apply_filters('advanced-product/field/value_html/type='.$f_attr['type'], '', $f_value, $f_attr, $field);
                        if(!empty($html)){
                            echo wp_kses($html,'post');
                        }elseif(is_array($f_value)){
                            $f_value    = array_values($f_value);
                            ?>
                            <?php echo esc_html(join(',', $f_value)); ?>
                            <?php
                        }
                        else{
                            if($f_attr['type'] == 'text' || $f_attr['type'] == 'number'){
                                if($f_attr['prepend']){
                                    ?><span class="custom-field-prepend"><?php echo esc_html($f_attr['prepend']);?></span> <?php
                                }
                                echo esc_html($f_value);
                                if($f_attr['append']){
                                    ?><span class="custom-field-append"><?php echo esc_html($f_attr['append']);?></span> <?php
                                }
                            }elseif($f_attr['type'] == 'date_picker'){
                                $date_val = date_create(get_field($f_attr['name']));
                                if($f_attr['display_format']){
                                    $unixtimestamp = strtotime( get_field( $f_attr['name'] ) );
                                    echo date_i18n( $f_attr['display_format'], $unixtimestamp );
                                }else{
                                    $unixtimestamp = strtotime( get_field( $f_attr['name'] ) );
                                    echo date_i18n( get_option('date_format'), $unixtimestamp );
                                }
                            }else{
                                echo esc_html($f_value);
                            }
                        }
                        ?>
                    </span>
                    <span class="ap-field-label"><?php echo esc_html($f_attr['label']); ?></span>
                </div>
            </div>
        <?php
        }
    } ?>
</div>
<?php }?>
