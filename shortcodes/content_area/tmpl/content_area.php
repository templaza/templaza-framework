<?php

defined('TEMPLAZA_FRAMEWORK') or exit();

use TemPlazaFramework\Functions;
use TemPlazaFramework\Templates;

$options        = Functions::get_theme_options();

$var        = get_query_var('templaza_framework_var');
$file_name  = ($var && isset($var['theme_file_name']))?$var['theme_file_name']:'index';

// Check file exists in sub folder
$path       = Templates::load_my_layout('theme_pages.'.$file_name.'.'.get_post_type(), false);

if(!$path){
    $path   = Templates::load_my_layout('theme_pages.'.$file_name, false);
}

if(file_exists($path)){
    ob_start();

    require_once $path;
    $theme_page_html    = ob_get_contents();
    ob_end_clean();

    $theme_page_html    = trim($theme_page_html);
    if(!empty($theme_page_html)){
?>
    <div<?php echo isset($atts['tz_id'])?' id="'.$atts['tz_id'].'"':''; ?> class="<?php
    echo isset($atts['tz_class'])?trim($atts['tz_class']):''; ?>">
    <?php echo $theme_page_html; ?>
    </div>
    <?php } ?>
<?php } ?>
