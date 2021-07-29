<?php

defined('TEMPLAZA_FRAMEWORK') or exit;

use TemPlazaFramework\Functions;

if(!class_exists('Templaza_Custom_Redux_Select')){
    class Templaza_Custom_Redux_Select{

        protected $redux_field_type = 'select';
        protected $tz_fields_object;

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

            add_filter("redux/{$this->args['opt_name']}/field/class/select", function($filter_path, $field){
                $_filter_path   = TEMPLAZA_FRAMEWORK_FIELD_PATH.'/select/override-redux-select.php';
                $filter_path    = file_exists($_filter_path)?$_filter_path:$filter_path;
                return $filter_path;
            }, 10, 2);

            add_filter("redux/{$this -> args['opt_name']}/field/class/{$this -> redux_field_type}",
                array($this, 'custom_enqueue_field'), 10, 2);

//            add_filter("redux/{$this -> args['opt_name']}/field/class/typography", array($this, 'custom_enqueue_field'), 10, 2);

            do_action('templaza-framework/override/redux-field/'.$this -> redux_field_type.'/hooks', $this);
        }

        public function custom_enqueue_field($filter_path, $field){
            if(wp_script_is('redux-field-'.$this -> redux_field_type.'-js') &&
                !wp_script_is('custom-redux-'.$this -> redux_field_type.'-js')) {
//            if(!wp_script_is('custom-redux-'.$this -> redux_field_type.'-js')) {
                $dep_array = array('redux-field-'.$this -> redux_field_type.'-js');
                wp_enqueue_script('custom-redux-'.$this -> redux_field_type.'-js', Functions::get_my_frame_url()
                    . "/fields/{$this -> redux_field_type}/custom-redux-{$this -> redux_field_type}.js", $dep_array, time(), true);
            }
            return $filter_path;
        }
    }
}