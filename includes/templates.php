<?php

namespace TemPlazaFramework;

use ScssPhp\ScssPhp\Compiler;
use ScssPhp\ScssPhp\OutputStyle;

defined('TEMPLAZA_FRAMEWORK') or exit();

class Templates{

    public static $_styles = ['xlarge' => [],'desktop' => [], 'tablet' => [], 'mobile' => []];
    public static $_devices= [
        'desktop' => '',
        'xlarge' => '@media (min-width: 1600px)',
        'laptop' => '@media (min-width: 960px) and (max-width: 1199.99px)',
        'tablet' => '@media (min-width: 640px) and (max-width: 959.99px)',
        'mobile' => '@media (max-width: 639.99px)',
    ];
//    public static $_devices= [
//        'tablet' => '@media (min-width: 640px) and (max-width: 960px)',
//        'laptop' => '@media (min-width: 960px) and (max-width: 1200px)',
//        'desktop' => '',
//        'xlarge' => '@media (min-width: 1600px)',
//        'mobile' => '@media (max-width: 640px)',
//    ];
// phpcs:disable WordPress.WP.AlternativeFunctions.file_system_operations_fopen, WordPress.WP.AlternativeFunctions.file_system_operations_fclose, WordPress.WP.AlternativeFunctions.unlink_unlink, WordPress.WP.AlternativeFunctions.file_system_operations_file_put_contents

    protected static $cache = array();

    public static function locate_my_template($template_names, $load = false, $require_once = true, $args = array()){
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
            load_template($located, $require_once, $args);
        }

