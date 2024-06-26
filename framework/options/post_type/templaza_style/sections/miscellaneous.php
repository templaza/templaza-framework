<?php

defined('TEMPLAZA_FRAMEWORK') or exit();

use TemPlazaFramework\Media;

// -> START 404 Error
Templaza_API::set_section('templaza_style',
    array(
        'title'   => __('404 Error Page', 'templaza-framework'),
        'id'      => 'miscellaneous-404-errors',
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
                'default'     => '',
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
            array(
                'id'          => '404-background-overlay',
                'type'        => 'color_rgba',
                'title'       => __( 'Color Overlay', 'templaza-framework' ),
            ),
            array(
                'id'          => '404-title-color',
                'type'        => 'color_rgba',
                'title'       => __( 'Title Color', 'templaza-framework' ),
            ),
            array(
                'id'          => '404-text-color',
                'type'        => 'color_rgba',
                'title'       => __( 'Text Color', 'templaza-framework' ),
            ),
            array(
                'id'          => '404-input-bg',
                'type'        => 'color_rgba',
                'title'       => __( 'Input Background Color', 'templaza-framework' ),
            ),
            array(
                'id'          => '404-input-color',
                'type'        => 'color_rgba',
                'title'       => __( 'Input Color', 'templaza-framework' ),
            ),
        )
    )
);