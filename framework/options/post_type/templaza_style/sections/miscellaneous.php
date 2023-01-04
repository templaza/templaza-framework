<?php

defined('TEMPLAZA_FRAMEWORK') or exit();

use TemPlazaFramework\Media;

// -> START Miscellaneous
Templaza_API::set_section('templaza_style',
    array(
        'title'  => __( 'Miscellaneous', 'templaza-framework' ),
        'id'     => 'miscellaneous',
        'desc'   => __( 'These settings control the typography', 'templaza-framework' ),
        'icon'   => 'el-icon-cogs',
    )
);

// -> START Contact
Templaza_API::set_section('templaza_style',
    array(
        'title'   => __('Contact', 'templaza-framework'),
        'id'      => 'miscellaneous-contact',
        'subsection' => true,
        'fields'     => array(
            array(
                'id'       => 'enable-contact',
                'type'     => 'select',
                'title'    => __( 'Contact info', 'templaza-framework' ),
                'subtitle' => __( 'Enable or disable Contact info.', 'templaza-framework' ),
                'options'       => array(
                    'on'         => esc_html__('On', 'templaza-framework'),
                    'off'         => esc_html__('Off', 'templaza-framework'),
                ),
                'placeholder'   => esc_html__('Inherit', 'templaza-framework'),
                'select2'       => array( 'allowClear' => true ),
                'default'       => '',
            ),
            array(
                'id'       => 'enable-contact-location',
                'type'     => 'select',
                'title'    => __( 'Enable location', 'templaza-framework' ),
                'subtitle' => __( 'Enable or disable Location.', 'templaza-framework' ),
                'options'       => array(
                    'on'         => esc_html__('On', 'templaza-framework'),
                    'off'         => esc_html__('Off', 'templaza-framework'),
                ),
                'placeholder'   => esc_html__('Inherit', 'templaza-framework'),
                'select2'       => array( 'allowClear' => true ),
                'default'       => '',
                'required' => array( 'enable-contact', '!=', 'off' ),
            ),
            array(
                'id'          => 'contact-location-icon',
                'type'        => 'select',
                'title'       => __( 'Location icon', 'templaza-framework' ),
                'data'        => 'fontawesome',
                'required'  => array(
                    array( 'enable-contact', '!=', 'off' ),
                    array( 'enable-contact-location', '!=', 'off' ),
                ),
            ),
            array(
                'id'       => 'contact-location',
                'type'     => 'text',
                'title'    => __( 'Location', 'templaza-framework' ),
                'subtitle' => __( 'Enter your location address.', 'templaza-framework' ),
                'required'  => array(
                    array( 'enable-contact', '!=', 'off' ),
                    array( 'enable-contact-location', '!=', 'off' ),
                ),
            ),
            array(
                'id'       => 'enable-contact-email',
                'type'     => 'select',
                'title'    => __( 'Enable email', 'templaza-framework' ),
                'subtitle' => __( 'Enable or disable Email.', 'templaza-framework' ),
                'options'       => array(
                    'on'         => esc_html__('On', 'templaza-framework'),
                    'off'         => esc_html__('Off', 'templaza-framework'),
                ),
                'placeholder'   => esc_html__('Inherit', 'templaza-framework'),
                'select2'       => array( 'allowClear' => true ),
                'default'       => '',
                'required' => array( 'enable-contact', '!=', 'off' ),
            ),
            array(
                'id'          => 'contact-email-icon',
                'type'        => 'select',
                'title'       => __( 'Email icon', 'templaza-framework' ),
                'data'        => 'fontawesome',
                'required' => array(
                    array( 'enable-contact', '!=', 'off' ),
                    array( 'enable-contact-email', '!=', 'off' ),
                ),
            ),
            array(
                'id'       => 'contact-email',
                'type'     => 'text',
                'title'    => __( 'Email address', 'templaza-framework' ),
                'subtitle' => __( 'Enter your Email address.', 'templaza-framework' ),
                'required' => array(
                    array( 'enable-contact', '!=', 'off' ),
                    array( 'enable-contact-email', '!=', 'off' ),
                ),
            ),
            array(
                'id'       => 'enable-contact-phone',
                'type'     => 'select',
                'title'    => __( 'Enable phone', 'templaza-framework' ),
                'subtitle' => __( 'Enable or disable Phone.', 'templaza-framework' ),
                'options'       => array(
                    'on'         => esc_html__('On', 'templaza-framework'),
                    'off'         => esc_html__('Off', 'templaza-framework'),
                ),
                'placeholder'   => esc_html__('Inherit', 'templaza-framework'),
                'select2'       => array( 'allowClear' => true ),
                'default'       => '',
                'required' => array( 'enable-contact', '!=', 'off' ),
            ),
            array(
                'id'          => 'contact-phone-icon',
                'type'        => 'select',
                'title'       => __( 'Phone icon', 'templaza-framework' ),
                'data'        => 'fontawesome',
                'required' => array(
                    array( 'enable-contact', '!=', 'off' ),
                    array( 'enable-contact-phone', '!=', 'off' ),
                ),
            ),
            array(
                'id'       => 'contact-phone',
                'type'     => 'text',
                'title'    => __( 'Phone number', 'templaza-framework' ),
                'subtitle' => __( 'Enter your phone number.', 'templaza-framework' ),
                'required' => array(
                    array( 'enable-contact', '!=', 'off' ),
                    array( 'enable-contact-phone', '!=', 'off' ),
                ),
            ),
            array(
                'id'       => 'enable-contact-login',
                'type'     => 'select',
                'title'    => __( 'Enable login', 'templaza-framework' ),
                'subtitle' => __( 'Enable or disable Login.', 'templaza-framework' ),
                'options'       => array(
                    'on'         => esc_html__('On', 'templaza-framework'),
                    'off'         => esc_html__('Off', 'templaza-framework'),
                ),
                'placeholder'   => esc_html__('Inherit', 'templaza-framework'),
                'select2'       => array( 'allowClear' => true ),
                'default'       => '',
                'required' => array( 'enable-contact', '!=', 'off' ),
            ),
            array(
                'id'          => 'contact-login-icon',
                'type'        => 'select',
                'title'       => __( 'Login icon', 'templaza-framework' ),
                'data'        => 'fontawesome',
                'required' => array(
                    array( 'enable-contact', '!=', 'off' ),
                    array( 'enable-contact-login', '!=', 'off' ),
                ),
            ),
            array(
                'id'       => 'contact-login',
                'type'     => 'text',
                'title'    => __( 'Login label', 'templaza-framework' ),
                'subtitle' => __( 'Enter your login label.', 'templaza-framework' ),
                'required' => array(
                    array( 'enable-contact', '!=', 'off' ),
                    array( 'enable-contact-login', '!=', 'off' ),
                ),
            ),array(
                'id'       => 'enable-contact-register',
                'type'     => 'select',
                'title'    => __( 'Enable register', 'tztodaynews' ),
                'subtitle' => __( 'Enable or disable register.', 'tztodaynews' ),
                'options'       => array(
                    'on'         => esc_html__('On', 'tztodaynews'),
                    'off'         => esc_html__('Off', 'tztodaynews'),
                ),
                'placeholder'   => esc_html__('Inherit', 'tztodaynews'),
                'select2'       => array( 'allowClear' => true ),
                'default'       => '',
                'required' => array( 'enable-contact', '!=', 'off' ),
            ),
            array(
                'id'          => 'contact-register-icon',
                'type'        => 'select',
                'title'       => esc_html__( 'Register icon', 'tztodaynews' ),
                'data'        => 'fontawesome',
                'required'    => array(
                    array( 'enable-contact', '=', true ),
                    array( 'enable-contact-register', '=', true ),
                ),
            ),
            array(
                'id'       => 'contact-register',
                'type'     => 'text',
                'title'    => esc_html__( 'Register label', 'tztodaynews' ),
                'subtitle' => esc_html__( 'Enter your register label.', 'tztodaynews' ),
                'required'    => array(
                    array( 'enable-contact', '=', true ),
                    array( 'enable-contact-register', '=', true ),
                ),
            ),
        )
    )
);
// -> START Copyright
Templaza_API::set_section('templaza_style',
    array(
        'title'   => __('Copyright', 'templaza-framework'),
        'id'      => 'miscellaneous-copyrights',
        'subsection' => true,
        'fields'     => array(
            array(
                'id'       => 'enable-footer',
                'type'     => 'select',
                'title'    => __( 'Branding', 'templaza-framework' ),
                'subtitle' => __( 'Enable or disable the footer copyright bar.', 'templaza-framework' ),
                'options'       => array(
                    'on'         => esc_html__('On', 'templaza-framework'),
                    'off'         => esc_html__('Off', 'templaza-framework'),
                ),
                'placeholder'   => esc_html__('Inherit', 'templaza-framework'),
                'select2'       => array( 'allowClear' => true ),
                'default'       => '',
            ),
            array(
                'id'       => 'footer-copyright',
                'type'     => 'textarea',
                'title'    => __( 'Custom HTML', 'templaza-framework' ),
                'subtitle' => __( 'Enter the text that displays in the copyright bar. You can use <code>{year}</code> for current year and <code>{sitetitle}</code> for site name.', 'templaza-framework' ),
                'desc'     => __('HTML is allowed in here.', 'templaza-framework'),
                'validate' => 'html', //see http://codex.wordpress.org/Function_Reference/wp_kses_post
                'default'  => '© {sitetitle} {year}. Design by <a href="https://www.templaza.com/" title="TemPlaza">TemPlaza</a>',
                'required' => array( 'enable-footer', '!=', 'off' ),
            ),
        )
    )
);

