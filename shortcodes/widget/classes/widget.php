<?php

defined('TEMPLAZA_FRAMEWORK') or exit();

use TemPlazaFramework\Functions;

class TemplazaFramework_Widget_Shortcode_Helper{
    public static function get_widgets(){
        global $wp_widget_factory;

        $widgets = array();

        foreach( $wp_widget_factory->widgets as $widget ) {

//            $disabled_widgets = array('maxmegamenu');
            $disabled_widgets = array();

            $disabled_widgets = apply_filters( "templaza-framework/shortcode/widget/megamenu_incompatible_widgets", $disabled_widgets );

            if ( ! in_array( $widget->id_base, $disabled_widgets ) ) {
                $widgets[$widget->id_base] = $widget->name;

            }

        }

        uasort( $widgets, array( 'TemplazaFramework_Widget_Shortcode_Helper', 'sort_by_text' ) );

        return $widgets;
    }

    public static function get_widget_by_id_base($id_base){
        global $wp_widget_factory;
        if($wp_widget_factory -> widgets){
            foreach($wp_widget_factory -> widgets as $widget){
                if($widget -> id_base == $id_base){
                    return $widget;
                }
            }
        }
        return false;
    }

    /**
     * Returns the id_base value for a Widget ID
     *
     * @since 1.0
     */
    public static function get_id_base_for_widget_id( $widget_id ) {
        global $wp_registered_widget_controls;

        if ( ! isset( $wp_registered_widget_controls[ $widget_id ] ) ) {
            return false;
        }

        $control = $wp_registered_widget_controls[ $widget_id ];

        $id_base = isset( $control['id_base'] ) ? $control['id_base'] : $control['id'];

        return $id_base;

    }

    /**
     * Returns the name value for a Widget ID
     *
     * @since 1.0
     */
    public static function get_name_for_widget_id( $widget_id ) {
        global $wp_registered_widget_controls;

        if ( ! isset( $wp_registered_widget_controls[ $widget_id ] ) ) {
            return false;
        }

        $control = $wp_registered_widget_controls[ $widget_id ];

        $id_base = isset( $control['name'] ) ? $control['name'] : $control['id'];

        return $id_base;

    }
    /**
     * Returns the widget ID (number)
     *
     * @since 1.0
     * @param string $widget_id - id_base-ID (eg meta-3)
     * @return int
     */
    public static function get_widget_number_for_widget_id( $widget_id ) {

        $parts = explode( "-", $widget_id );

        return absint( end( $parts ) );

    }

    /**
     * Sorts a 2d array by the 'text' key
     *
     * @since 1.2
     * @param array $a
     * @param array $b
     */
    public static function sort_by_text( $a, $b ) {
        return strcmp( $a, $b );
    }
    /**
     * Returns the HTML for a single widget instance.
     *
     * @since 1.0
     * @param string widget_id Something like meta-3
     */
    public static function show_widget( $id, $args = array() ) {
        global $wp_registered_widgets;

        $default_args = array(
            'before_widget' => '<div class="widget widget-area %s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h3 class="widgettitle">',
            'after_title'   => '</h3>',
        );

        $args   = array_merge($default_args, $args);

        if(!isset($wp_registered_widgets[$id])){
            return '';
        }

        $widget = $wp_registered_widgets[$id];

        $params = array_merge(
            array( array_merge( array( 'widget_id' => $id, 'widget_name' => $widget['name'] ) ) ),
            (array) $widget['params']
        );

//        var_dump($widget); die();

//        $params[0]['id'] = 'mega-menu';
        $params[0]['before_title'] = apply_filters( 'templaza-framework/shortcode/widget/before_widget_title', $args['before_title'], $widget);
        $params[0]['after_title'] = apply_filters( 'templaza-framework/shortcode/widget/after_widget_title', $args['after_title'], $widget );
        $params[0]['before_widget'] = apply_filters( 'templaza-framework/shortcode/widget/before_widget', sprintf( $args['before_widget'], $widget['classname'] ), $widget );
        $params[0]['after_widget'] = apply_filters( 'templaza-framework/shortcode/widget/after_widget', $args['after_widget'], $widget );

//        if ( defined("MEGAMENU_DYNAMIC_SIDEBAR_PARAMS") && MEGAMENU_DYNAMIC_SIDEBAR_PARAMS ) {
//            $params[0]['before_widget'] = apply_filters( "megamenu_before_widget", '<div id="" class="">', $widget );
//            $params[0]['after_widget'] = apply_filters( "megamenu_after_widget", '</div>', $widget );
//
//            $params = apply_filters('dynamic_sidebar_params', $params);
//        }

        $callback = $widget['callback'];

        if ( is_callable( $callback ) ) {
            ob_start();
            call_user_func_array( $callback, $params );
            return ob_get_clean();
        }

    }
}