<?php

defined('TEMPLAZA_FRAMEWORK') or exit();

// -> START Typography
Templaza_API::set_section('settings',
    array(
        'title'  => __( 'Custom Code', $this -> text_domain ),
        'id'     => 'customs',
        'icon'   => 'el el-magic',
        'fields' => array(
            array(
                'id'       => 'trackingcode-editor',
                'type'     => 'ace_editor',
                'mode'       => 'html',
                'theme'      => 'chrome',
                'title'    => __( 'Tracking Code', $this -> text_domain ),
                'subtitle' => __( 'Paste your tracking code here. This will be added into the header section of your template.', $this -> text_domain ),
            ),
            array(
                'id'       => 'beforehead-editor',
                'type'     => 'ace_editor',
                'mode'       => 'html',
                'theme'      => 'chrome',
    //            'full_width' => true,
                'title'    => esc_html__( 'Before </head>', $this -> text_domain ),
                'subtitle' => esc_html__( 'The code will display right before the closing </head> tag. Include <script> for JS and <style> for CSS.', $this -> text_domain ),
            ),
    //        array(
    //            'id'         => '404-content',
    //            'type'       => 'ace_editor',
    //            'title'      => __( '404 Page Content', $this -> text_domain ),
    //            'subtitle'   => __( 'Type the content of your 404 page. You can also use <code>{errorcode}</code> for system error code and <code>{errormessage}</code> for system error message.', $this -> text_domain ),
    //            'desc'       => __('HTML is allowed in here.', $this -> text_domain),
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
                'title'    => esc_html__( 'Before </body>', $this -> text_domain ),
                'subtitle' => esc_html__( 'The code will display right before the closing </body> tag. Include <script> for JS and <style> for CSS.', $this -> text_domain ),
            ),
            array(
                'id'       => 'customcss-editor',
                'type'     => 'ace_editor',
                'mode'       => 'css',
                'theme'      => 'monokai',
                'title'    => esc_html__( 'Custom CSS', $this -> text_domain ),
                'subtitle' => esc_html__( 'You can use custom CSS to add your own styles or overwrite default CSS. Do not include <style> tags.', $this -> text_domain ),
            ),
            array(
                'id'       => 'customcss-files',
                'type'     => 'textarea',
                'title'    => esc_html__( 'Custom CSS Files', $this -> text_domain ),
                'subtitle' => __( 'You can include css files by adding file path per line. You can use Full URL of the CSS file, or path of the CSS file relative to the Joomla root directory.<br> <b><code>styles.css</code></b> OR <b><code>https://www.somewebsite.com/styles.css</code></b>', $this -> text_domain ),
                'placeholder' => __('https://yourwebsite.com/style.css', $this -> text_domain),
            ),
            array(
                'id'       => 'customjs',
                'type'     => 'ace_editor',
                'mode'     => 'javascript',
                'theme'    => 'chrome',
                'title'    => esc_html__( 'Custom JS', $this -> text_domain ),
                'subtitle' => esc_html__( 'You can add custom javascript code here. Do not include <script> tags.', $this -> text_domain ),
            ),
            array(
                'id'       => 'customjs-files',
                'type'     => 'textarea',
                'title'    => esc_html__( 'Custom JS Files', $this -> text_domain ),
                'subtitle' => __( 'You can include javascript files by adding file path per line. <br> You can use Full URL of the script, or path of the script relative to the Joomla root directory.<br> <b><code>script.js</code></b> OR <b><code>https://www.somewebsite.com/script.js</code></b>', $this -> text_domain ),
                'placeholder' => __('https://yourwebsite.com/script.js', $this -> text_domain),
            ),
        )
    )
);
