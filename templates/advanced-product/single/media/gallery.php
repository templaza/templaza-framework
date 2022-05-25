<?php

use Advanced_Product\AP_Functions;

defined('ADVANCED_PRODUCT') or exit();

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
<div class="ap-slideshow uk-position-relative " data-uk-slideshow="animation: fade">
    <div class="uk-position-relative uk-visible-toggle">
        <ul class="uk-slideshow-items">
            <?php foreach ($ap_gallery as $image) {
                ?>
                <li>
                    <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['title']); ?>" data-uk-cover>

                </li>
            <?php } ?>
        </ul>
        <a class="uk-position-center-left uk-hidden-hover" href="#" data-uk-slidenav-previous data-uk-slideshow-item="previous"></a>
        <a class="uk-position-center-right  uk-hidden-hover" href="#" data-uk-slidenav-next data-uk-slideshow-item="next"></a>

    </div>

    <div class="uk-position-relative uk-margin-small-top uk-visible-toggle" data-uk-slider>
        <ul class="uk-slider-items  uk-child-width-1-5 uk-child-width-1-5@m uk-grid uk-grid-small">
            <?php
            $d=0;
            foreach ($ap_gallery as $image) {
                ?>
                <li data-uk-slideshow-item="<?php echo esc_attr($d);?>">
                    <a href="#">
                        <img src="<?php echo esc_url($image['url']); ?>" width="180" alt="<?php echo esc_attr($image['title']); ?>">
                    </a>
                </li>
            <?php
            $d++;
            } ?>
        </ul>
        <a class="uk-position-center-left uk-hidden-hover" href="#" data-uk-slidenav-previous data-uk-slider-item="previous"></a>
        <a class="uk-position-center-right  uk-hidden-hover" href="#" data-uk-slidenav-next data-uk-slider-item="next"></a>
    </div>
</div>
<?php } ?>