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

//    WP_Nav_Menu_Widget::
    $type = 'WP_Nav_Menu_Widget';
    $args = array();
    add_filter('widget_nav_menu_args', function ($args) use ($enable_submenu, $style) {
        if(!$enable_submenu){
            $args['depth']  = 1;
        }
        $menu_class                 = $style?'menu tz-menu-'.$style:'menu tz-menu-horizontal';
        $args['menu_class']         = $menu_class;
        $args['container_class']    = 'widget-content';
        if($style == 'ui_accordion'){
            $args['items_wrap'] = '<ul id="%1$s" class="%2$s uk-nav-parent-icon" data-uk-nav>%3$s</ul>';
        }
        return $args;
    });

        add_filter( 'nav_menu_css_class', function ( $classes )use($style){
            if($style == 'ui_accordion'){
                if(in_array('menu-item-has-children', $classes)){
                    $classes[]  = 'uk-parent';
                }
            }
            return $classes;
        }, 10 );
        add_filter( 'nav_menu_submenu_css_class', function ( $classes )use($style){
            if($style == 'ui_accordion'){
                $classes[]  = 'uk-nav-sub';
            }
            return $classes;
        }, 10 );
        add_filter( 'templaza-framework/walker/megamenu/megamenu_nav_menu_item_id', function ( $id )use($style){
            if($style == 'ui_accordion'){
                $id = '';
            }
            return $id;
        }, 10 );


    $args['before_title']   = '<'.$widget_heading.' class="widgettitle'.($widget_heading_style?' uk-'.$widget_heading_style:'').'">';
    $args['after_title']    = '</'.$widget_heading.'>';

    global $wp_widget_factory;
    // to avoid unwanted warnings let's check before using widget
    if ( is_object( $wp_widget_factory ) && isset( $wp_widget_factory->widgets, $wp_widget_factory->widgets[ $type ] ) ) {
?>
<div<?php echo $tz_id?' id="'.$tz_id.'"':''; ?> class="<?php
    echo $tz_class?trim($tz_class):''; ?>">
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
