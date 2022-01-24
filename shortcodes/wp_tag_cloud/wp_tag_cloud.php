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
                        'title'    => __( 'Widget Title', $this -> text_domain ),
                        'subtitle' => __( 'What text use as a widget title. Leave blank to use default widget title.', $this -> text_domain ),
                    ),
                    array(
                        'id'       => 'widget_heading',
                        'type'     => 'select',
                        'title'    => esc_html__('Widget Title HTML Element', $this -> text_domain),
                        'subtitle' => esc_html__('Select Widget title HTML element from the list', $this -> text_domain),
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
                        'title'         => esc_html__('Widget Title Style',  $this -> text_domain),
                        'subtitle'      => esc_html__('Heading styles differ in font-size but may also come with a predefined color, size and font',  $this -> text_domain),
                        'options'       => array(
                            ''                  => esc_html__('None',  $this -> text_domain),
                            'heading-2xlarge'   => esc_html__('2XLarge',  $this -> text_domain),
                            'heading-xlarge'    => esc_html__('XLarge',  $this -> text_domain),
                            'heading-large'     => esc_html__('Large',  $this -> text_domain),
                            'heading-medium'    => esc_html__('Medium',  $this -> text_domain),
                            'heading-small'     => esc_html__('Small',  $this -> text_domain),
                            'h1'                => esc_html__('H1',  $this -> text_domain),
                            'h2'                => esc_html__('H2',  $this -> text_domain),
                            'h3'                => esc_html__('H3',  $this -> text_domain),
                            'h4'                => esc_html__('H4',  $this -> text_domain),
                            'h5'                => esc_html__('H5',  $this -> text_domain),
                            'h6'                => esc_html__('H6',  $this -> text_domain),
                        ),
                        'default'       => '',
                    ),
                    array(
                        'id'       => 'taxonomy',
                        'type'     => 'select',
                        'data'     => 'taxonomies',
                        'title'    => __( 'Taxonomy', $this -> text_domain ),
                        'subtitle' => __( 'Select source for tag cloud.', $this -> text_domain ),
                    ),
                    array(
                        'id'       => 'count',
                        'type'     => 'switch',
                        'title'    => __( 'Show tag counts', $this -> text_domain ),
                        'subtitle' => __( 'If set to On, tag count will be display.', $this -> text_domain ),
                    ),
                )
            );
        }
    }

}

?>