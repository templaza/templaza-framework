<?php
use Advanced_Product\AP_Functions;

defined('ADVANCED_PRODUCT') or exit();
wp_enqueue_style('templaza-tiny-slider-style');
wp_enqueue_script( 'templaza-tiny-slider-script' );
$ap_video   = get_field('ap_video', get_the_ID());
$ap_gallery = get_field('ap_gallery', get_the_ID());
$no_cookie      =   0;
if (isset($ap_video) && !empty($ap_video)) {
    if (wp_oembed_get($ap_video)) :
        $video = parse_url($ap_video);
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
    $video_thumbnail="http://img.youtube.com/vi/".$id."/maxresdefault.jpg";
}

if(!empty($ap_gallery)){
?>
<div class="uk-inline tz-slideshow-wrap">
    <div class="ap-slideshow ap-tiny-slider">
        <?php
        if (isset($ap_video) && !empty($ap_video)) {
        ?>
        <div class="ap-tiny-slider-item item-video">
            <?php if(wp_oembed_get( $ap_video )) : ?>
                <iframe class="tz-embed-responsive-item" src="<?php echo esc_url($src);?>" allowFullScreen width="1920" height="1080" allowfullscreen uk-responsive data-uk-video></iframe>
            <?php else : ?>
                <?php echo wp_kses($ap_video,'post'); ?>
            <?php endif; ?>
        </div>
        <?php
        }
        ?>
        <?php foreach ($ap_gallery as $image) {
            ?>
            <div class="ap-tiny-slider-item">
                <?php if(isset($image['url'])){
                    ?>
                <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['title']); ?>">
                <?php
                }else{
                  ?>
                    <img src="<?php echo wp_get_attachment_url($image); ?>" alt="<?php echo get_post_meta($image, '_wp_attachment_image_alt', TRUE); ?>">
                <?php
                }
                ?>
            </div>
        <?php } ?>
    </div>
    <div class="tz-slideshow-control">
        <div class="prev">
            <i class="fas fa-chevron-left"></i>
        </div>
        <div class="next">
            <i class="fas fa-chevron-right"></i>
        </div>
    </div>
</div>
<div class="tz-control-wrap uk-inline">
    <div class="tz-ap-thumbnails">
        <?php
        if (isset($ap_video) && !empty($ap_video)) {
            ?>
            <div class="ap-tiny-slider-thumbnail item-video-thumbnail">
                <img src="<?php echo esc_url($video_thumbnail);?>" alt="<?php esc_attr_e('Video','templaza-framework');?>">
            </div>
            <?php
        }
        ?>
        <?php foreach ($ap_gallery as $image) {
            ?>
            <div class="ap-tiny-slider-thumbnail">
                <?php if(isset($image['sizes']['medium'])){
                    ?>
                    <img src="<?php echo esc_url($image['sizes']['medium']); ?>" alt="<?php echo esc_attr($image['title']); ?>">
                    <?php
                }else{
                    ?>
                    <img src="<?php echo wp_get_attachment_url($image); ?>" alt="<?php echo get_post_meta($image, '_wp_attachment_image_alt', TRUE); ?>">
                    <?php
                }
                ?>
            </div>
        <?php } ?>
    </div>
    <div class="tz-slideshow-control-thumb">
        <div class="prev">
            <i class="fas fa-chevron-left"></i>
        </div>
        <div class="next">
            <i class="fas fa-chevron-right"></i>
        </div>
    </div>
</div>
<?php } ?>
<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function(event) {
        var slider = tns({
            container: '.ap-tiny-slider',
            items: 1,
            mode: 'carousel',
            navContainer: '.tz-ap-thumbnails',
            navAsThumbnails: true,
            animateIn: 'tns-fadeIn',
            animateOut: 'tns-fadeOut',
            speed: 1000,
            mouseDrag: true,
            slideBy: 'page',
            center: true,
            loop: false,
            controlsContainer:'.tz-slideshow-control',
        });
        var slider_thumb = tns({
            container: '.tz-ap-thumbnails',
            items: 5,
            nav: false,
            gutter: 20,
            mouseDrag: true,
            loop: false,
            controlsContainer:'.tz-slideshow-control-thumb',
            responsive: {
                640: {
                    gutter: 10,
                    items: 3,
                },
                960: {
                    gutter: 20,
                    items: 5,
                }
            }
        });
    })
</script>
