<?php

namespace TemPlazaFramework;

use ScssPhp\ScssPhp\Compiler;

defined('TEMPLAZA_FRAMEWORK') or exit();

class Menu{

    public static function get_nav_menu($args = array()){

        if(isset($args['theme_location']) && !empty($args['theme_location']) && !has_nav_menu($args['theme_location'])){
            return '';
        }

//        $options    = Functions::get_theme_options();
        $options    = Functions::get_header_options();

//        $header  = isset($options['enable-header'])?(bool) $options['enable-header']:true;
        $mode    = isset($options['header-mode'])?$options['header-mode']:'horizontal';
        $header_stacked_menu_mode   = isset($options['header-stacked-menu-mode'])?$options['header-stacked-menu-mode']:'center';

        if($mode == 'stacked' && $header_stacked_menu_mode == 'seperated'){
            add_filter( 'wp_nav_menu_objects', array( 'TemPlazaFramework\Menu', 'add_logo_to_menu' ), 1000000, 2 );
        }

        return wp_nav_menu($args);
    }

    public static function add_logo_to_menu($items, $args){

        $is_sticky  = (isset($args -> templaza_is_sticky) && $args -> templaza_is_sticky)?$args -> templaza_is_sticky:false;
        if(!$is_sticky){
            ob_start();
            Templates::load_my_layout('logo', true, false);
            $logo_html    = ob_get_contents();
            ob_end_clean();
            if(!empty($items)){
                $remember  = array();
                $root_count  = 0;
                foreach($items as $i => $item){
                    if($item -> menu_item_parent == 0) {
                        $remember[$item -> ID]    = $i;
                        $root_count++;
                    }
                }
                $count  = 0;
                $split  = 0;
                if($root_count % 2 != 0){
//                    $options    = Functions::get_theme_options();
                    $options    = Functions::get_header_options();
                    $odd_position   = isset($options['header-odd-menu-items'])?$options['header-odd-menu-items']:'left';
                    if($odd_position == 'right'){
                        $count--;
                    }
                }
                foreach($items as $j => $item){
                    if($item -> menu_item_parent == 0) {
                        if($count == (int)($root_count / 2)){
                            $split  = $j;
                            break;
                        }
                        $count++;
                    }
                }
                $rolling_dummy_id = 999999999;
                $max_id = (int) max(wp_list_pluck($items, 'db_id'));
                $rolling_dummy_id = $max_id < $rolling_dummy_id?$rolling_dummy_id+1:$max_id+1;
                $layout_item = array(
                    'menu_item_parent' => 0,
                    'type' => '__templaza_mega_item',
                    'title' => 'Logo',
                    'parent_submenu_type' => '',
                    'menu_order' => $split+1,
                    'depth' => 0,
                    'classes' => array(
                        'menu-item-logo'
                    ),
                    'ID' => "{$item->ID}-{$i}-{$count}",
                    'db_id' => $rolling_dummy_id,
                    'templaza_allow_el'  => true,
                    'templaza_megamenu_html'  => $logo_html,
                    'templaza_megamenu_layout'  => '',
                );
                $layout_item    = (object) $layout_item;

                $first_items    = array_slice($items, 0, $split);
                $second_items    = array_slice($items, $split, count($items));

                if(count($second_items)){
                    foreach ($second_items as &$second_item){
                        $second_item -> menu_order++;
                    }
                }

                $items  = array_merge($first_items, array($layout_item), $second_items);
            }
        }
        return $items;
    }
}