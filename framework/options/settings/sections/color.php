<?php

defined('TEMPLAZA_FRAMEWORK') or exit();

// -> START Color Selection
Templaza_API::set_section('settings', array(
        'title' => __( 'Colors', $this -> text_domain),
        'id'    => 'colors',
        'desc'  => __( '', $this -> text_domain ),
        'icon'  => 'el el-brush'
    )
);

Templaza_API::set_section('settings',
    array(
        'title'      => __( 'Body', $this -> text_domain ),
        'id'         => 'colors-body',
        'desc'       => __( 'Select colors for Body ', $this -> text_domain ),
        'subsection' => true,
        'fields'     => array(
            array(
                'id'       => 'body-background-color',
                'type'     => 'color_rgba',
                'title'    => __( 'Background Color', $this -> text_domain ),
                'subtitle' => __( 'Select the background color for boxed layout.', $this -> text_domain ),
            ),
            array(
                'id'                => 'body-background-image',
                'type'              => 'background',
                'title'             => __( 'Background Image', $this -> text_domain ),
                'subtitle'          => __( 'Select the background color for boxed layout.', $this -> text_domain ),
                'background-color'  => false,
            ),
            array(
                'id'       => 'body-text-color',
                'type'     => 'color_rgba',
                'title'    => __( 'Text Color', $this -> text_domain ),
                'subtitle' => __( 'Set the color of the text for the website.', $this -> text_domain ),
            ),
            array(
                'id'       => 'body-heading-color',
                'type'     => 'color_rgba',
                'title'    => __( 'Heading Color', $this -> text_domain ),
                'subtitle' => __( 'Set colors for h1,h2,h3,h4,h5,h6', $this -> text_domain ),
            ),
            array(
                'id'       => 'body-link-color',
                'type'     => 'color_rgba',
                'title'    => __( 'Link Color', $this -> text_domain ),
                'subtitle' => __( 'Set the color of the links on the website.', $this -> text_domain ),
            ),
            array(
                'id'       => 'body-link-hover-color',
                'type'     => 'color_rgba',
                'title'    => __( 'Link Hover Color', $this -> text_domain ),
                'subtitle' => __( 'Set the hover color of the text links.', $this -> text_domain ),
            ),
        ),
    )
);
// -> START Header Color
Templaza_API::set_section('settings',
    array(
        'title'      => __( 'Header', $this -> text_domain ),
        'id'         => 'colors-header',
        'desc'       => __( 'Select colors for the Header', $this -> text_domain ),
        'subsection' => true,
        'fields'     => array(
            array(
                'id'       => 'header-bg',
                'type'     => 'color_rgba',
                'title'    => __( 'Background Color', $this -> text_domain ),
                'subtitle' => __( 'Select the color for header background.', $this -> text_domain ),
            ),
            array(
                'id'       => 'header-text-color',
                'type'     => 'color_rgba',
                'title'    => __( 'Text Color', $this -> text_domain ),
                'subtitle' => __( 'Set the color of the text for the header', $this -> text_domain ),
            ),
            array(
                'id'       => 'header-heading-color',
                'type'     => 'color_rgba',
                'title'    => __( 'Heading Color', $this -> text_domain ),
                'subtitle' => __( 'Set colors for h1,h2,h3,h4,h5,h6', $this -> text_domain ),
            ),
            array(
                'id'       => 'header-link-color',
                'type'     => 'color_rgba',
                'title'    => __( 'Link Color', $this -> text_domain ),
                'subtitle' => __( 'Set the color of the links on the header.', $this -> text_domain ),
            ),
            array(
                'id'       => 'header-link-hover-color',
                'type'     => 'color_rgba',
                'title'    => __( 'Link Hover Color', $this -> text_domain ),
                'subtitle' => __( 'Set the hover color of the text links.', $this -> text_domain ),
            ),
            array(
                'id'       => 'header-logo-text-color',
                'type'     => 'color_rgba',
                'title'    => __( 'Logo Text Color', $this -> text_domain ),
                'subtitle' => __( 'Set the color of the text in logo', $this -> text_domain ),
            ),
            array(
                'id'       => 'header-logo-text-tagline-color',
                'type'     => 'color_rgba',
                'title'    => __( 'Logo Tag Line Color', $this -> text_domain ),
                'subtitle' => __( 'Set the color of the logo tagline text', $this -> text_domain ),
            ),
            array(
                'id'       => 'topbar-bordercolor',
                'type'     => 'color_rgba',
                'title'    => __( 'Top-bar Border Color', $this -> text_domain ),
                'subtitle' => __( 'Select border color for top bar.', $this -> text_domain ),
            ),
        ),
    )
);
// -> START Main Menu Color
Templaza_API::set_section('settings',
    array(
        'title'      => __( 'Main Menu', $this -> text_domain ),
        'id'         => 'colors-main-menu',
        'desc'       => __( 'Select colors for the Header', $this -> text_domain ),
        'subsection' => true,
        'fields'     => array(
            array(
                'id'       => 'main-menu-link-color',
                'type'     => 'color_rgba',
                'title'    => __( 'Link Color', $this -> text_domain ),
                'subtitle' => __( 'Set the color of the menu items text', $this -> text_domain ),
            ),
            array(
                'id'       => 'main-menu-link-active-color',
                'type'     => 'color_rgba',
                'title'    => __( 'Link Active Color', $this -> text_domain ),
                'subtitle' => __( 'Set the color of active menu item.', $this -> text_domain ),
            ),
            array(
                'id'       => 'main-menu-link-hover-color',
                'type'     => 'color_rgba',
                'title'    => __( 'Link Hover Color', $this -> text_domain ),
                'subtitle' => __( 'Set the color of the menu item on hover', $this -> text_domain ),
            ),
            array(
                'id'       => 'sidebar-separate-color',
                'type'     => 'color_rgba',
                'title'    => __( 'Sidebar Separate Color', $this -> text_domain ),
                'subtitle' => __( 'Set colors for separate menu of Sidebar', $this -> text_domain ),
            ),
        ),
    )
);
// -> START Sticky Menu Color
Templaza_API::set_section('settings',
    array(
        'title'      => __( 'Sticky Menu', $this -> text_domain ),
        'id'         => 'colors-sticky-menu',
        'desc'       => __( 'Select colors for the Sticky Menu', $this -> text_domain ),
        'subsection' => true,
        'fields'     => array(
            array(
                'id'       => 'sticky-header-background-color',
                'type'     => 'color_rgba',
                'title'    => __( 'Background Color', $this -> text_domain ),
                'subtitle' => __( 'Select the background color of the Sticky Header.', $this -> text_domain ),
            ),
            array(
                'id'       => 'sticky-menu-link-color',
                'type'     => 'color_rgba',
                'title'    => __( 'Link Color', $this -> text_domain ),
                'subtitle' => __( 'Set the color of the menu items text', $this -> text_domain ),
            ),
            array(
                'id'       => 'sticky-menu-link-active-color',
                'type'     => 'color_rgba',
                'title'    => __( 'Link Active Color', $this -> text_domain ),
                'subtitle' => __( 'Set the color of active menu item.', $this -> text_domain ),
            ),
            array(
                'id'       => 'sticky-menu-link-hover-color',
                'type'     => 'color_rgba',
                'title'    => __( 'Link Hover Color', $this -> text_domain ),
                'subtitle' => __( 'Set the color of the menu item on hover', $this -> text_domain ),
            ),
            array(
                'id'       => 'sticky-off-canvas-button-color',
                'type'     => 'color_rgba',
                'title'    => __( 'Off Canvas Button', $this -> text_domain ),
                'subtitle' => __( 'Set the color of offcanvas button', $this -> text_domain ),
            ),
        ),
    )
);
// -> START Dropdown Menu Color
Templaza_API::set_section('settings',
    array(
        'title'      => __( 'Dropdown Menu', $this -> text_domain ),
        'id'         => 'colors-dropdown-menu',
        'desc'       => __( 'Select colors for the Dropdown Menu', $this -> text_domain ),
        'subsection' => true,
        'fields'     => array(
            array(
                'id'       => 'dropdown-menu-background-color',
                'type'     => 'color_rgba',
                'title'    => __( 'Background Color', $this -> text_domain ),
                'subtitle' => __( 'Set the background color of the dropdown', $this -> text_domain ),
            ),
            array(
                'id'       => 'dropdown-menu-link-color',
                'type'     => 'color_rgba',
                'title'    => __( 'Link Color', $this -> text_domain ),
                'subtitle' => __( 'Set the sub menu item text colour', $this -> text_domain ),
            ),
            array(
                'id'       => 'dropdown-menu-link-active-color',
                'type'     => 'color_rgba',
                'title'    => __( 'Link Active Color', $this -> text_domain ),
                'subtitle' => __( 'Set the color of the sub-menu item’s active text link', $this -> text_domain ),
            ),
            array(
                'id'       => 'dropdown-menu-active-bg-color',
                'type'     => 'color_rgba',
                'title'    => __( 'Active Background Color', $this -> text_domain ),
                'subtitle' => __( 'Set the background color of the active link sub menu item', $this -> text_domain ),
            ),
            array(
                'id'       => 'dropdown-menu-link-hover-color',
                'type'     => 'color_rgba',
                'title'    => __( 'Hover Link Color', $this -> text_domain ),
                'subtitle' => __( 'Set the color of the menu item on hover', $this -> text_domain ),
            ),
            array(
                'id'       => 'dropdown-menu-hover-bg-color',
                'type'     => 'color_rgba',
                'title'    => __( 'Hover Background Color', $this -> text_domain ),
                'subtitle' => __( 'Set the background color on hovering a sub menu item', $this -> text_domain ),
            ),
        ),
    )
);
// -> START Off-Canvas Menu Color
Templaza_API::set_section('settings',
    array(
        'title'      => __( 'Off-Canvas Menu', $this -> text_domain ),
        'id'         => 'colors-off-canvas-menu',
        'desc'       => __( 'Select colors for the Off-Canvas Menu', $this -> text_domain ),
        'subsection' => true,
        'fields'     => array(
            array(
                'id'       => 'off-canvas-button-color-close',
                'type'     => 'color_rgba',
                'title'    => __( 'Off Canvas Close Button', $this -> text_domain ),
                'subtitle' => __( 'Set the color of offcanvas Close button', $this -> text_domain ),
            ),
            array(
                'id'       => 'off-canvas-background-color',
                'type'     => 'color_rgba',
                'title'    => __( 'Background Color', $this -> text_domain ),
                'subtitle' => __( 'Set the background color of the offcanvas menu', $this -> text_domain ),
            ),
            array(
                'id'       => 'off-canvas-mobile-menu-text-color',
                'type'     => 'color_rgba',
                'title'    => __( 'Text Color', $this -> text_domain ),
                'subtitle' => __( 'Set the color of the text in the offcanvas menu', $this -> text_domain ),
            ),
            array(
                'id'       => 'off-canvas-mobile-menu-link-color',
                'type'     => 'color_rgba',
                'title'    => __( 'Link Color', $this -> text_domain ),
                'subtitle' => __( 'Set the menu & sub menu items text colour', $this -> text_domain ),
            ),
            array(
                'id'       => 'off-canvas-button-color',
                'type'     => 'color_rgba',
                'title'    => __( 'Off Canvas Button', $this -> text_domain ),
                'subtitle' => __( 'Set the color of offcanvas button', $this -> text_domain ),
            ),
            array(
                'id'       => 'off-canvas-link-active-color',
                'type'     => 'color_rgba',
                'title'    => __( 'Link Active Color', $this -> text_domain ),
                'subtitle' => __( 'Set the color of the sub-menu item’s active text link', $this -> text_domain ),
            ),
            array(
                'id'       => 'off-canvas-mobile-menu-active-bg-color',
                'type'     => 'color_rgba',
                'title'    => __( 'Active Background Color', $this -> text_domain ),
                'subtitle' => __( 'Set the background color of the active link sub menu item', $this -> text_domain ),
            ),
        ),
    )
);
// -> START Contact Color
Templaza_API::set_section('settings',
    array(
        'title'      => __( 'Contact icon', $this -> text_domain ),
        'id'         => 'colors-contact-icon',
        'desc'       => __( 'Select colors for contact icon', $this -> text_domain ),
        'subsection' => true,
        'fields'     => array(
            array(
                'id'       => 'contact-icon-color',
                'type'     => 'color_rgba',
                'title'    => __( 'Contact icon color', $this -> text_domain ),
                'subtitle' => __( 'Set the color of contact icon', $this -> text_domain ),
            ),
        ),
    )
);
// -> START Button Color
Templaza_API::set_section('settings',
    array(
        'title'      => __( 'Button', $this -> text_domain ),
        'id'         => 'colors-button',
        'desc'       => __( 'Select colors for Button', $this -> text_domain ),
        'subsection' => true,
        'fields'     => array(
            array(
                'id'       => 'button-background-color',
                'type'     => 'color_rgba',
                'title'    => __( 'Button background color', $this -> text_domain ),
                'subtitle' => __( 'Set background color button', $this -> text_domain ),
            ),
            array(
                'id'       => 'button-color',
                'type'     => 'color_rgba',
                'title'    => __( 'Button color', $this -> text_domain ),
                'subtitle' => __( 'Set color button', $this -> text_domain ),
            ),
            array(
                'id'       => 'button-background-color-hover',
                'type'     => 'color_rgba',
                'title'    => __( 'Button hover background color', $this -> text_domain ),
                'subtitle' => __( 'Set background color button hover', $this -> text_domain ),
            ),
            array(
                'id'       => 'button-color-hover',
                'type'     => 'color_rgba',
                'title'    => __( 'Button color hover', $this -> text_domain ),
                'subtitle' => __( 'Set color button hover', $this -> text_domain ),
            ),
        ),
    )
);