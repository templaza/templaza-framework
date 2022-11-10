<?php

defined('TEMPLAZA_FRAMEWORK') or exit();

use TemPlazaFramework\Functions;

if(!class_exists('TemplazaFramework_ShortCode_Megamenu_Menu_Item')){
    class TemplazaFramework_ShortCode_Megamenu_Menu_Item extends TemplazaFramework_ShortCode {

        public function register(){
            return array(
                'id'          => 'megamenu_menu_item',
//                'type'        => 'megamenu_item',
//                'type'        => 'tz_element',
//                'icon'        => 'fas fa-share-alt',
//                'menu_id'        => 2579,
                'title'          => __('Megamenu Menu Item'),
                'desc'           => __('Load a Megamenu Menu Item.'),
                'param_title'    => __('Megamenu Menu Item settings'),
                'core'           => true,
                'admin_label'    => true,
                'show_duplicate' => false,
                'show_delete'    => false,
                'params'         => array(
                    array(
                        'id' => 'menu_id',
                        'type' => 'text',
                        'title'      => __('Menu Id', 'templaza-framework'),
                        'attributes' => array(
                            'readonly'     => 'readonly',
                        )
                    ),
//                    array(
//                        'id'         => 'menu_slug',
//                        'type'       => 'text',
//                        'title'      => __('Menu Slug', 'templaza-framework'),
//                        'attributes' => array(
////                            'type' => 'hidden'
//                            'readonly'     => 'readonly',
//                        )
//                    ),
                ),
            );
        }
        public function prepare_params($params, $element,$parent_el){

            if(isset($element['menu_id'])){
                $params['menu_id']  = $element['menu_id'];
            }
            if(isset($element['menu_slug'])){
                $params['menu_slug']  = $element['menu_slug'];
            }
            return $params;
        }

        public function enqueue() {
            if (!wp_script_is('templaza-shortcode-'.$this -> get_shortcode_name().'-js')) {
//            if (!wp_script_is('templaza-shortcode-'.$this -> get_shortcode_name().'-js', 'registered')) {
                wp_enqueue_script(
                    'templaza-shortcode-'.$this -> get_shortcode_name().'-js',
                    \TemPlazaFramework\Functions::get_my_url() . '/shortcodes/'.$this -> get_shortcode_name()
                    .'/'.$this -> get_shortcode_name().'.js',
                    array( 'jquery', 'jquery-ui-tabs', 'wp-util', 'redux-js', TEMPLAZA_FRAMEWORK_NAME.'__js'),
                    time(),
                    'all'
                );
            }
        }


    }

}

?>