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