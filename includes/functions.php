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
//            $options = get_option($opt_name, array());

            $options        = array();
            $setting_file   = TEMPLAZA_FRAMEWORK_THEME_PATH_TEMPLATE_OPTION.'/settings/setting.json';

            // Get default config from file in theme
            if(!count($options)){
                $setting_file   = file_exists($setting_file)?$setting_file:TEMPLAZA_FRAMEWORK_THEME_PATH_THEME_OPTION.'/settings/default.json';
                if(file_exists($setting_file)){
                    $def_options    = file_get_contents($setting_file);
                    $def_options    = (is_string($def_options) && !empty($def_options))?json_decode($def_options, true):$def_options;
                    $options        = count($def_options)?$def_options:$options;
                }
            }

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
            global $wp;

            if(is_single() || is_archive()){
                if(is_archive() && \get_page_by_path($wp -> request)){
                    // Get page
                    $page   = \get_page_by_path($wp -> request);
                    if($page -> ID){
                        return static::get_theme_options_by_post_type_ID($page -> ID);
                    }
                }
                $post_type  = !empty($post_type)?$post_type: get_post_type($the_ID);
                $post_type  = !empty($post_type)?$post_type: get_query_var( 'post_type' );

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

            $options    = self::get_theme_option_by_id($style_id);

            if(count($options)){
                self::$cache[$store_id] = $options;
            }

            return $options;
        }

        public static function get_theme_option_by_id($style_id, $post_type = 'templaza_style'){

            $post_type  = !empty($post_type)?$post_type:'templaza_style';

            $store_id   = __METHOD__;
            $store_id  .= '::'.$style_id;
            $store_id  .= '::'.$post_type;
            $store_id   = md5($store_id);

            // Is slug
            if($style_id && !is_numeric($style_id)) {
                // Get style id by style slug
                $style_args = array(
                    'name'          => $style_id,
                    'post_type'     => $post_type,
                    'numberposts'   => 1
                );
                $posts = \get_posts($style_args);
                if(!empty($posts)){
                    $style_id = $posts[0]->ID;
                }

            }

            if($style_id && isset(self::$cache[$store_id])){
                return self::$cache[$store_id];
            }

            // Get options by style id
            if($style_id){
                $file_id    = get_post_meta($style_id, '_'.$post_type, true);
                $theme_name = get_post_meta($style_id, '_'.$post_type.'_theme', true);
                if($file_id){
                    require_once ( ABSPATH . '/wp-admin/includes/file.php' );
                    global $wp_filesystem;
                    WP_Filesystem();

                    $post_type_folder   = $post_type != 'templaza_style'?'/'.$post_type:'';

                    // Option file path from uploads folder
                    $file   = TEMPLAZA_FRAMEWORK_THEME_PATH_TEMPLATE_OPTION.$post_type_folder.'/'.$file_id.'.json';

                    // Option file path from theme if uploads folder not exists config file
                    $file   = !file_exists($file)?TEMPLAZA_FRAMEWORK_THEME_PATH_THEME_OPTION.$post_type_folder .'/'
                        . $file_id . '.json':$file;

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
                            $attribs .= ' ' . $key . '=\'' . $param . '\'';
                        }else{
                            $attribs    .= ' '.$key.'=\''.json_encode($param, JSON_FORCE_OBJECT).'\'';
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

                if(!isset($shortcode['shortcode']['open'][$level])){
                    $shortcode['shortcode']['open'][$level] = '';
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
            $logo_url     = get_template_directory_uri().$logo_url;
            $logo_path    = get_template_directory().$logo_path;

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

        public static function get_padding($padding) {
	        $css    =   array('desktop' => '', 'tablet' => '', 'mobile' => '');
	        if ($padding['padding-top']) {
		        $css['desktop'] .= !empty($padding['padding-top']['desktop']) ? 'padding-top: '.$padding['padding-top']['desktop'].';' : '';
		        $css['tablet'] .= !empty($padding['padding-top']['tablet']) ? 'padding-top: '.$padding['padding-top']['tablet'].';' : '';
		        $css['mobile'] .= !empty($padding['padding-top']['mobile']) ? 'padding-top: '.$padding['padding-top']['mobile'].';' : '';
	        }
	        if ($padding['padding-right']) {
		        $css['desktop'] .= !empty($padding['padding-right']['desktop']) ? 'padding-right: '.$padding['padding-right']['desktop'].';' : '';
		        $css['tablet'] .= !empty($padding['padding-right']['tablet']) ? 'padding-right: '.$padding['padding-right']['tablet'].';' : '';
		        $css['mobile'] .= !empty($padding['padding-right']['mobile']) ? 'padding-right: '.$padding['padding-right']['mobile'].';' : '';
	        }
	        if ($padding['padding-bottom']) {
		        $css['desktop'] .= !empty($padding['padding-bottom']['desktop']) ? 'padding-bottom: '.$padding['padding-bottom']['desktop'].';' : '';
		        $css['tablet'] .= !empty($padding['padding-bottom']['tablet']) ? 'padding-bottom: '.$padding['padding-bottom']['tablet'].';' : '';
		        $css['mobile'] .= !empty($padding['padding-bottom']['mobile']) ? 'padding-bottom: '.$padding['padding-bottom']['mobile'].';' : '';
	        }
	        if ($padding['padding-left']) {
		        $css['desktop'] .= !empty($padding['padding-left']['desktop']) ? 'padding-left: '.$padding['padding-left']['desktop'].';' : '';
		        $css['tablet'] .= !empty($padding['padding-left']['tablet']) ? 'padding-left: '.$padding['padding-left']['tablet'].';' : '';
		        $css['mobile'] .= !empty($padding['padding-left']['mobile']) ? 'padding-left: '.$padding['padding-left']['mobile'].';' : '';
	        }
	        return $css;
        }

	    public static function get_margin($margin) {
		    $css    =   array('desktop' => '', 'tablet' => '', 'mobile' => '');
		    if ($margin['margin-top']) {
			    $css['desktop'] .= !empty($margin['margin-top']['desktop']) ? 'margin-top: '.$margin['margin-top']['desktop'].';' : '';
			    $css['tablet'] .= !empty($margin['margin-top']['tablet']) ? 'margin-top: '.$margin['margin-top']['tablet'].';' : '';
			    $css['mobile'] .= !empty($margin['margin-top']['mobile']) ? 'margin-top: '.$margin['margin-top']['mobile'].';' : '';
		    }
		    if ($margin['margin-right']) {
			    $css['desktop'] .= !empty($margin['margin-right']['desktop']) ? 'margin-right: '.$margin['margin-right']['desktop'].';' : '';
			    $css['tablet'] .= !empty($margin['margin-right']['tablet']) ? 'margin-right: '.$margin['margin-right']['tablet'].';' : '';
			    $css['mobile'] .= !empty($margin['margin-right']['mobile']) ? 'margin-right: '.$margin['margin-right']['mobile'].';' : '';
		    }
		    if ($margin['margin-bottom']) {
			    $css['desktop'] .= !empty($margin['margin-bottom']['desktop']) ? 'margin-bottom: '.$margin['margin-bottom']['desktop'].';' : '';
			    $css['tablet'] .= !empty($margin['margin-bottom']['tablet']) ? 'margin-bottom: '.$margin['margin-bottom']['tablet'].';' : '';
			    $css['mobile'] .= !empty($margin['margin-bottom']['mobile']) ? 'margin-bottom: '.$margin['margin-bottom']['mobile'].';' : '';
		    }
		    if ($margin['margin-left']) {
			    $css['desktop'] .= !empty($margin['margin-left']['desktop']) ? 'margin-left: '.$margin['margin-left']['desktop'].';' : '';
			    $css['tablet'] .= !empty($margin['margin-left']['tablet']) ? 'margin-left: '.$margin['margin-left']['tablet'].';' : '';
			    $css['mobile'] .= !empty($margin['margin-left']['mobile']) ? 'margin-left: '.$margin['margin-left']['mobile'].';' : '';
		    }
		    return $css;
	    }

	    public static function get_background($background) {
		    $css = '';
		    if (!empty($background['background-color'])) {
			    $css     .=  'background-color: '.$background['background-color'].';';
		    }
		    if (!empty($background['background-repeat'])) {
			    $css     .=  'background-repeat: '.$background['background-repeat'].';';
		    }
		    if (!empty($background['background-size'])) {
			    $css     .=  'background-size: '.$background['background-size'].';';
		    }
		    if (!empty($background['background-attachment'])) {
			    $css     .=  'background-attachment: '.$background['background-attachment'].';';
		    }
		    if (!empty($background['background-position'])) {
			    $css     .=  'background-position: '.$background['background-position'].';';
		    }
		    if (!empty($background['background-image'])) {
			    $css     .=  'background-image: url("'.$background['background-image'].'");';
		    }
		    return $css;
	    }

	    public static function get_border($border) {
		    $css     =      'border-top: '.(!empty($border['border-top']) ? $border['border-top'] : '0' ).';';
		    $css     .=     'border-right: '.(!empty($border['border-right']) ? $border['border-right'] : '0' ).';';
		    $css     .=     'border-bottom: '.(!empty($border['border-bottom']) ? $border['border-bottom'] : '0' ).';';
		    $css     .=     'border-left: '.(!empty($border['border-left']) ? $border['border-left'] : '0' ).';';

		    if (!empty($border['border-style'])) {
			    $css     .=  'border-style: '.$border['border-style'].';';
		    }
		    if (!empty($border['border-color'])) {
			    $css     .=  'border-color: '.$border['border-color'].';';
		    }
		    return $css;
	    }

	    public static function get_template_id(){
//            $store_id   = __METHOD__;

            $result_id   = false;

            $the_ID = \get_the_ID();
            global $wp;

            if(is_single() || is_archive()){
                if(is_archive() && \get_page_by_path($wp -> request)){
                    // Get page
                    $page   = \get_page_by_path($wp -> request);
                    if($page -> ID){

                        $result_id   = get_post_meta($page -> ID, 'templaza-style', true);

//                        $result_id  = $page -> ID;
//                        return $page -> ID;
                    }
                }
                $post_type  = !empty($post_type)?$post_type: get_post_type($the_ID);
                $post_type  = !empty($post_type)?$post_type: get_query_var( 'post_type' );
                if(!empty($post_type)){
                    $key    = null;
                    if(is_single()){
                        $key    = $post_type.'-single-style';
                    }elseif(is_archive()){
                        $key    = $post_type.'-archive-style';
                    }
                    if($key) {
                        if($style_id = \Redux::get_option(self::get_theme_option_name(), $key)){
                            $result_id  = $style_id;
//                            return $style_id;
                        }
                    }
                }
            }elseif(is_404()){
                if($style_id = \Redux::get_option(self::get_theme_option_name(), '404-page-style')){
                    $result_id  = $style_id;
//                    return $style_id;
                }
            }


            if(!$result_id){

//                $result_id    = get_post_meta($the_ID, '_templaza_style', true);
                $result_id   = get_post_meta($the_ID, 'templaza-style', true);
            }
            // Is slug
            if($result_id && is_numeric($result_id)) {
                // Get style id by style slug
                $style_args = array(
                    'name'          => $result_id,
                    'post_type'     => $post_type,
                    'numberposts'   => 1
                );
                $posts = \get_posts($style_args);
                if(!empty($posts)){
                    $result_id = $posts[0]->post_name;
                }


            }

//            // Get home id
//            if(empty($result_id)){
//                // Get default
//            }
            var_dump($result_id);


            return $result_id;
        }

	    /**
	     * Get header options
         * @param string $layout An optional of header
         * @return array Header options
	     * */
	    public static function get_header_options(){

            $store_id   = __METHOD__;
            $store_id   = md5($store_id);

            if(isset(static::$cache[$store_id])){
                return static::$cache[$store_id];
            }

            $options    = static::__get_post_type_options('templaza_header', '__h_template_assign');

            if(!empty($options)) {
                static::$cache[$store_id]   = $options;
            }

            return $options;
        }

	    /**
	     * Get footer options
         * @param string $layout An optional of header
         * @return array Header options
	     * */
	    public static function get_footer_options(){

            $store_id   = __METHOD__;
            $store_id   = md5($store_id);

            if(isset(static::$cache[$store_id])){
                return static::$cache[$store_id];
            }

            $options    = static::__get_post_type_options('templaza_footer', '__f_template_assign');

            if(!empty($options)) {
                static::$cache[$store_id]   = $options;
            }

            return $options;
        }

        /**
         * Get header id
         * */
        public static function get_footer_id(){
            return static::__get_post_type_file_name('templaza_footer', '__f_template_assign');
        }

        /**
         * Get header id
         * */
        public static function get_header_id(){
            return static::__get_post_type_file_name('templaza_header', '__h_template_assign');
        }

        /**
         * Get post type id
         * */
        protected static function __get_post_type_file_name($post_type = '', $meta_key_assigned = ''){

            $template_id  = static::get_template_id();

            $store_id   = __METHOD__;
            $store_id  .= '::'.$post_type;
            $store_id  .= '::'.$template_id;
            $store_id   = md5($store_id);

            if(isset(static::$cache[$store_id])){
                return static::$cache[$store_id];
            }

            $json_file_name = '';

            $args   = array(
                'post_type'     => $post_type,
                'post_status'   => 'publish',
                'numberposts'   => 1,
                'meta_query'    => array(
                    array(
                        'key'   => '__home',
                        'value' => 1
                    ),
                    array(
                        'key'   => '_'.$post_type.'__theme',
                        'value' => get_template()
                    )
                )
            );

            // Get default header options
            $_header_opt_default = get_posts($args);
            if(!empty($_header_opt_default) && !is_wp_error($_header_opt_default)){
                $json_file_name = $_header_opt_default[0] -> post_name;
            }

            // Get header options assigned
            if($template_id){
                $args['meta_query'] = array(
                    array(
                        'key'   => $meta_key_assigned,
                        'value' => $template_id
                    ),
                    array(
                        'key'   => '_'.$post_type.'__theme',
                        'value' => get_template()
                    )
                );

                // Get header options assigned
                $_header_opt = get_posts($args);
                if(!empty($_header_opt) && !is_wp_error($_header_opt)){
                    $json_file_name = $_header_opt[0] -> post_name;
                }
            }
            if(isset($_GET['header_style']) && $post_type =='templaza_header'){
                $json_file_name = $_GET['header_style'];
            }
            if(isset($_GET['footer_style']) && $post_type =='templaza_footer'){
                $json_file_name = $_GET['footer_style'];
            }

            if(!empty($json_file_name)){
                static::$cache[$store_id]   = $json_file_name;
            }

            return $json_file_name;
        }

	    /**
	     * Get header options
         * @param string $post_type An optional of post type
         * @param string $meta_key_assigned An optional which post type stored with template
         * @return array Post type options
	     * */
	    protected static function __get_post_type_options($post_type = '', $meta_key_assigned = ''){

            $template_id  = static::get_template_id();

            $store_id   = __METHOD__;
            $store_id  .= '::'.$post_type;
            $store_id  .= '::'.$template_id;
            $store_id   = md5($store_id);

            if(isset(static::$cache[$store_id])){
                return static::$cache[$store_id];
            }

            $options        = array();
            $json_file_name = static::__get_post_type_file_name($post_type, $meta_key_assigned);

            // If header does not exists, return empty array
            if(empty($json_file_name)){
                return $options;
            }

            // Get header options from json file
            $base_path      = TEMPLAZA_FRAMEWORK_THEME_PATH_THEME_OPTION.'/'.$post_type;
            $default_path   = TEMPLAZA_FRAMEWORK_THEME_PATH_TEMPLATE_OPTION.'/'.$post_type;
            $json_file  = $default_path.'/'.$json_file_name.'.json';

            if(!file_exists($json_file)){
                $json_file  = $base_path.'/'.$json_file_name.'.json';
            }

            // If json file does not exists
            if(!file_exists($json_file)){
                return $options;
            }

            $data   = file_get_contents($json_file);

            $data   = (!empty($data) && is_string($data))?json_decode($data, true):$data;

            if(!empty($data)) {
                $options = $data;
                static::$cache[$store_id]   = $data;
            }

            return $options;
        }
    }
}