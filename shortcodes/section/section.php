<?php

defined('TEMPLAZA_FRAMEWORK') or exit();

use TemPlazaFramework\Functions;

if(!class_exists('TemplazaFramework_ShortCode_Section')){
    class TemplazaFramework_ShortCode_Section extends TemplazaFramework_ShortCode{

        public function __construct($field_parent = array(), $value = '', $parent = '')
        {
            $this -> hooks();

            parent::__construct($field_parent, $value, $parent);
        }

        public function hooks(){
            add_filter('templaza-framework/layout/generate/shortcode/'.$this -> get_shortcode_name().'/prepare',
                array($this, 'prepare_options'));
        }

        public function prepare_options($item){
            $item['has_children_shortcode']    = true;
            return $item;
        }

        public function register()
        {
            return array(
                'id'          => 'section',
                'title'       => esc_html__('Section'),
                'param_title' => esc_html__('Section Settings'),
                'desc'        => esc_html__('Place content elements inside the row', $this -> text_domain),
                'admin_label' => true,
                'core'        => true,
                'params'      => array(
                    array(
                        'id' => 'tabs',
                        'type'  => 'tz_tab',
                        'tabs' => array(
                            // General settings
                            array(
                                'id' => 'settings',
                                'title'  => esc_html__('General', $this -> text_domain),
                                'fields' => array(
                                    array(
                                        'id'       => 'section_type',
                                        'type'     => 'select',
                                        'title'    => esc_html__('Section Type', $this -> text_domain),
                                        'options'  => array(
                                            'default'         => esc_html__('Default', $this -> text_domain),
                                            'templaza-footer' => esc_html__('Footer', $this -> text_domain),
                                        ),
                                        'default' => 'default'
                                    ),
									array(
                                        'id'       => 'hideon_single',
                                        'type'     => 'switch',
                                        'title'    => esc_html__('Hide on Single Post', $this -> text_domain),
                                        'subtitle' => esc_html__('Enable to hide this section on Single Post', $this -> text_domain),
                                        'default'  => false,
                                    ),
                                    array(
                                        'id'       => 'title',
                                        'type'     => 'text',
                                        'title'    => esc_html__('Section Title', $this -> text_domain),
                                    ),
                                    array(
                                        'id'      => 'layout_type',
                                        'type'    => 'select',
                                        'title'   => esc_html__('Section Layout', $this -> text_domain),
                                        'options' => array(
                                            'container'                       => esc_html__('Container', $this -> text_domain),
                                            'container-fluid'                 => esc_html__('Container Fluid', $this -> text_domain),
                                            'container-with-no-gutters'       => esc_html__('Container with No gutters', $this -> text_domain),
                                            'container-fluid-with-no-gutters' => esc_html__('Container Fluid with No gutters', $this -> text_domain),
                                            'no-container'                    => esc_html__('Without Container', $this -> text_domain),
                                            'custom-container'                => esc_html__('Custom (Add Custom class to use customized container)', $this -> text_domain),
                                        ),
                                        'default' => 'container',
                                    ),
                                    array(
                                        'id'    => 'custom_container_class',
                                        'type'  => 'text',
                                        'title' => esc_html__('Layout Custom Class', $this -> text_domain),
                                    ),
                                ),
                            ),
                            // Design settings
                            array(
                                'id'     => 'design-settings',
                                'title'  => esc_html__('Design Settings', $this -> text_domain),
                                'fields' => array(
                                    array(
                                        'id'         => 'background',
                                        'type'       => 'background',
                                        'title'      => esc_html__('Background', $this -> text_domain),
                                    ),
									array(
                                        'id'       => 'background_overlay',
                                        'type'     => 'color_rgba',
                                        'title'    => esc_html__('Background Overlay', $this -> text_domain),
                                    ),
                                    array(
                                        'id'         => 'border',
                                        'type'       => 'border',
                                        'title'      => __('Border', $this -> text_domain),
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
                                    ),
                                    array(
                                        'id'       => 'link_color',
                                        'type'     => 'link_color',
                                        'title'    => esc_html__('Link Color', $this -> text_domain),
                                    ),
                                    array(
                                        'id'     => 'tab-spacing',
                                        'type'   => 'section',
                                        'indent' => true,
                                        'title'  => esc_html__('Spacing', $this -> text_domain),
                                    ),
                                    array(
                                        'id'     => 'margin',
                                        'type'   => 'spacing',
                                        'mode'   => 'margin',
                                        'all'    => false,
                                        'allow_responsive'  => true,
                                        'units'  => array( 'em', 'px', '%' ),      // You can specify a unit value. Possible: px, em, %
                                        'title'  => esc_html__('Margin', $this -> text_domain),
                                    ),
                                    array(
                                        'id'     => 'padding',
                                        'type'   => 'spacing',
                                        'mode'   => 'padding',
                                        'all'    => false,
                                        'allow_responsive'  => true,
                                        'units'  => array( 'em', 'px', '%' ),      // You can specify a unit value. Possible: px, em, %
                                        'title'  => esc_html__('Padding', $this -> text_domain),
                                    ),
                                    array(
                                        'id'     => 'tab-spacing-end',
                                        'type'   => 'section',
                                        'indent' => false, // Indent all options below until the next 'section' option is set.
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


        public function prepare_params($params, $element,$parent_el){
            $params = parent::prepare_params($params, $element,$parent_el);

            if(!isset($params['tz_class'])){
                $params['tz_class'] = '';
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

        public function enqueue() {
            if (!wp_script_is('templaza-shortcode-section-js')) {
                wp_enqueue_script(
                    'templaza-shortcode-section-js',
                    Functions::get_my_url() . '/shortcodes/section/section.js',
                    array( 'jquery', 'jquery-ui-tabs', 'wp-util', 'redux-js', TEMPLAZA_FRAMEWORK_NAME.'__js'),
                    time(),
                    'all'
                );
            }
        }
    }

}

?>