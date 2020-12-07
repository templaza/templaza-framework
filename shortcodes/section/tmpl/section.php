<?php
defined('TEMPLAZA_FRAMEWORK') or exit();

use TemPlazaFramework\Functions;

extract($atts);

$_tz_class  = '';

if(has_shortcode($content, 'templaza_header')){
    $options        = Functions::get_theme_options();
    $header         = isset($options['enable-header'])?(bool) $options['enable-header']:true;

    if($header){
        $_tz_class   .= ' templaza-header-section ';
    }
//    else{
//        return '';
//    }
}
if(isset($tz_class)){
    $tz_class   = $_tz_class.$tz_class;
}else{
    $tz_class   = $_tz_class;
}

//if(get_the_ID() == 186){
//    var_dump($content);
//}
if(!empty($content)){
?>
<section<?php echo isset($tz_id)?' id="'.$tz_id.'"':''; ?> class="<?php echo isset($tz_class)?trim($tz_class):''; ?>">
    <div class="<?php echo isset($layout_type)?$layout_type:'container';?><?php
    echo isset($custom_container_class)?' '.$custom_container_class:'';?>"><?php echo $content; ?></div>
</section>
<?php } ?>