<?php

defined('TEMPLAZA_FRAMEWORK') or exit();

use TemPlazaFramework\Functions;

if(!class_exists('TemplazaFramework_ShortCode_Column')){
    class TemplazaFramework_ShortCode_Column extends TemplazaFramework_ShortCode {

        public function register(){
            return array(
                'id'          => 'column',
                'title'       => __('Column'),
                'param_title' => esc_html__('Column Settings'),
                'desc'        => __('Place content elements inside the row'),
                'core'        => true, // This shortcode doesn't list in element list when add new element in column
                'params'      => array(
                    array(
                        'id'    => 'tabs',
                        'type'  => 'tz_tab',
                        'tabs'  => array(
                            // General settings
                            array(
                                'id' => 'settings',
                                'title'  => esc_html__('General Settings', $this -> text_domain),
                                'fields' => array(
//                                    array(
//                                        'id'       => 'customclass',
//                                        'type'     => 'text',
//                                        'title'    => esc_html__('Custom Class', $this -> text_domain),
//                                        'subtitle' => esc_html__('Custom Class can be used for writing custom CSS or JS.', $this -> text_domain),
//                                        'default'  => 'test',
//                                    ),
//                                    array(
//                                        'id'       => 'customid',
//                                        'type'     => 'text',
//                                        'title'    => esc_html__('Custom ID', $this -> text_domain),
//                                        'subtitle' => esc_html__('Custom ID can be used for overriding the auto-generated id.', $this -> text_domain),
//                                        'default'  => time(),
//                                    ),
                                ),
                            ), // End general settings

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
                                    array(
                                        'id'     => 'tab-custom_colors',
                                        'type'   => 'section',
                                        'indent' => true,
                                        'title'  => esc_html__('Custom Colors', $this -> text_domain),
                                    ),
                                    array(
                                        'id'       => 'text_color',
                                        'type'     => 'color',
                                        'title'    => esc_html__('Text Color', $this -> text_domain),
                                        'required' => array('custom_colors', '=', '1'),
                                    ),
                                    array(
                                        'id'       => 'link_color',
                                        'type'     => 'link_color',
                                        'title'    => esc_html__('Link Color', $this -> text_domain),
                                        'required' => array('custom_colors', '=', '1'),
                                    ),
                                    array(
                                        'id'     => 'tab-end',
                                        'type'   => 'section',
                                        'indent' => false, // Indent all options below until the next 'section' option is set.
                                    ),
                                )
                            ), // End design settings

                            // Responsive settings
                            array(
                                'id'     => 'responsive-settings',
                                'title'  => esc_html__('Responsive Settings', $this -> text_domain),
                                'fields' => array(
                                    array(
                                        'id'     => 'tab-extra-small',
                                        'type'   => 'section',
                                        'indent' => true,
                                        'title'  => esc_html__('Extra small', $this -> text_domain),
                                        'subtitle'   => esc_html__('<576px', $this -> text_domain),
                                    ),
                                    array(
                                        'id'      => 'xs_colum_size',
                                        'type'    => 'select',
                                        'title'   => esc_html__('Column size'),
                                        'options' => array(
                                            'inherit' => esc_html__('Inherit', $this -> text_domain),
                                            '1'       => esc_html__('col-xs-1', $this -> text_domain),
                                            '2'       => esc_html__('col-xs-2', $this -> text_domain),
                                            '3'       => esc_html__('col-xs-3', $this -> text_domain),
                                            '4'       => esc_html__('col-xs-4', $this -> text_domain),
                                            '5'       => esc_html__('col-xs-5', $this -> text_domain),
                                            '6'       => esc_html__('col-xs-6', $this -> text_domain),
                                            '7'       => esc_html__('col-xs-7', $this -> text_domain),
                                            '8'       => esc_html__('col-xs-8', $this -> text_domain),
                                            '9'       => esc_html__('col-xs-9', $this -> text_domain),
                                            '10'      => esc_html__('col-xs-10', $this -> text_domain),
                                            '11'      => esc_html__('col-xs-11', $this -> text_domain),
                                            '12'      => esc_html__('col-xs-12', $this -> text_domain),
                                        )
                                    ),
                                    array(
                                        'id'      => 'xs_visibility',
                                        'type'    => 'switch',
                                        'title'   => esc_html__('Visibility'),
                                    ),
                                    // Small subsection
                                    array(
                                        'id'     => 'tab-small',
                                        'type'   => 'section',
                                        'indent' => true,
                                        'title'  => esc_html__('Small', $this -> text_domain),
                                        'subtitle'   => esc_html__('>=576px', $this -> text_domain),
                                    ),
                                    array(
                                        'id'      => 'sm_colum_size',
                                        'type'    => 'select',
                                        'title'   => esc_html__('Column size'),
                                        'options' => array(
                                            'inherit' => esc_html__('Inherit', $this -> text_domain),
                                            '1'       => esc_html__('col-sm-1', $this -> text_domain),
                                            '2'       => esc_html__('col-sm-2', $this -> text_domain),
                                            '3'       => esc_html__('col-sm-3', $this -> text_domain),
                                            '4'       => esc_html__('col-sm-4', $this -> text_domain),
                                            '5'       => esc_html__('col-sm-5', $this -> text_domain),
                                            '6'       => esc_html__('col-sm-6', $this -> text_domain),
                                            '7'       => esc_html__('col-sm-7', $this -> text_domain),
                                            '8'       => esc_html__('col-sm-8', $this -> text_domain),
                                            '9'       => esc_html__('col-sm-9', $this -> text_domain),
                                            '10'      => esc_html__('col-sm-10', $this -> text_domain),
                                            '11'      => esc_html__('col-sm-11', $this -> text_domain),
                                            '12'      => esc_html__('col-sm-12', $this -> text_domain),
                                        )
                                    ),
                                    array(
                                        'id'      => 'sm_visibility',
                                        'type'    => 'switch',
                                        'title'   => esc_html__('Visibility'),
                                    ),
                                    // Medium subsection
                                    array(
                                        'id'     => 'tab-medium',
                                        'type'   => 'section',
                                        'indent' => true,
                                        'title'  => esc_html__('Medium', $this -> text_domain),
                                        'subtitle'   => esc_html__('>=768px', $this -> text_domain),
                                    ),
                                    array(
                                        'id'      => 'md_colum_size',
                                        'type'    => 'select',
                                        'title'   => esc_html__('Column size'),
                                        'options' => array(
                                            'inherit' => esc_html__('Inherit', $this -> text_domain),
                                            '1'       => esc_html__('col-md-1', $this -> text_domain),
                                            '2'       => esc_html__('col-md-2', $this -> text_domain),
                                            '3'       => esc_html__('col-md-3', $this -> text_domain),
                                            '4'       => esc_html__('col-md-4', $this -> text_domain),
                                            '5'       => esc_html__('col-md-5', $this -> text_domain),
                                            '6'       => esc_html__('col-md-6', $this -> text_domain),
                                            '7'       => esc_html__('col-md-7', $this -> text_domain),
                                            '8'       => esc_html__('col-md-8', $this -> text_domain),
                                            '9'       => esc_html__('col-md-9', $this -> text_domain),
                                            '10'      => esc_html__('col-md-10', $this -> text_domain),
                                            '11'      => esc_html__('col-md-11', $this -> text_domain),
                                            '12'      => esc_html__('col-md-12', $this -> text_domain),
                                        )
                                    ),
                                    array(
                                        'id'      => 'md_visibility',
                                        'type'    => 'switch',
                                        'title'   => esc_html__('Visibility'),
                                    ),
                                    // Large subsection
                                    array(
                                        'id'     => 'tab-large',
                                        'type'   => 'section',
                                        'indent' => true,
                                        'title'  => esc_html__('Large', $this -> text_domain),
                                        'subtitle'   => esc_html__('>=992px', $this -> text_domain),
                                    ),
                                    array(
                                        'id'      => 'lg_colum_size',
                                        'type'    => 'select',
                                        'title'   => esc_html__('Column size'),
                                        'options' => array(
                                            'inherit' => esc_html__('Inherit', $this -> text_domain),
                                            '1'       => esc_html__('col-lg-1', $this -> text_domain),
                                            '2'       => esc_html__('col-lg-2', $this -> text_domain),
                                            '3'       => esc_html__('col-lg-3', $this -> text_domain),
                                            '4'       => esc_html__('col-lg-4', $this -> text_domain),
                                            '5'       => esc_html__('col-lg-5', $this -> text_domain),
                                            '6'       => esc_html__('col-lg-6', $this -> text_domain),
                                            '7'       => esc_html__('col-lg-7', $this -> text_domain),
                                            '8'       => esc_html__('col-lg-8', $this -> text_domain),
                                            '9'       => esc_html__('col-lg-9', $this -> text_domain),
                                            '10'      => esc_html__('col-lg-10', $this -> text_domain),
                                            '11'      => esc_html__('col-lg-11', $this -> text_domain),
                                            '12'      => esc_html__('col-lg-12', $this -> text_domain),
                                        )
                                    ),
                                    array(
                                        'id'      => 'lg_visibility',
                                        'type'    => 'switch',
                                        'title'   => esc_html__('Visibility'),
                                    ),
                                    // Extra large subsection
                                    array(
                                        'id'     => 'tab-extra-large',
                                        'type'   => 'section',
                                        'indent' => true,
                                        'title'  => esc_html__('Extra Large', $this -> text_domain),
                                        'subtitle'   => esc_html__('≥1200px', $this -> text_domain),
                                    ),
                                    array(
                                        'id'      => 'xl_colum_size',
                                        'type'    => 'select',
                                        'title'   => esc_html__('Column size'),
                                        'options' => array(
                                            'inherit' => esc_html__('Inherit', $this -> text_domain),
                                            '1'       => esc_html__('col-xl-1', $this -> text_domain),
                                            '2'       => esc_html__('col-xl-2', $this -> text_domain),
                                            '3'       => esc_html__('col-xl-3', $this -> text_domain),
                                            '4'       => esc_html__('col-xl-4', $this -> text_domain),
                                            '5'       => esc_html__('col-xl-5', $this -> text_domain),
                                            '6'       => esc_html__('col-xl-6', $this -> text_domain),
                                            '7'       => esc_html__('col-xl-7', $this -> text_domain),
                                            '8'       => esc_html__('col-xl-8', $this -> text_domain),
                                            '9'       => esc_html__('col-xl-9', $this -> text_domain),
                                            '10'      => esc_html__('col-xl-10', $this -> text_domain),
                                            '11'      => esc_html__('col-xl-11', $this -> text_domain),
                                            '12'      => esc_html__('col-xl-12', $this -> text_domain),
                                        )
                                    ),
                                    array(
                                        'id'      => 'xl_visibility',
                                        'type'    => 'switch',
                                        'title'   => esc_html__('Visibility'),
                                    ),
                                    array(
                                        'id'     => 'tab-end',
                                        'type'   => 'section',
                                        'indent' => false, // Indent all options below until the next 'section' option is set.
                                    ),
                                )
                            ), // End design settings
                        ), // End tab field
                    ),
                ),
            );

//            add_filter('templaza-framework/field/tz_layout/element/template', array($this, 'template'));
//            add_action('templaza-framework/field/tz_layout/element/template', array($this, 'template'));
        }


        public function prepare_params($params, $element){
            $params = parent::prepare_params($params, $element);

//            var_dump($element);
            if(isset($element['size'])){
                if(isset($params['tz_class'])) {
                    $params['tz_class'].= ' col-lg-'.$element['size'];
                }else{
                    $params['tz_class'] = ' col-lg-'.$element['size'];
                }
                $params['tz_class'] = trim($params['tz_class']);
            }

//            var_dump($params['tz_class'] );

            return $params;
        }


        public function enqueue() {
            if (!wp_script_is('templaza-shortcode-column-js')) {
                wp_enqueue_script(
                    'templaza-shortcode-column-js',
                    \TemPlazaFramework\Functions::get_my_url() . '/shortcodes/column/column.js',
                    array( 'jquery', 'jquery-ui-tabs', 'wp-util', 'redux-js', TEMPLAZA_FRAMEWORK_NAME.'__js'),
                    time(),
                    'all'
                );
            }
        }
    }

}

?>