        return $located;
    }

    public static function load_my_layout($partial, $load = true, $require_once = true, $args = array()){
        $partial    = str_replace('.', '/', $partial);
        $located    = self::locate_my_template((array) $partial, $load, $require_once, $args);

        return $located;
    }

    public static function load_my_header($name = null, $require_once = true, $args = array()){
        if('' != $name){
            self::load_my_layout($name, true, $require_once, $args);
        }else {
            self::load_my_layout('header', true, $require_once, $args);
        }
    }
    public static function load_my_footer($name = 'footer', $args = array()){
        if('' != $name){
            self::load_my_layout($name, true, $args);
        }else {
            self::load_my_layout('footer', true, $args);
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
                if(!is_file($frm_file)){
                    continue;
                }
                $css_name .= md5_file($frm_file);
                $css_name .= md5(filesize($frm_file));
            }
        }

        $file_list   = Functions::list_files($scss_file_path, '.scss');
        if(count($file_list)){
            foreach($file_list as $file){
                if(!is_file($file)){
                    continue;
                }
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

        $md5file    = md5_file($sass_file);

        $has_import = false;
        $a = fopen($sass_file,'r');
        while(!feof($a)){
            $line   = fgets($a);
            if(strpos($line,'@import') === false){
                continue;
            }

            list($import_str, $import_file) = explode('"', $line);
            $import_file    = preg_replace('/\/(.*)$/', '/_$1', $import_file);

            $import_file    = $sass_path.'/'.$import_file.'.scss';

            if(file_exists($import_file)){
                $md5file    .= '-'.md5_file($import_file);
                $has_import = true;
            }
        }
        fclose($a);

        if($has_import) {
            $md5file = md5($md5file);
        }

//        $css_name   = $prefix.'-'.md5_file($sass_file).'.css';
        $css_name   = $prefix.'-'.$md5file.'.css';
        $css_file   = $css_path.'/'.$css_name;

        if(!file_exists($css_file)){
            if($clean_cache) {
                self::clear_css_cache($css_path, $prefix);
            }
            self::compileSass($sass_path, $css_path, $sass_name, $css_name);
        }

        return $css_name;
    }

    public static function compileSass($sass_path, $css_path, $sass, $css, $compress = true, $variables = array())
    {
        try {
            global $wp_filesystem;

            require_once TEMPLAZA_FRAMEWORK_LIBRARY_PATH.'/phpclass/scssphp/scss.inc.php';

            // Require my scss formatter
            require_once TEMPLAZA_FRAMEWORK_LIBRARY_PATH.'/helper/scssphp/formatter/ExpandedNewline.php';

            $scss = new Compiler();
            $scss->setImportPaths($sass_path);
            if($compress){
                $scss -> setOutputStyle(OutputStyle::COMPRESSED);
            }else{
//                $scss -> setOutputStyle(OutputStyle::EXPANDED);
                $scss -> setFormatter('TemPlazaFramework\\ScssPhp\\Formatter\\ExpandedNewline');
            }
            if (!empty($variables)) {
                $scss->setVariables($variables);
            }

            $content = $scss -> compileString('@import "' . $sass . '";') -> getCss();

            if(!is_dir($css_path)) {
                $wp_filesystem -> mkdir($css_path, 775, true);
            }
            if(is_dir($css_path)) {
                file_put_contents($css_path . '/' . $css, $content);
            }
        } catch (\Exception $e) {
            print_r($e);
            exit;
            echo '<h1>' . esc_html($e->getMessage()) . '</h1>';
            echo '<h3>' . esc_html($e->getFile()) . ' in ' . esc_html($e->getLine()) . '</h3>';
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

    /**
    *
     */
    public static function add_inline_styles($styles = array(), $css_file = true, $handle = false){
        if(!count($styles)){
            return;
        }
        if(count($styles)){
            foreach($styles as $device => $style){
                if ($css_file) {
                    self::$_styles[$device][] = $style;
                }
                else {
                    if($handle){
                        wp_add_inline_style($handle, $style);
                    }
                }
            }
        }
    }

    public static function get_inline_styles(){
        $inline_styles  = self::$_styles;
        if(is_array($inline_styles)){
            $styles     = [];
//            $_devices   = array_keys(static::$_devices);
            foreach (static::$_devices as $device => $media_css) {
                $style_device   = array_unique(self::$_styles[$device]);
                if($device == 'desktop'){
                    $styles[] = implode('', $style_device);
                }else{
                    $styles[] = $media_css.'{' . implode('', $style_device) . '}';
                }

//                if ($device == 'mobile') {
//                    $styles[] = '@media (max-width: 767.98px) {' . implode('',$style_device) . '}';
//                } elseif ($device == 'tablet') {
//                    $styles[] = '@media (max-width: 991.98px) {' . implode('', $style_device) . '}';
//                } else {
//                    $styles[] = implode('', $style_device);
//                }
            }
            $styles = implode('', $styles);
            $inline_styles  = $styles;
        }
        return $inline_styles;
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
            wp_enqueue_style(TEMPLAZA_FRAMEWORK_THEME_DIR_NAME.'__tzfrm-framework', $theme_css_uri.'/'.$file_name, array(), Functions::get_my_version());
        }
    }


    public static function load_css_file($css_file = true)
    {
        if ($css_file) {
            $styles     = [];
            foreach (static::$_devices as $device => $media_css) {
                if($device == 'desktop'){
                    $styles[] = implode('', self::$_styles[$device]);
                }else{
                    $styles[] = $media_css.'{' . implode('', self::$_styles[$device]) . '}';
                }
//                if ($device == 'mobile') {
//                    $styles[] = '@media (max-width: 767.98px) {' . implode('', self::$_styles[$device]) . '}';
//                } elseif ($device == 'tablet') {
//                    $styles[] = '@media (max-width: 991.98px) {' . implode('', self::$_styles[$device]) . '}';
//                } else {
//                    $styles[] = implode('', self::$_styles[$device]);
//                }
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
        $template_layout    = isset($options['layout-theme']) ?$options['layout-theme']:'';
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

        $css    = array_keys(self::$_devices);

        // Set all value's items of $css array to ''
        $css    = array_fill_keys($css, '');

        if(is_array($option_names)){
            $important  = $important?' !important':'';

            foreach($option_names as $name){
                if(isset($options[$name]) && $options[$name]){
                    $option = $options[$name];

                    // Background
                    if(array_key_exists('background-color', $option)) {
                        $css['desktop']    .= CSS::background($option['background-color'], $option['background-image'],
                            $option['background-repeat'], $option['background-attachment'],
                            $option['background-position'],$option['background-size'],'','','',true);
                    }
                    // Border
                    $border_top     = '';
                    $border_right   = '';
                    $border_bottom  = '';
                    $border_left    = '';
                    $border_style   = '';
                    $border_color   = '';
                    if(array_key_exists('border-top', $option)){
                        $border_top = $option['border-top'];
                    }
                    if(array_key_exists('border-right', $option)){
                        $border_right = $option['border-right'];
                    }
                    if(array_key_exists('border-bottom', $option)){
                        $border_bottom = $option['border-bottom'];
                    }
                    if(array_key_exists('border-left', $option)){
                        $border_left = $option['border-left'];
                    }
                    if(array_key_exists('border-style', $option)){
                        $border_style = $option['border-style'];
                    }
                    if(array_key_exists('border-color', $option)){
                        $border_color = $option['border-color'];
                    }

                    $css['desktop']    .= CSS::border($border_top, $border_right,
                        $border_bottom, $border_left,
                        $border_style, $border_color, $important);

                    // Border radius
                    if(array_key_exists('border-radius-top-left', $option)){
                        $border_radius = CSS::make_spacing_redux('border-radius', $option, $important, 'px');
                        if(!empty($border_radius) && count($border_radius)){
                            if(is_array($border_radius) && count($border_radius)){
                                foreach ($border_radius as $device => $mstyle){
                                    $css[$device]   .= $mstyle;
                                }
                            }else{
                                $css['desktop'] .= $border_radius;
                            }
                        }
                    }
                    // Margin
                    if(array_key_exists('margin-top', $option)
                        || array_key_exists('margin-right', $option)
                        || array_key_exists('margin-bottom', $option)
                        || array_key_exists('margin-left', $option)){
                        $margin = CSS::make_spacing_redux('margin', $option, $important, 'px');
                        if(!empty($margin)){
                            if(is_array($margin) && count($margin)){
                                foreach ($margin as $device => $mstyle){
                                    $css[$device]   .= $mstyle;
                                }
                            }else{
                                $css['desktop'] .= $margin;
                            }
                        }
                    }
                    // Padding
                    if(array_key_exists('padding-top', $option)
                        || array_key_exists('padding-right', $option)
                        || array_key_exists('padding-bottom', $option)
                        || array_key_exists('padding-left', $option)){
                        $padding = CSS::make_spacing_redux('padding', $option, $important, 'px');
                        if(!empty($padding) && count($padding)){
                            if(is_array($padding) && count($padding)){
                                foreach ($padding as $device => $pstyle){
                                    $css[$device]   .= $pstyle;
                                }
                            }else{
                                $css['desktop'] .= $padding;
                            }
                        }
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

    public static function get_sass_name_hash($core_path = '', $theme_path = ''){

        $css_name   = '';

        $core_path  = !empty($core_path)?$core_path:TEMPLAZA_FRAMEWORK_SCSS_PATH;
        $theme_path = !empty($theme_path)?$theme_path:TEMPLAZA_FRAMEWORK_THEME_SCSS_PATH;

        $store_id   = __METHOD__;
        $store_id  .= ':'.$core_path;
        $store_id  .= ':'.$theme_path;
        $store_id   = md5($store_id);

        if(isset(static::$cache[$store_id])){
            return static::$cache[$store_id];
        }

        // Get framework scss core files
        if(is_dir($core_path)){
            $frm_files  = Functions::list_files($core_path, '.scss');
            if(!empty($frm_files) && count($frm_files)){
                foreach($frm_files as $frm_file){
                    if(!is_file($frm_file)){
                        continue;
                    }
                    $css_name .= md5_file($frm_file);
                    $css_name .= md5(filesize($frm_file));
                }
            }
        }

        if(is_dir($theme_path)){
            $file_list   = Functions::list_files($theme_path, '.scss');
            if(!empty($file_list) && count($file_list)){
                foreach($file_list as $file){
                    if(!is_file($file)){
                        continue;
                    }
                    $css_name .= md5_file($file);
                    $css_name .= md5(filesize($file));
                }
            }
        }

        if(!empty($css_name)){
            return static::$cache[$store_id]   = md5($css_name);
        }

        return '';
    }

    public static function get_devices($reset = false){
        $devices    = static::$_devices;

        if($reset){
            $devices    = array_fill_keys(array_keys($devices), '');
        }

        return $devices;
    }
}
