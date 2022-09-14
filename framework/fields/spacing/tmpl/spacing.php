<?php

/*
 * Acceptable values checks.  If the passed variable doesn't pass muster, we unset them
 * and reset them with default values to avoid errors.
 */

defined('TEMPLAZA_FRAMEWORK') or exit;

//$devices    = array(
//    'desktop' => array(
//        'title'=> esc_html__('Desktop', 'templaza-framework'),
//        'icon' => 'dashicons dashicons-desktop',
//    ),
//    'tablet'  => array(
//        'title'=> esc_html__('Tablet', 'templaza-framework'),
//        'icon' => 'dashicons dashicons-tablet',
//    ),
//    'mobile'  => array(
//        'title'=> esc_html__('Mobile', 'templaza-framework'),
//        'icon' => 'dashicons dashicons-smartphone',
//        'uk-icon' => 'dashicons dashicons-smartphone',
//    ),
//);

$devices    = $this -> devices();
$allow_responsive   = isset($this -> field['allow_responsive'])?filter_var($this -> field['allow_responsive'], FILTER_VALIDATE_BOOLEAN):false;

if($allow_responsive){
?>
<div data-responsive="<?php echo (isset($this -> field['allow_responsive'])?(int) $this -> field['allow_responsive']:0);
?>" data-field-device="desktop">
<?php }?>
    <?php
    $unit_arr = Redux_Helpers::$array_units;

    $unit_check     = $unit_arr;
    $unit_check[]   = false;
    $position       = array(
        'top'       => 'top',
        'left'      => 'left',
        'right'     => 'right',
        'bottom'    => 'bottom'
    );
    $hints          = isset($this -> field['hint'])?$this -> field['hint']:array(
        'top'    => esc_html__('Top', 'templaza-framework'),
        'right'  => esc_html__('Right', 'templaza-framework'),
        'bottom' => esc_html__('Bottom', 'templaza-framework'),
        'left'   => esc_html__('Left', 'templaza-framework'),
    );

    $unit_responsive    = array();
    if($allow_responsive) {
        $unit_responsive = $this->value['units'];
    }

