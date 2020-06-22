<?php

defined('TEMPLAZA_FRAMEWORK') or exit();

// -> START Miscellaneous
$this -> sections[]	= array(
    'title'  => __( 'Miscellaneous', $this -> text_domain ),
    'id'     => 'miscellaneous',
    'desc'   => __( 'These settings control the typography', $this -> text_domain ),
    'icon'   => 'el-icon-cogs',
//    'fields' => array(
//
//    )
);

// -> START Copyright
$this -> sections[] = array(
    'title'   => __('Copyright', $this -> text_domain),
    'id'      => 'miscellaneous-copyrights',
//    'desc'       => __( 'Enable or disable the footer copyright bar.', $this -> text_domain ),
    'subsection' => true,
    'fields'     => array(
        array(
            'id'       => 'miscellaneous-footer',
            'type'     => 'switch',
            'title'    => __( 'Branding', $this -> text_domain ),
            'subtitle' => __( 'Enable or disable the footer copyright bar.', $this -> text_domain ),
            'default'  => true,
        ),
        array(
            'id'       => 'miscellaneous-footer-copyright',
            'type'     => 'textarea',
            'title'    => __( 'Custom HTML', $this -> text_domain ),
            'subtitle' => __( 'Enter the text that displays in the copyright bar. You can use <code>{year}</code> for current year and <code>{sitename}</code> for site name.', $this -> text_domain ),
            'desc'     => 'HTML is allowed in here.',
            'validate' => 'html', //see http://codex.wordpress.org/Function_Reference/wp_kses_post
            'required' => array('miscellaneous-footer', '=', '1'),
        ),
    )
);

// -> START Contact Information
$this -> sections[] = array(
    'title'   => __('Contact Information', $this -> text_domain),
    'id'      => 'miscellaneous-contacts',
//    'desc'       => __( 'Enable or disable the footer copyright bar.', $this -> text_domain ),
    'subsection' => true,
    'fields'     => array(
        array(
            'id'       => 'miscellaneous-contact-detail',
            'type'     => 'switch',
            'title'    => __( 'Contact Details', $this -> text_domain ),
            'subtitle' => __( 'Enable or disable to add or hide contact information.', $this -> text_domain ),
            'default'  => true,
        ),
        array(
            'id'          => 'miscellaneous-address',
            'type'        => 'text',
            'title'       => __( 'Address', $this -> text_domain ),
            'subtitle'    => __( 'Add address here. Leave blank if not required.', $this -> text_domain ),
            'placeholder' => __('15 Barnes Wallis Way, West Road, Chorley, USA', $this -> text_domain),
            'required'    => array(
                array('miscellaneous-contact-detail', '=', '1'),
            ),
        ),
        array(
            'id'          => 'miscellaneous-phone-number',
            'type'        => 'text',
            'title'       => __( 'Phone Number', $this -> text_domain ),
            'subtitle'    => __( 'Add phone number here. Leave blank if not required.', $this -> text_domain ),
            'placeholder' => __('+1 123 456 7890', $this -> text_domain),
            'required'    => array(
                array('miscellaneous-contact-detail', '=', '1'),
            ),
        ),
        array(
            'id'          => 'miscellaneous-mobile-number',
            'type'        => 'text',
            'title'       => __( 'Mobile Number', $this -> text_domain ),
            'subtitle'    => __( 'Add phone number here. Leave blank if not required.', $this -> text_domain ),
            'placeholder' => __('+1 123 456 7890', $this -> text_domain),
            'required'    => array(
                array('miscellaneous-contact-detail', '=', '1'),
            ),
        ),
        array(
            'id'          => 'miscellaneous-email',
            'type'        => 'text',
            'title'       => __( 'Email', $this -> text_domain ),
            'subtitle'    => __( 'Add email address here. Leave blank if not required.', $this -> text_domain ),
            'placeholder' => __('email@yourcompany.com', $this -> text_domain),
            'validate'    => 'email',
            'required'    => array(
                array('miscellaneous-contact-detail', '=', '1'),
            ),
        ),
        array(
            'id'          => 'miscellaneous-open-hours',
            'type'        => 'text',
            'title'       => __( 'Open Hours', $this -> text_domain ),
            'subtitle'    => __( 'Add Opening hour here. Leave blank if not required.', $this -> text_domain ),
            'placeholder' => __('Mon-Fri : 9:00am - 6:00pm', $this -> text_domain),
            'required'    => array(
                array('miscellaneous-contact-detail', '=', '1'),
            ),
        ),
        array(
            'id'          => 'miscellaneous-display',
            'type'        => 'switch',
            'title'       => __( 'Display', $this -> text_domain ),
            'subtitle'    => __( 'Select whether you need to have icons or text before each contact item.', $this -> text_domain ),
            'default'     => true,
            'on'          => __('Icons', $this -> text_domain),
            'off'         => __('Text', $this -> text_domain),
            'required'    => array(
                array('miscellaneous-contact-detail', '=', '1'),
            ),
        ),
        array(
            'id'          => 'miscellaneous-icon-color',
            'type'        => 'color_rgba',
            'title'       => __( 'Icon Color', $this -> text_domain ),
            'subtitle'    => __( 'Select icon color for contact details.', $this -> text_domain ),
            'required'    => array(
                array('miscellaneous-contact-detail', '=', '1'),
                array('miscellaneous-display', '=', '1'),
            ),
        ),
    )
);

