<?php

defined('TEMPLAZA_FRAMEWORK') or exit();

use TemPlazaFramework\Functions;
use TemPlazaFramework\Templates;

$options    = Functions::get_theme_options();

$type = 'WP_Widget_Tag_Cloud';
$args = array(
    'before_widget' => '<div class="widget widget-area %s">',
    'after_widget'  => '</div>',
    'before_title'  => '<h3 class="widgettitle">',
    'after_title'   => '</h3>',
);

global $wp_widget_factory;
// to avoid unwanted warnings let's check before using widget
if ( is_object( $wp_widget_factory ) && isset( $wp_widget_factory->widgets, $wp_widget_factory->widgets[ $type ] ) ) {
?>

<div<?php echo isset($atts['tz_id'])?' id="'.$atts['tz_id'].'"':''; ?> class="<?php
    echo isset($atts['tz_class'])?trim($atts['tz_class']):''; ?>">
    <?php
        the_widget( $type, $atts, $args );
        ?>
</div>
<?php } ?>