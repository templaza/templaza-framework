<?php

defined('TEMPLAZA_FRAMEWORK') or exit;

use TemPlazaFramework\Functions;

if(!class_exists('Templaza_Custom_Redux_Background')){
    class Templaza_Custom_Redux_Background{

        public $units = array(
            'px',
            'em',
            'rem',
            '%',
        );

        protected $args;
        protected $field;
        protected $value;
        protected $parent;
        protected $text_domain;
        protected $user_fonts = true;
        protected $redux_framework;
        protected $typography_preview = array();


        public function __construct( $args = array(), $parent = null) {
            $this -> args   = $args;
            $this -> parent = $parent;
            $this -> text_domain    = Functions::get_my_text_domain();

            if(isset($args['opt_name']) && $args['opt_name']){
                $this -> redux_framework    = \Redux::instance($args['opt_name']);
            }

            $this -> hooks();
        }

        protected function hooks(){
            add_action("redux/field/{$this ->args['opt_name']}/background/render/before", array($this, 'custom_before_render_field'), 10, 2);
            add_filter("redux/field/{$this -> args['opt_name']}/background/render/after", array($this, 'custom_render_field'), 10, 2);
            add_filter("redux/{$this -> args['opt_name']}/field/class/background", array($this, 'custom_enqueue_field'), 10, 2);


//            if ( function_exists( 'wp_enqueue_media' ) ) {
//                wp_enqueue_media();
//            } else {
//                if ( ! wp_script_is( 'media-upload' ) ) {
//                    wp_enqueue_script( 'media-upload' );
//                }
//            }
            do_action('templaza-framework/override/redux-field/background/hooks', $this);
        }
        public function custom_before_render_field($field, $value){
            if(isset($field['color_rgba']) && $field['color_rgba']) {
                $this -> field  = $field;
                $this -> value  = $value;
            }
        }

        public function custom_enqueue_field($filter_path, $field){
            if(isset($field['color_rgba']) && $field['color_rgba']) {
                $dep_array = array('redux-spectrum-js', 'redux-field-background-js');
                wp_enqueue_script('custom-redux-background-js', Functions::get_my_frame_url()
                    . "/fields/background/custom-redux-background.js", $dep_array, time(), true);

                wp_enqueue_style('custom-redux-background-css', Functions::get_my_frame_url()
                    . '/fields/background/custom-redux-background.css',
                    array(), time(), 'all');
            }
            return $filter_path;
        }

        public function custom_render_field($_render, $field){
            if(isset($field['color_rgba']) && $field['color_rgba']) {
                $this -> _init_field($field);

                $file   = TEMPLAZA_FRAMEWORK_FIELD_PATH.'/background/tmpl/background.php';
                if(file_exists($file)){
                    ob_start();
                    require $file;
                    $_render    = ob_get_contents();
                    ob_end_clean();
                    $_render    = '<div data-background-rgba="'.(isset($field['color_rgba'])?(int) $field['color_rgba']:0).'">'.$_render.'</div>';
                }
            }

            return $_render;
        }

        public function css_style( $value = array() ) {
            $css = '';

            if ( ! empty( $value ) && is_array( $value ) ) {
                foreach ( $value as $key => $val ) {
                    if ( ! empty( $val ) && 'media' !== $key ) {
                        if ( 'background-image' === $key ) {
                            $css .= $key . ":url('" . esc_url( $val ) . "');";
                        }
                        else if($key == 'background-color' && is_array($val)){
                            if(isset($val['alpha']) && $val['alpha'] < 1){
                                $css   .= $key.':'.esc_attr($val['rgba']);
                            }else{
                                $css   .= $key.':'.esc_attr($val['color']);
                            }
                        }else{
                            $css .= $key . ':' . esc_attr( $val ) . ';';
                        }
                    }
                }
            }

            return $css;
        }

        protected function _init_field($field){
            $this -> field = wp_parse_args( $this -> field, $field );


            // Background defaults
            $defaults = array(
                'background-color'      => true,
                'background-repeat'     => true,
                'background-attachment' => true,
                'background-position'   => true,
                'background-image'      => true,
                'background-gradient'   => false,
                'background-clip'       => false,
                'background-origin'     => false,
                'background-size'       => true,
                'preview_media'         => false,
                'preview'               => true,
                'preview_height'        => '200px',
                'transparent'           => true,
            );

            $this->field = wp_parse_args( $this->field, $defaults );

            // No errors please.
            $defaults = array(
//                'background-color'      => '',
                'background-color'      => array(
                    'color' => '',
                    'alpha' => 1,
                    'rgba'  => '',
                ),
                'background-repeat'     => '',
                'background-attachment' => '',
                'background-position'   => '',
                'background-image'      => '',
                'background-clip'       => '',
                'background-origin'     => '',
                'background-size'       => '',
                'media'                 => array(),
            );

            $this->value = wp_parse_args( $this->value, $defaults );

            $defaults = array(
                'id'        => '',
                'width'     => '',
                'height'    => '',
                'thumbnail' => '',
            );

            $this->value['media'] = wp_parse_args( $this->value['media'], $defaults );


            // Color defaults
//            $defaults = array(
//                'background-color' => '',
//                'background-color-alpha' => 1,
//                'background-color-rgba'  => '',
//            );

            $option_defaults = array(
                'show_input'             => true,
                'show_initial'           => false,
                'show_alpha'             => true,
                'show_palette'           => false,
                'show_palette_only'      => false,
                'max_palette_size'       => 10,
                'show_selection_palette' => false,
                'allow_empty'            => true,
                'clickout_fires_change'  => false,
                'choose_text'            => esc_html__( 'Choose', 'redux-framework' ),
                'cancel_text'            => esc_html__( 'Cancel', 'redux-framework' ),
                'show_buttons'           => true,
                'input_text'             => esc_html__( 'Select Color', 'redux-framework' ),
                'palette'                => null,
            );

//            $this->value = wp_parse_args( $this->value, $defaults );
//            $this->value = wp_parse_args( $this->value, $defaults );
//            var_dump($this->value['background-color'] );

            if ( isset( $this->field ) && ! is_array( $this->field ) ) {
                return;
            }

            $this->field['options'] = isset( $this->field['options'] ) ? wp_parse_args( $this->field['options'], $option_defaults ) : $option_defaults;

            // Convert empty array to null, if there.
            $this->field['options']['palette'] = empty( $this->field['options']['palette'] ) ? null : $this->field['options']['palette'];

            $this->field['output_transparent'] = isset( $this->field['output_transparent'] ) ? $this->field['output_transparent'] : false;
        }
    }
}