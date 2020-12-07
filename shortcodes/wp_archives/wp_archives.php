<?php

defined('TEMPLAZA_FRAMEWORK') or exit();

use TemPlazaFramework\Functions;

if(!class_exists('TemplazaFramework_ShortCode_WP_Archives')){
    class TemplazaFramework_ShortCode_WP_Archives extends TemplazaFramework_ShortCode {

        public function register(){
            return array(
                'id'          => 'wp_archives',
                'icon'        => 'fas fa-archive',
                'title'       => __('WP Archives'),
                'param_title' => esc_html__('WP Archives Settings'),
                'desc'        => __('Load a WP Archives.'),
                'admin_label' => true,
                'params'      => array(
                    array(
                        'id'       => 'title',
                        'type'     => 'text',
                        'title'    => __( 'Widget Title', $this -> text_domain ),
                        'subtitle' => __( 'What text use as a widget title. Leave blank to use default widget title.', $this -> text_domain ),
                    ),
                    array(
                        'id'       => 'dropdown',
                        'type'     => 'switch',
                        'title'    => __( 'Dropdown', $this -> text_domain ),
                        'subtitle' => __( 'If set to On, archives will be display by dropdown.', $this -> text_domain ),
                    ),
                    array(
                        'id'       => 'count',
                        'type'     => 'switch',
                        'title'    => __( 'Show post counts', $this -> text_domain ),
                        'subtitle' => __( 'If set to On, the post count will be display.', $this -> text_domain ),
                    ),
//                    array(
//                        'id'       => 'options',
//                        'type'     => 'checkbox',
//                        'title'    => __( 'Display options', $this -> text_domain ),
//                        'subtitle' => __( 'Select display options for archives.', $this -> text_domain ),
//                        'options'  => array(
//                            'dropdown'     => __( 'Dropdown', $this -> text_domain ),
//                            'count'        => __( 'Show post counts', $this -> text_domain ),
//                        ),
//                    ),
                )
            );
        }
    }

}

?>