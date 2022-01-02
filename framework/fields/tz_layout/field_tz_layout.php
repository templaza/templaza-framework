<?php

// Exit if accessed directly
defined( 'TEMPLAZA_FRAMEWORK' ) or exit;

use TemPlazaFramework\Functions;
use TemPlazaFramework\Helpers\FieldHelper;

if ( ! class_exists( 'ReduxFramework_TZ_Layout' ) ) {
    class ReduxFramework_TZ_Layout
    {
        protected $text_domain;
        protected $elements;
        protected $templates = array();

        function __construct( $field = array(), $value = '', $parent = null ) {

            $this -> text_domain    = Functions::get_my_text_domain();

            $field['title'] = isset($field['title'])?$field['title']:'';

            $this->parent = $parent;
            $this->field  = $field;
            $this->value  = $value;
            $this -> elements  = array();

            if(is_admin()) {
                $this->load_element();

//                $this -> _init_template();
            }

            $this -> hooks();
        }

        public function hooks(){
//            add_action('admin_footer', array($this, 'template'));
//            add_action('wp_ajax_nopriv_');
        }

        protected function load_element(){

            $folder_path    = TEMPLAZA_FRAMEWORK_SHORTCODES_PATH;
            $theme_path     = TEMPLAZA_FRAMEWORK_THEME_PATH_SHORTCODES;

            require_once ( ABSPATH . '/wp-admin/includes/file.php' );
            global $wp_filesystem;
            WP_Filesystem();
            $folders  = Functions::list_files($folder_path,'.', 1);
            $count      = count($folders);

            // Require shortcodes from theme
            if(is_dir($theme_path)){
                $theme_files    = Functions::list_files($theme_path, '.', 1);
                $folders    = array_merge($folders, $theme_files);
            }

            $folders    = apply_filters('templaza-framework/field/tz_layout/elements', $folders, $this);

            foreach($folders as $folder){
                $file_name  = basename($folder);

                $show   = 'shortcode_'.$file_name;

                if(isset($this -> parent -> args[$show]) && !$this -> parent -> args[$show]){
                    continue;
                }

                $class      = 'TemplazaFramework_ShortCode_'.ucfirst($file_name);
                if(!class_exists($class)){
                    $file_path  = $folder.$file_name.'.php';

                    if(file_exists($file_path)){
                        require_once $file_path;
                    }
                }
                if(class_exists($class)){
                    if(file_exists($theme_path.'/'.$file_name.'/config.php')){
                        require_once $theme_path.'/'.$file_name.'/config.php';
                    }
                    $element    = new $class($this -> field, '', $this -> parent);
                    $this -> elements[$file_name]    = $element;

                    apply_filters('templaza-framework/field/tz_layout/element', $element, $this);

                    if(method_exists($element, 'enqueue')) {
                        add_action('admin_enqueue_scripts', array($element, 'enqueue'));
                    }
                }
            }
        }

        public function render(){
            add_action('admin_footer', array($this, 'template'));

            $theme_file = TEMPLAZA_FRAMEWORK_THEME_PATH_FIELDS.'/tz_layout/tmpl/tz_layout.php';
            $file       = TEMPLAZA_FRAMEWORK_FIELD_PATH.'/tz_layout/tmpl/tz_layout.php';
            if(file_exists($theme_file)){
                require $theme_file;
            }elseif(file_exists($file)){
                require $file;
            }
        }

        public function template(){
            if(!isset($this -> templates) || empty($this -> templates)) {
                $this -> _init_template();
            }

            if(isset($this -> templates) && count($this -> templates)) {
                $this -> templates  = array_unique($this -> templates);
                echo implode("\n", $this->templates);
            }
        }

        protected function _init_template(){
            // Load tpl file in construct to fields can run hooks
            ob_start();
            ?>
            <?php
            require_once __DIR__.'/template/element.tpl.php';
            require_once __DIR__.'/template/list_items.tpl.php';
            require_once __DIR__.'/template/setting_grid.tpl.php';

            $this -> templates['element'] = ob_get_contents();
            ob_end_clean();
            $this -> templates  = apply_filters('templaza-framework/field/tz_layout/element/template', $this -> templates);
        }

        public function enqueue(){
//            wp_enqueue_editor();
            do_action('templaza-framework/field/tz_layout/enqueue', $this);

            if (!wp_style_is('templaza-field-tz_layout-css')) {
                wp_enqueue_style(
                    'templaza-field-tz_layout',
                    Functions::get_my_frame_url() . '/fields/tz_layout/field_tz_layout.css',
                    array(),
                    time(),
                    'all'
                );
            }

            if (!wp_script_is('templaza-field-tz_layout-js')) {
                wp_enqueue_script(
                    'templaza-field-tz_layout-js',
                    Functions::get_my_frame_url() . '/fields/tz_layout/field_tz_layout.js',
                    array( 'jquery', 'jquery-ui-tooltip',  'jquery-ui-sortable','jquery-ui-dialog', 'wp-util', 'redux-js'),
                    time(),
                    'all'
                );
                wp_localize_script(
                    'templaza-field-tz_layout-js',
                    'templaza_field_tz_layout', array('i18n' => array(
                        'close'             => __('Close', $this -> text_domain),
                        'name'              => __('Name', $this -> text_domain),
                        'copied'            => __('Copied!', $this -> text_domain),
                        'pasted'            => __('Pasted!', $this -> text_domain),
                        'search'            => __('Search', $this -> text_domain),
                        'created'           => __('Created', $this -> text_domain),
                        'actions'           => __('Actions', $this -> text_domain),
                        'copy_failed'       => __('Copy failed!', $this -> text_domain),
                        'created_date'      => __('Created date', $this -> text_domain),
                        'section_added'     => __('Section added!', $this -> text_domain),
                        'delete_question'   => __('Are you sure?', $this -> text_domain),
                        'paste_failed'      => __('Not Pasted! Please copy again.', $this -> text_domain),
                        'custom_column'     => __('Please enter custom grid size (eg. 1-2;1-4;1-4 or auto;1-3;expand).', $this -> text_domain),
                    ))
                );
            }

        }
    }
}