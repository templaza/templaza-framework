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
    <li><a href="#<?php echo esc_html($acf_f['name']); ?>">
        <?php echo esc_html($acf_f['label']); ?>
        </a>
    </li>
    <?php
    }
    }
} ?>