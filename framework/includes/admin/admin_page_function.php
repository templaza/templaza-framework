<?php

namespace TemPlazaFramework\Admin;

defined( 'ABSPATH' ) || exit;

use TemPlazaFramework\Functions;

if(!class_exists('TemPlazaFramework\Admin\Admin_Page_Function')){


    class Admin_Page_Function{
        protected static $cache    = array();

//        public static function get_my_plugin_data(){
//            $storeId    = md5(__METHOD__);
//
//            if(isset(self::$cache[$storeId])){
//                return self::$cache[$storeId];
//            }
//
//            $file   = TEMPLAZA_FRAMEWORK_INSTALLATION_PATH.'/'.TEMPLAZA_FRAMEWORK_NAME.'.php';
//
//            if(!file_exists($file)){
//                return false;
//            }
//            if( !function_exists('get_plugin_data') ){
//                require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
//            }
//
//            if($plugin = \get_plugin_data( $file, true, true )){
//
//                $other_data = get_file_data( $file,
//                    array(
//                        'Forum' => 'Forum',
//                        'Ticket' => 'Ticket',
//                        'FanPage' => 'FanPage',
//                        'Twitter' => 'Twitter',
//                        'Google' => 'Google+'
//                    ),
//                    'plugin' );
//                $plugin = array_merge($plugin, $other_data);
//
//                self::$cache[$storeId]  = $plugin;
//                return $plugin;
//            }
//            return false;
//        }

        public static function get_plugin_url(){
            return plugins_url().'/'.TEMPLAZA_FRAMEWORK_NAME;
        }

        public static function get_plugin_version(){
            return Functions::get_my_version();
        }

        public static function get_template_directory(){
            $folder   = get_template_directory().'/'.TEMPLAZA_FRAMEWORK_NAME.'/framework/templates';
            if(!is_dir($folder)){
                $folder   = TEMPLAZA_FRAMEWORK_CORE_TEMPLATE;
            }
            if(file_exists($folder)){
                return $folder;
            }
            return false;
        }

        public static function get_template_file($layout, $view = ''){

            if(!$layout){
                return false;
            }

            $file = self::get_template_directory().($view?'/'.$view:'').'/'.$layout.'.php';

            if(file_exists($file)){
                return $file;
            }

            return false;
        }

        public static function get_text_domain_name(){
            $text_domain = Functions::get_my_text_domain();
            return $text_domain;
        }

        public static function get_page_type(){
            if(!isset($_GET['page']) || (isset($_GET['page']) && !$_GET['page'])){
                return false;
            }

            $page   = $_GET['page'];
            $type       = preg_replace('/^'.TEMPLAZA_FRAMEWORK.'[-_]?/i', '', $page);
            return $type;
        }

        /**
         * Check if a plugin is installed. Does not take must-use plugins into account.
         *
         * @since 1.0.0
         *
         * @param string $slug Plugin slug.
         * @return bool True if installed, false otherwise.
         */
        public static function is_plugin_installed( $slug ) {
            $installed_plugins = self::get_plugins(); // Retrieve a list of all installed plugins (WP cached).

            $filePath   = self::_get_plugin_basename_from_slug($slug);

            return ( ! empty( $installed_plugins[$filePath ] ) );
        }

        /**
         * Check if a plugin is active.
         *
         * @since 1.0.0
         *
         * @param string $slug Plugin slug.
         * @return bool True if active, false otherwise.
         */
        public static function is_plugin_active( $slug ) {
            $filePath   = self::_get_plugin_basename_from_slug($slug);
            return \is_plugin_active( $filePath );
        }

        public static function get_plugins( $plugin_folder = '' ) {
            if ( ! function_exists( 'get_plugins' ) ) {
                require_once ABSPATH . 'wp-admin/includes/plugin.php';
            }

            return \get_plugins( $plugin_folder );
        }

        public static function get_plugin_version_by_slug($slug){
            $filePath   = WP_PLUGIN_DIR . '/' .self::_get_plugin_basename_from_slug($slug);

            if(file_exists($filePath)) {
                $plugin = get_file_data($filePath, array('Version' => 'Version'), false);
                if($plugin && isset($plugin['Version']) && $plugin['Version']){
                    return $plugin['Version'];
                }
            }

            return false;
        }

        protected static function _get_plugin_basename_from_slug( $slug ) {
            $keys = array_keys( self::get_plugins() );

            foreach ( $keys as $key ) {
                if ( preg_match( '|^' . $slug . '/|', $key ) ) {
                    return $key;
                }
            }

            return $slug;
        }

        public static function generate_date_number_to_string($dateNumber, $year = false, $month = false, $week = false, $day = true){
            $dateNumber = ceil($dateNumber / 24 / 60 / 60);

            if($dateNumber < 1 || (!$year && !$month && !$week && !$day)){
                return sprintf( _n( '%s day', '%s days', (int) 0, 'templaza-framework' ), (int) 0 );
            }

            $str    = array();

            if($year){
                $yearNumber = (int) ($dateNumber / 365);
                if($yearNumber >= 1) {
                    $dateNumber -= (365 * $yearNumber);
                    $str[]  = sprintf( _n( '%s year', '%s years', (int) $yearNumber, 'templaza-framework' ), (int) $yearNumber );
                }
            }

            if($month){
                $monthNumber    = (int) ($dateNumber / 30);
                if($monthNumber >= 1) {
                    $dateNumber -= $monthNumber * 30;
                    $str[]  = sprintf( _n( '%s month', '%s months', (int) $monthNumber, 'templaza-framework' ), (int) $monthNumber );
                }
            }

            if($week){
                $weekNumber    = (int) ($dateNumber / 7);
                if($weekNumber >= 1) {
                    $dateNumber -= $weekNumber * 7;
                    $str[]  = sprintf( _n( '%s week', '%s weeks', (int) $weekNumber, 'templaza-framework' ), (int) $weekNumber );
                }
            }
            if($day){
                $dayNumber    = (int) $dateNumber;
                if($dayNumber >= 1) {
                    $str[]  = sprintf( _n( '%s day', '%s days', (int) $dayNumber, 'templaza-framework' ), (int) $dayNumber );
                }
            }

            return implode(' ', $str);
        }
    }
}