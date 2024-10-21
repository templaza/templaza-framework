<?php

// Exit if accessed directly
defined( 'TEMPLAZA_FRAMEWORK' ) or exit;

use TemPlazaFramework\Enqueue;
use TemPlazaFramework\Functions;

if ( ! class_exists( 'Redux_TZ_Presets' ) ) {
    class Redux_TZ_Presets extends Redux_Field
    {
        protected $redux;
        protected $opt_name;

        private $preset_path;
        private $text_domain = 'templaza-framework';

        public function __construct($field = array(), $value = null, $parent = null)
        {
            parent::__construct($field, $value, $parent);

            $this -> text_domain    = Functions::get_my_text_domain();

            $this -> preset_path    = isset($field['preset_path'])?$field['preset_path']:TEMPLAZA_FRAMEWORK_THEME_PATH.'/presets';

            $this -> opt_name   = $this -> field['id'].'__opt_name';

            $this -> register_fields();
        }

        public function register_fields(){

            $fields     = isset($this -> field['fields'])?$this -> field['fields']:array();

            if(!empty($fields)) {
                $sections = array(
                    array(
//                        'id' => uniqid(),
                        'id' => $this -> field['id'].'__subfield',
                        'title' => '',
                        'fields' => $fields
                    )
                );

                $redux_args = $this->__init_redux_arguments();

                $opt_name = $redux_args['opt_name'];

                \Redux::set_args($opt_name, $redux_args);
                \Redux::set_sections($opt_name, $sections);
                \Redux::init($opt_name);
                \Templaza_API::load_my_fields($opt_name);


                add_filter("redux/{$opt_name}/repeater", function ($repeater_data) use ($redux_args) {
                    $repeater_data['opt_names'][] = $redux_args['opt_name'];
                    return $repeater_data;
                });
                $redux = \Redux::instance($opt_name);

                if (\version_compare(\Redux_Core::$version, '4.3.7', '<=')) {
                    $redux->_register_settings();
                } else {
                    $redux->options_class->register();
                }

                $my_enqueue = new Enqueue($redux);
                $my_enqueue->framework_init();

                $this->redux = $redux;
            }
        }

        protected function __init_redux_arguments(){
            $redux_args['opt_name']             = $this -> opt_name;
            $redux_args['menu_type']            = 'hidden';
            $redux_args['dev_mode']             = false;
            $redux_args['ajax_save']            = false;
            $redux_args['open_expanded']        = false;

            $redux_args['dev_mode']             = false;
            $redux_args['database']             = '';
            $redux_args['ajax_save']            = false;
            $redux_args['hide_save']            = true;
            $redux_args['hide_reset']           = true;
            $redux_args['show_import_export']   = false;
            $redux_args['class']                = 'fully-expanded field-tz_preset__container';

            return $redux_args;
        }

        protected function get_presets(){
            $preset_path    = $this -> preset_path;

            if(!is_dir($preset_path)){
                return false;
            }

            $files  = glob($preset_path.'/*.json');
            
            if(!count($files)){
                return false;
            }

            $presets    = array();
            // phpcs:disable WordPress.WP.AlternativeFunctions.file_get_contents_file_get_contents
            foreach ($files as $file){
                $preset = file_get_contents($file);

                if(empty($preset)){
                    continue;
                }

                $preset = json_decode($preset, true);

                $preset['name'] = basename($file, '.json');
                $presets[]  = $preset;
            }

            return $presets;
        }

        public function enqueue() {
            $dep_array = array( 'jquery', 'wp-color-picker', 'select2-js', 'redux-js' );
            if (!wp_style_is('field-tz_presets')) {
                wp_enqueue_style(
                    'field-tz_repeater',
                    Functions::get_my_frame_url() . '/extensions/tz_presets/tz_presets/field_tz_presets.css',
                    array(),
                    time(),
                    'all'
                );
            }

            if(!wp_script_is('field-tz_presets')) {
                wp_enqueue_script(
                    'field-tz_presets',
                    Functions::get_my_frame_url() . '/extensions/tz_presets/tz_presets/field_tz_presets.js',
                    $dep_array,
                    $this->timestamp,
                    true
                );

                wp_localize_script('field-tz_presets', 'field_tz_presets', array(
                    'i18n' => array(
                        'messages' => array(
                            'valid_name' => esc_html__('Please insert name of preset!', 'templaza-framework'),
                            'load_confirm' => esc_html__('Your current configure will be lost and overwritten by new data. Are you sure?', 'templaza-framework'),
                            'remove_confirm' => esc_html__('This preset will be deleted! Are you sure?', 'templaza-framework')
                        )
                    )
                ));
            }
        }

        public function render(){

            $file   = TEMPLAZA_FRAMEWORK_THEME_PATH_FIELDS.'/tz_presets/tmpl/tz_presets.php';

            if(!file_exists($file)){
                $file   = __DIR__.'/tmpl/tz_presets.php';
            }

            if(file_exists($file)){
                require $file;
            }
        }
    }
}