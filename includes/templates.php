<?php

namespace TemPlazaFramework;

use Pelago\Emogrifier\CssInliner;
use ScssPhp\ScssPhp\Compiler;

defined('TEMPLAZA_FRAMEWORK') or exit();

class Templates{

    public static $_styles = ['desktop' => [], 'tablet' => [], 'mobile' => []];

    protected static $cache = array();

    public static function locate_my_template($template_names, $load = false, $require_once = true){
        $located    = '';
        $base       = TEMPLAZA_FRAMEWORK.'/templates';

        foreach ( (array) $template_names as &$template_name ) {
            if ( ! $template_name ) {
                continue;
            }
            $template_name  = $base.'/'.$template_name;
            if(!preg_match('/\.php$/i', $template_name)){
                $template_name  .= '.php';
            }
            if ( file_exists( get_stylesheet_directory() . '/' . $template_name ) ) {
                $located = get_stylesheet_directory() . '/' . $template_name;
                break;
            } elseif ( file_exists( get_template_directory() . '/' . $template_name ) ) {
                $located = get_template_directory() . '/' . $template_name;
                break;
            } elseif ( file_exists( TEMPLAZA_FRAMEWORK_PLUGIN_DIR_PATH.'/'.$template_name ) ) {
                $located   = TEMPLAZA_FRAMEWORK_PLUGIN_DIR_PATH.'/'.$template_name;
                break;
            }
        }

        if($load && $located != '') {
            load_template($located, $require_once);
        }

        return $located;
    }

    public static function load_my_layout($partial, $load = true, $require_once = true){
        $partial    = str_replace('.', '/', $partial);
        $located    = self::locate_my_template((array) $partial, $load, $require_once);

        return $located;
    }

    public static function load_my_header($name = null, $require_once = true){
        if('' != $name){
            self::load_my_layout($name, true, $require_once);
        }else {
            self::load_my_layout('header', true, $require_once);
        }
    }
    public static function load_my_footer($name = 'footer'){
        if('' != $name){
            self::load_my_layout($name, true);
        }else {
            self::load_my_layout('footer', true);
        }
    }

    public static function get_style_name($theme_dir, $custom = false){
        require_once ( ABSPATH . '/wp-admin/includes/file.php' );
        global $wp_filesystem;
        WP_Filesystem();

        $prefix         = 'style';
        $scss_name      = 'style';
        $scss_file_path = $theme_dir.'/scss';

        if($custom){
            if (!file_exists($scss_file_path . '/custom') || !file_exists($scss_file_path . '/custom/custom.scss')) {
                return '';
            }
            $prefix     = 'custom';
            $scss_name  = 'custom';
        }
        if(!is_dir($scss_file_path)) {
            $prefix         = 'framework';
            $scss_file_path = TEMPLAZA_FRAMEWORK_SCSS_PATH;
        }


        $css_name   = '';

        // Get framework scss core files
        $frm_files  = Functions::list_files(TEMPLAZA_FRAMEWORK_SCSS_PATH, '.scss');
        if(count($frm_files)){
            foreach($frm_files as $frm_file){
                $css_name .= md5_file($frm_file);
                $css_name .= md5(filesize($frm_file));
            }
        }

        $file_list   = Functions::list_files($scss_file_path, '.scss');
        if(count($file_list)){
            foreach($file_list as $file){
                $css_name .= md5_file($file);
                $css_name .= md5(filesize($file));
            }
            $css_name   = $prefix.'-'.md5($css_name);
            $css_path   =  $theme_dir.'/css';

            if(!is_dir($css_path)){
                $wp_filesystem -> mkdir($css_path);
            }

            if(!file_exists($css_path.'/'.$css_name.'.css')){
                static::clear_css_cache($css_path, $prefix);
                self::compileSass($scss_file_path, $css_path, $scss_name.'.scss', $css_name.'.css');
            }
        }

        return $css_name.'.css';
    }

