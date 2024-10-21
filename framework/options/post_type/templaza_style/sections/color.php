<?php

defined('TEMPLAZA_FRAMEWORK') or exit();

// -> START Color Selection
Templaza_API::set_section('templaza_style', array(
        'title' => __( 'Colors', 'templaza-framework'),
        'id'    => 'colors',
        'desc'  => __('Color Settings', 'templaza-framework' ),
        'icon'  => 'el el-brush'
    )
);

Templaza_API::set_section('templaza_style',
    array(
        'title'      => __( 'Body', 'templaza-framework' ),
        'id'         => 'colors-body',
        'desc'       => __( 'Select colors for Body ', 'templaza-framework' ),
        'subsection' => true,
        'fields'     => array(
            array(
                'id'       => 'body-background-color',
                'type'     => 'color_rgba',
                'title'    => __( 'Background Color', 'templaza-framework' ),
                'subtitle' => __( 'Select the background color for boxed layout.', 'templaza-framework' ),
            ),
            array(
                'id'                => 'body-background-image',
                'type'              => 'background',
                'title'             => __( 'Background Image', 'templaza-framework' ),
                'subtitle'          => __( 'Select the background color for boxed layout.', 'templaza-framework' ),
                'background-color'  => false,
            ),
            array(
                'id'       => 'body-text-color',
                'type'     => 'color_rgba',
                'title'    => __( 'Text Color', 'templaza-framework' ),
                'subtitle' => __( 'Set the color of the text for the website.', 'templaza-framework' ),
            ),
            array(
                'id'       => 'body-heading-color',
                'type'     => 'color_rgba',
                'title'    => __( 'Heading Color', 'templaza-framework' ),
                'subtitle' => __( 'Set colors for h1,h2,h3,h4,h5,h6', 'templaza-framework' ),
            ),
            array(
                'id'       => 'body-link-color',
                'type'     => 'color_rgba',
                'title'    => __( 'Link Color', 'templaza-framework' ),
                'subtitle' => __( 'Set the color of the links on the website.', 'templaza-framework' ),
            ),
            array(
                'id'       => 'body-link-hover-color',
                'type'     => 'color_rgba',
                'title'    => __( 'Link Hover Color', 'templaza-framework' ),
                'subtitle' => __( 'Set the hover color of the text links.', 'templaza-framework' ),
            ),
        ),
    )
);
// -> START Header Color
Templaza_API::set_section('templaza_style',
    array(
        'title'      => __( 'Header', 'templaza-framework' ),
        'id'         => 'colors-header',
        'desc'       => __( 'Select colors for the Header', 'templaza-framework' ),
        'subsection' => true,
        'fields'     => array(
            array(
                'id'       => 'header-bg',
                'type'     => 'color_rgba',
                'title'    => __( 'Background Color', 'templaza-framework' ),
                'subtitle' => __( 'Select the color for header background.', 'templaza-framework' ),
            ),
            array(
                'id'       => 'header-text-color',
                'type'     => 'color_rgba',
                'title'    => __( 'Text Color', 'templaza-framework' ),
                'subtitle' => __( 'Set the color of the text for the header', 'templaza-framework' ),
            ),
            array(
                'id'       => 'header-heading-color',
                'type'     => 'color_rgba',
                'title'    => __( 'Heading Color', 'templaza-framework' ),
                'subtitle' => __( 'Set colors for h1,h2,h3,h4,h5,h6', 'templaza-framework' ),
            ),
            array(
                'id'       => 'header-link-color',
                'type'     => 'color_rgba',
                'title'    => __( 'Link Color', 'templaza-framework' ),
                'subtitle' => __( 'Set the color of the links on the header.', 'templaza-framework' ),
            ),
            array(
                'id'       => 'header-link-hover-color',
                'type'     => 'color_rgba',
                'title'    => __( 'Link Hover Color', 'templaza-framework' ),
                'subtitle' => __( 'Set the hover color of the text links.', 'templaza-framework' ),
            ),
            array(
                'id'       => 'header-logo-text-color',
                'type'     => 'color_rgba',
                'title'    => __( 'Logo Text Color', 'templaza-framework' ),
                'subtitle' => __( 'Set the color of the text in logo', 'templaza-framework' ),
            ),
            array(
                'id'       => 'header-logo-text-tagline-color',
                'type'     => 'color_rgba',
                'title'    => __( 'Logo Tag Line Color', 'templaza-framework' ),
                'subtitle' => __( 'Set the color of the logo tagline text', 'templaza-framework' ),
            ),
            array(
                'id'       => 'topbar-bordercolor',
                'type'     => 'color_rgba',
                'title'    => __( 'Top-bar Border Color', 'templaza-framework' ),
                'subtitle' => __( 'Select border color for top bar.', 'templaza-framework' ),
            ),
            array(
                'id'       => 'background-logo-section',
                'type'     => 'color_rgba',
                'title'    => esc_html__( 'Background Logo Section', 'templaza-framework' ),
            ),
            array(
                'id'       => 'background-stacked-top-section',
                'type'     => 'color_rgba',
                'title'    => esc_html__( 'Background Stacked Top Section', 'templaza-framework' ),
                'default'  => '',
            ),
            array(
                'id'       => 'color-stacked-top-section',
                'type'     => 'color_rgba',
                'title'    => esc_html__( 'Stacked Top Section Color', 'templaza-framework' ),
                'default'  => '',
            ),
            array(
                'id'       => 'background-menu-section',
                'type'     => 'color_rgba',
                'title'    => esc_html__( 'Background Menu Section', 'templaza-framework' ),
            ),
            array(
                'id'       => 'header-icon-color',
                'type'     => 'color_rgba',
                'title'    => esc_html__( 'Header icon color', 'templaza-framework' ),
            ),
        ),
    )
);
// -> START Main Menu Color
Templaza_API::set_section('templaza_style',
    array(
        'title'      => __( 'Main Menu', 'templaza-framework' ),
        'id'         => 'colors-main-menu',
        'desc'       => __( 'Select colors for the Header', 'templaza-framework' ),
        'subsection' => true,
        'fields'     => array(
            array(
                'id'       => 'main-menu-link-color',
                'type'     => 'color_rgba',
                'title'    => __( 'Link Color', 'templaza-framework' ),
                'subtitle' => __( 'Set the color of the menu items text', 'templaza-framework' ),
            ),
            array(
                'id'       => 'main-menu-link-active-color',
                'type'     => 'color_rgba',
                'title'    => __( 'Link Active Color', 'templaza-framework' ),
                'subtitle' => __( 'Set the color of active menu item.', 'templaza-framework' ),
            ),
            array(
                'id'       => 'main-menu-link-hover-color',
                'type'     => 'color_rgba',
                'title'    => __( 'Link Hover Color', 'templaza-framework' ),
                'subtitle' => __( 'Set the color of the menu item on hover', 'templaza-framework' ),
            ),
            array(
                'id'       => 'main-menu-border-color',
                'type'     => 'color_rgba',
                'title'    => __( 'Link Border Hover Color', 'templaza-framework' ),
                'subtitle' => __( 'Set the color of the menu item border on hover', 'templaza-framework' ),
            ),
            array(
                'id'       => 'sidebar-separate-color',
                'type'     => 'color_rgba',
                'title'    => __( 'Sidebar Separate Color', 'templaza-framework' ),
                'subtitle' => __( 'Set colors for separate menu of Sidebar', 'templaza-framework' ),
            ),
        ),
    )
);
// -> START Sticky Menu Color
Templaza_API::set_section('templaza_style',
    array(
        'title'      => __( 'Sticky Menu', 'templaza-framework' ),
        'id'         => 'colors-sticky-menu',
        'desc'       => __( 'Select colors for the Sticky Menu', 'templaza-framework' ),
        'subsection' => true,
        'fields'     => array(
            array(
                'id'       => 'sticky-header-background-color',
                'type'     => 'color_rgba',
                'title'    => __( 'Background Color', 'templaza-framework' ),
                'subtitle' => __( 'Select the background color of the Sticky Header.', 'templaza-framework' ),
            ),
            array(
                'id'       => 'sticky-menu-link-color',
                'type'     => 'color_rgba',
                'title'    => __( 'Link Color', 'templaza-framework' ),
                'subtitle' => __( 'Set the color of the menu items text', 'templaza-framework' ),
            ),
            array(
                'id'       => 'sticky-menu-link-active-color',
                'type'     => 'color_rgba',
                'title'    => __( 'Link Active Color', 'templaza-framework' ),
                'subtitle' => __( 'Set the color of active menu item.', 'templaza-framework' ),
            ),
            array(
                'id'       => 'sticky-menu-link-hover-color',
                'type'     => 'color_rgba',
                'title'    => __( 'Link Hover Color', 'templaza-framework' ),
                'subtitle' => __( 'Set the color of the menu item on hover', 'templaza-framework' ),
            ),
            array(
                'id'       => 'sticky-off-canvas-button-color',
                'type'     => 'color_rgba',
                'title'    => __( 'Off Canvas Button', 'templaza-framework' ),
                'subtitle' => __( 'Set the color of offcanvas button', 'templaza-framework' ),
            ),
            array(
                'id'       => 'sticky-icon-color',
                'type'     => 'color_rgba',
                'title'    => __( 'Icon color', 'templaza-framework' ),
                'subtitle' => __( 'Set the color of icon', 'templaza-framework' ),
            ),
        ),
    )
);
// -> START Dropdown Menu Color
Templaza_API::set_section('templaza_style',
    array(
        'title'      => __( 'Dropdown Menu', 'templaza-framework' ),
        'id'         => 'colors-dropdown-menu',
        'desc'       => __( 'Select colors for the Dropdown Menu', 'templaza-framework' ),
        'subsection' => true,
        'fields'     => array(
            array(
                'id'       => 'dropdown-menu-background-color',
                'type'     => 'color_rgba',
                'title'    => __( 'Background Color', 'templaza-framework' ),
                'subtitle' => __( 'Set the background color of the dropdown', 'templaza-framework' ),
            ),
            array(
                'id'       => 'dropdown-menu-link-color',
                'type'     => 'color_rgba',
                'title'    => __( 'Link Color', 'templaza-framework' ),
                'subtitle' => __( 'Set the sub menu item text colour', 'templaza-framework' ),
            ),
            array(
                'id'       => 'dropdown-menu-link-active-color',
                'type'     => 'color_rgba',
                'title'    => __( 'Link Active Color', 'templaza-framework' ),
                'subtitle' => __( 'Set the color of the sub-menu item’s active text link', 'templaza-framework' ),
            ),
            array(
                'id'       => 'dropdown-menu-active-bg-color',
                'type'     => 'color_rgba',
                'title'    => __( 'Active Background Color', 'templaza-framework' ),
                'subtitle' => __( 'Set the background color of the active link sub menu item', 'templaza-framework' ),
            ),
            array(
                'id'       => 'dropdown-menu-link-hover-color',
                'type'     => 'color_rgba',
                'title'    => __( 'Hover Link Color', 'templaza-framework' ),
                'subtitle' => __( 'Set the color of the menu item on hover', 'templaza-framework' ),
            ),
            array(
                'id'       => 'dropdown-menu-hover-bg-color',
                'type'     => 'color_rgba',
                'title'    => __( 'Hover Background Color', 'templaza-framework' ),
                'subtitle' => __( 'Set the background color on hovering a sub menu item', 'templaza-framework' ),
            ),
        ),
    )
);
// -> START Off-Canvas Menu Color
Templaza_API::set_section('templaza_style',
    array(
        'title'      => __( 'Off-Canvas Menu', 'templaza-framework' ),
        'id'         => 'colors-off-canvas-menu',
        'desc'       => __( 'Select colors for the Off-Canvas Menu', 'templaza-framework' ),
        'subsection' => true,
        'fields'     => array(
            array(
                'id'       => 'off-canvas-button-color-close',
                'type'     => 'color_rgba',
                'title'    => __( 'Off Canvas Close Button', 'templaza-framework' ),
                'subtitle' => __( 'Set the color of offcanvas Close button', 'templaza-framework' ),
            ),
            array(
                'id'       => 'off-canvas-background-color',
                'type'     => 'color_rgba',
                'title'    => __( 'Background Color', 'templaza-framework' ),
                'subtitle' => __( 'Set the background color of the offcanvas menu', 'templaza-framework' ),
            ),
            array(
                'id'       => 'off-canvas-mobile-menu-text-color',
                'type'     => 'color_rgba',
                'title'    => __( 'Text Color', 'templaza-framework' ),
                'subtitle' => __( 'Set the color of the text in the offcanvas menu', 'templaza-framework' ),
            ),
            array(
                'id'       => 'off-canvas-mobile-menu-link-color',
                'type'     => 'color_rgba',
                'title'    => __( 'Link Color', 'templaza-framework' ),
                'subtitle' => __( 'Set the menu & sub menu items text colour', 'templaza-framework' ),
            ),
            array(
                'id'       => 'off-canvas-button-color',
                'type'     => 'color_rgba',
                'title'    => __( 'Off Canvas Button', 'templaza-framework' ),
                'subtitle' => __( 'Set the color of offcanvas button', 'templaza-framework' ),
            ),
            array(
                'id'       => 'off-canvas-link-active-color',
                'type'     => 'color_rgba',
                'title'    => __( 'Link Active Color', 'templaza-framework' ),
                'subtitle' => __( 'Set the color of the sub-menu item’s active text link', 'templaza-framework' ),
            ),
            array(
                'id'       => 'off-canvas-mobile-menu-active-bg-color',
                'type'     => 'color_rgba',
                'title'    => __( 'Active Background Color', 'templaza-framework' ),
                'subtitle' => __( 'Set the background color of the active link sub menu item', 'templaza-framework' ),
            ),
        ),
    )
);
// -> START Contact Color
Templaza_API::set_section('templaza_style',
    array(
        'title'      => __( 'Contact icon', 'templaza-framework' ),
        'id'         => 'colors-contact-icon',
        'desc'       => __( 'Select colors for contact icon', 'templaza-framework' ),
        'subsection' => true,
        'fields'     => array(
            array(
                'id'       => 'contact-icon-color',
                'type'     => 'color_rgba',
                'title'    => __( 'Contact icon color', 'templaza-framework' ),
                'subtitle' => __( 'Set the color of contact icon', 'templaza-framework' ),
            ),
        ),
    )
);
// -> START Footer Color
Templaza_API::set_section('templaza_style',
    array(
        'title'      => __( 'Footer', 'templaza-framework' ),
        'id'         => 'colors-footer',
        'desc'       => __( 'Select colors for Footer', 'templaza-framework' ),
        'subsection' => true,
        'fields'     => array(
            array(
                'id'       => 'footer-link-color',
                'type'     => 'color_rgba',
                'title'    => __( 'Footer link color', 'templaza-framework' ),
                'subtitle' => __( 'Set color link in footer', 'templaza-framework' ),
            ),
            array(
                'id'       => 'footer-link-color-hover',
                'type'     => 'color_rgba',
                'title'    => __( 'Footer link hover color', 'templaza-framework' ),
                'subtitle' => __( 'Set color link hover in footer', 'templaza-framework' ),
            ),

        ),
    )
);