// -> START Coming Soon
$this -> sections[] = array(
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
);

// -> START 404 Error
$this -> sections[] = array(
    'title'   => __('404 Error', $this -> text_domain),
    'id'      => 'miscellaneous-404-errors',
//    'desc'       => __( 'Enable or disable the footer copyright bar.', $this -> text_domain ),
    'subsection' => true,
    'fields'     => array(
        array(
            'id'       => 'miscellaneous-404-content',
            'type'     => 'textarea',
            'title'    => __( '404 Page Content', $this -> text_domain ),
            'subtitle' => __( 'Type the content of your 404 page. You can also use <code>{errorcode}</code> for system error code and <code>{errormessage}</code> for system error message.', $this -> text_domain ),
            'desc'     => __('HTML is allowed in here.', $this -> text_domain),
            'validate' => 'html', //see http://codex.wordpress.org/Function_Reference/wp_kses_post
            'default'  => '',
        ),
        array(
            'id'          => 'miscellaneous-404-call-to-action',
            'type'        => 'text',
            'title'       => __( 'Call To Action', $this -> text_domain ),
            'subtitle'    => __( 'Enter text to dislay on Call To Action Button.', $this -> text_domain ),
            'default'     => 'Go Home',
            'placeholder'     => 'Go Home',
        ),
        array(
            'id'          => 'miscellaneous-404-background-setting',
            'type'        => 'select',
            'title'       => __( 'Background Type', $this -> text_domain ),
            'options'     => array(
                '0'     => __('None', $this -> text_domain),
                'color' => __('Color', $this -> text_domain),
                'image' => __('Image', $this -> text_domain),
                'video' => __('Video', $this -> text_domain),
            ),
            'default'     => 0,
        ),
    )
);
// -> START Favicon
$this -> sections[] = array(
    'title'   => __('Favicon', $this -> text_domain),
    'id'      => 'miscellaneous-favicons',
//    'desc'       => __( 'Enable or disable the footer copyright bar.', $this -> text_domain ),
    'subsection' => true,
    'fields'     => array(
        array(
            'id'       => 'miscellaneous-favicon',
            'type'     => 'media',
            'title'    => __( 'Favicon', $this -> text_domain ),
            'subtitle' => __( 'Upload your browser URL icon. It\'s recommended to apply a size of 96x96 pixels to the favicon.png.', $this -> text_domain ),
        ),
    )
);