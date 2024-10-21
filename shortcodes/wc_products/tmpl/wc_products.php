<?php

defined('TEMPLAZA_FRAMEWORK') or exit();

use TemPlazaFramework\Functions;
use TemPlazaFramework\Templates;

$options    = Functions::get_theme_options();

    $type = 'WC_Widget_Products';
    $args = array();

    $widget_heading = isset($atts['widget_heading'])?$atts['widget_heading']:'h3';

    $atts['before_title']   = '<'.$widget_heading.' class="widgettitle">';
    $atts['after_title']    = '</'.$widget_heading.'>';

    global $wp_widget_factory;

    if(isset($atts['show']) && $atts['show']){
        $atts['show']   = '';
    }

    // to avoid unwanted warnings let's check before using widget
    if ( is_object( $wp_widget_factory ) && isset( $wp_widget_factory->widgets, $wp_widget_factory->widgets[ $type ] ) ) {
?>
<div<?php echo isset($atts['tz_id'])?' id="'.esc_attr($atts['tz_id']).'"':''; ?> class="<?php
    echo isset($atts['tz_class'])?esc_attr(trim($atts['tz_class'])):''; ?>">
    <aside id="widget-area-<?php echo esc_attr($atts['id']); ?>" class="widget-area">
    <?php
        the_widget( $type, $atts, $args );
    ?>
    </aside>
</div>
    <?php
    }
?>
