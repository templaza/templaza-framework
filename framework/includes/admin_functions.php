<?php

namespace TemPlazaFramework;

defined( 'ABSPATH' ) || exit;

if(!class_exists('TemPlazaFramework\Admin_Functions')){

    class Admin_Functions extends Functions {
        public static function is_post_type($post_type){
            $is_post_type = false;
            if((isset($_GET['post_type']) && $_GET['post_type'] == $post_type)
                || (isset($_GET['post']) && get_post_type( $_GET['post'] ) == $post_type)) {
                $is_post_type = true;
            }
            return $is_post_type;
        }

        public static function is_home($post_id){
            if(!$post_id){
                return false;
            }
            $is_home = (bool) get_post_meta($post_id, 'home', true);
            return $is_home;
        }
    }
}