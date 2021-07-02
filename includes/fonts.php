<?php

namespace TemPlazaFramework;

use TemPlazaFramework\Functions;
use TemPlazaFramework\Templates;

defined('TEMPLAZA_FRAMEWORK') or exit();

class Fonts{

    public static $std_fonts = array(
        "Arial, Helvetica, sans-serif"                         => "Arial, Helvetica, sans-serif",
        "'Arial Black', Gadget, sans-serif"                    => "'Arial Black', Gadget, sans-serif",
        "'Bookman Old Style', serif"                           => "'Bookman Old Style', serif",
        "'Comic Sans MS', cursive"                             => "'Comic Sans MS', cursive",
        "Courier, monospace"                                   => "Courier, monospace",
        "Garamond, serif"                                      => "Garamond, serif",
        "Georgia, serif"                                       => "Georgia, serif",
        "Impact, Charcoal, sans-serif"                         => "Impact, Charcoal, sans-serif",
        "'Lucida Console', Monaco, monospace"                  => "'Lucida Console', Monaco, monospace",
        "'Lucida Sans Unicode', 'Lucida Grande', sans-serif"   => "'Lucida Sans Unicode', 'Lucida Grande', sans-serif",
        "'MS Sans Serif', Geneva, sans-serif"                  => "'MS Sans Serif', Geneva, sans-serif",
        "'MS Serif', 'New York', sans-serif"                   => "'MS Serif', 'New York', sans-serif",
        "'Palatino Linotype', 'Book Antiqua', Palatino, serif" => "'Palatino Linotype', 'Book Antiqua', Palatino, serif",
        "Tahoma,Geneva, sans-serif"                            => "Tahoma, Geneva, sans-serif",
        "'Times New Roman', Times,serif"                       => "'Times New Roman', Times, serif",
        "'Trebuchet MS', Helvetica, sans-serif"                => "'Trebuchet MS', Helvetica, sans-serif",
        "Verdana, Geneva, sans-serif"                          => "Verdana, Geneva, sans-serif",
    );

    protected static $_google_fonts = array();

    public static function get_uploaded_fonts()
    {
        require_once TEMPLAZA_FRAMEWORK_LIBRARY_PATH.'/FontLib/Autoloader.php';

        $template_fonts_path = TEMPLAZA_FRAMEWORK_THEME_PATH . "/fonts";
        if (!file_exists($template_fonts_path)) {
            return [];
        }
        $fonts = [];
        $font_extensions = ['otf', 'ttf', 'woff'];
        foreach (scandir($template_fonts_path) as $font_path) {
            if (is_file($template_fonts_path . '/' . $font_path)) {
                $pathinfo = pathinfo($template_fonts_path . '/' . $font_path);
                if (in_array($pathinfo['extension'], $font_extensions)) {
                    $font = \FontLib\Font::load($template_fonts_path . '/' . $font_path);
                    $font->parse();
                    $fontname = $font->getFontFullName();
                    $fontid = 'library-font-' . sanitize_title($fontname);
                    if (!isset($fonts[$fontid])) {
                        $fonts[$fontid] = [];
                        $fonts[$fontid]['id'] = $fontid;
                        $fonts[$fontid]['name'] = $fontname;
                        $fonts[$fontid]['files'] = [];
                    }
                    $fonts[$fontid]['files'][] = './../fonts/' . $font_path;
                }
            }
        }
        return apply_filters('templaza-framework/fonts/uploaded/list', $fonts);
    }

