<?php

defined('TEMPLAZA_FRAMEWORK') or exit();

use TemPlazaFramework\Functions;
use TemPlazaFramework\Templates;

$options        = Functions::get_theme_options();

if(isset($content) && !empty($content)){

    extract(shortcode_atts(array(
        'id'                    => uniqid(),
        'tz_id'                 => '',
        'tz_css'                => '',
        'tz_class'              => '',
        'widget_heading'        => 'h3',
        'widget_heading_style'  => '',
    ), $atts));

    $type = 'WP_Widget_Text';
    $args = array(
        'before_widget' => '<div class="widget widget-area %s">',
        'after_widget'  => '</div>',
        'before_title' => '<'.$widget_heading.' class="widgettitle'.($widget_heading_style?' uk-'.$widget_heading_style:'').'">',
        'after_title'  => '</'.$widget_heading.'>',
    );

    $atts['text']   = $content;
?>
<div<?php echo !empty($tz_id)?' id="'.esc_attr($tz_id).'"':''; ?> class="<?php
    echo !empty($tz_class)?esc_attr($tz_class):''; ?>">
    <?php
    the_widget( $type, $atts, $args );
    ?>
</div>
<?php } ?>