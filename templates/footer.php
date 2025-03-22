<?php

defined('TEMPLAZA_FRAMEWORK') or exit();

use TemPlazaFramework\Functions;
use TemPlazaFramework\Templates;
if ( !class_exists( 'TemPlazaFramework\TemPlazaFramework' )){
    $templaza_options = array();
}else{
    $templaza_options = Functions::get_theme_options();
}
$ap_quote       = isset($templaza_options['ap_product-quote'])?filter_var($templaza_options['ap_product-quote'], FILTER_VALIDATE_BOOLEAN):false;
$ap_quote_label          = isset($templaza_options['ap_product-quote-label'])?$templaza_options['ap_product-quote-label']:'';
$ap_quote_form          = isset($templaza_options['ap_product-quote-form'])?$templaza_options['ap_product-quote-form']:'';
$ap_quote_form_custom          = isset($templaza_options['ap_product-quote-form-custom'])?$templaza_options['ap_product-quote-form-custom']:'';
$ap_quote_form_url          = isset($templaza_options['ap_product-quote-custom-url'])?$templaza_options['ap_product-quote-custom-url']:'';
?>

            </div><!-- Wrapper -->
        </div><!-- Layout -->
    </div><!-- Content -->
    <?php Templates::load_my_header('backtotop'); ?>

</div><!-- Container -->

