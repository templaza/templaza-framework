<?php

defined('TEMPLAZA_FRAMEWORK') or exit();

use TemPlazaFramework\Functions;

if(!class_exists('TemplazaFramework_ShortCode_Section')){
    class TemplazaFramework_ShortCode_Section extends TemplazaFramework_ShortCode{

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
//                                        'color_rgba' => true,
                                        'title'      => esc_html__('Background'),
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
                                        'units'  => array( 'em', 'px', '%' ),      // You can specify a unit value. Possible: px, em, %
                                        'title'  => esc_html__('Margin', $this -> text_domain),
                                    ),
                                    array(
                                        'id'     => 'padding',
                                        'type'   => 'spacing',
                                        'mode'   => 'padding',
                                        'all'    => false,
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
            $id = '';
            if(isset($element['id'])){
                $id = $element['id'];
            }
            if(isset($params['tz_customid'])) {
                $custom_id = trim($params['tz_customid']);
            }
            $params = parent::prepare_params($params, $element);

            if(isset($id) && isset($params['title']) && !empty($params['title'])){
                $params['tz_id']  = sanitize_title($params['title']).'-'.$id;
            }else{
                $params['tz_id']  = 'templaza-section-'.$id;
            }
            if(isset($custom_id) && !empty($custom_id)){
                $params['tz_id']  = $custom_id;
            }

            // Custom class
            if((isset($params['hideonxs']) && $params['hideonxs']) ||
                (isset($params['hideonsm']) && $params['hideonsm'])){
                if(!isset($params['customclass'])) {
                    $params['tz_class'] = '';
                }
                if(isset($params['hideonxs']) && $params['hideonxs']){
                    $params['tz_class']  .= 'd-none d-sm-block '.$params['customclass'];
                    unset($params['hideonxs']);
                }
                if(isset($params['hideonsm']) && $params['hideonsm']){
                    $params['tz_class']  .= 'd-sm-none d-md-block '.$params['customclass'];
                    unset($params['hideonsm']);
                }
            }

            switch ($params['layout_type']) {
                case '':
                case 'container-with-no-gutters':
                    $params['layout_type'] = 'container';
                    break;
                case 'no-container':
                    $params['layout_type'] = '';
                    break;
                case 'container-fluid-with-no-gutters':
                    $params['layout_type'] = 'container-fluid';
                    break;
            }

            return $params;
        }

        public function enqueue() {
            if (!wp_script_is('templaza-shortcode-section-js')) {
                wp_enqueue_script(
                    'templaza-shortcode-section-js',
                    \TemPlazaFramework\Functions::get_my_url() . '/shortcodes/section/section.js',
                    array( 'jquery', 'jquery-ui-tabs', 'wp-util', 'redux-js', TEMPLAZA_FRAMEWORK_NAME.'__js'),
                    time(),
                    'all'
                );
            }
        }
    }

}

?>