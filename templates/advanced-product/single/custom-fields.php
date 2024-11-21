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
// phpcs:disable WordPress.Security.NonceVerification.Recommended
if(isset($_GET['customfield_layout'])){
    $ap_single_customfield_layout = $_GET['customfield_layout'];
}else {
    $ap_single_customfield_layout = isset($templaza_options['ap_product-single-customfield-style']) ? $templaza_options['ap_product-single-customfield-style'] : 'style1';
}
$ap_content_group     = isset($templaza_options['ap_product-single-group-content'])?$templaza_options['ap_product-single-group-content']:array();
$ap_taxonomy_group     = isset($templaza_options['ap_product-single-group-taxonomy'])?$templaza_options['ap_product-single-group-taxonomy']:'';
$ap_taxonomy_show     = isset($templaza_options['ap_product-single-taxonomy-show'])?$templaza_options['ap_product-single-taxonomy-show']:array();
$widget_heading_style       = isset($templaza_options['widget_box_heading_style'])?$templaza_options['widget_box_heading_style']:'';
$ap_group_accordion       = isset($templaza_options['ap_product-single-group-field-acc'])?$templaza_options['ap_product-single-group-field-acc']:false;
$product_id     = get_the_ID();
$gfields_assigned   = AP_Custom_Field_Helper::get_group_fields_by_product();

$default_lang = apply_filters('wpml_default_language', NULL );
$current_lang = apply_filters( 'wpml_current_language', NULL );
if($default_lang != $current_lang){
    foreach ($ap_content_group as $group_item){
        $category = get_term_by('slug', $group_item, 'ap_group_field');
        $term_id = $category->term_id;
        $group_field_la = AP_Functions::get_translated_term($term_id, 'ap_group_field', ICL_LANGUAGE_CODE);
        $group_field_la_title = get_term_by('name', $group_field_la, 'ap_group_field');

        $ap_content_group[]=$group_field_la_title->slug;
    }
}

$ap_content_group[]='pricing';
$term_list = wp_get_post_terms( $product_id);
$d=1;
if($gfields_assigned && count($gfields_assigned)){
    foreach ($gfields_assigned as $group) {
        if(in_array($group->slug, $ap_content_group) == false){
            if($ap_taxonomy_group == $group->slug){
                ob_start();
                AP_Templates::load_my_layout('single.custom-fields-item-'.$ap_single_customfield_layout.'', true, false, array(
                    'field'         => '',
                    'product_id'    => $product_id,
                    'ap_taxonomy'   => true,
                    'ap_taxonomy_show'   => $ap_taxonomy_show,
                ));
                $html_tax = ob_get_contents();
                ob_end_clean();

                $html_tax = trim($html_tax);
            }else{
                $html_tax = '';
            }
            $fields = AP_Custom_Field_Helper::get_fields_by_group_fields($group);
            if($fields && count($fields)) {
                ob_start();
                foreach ($fields as $field) {
                    AP_Templates::load_my_layout('single.custom-fields-item-'.$ap_single_customfield_layout.'', true, false, array(
                        'field'         => $field,
                        'product_id'    => $product_id,
                        'ap_taxonomy'   => false,
                    ));
                }
                $html = ob_get_contents();
                ob_end_clean();

                $html = trim($html);
            }
            if($d==1){
                $acc_open = 'uk-open ';
            }else{
                $acc_open = ' uk-open';
            }
            if(!empty($html)){
                if($ap_group_accordion){
                    ?>
                    <div  data-uk-accordion="multiple: true" class="ap-single-side-box ap-specs ap-box ap-group ap-group-<?php echo esc_attr($group -> slug); ?>">
                        <div class="widget-content <?php echo esc_attr($acc_open);?>">
                            <h3 class="widget-title ap-group-title uk-accordion-title">
                                <span><?php echo esc_html($group -> name); ?></span>
                            </h3>
                            <?php
                            if($ap_single_customfield_layout == 'style2'){
                                ?>
                                <div class="ap-group-content uk-grid-small uk-accordion-content" data-uk-grid>
                                    <?php echo wp_kses($html_tax,'post');?>
                                    <?php echo wp_kses($html,'post');?>
                                </div>
                                <?php
                            }else{
                                ?>
                                <div class="ap-group-content uk-accordion-content">
                                    <?php echo wp_kses($html_tax,'post');?>
                                    <?php echo wp_kses($html,'post');?>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                    <?php
                }else{
            ?>
            <div  class="ap-single-side-box ap-specs ap-box ap-group ap-group-<?php echo esc_attr($group -> slug); ?>">
                <div class="widget-content">
                    <h3 class="widget-title ap-group-title">
                        <span><?php echo esc_html($group -> name); ?></span>
                    </h3>
                    <?php
                    if($ap_single_customfield_layout == 'style2'){
                        ?>
                        <div class="ap-group-content uk-grid-small" data-uk-grid>
                            <?php echo wp_kses($html_tax,'post');?>
                            <?php echo wp_kses($html,'post');?>
                        </div>
                        <?php
                    }else{
                    ?>
                    <div class="ap-group-content">
                        <?php echo wp_kses($html_tax,'post');?>
                        <?php echo wp_kses($html,'post');?>
                    </div>
                        <?php
                    }
                        ?>
                </div>
            </div>
            <?php
                }
                $d++;
            }
        }
    }
}

if($fields_wgs = AP_Custom_Field_Helper::get_fields_without_group_field()){
    if($ap_taxonomy_group){
        $tax_val = false;
    }else{
        $tax_val = true;
    }
    ob_start();
    foreach ($fields_wgs as $field) {
        AP_Templates::load_my_layout('single.custom-fields-item-'.$ap_single_customfield_layout.'', true, false, array(
            'field'         => $field,
            'product_id'    => $product_id,
            'ap_taxonomy'    => $tax_val
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
                <div class="ap-group-content<?php echo ($ap_single_customfield_layout == 'style2')?' uk-grid-small':'';
                ?>"<?php echo ($ap_single_customfield_layout == 'style2')?' data-uk-grid':'';?>><?php
                    echo wp_kses($html,'post'); ?></div>
            </div>
        </div>
        <?php
    }
}
?>