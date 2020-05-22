<?php

defined('TEMPLAZA_FRAMEWORK') or exit();

use TemPlazaFramework\Functions;

Redux::setSection($opt_name, array(
    'title'  => __( 'Header', $this -> text_domain ),
    'id'     => 'header',
    'desc'   => __( 'Here you can set your preferences for the template header(Logo, Menu and Menu Elements).', $this -> text_domain ),
    'icon'   => 'el el-tasks',
    'fields' => array(
        array(
            'id'       => 'enable-header',
            'type'     => 'switch',
            'title'    => __( 'Enable Header', $this -> text_domain ),
            'subtitle' => __( 'Enable or disable the Header Element.', $this -> text_domain ),
            'default'  => true,
        ),
        array(

        )
    ),
));

// -> START Logo
Redux::setSection($opt_name, array(
    'title'      => __( 'Logo', $this -> text_domain ),
    'id'         => 'logo',
    'desc'       => __( 'You can select a logo for desktop view, mobile view and sticky header.', $this -> text_domain ),
    'subsection' => true,
    'fields' => array(
        array(
            'id'       => 'logo-type',
            'type'     => 'switch',
            'required' => array( 'enable-header', '=', '1' ),
            'title'    => __( 'Logo Type', $this -> text_domain ),
            'subtitle' => __( 'Select logo type.', $this -> text_domain ),
            'default'  => true,
            'on'       => __('Image', $this -> text_domain),
            'off'      => __('Text', $this -> text_domain),
        ),
        array(
            'id'       => 'default-logo',
            'type'     => 'media',
            'url'      => true,
            'title'    => __( 'Default Logo', $this -> text_domain ),
            'compiler' => 'true',
            'desc'     => __( 'Basic media uploader with disabled URL input field.', $this -> text_domain ),
            'subtitle' => __( 'Select an image for your logo.', $this -> text_domain ),
            'required' => array( array('enable-header', '=', '1'),
                array('logo-type', '=', '1') ),
        ),
        array(
            'id'       => 'mobile-logo',
            'type'     => 'media',
            'url'      => true,
            'title'    => __( 'Mobile Logo', $this -> text_domain ),
            'compiler' => 'true',
            'desc'     => __( 'Basic media uploader with disabled URL input field.', $this -> text_domain ),
            'subtitle' => __( 'Select an image for your mobile logo.', $this -> text_domain ),
            'required' => array( array('enable-header', '=', '1'),
                array('logo-type', '=', '1') ),
        ),
        array(
            'id'    => 'logo-text',
            'type'  => 'text',
            'title'    => __('Logo Text', $this -> text_domain),
            'subtitle' => __( 'Enter Logo Text.', $this -> text_domain ),
            'required' => array( array('enable-header', '=', '1'),
                array('logo-type', '!=', '1') ),
        ),
        array(
            'id'    => 'logo-slogan',
            'type'  => 'text',
            'title'    => __('Slogan', $this -> text_domain),
            'subtitle' => __( 'Enter Slogan.', $this -> text_domain ),
            'required' => array( array('enable-header', '=', '1'),
                array('logo-type', '!=', '1') ),
        )
    ),
));

// -> START Sticky Header
Redux::setSection($opt_name, array(
    'title'      => __( 'Sticky', $this -> text_domain ),
    'id'         => 'sticky-header',
    'desc'       => __( 'Here you can select the type of the Sticky Header for desktop view, tablet view and mobile view.', $this -> text_domain ),
    'subsection' => true,
    'fields' => array(
        array(
            'id'       => 'enable-sticky',
            'type'     => 'switch',
            'required' => array( 'enable-header', '=', '1' ),
            'title'    => __( 'Enable Sticky', $this -> text_domain ),
            'subtitle' => __( 'Enable Sticky Header.', $this -> text_domain ),
            'default'  => true,
        ),
        array(
            'id'    => 'sticky-menu-mode',
            'type'  => 'image_select',
            'tiles'    => true,
            'title'    => __('Menu Mode', $this -> text_domain),
            'subtitle' => __( 'Select your horizontal menu mode. Select between left, right or center menu.', $this -> text_domain ),
            'required' => array( array('enable-header', '=', '1'),
                array('enable-sticky', '=', '1') ),
            'default'  => 0,
            'options'  => array(
                'left' => array(
                    'alt'   => __('Left', $this -> text_domain),
                    'title' => __('Left', $this -> text_domain),
                    'class' => 'w-px-150',
                    'img'   => Functions::get_my_frame_url().'/options/patterns/horizontal-left.svg',
                ),
                'center' => array(
                    'alt'   => __('Center', $this -> text_domain),
                    'title' => __('Center', $this -> text_domain),
                    'class' => 'w-px-150',
                    'img'   => Functions::get_my_frame_url().'/options/patterns/horizontal-center.svg',
                ),
                'right' => array(
                    'alt'   => __('Right', $this -> text_domain),
                    'title' => __('Right', $this -> text_domain),
                    'class' => 'w-px-150',
                    'img'   => Functions::get_my_frame_url().'/options/patterns/horizontal-right.svg',
                ),
            ),
        ),
        array(
            'id'       => 'sticky-logo',
            'type'     => 'media',
            'url'      => true,
            'title'    => __( 'Sticky Logo', $this -> text_domain ),
            'compiler' => 'true',
            'desc'     => __( 'Basic media uploader with disabled URL input field.', $this -> text_domain ),
            'subtitle' => __( 'Select an image for your sticky header logo.', $this -> text_domain ),
            'required' => array( array('enable-header', '=', '1'),
                array('enable-sticky', '=', '1') ),
        ),
        array(
            'id'       => 'sticky-desktop',
            'type'     => 'select',
            'title'    => __( 'Sticky on Desktop', $this -> text_domain ),
            'subtitle' => __( 'Select the type of the Sticky Header for Desktop.', $this -> text_domain ),
            //Must provide key => value pairs for select options
            'options'  => array(
                'sticky'         => __('Sticky', $this -> text_domain),
                'stickyonscroll' => __('Sticky On Scroll Up', $this -> text_domain),
            ),
            'default'  => 'sticky'
        ),
        array(
            'id'       => 'sticky-tablet',
            'type'     => 'select',
            'title'    => __( 'Sticky on Tablets', $this -> text_domain ),
            'subtitle' => __( 'Select the type of the Sticky Header for Tablet.', $this -> text_domain ),
            //Must provide key => value pairs for select options
            'options'  => array(
                'static'         => __('Static', $this -> text_domain),
                'sticky'         => __('Sticky', $this -> text_domain),
                'stickyonscroll' => __('Sticky On Scroll Up', $this -> text_domain),
            ),
            'default'  => 'static'
        ),
        array(
            'id'       => 'sticky-mobile',
            'type'     => 'select',
            'title'    => __( 'Sticky on Mobile', $this -> text_domain ),
            'subtitle' => __( 'Select the type of the Sticky Header for Mobile.', $this -> text_domain ),
            //Must provide key => value pairs for select options
            'options'  => array(
                'static'         => __('Static', $this -> text_domain),
                'sticky'         => __('Sticky', $this -> text_domain),
                'stickyonscroll' => __('Sticky On Scroll Up', $this -> text_domain),
            ),
            'default'  => 'static'
        ),
    ),
));
