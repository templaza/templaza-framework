<?php

defined('TEMPLAZA_FRAMEWORK') or exit;

use TemPlazaFramework\Functions;

if(!class_exists('ReduxFramework_Extension_TZ_Layout')) {

    class ReduxFramework_Extension_TZ_Layout
    {

        public static $theInstance;
        public $is_field = false;
        protected $text_domain;

        public function __construct( $parent ) {

            $this->parent = $parent;
            $my_class   = strtolower(__CLASS__);
            $this -> field_name = str_replace('reduxframework_extension_','', $my_class);

            $this -> text_domain    = Functions::get_my_text_domain();

            self::$theInstance = $this;

            if ( ! $this->is_field && $this->parent->args['show_layout'] ) {
                $this->add_section();
            }

//            require_once __DIR__.'/inc/helper.php';
//            add_filter( 'redux/' . $this->parent->args['opt_name'] . '/field/class/' . $this->field_name, array(
//                &$this,
//                'overload_field_path'
//            ) ); // Adds the local field
        }

//        // Forces the use of the embeded field path vs what the core typically would use
//        public function overload_field_path( $field ) {
//            return dirname( __FILE__ ) . '/' . $this->field_name . '/field_' . $this->field_name . '.php';
////            return dirname( __FILE__ ) . '/' . $this->field_name . '/field_' . $this->field_name . '.php';
//        }

        public function add_section() {
            $this->parent->sections[] = array(
                'title'  => __( 'Layout', $this -> text_domain ),
                'id'     => 'section-layouts',
                'desc'   => __( 'These settings control the layout', $this -> text_domain ),
                'icon'   => 'el el-website',
                'fields'     => array(
                    array(
                        'id'       => 'layout',
                        'type'     => 'tz_layout',
                        'class'    => 'field-tz_layout-content',
                        'fields'   => array(
                            array(
                                'id'          => 'section',
                                'type'        => 'tz_element',
                                'title'       => __('Section'),
                                'desc'        => __('Place content elements inside the row'),
                                'admin_label' => true,
                                'fields'      => array(
                                    // General settings tab
                                    array(
                                        'id'     => 'tab-settings',
                                        'type'   => 'tab',
                                        'indent' => true,
                                        'title'  => esc_html__('General Settings', $this -> text_domain),
                                    ),
                                    array(
                                        'id'    => 'title',
                                        'type'  => 'text',
                                        'title' => esc_html__('Section Title', $this -> text_domain),
                                    ),
                                    array(
                                        'id'    => 'customclass',
                                        'type'  => 'text',
                                        'title' => esc_html__('Custom Class', $this -> text_domain),
                                        'desc'  => esc_html__('Custom Class can be used for writing custom CSS or JS.', $this -> text_domain),
                                    ),
                                    array(
                                        'id'    => 'customid',
                                        'title' => esc_html__('Custom ID', $this -> text_domain),
                                        'desc'  => esc_html__('Custom ID can be used for overriding the auto-generated id.', $this -> text_domain),
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
                                    ),
                                    array(
                                        'id'    => 'custom_container_class',
                                        'type'  => 'text',
                                        'title' => esc_html__('Layout Custom Class', $this -> text_domain),
                                    ),
                                    // Design Settings tab
                                    array(
                                        'id'     => 'tab-design-settings',
                                        'type'   => 'tab',
                                        'indent' => true,
                                        'title'  => esc_html__('Design Settings', $this -> text_domain),
                                    ),
                                    array(
                                        'id'    => 'background',
                                        'type'  => 'background',
                                        'title' => esc_html__('Background'),
                                    ),
                                    array(
                                        'id'     => 'tab-section-spacing',
                                        'type'   => 'section',
                                        'indent' => true,
                                        'title'  => esc_html__('Spacing', $this -> text_domain),
                                    ),
                                    array(
                                        'id'     => 'margin',
                                        'type'   => 'dimensions',
                                        'title'  => esc_html__('Margin', $this -> text_domain),
                                    ),
                                    array(
                                        'id'     => 'padding',
                                        'type'   => 'dimensions',
                                        'title'  => esc_html__('Margin', $this -> text_domain),
                                    ),
                                    array(
                                        'id'     => 'tab-section-spacing-end',
                                        'type'   => 'section',
                                        'indent' => false, // Indent all options below until the next 'section' option is set.
                                    ),
                                    // Responsive Settings tab
                                    array(
                                        'id'     => 'tab-responsive-settings',
                                        'type'   => 'tab',
                                        'indent' => true,
                                        'title'  => esc_html__('Responsive Settings', $this -> text_domain),
                                    ),
                                    array(
                                        'id'     => 'tab-section-device-visibility',
                                        'type'   => 'section',
                                        'indent' => true,
                                    ),
                                    array(
                                        'id'     => 'tab-section-device-visibility',
                                        'type'   => 'section',
                                        'indent' => true,
                                        'title'  => esc_html__('Device Visibility', $this -> text_domain),
                                    ),
                                    array(
                                        'id'     => 'hideonxs',
                                        'type'   => 'radio',
                                        'title'  => esc_html__('Hide on Extra-Small Devices', $this -> text_domain),
                                        'desc'   => esc_html__('Enable to hide this section on medium Devices', $this -> text_domain),
                                    ),
                                    array(
                                        'id'     => 'hideonsm',
                                        'type'   => 'radio',
                                        'title'  => esc_html__('Hide on Small Devices', $this -> text_domain),
                                        'desc'   => esc_html__('Enable to hide this section on Small Devices.', $this -> text_domain),
                                    ),
                                    array(
                                        'id'     => 'hideonmd',
                                        'type'   => 'radio',
                                        'title'  => esc_html__('Hide on Medium Devices', $this -> text_domain),
                                        'desc'   => esc_html__('Enable to hide this section on medium Devices.', $this -> text_domain),
                                    ),
                                    array(
                                        'id'     => 'hideonlg',
                                        'type'   => 'radio',
                                        'title'  => esc_html__('Hide on Large Devices', $this -> text_domain),
                                        'desc'   => esc_html__('Enable to hide this section on Large Devices.', $this -> text_domain),
                                    ),
                                    array(
                                        'id'     => 'hideonxl',
                                        'type'   => 'radio',
                                        'title'  => esc_html__('Hide on Extra-Large Devices', $this -> text_domain),
                                        'desc'   => esc_html__('Enable to hide this section on Extra-Large Devices.', $this -> text_domain),
                                    ),
                                    array(
                                        'id'     => 'tab-section-device-visibility-end',
                                        'type'   => 'section',
                                        'indent' => false, // Indent all options below until the next 'section' option is set.
                                    ),
                                    array(
                                        'id'     => 'tab-end',
                                        'type'   => 'tab',
                                        'indent' => false, // Indent all options below until the next 'tab' option is set.
                                    ),
                                )
                            ),
                            array(
                                'id'          => 'row',
                                'type'        => 'tz_element',
                                'title'       => __('Row'),
                                'desc'        => __('Place content elements inside the row'),
                                'admin_label' => true,
                                'fields'      => array(
                                    array(
                                        'id'    => 'customclass',
                                        'type'  => 'text',
                                        'title' => esc_html__('Custom Class', $this -> text_domain),
                                        'desc' => esc_html__('Custom Class can be used for writing custom CSS or JS.', $this -> text_domain),
                                    ),
                                    array(
                                        'id'    => 'customid',
                                        'type'  => 'text',
                                        'title' => esc_html__('Custom ID', $this -> text_domain),
                                        'desc' => esc_html__('Custom ID can be used for overriding the auto-generated id.', $this -> text_domain),
                                    ),
                                )
                            )
                        )
                    ),
                ),
            );
        }

    }
}