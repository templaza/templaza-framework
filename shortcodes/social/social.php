<?php

defined('TEMPLAZA_FRAMEWORK') or exit();

use TemPlazaFramework\Functions;

if(!class_exists('TemplazaFramework_ShortCode_Social')){
    class TemplazaFramework_ShortCode_Social extends TemplazaFramework_ShortCode {

        public function register(){
            return array(
                'id'          => 'social',
                'icon'        => 'fas fa-share-alt',
                'title'       => __('Social'),
                'desc'        => __('Load a social.'),
                'param_title' => __('Social settings'),
                'admin_label' => true,
                'params'      => array(
                )
            );
        }


    }

}

?>