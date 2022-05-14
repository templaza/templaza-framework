<?php

namespace TemPlazaFramework\AdminHelper;

defined( 'TEMPLAZA_FRAMEWORK' ) || exit;

if(!class_exists('TemPlazaFramework\AdminHelper\Templaza_Footer')){
    class Templaza_Footer{

        protected static $cache = array();

        public static function get_items_by_slug(){
            $store_id   = md5(__METHOD__);

            if(isset(static::$cache[$store_id])){
                return static::$cache[$store_id];
            }

            $args     = array(
                'post_type'      => 'templaza_footer',
                'posts_per_page' => -1,
                'orderby'        => 'title',
                'order'          => 'ASC',
                'meta_query'     => array(
                    array(
                        'key'   => '_templaza_header__theme',
                        'value' => get_template()
                    )
                )
            );

            $data    = array();
            $tz_posts = \get_posts($args);
            if($tz_posts && count($tz_posts)){
                //            $data    = array();
                foreach($tz_posts as $_tz_post){
                    $data[$_tz_post -> post_name] = $_tz_post -> post_title;
                }
            }

            if(!empty($data)){
                static::$cache[$store_id]   = $data;
            }

            return $data;
        }
    }
}