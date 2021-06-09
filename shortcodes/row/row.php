<?php

defined('TEMPLAZA_FRAMEWORK') or exit();

use TemPlazaFramework\Functions;

if(!class_exists('TemplazaFramework_ShortCode_Row')){
    class TemplazaFramework_ShortCode_Row extends TemplazaFramework_ShortCode {
        protected $element;

        public function __construct($field_parent = array(), $value = '', $parent = '')
        {
            $this -> hooks();

            parent::__construct($field_parent, $value, $parent);
        }

        public function hooks(){
            add_filter('templaza-framework/layout/generate/shortcode/'.$this -> get_shortcode_name().'/prepare', array($this, 'prepare_options'));
        }

        public function prepare_options($item){
            $item['has_children_shortcode']    = true;
            return $item;
        }

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
//                                    array(
//                                        'id'       => 'full-height',
//                                        'type'     => 'switch',
//                                        'title'    => __('Full height row', $this -> text_domain),
//                                        'subtitle' => __('If set on, row will be set to full height.', $this -> text_domain),
//                                        'default'  => false,
//                                    ),
//                                    array(
//                                        'id'       => 'columns-placement',
//                                        'type'     => 'select',
//                                        'title'    => __('Columns position', $this -> text_domain),
//                                        'subtitle' => __('Select columns position within row.', $this -> text_domain),
//                                        'options'  => array(
//                                            'top'     => esc_html__('Top', $this -> text_domain),
//                                            'middle'  => esc_html__('Middle', $this -> text_domain),
//                                            'bottom'  => esc_html__('Bottom', $this -> text_domain),
//                                            'stretch' => esc_html__('Stretch', $this -> text_domain),
//                                        ),
//                                        'default'  => 'top',
//                                        'required' => array('full-height', '=', false),
//                                    ),
//                                    array(
//                                        'id'       => 'equal-height',
//                                        'type'     => 'switch',
//                                        'title'    => __('Equal height', $this -> text_domain),
//                                        'subtitle' => __('If set on, columns will be set to equal height.', $this -> text_domain),
//                                        'default'  => true,
//                                    ),
//                                    array(
//                                        'id'       => 'rtl-reverse',
//                                        'type'     => 'switch',
//                                        'title'    => __('Reverse columns in RTL', $this -> text_domain),
//                                        'subtitle' => __('If set on, columns will be reversed in RTL.', $this -> text_domain),
//                                        'default'  => false,
//                                    ),
//                                    array(
//                                        'id'       => 'content-placement',
//                                        'type'     => 'select',
//                                        'title'    => __('Content position', $this -> text_domain),
//                                        'subtitle' => __('Select content position within columns.', $this -> text_domain),
//                                        'options'  => array(
//                                            'top'     => esc_html__('Top', $this -> text_domain),
//                                            'middle'  => esc_html__('Middle', $this -> text_domain),
//                                            'bottom'  => esc_html__('Bottom', $this -> text_domain),
//                                        ),
//                                        'default'  => '',
//                                    ),
                                ),
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
                                        'subtitle' => esc_html__('Enable to hide this section on extra-small Devices', $this -> text_domain),
                                        'default'  => false,
                                    ),
                                    array(
                                        'id'       => 'hideonsm',
                                        'type'     => 'switch',
                                        'title'    => esc_html__('Hide on Small Devices', $this -> text_domain),
                                        'subtitle' => esc_html__('Enable to hide this section on Small Devices.', $this -> text_domain),
                                        'default'  => false,
                                    ),
                                    array(
                                        'id'       => 'hideonmd',
                                        'type'     => 'switch',
                                        'title'    => esc_html__('Hide on Medium Devices', $this -> text_domain),
                                        'subtitle' => esc_html__('Enable to hide this section on medium Devices.', $this -> text_domain),
                                        'default'  => false,
                                    ),
                                    array(
                                        'id'       => 'hideonlg',
                                        'type'     => 'switch',
                                        'title'    => esc_html__('Hide on Large Devices', $this -> text_domain),
                                        'subtitle' => esc_html__('Enable to hide this section on Large Devices.', $this -> text_domain),
                                        'default'  => false,
                                    ),
                                    array(
                                        'id'       => 'hideonxl',
                                        'type'     => 'switch',
                                        'title'    => esc_html__('Hide on Extra-Large Devices', $this -> text_domain),
                                        'subtitle' => esc_html__('Enable to hide this section on Extra-Large Devices.', $this -> text_domain),
                                        'default'  => false,
                                    ),
                                    array(
                                        'id'       => 'hideonxxl',
                                        'type'     => 'switch',
                                        'title'    => esc_html__('Hide on Extra-Extra-Large Devices', $this -> text_domain),
                                        'subtitle' => esc_html__('Enable to hide this section on Extra-Extra-Large Devices.', $this -> text_domain),
                                        'default'  => false,
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


            if(!isset($params['tz_class'])){
                $params['tz_class'] = '';
            }

            if(isset($params['tz_no_gutters']) && $params['tz_no_gutters']){
                $params['tz_class'] .= ' no-gutters gx-0';
            }

            if(isset($params['hideonxxl']) && (bool) $params['hideonxxl']){
                $params['tz_class'] .= ' hideonxxl';
            }
            if(isset($params['hideonxl']) && (bool) $params['hideonxl']){
                $params['tz_class'] .= ' hideonxl';
            }
            if(isset($params['hideonlg']) && (bool) $params['hideonlg']){
                $params['tz_class'] .= ' hideonlg';
            }
            if(isset($params['hideonmd']) && (bool) $params['hideonmd']){
                $params['tz_class'] .= ' hideonmd';
            }
            if(isset($params['hideonsm']) && (bool) $params['hideonsm']){
                $params['tz_class'] .= ' hideonsm';
            }
            if(isset($params['hideonxs']) && (bool) $params['hideonxs']){
                $params['tz_class'] .= ' hideonxs';
            }

            return $params;
        }

    }

}

?>