// -> START Coming Soon
Templaza_API::set_section('templaza_style',
    array(
        'title'   => __('Coming Soon', 'templaza-framework'),
        'id'      => 'miscellaneous-comming-soons',
        'subsection' => true,
        'fields'     => array(
            array(
                'id'       => 'miscellaneous-development-mode',
                'type'     => 'select',
                'title'    => __( 'Development Mode', 'templaza-framework' ),
                'subtitle' => __( 'Enable development mode to take your site offline and show a static coming soon page.', 'templaza-framework' ),
                'options'       => array(
                    'on'        => esc_html__('On', 'templaza-framework'),
                    'off'       => esc_html__('Off', 'templaza-framework'),
                ),
                'placeholder'   => esc_html__('Inherit', 'templaza-framework'),
                'select2'       => array( 'allowClear' => true ),
                'default'       => '',
            ),
            array(
                'id'          => 'miscellaneous-logo',
                'type'        => 'media',
                'title'       => __( 'Logo', 'templaza-framework' ),
                'subtitle'    => __( 'Select a logo for coming soon page.', 'templaza-framework' ),
                'required'    => array(
                    array('miscellaneous-development-mode', '!=', 'off'),
                ),
            ),
            array(
                'id'          => 'miscellaneous-content',
                'type'        => 'textarea',
                'title'       => __( 'Content', 'templaza-framework' ),
                'subtitle'    => __( 'Enter your coming soon page content.', 'templaza-framework' ),
                'desc'        => __('HTML is allowed in here.', 'templaza-framework'),
                'validate'    => 'html', //see http://codex.wordpress.org/Function_Reference/wp_kses_post
                'required'    => array(
                    array('miscellaneous-development-mode', '!=', 'off'),
                ),
            ),
            array(
                'id'          => 'miscellaneous-coming-soon-countdown-date',
                'type'        => 'text',
                'title'       => __( 'Countdown Date', 'templaza-framework' ),
                'subtitle'    => __( 'Set a date for countdown.', 'templaza-framework' ),
                'required'    => array(
                    array('miscellaneous-development-mode', '!=', 'off'),
                ),
            ),
//            array(
//                'id'          => 'miscellaneous-coming-soon-social',
//                'type'        => 'select',
//                'title'       => __( 'Social Icons', 'templaza-framework' ),
//                'options'       => array(
//                    '1'         => esc_html__('On', 'templaza-framework'),
//                    '0'         => esc_html__('Off', 'templaza-framework'),
//                ),
//                'placeholder'   => esc_html__('Inherit', 'templaza-framework'),
//                'select2'       => array( 'allowClear' => true ),
//                'default'       => '',
//                'required'    => array(
//                    array('miscellaneous-development-mode', '!=', 'off'),
//                ),
//            ),
            array(
                'id'          => 'miscellaneous-background-setting',
                'type'        => 'select',
                'title'       => __( 'Background Type', 'templaza-framework' ),
                'options'     => array(
                    '0'     => __('None', 'templaza-framework'),
                    'color' => __('Color', 'templaza-framework'),
                    'image' => __('Image', 'templaza-framework'),
                    'video' => __('Video', 'templaza-framework'),
                ),
                'placeholder'   => esc_html__('Inherit', 'templaza-framework'),
                'select2'       => array( 'allowClear' => true ),
                'default'       => '',
                'required'    => array(
                    array('miscellaneous-development-mode', '!=', 'off'),
                ),
            ),array(
                'id'          => 'miscellaneous-background-color',
                'type'        => 'color_rgba',
                'title'       => __( 'Background Color', 'templaza-framework' ),
                'required'    => array(
                    array('miscellaneous-background-setting', '=', 'color'),
                ),
            ),
            array(
                'id'                => 'miscellaneous-background-image',
                'type'              => 'background',
                'title'             => __( 'Background Image', 'templaza-framework' ),
                'library_filter'    => Media::get_image_formats_by_mime_type(),
                'required'          => array(
                    array('miscellaneous-background-setting', '=', 'image'),
                ),
            ),
            array(
                'id'                => 'miscellaneous-background-video',
                'type'              => 'media',
                'title'             => __( 'Background Video', 'templaza-framework' ),
                'library_filter'    => Media::get_video_formats_by_mime_type(),
                'required'          => array(
                    array('miscellaneous-background-setting', '=', 'video'),
                ),
            ),
        )
    )
);

