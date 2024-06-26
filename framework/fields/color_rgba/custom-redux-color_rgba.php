<?php

defined('TEMPLAZA_FRAMEWORK') or exit;

use TemPlazaFramework\Functions;

//$field_class = Redux_Functions::class_exists_ex( $field_classes );
if(!Redux_Functions::class_exists_ex( array('Redux_Color_Rgba') )){
    require_once Redux_Core::$dir .'inc/fields/color_rgba/class-redux-color-rgba.php';
}


if(!class_exists('Templaza_Custom_Redux_Color_Rgba')){

    class Templaza_Custom_Redux_Color_Rgba  extends Redux_Color_Rgba{

        protected $redux_field_type = 'color_rgba';
        protected $args = array();
        protected $units;
        protected $redux_framework;
        protected $tz_fields_object;

        public function __tz_init($args = array(),  $field_object = null){
            $this -> args               = $args;
            $this -> tz_fields_object   = $field_object;
            if(isset($args['opt_name']) && $args['opt_name']){
                $this -> redux_framework    = \Redux::instance($args['opt_name']);
            }

            $this -> hooks();
        }

        protected function hooks(){
            add_filter("redux/{$this -> args['opt_name']}/field/class/{$this -> redux_field_type}",
                array($this, 'custom_enqueue_field'), 10, 2);

            add_action("redux/field/{$this ->args['opt_name']}/{$this -> redux_field_type}/render/before",
                array($this, 'custom_before_render_field'), 10, 2);
            add_filter("redux/field/{$this -> args['opt_name']}/{$this -> redux_field_type}/render/after",
                array($this, 'custom_render_field'), 10, 2);

            do_action('templaza-framework/override/redux-field/'.$this -> redux_field_type.'/hooks', $this);
        }

        public function set_defaults(){
            parent::set_defaults();

            /* Attributes added by templaza framework */
            $custom_option_defaults = array(
                'choose_color'  => false,
                'allow_global'  => true
            );

            $this->field['options']    = isset($this -> field['options'])?array_merge( $this->field['options'], $custom_option_defaults ):$custom_option_defaults;

         }

        public function custom_before_render_field(&$field, &$value){
            $this -> set_defaults();
            $this->value = wp_parse_args($value, $this->value);

            if(!is_array($value) && empty($value)) {
                $this -> value  = array();
            }
        }

        public function custom_render_field($_render, $field){

            $this -> field = wp_parse_args( $field, $this -> field );

            $file   = TEMPLAZA_FRAMEWORK_FIELD_PATH.'/'.$this -> redux_field_type.'/tmpl/'
                .$this -> redux_field_type.'.php';
            if(file_exists($file)){
                ob_start();
                require $file;
                $_render    = ob_get_contents();
                ob_end_clean();
            }

            return $_render;
        }

        public function custom_enqueue_field($filter_path, $field){
            $org_field_type = str_replace('_', '-', $this -> redux_field_type);
            if((wp_script_is('redux-field-'.$org_field_type)
                    || wp_script_is('redux-field-'.$org_field_type.'-js')) &&
                !wp_script_is('custom-redux-'.$this -> redux_field_type)) {

                if(wp_script_is('redux-field-'.$org_field_type)){
                    $dep_array = array('redux-field-' . $org_field_type);
                }elseif(wp_script_is('redux-field-'.$org_field_type.'-js')) {
                    $dep_array = array('redux-field-' . $org_field_type . '-js');
                }

                wp_enqueue_script('custom-redux-'.$this -> redux_field_type, Functions::get_my_frame_url()
                    . "/fields/{$this -> redux_field_type}/custom-redux-{$this -> redux_field_type}.js", $dep_array, time(), true);
            }
            return $filter_path;
        }
    }
}