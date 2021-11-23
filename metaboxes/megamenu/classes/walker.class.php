<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit; // disable direct access
}

use TemPlazaFramework\CSS;
use TemPlazaFramework\Templates;

if( ! class_exists( 'TemplazaFramework_Mega_Menu_Walker' ) ) {

    /**
     * @package WordPress
     * @since 1.0.0
     * @uses Walker
     */
    class TemplazaFramework_Mega_Menu_Walker extends Walker_Nav_Menu
    {
        private $is_header_menu     = false;
        private $is_megamenu        = false;

        private $depth_mega = array();

        private $my_menu_type       = '__templaza_mega_item';
        private $menu_shorcode_tag  = 'templaza___megamenu_item';

        /**
         * Starts the list before the elements are added.
         *
         * @param string $output Passed by reference. Used to append additional content.
         * @param int $depth Depth of menu item. Used for padding.
         * @param array $args An array of arguments. @see wp_nav_menu()
         * @since 1.0
         *
         * @see Walker::start_lvl()
         *
         */
        function start_lvl(&$output, $depth = 0, $args = array())
        {
            if($this -> is_header_menu && isset($this -> depth_mega[$depth]) && !empty($this -> depth_mega[$depth])){
                $this -> start_my_lvl($output, $this -> depth_mega[$depth], $depth, $args);
            }else{
//                parent::start_lvl($output, $depth, $args);
                if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
                    $t = '';
                    $n = '';
                } else {
                    $t = "\t";
                    $n = "\n";
                }
                $indent = str_repeat( $t, $depth );

                // Default class.
                $classes = array( 'sub-menu' );

                /**
                 * Filters the CSS class(es) applied to a menu list element.
                 *
                 * @since 4.8.0
                 *
                 * @param string[] $classes Array of the CSS classes that are applied to the menu `<ul>` element.
                 * @param stdClass $args    An object of `wp_nav_menu()` arguments.
                 * @param int      $depth   Depth of menu item. Used for padding.
                 */
                $class_names = implode( ' ', apply_filters( 'nav_menu_submenu_css_class', $classes, $args, $depth ) );
//                $class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

                $attributes = array(
                    'class' => esc_attr( $class_names )
                );

                $attributes = apply_filters( 'templaza-framework/walker/megamenu/wp_nav_menu_submenu_attribute', $attributes, $args, $depth );

                $attributes = $this -> generate_attribute($attributes);

                $output .= "{$n}{$indent}<ul$attributes>{$n}";
            }

        }

        /**
         * Ends the list of after the elements are added.
         *
         * @param string $output Passed by reference. Used to append additional content.
         * @param int $depth Depth of menu item. Used for padding.
         * @param array $args An array of arguments. @see wp_nav_menu()
         * @since 1.0
         *
         * @see Walker::end_lvl()
         *
         */
        function end_lvl(&$output, $depth = 0, $args = array())
        {
            if($this -> is_header_menu){
                if(!isset($this -> depth_mega[$depth]) || (isset($this -> depth_mega[$depth]) && empty($this -> depth_mega[$depth]))){
                    parent::end_lvl($output, $depth, $args);
                }
            }else {
                parent::end_lvl($output, $depth, $args);
            }
        }

        protected function start_my_lvl(&$output, $item, $depth, $args){
            if($item && isset($item->templaza_megamenu_saved_layout)
                && !empty($item->templaza_megamenu_saved_layout)) {

                // Default class.
                $classes = array('sub-menu megamenu-sub-menu');

                $classes = apply_filters('nav_menu_submenu_css_class', $classes, $args, $depth);
                $class_names = join(' ', apply_filters('templaza-framework/walker/megamenu/submenu_class',
                    $classes, $args, $depth));

                $settings = array();
                if (property_exists($item, 'templaza_megamenu_settings')) {
                    $settings = $item->templaza_megamenu_settings;
                }
                $direction = isset($settings['submenu_direction']) ? $settings['submenu_direction'] : 'full';
                $width = isset($settings['width']) && ($direction != 'full' && $direction != 'edge') ? $settings['width'] : '';

                if ($direction == 'full') {
                    $width = '100vw';
                }
                if ($direction == 'edge') {
                    $width = '100vw';
                }

                $style = '';
                if ($width) {
                    $style .= 'width:' . $width . ';';
                }

//                $output .= '<div class="' . $class_names . '"' . (!empty($style) ? ' style="' . $style . '"' : '') . '><div class="container">';

                $attributes = array(
                    'class' => $class_names,
                    'style' => $style
                );
                $attributes_container   = array(
//                    'class' => 'container'
                );

                $attributes             = apply_filters( 'templaza-framework/walker/megamenu/submenu_attribute', $attributes, $args, $depth );
                $attributes_container   = apply_filters( 'templaza-framework/walker/megamenu/submenu_attribute_container', $attributes_container, $args, $depth );

                $attributes             = $this -> generate_attribute($attributes);
                $attributes_container   = $this -> generate_attribute($attributes_container);

                $output .= '<div'.$attributes.'>';
//                $output .= '<div'.$attributes.'><div'.$attributes_container.'>';
            }
        }

        private function generate_attribute($attributes){
            if(is_array($attributes) && count($attributes)){
                foreach($attributes as $key => &$attrib){
                    if(is_array($attrib)) {
                        $attrib = $key.'="'.implode($attrib).'"';
                    }else{
                        $attrib = $key . '="' . $attrib . '"';
                    }
                }
            }

            $attributes = implode(' ', $attributes);

            return !empty($attributes)?' '.$attributes:'';
        }

        protected function end_my_lvl(&$output, $item, $depth, $args){
            $output .= '</div>';
//            $output .= '</div></div>';
        }

        /**
         * Custom walker. Add the widgets into the menu.
         *
         * @param string $output Passed by reference. Used to append additional content.
         * @param object $item Menu item data object.
         * @param int $depth Depth of menu item. Used for padding.
         * @param array $args An array of arguments. @see wp_nav_menu()
         * @param int $id Current item ID.
         * @since 1.0
         *
         * @see Walker::start_el()
         *
         */
        function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0)
        {
            $this -> is_megamenu    = false;
            if(isset($item -> templaza_megamenu_layout) && !empty($item -> templaza_megamenu_layout)) {
                $this -> is_megamenu = true;
            }


            $this -> depth_mega[$depth] = false;
            if($this -> is_megamenu && $this -> has_children){
                $this -> depth_mega[$depth] = $item;
            }


            $settings   = array();
            if (property_exists($item, 'templaza_megamenu_settings')) {
                $settings = $item->templaza_megamenu_settings;
            }
            $direction = isset($settings['submenu_direction']) ? $settings['submenu_direction'] : 'left';

            // Item Class
            $classes = empty($item->classes) ? array() : (array)$item->classes;

            $has_mega_class = 'has-megamenu';
            $_args  = (array) $args;

            if($this -> is_megamenu) {
                $megamenu_data  = isset($_args['templaza_megamenu_html_data'])?$_args['templaza_megamenu_html_data']:array();
                if(isset($megamenu_data['data-megamenu-class'])) {
                    $has_mega_class = preg_replace('/^\./', '', $megamenu_data['data-megamenu-class']);
                }
            }

//            $hide_text  = isset($settings['hide_text'])?filter_var($settings['hide_text'], FILTER_VALIDATE_BOOLEAN):false;
//            if (!$hide_text) {
//                $highlight_style    = '';
//                if(isset($settings['highlight_text_color']) && !empty($settings['highlight_text_color'])){
//                    $highlight_style    .= 'color:'.$settings['highlight_text_color'].';';
//                }
//                if(isset($settings['highlight_text_bg_color']) && !empty($settings['highlight_text_bg_color'])){
//                    $highlight_style    .= 'background-color:'.$settings['highlight_text_bg_color'].';';
//                }
//                if(!empty($highlight_style)){
//                    Templates::add_inline_style('.menu-item-'.$item -> ID.' > a > .menu-highlight-label{'.$highlight_style.'}');
//                }
//            }

            if(isset($settings['background']) && !empty($settings['background'])){
                Templates::add_inline_style('.menu-item-'.$item -> ID.' > .sub-menu{'.CSS::background_redux($settings['background'], true).'}');
            }

            if(is_array($classes)){
                if(strpos($item -> ID,'-') == false) {
                    $classes[] = 'menu-item-' . $item->ID;
                }
                if($this -> is_megamenu) {
                    $classes[]  = $has_mega_class;
                    $id         = "megamenu-item-{$item->ID}";
                }else{
//                    $classes[]  = 'menu-item-' . $item->ID;
                    $id         = "megamenu-{$item->ID}";
                }
            }

            if(isset($settings['custom_class']) && !empty($settings['custom_class'])){
                $classes[]  = $settings['custom_class'];
            }

            $classes    = apply_filters('nav_menu_css_class',array_filter($classes), $item, $args);

            $class = join(' ', apply_filters('templaza-framework/walker/megamenu/megamenu_nav_menu_css_class',
                array_filter($classes), $item, $args));

            // these classes are prepended with 'mega-'
            $mega_classes = explode(' ', $class);

            // strip widget classes back to how they're intended to be output
            $class = str_replace("mega-menu-widget-class-", "", $class);

            $id = esc_attr(apply_filters('templaza-framework/walker/megamenu/megamenu_nav_menu_item_id',
                $id, $item, $args));

            $atts = array();

            $atts['title'] = !empty($item->attr_title) ? $item->attr_title : '';
            $atts['target'] = !empty($item->target) ? $item->target : '';
            $atts['class'] = '';
            $atts['rel'] = !empty($item->xfn) ? $item->xfn : '';

            if (!isset($settings['disable_link']) || (isset($settings['disable_link']) && !(bool) $settings['disable_link'])) {
                $atts['href'] = !empty($item->url) ? $item->url : '';
            } else {
                $atts['tabindex'] = 0;
            }

            if ($depth == 0) {
                $atts['tabindex'] = "0";
            }

            if (isset($settings['hide_text']) && $settings['hide_text'] == 'true') {
                $atts['aria-label'] = $item->title;
            }

            $atts = apply_filters('templaza-framework/walker/megamenu/megamenu_nav_menu_link_attributes', $atts, $item, $args);

            if (isset($atts['class']) && strlen($atts['class'])) {
                $atts['class'] = $atts['class'] . ' megamenu-item-link';
            } else {
                $atts['class'] = 'megamenu-item-link';
            }

            $atts['class']  .= ' item-level-'.($depth + 1);

            if($this -> is_megamenu || in_array('menu-item-has-children', $classes)) {
                $atts['class']  .= ' has-children';
            }

//            $attributes = '';
//
//            foreach ($atts as $attr => $value) {
//                if (strlen($value)) {
//                    $value = ('href' === $attr) ? esc_url($value) : esc_attr($value);
//                    $attributes .= ' ' . $attr . '="' . $value . '"';
//                }
//            }

            $item_output    = '';
            if ($item->type != $this->my_menu_type) {
                $item_output = $this->get_link_tag($item, $atts, $depth, $args);
            }

            /* New coding */
            if($this -> is_header_menu){

                if ($item->type == $this->my_menu_type) {

                    if (isset($item->templaza_megamenu_html) && !empty($item->templaza_megamenu_html)) {

                        if (!preg_match('/(.*?)\[' . $this->menu_shorcode_tag . '.*?\]/ims', $item->templaza_megamenu_html, $match)) {
                            if(isset($item -> templaza_allow_el) && $item -> templaza_allow_el) {
                                $output .= '<li data-position="' . $direction . '" class="' . $class . '" >';
                            }
                            $output .= $item->templaza_megamenu_html;
                        }

                        if (preg_match('/(.*?)[\n|\s]*?\[' . $this->menu_shorcode_tag . '.*?\]/ims',
                            $item->templaza_megamenu_html, $match)) {
                            $output .= $match[1];
                        }
                    }
                }else{
                    $has_lvl = $this->has_my_menu_type($item);
                    if($has_lvl){
                        if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
                            $t = '';
                            $n = '';
                        } else {
                            $t = "\t";
                            $n = "\n";
                        }
                        $indent = str_repeat( $t, $depth );

                        // Default class.
                        $classes = array('nav-submenu link-list');

                        /**
                         * Filters the CSS class(es) applied to a menu list element.
                         *
                         * @since 4.8.0
                         *
                         * @param string[] $classes Array of the CSS classes that are applied to the menu `<ul>` element.
                         * @param stdClass $args    An object of `wp_nav_menu()` arguments.
                         * @param int      $depth   Depth of menu item. Used for padding.
                         */
                        $class_names = implode( ' ', apply_filters( 'nav_menu_submenu_css_class', $classes, $args, $depth ) );
                        $class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

                        $output .= "{$n}{$indent}<ul$class_names>{$n}";
                    }
                    $output .= '<li data-position="' . $direction . '" class="' . $class . '" >';
                }
            }else{
                $output .= '<li class="' . $class . '" >';
            }

            $output .= apply_filters('templaza-framework/walker/megamenu/megamenu_walker_nav_menu_start_el',
                $item_output, $item, $depth, $args);
        }

        protected function has_my_menu_type($item, $position = 'prev'){
            $has_lvl        = false;
            $items          = $this -> elements;
            $db_ids         = wp_list_pluck($items, 'db_id');
            $parent_id      = $item -> menu_item_parent;

            $pos_item       = '';

            $parent_index   = array_search($parent_id, $db_ids);
            $item_index     = array_search($item -> db_id, $db_ids);
            $pos_index      = -1;

            if($position == 'prev'){
                $pos_index  = $item_index - 1;
            }elseif($position == 'next'){
                $pos_index  = $item_index + 1;
            }

            if(isset($items[$pos_index])){
                $pos_item   = $items[$pos_index];
            }

            if(isset($items[$parent_index]) && $items[$parent_index] -> type == $this -> my_menu_type) {
                if($position == 'prev' && !empty($pos_item) && $pos_item -> type == $this -> my_menu_type){
                    $has_lvl    = true;
                }
                if($position == 'next' && (empty($pos_item) || (!empty($pos_item) && ($pos_item -> type == $this -> my_menu_type
                                || ($pos_item -> type != $this -> my_menu_type
                                    && $pos_item -> menu_item_parent != $item -> menu_item_parent))))){
                    $has_lvl    = true;
                }
            }

            return $has_lvl;
        }

        protected function get_link_tag($item, $attributes, $depth, $args = array()){

            $args       = (array) $args;
            $settings   = array();

            $_attributes = '';

            foreach ($attributes as $attr => $value) {
                if (strlen($value)) {
                    $value = ('href' === $attr) ? esc_url($value) : esc_attr($value);
                    $_attributes .= ' ' . $attr . '="' . $value . '"';
                }
            }

            if (property_exists($item, 'templaza_megamenu_settings')) {
                $settings = $item->templaza_megamenu_settings;
            }

            $icon_position  = 'left';
            if(isset($settings['icon_position'])){
                $icon_position  = $settings['icon_position'];
            }
            $icon   = '';
            if (isset($settings['icon']) && $settings['icon'] != 'disabled' && $settings['icon'] != 'custom') {
                if($icon_position == 'top' || $icon_position == 'bottom') {
                    $settings['icon'] .= ' w-100';
                }
                if($icon_position == 'right' || $icon_position == 'bottom') {
                    $settings['icon'] .= ' order-2';
                }
                $icon = '<i class="menu-icon uk-margin-small-right ' . $settings['icon'] . '"></i>';
            }

            $item_output = $args['before'];
            $item_output .= '<a' . $_attributes . '>';

            $before_title   = '';
            $item_output .= apply_filters('templaza-framework/walker/megamenu/before_megamenu_the_title',
                $before_title, $item, $attributes, $args);

            if(!empty($icon)){
                $item_output    .= $icon;
            }

            $hide_text  = isset($settings['hide_text'])?filter_var($settings['hide_text'], FILTER_VALIDATE_BOOLEAN):false;

            if ($hide_text) {
                /** This filter is documented in wp-includes/post-template.php */
            } else if (property_exists($item, 'templaza_megamenu_description') && strlen($item->templaza_megamenu_description)) {
                $item_output .= '<span class="megamenu-description-group">';
                $item_output .= '<span class="megamenu-title">';
                $item_output .= $args['link_before']. apply_filters('templaza-framework/walker/megamenu/megamenu_the_title',
                        $item -> title, $item, $attributes, $args) . $args['link_after'];
                $item_output .= '</span><span class="megamenu-description">'
                    . $item->description . '</span>';
                $item_output .= '</span>';
            } else {
                $item_output .= $args['link_before'].'<span class="megamenu-title">';
                $item_output .= apply_filters('templaza-framework/walker/megamenu/megamenu_the_title',
                    $item -> title, $item, $attributes, $args);
                $item_output .= '</span>' . $args['link_after'];
            }

            if (!$hide_text) {
                if(isset($settings['highlight_text']) && !empty($settings['highlight_text'])){
                    $item_output    .= '<span class="menu-highlight-label">'.$settings['highlight_text'].'</span>';
                }

                $highlight_style    = '';
                if(isset($settings['highlight_text_color']) && !empty($settings['highlight_text_color'])){
                    $highlight_style    .= 'color:'.$settings['highlight_text_color'].';';
                }
                if(isset($settings['highlight_text_bg_color']) && !empty($settings['highlight_text_bg_color'])){
                    $highlight_style    .= 'background-color:'.$settings['highlight_text_bg_color'].';';
                }
                if(!empty($highlight_style)){
                    Templates::add_inline_style('.menu-item-'.$item -> ID.' > a > .menu-highlight-label{'.$highlight_style.'}');
                }
            }



            $options    = \TemPlazaFramework\Functions::get_theme_options();
            $show_arrow = isset($options['dropdown-arrow'])?(bool) $options['dropdown-arrow']:true;

            if (/*$this -> is_megamenu &&*/ $this -> has_children) {
                if($show_arrow) {
                    $arrow_icon = isset($settings['dropdown-arrow-icon'])?$settings['dropdown-arrow-icon']:'megamenu-indicator';
                    if($icon_position == 'right') {
                        $item_output .= '<span class="'.$arrow_icon.' order-3 megamenu-arrow"></span>';
                    }else {
                        $item_output .= '<span class="'.$arrow_icon.' megamenu-arrow"></span>';
                    }
                }
            }

            $after_title    = '';
            $item_output .= apply_filters('templaza-framework/walker/megamenu/after_megamenu_the_title',
                $after_title, $item, $attributes, $args);

            $item_output .= '</a>';
            $item_output .= $args['after'];
            return $item_output;
        }

        protected function get_link_attribute($item, $depth = 0, $args = array()){

            // Item Class
            $classes = empty($item->classes) ? array() : (array)$item->classes;

            $has_mega_class = 'has-megamenu';
            $_args  = (array) $args;

            if($this -> is_megamenu) {
                $megamenu_data  = isset($_args['templaza-megamenu-html-data'])?$_args['templaza-megamenu-html-data']:array();
                if(isset($megamenu_data['data-megamenu-class'])) {
                    $has_mega_class = preg_replace('/^\./', '', $megamenu_data['data-megamenu-class']);
                }
            }

            if(is_array($classes)){
                if($this -> is_megamenu) {
                    $classes[]  = $has_mega_class;
                    $id         = "megamenu-item-{$item->ID}";
                }else{
                    $classes[]  = 'menu-item-' . $item->ID;
                    $id         = "megamenu-{$item->ID}";
                }
            }

            if(isset($settings['custom_class']) && !empty($settings['custom_class'])){
                $classes[]  = $settings['custom_class'];
            }

            $classes    = apply_filters('nav_menu_css_class',array_filter($classes), $item, $args);

            $class = join(' ', apply_filters('templaza-framework/walker/megamenu/megamenu_nav_menu_css_class',
                array_filter($classes), $item, $args));

            // these classes are prepended with 'mega-'
            $mega_classes = explode(' ', $class);

            // strip widget classes back to how they're intended to be output
            $class = str_replace("mega-menu-widget-class-", "", $class);

            $id = esc_attr(apply_filters('templaza-framework/walker/megamenu/megamenu_nav_menu_item_id',
                $id, $item, $args));

            $atts = array();

            $atts['title'] = !empty($item->attr_title) ? $item->attr_title : '';
            $atts['target'] = !empty($item->target) ? $item->target : '';
            $atts['class'] = '';
            $atts['rel'] = !empty($item->xfn) ? $item->xfn : '';

            if (!isset($settings['disable_link']) || (isset($settings['disable_link']) && !(bool) $settings['disable_link'])) {
                $atts['href'] = !empty($item->url) ? $item->url : '';
            } else {
                $atts['tabindex'] = 0;
            }

            if ($depth == 0) {
                $atts['tabindex'] = "0";
            }

            if (isset($settings['hide_text']) && $settings['hide_text'] == 'true') {
                $atts['aria-label'] = $item->title;
            }

            $atts = apply_filters('templaza-framework/walker/megamenu/megamenu_nav_menu_link_attributes', $atts, $item, $args);

            if (isset($atts['class']) && strlen($atts['class'])) {
                $atts['class'] = $atts['class'] . ' megamenu-item-link';
            } else {
                $atts['class'] = 'megamenu-item-link';
            }

            $atts['class']  .= ' item-level-'.($depth + 1);

            if($this -> is_megamenu || in_array('menu-item-has-children', $classes)) {
                $atts['class']  .= ' has-children';
            }

            $attributes = '';

            foreach ($atts as $attr => $value) {
                if (strlen($value)) {
                    $value = ('href' === $attr) ? esc_url($value) : esc_attr($value);
                    $attributes .= ' ' . $attr . '="' . $value . '"';
                }
            }

            return $attributes;
        }

        /**
         * Ends the element output, if needed.
         *
         * @param string $output Passed by reference. Used to append additional content.
         * @param object $item Page data object. Not used.
         * @param int $depth Depth of page. Not Used.
         * @param array $args An array of arguments. @see wp_nav_menu()
         * @see Walker::end_el()
         *
         * @since 1.7
         *
         */
        public function end_el(&$output, $item, $depth = 0, $args = array())
        {
            if($this -> is_header_menu){
                if ($item->type == $this->my_menu_type) {
                    if(isset($item -> templaza_allow_el) && $item -> templaza_allow_el) {
                        parent::end_el($output, $item, $depth, $args);
                    }else{
                        if (preg_match('/\[' . $this->menu_shorcode_tag . '.*?\][\n|\s]*?(.*?)$/ism',
                            $item->templaza_megamenu_html, $match)) {
                            $output .= $match[1];
                        }
                    }
                }else{
                    if(isset($this -> depth_mega[$depth]) && !empty($this -> depth_mega[$depth])
                        && $item -> db_id == $this -> depth_mega[$depth] -> db_id){
                        $this -> end_my_lvl($output, $item, $depth, $args);
                    }
                    parent::end_el($output, $item, $depth, $args);

                    $has_lvl = $this->has_my_menu_type($item, 'next');
                    if($has_lvl){
                        $output .= '</ul>';
                    }
                }
            }else {
                parent::end_el($output, $item, $depth, $args);
            }
        }

        public function walk( $elements, $max_depth, ...$args ) {
            $_args  = (array) $args[0];
            $this -> is_header_menu    = (isset($_args['templaza_megamenu_html_data']) && !empty($_args['templaza_megamenu_html_data']))?true:false;
            $this -> elements            = $elements;
            $output = parent::walk($elements, $max_depth, ...$args);

            return $output;
        }

    }

}