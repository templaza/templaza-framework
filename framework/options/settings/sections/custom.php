<?php

defined('TEMPLAZA_FRAMEWORK') or exit();

// -> START Typography
Templaza_API::set_section('settings',
    array(
        'title'  => __( 'Custom Code', 'templaza-framework' ),
        'id'     => 'customs',
        'icon'   => 'el el-magic',
        'fields' => array(
            array(
                'id'       => 'trackingcode-editor',
                'type'     => 'ace_editor',
                'mode'       => 'html',
                'theme'      => 'chrome',
                'title'    => __( 'Tracking Code', 'templaza-framework' ),
                'subtitle' => __( 'Paste your tracking code here. This will be added into the header section of your template.', 'templaza-framework' ),
            ),
            array(
                'id'       => 'beforehead-editor',
                'type'     => 'ace_editor',
                'mode'       => 'html',
                'theme'      => 'chrome',
    //            'full_width' => true,
                'title'    => esc_html__( 'Before </head>', 'templaza-framework' ),
                'subtitle' => esc_html__( 'The code will display right before the closing </head> tag. Include <script> for JS and <style> for CSS.', 'templaza-framework' ),
            ),
    //        array(
    //            'id'         => '404-content',
    //            'type'       => 'ace_editor',
    //            'title'      => __( '404 Page Content', 'templaza-framework' ),
    //            'subtitle'   => __( 'Type the content of your 404 page. You can also use <code>{errorcode}</code> for system error code and <code>{errormessage}</code> for system error message.', 'templaza-framework' ),
    //            'desc'       => __('HTML is allowed in here.', 'templaza-framework'),
    //            'theme'      => 'chrome',
    //            'full_width' => true,
    ////            'validate' => 'html', //see http://codex.wordpress.org/Function_Reference/wp_kses_post
    //            'default'  => '',
    //        ),
            array(
                'id'       => 'beforebody-editor',
                'type'     => 'ace_editor',
                'mode'       => 'html',
                'theme'      => 'chrome',
                'title'    => esc_html__( 'Before </body>', 'templaza-framework' ),
                'subtitle' => esc_html__( 'The code will display right before the closing </body> tag. Include <script> for JS and <style> for CSS.', 'templaza-framework' ),
            ),
            array(
                'id'       => 'customcss-editor',
                'type'     => 'ace_editor',
                'mode'       => 'css',
                'theme'      => 'monokai',
                'title'    => esc_html__( 'Custom CSS', 'templaza-framework' ),
                'subtitle' => esc_html__( 'You can use custom CSS to add your own styles or overwrite default CSS. Do not include <style> tags.', 'templaza-framework' ),
            ),
            array(
                'id'       => 'customcss-files',
                'type'     => 'textarea',
                'title'    => esc_html__( 'Custom CSS Files', 'templaza-framework' ),
                'subtitle' => __( 'You can include css files by adding file path per line. You can use Full URL of the CSS file, or path of the CSS file relative to the Joomla root directory.<br> <b><code>styles.css</code></b> OR <b><code>https://www.somewebsite.com/styles.css</code></b>', 'templaza-framework' ),
                'placeholder' => __('https://yourwebsite.com/style.css', 'templaza-framework'),
            ),
            array(
                'id'       => 'customjs',
                'type'     => 'ace_editor',
                'mode'     => 'javascript',
                'theme'    => 'chrome',
                'title'    => esc_html__( 'Custom JS', 'templaza-framework' ),
                'subtitle' => esc_html__( 'You can add custom javascript code here. Do not include <script> tags.', 'templaza-framework' ),
            ),
            array(
                'id'       => 'customjs-files',
                'type'     => 'textarea',
                'title'    => esc_html__( 'Custom JS Files', 'templaza-framework' ),
                'subtitle' => __( 'You can include javascript files by adding file path per line. <br> You can use Full URL of the script, or path of the script relative to the Joomla root directory.<br> <b><code>script.js</code></b> OR <b><code>https://www.somewebsite.com/script.js</code></b>', 'templaza-framework' ),
                'placeholder' => __('https://yourwebsite.com/script.js', 'templaza-framework'),
            ),
        )
    )
);
