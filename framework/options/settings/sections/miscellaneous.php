<?php

defined('TEMPLAZA_FRAMEWORK') or exit();

// -> START Miscellaneous
Templaza_API::set_section('settings',
    array(
        'title'  => __( 'Miscellaneous', $this -> text_domain ),
        'id'     => 'miscellaneous',
        'desc'   => __( 'These settings control the typography', $this -> text_domain ),
        'icon'   => 'el-icon-cogs',
    )
);

// -> START Copyright
Templaza_API::set_section('settings',
    array(
        'title'   => __('Copyright', $this -> text_domain),
        'id'      => 'miscellaneous-copyrights',
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
            ),
        )
    )
);

// -> START Coming Soon
Templaza_API::set_section('settings',
    array(
        'title'   => __('Coming Soon', $this -> text_domain),
        'id'      => 'miscellaneous-comming-soons',
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
Templaza_API::set_section('settings',
    array(
        'title'   => __('404 Error', $this -> text_domain),
        'id'      => 'miscellaneous-404-errors',
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
                'background-color' => false,
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