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

$ap_product_related_spec      = isset($templaza_options['ap_product-related-spec-limit'])?$templaza_options['ap_product-related-spec-limit']:3;
if(is_single()){
    $max=$ap_product_related_spec;
}else{
    if(isset($_GET['field_limit'])){
        $max = $_GET['field_limit'];
    }else{
        $max = 1000;
    }
}
if(!empty($fields)){
?>
<div class="ap-specification">
    <?php $d=0; foreach($fields as $field){
        if($d < $max){
        $f_attr             = AP_Custom_Field_Helper::get_custom_field_option_by_id($field -> ID);
        $f_value            = (!empty($f_attr) && isset($f_attr['name']))?get_field($f_attr['name']):null;
        $f_icon         = isset($f_attr['icon'])?$f_attr['icon']:'';
        if(isset($_GET['show_icon'])){
            $show_icon = $_GET['show_icon'];
        }else {
            $show_icon      = get_field('ap_show_archive_custom_field_icon', 'option');
        }

        $f_icon_image   = isset($f_attr['icon_image']) && !empty($f_attr['icon_image'])?$f_attr['icon_image']:'';
        if($f_value){
        ?>
        <div class="ap-spec-item uk-display-inline-block" >
            <span>
            <?php
            if((!empty($f_icon) || !empty($f_icon_image)) && $show_icon){
                echo '<span class="ap-style1-icon">';
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
                echo '</span>';
                }
            ?>
            <?php
            $html   = apply_filters('advanced-product/field/value_html/type='.$f_attr['type'], '', $f_value, $f_attr, $field);
            if(!empty($html)){
                echo wp_kses($html,'post');
            }elseif(is_array($f_value)){
                $f_value    = array_values($f_value);
                echo esc_html(join(',', $f_value));
            }else{
                echo esc_html($f_value);
            }
            ?>
            </span>
        </div>
        <?php
            }
        }
        $d++;
    } ?>
</div>
<?php }?>
