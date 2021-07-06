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
        private $depth_tmp;
        private $has_layout = false;

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
            $indent = str_repeat("\t", $depth);

            if($this -> has_layout){
                $item   = $this -> item_tmp;
                if($item -> type != $this -> my_menu_type) {
                    $sub_class = array(
                        'sub-menu'
                    );

                    $mega_html_data = array();
                    if(property_exists($args, 'templaza_megamenu_html_data')){
                        $mega_html_data = $args -> templaza_megamenu_html_data;
                    }
                    $sub_class[]    = isset($mega_html_data['data-megamenu-content-class'])?preg_replace('/^\./',
                        '', $mega_html_data['data-megamenu-content-class']):'megamenu-sub-menu';
                    $sub_class      = apply_filters( 'nav_menu_submenu_css_class', $sub_class, $args, $depth );
                    $sub_class  = join(' ', apply_filters('templaza-framework/walker/megamenu/submenu_class',
                        $sub_class, $item, $args));

                    $settings   = array();
                    if (property_exists($item, 'templaza_megamenu_settings')) {
                        $settings = $item->templaza_megamenu_settings;
                    }
                    $direction  = isset($settings['submenu_direction'])?$settings['submenu_direction']:'full';
                    $width      = isset($settings['width']) && ($direction != 'full' && $direction != 'edge')?$settings['width']:'';

//                    if($depth == 0){
                        if ($direction == 'full') {
                            $width = '100vw';
                        }
                        if ($direction == 'edge') {
                            $width = '100vw';
                        }
//                    }

                    $style      = '';
                    if($width){
                        $style  .= 'width:'.$width.';';
                    }



                    $output .= '<div class="'.$sub_class.'"'.(!empty($style)?' style="'.$style.'"':'').'><div class="container">';
                }
            }
            else{
                $output .= parent::start_lvl($output, $depth, $args);
//                $output .= "\n$indent<ul class=\"sub-menu\">\n";
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
            $indent = str_repeat("\t", $depth);

            if($this -> has_layout){
                if($this -> item_tmp -> type != $this -> my_menu_type) {
                    $output .= '</div></div>';
                }
            }
            else{
                $output .= "$indent</ul>\n";
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

            // My bug
//                if($item -> )
//            var_dump($item); die(__METHOD__);

            $this -> item_tmp   = $item;

            $indent = ($depth) ? str_repeat("\t", $depth) : '';

            $settings   = array();
            if (property_exists($item, 'templaza_megamenu_settings')) {
                $settings = $item->templaza_megamenu_settings;
            }
//            else {
//                $settings = Mega_Menu_Nav_Menus::get_menu_item_defaults();
//            }

            $this -> has_layout = false;
            if(isset($item -> templaza_megamenu_layout) && !empty($item -> templaza_megamenu_layout)){
                $this -> has_layout = true;
            }

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

            $item_output = $_args['before'];
            $item_output .= '<a' . $attributes . '>';

            if(!empty($icon)){
                $item_output    .= $icon;
            }
            if (isset($settings['hide_text']) && ((bool) $settings['hide_text']) == true) {
                /** This filter is documented in wp-includes/post-template.php */
            } else if (property_exists($item, 'templaza_megamenu_description') && strlen($item->templaza_megamenu_description)) {
                $item_output .= '<span class="megamenu-description-group">';
                $item_output .= '<span class="megamenu-title">';
                $item_output .= $_args['link_before']. apply_filters('templaza-framework/walker/megamenu/megamenu_the_title',
                        $item->title, $item->ID) . $_args['link_after'];
                $item_output .= '</span><span class="megamenu-description">'
                    . $item->description . '</span>';
                $item_output .= '</span>';
            } else {
                $item_output .= $_args['link_before'].'<span class="megamenu-title">';
                $item_output .= apply_filters('templaza-framework/walker/megamenu/megamenu_the_title',
                        $item->title, $item->ID);
                $item_output .= '</span>' . $_args['link_after'];
            }

            $options    = \TemPlazaFramework\Functions::get_theme_options();
            $show_arrow = isset($options['dropdown-arrow'])?(bool) $options['dropdown-arrow']:true;
//            $show_arrow = isset($settings['hide_arrow'])?!(bool) $settings['hide_arrow']:$hide_arrow;

//            if (is_array($classes) && in_array('menu-item-has-children', $classes)) {
            if ($this -> has_layout) {
                if($show_arrow) {
                    $arrow_icon = isset($settings['dropdown-arrow-icon'])?$settings['dropdown-arrow-icon']:'megamenu-indicator';
                    if($icon_position == 'right') {
                        $item_output .= '<span class="'.$arrow_icon.' order-3 megamenu-arrow"></span>';
//                        $item_output .= '<span class="megamenu-indicator order-3"></span>';
                    }else {
//                        if($depth == 0){
//                            $item_output .= '<i class="fas fa-angle-down megamenu-arrow"></i>';
//                        }else{
//                            $item_output .= '<i class="fas fa-angle-right megamenu-arrow"></i>';
//                        }
                        $item_output .= '<span class="'.$arrow_icon.' megamenu-arrow"></span>';
//                        $item_output .= '<span class="megamenu-indicator"></span>';
                    }
                }
            }

            $item_output .= '</a>';
            $item_output .= $_args['after'];

            if($item -> type == $this -> my_menu_type){

                if(isset($item -> templaza_allow_el) && $item -> templaza_allow_el) {
                    $direction = isset($settings['submenu_direction']) ? $settings['submenu_direction'] : 'left';
                    $output .= '<li data-position="' . $direction . '" class="' . $class . '" >';
                }

                $item_shortcode = $item->templaza_megamenu_html;

                if(preg_match_all( '/(.*?)' . get_shortcode_regex(array($this -> menu_shorcode_tag)) . '/sm',
                    $item_shortcode, $matches2, PREG_SET_ORDER )) {
                    $matches2   = array_shift($matches2);
                    $output .= $matches2[1];

                }else{
                    $output .= $item_shortcode;
                }
                $item_output    = '';
            }
            else {
                if($item -> templaza_moved && $depth != $this -> depth_tmp) {
                    $output .= '<ul class="nav-submenu link-list">';
                }
//                id="'.$id.'"

                $direction  = isset($settings['submenu_direction'])?$settings['submenu_direction']:'left';
                $output .= '<li data-position="'.$direction.'" class="'.$class.'" >';
            }
            $this -> depth_tmp  = $depth;

            $output .= apply_filters('templaza-framework/walker/megamenu/megamenu_walker_nav_menu_start_el',
                $item_output, $item, $depth, $args);
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
            if($item -> type == $this -> my_menu_type){

                if(isset($item -> templaza_megamenu_html) && $item -> templaza_megamenu_html) {
                    $item_shortcode = $item->templaza_megamenu_html;
                    if(preg_match( '/'.$this -> menu_shorcode_tag.'\](.*)/im', $item_shortcode, $match )){
                        $output .= $match[1];
                    }
                }

                if(isset($item -> templaza_allow_el) && $item -> templaza_allow_el) {
                    $output .= "</li>"; // remove new line to remove the 4px gap between menu items
                }
            }
            else {
                $output .= "</li>"; // remove new line to remove the 4px gap between menu items
                if($item -> templaza_moved && $depth != $this -> depth_tmp) {
                    $output .= "</ul>";
                }
            }
        }

        public function display_element( $element, &$children_elements, $max_depth, $depth, $args, &$output ) {
            if($element -> type == $this -> my_menu_type){
                $depth  = 0;
            }
            parent::display_element($element, $children_elements, $max_depth, $depth, $args, $output);
        }
    }

}