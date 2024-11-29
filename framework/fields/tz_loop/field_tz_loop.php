<?php

// Exit if accessed directly
defined( 'TEMPLAZA_FRAMEWORK' ) or exit;

use TemPlazaFramework\Enqueue;
use TemPlazaFramework\Functions;

if ( ! class_exists( 'ReduxFramework_TZ_Loop' ) ) {
    class ReduxFramework_TZ_Loop
    {
        protected $elements;
        protected $opt_name;
        protected $title_field;
        protected $templates = array();
        protected $ignore_fields = array();

        function __construct( $field = array(), $value = '', $parent = null ) {
            $this->parent           = $parent;
            $this->field            = $field;
            $this->value            = stripslashes($value);
            $this -> elements       = array();
            $this -> opt_name       = $field['id'].'__opt_name';

            $fields     = $field['fields'];
            $opt_name   = $this -> opt_name;
            $this -> hooks();

            $sections   = array(
                array(
                    'id'    => uniqid(),
                    'title' => '',
                    'fields' => $fields
                )
            );
//            $sections   = $fields;

            $redux_args['opt_name']             = $opt_name;
            $redux_args['menu_type']            = 'hidden';
            $redux_args['dev_mode']             = false;
            $redux_args['ajax_save']            = false;
            $redux_args['open_expanded']        = false;

            $redux_args['dev_mode']             = false;
            $redux_args['database']             = '';
            $redux_args['ajax_save']            = false;
            $redux_args['hide_save']            = true;
            $redux_args['menu_type']            = 'hidden';
            $redux_args['hide_reset']           = true;
            $redux_args['show_import_export']   = false;
            $redux_args['class']                = 'fully-expanded field-tz_loop__container';

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

            do_action('templaza-framework/fields/tz_loop/hooks');
        }

        public function render(){
            $content_id = $this -> field['id'].'__content';
            // phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped
            ?>
            <textarea class="hide" name="<?php echo esc_attr($this -> field['name']);?>" id="<?php echo esc_attr($this -> field['id']);
            ?>"><?php echo $this -> value; ?></textarea>
            <div class="field-tz_loop-accordion" id="<?php echo esc_attr($content_id); ?>" data-group-fields="<?php
            echo htmlspecialchars(wp_json_encode($this -> field['group_fields']));?>"></div>
        <?php
        }

        public function template(){
            require __DIR__.'/tmpl/tz_loop.tpl.php';
        }

        public function enqueue(){
            do_action('templaza-framework/field/tz_loop/enqueue', $this);

            if (!wp_style_is('field-tz_loop-css')) {
                wp_enqueue_style(
                    'field-tz_loop-css',
                    Functions::get_my_frame_url() . '/fields/tz_loop/field_tz_loop.css',
                    array(),
                    time(),
                    'all'
                );
            }

            if (!wp_script_is('field-tz_loop-js')) {
                wp_enqueue_script(
                    'field-tz_loop-js',
                    Functions::get_my_frame_url() . '/fields/tz_loop/field_tz_loop.js',
                    array( 'jquery', 'jquery-ui-accordion',  'jquery-ui-sortable', 'redux-js'),
                    time(),
                    'all'
                );
                wp_localize_script('field-tz_loop-js', 'field_tz_loop_obj', array(
                        'title_field'       => $this -> title_field,
                        'ignore_fields'     => $this -> ignore_fields,
                        'ask_remove_option' => esc_html__('Are you sure to delete this option?', 'templaza-framework')
                ));
            }
        }
    }
}