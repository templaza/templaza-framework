<?php

defined('TEMPLAZA_FRAMEWORK') or exit();

use TemPlazaFramework\Functions;

if(!class_exists('TemplazaFramework_ShortCode_Sidebar')){
    class TemplazaFramework_ShortCode_Sidebar extends TemplazaFramework_ShortCode {

        public function register(){
            return array(
                'id'          => 'sidebar',
                'icon'        => 'el el-credit-card rotate-n90',
                'title'       => __('Sidebar'),
                'param_title' => esc_html__('Sidebar Settings'),
                'desc'        => __('Load a sidebar.'),
                'admin_label' => true,
                'params'      => array(
                    array(
                        'id'       => 'sidebar',
                        'type'     => 'select',
                        'data'     => 'sidebars',
                        'title'    => __( 'Sidebar', $this -> text_domain ),
                        'subtitle' => __( 'Select Sidebar.', $this -> text_domain ),
                    ),
                )
            );
        }
    }

}

?>