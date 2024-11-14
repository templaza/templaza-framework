<?php

defined('TEMPLAZA_FRAMEWORK') or exit();

use TemPlazaFramework\Functions;

Templaza_API::set_section('templaza_header',
    array(
        'title'  => __( 'Header', 'templaza-framework' ),
        'id'     => 'headers',
        'desc'   => __( 'Here you can set your preferences for the template header(Logo, Menu and Menu Elements).', 'templaza-framework' ),
        'icon'   => 'el el-tasks',
        //    'subsection' => true,
        'fields' => array(
            array(
                'id'    => 'header-mode',
                'type'  => 'image_select',
                'title'    => __('Header Mode', 'templaza-framework'),
                'subtitle' => __( 'Select your header mode for the appearance of your site.', 'templaza-framework' ),
                'default'  => 'horizontal',
                'options'  => array(
                    'horizontal' => array(
                        'alt'   => __('Horizontal', 'templaza-framework'),
                        'title' => __('Horizontal', 'templaza-framework'),
                        'class' => 'w-px-150 h-px-103',
                        'img'   => Functions::get_my_frame_url().'/options/patterns/horizontal-left.svg',
                    ),
                    'stacked' => array(
                        'alt'   => __('Stacked', 'templaza-framework'),
                        'title' => __('Stacked', 'templaza-framework'),
                        'class' => 'w-px-150 h-px-103',
                        'img'   => Functions::get_my_frame_url().'/options/patterns/stacked_style1.svg',
                    ),
                    'sidebar' => array(
                        'alt'   => __('Sidebar', 'templaza-framework'),
                        'title' => __('Sidebar', 'templaza-framework'),
                        'class' => 'w-px-150 h-px-103',
                        'img'   => Functions::get_my_frame_url().'/options/patterns/sidebar-1.svg',
                    ),
                ),
            ),
            array(
                'id'    => 'header-horizontal-menu-mode',
                'type'  => 'image_select',
                'title'    => __('Horizontal Menu Mode', 'templaza-framework'),
                'subtitle' => __( 'Select your horizontal menu mode. Select between left, right or center menu.', 'templaza-framework' ),
                'options'  => array(
                    'left' => array(
                        'alt'   => __('Left', 'templaza-framework'),
                        'title' => __('Left', 'templaza-framework'),
                        'class' => 'w-px-150 h-px-103',
                        'img'   => Functions::get_my_frame_url().'/options/patterns/horizontal-left.svg',
                    ),
                    'center' => array(
                        'alt'   => __('Center', 'templaza-framework'),
                        'title' => __('Center', 'templaza-framework'),
                        'class' => 'w-px-150 h-px-103',
                        'img'   => Functions::get_my_frame_url().'/options/patterns/horizontal-center.svg',
                    ),
                    'right' => array(
                        'alt'   => __('Right', 'templaza-framework'),
                        'title' => __('Right', 'templaza-framework'),
                        'class' => 'w-px-150 h-px-103',
                        'img'   => Functions::get_my_frame_url().'/options/patterns/horizontal-right.svg',
                    ),
                    'justify' => array(
                        'alt'   => __('Justify', 'templaza-framework'),
                        'title' => __('Justify', 'templaza-framework'),
                        'class' => 'w-px-150 h-px-103',
                        'img'   => Functions::get_my_frame_url().'/options/patterns/horizontal-center.svg',
                    ),
                ),
                'default'  => 'left',
                'required' => array(
                    array('header-mode', '=', 'horizontal')
                ),
            ),
            array(
                'id'    => 'header-stacked-menu-mode',
                'type'  => 'image_select',
                'title'    => __('Stacked Menu Mode', 'templaza-framework'),
                'subtitle' => __( 'Select your stacked menu mode. Select between top, middle or bottom menu.', 'templaza-framework' ),
                'default'  => 'center',
                'options'  => array(
                    'center-balance' => array(
                        'alt'   => __('Center Balance', 'templaza-framework'),
                        'title' => __('Center Balance', 'templaza-framework'),
                        'class' => 'w-px-150 h-px-103',
                        'img'   => Functions::get_my_frame_url().'/options/patterns/stacked_style0.svg',
                    ),
                    'center' => array(
                        'alt'   => __('Stacked Center', 'templaza-framework'),
                        'title' => __('Stacked Center', 'templaza-framework'),
                        'class' => 'w-px-150 h-px-103',
                        'img'   => Functions::get_my_frame_url().'/options/patterns/stacked_style1.svg',
                    ),
                    'seperated' => array(
                        'alt'   => __('Stacked Seperated', 'templaza-framework'),
                        'title' => __('Stacked Seperated', 'templaza-framework'),
                        'class' => 'w-px-150 h-px-103',
                        'img'   => Functions::get_my_frame_url().'/options/patterns/stacked_style2.svg',
                    ),
                    'divided' => array(
                        'alt'   => __('Stacked Divided', 'templaza-framework'),
                        'title' => __('Stacked Divided', 'templaza-framework'),
                        'class' => 'w-px-150 h-px-103',
                        'img'   => Functions::get_my_frame_url().'/options/patterns/stacked_style3.svg',
                    ),
                    'left' => array(
                        'alt'   => __('Stacked Left', 'templaza-framework'),
                        'title' => __('Stacked Left', 'templaza-framework'),
                        'class' => 'w-px-150 h-px-103',
                        'img'   => Functions::get_my_frame_url().'/options/patterns/stacked-left.svg',
                    ),
                ),
                'required' => array(
                    array('header-mode', '=', 'stacked')
                ),
            ),
            array(
                'id'    => 'header-sidebar-menu-mode',
                'type'  => 'image_select',
                'title'    => __('Sidebar Menu Mode', 'templaza-framework'),
                'subtitle' => __( 'Select your sidebar menu mode. Select between left or right menu.', 'templaza-framework' ),
                'default'  => 'left',
                'options'  => array(
                    'left' => array(
                        'alt'   => __('Left', 'templaza-framework'),
                        'title' => __('Left', 'templaza-framework'),
                        'class' => 'w-px-150 h-px-103',
                        'img'   => Functions::get_my_frame_url().'/options/patterns/sidebar-1.svg',
                    ),
                    'right' => array(
                        'alt'   => __('Right', 'templaza-framework'),
                        'title' => __('Right', 'templaza-framework'),
                        'class' => 'w-px-150 h-px-103',
                        'img'   => Functions::get_my_frame_url().'/options/patterns/sidebar-2.svg',
                    ),
                ),
                'required' => array(
                    array('header-mode', '=', 'sidebar')
                ),
            ),
            array(
                'id'       => 'header-odd-menu-items',
                'type'     => 'button_set',
                'title'    => __('Odd number menu item position', 'templaza-framework'),
                'subtitle' => __('Select where you want to place the extra menu item in case of Odd number of menu items.', 'templaza-framework'),
                'options'  => array(
                    'left'  => esc_html__('Left', 'templaza-framework'),
                    'right' => esc_html__('Right', 'templaza-framework'),
                ),
                'default'  => 'left',
                'required' => array('header-stacked-menu-mode', '=', 'seperated'),
            ),
            array(
                'id'       => 'header-menu-item-align',
                'type'     => 'select',
                'title'    => __( 'Menu item align', 'templaza-framework' ),
                'options'  => array(
                    'default'     => __('Default', 'templaza-framework'),
                    'justify'   => __('Justify', 'templaza-framework'),
                ),
                'select2'       => array( 'allowClear' => false ),
                'default'  => 'default',
                'required' => array(
                    array('header-mode', '=', 'stacked')
                ),
            ),
            array(
                'id'       => 'header-menu-item-text-align',
                'type'     => 'select',
                'title'    => __( 'Menu item text align', 'templaza-framework' ),
                'options'  => array(
                    'left'     => __('Left', 'templaza-framework'),
                    'center'   => __('Center', 'templaza-framework'),
                    'right'   => __('Right', 'templaza-framework'),
                    'default'   => __('Default', 'templaza-framework'),
                ),
                'select2'       => array( 'allowClear' => false ),
                'default'  => 'left',
                'required' => array(
                    array('header-menu-item-align', '=', 'justify')
                ),
            ),
            array(
                'id'       => 'header-block-1-type',
                'type'     => 'select',
                'title'    => __( 'Header Block 1', 'templaza-framework' ),
                'subtitle' => __( 'Select the content you want to display in the Header Block 1.', 'templaza-framework' ),
                //Must provide key => value pairs for select options
                'options'  => array(
                    'blank'     => __('Blank', 'templaza-framework'),
                    'sidebar'   => __('Sidebar', 'templaza-framework'),
                    'contact'   => __('Contact', 'templaza-framework'),
                    'social'    => __('Social', 'templaza-framework'),
                    'custom'    => __('Custom HTML', 'templaza-framework'),
                ),
                'select2'       => array( 'allowClear' => false ),
                'default'  => 'blank',
            ),
            array(
                'id'       => 'header-block-1-position',
                'type'     => 'select',
                'title'    => __( 'Header Block 1 Position', 'templaza-framework' ),
                'options'  => array(
                    'right'     => __('Right', 'templaza-framework'),
                    'center'   => __('Center', 'templaza-framework'),
                ),
                'select2'       => array( 'allowClear' => false ),
                'default'  => 'center',
                'required' => array('header-stacked-menu-mode', '=', 'divided'),
            ),
            array(
                'id'       => 'header-block-1-sidebar',
                'type'     => 'select',
                'title'    => __( 'Block 1 Sidebar', 'templaza-framework' ),
                'subtitle' => __( 'Select Sidebar for Header Block 1.', 'templaza-framework' ),
                'data'     => 'sidebars',
                'default'  => '',
                'required' => array( array('header-block-1-type', '=', 'sidebar')),
            ),
            array(
                'id'       => 'header-block-1-custom',
                'type'     => 'textarea',
                'title'    => __( 'Block 1 Custom HTML', 'templaza-framework' ),
                'subtitle' => __( 'Enter your Custom HTML code for Header Block 1.', 'templaza-framework' ),
                'required' => array(
                    array('header-block-1-type', '=', 'custom')
                ),
            ),
            array(
                'id'       => 'header-block-2-horizontal-sidebar',
                'type'     => 'select',
                'title'    => __( 'Block 2 Sidebar', 'templaza-framework' ),
                'subtitle' => __( 'Select Sidebar for Header Block 2.', 'templaza-framework' ),
                'data'     => 'sidebars',
                'default'  => '',
                'required' => array(
                    array('header-horizontal-menu-mode', '=', 'right')
                ),
            ),
            array(
                'id'       => 'header-block-2-type',
                'type'     => 'select',
                'title'    => __( 'Header Block 2', 'templaza-framework' ),
                'subtitle' => __( 'Select the content you want to display in the Header Block 2.', 'templaza-framework' ),
                //Must provide key => value pairs for select options
                'options'  => array(
                    'blank'     => __('Blank', 'templaza-framework'),
                    'sidebar'   => __('Sidebar', 'templaza-framework'),
                    'contact'    => __('Contact', 'templaza-framework'),
                    'social'    => __('Social', 'templaza-framework'),
                    'custom'    => __('Custom HTML', 'templaza-framework'),
                ),
                'default'  => 'blank',
                'required' => array(
                    array('header-stacked-menu-mode', '!=', 'center'),
                ),
            ),
            array(
                'id'       => 'header-block-2-sidebar',
                'type'     => 'select',
                'title'    => __( 'Block 2 Sidebar', 'templaza-framework' ),
                'subtitle' => __( 'Select Sidebar for Header Block 2.', 'templaza-framework' ),
                'data'     => 'sidebars',
                'default'  => '',
                'required' => array( array('header-block-2-type', '=', 'sidebar')),
            ),
            array(
                'id'       => 'header-block-2-custom',
                'type'     => 'textarea',
                'title'    => __( 'Block 2 Custom HTML', 'templaza-framework' ),
                'subtitle' => __( 'Enter your Custom HTML code for Header Block 2.', 'templaza-framework' ),
                //Must provide key => value pairs for select options
                'options'  => array(
                    'blank'         => __('Blank', 'templaza-framework'),
                    'custom' => __('Custom HTML', 'templaza-framework'),
                ),
                'required' => array(
                    array('header-block-2-type', '=', 'custom'),
                ),
            ),
            array(
                'id'       => 'header-block-3-type',
                'type'     => 'select',
                'title'    => __( 'Header Block 3', 'templaza-framework' ),
                'subtitle' => __( 'Select the content you want to display in the Header Block 3.', 'templaza-framework' ),
                //Must provide key => value pairs for select options
                'options'  => array(
                    'blank'     => __('Blank', 'templaza-framework'),
                    'sidebar'   => __('Sidebar', 'templaza-framework'),
                    'contact'    => __('Contact', 'templaza-framework'),
                    'social'    => __('Social', 'templaza-framework'),
                    'custom'    => __('Custom HTML', 'templaza-framework'),
                ),
                'default'  => 'blank',
                'required' => array(
                    array('header-stacked-menu-mode', '=', 'left'),
                ),
            ),
            array(
                'id'       => 'header-block-3-sidebar',
                'type'     => 'select',
                'title'    => __( 'Block 3 Sidebar', 'templaza-framework' ),
                'subtitle' => __( 'Select Sidebar for Header Block 3.', 'templaza-framework' ),
                'data'     => 'sidebars',
                'default'  => '',
                'required' => array( array('header-block-3-type', '=', 'sidebar')),
            ),
            array(
                'id'       => 'header-block-3-custom',
                'type'     => 'textarea',
                'title'    => __( 'Block 3 Custom HTML', 'templaza-framework' ),
                'subtitle' => __( 'Enter your Custom HTML code for Header Block 3.', 'templaza-framework' ),
                //Must provide key => value pairs for select options
                'options'  => array(
                    'blank'         => __('Blank', 'templaza-framework'),
                    'custom' => __('Custom HTML', 'templaza-framework'),
                ),
                'required' => array(
                    array('header-block-3-type', '=', 'custom'),
                ),
            ),
            array(
                'id'       => 'logo-section-border',
                'type'     => 'border',
                'title'    => esc_html__('Logo section Border', 'templaza-framework'),
                'default'  => '',
                'color_alpha'  => true,
                'required' => array(
                    array('header-mode', '=', array('stacked','horizontal')) ),
            ),
            array(
                'id'       => 'stacked-divided-top-padding',
                'type'     => 'spacing',
                'allow_responsive'    => true,
                'title'    => esc_html__('Logo Section Padding', 'templaza-framework'),
                'default'  => '',
                'required' => array(
                    array('header-mode', '=', array('stacked','horizontal')) ),
            ),
            array(
                'id'       => 'stacked-divided-top-margin',
                'type'     => 'spacing',
                'mode'     => 'margin',
                'allow_responsive'    => true,
                'title'    => esc_html__('Logo Section Margin', 'templaza-framework'),
                'default'  => '',
                'required' => array(
                    array('header-mode', '=', array('stacked','horizontal')) ),
            ),
            array(
                'id'       => 'menu-section-border',
                'type'     => 'border',
                'title'    => esc_html__('Menu wrap Border', 'templaza-framework'),
                'default'  => '',
                'color_alpha'  => true,
                'required' => array(
                    array('header-mode', '=', array('horizontal')) ),
            ),
            array(
                'id'       => 'menu-section-margin',
                'type'     => 'spacing',
                'mode'     => 'margin',
                'allow_responsive'    => true,
                'title'    => esc_html__('Menu wrap Margin', 'templaza-framework'),
                'default'  => '',
                'required' => array(
                    array('header-mode', '=', array('horizontal')) ),
            ),
            array(
                'id'       => 'stacked-divided-header-top-padding',
                'type'     => 'spacing',
                'allow_responsive'    => true,
                'title'    => esc_html__('Stacked Top Section Padding', 'templaza-framework'),
                'default'  => '',
                'required' => array(
                    array('header-mode', '=', 'stacked') ),
            ),
            array(
                'id'       => 'stacked-top-section-border',
                'type'     => 'border',
                'color_alpha'  => true,
                'title'    => esc_html__('Top section Border', 'templaza-framework'),
                'default'  => '',
                'required' => array(
                    array('header-mode', '=', 'stacked') ),
            ),
            array(
                'id'       => 'stacked-divided-header-menu-padding',
                'type'     => 'spacing',
                'allow_responsive'    => true,
                'title'    => esc_html__('Stacked Menu Section Padding', 'templaza-framework'),
                'default'  => '',
                'required' => array(
                    array('header-mode', '=', 'stacked') ),
            ),
            array(
                'id'       => 'stacked-divided-background',
                'type'     => 'switch',
                'title'    => esc_html__( 'Divided background', 'templaza-framework' ),
                'default'  => true,
                'required' => array('header-stacked-menu-mode', '=' , array('divided','center'))
            ),

            array(
                'id'       => 'input-border',
                'type'     => 'border',
                'color_alpha'  => true,
                'title'    => esc_html__('Input Border', 'templaza-framework'),
                'default'  => '',
                'required' => array('stacked-divided-background', '=' , true)
            ),
            array(
                'id'        => 'stacked-divided-inner-width',
                'type'      => 'select',
                'title'     =>  esc_html__('Max Width', 'templaza-framework'),
                'options' => array(
                    'default'   => esc_html__('Default', 'templaza-framework'),
                    'xsmall'    => esc_html__('XSmall', 'templaza-framework'),
                    'small'     => esc_html__('Small', 'templaza-framework'),
                    'large'     => esc_html__('Large', 'templaza-framework'),
                    'xlarge'    => esc_html__('XLarge', 'templaza-framework'),
                    'expand'    => esc_html__('Expand', 'templaza-framework'),
                    'none'      => esc_html__('None', 'templaza-framework'),
                ),
                'default'       => 'none',
                'required' => array('stacked-divided-background', '=' , true)
            ),
            array(
                'id'        => 'stacked-icon-position',
                'type'      => 'select',
                'title'     =>  esc_html__('Icon Position', 'templaza-framework'),
                'options' => array(
                    'top'   => esc_html__('Top', 'templaza-framework'),
                    'bottom'    => esc_html__('Bottom', 'templaza-framework'),
                ),
                'default'       => 'top',
                'required' => array('header-stacked-menu-mode', '=' , 'divided')
            ),
            array(
                'id'       => 'header-menu',
                'type'     => 'select',
                'data'     => 'menu_locations',
                'title'    => __( 'Site Menu', 'templaza-framework' ),
                'subtitle' => __( 'Select Site Menu.', 'templaza-framework' ),
                'default'  => 'header',
            ),
            array(
                'id'       => 'header-menu-level',
                'type'     => 'spinner',
                'title'    => __( 'Menu Level', 'templaza-framework' ),
                'subtitle' => __( 'Level to rendering the menu at. Setting levels to the same level will only display that single level.', 'templaza-framework' ),
                'min'      => 0,
                'step'     => 1,
                'max'      => 10,
                'default'  => 0,
            ),
            array(
                'id'       => 'header-mobile-menu',
                'type'     => 'select',
                'data'     => 'menu_locations',
                'title'    => __( 'Mobile Menu', 'templaza-framework' ),
                'subtitle' => __( 'Select Mobile Menu.', 'templaza-framework' ),
                'default'  => 'header',
            ),
            array(
                'id'       => 'header-mobile-menu-level',
                'type'     => 'spinner',
                'title'    => __( 'Mobile Menu Level', 'templaza-framework' ),
                'subtitle' => __( 'Level to rendering the menu at. Setting levels to the same level will only display that single level.', 'templaza-framework' ),
                'min'      => 0,
                'step'     => 1,
                'max'      => 10,
                'default'  => 0,
            ),
            array(
                'id'       => 'header-absolute',
                'type'     => 'switch',
                'title'    => __( 'Header Display Absolute', 'templaza-framework' ),
                'subtitle' => __( 'Enable header display absolute.', 'templaza-framework' ),
                'default'  => false,
                'required' => array(
                    array('header-mode', '!=', 'sidebar'),
                ),
            ),

            // -> START Logo
            array(
                'id'       => 'section-logo',
                'type'     => 'section',
                'title'      => __( 'Logo', 'templaza-framework' ),
                'subtitle'       => __( 'You can select a logo for desktop view, mobile view and sticky header.', 'templaza-framework' ),
                'indent'   => true, // Indent all options below until the next 'section' option is set.
            ),
            array(
                'id'       => 'logo-type',
                'type'     => 'button_set',
                'title'    => __( 'Logo Type', 'templaza-framework' ),
                'subtitle' => __( 'Select logo type.', 'templaza-framework' ),
                'options'  => array(
                    'image' => esc_html__('Image', 'templaza-framework'),
                    'text'  => esc_html__('Text', 'templaza-framework'),
                    'none'  => esc_html__('None', 'templaza-framework'),
                ),
                'default'  => 'image',
            ),
            array(
                'id'       => 'default-logo',
                'type'     => 'media',
                'url'      => true,
                'title'    => __( 'Default Logo', 'templaza-framework' ),
                'compiler' => 'true',
                'desc'     => __( 'Basic media uploader with disabled URL input field.', 'templaza-framework' ),
                'subtitle' => __( 'Select an image for your logo.', 'templaza-framework' ),
                'required' => array(
                    array('logo-type', '=', 'image') ),
            ),
            array(
                'id'       => 'logo_size',
                'type'     => 'dimensions',
                'units'    => array('em','px'),
                'title'    => esc_html__('Logo (Width/Height) Option', 'templaza-framework'),
                'subtitle' => esc_html__('Allow your users to choose width, height, and/or unit. Empty is auto value', 'templaza-framework'),
            ),
            array(
                'id'       => 'mobile-logo-hide',
                'type'     => 'switch',
                'title'    => esc_html__( 'Hide logo on mobile', 'templaza-framework' ),
                'default'  => false,
            ),
            array(
                'id'       => 'mobile-logo',
                'type'     => 'media',
                'url'      => true,
                'title'    => __( 'Mobile Logo', 'templaza-framework' ),
                'compiler' => 'true',
                'desc'     => __( 'Basic media uploader with disabled URL input field.', 'templaza-framework' ),
                'subtitle' => __( 'Select an image for your mobile logo.', 'templaza-framework' ),
                'required' => array(
                    array('logo-type', '=', 'image') ),
            ),
            array(
                'id'       => 'mobi_logo_size',
                'type'     => 'dimensions',
                'units'    => array('em','px'),
                'title'    => esc_html__('Mobile Logo (Width/Height) Option', 'templaza-framework'),
                'subtitle' => esc_html__('Allow your users to choose width, height, and/or unit. Empty is auto value', 'templaza-framework'),
                'required' => array(
                    array('mobile-logo-hide', '!=', '1') ),
            ),

            array(
                'id'       => 'sidebar-logo',
                'type'     => 'media',
                'url'      => true,
                'title'    => __( 'Sidebar Logo', 'templaza-framework' ),
                'compiler' => 'true',
                'desc'     => __( 'This logo will appear when sidebar is collapsed.', 'templaza-framework' ),
                'subtitle' => __( 'Select an image for your sidebar logo.', 'templaza-framework' ),
                'required' => array(
                    array('header-mode', '=', 'sidebar') ),
            ),
            array(
                'id'    => 'logo-text',
                'type'  => 'text',
                'title'    => __('Logo Text', 'templaza-framework'),
                'subtitle' => __( 'Enter Logo Text.', 'templaza-framework' ),
                'required' => array(
                    array('logo-type', '=', 'text') ),
            ),
            array(
                'id'    => 'tag-line',
                'type'  => 'text',
                'title'    => __('Tag Line', 'templaza-framework'),
                'subtitle' => __( 'Enter Tag Line.', 'templaza-framework' ),
                'required' => array(
                    array('logo-type', '=', 'text') ),
            ),

            // -> START Sticky Header
            array(
                'id'       => 'section-sticky-header',
                'type'     => 'section',
                'required' => array(
                    array('header-mode', '!=','sidebar'),
                ),
                'title'    => __( 'Sticky', 'templaza-framework' ),
                'subtitle' => __( 'Here you can select the type of the Sticky Header for desktop view, tablet view and mobile view.', 'templaza-framework' ),
                'indent'   => true, // Indent all options below until the next 'section' option is set.
            ),
            array(
                'id'       => 'enable-sticky',
                'type'     => 'switch',
                'required' => array(
                    array('header-mode', '!=', 'sidebar'),
                ),
                'title'    => __( 'Enable Sticky', 'templaza-framework' ),
                'subtitle' => __( 'Enable Sticky Header.', 'templaza-framework' ),
                'default'  => true,
            ),
            array(
                'id'    => 'sticky-menu-mode',
                'type'  => 'image_select',
                //            'tiles'    => true,
                'title'    => __('Sticky Menu Mode', 'templaza-framework'),
                'subtitle' => __( 'Select your horizontal menu mode. Select between left, right or center menu.', 'templaza-framework' ),
                'required' => array(
                    array('enable-sticky', '=', '1') ),
                'options'  => array(
                    'left' => array(
                        'alt'   => __('Left', 'templaza-framework'),
                        'title' => __('Left', 'templaza-framework'),
                        'class' => 'w-px-150 h-px-103',
                        'img'   => Functions::get_my_frame_url().'/options/patterns/horizontal-left.svg',
                    ),
                    'center' => array(
                        'alt'   => __('Center', 'templaza-framework'),
                        'title' => __('Center', 'templaza-framework'),
                        'class' => 'w-px-150 h-px-103',
                        'img'   => Functions::get_my_frame_url().'/options/patterns/horizontal-center.svg',
                    ),
                    'right' => array(
                        'alt'   => __('Right', 'templaza-framework'),
                        'title' => __('Right', 'templaza-framework'),
                        'class' => 'w-px-150 h-px-103',
                        'img'   => Functions::get_my_frame_url().'/options/patterns/horizontal-right.svg',
                    ),
                ),
                'default'  => 'left',
            ),
            array(
                'id'        => 'sticky-max-width',
                'type'      => 'select',
                'title'     =>  esc_html__('Sticky Max Width', 'templaza-framework'),
                'options' => array(
                    'default'   => esc_html__('Default', 'templaza-framework'),
                    'xsmall'    => esc_html__('XSmall', 'templaza-framework'),
                    'small'     => esc_html__('Small', 'templaza-framework'),
                    'large'     => esc_html__('Large', 'templaza-framework'),
                    'xlarge'    => esc_html__('XLarge', 'templaza-framework'),
                    'expand'    => esc_html__('Expand', 'templaza-framework'),
                    'none'      => esc_html__('None', 'templaza-framework'),
                ),
                'default'       => 'none',
                'required' => array(
                    array('enable-sticky', '=', '1') ),
            ),
            array(
                'id'       => 'sticky-padding',
                'type'     => 'spacing',
                'allow_responsive'    => true,
                'title'    => esc_html__('Sticky Padding', 'templaza-framework'),
                'default'  => '',
                'required' => array(
                    array('enable-sticky', '=', '1') ),
            ),
            array(
                'id'       => 'sticky-border',
                'type'     => 'border',
                'title'    => esc_html__('Sticky Border', 'templaza-framework'),
                'default'  => '',
                'color_alpha'  => true,
                'required' => array(
                    array('enable-sticky', '=', '1') ),
            ),
            array(
                'id'       => 'sticky-logo',
                'type'     => 'media',
                'url'      => true,
                'title'    => __( 'Sticky Logo', 'templaza-framework' ),
                'compiler' => 'true',
                'desc'     => __( 'Basic media uploader with disabled URL input field.', 'templaza-framework' ),
                'subtitle' => __( 'Select an image for your sticky header logo.', 'templaza-framework' ),
                'required' => array(
                    array('enable-sticky', '=', '1') ),
            ),
            array(
                'id'       => 'sticky-desktop',
                'type'     => 'select',
                'title'    => __( 'Sticky on Desktop', 'templaza-framework' ),
                'subtitle' => __( 'Select the type of the Sticky Header for Desktop.', 'templaza-framework' ),
                //Must provide key => value pairs for select options
                'options'  => array(
                    'sticky'         => __('Sticky', 'templaza-framework'),
                    'stickyonscroll' => __('Sticky On Scroll Up', 'templaza-framework'),
                ),
                'select2'       => array( 'allowClear' => false ),
                'default'  => 'sticky',
                'required' => array(
                    array('enable-sticky', '=', '1') ),
            ),
            array(
                'id'       => 'sticky-tablet',
                'type'     => 'select',
                'title'    => __( 'Sticky on Tablets', 'templaza-framework' ),
                'subtitle' => __( 'Select the type of the Sticky Header for Tablet.', 'templaza-framework' ),
                //Must provide key => value pairs for select options
                'options'  => array(
                    'static'         => __('Static', 'templaza-framework'),
                    'sticky'         => __('Sticky', 'templaza-framework'),
                    'stickyonscroll' => __('Sticky On Scroll Up', 'templaza-framework'),
                ),
                'select2'       => array( 'allowClear' => false ),
                'default'  => 'static',
                'required' => array(
                    array('enable-sticky', '=', '1') ),
            ),
            array(
                'id'       => 'sticky-mobile',
                'type'     => 'select',
                'title'    => __( 'Sticky on Mobile', 'templaza-framework' ),
                'subtitle' => __( 'Select the type of the Sticky Header for Mobile.', 'templaza-framework' ),
                //Must provide key => value pairs for select options
                'options'  => array(
                    'static'         => __('Static', 'templaza-framework'),
                    'sticky'         => __('Sticky', 'templaza-framework'),
                    'stickyonscroll' => __('Sticky On Scroll Up', 'templaza-framework'),
                ),
                'select2'  => array( 'allowClear' => false ),
                'default'  => 'static',
                'required' => array(
                    array('enable-sticky', '=', '1') ),
            ),

            // -> START Off Canvas Menu
            array(
                'id'       => 'section-offcanvas-menu',
                'type'     => 'section',
                'title'      => __( 'Off-Canvas menu', 'templaza-framework' ),
                'subtitle'       => __( 'Customize Off-Canvas style for your site. You must publish content to the Off-Canvas module position or you\'ll see a blank off-canvas menu.', 'templaza-framework' ),
                'required' => array(
                    array('header-mode', '!=','sidebar'),
                ),
                'indent'   => true, // Indent all options below until the next 'section' option is set.
            ),
            array(
                'id'       => 'enable-offcanvas',
                'type'     => 'switch',
                'title'    => __( 'Off-Canvas menu', 'templaza-framework' ),
                'subtitle' => __( 'Enable or disable to show or hide Off-Canvas menu.', 'templaza-framework' ),
                'default'  => false,
            ),
            array(
                'id'       => 'offcanvas-sidebar',
                'type'     => 'select',
                'data'     => 'sidebars',
                'required' => array( 'enable-offcanvas', '=', '1' ),
                'title'    => __( 'Off-Canvas Sidebar', 'templaza-framework' ),
                'subtitle' => __( 'Select Sidebar for Off-Canvas', 'templaza-framework' ),
                'default'  => '',
            ),
            array(
                'id'       => 'offcanvas-togglevisibility',
                'type'     => 'select',
                'required' => array(
                    array('enable-offcanvas', '=', '1' )
                ),
                'title'    => __( 'Toggle Visibility', 'templaza-framework' ),
                'subtitle' => __( 'Select to toggle off-canvas visibility on mobile or desktop.', 'templaza-framework' ),
                //Must provide key => value pairs for select options
                'options'  => array(
                    'd-block'           => __('Always', 'templaza-framework'),
                    'd-block d-sm-none' => __('Only on X-Small Devices', 'templaza-framework'),
                    'd-block d-md-none' => __('Upto Small Devices', 'templaza-framework'),
                    'd-block d-lg-none' => __('Upto Medium Devices', 'templaza-framework'),
                    'd-block d-xl-none' => __('Upto Large Devices', 'templaza-framework'),
                    'd-none d-xl-block' => __('Upto Only on X-Large Devices', 'templaza-framework'),
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
                'title'    => __( 'Panel Width', 'templaza-framework' ),
                'subtitle' => __( 'Set off-canvas size in rem, em, px or percentage unit values.', 'templaza-framework' ),
                'default'  => '320px'
            ),
            array(
                'id'       => 'offcanvas-animation',
                'type'     => 'select',
                'required' => array(
                    array('enable-offcanvas', '=', '1' )
                ),
                'title'    => __( 'Off-Canvas Animation', 'templaza-framework' ),
                'subtitle' => __( 'Select an animation for Off-canvas Menu from dropdown options.', 'templaza-framework' ),
                //Must provide key => value pairs for select options
                'options'  => array(
                    'st-effect-1' => __('Slide in On Top', 'templaza-framework'),
                    'st-effect-2' => __('Reveal', 'templaza-framework'),
                    'st-effect-3' => __('Push', 'templaza-framework'),
                ),
                'default'  => 'st-effect-1',
                'select2'  => array( 'allowClear' => false ),
            ),
            array(
                'id'       => 'offcanvas-direction',
                'type'     => 'select',
                'title'    => __( 'Off-Canvas Direction', 'templaza-framework' ),
                'subtitle' => __( 'Select the direction for Off-canvas Menu', 'templaza-framework' ),
                'options'  => array(
                    'offcanvasDirLeft'  => esc_html__('Left', 'templaza-framework'),
                    'offcanvasDirRight' => esc_html__('Right', 'templaza-framework'),
                ),
                'select2'       => array( 'allowClear' => false ),
                'default'       => 'offcanvasDirLeft',
                'required' => array(
                    array('enable-offcanvas', '=', '1' )
                ),
            ),

            // -> START Animation
            array(
                'id'         => 'section-dropdown-animation',
                'title'      => __( 'Dropdown Animation', 'templaza-framework' ),
                'desc'       => __( 'Customize dropdown animation for mega/dropdown menu.', 'templaza-framework' ),
                'type'     => 'section',
                'indent'   => true, // Indent all options below until the next 'section' option is set.
                'required' => array(
                    array('header-mode', '!=','sidebar'),
                ),
            ),
            array(
                'id'       => 'dropdown-animation-type',
                'type'     => 'button_set',
                'title'    => __( 'Animation', 'templaza-framework' ),
                //Must provide key => value pairs for select options
                'options'  => array(
                    'fade'  => __('On', 'templaza-framework'),
                    'none'  => __('Off', 'templaza-framework'),
//                    'slide' => __('Slide', 'templaza-framework'),
                ),
                'default'  => 'fade',
            ),
            array(
                'id'       => 'dropdown-animation-effect',
                'type'     => 'select',
                'title'    => __( 'Effect', 'templaza-framework' ),
                //Must provide key => value pairs for select options
                'options'  => array(
                    'fade-down'  => __('Fade Down', 'templaza-framework'),
                    'fade-left'  => __('Fade Left', 'templaza-framework'),
                    'fade-right' => __('Fade Right', 'templaza-framework'),
                    'fade-up'    => __('Fade Up', 'templaza-framework'),
                    'rotate-x'   => __('Rotate X', 'templaza-framework'),
                    'rotate-y'   => __('Rotate Y', 'templaza-framework'),
                ),
                'select2'  => array( 'allowClear' => false ),
                'default'  => 'fade-down',
                'required' => array(
                    array('header-mode', '!=', 'sidebar'),
                    array('dropdown-animation-type', '!=', 'none')
                ),
            ),
            array(
                'id'       => 'dropdown-arrow',
                'type'     => 'switch',
                'required' => array(
                    array('header-mode', '!=', 'sidebar' ),
                ),
                'title'    => __( 'Dropdown Arrow', 'templaza-framework' ),
                'subtitle' => __( 'Enable or Disable if you want to show the dropdown arrow', 'templaza-framework' ),
                'default'  => true,
            ),
            array(
                'id'       => 'dropdown-trigger',
                'type'     => 'button_set',
                'required' => array(
                    array('header-mode', '!=', 'sidebar' ),
                ),
                'title'    => __( 'Dropdown Trigger', 'templaza-framework' ),
                'subtitle' => __( 'Choose the action for the menu items to view the megamenu', 'templaza-framework' ),
                'options' => array(
                    'hover' => __('Hover', 'templaza-framework'),
                    'click' => __('Click', 'templaza-framework'),
                ),
                'default'  => 'hover',
            ),
            array(
                'id'     => 'section-end',
                'type'   => 'section',
                'indent' => false, // Indent all options below until the next 'section' option is set.
            ),

            // -> START Header icon
            array(
                'id'         => 'section-header-icon',
                'title'      => __( 'Header Icon', 'templaza-framework' ),
                'type'     => 'section',
                'indent'   => true, // Indent all options below until the next 'section' option is set.

            ),
            array(
                'id'       => 'stacked-divided-search',
                'type'     => 'switch',
                'title'    => esc_html__( 'Show search icon', 'templaza-framework' ),
                'default'  => true,
            ),
            array(
                'id'       => 'stacked-divided-account',
                'type'     => 'switch',
                'title'    => esc_html__( 'Show account icon', 'templaza-framework' ),
                'default'  => true,
            ),
            array(
                'id'       => 'stacked-divided-cart',
                'type'     => 'switch',
                'title'    => esc_html__( 'Show cart icon', 'templaza-framework' ),
                'default'  => true,
            ),
            array(
                'id'        => 'search-icon-type',
                'type'      => 'select',
                'title'     =>  esc_html__('Search Icon Type', 'templaza-framework'),
                'options' => array(
                    'default'   => esc_html__('Default', 'templaza-framework'),
                    'fontawesome'    => esc_html__('fontawesome', 'templaza-framework'),
                    'custom'     => esc_html__('Custom', 'templaza-framework'),
                ),
                'default'       => 'default',
                'required' => array( 'stacked-divided-search', '=', true ),
            ),
            array(
                'id'          => 'search-icon',
                'type'        => 'select',
                'title'       => esc_html__( 'Search icon', 'templaza-framework' ),
                'data'        => 'fontawesome',
                'required'    => array( 'search-icon-type', '=', 'fontawesome' ),
            ),
            array(
                'id'       => 'search-icon-custom',
                'type'     => 'media',
                'url'      => true,
                'title'    => esc_html__( 'Search icon', 'templaza-framework' ),
                'compiler' => 'true',
                'required' => array( 'search-icon-type', '=', 'custom' ),
            ),
            array(
                'id'        => 'account-icon-type',
                'type'      => 'select',
                'title'     =>  esc_html__('Account Icon Type', 'templaza-framework'),
                'options' => array(
                    'default'   => esc_html__('Default', 'templaza-framework'),
                    'fontawesome'    => esc_html__('fontawesome', 'templaza-framework'),
                    'custom'     => esc_html__('Custom', 'templaza-framework'),
                ),
                'default'       => 'default',
                'required' => array( 'stacked-divided-account', '=', true ),
            ),
            array(
                'id'          => 'account-icon',
                'type'        => 'select',
                'title'       => esc_html__( 'Account icon', 'templaza-framework' ),
                'data'        => 'fontawesome',
                'required'    => array( 'account-icon-type', '=', 'fontawesome' ),
            ),
            array(
                'id'       => 'account-icon-custom',
                'type'     => 'media',
                'url'      => true,
                'title'    => esc_html__( 'Account icon', 'templaza-framework' ),
                'compiler' => 'true',
                'required' => array( 'account-icon-type', '=', 'custom' ),
            ),
            array(
                'id'        => 'cart-icon-type',
                'type'      => 'select',
                'title'     =>  esc_html__('Cart Icon Type', 'templaza-framework'),
                'options' => array(
                    'default'   => esc_html__('Default', 'templaza-framework'),
                    'fontawesome'    => esc_html__('fontawesome', 'templaza-framework'),
                    'custom'     => esc_html__('Custom', 'templaza-framework'),
                ),
                'default'       => 'default',
                'required' => array( 'stacked-divided-cart', '=', true ),
            ),
            array(
                'id'          => 'cart-icon',
                'type'        => 'select',
                'title'       => esc_html__( 'Cart icon', 'templaza-framework' ),
                'data'        => 'fontawesome',
                'required'    => array( 'cart-icon-type', '=', 'fontawesome' ),
            ),
            array(
                'id'       => 'cart-icon-custom',
                'type'     => 'media',
                'url'      => true,
                'title'    => esc_html__( 'Cart icon', 'templaza-framework' ),
                'compiler' => 'true',
                'required' => array( 'cart-icon-type', '=', 'custom' ),
            ),
            array(
                'id'       => 'header-icon-size',
                'type'     => 'text',
                'title'    => __( 'Icon Size', 'templaza-framework' ),
                'subtitle' => __( 'Set icon size in rem, em, px or percentage unit values.', 'templaza-framework' ),
                'default'  => ''
            ),

        ),
    )
);