<?php

defined('TEMPLAZA_FRAMEWORK') or exit();

use TemPlazaFramework\Functions;

if(!class_exists('TemplazaFramework_ShortCode_Contact')){
    class TemplazaFramework_ShortCode_Contact extends TemplazaFramework_ShortCode {

        public function register(){
            return array(
                'id'          => 'contact',
//                'type'        => 'tz_element',
                'icon'        => 'far fa-address-book',
                'title'       => __('Contact'),
                'desc'        => __('Load a contact.'),
                'param_title' => __('Contact settings'),
                'admin_label' => true,
                'params'      => array(
                ),
            );
        }
    }
}
?>