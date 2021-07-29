<?php

defined('TEMPLAZA_FRAMEWORK') or exit;

use TemPlazaFramework\Functions;

if(!class_exists('Templaza_Custom_Redux_Spinner')){
    class Templaza_Custom_Redux_Spinner{

        protected $redux_field_type = 'spinner';

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
            add_filter("redux/field/{$this -> args['opt_name']}/{$this -> redux_field_type}/render/after", array($this, 'custom_render_field'), 10, 2);

            do_action('templaza-framework/override/redux-field/'.$this -> redux_field_type.'/hooks', $this);
        }

        public function custom_render_field($_render, $field){

            // Fix error attrib don't have ' or " character
            if(!preg_match('/data-val=["|\']/i', $_render)){
                $_render    = preg_replace('/(data-val=)(.*?)\s/i','$1"$2" ', $_render);
            }

            return $_render;
        }
    }
}