    public static function get_style($name = '', $prefix = 'style', $clean_cache = false, $sass_path = '', $css_path = ''){
        $css_path   = $css_path?$css_path:TEMPLAZA_FRAMEWORK_THEME_CSS_PATH;
        $sass_path  = $sass_path?$sass_path:TEMPLAZA_FRAMEWORK_SCSS_PATH;

        $sass_name  = strpos($name, '.scss') == false?$name.'.scss':$name;
        $sass_file  = $sass_path.'/'.$sass_name;

        if(!file_exists($sass_file)){
            return '';
        }

        $css_name   = $prefix.'-'.md5_file($sass_file).'.css';
        $css_file   = $css_path.'/'.$css_name;

        if(!file_exists($css_file)){
            if($clean_cache) {
                self::clear_css_cache($css_path, $prefix);
            }
            self::compileSass($sass_path, $css_path, $sass_name, $css_name);
        }

        return $css_name;
    }

    public static function compileSass($sass_path, $css_path, $sass, $css, $variables = array())
    {
        try {
            global $wp_filesystem;
            require_once TEMPLAZA_FRAMEWORK_LIBRARY_PATH.'/phpclass/scssphp/scss.inc.php';
            $scss = new Compiler();
            $scss->setImportPaths($sass_path);
            $scss->setFormatter('\ScssPhp\ScssPhp\Formatter\Compressed');
            if (!empty($variables)) {
                $scss->setVariables($variables);
            }
            $content = $scss->compile('@import "' . $sass . '";');

            if(!is_dir($css_path)) {
                $wp_filesystem -> mkdir($css_path, 775, true);
            }
            if(is_dir($css_path)) {
                file_put_contents($css_path . '/' . $css, $content);
            }
        } catch (\Exception $e) {
            print_r($e);
            exit;
            echo '<h1>' . $e->getMessage() . '</h1>';
            echo '<h3>' . $e->getFile() . ' in ' . $e->getLine() . '</h3>';
            exit;
        }
    }

    public static function add_inline_style($styles, $device = 'desktop', $css_file = true, $handle = false){
        if ($css_file) {
            self::$_styles[$device][] = $styles;
        } else {
            if($handle){
                wp_add_inline_style($handle, $styles);
            }
        }
    }

    public static function build_inline_style($version, $css = '', $css_file = true, $clean_cache = false)
    {
        $prefix = 'framework-';
        if ($css_file) {
            $theme_css_dir  = TEMPLAZA_FRAMEWORK_THEME_CSS_PATH;
            $file_name      = $prefix.$version.'.css';
            if(!file_exists($theme_css_dir.'/'.$file_name)){
                if($clean_cache) {
                    // Clear cache
                    self::clear_css_cache($theme_css_dir, 'framework');
                }
                $styles = preg_grep('~^' . $prefix . '.*\.(css)$~', scandir($theme_css_dir));
                foreach ($styles as $style) {
                    $space_time    =   time() - filemtime($theme_css_dir . '/' .$style);
                    if ($space_time > 86400) {
                        unlink($theme_css_dir . '/' . $style);
                    }
                }
                file_put_contents($theme_css_dir . '/' .$file_name, $css);
            }

            $theme_css_uri = Functions::get_my_theme_css_uri();
            wp_enqueue_style(TEMPLAZA_FRAMEWORK_THEME_DIR_NAME.'__tzfrm-framework', $theme_css_uri.'/'.$file_name, array());
        }
    }


    public static function load_css_file($css_file = true)
    {
        if ($css_file) {
            $styles = [];
            foreach (['desktop', 'tablet', 'mobile'] as $device) {
                if ($device == 'mobile') {
                    $styles[] = '@media (max-width: 767.98px) {' . implode('', self::$_styles[$device]) . '}';
                } elseif ($device == 'tablet') {
                    $styles[] = '@media (max-width: 991.98px) {' . implode('', self::$_styles[$device]) . '}';
                } else {
                    $styles[] = implode('', self::$_styles[$device]);
                }
            }
            $styles = implode('', $styles);
            $version = md5($styles);
            self::build_inline_style($version, $styles);
        }
    }

