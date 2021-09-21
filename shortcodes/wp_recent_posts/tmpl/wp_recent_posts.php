<?php

defined('TEMPLAZA_FRAMEWORK') or exit();

use TemPlazaFramework\Functions;
use TemPlazaFramework\Templates;

extract(shortcode_atts(array(
    'id'                    => uniqid(),
    'tz_id'                 => '',
    'tz_css'                => '',
    'tz_class'              => '',
    'widget_heading'        => 'h3',
    'widget_heading_style'  => '',
), $atts));

$options    = Functions::get_theme_options();

$type = 'WP_Widget_Recent_Posts';
$args = array(
    'before_widget' => '<div class="widget widget-area %s">',
    'after_widget'  => '</div>',
    'before_title' => '<'.$widget_heading.' class="widgettitle'.($widget_heading_style?' uk-'.$widget_heading_style:'').'">',
    'after_title'  => '</'.$widget_heading.'>'
);

global $wp_widget_factory;
// to avoid unwanted warnings let's check before using widget

if ( is_object( $wp_widget_factory ) && isset( $wp_widget_factory->widgets, $wp_widget_factory->widgets[ $type ] ) ) {
    ?>

<div<?php echo !empty($tz_id)?' id="'.esc_attr($tz_id).'"':''; ?> class="<?php
    echo !empty($tz_class)?esc_attr($tz_class):''; ?>">
    <?php the_widget( $type, $atts, $args ); ?>
</div>
<?php } ?>
