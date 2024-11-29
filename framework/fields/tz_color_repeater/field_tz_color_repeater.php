<?php

// Exit if accessed directly
defined( 'TEMPLAZA_FRAMEWORK' ) or exit;

use TemPlazaFramework\Enqueue;
use TemPlazaFramework\Functions;
use TemPlazaFramework\Core\Fields;

if ( ! class_exists( 'ReduxFramework_TZ_Color_Repeater' ) ) {
    class ReduxFramework_TZ_Color_Repeater extends Redux_Field
    {
        protected $redux;
        protected $elements;
        protected $opt_name;

        protected $type             = 'tz_color_repeater';
        protected $field_style      = 'inline';
        protected $core_fields      = array();
        protected $accordion        = true;
        protected $templates        = array();
        protected $ignore_fields    = array();

        public function __construct( $field = array(), $value = '', $parent = null ) {
            parent::__construct(array(), null, $parent);
            $this->parent           = $parent;
            $this->field            = $field;
            $this->value            = $value;
            $this -> elements       = array();
            $this -> opt_name       = $field['id'].'__opt_name';

            $fields                 = isset($field['fields'])?$fields['fields']:array();
            $opt_name               = $this -> opt_name;

            if(isset($field['accordion'])) {
                $this -> accordion = filter_var($field['accordion'], FILTER_VALIDATE_BOOLEAN);
            }
            if(isset($field['field_style'])) {
                $this -> field_style = $field['field_style'];
            }

            $this -> hooks();

            $core_fields = array(
                array(
                    'id'    => 'title',
                    'type'  => 'text',
                    'title' => esc_html__('Title', 'templaza-framework'),
                    'placeholder' => esc_html__('Title', 'templaza-framework'),
                ),
                array(
                    'id'    => 'color',
                    'type'  => 'color_rgba',
                    'title' => esc_html__('Color', 'templaza-framework'),
                    'options'   => array(
                        'choose_color'  => true, /* Attribute added by templaza framework */
                        'allow_global'  => false
                    ),
                ),
                array(
                    'id'    => 'id',
                    'type'  => 'text',
                    'title' => esc_html__('ID', 'templaza-framework'),
                    'hidden'    => true,
                ),
            );
            $this -> core_fields    = array_column($core_fields, 'id');

            if(!empty($fields)) {
                $fields = array_merge($core_fields, $fields);
            }else{
                $fields = $core_fields;
            }

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
            }else{
                $redux -> options_class -> register();
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

            do_action('templaza-framework/fields/'.$this -> type.'/hooks');
        }

        public function render(){

            $file   = TEMPLAZA_FRAMEWORK_THEME_PATH_FIELDS.'/'.$this -> type.'/tmpl/'.$this -> type.'.php';

            if(!file_exists($file)){
                $file   = TEMPLAZA_FRAMEWORK_FIELD_PATH.'/'.$this -> type.'/tmpl/'.$this -> type.'.php';
            }

            if(file_exists($file)){
                require $file;
            }
        }

        public function template(){
            require __DIR__.'/tmpl/'.$this -> type.'.tpl.php';
        }

        public function enqueue(){
            do_action('templaza-framework/field/'.$this -> type.'/enqueue', $this);

            if (!wp_style_is('field-'.$this -> type.'-css')) {
                wp_enqueue_style(
                    'field-'.$this -> type.'-css',
                    Functions::get_my_frame_url() . '/fields/'.$this -> type.'/field_'.$this -> type.'.css',
                    array(),
                    time(),
                    'all'
                );
            }

            if (!wp_script_is('field-'.$this -> type.'-js')) {
                wp_enqueue_script(
                    'field-'.$this -> type.'-js',
                    Functions::get_my_frame_url() . '/fields/'.$this -> type.'/field_'.$this -> type.'.js',
                    array( 'jquery', 'jquery-ui-accordion',  'jquery-ui-sortable', 'redux-js', 'wp-util'),
                    time(),
                    'all'
                );
                wp_localize_script('field-'.$this -> type.'-js', 'field_'.$this -> type.'_obj', array(
                        'core_fields'       => $this -> core_fields,
                        'ignore_fields'     => $this -> ignore_fields,
                        'new_item'          => esc_html__('New Item', 'templaza-framework'),
                        'ask_remove_option' => esc_html__(' You\'re about to delete a Global Color. Note that if it\'s being used anywhere on your site, it will inherit a default Color.', 'templaza-framework')
                ));
            }
        }
    }
}