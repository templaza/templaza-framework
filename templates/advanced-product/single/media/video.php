<?php

use Advanced_Product\AP_Functions;

defined('ADVANCED_PRODUCT') or exit();

$options    = array();

$ap_video = get_field('ap_video', get_the_ID());
$autoplay       =   0;
$loop           =   0;
$muted          =   0;
$autopause      =   1;
$byline         =   1;
$video_title    =   1;
$portrait       =   1;
$controls       =   1;
$no_cookie      =   0;
$show_rel_video =   '&rel=1';
$attrb[]  = 'autoplay='.$autoplay;
$attrb[]  = 'loop='.$loop;
$attrb[]  = 'muted='.$muted;
$attrb[]  = 'mute='.$muted;
$attrb[]  = 'autopause='.$autopause;
$attrb[]  = 'title='.$video_title;
$attrb[]  = 'byline='.$byline;
$attrb[]  = 'portrait='.$portrait;
$attrb[]  = 'controls='.$controls;
if(!empty($ap_video)){
    ?>
    <div class="ap-single-video">
        <?php
        if (wp_oembed_get($ap_video)) :
            $video = parse_url($ap_video);
            $youtube_no_cookie = $no_cookie ? '-nocookie' : '';
            switch($video['host']) {
                case 'youtu.be':
                    $id = trim($video['path'],'/');
                    $src = '//www.youtube'.$youtube_no_cookie.'.com/embed/' . $id .'?autoplay=0&amp;showinfo=0&amp;rel=0&amp;modestbranding=1&amp;playsinline=1';
                    break;

                case 'www.youtube.com':
                case 'youtube.com':
                    parse_str($video['query'], $query);
                    $id = $query['v'];
                    $src = '//www.youtube'.$youtube_no_cookie.'.com/embed/' . $id .'?autoplay=0&amp;showinfo=0&amp;rel=0&amp;modestbranding=1&amp;playsinline=1';
                    break;

                case 'vimeo.com':
                case 'www.vimeo.com':
                    $id = trim($video['path'],'/');
                    $src = "//player.vimeo.com/video/{$id}?".implode('&amp;', $attrb);
            }
            echo '<div class="tz-embed-responsive tz-embed-responsive-16by9">';
            echo '<iframe class="tz-embed-responsive-item" src="'.esc_url($src).'" allowFullScreen width="1920" height="1080" allowfullscreen uk-responsive data-uk-video></iframe>';
            echo '</div>';
        else :
            echo wp_kses_post($ap_video);
        endif;
        ?>
    </div>
<?php } ?>