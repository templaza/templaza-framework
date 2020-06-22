<?php

namespace TemPlazaFramework;

use ScssPhp\ScssPhp\Compiler;

defined('TEMPLAZA_FRAMEWORK') or exit();

class Menu{

    public static function get_nav_menu($args = array()){
        $options    = Functions::get_theme_options();

//        $header  = isset($options['enable-header'])?(bool) $options['enable-header']:true;
        $mode    = isset($options['header-mode'])?$options['header-mode']:'horizontal';
        $header_stacked_menu_mode   = isset($options['header-stacked-menu-mode'])?$options['header-stacked-menu-mode']:'center';
        if($mode == 'stacked' && $header_stacked_menu_mode == 'seperated'){
            add_filter('wp_nav_menu_items', array('TemPlazaFramework\Menu','seperated_nav_menu'), 10, 2);
        }

        return wp_nav_menu($args);
    }

    public static function seperated_nav_menu($items, $args){
        if(!$items){
            return $items;
        }
        $dom = new \DOMDocument();
        $dom->loadHTML($items);
        $find = $dom->getElementsByTagName('li');

        $count  = $find -> count();

        $new_el_logo = $dom->createElement('li', '');
        $new_el_logo -> setAttribute('class', 'nav-item nav-stacked-logo text-center');
//                        $img_el = $dom -> createElement('img');
//                        $img_el -> setAttribute('src', '#');
//                        $img_el -> setAttribute('alt', '');
//                        $img_el -> setAttribute('title', '');
//                        $new_el_logo -> appendChild($img_el);


//                        $default_logo       = isset($options['default-logo'])?$options['default-logo']:false;
//                        $mobile_logo        = isset($options['mobile-logo'])?$options['mobile-logo']:false;
//                        $sticky_header_logo= isset($options['sticky-logo'])?$options['sticky-logo']:false;
//                        var_dump($default_logo);
////                        die;
//
//                        $logo_type                  = isset($options['logo-type'])?(bool) $options['logo-type']:true; // Logo Type
//                        $header_mode                = isset($options['header-mode'])?$options['header-mode']:'horizontal';
//                        $header_stacked_menu_mode   = isset($options['header-stacked-menu-mode'])?$options['header-stacked-menu-mode']:'center';
//                        var_dump($logo_type);
//                        var_dump($header_mode);
//                        var_dump($header_stacked_menu_mode);
//                        die();
//

        ob_start();
        Templates::load_my_layout('logo', true, false);
        $img    = ob_get_contents();
        ob_end_clean();

        if(!empty($img)) {
            $fragment = $dom->createDocumentFragment();
            $fragment->appendXML( $img);
//                            $fragment->appendXML( Templates::load_my_layout('logo'));
            //                        $fragment->appendXML('<div>This is a test element.</div>');
            $new_el_logo -> appendChild($fragment);
        }

        foreach ($find as $i => $item ) {
            if ($i == ceil($count / 2) + 1) {
                $item->parentNode->insertBefore($new_el_logo, $item);
            }
        }
//                        die();
//                        var_dump($dom -> saveHTML());
//                        die();

        return $dom->saveHTML();
    }
}
