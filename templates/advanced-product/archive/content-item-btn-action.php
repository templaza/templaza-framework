<?php

defined('ADVANCED_PRODUCT') or exit();

use Advanced_Product\AP_Templates;
use Advanced_Product\AP_Functions;
use Advanced_Product\Helper\AP_Product_Helper;
$price = get_field('ap_price', get_the_ID());
$ap_category = wp_get_object_terms( get_the_ID(), 'ap_category', array( 'fields' => 'names' ) );
$show_compare_button= get_field('ap_show_archive_compare_button', 'option');
$show_compare_button= $show_compare_button!==false?(bool)$show_compare_button:true;
$show_compare_button= isset($args['show_archive_compare_button'])?(bool)$args['show_archive_compare_button']:$show_compare_button;
$pid            = get_the_ID();

?>
<div class="ap-button-info uk-flex uk-flex-between">
    <span class="ap-button ap-button-quickview" data-ap-quickview-button="<?php echo $pid?$pid:'';
    ?>" data-uk-tooltip="<?php echo esc_attr(__('Quick View', 'templaza-framework')); ?>">
        <i class="fas fa-eye"></i>
    </span>
    <?php
    ob_start();
    do_action('advanced-product/archive/compare/action', get_the_ID(), $args);
    $action_html    = ob_get_contents();
    ob_end_clean();

    $action_html    = !empty($action_html)?trim($action_html):'';

    if($show_compare_button || (isset($actions) && !empty($actions)) || !empty($action_html)){ ?>
        <?php if($show_compare_button){ ?>

            <?php
            $compare_list   = AP_Product_Helper::get_compare_product_ids_list();
            $pid            = get_the_ID();
            $has_compare    = (!empty($compare_list) && in_array($pid, $compare_list))?true:false;
            $active_text    = $has_compare?'In compare list':'Add to compare';
            ?>
            <span class="ap-button ap-button-compare <?php echo $has_compare?' ap-in-compare-list':'';
            ?>" data-ap-compare-button="id: <?php the_ID();
            ?>; active_icon: fas fa-clipboard-list; icon: fas fa-balance-scale" data-uk-tooltip="<?php
            _e($active_text, 'templaza-framework');?>">
                <?php if($has_compare){?>
                    <i class="fas fa-exchange-alt"></i>
                <?php }else{ ?>
                    <i class="fas fa-exchange-alt"></i>
                <?php }?>
            </span>
        <?php } ?>
        <?php
        if(isset($actions) && !empty($actions)){
            foreach($actions as $_action){
                echo $_action;
            }
        }
        echo $action_html;
        ?>
    <?php } ?>

    <?php do_action('advanced-product/archive/after_content');?>

    <span class="ap-button ap-button-viewmore">
        <a href="<?php the_permalink(); ?>" data-uk-tooltip="<?php echo esc_attr(__('View Detail', 'templaza-framework')); ?>">
        <i class="fas fa-plus"></i>
        </a>
    </span>
</div>
<?php