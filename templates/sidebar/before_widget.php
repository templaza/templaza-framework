<?php

defined('TEMPLAZA_FRAMEWORK') or exit();

use TemPlazaFramework\Functions;

$options    = array();
if(class_exists('TemPlazaFramework\Functions')) {
    $options = Functions::get_theme_options();
}
$widget_heading_style  = isset($options['widget_box_heading_style'])?$options['widget_box_heading_style']:'style1';
?>
<div class="widget %2$s <?php echo $widget_heading_style; ?>"><div class="widget-content">