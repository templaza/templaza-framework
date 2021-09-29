<?php

use TemPlazaFramework\Core\Fields;

defined('TEMPLAZA_FRAMEWORK') or exit();


// Don't duplicate me!
if ( ! class_exists( 'Templaza_API', false ) ) {
    class Templaza_API extends Redux {

        /**
         * Option original sections.
         *
         * @var array
         */
        public static $org_sections = array();

        public static function construct_sections(string $opt_name ): array {
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
         * Add an argument for a field.
         *
         * @param string $opt_name Panel opt_name.
         * @param string|int $section_id Section ID this field belongs to.
         * @param string $field_id Field ID.
         * @param string $name Argument name this field belongs to.
         * @param string| $value Argument value this field belongs to.
         */
        public static function add_field_single_argument($opt_name = '', $section_id = '', $field_id = '',
                                                         $name = '', $value = ''){
            if ( '' === $opt_name || '' === $section_id  || '' === $field_id || '' === $name ) {
                return;
            }

            self::check_opt_name( $opt_name );

            if(!isset(self::$fields[$opt_name][$field_id])){
                return;
            }

            $field  = self::$fields[$opt_name][$field_id];

            if(isset($field[$name]) && is_array($field[$name])){
                $field[$name]   = array_merge($field[$name], (array) $value);
            }else {
                $field[$name] = $value;
            }

            self::$fields[$opt_name][$field_id] = $field;
        }


        /**
         * Add arguments for a field.
         *
         * @param string $opt_name Panel opt_name.
         * @param string|int $section_id Section ID this field belongs to.
         * @param string $field_id Field ID.
         * @param array $field_args Arguments this field belongs to.
         */
        public static function add_field_argument($opt_name = '', $section_id = '', $field_id = '', $field_args = array()){
            if (!is_array($field_args) || empty($field_args) || '' === $opt_name
                || '' === $section_id  || '' === $field_id ) {
                return;
            }

            foreach ($field_args as $name => $value){
                self::add_field_single_argument($opt_name, $section_id, $field_id, $name, $value);
            }
        }

        /**
         * Add multiple arguments for multiple fields.
         *
         * @param string $opt_name Panel opt_name.
         * @param string|int $section_id Section ID this field belongs to.
         * @param array $field_args Multiple field arguments.
         */
        public static function add_field_arguments($opt_name = '', $section_id = '', $field_args = array()){
            if ( !is_array($field_args) || empty( $field_args ) || '' === $opt_name || '' === $section_id  ) {
                return;
            }

            foreach($field_args as $field_id => $fargs){
                self::add_field_argument($opt_name, $section_id, $field_id, $fargs);
            }
        }

        /**
         * Insert an option panel field and adds to a section.
         *
         * @param string     $opt_name   Panel opt_name.
         * @param string|int $section_id Section ID this field belongs to.
         * @param string     $field_id   Field ID.
         * @param array      $field      Field data.
         * @param array      $pos        Insert new field to "before" or "after" field with field_id.
         *                               Default: after.
         */
        public static function insert_field($opt_name = '', $field_id = '', array $field = array(), $pos = 'after', $section_id = '' ) {

            if ( ! is_array( $field ) || empty( $field ) || '' === $opt_name || '' === $field_id ) {
                return;
            }

            self::check_opt_name( $opt_name );

            Redux_Functions_Ex::record_caller( $opt_name );

            $all_fields     = self::$fields[ $opt_name ];
            $dest_field     = self::$fields[ $opt_name ][ $field_id ];
            $section_id     = !empty($section_id)?$section_id:(isset($dest_field['section_id'])?$dest_field['section_id']:'');

            if(!isset($field['section_id'])) {
                $field['section_id'] = $section_id;
            }

            $field_keys   = array_keys($all_fields);
            $field_key    = array_search($field_id, $field_keys);

            if($field_key !== false) {
                if ($pos != 'after') {
                    $field_key--;
                }

                // Extract sections to 2 parts
                $first_array = array_splice($all_fields, 0, $field_key + 1);
                $last = end($first_array);

                $field['priority'] = $last['priority'] + 1;

                // Reorder priority of last array
                foreach ($all_fields as $k => &$val) {
                    if (isset($val['priority'])) {
                        $val['priority']++;
                    }
                }

                $all_fields = array_merge($first_array, array($field['id'] => $field), $all_fields);

                self::$fields[$opt_name] = $all_fields;
            }
        }

        /**
         * Insert multiple option panel field and adds to a section.
         *
         * @param string     $opt_name   Panel opt_name.
         * @param string|int $section_id Section ID this field belongs to.
         * @param string     $field_id   Field ID.
         * @param array      $field      Field data.
         * @param array      $pos        Insert new field to "before" or "after" field with field_id.
         *                               Default: after.
         */
        public static function insert_fields($opt_name = '', $field_id = '', array $fields = array(), $pos = 'after', $section_id = '' ) {

            if ( ! is_array( $fields ) || empty( $fields ) || '' === $opt_name || '' === $field_id ) {
                return;
            }

            self::check_opt_name( $opt_name );

            Redux_Functions_Ex::record_caller( $opt_name );

            $all_fields     = self::$fields[ $opt_name ];

            $dest_field = self::$fields[ $opt_name ][ $field_id ];

            $section_id = !empty($section_id)?$section_id:(isset($dest_field['section_id'])?$dest_field['section_id']:'');


            $field_keys   = array_keys($all_fields);
            $field_key    = array_search($field_id, $field_keys);

            if($field_key !== false) {
                if ($pos != 'after') {
                    $field_key--;
                }

                // Extract sections to 2 parts
                $first_array = array_splice($all_fields, 0, $field_key + 1);
                $last = end($first_array);

                $new_fields = array();

                foreach ($fields as $field){
                    if(!isset($field['section_id'])){
                        $field['section_id']    = $section_id;
                    }
                    $field['priority'] = $last['priority'] + 1;
                    $new_fields[$field['id']]   = $field;
                }

                $reorder    = count($fields);

                // Reorder priority of last array
                foreach ($all_fields as $k => &$val) {
                    if (isset($val['priority'])) {
                        $reorder++;
                        $val['priority'] += $reorder;
                    }
                }

                $all_fields = array_merge($first_array, $new_fields, $all_fields);

                self::$fields[$opt_name] = $all_fields;
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