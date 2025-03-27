<?php

defined('TEMPLAZA_FRAMEWORK') or exit();

use TemPlazaFramework\Functions;
use TemPlazaFramework\Templates;

$options        = Functions::get_theme_options();

if(isset($atts['text_align'])){
    if($atts['text_align'] == 'center'){
        $atts['tz_class'] .= ' uk-flex-center';
    }
    if($atts['text_align'] == 'right'){
        $atts['tz_class'] .= ' uk-flex-right';
    }
}
$backtotop_icon             = isset($options['backtotop-icon'])?$options['backtotop-icon']:'fas fa-arrow-up';
?>
<div<?php echo isset($atts['tz_id'])?' id="'.esc_attr($atts['tz_id']).'"':''; ?> class=" <?php
echo isset($atts['tz_class'])?esc_attr(trim($atts['tz_class'])):''; ?>">

    <a id="templaza-backtotop" class="templaza-backtotop-element" href="javascript:void(0)"><i class="<?php echo esc_attr($backtotop_icon);?>" ></i></a>

</div>
