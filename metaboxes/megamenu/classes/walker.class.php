<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit; // disable direct access
}

if( ! class_exists( 'TemplazaFramework_Mega_Menu_Walker' ) ) {

    /**
     * @package WordPress
     * @since 1.0.0
     * @uses Walker
     */
    class TemplazaFramework_Mega_Menu_Walker extends Walker_Nav_Menu
    {
        private $item_tmp;
        private $prev_item;
        private $prev_depth = -1;
        private $current_el;
        private $item_has_child;
        private $depth_tmp;
        private $has_layout = false;
        private $my_trees = array();
        private $has_mega_lvl = false;
        private $has_original_lvl = false;

        private $my_menu_type = '__templaza_mega_item';
        private $menu_shorcode_tag = 'templaza___megamenu_item';

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
            /* Coding */
            // Create submenu main html tag
            if($this -> has_original_lvl) {
                if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
                    $t = '';
                    $n = '';
                } else {
                    $t = "\t";
                    $n = "\n";
                }
                $indent = str_repeat( $t, $depth );

                // Default class.
                $classes = array( 'nav-submenu link-list' );

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

            }else {
                if($this -> has_layout) {
                    if ($this->item_tmp && isset($this->item_tmp->templaza_megamenu_saved_layout)
                        && !empty($this->item_tmp->templaza_megamenu_saved_layout)) {

                        $item   = $this -> item_tmp;

//                        // Default class.
//                        $classes = array('sub-menu megamenu-sub-menu');
//
//
//                        $classes = apply_filters('nav_menu_submenu_css_class', $classes, $args, $depth);
//                        $class_names = join(' ', apply_filters('templaza-framework/walker/megamenu/submenu_class',
//                            $classes, $args, $depth));
//
//                        $settings   = array();
//                        if (property_exists($item, 'templaza_megamenu_settings')) {
//                            $settings = $item->templaza_megamenu_settings;
//                        }
//                        $direction  = isset($settings['submenu_direction'])?$settings['submenu_direction']:'full';
//                        $width      = isset($settings['width']) && ($direction != 'full' && $direction != 'edge')?$settings['width']:'';
//
////                    if($depth == 0){
//                        if ($direction == 'full') {
//                            $width = '100vw';
//                        }
//                        if ($direction == 'edge') {
//                            $width = '100vw';
//                        }
////                    }
//
//                        $style      = '';
//                        if($width){
//                            $style  .= 'width:'.$width.';';
//                        }
//
//                        $output .= '<div class="' . $class_names . '"' . (!empty($style) ? ' style="' . $style . '"' : '') . '><div class="container">';

                        $this -> start_my_lvl($output, $item, $depth, $args);

                        $this -> my_trees[$depth]   = $item;

                        if(isset($this -> elements) && !empty($this -> elements)) {
                            $db_ids = wp_list_pluck($this->elements, 'db_id');
                            $children = wp_list_pluck($this->elements, 'menu_item_parent');

                            $parent_index = array_search($item->db_id, array_reverse($children, true));
                            if ($parent_index !== false && isset($this->elements[$parent_index])) {
                                $this->item_mega_lvl = $this->elements[$parent_index];
                            }
                        }

//                        $this->has_mega_lvl = true;
                    }

                }
                else{
                    parent::start_lvl($output, $depth, $args);
                }
            }
            /* End coding */

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
            /* Coding */
            if($this -> has_original_lvl){
                parent::end_lvl($output, $depth, $args);
            }else {
                if($this -> has_layout) {
//                    if ($this->item_tmp->type == $this->my_menu_type) {
//                        if (preg_match('/\[' . $this->menu_shorcode_tag . '.*?\][\n|\s]*?(.*?)$/ism',
//                            $this->item_tmp->templaza_megamenu_html, $match)) {
//    //                        var_dump('end_lvl_item_db_id_first: '.$this -> item_tmp -> db_id);
//    //                        var_dump($match);
//    //                        if($this -> item_tmp -> db_id == 1000000000){
//    //                            var_dump($match); die();
//    //                        }
//                            $output .= $match[1];
//                            $output .= $this->item_tmp -> title;
//                        }
//                    }
                    // Create submenu main html tag
//                    if ((isset($this->has_mega_lvl) && $this->has_mega_lvl) ||
//                        (isset($this->item_tmp) && isset($this->item_tmp->templaza_megamenu_saved_layout))
//                        && !empty($this->item_tmp->templaza_megamenu_saved_layout)) {
//                    var_dump('end_lvl: '.$this -> has_mega_lvl);

//                    var_dump('end_lvl_item_db_id: '.$this -> item_tmp -> db_id.'__'.$this -> item_tmp -> title);

//                    var_dump('end_lvl_has_children: '.$this -> has_children);

                    ///////////

//                    $this -> end_my_lvl($output, )

//                    if ($this -> has_mega_lvl && $depth > 0) {
//                        $output .= '</div></div>';
//                        $output .= 'has_mega_lvl: '.$this -> has_mega_lvl;
//                        $this->has_mega_lvl = false;
//                    }


//                    if ($this -> has_mega_lvl || (/*!$this -> has_mega_lvl && */isset($this -> item_mega_lvl)
//                            && $this -> item_mega_lvl -> db_id == $this -> item_tmp -> db_id)) {
//                        $output .= '</div></div>';
//                        $output .= 'has_mega_lvl: '.$this -> has_mega_lvl;
//                        $output .= 'item_mega_lvl: '.$this -> item_mega_lvl -> db_id;
//                        $this->has_mega_lvl = false;
//                    }

                }else{
                    parent::end_lvl($output, $depth, $args);
                }
            }

            /* End coding */



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

//                    if($depth == 0){
                if ($direction == 'full') {
                    $width = '100vw';
                }
                if ($direction == 'edge') {
                    $width = '100vw';
                }
//                    }

                $style = '';
                if ($width) {
                    $style .= 'width:' . $width . ';';
                }

                $output .= '<div class="' . $class_names . '"' . (!empty($style) ? ' style="' . $style . '"' : '') . '><div class="container">';
                $this -> has_mega_lvl   = true;
            }
        }

        protected function end_my_lvl(&$output, $item, $depth, $args){
            if(isset($this -> my_trees[$depth]) && isset($this -> my_trees[$depth])
                && $this -> my_trees[$depth] -> db_id == $item -> db_id){
//            if($this -> has_mega_lvl) {
//                if(!isset($item -> templaza_allow_el) || (isset($item -> templaza_allow_el) && !$item -> templaza_allow_el)) {
                    $output .= '</div></div>';
//                }
            }
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

            /* Coding */
            $_args  = (array) $args;

            $this -> has_layout = false;
            if(isset($_args['templaza_megamenu_html_data']) && !empty($_args['templaza_megamenu_html_data'])) {
                $this->has_layout = true;
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

            if($this -> has_layout) {
                $megamenu_data  = isset($_args['templaza-megamenu-html-data'])?$_args['templaza-megamenu-html-data']:array();
                if(isset($megamenu_data['data-megamenu-class'])) {
                    $has_mega_class = preg_replace('/^\./', '', $megamenu_data['data-megamenu-class']);
                }
            }

            if(is_array($classes)){
                if($this -> has_layout) {
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

            if($this -> has_layout || in_array('menu-item-has-children', $classes)) {
                $atts['class']  .= ' has-children';
            }

            $attributes = '';

            foreach ($atts as $attr => $value) {
                if (strlen($value)) {
                    $value = ('href' === $attr) ? esc_url($value) : esc_attr($value);
                    $attributes .= ' ' . $attr . '="' . $value . '"';
                }
            }

//            $attributes = $this -> get_link_attribute($item, $depth, $args);

            $item_output    = '';
            if ($item->type != $this->my_menu_type) {
                $item_output = $this->get_link_tag($item, $attributes, $args);
            }


            if($this->has_layout) {

                if ($item->type == $this->my_menu_type) {

                    if (isset($item->templaza_megamenu_html) && !empty($item->templaza_megamenu_html)) {
                        if (!preg_match('/(.*?)\[' . $this->menu_shorcode_tag . '.*?\]/im', $item->templaza_megamenu_html, $match)) {
                            if(isset($item -> templaza_allow_el) && $item -> templaza_allow_el) {
                                $output .= '<li data-position="' . $direction . '" class="' . $class . '" >';
                            }
                            $output .= $item->templaza_megamenu_html;
                        }

//                        if ($this->item_tmp->type == $this->my_menu_type) {
                            if (preg_match('/(.*?)[\n|\s]*?\[' . $this->menu_shorcode_tag . '.*?\]/im',
                                $item->templaza_megamenu_html, $match)) {
                                $output .= $match[1];
                            }
//                        }
                    }

                } else {
                    if ($depth > 0 && $item->type != $this->my_menu_type) {
                        $this->has_original_lvl = true;
                        $this->start_lvl($output, $depth, $args);
                        $this->has_original_lvl = false;
                    }
//                    if(isset($item -> templaza_allow_el) && $item -> templaza_allow_el) {
                        $output .= '<li data-position="' . $direction . '" class="' . $class . '" >';
//                    }
                }

//                $this -> start_my_lvl($output, $item, $depth, $args);

                $this->prev_depth = $depth;
                $this->item_tmp = $item;
            }
            else{
                $output .= '<li class="' . $class . '" >';
//                parent::start_el($output, $item, $depth, $args, $id);
            }
            $output .= apply_filters('templaza-framework/walker/megamenu/megamenu_walker_nav_menu_start_el',
                $item_output, $item, $depth, $args);
            /* End coding */
        }

        protected function get_link_tag($item, $attributes, $args = array()){

            $args   = (array) $args;
            $settings   = array();
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
                $icon = '<i class="' . $settings['icon'] . '"></i>';
            }

            $item_output = $args['before'];
            $item_output .= '<a' . $attributes . '>';

            if(!empty($icon)){
                $item_output    .= $icon;
            }

            if (isset($settings['hide_text']) && ((bool) $settings['hide_text']) == true) {
                /** This filter is documented in wp-includes/post-template.php */
            } else if (property_exists($item, 'templaza_megamenu_description') && strlen($item->templaza_megamenu_description)) {
                $item_output .= '<span class="megamenu-description-group">';
                $item_output .= '<span class="megamenu-title">';
                $item_output .= $args['link_before']. apply_filters('templaza-framework/walker/megamenu/megamenu_the_title',
                        $item->title, $item->ID) . $args['link_after'];
                $item_output .= '</span><span class="megamenu-description">'
                    . $item->description . '</span>';
                $item_output .= '</span>';
            } else {
                $item_output .= $args['link_before'].'<span class="megamenu-title">';
                $item_output .= apply_filters('templaza-framework/walker/megamenu/megamenu_the_title',
                    $item->title, $item->ID);
                $item_output .= '</span>' . $args['link_after'];
            }

            $options    = \TemPlazaFramework\Functions::get_theme_options();
            $show_arrow = isset($options['dropdown-arrow'])?(bool) $options['dropdown-arrow']:true;

            if ($this -> has_layout && $this -> has_children) {
                if($show_arrow) {
                    $arrow_icon = isset($settings['dropdown-arrow-icon'])?$settings['dropdown-arrow-icon']:'megamenu-indicator';
                    if($icon_position == 'right') {
                        $item_output .= '<span class="'.$arrow_icon.' order-3 megamenu-arrow"></span>';
                    }else {
                        $item_output .= '<span class="'.$arrow_icon.' megamenu-arrow"></span>';
                    }
                }
            }

            $item_output .= '</a>';
            $item_output .= $args['after'];
            return $item_output;
        }

        protected function get_link_attribute($item, $depth = 0, $args = array()){

            // Item Class
            $classes = empty($item->classes) ? array() : (array)$item->classes;

            $has_mega_class = 'has-megamenu';
            $_args  = (array) $args;

            if($this -> has_layout) {
                $megamenu_data  = isset($_args['templaza-megamenu-html-data'])?$_args['templaza-megamenu-html-data']:array();
                if(isset($megamenu_data['data-megamenu-class'])) {
                    $has_mega_class = preg_replace('/^\./', '', $megamenu_data['data-megamenu-class']);
                }
            }

            if(is_array($classes)){
                if($this -> has_layout) {
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

            if($this -> has_layout || in_array('menu-item-has-children', $classes)) {
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

            /* Coding */
            $_args  = (array) $args;

            if($this->has_layout) {
                $this->item_tmp = $item;
                if($item -> type != $this -> my_menu_type){

                    // Close tag of submenu
//                    if(isset($this -> my_trees[$depth]) && isset($this -> my_trees[$depth])
//                        && $this -> my_trees[$depth] -> db_id == $item -> db_id){
//                        $output .= '</div></div>';
                    $this -> end_my_lvl($output, $item, $depth, $args);
//                    }

                    parent::end_el($output, $item, $depth, $args);

                    if($depth > 0 && $item -> type != $this -> my_menu_type){
                        $this -> has_original_lvl    = true;
                        $this -> end_lvl($output, $depth, $args);
                        $this -> has_original_lvl    = false;

                    }
                }else{
                    if(isset($item -> templaza_allow_el) && $item -> templaza_allow_el) {
                        parent::end_el($output, $item, $depth, $args);
                    }else{
                        if (preg_match('/\[' . $this->menu_shorcode_tag . '.*?\][\n|\s]*?(.*?)$/ism',
                            $item->templaza_megamenu_html, $match)) {
                            $output .= $match[1];
                        }
                    }
                }
            }else{
                parent::end_el($output, $item, $depth, $args);
            }

            /* End coding */


        }

        public function walk( $elements, $max_depth, ...$args ) {
            $this ->elements    = $elements;
            $output = parent::walk($elements, $max_depth, ...$args);

            return $output;
        }

    }

}