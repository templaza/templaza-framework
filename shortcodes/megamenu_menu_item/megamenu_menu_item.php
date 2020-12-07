<?php

defined('TEMPLAZA_FRAMEWORK') or exit();

use TemPlazaFramework\Functions;

if(!class_exists('TemplazaFramework_ShortCode_Megamenu_Menu_Item')){
    class TemplazaFramework_ShortCode_Megamenu_Menu_Item extends TemplazaFramework_ShortCode {

        public function register(){
            return array(
                'id'          => 'megamenu_menu_item',
//                'type'        => 'tz_element',
//                'icon'        => 'fas fa-share-alt',
                'title'       => __('Megamenu Menu Item'),
                'desc'        => __('Load a Megamenu Menu Item.'),
                'param_title' => __('Megamenu Menu Item settings'),
                'core'        => true,
                'admin_label' => true,
                'params'      => array(
                ),
            );
        }


    }

}

?>