<?php
if($ap_quote){
    ?>
<div class="ap_product_quote  uk-position-fixed uk-position-center-right">
    <span class="quote_open" data-uk-icon="icon:chevron-double-left; ratio: 0.9"></span>
    <div class="ap_quote_inner">
        <span class="quote_close" data-uk-icon="icon:chevron-double-right; ratio: 0.9"></span>
        <?php
        if($ap_quote_form =='custom_url'){
            if($ap_quote_form_url !=''){
                ?>
                <a href="<?php echo esc_url($ap_quote_form_url);?>" target="_blank" class="templaza-btn"><?php echo esc_html($ap_quote_label);?></a>
                <?php
            }
        }else{
            ?>
            <a class="templaza-btn" href="#modal-quote" data-uk-toggle>
                <?php echo esc_html($ap_quote_label);?>
            </a>
            <?php
        }
        ?>
    </div>
</div>
<div id="modal-quote" class="uk-flex-top ap-modal" data-uk-modal>
    <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical">
        <button class="uk-modal-close-default" type="button" data-uk-close></button>
        <div class="get-price">
            <?php
            if($ap_quote_form == 'custom'){
                echo do_shortcode($ap_quote_form_custom);
            }else{
                ?>
                <h3 class="uk-modal-title"><?php echo esc_html(get_the_title($ap_quote_form)); ?></h3>
                <?php
                if(function_exists('wpforms')) {
                    echo do_shortcode('[wpforms id="' . $ap_quote_form . '"]');
                }
            }
            ?>
        </div>
    </div>
</div>
<?php
}
$cursor_enable   = isset($templaza_options['enable-cursor-effects'])?filter_var($templaza_options['enable-cursor-effects'], FILTER_VALIDATE_BOOLEAN):false;
$cursor_eff   = isset($templaza_options['cursor-effects'])?$templaza_options['cursor-effects']:'';
if($cursor_enable && $cursor_eff){
    switch ($cursor_eff) {
        case "effect1":
            ?>
            <svg class="cursor cursor-effect1" width="24" height="24" viewBox="0 0 24 24" data-scale-enter="2" data-opacity-enter=".8">
                <circle class="cursor__inner" cx="12" cy="12" r="6"></circle>
            </svg>
            <?php
            break;
        case "effect2":
            ?>
            <svg class="cursor cursor--1 cursor-effect2" width="12" height="12" viewBox="0 0 12 12" data-scale-enter="0" data-opacity-enter="0">
                <circle class="cursor__inner" cx="6" cy="6" r="3"></circle>
            </svg>
            <svg class="cursor cursor-effect2 cursor--2" width="72" height="72" viewBox="0 0 72 72" data-scale-enter="2" data-opacity-enter=".5" data-amt="0.15">
                <circle class="cursor__inner" cx="36" cy="36" r="18"></circle>
            </svg>
            <?php
            break;
        case "effect3":
            ?>
            <svg class="cursor cursor-effect3" width="120" height="120" viewBox="0 0 120 120">
                <defs>
                    <filter id="cursor-filter" x="-50%" y="-50%" width="200%" height="200%"
                            filterUnits="objectBoundingBox">
                        <feTurbulence type="fractalNoise" baseFrequency="0" numOctaves="1" result="warp" />
                        <feDisplacementMap in2="turbulence" xChannelSelector="R" yChannelSelector="G" scale="30" in="SourceGraphic" />
                    </filter>
                </defs>
                <circle class="cursor__inner" cx="60" cy="60" r="20"/>
            </svg>
            <svg class="cursor cursor-effect3" width="120" height="120" viewBox="0 0 120 120" data-amt="0.1">
                <circle class="cursor__inner" cx="60" cy="60" r="20"/>
            </svg>
            <?php
            break;
        case "effect4":
            ?>
            <svg class="cursor cursor-effect4" width="100" height="100" viewBox="0 0 100 100">
                <defs>
                    <filter id="cursor-filter" x="-50%" y="-50%" width="200%" height="200%"
                            filterUnits="objectBoundingBox">
                        <feTurbulence type="fractalNoise" baseFrequency="0" numOctaves="1" result="warp" />
                        <feDisplacementMap in2="turbulence" xChannelSelector="R" yChannelSelector="G" scale="30" in="SourceGraphic" />
                    </filter>
                </defs>
                <circle class="cursor__inner" cx="50" cy="50" r="15"/>
            </svg>
            <svg class="cursor cursor-effect4" style="opacity:0.7" width="100" height="100" viewBox="0 0 100 100" data-amt="0.13">
                <circle class="cursor__inner" cx="50" cy="50" r="15"/>
            </svg>
            <svg class="cursor cursor-effect4" style="opacity:0.6" width="100" height="100" viewBox="0 0 100 100" data-amt="0.115">
                <circle class="cursor__inner" cx="50" cy="50" r="15"/>
            </svg>
            <svg class="cursor cursor-effect4" style="opacity:0.5" width="100" height="100" viewBox="0 0 100 100" data-amt="0.1">
                <circle class="cursor__inner" cx="50" cy="50" r="15"/>
            </svg>
            <svg class="cursor cursor-effect4" style="opacity:0.4" width="100" height="100" viewBox="0 0 100 100" data-amt="0.085">
                <circle class="cursor__inner" cx="50" cy="50" r="15"/>
            </svg>
            <svg class="cursor cursor-effect4" style="opacity:0.3" width="100" height="100" viewBox="0 0 100 100" data-amt="0.07">
                <circle class="cursor__inner" cx="50" cy="50" r="15"/>
            </svg>
            <svg class="cursor cursor-effect4" style="opacity:0.2" width="100" height="100" viewBox="0 0 100 100" data-amt="0.055">
                <circle class="cursor__inner" cx="50" cy="50" r="15"/>
            </svg>
            <svg class="cursor cursor-effect4" style="opacity:0.1" width="100" height="100" viewBox="0 0 100 100" data-amt="0.04">
                <circle class="cursor__inner" cx="50" cy="50" r="15"/>
            </svg>
            <?php
            break;
        case "effect5":
            ?>
            <svg class="cursor cursor-effect5" width="100" height="100" viewBox="0 0 100 100">
                <defs>
                    <filter id="cursor-filter" x="-50%" y="-50%" width="200%" height="200%"
                            filterUnits="objectBoundingBox">
                        <feTurbulence type="fractalNoise" seed="1" baseFrequency="0" numOctaves="1" result="warp" />
                        <feDisplacementMap in2="turbulence" xChannelSelector="R" yChannelSelector="G" scale="40" in="SourceGraphic" />
                    </filter>
                </defs>
                <circle class="cursor__inner" cx="50" cy="50" r="20"/>
            </svg>
            <?php
            break;
        case "effect6":
            ?>
            <svg class="cursor cursor-effect6" width="120" height="120" viewBox="0 0 120 120">
                <defs>
                    <filter id="cursor-filter" x="-50%" y="-50%" width="200%" height="200%"
                            filterUnits="objectBoundingBox">
                        <feTurbulence type="fractalNoise" seed="1" baseFrequency="0" numOctaves="1" result="warp" />
                        <feDisplacementMap in2="turbulence" xChannelSelector="R" yChannelSelector="G" scale="20" in="SourceGraphic" />
                    </filter>
                </defs>
                <circle class="cursor__inner" cx="60" cy="60" r="10"/>
            </svg>
            <?php
            break;
        case "effect7":
            ?>
            <svg class="cursor cursor-effect7" width="140" height="140" viewBox="0 0 140 140">
                <defs>
                    <filter id="cursor-filter" x="-50%" y="-50%" width="200%" height="200%"
                            filterUnits="objectBoundingBox">
                        <feTurbulence type="fractalNoise" seed="3" baseFrequency="0" numOctaves="1" result="warp" />
                        <feDisplacementMap in2="turbulence" xChannelSelector="R" yChannelSelector="G" scale="15" in="SourceGraphic" />
                    </filter>
                </defs>
                <circle class="cursor__inner" cx="70" cy="70" r="20"/>
            </svg>
            <svg class="cursor cursor-effect7" width="140" height="140" viewBox="0 0 140 140" data-amt="0.13">
                <circle class="cursor__inner" cx="70" cy="70" r="24"/>
            </svg>
            <?php
            break;

        default:

    }
}
?>

