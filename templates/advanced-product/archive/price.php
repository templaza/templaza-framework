<?php

defined('ADVANCED_PRODUCT') or exit();

use Advanced_Product\AP_Functions;
use Advanced_Product\Helper\AP_Helper;
use Advanced_Product\Helper\AP_Custom_Field_Helper;
use TemPlazaFramework\Functions;
?>
<?php
if ( !class_exists( 'TemPlazaFramework\TemPlazaFramework' )){
    $templaza_options = array();
}else{
    $templaza_options = Functions::get_theme_options();
}
$sold_text     = isset($templaza_options['ap_product-sold-label'])?$templaza_options['ap_product-sold-label']:'';
$contact_text     = isset($templaza_options['ap_product-contact-label'])?$templaza_options['ap_product-contact-label']:'';


$msrp           = get_field('ap_price_msrp', get_the_ID());
$price          = get_field('ap_price', get_the_ID());
$rental         = get_field('ap_rental_price', get_the_ID());
$rental_value    = get_field('ap_rental_unit', get_the_ID());
if($rental_value){
    $field_rental = get_field_object('ap_rental_unit');
    $rental_unit = $field_rental['choices'][ $rental_value ];
}

$price_contact  = get_field('ap_price_contact', get_the_ID());
$product_type   = get_field('ap_product_type', get_the_ID());
$price_notice_value = get_field('price-notice', get_the_ID());
$price_sold = get_field('ap_price_sold', get_the_ID());
$price_contact = get_field('ap_price_contact', get_the_ID());

$show_price         = AP_Custom_Field_Helper::get_field_display_flag_by_field_name('show_in_listing', 'ap_price');
$show_price_msrp    = AP_Custom_Field_Helper::get_field_display_flag_by_field_name('show_in_listing', 'ap_price_msrp');
$show_price_notice  = AP_Custom_Field_Helper::get_field_display_flag('show_in_listing', 'price-notice');
$show_price_rental  = AP_Custom_Field_Helper::get_field_display_flag_by_field_name('show_in_listing', 'ap_rental_price');
$show_price_contact  = AP_Custom_Field_Helper::get_field_display_flag_by_field_name('show_in_listing', 'ap_price_contact');
$show_price_sold  = AP_Custom_Field_Helper::get_field_display_flag_by_field_name('show_in_listing', 'ap_price_sold');
if($product_type == 'sale'){
    $product_type = array('sale');
}
if($price_sold == ''){
    $price_sold = $sold_text;
}
if($price_contact == ''){
    $price_contact = $contact_text;
}

$f_value            = get_field('unit-price', get_the_ID());
if ((!$product_type || in_array('sale', $product_type)) && !empty($price) && $show_price) {
    ?>
    <div class="ap-price-box">
        <span class="ap-field-label"><?php esc_html_e('Total Price','templaza-framework')?></span>
        <?php
        $html = sprintf('<span class="ap-price"><b> %s</b> %s </span>',
            esc_html__(' ', 'templaza-framework'), AP_Helper::format_price($price));
        if (!empty($msrp) && $show_price_msrp) {
            $html .= sprintf('<span class="ap-price-msrp"><span> %s </span>  %s </span>',
                esc_html__('MSRP: ', 'templaza-framework'), AP_Helper::format_price($msrp));
        }
        echo wp_kses($html,'post');
        if(!empty($price_notice_value) && $show_price_notice){
        ?>
        <span class="meta">
            <?php echo esc_html($price_notice_value);?>
        </span>
        <?php } ?>
    </div>
<?php }

if ((!empty($product_type) && in_array('contact', $product_type)) && !empty($price_contact) && $show_price_contact) {
    ?>
    <div class="ap-price-box">
        <span class="ap-field-label"><?php esc_html_e('Price','templaza-framework')?></span>
        <span class="ap-price">
            <?php echo esc_html($price_contact);?>
        </span>
    </div>
<?php }

if ((!empty($product_type) && in_array('sold', $product_type)) && !empty($price_sold) && $show_price_sold) {
    ?>
    <div class="ap-price-box">
        <span class="ap-field-label"><?php esc_html_e('Price','templaza-framework')?></span>
        <span class="ap-price">
            <?php echo esc_html($price_sold);?>
        </span>
    </div>
<?php }

if (!empty($product_type) && in_array('rental', $product_type) && !empty($rental) && $show_price_rental) { ?>
    <div class="ap-price-box">
        <span class="ap-field-label"><?php esc_html_e('Rental price','templaza-framework')?></span>
        <?php
        $html = sprintf('<span class="ap-price ap-price-rental uk-display-inline-block">%s</span>',
            AP_Helper::format_price($rental));
        echo wp_kses($html,'post');
        if(!empty($rental_unit)){ ?>
        <span class="meta ap-unit">
            <?php esc_html_e(' / ','templaza-framework'); echo esc_html($rental_unit);?>
        </span>
        <?php } ?>
    </div>
<?php } ?>
