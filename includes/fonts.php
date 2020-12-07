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
        return $fonts;
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
}
