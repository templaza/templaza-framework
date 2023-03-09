<?php

defined('ADVANCED_PRODUCT') or exit();

use Advanced_Product\AP_Functions;
use Advanced_Product\Helper\AP_Custom_Field_Helper;
use TemPlazaFramework\Functions;
if ( !class_exists( 'TemPlazaFramework\TemPlazaFramework' )){
    $templaza_options = array();
}else{
    $templaza_options = Functions::get_theme_options();
}
$ap_content_group     = isset($templaza_options['ap_product-single-group-content'])?$templaza_options['ap_product-single-group-content']:'';
if($ap_content_group && isset($ap_content_group)){
    foreach($ap_content_group as $group){
        $tag = get_term_by('slug', $group, 'ap_group_field');
        ?>
        <h2 class="uk-margin-remove uk-text-lead ap-scroll-item">
            <a href="#<?php echo esc_attr($group); ?>" data-uk-scroll><?php echo esc_html($tag->name); ?></a>
        </h2>
    <?php
    }
}