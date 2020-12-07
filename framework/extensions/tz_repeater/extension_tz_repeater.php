<?php

if(!class_exists('ReduxFramework_Extension_TZ_Repeater')) {
    class ReduxFramework_Extension_TZ_Repeater
    {
        public function __construct( $parent ) {
//            die(__METHOD__);

            $this->parent = $parent;
//            var_dump($this); die();
            $this->field_name = 'tz_repeater';
            add_filter( 'redux/' . $this->parent->args['opt_name'] . '/field/class/' . $this->field_name, array(
                &$this,
                'overload_field_path'
            ) ); // Adds the local field
        }

        // Forces the use of the embeded field path vs what the core typically would use
        public function overload_field_path( $field ) {
            return dirname( __FILE__ ) . '/' . $this->field_name . '/field_' . $this->field_name . '.php';
        }
    }
}