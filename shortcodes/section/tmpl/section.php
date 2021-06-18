<?php
defined('TEMPLAZA_FRAMEWORK') or exit();

use TemPlazaFramework\Functions;

extract(shortcode_atts(array(
    'tz_id'                  => '',
    'tz_class'               => '',
    'section_type'           => 'default',
    'layout_type'            => 'container',
    'custom_container_class' => '',
), $atts));

if(!empty($content)){

    $_tz_class  = '';

    if(has_shortcode($content, 'templaza_header')){
        $options        = Functions::get_theme_options();
        $header         = isset($options['enable-header'])?filter_var($options['enable-header'],FILTER_VALIDATE_BOOLEAN):true;

        if($header){
            $header_absolute = isset($options['header-absolute'])?(bool) $options['header-absolute']:false;
            $_tz_class  .= ' templaza-header-section ';
            if($header_absolute) {
                $_tz_class .= 'header-absolute ';
            }
        }
    }
    if(isset($tz_class)){
        $tz_class   = $_tz_class.$tz_class;
    }else{
        $tz_class   = $_tz_class;
    }

    if(isset($section_type) && $section_type !== 'default'){
        $tz_class   .= ' '.$section_type;
    }

    $_gutter        = '';
    $_layout_type   = 'container';
    switch ($layout_type){
        case 'container':
        case 'container-fluid':
            $_layout_type   = $layout_type;
            break;
        case 'container-fluid-with-no-gutters':
            $_layout_type   = 'container-fluid';
            break;
    }
?>
<section<?php echo isset($tz_id)?' id="'.$tz_id.'"':''; ?> class="<?php echo isset($tz_class)?esc_attr($tz_class):''; ?>">
    <?php if($layout_type != 'no-container'){ ?>
    <div class="<?php echo $_layout_type;?><?php
    echo isset($custom_container_class)?' '.$custom_container_class:'';?>">
    <?php }?>
    <?php echo $content; ?>
    <?php if($layout_type != 'no-container'){ ?></div><?php } ?>
</section>
<?php } ?>