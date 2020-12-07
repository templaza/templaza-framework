<?php

defined('TEMPLAZA_FRAMEWORK') or exit();

use TemPlazaFramework\Functions;

if(!class_exists('TemplazaFramework_ShortCode_WP_Menu')){
    class TemplazaFramework_ShortCode_WP_Menu extends TemplazaFramework_ShortCode {

        public function register(){
            return array(
                'id'          => 'wp_menu',
                'icon'        => 'el el-lines',
                'title'       => __('WP Menu'),
                'param_title' => esc_html__('WP Menu Settings'),
                'desc'        => __('Load a WP Menu.'),
                'admin_label' => true,
                'params'      => array(
                    array(
                        'id'       => 'title',
                        'type'     => 'text',
                        'title'    => __( 'Widget Title', $this -> text_domain ),
                        'subtitle' => __( 'What text use as a widget title. Leave blank to use default widget title..', $this -> text_domain ),
                    ),
                    array(
                        'id'       => 'nav_menu',
                        'type'     => 'select',
                        'data'     => 'menus',
                        'title'    => __( 'Menu', $this -> text_domain ),
                        'subtitle' => __( 'Select menu.', $this -> text_domain ),
                    ),
                )
            );
        }
    }

}

?>