<?php
use Advanced_Product\AP_Functions;
use TemPlazaFramework\Functions;
use TemPlazaFramework\Templates;
use TemPlazaFramework\CSS;
defined('ADVANCED_PRODUCT') or exit();

if ( !class_exists( 'TemPlazaFramework\TemPlazaFramework' )){
    $templaza_options = array();
}else{
    $templaza_options = Functions::get_theme_options();
}
wp_enqueue_style('templaza-tiny-slider-style');
wp_enqueue_script( 'templaza-tiny-slider-script' );
$ap_video   = get_field('ap_video', get_the_ID());
$ap_gallery = get_field('ap_gallery', get_the_ID());
$ap_tiny_mode = isset($templaza_options['ap_product-single-tiny-mode']) ? $templaza_options['ap_product-single-tiny-mode'] : 'carousel';
$ap_tiny_height = isset($templaza_options['ap_product-single-tiny-custom_height']) ? $templaza_options['ap_product-single-tiny-custom_height'] : '';
$ap_tiny_image = isset($templaza_options['ap_product-single-tiny-cover']) ? $templaza_options['ap_product-single-tiny-cover'] : 'cover';
$ap_tiny_autoheight  = isset($templaza_options['ap_product-single-tiny-autoheight'])?filter_var($templaza_options['ap_product-single-tiny-autoheight'], FILTER_VALIDATE_BOOLEAN):true;
$ap_tiny_thumb  = isset($templaza_options['ap_product-slider-thumbnail'])?filter_var($templaza_options['ap_product-slider-thumbnail'], FILTER_VALIDATE_BOOLEAN):true;
$ap_slider_number = isset($templaza_options['ap_product-slider-number']) ? $templaza_options['ap_product-slider-number'] : 1;
$no_cookie      =   0;
if($ap_slider_number >1){
    $ap_tiny_mode = 'carousel';
}
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
    $video_thumbnail="https://img.youtube.com/vi/".$id."/maxresdefault.jpg";
}
$tiny_cls = '';
$tiny_cls .= 'mode'.$ap_tiny_mode;
if ( class_exists( 'TemPlazaFramework\TemPlazaFramework' ) ) {

    if ($ap_tiny_height != '') {
        $koer_css = '.tz-slideshow-wrap .tns-item {height: ' . $ap_tiny_height . ';}';
        Templates::add_inline_style($koer_css);
        $tiny_cls .= ' slider-custom_height';
    }
}

if($ap_tiny_image =='cover'){
    $tiny_cls .= ' img-cover';
}

if(!empty($ap_gallery)){
?>
<div class="uk-inline tz-slideshow-wrap <?php echo esc_attr($tiny_cls);?>">
    <div class="ap-slideshow ap-tiny-slider"  data-uk-lightbox="animation: fade">
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
                <div class="sl-img-wrap">
                <?php if(isset($image['url'])){
                    ?>
                    <a data-elementor-open-lightbox="no" class="uk-inline" href="<?php echo esc_url($image['url']); ?>" data-caption="<?php echo esc_attr($image['title']); ?>">
                        <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['title']); ?>">
                    </a>

                <?php
                }else{
                  ?>
                    <img src="<?php echo wp_get_attachment_url($image); ?>" alt="<?php echo get_post_meta($image, '_wp_attachment_image_alt', TRUE); ?>">
                <?php
                }
                ?>
                </div>
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
<?php if($ap_tiny_thumb){ ?>
<div class="tz-control-wrap uk-inline <?php echo esc_attr($tiny_cls);?>">
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
                <div class="thumb-img-wrap">
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
<?php } ?>
<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function(event) {
        var slider = tns({
            container: '.ap-tiny-slider',
            items: <?php echo esc_attr($ap_slider_number);?>,
            mode: '<?php echo esc_attr($ap_tiny_mode);?>',
            <?php if($ap_tiny_thumb){ ?>
            navContainer: '.tz-ap-thumbnails',
            navAsThumbnails: true,
            <?php } ?>
            animateIn: 'tns-fadeIn',
            animateOut: 'tns-fadeOut',
            speed: 1000,
            autoHeight:<?php if($ap_tiny_autoheight){ echo 'true';} else{ echo 'false';}?>,
            mouseDrag: true,
            slideBy: 1,
            center: true,
            <?php if($ap_tiny_thumb==false){ ?>
            nav: false,
            <?php } ?>
            loop: true,
            controlsContainer:'.tz-slideshow-control',

        });
        <?php if($ap_tiny_thumb){ ?>
        var slider_thumb = tns({
            container: '.tz-ap-thumbnails',
            items: 5,
            nav: false,
            gutter: 10,
            mouseDrag: true,
            loop: false,
            controlsContainer:'.tz-slideshow-control-thumb',
            responsive: {
                640: {
                    gutter: 10,
                    items: 4,
                },
                960: {
                    gutter: 20,
                    items: 5,
                }
            }
        });
        <?php } ?>
    })
</script>
