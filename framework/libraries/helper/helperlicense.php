<?php
/**
 * Base layout for all admin pages
 */

namespace TemPlazaFramework\Helpers;

defined( 'ABSPATH' ) || exit;

if(!class_exists('TemPlazaFramework\Helpers\HelperLicense')){
    class HelperLicense{
        protected static $cache  = array();

        public static function get_license($theme){
            $store_id   = __METHOD__;
            $store_id  .= ':'.$theme;
            $store_id   = md5($store_id);

            if(isset(self::$cache[$store_id])){
                return self::$cache[$store_id];
            }

            $theme    = strtolower($theme);

            $license = get_option(self::get_option_name($theme));

            if($license && !isset($license['purchase_code'])){
                $license['purchase_code']   = '';
            }
            self::$cache[$store_id] = $license;
            return self::$cache[$store_id];
        }

        public static function get_purchase_code($theme)
        {
            $theme = strtolower($theme);
            $license = self::get_license($theme);

            if (!$license || ($license && !$license['purchase_code'])) {
                return false;
            }

            return $license['purchase_code'];

        }

        public static function is_authorised($theme)
        {
            $theme      = strtolower($theme);
            $license    = self::get_license($theme);
            /* mode developer */
            if($license && isset($license['purchase_code']) && $license['purchase_code']=='developer'){
                return true;
            }

            if($license && isset($license['purchase_code']) && $license['purchase_code']){
                return true;
            }

            return false;
        }

        public static function has_expired($theme){
            $theme          = strtolower($theme);
            $license        = self::get_license($theme);

            /* mode developer */
            if($license && isset($license['purchase_code']) && $license['purchase_code']=='developer'){
                return false;
            }

            if(!$license || ($license && isset($license['purchase_code']) && !$license['purchase_code'])){
                return true;
            }

            $purchase_date  = isset($license['purchase_date'])?strtotime($license['purchase_date']):0;
            $support_until  = isset($license['supported_until'])?strtotime($license['supported_until']):0;

            /* mode developer */
            if($license && isset($license['purchase_code']) && $license['purchase_code']=='developer'){
                return false;
            }else{
                if($support_until < current_time('timestamp') || $support_until < $purchase_date){
                    return true;
                }
            }

            return false;
        }

        public static function get_option_name($theme){
            $theme  = strtolower($theme);
            $name   = '_'.TEMPLAZA_FRAMEWORK.'_envato_license__'.$theme;
            return $name;
        }

        public static function generate_secret_key($theme){

            $store_id   = __METHOD__;
            $store_id  .= ':'.$theme;
            $store_id   = md5($store_id);

            if(isset(self::$cache[$store_id])){
                return self::$cache[$store_id];
            }
            $theme    = strtolower($theme);

            self::$cache[$store_id] = md5(uniqid($theme));
            return self::$cache[$store_id];
        }

        public static function get_secret_key($theme){

            $store_id   = __METHOD__;
            $store_id  .= ':'.$theme;
            $store_id   = md5($store_id);

            if(isset(self::$cache[$store_id])){
                return self::$cache[$store_id];
            }

            $option = get_option(self::get_option_name($theme));
            self::$cache[$store_id] = $option['secret_key'];
//            $theme    = strtolower($theme);
//
//            self::$cache[$store_id] = md5(uniqid($theme));
            return self::$cache[$store_id];
        }
    }
}