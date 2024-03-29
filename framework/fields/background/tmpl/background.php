<?php

defined('TEMPLAZA_FRAMEWORK') or exit;

$field_id   = $this -> field['id'];

$this->select2_config['allowClear'] = true;

if ( isset( $this->field['select2'] ) ) {
    $this->field['select2'] = wp_parse_args( $this->field['select2'], $this->select2_config );
} else {
    $this->field['select2'] = $this->select2_config;
}

$this->field['select2'] = Redux_Functions::sanitize_camel_case_array_keys( $this->field['select2'] );

$select2_data = Redux_Functions::create_data_string( $this->field['select2'] );

//// Colour picker layout.
//if ( '' === $this->value['color'] || 'transparent' === $this->value['color'] ) {
//    $color = '';
//} else {
//    $color = Redux_Helpers::hex2rgba( $this->value['color'], $this->value['alpha'] );
//}
//
//if ( '' === $this->value['rgba'] && '' !== $this->value['color'] ) {
//    $this->value['rgba'] = Redux_Helpers::hex2rgba( $this->value['color'], $this->value['alpha'] );
//}

// Background Color
if ( true === $this->field['background-color'] ) {
    if ( isset( $this->value['color'] ) && empty( $this->value['background-color'] ) ) {
        $this->value['background-color'] = $this->value['color'];
    }

//    $def_bg_color = isset( $this->field['default']['background-color'] ) ? $this->field['default']['background-color'] : '';

    $bg_color       = '';
    if(is_array($this -> value['background-color']) && isset($this -> value['background-color']['color'])){
        $bg_color   = $this -> value['background-color']['color'];
    }elseif(!is_array($this -> value['background-color'])){
        $bg_color   = $this -> value['background-color'];
    }
    $bg_color_alpha  = 1;
    if(is_array($this -> value['background-color']) && isset($this -> value['background-color']['alpha'])){
    $bg_color_alpha = $this->value['background-color']['alpha'];
    }
//    elseif(!is_array($this -> value['background-color'])){
//        $bg_color_alpha   = $this -> value['background-color'];
//    }
//    if(isset($this -> value['background-color-alpha'])) {
//        $bg_color_alpha = $this->value['background-color-alpha'];
//    }
    $bg_color_rgba       = '';
//    if(isset($this -> value['background-color-rgba'])){
//        $bg_color_rgba   = $this -> value['background-color-rgba'];
//    }
    if(is_array($this -> value['background-color']) && isset($this -> value['background-color']['rgba'])){
        $bg_color_rgba   = $this -> value['background-color']['rgba'];
    }
//elseif(!is_array($this -> value['background-color'])){
//        $bg_color_rgba   = $this -> value['background-color'];
//    }

    // Color picker container.
    echo '<div 
                  class="redux-color-rgba-container ' . esc_attr( $this->field['class'] ) . '" 
                  data-id="' . esc_attr( $field_id ) . '"
                  data-show-input="' . esc_attr( $this->field['options']['show_input'] ) . '"
                  data-show-initial="' . esc_attr( $this->field['options']['show_initial'] ) . '"
                  data-show-alpha="' . esc_attr( $this->field['options']['show_alpha'] ) . '"
                  data-show-palette="' . esc_attr( $this->field['options']['show_palette'] ) . '"
                  data-show-palette-only="' . esc_attr( $this->field['options']['show_palette_only'] ) . '"
                  data-show-selection-palette="' . esc_attr( $this->field['options']['show_selection_palette'] ) . '"
                  data-max-palette-size="' . esc_attr( $this->field['options']['max_palette_size'] ) . '"
                  data-allow-empty="' . esc_attr( $this->field['options']['allow_empty'] ) . '"
                  data-clickout-fires-change="' . esc_attr( $this->field['options']['clickout_fires_change'] ) . '"
                  data-choose-text="' . esc_attr( $this->field['options']['choose_text'] ) . '"
                  data-cancel-text="' . esc_attr( $this->field['options']['cancel_text'] ) . '"
                  data-input-text="' . esc_attr( $this->field['options']['input_text'] ) . '"
                  data-show-buttons="' . esc_attr( $this->field['options']['show_buttons'] ) . '"
                  data-palette="' . rawurlencode( wp_json_encode( $this->field['options']['palette'] ) ) . '"
              >';
    // Colour picker layout.
    if ( '' === $bg_color || 'transparent' === $bg_color) {
        $color = '';
    } else {
        $color = Redux_Helpers::hex2rgba( $bg_color, $bg_color_alpha );
    }

    if ( '' === $bg_color_rgba && '' !== $bg_color ) {
        $bg_color_rgba = Redux_Helpers::hex2rgba( $bg_color, $bg_color_rgba );
    }

    echo '<input ';
    echo 'data-id="' . esc_attr( $this->field['id'] ) . '"';
    echo 'name="' . esc_attr( $this->field['name'] . $this->field['name_suffix'] ) . '[background-color][color]"';
    echo 'id="' . esc_attr( $this->field['id'] ) . '-color"';
    echo 'class="color-picker redux-color-rgba redux-background-input redux-color-init ' . esc_attr( $this->field['class'] ) . '"';
//    echo 'type="text"';
    echo 'type="text" value="'.esc_attr($bg_color).'"';
//    echo 'type="text" value="' . esc_attr( $this->value['background-color'] ) . '"';
//    echo 'data-default-color="' . esc_attr( $def_bg_color ) . '"';
    echo 'data-color="' . esc_attr( $color ) . '"';
    echo 'data-current-color="' . esc_attr( $bg_color ) . '"';
    echo 'data-block-id="' . esc_attr( $field_id ) . '"';
    echo 'data-output-transparent="' . esc_attr( $this->field['output_transparent'] ) . '"';

    echo '/>';

//    echo '<input type="hidden" class="redux-saved-color" id="' . esc_attr( $this->field['id'] ) . '-saved-color" value="">';
    echo '<input
                    type="hidden"
                    class="redux-hidden-color"
                    data-id="' . esc_attr( $field_id ) . '-color"
                    id="' . esc_attr( $field_id ) . '-color"
                    value="'.esc_attr($bg_color).'"
                  />';
//                    value="' . esc_attr( $this->value['background-color']['color'] ) . '"

    // Hidden input for alpha channel.
    echo '<input
                    type="hidden"
                    class="redux-hidden-alpha"
                    data-id="' . esc_attr( $field_id ) . '-alpha"
                    name="' . esc_attr( $this->field['name'] . $this->field['name_suffix'] ) . '[background-color][alpha]"
                    id="' . esc_attr( $field_id ) . '-alpha"
                    value="'.esc_attr($bg_color_alpha).'"
                  />';
//                    value="' . esc_attr( $this->value['background-color']['alpha'] ) . '"

    // Hidden input for rgba.
    echo '<input
                    type="hidden"
                    class="redux-hidden-rgba"
                    data-id="' . esc_attr( $field_id ) . '-rgba"
                    name="' . esc_attr( $this->field['name'] . $this->field['name_suffix'] ) . '[background-color][rgba]"
                    id="' . esc_attr( $field_id ) . '-rgba"
                    value="'.esc_attr($bg_color_rgba).'"
                  />';
//    value="' . esc_attr( $this->value['background-color']['rgba'] ) . '"

    if ( ! isset( $this->field['transparent'] ) || false !== $this->field['transparent'] ) {
        $is_checked = '';
        if ( 'transparent' === $this->value['background-color'] ) {
            $is_checked = ' checked="checked"';
        }
        echo '<label for="' . esc_attr( $this->field['id'] ) . '-transparency" class="color-transparency-check"><input type="checkbox" class="checkbox color-transparency redux-background-input ' . esc_attr( $this->field['class'] ) . '" id="' . esc_attr( $this->field['id'] ) . '-transparency" data-id="' . esc_attr( $this->field['id'] ) . '-color" value="1" ' . esc_html( $is_checked ) . '> ' . esc_html__( 'Transparent', 'redux-framework' ) . '</label>';
    }

    if ( true === $this->field['background-repeat'] || true === $this->field['background-position'] || true === $this->field['background-attachment'] ) {
        echo '<br />';
    }

    echo '</div>';
}
// Background Image
if ( $this->field['background-image'] ) {
    if ( true === $this->field['background-repeat'] ) {
        $array = array(
            'no-repeat' => esc_html__( 'No Repeat', 'redux-framework' ),
            'repeat'    => esc_html__( 'Repeat All', 'redux-framework' ),
            'repeat-x'  => esc_html__( 'Repeat Horizontally', 'redux-framework' ),
            'repeat-y'  => esc_html__( 'Repeat Vertically', 'redux-framework' ),
            'inherit'   => esc_html__( 'Inherit', 'redux-framework' ),
        );

        echo '<select id="' . esc_attr( $this->field['id'] ) . '-repeat-select" data-placeholder="' . esc_html__( 'Background Repeat', 'redux-framework' ) . '" name="' . esc_attr( $this->field['name'] . $this->field['name_suffix'] ) . '[background-repeat]" class="redux-select-item redux-background-input redux-background-repeat ' . esc_attr( $this->field['class'] ) . '"' . esc_attr( $select2_data ) . '>';
        echo '<option></option>';

        foreach ( $array as $k => $v ) {
            echo '<option value="' . esc_attr( $k ) . '" ' . selected( $this->value['background-repeat'], $k, false ) . '>' . esc_html( $v ) . '</option>';
        }

        echo '</select>';
    }

    if ( true === $this->field['background-clip'] ) {
        $array = array(
            'inherit'     => esc_html__( 'Inherit', 'redux-framework' ),
            'border-box'  => esc_html__( 'Border Box', 'redux-framework' ),
            'content-box' => esc_html__( 'Content Box', 'redux-framework' ),
            'padding-box' => esc_html__( 'Padding Box', 'redux-framework' ),
        );

        echo '<select id="' . esc_attr( $this->field['id'] ) . '-clip-select" data-placeholder="' . esc_html__( 'Background Clip', 'redux-framework' ) . '" name="' . esc_attr( $this->field['name'] . $this->field['name_suffix'] ) . '[background-clip]" class="redux-select-item redux-background-input redux-background-clip ' . esc_attr( $this->field['class'] ) . '"' . esc_attr( $select2_data ) . '>';
        echo '<option></option>';

        foreach ( $array as $k => $v ) {
            echo '<option value="' . esc_attr( $k ) . '" ' . selected( $this->value['background-clip'], $k, false ) . '>' . esc_html( $v ) . '</option>';
        }

        echo '</select>';
    }

    if ( true === $this->field['background-origin'] ) {
        $array = array(
            'inherit'     => esc_html__( 'Inherit', 'redux-framework' ),
            'border-box'  => esc_html__( 'Border Box', 'redux-framework' ),
            'content-box' => esc_html__( 'Content Box', 'redux-framework' ),
            'padding-box' => esc_html__( 'Padding Box', 'redux-framework' ),
        );

        echo '<select id="' . esc_attr( $this->field['id'] ) . '-origin-select" data-placeholder="' . esc_html__( 'Background Origin', 'redux-framework' ) . '" name="' . esc_attr( $this->field['name'] . $this->field['name_suffix'] ) . '[background-origin]" class="redux-select-item redux-background-input redux-background-origin ' . esc_attr( $this->field['class'] ) . '"' . esc_attr( $select2_data ) . '>';
        echo '<option></option>';

        foreach ( $array as $k => $v ) {
            echo '<option value="' . esc_attr( $k ) . '" ' . selected( $this->value['background-origin'], $k, false ) . '>' . esc_html( $v ) . '</option>';
        }

        echo '</select>';
    }

    if ( true === $this->field['background-size'] ) {
        $array = array(
            'inherit' => esc_html__( 'Inherit', 'redux-framework' ),
            'cover'   => esc_html__( 'Cover', 'redux-framework' ),
            'contain' => esc_html__( 'Contain', 'redux-framework' ),
        );

        echo '<select id="' . esc_attr( $this->field['id'] ) . '-size-select" data-placeholder="' . esc_html__( 'Background Size', 'redux-framework' ) . '" name="' . esc_attr( $this->field['name'] . $this->field['name_suffix'] ) . '[background-size]" class="redux-select-item redux-background-input redux-background-size ' . esc_attr( $this->field['class'] ) . '"' . esc_attr( $select2_data ) . '>';
        echo '<option></option>';

        foreach ( $array as $k => $v ) {
            echo '<option value="' . esc_attr( $k ) . '" ' . selected( $this->value['background-size'], $k, false ) . '>' . esc_html( $v ) . '</option>';
        }

        echo '</select>';
    }

    if ( true === $this->field['background-attachment'] ) {
        $array = array(
            'fixed'   => esc_html__( 'Fixed', 'redux-framework' ),
            'scroll'  => esc_html__( 'Scroll', 'redux-framework' ),
            'inherit' => esc_html__( 'Inherit', 'redux-framework' ),
        );

        echo '<select id="' . esc_attr( $this->field['id'] ) . '-attachment-select" data-placeholder="' . esc_html__( 'Background Attachment', 'redux-framework' ) . '" name="' . esc_attr( $this->field['name'] . $this->field['name_suffix'] ) . '[background-attachment]" class="redux-select-item redux-background-input redux-background-attachment ' . esc_attr( $this->field['class'] ) . '"' . esc_attr( $select2_data ) . '>';
        echo '<option></option>';

        foreach ( $array as $k => $v ) {
            echo '<option value="' . esc_attr( $k ) . '" ' . selected( $this->value['background-attachment'], $k, false ) . '>' . esc_html( $v ) . '</option>';
        }

        echo '</select>';
    }

    if ( true === $this->field['background-position'] ) {
        $array = array(
            'left top'      => esc_html__( 'Left Top', 'redux-framework' ),
            'left center'   => esc_html__( 'Left center', 'redux-framework' ),
            'left bottom'   => esc_html__( 'Left Bottom', 'redux-framework' ),
            'center top'    => esc_html__( 'Center Top', 'redux-framework' ),
            'center center' => esc_html__( 'Center Center', 'redux-framework' ),
            'center bottom' => esc_html__( 'Center Bottom', 'redux-framework' ),
            'right top'     => esc_html__( 'Right Top', 'redux-framework' ),
            'right center'  => esc_html__( 'Right center', 'redux-framework' ),
            'right bottom'  => esc_html__( 'Right Bottom', 'redux-framework' ),
        );

        echo '<select id="' . esc_attr( $this->field['id'] ) . '-position-select" data-placeholder="' . esc_html__( 'Background Position', 'redux-framework' ) . '" name="' . esc_attr( $this->field['name'] . $this->field['name_suffix'] ) . '[background-position]" class="redux-select-item redux-background-input redux-background-position ' . esc_attr( $this->field['class'] ) . '"' . esc_attr( $select2_data ) . '>';
        echo '<option></option>';

        foreach ( $array as $k => $v ) {
            echo '<option value="' . esc_attr( $k ) . '" ' . selected( $this->value['background-position'], $k, false ) . '>' . esc_html( $v ) . '</option>';
        }

        echo '</select>';
    }

    if ( $this->field['background-image'] ) {
        echo '<br />';

        if ( empty( $this->value ) && ! empty( $this->field['default'] ) ) {
            if ( is_array( $this->field['default'] ) ) {
                if ( ! empty( $this->field['default']['media']['id'] ) ) {
                    $this->value['media']['id'] = $this->field['default']['media']['id'];
                } elseif ( ! empty( $this->field['default']['id'] ) ) {
                    $this->value['media']['id'] = $this->field['default']['id'];
                }

                if ( ! empty( $this->field['default']['url'] ) ) {
                    $this->value['background-image'] = $this->field['default']['url'];
                } elseif ( ! empty( $this->field['default']['media']['url'] ) ) {
                    $this->value['background-image'] = $this->field['default']['media']['url'];
                } elseif ( ! empty( $this->field['default']['background-image'] ) ) {
                    $this->value['background-image'] = $this->field['default']['background-image'];
                }
            } else {
                if ( is_numeric( $this->field['default'] ) ) { // Check if it's an attachment ID.
                    $this->value['media']['id'] = $this->field['default'];
                } else { // Must be a URL.
                    $this->value['background-image'] = $this->field['default'];
                }
            }
        }

        if ( empty( $this->value['background-image'] ) && ! empty( $this->value['media']['id'] ) ) {
            $img                             = wp_get_attachment_image_src( $this->value['media']['id'], 'full' );
            $this->value['background-image'] = $img[0];
            $this->value['media']['width']   = $img[1];
            $this->value['media']['height']  = $img[2];
        }

        $hide = 'hide ';

        if ( ( isset( $this->field['preview_media'] ) && false === $this->field['preview_media'] ) ) {
            $this->field['class'] .= ' noPreview';
        }

        if ( ( ! empty( $this->field['background-image'] ) && true === $this->field['background-image'] ) || isset( $this->field['preview'] ) && false === $this->field['preview'] ) {
            $hide = '';
        }

        $placeholder = isset( $this->field['placeholder'] ) ? $this->field['placeholder'] : esc_html__( 'No media selected', 'redux-framework' );

        echo '<input placeholder="' . esc_html( $placeholder ) . '" type="text" class="redux-background-input ' . esc_attr( $hide ) . 'upload ' . esc_attr( $this->field['class'] ) . '" name="' . esc_attr( $this->field['name'] . $this->field['name_suffix'] ) . '[background-image]" id="' . esc_attr( $this->parent->args['opt_name'] ) . '[' . esc_attr( $this->field['id'] ) . '][background-image]" value="' . esc_url( $this->value['background-image'] ) . '" />';
        echo '<input type="hidden" class="upload-id ' . esc_attr( $this->field['class'] ) . '" name="' . esc_attr( $this->field['name'] . $this->field['name_suffix'] ) . '[media][id]" id="' . esc_attr( $this->parent->args['opt_name'] ) . '[' . esc_attr( $this->field['id'] ) . '][media][id]" value="' . esc_attr( $this->value['media']['id'] ) . '" />';
        echo '<input type="hidden" class="upload-height" name="' . esc_attr( $this->field['name'] . $this->field['name_suffix'] ) . '[media][height]" id="' . esc_attr( $this->parent->args['opt_name'] ) . '[' . esc_attr( $this->field['id'] ) . '][media][height]" value="' . esc_attr( $this->value['media']['height'] ) . '" />';
        echo '<input type="hidden" class="upload-width" name="' . esc_attr( $this->field['name'] . $this->field['name_suffix'] ) . '[media][width]" id="' . esc_attr( $this->parent->args['opt_name'] ) . '[' . esc_attr( $this->field['id'] ) . '][media][width]" value="' . esc_attr( $this->value['media']['width'] ) . '" />';
        echo '<input type="hidden" class="upload-thumbnail" name="' . esc_attr( $this->field['name'] . $this->field['name_suffix'] ) . '[media][thumbnail]" id="' . esc_attr( $this->parent->args['opt_name'] ) . '[' . esc_attr( $this->field['id'] ) . '][media][thumbnail]" value="' . esc_url( $this->value['media']['thumbnail'] ) . '" />';

        // Preview.
        $hide = '';

        if ( ( isset( $this->field['preview_media'] ) && false === $this->field['preview_media'] ) || empty( $this->value['background-image'] ) ) {
            $hide = 'hide ';
        }

        if ( empty( $this->value['media']['thumbnail'] ) && ! empty( $this->value['background-image'] ) ) { // Just in case.
            if ( ! empty( $this->value['media']['id'] ) ) {
                $image = wp_get_attachment_image_src(
                    $this->value['media']['id'],
                    array(
                        150,
                        150,
                    )
                );

                $this->value['media']['thumbnail'] = $image[0];
            } else {
                $this->value['media']['thumbnail'] = $this->value['background-image'];
            }
        }

        echo '<div class="' . esc_attr( $hide ) . 'screenshot">';
        echo '<a class="of-uploaded-image" href="' . esc_url( $this->value['background-image'] ) . '" target="_blank">';

        $alt = wp_prepare_attachment_for_js( $this->value['media']['id'] );
        $alt = isset( $alt['alt'] ) ? $alt['alt'] : '';

        echo '<img class="redux-option-image" id="image_' . esc_attr( $this->value['media']['id'] ) . '" src="' . esc_url( $this->value['media']['thumbnail'] ) . '" alt="' . esc_attr( $alt ) . '" target="_blank" rel="external" />';
        echo '</a>';
        echo '</div>';

        // Upload controls DIV.
        echo '<div class="upload_button_div">';

        // If the user has WP3.5+ show upload/remove button.
        echo '<span class="button redux-background-upload" id="' . esc_attr( $this->field['id'] ) . '-media">' . esc_html__( 'Upload', 'redux-framework' ) . '</span>';

        $hide = '';
        if ( empty( $this->value['background-image'] ) || '' === $this->value['background-image'] ) {
            $hide = ' hide';
        }

        echo '<span class="button removeCSS redux-remove-background' . esc_attr( $hide ) . '" id="reset_' . esc_attr( $this->field['id'] ) . '" rel="' . esc_attr( $this->field['id'] ) . '">' . esc_html__( 'Remove', 'redux-framework' ) . '</span>';

        echo '</div>';
    }

    /**
     * Preview
     * */
    if ( ! isset( $this->field['preview'] ) || false !== $this->field['preview'] ) {
        $css = $this->css_style( $this->value );

        $is_bg = strpos( $css, 'background-image' );

        if ( empty( $css ) || ! $is_bg ) {
            $css = 'display:none;';
        }

        $css .= 'height: ' . esc_attr( $this->field['preview_height'] ) . ';';
        echo '<p class="clear ' . esc_attr( $this->field['id'] ) . '_previewer background-preview" style="' . esc_attr( $css ) . '">&nbsp;</p>';
    }
}