// -> START 404 Error
Templaza_API::set_section('templaza_style',
    array(
        'title'   => __('404 Error', 'templaza-framework'),
        'id'      => 'miscellaneous-404-errors',
        'subsection' => true,
        'fields'     => array(
            array(
                'id'         => '404-content',
                'type'       => 'ace_editor',
                'title'      => __( '404 Page Content', 'templaza-framework' ),
                'subtitle'   => __( 'Type the content of your 404 page. You can also use <code>{errorcode}</code> for system error code and <code>{errormessage}</code> for system error message.', 'templaza-framework' ),
                'desc'       => __('HTML is allowed in here.', 'templaza-framework'),
                'mode'       => 'html',
                'theme'      => 'chrome',
                'default'  => '',
            ),
            array(
                'id'          => '404-call-to-action',
                'type'        => 'text',
                'title'       => __( 'Call To Action', 'templaza-framework' ),
                'subtitle'    => __( 'Enter text to dislay on Call To Action Button.', 'templaza-framework' ),
                'default'     => 'Go Home',
                'placeholder'     => 'Go Home',
            ),
            array(
                'id'          => '404-background-setting',
                'type'        => 'select',
                'title'       => __( 'Background Type', 'templaza-framework' ),
                'options'     => array(
                    'none'    => __('None', 'templaza-framework'),
                    'color'   => __('Color', 'templaza-framework'),
                    'image'   => __('Image', 'templaza-framework'),
                    'video'   => __('Video', 'templaza-framework'),
                ),
                'placeholder'   => esc_html__('Inherit', 'templaza-framework'),
                'select2'       => array( 'allowClear' => true ),
                'default'       => '',
            ),
            array(
                'id'          => '404-background-color',
                'type'        => 'color_rgba',
                'title'       => __( 'Background Color', 'templaza-framework' ),
                'required'  => array('404-background-setting', '=', array('color','')),
            ),
            array(
                'id'          => '404-background',
                'type'        => 'background',
                'title'       => __( 'Background', 'templaza-framework' ),
                'required'  => array('404-background-setting', '=', array('','image')),
                'background-color' => false,
            ),
            array(
                'id'          => '404-background-video',
                'type'        => 'media',
                'title'       => __( 'Background Video', 'templaza-framework' ),
                'required'  => array('404-background-setting', '=', array('','video')),
            ),
        )
    )
);