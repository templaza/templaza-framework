<?php

use TemPlazaFramework\Core\Fields;

defined('TEMPLAZA_FRAMEWORK') or exit();


// Don't duplicate me!
if ( ! class_exists( 'Templaza_API', false ) ) {
    class Templaza_API extends Redux {

//        /**
//         *  Option fields.
//         *
//         * @var array
//         */
//        public static $fields = array();

        /**
         * Option original sections.
         *
         * @var array
         */
        public static $org_sections = array();
//        /**
//         *  Option fields.
//         *
//         * @var array
//         */
//        public static $fields = array();
//
//        /**
//         * Extension list.
//         *
//         * @var array
//         */
//        public static $extensions = array();
//
//        public static function set_sections( $opt_name = '', $sections = array() ) {
//            if ( empty( $sections ) || '' === $opt_name ) {
//                return;
//            }
//
//            self::check_opt_name( $opt_name );
//
//            Redux_Functions_Ex::record_caller( $opt_name );
//
//            if ( ! empty( $sections ) ) {
//                foreach ( $sections as $section ) {
//                    self::set_section( $opt_name, $section );
//                }
//            }
//        }

//        public static function set_section( $opt_name = '', $section = array(), $replace = false ) {
//            if(!isset(self::$org_sections[$opt_name])){
//                self::$org_sections[$opt_name]  = array();
//            }
//            self::$org_sections[$opt_name][]  = $section;
//            parent::set_section($opt_name, $section, $replace);
////            remove_action( 'after_setup_theme', array( 'Redux', 'create_redux' ) );
////            remove_action( 'init', array( 'Redux', 'create_redux' ) );
////            remove_action( 'setup_theme', array( 'Redux', 'create_redux' ) );
//            if(isset(Redux::$init[ $opt_name ])) {
//////                unset(Redux::[$opt_name]);
//                unset(Redux::$init[$opt_name]);
//            }
////            unset(self::)
//        }
//        public static function create_redux() {
//            return;
////            foreach ( self::$sections as $opt_name => $the_sections ) {
////                if ( ! empty( $the_sections ) ) {
////                    if ( ! self::$init[ $opt_name ] ) {
////                        self::loadRedux( $opt_name );
////                    }
////                }
////            }
//        }
//        public static function get_org_sections( $opt_name = '' ){
//            if ( ! empty( self::$org_sections[ $opt_name ] ) ) {
//                return self::$org_sections[ $opt_name ];
//            }
//
//            return array();
//        }
//        public static function get_org_sections( $opt_name = '' ){
//            if ( ! empty( self::$org_sections[ $opt_name ] ) ) {
//                return self::$org_sections[ $opt_name ];
//            }
//
//            return array();
//        }
//

        public static function construct_sections( $opt_name ) {
            $sections   = parent::construct_sections($opt_name);

            unset(\Redux::$sections[$opt_name]);

            return $sections;
        }


        /**
         * Sets a single option panel section.
         *
         * @param string $opt_name Panel opt_name. Default is post_type
         * @param string $parent_section_id Main section id.
         * @param array  $section  Section data.
         * @param bool   $replace  Replaces section instead of creating a new one.
         */
        public static function set_subsection( $opt_name = '', $parent_section_id = '', $section = array(), $replace = false, $position = 'last' ) {
            self::set_section($opt_name, $section, $replace);

            if(self::$sections && isset(self::$sections[$opt_name]) && isset(self::$sections[$opt_name][$parent_section_id])) {
                $sections   = self::$sections[$opt_name];
                $sec_keys   = array_keys($sections);
                $sec_key    = array_search($parent_section_id, $sec_keys);

                $cur_section    = $sections[$section['id']];
                unset($sections[$section['id']]);

                if($sec_key !== false) {
                    if($position != 'first'){

                        // Get next key
                        if(isset($sec_keys[$sec_key + 1])){
                            $key_next   = $sec_keys[$sec_key + 1];
                        }

                        // Increase position if main section have subsections
                        $i  = 0;
                        while(isset($key_next) && isset($sections[$key_next]['subsection']) && $sections[$key_next]['subsection']){
                            if(is_numeric($position) && $position == $i){
                                break;
                            }
                            $sec_key++;
                            $i++;
                            if(isset($sec_keys[$sec_key + 1])){
                                $key_next   = $sec_keys[$sec_key + 1];
                            }
                        }
                    }

                    // Extract sections to 2 parts
                    $first_array    = array_splice ($sections, 0, $sec_key + 1);
                    $last           = end($first_array);

                    $cur_section['priority']    = $last['priority'] + 1;
                    $_sec[$section['id']]       = $cur_section;

                    // Reorder priority of last array
                    foreach ($sections as $k => &$val){
                        if(isset($val['priority'])) {
                            $val['priority']++;
                        }
                    }

                    $sections = array_merge ($first_array, $_sec, $sections);

                    self::$sections[$opt_name] = $sections;
                }
            }
        }


        /**
         * Sets all fields in path.
         *
         * @param string $opt_name Panel opt_name.
         * @param string $path     Path to extension folder.
         * @param bool   $force    Make extension reload.
         */
        public static function load_my_fields($opt_name = '')
        {
            // Load custom fields
            if(!class_exists('Fields')){
                require_once TEMPLAZA_FRAMEWORK_FIELD_PATH.'/fields.php';
            }
            $fields = new Fields(\Redux::construct_args($opt_name));
        }

        public static function load() {
            remove_action( 'after_setup_theme', array( 'Redux', 'create_redux' ) );
            remove_action( 'init', array( 'Redux', 'create_redux' ) );
            remove_action( 'setup_theme', array( 'Redux', 'create_redux' ) );
        }
    }
    Templaza_API::load();
}