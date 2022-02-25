<?php

defined('TEMPLAZA_FRAMEWORK') or exit;

use TemPlazaFramework\Functions;

//$field_class = Redux_Functions::class_exists_ex( $field_classes );
if(!Redux_Functions::class_exists_ex( array('Redux_Spacing') )){
    require_once Redux_Core::$dir .'inc/fields/spacing/class-redux-spacing.php';
}


if(!class_exists('Templaza_Custom_Redux_Spacing')){
    class Templaza_Custom_Redux_Spacing  extends Redux_Spacing{

        protected $redux_field_type = 'spacing';
        protected $args = array();
        protected $units;
        protected $value_tmp;
        protected $redux_framework;
        protected $tz_fields_object;
//        protected $select2_config;

        public function __tz_init($args = array(),  $field_object = null){
            $this -> args               = $args;
            $this -> tz_fields_object   = $field_object;
            $this -> text_domain        = Functions::get_my_text_domain();
            if(isset($args['opt_name']) && $args['opt_name']){
                $this -> redux_framework    = \Redux::instance($args['opt_name']);
            }

            $this -> hooks();
        }

        protected function hooks(){
            add_filter("redux/{$this -> args['opt_name']}/field/class/{$this -> redux_field_type}",
                array($this, 'custom_enqueue_field'), 10, 2);

            add_action("redux/field/{$this ->args['opt_name']}/spacing/render/before", array($this, 'custom_before_render_field'), 10, 2);
            add_filter("redux/field/{$this -> args['opt_name']}/spacing/render/after", array($this, 'custom_render_field'), 10, 2);

            do_action('templaza-framework/override/redux-field/'.$this -> redux_field_type.'/hooks', $this);
        }

        public function custom_before_render_field(&$field, &$value){
            if((isset($field['allow_responsive']) && $field['allow_responsive']) ||
                (isset($field['mode']) && !in_array($field['mode'], array('absolute', 'margin', 'padding')))) {
                if(is_array($value)) {
                    $this->value_tmp = $value;
                    $value['units'] = 'px';
                }
                $this -> value      = $value;
            }
        }

        public function custom_render_field($_render, $field){
            if((isset($field['allow_responsive']) && $field['allow_responsive']) ||
                (isset($field['mode']) && !in_array($field['mode'], array('absolute', 'margin', 'padding')))) {

                $this -> _init_field($field);
                if(isset($this -> value_tmp) && !empty($this -> value_tmp)) {
                    $this->value = $this->value_tmp;
                }

                $file   = TEMPLAZA_FRAMEWORK_FIELD_PATH.'/spacing/tmpl/spacing.php';
                if(file_exists($file)){
                    ob_start();
                    require $file;
                    $_render    = ob_get_contents();
                    ob_end_clean();
                }
            }

            return $_render;
        }

        public function custom_enqueue_field($filter_path, $field){
            if(wp_script_is('redux-field-'.$this -> redux_field_type.'-js') &&
                !wp_script_is('custom-redux-'.$this -> redux_field_type.'-js')) {
                $dep_array = array('redux-field-'.$this -> redux_field_type.'-js');
                wp_enqueue_script('custom-redux-'.$this -> redux_field_type.'-js', Functions::get_my_frame_url()
                    . "/fields/{$this -> redux_field_type}/custom-redux-{$this -> redux_field_type}.js", $dep_array, time(), true);
            }
            return $filter_path;
        }

        protected function _init_field($field){

            $defaults = array(
                'units'           => 'px',
                'mode'            => 'padding',
                'top'             => true,
                'bottom'          => true,
                'all'             => false,
                'left'            => true,
                'right'           => true,
                'units_extended'  => false,
                'display_units'   => true,
                // Custom position when you want to change original position
                'custom_position' => array(
//                    'top'          => 'top-left',
//                    'right'        => 'top-right',
//                    'bottom'       => 'bottom-right',
//                    'left'         => 'bottom-left',
                ),
                'hint'           => array(
                    'all'    => esc_html__('All', $this -> text_domain),
                    'top'    => esc_html__('Top', $this -> text_domain),
                    'bottom' => esc_html__('Bottom', $this -> text_domain),
                    'left'   => esc_html__('Left', $this -> text_domain),
                    'right'  => esc_html__('Right', $this -> text_domain),
                ),
            );

            $this -> field = wp_parse_args( $field, $defaults );

            // Set value defaults.
            $defaults = array(
                'top'    => '',
                'right'  => '',
                'bottom' => '',
                'left'   => '',
                'units'  => '',
            );

            $this->value = wp_parse_args( $this -> value, $defaults );

            if ( empty( $this -> field['units'] )
                || ($this -> units && !empty($this -> field['units']) && !is_array($this -> field['units'])
                    && ! in_array( $this -> field['units'], $this -> units, true )) ) {
                $this -> field['units'] = 'px';
            }
        }

        protected function devices(){

            $devices    = array(
                'xlarge' => array(
                    'title'=> esc_html__('Large Screen', $this -> text_domain),
//                    'icon' => 'dashicons dashicons-desktop',
                    'uk-icon' => 'tv',
                ),
                'desktop' => array(
                    'title'=> esc_html__('Desktop', $this -> text_domain),
                    'icon' => 'dashicons dashicons-desktop',
                    'uk-icon' => 'desktop',
                ),
                'laptop' => array(
                    'title'=> esc_html__('Laptop', $this -> text_domain),
                    'icon' => 'dashicons dashicons-laptop',
                    'uk-icon' => 'laptop',
                ),
                'tablet'  => array(
                    'title'=> esc_html__('Tablet', $this -> text_domain),
                    'icon' => 'dashicons dashicons-tablet',
                    'uk-icon' => 'tablet',
                ),
                'mobile'  => array(
                    'title'=> esc_html__('Mobile', $this -> text_domain),
                    'icon' => 'dashicons dashicons-smartphone',
                    'uk-icon' => 'phone',
                ),
            );
            return $devices;
        }
    }
}