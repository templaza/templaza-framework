<?php
use Advanced_Product\AP_Functions;

defined('ADVANCED_PRODUCT') or exit();
$ap_video   = get_field('ap_video', get_the_ID());
$ap_gallery = get_field('ap_gallery', get_the_ID());
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
    $video_thumbnail="http://img.youtube.com/vi/".$id."/maxresdefault.jpg";
}

if(!empty($ap_gallery)){
    $class='';
    $img_position='uk-position-top-left';
    $img_cover='data-uk-cover';
    $total_images = count($ap_gallery);
    if($total_images ==1){
        $col_class = 'uk-width-1-1';
        $col_class2 = '';
        $img_height = '100%';
        $img_position = ' one_image';
        $img_cover = ' ';
    }elseif($total_images ==2){
        $col_class = $col_class2 = $class_inner = 'uk-width-1-2';
        $img_height = '600';
    }elseif($total_images ==3){
        $col_class = $col_class2 = $class_inner = 'uk-width-1-3';
        $img_height = '500';
    }elseif($total_images ==4){
        $bg = '';
    }elseif($total_images ==5){
        $bg = 'uk-hidden';
        $col_class = 'uk-width-3-5';
        $col_class2 = 'uk-width-1-3';
        $class_inner = 'uk-width-1-2';
        $img_height = '350';
    }else{
        $bg = '';
        $col_class = 'uk-width-2-3';
        $col_class2 = 'uk-width-1-3';
        $class_inner = 'uk-width-1-2';
        $img_height = '350';
    }
?>
<div class="ap-gallery-grid">
    <div class="ap-gallery uk-grid-small uk-grid-match" data-uk-grid data-uk-lightbox="animation: scale">
        <?php
        if (isset($ap_video) && !empty($ap_video)) {
        ?>
        <div class="ap-video">
            <?php if(wp_oembed_get( $ap_video )) : ?>
                <iframe class="tz-embed-responsive-item" src="<?php echo esc_url($src);?>" allowFullScreen width="1920" height="1080" allowfullscreen uk-responsive data-uk-video></iframe>
            <?php else : ?>
                <?php echo wp_kses($ap_video,'post'); ?>
            <?php endif; ?>
        </div>
        <?php
        }
        ?>
        <?php $i=0;foreach ($ap_gallery as $image) {
            if($i==0){
                ?>
                <div class="ap-gallery-item <?php echo esc_attr($col_class);?>">
                    <div class="uk-flex uk-flex-center uk-flex-middle uk-height-1-1 uk-cover-container">
                        <a class="<?php echo esc_attr($img_position);?> uk-inline uk-width-1-1 uk-height-1-1" href="<?php echo esc_url($image['url']); ?>" data-caption="<?php echo esc_attr($image['caption']); ?>">
                            <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['title']); ?>" <?php echo esc_attr($img_cover);?>>
                            <canvas width="100%" height="<?php echo esc_attr($img_height);?>"></canvas>
                        </a>
                    </div>
                </div>
                <?php if($total_images >4){ ?>
                <div class="<?php echo esc_attr($col_class2);?>" >
                <div class="uk-grid-small" data-uk-grid >
                <?php
                }
            }else{
                if($i>4){
                    $class .=' uk-hidden';
                }
                if($i==4){
                    ?>
                    <div class="ap-gallery-item uk-width-1-2 <?php echo esc_attr($class);?>">
                        <div class="uk-cover-container">
                            <a class="uk-inline uk-width-1-1 uk-height-1-1" href="<?php echo esc_url($image['url']); ?>" data-caption="<?php echo esc_attr($image['caption']); ?>">
                                <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['title']); ?>" data-uk-cover>
                                <canvas width="100%" height="350"></canvas>
                                <span class="ap-image-color <?php echo esc_attr($bg);?> uk-flex uk-flex-center uk-flex-middle uk-position-top-left uk-width-1-1 uk-height-1-1"><?php esc_html_e('+','templaza-framework'); echo esc_html($total_images-4);esc_html_e(' Photos >','templaza-framework');?></span>
                            </a>
                        </div>
                    </div>
                    <?php
                }else{
                ?>
                <div class="ap-gallery-item <?php echo esc_attr($class.' '.$class_inner);?>">
                    <div class="uk-cover-container">
                        <a class="uk-inline uk-width-1-1 uk-height-1-1" href="<?php echo esc_url($image['url']); ?>" data-caption="<?php echo esc_attr($image['caption']); ?>">
                            <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['title']); ?>" data-uk-cover>
                            <canvas width="100%" height="<?php echo esc_attr($img_height);?>"></canvas>
                        </a>
                    </div>
                </div>
            <?php
                }
            }
            ?>
        <?php $i++;
        if($i==$total_images && $total_images>4){
            echo '</div></div>';
        }
        } ?>
    </div>
</div>
<?php } ?>

