<?php

namespace TemPlazaFramework;

defined( 'ABSPATH' ) || exit;

use ScssPhp\ScssPhp\Compiler;

if(!class_exists('TemPlazaFramework\Functions')){

    class Functions{
        protected static $cache         = array();
        protected static $shortcode_tmp = '';

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

            $text_domain    = ($plugin && isset($plugin['TextDomain']))?$plugin['TextDomain']:'templaza-framework';
//            if(!$plugin){
//                return false;
//            }
//            return $plugin['TextDomain'];
            return $text_domain;
        }

        public static function get_my_theme_css_uri(){
            return get_template_directory_uri().'/'.TEMPLAZA_FRAMEWORK.'/css';
        }

        public static function get_theme_option_name(){
            return 'tzfrm_'.basename(get_template_directory()).'_opt';
        }

        public static function get_theme_options(){
//            $theme_name     = basename(get_template_directory());
//            $theme_options  = get_option(TEMPLAZA_FRAMEWORK_PREFIX.'_'.$theme_name.'_opt');
//            return $theme_options;

            $the_ID = \get_the_ID();

            if(is_single() || is_archive()){
                if($post_type = get_post_type($the_ID)){
                    $key    = null;
                    if(is_single()){
                        $key    = $post_type.'-single-style';
                    }elseif(is_archive()){
                        $key    = $post_type.'-archive-style';
                    }
                    if($key) {
                        if($style_id = \Redux::get_option(self::get_theme_option_name(), $key)){
                            return self::get_theme_option_by_id($style_id);
                        }
                    }
                }
            }

            return self::get_theme_options_by_post_type_ID($the_ID);
        }
        public static function get_theme_options_by_post_type_ID($id){
            $store_id   = __METHOD__;
            $store_id  .= ':'.$id;
            $store_id   = md5($store_id);

            if(isset(self::$cache[$store_id])){
                return self::$cache[$store_id];
            }

            $style_id   = get_post_meta($id, 'templaza-style', true);

            if(!$id || empty($style_id)){
                // Get home post id
                $args = array(
                    'post_type'      => 'templaza_style',
                    'meta_query' => array(
                        array(
                            'key' => 'home',
                            'value' => '1',
                            'compare' => '=',
                        )
                    )
                );
                $posts = \get_posts($args);
                if($posts && count($posts)){
//                    $id   = $posts[0] -> ID;
                    $style_id   = $posts[0] -> ID;
                }
            }

            $options    = self::get_theme_option_by_id($style_id);

            if(count($options)){
                self::$cache[$store_id] = $options;
            }

            return $options;
        }

        public static function get_theme_option_by_id($style_id){
            $store_id   = __METHOD__;
            $store_id  .= ':'.$style_id;
            $store_id   = md5($store_id);

            if(isset(self::$cache[$store_id])){
                return self::$cache[$store_id];
            }

            // Get default style options if not style id
            if(!$style_id){
                // Get home post id
                $args = array(
                    'post_type'      => 'templaza_style',
                    'meta_query' => array(
                        array(
                            'key' => 'home',
                            'value' => '1',
                            'compare' => '=',
                        )
                    )
                );
                $posts = \get_posts($args);
                if($posts && count($posts)){
                    $style_id   = $posts[0] -> ID;
                }
            }

            // Get options by style id
            if($style_id){
                $file_id    = get_post_meta($style_id, '_templaza_style', true);
                $theme_name = get_post_meta($style_id, '_templaza_style_theme', true);
                if($file_id){
                    require_once ( ABSPATH . '/wp-admin/includes/file.php' );
                    global $wp_filesystem;
                    WP_Filesystem();
                    $file   = dirname(get_template_directory()) .'/'.$theme_name.'/'
                        .TEMPLAZA_FRAMEWORK_NAME. '/theme_options/' . $file_id . '.json';
                    if(file_exists($file)){
                        $options    = $wp_filesystem -> get_contents($file);
                        $options    = html_entity_decode(stripslashes ($options));
                        $options    = json_decode($options, true);
                        self::$cache[$store_id] = $options;
                        return $options;
                    }

                }
            }

            return array();
        }

        public static function list_files( $folder = '',  $filter = '.', $levels = 100, $exclusions = array() ) {
            if ( empty( $folder ) ) {
                return false;
            }

            $folder = trailingslashit( $folder );

            if ( ! $levels ) {
                return false;
            }

            $files = array();

            $dir = @opendir( $folder );
            if ( $dir ) {
                while ( ( $file = readdir( $dir ) ) !== false ) {
                    // Skip current and parent folder links.
                    if ( in_array( $file, array( '.', '..' ), true ) ) {
                        continue;
                    }

                    // Skip hidden and excluded files.
                    if ( '.' === $file[0] || in_array( $file, $exclusions, true ) ) {
                        continue;
                    }

                    if ( is_dir( $folder . $file ) ) {
                        $files2 = self::list_files( $folder . $file,  $filter, $levels - 1 );
                        if ( $files2 ) {
                            $files = array_merge( $files, $files2 );
                        } else {
                            $files[] = $folder . $file . '/';
                        }
                    } else {
                        if(!empty($filter) && $file && !preg_match("/$filter/", $file)){
                            continue;
                        }
                        $files[] = $folder . $file;
                    }
                }

                closedir( $dir );
            }

            return $files;
        }

//        public static function generateID() {
//            $r  = rand() >= 0.5;
//            if($r){
//                $x  = floor(rand() * 10 + 1);
//                $y  = floor(rand() * 100 + 1);
//                $z  = floor(rand() * 10 + 1);
//            }else{
//                $x  = floor(rand() * 10 + 1);
//                $y  = floor(rand() * 10 + 1);
//                $z  = floor(rand() * 100 + 1);
//            }
//            //        $time   = time();
//            return $x + $y + $z + time();
//            //    return x + y + z + t.toString();
//        }

        public static function generate_option_to_shortcode($layout, &$tree = array(), &$level = 0){
            if(!$layout){
                return;
            }
            foreach($layout as $item){
//                $item['id'] = self::generateID();

                $shortcode_file = TEMPLAZA_FRAMEWORK_SHORTCODES_PATH.'/'.$item['type'].'/'.$item['type'].'.php';
                if(file_exists($shortcode_file)){
                    require $shortcode_file;
                }

                $shortcode_class    = 'TemplazaFramework_Shortcode_'.$item['type'];
                $shortcode_storeId  = md5($shortcode_class);
                if(class_exists($shortcode_class) && !isset(self::$cache['shortcode'][$shortcode_storeId])) {
                    self::$cache['shortcode'][$shortcode_storeId] = new $shortcode_class();
                }

                $item = apply_filters('templaza-framework/layout/generate/shortcode/prepare', $item);

                $shortcode_name = 'templaza_'.$item['type'];
                $subitems       = is_array($item) && isset($item['elements']) && !empty($item['elements']);

                if($subitems){
                    self::generate_option_to_shortcode($item['elements'], $tree, $level);
                    $level++;
                }else{
                    if($item['type'] !== self::$shortcode_tmp) {
                        $level = 0;
                    }
                }

                $attribs    = "";
                $params     = isset($item['params'])?$item['params']: array();

                $params = apply_filters('templaza-framework/layout/generate/shortcode/'.$item['type'].'/params/prepare', $params, $item);

                if(count($params)){
                    $params = array_filter($params, function($v, $k){
                        return (!is_null($v) && !is_string($v)) || (!is_null($v) && is_string($v) && strlen($v));
                    }, ARRAY_FILTER_USE_BOTH);
                    foreach($params as $key => $param){
                        if(!is_array($param)) {
                            $attribs .= ' ' . $key . '="' . $param . '"';
                        }
                    }
                }
                if(!isset($tree[$level])) {
                    if($subitems) {
                        $tree[$level]       = '['.$shortcode_name.$attribs.']'.$tree[$level - 1].'[/'.$shortcode_name.']';
                        $tree[$level - 1]   = '';
                    }else{
                        if($level > 0){
                            $tree[$level]   = '['.$shortcode_name.$attribs.'][/'.$shortcode_name.']';
                        }else {
                            $tree[$level]   = '[' . $shortcode_name . $attribs . ']';
                        }
                    }
                }else{
                    if($subitems) {
                        $tree[$level]  .= '['.$shortcode_name.$attribs.']'.$tree[$level - 1].'[/'.$shortcode_name.']';
                        $tree[$level - 1]   = '';
                    }else {
                        if($level > 0){
                            $tree[$level]  .= '['.$shortcode_name.$attribs.'][/'.$shortcode_name.']';
                        }else {
                            $tree[$level] .= '[' . $shortcode_name . $attribs . ']';
                        }
                    }
                }
                self::$shortcode_tmp   = $item['type'];
            }
        }

        public static function get_related_posts(){
            $post_id = get_the_ID();
            $cat_ids = array();
            $categories = get_the_category( $post_id );

            if(!empty($categories) && is_wp_error($categories)):
                foreach ($categories as $category):
                    array_push($cat_ids, $category->term_id);
                endforeach;
            endif;

            $current_post_type = get_post_type($post_id);
            $query_args = array(

                'category__in'   => $cat_ids,
                'post_type'      => $current_post_type,
                'post_not_in'    => array($post_id),
                'posts_per_page'  => '3'


            );

            $related_post = new \WP_Query( $query_args );

            if($related_post -> have_posts()){
                $path   = TEMPLAZA_FRAMEWORK_THEME_PATH_TEMPLATE.'/theme_pages/single';
                $file   = $path.'/'.$current_post_type.'-related.php';
                if(file_exists($file)){
                    require_once $file;
                }

                $path   = TEMPLAZA_FRAMEWORK.'/theme_pages/single';
                $file   = $path.'/'.$current_post_type.'-related.php';
                if(file_exists($file)){
                    require_once $file;
                }
            }
        }

//        public static function trim_excerpt( $text = '', $post = null, $excerpt_length = 55){
//            add_filter('excerpt_length', function() use($excerpt_length){
//                return $excerpt_length;
//            });
//            return wp_trim_excerpt($text, $post);
//        }
    }
}