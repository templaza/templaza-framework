<?php

namespace TemPlazaFramework;

defined( 'TEMPLAZA_FRAMEWORK' ) || exit;

if(!class_exists('TemPlazaFramework\Menu_Admin')){

    class Menu_Admin {
        protected static $sections      = array();
        protected static $section_slugs = array();

//        protected static function default_args($page_prefix){
//            return array(
//                'url'               => 'admin.php?page='.TEMPLAZA_FRAMEWORK,
//                'add_admin_menu'    => true,
//            );
//        }
        public static function add_submenu_section($menu_name, $args = array(), $prefix = TEMPLAZA_FRAMEWORK){
            $page   = (!empty($menu_name) && $menu_name == TEMPLAZA_FRAMEWORK)?'':'_'.$menu_name;
            $page   = TEMPLAZA_FRAMEWORK.$page;

            $args['url']                = isset($args['url'])?$args['url']:'admin.php?page='.$page;
            $args['slug']               = $prefix?$prefix.'_'.$menu_name:$menu_name;
            if(!in_array($args['slug'] ,self::$section_slugs)){
                self::$section_slugs[]  = $args['slug'] ;
            }
            self::$sections[$menu_name] = !isset(self::$sections[$menu_name])?$args:self::$sections[$menu_name];
        }

        public static function get_menu_sections(){
            self::$sections = apply_filters( TEMPLAZA_FRAMEWORK.'_admin_menu_sections', self::$sections );
            return self::$sections;
        }
        public static function get_nav_tabs(){
            $nav_tabs = apply_filters( TEMPLAZA_FRAMEWORK.'_admin_nav_tabs', self::$sections );;
            return $nav_tabs;
        }

        public static function get_submenu_slugs(){
            return self::$section_slugs;
        }
    }
}