<?php

defined('TEMPLAZA_FRAMEWORK') or exit();

use TemPlazaFramework\Functions;

// General
Templaza_API::set_section('settings',
    array(
        'id'         => 'generals',
        'title'     => esc_html__('General',$this -> text_domain),
        'desc'      => esc_html__('General theme options',$this -> text_domain),
        'icon'      => 'el-icon-cog',
        'fields'    => array(
//            array(
//                'id'               => 'editor-text',
//                'type'             => 'editor',
//                'title'            => __('Editor Text', 'redux-framework-demo'),
//                'subtitle'         => __('Subtitle text would go here.', 'redux-framework-demo'),
//                'default'          => 'Powered by Redux.',
//                'args'   => array(
//                    'teeny'            => true,
//                    'textarea_rows'    => 10
//                )
//            ),
        ),
    )
);

// -> START Favicon
Templaza_API::set_section('settings',
    array(
        'title'   => __('Favicon', $this -> text_domain),
        'id'      => 'section-favicons',
        //    'desc'       => __( 'Enable or disable the footer copyright bar.', $this -> text_domain ),
        'subsection' => true,
        'fields'     => array(
            array(
                'id'       => 'favicon',
                'type'     => 'media',
                'title'    => __( 'Favicon', $this -> text_domain ),
                'subtitle' => __( 'Upload your browser URL icon. It\'s recommended to apply a size of 96x96 pixels to the favicon.png.', $this -> text_domain ),
            ),
        )
    )
);

// -> START Preloader
Templaza_API::set_section('settings',
    array(
        'id'         => 'preloaders',
        'title'     => esc_html__('Preloader',$this -> text_domain),
        'subsection' => true,
        'fields'     => array(
            array(
                'id'       => 'preloader',
                'type'     => 'switch',
                'title'    => __( 'Preloader', $this -> text_domain ),
                'subtitle' => __( 'Enable or disable the preloader.', $this -> text_domain ),
                'default'  => true,
            ),
            array(
                'id'       => 'preloader-setting',
                'type'     => 'button_set',
                'title'    => __( 'Type', $this -> text_domain ),
                'subtitle' => __( 'Select a preloader type.', $this -> text_domain ),
                'options'  => array(
                    'animations'  => __('Animation', $this -> text_domain),
                    'image'       => __('Image', $this -> text_domain),
                    'fontawesome' => __('Font Awesome', $this -> text_domain),
                ),
                'default'  => 'animations',
                'required' => array('preloader','=',true),
            ),
            array(
                'id'           => 'preloader-animation', /* Need create custom field */
                'type'         => 'tz_preloader',
                'title'        => __( 'Preloader animation', $this -> text_domain ),
                'subtitle'     => __( 'Select a preloader animation.', $this -> text_domain ),
                'dialog_title' => __( 'Select Preloader Style', $this -> text_domain ),
                'required'     => array('preloader-setting','=','animations'),
                'default'      => 'circle',
            ),
            array(
                'id'       => 'preloader-fontawesome', /* Need create custom field */
                'type'     => 'select',
                'data'     => 'fontawesome',
                'title'    => __( 'Preloader animation', $this -> text_domain ),
                'subtitle' => __( 'Select a preloader animation.', $this -> text_domain ),
                'default'  => 'spiner',
                'required' => array('preloader-setting','=','fontawesome'),
            ),
            array(
                'id'       => 'preloader-image', /* Need create custom field */
                'type'     => 'background',
                'title'    => __( 'Preloader Image', $this -> text_domain ),
                'subtitle' => __( 'Select a preloader image.', $this -> text_domain ),
                'required' => array('preloader-setting','=','image'),
                'background-color' => false,
            ),
            array(
                'id'       => 'preloader-color',
                'type'     => 'color_rgba',
                'title'    => __( 'Preloader color', $this -> text_domain ),
                'subtitle' => __( 'Select a color for the preloader.', $this -> text_domain ),
                'required' => array('preloader-setting','=',array('animations', 'fontawesome')),
    //            'required' => array('preloader','=','1'),
            ),
            array(
                'id'       => 'preloader-bgcolor',
                'type'     => 'color_rgba',
                'title'    => __( 'Preloader background color', $this -> text_domain ),
                'subtitle' => __( 'Select a background color for the preloader.', $this -> text_domain ),
                'required' => array('preloader','=','1'),
            ),
            array(
                'id'       => 'preloader-size',
                'type'     => 'slider',
                'title'    => __( 'Preloader size', $this -> text_domain ),
                'subtitle' => __( 'Set size for the preloader, set a value by moving an indicator in a horizontal fashion.', $this -> text_domain ),
                'desc'     => __( 'Preloader size by: px', $this -> text_domain ),
                'min'      => '0',
                'max'      => '500',
                'step'     => '1',
                'default'  => '40',
                'required' => array(
                    array('preloader','=','1'),
                    array('preloader-setting','=', array('animations', 'fontawesome')),
    //                array('preloader-setting','=','fontawesome'),
                ),
    //            'required' => array('preloader','=','1'),
            ),
        )
    )
);

