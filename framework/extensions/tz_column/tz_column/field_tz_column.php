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
use TemPlazaFramework\Extensions\TZ_Column\Helper;

// Don't duplicate me!
if ( !class_exists ( 'ReduxFramework_TZ_Column' ) ) {


    /**
     * Main ReduxFramework_slides class
     *
     * @since       1.0.0
     */
    class ReduxFramework_TZ_Column {
        private $text_domain;

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

            $this -> text_domain    = Functions::get_my_text_domain();

            // Set field array defaults.  No errors please
            $defaults = array(
                'fields' => array(
                    array(
                        'id' => 'width',
                        'type' => 'slider',
                        'title' => 'Width',
                        'description' => __('Min: 1, Max: 12, Default value: 1', $this->text_domain),
                        'min' => 1,
                        'max' => 12,
                        'step' => 1,
                        'default' => 1,
                    ),
//                    array(
//                        'id'    => 'type',
//                        'type'  => 'button_set',
//                        'title' => __('Type', $this -> text_domain),
//                        'options' => array(
//                            'sidebar' => __('Sidebar', $this -> text_domain),
//                        ),
//                        'default' => 'sidebar',
//                    ),
                    array(
                        'id' => 'sidebar',
                        'type' => 'select',
                        'title' => __('Sidebar', $this->text_domain),
                        'data' => 'sidebars',
//                        'required' => array($this -> field['id'].'-type', '=', 'sidebar'),
                    ),
                    array(
                        'id' => 'custom_class',
                        'type' => 'text',
                        'title' => __('Custom Class', $this->text_domain),
                    ),
                ),
            );

//            if(isset($this -> field['fields']) && !empty($this -> field['fields'])) {
//                $this -> field['fields']   = array_merge($defaults['fields'], $this -> field['fields']);
//            }
            $this->field = wp_parse_args($this->field, $defaults);
//            var_dump($this->field);

            if(isset($this -> field['fields']) && count($this -> field['fields'])){
                $fields = $this -> field['fields'];

                $field_option   = isset($this -> field['options'])?(array) $this -> field['options']:array();

                foreach ($fields as &$f){

                    if(isset($field_option[$f['id']]) && isset($f['options'])){
                        $f['options']   = array_merge($field_option[$f['id']], $f['options']);
                    }

                    $f['value'] = '';
                    if(isset($this -> value[$f['id']])) {
                        $f['value'] = $this -> value[$f['id']];
                    }elseif(isset($f['default'])){
                        $f['value'] = $f['default'];
                    }
                    $f['name']  = $this -> field['name'].'['.$f['id'].']';
                    $f['class'] = '';
                    $f['id']    = $this->field[ 'id' ].'-'.$f['id'];



                    $this -> parent -> field_default_values($f);
                    $this -> parent -> check_dependencies($f);

                    Helper::check_required_dependencies($f, $this -> field, $this -> parent);

                }

                $this -> field['fields']    = $fields;
            }
//            }
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
//            echo '<div id="' . $this->field['id'] . '" class="redux-tz_column-container" data-id="' . $this->field['id'] . '">';

            if(isset($this -> field['fields']) && count($this -> field['fields'])){
                $fields = $this -> field['fields'];

                echo '<table>';
                foreach ($fields as &$field){
                    echo '<tr>';
                    echo '<th scope="row">';
                    echo $this -> parent -> get_header_html($field);
                    echo '</th>';
                    echo '<td>';
                    echo $this -> parent -> _field_input($field, (isset($field['value'])?$field['value']:null));
                    echo '</td>';
                    echo '</tr>';
                }
                echo '</table>';
            }
//            echo '</div>';
        }

        public function enqueue(){
            if (!wp_style_is('templaza-field-tz_column-css')) {
                wp_enqueue_style(
                    'templaza-field-tz_column-css',
                    Functions::get_my_frame_url() . '/extensions/tz_column/tz_column/field_tz_column.css',
                    array(),
                    time(),
                    'all'
                );
            }
            if (!wp_script_is('templaza-field-tz_column-js')) {
                wp_enqueue_script(
                    'templaza-field-tz_column-js',
                    Functions::get_my_frame_url() . '/extensions/tz_column/tz_column/field_tz_column.js',
                    array(),
                    time(),
                    'all'
                );
            }
        }
    }
}