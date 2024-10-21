<?php

defined('TEMPLAZA_FRAMEWORK') or exit();

// -> START Color Selection
Templaza_API::set_section('settings', array(
        'title' => __( 'Colors', 'templaza-framework'),
        'id'    => 'colors',
        'desc'  => __( 'Color Settings', 'templaza-framework' ),
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
            array(
                'id'       => 'body-border-color',
                'type'     => 'color_rgba',
                'title'    => __( 'Border Color', 'templaza-framework' ),
                'subtitle' => __( 'Set the border color of table....', 'templaza-framework' ),
            ),
            array(
                'id'       => 'body-modal-bg',
                'type'     => 'color_rgba',
                'title'    => __( 'Background Modal color', 'templaza-framework' ),
                'subtitle' => __( 'Set the background color of modal.', 'templaza-framework' ),
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
                'title'    => esc_html__( 'Background Logo Section', 'templaza-framework' ),
                'default'  => '',
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
                'default'  => '',
            ),
            array(
                'id'       => 'header-icon-color',
                'type'     => 'color_rgba',
                'title'    => esc_html__( 'Header icon color', 'templaza-framework' ),
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
                'id'       => 'sticky-heading-color',
                'type'     => 'color_rgba',
                'title'    => __( 'Sticky Heading Color', 'templaza-framework' ),
                'subtitle' => __( 'Set colors for h1,h2,h3,h4,h5,h6', 'templaza-framework' ),
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
// -> START Breadcrumb Color
Templaza_API::set_section('settings',
    array(
        'title'      => __( 'Breadcrumb Color', 'templaza-framework' ),
        'id'         => 'colors-breadcrumb',
        'desc'       => __( 'Select colors for breadcrumb', 'templaza-framework' ),
        'subsection' => true,
        'fields'     => array(
            array(
                'id'       => 'breadcrumb-link',
                'type'     => 'color_rgba',
                'title'    => __( 'Breadcrumb link color', 'templaza-framework' ),
                'subtitle' => __( 'Set the color of breadcrumb link', 'templaza-framework' ),
            ),
            array(
                'id'       => 'breadcrumb-link-hover',
                'type'     => 'color_rgba',
                'title'    => __( 'Breadcrumb link hover color', 'templaza-framework' ),
                'subtitle' => __( 'Set the hover color of breadcrumb link', 'templaza-framework' ),
            ),
            array(
                'id'       => 'breadcrumb-current',
                'type'     => 'color_rgba',
                'title'    => __( 'Breadcrumb color current', 'templaza-framework' ),
                'subtitle' => __( 'Set the color of current', 'templaza-framework' ),
            ),
            array(
                'id'       => 'breadcrumb-link-single',
                'type'     => 'color_rgba',
                'title'    => __( 'Single post breadcrumb link color', 'templaza-framework' ),
                'subtitle' => __( 'Set the color of single post breadcrumb link', 'templaza-framework' ),
            ),
            array(
                'id'       => 'breadcrumb-link-hover-single',
                'type'     => 'color_rgba',
                'title'    => __( 'Single post breadcrumb link hover color', 'templaza-framework' ),
                'subtitle' => __( 'Set the hover color of single post breadcrumb link', 'templaza-framework' ),
            ),
            array(
                'id'       => 'breadcrumb-current-single',
                'type'     => 'color_rgba',
                'title'    => __( 'Single post breadcrumb color current', 'templaza-framework' ),
                'subtitle' => __( 'Set the color of single post current', 'templaza-framework' ),
            ),
        ),
    )
);
// -> START Blog Color
Templaza_API::set_section('settings',
    array(
        'title'      => __( 'Blog Color', 'templaza-framework' ),
        'id'         => 'colors-blog',
        'desc'       => __( 'Select colors for Blog', 'templaza-framework' ),
        'subsection' => true,
        'fields'     => array(
            array(
                'id'       => 'blog-quote-bg-color',
                'type'     => 'color_rgba',
                'title'    => __( 'Quote background color', 'templaza-framework' ),
            ),
            array(
                'id'       => 'blog-quote-color',
                'type'     => 'color_rgba',
                'title'    => __( 'Quote color', 'templaza-framework' ),
            ),
            array(
                'id'       => 'blog-border-color',
                'type'     => 'color_rgba',
                'default'     => '',
                'title'    => __( 'Border color', 'templaza-framework' ),
            ),
            array(
                'id'       => 'blog-meta-color',
                'type'     => 'color_rgba',
                'default'     => '',
                'title'    => __( 'Meta color', 'templaza-framework' ),
            ),
            array(
                'id'       => 'blog-meta-link-color',
                'type'     => 'color_rgba',
                'default'     => '',
                'title'    => __( 'Meta link color', 'templaza-framework' ),
            ),
            array(
                'id'       => 'blog-meta-link-hover-color',
                'type'     => 'color_rgba',
                'default'     => '',
                'title'    => __( 'Meta link hover color', 'templaza-framework' ),
            ),
            array(
                'id'       => 'blog-author-bg-color',
                'type'     => 'color_rgba',
                'default'     => '',
                'title'    => __( 'Single block author background color', 'templaza-framework' ),
            ),
            array(
                'id'       => 'blog-author-color',
                'type'     => 'color_rgba',
                'default'     => '',
                'title'    => __( 'Single block author color', 'templaza-framework' ),
            ),
            array(
                'id'       => 'blog-meta-color-single',
                'type'     => 'color_rgba',
                'default'     => '',
                'title'    => __( 'Single meta color', 'templaza-framework' ),
            ),
            array(
                'id'       => 'blog-meta-link-color-single',
                'type'     => 'color_rgba',
                'default'     => '',
                'title'    => __( 'Single meta link color', 'templaza-framework' ),
            ),
            array(
                'id'       => 'blog-meta-link-hover-color-single',
                'type'     => 'color_rgba',
                'default'     => '',
                'title'    => __( 'Single meta link hover color', 'templaza-framework' ),
            ),
            array(
                'id'       => 'blog-input-cm-bg-color',
                'type'     => 'color_rgba',
                'title'    => __( 'Comment input background color', 'templaza-framework' ),
            ),
            array(
                'id'       => 'form-input-cm-color',
                'type'     => 'color_rgba',
                'title'    => __( 'Comment input color', 'templaza-framework' ),
            ),
        ),
    )
);
// -> START Form Color
Templaza_API::set_section('settings',
    array(
        'title'      => __( 'Form Color', 'templaza-framework' ),
        'id'         => 'colors-form',
        'desc'       => __( 'Select colors for Form', 'templaza-framework' ),
        'subsection' => true,
        'fields'     => array(
            array(
                'id'       => 'form-input-bg-color',
                'type'     => 'color_rgba',
                'title'    => __( 'Input background color', 'templaza-framework' ),
            ),
            array(
                'id'       => 'form-input-color',
                'type'     => 'color_rgba',
                'title'    => __( 'Input color', 'templaza-framework' ),
            ),

        ),
    )
);
// -> START Form Color
Templaza_API::set_section('settings',
    array(
        'title'      => __( 'Sidebar Color', 'templaza-framework' ),
        'id'         => 'colors-sidebar',
        'desc'       => __( 'Select colors for Sidebar', 'templaza-framework' ),
        'subsection' => true,
        'fields'     => array(
            array(
                'id'       => 'sidebar-bg-color',
                'type'     => 'color_rgba',
                'title'    => __( 'Sidebar background color', 'templaza-framework' ),
            ),
            array(
                'id'       => 'sidebar-heading-color',
                'type'     => 'color_rgba',
                'title'    => __( 'Widget Heading color', 'templaza-framework' ),
            ),
            array(
                'id'       => 'sidebar-widget-content-color',
                'type'     => 'color_rgba',
                'title'    => __( 'Widget content color', 'templaza-framework' ),
                'default'   => array(
                    'color'     => '',
                    'alpha'     => 1
                ),
            ),
            array(
                'id'       => 'sidebar-widget-border-color',
                'type'     => 'color_rgba',
                'title'    => __( 'Widget border color', 'templaza-framework' ),
                'default'   => array(
                    'color'     => '',
                    'alpha'     => 1
                ),
            ),
            array(
                'id'       => 'sidebar-post-title-color',
                'type'     => 'color_rgba',
                'title'    => __( 'Post title color', 'templaza-framework' ),
                'default'   => array(
                    'color'     => '',
                    'alpha'     => 1
                ),
            ),
            array(
                'id'       => 'sidebar-post-title-hover-color',
                'type'     => 'color_rgba',
                'title'    => __( 'Post title hover color', 'templaza-framework' ),
                'default'   => array(
                    'color'     => '',
                    'alpha'     => 1
                ),
            ),
            array(
                'id'       => 'sidebar-tag-bg-color',
                'type'     => 'color_rgba',
                'title'    => __( 'Tag background color', 'templaza-framework' ),
                'default'   => array(
                    'color'     => '',
                    'alpha'     => 1
                ),
            ),
            array(
                'id'       => 'sidebar-tag-color',
                'type'     => 'color_rgba',
                'title'    => __( 'Tag color', 'templaza-framework' ),
                'default'   => array(
                    'color'     => '',
                    'alpha'     => 1
                ),
            ),
            array(
                'id'       => 'sidebar-tag-bg-hover-color',
                'type'     => 'color_rgba',
                'title'    => __( 'Tag background hover color', 'templaza-framework' ),
                'default'   => array(
                    'color'     => '',
                    'alpha'     => 1
                ),
            ),
            array(
                'id'       => 'sidebar-tag-hover-color',
                'type'     => 'color_rgba',
                'title'    => __( 'Tag hover color', 'templaza-framework' ),
                'default'   => array(
                    'color'     => '',
                    'alpha'     => 1
                ),
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
// -> START Footer Color
Templaza_API::set_section('settings',
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
// -> START WooCommerce Color
Templaza_API::set_section('settings',
    array(
        'title'      => __( 'WooCommerce Color', 'templaza-framework' ),
        'id'         => 'woo-color',
        'desc'       => __( 'Config color on WooCommerce page', 'templaza-framework' ),
        'subsection' => true,
        'fields'     => array(
            array(
                'id'       => 'woo-catalog-title-color',
                'type'     => 'color_rgba',
                'title'    => __( 'Catalog title color', 'templaza-framework' ),
            ),
            array(
                'id'       => 'woo-catalog-meta-color',
                'type'     => 'color_rgba',
                'title'    => __( 'Catalog meta color', 'templaza-framework' ),
            ),
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
            array(
                'id'       => 'woo-filter-color',
                'type'     => 'color_rgba',
                'title'    => __( 'Filter item color', 'templaza-framework' ),
            ),
            array(
                'id'       => 'woo-filter-hover-color',
                'type'     => 'color_rgba',
                'title'    => __( 'Filter item hover color', 'templaza-framework' ),
            ),
            array(
                'id'       => 'woo-modal-bg-color',
                'type'     => 'color_rgba',
                'title'    => __( 'Modal background color', 'templaza-framework' ),
            ),
            array(
                'id'       => 'woo-single-quantity-background',
                'type'     => 'color_rgba',
                'title'    => __( 'Single quantity background color', 'templaza-framework' ),
            ),
            array(
                'id'       => 'woo-single-quantity-color',
                'type'     => 'color_rgba',
                'title'    => __( 'Single quantity color', 'templaza-framework' ),
            ),
            array(
                'id'       => 'woo-single-sticky-cart-bg',
                'type'     => 'color_rgba',
                'title'    => __( 'Single sticky background color', 'templaza-framework' ),
            ),
            array(
                'id'       => 'woo-cart-link-color',
                'type'     => 'color_rgba',
                'title'    => __( 'Cart link color', 'templaza-framework' ),
            ),
            array(
                'id'       => 'woo-cart-link-hover-color',
                'type'     => 'color_rgba',
                'title'    => __( 'Cart link hover color', 'templaza-framework' ),
            ),
            array(
                'id'       => 'woo-checkout-side-bg-color',
                'type'     => 'color_rgba',
                'title'    => __( 'Checkout sidebar background color', 'templaza-framework' ),
            ),
            array(
                'id'       => 'woo-checkout-side-border-color',
                'type'     => 'color_rgba',
                'title'    => __( 'Checkout sidebar border color', 'templaza-framework' ),
            ),
            array(
                'id'       => 'woo-checkout-label-color',
                'type'     => 'color_rgba',
                'title'    => __( 'Checkout label color', 'templaza-framework' ),
            ),
        ),
    )
);
// -> START WooCommerce Color
Templaza_API::set_section('settings',
    array(
        'title'      => __( 'Advanced Product Color', 'templaza-framework' ),
        'id'         => 'advanced-product-color',
        'desc'       => __( 'Config color on Advanced product page', 'templaza-framework' ),
        'subsection' => true,
        'fields'     => array(
            array(
                'id'       => 'ap_product-loop-bg-color',
                'type'     => 'background',
                'title'    => esc_html__( 'Item Background', 'templaza-framework' ),
                'subtitle' => esc_html__( 'Select the background for product item.', 'templaza-framework' ),
            ),
            array(
                'id'       => 'ap-archive-title-color',
                'type'     => 'color_rgba',
                'title'    => __( 'Archive title color', 'templaza-framework' ),
            ),
            array(
                'id'       => 'ap-archive-title-hover-color',
                'type'     => 'color_rgba',
                'title'    => __( 'Archive title hover color', 'templaza-framework' ),
            ),
            array(
                'id'       => 'ap-meta-color',
                'type'     => 'color_rgba',
                'title'    => __( 'Archive meta color', 'templaza-framework' ),
            ),
            array(
                'id'       => 'ap-icon-bg',
                'type'     => 'color_rgba',
                'title'    => __( 'Icon background color', 'templaza-framework' ),
            ),
            array(
                'id'       => 'ap-icon-color',
                'type'     => 'color_rgba',
                'title'    => __( 'Icon color', 'templaza-framework' ),
            ),
            array(
                'id'       => 'ap-icon-hover-bg',
                'type'     => 'color_rgba',
                'title'    => __( 'Icon background hover color', 'templaza-framework' ),
            ),
            array(
                'id'       => 'ap-icon-hover-color',
                'type'     => 'color_rgba',
                'title'    => __( 'Icon hover color', 'templaza-framework' ),
            ),
            array(
                'id'       => 'ap-icon-border-color',
                'type'     => 'color_rgba',
                'title'    => __( 'Icon border color', 'templaza-framework' ),
            ),
            array(
                'id'       => 'ap-field-label-color',
                'type'     => 'color_rgba',
                'title'    => __( 'Custom field label color', 'templaza-framework' ),
            ),
            array(
                'id'       => 'ap-field-value-color',
                'type'     => 'color_rgba',
                'title'    => __( 'Custom field value color', 'templaza-framework' ),
            ),
            array(
                'id'       => 'ap-item-footer-border',
                'type'     => 'color_rgba',
                'title'    => __( 'Footer item border color', 'templaza-framework' ),
            ),
            array(
                'id'       => 'ap-price-color',
                'type'     => 'color_rgba',
                'title'    => __( 'Price color', 'templaza-framework' ),
            ),
            array(
                'id'       => 'ap-price-msrp-color',
                'type'     => 'color_rgba',
                'title'    => __( 'MSRP Price color', 'templaza-framework' ),
            ),
            array(
                'id'       => 'ap-filter-label-color',
                'type'     => 'color_rgba',
                'title'    => __( 'Filter label color', 'templaza-framework' ),
            ),
            array(
                'id'       => 'ap-filter-input-border',
                'type'     => 'color_rgba',
                'title'    => __( 'Filter input border color', 'templaza-framework' ),
            ),
            array(
                'id'       => 'ap-filter-input-bg',
                'type'     => 'color_rgba',
                'title'    => __( 'Filter input background color', 'templaza-framework' ),
            ),
            array(
                'id'       => 'ap-filter-input-color',
                'type'     => 'color_rgba',
                'title'    => __( 'Filter input color', 'templaza-framework' ),
            ),
            array(
                'id'       => 'ap-filter-color',
                'type'     => 'color_rgba',
                'title'    => __( 'Filter color', 'templaza-framework' ),
            ),
            array(
                'id'       => 'ap-filter-hover-color',
                'type'     => 'color_rgba',
                'title'    => __( 'Filter link hover color', 'templaza-framework' ),
            ),
            array(
                'id'       => 'ap-list-grid-border',
                'type'     => 'color_rgba',
                'title'    => __( 'List/Grid border color', 'templaza-framework' ),
            ),
            array(
                'id'       => 'ap-list-grid-label',
                'type'     => 'color_rgba',
                'title'    => __( 'List/Grid label color', 'templaza-framework' ),
            ),
            array(
                'id'       => 'ap-list-grid-bg',
                'type'     => 'color_rgba',
                'title'    => __( 'List/Grid button background', 'templaza-framework' ),
            ),
            array(
                'id'       => 'ap-list-grid-color',
                'type'     => 'color_rgba',
                'title'    => __( 'List/Grid button color', 'templaza-framework' ),
            ),
            array(
                'id'       => 'ap-list-grid-hover-bg',
                'type'     => 'color_rgba',
                'title'    => __( 'List/Grid button hover background', 'templaza-framework' ),
            ),
            array(
                'id'       => 'ap-list-grid-hover-color',
                'type'     => 'color_rgba',
                'title'    => __( 'List/Grid button hover color', 'templaza-framework' ),
            ),
            array(
                'id'       => 'ap-single-price-bg',
                'type'     => 'color_rgba',
                'title'    => __( 'Single Price background color', 'templaza-framework' ),
            ),
            array(
                'id'       => 'ap-single-price-color',
                'type'     => 'color_rgba',
                'title'    => __( 'Single Price color', 'templaza-framework' ),
            ),
            array(
                'id'       => 'ap_product-side-box-bg-color',
                'type'     => 'background',
                'title'    => esc_html__( 'Single Side Box Background', 'templaza-framework' ),
                'subtitle' => esc_html__( 'Select the background for single side box item.', 'templaza-framework' ),
            ),
            array(
                'id'       => 'ap-single-side-box-title',
                'type'     => 'color_rgba',
                'title'    => __( 'Single Side box title color', 'templaza-framework' ),
            ),
            array(
                'id'       => 'ap-single-side-box-field-label',
                'type'     => 'color_rgba',
                'title'    => __( 'Single Side box field label color', 'templaza-framework' ),
            ),
            array(
                'id'       => 'ap-single-side-box-field-value',
                'type'     => 'color_rgba',
                'title'    => __( 'Single Side box field value color', 'templaza-framework' ),
            ),
            array(
                'id'       => 'ap-single-side-box-border',
                'type'     => 'color_rgba',
                'title'    => __( 'Single Side box border color', 'templaza-framework' ),
            ),
            array(
                'id'       => 'ap-single-side-box-author-bg',
                'type'     => 'color_rgba',
                'title'    => __( 'Single Side box author background color', 'templaza-framework' ),
            ),
            array(
                'id'       => 'ap-single-side-box-author-title',
                'type'     => 'color_rgba',
                'title'    => __( 'Single Side box author title color', 'templaza-framework' ),
            ),
            array(
                'id'       => 'ap-single-side-box-author-color',
                'type'     => 'color_rgba',
                'title'    => __( 'Single Side box author color', 'templaza-framework' ),
            ),
            array(
                'id'       => 'ap-single-side-box-input-bg',
                'type'     => 'color_rgba',
                'title'    => __( 'Single Side box form input background color', 'templaza-framework' ),
            ),
            array(
                'id'       => 'ap-single-side-box-input-color',
                'type'     => 'color_rgba',
                'title'    => __( 'Single Side box form input color', 'templaza-framework' ),
            ),

        ),
    )
);