<?php

defined('TEMPLAZA_FRAMEWORK') or exit;

if(!class_exists('ReduxFramework_Extension_TZ_Column')) {
    class ReduxFramework_Extension_TZ_Column
    {
        public function __construct( $parent ) {

            $this->parent = $parent;
            $my_class   = strtolower(__CLASS__);
            $this -> field_name = str_replace('reduxframework_extension_','', $my_class);
            require_once __DIR__.'/inc/helper.php';
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