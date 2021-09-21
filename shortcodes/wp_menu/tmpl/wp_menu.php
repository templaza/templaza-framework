<?php

defined('TEMPLAZA_FRAMEWORK') or exit();

use TemPlazaFramework\Functions;
use TemPlazaFramework\Templates;

extract(shortcode_atts(array(
    'id'                    => uniqid(),
    'tz_id'                 => '',
    'tz_css'                => '',
    'tz_class'              => '',
    'style'                 => '',
    'nav_menu'              => '',
    'enable_submenu'        => '',
    'widget_heading'        => 'h3',
    'widget_heading_style'  => '',
), $atts));

if ($nav_menu){

    $options    = Functions::get_theme_options();

    $type = 'WP_Nav_Menu_Widget';
    $args = array(
        'before_title' => '<'.$widget_heading.' class="widgettitle'.($widget_heading_style?' uk-'.$widget_heading_style:'').'">',
        'after_title'  => '</'.$widget_heading.'>'
    );

    if($style == 'ui_accordion') {
        $args['templaza_wp_menu_shortcode_submenu_attributes'] = array(
            'data-uk-nav' => 'toggle: > a > .nav-item-caret'
        );
        $args['items_wrap']    = '<ul id="%1$s" class="%2$s" data-uk-nav="toggle: > a > .nav-item-caret">%3$s</ul>';
        $args['templaza_wp_menu_shortcode_after_title'] = '<i class="uk-float-right nav-item-caret"></i>';
    }

    global $wp_widget_factory;
    // to avoid unwanted warnings let's check before using widget
    if ( is_object( $wp_widget_factory ) && isset( $wp_widget_factory->widgets, $wp_widget_factory->widgets[ $type ] ) ) {
?>
<div<?php echo !empty($tz_id)?' id="'.esc_attr($tz_id).'"':''; ?> class="<?php
    echo !empty($tz_class)?esc_attr($tz_class):''; ?>">
    <aside id="widget-area-<?php echo $id; ?>" class="widget-area">
    <?php
        the_widget( $type, $atts, $args );
    ?>
    </aside>
</div>
    <?php
    }
}
?>
