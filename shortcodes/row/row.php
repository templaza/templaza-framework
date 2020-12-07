<?php

defined('TEMPLAZA_FRAMEWORK') or exit();

use TemPlazaFramework\Functions;

if(!class_exists('TemplazaFramework_ShortCode_Row')){
    class TemplazaFramework_ShortCode_Row extends TemplazaFramework_ShortCode {
        protected $element;

        public function register(){
            return array(
                'id'          => 'row',
                'title'       => __('Row'),
                'icon'        => 'el el-align-left',
                'param_title' => esc_html__('Row Settings'),
                'desc'        => __('Load a row'),
                'core'        => true,
                'params'      => array(
                    array(
                        'id' => 'tabs',
                        'type'  => 'tz_tab',
                        'tabs' => array(
                            // General settings
                            array(
                                'id' => 'settings',
                                'title'  => esc_html__('General Settings', $this -> text_domain),
                                'fields' => array(
                                    array(
                                        'id'       => 'test',
                                        'type'     => 'text',
                                        'title'    => esc_html__('Custom Class', $this -> text_domain),
                                        'subtitle' => esc_html__('Custom Class can be used for writing custom CSS or JS.', $this -> text_domain),
                                    ),
//                                    array(
//                                        'id'       => 'customid',
//                                        'type'     => 'text',
//                                        'title'    => esc_html__('Custom ID', $this -> text_domain),
//                                        'subtitle' => esc_html__('Custom ID can be used for overriding the auto-generated id.', $this -> text_domain),
//                                    ),
                                ),
                            ),

                            // Design settings
                            array(
                                'id'     => 'design-settings',
                                'title'  => esc_html__('Design Settings', $this -> text_domain),
                                'fields' => array(
                                    array(
                                        'id'    => 'background',
                                        'type'  => 'background',
                                        'title' => esc_html__('Background'),
                                    ),
                                )
                            ),
                            // Responsive settings
                            array(
                                'id'     => 'responsive-settings',
                                'title'  => esc_html__('Responsive Settings', $this -> text_domain),
                                'fields' => array(
                                    array(
                                        'id'       => 'tab-device-visibility',
                                        'type'     => 'section',
                                        'indent'   => true,
                                        'title'    => esc_html__('Device Visibility', $this -> text_domain),
                                    ),
                                    array(
                                        'id'       => 'hideonxs',
                                        'type'     => 'switch',
                                        'title'    => esc_html__('Hide on Extra-Small Devices', $this -> text_domain),
                                        'subtitle' => esc_html__('Enable to hide this section on medium Devices', $this -> text_domain),
                                    ),
                                    array(
                                        'id'       => 'hideonsm',
                                        'type'     => 'switch',
                                        'title'    => esc_html__('Hide on Small Devices', $this -> text_domain),
                                        'subtitle' => esc_html__('Enable to hide this section on Small Devices.', $this -> text_domain),
                                    ),
                                    array(
                                        'id'       => 'hideonmd',
                                        'type'     => 'switch',
                                        'title'    => esc_html__('Hide on Medium Devices', $this -> text_domain),
                                        'subtitle' => esc_html__('Enable to hide this section on medium Devices.', $this -> text_domain),
                                    ),
                                    array(
                                        'id'       => 'hideonlg',
                                        'type'     => 'switch',
                                        'title'    => esc_html__('Hide on Large Devices', $this -> text_domain),
                                        'subtitle' => esc_html__('Enable to hide this section on Large Devices.', $this -> text_domain),
                                    ),
                                    array(
                                        'id'       => 'hideonxl',
                                        'type'     => 'switch',
                                        'title'    => esc_html__('Hide on Extra-Large Devices', $this -> text_domain),
                                        'subtitle' => esc_html__('Enable to hide this section on Extra-Large Devices.', $this -> text_domain),
                                    ),
                                    array(
                                        'id'       => 'tab-device-visibility-end',
                                        'type'     => 'section',
                                        'indent'   => false, // Indent all options below until the next 'section' option is set.
                                    ),
                                )
                            ),
                        ),
                    ),
                )
            );

        }

        public function prepare_params($params, $element){

            $params = parent::prepare_params($params, $element);

            if(isset($params['tz_no_gutters'])){
                $params['tz_class'] .= ' no-gutters';
            }

            return $params;
        }

    }

}

?>