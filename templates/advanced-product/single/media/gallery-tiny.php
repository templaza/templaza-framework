<?php
use Advanced_Product\AP_Functions;

defined('ADVANCED_PRODUCT') or exit();
wp_enqueue_style('baressco-tiny-slider-style');
wp_enqueue_script( 'baressco-tiny-slider-script' );
$ap_video   = get_field('ap_video', get_the_ID());
$ap_gallery = get_field('ap_gallery', get_the_ID());

if (isset($ap_video) && !empty($ap_video)) {
    preg_match("/iframe/", $ap_video, $output_array);
    if ($output_array && !empty($output_array)) {
        preg_match("/src=\"([^\"]+)\"/", $ap_video, $output_array);
        $ap_video = $output_array[1];
    }
}

if(!empty($ap_gallery)){
?>
<div class="uk-inline tz-slideshow-wrap">
    <div class="ap-slideshow ap-tiny-slider">
        <?php foreach ($ap_gallery as $image) {
            ?>
            <div class="ap-tiny-slider-item">
                <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['title']); ?>">
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
        <?php foreach ($ap_gallery as $image) {
            ?>
            <div class="ap-tiny-slider-thumbnail">
                <img src="<?php echo esc_url($image['sizes']['medium']); ?>" alt="<?php echo esc_attr($image['title']); ?>">
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
            mode: 'gallery',
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
        });
    })
</script>
