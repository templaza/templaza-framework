<?php

defined('TEMPLAZA_FRAMEWORK') or exit();

// -> START Typography
Templaza_API::set_section('settings',
    array(
        'title'  => __( 'Layout', 'templaza-framework' ),
        'id'     => 'section-layouts',
        'desc'   => __( 'These settings control the layout', 'templaza-framework' ),
        'icon'   => 'el el-website',
        'fields'     => array(
//            array(
//                'id' => 'test-editor',
//                'type' => 'editor',
//                'title' => 'Test Editor',
//            ),
            array(
                'id'       => 'layout',
                'type'     => 'tz_layout',
                'class'    => 'field-tz_layout-content',
    //            'elements' => array(
    //                array(
    //                    'id'          => 'section',
    //                    'type'        => 'tz_element',
    //                    'title'       => __('Section'),
    //                    'desc'        => __('Place content elements inside the row'),
    //                    'admin_label' => true,
    //                    'fields'      => array(
    //                        // General settings tab
    //                        array(
    //                            'id'     => 'tab-settings',
    //                            'type'   => 'tab',
    //                            'indent' => true,
    //                            'title'  => esc_html__('General Settings', 'templaza-framework'),
    //                        ),
    //                        array(
    //                            'id'    => 'title',
    //                            'type'  => 'text',
    //                            'title' => esc_html__('Section Title', 'templaza-framework'),
    //                        ),
    //                        array(
    //                            'id'    => 'customclass',
    //                            'type'  => 'text',
    //                            'title' => esc_html__('Custom Class', 'templaza-framework'),
    //                            'desc'  => esc_html__('Custom Class can be used for writing custom CSS or JS.', 'templaza-framework'),
    //                        ),
    //                        array(
    //                            'id'    => 'customid',
    //                            'title' => esc_html__('Custom ID', 'templaza-framework'),
    //                            'desc'  => esc_html__('Custom ID can be used for overriding the auto-generated id.', 'templaza-framework'),
    //                        ),
    //                        array(
    //                            'id'      => 'layout_type',
    //                            'type'    => 'select',
    //                            'title'   => esc_html__('Section Layout', 'templaza-framework'),
    //                            'options' => array(
    //                                'container'                       => esc_html__('Container', 'templaza-framework'),
    //                                'container-fluid'                 => esc_html__('Container Fluid', 'templaza-framework'),
    //                                'container-with-no-gutters'       => esc_html__('Container with No gutters', 'templaza-framework'),
    //                                'container-fluid-with-no-gutters' => esc_html__('Container Fluid with No gutters', 'templaza-framework'),
    //                                'no-container'                    => esc_html__('Without Container', 'templaza-framework'),
    //                                'custom-container'                => esc_html__('Custom (Add Custom class to use customized container)', 'templaza-framework'),
    //                            ),
    //                        ),
    //                        array(
    //                            'id'    => 'custom_container_class',
    //                            'type'  => 'text',
    //                            'title' => esc_html__('Layout Custom Class', 'templaza-framework'),
    //                        ),
    //                        // Design Settings tab
    //                        array(
    //                            'id'     => 'tab-design-settings',
    //                            'type'   => 'tab',
    //                            'indent' => true,
    //                            'title'  => esc_html__('Design Settings', 'templaza-framework'),
    //                        ),
    //                        array(
    //                            'id'    => 'background',
    //                            'type'  => 'background',
    //                            'title' => esc_html__('Background'),
    //                        ),
    //                        array(
    //                            'id'     => 'tab-section-spacing',
    //                            'type'   => 'section',
    //                            'indent' => true,
    //                            'title'  => esc_html__('Spacing', 'templaza-framework'),
    //                        ),
    //                        array(
    //                            'id'     => 'margin',
    //                            'type'   => 'dimensions',
    //                            'title'  => esc_html__('Margin', 'templaza-framework'),
    //                        ),
    //                        array(
    //                            'id'     => 'padding',
    //                            'type'   => 'dimensions',
    //                            'title'  => esc_html__('Margin', 'templaza-framework'),
    //                        ),
    //                        array(
    //                            'id'     => 'tab-section-spacing-end',
    //                            'type'   => 'section',
    //                            'indent' => false, // Indent all options below until the next 'section' option is set.
    //                        ),
    //                        // Responsive Settings tab
    //                        array(
    //                            'id'     => 'tab-responsive-settings',
    //                            'type'   => 'tab',
    //                            'indent' => true,
    //                            'title'  => esc_html__('Responsive Settings', 'templaza-framework'),
    //                        ),
    //                        array(
    //                            'id'     => 'tab-section-device-visibility',
    //                            'type'   => 'section',
    //                            'indent' => true,
    //                        ),
    //                        array(
    //                            'id'     => 'tab-section-device-visibility',
    //                            'type'   => 'section',
    //                            'indent' => true,
    //                            'title'  => esc_html__('Device Visibility', 'templaza-framework'),
    //                        ),
    //                        array(
    //                            'id'     => 'hideonxs',
    //                            'type'   => 'radio',
    //                            'title'  => esc_html__('Hide on Extra-Small Devices', 'templaza-framework'),
    //                            'desc'   => esc_html__('Enable to hide this section on medium Devices', 'templaza-framework'),
    //                        ),
    //                        array(
    //                            'id'     => 'hideonsm',
    //                            'type'   => 'radio',
    //                            'title'  => esc_html__('Hide on Small Devices', 'templaza-framework'),
    //                            'desc'   => esc_html__('Enable to hide this section on Small Devices.', 'templaza-framework'),
    //                        ),
    //                        array(
    //                            'id'     => 'hideonmd',
    //                            'type'   => 'radio',
    //                            'title'  => esc_html__('Hide on Medium Devices', 'templaza-framework'),
    //                            'desc'   => esc_html__('Enable to hide this section on medium Devices.', 'templaza-framework'),
    //                        ),
    //                        array(
    //                            'id'     => 'hideonlg',
    //                            'type'   => 'radio',
    //                            'title'  => esc_html__('Hide on Large Devices', 'templaza-framework'),
    //                            'desc'   => esc_html__('Enable to hide this section on Large Devices.', 'templaza-framework'),
    //                        ),
    //                        array(
    //                            'id'     => 'hideonxl',
    //                            'type'   => 'radio',
    //                            'title'  => esc_html__('Hide on Extra-Large Devices', 'templaza-framework'),
    //                            'desc'   => esc_html__('Enable to hide this section on Extra-Large Devices.', 'templaza-framework'),
    //                        ),
    //                        array(
    //                            'id'     => 'tab-section-device-visibility-end',
    //                            'type'   => 'section',
    //                            'indent' => false, // Indent all options below until the next 'section' option is set.
    //                        ),
    //                        array(
    //                            'id'     => 'tab-end',
    //                            'type'   => 'tab',
    //                            'indent' => false, // Indent all options below until the next 'tab' option is set.
    //                        ),
    //                    )
    //                ),
    //                array(
    //                    'id'          => 'row',
    //                    'type'        => 'tz_element',
    //                    'title'       => __('Row'),
    //                    'desc'        => __('Place content elements inside the row'),
    //                    'admin_label' => true,
    //                    'fields'      => array(
    //                        array(
    //                            'id'    => 'customclass',
    //                            'type'  => 'text',
    //                            'title' => esc_html__('Custom Class', 'templaza-framework'),
    //                            'desc' => esc_html__('Custom Class can be used for writing custom CSS or JS.', 'templaza-framework'),
    //                        ),
    //                        array(
    //                            'id'    => 'customid',
    //                            'type'  => 'text',
    //                            'title' => esc_html__('Custom ID', 'templaza-framework'),
    //                            'desc' => esc_html__('Custom ID can be used for overriding the auto-generated id.', 'templaza-framework'),
    //                        ),
    //                    )
    //                )
    //            )
            ),


    //        array(
    //            'id' => 'tabs-2',
    //            'type'  => 'tz_tab',
    //            'tabs' => array(
    //                // General settings
    //                array(
    //                    'id' => 'settings-2',
    //                    'title'  => esc_html__('General Settings', 'templaza-framework'),
    //                    'fields' => array(
    //                        array(
    //                            'id'       => 'test_title',
    //                            'type'     => 'text',
    //                            'default'  => '21321',
    //                            'title'    => esc_html__('Section Title', 'templaza-framework'),
    //                        ),
    //                    ),
    //                ),
    //            ),
    //        ),



        ),
    )
);
