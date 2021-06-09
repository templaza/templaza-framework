<?php

defined('TEMPLAZA_FRAMEWORK') or exit();

use TemPlazaFramework\Functions;
use TemPlazaFramework\Templates;

$options        = Functions::get_theme_options();

$file_name  = apply_filters('templaza-framework/shortcode/content_area/theme_file', 'index');

if(!is_file($file_name)){
    // Check file exists in sub folder
    $path       = Templates::load_my_layout('theme_pages.'.$file_name.'.'.get_post_type(), false);

    if(!$path){
        $path   = Templates::load_my_layout('theme_pages.'.$file_name, false);
    }
}else{
    $path   = $file_name;
}

if(file_exists($path)){
    extract(shortcode_atts(array(
        'id'                  => '',
        'tz_id'                  => '',
        'tz_class'               => '',
        'section_type'           => 'default',
        'layout_type'            => 'container',
        'custom_container_class' => '',
    ), $atts));

    ob_start();

    require_once $path;
    $theme_page_html    = ob_get_contents();
    ob_end_clean();

    $theme_page_html    = trim($theme_page_html);
    if(!empty($theme_page_html)){
?>
    <div<?php echo !empty($tz_id)?' id="'.esc_attr($tz_id).'"':''; ?> class="<?php
    echo esc_attr($tz_class); ?>">
    <?php echo $theme_page_html; ?>
    </div>
    <?php } ?>
<?php } ?>
