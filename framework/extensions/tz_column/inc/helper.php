<?php

namespace TemPlazaFramework\Extensions\TZ_Column;

class Helper{
    public static function check_required_dependencies($field, $parent_field, &$parent){
        if ( ! empty ( $field['required'] ) ) {
            if ( is_array( $field['required'][0] ) ) {
                foreach ( $field['required'] as $value ) {
                    if ( is_array( $value ) && count( $value ) == 3 ) {
                        $data               = array();
                        $data['parent']     = $value[0];
                        $data['operation']  = $value[1];
                        $data['checkValue'] = $value[2];

                        self::checkRequiredDependencies( $field, $data, $parent );
                    }
                }
            }else{

                $data               = array();
                $data['parent']     = $field['required'][0];
                $data['operation']  = $field['required'][1];
                $data['checkValue'] = $field['required'][2];


                $data['parent_field']     = str_replace($parent_field['id'].'-', '', $data['parent']);

                self::checkRequiredDependencies( $field, $data, $parent_field, $parent );
            }
        }
    }
    protected static function checkRequiredDependencies( $field, $data, $parent_field , &$parent) {
        if ( isset ( $parent->options[ $parent_field['id'] ] ) ) {
            $parent_option  = $parent -> options[$parent_field['id']];
            if(is_array($parent_option) && isset($parent_option[$data['parent_field'] ])) {
                $return = self::compareValueDependencies( $parent_option[$data['parent_field'] ], $data['checkValue'], $data['operation'] );
            }else{
                if($default_value = $parent -> get_default_value($data['parent'])) {
                    $return = self::compareValueDependencies($default_value, $data['checkValue'], $data['operation']);
                }

            }
            if(isset($return) && $return){
                $parent -> folds[$field['id']]  = 'show';
            }
        }
    }

    protected static function compareValueDependencies( $parentValue, $checkValue, $operation ) {
        $return = false;
        switch ( $operation ) {
            case '=':
            case 'equals':
                $data['operation'] = "=";

                if ( is_array( $parentValue ) ) {
                    foreach ( $parentValue as $idx => $val ) {
                        if ( is_array( $checkValue ) ) {
                            foreach ( $checkValue as $i => $v ) {
                                if ( \Redux_Helpers::makeBoolStr($val) === \Redux_Helpers::makeBoolStr($v) ) {
                                    $return = true;
                                }
                            }
                        } else {
                            if ( \Redux_Helpers::makeBoolStr($val) === \Redux_Helpers::makeBoolStr($checkValue) ) {
                                $return = true;
                            }
                        }
                    }
                } else {
                    //var_dump($checkValue);
                    if ( is_array( $checkValue ) ) {
                        foreach ( $checkValue as $i => $v ) {
                            if ( \Redux_Helpers::makeBoolStr($parentValue) === \Redux_Helpers::makeBoolStr($v) ) {
                                $return = true;
                            }
                        }
                    } else {
                        if ( \Redux_Helpers::makeBoolStr($parentValue) === \Redux_Helpers::makeBoolStr($checkValue) ) {
                            $return = true;
                        }
                    }
                }
                break;

            case '!=':
            case 'not':
                $data['operation'] = "!==";
                if ( is_array( $parentValue ) ) {
                    foreach ( $parentValue as $idx => $val ) {
                        if ( is_array( $checkValue ) ) {
                            foreach ( $checkValue as $i => $v ) {
                                if ( \Redux_Helpers::makeBoolStr($val) !== Redux_Helpers::makeBoolStr($v) ) {
                                    $return = true;
                                }
                            }
                        } else {
                            if ( \Redux_Helpers::makeBoolStr($val) !== Redux_Helpers::makeBoolStr($checkValue) ) {
                                $return = true;
                            }
                        }
                    }
                } else {
                    if ( is_array( $checkValue ) ) {
                        foreach ( $checkValue as $i => $v ) {
                            if ( \Redux_Helpers::makeBoolStr($parentValue) !== Redux_Helpers::makeBoolStr($v) ) {
                                $return = true;
                            }
                        }
                    } else {
                        if ( \Redux_Helpers::makeBoolStr($parentValue) !== \Redux_Helpers::makeBoolStr($checkValue) ) {
                            $return = true;
                        }
                    }
                }
                break;
            case '>':
            case 'greater':
            case 'is_larger':
                $data['operation'] = ">";
                if ( $parentValue > $checkValue ) {
                    $return = true;
                }
                break;
            case '>=':
            case 'greater_equal':
            case 'is_larger_equal':
                $data['operation'] = ">=";
                if ( $parentValue >= $checkValue ) {
                    $return = true;
                }
                break;
            case '<':
            case 'less':
            case 'is_smaller':
                $data['operation'] = "<";
                if ( $parentValue < $checkValue ) {
                    $return = true;
                }
                break;
            case '<=':
            case 'less_equal':
            case 'is_smaller_equal':
                $data['operation'] = "<=";
                if ( $parentValue <= $checkValue ) {
                    $return = true;
                }
                break;
            case 'contains':
                if ( is_array( $parentValue ) ) {
                    $parentValue = implode( ',', $parentValue );
                }

                if ( is_array( $checkValue ) ) {
                    foreach ( $checkValue as $idx => $opt ) {
                        if ( strpos( $parentValue, (string) $opt ) !== false ) {
                            $return = true;
                        }
                    }
                } else {
                    if ( strpos( $parentValue, (string) $checkValue ) !== false ) {
                        $return = true;
                    }
                }

                break;
            case 'doesnt_contain':
            case 'not_contain':
                if ( is_array( $parentValue ) ) {
                    $parentValue = implode( ',', $parentValue );
                }

                if ( is_array( $checkValue ) ) {
                    foreach ( $checkValue as $idx => $opt ) {
                        if ( strpos( $parentValue, (string) $opt ) === false ) {
                            $return = true;
                        }
                    }
                } else {
                    if ( strpos( $parentValue, (string) $checkValue ) === false ) {
                        $return = true;
                    }
                }

                break;
            case 'is_empty_or':
                if ( empty ( $parentValue ) || $parentValue == $checkValue ) {
                    $return = true;
                }
                break;
            case 'not_empty_and':
                if ( ! empty ( $parentValue ) && $parentValue != $checkValue ) {
                    $return = true;
                }
                break;
            case 'is_empty':
            case 'empty':
            case '!isset':
                if ( empty ( $parentValue ) || $parentValue == "" || $parentValue == null ) {
                    $return = true;
                }
                break;
            case 'not_empty':
            case '!empty':
            case 'isset':
                if ( ! empty ( $parentValue ) && $parentValue != "" && $parentValue != null ) {
                    $return = true;
                }
                break;
        }

        return $return;
    }
}