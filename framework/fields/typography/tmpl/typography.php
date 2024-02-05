<?php

defined('TEMPLAZA_FRAMEWORK') or exit;

//var_dump($this -> field['units']); die();
if ( empty( $this -> field['units'] ) && ! empty( $this -> field['default']['units'] ) ) {
    $this -> field['units'] = $this -> field['default']['units'];
}


$unit = $this -> field['units'];

if(!empty($unit) && is_array($unit)){
    $unit   = '';
}

?>
<div data-responsive="<?php echo (isset($this -> field['allow_responsive'])?(int) $this -> field['allow_responsive']:0);?>">
    <div id="<?php echo esc_attr( $this -> field['id'] ); ?>" class="redux-typography-container" data-id="<?php
        echo esc_attr( $this -> field['id'] ); ?>" data-units="<?php echo esc_attr( $unit ); ?>">

    <?php
    $this -> select2_config['allowClear'] = true;

    if ( isset( $this -> field['select2'] ) ) {
        $this -> field['select2'] = wp_parse_args( $this -> field['select2'], $this -> select2_config );
    } else {
        $this -> field['select2'] = $this -> select2_config;
    }

    $this -> field['select2'] = Redux_Functions::sanitize_camel_case_array_keys( $this -> field['select2'] );

    $select2_data = Redux_Functions::create_data_string( $this -> field['select2'] );

    /* Font Family */
    if ( true === $this -> field['font-family'] ) {
        if ( filter_var( $this -> value['google'], FILTER_VALIDATE_BOOLEAN ) ) {

            // Divide and conquer.
            $font_family = explode( ', ', $this -> value['font-family'], 2 );

            // If array 0 is empty and array 1 is not.
            if ( empty( $font_family[0] ) && ! empty( $font_family[1] ) ) {

                // Make array 0 = array 1.
                $font_family[0] = $font_family[1];

                // Clear array 1.
                $font_family[1] = '';
            }
        }

        // If no fontFamily array exists, create one and set array 0
        // with font value.
        if ( ! isset( $font_family ) ) {
            $font_family    = array();
            $font_family[0] = $this -> value['font-family'];
            $font_family[1] = '';
        }

        // Is selected font a Google font.
        $is_google_font = '0';
        if ( isset( $this -> redux_framework -> fonts['google'][ $font_family[0] ] ) ) {
            $is_google_font = '1';
        }

        // If not a Google font, show all font families.
        if ( '1' !== $is_google_font ) {
            $font_family[0] = $this -> value['font-family'];
        }

        $user_fonts = '0';
        if ( true === $this->user_fonts ) {
            $user_fonts = '1';
        }
    ?>

        <?php echo '<input
                            type="hidden"
                            class="redux-typography-font-family ' . esc_attr( $this -> field['class'] ) . '"
                            data-user-fonts="' . esc_attr( $user_fonts ) . '" name="' . esc_attr( $this -> field['name'] . $this -> field['name_suffix'] ) . '[font-family]"
                            value="' . esc_attr( $this -> value['font-family'] ) . '"
                            data-id="' . esc_attr( $this -> field['id'] ) . '"  />';?>

        <?php echo '<input
                            type="hidden"
                            class="redux-typography-font-options ' . esc_attr( $this -> field['class'] ) . '"
                            name="' . esc_attr( $this -> field['name'] . $this -> field['name_suffix'] ) . '[font-options]"
                            value="' . esc_attr( $this -> value['font-options'] ) . '"
                            data-id="' . esc_attr( $this -> field['id'] ) . '"  />';?>

        <?php echo '<input
                            type="hidden"
                            class="redux-typography-google-font" value="' . esc_attr( $is_google_font ) . '"
                            id="' . esc_attr( $this -> field['id'] ) . '-google-font">';?>

        <?php echo '<div class="select_wrapper typography-family" style="width: 220px; margin-right: 5px;">';?>
        <?php echo '<label>' . esc_html__( 'Font Family', 'redux-framework' ) . '</label>'; ?>
    <?php
        $placeholder = esc_html__( 'Font family', 'redux-framework' );

        $new_arr                = $this -> field['select2'];
        $new_arr['allow-clear'] = $this -> field['font_family_clear'];
        $new_data               = Redux_Functions::create_data_string( $new_arr );

        echo '<select class=" redux-typography redux-typography-family select2-container ' . esc_attr( $this -> field['class'] ) . '" id="' . esc_attr( $this -> field['id'] ) . '-family" data-placeholder="' . esc_attr( $placeholder ) . '" data-id="' . esc_attr( $this -> field['id'] ) . '" data-value="' . esc_attr( $font_family[0] ) . '"' . esc_html( $new_data ) . '>';

        echo '</select>';
        echo '</div>';

        $google_set = false;
        if ( true === $this -> field['google'] ) {

            // Set a flag so we know to set a header style or not.
            echo '<input
                                type="hidden"
                                class="redux-typography-google ' . esc_attr( $this -> field['class'] ) . '"
                                id="' . esc_attr( $this -> field['id'] ) . '-google" name="' . esc_attr( $this -> field['name'] . $this -> field['name_suffix'] ) . '[google]"
                                type="text" value="' . esc_attr( $this -> field['google'] ) . '"
                                data-id="' . esc_attr( $this -> field['id'] ) . '" />';

            $google_set = true;
        }
    }

    /* Backup Font */
    if ( true === $this -> field['font-family'] && true === $this -> field['google'] ) {
        if ( false === $google_set ) {
            // Set a flag so we know to set a header style or not.
            echo '<input
                                type="hidden"
                                class="redux-typography-google ' . esc_attr( $this -> field['class'] ) . '"
                                id="' . esc_attr( $this -> field['id'] ) . '-google" name="' . esc_attr( $this -> field['name'] . $this -> field['name_suffix'] ) . '[google]"
                                type="text" value="' . esc_attr( $this -> field['google'] ) . '"
                                data-id="' . esc_attr( $this -> field['id'] ) . '"  />';
        }

        if ( true === $this -> field['font-backup'] ) {
            echo '<div class="select_wrapper typography-family-backup" style="width: 220px; margin-right: 5px;">';
            echo '<label>' . esc_html__( 'Backup Font Family', 'redux-framework' ) . '</label>';
            echo '<select
                                data-placeholder="' . esc_html__( 'Backup Font Family', 'redux-framework' ) . '"
                                name="' . esc_attr( $this -> field['name'] . $this -> field['name_suffix'] ) . '[font-backup]"
                                class="redux-typography redux-typography-family-backup ' . esc_attr( $this -> field['class'] ) . '"
                                id="' . esc_attr( $this -> field['id'] ) . '-family-backup"
                                data-id="' . esc_attr( $this -> field['id'] ) . '"
                                data-value="' . esc_attr( $this -> value['font-backup'] ) . '"' . esc_attr( $select2_data ) . '>';

            echo '<option data-google="false" data-details="" value=""></option>';

            foreach ( $this -> field['fonts'] as $i => $family ) {
                echo '<option data-google="true" value="' . esc_attr( $i ) . '" ' . selected( $this -> value['font-backup'], $i, false ) . '>' . esc_html( $family ) . '</option>';
            }

            echo '</select></div>';
        }
    }

    /* Font Style/Weight */
    if ( true === $this -> field['font-style'] || true === $this -> field['font-weight'] ) {
        echo '<div data-weights="' . rawurlencode( wp_json_encode( $this->field['weights'] ) ) . '" class="select_wrapper typography-style" original-title="' . esc_html__( 'Font style', 'redux-framework' ) . '">';
//        echo '<div class="select_wrapper typography-style" original-title="' . esc_html__( 'Font style', 'redux-framework' ) . '">';
        echo '<label>' . esc_html__( 'Font Weight &amp; Style', 'redux-framework' ) . '</label>';

        $style = $this -> value['font-weight'] . $this -> value['font-style'];

        echo '<input
                            type="hidden"
                            class="typography-font-weight" name="' . esc_attr( $this -> field['name'] . $this -> field['name_suffix'] ) . '[font-weight]"
                            value="' . esc_attr( $this -> value['font-weight'] ) . '"
                            data-id="' . esc_attr( $this -> field['id'] ) . '"  /> ';

        echo '<input
                            type="hidden"
                            class="typography-font-style" name="' . esc_attr( $this -> field['name'] . $this -> field['name_suffix'] ) . '[font-style]"
                            value="' . esc_attr( $this -> value['font-style'] ) . '"
                            data-id="' . esc_attr( $this -> field['id'] ) . '"  /> ';
        $multi = ( isset( $this -> field['multi']['weight'] ) && $this -> field['multi']['weight'] ) ? ' multiple="multiple"' : '';
        echo '<select' . esc_html( $multi ) . '
                            data-placeholder="' . esc_html__( 'Style', 'redux-framework' ) . '"
                            class="redux-typography redux-typography-style select ' . esc_attr( $this -> field['class'] ) . '"
                            original-title="' . esc_html__( 'Font style', 'redux-framework' ) . '"
                            id="' . esc_attr( $this -> field['id'] ) . '_style" data-id="' . esc_attr( $this -> field['id'] ) . '"
                            data-value="' . esc_attr( $style ) . '"' . esc_attr( $select2_data ) . '>';

        if ( empty( $this -> value['subsets'] ) || empty( $this -> value['font-weight'] ) ) {
            echo '<option value=""></option>';
        }

        echo '</select></div>';
    }

    if(isset($this -> field['multi_styles']) && $this -> field['multi_styles'] === true && true === $this -> field['google'] ){
        echo '<div class="select_wrapper typography-multi-style" original-title="'
            . esc_html__( 'Font style', 'redux-framework' ) . '">';
        echo '<label>' . esc_html__( 'Load Other Font Weight &amp; Style', 'templaza-framework' ) . '</label>';

        echo '<select multiple="multiple" name="'. esc_attr( $this -> field['name'] . $this -> field['name_suffix'] ).'[font-multi-styles][]"
                            data-placeholder="' . esc_html__( 'Style', 'redux-framework' ) . '"
                            class="uk-float-left uk-width-expand redux-typography-multi-style ' . esc_attr( $this -> field['class'] ) . '"
                            original-title="' . esc_html__( 'Load Other Font Weight &amp; Style', 'templaza-framework' ) . '"
                            id="' . esc_attr( $this -> field['id'] ) . '_multi_styles"
                            data-value="' . esc_attr( json_encode($this -> value['font-multi-styles']) ) . '"' . esc_attr( $select2_data ) . '>';

        echo '</select></div>';
    }

    /* Font Script */
    if ( true === $this -> field['font-family'] && true === $this -> field['subsets'] && true === $this -> field['google'] ) {
        echo '<div class="select_wrapper typography-script tooltip" original-title="' . esc_html__( 'Font subsets', 'redux-framework' ) . '">';
        echo '<input
                            type="hidden"
                            class="typography-subsets"
                            name="' . esc_attr( $this -> field['name'] . $this -> field['name_suffix'] ) . '[subsets]"
                            value="' . esc_attr( $this -> value['subsets'] ) . '"
                            data-id="' . esc_attr( $this -> field['id'] ) . '"  /> ';

        echo '<label>' . esc_html__( 'Font Subsets', 'redux-framework' ) . '</label>';
        $multi = ( isset( $this -> field['multi']['subsets'] ) && $this -> field['multi']['subsets'] ) ? ' multiple="multiple"' : '';
        echo '<select' . esc_html( $multi ) . '
                            data-placeholder="' . esc_html__( 'Subsets', 'redux-framework' ) . '"
                            class="redux-typography redux-typography-subsets ' . esc_attr( $this -> field['class'] ) . '"
                            original-title="' . esc_html__( 'Font script', 'redux-framework' ) . '"
                            id="' . esc_attr( $this -> field['id'] ) . '-subsets"
                            data-value="' . esc_attr( $this -> value['subsets'] ) . '"
                            data-id="' . esc_attr( $this -> field['id'] ) . '"' . esc_attr( $select2_data ) . '>';

        if ( empty( $this -> value['subsets'] ) ) {
            echo '<option value=""></option>';
        }

        echo '</select></div>';
    }

    /* Font Align */
    if ( true === $this -> field['text-align'] ) {
        echo '<div class="select_wrapper typography-align tooltip" original-title="' . esc_html__( 'Text Align', 'redux-framework' ) . '">';
        echo '<label>' . esc_html__( 'Text Align', 'redux-framework' ) . '</label>';
        echo '<select
                            data-placeholder="' . esc_html__( 'Text Align', 'redux-framework' ) . '"
                            class="redux-typography redux-typography-align ' . esc_attr( $this -> field['class'] ) . '"
                            original-title="' . esc_html__( 'Text Align', 'redux-framework' ) . '"
                            id="' . esc_attr( $this -> field['id'] ) . '-align"
                            name="' . esc_attr( $this -> field['name'] . $this -> field['name_suffix'] ) . '[text-align]"
                            data-value="' . esc_attr( $this -> value['text-align'] ) . '"
                            data-id="' . esc_attr( $this -> field['id'] ) . '"' . esc_attr( $select2_data ) . '>';

        echo '<option value=""></option>';

        $align = array(
            esc_html__( 'inherit', 'redux-framework' ),
            esc_html__( 'left', 'redux-framework' ),
            esc_html__( 'right', 'redux-framework' ),
            esc_html__( 'center', 'redux-framework' ),
            esc_html__( 'justify', 'redux-framework' ),
            esc_html__( 'initial', 'redux-framework' ),
        );

        foreach ( $align as $v ) {
            echo '<option value="' . esc_attr( $v ) . '" ' . selected( $this -> value['text-align'], $v, false ) . '>' . esc_html( ucfirst( $v ) ) . '</option>';
        }

        echo '</select></div>';
    }

    /* Text Transform */
    if ( true === $this -> field['text-transform'] ) {
        echo '<div class="select_wrapper typography-transform tooltip" original-title="' . esc_html__( 'Text Transform', 'redux-framework' ) . '">';
        echo '<label>' . esc_html__( 'Text Transform', 'redux-framework' ) . '</label>';
        echo '<select
                            data-placeholder="' . esc_html__( 'Text Transform', 'redux-framework' ) . '"
                            class="redux-typography redux-typography-transform ' . esc_attr( $this -> field['class'] ) . '"
                            original-title="' . esc_html__( 'Text Transform', 'redux-framework' ) . '"
                            id="' . esc_attr( $this -> field['id'] ) . '-transform"
                            name="' . esc_attr( $this -> field['name'] . $this -> field['name_suffix'] ) . '[text-transform]"
                            data-value="' . esc_attr( $this -> value['text-transform'] ) . '"
                            data-id="' . esc_attr( $this -> field['id'] ) . '"' . esc_attr( $select2_data ) . '>';

        echo '<option value=""></option>';

        $values = array(
            esc_html__( 'none', 'redux-framework' ),
            esc_html__( 'capitalize', 'redux-framework' ),
            esc_html__( 'uppercase', 'redux-framework' ),
            esc_html__( 'lowercase', 'redux-framework' ),
            esc_html__( 'initial', 'redux-framework' ),
            esc_html__( 'inherit', 'redux-framework' ),
        );

        foreach ( $values as $v ) {
            echo '<option value="' . esc_attr( $v ) . '" ' . selected( $this -> value['text-transform'], $v, false ) . '>' . esc_html( ucfirst( $v ) ) . '</option>';
        }

        echo '</select></div>';
    }

    /* Font Variant */
    if ( true === $this -> field['font-variant'] ) {
        echo '<div class="select_wrapper typography-font-variant tooltip" original-title="' . esc_html__( 'Font Variant', 'redux-framework' ) . '">';
        echo '<label>' . esc_html__( 'Font Variant', 'redux-framework' ) . '</label>';
        echo '<select
                            data-placeholder="' . esc_html__( 'Font Variant', 'redux-framework' ) . '"
                            class="redux-typography redux-typography-font-variant ' . esc_attr( $this -> field['class'] ) . '"
                            original-title="' . esc_html__( 'Font Variant', 'redux-framework' ) . '"
                            id="' . esc_attr( $this -> field['id'] ) . '-font-variant"
                            name="' . esc_attr( $this -> field['name'] . $this -> field['name_suffix'] ) . '[font-variant]"
                            data-value="' . esc_attr( $this -> value['font-variant'] ) . '"
                            data-id="' . esc_attr( $this -> field['id'] ) . '"' . esc_attr( $select2_data ) . '>';

        echo '<option value=""></option>';

        $values = array(
            esc_html__( 'inherit', 'redux-framework' ),
            esc_html__( 'normal', 'redux-framework' ),
            esc_html__( 'small-caps', 'redux-framework' ),
        );

        foreach ( $values as $v ) {
            echo '<option value="' . esc_attr( $v ) . '" ' . selected( $this -> value['font-variant'], $v, false ) . '>' . esc_attr( ucfirst( $v ) ) . '</option>';
        }

        echo '</select></div>';
    }

    /* Text Decoration */
    if ( true === $this -> field['text-decoration'] ) {
        echo '<div class="select_wrapper typography-decoration tooltip" original-title="' . esc_html__( 'Text Decoration', 'redux-framework' ) . '">';
        echo '<label>' . esc_html__( 'Text Decoration', 'redux-framework' ) . '</label>';
        echo '<select
                            data-placeholder="' . esc_html__( 'Text Decoration', 'redux-framework' ) . '"
                            class="redux-typography redux-typography-decoration ' . esc_attr( $this -> field['class'] ) . '"
                            original-title="' . esc_html__( 'Text Decoration', 'redux-framework' ) . '"
                            id="' . esc_attr( $this -> field['id'] ) . '-decoration"
                            name="' . esc_attr( $this -> field['name'] . $this -> field['name_suffix'] ) . '[text-decoration]"
                            data-value="' . esc_attr( $this -> value['text-decoration'] ) . '"
                            data-id="' . esc_attr( $this -> field['id'] ) . '"' . esc_attr( $select2_data ) . '>';

        echo '<option value=""></option>';

        $values = array(
            esc_html__( 'none', 'redux-framework' ),
            esc_html__( 'inherit', 'redux-framework' ),
            esc_html__( 'underline', 'redux-framework' ),
            esc_html__( 'overline', 'redux-framework' ),
            esc_html__( 'line-through', 'redux-framework' ),
            esc_html__( 'blink', 'redux-framework' ),
        );

        foreach ( $values as $v ) {
            echo '<option value="' . esc_attr( $v ) . '" ' . selected( $this -> value['text-decoration'], $v, false ) . '>' . esc_html( ucfirst( $v ) ) . '</option>';
        }

        echo '</select></div>';
    }

    /* Font Size */
