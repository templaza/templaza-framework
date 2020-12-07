<?php

defined('TEMPLAZA_FRAMEWORK') or exit;

use TemPlazaFramework\Functions;

if(!class_exists('Templaza_Custom_Redux_Typography')){
    class Templaza_Custom_Redux_Typography{

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

        protected $std_fonts = array(
            'Arial, Helvetica, sans-serif'            => 'Arial, Helvetica, sans-serif',
            '\'Arial Black\', Gadget, sans-serif'     => '\'Arial Black\', Gadget, sans-serif',
            '\'Bookman Old Style\', serif'            => '\'Bookman Old Style\', serif',
            '\'Comic Sans MS\', cursive'              => '\'Comic Sans MS\', cursive',
            'Courier, monospace'                      => 'Courier, monospace',
            'Garamond, serif'                         => 'Garamond, serif',
            'Georgia, serif'                          => 'Georgia, serif',
            'Impact, Charcoal, sans-serif'            => 'Impact, Charcoal, sans-serif',
            '\'Lucida Console\', Monaco, monospace'   => '\'Lucida Console\', Monaco, monospace',
            '\'Lucida Sans Unicode\', \'Lucida Grande\', sans-serif' => '\'Lucida Sans Unicode\', \'Lucida Grande\', sans-serif',
            '\'MS Sans Serif\', Geneva, sans-serif'   => '\'MS Sans Serif\', Geneva, sans-serif',
            '\'MS Serif\', \'New York\', sans-serif'  => '\'MS Serif\', \'New York\', sans-serif',
            '\'Palatino Linotype\', \'Book Antiqua\', Palatino, serif' => '\'Palatino Linotype\', \'Book Antiqua\', Palatino, serif',
            'Tahoma,Geneva, sans-serif'               => 'Tahoma, Geneva, sans-serif',
            '\'Times New Roman\', Times,serif'        => '\'Times New Roman\', Times, serif',
            '\'Trebuchet MS\', Helvetica, sans-serif' => '\'Trebuchet MS\', Helvetica, sans-serif',
            'Verdana, Geneva, sans-serif'             => 'Verdana, Geneva, sans-serif',
        );

        public function __construct( $args = array(), $parent = null) {
            $this -> args   = $args;
            $this -> parent = $parent;
            $this -> text_domain    = Functions::get_my_text_domain();

            $this -> select2_config = array(
                'width'      => 'resolve',
                'allowClear' => false,
                'theme'      => 'default',
            );

            if(isset($args['opt_name']) && $args['opt_name']){
                $this -> redux_framework    = \Redux::instance($args['opt_name']);
            }

            $this -> hooks();
        }
        protected function hooks(){
            add_action("redux/field/{$this ->args['opt_name']}/typography/render/before", array($this, 'custom_before_render_field'), 10, 2);
            add_filter("redux/field/{$this -> args['opt_name']}/typography/render/after", array($this, 'custom_render_field'), 10, 2);
            add_filter("redux/{$this -> args['opt_name']}/field/class/typography", array($this, 'custom_enqueue_field'), 10, 2);

            do_action('templaza-framework/override/redux-field/typography/hooks', $this);
        }
        public function custom_before_render_field($field, $value){
            if(isset($field['allow_responsive']) && $field['allow_responsive']) {
                $this -> value  = $value;
            }
        }

        public function custom_enqueue_field($filter_path, $field){
            if(isset($field['allow_responsive']) && $field['allow_responsive']) {
                $dep_array = array('jquery-ui-tabs', 'redux-field-typography-js');
                wp_enqueue_script('custom-redux-typography-js', Functions::get_my_frame_url()
                    . "/fields/typography/custom-redux-typography.js", $dep_array, time(), true);

                wp_enqueue_style('custom-redux-typography-css', Functions::get_my_frame_url()
                    . '/fields/typography/custom-redux-typography.css',
                    array(), time(), 'all');
            }
            return $filter_path;
        }

        public function custom_render_field($_render, $field){
            if(isset($field['allow_responsive']) && $field['allow_responsive']) {
                $this -> _init_field($field);

                $file   = TEMPLAZA_FRAMEWORK_FIELD_PATH.'/typography/tmpl/typography.php';
                if(file_exists($file)){
                    ob_start();
                    require $file;
                    $_render    = ob_get_contents();
                    ob_end_clean();
                }
                if(!empty($_render)){
                    $_render    = '<div data-responsive="'.(isset($field['allow_responsive'])?(int) $field['allow_responsive']:0).'">'.$_render.'</div>';
                }
            }

            return $_render;
        }

        protected function _init_field($field){

//            exit(__METHOD__);
            $defaults = array(
                'font-family'             => true,
                'font-size'               => true,
                'font-weight'             => true,
                'font-style'              => true,
                'font-backup'             => false,
                'subsets'                 => true,
                'custom_fonts'            => true,
                'text-align'              => true,
                'text-transform'          => false,
                'font-variant'            => false,
                'text-decoration'         => false,
                'color'                   => true,
                'preview'                 => true,
                'line-height'             => true,
                'multi'                   => array(
                    'subsets' => false,
                    'weight'  => false,
                ),
                'word-spacing'            => false,
                'letter-spacing'          => false,
                'google'                  => true,
                'font_family_clear'       => true,
                'allow_empty_line_height' => false,
            );

            $this -> field = wp_parse_args( $field, $defaults );

            // Set value defaults.
            $defaults = array(
                'font-family'     => '',
                'font-options'    => '',
                'font-backup'     => '',
                'text-align'      => '',
                'text-transform'  => '',
                'font-variant'    => '',
                'text-decoration' => '',
                'line-height'     => '',
                'word-spacing'    => '',
                'letter-spacing'  => '',
                'subsets'         => '',
                'google'          => false,
                'font-script'     => '',
                'font-weight'     => '',
                'font-style'      => '',
                'color'           => '',
                'font-size'       => array(
                    'desktop'   => '',
                    'tablet'    => '',
                    'mobile'    => '',
                ),
//                'font-size'       => '',
            );

            $this->value = wp_parse_args( $this -> value, $defaults );

            if ( empty( $this -> field['units'] )
                || (!empty($this -> field['units']) && !is_array($this -> field['units']) && ! in_array( $this -> field['units'], $this -> units, true )) ) {
                $this -> field['units'] = 'px';
            }

            if ( empty( $this -> field['fonts'] ) ) {
                $this -> user_fonts     = false;
                $this -> field['fonts'] = $this -> std_fonts;
            }
        }
    }
}