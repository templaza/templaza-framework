<?php

defined('TEMPLAZA_FRAMEWORK') or exit();

use TemPlazaFramework\Functions;

Templaza_API::set_section('settings',
    array(
        'title'  => __( 'Header', $this -> text_domain ),
        'id'     => 'headers',
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
                'id'       => 'header-layout',
                'type'     => 'select',
                'data'     => 'callback',
                'title'    => esc_html__('Header Layout', $this -> text_domain),
                'subtitle' => __('This template style will be defined as the global default template style.', $this -> text_domain),
                'args'     => array('TemPlazaFramework\AdminHelper\Templaza_Header', 'get_items_by_slug'),
                'required' => array( 'enable-header', '=', '1' ),
            ),
            array(
                'id'    => 'header-mode',
                'type'  => 'image_select',
                'title'    => __('Header Mode', $this -> text_domain),
                'subtitle' => __( 'Select your header mode for the appearance of your site.', $this -> text_domain ),
                'required' => array( 'enable-header', '=', '1' ),
                'default'  => 'horizontal',
                'options'  => array(
                    'horizontal' => array(
                        'alt'   => __('Horizontal', $this -> text_domain),
                        'title' => __('Horizontal', $this -> text_domain),
                        'class' => 'w-px-150 h-px-103',
                        'img'   => Functions::get_my_frame_url().'/options/patterns/horizontal-left.svg',
                    ),
                    'stacked' => array(
                        'alt'   => __('Stacked', $this -> text_domain),
                        'title' => __('Stacked', $this -> text_domain),
                        'class' => 'w-px-150 h-px-103',
                        'img'   => Functions::get_my_frame_url().'/options/patterns/stacked_style1.svg',
                    ),
                    'sidebar' => array(
                        'alt'   => __('Sidebar', $this -> text_domain),
                        'title' => __('Sidebar', $this -> text_domain),
                        'class' => 'w-px-150 h-px-103',
                        'img'   => Functions::get_my_frame_url().'/options/patterns/sidebar-1.svg',
                    ),
                ),
            ),
            array(
                'id'    => 'header-horizontal-menu-mode',
                'type'  => 'image_select',
                'title'    => __('Horizontal Menu Mode', $this -> text_domain),
                'subtitle' => __( 'Select your horizontal menu mode. Select between left, right or center menu.', $this -> text_domain ),
                'options'  => array(
                    'left' => array(
                        'alt'   => __('Left', $this -> text_domain),
                        'title' => __('Left', $this -> text_domain),
                        'class' => 'w-px-150 h-px-103',
                        'img'   => Functions::get_my_frame_url().'/options/patterns/horizontal-left.svg',
                    ),
                    'center' => array(
                        'alt'   => __('Center', $this -> text_domain),
                        'title' => __('Center', $this -> text_domain),
                        'class' => 'w-px-150 h-px-103',
                        'img'   => Functions::get_my_frame_url().'/options/patterns/horizontal-center.svg',
                    ),
                    'right' => array(
                        'alt'   => __('Right', $this -> text_domain),
                        'title' => __('Right', $this -> text_domain),
                        'class' => 'w-px-150 h-px-103',
                        'img'   => Functions::get_my_frame_url().'/options/patterns/horizontal-right.svg',
                    ),
                ),
                'default'  => 'left',
                'required' => array(
                    array('enable-header', '=', '1'),
                    array('header-mode', '=', 'horizontal')
                ),
            ),
            array(
                'id'    => 'header-stacked-menu-mode',
                'type'  => 'image_select',
                'title'    => __('Stacked Menu Mode', $this -> text_domain),
                'subtitle' => __( 'Select your stacked menu mode. Select between top, middle or bottom menu.', $this -> text_domain ),
                'default'  => 'center',
                'options'  => array(
                    'center' => array(
                        'alt'   => __('Stacked Center', $this -> text_domain),
                        'title' => __('Stacked Center', $this -> text_domain),
                        'class' => 'w-px-150 h-px-103',
                        'img'   => Functions::get_my_frame_url().'/options/patterns/stacked_style1.svg',
                    ),
                    'seperated' => array(
                        'alt'   => __('Stacked Seperated', $this -> text_domain),
                        'title' => __('Stacked Seperated', $this -> text_domain),
                        'class' => 'w-px-150 h-px-103',
                        'img'   => Functions::get_my_frame_url().'/options/patterns/stacked_style2.svg',
                    ),
                    'divided' => array(
                        'alt'   => __('Stacked Divided', $this -> text_domain),
                        'title' => __('Stacked Divided', $this -> text_domain),
                        'class' => 'w-px-150 h-px-103',
                        'img'   => Functions::get_my_frame_url().'/options/patterns/stacked_style3.svg',
                    ),
                ),
                'required' => array(
                    array('enable-header', '=', '1'),
                    array('header-mode', '=', 'stacked')
                ),
            ),
            array(
                'id'    => 'header-sidebar-menu-mode',
                'type'  => 'image_select',
                'title'    => __('Sidebar Menu Mode', $this -> text_domain),
                'subtitle' => __( 'Select your sidebar menu mode. Select between left or right menu.', $this -> text_domain ),
                'default'  => 'left',
                'options'  => array(
                    'left' => array(
                        'alt'   => __('Left', $this -> text_domain),
                        'title' => __('Left', $this -> text_domain),
                        'class' => 'w-px-150 h-px-103',
                        'img'   => Functions::get_my_frame_url().'/options/patterns/sidebar-1.svg',
                    ),
                    'right' => array(
                        'alt'   => __('Right', $this -> text_domain),
                        'title' => __('Right', $this -> text_domain),
                        'class' => 'w-px-150 h-px-103',
                        'img'   => Functions::get_my_frame_url().'/options/patterns/sidebar-2.svg',
                    ),
                ),
                'required' => array(
                    array('enable-header', '=', '1'),
                    array('header-mode', '=', 'sidebar')
                ),
            ),
            array(
                'id'       => 'header-odd-menu-items',
                'type'     => 'button_set',
                'title'    => __('Odd number menu item position', $this -> text_domain),
                'subtitle' => __('Select where you want to place the extra menu item in case of Odd number of menu items.', $this -> text_domain),
                'options'  => array(
                    'left'  => esc_html__('Left', $this -> text_domain),
                    'right' => esc_html__('Right', $this -> text_domain),
                ),
                'default'  => 'left',
                'required' => array('header-stacked-menu-mode', '=', 'seperated'),
            ),
            array(
                'id'       => 'header-block-1-type',
                'type'     => 'select',
                'title'    => __( 'Header Block 1', $this -> text_domain ),
                'subtitle' => __( 'Select the content you want to display in the Header Block 1.', $this -> text_domain ),
                //Must provide key => value pairs for select options
                'options'  => array(
                    'blank'     => __('Blank', $this -> text_domain),
                    'sidebar'   => __('Sidebar', $this -> text_domain),
                    'custom'    => __('Custom HTML', $this -> text_domain),
                ),
                'select2'       => array( 'allowClear' => false ),
                'default'  => 'blank',
                'required' => array( array('enable-header', '=', '1')),
            ),
            array(
                'id'       => 'header-block-1-sidebar',
                'type'     => 'select',
                'title'    => __( 'Block 1 Sidebar', $this -> text_domain ),
                'subtitle' => __( 'Select Sidebar for Header Block 1.', $this -> text_domain ),
                'data'     => 'sidebars',
                'default'  => '',
                'required' => array( array('header-block-1-type', '=', 'sidebar')),
            ),
            array(
                'id'       => 'header-block-1-custom',
                'type'     => 'textarea',
                'title'    => __( 'Block 1 Custom HTML', $this -> text_domain ),
                'subtitle' => __( 'Enter your Custom HTML code for Header Block 1.', $this -> text_domain ),
                'required' => array(
                    array('enable-header', '=', '1'),
                    array('header-block-1-type', '=', 'custom')
                ),
            ),
            array(
                'id'       => 'header-block-2-type',
                'type'     => 'select',
                'title'    => __( 'Header Block 2', $this -> text_domain ),
                'subtitle' => __( 'Select the content you want to display in the Header Block 2.', $this -> text_domain ),
                //Must provide key => value pairs for select options
                'options'  => array(
                    'blank'     => __('Blank', $this -> text_domain),
                    'sidebar'   => __('Sidebar', $this -> text_domain),
                    'custom'    => __('Custom HTML', $this -> text_domain),
                ),
                'default'  => 'blank',
                'required' => array(
                    array('header-stacked-menu-mode', '!=', 'center'),
                ),
            ),
            array(
                'id'       => 'header-block-2-sidebar',
                'type'     => 'select',
                'title'    => __( 'Block 2 Sidebar', $this -> text_domain ),
                'subtitle' => __( 'Select Sidebar for Header Block 2.', $this -> text_domain ),
                'data'     => 'sidebars',
                'default'  => '',
                'required' => array( array('header-block-2-type', '=', 'sidebar')),
            ),
            array(
                'id'       => 'header-block-2-custom',
                'type'     => 'textarea',
                'title'    => __( 'Block 2 Custom HTML', $this -> text_domain ),
                'subtitle' => __( 'Enter your Custom HTML code for Header Block 2.', $this -> text_domain ),
                //Must provide key => value pairs for select options
                'options'  => array(
                    'blank'         => __('Blank', $this -> text_domain),
                    'custom' => __('Custom HTML', $this -> text_domain),
                ),
                'required' => array(
                    array('enable-header', '=', '1'),
                    array('header-block-2-type', '=', 'custom'),
                ),
            ),
            array(
                'id'       => 'header-menu',
                'type'     => 'select',
                'data'     => 'menu_locations',
                'title'    => __( 'Site Menu', $this -> text_domain ),
                'subtitle' => __( 'Select Site Menu.', $this -> text_domain ),
                'default'  => 'header',
                'required' => array(
                    array('enable-header', '=', '1'),
                ),
            ),
    //        array(
    //            'id'       => 'header-menu-item',
    //            'type'     => 'select',
    //            'data'     => 'menus',
    //            'title'    => __( 'Site Menus', $this -> text_domain ),
    //            'subtitle' => __( 'Select Site Menu.', $this -> text_domain ),
    //            'default'  => 'header',
    //            'required' => array(
    //                array('enable-header', '=', '1'),
    //            ),
    //        ),
            array(
                'id'       => 'header-menu-level',
                'type'     => 'spinner',
                'title'    => __( 'Menu Level', $this -> text_domain ),
                'subtitle' => __( 'Level to rendering the menu at. Setting levels to the same level will only display that single level.', $this -> text_domain ),
                'min'      => 0,
                'step'     => 1,
                'max'      => 10,
                'default'  => 0,
                'required' => array(
                    array('enable-header', '=', '1'),
                ),
            ),
            array(
                'id'       => 'header-mobile-menu',
                'type'     => 'select',
                'data'     => 'menu_locations',
                'title'    => __( 'Mobile Menu', $this -> text_domain ),
                'subtitle' => __( 'Select Mobile Menu.', $this -> text_domain ),
                'default'  => 'header',
                'required' => array(
                    array('enable-header', '=', '1'),
                ),
            ),
            array(
                'id'       => 'header-mobile-menu-level',
                'type'     => 'spinner',
                'title'    => __( 'Mobile Menu Level', $this -> text_domain ),
                'subtitle' => __( 'Level to rendering the menu at. Setting levels to the same level will only display that single level.', $this -> text_domain ),
                'min'      => 0,
                'step'     => 1,
                'max'      => 10,
                'default'  => 0,
                'required' => array(
                    array('enable-header', '=', '1'),
                ),
            ),
            array(
                'id'       => 'header-absolute',
                'type'     => 'switch',
                'title'    => __( 'Header Display Absolute', $this -> text_domain ),
                'subtitle' => __( 'Enable header display absolute.', $this -> text_domain ),
                'default'  => false,
                'required' => array(
                    array('header-mode', '!=', 'sidebar'),
                ),
            ),

            // -> START Logo
            array(
                'id'       => 'section-logo',
                'type'     => 'section',
                'required' => array('enable-header', '=','1'),
                'title'      => __( 'Logo', $this -> text_domain ),
                'subtitle'       => __( 'You can select a logo for desktop view, mobile view and sticky header.', $this -> text_domain ),
                'indent'   => true, // Indent all options below until the next 'section' option is set.
            ),
            array(
                'id'       => 'logo-type',
                'type'     => 'button_set',
                'required' => array( 'enable-header', '=', '1' ),
                'title'    => __( 'Logo Type', $this -> text_domain ),
                'subtitle' => __( 'Select logo type.', $this -> text_domain ),
                'options'  => array(
                    'image' => esc_html__('Image', $this -> text_domain),
                    'text'  => esc_html__('Text', $this -> text_domain),
                    'none'  => esc_html__('None', $this -> text_domain),
                ),
                'default'  => 'image',
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
                    array('logo-type', '=', 'image') ),
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
                    array('logo-type', '=', 'image') ),
            ),
            array(
                'id'       => 'sidebar-logo',
                'type'     => 'media',
                'url'      => true,
                'title'    => __( 'Sidebar Logo', $this -> text_domain ),
                'compiler' => 'true',
                'desc'     => __( 'This logo will appear when sidebar is collapsed.', $this -> text_domain ),
                'subtitle' => __( 'Select an image for your sidebar logo.', $this -> text_domain ),
                'required' => array( array('enable-header', '=', '1'),
                    array('header-mode', '=', 'sidebar') ),
            ),
            array(
                'id'    => 'logo-text',
                'type'  => 'text',
                'title'    => __('Logo Text', $this -> text_domain),
                'subtitle' => __( 'Enter Logo Text.', $this -> text_domain ),
                'required' => array( array('enable-header', '=', '1'),
                    array('logo-type', '=', 'text') ),
            ),
            array(
                'id'    => 'tag-line',
                'type'  => 'text',
                'title'    => __('Tag Line', $this -> text_domain),
                'subtitle' => __( 'Enter Tag Line.', $this -> text_domain ),
                'required' => array( array('enable-header', '=', '1'),
                    array('logo-type', '=', 'text') ),
            ),

            // -> START Sticky Header
            array(
                'id'       => 'section-sticky-header',
                'type'     => 'section',
                'required' => array(
                    array('enable-header', '=','1'),
                    array('header-mode', '!=','sidebar'),
                ),
                'title'    => __( 'Sticky', $this -> text_domain ),
                'subtitle' => __( 'Here you can select the type of the Sticky Header for desktop view, tablet view and mobile view.', $this -> text_domain ),
                'indent'   => true, // Indent all options below until the next 'section' option is set.
            ),
            array(
                'id'       => 'enable-sticky',
                'type'     => 'switch',
                'required' => array(
                    array('header-mode', '!=', 'sidebar'),
                ),
                'title'    => __( 'Enable Sticky', $this -> text_domain ),
                'subtitle' => __( 'Enable Sticky Header.', $this -> text_domain ),
                'default'  => true,
            ),
            array(
                'id'    => 'sticky-menu-mode',
                'type'  => 'image_select',
    //            'tiles'    => true,
                'title'    => __('Sticky Menu Mode', $this -> text_domain),
                'subtitle' => __( 'Select your horizontal menu mode. Select between left, right or center menu.', $this -> text_domain ),
                'required' => array( array('enable-header', '=', '1'),
                    array('enable-sticky', '=', '1') ),
                'options'  => array(
                    'left' => array(
                        'alt'   => __('Left', $this -> text_domain),
                        'title' => __('Left', $this -> text_domain),
                        'class' => 'w-px-150 h-px-103',
                        'img'   => Functions::get_my_frame_url().'/options/patterns/horizontal-left.svg',
                    ),
                    'center' => array(
                        'alt'   => __('Center', $this -> text_domain),
                        'title' => __('Center', $this -> text_domain),
                        'class' => 'w-px-150 h-px-103',
                        'img'   => Functions::get_my_frame_url().'/options/patterns/horizontal-center.svg',
                    ),
                    'right' => array(
                        'alt'   => __('Right', $this -> text_domain),
                        'title' => __('Right', $this -> text_domain),
                        'class' => 'w-px-150 h-px-103',
                        'img'   => Functions::get_my_frame_url().'/options/patterns/horizontal-right.svg',
                    ),
                ),
                'default'  => 'left',
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
                'select2'       => array( 'allowClear' => false ),
                'default'  => 'sticky',
                'required' => array( array('enable-header', '=', '1'),
                    array('enable-sticky', '=', '1') ),
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
                'select2'       => array( 'allowClear' => false ),
                'default'  => 'static',
                'required' => array( array('enable-header', '=', '1'),
                    array('enable-sticky', '=', '1') ),
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
                'select2'  => array( 'allowClear' => false ),
                'default'  => 'static',
                'required' => array( array('enable-header', '=', '1'),
                    array('enable-sticky', '=', '1') ),
            ),

            // -> START Off Canvas Menu
            array(
                'id'       => 'section-offcanvas-menu',
                'type'     => 'section',
                'title'      => __( 'Off-Canvas menu', $this -> text_domain ),
                'subtitle'       => __( 'Customize Off-Canvas style for your site. You must publish content to the Off-Canvas module position or you\'ll see a blank off-canvas menu.', $this -> text_domain ),
                'required' => array(
                    array('enable-header', '=','1'),
                    array('header-mode', '!=','sidebar'),
                ),
                'indent'   => true, // Indent all options below until the next 'section' option is set.
            ),
            array(
                'id'       => 'enable-offcanvas',
                'type'     => 'switch',
                'required' => array( 'enable-header', '=', '1' ),
                'title'    => __( 'Off-Canvas menu', $this -> text_domain ),
                'subtitle' => __( 'Enable or disable to show or hide Off-Canvas menu.', $this -> text_domain ),
                'default'  => false,
            ),
    //        array(
    //            'id'       => 'offcanvas-menu',
    //            'type'     => 'select',
    //            'data'     => 'menu_locations',
    //            'required' => array( 'enable-offcanvas', '=', '1' ),
    //            'title'    => __( 'Off-Canvas menu location', $this -> text_domain ),
    //            'subtitle' => __( 'Enable or disable to show or hide Off-Canvas menu.', $this -> text_domain ),
    //            'default'  => 'header',
    //        ),
            array(
                'id'       => 'offcanvas-sidebar',
                'type'     => 'select',
                'data'     => 'sidebars',
                'required' => array( 'enable-offcanvas', '=', '1' ),
                'title'    => __( 'Off-Canvas Sidebar', $this -> text_domain ),
                'subtitle' => __( 'Select Sidebar for Off-Canvas', $this -> text_domain ),
                'default'  => '',
            ),
            array(
                'id'       => 'offcanvas-togglevisibility',
                'type'     => 'select',
                'required' => array(
                    array('enable-offcanvas', '=', '1' )
                ),
                'title'    => __( 'Toggle Visibility', $this -> text_domain ),
                'subtitle' => __( 'Select to toggle off-canvas visibility on mobile or desktop.', $this -> text_domain ),
                //Must provide key => value pairs for select options
                'options'  => array(
                    'd-block'           => __('Always', $this -> text_domain),
                    'd-block d-sm-none' => __('Only on X-Small Devices', $this -> text_domain),
                    'd-block d-md-none' => __('Upto Small Devices', $this -> text_domain),
                    'd-block d-lg-none' => __('Upto Medium Devices', $this -> text_domain),
                    'd-block d-xl-none' => __('Upto Large Devices', $this -> text_domain),
                    'd-none d-xl-block' => __('Upto Only on X-Large Devices', $this -> text_domain),
                ),
                'default'  => 'd-block',
                'select2'  => array( 'allowClear' => false ),
            ),
            array(
                'id'       => 'offcanvas-panelwidth',
                'type'     => 'text',
                'required' => array(
                    array('enable-offcanvas', '=', '1' )
                ),
                'title'    => __( 'Panel Width', $this -> text_domain ),
                'subtitle' => __( 'Set off-canvas size in rem, em, px or percentage unit values.', $this -> text_domain ),
                'default'  => '320px'
            ),
            array(
                'id'       => 'offcanvas-animation',
                'type'     => 'select',
                'required' => array(
                    array('enable-offcanvas', '=', '1' )
                ),
                'title'    => __( 'Off-Canvas Animation', $this -> text_domain ),
                'subtitle' => __( 'Select an animation for Off-canvas Menu from dropdown options.', $this -> text_domain ),
                //Must provide key => value pairs for select options
                'options'  => array(
                    'st-effect-1' => __('Slide in On Top', $this -> text_domain),
                    'st-effect-2' => __('Reveal', $this -> text_domain),
                    'st-effect-3' => __('Push', $this -> text_domain),
                ),
                'default'  => 'st-effect-1',
                'select2'  => array( 'allowClear' => false ),
            ),
            array(
                'id'       => 'offcanvas-direction',
                'type'     => 'select',
                'title'    => __( 'Off-Canvas Direction', $this -> text_domain ),
                'subtitle' => __( 'Select the direction for Off-canvas Menu', $this -> text_domain ),
                'options'  => array(
                    'offcanvasDirLeft'  => esc_html__('Left', $this -> text_domain),
                    'offcanvasDirRight' => esc_html__('Right', $this -> text_domain),
                ),
                'select2'       => array( 'allowClear' => false ),
                'default'       => 'offcanvasDirLeft',
                'required' => array(
                    array('enable-header', '=', '1' ),
                    array('enable-offcanvas', '=', '1' )
                ),
            ),

            // -> START Animation
            array(
                'id'         => 'section-dropdown-animation',
                'title'      => __( 'Dropdown Animation', $this -> text_domain ),
                'desc'       => __( 'Customize dropdown animation for mega/dropdown menu.', $this -> text_domain ),
                'type'     => 'section',
                'indent'   => true, // Indent all options below until the next 'section' option is set.
                'required' => array(
                    array('enable-header', '=','1'),
                    array('header-mode', '!=','sidebar'),
                ),
            ),
            array(
                'id'       => 'dropdown-animation-type',
                'type'     => 'button_set',
                'required' => array(
                    array( 'enable-header', '=', '1' ),
                ),
                'title'    => __( 'Animation', $this -> text_domain ),
                //Must provide key => value pairs for select options
                'options'  => array(
                    'fade'  => __('On', $this -> text_domain),
                    'none'  => __('Off', $this -> text_domain),
//                    'slide' => __('Slide', $this -> text_domain),
                ),
                'default'  => 'fade',
            ),
            array(
                'id'       => 'dropdown-animation-effect',
                'type'     => 'select',
                'title'    => __( 'Effect', $this -> text_domain ),
                //Must provide key => value pairs for select options
                'options'  => array(
                    'fade-down'  => __('Fade Down', $this -> text_domain),
                    'fade-left'  => __('Fade Left', $this -> text_domain),
                    'fade-right' => __('Fade Right', $this -> text_domain),
                    'fade-up'    => __('Fade Up', $this -> text_domain),
                    'rotate-x'   => __('Rotate X', $this -> text_domain),
                    'rotate-y'   => __('Rotate Y', $this -> text_domain),
                ),
                'select2'  => array( 'allowClear' => false ),
                'default'  => 'fade-down',
                'required' => array(
                    array('header-mode', '!=', 'sidebar'),
                    array('dropdown-animation-type', '!=', 'none')
                ),
            ),
    //        array(
    //            'id'       => 'dropdown-animation-speed-1',
    //            'type'     => 'slider',
    //            'required' => array(
    //                array( 'header-mode', '!=', 'sidebar' ),
    //            ),
    //            'title'    => __( 'Animation Speed 1', $this -> text_domain ),
    //            'desc'     => __( 'Animation speed by: ms', $this -> text_domain ),
    //            'default'       => 300,
    //            'min'           => 100,
    //            'step'          => 1,
    //            'max'           => 4000,
    //            'display_value' => 'text'
    //        ),
    //        array(
    //            'id'       => 'dropdown-animation-speed-2',
    //            'type'     => 'slider',
    //            'required' => array(
    //                array('header-mode', '!=', 'sidebar'),
    //            ),
    //            'title'    => __( 'Animation Speed 2', $this -> text_domain ),
    //            'desc'     => __( 'Animation speed by: ms', $this -> text_domain),
    //            'default'       => 300,
    //            'min'           => 100,
    //            'step'          => 1,
    //            'max'           => 4000,
    //            'display_value' => 'text'
    //        ),
    //        array(
    //            'id'       => 'dropdown-animation-ease',
    //            'type'     => 'select',
    //            'required' => array(
    //                array( 'enable-header', '=', '1' ),
    //                array( 'header-mode', '!=', 'sidebar' ),
    //            ),
    //            'title'    => __( 'Easing', $this -> text_domain ),
    //            //Must provide key => value pairs for select options
    //            'options'  => array(
    //                'linear'            => __('linear', $this -> text_domain),
    //                'swing'             => __('swing', $this -> text_domain),
    //                'easeInQuad'        => __('easeInQuad', $this -> text_domain),
    //                'easeOutQuad'       => __('easeOutQuad', $this -> text_domain),
    //                'easeInOutQuad'     => __('easeInOutQuad', $this -> text_domain),
    //                'easeInCubic'       => __('easeInCubic', $this -> text_domain),
    //                'easeOutCubic'      => __('easeOutCubic', $this -> text_domain),
    //                'easeInOutCubic'    => __('easeInOutCubic', $this -> text_domain),
    //                'easeInQuart'       => __('easeInQuart', $this -> text_domain),
    //                'easeOutQuart'      => __('easeOutQuart', $this -> text_domain),
    //                'easeInOutQuart'    => __('easeInOutQuart', $this -> text_domain),
    //                'easeInQuint'       => __('easeInQuint', $this -> text_domain),
    //                'easeOutQuint'      => __('easeOutQuint', $this -> text_domain),
    //                'easeInOutQuint'    => __('easeInOutQuint', $this -> text_domain),
    //                'easeInSine'        => __('easeInSine', $this -> text_domain),
    //                'easeOutSine'       => __('easeOutSine', $this -> text_domain),
    //                'easeInOutSine'     => __('easeInOutSine', $this -> text_domain),
    //                'easeInExpo'        => __('easeInExpo', $this -> text_domain),
    //                'easeOutExpo'       => __('easeOutExpo', $this -> text_domain),
    //                'easeInOutExpo'     => __('easeInOutExpo', $this -> text_domain),
    //                'easeInCirc'        => __('easeInCirc', $this -> text_domain),
    //                'easeOutCirc'       => __('easeOutCirc', $this -> text_domain),
    //                'easeInOutCirc'     => __('easeInOutCirc', $this -> text_domain),
    //                'easeInElastic'     => __('easeInElastic', $this -> text_domain),
    //                'easeOutElastic'    => __('easeOutElastic', $this -> text_domain),
    //                'easeInOutElastic' => __('easeInOutElastic', $this -> text_domain),
    //                'easeInBack'        => __('easeInBack', $this -> text_domain),
    //                'easeOutBack'       => __('easeOutBack', $this -> text_domain),
    //                'easeInOutBack'     => __('easeInOutBack', $this -> text_domain),
    //                'easeInBounce'      => __('easeInBounce', $this -> text_domain),
    //                'easeOutBounce'     => __('easeOutBounce', $this -> text_domain),
    //                'easeInOutBounce'   => __('easeInOutBounce', $this -> text_domain),
    //            ),
    //            'default'  => 'linear',
    //        ),
            array(
                'id'       => 'dropdown-arrow',
                'type'     => 'switch',
                'required' => array(
                    array('enable-header', '=', '1' ),
                    array('header-mode', '!=', 'sidebar' ),
                ),
                'title'    => __( 'Dropdown Arrow', $this -> text_domain ),
                'subtitle' => __( 'Enable or Disable if you want to show the dropdown arrow', $this -> text_domain ),
                'default'  => true,
            ),
            array(
                'id'       => 'dropdown-trigger',
                'type'     => 'button_set',
                'required' => array(
                    array('enable-header', '=', '1' ),
                    array('header-mode', '!=', 'sidebar' ),
                ),
                'title'    => __( 'Dropdown Trigger', $this -> text_domain ),
                'subtitle' => __( 'Choose the action for the menu items to view the megamenu', $this -> text_domain ),
                'options' => array(
                    'hover' => __('Hover', $this -> text_domain),
                    'click' => __('Click', $this -> text_domain),
                ),
                'default'  => 'hover',
            ),
//            array(
//                'id'       => 'dropdown-trigger',
//                'type'     => 'switch',
//                'required' => array(
//                    array('enable-header', '=', '1' ),
//                    array('header-mode', '!=', 'sidebar' ),
//                ),
//                'title'    => __( 'Dropdown Trigger', $this -> text_domain ),
//                'subtitle' => __( 'Choose the action for the menu items to view the megamenu', $this -> text_domain ),
//                'default'  => true,
//                'on'       => __('Hover', $this -> text_domain),
//                'off'      => __('Click', $this -> text_domain),
//            ),
            array(
                'id'     => 'section-end',
                'type'   => 'section',
                'indent' => false, // Indent all options below until the next 'section' option is set.
            ),
        ),
    )
);