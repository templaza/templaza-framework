<?php
/**
 * Field TZ Select Image
 *
 * @package     Redux Framework/Fields
 * @since       1.0.0
 * @author      TemPlaza <DuongTV>
 * @version     1.0.0
 */

defined( 'TEMPLAZA_FRAMEWORK' ) || exit;

use TemPlazaFramework\Functions;

if ( ! class_exists( 'Redux_TZ_Select_Image', false ) ) {

//    if(! class_exists( 'Redux_Select_Image', false ) ){
//
//        if(($field_path = Redux_Core::$dir.'inc/fields/select_image/class-redux-select-image.php') && file_exists($field_path)) {
//            require_once $field_path;
//        }
//    }

    /**
     * Class Redux_TZ_Select_Image
     */
    class Redux_TZ_Select_Image extends Redux_Field {

        /**
         * Field Render Function.
         * Takes the vars and outputs the HTML for the field in the settings
         *
         * @since ReduxFramework 1.0.0
         */
        public function render() {

            // If options is NOT empty, the process.
            if ( ! empty( $this->field['options'] ) ) {

                // bean counter.
                $x = 1;

                // Process width.
                if ( ! empty( $this->field['width'] ) ) {
                    $width = ' style="width:' . esc_attr( $this->field['width'] ) . ';"';
                } else {
                    $width = ' style="width: 40%;"';
                }

                // Process placeholder.
                $placeholder = ( isset( $this->field['placeholder'] ) ) ? esc_attr( $this->field['placeholder'] ) : esc_html__( 'Select an item', 'redux-framework' );

                $this->select2_config['allowClear'] = true;

                if ( isset( $this->field['select2'] ) ) {
                    $this->field['select2'] = wp_parse_args( $this->field['select2'], $this->select2_config );
                } else {
                    $this->field['select2'] = $this->select2_config;
                }

                $this->field['select2'] = Redux_Functions::sanitize_camel_case_array_keys( $this->field['select2'] );

                $select2_data = Redux_Functions::create_data_string( $this->field['select2'] );

                // Begin the <select> tag.
                echo '<select 
						data-id="' . esc_attr( $this->field['id'] ) . '" 
						data-placeholder="' . esc_attr( $placeholder ) . '" 
						name="' . esc_attr( $this->field['name'] . $this->field['name_suffix'] ) . '" 
						class="redux-select-item redux-select-images ' . esc_attr( $this->field['class'] ) . '"' .
                    $width . ' rows="6"' . esc_attr( $select2_data ) . '>';  // phpcs:ignore WordPress.Security.EscapeOutput

                echo '<option></option>';

                // Enum through the options array.
                foreach ( $this->field['options'] as $k => $v ) {

                    // No array?  No problem!
                    if ( ! is_array( $v ) ) {
                        $v = array( 'img' => $v );
                    }

                    // No title set?  Make it blank.
                    if ( ! isset( $v['title'] ) ) {
                        $v['title'] = '';
                    }

                    // No alt?  Set it to title.  We do this so the alt tag shows
                    // something.  It also makes HTML/SEO purists happy.
                    if ( ! isset( $v['alt'] ) ) {
                        $v['alt'] = $v['title'];
                    }

                    if ( ! isset( $v['class'] ) ) {
                        $v['class'] = '';
                    }

                    // Set the selected entry.
                    if ( is_array( $this->value ) ) {
                        $selected = ( is_array( $this->value ) && in_array( $k, $this->value, true ) ) ? ' selected="selected"' : '';
                    } else {
                        $selected = selected( $this->value, $k, false );
                    }
//                    $selected = selected( $this->value, $v['img'], false );

                    // If selected returns something other than a blank space, we
                    // found our default/saved name.  Save the array number in a
                    // variable to use later on when we want to extract its associated
                    // url.
                    if ( '' !== $selected ) {
                        $arr_num = $x;
                    }

                    // Add the option tag, with values.
                    echo '<option value="' . esc_attr( $k ) . '"  data-image="' . esc_url( $v['img'] )
                        . '" ' . esc_html( $selected ) . '>' . esc_attr( $v['alt'] ) . '</option>';

                    // Add a bean.
                    $x ++;
                }

                // Close the <select> tag.
                echo '</select>';

                // Some space.
                echo '<br /><br />';

                // Show the preview image.
                echo '<div>';

                // just in case.  You never know.
                if ( ! isset( $arr_num ) ) {
                    $this->value = '';
                }

                // Set the default image.  To get the url from the default name,
                // we save the array count from the for/each loop, when the default image
                // is mark as selected.  Since the for/each loop starts at one, we must
                // subtract one from the saved array number.  We then pull the url
                // out of the options array, and there we go.

                if ( '' === $this->value ) {
                    echo '<img src="#" class="redux-preview-image'
                        .(!empty($v['class'])?' '.$v['class']:'').'" style="visibility:hidden;" id="image_'
                        . esc_attr( $this->field['id'] ) . '">';
                } else {
                    $f_options   = $this->field['options'];
                    echo '<img src="' . esc_url( $f_options[$this->value]['img'] ) . '" class="redux-preview-image'
                        .(!empty($v['class'])?' '.$v['class']:'').'" id="image_'. esc_attr( $this->field['id'] ) . '">';
                }

                // Close the <div> tag.
                echo '</div>';
            } else {

                // No options specified.  Really?
                echo '<strong>' . esc_html__( 'No items of this type were found.', 'redux-framework' ) . '</strong>';
            }
        }

        /**
         * Enqueue Function.
         * If this field requires any scripts, or css define this function and register/enqueue the scripts/css
         *
         * @since ReduxFramework 1.0.0
         */
        public function enqueue() {
            wp_enqueue_style( 'select2-css' );

            wp_enqueue_script(
                'field-tz_select_image-js',
                Functions::get_my_frame_url() . '/fields/tz_select_image/field_tz_select_image.js',
                array( 'jquery', 'select2-js', 'redux-js' ),
                $this->timestamp,
                true
            );

//            if ( $this->parent->args['dev_mode'] ) {
//                wp_enqueue_style(
//                    'redux-field-select-image-css',
//                    Redux_Core::$url . 'inc/fields/select_image/redux-select-image.css',
//                    array(),
//                    $this->timestamp,
//                    'all'
//                );
//            }
        }
    }
}
