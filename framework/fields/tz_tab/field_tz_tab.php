<?php

// Exit if accessed directly
defined( 'TEMPLAZA_FRAMEWORK' ) or exit;

use TemPlazaFramework\Functions;

// Don't duplicate me!
    if ( ! class_exists( 'ReduxFramework_TZ_Tab' ) ) {

        /**
         * Main ReduxFramework_heading class
         *
         * @since       1.0.0
         */
        class ReduxFramework_TZ_Tab {
            protected $instances = array();
            /**
             * Field Constructor.
             * Required - must call the parent constructor, then assign field and value to vars, and obviously call the render field function
             *
             * @since         1.0.0
             * @access        public
             * @return        void
             */
            public function __construct( $field = array(), $value = '', $parent ) {
                $this->parent = $parent;
                $this->field  = $field;
                $this->value  = $value;


                if(isset($this -> field['tabs'])){
                    $has_media  = false;

                    $args   = $this -> parent -> args;
//                    var_dump($args['opt_name']);
                    $opt_name   = $args['opt_name'].'__field-'.$this -> field['type'];
                    $args['opt_name']   = $opt_name;
                    foreach($this -> field['tabs'] as $k => &$tab) {

                        foreach ($tab['fields'] as &$f) {
                            if($f['type'] == 'background'){
                                $has_media  = true;
                            }
                            $field_classes = array( 'Redux_' . $field['type'], 'ReduxFramework_' . $field['type'] );

                            $class_file = apply_filters( "redux/{$this->parent ->args['opt_name']}/field/class/{$f['type']}",
                                ReduxFramework::$_dir . "inc/fields/{$f['type']}/field_{$f['type']}.php", $f );
//                            $field_class = "Redux_{$f['type']}";

                            if ( $class_file ) {
                                $field_class = Redux_Functions::class_exists_ex( $field_classes );
                                if ( false === $field_class ) {
                                    if ( file_exists( $class_file ) ) {
                                        require_once $class_file;

                                        $field_class = Redux_Functions::class_exists_ex( $field_classes );
                                    } else {
                                        return;
                                    }
                                }

                                if(!isset($this -> instances[$f['type']])) {
                                    $field_obj = new $field_class($f, '', $this->parent);
                                    $this -> instances[$f['type']] = $field_obj;
                                    if(method_exists($field_obj, 'template')) {
                                        ob_start();
                                        $field_obj -> template();
                                        $template   = ob_get_contents();
                                        ob_end_clean();
                                        add_filter('templaza-framework/field/tz_layout/element/template', function($templates)use($f, $template){
                                            $templates[$f['type']]    = $template;
                                            return $templates;
                                        });
                                    }
//                                    $field_obj -> enqueue();
                                }
                            }
                        }
                    }

                    if($has_media){
                        if ( function_exists( 'wp_enqueue_media' ) ) {
                            wp_enqueue_media();
                        } else {
                            if ( ! wp_script_is( 'media-upload' ) ) {
                                wp_enqueue_script( 'media-upload' );
                            }
                        }
                    }
                }

            }


            /**
             * Field Render Function.
             * Takes the vars and outputs the HTML for the field in the settings
             *
             * @since         1.0.0
             * @access        public
             * @return        void
             */
            public function render() {

                // No errors please
                $defaults    = array(
                    'indent'   => '',
                    'style'    => '',
                    'class'    => '',
                    'title'    => '',
                    'subtitle' => '',
                );
                $this->field = wp_parse_args( $this->field, $defaults );

                $tab_titles     = '';
                $tab_contents   = '';

                if(isset($this -> field['tabs']) && count($this -> field['tabs'])){

                    $args   = $this -> parent -> args;
//                    $args['opt_name']   .= '__'.$this -> field['id'];
                    $args['opt_name']   .= '__'.$this -> field['id'].'-'.uniqid();
//                    $args['opt_name']   .= '__'.time();
                    $opt_name   = $args['opt_name'];
                    $args['show_import_export'] = false;
                    Redux::set_args($opt_name, $args);

                    foreach($this -> field['tabs'] as $k => $tab){
                        $tab_titles     .= '<li><a href="#tz_tab-'.$tab['id'].'">'.$tab['title'].'</a></li>';

                        $tab['title']   = '';

                        Redux::set_section($opt_name, $tab);

                    }
                    \Templaza_API::load_my_fields($opt_name);
                    Redux::init($opt_name);

                    $redux  = Redux::instance($opt_name);

                    foreach($redux -> sections as $k => $tab){
                        $tab_contents   .= '<div id="tz_tab-'.$tab['id'].'">';

                        if(isset($tab['fields']) && count($tab['fields'])){
                            foreach ($tab['fields'] as $field) {
                                add_filter("redux/options/{$opt_name}/field/{$field['id']}", function($_field)use($field){
                                    $_field['name'] = $_field['id'];
                                    return $_field;
                                });
                            }
                        }
                        add_filter("redux/{$this -> parent -> args['opt_name']}/repeater", function($repeater_data) use($opt_name){
                            $repeater_data['opt_names'][]   = $opt_name;
                            return $repeater_data;
                        });

//                        var_dump($redux->folds);
                        $redux -> _register_settings();
                        $enqueue    = new \TemPlazaFramework\Enqueue($redux);
                        $enqueue -> init();


//                        $redux -> _enqueue();
//                        var_dump($redux -> folds);


                        $tab['class'] = isset($tab['class']) ? ' ' . $tab['class'] : '';
//                        $tab_contents .= '<div class="redux-group-tab' . esc_attr($tab['class']) . '" data-rel="'.$this -> field['type'].'_' . $k . '">';
                        $tab_contents .= '<div id="'.$this -> field['type'].'_' . $k . '_section_group' . '" class="redux-group-tab' . esc_attr($tab['class']) . '" data-rel="'.$this -> field['type'].'_' . $k . '">';
                        $tab_contents .= '<div class="redux-container"  data-opt-name="'.$opt_name.'">';
//                        $tab_contents .= '<div class="redux-form-wrapper">';

                            ob_start();
                            do_settings_sections( $redux->args['opt_name'] . $k . '_section_group' );
                            $tab_contents   .= ob_get_contents();
                            ob_end_clean();
//                        $tab_contents .= '</div>';
                        $tab_contents .= '</div>';
                        $tab_contents .= '</div>';
                        $tab_contents   .= '</div>';
                    }
                }

                echo '<div id="tz_tab-'.$this -> field['id'].'-tab" class="tzfrm-ui-tab" data-fl-tz_layout-tab>
                    <ul>'.$tab_titles.'</ul>
                    '.$tab_contents.'
                </div>';
            }

            public function enqueue() {
                if (!wp_script_is('templaza-field-tz_tab-js')) {
                    wp_enqueue_script(
                        'templaza-field-tz_tab-js',
                        Functions::get_my_frame_url() . '/fields/tz_tab/field_tz_tab.js',
                        array( 'jquery', 'jquery-ui-tabs','redux-js'),
                        time(),
                        true
                    );
                }
            }
        }
    }