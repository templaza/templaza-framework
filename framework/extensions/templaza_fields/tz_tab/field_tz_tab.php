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
                    foreach($this -> field['tabs'] as &$tab) {
                        foreach ($tab['fields'] as &$f) {
                            $field_class = "Redux_{$f['type']}";

                            if ( ! class_exists( $field_class ) ) {
                                $class_file = apply_filters( "redux/{$this->parent ->args['opt_name']}/field/class/{$f['type']}", ReduxFramework::$_dir . "inc/fields/{$f['type']}/field_{$f['type']}.php", $f );

                                if ( $class_file ) {
                                    if ( file_exists( $class_file ) ) {
                                        require_once $class_file;
                                    }
                                }
                            }
//                            var_dump(class_exists( $field_class ));

//                            if(!isset($this -> instances[$f['type']])) {
//                                $field_obj = new $field_class($f, '', $this->parent);
//                                $this -> instances[$f['type']] = $field_obj;
//                                if(method_exists($field_obj, 'template')) {
//                                    ob_start();
//                                    $field_obj -> template();
//                                    $template   = ob_get_contents();
//                                    ob_end_clean();
//                                    add_filter('templaza-framework/field/tz_layout/element/template', function($templates)use($f, $template){
//                                        $templates[$f['type']]    = $template;
//                                        return $templates;
//                                    });
//                                }
//                            }
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
                    $enqueue    = null;
                    if(class_exists('reduxCoreEnqueue')) {
                        $enqueue = new reduxCoreEnqueue ( $this -> parent );
                    }

                    foreach($this -> field['tabs'] as $tab){
                        $tab_titles     .= '<li><a href="#tz_tab-'.$tab['id'].'">'.$tab['title'].'</a></li>';
                        $tab_contents   .= '<div id="tz_tab-'.$tab['id'].'">';


//                        if(isset($tab['fields']) && count($tab['fields'])){
//                            $tab_contents   .= '<table class="form-table">';
//                            foreach($tab['fields'] as $field){
//                                if($enqueue){
//                                    $enqueue -> _enqueue_field($field);
//                                }
//                                $f_org_id   = $field['id'];
////                                $f_id   = $this -> field['id'].'-'.$field['id'];
//                                $field['class'] = '';
////                                $field['id']    = $f_id;
//
//
//                                $this -> parent -> field_default_values($field);
//                                $this -> parent -> check_dependencies($field);
//
//                                TemPlazaFramework\Helpers\FieldHelper::check_required_dependencies($field,
//                                    $this -> field, $this -> parent);
//
//                                if(isset($this -> field['shortcode']) && $this -> field['shortcode']) {
//                                    $field['shortcode'] = $this -> field['shortcode'];
//                                    $field['name'] = $field['id'];
//                                    $f_value = $this -> parent -> get_default_value($field['id']);
//                                }else{
//                                    $field['id']    = $this -> field['id'].'-'.$field['id'];
//                                    $field['name']  = $this -> parent -> args['opt_name'].'['.$field['id'].']';
//                                    $f_value = isset ( $this ->parent->options[$f_org_id] ) ? $this ->parent->options[$f_org_id] : $this -> parent -> get_default_value($field['id']);
//                                }
//
//                                ob_start();
//                                $this -> parent -> _field_input($field, $f_value);
//                                $field_html = ob_get_contents();
//                                ob_end_clean();
//                                if(preg_match('/<script\b[^>]*>(.*?)<\/script>/is', $field_html)){
//                                    $field_html = preg_replace('/<script\b[^>]*>(.*?)<\/script>/is', '', $field_html);
//                                }
//
//                                $tab_contents   .= '<tr>';
//                                $tab_contents   .= '<th>'.$this -> parent -> get_header_html($field).'</th>';
//                                $tab_contents   .= '<td>'.$field_html.'<td>';
//                                $tab_contents   .= '</tr>';
//                            }
//                            $tab_contents   .= '</table>';
//                        }

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