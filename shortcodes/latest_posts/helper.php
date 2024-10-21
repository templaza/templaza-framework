<?php

namespace TemPlazaFramework\Shortcode\Helper;

defined('TEMPLAZA_FRAMEWORK') or exit();

if(!class_exists('TemPlazaFramework\Shortcode\Helper\Latest_PostsHelper')){
    class Latest_PostsHelper{

        protected static $cache    = array();

        public static function get_taxonomy_by_post_type($post_type){
            if(!$post_type){
                return false;
            }

            $store_id   = __METHOD__;
            $store_id  .= '::'.$post_type;
            $store_id   = md5($store_id);

            if(isset(static::$cache[$store_id])){
                return static::$cache[$store_id];
            }

            $cats_sync  = static::get_taxonomies_sync_post_type();

            if(!empty($cats_sync) && isset($cats_sync[$post_type]) && !empty($cats_sync[$post_type])){
                return static::$cache[$store_id]    = $cats_sync[$post_type];
            }

            return false;
        }

        public static function get_taxonomies_sync_post_type() {
            $post_types = get_post_types(
                array(
                    'public'   => true,
                    '_builtin' => false
                )
            );

            $post_types = apply_filters('templaza-framework/shortcode/latest_posts/helper/post_types', $post_types);

            if(empty($post_types) || is_wp_error($post_types)){
                return false;
            }

            $cat_syncs  = array(
                'post'  => 'category'
            );

            $store_id   = __METHOD__;
            $store_id  .= '::'.serialize($post_types);
            $store_id  .= '::'.serialize($cat_syncs);
            $store_id   = md5($store_id);

            if(isset(static::$cache[$store_id])){
                return static::$cache[$store_id];
            }

            foreach ($post_types as $post_type){
                $cat    = apply_filters('templaza-framework/shortcode/latest_posts/helper/taxonomy_sync_post_type', '', $post_type);

                if(!empty($cat)){
                    $cat_syncs[$post_type]  = $cat;
                }
            }
            $cat_syncs  = apply_filters('templaza-framework/shortcode/latest_posts/helper/taxonomies_sync_post_type', $cat_syncs);

            if(!empty($cat_syncs)){
                return static::$cache[$store_id]    = $cat_syncs;
            }

            return false;
        }

        public static function get_categories(){

            $cats_sync = Latest_PostsHelper::get_taxonomies_sync_post_type();

            if(empty($cats_sync)){
                return false;
            }

            $store_id   = __METHOD__;
            $store_id  .= '::'.serialize($cats_sync);
            $store_id   = md5($store_id);

            if(isset(static::$cache[$store_id])){
                return static::$cache[$store_id];
            }

            $cats   = array();

            foreach($cats_sync as $post_type => $term){
                $terms  = static::get_cat_taxonomy($term);

                if(!empty($terms)){
                    $cats[$post_type]   = $terms;
                }
            }

            if(!empty($cats)){
                static::$cache[$store_id]   = $cats;
                return $cats;
            }

            return false;
        }

        public static function get_cat_taxonomy($term = 'category'){
            $store_id   = __METHOD__;
            $store_id  .= '::'.$term;
            $store_id   = md5($store_id);

            if(isset(static::$cache[$store_id])){
                return static::$cache[$store_id];
            }

            $cats = array();

            $args  = array(
                'taxonomy'   => $term,
                'pad_counts'   => 1,
                'hierarchical' => 1,
                'hide_empty'   => false,
                'orderby'      => 'name',
                'menu_order'   => false
            );

            $terms = get_terms( $args );
            if ( is_wp_error( $terms ) ) {
            } else {
                if ( empty( $terms ) ) {
                } else {
                    $prefix = '';
                    foreach ( $terms as $term ) {
                        if ( $term->parent > 0 ) {
                            $prefix = "--";
                        }

                        $cats[$term->term_id] = $prefix . $term->name;
                    }
                }
            }

            if(!empty($cats)){
                static::$cache[$store_id]   = $cats;
            }

            return $cats;
        }
    }
}