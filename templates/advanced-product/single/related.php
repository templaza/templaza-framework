<?php

defined('ADVANCED_PRODUCT') or exit();

use Advanced_Product\AP_Templates;
use Advanced_Product\AP_Functions;
use Advanced_Product\Helper\AP_Helper;
use Advanced_Product\Helper\AP_Custom_Field_Helper;
use TemPlazaFramework\Functions;

if ( !class_exists( 'TemPlazaFramework\TemPlazaFramework' )){
    $templaza_options = array();
}else{
    $templaza_options = Functions::get_theme_options();
}
// phpcs:disable WordPress.Security.NonceVerification.Recommended, WordPressVIPMinimum.Performance.WPQueryParams.PostNotIn_post__not_in, WordPress.DB.SlowDBQuery.slow_db_query_tax_query
if(isset($_GET['product_loop'])){
    $ap_loop_layout = $_GET['product_loop'];
}else {
    $ap_loop_layout = isset($templaza_options['ap_product-loop-layout']) ? $templaza_options['ap_product-loop-layout'] : 'style1';
}

if(isset($_GET['related_number'])){
    $ap_product_related_number = $_GET['related_number'];
}else {
    $ap_product_related_number    = isset($templaza_options['ap_product-related-number'])?$templaza_options['ap_product-related-number']:3;
}
$ap_product_related_title     = isset($templaza_options['ap_product-related-title'])?$templaza_options['ap_product-related-title']:'RELATED PRODUCT';
$ap_product_related = isset($templaza_options['ap_product-related']) ? $templaza_options['ap_product-related'] : true;
$ap_product_related_nav = isset($templaza_options['ap_product-related-nav']) ? $templaza_options['ap_product-related-nav'] : true;
$ap_product_related_dot = isset($templaza_options['ap_product-related-dot']) ? $templaza_options['ap_product-related-dot'] : true;
$ap_product_related_column     = isset($templaza_options['ap_product-related-columns'])?$templaza_options['ap_product-related-columns']:3;
$ap_product_related_column_gap     = isset($templaza_options['ap_product-related-columns-gap'])?$templaza_options['ap_product-related-columns-gap']:'medium';
$ap_product_related_by     = isset($templaza_options['ap_product-related-by'])?$templaza_options['ap_product-related-by']:'';

$related_args =
    array(
        'post_type' => 'ap_product',
        'posts_per_page' => $ap_product_related_number,
        'post__not_in' => array(get_the_ID()),
    );
$custom_meta_query = array();
if($ap_product_related){
    $ap_sold       = isset($templaza_options['ap_product-archive-product-sold'])?$templaza_options['ap_product-archive-product-sold']:false;
    if($ap_sold == true) {
        $custom_meta_query = array(
            array(
                'relation' => 'OR',
                array(
                    'key' => 'ap_product_type',
                    'value' => 'sold',
                    'compare' => 'NOT LIKE',
                ),
                array(
                    'key' => 'ap_product_type',
                    'compare' => 'NOT EXISTS',
                ),
            ),
        );
    }
    if($ap_product_related_by !=''){
        $ap_cat = '';
        $ap_cats = wp_get_post_terms(get_the_ID(), $ap_product_related_by);
        if($ap_cats){
            foreach ($ap_cats as $item) {
                $ap_cat = $item->slug;
            }
            $related_args =
                array(
                    'post_type' => 'ap_product',
                    'posts_per_page' => $ap_product_related_number,
                    'post__not_in' => array(get_the_ID()),
                    'tax_query' => array(
                        array(
                            'taxonomy' => $ap_product_related_by,
                            'field'    => 'slug',
                            'terms'    => $ap_cat,
                        ),
                    ),
                    'meta_query' =>$custom_meta_query,
                );
        }
    }else{
        $related_args =
            array(
                'post_type' => 'ap_product',
                'posts_per_page' => $ap_product_related_number,
                'post__not_in' => array(get_the_ID()),
                'meta_query' =>$custom_meta_query,
            );
    }




    $related = new WP_Query( $related_args ) ;
    if ( $related -> have_posts() ):?>
        <div class="ap-related-product uk-margin-large-top">
            <h3 class="box-title">
                <?php echo esc_html($ap_product_related_title);?>
            </h3>
            <div data-uk-slider >
                <div class="uk-position-relative">
                    <div class="uk-slider-container">
                        <div class="templaza-ap-archive uk-position-relative uk-slider-items uk-child-width-1-1 uk-grid-<?php echo esc_attr($ap_product_related_column_gap);?> uk-child-width-1-<?php echo esc_attr($ap_product_related_column);?>@l uk-child-width-1-3@m uk-child-width-1-2@s uk-grid">
                            <?php
                            while ( $related -> have_posts() ): $related -> the_post() ;
                                $pid =$related->post->ID;
                                if($ap_loop_layout){
                                    AP_Templates::load_my_layout('archive.content-item-'.$ap_loop_layout.'');
                                }else{
                                    ?>
                                    <div class="ap-item">
                                        <div class="ap-inner ">
                                            <?php AP_Templates::load_my_layout('archive.media'); ?>
                                            <div class="ap-info">
                                                <div class="ap-info-inner ap-info-top">
                                                    <h2 class="ap-title">
                                                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                                    </h2>
                                                    <?php AP_Templates::load_my_layout('archive.price');?>
                                                </div>
                                                <div class="ap-info-inner  ap-info-bottom">
                                                    <?php AP_Templates::load_my_layout('archive.custom-fields'); ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                }
                            endwhile;
                            ?>
                        </div>
                    </div>
                    <?php
                    if($ap_product_related_nav){
                        ?>
                        <div class="uk-hidden@s uk-light">
                            <a class="uk-position-center-left uk-position-small" href="#" data-uk-slidenav-previous data-uk-slider-item="previous"></a>
                            <a class="uk-position-center-right uk-position-small" href="#" data-uk-slidenav-next data-uk-slider-item="next"></a>
                        </div>

                        <div class="uk-visible@s">
                            <a class="uk-position-center-left-out uk-position-small" href="#" data-uk-slidenav-previous data-uk-slider-item="previous"></a>
                            <a class="uk-position-center-right-out uk-position-small" href="#" data-uk-slidenav-next data-uk-slider-item="next"></a>
                        </div>
                        <?php
                    }
                    ?>
                </div>
                <?php if($ap_product_related_dot){
                    ?>
                    <ul class="uk-slider-nav uk-dotnav uk-flex-center"></ul>
                    <?php
                }
                ?>
            </div>
        </div>
    <?php
    endif;
    wp_reset_postdata();
}