<?php

use Advanced_Product\AP_Functions;
use TemPlazaFramework\Functions;
defined('ADVANCED_PRODUCT') or exit();
if ( !class_exists( 'TemPlazaFramework\TemPlazaFramework' )){
    $templaza_options = array();
}else{
    $templaza_options = Functions::get_theme_options();
}
$ap_video   = get_field('ap_video', get_the_ID());
$ap_gallery = get_field('ap_gallery', get_the_ID());
$ap_tiny_thumb  = isset($templaza_options['ap_product-slider-thumbnail'])?filter_var($templaza_options['ap_product-slider-thumbnail'], FILTER_VALIDATE_BOOLEAN):true;
$no_cookie      =   0;
if (isset($ap_video) && !empty($ap_video)) {
    if (wp_oembed_get($ap_video)) :
        $video = wp_parse_url($ap_video);
        $youtube_no_cookie = $no_cookie ? '-nocookie' : '';
        switch($video['host']) {
            case 'youtu.be':
                $id = trim($video['path'],'/');
                $src = '//www.youtube'.$youtube_no_cookie.'.com/embed/' . $id .'?autoplay=0&amp;showinfo=0&amp;rel=0&amp;modestbranding=1';
                break;

            case 'www.youtube.com':
            case 'youtube.com':
                parse_str($video['query'], $query);
                $id = $query['v'];
                $src = '//www.youtube'.$youtube_no_cookie.'.com/embed/' . $id .'?autoplay=0&amp;showinfo=0&amp;rel=0&amp;modestbranding=1';
                break;

            case 'vimeo.com':
            case 'www.vimeo.com':
                $id = trim($video['path'],'/');
                $src = "//player.vimeo.com/video/{$id}?".implode('&amp;', $attrb);
        }
    endif;
    $video_thumbnail="https://img.youtube.com/vi/".$id."/maxresdefault.jpg";
}

if(!empty($ap_gallery)){
?>
<div class="ap-slideshow uk-position-relative " data-uk-slideshow="animation: fade">
    <div class="uk-position-relative uk-visible-toggle">
        <ul class="uk-slideshow-items uk-width-1-1"  data-uk-lightbox="animation: fade">
            <?php
            if (isset($ap_video) && !empty($ap_video)) {
                ?>
                <li>
                    <?php if(wp_oembed_get( $ap_video )) : ?>
                        <iframe class="tz-embed-responsive-item" src="<?php echo esc_url($src);?>" allowFullScreen width="1920" height="1080" allowfullscreen uk-responsive data-uk-video></iframe>
                    <?php else : ?>
                        <?php echo wp_kses($ap_video,'post'); ?>
                    <?php endif; ?>
                </li>
                <?php
            }
            foreach ($ap_gallery as $image) {
                ?>
                <li>
                    <a  class="uk-height-1-1 uk-width-1-1 uk-cover-container uk-display-block uk-position-relative" href="<?php echo esc_url($image['url']); ?>" data-caption="<?php echo esc_attr($image['caption']); ?>">
                    <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['title']); ?>" data-uk-cover>
                    </a>
                </li>
            <?php } ?>
        </ul>
        <a class="uk-position-center-left uk-hidden-hover" href="#" data-uk-slidenav-previous data-uk-slideshow-item="previous"></a>
        <a class="uk-position-center-right  uk-hidden-hover" href="#" data-uk-slidenav-next data-uk-slideshow-item="next"></a>

    </div>
    <?php if($ap_tiny_thumb){ ?>
    <div class="uk-position-relative uk-margin-small-top uk-visible-toggle" data-uk-slider>
        <ul class="uk-slider-items  uk-child-width-1-5 uk-child-width-1-5@m uk-grid uk-grid-small">
            <?php
            $d=0;
            if (isset($ap_video) && !empty($ap_video)) {
                $d=0;
                ?>
                <li data-uk-slideshow-item="<?php echo esc_attr($d);?>" >
                    <a href="#" data-uk-cover-container class="uk-display-block uk-position-relative">
                        <img data-uk-cover src="<?php echo esc_url($video_thumbnail);?>" alt="<?php esc_attr_e('Video','templaza-framework');?>">
                    </a>
                </li>
                <?php
                $d++;
            }
            foreach ($ap_gallery as $image) {
                ?>
                <li data-uk-slideshow-item="<?php echo esc_attr($d);?>" >
                    <a href="#" data-uk-cover-container class="uk-display-block uk-position-relative">
                        <img data-uk-cover src="<?php echo esc_url($image['sizes']['medium']); ?>" width="180" alt="<?php echo esc_attr($image['title']); ?>">
                    </a>
                </li>
            <?php
            $d++;
            } ?>
        </ul>
        <a class="uk-position-center-left uk-hidden-hover" href="#" data-uk-slidenav-previous data-uk-slider-item="previous"></a>
        <a class="uk-position-center-right  uk-hidden-hover" href="#" data-uk-slidenav-next data-uk-slider-item="next"></a>
    </div>
    <?php } ?>
</div>
<?php } ?>