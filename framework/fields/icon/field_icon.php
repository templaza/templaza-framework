<?php


if ( ! class_exists( 'ReduxFramework_select' ) ) {
    require_once TEMPLAZA_FRAMEWORK_PLUGIN_DIR_PATH.'/redux-framework/ReduxCore/inc/fields/select/field_select.php';
}

class ReduxFramework_Icon extends ReduxFramework_select {

    public function __construct( &$field = array(), $value = '', $parent ) {
        $field['class']             = 'font-icons';
        $field['fieldset_class']    = 'redux-container-select';
        parent::__construct($field, $value, $parent);
    }
    public function render() {
        if (empty( $this->field['options'] ) ) {
            if(!empty($this -> field['data'])){
                $icons_file   = TEMPLAZA_FRAMEWORK_FIELD_PATH.'/'.$this -> field['type'].'/font-icons/'.$this -> field['data'].'.php';
                /**
                 * filter 'redux-font-icons-file}'
                 *
                 * @param  array $icon_file File for the icons
                 */
    //                $icons_file = apply_filters( 'redux-font-icons-file', $icons_file );
                $icons_file = apply_filters( 'templaza-framework-font-icons-file', $icons_file, $this -> field );

                /**
                 * filter 'redux/{opt_name}/field/font/icons/file'
                 *
                 * @param  array $icon_file File for the icons
                 */
                $icons_file = apply_filters( "templaza-framework/{$this->parent->args['opt_name']}/field/font/icons/file", $icons_file, $this -> field);
//            else{
//                $icons_file   = TEMPLAZA_FRAMEWORK_FIELD_PATH.'/'.$this -> field['type'].'/font-icons/fontawesome.php';
////                var_dump($icons_file); die();
//            }

                if ( file_exists( $icons_file ) ) {
                    require_once $icons_file;
                }
                $font_icons = apply_filters( 'redux-font-icons', array() );
                $font_icons = apply_filters('templaza-framework/font-icons', $font_icons );

                $this->field['select2']   = true;
    //                $this->field['class']   .= "font-icons";

                if($font_icons && count($font_icons)) {
                    $font_icons = array_combine($font_icons, $font_icons);
                }
                $this->field['options'] = $font_icons;
            }
        }

        parent::render();
    } //function

//    protected function make_option($id, $value, $group_name = '') {
//        if ( is_array( $this->value ) ) {
//            $selected = ( is_array( $this->value ) && in_array( $id, $this->value ) ) ? ' selected="selected"' : '';
//        } else {
//            $selected = selected( $this->value, $id, false );
//        }
//
//        echo '<option value="' . $id . '"' . $selected . '>' . $value . '</option>';
//    }
}