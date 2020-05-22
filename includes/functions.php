<?php

namespace TemPlazaFramework;

defined( 'ABSPATH' ) || exit;

if(!class_exists('TemPlazaFramework\Functions')){

    class Functions{
        protected static $cache    = array();

        public static function get_my_data(){
            $storeId    = md5(__METHOD__);

            if(isset(self::$cache[$storeId])){
                return self::$cache[$storeId];
            }

            $file   = TEMPLAZA_FRAMEWORK_PATH.'/'.TEMPLAZA_FRAMEWORK_NAME.'.php';

            if(!file_exists($file)){
                return false;
            }
            if( !function_exists('get_plugin_data') ){
                require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
            }

            if($plugin = get_plugin_data( $file, true, true )){

                $other_data = get_file_data( $file,
                    array(
                        'Forum' => 'Forum',
                        'Ticket' => 'Ticket',
                        'FanPage' => 'FanPage',
                        'Twitter' => 'Twitter',
                        'Google' => 'Google+'
                    ),
                    'plugin' );
                $plugin = array_merge($plugin, $other_data);

                self::$cache[$storeId]  = $plugin;
                return $plugin;
            }
            return false;
        }

//        public static function get_my_name(){
//            $plugin = self::get_my_plugin_data();
//
//            return $plugin['Name'];
//        }

        public static function get_my_url(){
            return plugins_url().'/'.TEMPLAZA_FRAMEWORK_NAME;
        }
        public static function get_my_frame_url(){
            return plugins_url().'/'.TEMPLAZA_FRAMEWORK_NAME.'/framework';
        }

        public static function get_my_version(){
            $plugin = self::get_my_data();

            return $plugin['Version'];
        }

        public static function get_my_text_domain(){
            $plugin = self::get_my_data();

            if(!$plugin){
                return false;
            }
            return $plugin['TextDomain'];
        }

//        public static function get_my_template_directory(){
//            $file   = get_template_directory().'/'.TEMPLAZA_FRAMEWORK_NAME;
//            if(!file_exists($file)){
//                $file   = TEMPLAZA_FRAMEWORK_PATH.'/templates';
//            }
//            if(file_exists($file)){
//                return $file;
//            }
//            return false;
//        }

//        public static function get_my_page_type(){
//            if(!isset($_GET['page']) || (isset($_GET['page']) && !$_GET['page'])){
//                return false;
//            }
//
//            $page   = $_GET['page'];
//            $type       = preg_replace('/^'.PLAZART_INSTALLATION_PREFIX.'[-]?/i', '', $page);
//            return $type;
//        }
    }
}