<?php

defined('TEMPLAZA_FRAMEWORK') or exit();

// -> START Miscellaneous
Templaza_API::set_section('templaza_style',
    array(
        'title'  => __( 'Miscellaneous', $this -> text_domain ),
        'id'     => 'miscellaneous',
        'desc'   => __( 'These settings control the typography', $this -> text_domain ),
        'icon'   => 'el-icon-cogs',
    //    'fields' => array(
    //
    //    )
    )
);
//
// -> START Copyright
Templaza_API::set_section('templaza_style',
    array(
        'title'   => __('Copyright', $this -> text_domain),
        'id'      => 'miscellaneous-copyrights',
    //    'desc'       => __( 'Enable or disable the footer copyright bar.', $this -> text_domain ),
        'subsection' => true,
        'fields'     => array(
            array(
                'id'       => 'enable-footer',
                'type'     => 'switch',
                'title'    => __( 'Branding', $this -> text_domain ),
                'subtitle' => __( 'Enable or disable the footer copyright bar.', $this -> text_domain ),
                'default'  => false,
            ),
            array(
                'id'       => 'footer-copyright',
                'type'     => 'textarea',
                'title'    => __( 'Custom HTML', $this -> text_domain ),
                'subtitle' => __( 'Enter the text that displays in the copyright bar. You can use <code>{year}</code> for current year and <code>{sitetitle}</code> for site name.', $this -> text_domain ),
                'desc'     => __('HTML is allowed in here.', $this -> text_domain),
                'validate' => 'html', //see http://codex.wordpress.org/Function_Reference/wp_kses_post
                'default'  => '© {sitename} {year}. Design by <a href="https://www.templaza.com/" title="TemPlaza">TemPlaza</a>',
                'required' => array( 'enable-footer', '=', true ),
    //            'required' => array('enable-footer', '=', '1'),
            ),
    //        array(
    //            'id'       => 'footer-sidebar',
    //            'type'     => 'select',
    //            'data'     => 'sidebars',
    //            'title'    => __( 'Footer Sidebar', $this -> text_domain ),
    //            'subtitle' => __( 'Select Sidebar for Footer.', $this -> text_domain ),
    //            'required' => array('enable-footer', '=', '1'),
    //        ),
        )
    )
);

// -> START Contact Information
Templaza_API::set_section('templaza_style',
    array(
        'title'   => __('Contact Information', $this -> text_domain),
        'id'      => 'miscellaneous-contacts',
        'subsection' => true,
        'fields'     => array(
            array(
                'id'       => 'contact-detail',
                'type'     => 'switch',
                'title'    => __( 'Contact Details', $this -> text_domain ),
                'subtitle' => __( 'Enable or disable to add or hide contact information.', $this -> text_domain ),
                'default'  => true,
            ),
            array(
                'id'          => 'contact-address',
                'type'        => 'text',
                'title'       => __( 'Address', $this -> text_domain ),
                'subtitle'    => __( 'Add address here. Leave blank if not required.', $this -> text_domain ),
                'placeholder' => __('15 Barnes Wallis Way, West Road, Chorley, USA', $this -> text_domain),
                'required'    => array(
                    array('contact-detail', '=', '1'),
                ),
            ),
            array(
                'id'          => 'contact-phone-number',
                'type'        => 'text',
                'title'       => __( 'Phone Number', $this -> text_domain ),
                'subtitle'    => __( 'Add phone number here. Leave blank if not required.', $this -> text_domain ),
                'placeholder' => __('+1 123 456 7890', $this -> text_domain),
                'required'    => array(
                    array('contact-detail', '=', '1'),
                ),
            ),
            array(
                'id'          => 'contact-mobile-number',
                'type'        => 'text',
                'title'       => __( 'Mobile Number', $this -> text_domain ),
                'subtitle'    => __( 'Add phone number here. Leave blank if not required.', $this -> text_domain ),
                'placeholder' => __('+1 123 456 7890', $this -> text_domain),
                'required'    => array(
                    array('contact-detail', '=', '1'),
                ),
            ),
            array(
                'id'          => 'contact-email-address',
                'type'        => 'text',
                'title'       => __( 'Email', $this -> text_domain ),
                'subtitle'    => __( 'Add email address here. Leave blank if not required.', $this -> text_domain ),
                'placeholder' => __('email@yourcompany.com', $this -> text_domain),
                'validate'    => 'email',
                'required'    => array(
                    array('contact-detail', '=', '1'),
                ),
            ),
            array(
                'id'          => 'contact-open-hours',
                'type'        => 'text',
                'title'       => __( 'Open Hours', $this -> text_domain ),
                'subtitle'    => __( 'Add Opening hour here. Leave blank if not required.', $this -> text_domain ),
                'placeholder' => __('Mon-Fri : 9:00am - 6:00pm', $this -> text_domain),
                'required'    => array(
                    array('contact-detail', '=', '1'),
                ),
            ),
            array(
                'id'          => 'contact-display',
                'type'        => 'switch',
                'title'       => __( 'Display', $this -> text_domain ),
                'subtitle'    => __( 'Select whether you need to have icons or text before each contact item.', $this -> text_domain ),
                'default'     => true,
                'on'          => __('Icons', $this -> text_domain),
                'off'         => __('Text', $this -> text_domain),
                'required'    => array(
                    array('contact-detail', '=', '1'),
                ),
            ),
            array(
                'id'          => 'contact-icon-color',
                'type'        => 'color_rgba',
                'title'       => __( 'Icon Color', $this -> text_domain ),
                'subtitle'    => __( 'Select icon color for contact details.', $this -> text_domain ),
                'required'    => array(
                    array('contact-display', '=', '1'),
                ),
            ),
        )
    )
);

