<?php

// Exit if accessed directly
defined( 'TEMPLAZA_FRAMEWORK' ) or exit;

use TemPlazaFramework\Functions;

//if(!Redux_Functions::class_exists_ex( array('Redux_Spacing') )){
//    require_once Redux_Core::$dir .'inc/fields/spacing/class-redux-spacing.php';
//}

if ( ! class_exists( 'ReduxFramework_TZ_Repeater' ) ) {
    class ReduxFramework_TZ_Repeater extends Redux_Field
    {
        protected $elements;
        protected $opt_name;
        protected $text_domain;
        protected $title_field;
        protected $templates = array();
        protected $ignore_fields = array();

        public function __construct( $field = array(), $value = '', $parent = null ) {
            parent::__construct(array(), null, $parent);
            $this -> text_domain    = Functions::get_my_text_domain();
            $this->parent           = $parent;
            $this->field            = $field;
            $this->value            = $value;
            $this -> elements       = array();
            $this -> opt_name       = $field['id'].'__opt_name';

            $fields = $field['fields'];
            $opt_name                           = $this -> opt_name;
            $this -> hooks();

            $core_field = array(
                'id'    => 'admin_label',
                'type'  => 'text',
                'title' => esc_html__('Admin Label', $this -> text_domain),
                'subtitle' => esc_html__('Set title for this option.', $this -> text_domain)
            );
             array_unshift($fields, $core_field);
            $this -> title_field    = 'admin_label';

            $sections                           = array(
                'title' => '',
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

            $redux-> _register_settings();

            $enqueue    = new \TemPlazaFramework\Enqueue($redux);
            $enqueue -> init();
            ob_start();

            $redux->generate_panel();

            ob_end_clean();

            $this -> redux          = $redux;

        }

        public function hooks(){

            add_action('admin_footer', array($this, 'template'));

            do_action('templaza-framework/fields/tz_repeater/hooks');
        }

        public function render(){
            $content_id = $this -> field['id'].'__content';
            ?>
            <textarea class="hide" name="<?php echo $this -> field['name'];?>" id="<?php echo $this -> field['id'];
            ?>"><?php echo $this -> value; ?></textarea>
            <div class="field-tz_repeater-accordion" id="<?php echo $content_id; ?>"></div>

            <a href="#" class="add-more button button-primary" data-content="#<?php echo $content_id; ?>"><i class="far fa-plus-square"></i> <?php echo __('Add More', $this -> text_domain); ?></a>

        <?php
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
                    array( 'jquery', 'jquery-ui-accordion',  'jquery-ui-sortable', 'redux-js'),
                    time(),
                    'all'
                );
                wp_localize_script('field-tz_repeater-js', 'field_tz_repeater_obj', array(
                        'title_field'       => $this -> title_field,
                        'ignore_fields'     => $this -> ignore_fields,
                        'ask_remove_option' => esc_html__('Are you sure to delete this option?', $this -> text_domain)
                ));
            }
        }
    }
}