<?php

defined('TEMPLAZA_FRAMEWORK') or exit();

// -> START Typography
$this -> sections[]	= array(
    'title'  => __( 'Custom Code', $this -> text_domain ),
    'id'     => 'customs',
    'icon'   => 'el el-magic',
    'fields' => array(
        array(
            'id'       => 'trackingcode-editor',
            'type'     => 'textarea',
            'title'    => __( 'Tracking Code', $this -> text_domain ),
            'subtitle' => __( 'Paste your tracking code here. This will be added into the header section of your template.', $this -> text_domain ),
        ),
        array(
            'id'       => 'beforehead-editor',
            'type'     => 'textarea',
            'title'    => esc_html__( 'Before </head>', $this -> text_domain ),
            'subtitle' => esc_html__( 'The code will display right before the closing </head> tag. Include <script> for JS and <style> for CSS.', $this -> text_domain ),
        ),
        array(
            'id'       => 'beforebody-editor',
            'type'     => 'textarea',
            'title'    => esc_html__( 'Before </body>', $this -> text_domain ),
            'subtitle' => esc_html__( 'The code will display right before the closing </body> tag. Include <script> for JS and <style> for CSS.', $this -> text_domain ),
        ),
        array(
            'id'       => 'customcss-editor',
            'type'     => 'textarea',
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
            'type'     => 'textarea',
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
);
