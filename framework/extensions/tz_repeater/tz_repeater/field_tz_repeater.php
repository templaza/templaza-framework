<?php

/**
 * Redux Framework is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 2 of the License, or
 * any later version.
 * Redux Framework is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 * You should have received a copy of the GNU General Public License
 * along with Redux Framework. If not, see <http://www.gnu.org/licenses/>.
 *
 * @package     ReduxFramework
 * @subpackage  Field_slides
 * @author      Luciano "WebCaos" Ubertini
 * @author      Daniel J Griffiths (Ghost1227)
 * @author      Dovy Paukstys
 * @version     3.0.0
 */

// Exit if accessed directly
if ( !defined ( 'ABSPATH' ) ) {
    exit;
}

use TemPlazaFramework\Functions;

// Don't duplicate me!
if ( !class_exists ( 'ReduxFramework_TZ_Repeater' ) ) {


    /**
     * Main ReduxFramework_slides class
     *
     * @since       1.0.0
     */
    class ReduxFramework_TZ_Repeater {
        protected $fields_html  = '';

        /**
         * Field Constructor.
         * Required - must call the parent constructor, then assign field and value to vars, and obviously call the render field function
         *
         * @since       1.0.0
         * @access      public
         * @return      void
         */
        function __construct ( $field = array(), $value = '', $parent ) {
            $this->parent = $parent;
            $this->field = $field;
            $this->value = $value;

//            var_dump($field); die();


//            $field_html = '';
//            if(isset($this -> field['fields']) && count($this -> field['fields'])){
//                $fields = $this -> field['fields'];
//
//                $enqueue = new reduxCoreEnqueue ( $parent );
//
//                foreach ($fields as &$field){
//
//                    $field_class = "ReduxFramework_{$field['type']}";
//                    $field['name']  = $this -> field['name'].'['.$x.']['.$field['id'].']';
//                    $field['class'] = '';
//
//
////                    $render = new $field_class ( $field, '', $this -> parent );
//
////                    var_dump($render); die();
//                    ob_start();
//                    $this -> parent -> _field_input($field);
////                    $render -> render();
//                    $this -> fields_html    .= '<li>'.ob_get_contents().'</li>';
//                    ob_end_clean();
////                    add_filter( "redux/options/{$this->parent->args['opt_name']}/field/{$field['id']}/register", function () use ($field){
////                        return $field;
////                    });
////                    add_filter("redux-field-{$this->parent->args['opt_name']}", function ($content, $field){
////
////                        var_dump($content);
////                    }, 10, 2);
//
//                    $enqueue ->_enqueue_field($field);
////                    $this -> fields_html    = '<li>'.$field_html.'</li>';
//                }
//            }

//            $field_html = '';
//            if(isset($this -> field['fields']) && count($this -> field['fields'])){
//                $fields = $this -> field['fields'];
//
//                $enqueue = new reduxCoreEnqueue ( $parent );
//                foreach ($fields as $f){
//
//                    $enqueue -> _enqueue_field($f);
//                }
//            }
//            add_action('redux/field/'.$parent->args['opt_name'].'/tz_repeater/render/before', function()use($field, $parent){
////
//                if(isset($field['fields']) && count($field['fields'])){
//                    $fields = $field['fields'];
//
//                    foreach ($fields as $f){
//                        $enqueue = new reduxCoreEnqueue ( $parent );
//                        $enqueue -> _enqueue_field($f);
//
////                        $field_class = 'ReduxFramework_' . $f['type'];
////                        $theField = new $field_class( $f, $parent->options[ $f['id'] ], $parent );
////                        $theField -> enqueue();
//                    }
//                }
//            });
//
////            var_dump($this -> field['fields']);
        }

        /**
         * Field Render Function.
         * Takes the vars and outputs the HTML for the field in the settings
         *
         * @since       1.0.0
         * @access      public
         * @return      void
         */
        public function render () {

//            $field_html = '';
//            if(isset($this -> field['fields']) && count($this -> field['fields'])){
//                $fields = $this -> field['fields'];
//
//                foreach ($fields as $field){
//
//                    $field_class = "ReduxFramework_{$field['type']}";
//
//
////                    $render = new $field_class ( $field, '', $this -> parent );
//
////                    var_dump($render); die();
//                    ob_start();
//                    $this -> parent -> _field_input($field);
////                    $render -> render();
//                    $field_html    .= ob_get_contents();
//                    ob_end_clean();
////                    add_filter( "redux/options/{$this->parent->args['opt_name']}/field/{$field['id']}/register", function () use ($field){
////                        return $field;
////                    });
////                    add_filter("redux-field-{$this->parent->args['opt_name']}", function ($content, $field){
////
////                        var_dump($content);
////                    }, 10, 2);
//                }
//            }
//            echo 'tz_repeater';
//            var_dump($this -> field['name']);
//            echo $field_html;

            echo '<div class="redux-slides-accordion" data-new-content-title="' . esc_attr ( sprintf ( __ ( 'New %s', 'redux-framework' ), $this->field[ 'title' ] ) ) . '">';

            $x = 0;

            if ( $x == 0 ) {
                echo '<div class="redux-slides-accordion-group" data-slide-count="'.$x.'"><fieldset class="redux-field" data-id="' . $this->field[ 'id' ] . '"><h3><span class="redux-slides-header">' . esc_attr ( sprintf ( __ ( 'New %s', 'redux-framework' ), $this->field[ 'title' ] ) ) . '</span></h3><div>';

                $hide = ' hide';

                echo '<ul id="' . $this->field[ 'id' ] . '-ul" class="redux-slides-list">';

                if(isset($this -> field['fields']) && count($this -> field['fields'])){
                    $fields = $this -> field['fields'];

                    foreach ($fields as &$field){
                        $field_html = '';

                        $field_class = "ReduxFramework_{$field['type']}";
                        $field['name']  = $this -> field['name'].'['.$x.']['.$field['id'].']';
                        $field['class'] = '';
                        $field['id']    = $this->field[ 'id' ].'-'.$field['id'].'_'.$x;


    //                    $render = new $field_class ( $field, '', $this -> parent );

    //                    var_dump($render); die();
                        ob_start();
                        $this -> parent -> _field_input($field);
    //                    $render -> render();
                        $field_html    .= ob_get_contents();
                        ob_end_clean();
    //                    add_filter( "redux/options/{$this->parent->args['opt_name']}/field/{$field['id']}/register", function () use ($field){
    //                        return $field;
    //                    });
    //                    add_filter("redux-field-{$this->parent->args['opt_name']}", function ($content, $field){
    //
    //                        var_dump($content);
    //                    }, 10, 2);

    //                    $enqueue = new reduxCoreEnqueue ( $this -> parent );
    //                    $enqueue ->_enqueue_field($field);
                        echo '<li data-slide-item-type="'.$field['type'].'">'.$field_html.'</li>';
                    }
                }

                echo '</ul></div></fieldset></div>';
            }
            echo '</div><a href="javascript:void(0);" class="button redux-tz_repeater-add button-primary" rel-id="' . $this->field[ 'id' ] . '-ul" rel-name="' . $this->field[ 'name' ] . '[title][]' . $this->field['name_suffix'] .'">' . sprintf ( __ ( 'Add %s', 'redux-framework' ), $this->field[ 'title' ] ) . '</a><br/>';
        }

        /**
         * Enqueue Function.
         * If this field requires any scripts, or css define this function and register/enqueue the scripts/css
         *
         * @since       1.0.0
         * @access      public
         * @return      void
         */
        public function enqueue () {

            if(isset($this -> field['fields']) && count($this -> field['fields'])){
                $fields = $this -> field['fields'];

                $enqueue = new reduxCoreEnqueue ( $this -> parent );
                foreach ($fields as $f){
                    $enqueue -> _enqueue_field($f);
//                    $f['name']  = $this -> field['name'].'[][]';
//                    var_dump($f); die();

//                        $field_class = 'ReduxFramework_' . $f['type'];
//                        $theField = new $field_class( $f, '', $this -> parent );
//                        $theField -> enqueue();
                }
            }


//            if ( function_exists( 'wp_enqueue_media' ) ) {
//                wp_enqueue_media();
//            } else {
//                wp_enqueue_script( 'media-upload' );
//            }
                
            if ($this->parent->args['dev_mode']){
                wp_enqueue_style ('redux-field-media-css');

                wp_enqueue_style (
                    'redux-field-slides-css', 
//                    ReduxFramework::$_url . 'inc/fields/slides/field_slides.css',
                    Functions::get_my_frame_url() . '/extensions/tz_repeater/tz_repeater/tz_repeater.css',
                    array(),
                    time (), 
                    'all'
                );
            }
            
//            wp_enqueue_script(
//                'redux-field-media-js',
//                ReduxFramework::$_url . 'assets/js/media/media' . Redux_Functions::isMin() . '.js',
//                array( 'jquery', 'redux-js' ),
//                time(),
//                true
//            );

            wp_enqueue_script (
                'redux-field-slides-js',
                Functions::get_my_frame_url() . '/extensions/tz_repeater/tz_repeater/tz_repeater' . Redux_Functions::isMin () . '.js',
                array( 'jquery', 'jquery-ui-core', 'jquery-ui-accordion', 'jquery-ui-sortable', 'redux-field-media-js' ),
                time (),
                true
            );
        }
    }
}