// -> START Back to Top
Templaza_API::set_section('settings',
    array(
        'id'         => 'backtotops',
        'title'     => esc_html__('Back to Top',$this -> text_domain),
        'subsection' => true,
        'fields'     => array(
            array(
                'id'       => 'backtotop',
                'type'     => 'switch',
                'title'    => __( 'Back to Top', $this -> text_domain ),
                'subtitle' => __( 'Enable or disable the back to top button.', $this -> text_domain ),
                'default'  => true,
            ),
            array(
                'id'       => 'backtotop-icon',
                'type'     => 'select',
                'title'    => __( 'Icon', $this -> text_domain ),
                'subtitle' => __( 'Select a Back to Top Icon from the list', $this -> text_domain ),
                'data'     => 'fontawesome-arrows',
                'default'  => 'fas fa-arrow-up',
                'select2'  => array('allowClear' => false),
                'required' => array('backtotop','=','1'),
            ),
            array(
                'id'       => 'backtotop-icon-size',
                'type'     => 'slider',
                'title'    => __( 'Icon size', $this -> text_domain ),
                'subtitle' => __( 'Set size for the Back to Top Icon, set a value by moving an indicator in a horizontal fashion.', $this -> text_domain ),
                'desc' => __( 'Icon size by: px', $this -> text_domain ),
                'min'      => 10,
                'max'      => 200,
                'step'     => 1,
                'default'  => 20,
                'required' => array('backtotop','=','1'),
            ),
            array(
                'id'       => 'backtotop-icon-color',
                'type'     => 'color_rgba',
                'title'    => __( 'Icon color', $this -> text_domain ),
                'subtitle' => __( 'Set size for the Back to Top Icon, set a value by moving an indicator in a horizontal fashion.', $this -> text_domain ),
                'required' => array('backtotop','=','1'),
                'default'  => array(
                    'color' => '#000'
                ),
            ),
            array(
                'id'       => 'backtotop-icon-bgcolor',
                'type'     => 'color_rgba',
                'title'    => __( 'Icon background color', $this -> text_domain ),
                'subtitle' => __( 'Select a background color for the Back to Top Icon.', $this -> text_domain ),
                'required' => array('backtotop','=','1'),
            ),
            array(
                'id'       => 'backtotop-icon-shape', /* Need create custom field */
                'type'     => 'select',
                'title'    => __( 'Icon shape', $this -> text_domain ),
                'subtitle' => __( 'Select a Back to Top icon shape.', $this -> text_domain ),
                'options'  => array(
                    'circle'  => __('Circle', $this -> text_domain),
                    'rounded' => __('Rounded', $this -> text_domain),
                    'square'  => __('Square', $this -> text_domain),
                ),
                'default'  => 'circle',
                'select2'  => array('allowClear' => false),
                'required' => array('backtotop','=','1'),
            ),
            array(
                'id'       => 'backtotop-on-mobile',
                'type'     => 'switch',
                'title'    => __( 'Back To Top Button On Mobile', $this -> text_domain ),
                'subtitle' => __( 'Enable or disable the button to show or hide Back to top button on mobile view.', $this -> text_domain ),
                'default'  => true,
                'required' => array('backtotop','=','1'),
            ),
        )
    )
);

// -> START Layout Settings
Templaza_API::set_section('settings',
    array(
        'id'         => 'layout-settings',
        'title'     => esc_html__('Layout Settings',$this -> text_domain),
        'subsection' => true,
        'fields'     => array(
            array(
                'id'       => 'layout-theme',
                'type'     => 'button_set',
                'title'    => __( 'Site Layout', $this -> text_domain ),
                'subtitle' => __( 'Select the site layout.', $this -> text_domain ),
                'options'  => array(
                    'wide'       => __('Wide', $this -> text_domain),
                    'boxed'      => __('Boxed', $this -> text_domain),
                ),
                'default' => 'wide',
            ),
            array(
                'id'       => 'layout-background',
                'type'     => 'background',
                'title'    => __( 'Background', $this -> text_domain ),
                'required' => array('layout-theme', '=', 'boxed'),
            ),
        )
    )
);

// -> START Smooth Scroll
Templaza_API::set_section('settings',
    array(
        'id'         => 'smooth-scrolls',
        'title'     => esc_html__('Smooth Scroll',$this -> text_domain),
        'subsection' => true,
        'fields'     => array(
            array(
                'id'       => 'enable-smooth-scroll',
                'type'     => 'switch',
                'title'    => __( 'Enable Smooth Scroll', $this -> text_domain ),
                'subtitle' => __( 'Enabling will option load the necessary JS for smooth scroll.', $this -> text_domain ),
                'default'  => '1',
            ),
            array(
                'id'       => 'smooth-scroll-speed',
                'type'     => 'slider',
                'title'    => __( 'Scroll Speed', $this -> text_domain ),
                'subtitle' => __( 'This a number representing the amount of time in milliseconds that it should take to scroll 1000px. Scroll distances shorter than that will take less time, and scroll distances longer than that will take more time. The default is 300ms.', $this -> text_domain ),
                'min'      => 1,
                'max'      => 10000,
                'step'     => 1,
                'default'  => '300',
                'required' => array('enable-smooth-scroll', '=', '1'),
            ),
        )
    )
);