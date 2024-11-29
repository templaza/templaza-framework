<?php

// Exit if accessed directly
defined( 'TEMPLAZA_FRAMEWORK' ) or exit;

use TemPlazaFramework\Enqueue;
use TemPlazaFramework\Functions;
use TemPlazaFramework\Core\Fields;

if ( ! class_exists( 'ReduxFramework_TZ_Repeater' ) ) {
    class ReduxFramework_TZ_Repeater extends Redux_Field
    {
        protected $redux;
        protected $elements;
        protected $opt_name;
        protected $title_field;
        protected $templates        = array();
        protected $ignore_fields    = array();

        public function __construct( $field = array(), $value = '', $parent = null ) {
            parent::__construct(array(), null, $parent);
            $this->parent           = $parent;
            $this->field            = $field;
            $this->value            = $value;
            $this -> elements       = array();
            $this -> opt_name       = $field['id'].'__opt_name';

            $fields                 = $field['fields'];
            $opt_name               = $this -> opt_name;

            $this -> hooks();

            $core_field = array(
                'id'    => 'admin_label',
                'type'  => 'text',
                'title' => esc_html__('Admin Label', 'templaza-framework'),
                'subtitle' => esc_html__('Set title for this option.', 'templaza-framework')
            );
             array_unshift($fields, $core_field);
            $this -> title_field    = 'admin_label';

            // Init Fields
            Fields::load_fields($fields, $parent);

            $sections                           = array(
                array(
                    'id'    => uniqid(),
                    'title' => '',
                    'fields' => $fields
                )
            );

            $redux_args['opt_name']             = $opt_name;
            $redux_args['menu_type']            = 'hidden';
            $redux_args['dev_mode']             = false;
            $redux_args['ajax_save']            = false;
            $redux_args['open_expanded']        = false;

            $redux_args['dev_mode']       = false;
            $redux_args['database']       = '';
            $redux_args['ajax_save']      = false;
            $redux_args['hide_save']      = true;
            $redux_args['menu_type']      = 'hidden';
            $redux_args['hide_reset']     = true;
            $redux_args['show_import_export']   = false;
            $redux_args['class']   = 'fully-expanded field-tz_repeater__container';

            \Redux::set_args($opt_name, $redux_args);
            \Redux::set_sections($opt_name, $sections);
            \Redux::init($opt_name);
            \Templaza_API::load_my_fields($opt_name);


            add_filter("redux/{$opt_name}/repeater", function($repeater_data) use($redux_args){
                $repeater_data['opt_names'][]   = $redux_args['opt_name'];
                return $repeater_data;
            });
            $redux  = \Redux::instance($opt_name );

            if(\version_compare(\Redux_Core::$version, '4.3.7', '<=')) {
                $redux->_register_settings();
//                $enqueue    = new Enqueue($redux);
//                $enqueue -> init();
            }else{
                $redux -> options_class -> register();
//                $my_enqueue = new Enqueue($redux);
//                $my_enqueue ->init();
            }
            $my_enqueue = new Enqueue($redux);
            $my_enqueue ->framework_init();

            ob_start();
            if(\version_compare(\Redux_Core::$version, '4.3.7', '<=')) {
                $redux->generate_panel();
            }else{
                $redux -> render_class -> generate_panel();
            }

            ob_end_clean();

            $this -> redux          = $redux;

        }

        public function hooks(){

            add_action('admin_footer', array($this, 'template'));

            do_action('templaza-framework/fields/tz_repeater/hooks');
        }

        public function render(){

            $file   = TEMPLAZA_FRAMEWORK_THEME_PATH_FIELDS.'/tz_repeater/tmpl/tz_repeater.php';

            if(!file_exists($file)){
                $file   = TEMPLAZA_FRAMEWORK_FIELD_PATH.'/tz_repeater/tmpl/tz_repeater.php';
            }

            if(file_exists($file)){
                require $file;
            }
        }

        public function template(){
            require __DIR__.'/tmpl/tz_repeater.tpl.php';
        }

        public function enqueue(){
            do_action('templaza-framework/field/tz_repeater/enqueue', $this);

            if (!wp_style_is('field-tz_repeater-css')) {
                wp_enqueue_style(
                    'field-tz_repeater-css',
                    Functions::get_my_frame_url() . '/fields/tz_repeater/field_tz_repeater.css',
                    array(),
                    time(),
                    'all'
                );
            }

            if (!wp_script_is('field-tz_repeater-js')) {
                wp_enqueue_script(
                    'field-tz_repeater-js',
                    Functions::get_my_frame_url() . '/fields/tz_repeater/field_tz_repeater.js',
                    array( 'jquery', 'jquery-ui-accordion',  'jquery-ui-sortable', 'redux-js', 'wp-util'),
                    time(),
                    'all'
                );
                wp_localize_script('field-tz_repeater-js', 'field_tz_repeater_obj', array(
                        'title_field'       => $this -> title_field,
                        'ignore_fields'     => $this -> ignore_fields,
                        'ask_remove_option' => esc_html__('Are you sure to delete this option?', 'templaza-framework')
                ));
            }
        }
    }
}