//    var_dump('<pre>');
////    var_dump($unit_responsive);
//    var_dump($this->field['units']);
////    var_dump($unit_responsive);
////    var_dump($unit_arr);
//    var_dump('</pre>');

    // If units field has a value but is not an acceptable value, unset the variable.
    if ( ! Redux_Helpers::array_in_array( $this->field['units'], $unit_check ) ) {
        $this->field['units'] = 'px';
    }

    // If there is a default unit value  but is not an accepted value, unset the variable.
    if ( ! Redux_Helpers::array_in_array( $this->value['units'], $unit_check ) ) {
        $this->value['units'] = 'px';
    }

    if ( false === $this->field['units'] ) {
        '' === $this->value['units'];
    }

    //if ( ! in_array( $this->field['mode'], array( 'margin', 'padding' ), true ) ) {
        if ( 'absolute' === $this->field['mode'] ) {
            $this->field['mode'] = '';
        } elseif(!$this -> field['mode']) {
            $this->field['mode'] = 'padding';
        }
    //}

    if($this -> field['mode'] == 'border-radius'){
        $position['top']        = 'top-left';
        $position['right']      = 'top-right';
        $position['bottom']     = 'bottom-right';
        $position['left']       = 'bottom-left';

        if(isset($this -> field['custom-position']) && count($this -> field['custom-position'])){
            $position   = array_merge($position, $this -> field['custom-position']);
        }

        $hints['top']       = esc_html__('Top Left', 'templaza-framework');
        $hints['right']     = esc_html__('Top Right', 'templaza-framework');
        $hints['bottom']    = esc_html__('Bottom Right', 'templaza-framework');
        $hints['left']      = esc_html__('Bottom Left', 'templaza-framework');

    }


    $value_responsive   = array();
    if($allow_responsive){
        $value_responsive = array(
            'top' => isset($this->value[$this->field['mode'] . '-' . $position['top']]) ? $this->value[$this->field['mode'] . '-' . $position['top']]:array(),
            'right' => isset($this->value[$this->field['mode'] . '-' . $position['right']]) ? $this->value[$this->field['mode'] . '-' . $position['right']]:array(),
            'bottom' => isset($this->value[$this->field['mode'] . '-' . $position['bottom']]) ? $this->value[$this->field['mode'] . '-' . $position['bottom']]:array(),
            'left' => isset($this->value[$this->field['mode'] . '-' . $position['left']]) ? $this->value[$this->field['mode'] . '-' . $position['left']]:array(),
        );
        if(isset($this->value[$this->field['mode'] . '-' . $position['top']]['desktop'])) {
            $value = array(
                'top' => isset($this->value[$this->field['mode'] . '-' . $position['top']]['desktop']) ? filter_var($this->value[$this->field['mode'] . '-' . $position['top']]['desktop'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION) : filter_var($this->value['top'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION),
                'right' => isset($this->value[$this->field['mode'] . '-' . $position['right']]['desktop']) ? filter_var($this->value[$this->field['mode'] . '-' . $position['right']]['desktop'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION) : filter_var($this->value['right'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION),
                'bottom' => isset($this->value[$this->field['mode'] . '-' . $position['bottom']]['desktop']) ? filter_var($this->value[$this->field['mode'] . '-' . $position['bottom']]['desktop'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION) : filter_var($this->value['bottom'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION),
                'left' => isset($this->value[$this->field['mode'] . '-' . $position['left']]['desktop']) ? filter_var($this->value[$this->field['mode'] . '-' . $position['left']]['desktop'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION) : filter_var($this->value['left'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION),
            );
        }else{
            $value = array(
                'top' => isset($this->value[$this->field['mode'] . '-' . $position['top']]) ? filter_var($this->value[$this->field['mode'] . '-' . $position['top']], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION) : (isset($this -> value['top'])?filter_var($this->value['top'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION):''),
                'right' => isset($this->value[$this->field['mode'] . '-' . $position['right']]) ? filter_var($this->value[$this->field['mode'] . '-' . $position['right']], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION) : (isset($this -> value['right'])?filter_var($this->value['right'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION):''),
                'bottom' => isset($this->value[$this->field['mode'] . '-' . $position['bottom']]) ? filter_var($this->value[$this->field['mode'] . '-' . $position['bottom']], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION) : (isset($this -> value['bottom'])?filter_var($this->value['bottom'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION):''),
                'left' => isset($this->value[$this->field['mode'] . '-' . $position['left']]) ? filter_var($this->value[$this->field['mode'] . '-' . $position['left']], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION) : (isset($this -> value['left'])?filter_var($this->value['left'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION):''),
            );
        }
    }else {
        $value = array(
            'top' => (isset($position['top']) && isset($this->value[$this->field['mode'] . '-' . $position['top']])) ? filter_var($this->value[$this->field['mode'] . '-' . $position['top']], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION) : filter_var((isset($this->value['top'])?$this->value['top']:''), FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION),
            'right' => (isset($position['right']) && isset($this->value[$this->field['mode'] . '-' . $position['right']])) ? filter_var($this->value[$this->field['mode'] . '-' . $position['right']], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION) : filter_var((isset($this->value['right'])?$this->value['right']:''), FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION),
            'bottom' => (isset($position['bottom']) && isset($this->value[$this->field['mode'] . '-' . $position['bottom']])) ? filter_var($this->value[$this->field['mode'] . '-' . $position['bottom']], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION) : filter_var((isset($this->value['bottom'])?$this->value['bottom']:''), FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION),
            'left' => (isset($position['left']) && isset($this->value[$this->field['mode'] . '-' . $position['left']])) ? filter_var($this->value[$this->field['mode'] . '-' . $position['left']], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION) : filter_var((isset($this->value['left'])?$this->value['left']:''), FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION),
        );
    }

    // if field units has a value and is NOT an array, then evaluate as needed.
    if ( ! is_array( $this->field['units'] ) ) {

        // If units fields has a value and is not empty but units value does not then make units value the field value.
        if ( '' === $this->value['units'] && ( '' !== $this->field['units'] || false === $this->field['units'] ) ) {
            $this->value['units'] = $this->field['units'];

            // If units field does NOT have a value and units value does NOT have a value, set both to blank (default?).
        } elseif ( '' === $this->field['units'] && '' === $this->value['units'] ) {
            $this->field['units'] = 'px';
            $this->value['units'] = 'px';

            // If units field has NO value but units value does, then set unit field to value field.
        } elseif ( '' === $this->field['units'] && '' !== $this->value['units'] ) {
            $this->field['units'] = $this->value['units'];

            // if unit value is set and unit value doesn't equal unit field (coz who knows why)
            // then set unit value to unit field.
        } elseif ( '' !== $this->value['units'] && $this->field['units'] !== $this->value['units'] ) {
            $this->value['units'] = $this->field['units'];
        }

        // do stuff based on unit field NOT set as an array.
        // phpcs:ignore Generic.CodeAnalysis.EmptyStatement
    } elseif ( ! empty( $this->field['units'] ) && is_array( $this->field['units'] ) ) {
        // nothing to do here, but I'm leaving the construct just in case I have to debug this again.

//        $value_responsive['units'] = $this->value['units'];
    }

    if ( '' !== $this->field['units'] ) {
        $value['units'] = $this->value['units'];
    }

    $this->value = $value;

    if ( '' !== $this->field['mode'] ) {
        $this->field['mode'] = $this->field['mode'] . '-';
    }

    if ( isset( $this->field['select2'] ) ) {
        $this->field['select2'] = wp_parse_args( $this->field['select2'], $this->select2_config );
    } else {
        $this->field['select2'] = $this->select2_config;
    }

    $this->field['select2'] = Redux_Functions::sanitize_camel_case_array_keys( $this->field['select2'] );

    $select2_data = Redux_Functions::create_data_string( $this->field['select2'] );
?>
    <?php
    $input_unit_html    = '';
    $input_spacing_html = '';
    if($allow_responsive){ ?>
        <div class="uk-clearfix">
            <span class="spacing-lock locked">
                <i class="dashicons dashicons-lock"></i>
            </span>
            <ul class="uk-iconnav uk-float-right" data-uk-switcher="active: 1">
                <?php
                foreach($devices as $device => $item) {

                    $unit_value = '';
                    if(is_array($unit_responsive) && isset($unit_responsive[$device])){
                        if($unit_responsive[$device] == 'Array'){
                            $unit_value = '';
                        }else {
                            $unit_value = $unit_responsive[$device];
                        }
                    }elseif(is_string($unit_responsive)){
                        $unit_value = $unit_responsive;
                    }

                    $input_unit_html    .= '<input 
                            type="hidden" 
                            name="' . esc_attr($this->field['name'] . $this->field['name_suffix']) . '[units]['.$device.']" 
                            class="field-units js-device-'.$device.'" value="' . esc_attr($unit_value) . '">'."\n";
                    if ( true === $this->field['top'] ) {
                        $top_val    = '';
                        if(isset($value_responsive['top'][$device])){
                            $top_val    = filter_var($value_responsive['top'][$device], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
                        }elseif($device == 'desktop'){
                            $top_val    = filter_var($value_responsive['top'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
                        }

                        $input_spacing_html .= '<input 
                                    type="hidden" 
                                    class="redux-spacing-value js-device-'.$device.'" 
                                    id="' . esc_attr( $this->field['id'] ).'-'.$position['top'] . '" 
                                    name="' . esc_attr( $this->field['name'] . $this->field['name_suffix'] . '[' . $this->field['mode'] ) .$position['top']. ']['.$device.']" 
                                    value="' . esc_attr( $top_val ) . ( ! empty( $top_val ) ? esc_attr( $unit_value ) : '' ) . '"
                                  >'."\n";
                    }
                    if ( true === $this->field['right'] ) {
                        $right_val    = '';
                        if(isset($value_responsive['right'][$device])){
                            $right_val    = filter_var($value_responsive['right'][$device], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
                        }elseif($device == 'desktop'){
                            $right_val    = filter_var($value_responsive['right'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
                        }

                        $input_spacing_html .= '<input 
                                    type="hidden" 
                                    class="redux-spacing-value js-device-'.$device.'"
                                    id="' . esc_attr( $this->field['id'] ).'-'.$position['right'] . '" 
                                    name="' . esc_attr( $this->field['name'] . $this->field['name_suffix'] . '[' . $this->field['mode'] ) .$position['right']. ']['.$device.']" 
                                    value="' . esc_attr( $right_val ) . ( ! empty( $right_val ) ? esc_attr( $unit_value ) : '' ) . '"
                                  >';
                    }
                    if ( true === $this->field['bottom'] ) {
                        $bottom_val    = '';
                        if(isset($value_responsive['bottom'][$device])){
                            $bottom_val    = filter_var($value_responsive['bottom'][$device], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
                        }elseif($device == 'desktop'){
                            $bottom_val    = filter_var($value_responsive['bottom'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
                        }

                        $input_spacing_html .= '<input 
                                    type="hidden" 
                                    class="redux-spacing-value js-device-'.$device.'" 
                                    id="' . esc_attr( $this->field['id'] ) .'-'.$position['bottom'] . '" 
                                    name="' . esc_attr( $this->field['name'] . $this->field['name_suffix'] . '[' . $this->field['mode'] ) .$position['bottom']. ']['.$device.']" 
                                    value="' . esc_attr( $bottom_val ) . ( ! empty( $bottom_val ) ? esc_attr( $unit_value ) : '' ) . '"
                                  >'."\n";
                    }
                    if ( true === $this->field['left'] ) {
                        $left_val    = '';
                        if(isset($value_responsive['left'][$device])){
                            $left_val    = filter_var($value_responsive['left'][$device], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
                        }elseif($device == 'desktop'){
                            $left_val    = filter_var($value_responsive['left'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
                        }

                        $input_spacing_html .= '<input 
                                    type="hidden" 
                                    class="redux-spacing-value js-device-'.$device.'"
                                    id="' . esc_attr( $this->field['id'] ) .'-'.$position['left'] . '" 
                                    name="' . esc_attr( $this->field['name'] . $this->field['name_suffix'] . '[' . $this->field['mode'] ) .$position['left']. ']['.$device.']" 
                                    value="' . esc_attr( $left_val ) . ( ! empty( $left_val ) ? esc_attr( $unit_value ) : '' ) . '"
                                  >';
                    }
                    ?>
                    <li><a href="#" data-uk-tooltip="<?php echo $item['title']; ?>" data-field-device="<?php
                        echo $device; ?>">
                            <?php if(isset($item['uk-icon']) && !empty($item['uk-icon'])){?>
                                <span data-uk-icon="icon: <?php echo $item['uk-icon'];?>"></span>
                            <?php }else{?>
                            <i class="<?php echo $item['icon']; ?>"></i>
                            <?php } ?>
                        </a></li>
                <?php } ?>
            </ul>
        </div>
    <?php }else{
        $input_unit_html    = '<input 
                        type="hidden" 
                        name="' . esc_attr($this->field['name'] . $this->field['name_suffix']) . '[units]" 
                        class="field-units" value="' . esc_attr($this->value['units']) . '">';
        if ( true === $this->field['top'] ) {
            $input_spacing_html .= '<input 
                                type="hidden" 
                                class="redux-spacing-value" 
                                id="' . esc_attr( $this->field['id'] ).'-'.$position['top'] . '" 
                                name="' . esc_attr( $this->field['name'] . $this->field['name_suffix'] . '[' . $this->field['mode'] ) .$position['top']. ']" 
                                value="' . esc_attr( $this->value['top'] ) . ( ! empty( $this->value['top'] ) ? esc_attr( $this->value['units'] ) : '' ) . '"
                              >'."\n";
        }
        if ( true === $this->field['right'] ) {
            $input_spacing_html .= '<input 
                                type="hidden" 
                                class="redux-spacing-value" 
                                id="' . esc_attr( $this->field['id'] ).'-'.$position['right'] . '" 
                                name="' . esc_attr( $this->field['name'] . $this->field['name_suffix'] . '[' . $this->field['mode'] ) .$position['right']. ']" 
                                value="' . esc_attr( $this->value['right'] ) . ( ! empty( $this->value['right'] ) ? esc_attr( $this->value['units'] ) : '' ) . '"
                              >'."\n";
        }
        if ( true === $this->field['bottom'] ) {
            $input_spacing_html .= '<input 
                                type="hidden" 
                                class="redux-spacing-value" 
                                id="' . esc_attr( $this->field['id'] ) .'-'.$position['bottom'] . '" 
                                name="' . esc_attr( $this->field['name'] . $this->field['name_suffix'] . '[' . $this->field['mode'] ) .$position['bottom']. ']" 
                                value="' . esc_attr( $this->value['bottom'] ) . ( ! empty( $this->value['bottom'] ) ? esc_attr( $this->value['units'] ) : '' ) . '"
                              >'."\n";
        }
        if ( true === $this->field['left'] ) {
            $input_spacing_html .= '<input 
                                type="hidden" 
                                class="redux-spacing-value" 
                                id="' . esc_attr( $this->field['id'] ) .'-'.$position['left'] . '" 
                                name="' . esc_attr( $this->field['name'] . $this->field['name_suffix'] . '[' . $this->field['mode'] ) .$position['left']. ']" 
                                value="' . esc_attr( $this->value['left'] ) . ( ! empty( $this->value['left'] ) ? esc_attr( $this->value['units'] ) : '' ) . '"
                              >';
        }
    } ?>

    <?php
    echo $input_unit_html;

    echo $input_spacing_html;
    ?>

    <div class="uk-child-width-1-4 uk-grid-small" data-uk-grid>
        <?php
        if ( true === $this->field['all'] ) {
            $this->field['top']    = true;
            $this->field['right']  = true;
            $this->field['bottom'] = true;
            $this->field['left']   = true;

            $this->value['bottom'] = $this->value['top'];
            $this->value['left']   = $this->value['top'];
            $this->value['right']  = $this->value['top'];

            echo '<div class="field-spacing-input input-prepend">
                                <span class="add-on">
                                    <i class="el el-fullscreen icon-large"></i>
                                </span>
                                <input 
                                    type="text" 
                                    class="redux-spacing-all redux-spacing-input mini ' . esc_attr( $this->field['class'] ) . '" 
                                    placeholder="' . $hints['all'] . '" 
                                    rel="' . esc_attr( $this->field['id'] ) . '-all" 
                                    value="' . esc_attr( $this->value['top'] ) . '"
                                >
                              </div>';
        }


        if ( false === $this->field['all'] ) {
            /**
             * Top
             * */
            if ( true === $this->field['top'] ) {
                echo '<div class="field-spacing-input input-prepend">
                                    <span class="add-on">
                                        <i class="el el-arrow-up icon-large"></i>
                                    </span>
                                    <input type="text" 
                                           class="redux-spacing-top redux-spacing-input mini ' . esc_attr( $this->field['class'] ) . '"
                                           placeholder="' . $hints['top'] . '"
                                           rel="' . esc_attr( $this->field['id'] ) .'-'.$position['top']. '"
                                           value="' . esc_attr( $this->value['top'] ) . '"/>
                                </div>';
            }

            /**
             * Right
             * */
            if ( true === $this->field['right'] ) {
                echo '<div class="field-spacing-input input-prepend">
                                    <span class="add-on">
                                        <i class="el el-arrow-right icon-large"></i>
                                    </span>
                                    <input type="text" 
                                           class="redux-spacing-right redux-spacing-input mini ' . esc_attr( $this->field['class'] ) . '"
                                           placeholder="' .$hints['right'] . '"
                                           rel="' . esc_attr( $this->field['id'] ).'-'.$position['right'] . '"
                                           value="' . esc_attr( $this->value['right'] ) . '"/>
                                </div>';
            }

            /**
             * Bottom
             * */
            if ( true === $this->field['bottom'] ) {
                echo '<div class="field-spacing-input input-prepend">
                                    <span class="add-on">
                                        <i class="el el-arrow-down icon-large"></i>
                                    </span>
                                    <input type="text" 
                                           class="redux-spacing-bottom redux-spacing-input mini ' . esc_attr( $this->field['class'] ) . '"
                                           placeholder="' . $hints['bottom'] . '"
                                           rel="' . esc_attr( $this->field['id'] ) .'-'.$position['bottom']. '"
                                           value="' . esc_attr( $this->value['bottom'] ) . '">
                                </div>';
            }

            /**
             * Left
             * */
            if ( true === $this->field['left'] ) {
                echo '<div class="field-spacing-input input-prepend">
                                    <span class="add-on">
                                        <i class="el el-arrow-left icon-large"></i>
                                    </span>
                                    <input type="text" 
                                           class="redux-spacing-left redux-spacing-input mini ' . esc_attr( $this->field['class'] ) . '"
                                           placeholder="' . $hints['left'] . '"
                                           rel="' . esc_attr( $this->field['id'] ) .'-'.$position['left'] . '"
                                           value="' . esc_attr( $this->value['left'] ) . '"/>
                                </div>';
            }
        }

        /**
         * Units
         * */
        if ( false !== $this->field['units'] && true === $this->field['display_units'] ) {
            echo '<div class="select_wrapper spacing-units" original-title="' . esc_html__( 'Units', 'redux-framework' ) . '">';
            echo '<select data-placeholder="' . esc_html__( 'Units', 'redux-framework' ) . '" class="redux-spacing redux-spacing-units select ' . esc_attr( $this->field['class'] ) . '" original-title="' . esc_html__( 'Units', 'redux-framework' ) . '" id="' . esc_attr( $this->field['id'] ) . '_units"' . esc_attr( $select2_data ) . '>';

            if ( $this->field['units_extended'] ) {
                $test_units = $unit_arr;
            } else {
                $test_units = array( 'px', 'em', 'pt', 'rem', '%' );
            }

            if ( '' !== $this->field['units'] || is_array( $this->field['units'] ) ) {
                $test_units = $this->field['units'];
            }

            echo '<option></option>';

            if ( ! is_array( $this->field['units'] ) ) {
                echo '<option value="' . esc_attr( $this->field['units'] ) . '" selected="selected">' . esc_attr( $this->field['units'] ) . '</option>';
            } else {
                $val_units  = $this->value['units'];
                foreach ( $test_units as $a_unit ) {
                    if(isset($val_units['desktop'])) {
                        echo '<option value="' . esc_attr($a_unit) . '" ' . selected($val_units['desktop'], $a_unit, false) . '>' . esc_html($a_unit) . '</option>';
                    }else{
                        echo '<option value="' . esc_attr($a_unit) . '" ' . selected($val_units, $a_unit, false) . '>' . esc_html($a_unit) . '</option>';

                    }
                }
            }

            echo '</select></div>';
        }
        ?>
    </div>
<?php if($allow_responsive){?>
</div>
<?php }?>