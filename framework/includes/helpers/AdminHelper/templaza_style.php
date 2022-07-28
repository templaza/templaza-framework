<?php

namespace TemPlazaFramework\AdminHelper;

defined( 'TEMPLAZA_FRAMEWORK' ) || exit;

if(!class_exists('TemPlazaFramework\AdminHelper\Templaza_Style')){
    class Templaza_Style{

        protected static $cache = array();
        protected static $post_type = 'templaza_style';

        public static function get_items_by_slug(){
            $store_id   = md5(__METHOD__);

            if(isset(static::$cache[$store_id])){
                return static::$cache[$store_id];
            }

            $args     = array(
                'post_type'      => static::$post_type,
                'posts_per_page' => -1,
                'orderby'        => 'title',
                'order'          => 'ASC',
                'meta_query'     => array(
                    array(
                        'key'   => '_'.static::$post_type.'_theme',
                        'value' => get_template()
                    )
                )
            );

            $data    = array();
            $tz_posts = \get_posts($args);
            if($tz_posts && count($tz_posts)){
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