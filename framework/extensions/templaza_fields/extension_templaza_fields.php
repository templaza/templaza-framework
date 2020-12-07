<?php

defined('TEMPLAZA_FRAMEWORK') or exit;

if(!class_exists('ReduxFramework_Extension_Templaza_Fields')) {
    class ReduxFramework_Extension_Templaza_Fields extends Redux_Extension_Abstract
    {
        public static $version = '1.0.0';
        private $extension_name = 'Templaza Fields';
        private $minimum_redux_version = '4.0.0';
        public function __construct( $parent ) {
            parent::__construct( $parent, __FILE__ );

            if ( is_admin() && ! $this->is_minimum_version( $this->minimum_redux_version, self::$version, $this->extension_name ) ) {
                return;
            }

//            $this->add_field( 'tz_tab' );
//            $this->add_field( 'tz_layout' );
        }

//        public function __construct( $parent, $file = '' ) {
//
//            $this->parent = $parent;
//            $my_class   = strtolower(__CLASS__);
//            $this -> field_name = str_replace('reduxframework_extension_','', $my_class);
////            require_once __DIR__.'/inc/helper.php';
//
////            // Load custom core fields
////            require_once ( ABSPATH . '/wp-admin/includes/file.php' );
////            $fieldPath  = TEMPLAZA_FRAMEWORK_FIELD_PATH;
////            $fieldPath  = trailingslashit($fieldPath);
////
////            if(is_dir($fieldPath)){
////                $files  = list_files($fieldPath, 1);
////                if($files && count($files)){
////                    foreach($files as $f){
////                        if(!is_dir($f)){
////                            continue;
////                        }
////                        $fName  = basename($f);
////                        $fFile  = $f.'field_'.$fName.'.php';
////                        if(file_exists($fFile)){
////                            add_filter( 'redux/' . $parent->args['opt_name'] . '/field/class/' . $fName,function($field) use ($fFile){
////                                return $fFile;
////                            }); // Adds the local field
////
////                        }
////                    }
////                }
////            }
////            add_filter( 'redux/' . $this->parent->args['opt_name'] . '/field/class/' . $this->field_name, array(
////                &$this,
////                'overload_field_path'
////            ) ); // Adds the local field
//        }

//        // Forces the use of the embeded field path vs what the core typically would use
//        public function overload_field_path( $field ) {
//            return dirname( __FILE__ ) . '/' . $this->field_name . '/field_' . $this->field_name . '.php';
//        }

    }
}