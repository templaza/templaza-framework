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
$compare_layout  = isset($args['compare_layout'])?$args['compare_layout']:'';

$show_quickview_button= get_field('ap_show_archive_quickview_button', 'option');
$show_quickview_button= $show_quickview_button!==false?(bool)$show_quickview_button:true;
$show_quickview_button= isset($args['show_archive_quickview_button'])?(bool)$args['show_archive_quickview_button']:$show_quickview_button;

if(isset($args['ap_class'])){
    $ap_class = $args['ap_class'];
}else{
    $ap_class = ' templazaFadeInUp';
}
// phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped
?>
<div class="ap-item ap-item-style3 <?php echo esc_attr($ap_class);?>">
    <div class="ap-inner ">
        <div class="ap-info">
            <div class="ap-info-inner ap-info-top uk-flex uk-flex-middle uk-flex-between">
                <div class="ap-title-info">
                    <h2 class="ap-title">
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </h2>
                    <span class="ap-info-author">
                        <?php echo esc_html__('By', 'templaza-framework') .' '. wp_kses(get_the_author_posts_link(),'post');?>
                    </span>
                </div>
                <div class="ap-button-info uk-flex uk-flex-between">
                    <?php if($show_quickview_button) { ?>
                    <span class="ap-button ap-button-quickview" data-ap-quickview-button="<?php echo $pid?$pid:'';
                    ?>" data-uk-tooltip="<?php echo esc_attr__('Quick View', 'templaza-framework'); ?>">
                        <i class="fas fa-eye"></i>
                    </span>
                    <?php
                    }
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
                                    esc_html($active_text);?>">
                                        <?php if($has_compare){?>
                                            <i class="fas fa-exchange-alt"></i>
                                        <?php }else{?>
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
            </div>
            <div class="uk-inline uk-position-relative uk-width-1-1">
                <?php AP_Templates::load_my_layout('archive.badges'); ?>
                <?php AP_Templates::load_my_layout('archive.media',true,false,array('compare_layout'    => $compare_layout)); ?>
            </div>
            <div class="ap-info-inner ap-info-fields">
                <?php AP_Templates::load_my_layout('archive.custom-fields-style3'); ?>
            </div>
            <div class="ap-info-inner ap-info-bottom uk-flex uk-flex-between uk-flex-middle">
                <?php AP_Templates::load_my_layout('archive.price');?>
                <div class="ap-readmore-box">
                    <a href="<?php the_permalink(); ?>" class="templaza-btn"><?php esc_html_e('View more','templaza-framework');?></a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php