<?php

defined('TEMPLAZA_FRAMEWORK') or exit();

use TemPlazaFramework\Functions;
use TemPlazaFramework\Templates;

extract(shortcode_atts(array(
    'tz_id'          => '',
    'tz_class'       => '',
    'widget'         => '',
    'widget_id'      => '',
    'widget_heading' => '',
    'widget_heading_style'  => '',
), $atts));

$options    = Functions::get_theme_options();

$html   = TemplazaFramework_Widget_Shortcode_Helper::show_widget($widget_id, array(
    'before_title' => '<'.$widget_heading.' class="widgettitle'.($widget_heading_style?' uk-'.$widget_heading_style:'').'">',
    'after_title'  => '</'.$widget_heading.'>',
));

if(!empty($html)){
?>
<div<?php echo !empty($tz_id)?' id="'.esc_attr($tz_id).'"':''; ?> class="<?php
    echo !empty($tz_class)?esc_attr($tz_class):''; ?>">
    <?php echo trim($html); ?>
</div>
<?php } ?>