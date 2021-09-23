<?php

// Exit if accessed directly
defined( 'TEMPLAZA_FRAMEWORK' ) or exit;

use TemPlazaFramework\Functions;

if ( ! class_exists( 'Redux_TZ_Presets' ) ) {
    class Redux_TZ_Presets extends Redux_Field
    {
        private $preset_path;

        private $text_domain = 'templaza-framework';

        public function __construct($field = array(), $value = null, $parent = null)
        {
            parent::__construct($field, $value, $parent);

            $this -> text_domain    = Functions::get_my_text_domain();

            $this -> preset_path    = isset($field['preset_path'])?$field['preset_path']:TEMPLAZA_FRAMEWORK_THEME_PATH.'/presets';
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
                            'valid_name' => esc_html__('Please insert name of preset!', $this->text_domain),
                            'load_confirm' => esc_html__('Your current configure will be lost and overwritten by new data. Are you sure?', $this->text_domain),
                            'remove_confirm' => esc_html__('This preset will be deleted! Are you sure?', $this->text_domain)
                        )
                    )
                ));
            }
        }

        public function render()
        {
            $file   = __DIR__.'/tmpl/tz_presets.php';

            if(file_exists($file)){
                require $file;
            }
        }
    }
}