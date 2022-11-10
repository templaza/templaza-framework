<?php

defined('TEMPLAZA_FRAMEWORK') or exit();

use TemPlazaFramework\Functions;

// General
Templaza_API::set_section('settings',
    array(
        'id'         => 'generals',
        'title'     => esc_html__('General','templaza-framework'),
        'desc'      => esc_html__('General theme options','templaza-framework'),
        'icon'      => 'el-icon-cog',
        'fields'    => array(
        ),
    )
);

// -> START Favicon
Templaza_API::set_section('settings',
    array(
        'title'   => __('Favicon', 'templaza-framework'),
        'id'      => 'section-favicons',
        //    'desc'       => __( 'Enable or disable the footer copyright bar.', 'templaza-framework' ),
        'subsection' => true,
        'fields'     => array(
            array(
                'id'       => 'favicon',
                'type'     => 'media',
                'title'    => __( 'Favicon', 'templaza-framework' ),
                'subtitle' => __( 'Upload your browser URL icon. It\'s recommended to apply a size of 96x96 pixels to the favicon.png.', 'templaza-framework' ),
            ),
        )
    )
);

// -> START Preloader
Templaza_API::set_section('settings',
    array(
        'id'         => 'preloaders',
        'title'     => esc_html__('Preloader','templaza-framework'),
        'subsection' => true,
        'fields'     => array(
            array(
                'id'       => 'preloader',
                'type'     => 'switch',
                'title'    => __( 'Preloader', 'templaza-framework' ),
                'subtitle' => __( 'Enable or disable the preloader.', 'templaza-framework' ),
                'default'  => true,
            ),
            array(
                'id'       => 'preloader-setting',
                'type'     => 'button_set',
                'title'    => __( 'Type', 'templaza-framework' ),
                'subtitle' => __( 'Select a preloader type.', 'templaza-framework' ),
                'options'  => array(
                    'animations'  => __('Animation', 'templaza-framework'),
                    'image'       => __('Image', 'templaza-framework'),
                    'fontawesome' => __('Font Awesome', 'templaza-framework'),
                ),
                'default'  => 'animations',
                'required' => array('preloader','=',true),
            ),
            array(
                'id'           => 'preloader-animation', /* Need create custom field */
                'type'         => 'tz_preloader',
                'title'        => __( 'Preloader animation', 'templaza-framework' ),
                'subtitle'     => __( 'Select a preloader animation.', 'templaza-framework' ),
                'dialog_title' => __( 'Select Preloader Style', 'templaza-framework' ),
                'required'     => array('preloader-setting','=','animations'),
                'default'      => 'circle',
            ),
            array(
                'id'       => 'preloader-fontawesome', /* Need create custom field */
                'type'     => 'select',
                'data'     => 'fontawesome',
                'title'    => __( 'Preloader animation', 'templaza-framework' ),
                'subtitle' => __( 'Select a preloader animation.', 'templaza-framework' ),
                'default'  => 'spiner',
                'required' => array('preloader-setting','=','fontawesome'),
            ),
            array(
                'id'       => 'preloader-image', /* Need create custom field */
                'type'     => 'background',
                'title'    => __( 'Preloader Image', 'templaza-framework' ),
                'subtitle' => __( 'Select a preloader image.', 'templaza-framework' ),
                'required' => array('preloader-setting','=','image'),
                'background-color' => false,
            ),
            array(
                'id'       => 'preloader-color',
                'type'     => 'color_rgba',
                'title'    => __( 'Preloader color', 'templaza-framework' ),
                'subtitle' => __( 'Select a color for the preloader.', 'templaza-framework' ),
                'required' => array('preloader-setting','=',array('animations', 'fontawesome')),
            ),
            array(
                'id'       => 'preloader-color-2',
                'type'     => 'color_rgba',
                'title'    => __( 'Preloader color 2', 'templaza-framework' ),
                'subtitle' => __( 'Select a color for the preloader.', 'templaza-framework' ),
                'required' => array(
                    array('preloader-setting','=',array('animations', 'fontawesome')),
                    array('preloader-animation','=', array('triple-spinner', 'cm-spinner', 'hm-spinner','reverse-spinner'))
                ),
            ),
            array(
                'id'       => 'preloader-color-3',
                'type'     => 'color_rgba',
                'title'    => __( 'Preloader color 3', 'templaza-framework' ),
                'subtitle' => __( 'Select a color for the preloader.', 'templaza-framework' ),
                'required' => array(
                    array('preloader-setting','=',array('animations', 'fontawesome')),
                    array('preloader-animation','=', array('triple-spinner', 'cm-spinner', 'hm-spinner'))
                ),
            ),
            array(
                'id'       => 'preloader-bgcolor',
                'type'     => 'color_rgba',
                'title'    => __( 'Preloader background color', 'templaza-framework' ),
                'subtitle' => __( 'Select a background color for the preloader.', 'templaza-framework' ),
                'required' => array('preloader','=','1'),
            ),
            array(
                'id'       => 'preloader-size',
                'type'     => 'slider',
                'title'    => __( 'Preloader size', 'templaza-framework' ),
                'subtitle' => __( 'Set size for the preloader, set a value by moving an indicator in a horizontal fashion.', 'templaza-framework' ),
                'desc'     => __( 'Preloader size by: px', 'templaza-framework' ),
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
        'title'     => esc_html__('Back to Top','templaza-framework'),
        'subsection' => true,
        'fields'     => array(
            array(
                'id'       => 'backtotop',
                'type'     => 'switch',
                'title'    => __( 'Back to Top', 'templaza-framework' ),
                'subtitle' => __( 'Enable or disable the back to top button.', 'templaza-framework' ),
                'default'  => true,
            ),
            array(
                'id'       => 'backtotop-icon',
                'type'     => 'select',
                'title'    => __( 'Icon', 'templaza-framework' ),
                'subtitle' => __( 'Select a Back to Top Icon from the list', 'templaza-framework' ),
                'data'     => 'fontawesome-arrows',
                'default'  => 'fas fa-arrow-up',
                'select2'  => array('allowClear' => false),
                'required' => array('backtotop','=','1'),
            ),
            array(
                'id'       => 'backtotop-icon-size',
                'type'     => 'slider',
                'title'    => __( 'Icon size', 'templaza-framework' ),
                'subtitle' => __( 'Set size for the Back to Top Icon, set a value by moving an indicator in a horizontal fashion.', 'templaza-framework' ),
                'desc' => __( 'Icon size by: px', 'templaza-framework' ),
                'min'      => 10,
                'max'      => 200,
                'step'     => 1,
                'default'  => 20,
                'required' => array('backtotop','=','1'),
            ),
            array(
                'id'       => 'backtotop-icon-padding',
                'type'   => 'spacing',
                'mode'   => 'padding',
                'all'    => false,
                'allow_responsive'    => true,
                'units'  => array( 'em', 'px', '%' ),      // You can specify a unit value. Possible: px, em, %
                'title'    => __( 'Icon Padding', 'templaza-framework' ),
                'subtitle' => __( 'Set padding for the Back to Top Icon, set a value by moving an indicator in a horizontal fashion.', 'templaza-framework' ),
                'required' => array('backtotop','=','1'),
                'default' => array(
                    'units' => 'px',
                ),
            ),
            array(
                'id'       => 'backtotop-icon-border',
                'type'   => 'border',
                'title'    => __( 'Icon border', 'templaza-framework' ),
                'subtitle' => __( 'Set border for the Back to Top Icon, set a value by moving an indicator in a horizontal fashion.', 'templaza-framework' ),
                'required' => array('backtotop','=','1'),
            ),
            array(
                'id'       => 'backtotop-icon-color',
                'type'     => 'color_rgba',
                'title'    => __( 'Icon color', 'templaza-framework' ),
                'subtitle' => __( 'Set size for the Back to Top Icon, set a value by moving an indicator in a horizontal fashion.', 'templaza-framework' ),
                'required' => array('backtotop','=','1'),
                'default'  => array(
                    'color' => '#000'
                ),
            ),
            array(
                'id'       => 'backtotop-icon-bgcolor',
                'type'     => 'color_rgba',
                'title'    => __( 'Icon background color', 'templaza-framework' ),
                'subtitle' => __( 'Select a background color for the Back to Top Icon.', 'templaza-framework' ),
                'required' => array('backtotop','=','1'),
            ),
            array(
                'id'       => 'backtotop-icon-shape', /* Need create custom field */
                'type'     => 'select',
                'title'    => __( 'Icon shape', 'templaza-framework' ),
                'subtitle' => __( 'Select a Back to Top icon shape.', 'templaza-framework' ),
                'options'  => array(
                    'circle'  => __('Circle', 'templaza-framework'),
                    'rounded' => __('Rounded', 'templaza-framework'),
                    'square'  => __('Square', 'templaza-framework'),
                ),
                'default'  => 'circle',
                'select2'  => array('allowClear' => false),
                'required' => array('backtotop','=','1'),
            ),
            array(
                'id'       => 'backtotop-on-mobile',
                'type'     => 'switch',
                'title'    => __( 'Back To Top Button On Mobile', 'templaza-framework' ),
                'subtitle' => __( 'Enable or disable the button to show or hide Back to top button on mobile view.', 'templaza-framework' ),
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
        'title'     => esc_html__('Layout Settings','templaza-framework'),
        'subsection' => true,
        'fields'     => array(
            array(
                'id'       => 'layout-theme',
                'type'     => 'button_set',
                'title'    => __( 'Site Layout', 'templaza-framework' ),
                'subtitle' => __( 'Select the site layout.', 'templaza-framework' ),
                'options'  => array(
                    'wide'       => __('Wide', 'templaza-framework'),
                    'boxed'      => __('Boxed', 'templaza-framework'),
                ),
                'default' => 'wide',
            ),
            array(
                'id'       => 'layout-background',
                'type'     => 'background',
                'title'    => __( 'Background', 'templaza-framework' ),
                'required' => array('layout-theme', '=', 'boxed'),
            ),
        )
    )
);

// -> START Smooth Scroll
Templaza_API::set_section('settings',
    array(
        'id'         => 'smooth-scrolls',
        'title'     => esc_html__('Smooth Scroll','templaza-framework'),
        'subsection' => true,
        'fields'     => array(
            array(
                'id'       => 'enable-smooth-scroll',
                'type'     => 'switch',
                'title'    => __( 'Enable Smooth Scroll', 'templaza-framework' ),
                'subtitle' => __( 'Enabling will option load the necessary JS for smooth scroll.', 'templaza-framework' ),
                'default'  => '1',
            ),
            array(
                'id'       => 'smooth-scroll-speed',
                'type'     => 'slider',
                'title'    => __( 'Scroll Speed', 'templaza-framework' ),
                'subtitle' => __( 'This a number representing the amount of time in milliseconds that it should take to scroll 1000px. Scroll distances shorter than that will take less time, and scroll distances longer than that will take more time. The default is 300ms.', 'templaza-framework' ),
                'min'      => 1,
                'max'      => 10000,
                'step'     => 1,
                'default'  => '300',
                'required' => array('enable-smooth-scroll', '=', '1'),
            ),
        )
    )
);

// -> START Header
Templaza_API::set_section('settings',
    array(
        'id'         => 'headers',
        'title'     => esc_html__('Header','templaza-framework'),
        'subsection' => true,
        'fields'     => array(
            array(
                'id'       => 'enable-header',
                'type'     => 'switch',
                'title'    => __( 'Enable Header', 'templaza-framework' ),
                'subtitle' => __( 'Enable or disable the Header Element.', 'templaza-framework' ),
                'default'  => true,
            ),
        )
    )
);