    public static function load_library_font($font)
    {
        if (empty($font)) {
            return;
        }
        $style = '';
        foreach ($font['files'] as $file) {
            $style .= '@font-face { font-family: "' . $font['name'] . '"; src: url("' . $file . '");
            }';
        }
        Templates::add_inline_style($style);
    }

    public static function is_system_font($font)
    {
        return isset(self::$std_fonts[$font]);
    }

    /**
     * Make_google_web_font_link Function.
     * Creates the google fonts link.
     *
     * @since ReduxFramework 3.0.0
     *
     * @param array $fonts Array of google fonts.
     *
     * @return string
     */
    public static function make_google_web_font_link( $fonts = array() ) {

        $fonts  = count($fonts)?$fonts:static::get_google_font_assigned_list();

        if(!count($fonts)){
            return false;
        }

        $link    = '';
        $subsets = array();

        foreach ( $fonts as $family => $font ) {
            if ( ! empty( $link ) ) {
                $link .= '%7C'; // Append a new font to the string.
            }
            $link .= $family;

            if ( ! empty( $font['font-style'] ) || ! empty( $font['all-styles'] ) ) {
                $link .= ':';
                if ( ! empty( $font['all-styles'] ) ) {
                    $link .= implode( ',', $font['all-styles'] );
                } elseif ( ! empty( $font['font-style'] ) ) {
                    $link .= implode( ',', $font['font-style'] );
                }
            }

            if ( ! empty( $font['subset'] ) || ! empty( $font['all-subsets'] ) ) {
                if ( ! empty( $font['all-subsets'] ) ) {
                    foreach ( $font['all-subsets'] as $subset ) {
                        if ( ! in_array( $subset, $subsets, true ) ) {
                            array_push( $subsets, $subset );
                        }
                    }
                } elseif ( ! empty( $font['subset'] ) ) {
                    foreach ( $font['subset'] as $subset ) {
                        if ( ! in_array( $subset, $subsets, true ) ) {
                            array_push( $subsets, $subset );
                        }
                    }
                }
            }
        }

        if ( ! empty( $subsets ) ) {
            $link .= '&subset=' . implode( ',', $subsets );
        }
//        $link .= '&display=' . $this->parent->args['font_display'];

        return 'https://fonts.googleapis.com/css?family=' . $link;
    }

    public static function get_google_font_assigned_list(){
        $fonts  = static::$_google_fonts;
        return apply_filters('templaza-framework/typography/google-font/list', $fonts);
    }

    public static function make_css_style($font_option, $devices = array('desktop' => '', 'tablet' => '', 'mobile' => '')){

        $open_devices   = array_filter($devices);
        $def_devices    = array('desktop' => '');
        $devices        = array_merge($def_devices, $devices);
        $devices        = array_keys($devices);
        $devices        = array_fill_keys($devices, '');

        if(!count($font_option)){
            return $devices;
        }

        $libraryFonts   = static::get_uploaded_fonts();
        $font_family    = $font_option['font-family'];
        $is_google_font = (isset($font_option['google']) && (bool) $font_option['google'])?true:false;

        // Create font-family css style
        if (!empty($font_family)) {
            if ($is_google_font) {
                // Push google font to stack to generate link
                $google_font_style  = array();
                $google_font_subset = array();
                if(isset(static::$_google_fonts[$font_family])){
                    $google_font_style  = static::$_google_fonts[$font_family]['font-style'];
                    $google_font_subset = static::$_google_fonts[$font_family]['subset'];
                }

                $_font_style    = $font_option['font-weight'] . $font_option['font-style'];
                if(!count($google_font_style) || (count($google_font_style) && !in_array($_font_style, $google_font_style))){
                    $google_font_style[]    = $_font_style;
                }

                if(isset($font_option['subsets']) && count($google_font_subset) && !in_array($font_option['subsets'], $google_font_subset)){
                    $google_font_subset   = $font_option['subsets'];
                }

                static::$_google_fonts[$font_family]    = array(
                    'font-style' => $google_font_style,
                    'subset'     => $google_font_subset,
                );
            }

            if (isset($libraryFonts[$font_family])) {
                $device_font_family = 'font-family: ' . $libraryFonts[$font_family]['name'];
                Fonts::load_library_font($libraryFonts[$font_family]);
            }else{
                if(strpos($font_family, ' ') != false){
                    $device_font_family = 'font-family: \'' . $font_family.'\'';
                }else {
                    $device_font_family = 'font-family: ' . $font_family;
                }
            }
            if(isset($font_option['font-backup']) && !empty($font_option['font-backup'])){
                $device_font_family .= ', '.$font_option['font-backup'];
            }
            $devices['desktop'] .= $device_font_family . ';';
        }

        // Create font option has devices
        $end_key    = @end(array_keys($font_option));
        foreach($font_option as $key => $option){
            if($key == 'font-family' || $key == 'font-backup'
                || $key == 'font-options' || $key == 'google' || $key == 'subsets'){
                continue;
            }
            if(is_array($option)){
                foreach($option as $device => $value){
                    if(!empty($value)){
                        $devices[$device]   .= $key.':'.$value.';';
                    }

//                    if(count($open_devices) && isset($open_devices[$device]) && $end_key == $key){
//                        $open_device    = trim($open_devices[$device]);
//                        if(!preg_match('/\{$/is', $open_device)){
//                            $open_device    .= '{';
//                        }
//                        $devices[$device] = $open_device.$devices[$device].'}';
//                    }
                }
            }else{
                if(!empty($option)) {
                    $devices['desktop'] .= $key . ':' . $option . ';';
                }

//                if(count($open_devices) && isset($open_devices['desktop']) && $end_key == $key){
//                    $open_device    = trim($open_devices['desktop']);
//                    if(!preg_match('/\{$/is', $open_device)){
//                        $open_device    .= '{';
//                    }
//
//                    $devices['desktop'] = $open_device.$devices['desktop'].'}';
//                }
            }

            if(count($open_devices) && $end_key == $key){
                foreach ($open_devices as $device => $class) {
                    if(!empty($devices[$device])){
                        if (!preg_match('/\}$/is', $devices[$device])) {
                            $class .= '{';
                            $devices[$device] = $class . $devices[$device] . '}';
                        }
                    }
                }
//                }
            }
        }

        return $devices;
    }

    public static function add_css_inline(){

    }
}
