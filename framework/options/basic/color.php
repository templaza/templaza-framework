<?php

defined('TEMPLAZA_FRAMEWORK') or exit();

// -> START Color Selection
Redux::setSection( $opt_name, array(
    'title' => __( 'Color Options', $this -> text_domain),
    'id'    => 'color',
    'desc'  => __( '', $this -> text_domain ),
    'icon'  => 'el el-brush'
) );

Redux::setSection( $opt_name, array(
    'title'      => __( 'Color', $this -> text_domain ),
    'id'         => 'color-Color',
    'desc'       => __( 'For full documentation on this field, visit: ', $this -> text_domain ) . '<a href="//docs.reduxframework.com/core/fields/color/" target="_blank">docs.reduxframework.com/core/fields/color/</a>',
    'subsection' => true,
    'fields'     => array(
        array(
            'id'       => 'opt-color-title',
            'type'     => 'color',
            'output'   => array( '.site-title' ),
            'title'    => __( 'Site Title Color', $this -> text_domain ),
            'subtitle' => __( 'Pick a title color for the theme (default: #000).', $this -> text_domain ),
            'default'  => '#000000',
        ),
        array(
            'id'       => 'opt-color-footer',
            'type'     => 'color',
            'title'    => __( 'Footer Background Color', $this -> text_domain ),
            'subtitle' => __( 'Pick a background color for the footer (default: #dd9933).', $this -> text_domain ),
            'default'  => '#dd9933',
            'validate' => 'color',
        ),
    ),
) );
Redux::setSection( $opt_name, array(
    'title'      => __( 'Color Gradient', $this -> text_domain ),
    'desc'       => __( 'For full documentation on this field, visit: ', $this -> text_domain ) . '<a href="//docs.reduxframework.com/core/fields/color-gradient/" target="_blank">docs.reduxframework.com/core/fields/color-gradient/</a>',
    'id'         => 'color-gradient',
    'subsection' => true,
    'fields'     => array(
        array(
            'id'       => 'opt-color-header',
            'type'     => 'color_gradient',
            'title'    => __( 'Header Gradient Color Option', $this -> text_domain ),
            'subtitle' => __( 'Only color validation can be done on this field type', $this -> text_domain ),
            'desc'     => __( 'This is the description field, again good for additional info.', $this -> text_domain ),
            'default'  => array(
                'from' => '#1e73be',
                'to'   => '#00897e'
            )
        ),
    )
) );
Redux::setSection( $opt_name, array(
    'title'      => __( 'Color RGBA', $this -> text_domain ),
    'desc'       => __( 'For full documentation on this field, visit: ', $this -> text_domain ) . '<a href="//docs.reduxframework.com/core/fields/color-rgba/" target="_blank">docs.reduxframework.com/core/fields/color-rgba/</a>',
    'id'         => 'color-rgba',
    'subsection' => true,
    'fields'     => array(
        array(
            'id'       => 'opt-color-rgba',
            'type'     => 'color_rgba',
            'title'    => __( 'Color RGBA', $this -> text_domain ),
            'subtitle' => __( 'Gives you the RGBA color.', $this -> text_domain ),
            'default'  => array(
                'color' => '#7e33dd',
                'alpha' => '.8'
            ),
            //'output'   => array( 'body' ),
            'mode'     => 'background',
            //'validate' => 'colorrgba',
        ),
    )
) );
Redux::setSection( $opt_name, array(
    'title'      => __( 'Link Color', $this -> text_domain ),
    'desc'       => __( 'For full documentation on this field, visit: ', $this -> text_domain ) . '<a href="//docs.reduxframework.com/core/fields/link-color/" target="_blank">docs.reduxframework.com/core/fields/link-color/</a>',
    'id'         => 'color-link',
    'subsection' => true,
    'fields'     => array(
        array(
            'id'       => 'opt-link-color',
            'type'     => 'link_color',
            'title'    => __( 'Links Color Option', $this -> text_domain ),
            'subtitle' => __( 'Only color validation can be done on this field type', $this -> text_domain ),
            'desc'     => __( 'This is the description field, again good for additional info.', $this -> text_domain ),
            //'regular'   => false, // Disable Regular Color
            //'hover'     => false, // Disable Hover Color
            //'active'    => false, // Disable Active Color
            //'visited'   => true,  // Enable Visited Color
            'default'  => array(
                'regular' => '#aaa',
                'hover'   => '#bbb',
                'active'  => '#ccc',
            )
        ),
    )
) );

Redux::setSection( $opt_name, array(
    'title'      => __( 'Palette Colors', $this -> text_domain ),
    'desc'       => __( 'For full documentation on this field, visit: ', $this -> text_domain ) . '<a href="//docs.reduxframework.com/core/fields/palette-color/" target="_blank">docs.reduxframework.com/core/fields/palette-color/</a>',
    'id'         => 'color-palette',
    'subsection' => true,
    'fields'     => array(
        array(
            'id'       => 'opt-palette-color',
            'type'     => 'palette',
            'title'    => __( 'Palette Color Option', $this -> text_domain ),
            'subtitle' => __( 'Only color validation can be done on this field type', $this -> text_domain ),
            'desc'     => __( 'This is the description field, again good for additional info.', $this -> text_domain ),
            'default'  => 'red',
            'palettes' => array(
                'red'  => array(
                    '#ef9a9a',
                    '#f44336',
                    '#ff1744',
                ),
                'pink' => array(
                    '#fce4ec',
                    '#f06292',
                    '#e91e63',
                    '#ad1457',
                    '#f50057',
                ),
                'cyan' => array(
                    '#e0f7fa',
                    '#80deea',
                    '#26c6da',
                    '#0097a7',
                    '#00e5ff',
                ),
            )
        ),
    )
) );