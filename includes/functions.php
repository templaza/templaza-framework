<?php

namespace TemPlazaFramework;

defined( 'ABSPATH' ) || exit;

use ScssPhp\ScssPhp\Compiler;

if(!class_exists('TemPlazaFramework\Functions')){

    class Functions{
        protected static $cache         = array();
        protected static $shortcode = '';

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
            return $text_domain;
        }

        public static function get_my_theme_css_uri(){
            return get_template_directory_uri().'/'.TEMPLAZA_FRAMEWORK.'/css';
        }

        public static function get_theme_option_name(){
            return 'tzfrm_'.basename(get_template_directory()).'_opt';
        }

        public static function get_global_settings(){
            $opt_name   = self::get_theme_option_name();

            $store_id   = __METHOD__;
            $store_id  .= ':'.$opt_name;
            $store_id   = md5($store_id);

            if(isset(self::$cache[$store_id])){
                return self::$cache[$store_id];
            }
            $options = get_option($opt_name, array());
            if(count($options)){
                self::$cache[$store_id] = $options;
            }
            return $options;
        }

        public static function get_theme_options($post_type = ''){

            $store_id   = __METHOD__;
            $store_id  .= ':'.$post_type;
            $global_options     = self::get_global_settings();
            $template_options   = self::_get_theme_options($post_type);

            $store_id  .= serialize($global_options);
            $store_id  .= serialize($template_options);
            $store_id   = md5($store_id);

            if(isset(self::$cache[$store_id])){
                return self::$cache[$store_id];
            }

            $theme_options      = self::merge_array($template_options, $global_options);
//            $theme_options      = self::merge_array($global_options, $template_options);

            if($theme_options && count($theme_options)){
                self::$cache[$store_id] = $theme_options;
                return $theme_options;
            }

            return array();
        }
        protected static function _get_theme_options($post_type = ''){
            $the_ID = \get_the_ID();

            if(is_single() || is_archive()){
                $post_type  = !empty($post_type)?$post_type: get_post_type($the_ID);
                if(!empty($post_type)){
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
            }elseif(is_404()){
                if($style_id = \Redux::get_option(self::get_theme_option_name(), '404-page-style')){
                    return self::get_theme_option_by_id($style_id);
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

            // Is slug
            if($style_id && !is_numeric($style_id)) {
                // Get style id by style slug
                $style_args = array(
                    'name' => $style_id,
                    'post_type' => 'templaza_style',
                    'numberposts' => 1
                );
                $posts = \get_posts($style_args);
                if(!empty($posts)){
                    $style_id = $posts[0]->ID;
                }

            }



//            // When not found style id return to global options (old version to home options)
//            if(!$id || empty($style_id)){
////            if(!$id && empty($style_id)){
////            if(empty($style_id)){
//
//                /* Get home post id
//                * Replace by global options
//                 */
//                $args = array(
//                    'post_type'      => 'templaza_style',
//                    'meta_query' => array(
//                        array(
//                            'key' => 'home',
//                            'value' => '1',
//                            'compare' => '=',
//                        )
//                    )
//                );
//                $posts = \get_posts($args);
//                if($posts && count($posts)){
//                    $style_id   = $posts[0] -> ID;
//                }
//            }


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

            // Is slug
            if($style_id && !is_numeric($style_id)) {
                // Get style id by style slug
                $style_args = array(
                    'name' => $style_id,
                    'post_type' => 'templaza_style',
                    'numberposts' => 1
                );
                $posts = \get_posts($style_args);
                if(!empty($posts)){
                    $style_id = $posts[0]->ID;
                }

            }

            if($style_id && isset(self::$cache[$store_id])){
                return self::$cache[$store_id];
            }

//            // Get default style options if not style id
//            if(!$style_id){
//                // Get home post id
//                $args = array(
//                    'post_type'      => 'templaza_style',
//                    'meta_query' => array(
//                        array(
//                            'key' => 'home',
//                            'value' => '1',
//                            'compare' => '=',
//                        )
//                    )
//                );
//                $posts = \get_posts($args);
//                if($posts && count($posts)){
//                    $style_id   = $posts[0] -> ID;
//                }
//            }

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
                        $options    = json_decode($options, true);
                        self::$cache[$store_id] = $options;
                        return $options;
                    }

                }
            }

            return self::get_global_settings();
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

        /*
         * @layout is json string|array
         * */
        public static function generate_option_to_shortcode($layout){
            if(is_string($layout)){
                $layout = json_decode($layout, true);
            }

            self::$shortcode    = '';
            self::__generate_option_to_shortcode($layout);

            return self::$shortcode;
        }

        protected static function __generate_option_to_shortcode($layout, &$level = 0, &$shortcode = array(), $parent_el = false){
            if(!$layout){
                return;
            }

            foreach($layout as $i => $item){

                $item   = apply_filters('templaza-framework/layout/generate/shortcode/'.$item['type'].'/before_register', $item, $parent_el);

                $shortcode_file = TEMPLAZA_FRAMEWORK_SHORTCODES_PATH.'/'.$item['type'].'/'.$item['type'].'.php';
                if(file_exists($shortcode_file)){
                    require $shortcode_file;
                }

                $shortcode_class    = 'TemplazaFramework_Shortcode_'.$item['type'];
                $shortcode_storeId  = md5($shortcode_class);
                if(class_exists($shortcode_class) && !isset(self::$cache['shortcode'][$shortcode_storeId])) {
                    self::$cache['shortcode'][$shortcode_storeId] = new $shortcode_class();
                }

                $item = apply_filters('templaza-framework/layout/generate/shortcode/prepare', $item, $parent_el);
                $item = apply_filters('templaza-framework/layout/generate/shortcode/'.$item['type'].'/prepare', $item, $parent_el);

                $shortcode_name = 'templaza_'.$item['type'];
                $subitems       = is_array($item) && isset($item['elements']) && !empty($item['elements']);

                // Init shortcode_tmp variable
                if(!isset($shortcode['shortcode'])){
                    $shortcode['shortcode']   = array();
                }

                if(!isset($shortcode['shortcode']['open'])) {
                    $shortcode['shortcode']['open'] = array();
                }
                if(!isset($shortcode['shortcode']['close'])) {
                    $shortcode['shortcode']['close'] = array();
                }

                if(!isset($shortcode['level'])){
                    $shortcode['level']   = 0;
                }

                if($subitems) {
                    $level++;
                }


                // Call back function if shortcode has child shortcode
                if($subitems){
//                    $parent_el  = $item;
                    self::__generate_option_to_shortcode($item['elements'],$level, $shortcode, $item);
                }

                $attribs    = "";
                $params     = isset($item['params'])?$item['params']: array();

                $params = apply_filters('templaza-framework/layout/generate/shortcode/'
                    .$item['type'].'/params/prepare', $params, $item, $parent_el);

                if(count($params)){
                    $params = array_filter($params, function($v, $k){
                        return (!is_null($v) && !is_string($v)) || (!is_null($v) && is_string($v) && strlen($v));
                    }, ARRAY_FILTER_USE_BOTH);
                    foreach($params as $key => $param){
                        if(!is_array($param)) {
                            $attribs .= ' ' . $key . '="' . $param . '"';
                        }else{
                            $attribs    .= ' '.$key.'=\''.json_encode($param).'\'';
                        }
                    }
                }

                if($subitems) {
                    $level--;
                }

                // Create open and close shortcode
                $_shortcode = '['.$shortcode_name.$attribs.']';
                $shortcode['shortcode']['close'][$level]  = '[/'.$shortcode_name.']';

                // Push child shortcode to parent of it.
                if($level > $shortcode['level'] && isset($shortcode['shortcode']['open'][$level])){
                    $shortcode['shortcode']['open'][$shortcode['level']]    .= $shortcode['shortcode']['open'][$level];
                    unset($shortcode['shortcode']['open'][$level]);
                }

                // Remove shortcode if the element is parent but it doesn't have children
                // Should create has_children_shortcode option for element to remove
                if(isset($item['has_children_shortcode']) && $item['has_children_shortcode']){
                    if(empty($shortcode['shortcode']['open'][$level + 1])){
                        if(!isset($shortcode['shortcode']['open'][$level])) {
                            unset($shortcode['shortcode']['open'][$level]);
                        }
                    }else{
                        if(!isset($shortcode['shortcode']['open'][$level])) {
                            $shortcode['shortcode']['open'][$level] = $_shortcode;
                        }else{
                            $shortcode['shortcode']['open'][$level] .= $_shortcode;
                        }
                    }
                }else{
                    // Create shortcode
                    if(!isset($shortcode['shortcode']['open'][$level])) {
                        $shortcode['shortcode']['open'][$level] = $_shortcode;
                    }else{
                        $shortcode['shortcode']['open'][$level] .= $_shortcode;
                    }
                }

                // Push shortcode to parent of it when next shortcode has level the same
                if($level < $shortcode['level']){
                    if(!empty($shortcode['shortcode']['open'][$level + 1])){
                        $shortcode['shortcode']['open'][$level]   .= $shortcode['shortcode']['open'][$level+1]
                            .$shortcode['shortcode']['close'][$level];
                        unset($shortcode['shortcode']['open'][$level+1]);
                    }
                }

                $shortcode['shortcode']['open'][$level] = apply_filters('templaza-framework/layout/generate/shortcode/'.$item['type'].'/after_shortcode',
                    $shortcode['shortcode']['open'][$level], $level, $params, $item, $parent_el);

                // Reset shortcode tree when level is zero
                if($level == 0){
                    if(isset($shortcode['shortcode']['open'][$level])) {
                        self::$shortcode .= $shortcode['shortcode']['open'][$level];
                    }
                    $shortcode['shortcode']   = array();
                }

                if(!isset($shortcode['shortcode']['open'][$level])){
                    $shortcode['shortcode']['open'][$level] = '';
                }

//                $shortcode['shortcode']['open'][$level] = apply_filters('templaza-framework/layout/generate/shortcode/'.$item['type'].'/after_shortcode',
//                    $shortcode['shortcode']['open'][$level], $level, $params, $item);

                // Store prev shortcode
                $shortcode['item']    = $item;
                $shortcode['level']   = $level;
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
                }else {
                    $path = TEMPLAZA_FRAMEWORK . '/theme_pages/single';
                    $file = $path . '/' . $current_post_type . '-related.php';
                    if (file_exists($file)) {
                        require_once $file;
                    }
                }
            }
        }

        public static function get_attribute_value($key='attribute', $attrib_key = ''){
            $attributes = self::get_attributes($key);

            if(isset($attributes[$attrib_key])){
                return $attributes[$attrib_key];
            }

            return false;
        }
        public static function get_attributes($key='attribute'){
            $store_id   = __CLASS__;
            $store_id  .= ':'.$key;
            $store_id   = md5($store_id);
            if(isset(self::$cache[$store_id])){
                return self::$cache[$store_id];
            }
            return false;
        }
        public static function add_attributes($key='attribute', $attributes = array()){
            $store_id   = __CLASS__;
            $store_id  .= ':'.$key;
            $store_id   = md5($store_id);

            self::$cache[$store_id] = $attributes;
        }

        public static function get_templaza_style_by_slug(){
            $args     = array(
                'post_type'      => 'templaza_style',
                'posts_per_page' => -1,
                'orderby'        => 'title',
                'order'          => 'ASC',
                'meta_key'       => '_templaza_style_theme',
                'meta_value'     => basename(get_template_directory()),
            );

            $data    = array();
            $tz_posts = \get_posts($args);
            if($tz_posts && count($tz_posts)){
    //            $data    = array();
                foreach($tz_posts as $_tz_post){
                    $data[$_tz_post -> post_name] = $_tz_post -> post_title;
                }
            }
            return $data;
        }

        public static function merge_array($source, $destination, $recursive = true,  $allowNull = false){
            return Array_Helper::merge($source, $destination, $recursive, $allowNull);
        }

        public static function get_framework_logo_url(){
            $logo_url   = self::get_my_url();
            $log_path   = TEMPLAZA_FRAMEWORK_PATH.'/assets/images/logo.svg';
            if(file_exists($log_path)){
                return $logo_url.'/assets/images/logo.svg';
            }
            return '';
        }

        /**
         * Get theme's default logo when option has not set in config
         * Note: your logo file should have in your theme base folder. Ex: your-theme/assets/images
         * @param string $file_name
         * @param array|string $files_ext
         * @param string $base_folder
         * @return string
         * */
        public static function get_theme_default_logo_url($file_name, $files_ext = array('.svg', '.png'), $base_folder = 'assets/images'){

            if(empty($file_name) || empty($files_ext) || empty($base_folder)){
                return '';
            }

            $logo_url = $logo_path = '/'.$base_folder.'/'.$file_name;
            $logo_url     = get_stylesheet_directory_uri().$logo_url;
            $logo_path    = get_stylesheet_directory().$logo_path;

            if(is_array($files_ext)){
                foreach($files_ext as $ext){
                    if(file_exists($logo_path.$ext)){
                        return $logo_url.$ext;
                    }
                }
            }elseif(is_string($files_ext) && $logo_path.$files_ext){
                return $logo_url.$files_ext;
            }
            return '';
        }

        /**
         * Check url is external
         * @param string $url
         * @return bool true|false
         * */
        public static function is_external_url($url){
            if(!$url){
                return false;
            }

            $url_host       = parse_url($url, PHP_URL_HOST);
            $internal_host  = parse_url(get_site_url(), PHP_URL_HOST);

            if($url_host != $internal_host){
                return true;
            }
            return false;
        }

        /**
         * Check extension of a file
         * @param string $file
         * @param string $ext_check The extension of file to check
         * @return bool true|false|null
         * */
        public static function file_ext_exists($file, $ext_check){
            if(!$file || !$ext_check){
                return null;
            }

            $file_type  = wp_check_filetype($file);
            if(!$file_type['ext']){
                return null;
            }
            if(is_array($ext_check) && in_array($file_type['ext'], $ext_check)){
                return true;
            }
            return (is_string($ext_check) && $file_type['ext'] == $ext_check);
        }
    }
}