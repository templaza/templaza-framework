<?php

namespace TemPlazaFramework\Helpers;

defined('TEMPLAZA_FRAMEWORK') or exit();

class FieldHelper{
    public static function check_required_dependencies($field, $parent_field, &$parent){
        if ( ! empty ( $field['required'] ) ) {
            if ( is_array( $field['required'][0] ) ) {
                foreach ( $field['required'] as $value ) {
                    if ( is_array( $value ) && count( $value ) == 3 ) {
                        $data               = array();
                        $data['parent']     = $value[0];
                        $data['operation']  = $value[1];
                        $data['checkValue'] = $value[2];

                        self::checkRequiredDependencies( $field, $data, $parent_field, $parent );
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
        // The Required field must not be hidden. Otherwise, hide this one by default.
        if ( ! in_array( $data['parent'], $parent->fields_hidden, true ) && ( ! isset( $parent->folds[ $field['id'] ] ) || 'hide' !== $parent->folds[ $field['id'] ] ) ) {
            if ( isset( $parent->options[ $data['parent'] ] ) ) {
                $return = self::compareValueDependencies( $parent->options[ $data['parent'] ], $data['checkValue'], $data['operation'] );
            } elseif ( isset( $parent->options_defaults[ $data['parent'] ] ) ) {
                $return = self::compareValueDependencies( $parent->options_defaults[ $data['parent'] ], $data['checkValue'], $data['operation'] );
            }
        }

        if ( ( isset( $return ) && $return ) && ( ! isset( $parent->folds[ $field['id'] ] ) || 'hide' !== $parent->folds[ $field['id'] ] ) ) {
            $parent->folds[ $field['id'] ] = 'show';
        } else {
            $parent->folds[ $field['id'] ] = 'hide';

            if ( ! in_array( $field['id'], $parent->fields_hidden, true ) ) {
                $parent->fields_hidden[] = $field['id'];
            }
        }

//        if ( isset ( $parent->options[ $parent_field['id'] ] ) ) {
//            $parent_option  = $parent -> options[$parent_field['id']];
//            if(is_array($parent_option) && isset($parent_option[$data['parent_field'] ])) {
//                $return = self::compareValueDependencies( $parent_option[$data['parent_field'] ], $data['checkValue'], $data['operation'] );
//            }else{
//                if($default_value = $parent -> get_default_value($data['parent'])) {
//                    $return = self::compareValueDependencies($default_value, $data['checkValue'], $data['operation']);
//                }
//
//            }
//            if(isset($return) && $return){
//                $parent -> folds[$field['id']]  = 'show';
//            }
//        }
    }

    protected static function compareValueDependencies( $parent_value, $check_value, $operation ) {
        $return = false;
        switch ( $operation ) {
            case '=':
            case 'equals':
                $data['operation'] = '=';

                if ( is_array( $parent_value ) ) {
                    foreach ( $parent_value as $val ) {
                        if ( is_array( $check_value ) ) {
                            foreach ( $check_value as $v ) {
                                if ( \Redux_Helpers::make_bool_str( $val ) === \Redux_Helpers::make_bool_str( $v ) ) {
                                    $return = true;
                                }
                            }
                        } else {
                            if ( \Redux_Helpers::make_bool_str( $val ) === \Redux_Helpers::make_bool_str( $check_value ) ) {
                                $return = true;
                            }
                        }
                    }
                } else {
                    if ( is_array( $check_value ) ) {
                        foreach ( $check_value as $v ) {
                            if ( \Redux_Helpers::make_bool_str( $parent_value ) === \Redux_Helpers::make_bool_str( $v ) ) {
                                $return = true;
                            }
                        }
                    } else {
                        if ( \Redux_Helpers::make_bool_str( $parent_value ) === \Redux_Helpers::make_bool_str( $check_value ) ) {
                            $return = true;
                        }
                    }
                }
                break;

            case '!=':
            case 'not':
                $data['operation'] = '!==';
                if ( is_array( $parent_value ) ) {
                    foreach ( $parent_value as $val ) {
                        if ( is_array( $check_value ) ) {
                            foreach ( $check_value as $v ) {
                                if ( \Redux_Helpers::make_bool_str( $val ) !== \Redux_Helpers::make_bool_str( $v ) ) {
                                    $return = true;
                                }
                            }
                        } else {
                            if ( \Redux_Helpers::make_bool_str( $val ) !== \Redux_Helpers::make_bool_str( $check_value ) ) {
                                $return = true;
                            }
                        }
                    }
                } else {
                    if ( is_array( $check_value ) ) {
                        foreach ( $check_value as $v ) {
                            if ( \Redux_Helpers::make_bool_str( $parent_value ) !== \Redux_Helpers::make_bool_str( $v ) ) {
                                $return = true;
                            }
                        }
                    } else {
                        if ( \Redux_Helpers::make_bool_str( $parent_value ) !== \Redux_Helpers::make_bool_str( $check_value ) ) {
                            $return = true;
                        }
                    }
                }

                break;
            case '>':
            case 'greater':
            case 'is_larger':
                $data['operation'] = '>';
                if ( $parent_value > $check_value ) {
                    $return = true;
                }
                break;
            case '>=':
            case 'greater_equal':
            case 'is_larger_equal':
                $data['operation'] = '>=';
                if ( $parent_value >= $check_value ) {
                    $return = true;
                }
                break;
            case '<':
            case 'less':
            case 'is_smaller':
                $data['operation'] = '<';
                if ( $parent_value < $check_value ) {
                    $return = true;
                }
                break;
            case '<=':
            case 'less_equal':
            case 'is_smaller_equal':
                $data['operation'] = '<=';
                if ( $parent_value <= $check_value ) {
                    $return = true;
                }
                break;
            case 'contains':
                if ( is_array( $parent_value ) ) {
                    $parent_value = implode( ',', $parent_value );
                }

                if ( is_array( $check_value ) ) {
                    foreach ( $check_value as $opt ) {
                        if ( strpos( $parent_value, (string) $opt ) !== false ) {
                            $return = true;
                        }
                    }
                } else {
                    if ( strpos( $parent_value, (string) $check_value ) !== false ) {
                        $return = true;
                    }
                }

                break;
            case 'doesnt_contain':
            case 'not_contain':
                if ( is_array( $parent_value ) ) {
                    $parent_value = implode( ',', $parent_value );
                }

                if ( is_array( $check_value ) ) {
                    foreach ( $check_value as $opt ) {
                        if ( strpos( $parent_value, (string) $opt ) === false ) {
                            $return = true;
                        }
                    }
                } else {
                    if ( strpos( $parent_value, (string) $check_value ) === false ) {
                        $return = true;
                    }
                }

                break;
            case 'is_empty_or':
                if ( empty( $parent_value ) || $check_value === $parent_value ) {
                    $return = true;
                }
                break;
            case 'not_empty_and':
                if ( ! empty( $parent_value ) && $check_value !== $parent_value ) {
                    $return = true;
                }
                break;
            case 'is_empty':
            case 'empty':
            case '!isset':
                if ( empty( $parent_value ) ) {
                    $return = true;
                }
                break;
            case 'not_empty':
            case '!empty':
            case 'isset':
                if ( ! empty( $parent_value ) && '' !== $parent_value ) {
                    $return = true;
                }
                break;
        }

        return $return;
    }
}