    public static function get_layout_styles()
    {
        $styles             = [];
        $options            = Functions::get_theme_options();
        $template_layout    = (isset($options['layout-theme']) && (bool) $options['layout-theme'])?'wide':'boxed';
        if ($template_layout != 'boxed') {
            return false;
        }
        $layout_background  = isset($options['layout-background'])?$options['layout-background']:array();

        if(count($layout_background)) {
            $layout_background_color        = isset($layout_background['background-color'])?$layout_background['background-color']:'';
            $layout_background_image        = isset($layout_background['background-image'])?$layout_background['background-image']:'';
            $layout_background_size         = isset($layout_background['background-size'])?$layout_background['background-size']:'inherit';
            $layout_background_repeat       = isset($layout_background['background-repeat'])?$layout_background['background-repeat']:'inherit';
            $layout_background_position     = isset($layout_background['background-position'])?$layout_background['background-position']:'inherit';
            $layout_background_attachment   = isset($layout_background['background-attachment'])?$layout_background['background-attachment']:'inherit';
            if(!empty($layout_background_color)){
                $styles[] = 'background-color: '.$layout_background_color;
            }
            if (!empty($layout_background_image)) {
                $styles[] = 'background-image:url(' .get_home_url() . '/' . $layout_background_image . ')';
                $styles[] = 'background-repeat:' . $layout_background_repeat;
                $styles[] = 'background-size:' . $layout_background_size;
                $styles[] = 'background-position:' . $layout_background_position;
                $styles[] = 'background-attachment:' . $layout_background_attachment;
            }
            return implode(';', $styles);
        }
        return false;
    }

    // Make css design style: background, padding, margin, border
    public static function make_css_design_style($option_names, $options, $important = false){

        if(!$option_names){
            return '';
        }

        $store_id   = __METHOD__;
        $store_id  .= ':'.serialize($option_names);
        $store_id  .= ':'.serialize($options);
        $store_id  .= ':'.$important;
        $store_id   = md5($store_id);

        if(isset(static::$cache[$store_id])){
            return static::$cache[$store_id];
        }

        $css    = '';
        if(is_array($option_names)){
            $important  = $important?' !important':'';

            foreach($option_names as $name){
                if($options[$name]){
                    $option = $options[$name];

                    // Background
                    if(array_key_exists('background-color', $option)) {
                        $css    .= CSS::background($option['background-color'], $option['background-image'],
                            $option['background-repeat'], $option['background-attachment'],
                            $option['background-position'],$option['background-size']);
                    }
                    // Border
                    if(array_key_exists('border-top', $option)){
                        $css    .= CSS::border($option['border-top'], $option['border-right'],
                            $option['border-bottom'], $option['border-left'],
                            $option['border-style'], $option['border-color'], $important);
                    }
                    // Border radius
                    if(array_key_exists('border-radius-top-left', $option)){
                        $css    .= CSS::border_radius($option['border-radius-top-left'], $option['border-radius-top-right'],
                            $option['border-radius-bottom-left'], $option['border-radius-bottom-right'], $important);
                    }
                    // Margin
                    if(array_key_exists('margin-top', $option)){
                        $css    .= CSS::margin($option['margin-top'], $option['margin-right'],
                            $option['margin-bottom'], $option['margin-left'], $important);
                    }
                    // Padding
                    if(array_key_exists('padding-top', $option)){
                        $css    .= CSS::padding($option['padding-top'], $option['padding-right'],
                            $option['padding-bottom'], $option['padding-left'], $important);
                    }
                }
            }
        }

        if(empty($css)){
            return '';
        }
        static::$cache[$store_id]   = $css;
        return $css;
    }

    public static function clear_css_cache($theme_dir = '', $prefix = 'style')
    {
        if(!is_dir($theme_dir)){
            return false;
        }

        if (is_array($prefix)) {
            foreach ($prefix as $pre) {
                $styles = preg_grep('~^' . $pre . '-.*\.(css)$~', scandir($theme_dir));
                foreach ($styles as $style) {
                    unlink($theme_dir . '/' . $style);
                }
            }
        } else {
            $styles = preg_grep('~^' . $prefix . '-.*\.(css)$~', scandir($theme_dir));
            foreach ($styles as $style) {
                unlink($theme_dir . '/' . $style);
            }
        }
        return true;
    }
}
