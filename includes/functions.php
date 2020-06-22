<?php

namespace TemPlazaFramework;

defined( 'ABSPATH' ) || exit;

use ScssPhp\ScssPhp\Compiler;

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

        public static function get_my_theme_css_uri(){
            return get_template_directory_uri().'/'.TEMPLAZA_FRAMEWORK.'/css';
        }

        public static function get_theme_options(){
            $theme_name     = basename(TEMPLATEPATH);
            $theme_options  = get_option(TEMPLAZA_FRAMEWORK_PREFIX.'_'.$theme_name.'_opt');
            return $theme_options;
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

//        public static function get_style_name($theme_dir, $custom = false){
//            require_once ( ABSPATH . '/wp-admin/includes/file.php' );
//            global $wp_filesystem;
//            WP_Filesystem();
//
//            $prefix         = 'style';
//            $scss_name      = 'style';
//            $scss_file_path = $theme_dir.'/scss';
//
//            if($custom){
//                if (!file_exists($scss_file_path . '/custom') || !file_exists($scss_file_path . '/custom/custom.scss')) {
//                    return '';
//                }
//                $prefix     = 'custom';
//                $scss_name  = 'custom';
//            }
//            if(!is_dir($scss_file_path)) {
//                $prefix         = 'framework';
//                $scss_file_path = TEMPLAZA_FRAMEWORK_SCSS_PATH;
//            }
//
//            $file_list   = self::list_files($scss_file_path, '.scss');
//
//            $css_name   = '';
//
//            if(count($file_list)){
//                foreach($file_list as $file){
//                    $css_name .= md5_file($file);
//                }
//                $css_name   = $prefix.'-'.md5($css_name);
//                $css_path   =  $theme_dir.'/css';
//
//
//                if(!is_dir($css_path)){
//                    $wp_filesystem -> mkdir($css_path);
//                }
//                if(!file_exists($css_path.'/'.$css_name.'.css')){
//                    static::clear_css_cache($css_path, $prefix);
//                    self::compileSass($scss_file_path, $css_path, $scss_name.'.scss', $css_name.'.css');
//                }
//            }
//
//            return $css_name.'.css';
//        }
//
//        public static function compileSass($sass_path, $css_path, $sass, $css, $variables = array())
//        {
//            try {
//                require_once TEMPLAZA_FRAMEWORK_LIBRARY_PATH.'/phpclass/scssphp/scss.inc.php';
//                $scss = new Compiler();
//                $scss->setImportPaths($sass_path);
//                $scss->setFormatter('\ScssPhp\ScssPhp\Formatter\Compressed');
//                if (!empty($variables)) {
//                    $scss->setVariables($variables);
//                }
//                $content = $scss->compile('@import "' . $sass . '";');
//                file_put_contents($css_path . '/' . $css, $content);
//            } catch (\Exception $e) {
//                print_r($e);
//                exit;
//                echo '<h1>' . $e->getMessage() . '</h1>';
//                echo '<h3>' . $e->getFile() . ' in ' . $e->getLine() . '</h3>';
//                exit;
//            }
//        }
//
//        public static function clear_css_cache($theme_dir = '', $prefix = 'style')
//        {
//            if(!is_dir($theme_dir)){
//                return false;
//            }
//
//            if (is_array($prefix)) {
//                foreach ($prefix as $pre) {
//                    $styles = preg_grep('~^' . $pre . '-.*\.(css)$~', scandir($theme_dir));
//                    foreach ($styles as $style) {
//                        unlink($theme_dir . '/' . $style);
//                    }
//                }
//            } else {
//                $styles = preg_grep('~^' . $prefix . '-.*\.(css)$~', scandir($theme_dir));
//                foreach ($styles as $style) {
//                    unlink($theme_dir . '/' . $style);
//                }
//            }
//            return true;
//        }

    }
}