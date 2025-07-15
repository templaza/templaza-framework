<?php
defined('TEMPLAZA_FRAMEWORK') or exit();

use TemPlazaFramework\Functions;

extract(shortcode_atts(array(
    'tz_id'                  => '',
    'tz_class'               => '',
	'hideon_single'          => '',
    'section_type'           => 'default',
    'section_overflow'       => '',
    'layout_type'            => 'container',
    'height'                 => '',
    'vertical_align'         => '',
    'container_width'        => '',
    'padding_type'        => '',
    'padding_remove_top'     => '',
    'padding_remove_bottom'  => '',
    'custom_container_class' => '',
    'container_width_expand' => '',
    'padding_remove_horizontal' => '',
    'background_effect' => '',
    'decorative_background' => '',
), $atts));
if(is_single()==true && $hideon_single ==1) {
    return;
}else{
if(!empty($content)){

    $_tz_class  = '';

    $padding_remove_horizontal    = isset($padding_remove_horizontal)?filter_var($padding_remove_horizontal, FILTER_VALIDATE_BOOLEAN):false;

    if(has_shortcode($content, 'templaza_header')){
        $gboptions      = Functions::get_theme_options();
        $options        = Functions::get_header_options();
        $header         = isset($gboptions['enable-header'])?filter_var($gboptions['enable-header'],FILTER_VALIDATE_BOOLEAN):true;

        if($header){
            $header_absolute = isset($options['header-absolute'])?(bool) $options['header-absolute']:false;
            $_tz_class  .= ' templaza-header-section ';
            if($header_absolute) {
                $_tz_class .= 'header-absolute ';
            }
        }
    }
    if($section_overflow == 'hidden'){
        $_tz_class .=' uk-overflow-hidden ';
    }
    if($background_effect){
        $_tz_class .=' bg-image-motion ';
    }
    if($vertical_align && $vertical_align=='middle'){
        $_tz_class .=' uk-flex-middle ';
    }
    if($vertical_align && $vertical_align=='bottom'){
        $_tz_class .=' uk-flex-bottom ';
    }
    if(isset($tz_class)){
        $tz_class   = $_tz_class.$tz_class;
    }else{
        $tz_class   = $_tz_class;
    }


    $_gutter            = '';
    $container_class    = 'uk-container';

    if($container_width == '' || $container_width == 'none'){
        $container_class    = '';
    }elseif($container_width != 'default'){
        $container_class    .= ' uk-container-'.$container_width;
    }elseif($container_width == 'custom'){
        $container_width    = 'custom-container';
    }

    if($container_width != '' && $container_width != 'none' && $container_width != 'expand') {
        $container_class .= $padding_remove_horizontal ? ' uk-padding-remove-horizontal' : '';
    }
    $container_class    .= !empty($container_width_expand)?' uk-container-expand-'.$container_width_expand:'';

    $_section_attributes   = '';
    switch($height) {
        case 'full':
            $_section_attributes = ' data-uk-height-viewport="offset-top: true;"';
            break;
        case 'percent':
            $_section_attributes = ' data-uk-height-viewport="offset-top: true; offset-bottom: 20;"';
            break;
        case 'section':
            $_section_attributes = ' data-uk-height-viewport="offset-top: true; offset-bottom: true;"';
            break;
        case 'expand':
            $_section_attributes = ' data-uk-height-viewport="expand: true;"';
            break;
    }

// phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped
?>
<section  <?php echo isset($tz_id)?' id="'.esc_attr($tz_id).'"':''; ?> class="<?php echo isset($tz_class)?esc_attr($tz_class):''; ?>"<?php
echo $_section_attributes;?>>
    <?php if(!empty($container_class)){ ?>
    <div class="<?php echo $container_class;?><?php
    echo isset($custom_container_class)?' '.$custom_container_class:'';?>">
    <?php }?>
    <?php echo $content; ?>
    <?php if(!empty($container_class)){ ?>
    </div><?php }
if($background_effect){
    echo '<div class="light-overlay"></div>';
}
if($decorative_background !='' && $decorative_background !='None' ){
?>
    <div class="background-banner uk-position-center-right">
        <canvas class="as-animation-background" data-type="<?php echo esc_attr($decorative_background);?>" data-color1="#666666" data-color2="#666666"></canvas>
    </div>
<?php
}
?>
</section>
<?php } }?>