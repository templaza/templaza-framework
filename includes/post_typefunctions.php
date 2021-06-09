<?php

namespace TemPlazaFramework;

defined( 'ABSPATH' ) || exit;

use ScssPhp\ScssPhp\Compiler;

if(!class_exists('TemPlazaFramework\Post_TypeFunctions')){

    class Post_TypeFunctions
    {
        protected static $cache = array();
        protected static $post_types = false;
        protected static $excluded_post_types = false;

        /**
         * @return array|bool
         */
        public static function getPostTypes(){
            $store_id   = __METHOD__;
            $store_id   = md5($store_id);

            if(isset(self::$cache[$store_id])){
                return self::$cache[$store_id];
            }


            if ( false === self::$post_types ) {
                self::$post_types = array();
                $exclude = self::getExcludePostTypes();
                foreach ( get_post_types( array( 'public' => true ) ) as $post_type ) {
                    if ( ! in_array( $post_type, $exclude, true ) ) {
                        self::$post_types[] = $post_type;
                    }
                }
            }

            return self::$post_types;
        }

        /**
         * @return bool|mixed|void
         */
        public static function getExcludePostTypes(){
            if ( false === self::$excluded_post_types ) {
                self::$excluded_post_types = apply_filters( 'templaza-framework/functions/post-type/settings_exclude_post_type', array(
                    'templaza_style',
                    'attachment',
                    'revision',
                    'nav_menu_item',
                    'mediapage',
                ) );
            }

            return self::$excluded_post_types;
        }

    }
}