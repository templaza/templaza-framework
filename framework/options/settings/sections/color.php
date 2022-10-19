<?php

defined('TEMPLAZA_FRAMEWORK') or exit();

// -> START Color Selection
Templaza_API::set_section('settings', array(
        'title' => __( 'Colors', 'templaza-framework'),
        'id'    => 'colors',
        'desc'  => __( '', 'templaza-framework' ),
        'icon'  => 'el el-brush'
    )
);

Templaza_API::set_section('settings',
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
Templaza_API::set_section('settings',
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
                'title'    => esc_html__( 'Background Logo Section', 'tzautoshowroom' ),
                'default'  => '',
            ),
            array(
                'id'       => 'background-menu-section',
                'type'     => 'color_rgba',
                'title'    => esc_html__( 'Background Menu Section', 'tzautoshowroom' ),
                'default'  => '',
            ),
            array(
                'id'       => 'header-icon-color',
                'type'     => 'color_rgba',
                'title'    => esc_html__( 'Header icon color', 'tzautoshowroom' ),
                'default'  => '',
            ),
        ),
    )
);
// -> START Main Menu Color
Templaza_API::set_section('settings',
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
                'id'       => 'sidebar-separate-color',
                'type'     => 'color_rgba',
                'title'    => __( 'Sidebar Separate Color', 'templaza-framework' ),
                'subtitle' => __( 'Set colors for separate menu of Sidebar', 'templaza-framework' ),
            ),
        ),
    )
);
// -> START Sticky Menu Color
Templaza_API::set_section('settings',
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
Templaza_API::set_section('settings',
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
Templaza_API::set_section('settings',
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
Templaza_API::set_section('settings',
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
// -> START Button Color
Templaza_API::set_section('settings',
    array(
        'title'      => __( 'Button', 'templaza-framework' ),
        'id'         => 'colors-button',
        'desc'       => __( 'Select colors for Button', 'templaza-framework' ),
        'subsection' => true,
        'fields'     => array(
            array(
                'id'       => 'button-background-color',
                'type'     => 'color_rgba',
                'title'    => __( 'Button background color', 'templaza-framework' ),
                'subtitle' => __( 'Set background color button', 'templaza-framework' ),
            ),
            array(
                'id'       => 'button-color',
                'type'     => 'color_rgba',
                'title'    => __( 'Button color', 'templaza-framework' ),
                'subtitle' => __( 'Set color button', 'templaza-framework' ),
            ),
            array(
                'id'       => 'button-background-color-hover',
                'type'     => 'color_rgba',
                'title'    => __( 'Button hover background color', 'templaza-framework' ),
                'subtitle' => __( 'Set background color button hover', 'templaza-framework' ),
            ),
            array(
                'id'       => 'button-color-hover',
                'type'     => 'color_rgba',
                'title'    => __( 'Button color hover', 'templaza-framework' ),
                'subtitle' => __( 'Set color button hover', 'templaza-framework' ),
            ),
        ),
    )
);
// -> START WooCommerce Color
Templaza_API::set_section('settings',
    array(
        'title'      => __( 'WooCommerce Color', 'templaza-framework' ),
        'id'         => 'woo-color',
        'desc'       => __( 'Config color on WooCommerce page', 'templaza-framework' ),
        'subsection' => true,
        'fields'     => array(
            array(
                'id'       => 'woo-catalog-icon-bg-color',
                'type'     => 'color_rgba',
                'title'    => __( 'Catalog icon background color', 'templaza-framework' ),
                'subtitle' => __( 'Set background color icon', 'templaza-framework' ),
            ),
            array(
                'id'       => 'woo-catalog-icon-color',
                'type'     => 'color_rgba',
                'title'    => __( 'Catalog icon color', 'templaza-framework' ),
                'subtitle' => __( 'Set color icon', 'templaza-framework' ),
            ),
            array(
                'id'       => 'woo-catalog-icon-bg-color-hover',
                'type'     => 'color_rgba',
                'title'    => __( 'Catalog icon background color hover', 'templaza-framework' ),
                'subtitle' => __( 'Set background color icon hover', 'templaza-framework' ),
            ),
            array(
                'id'       => 'woo-catalog-icon-color-hover',
                'type'     => 'color_rgba',
                'title'    => __( 'Catalog icon color hover', 'templaza-framework' ),
                'subtitle' => __( 'Set color icon hover', 'templaza-framework' ),
            ),
        ),
    )
);