<?php

defined('TEMPLAZA_FRAMEWORK') or exit();

// -> START Typography
Redux::setSection( $opt_name, array(
    'title'  => __( 'Typography', $this -> text_domain ),
    'id'     => 'typography',
    'desc'   => __( 'For full documentation on this field, visit: ', $this -> text_domain ) . '<a href="//docs.reduxframework.com/core/fields/typography/" target="_blank">docs.reduxframework.com/core/fields/typography/</a>',
    'icon'   => 'el el-font',
    'fields' => array(
        array(
            'id'       => 'opt-typography-body',
            'type'     => 'typography',
            'title'    => __( 'Body Font', $this -> text_domain ),
            'subtitle' => __( 'Specify the body font properties.', $this -> text_domain ),
            'google'   => true,
            'output' => array('h1, h2, h3, h4'),
            'default'  => array(
                'color'       => '#dd9933',
                'font-size'   => '30px',
                'font-family' => 'Arial,Helvetica,sans-serif',
                'font-weight' => 'Normal',
            ),
        ),
        array(
            'id'          => 'opt-typography',
            'type'        => 'typography',
            'title'       => __( 'Typography h2.site-description', $this -> text_domain ),
            //'compiler'      => true,  // Use if you want to hook in your own CSS compiler
            //'google'      => false,
            // Disable google fonts. Won't work if you haven't defined your google api key
            'font-backup' => true,
            // Select a backup non-google font in addition to a google font
            //'font-style'    => false, // Includes font-style and weight. Can use font-style or font-weight to declare
            //'subsets'       => false, // Only appears if google is true and subsets not set to false
            //'font-size'     => false,
            //'line-height'   => false,
            //'word-spacing'  => true,  // Defaults to false
            //'letter-spacing'=> true,  // Defaults to false
            //'color'         => false,
            //'preview'       => false, // Disable the previewer
            'all_styles'  => true,
            // Enable all Google Font style/weight variations to be added to the page
            'output'      => array( '.site-description' ),
            // An array of CSS selectors to apply this font style to dynamically
            'compiler'    => array( 'site-description-compiler' ),
            // An array of CSS selectors to apply this font style to dynamically
            'units'       => 'px',
            // Defaults to px
            'subtitle'    => __( 'Typography option with each property can be called individually.', $this -> text_domain ),
            'default'     => array(
                'color'       => '#333',
                'font-style'  => '700',
                'font-family' => 'Abel',
                'google'      => true,
                'font-size'   => '33px',
                'line-height' => '40px'
            ),
        ),
    )
) );