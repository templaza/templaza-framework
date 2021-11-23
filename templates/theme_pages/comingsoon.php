<?php
use TemPlazaFramework\CSS;
use TemPlazaFramework\Functions;
use TemPlazaFramework\Templates;

$options    = Functions::get_theme_options();

$background_setting = isset($options['miscellaneous-development-mode'])?filter_var($options['miscellaneous-development-mode'], FILTER_VALIDATE_BOOLEAN):false;

$css    = '';
$video  = [];
if ($background_setting) {
    if ($background_setting == "color") {
        $background_color   = isset($options['miscellaneous-background-color'])?$options['miscellaneous-background-color']:'';
        $background_color   = CSS::make_color_rgba_redux($background_color);
        if (!empty($background_color)) {
            $css = 'background-color:' . $background_color;
        }
    }
    if ($background_setting == "image") {

        $background_image   = isset($options['miscellaneous-background-image'])?$options['miscellaneous-background-image']:'';
        $css                = !empty($background_image)?CSS::background_redux($background_image):'';

//        $img_background_color = isset($options['miscellaneous-background-image'])?$options['miscellaneous-background-image']:'';
//        $img_background_color = empty($img_background_color) ? 'inherit' : $img_background_color;
//        $styles[] = 'background-color:' . $img_background_color;
//
//        $background_image = $params->get('background_image', '');
//        if (!empty($background_image)) {
//            $styles[] = 'background-image: url(' . JURI::root() . Astroid\Helper\Media::getPath() . '/' . $background_image . ')';
//            $background_repeat = $params->get('background_repeat', '');
//            $background_repeat = empty($background_repeat) ? 'inherit' : $background_repeat;
//            $styles[] = 'background-repeat:' . $background_repeat;
//
//            $background_size = $params->get('background_size', '');
//            $background_size = empty($background_size) ? 'inherit' : $background_size;
//            $styles[] = 'background-size:' . $background_size;
//
//            $background_attchment = $params->get('background_attchment', '');
//            $background_attchment = empty($background_attchment) ? 'inherit' : $background_attchment;
//            $styles[] = 'background-attachment:' . $background_attchment;
//
//            $background_position = $params->get('background_position', '');
//            $background_position = empty($background_position) ? 'inherit' : $background_position;
//            $styles[] = 'background-position:' . $background_position;
//        }
    }

    if ($background_setting == "video") {
        $attributes = [];
        $background_video = isset($options['miscellaneous-background-video'])?$options['miscellaneous-background-video']:'';
        if (!empty($background_video) && !isset($background_video['url']) && !empty($background_video['url'])) {
            $attributes['data-jd-video-bg'] = $background_video['url'];
//            $document->addScript('vendor/astroid/js/videobg.js', 'body');
        }

        $return = [];
        foreach ($attributes as $key => $value) {
            $return[] = $key . '="' . $value . '"';
        }
        $video =  $return;
    }
}

$comingsoon_logo = "";
$hascs_logo = 0;

$cs_logo = isset($options['miscellaneous-logo'])?$options['miscellaneous-logo']:'';
if ($cs_logo && isset($cs_logo['url']) && !empty($cs_logo['url'])) {
    if(!Functions::is_external_url($cs_logo['url'])){
        $comingsoon_logo = $cs_logo['url'];
    }else {
        $comingsoon_logo = Functions::get_theme_default_logo_url('logo');
    }
    $hascs_logo = 1;
}

$coming_soon_content    = isset($options['miscellaneous-content'])?$options['miscellaneous-content']:'';
$comingsoon_social      = isset($options['miscellaneous-coming-soon-social'])?filter_var($options['miscellaneous-coming-soon-social'], FILTER_VALIDATE_BOOLEAN):false;
$comingsoon_date        = isset($options['miscellaneous-coming-soon-countdown-date'])?$options['miscellaneous-coming-soon-countdown-date']:time();

$date               = new \DateTime($comingsoon_date, new DateTimeZone(wp_timezone_string()));
$comingsoon_date    = $date->format('c');

Templates::add_inline_style('.comingsoon-wrap{'.$css.'}');
?>
<div class="comingsoon-wrap" <?php echo implode(' ', $video); ?>>
    <div class="uk-text-center">
        <div id="comingsoon">
            <div class="comingsoon-page-logo">
                <?php if ($hascs_logo) { ?>
                    <img class="comingsoon-logo m-auto" alt="logo" src="<?php echo $comingsoon_logo; ?>" />
                <?php } ?>
            </div>

            <?php if (!empty($coming_soon_content)) { ?>
                <div class="comingsoon-content">
                    <?php echo $coming_soon_content; ?>
                </div>
            <?php } ?>

            <?php if ($comingsoon_date) { ?>
                <div class="uk-grid-small uk-child-width-auto uk-flex-center" data-uk-grid data-uk-countdown="date: <?php echo esc_attr($comingsoon_date); ?>">
                    <div>
                        <div class="uk-countdown-number uk-countdown-days"></div>
                        <div class="uk-countdown-label uk-margin-small uk-text-center uk-visible@s"><?php echo __('Days',Functions::get_my_text_domain()); ?></div>
                    </div>
                    <div class="uk-countdown-separator">:</div>
                    <div>
                        <div class="uk-countdown-number uk-countdown-hours"></div>
                        <div class="uk-countdown-label uk-margin-small uk-text-center uk-visible@s"><?php echo __('Hours',Functions::get_my_text_domain()); ?></div>
                    </div>
                    <div class="uk-countdown-separator">:</div>
                    <div>
                        <div class="uk-countdown-number uk-countdown-minutes"></div>
                        <div class="uk-countdown-label uk-margin-small uk-text-center uk-visible@s"><?php echo __('Minutes',Functions::get_my_text_domain()); ?></div>
                    </div>
                    <div class="uk-countdown-separator">:</div>
                    <div>
                        <div class="uk-countdown-number uk-countdown-seconds"></div>
                        <div class="uk-countdown-label uk-margin-small uk-text-center uk-visible@s"><?php echo __('Seconds',Functions::get_my_text_domain()); ?></div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>
