<?php

defined('ADVANCED_PRODUCT') or exit();

use Advanced_Product\AP_Functions;
use Advanced_Product\AP_Templates;
use Advanced_Product\Helper\AP_Helper;
use Advanced_Product\Helper\AP_Custom_Field_Helper;
use TemPlazaFramework\Functions;
if ( !class_exists( 'TemPlazaFramework\TemPlazaFramework' )){
    $templaza_options = array();
}else{
    $templaza_options = Functions::get_theme_options();
}
// phpcs:disable WordPress.Security.NonceVerification.Recommended
if(isset($_GET['columns'])){
    $ap_col = $ap_col_large = $ap_col_laptop = $_GET['columns'];
}else{
    $ap_col_laptop       = isset($templaza_options['ap_product-column-laptop'])?$templaza_options['ap_product-column-laptop']:3;
    $ap_col_large        = isset($templaza_options['ap_product-column-large'])?$templaza_options['ap_product-column-large']:3;
    $ap_col              = isset($templaza_options['ap_product-column'])?$templaza_options['ap_product-column']:3;
}
$ap_layout           = isset($templaza_options['ap_product-layout'])?$templaza_options['ap_product-layout']:'grid';
$ap_col_tablet       = isset($templaza_options['ap_product-column-tablet'])?$templaza_options['ap_product-column-tablet']:2;
$ap_col_mobile       = isset($templaza_options['ap_product-column-mobile'])?$templaza_options['ap_product-column-mobile']:1;
$ap_col_gap          = isset($templaza_options['ap_product-column-gap'])?$templaza_options['ap_product-column-gap']:'';
$grid_view  = isset($_REQUEST['archive_view'])?$_REQUEST['archive_view']:($ap_layout == 'masonry'?'grid':$ap_layout);

$ap_switch_layout       = isset($templaza_options['ap_product-archive-layout-switch'])?filter_var($templaza_options['ap_product-archive-layout-switch'], FILTER_VALIDATE_BOOLEAN):true;
$ap_result       = isset($templaza_options['ap_product-archive-product-result'])?filter_var($templaza_options['ap_product-archive-product-result'], FILTER_VALIDATE_BOOLEAN):true;
$ap_sortby       = isset($templaza_options['ap_product-archive-product-sortby'])?filter_var($templaza_options['ap_product-archive-product-sortby'], FILTER_VALIDATE_BOOLEAN):true;
$ap_list_grid       = isset($templaza_options['ap_product-archive-product-list-grid'])?filter_var($templaza_options['ap_product-archive-product-list-grid'], FILTER_VALIDATE_BOOLEAN):true;
$ap_cat_description       = isset($templaza_options['ap_product-cat-description'])?$templaza_options['ap_product-cat-description']:'top';
$ap_sortby_full = array('date_high','date_low','title_low','title_high','price_high','price_low','price_rental_high','price_rental_low');
$ap_sortby_hidden       = isset($templaza_options['ap_product-archive-product-sortby-hidden'])?$templaza_options['ap_product-archive-product-sortby-hidden']:array();
$grid_option = '';

