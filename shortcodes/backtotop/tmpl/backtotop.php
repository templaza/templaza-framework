<?php

defined('TEMPLAZA_FRAMEWORK') or exit();

use TemPlazaFramework\Functions;
use TemPlazaFramework\Templates;
extract(shortcode_atts(array(
    'tz_id'                    => '',
    'tz_class'                 => '',
    'image'                 => '',

), $atts));

$options        = Functions::get_theme_options();

if(isset($atts['text_align'])){
    if($atts['text_align'] == 'center'){
        $atts['tz_class'] .= ' uk-flex-center';
    }
    if($atts['text_align'] == 'right'){
        $atts['tz_class'] .= ' uk-flex-right';
    }
}

if(!empty($image)){
    $image      =   json_decode($image);
}else{
    $backtotop_icon  = isset($options['backtotop-icon'])?$options['backtotop-icon']:'fas fa-arrow-up';
}
?>
<div<?php echo isset($atts['tz_id'])?' id="'.esc_attr($atts['tz_id']).'"':''; ?> class=" <?php
echo isset($atts['tz_class'])?esc_attr(trim($atts['tz_class'])):''; ?>">

    <a id="templaza-backtotop-element" class="templaza-b2t_btn templaza-backtotop-element" href="javascript:void(0)">
        <?php
        if($image){
            ?>
        <img alt="<?php esc_attr_e('icon','templaza-framework');?>" src="<?php echo esc_url($image->url);?>"/>
        <?php
        }else{
            ?>
            <i class="<?php echo esc_attr($backtotop_icon);?>" ></i>
        <?php
        }
        ?>
    </a>

</div>
