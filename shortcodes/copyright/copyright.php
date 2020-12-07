<?php

defined('TEMPLAZA_FRAMEWORK') or exit();

use TemPlazaFramework\Functions;

if(!class_exists('TemplazaFramework_ShortCode_Copyright')){
    class TemplazaFramework_ShortCode_Copyright extends TemplazaFramework_ShortCode {

        public function register(){
            return array(
                'id'          => 'copyright',
//                'type'        => 'tz_element',
                'icon'        => 'far fa-copyright',
                'title'       => __('Copyright'),
                'desc'        => __('Load a copyright.'),
                'param_title' => __('Copyright settings'),
                'admin_label' => true,
                'params'      => array(
                ),
            );
        }
    }

}

?>