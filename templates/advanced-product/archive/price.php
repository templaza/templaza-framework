<?php

defined('ADVANCED_PRODUCT') or exit();

use Advanced_Product\AP_Functions;
use Advanced_Product\Helper\AP_Helper;
use Advanced_Product\Helper\AP_Custom_Field_Helper;

?>
<?php
$msrp   = get_field('ap_price_msrp', get_the_ID());
$price  = get_field('ap_price', get_the_ID());

$show_price         = AP_Custom_Field_Helper::get_field_display_flag_by_field_name('show_in_listing', 'ap_price');
$show_price_msrp    = AP_Custom_Field_Helper::get_field_display_flag_by_field_name('show_in_listing', 'ap_price_msrp');
$show_price_notice  = AP_Custom_Field_Helper::get_field_display_flag('show_in_listing', 'unit-price');
$f_value            = get_field('unit-price', get_the_ID());
if (!empty($price) && $show_price) {
    ?>
    <div class="ap-price-box">
        <span class="ap-field-label"><?php esc_html_e('Total Price','templaza-framework')?></span>
        <?php
        $html = sprintf('<span class="ap-price"><b> %s</b> %s </span>',
            esc_html__(' ', 'templaza-framework'), AP_Helper::format_price($price));
        if (!empty($msrp) && $show_price_msrp) {
            $html .= sprintf('<span class="ap-price-msrp"> %s  %s </span>',
                esc_html__('MSRP:', 'templaza-framework'), AP_Helper::format_price($msrp));
        }
        ?>
        <?php
        echo wp_kses($html,'post');
        ?>
        <span class="meta">
            <?php echo esc_html($f_value);?>
        </span>
    </div>
<?php } ?>