if($ap_layout == 'masonry'){
    $grid_option = 'masonry: true';
}
if($ap_layout == 'list' || $grid_view =='list'){
    $ap_col_laptop = $ap_col_large = $ap_col = $ap_col_tablet = $ap_col_mobile = '1';
}else{
    $grid_option = '';
}
$post_count = $GLOBALS['wp_query']->found_posts;
if(!is_post_type_archive('ap_product')){
    $cat_id         = get_queried_object()->term_id;
    if($ap_cat_description == 'top'){
    ?>
    <div class="ap-archive-descirtion uk-margin-medium-bottom">
        <?php
        echo wp_kses_post(term_description($cat_id));
        ?>
    </div>
    <?php
    }
}
if ( have_posts()) {
    ?>
    <div class="templaza-ap-product-filter uk-margin-bottom uk-flex uk-flex-right uk-hidden@m uk-text-right  uk-position-z-index" data-uk-sticky="start: 20vh; end: !.templaza-content_area; offset: 30vh">
        <span class="ap-filter-btn"><i class="fas fa-sliders-h"></i><?php esc_html_e('Filter','templaza-framework');?></span>
    </div>
    <?php if($ap_switch_layout){
      ?>
        <div class="uk-flex uk-grid-collapse uk-flex-middle uk-flex-between templaza-ap-archive-view uk-grid" data-uk-grid>
            <?php
            if($ap_result){
                ?>
                <div class="uk-width-1-3@s uk-flex ap-number-product">
                    <h3 class="uk-margin-remove"><span><?php echo esc_html($post_count);?></span> <?php esc_html_e(' Products available','templaza-framework');?></h3>
                </div>
                <?php
            }
            ?>
            <div class="uk-width-2-3@s uk-flex uk-flex-middle uk-flex-between uk-flex-right@s">
                <?php
                if($ap_sortby){
                    ?>
                    <div class="templaza-ap-archive-sort uk-flex uk-flex-middle">
                        <label class="uk-width-auto"><?php echo esc_html__('Sort By', 'templaza-framework')?></label>
                        <div class="uk-form-controls">
                            <select name="ap-archive-sort">
                                <?php
                                foreach ($ap_sortby_full as $sortby_item){
                                    if(!in_array($sortby_item,$ap_sortby_hidden)){
                                        if($sortby_item=='date_high'){
                                            ?>
                                            <option value="date_high"><?php echo esc_html__('Date: Newest First', 'templaza-framework')?></option>
                                            <?php
                                        }
                                        if($sortby_item=='date_low'){
                                            ?>
                                            <option value="date_low"><?php echo esc_html__('Date: Oldest First', 'templaza-framework')?></option>
                                            <?php
                                        }
                                        if($sortby_item=='title_low'){
                                            ?>
                                            <option value="title_low"><?php echo esc_html__('Title: A - Z', 'templaza-framework')?></option>
                                            <?php
                                        }
                                        if($sortby_item=='title_high'){
                                            ?>
                                            <option value="title_high"><?php echo esc_html__('Title: Z - A', 'templaza-framework')?></option>
                                            <?php
                                        }
                                        if($sortby_item=='price_high'){
                                            ?>
                                            <option value="price_high"><?php echo esc_html__('Price: High To Low', 'templaza-framework')?></option>
                                            <?php
                                        }
                                        if($sortby_item=='price_low'){
                                            ?>
                                            <option value="price_low"><?php echo esc_html__('Price: Low To High', 'templaza-framework')?></option>
                                            <?php
                                        }
                                        if($sortby_item=='price_rental_high'){
                                            ?>
                                            <option value="price_rental_high"><?php echo esc_html__('Price Rental: High To Low', 'templaza-framework')?></option>
                                            <?php
                                        }
                                        if($sortby_item=='price_rental_low'){
                                            ?>
                                            <option value="price_rental_low"><?php echo esc_html__('Price Rental: Low To High', 'templaza-framework')?></option>
                                            <?php
                                        }
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <?php
                }
                if($ap_list_grid){
                    ?>
                    <div class="ap-switcher-wrap uk-flex uk-flex-right uk-text-right" data-uk-switcher data-ap-archive-view="<?php echo esc_attr($grid_view);?>">
                        <span class="switcher_btn grid<?php echo $grid_view == 'grid'?' uk-active':'';?>" data-uk-icon="grid" data-ap-archive-view-item="grid"></span>
                        <span class="switcher_btn uk-visible@s list<?php echo $grid_view == 'list'?' uk-active':'';?>" data-uk-icon="list" data-ap-archive-view-item="list"></span>
                    </div>
                    <?php
                }
                ?>
            </div>
            <div class="active-filters"></div>
        </div>
    <?php
    }
    ?>
<div class="templaza-ap-archive templaza-ap-grid
  uk-child-width-1-<?php echo esc_attr($ap_col);?>@l
  uk-child-width-1-<?php echo esc_attr($ap_col_large);?>@xl
  uk-child-width-1-<?php echo esc_attr($ap_col_laptop);?>@m
  uk-child-width-1-<?php echo esc_attr($ap_col_tablet);?>@s
  uk-child-width-1-<?php echo esc_attr($ap_col_mobile);?>
  uk-grid-<?php echo esc_attr($ap_col_gap);?>
 " data-uk-grid="<?php echo esc_attr($grid_option);?>">
    <?php
    if($grid_view == 'list'){
        AP_Templates::load_my_layout('archive.content-list');
    }else{
        AP_Templates::load_my_layout('archive.content');
    }
    ?>
</div>
<div class="templaza-blog-pagenavi uk-margin-large-top">
    <?php
    do_action('templaza_pagination');
    ?>
</div>
<?php
}
if(!is_post_type_archive('ap_product')){
    $cat_id         = get_queried_object()->term_id;
    if($ap_cat_description == 'bottom'){
        ?>
        <div class="ap-archive-descirtion uk-margin-medium-bottom">
            <?php
            echo wp_kses_post(term_description($cat_id));
            ?>
        </div>
        <?php
    }
}
?>