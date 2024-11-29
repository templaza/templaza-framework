<?php

defined('TEMPLAZA_FRAMEWORK') or exit;

use TemPlazaFramework\Functions;

if(!class_exists('Templaza_Custom_Redux_Switch')){
    class Templaza_Custom_Redux_Switch{

        protected $redux_field_type = 'switch';
        protected $tz_fields_object;
        protected $args;
        protected $redux_framework;

        public function __tz_init($args = array(),  $field_object = null){
            $this -> args               = $args;
            $this -> tz_fields_object   = $field_object;

            if(isset($args['opt_name']) && $args['opt_name']){
                $this -> redux_framework    = \Redux::instance($args['opt_name']);
            }

            $this -> hooks();
        }

        protected function hooks(){
            add_action('admin_enqueue_scripts', array($this, 'custom_enqueues'), 10, 2);

            do_action('templaza-framework/override/redux-field/'.$this -> redux_field_type.'/hooks', $this);
        }

        public function custom_enqueues(){
            if((wp_script_is('redux-field-'.$this -> redux_field_type)
                    || wp_script_is('redux-field-'.$this -> redux_field_type.'-js')) &&
                !wp_script_is('custom-redux-'.$this -> redux_field_type.'-js')) {

                if(wp_script_is('redux-field-'.$this -> redux_field_type)){
                    $dep_array = array('redux-field-' . $this->redux_field_type);
                }elseif(wp_script_is('redux-field-'.$this -> redux_field_type.'-js')) {
                    $dep_array = array('redux-field-' . $this->redux_field_type . '-js');
                }
                wp_enqueue_script('custom-redux-'.$this -> redux_field_type, Functions::get_my_frame_url()
                    . "/fields/{$this -> redux_field_type}/custom-redux-{$this -> redux_field_type}.js", $dep_array, time(), true);

            }
        }
    }
}