//    $devices    = array(
//        'desktop' => array(
//            'title'=> esc_html__('Desktop', 'templaza-framework'),
//            'icon' => 'dashicons dashicons-desktop',
//        ),
//        'tablet'  => array(
//            'title'=> esc_html__('Tablet', 'templaza-framework'),
//            'icon' => 'dashicons dashicons-tablet',
//        ),
//        'mobile'  => array(
//            'title'=> esc_html__('Mobile', 'templaza-framework'),
//            'icon' => 'dashicons dashicons-smartphone',
//        ),
//    );
    $devices    = $this -> get_devices();
    $units      = array(
        'px',
        'pt',
        'em',
        'rem',
        '%',
    );
    $font_size_units      = $units;
    if(is_array($this -> field['units']) && isset($this -> field['units']['font-size'])
        && is_array($this -> field['units']['font-size'])){
        $font_size_units    = array_merge($this -> field['units']['font-size'], $font_size_units);
    }
    if ( true === $this -> field['font-size'] ) {
        echo '<div class="input_wrapper font-size redux-container-typography">';
        echo '<div data-uk-grid>';
        echo '  <div class="uk-width-auto uk-margin-small-right">';
        echo '    <label>' . esc_html__( 'Font Size', 'templaza-framework' ) . '</label>';
        echo '  </div>';

        $nav_tab    = '';
//        $nav_tab    = '<li><label>' . esc_html__( 'Font Size', 'templaza-framework' ) . '</label></li>';
        $tab_pane   = '';
        foreach($devices as $device => $item) {
            $uniquid    = uniqid();
            $value      = '';
            if(isset($this -> value['font-size']) && !empty($this -> field['font-size'])){
                if(is_array($this -> value['font-size']) && isset($this -> value['font-size'][$device])){
                    $value  = $this -> value['font-size'][$device];
                }elseif(!is_array($this -> value['font-size']) && $device == 'desktop'){
                    $value  = $this -> value['font-size'];
                }
            }
            $_unit      = preg_replace('#^'.(float) $value.'#i','', $value);

            if(empty($_unit)){
                if(is_array($unit) && isset($unit['font-size'])){
                    $_unit  = $unit['font-size'];
                }elseif(!is_array($unit)){
                    $_unit  = $unit;
                }
            }

//            $nav_tab    .= '<li><a href="#tabs-'.$this -> field['id'].'-'.$uniquid.'" title="' . $item['title']
//                . '"><span class="'.$item['icon'].'"></span></a></li>';
            $nav_tab    .= '<li><a href="#tabs-'.$this -> field['id'].'-'.$uniquid.'" title="' . $item['title']
                . '" data-uk-tooltip="'.$item['title'].'">';
            if(isset($item['uk-icon']) && !empty($item['uk-icon'])){
                $nav_tab    .= '<span data-uk-icon="icon: '.$item['uk-icon'].'"></span>';
            }else{
                $nav_tab    .= '<span class="'.$item['icon'].'"></span>';
            }
            $nav_tab    .= '</a></li>';

            $tab_pane   .= '<div id="tabs-'.$this -> field['id'].'-'.$uniquid
                .'" class="tz-redux-typography-size tz-redux-typography-device" data-device="'.$device.'" data-name="size" data-hidden-name="font-size">';
            $tab_pane   .= '<input
                                type="text"
                                class="span2 redux-typography mini typography-input ' . esc_attr($this -> field['class']) . '"
                                title="' . esc_html__('Font Size', 'redux-framework') . '"
                                placeholder="' . esc_html__('Size', 'redux-framework') . '"
                                id="' . esc_attr($this -> field['id']) . '-size"
                                value="' . esc_attr(preg_replace('#'.$_unit.'$#i','', $value)) . '"
                                data-value="' . esc_attr(preg_replace('#'.$_unit.'$#i','', $value)). '">';
                /* My customize */
            $tab_pane  .= '<select id="' . $this -> field['id'] . '-unit" class="redux-typography-unit" data-placeholder="'.
                esc_html__('Units', 'templaza-framework').'"'.$select2_data.' data-name="unit">';
                foreach ($font_size_units as $un) {
                    if(!empty($un)){
                        $tab_pane  .= '<option value="' . $un . '"' . selected($un, $_unit, false) . '>' . $un . '</option>';
                    }else{
                        $tab_pane  .= '<option></option>';
                    }
                }
            $tab_pane  .=  '<select class="select2-container">';
            /* End my customize */
            $tab_pane  .= '<input type="hidden" name="'
                    . esc_attr( $this -> field['name'] . $this -> field['name_suffix'] )
                    . '[font-size]['.$device.']" value="' . ((float)$value?esc_attr( $value):'')
                    . '" data-id="' . esc_attr( $this -> field['id'] ) . '" data-device="'.$device.'"/>';

            $tab_pane  .= '</div>';
        }
            echo '  <ul class="clearfix uk-iconnav uk-width-expand" data-uk-switcher="active: 1;">';
            echo $nav_tab;
            echo '  </ul>';
            echo '  <div class="uk-switcher uk-width-1-1 uk-margin-remove">';
            echo $tab_pane;
            echo '  </div>';
            echo '</div>';
        echo '</div>';
    }

    /* Line Height */
    $line_height_units  = $units;
    if(isset($this -> field['units']) && isset($this -> field['units']['line-height'])
        && is_array($this -> field['units']['line-height'])){
        $line_height_units  = array_merge($this -> field['units']['line-height'], $line_height_units);
    }
    if ( true === $this -> field['line-height'] ) {

        echo '<div class="input_wrapper line-height redux-container-typography">';

        echo '<div data-uk-grid>';
        echo '<div class="uk-width-auto uk-margin-small-right">';
        echo '<label>' . esc_html__( 'Line Height', 'templaza-framework' ) . '</label>';
        echo '</div>';

        $nav_tab    = '';

        $tab_pane   = '';
        foreach($devices as $device =>  $item) {
            $uniquid    = uniqid();
            $value      = '';
            if(isset($this -> value['line-height']) && !empty($this -> field['line-height'])){
                if(is_array($this -> value['line-height']) && isset($this -> value['line-height'][$device])){
                    $value  = $this -> value['line-height'][$device];
                }elseif(!is_array($this -> value['line-height']) && $device == 'desktop'){
                    $value  = $this -> value['line-height'];
                }
            }
            $_unit      = preg_replace('#^'.(float) $value.'#i','', $value);

            if(empty($_unit)){
                if(is_array($unit) && isset($unit['line-height'])){
                    $_unit  = $unit['line-height'];
                }elseif(!is_array($unit)){
                    $_unit  = $unit;
                }
            }

            $nav_tab    .= '<li><a href="#tabs-'.$this -> field['id'].'-'.$uniquid.'" title="' . $item['title']
                . '" data-uk-tooltip="'.$item['title'].'">';

            if(isset($item['uk-icon']) && !empty($item['uk-icon'])){
                $nav_tab    .= '<span data-uk-icon="icon: '.$item['uk-icon'].'"></span>';
            }else{
                $nav_tab    .= '<span class="'.$item['icon'].'"></span>';
            }
            $nav_tab    .= '</a></li>';

            $tab_pane   .= '<div id="tabs-'.$this -> field['id'].'-'.$uniquid
                .'" class="tz-redux-typography-device" data-device="'.$device.'" data-name="height" data-hidden-name="line-height">';
            $tab_pane   .= '<input
                            type="text"
                            class="span2 redux-typography mini typography-input ' . esc_attr( $this -> field['class'] ) . '"
                            title="' . esc_html__( 'Line Height', 'redux-framework' ) . '"
                            placeholder="' . esc_html__( 'Height', 'redux-framework' ) . '"
                            id="' . esc_attr( $this -> field['id'] ) . '-height"
                            data-allow-empty="' . esc_attr( $this -> field['allow_empty_line_height'] ) . '"
                            value="' . esc_attr( preg_replace('#'.$_unit.'$#i','', $value) ) . '"
                            data-value="' . esc_attr( preg_replace('#'.$_unit.'$#i','', $value) ) . '">';
            /* My customize */
            $tab_pane  .= '<select id="' . $this -> field['id'] . '-unit" class="redux-typography-unit"'
                .$select2_data.' data-placeholder="'.esc_html__('Units', 'templaza-framework').'" data-name="unit">';
            foreach ($line_height_units as $un) {
                if(!empty($un)) {
                    $tab_pane .= '<option value="' . $un . '"' . selected($un, $_unit, false) . '>' . $un . '</option>';
                }else{
                    $tab_pane   .= '<option></option>';
                }
            }
            $tab_pane  .=  '<select>';
            /* End my customize */
            $tab_pane  .= '<input type="hidden" name="'
                . esc_attr( $this -> field['name'] . $this -> field['name_suffix'] )
                . '[line-height]['.$device.']" value="' . ((float)$value?esc_attr( $value):'')
                . '" data-id="' . esc_attr( $this -> field['id'] ) . '" data-device="'.$device.'"/>';
            $tab_pane  .= '</div>';
        }
        echo '  <ul class="clearfix uk-iconnav uk-width-expand" data-uk-switcher="active: 1;">';
        echo $nav_tab;
        echo '  </ul>';
        echo '  <div class="uk-switcher uk-width-1-1 uk-margin-remove">';
        echo $tab_pane;
        echo '  </div>';
        echo '</div>';
        echo '</div>';

    }

    array_pop($units);
    /* Word Spacing */
    $word_units   = $units;
    if(isset($this -> field['units']) && isset($this -> field['units']['word-spacing'])
        && is_array($this -> field['units']['word-spacing'])){
        $word_units  = array_merge($this -> field['units']['word-spacing'], $word_units);
    }
    if ( true === $this -> field['word-spacing'] ) {
        echo '<div class="input_wrapper line-height redux-container-typography">';

        echo '<div data-uk-grid>';
        echo '<div class="uk-width-auto uk-margin-small-right">';
        echo '<label>' . esc_html__( 'Word Spacing', 'templaza-framework' ) . '</label>';
        echo '</div>';

        $nav_tab    = '';
        $tab_pane   = '';
        foreach($devices as $device => $item) {
            $uniquid    = uniqid();
            $value      = '';
            if(isset($this -> value['word-spacing']) && !empty($this -> field['word-spacing'])){
                if(is_array($this -> value['word-spacing']) && isset($this -> value['word-spacing'][$device])){
                    $value  = $this -> value['word-spacing'][$device];
                }elseif(!is_array($this -> value['word-spacing']) && $device == 'desktop'){
                    $value  = $this -> value['word-spacing'];
                }
            }
            $_unit      = preg_replace('#^'.(float) $value.'#i','', $value);

            if(empty($_unit)){
                if(is_array($unit) && isset($unit['word-spacing'])){
                    $_unit  = $unit['word-spacing'];
                }elseif(!is_array($unit)){
                    $_unit  = $unit;
                }
            }

//            $nav_tab    .= '<li><a href="#tabs-'.$this -> field['id'].'-'.$uniquid.'" title="' . $item['title']
//                . '"><span class="'.$item['icon'].'"></span></a></li>';

            $nav_tab    .= '<li><a href="#tabs-'.$this -> field['id'].'-'.$uniquid.'" title="' . $item['title']
                . '" data-uk-tooltip="'.$item['title'].'">';

            if(isset($item['uk-icon']) && !empty($item['uk-icon'])){
                $nav_tab    .= '<span data-uk-icon="icon: '.$item['uk-icon'].'"></span>';
            }else{
                $nav_tab    .= '<span class="'.$item['icon'].'"></span>';
            }
            $nav_tab    .= '</a></li>';

            $tab_pane   .= '<div id="tabs-'.$this -> field['id'].'-'.$uniquid
                .'" class="tz-redux-typography-device" data-device="'.$device.'" data-name="letter" data-hidden-name="letter-spacing">';
            $tab_pane   .= '<input
                            type="text"
                            class="span2 redux-typography mini typography-input ' . esc_attr( $this -> field['class'] ) . '"
                            title="' . esc_html__( 'Word Spacing', 'redux-framework' ) . '"
                            placeholder="' . esc_html__( 'Word Spacing', 'redux-framework' ) . '"
                            id="' . esc_attr( $this -> field['id'] ) . '-word"
                            value="' . esc_attr( preg_replace('#'.$_unit.'$#i','', $value) ) . '"
                            data-value="' . esc_attr( preg_replace('#'.$_unit.'$#i','', $value)) . '">';
            /* My customize */
            $tab_pane  .= '<select id="' . $this -> field['id'] . '-unit"'.$select2_data
                .' data-placeholder="'.esc_html__('Units', 'templaza-framework')
                .'" class="redux-typography-unit" data-name="unit">';
            foreach ($word_units as $un) {
                if(!empty($un)) {
                    $tab_pane .= '<option value="' . $un . '"' . selected($un, $_unit, false) . '>' . $un . '</option>';
                }else{
                    $tab_pane .= '<option></option>';
                }
            }
            $tab_pane  .=  '<select>';
            /* End my customize */
            $tab_pane  .= '<input type="hidden" name="'
                . esc_attr( $this -> field['name'] . $this -> field['name_suffix'] )
                . '[word-spacing]['.$device.']" value="' . esc_attr( $value  )
                . '" data-id="' . esc_attr( $this -> field['id'] ) . '" data-device="'.$device.'"/>';
            $tab_pane  .= '</div>';
        }
        echo '  <ul class="clearfix uk-iconnav uk-width-expand" data-uk-switcher="active: 1;">';
        echo $nav_tab;
        echo '  </ul>';
        echo '  <div class="uk-switcher uk-width-1-1 uk-margin-remove">';
        echo $tab_pane;
        echo '  </div>';
        echo '</div>';
        echo '</div>';
    }

    /* Letter Spacing */
    if ( true === $this -> field['letter-spacing'] ) {
        $letter_units   = $units;
        if(isset($this -> field['units']) && isset($this -> field['units']['letter-spacing'])
            && is_array($this -> field['units']['letter-spacing'])){
            $letter_units  = array_merge($this -> field['units']['letter-spacing'], $letter_units);
        }

        echo '<div class="input_wrapper letter-spacing redux-container-typography">';

        echo '<div data-uk-grid>';
        echo '<div class="uk-width-auto uk-margin-small-right">';
        echo '<label>' . esc_html__( 'Letter Spacing', 'templaza-framework' ) . '</label>';
        echo '</div>';

        $nav_tab    = '';
        $tab_pane   = '';
        foreach($devices as $device => $item) {
            $uniquid    = uniqid();
            $value      = '';
            if(isset($this -> value['letter-spacing']) && !empty($this -> field['letter-spacing'])){
                if(is_array($this -> value['letter-spacing']) && isset($this -> value['letter-spacing'][$device])){
                    $value  = $this -> value['letter-spacing'][$device];
                }elseif(!is_array($this -> value['letter-spacing']) && $device == 'desktop'){
                    $value  = $this -> value['letter-spacing'];
                }
            }
            $_unit      = preg_replace('#^'.(float) $value.'#i','', $value);

            if(empty($_unit)){
                if(is_array($unit) && isset($unit['letter-spacing'])){
                    $_unit  = $unit['letter-spacing'];
                }elseif(!is_array($unit)){
                    $_unit  = $unit;
                }
            }

            $nav_tab    .= '<li><a href="#tabs-'.$this -> field['id'].'-'.$uniquid.'" title="' . $item['title']
                . '" data-uk-tooltip="'.$item['title'].'">';

            if(isset($item['uk-icon']) && !empty($item['uk-icon'])){
                $nav_tab    .= '<span data-uk-icon="icon: '.$item['uk-icon'].'"></span>';
            }else{
                $nav_tab    .= '<span class="'.$item['icon'].'"></span>';
            }
            $nav_tab    .= '</a></li>';

            $tab_pane   .= '<div id="tabs-'.$this -> field['id'].'-'.$uniquid
                .'" class="tz-redux-typography-device" data-device="'.$device.'" data-name="word" data-hidden-name="word-spacing">';
            $tab_pane   .= '<input
                            type="text"
                            class="span2 redux-typography mini typography-input ' . esc_attr( $this -> field['class'] ) . '"
                            title="' . esc_html__( 'Letter Spacing', 'redux-framework' ) . '"
                            placeholder="' . esc_html__( 'Letter Spacing', 'redux-framework' ) . '"
                            id="' . esc_attr( $this -> field['id'] ) . '-letter"
                            value="' . esc_attr( preg_replace('#'.$_unit.'$#i','', $value) ) . '"
                            data-value="' . esc_attr( preg_replace('#'.$_unit.'$#i','', $value) ) . '">';
            /* My customize */
            $tab_pane  .= '<select id="' . $this -> field['id'] . '-unit"'.$select2_data
                .' data-placeholder="'.esc_html__('Units', 'templaza-framework')
                .'" class="redux-typography-unit" data-name="unit" data-value="'.preg_replace('/[a-zA-Z]+$/i','', $value).'">';
            foreach ($letter_units as $un) {
                if(!empty($un)) {
                    $tab_pane .= '<option value="' . $un . '"' . selected($un, $_unit, false) . '>' . $un . '</option>';
                }else{
                    $tab_pane .= '<option></option>';
                }
            }
            $tab_pane  .=  '<select>';
            /* End my customize */
            $tab_pane  .= '<input type="hidden" name="'
                . esc_attr( $this -> field['name'] . $this -> field['name_suffix'] )
                . '[letter-spacing]['.$device.']" value="' . esc_attr( $value  )
                . '" data-id="' . esc_attr( $this -> field['id'] ) . '" data-device="'.$device.'"/>';
            $tab_pane  .= '</div>';
        }
        echo '  <ul class="clearfix uk-iconnav uk-width-expand" data-uk-switcher="active: 1;">';
        echo $nav_tab;
        echo '  </ul>';
        echo '  <div class="uk-switcher uk-width-1-1 uk-margin-remove">';
        echo $tab_pane;
        echo '  </div>';
        echo '</div>';
        echo '</div>';

    }

    echo '<div class="clearfix"></div>';

    if ( Redux_Core::$pro_loaded ) {
        // phpcs:ignore WordPress.NamingConventions.ValidHookName, WordPress.Security.EscapeOutput
        echo apply_filters( 'redux/pro/typography/render/extra_inputs', null );
    }

    /* Font Color */
    if ( true === $this -> field['color'] ) {
        $default = '';

        if ( empty( $this -> field['default']['color'] ) && ! empty( $this -> field['color'] ) ) {
            $default = $this -> value['color'];
        } elseif ( ! empty( $this -> field['default']['color'] ) ) {
            $default = $this -> field['default']['color'];
        }

        echo '<div class="picker-wrapper">';
        echo '<label>' . esc_html__( 'Font Color', 'redux-framework' ) . '</label>';
        echo '<div id="' . esc_attr( $this -> field['id'] ) . '_color_picker" class="colorSelector typography-color">';
        echo '<div style="background-color: ' . esc_attr( $this -> value['color'] ) . '"></div>';
        echo '</div>';
        echo '<input ';
        echo 'data-default-color="' . esc_attr( $default ) . '"';
        echo 'class="color-picker redux-color redux-typography-color ' . esc_attr( $this -> field['class'] ) . '"';
        echo 'original-title="' . esc_html__( 'Font color', 'redux-framework' ) . '"';
        echo 'id="' . esc_attr( $this -> field['id'] ) . '-color"';
        echo 'name="' . esc_attr( $this -> field['name'] . $this -> field['name_suffix'] ) . '[color]"';
        echo 'type="text"';
        echo 'value="' . esc_attr( $this -> value['color'] ) . '"';
        echo 'data-id="' . esc_attr( $this -> field['id'] ) . '"';

        if ( Redux_Core::$pro_loaded ) {
            $data = array(
                'field' => $this -> field,
                'index' => 'color',
            );

            // phpcs:ignore WordPress.NamingConventions.ValidHookName
            echo esc_html( apply_filters( 'redux/pro/render/color_alpha', $data ) );
        }

        if(method_exists('Redux_Functions_Ex', 'output_alpha_data')) {
            $data = array(
                'field' => $this->field,
                'index' => 'color',
            );
            echo Redux_Functions_Ex::output_alpha_data($data);
        }

        echo '/>';
        echo '</div>';
    }

    echo '<div class="clearfix"></div>';

    /* Font Preview */
    if ( ! isset( $this -> field['preview'] ) || false !== $this -> field['preview'] ) {
        if ( isset( $this -> field['preview']['text'] ) ) {
            $g_text = $this -> field['preview']['text'];
        } else {
            $g_text = '1 2 3 4 5 6 7 8 9 0 A B C D E F G H I J K L M N O P Q R S T U V W X Y Z a b c d e f g h i j k l m n o p q r s t u v w x y z';
        }

        $style = '';
        if ( isset( $this -> field['preview']['always_display'] ) ) {
            if ( true === filter_var( $this -> field['preview']['always_display'], FILTER_VALIDATE_BOOLEAN ) ) {
                if ( true === $is_google_font ) {
                    $typography_preview[ $font_family[0] ] = array(
                        'font-style' => array( $this -> value['font-weight'] . $this -> value['font-style'] ),
                        'subset'     => array( $this -> value['subsets'] ),
                    );

    //                    wp_deregister_style( 'redux-typography-preview' );
    //                    wp_dequeue_style( 'redux-typography-preview' );
    //
    //                    wp_enqueue_style( 'redux-typography-preview', $this->make_google_web_font_link( $this->typography_preview ), array(), Redux_Core::$version, 'all' );
                }

                $style = 'display: block; font-family: ' . esc_attr( $this -> value['font-family'] ) . '; font-weight: ' . esc_attr( $this -> value['font-weight'] ) . ';';
            }
        }

        if ( isset( $this -> field['preview']['font-size'] ) ) {
            $style .= 'font-size: ' . $this -> field['preview']['font-size'] . ';';
            $in_use = '1';
        } else {
            $in_use = '0';
        }

        if ( Redux_Helpers::google_fonts_update_needed() && ! get_option( 'auto_update_redux_google_fonts', false ) && $this->field['font-family'] && $this->field['google'] ) {
            $nonce = wp_create_nonce( 'redux_update_google_fonts' );

            echo '<div data-nonce="' . esc_attr( $nonce ) . '" class="redux-update-google-fonts update-message notice inline notice-warning notice-alt">';
            echo '<p>' . esc_html__( 'Your Google Fonts are out of date. In order to update them you must register for Redux to enable updates.', 'redux-framework' );
            echo '&nbsp;<a href="#" class="update-google-fonts" data-action="automatic" aria-label="' . esc_attr__( 'Automated updates', 'redux-framework' ) . '">' . esc_html__( 'Automated updates', 'redux-framework' ) . '</a> or <a href="#" class="update-google-fonts" data-action="manual" aria-label="' . esc_attr__( 'one-time update', 'redux-framework' ) . '">' . esc_html__( 'one-time update', 'redux-framework' ) . '</a>.';
            echo '</p>';
            echo '</div>';
        }

        echo '<p data-preview-size="' . esc_attr( $in_use ) . '" class="clear ' . esc_attr( $this -> field['id'] ) . '_previewer typography-preview" style="' . esc_attr( $style ) . '">' . esc_html( $g_text ) . '</p>';

        if ( Redux_Core::$pro_loaded ) {
            // phpcs:ignore WordPress.NamingConventions.ValidHookName, WordPress.Security.EscapeOutput
            echo apply_filters( 'redux/pro/typography/render/text_shadow', null );
        }

        echo '</div>'; // end typography container.
    }
?>
</div>
