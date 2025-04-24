<?php

defined('ADVANCED_PRODUCT') or exit();

use Advanced_Product\AP_Functions;
use Advanced_Product\Helper\AP_Product_Helper;

extract($args);

$compare_list   = AP_Product_Helper::get_compare_product_ids_list();
$pid            = isset($atts['id'])?$atts['id']:0;
$has_compare    = (!empty($compare_list) && in_array($pid, $compare_list))?true:false;

?>
<a href="javascript:" data-uk-tooltip="" class="uk-button ap-btn uk-width-1-1<?php echo $has_compare?' ap-in-compare-list':'';
?>" data-ap-compare-button="id: <?php echo $pid?esc_attr($pid):'';?>; active_icon: fas fa-clipboard-list">
    <?php if($has_compare){?>
    <i class="fas fa-check-circle js-ap-icon"></i>
    <span class=" js-ap-text"><?php
        esc_html_e('In compare list', 'templaza-framework'); ?></span>
    <?php }else{?>
    <i class="fas fa-plus-circle js-ap-icon"></i>
    <span class=" js-ap-text"><?php
        esc_html_e('Add To Compare', 'templaza-framework'); ?></span>
    <?php }?>
</a>