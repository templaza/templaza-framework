<?php

defined('TEMPLAZA_FRAMEWORK') or exit();

use TemPlazaFramework\Functions;

if(!class_exists('TemplazaFramework_ShortCode_WP_Tag_Cloud')){
    class TemplazaFramework_ShortCode_WP_Tag_Cloud extends TemplazaFramework_ShortCode {

        public function register(){
            return array(
                'id'          => 'wp_tag_cloud',
                'icon'        => 'el el-tags',
                'title'       => __('WP Tag Cloud'),
                'param_title' => esc_html__('WP Tag Cloud Settings'),
                'desc'        => __('Load a WP Tag Cloud.'),
                'admin_label' => true,
                'params'      => array(
                    array(
                        'id'       => 'title',
                        'type'     => 'text',
                        'title'    => __( 'Widget Title', 'templaza-framework' ),
                        'subtitle' => __( 'What text use as a widget title. Leave blank to use default widget title.', 'templaza-framework' ),
                    ),
                    array(
                        'id'       => 'widget_heading',
                        'type'     => 'select',
                        'title'    => esc_html__('Widget Title HTML Element', 'templaza-framework'),
                        'subtitle' => esc_html__('Select Widget title HTML element from the list', 'templaza-framework'),
                        'options'  => array(
                            'h1'   => 'h1',
                            'h2'   => 'h2',
                            'h3'   => 'h3',
                            'h4'   => 'h4',
                            'h5'   => 'h5',
                            'h6'   => 'h6',
                        ),
                        'default'  => 'h3',
//                        'required' => array('title', 'not_empty_and', ''),
                        'required' => array('title', 'not', ''),
                    ),
                    array(
                        'type'          => 'select',
                        'id'            => 'widget_heading_style',
                        'title'         => esc_html__('Widget Title Style',  'templaza-framework'),
                        'subtitle'      => esc_html__('Heading styles differ in font-size but may also come with a predefined color, size and font',  'templaza-framework'),
                        'options'       => array(
                            ''                  => esc_html__('None',  'templaza-framework'),
                            'heading-2xlarge'   => esc_html__('2XLarge',  'templaza-framework'),
                            'heading-xlarge'    => esc_html__('XLarge',  'templaza-framework'),
                            'heading-large'     => esc_html__('Large',  'templaza-framework'),
                            'heading-medium'    => esc_html__('Medium',  'templaza-framework'),
                            'heading-small'     => esc_html__('Small',  'templaza-framework'),
                            'h1'                => esc_html__('H1',  'templaza-framework'),
                            'h2'                => esc_html__('H2',  'templaza-framework'),
                            'h3'                => esc_html__('H3',  'templaza-framework'),
                            'h4'                => esc_html__('H4',  'templaza-framework'),
                            'h5'                => esc_html__('H5',  'templaza-framework'),
                            'h6'                => esc_html__('H6',  'templaza-framework'),
                        ),
                        'default'       => '',
                    ),
                    array(
                        'id'       => 'taxonomy',
                        'type'     => 'select',
                        'data'     => 'taxonomies',
                        'title'    => __( 'Taxonomy', 'templaza-framework' ),
                        'subtitle' => __( 'Select source for tag cloud.', 'templaza-framework' ),
                    ),
                    array(
                        'id'       => 'count',
                        'type'     => 'switch',
                        'title'    => __( 'Show tag counts', 'templaza-framework' ),
                        'subtitle' => __( 'If set to On, tag count will be display.', 'templaza-framework' ),
                    ),
                )
            );
        }
    }

}

?>