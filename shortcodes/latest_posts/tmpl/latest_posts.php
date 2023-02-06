<?php

defined('TEMPLAZA_FRAMEWORK') or exit();

use TemPlazaFramework\Functions;
use TemPlazaFramework\Templates;

extract(shortcode_atts(array(
    'tz_id'                    => '',
    'tz_class'                 => '',
    'show_featured'            => '',
    'latest_post_type'         => 'post',
    'latest_post_order_by'     => 'date',
    'latest_post_order'        => 'DESC',
    'latest_post_number'       => 6,
    'latest_post_image_cover'  => false,
    'latest_post_image_cover_height'  => 300,
    'latest_post_show_date'    => true,
    'latest_post_show_author'  => true,
    'latest_post_slider_item'  => '3',
    'latest_post_show_nav'     => true,
    'latest_post_show_dot'     => false,
), $atts));

$options        = Functions::get_theme_options();

$featured_posttypes = array();
if(isset($options['enable-featured-for-posttypes'])&& !empty($options['enable-featured-for-posttypes'])){
    $featured_posttypes = $options['enable-featured-for-posttypes'];
}
if(!in_array($latest_post_type, $featured_posttypes)){
    $show_featured  = '';
}

$args = array(
    'post_type'  => ''.$latest_post_type.'',
    'numberposts' => $latest_post_number,
    'orderby' => ''.$latest_post_order_by.'',
    'order' => ''.$latest_post_order.'',
);

if(isset($show_featured)){
    if($show_featured == '1') {
        $args['meta_query'] = array(
            array(
                'key' => 'templaza-featured',
                'value' => '1'
            )
        );
    }elseif($show_featured == '0'){
        $args['meta_query'] = array(
            'relation' => 'OR',
            array(
                'key'       => 'templaza-featured',
                'compare'   => '!=',
                'value'     => '1'
            ),
            array(
                'key' => 'templaza-featured',
                'compare' => 'NOT EXISTS',
                'value' => 'null',
            )
        );
    }
}

if(!empty($latest_post_type) && isset($atts[$latest_post_type.'_category'])
    && !empty($atts[$latest_post_type.'_category'])){
    $cats_sync  = $atts[$latest_post_type.'_category'];
    if(preg_match('/^\{.*?\}$/', $cats_sync)){
        $cats_sync  = json_decode($cats_sync, true);
        $tax_name   = \TemPlazaFramework\Shortcode\Helper\Latest_PostsHelper::get_taxonomy_by_post_type($latest_post_type);
        if($latest_post_type == 'post'){
            $args['category']   = $cats_sync;
        }else {
            $args['tax_query'] = array(
                'taxonomy'  => $tax_name,
                'field'     => 'id',
                'operator' => 'IN',
                'terms'     => $cats_sync,
            );
        }
    }
}

$latest_cause = get_posts( $args );
$date_format = get_option('date_format');
?>

<div<?php echo isset($atts['tz_id'])?' id="'.$atts['tz_id'].'"':''; ?> class="module-latest-posts <?php
echo isset($atts['tz_class'])?trim($atts['tz_class']):''; ?>" >

    <div class="uk-slider-container-offset" data-uk-slider>

        <div class="uk-position-relative uk-visible-toggle" tabindex="-1">

            <div class="uk-slider-items uk-grid-medium uk-child-width-1-<?php echo esc_attr($latest_post_slider_item);?>@s " data-uk-grid>
                <?php
                if($latest_cause){
                foreach ($latest_cause as $post_item) {
                    $author_id = $post_item->post_author;
                    ?>
                    <div>
                        <div class="uk-card">
                            <div class="uk-card-media-top">
                                <?php if($latest_post_image_cover == true){
                                    ?>
                                <div class="uk-cover-container">
                                    <canvas height="<?php echo esc_attr($latest_post_image_cover_height);?>"></canvas>
                                    <img src="<?php echo esc_url(get_the_post_thumbnail_url($post_item->ID));?>" alt="<?php echo esc_attr(get_the_title($post_item->ID));?>" data-uk-cover>
                                </div>
                            <?php
                                }else{
                                ?>
                                <a href="<?php echo esc_url(get_permalink($post_item->ID));?>">
                                    <img src="<?php echo esc_url(get_the_post_thumbnail_url($post_item->ID));?>" alt="<?php echo esc_attr(get_the_title($post_item->ID));?> "/>

                                </a>
                            <?php
                                }
                            ?>
                            </div>
                            <div class="module-latest-info uk-margin-top">
                                <h4 class="uk-card-title module-title uk-margin-small">
                                    <a href="<?php echo esc_url(get_permalink($post_item->ID));?>">
                                    <?php echo esc_html(get_the_title($post_item->ID));?>
                                    </a>
                                </h4>
                                <?php if($latest_post_show_date == true || $latest_post_show_author == true){
                                ?>
                                <div class="uk-text-meta templaza-blog-item-info">
                                    <?php
                                    if($latest_post_show_date==true){
                                    ?>
                                        <span><?php echo esc_attr(get_the_date($date_format,$post_item->ID)); ?></span>
                                    <?php
                                    }
                                    if($latest_post_show_author==true){
                                    ?>
                                        <span class="author">
                                    <?php echo esc_html__('By', 'golden-hearts');?>
                                        <a href="<?php echo esc_url(get_author_posts_url($author_id));?>"><?php the_author_meta( 'display_name' , $author_id ); ?></a>
                                    </span>
                                    <?php
                                    }
                                    ?>
                                </div>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>

                    <?php
                }
                wp_reset_postdata();
                }
                ?>
            </div>
            <?php if($latest_post_show_nav == true){
                ?>
            <a class="uk-position-center-left uk-position-small uk-hidden-hover" href="#" data-uk-slidenav-previous data-uk-slider-item="previous"></a>
            <a class="uk-position-center-right uk-position-small uk-hidden-hover" href="#" data-uk-slidenav-next data-uk-slider-item="next"></a>
            <?php
            }
            ?>
        </div>
        <?php if($latest_post_show_dot == true){
            ?>
            <ul class="uk-slider-nav uk-dotnav uk-flex-center uk-margin"></ul>
        <?php
        }
        ?>

    </div>
</div>