// -> START Coming Soon
Templaza_API::set_section('templaza_style',
    array(
        'title'   => __('Coming Soon', $this -> text_domain),
        'id'      => 'miscellaneous-comming-soons',
    //    'desc'       => __( 'Enable or disable the footer copyright bar.', $this -> text_domain ),
        'subsection' => true,
        'fields'     => array(
            array(
                'id'       => 'miscellaneous-development-mode',
                'type'     => 'switch',
                'title'    => __( 'Development Mode', $this -> text_domain ),
                'subtitle' => __( 'Enable development mode to take your site offline and show a static coming soon page.', $this -> text_domain ),
                'default'  => true,
            ),
            array(
                'id'          => 'miscellaneous-logo',
                'type'        => 'media',
                'title'       => __( 'Logo', $this -> text_domain ),
                'subtitle'    => __( 'Select a logo for coming soon page.', $this -> text_domain ),
                'required'    => array(
                    array('miscellaneous-development-mode', '=', '1'),
                ),
            ),
            array(
                'id'          => 'miscellaneous-content',
                'type'        => 'textarea',
                'title'       => __( 'Content', $this -> text_domain ),
                'subtitle'    => __( 'Enter your coming soon page content.', $this -> text_domain ),
                'desc'        => __('HTML is allowed in here.', $this -> text_domain),
                'validate'    => 'html', //see http://codex.wordpress.org/Function_Reference/wp_kses_post
                'required'    => array(
                    array('miscellaneous-development-mode', '=', '1'),
                ),
            ),
            array(
                'id'          => 'miscellaneous-coming-soon-countdown-date',
                'type'        => 'text',
                'title'       => __( 'Countdown Date', $this -> text_domain ),
                'subtitle'    => __( 'Set a date for countdown.', $this -> text_domain ),
                'required'    => array(
                    array('miscellaneous-development-mode', '=', '1'),
                ),
            ),
            array(
                'id'          => 'miscellaneous-coming-soon-social',
                'type'        => 'switch',
                'title'       => __( 'Social Icons', $this -> text_domain ),
                'default'     => true,
                'required'    => array(
                    array('miscellaneous-development-mode', '=', '1'),
                ),
            ),
            array(
                'id'          => 'miscellaneous-background-setting',
                'type'        => 'select',
                'title'       => __( 'Background Type', $this -> text_domain ),
                'options'     => array(
                    '0'     => __('None', $this -> text_domain),
                    'color' => __('Color', $this -> text_domain),
                    'image' => __('Image', $this -> text_domain),
                    'video' => __('Video', $this -> text_domain),
                ),
                'required'    => array(
                    array('miscellaneous-development-mode', '=', '1'),
                ),
            ),
        )
    )
);

// -> START 404 Error
Templaza_API::set_section('templaza_style',
    array(
        'title'   => __('404 Error', $this -> text_domain),
        'id'      => 'miscellaneous-404-errors',
    //    'desc'       => __( 'Enable or disable the footer copyright bar.', $this -> text_domain ),
        'subsection' => true,
        'fields'     => array(
            array(
                'id'         => '404-content',
                'type'       => 'ace_editor',
                'title'      => __( '404 Page Content', $this -> text_domain ),
                'subtitle'   => __( 'Type the content of your 404 page. You can also use <code>{errorcode}</code> for system error code and <code>{errormessage}</code> for system error message.', $this -> text_domain ),
                'desc'       => __('HTML is allowed in here.', $this -> text_domain),
                'mode'       => 'html',
                'theme'      => 'chrome',
    //            'full_width' => true,
    //            'validate' => 'html', //see http://codex.wordpress.org/Function_Reference/wp_kses_post
                'default'  => '',
            ),
            array(
                'id'          => '404-call-to-action',
                'type'        => 'text',
                'title'       => __( 'Call To Action', $this -> text_domain ),
                'subtitle'    => __( 'Enter text to dislay on Call To Action Button.', $this -> text_domain ),
                'default'     => 'Go Home',
                'placeholder'     => 'Go Home',
            ),
            array(
                'id'          => '404-background-setting',
                'type'        => 'button_set',
                'title'       => __( 'Background Type', $this -> text_domain ),
                'options'     => array(
                    '0'     => __('None', $this -> text_domain),
                    'color' => __('Color', $this -> text_domain),
                    'image' => __('Image', $this -> text_domain),
                    'video' => __('Video', $this -> text_domain),
                ),
                'default'     => 0,
            ),
            array(
                'id'          => '404-background-color',
                'type'        => 'color_rgba',
                'title'       => __( 'Background Color', $this -> text_domain ),
                'required'  => array('404-background-setting', '=', 'color'),
            ),
            array(
                'id'          => '404-background',
                'type'        => 'background',
                'title'       => __( 'Background', $this -> text_domain ),
                'required'  => array('404-background-setting', '=', 'image'),
            ),
            array(
                'id'          => '404-background-video',
                'type'        => 'media',
                'title'       => __( 'Background Video', $this -> text_domain ),
                'required'  => array('404-background-setting', '=', 'video'),
            ),
        )
    )
);
// -> START Favicon
Templaza_API::set_section('templaza_style',
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