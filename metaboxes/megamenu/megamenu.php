<?php

defined('TEMPLAZA_FRAMEWORK') or exit();

use TemPlazaFramework\Enqueue;
use TemPlazaFramework\Functions;

if(!class_exists('TemplazaFramework_MetaBox_MegaMenu')){

    class TemplazaFramework_MetaBox_MegaMenu extends TemplazaFramework_MetaBox{

        public $layout_fields = array();
        public $template_html = '';

        protected $redux;
        protected $opt_name;

        protected $loop_fields;

        public function __construct($post_type, &$framework = null)
        {
            global $pagenow;

//            $this -> opt_name                   = 'megamenu__layout';
            $this -> opt_name                   = 'megamenu__item';

            parent::__construct($post_type, $framework);

            $ignores    = array('templaza_style');
//            $post_type_name = $this -> post_type -> get_current_screen_post_type();
            $post_type_name = $this -> post_type -> get_post_type();

            if($pagenow == 'nav-menus.php'){

                $opt_name                           = $this -> opt_name ;
                $sections                           = $this -> layout_fields;

                $setting_args                       = $this -> post_type -> setting_args;
                $setting_args                       = $setting_args[$post_type_name];
                $redux_args                         = $setting_args;

                $redux_args['opt_name']             = $opt_name;
                $redux_args['menu_type']            = 'hidden';
                $redux_args['dev_mode']             = false;
                $redux_args['ajax_save']            = false;
                $redux_args['open_expanded']        = false;
                //            $redux_args['open_expanded']        = true;
                $redux_args['shortcode_section']    = false;
                $redux_args['show_import_export']   = false;


                \Redux::set_args($opt_name, $redux_args);
                \Redux::set_sections($opt_name, $sections);
                \Redux::init($opt_name);
                \Templaza_API::load_my_fields($opt_name);

                add_filter("redux/{$opt_name}/repeater", function($repeater_data) use($redux_args){
                    $repeater_data['opt_names'][]   = $redux_args['opt_name'];
                    return $repeater_data;
                });

                $redux  = \Redux::instance($opt_name );

                if(!($redux instanceof ReduxFramework)){
                    return;
                }

                // Set options
                $redux -> options   = array();
//                $redux ->_default_values();
//                $redux ->check_dependencies();
//                if(method_exists($redux, '_register_settings')) {
                if(\version_compare(\Redux_Core::$version, '4.3.7', '<=')) {
                    $redux->_register_settings();
                }else{
                    $redux -> options_class -> register();
                }
//                }

                // Generate redux html to field call hook or filter
                ob_start();
                $redux->generate_panel();
                ob_end_clean();

                $this -> redux  = $redux;

            }

        }

        /**
         * Returns the title of a given menu item ID
         *
         * @since 2.7.5
         * @param int $menu_item_id
         * @return int $menu_id
         */
        public function get_title_for_menu_item_id( $menu_item_id, $menu_item_objects ) {
            foreach( $menu_item_objects as $key => $item ) {
                if ( $item->ID == $menu_item_id ) {
                    return $item->title;
                }
            }

            return false;
        }

        public function register(){

//            $locations              = get_nav_menu_locations();
//            $theme_locations        = get_registered_nav_menus();
            $menu_id                = $this -> get_selected_menu_id();
            $tagged_menu_locations  = $this -> get_tagged_theme_locations_for_menu_id($menu_id);

            $this -> loop_fields = $mloopFields    = array(
                array(
                    'id'    => 'enabled',
                    'type'  => 'switch',
                    'title' => esc_html__('Enable', $this -> text_domain),
                    'default' => 0,
                ),
            );

            $metaboxes  = array();

//            $metaboxes[] = array(
//                'id'            => 'tz_megamenu-main',
//                'title'         => __( 'TZ Mengamenu Options', $this -> text_domain ),
//                'post_types'    => 'nav-menus',
//                'position'      => 'side', // normal, advanced, side
//                'priority'      => 'high', // high, core, default, low - Priorities of placement
//                'store_each'    => true, // Store value of each fields to each post meta
//                'sections'      => array(
//                    array(
//                        'id'    => uniqid(),
//                        'title' => '',
//                        'fields' => array(
//                            array(
//                                'id'           => 'tz_megamenu_meta',
//                                'type'         => 'tz_loop',
//                                'title'        => 'Main Options',
////                                'title'        => '',
//                                'group_fields' => $tagged_menu_locations,
//                                'fields'       => $mloopFields,
//                            ),
//                        ),
//                    ),
//                ),
//            );

            $this -> layout_fields  = array(
                array(
                    'id'     => 'megamenu-layout-section',
                    'icon'   => 'dashicons dashicons-welcome-widgets-menus',
//                    'title'  => esc_html__('Mega Menu', $this -> text_domain),
                    'fields' => array(
                        array(
                            'id'       => 'icon',
                            'type'     => 'select',
                            'title'    => __( 'Icon Select', $this -> text_domain ),
                            'subtitle' => __( 'Select an icon for your menu item.', $this -> text_domain ),
                            'data'     => 'fontawesome',
//                            'default'  => 'fas fa-arrow-up',
//                            'required' => array('backtotop','=','1'),
                        ),
                        array(
                            'id'       => 'hide_text',
                            'type'     => 'switch',
                            'title'    => __( 'Icon/Thumbnail Only', $this -> text_domain ),
                            'subtitle' => __( 'Select an icon for your menu item.', $this -> text_domain ),
                        ),
                        array(
                            'id'       => 'highlight_text',
                            'type'     => 'text',
                            'title'    => __( 'Menu Highlight Label', $this -> text_domain ),
                            'subtitle' => __( 'Set the highlight label for menu item.', $this -> text_domain ),
                            'required' => array('hide_text', '!=', true),
                        ),
                        array(
                            'id'          => 'highlight_text_bg_color',
                            'type'        => 'color',
                            'title'       => __( 'Menu Highlight Label Background Color', $this -> text_domain ),
                            'subtitle'    => __( 'Set the highlight label background color.', $this -> text_domain ),
                            'transparent' => false,
                            'required'    => array('hide_text', '!=', true),
                        ),
                        array(
                            'id'          => 'highlight_text_color',
                            'type'        => 'color',
                            'title'       => __( 'Menu Highlight Label Text Color', $this -> text_domain ),
                            'subtitle'    => __( 'Set the highlight label text color.', $this -> text_domain ),
                            'transparent' => false,
                            'required'    => array('hide_text', '!=', true),
                        ),
                        array(
                            'id'          => 'background',
                            'type'        => 'background',
                            'title'       => __( 'Mega Menu / Flyout Menu Background Image', $this -> text_domain ),
                            'subtitle'    => __( 'Select an image for the mega menu or flyout menu background.\nMega Menu: In case of mega menu, if left empty, the Main Menu Dropdown Background Color will be used. Each mega menu column can have its own background image, or you can have one image that spreads across the entire mega menu width.
Flyout Menu: When used in the flyout menu, the image will be shown full screen when hovering the corresponding menu item.', $this -> text_domain ),
                            'transparent' => false,
                            'background-color'  => false,
//                            'required'    => array('hide_text', 'not', '1'),
                        ),
                        array(
                            'id'    => 'megamenu_enable',
                            'type'  => 'switch',
                            'title' => esc_html__('Enable', $this -> text_domain)
                        ),
                        array(
                            'id'      => 'submenu_direction',
                            'type'    => 'select',
                            'title'   => __('Sub Menu Alignment', $this -> text_domain),
                            'options' => array(
                                'left'   => esc_html__('Left', $this -> text_domain),
                                'right'  => esc_html__('Right', $this -> text_domain),
                                'center' => esc_html__('Center', $this -> text_domain),
                                'full'   => esc_html__('Container', $this -> text_domain),
                                'edge'   => esc_html__('Full', $this -> text_domain),
                            ),
                            'default' => 'left',
                            'required'  => array('megamenu_enable', '=', true),
                        ),
                        array(
                            'id'        => 'width',
                            'type'      => 'text',
                            'title'     => __('Sub Menu Width', $this -> text_domain),
                            'subtitle'  => __('Controls the max width of the mega menu. In pixels.', $this -> text_domain),
//                            'placeholder' => '980px',
                            'required' => array(
                                array('submenu_direction', '!=', 'full'),
                                array('submenu_direction', '!=', 'edge')
                            ),
                        ),
                        array(
                            'id'            => 'megamenu_layout',
                            'type'          => 'tz_layout',
                            'allow_copy'    => false,
                            'one_row'       => true,
                            'class'         => 'field-tz_layout-content',
                            'default'       => false,
                            'required'      => array('megamenu_enable', '=', true),
                        ),

                    ),
                ),
//                array(
//                    'id'     => 'megamenu-settings-section',
//                    'title'  => esc_html__('Settings', $this -> text_domain),
//                    'fields' => array(
//                        array(
//                            'id'    => 'hide_text',
//                            'type'  => 'switch',
//                            'title' => esc_html__('Hide Text', $this -> text_domain)
//                        ),
////                        array(
////                            'id'    => 'hide_arrow',
////                            'type'  => 'switch',
////                            'title' => esc_html__('Hide Arrow', $this -> text_domain)
////                        ),
//                        array(
//                            'id'    => 'disable_link',
//                            'type'  => 'switch',
//                            'title' => esc_html__('Disable Link', $this -> text_domain)
//                        ),
//                        array(
//                            'id'    => 'hide_on_mobile',
//                            'type'  => 'switch',
//                            'title' => esc_html__('Hide Item on Mobile', $this -> text_domain)
//                        ),
//                        array(
//                            'id'    => 'hide_on_desktop',
//                            'type'  => 'switch',
//                            'title' => esc_html__('Hide Item on Desktop', $this -> text_domain)
//                        ),
//                        array(
//                            'id'    => 'item_align',
//                            'type'  => 'select',
//                            'title' => esc_html__('Menu Item Align', $this -> text_domain),
//                            'options' => array(
//                                'float-left' => esc_html__('Left', $this -> text_domain),
//                                'left'       => esc_html__('Default', $this -> text_domain),
//                                'right'      => esc_html__('Right', $this -> text_domain),
//                            ),
//                            'default' => 'left'
//                        ),
//                    ),
//                ),
//                array(
//                    'id'         =>'megamenu-submenu-setting-section',
//                    'title'      => __('Sub Menu Settings', $this -> text_domain),
//                    'desc'       => __('Configure Submenu settings.', $this -> text_domain),
//                    'subsection' => true,
//                    'fields'     => array(
//                        array(
//                            'id'      => 'submenu_direction',
//                            'type'    => 'select',
//                            'title'   => __('Sub Menu Alignment', $this -> text_domain),
//                            'options' => array(
//                                'left'   => esc_html__('Left', $this -> text_domain),
//                                'right'  => esc_html__('Right', $this -> text_domain),
//                                'center' => esc_html__('Center', $this -> text_domain),
//                                'full'   => esc_html__('Container', $this -> text_domain),
//                                'edge'   => esc_html__('Full', $this -> text_domain),
//                            ),
//                            'default' => 'left'
//                        ),
//                        array(
//                            'id'    => 'width',
//                            'type'  => 'text',
//                            'title' => __('Sub Menu Width', $this -> text_domain),
//                            'placeholder' => '980px',
//                            'required' => array(
//                                array('submenu_direction', '!=', 'full'),
//                                array('submenu_direction', '!=', 'edge')
//                            )
//                        ),
////                        array(
////                            'id'    => 'align',
////                            'type'  => 'select',
////                            'title' => __('Sub Menu Align', $this -> text_domain),
////                            'options' => array(
////                                'bottom-left'  => esc_html__('Left edge of Parent', $this -> text_domain),
////                                'bottom-right'   => esc_html__('Right edge of Parent', $this -> text_domain),
////                            ),
////                            'default' => 'bottom-left'
////                        ),
//                        array(
//                            'id'    => 'hide_sub_menu_on_mobile',
//                            'type'  => 'switch',
//                            'title' => __('Hide Sub Menu on Mobile', $this -> text_domain),
//                        ),
//                    ),
//                ),
//                array(
//                    'id'         => 'megamenu-icon-section',
////                    'icon'       => 'dashicons dashicons-format-image',
//                    'title'      => esc_html__('Icon', $this -> text_domain),
//                    'subsection' => true,
//                    'fields'     => array(
//                        array(
//                            'id'    => 'icon_position',
//                            'type'  => 'select',
//                            'title' => esc_html__('Icon Position', $this -> text_domain),
//                            'options' => array(
//                                'left'   => esc_html__('Left', $this -> text_domain),
//                                'top'    => esc_html__('Top', $this -> text_domain),
//                                'right'  => esc_html__('Right', $this -> text_domain),
//                                'bottom' => esc_html__('Bottom', $this -> text_domain),
//                            ),
//                            'default' => 'left'
//                        ),
//                        array(
//                            'id'       => 'icon',
//                            'type'     => 'select',
//                            'title'    => __( 'Menu Item Icon', $this -> text_domain ),
////                            'subtitle' => __( 'Select a Back to Top Icon from the list', $this -> text_domain ),
//                            'data'     => 'fontawesome',
////                            'default'  => 'fas fa-arrow-up',
////                            'required' => array('backtotop','=','1'),
//                        ),
//                        array(
//                            'id'         => 'dropdown-arrow-icon',
//                            'type'       => 'select',
//                            'title'      => __('Dropdown Arrow Icon', $this -> text_domain),
//                            'data'       => 'fontawesome',
////                            'data'       => 'icons',
////                            'data-icons' => array(
////                                'fas fa-arrow-down',
////                                'fas fa-arrow-circle-down',
////                                'fas fa-arrow-alt-circle-down',
////                                'fas fa-sort-down',
////                                'fas fa-chevron-down',
////                                'fas chevron-circle-down',
////                                'fas fa-caret-square-down',
////                                'far fa-caret-square-down',
////                                'fas fa-caret-down',
////                                'fas fa-angle-down',
////                                'fas fa-angle-double-down',
////                            ),
//                        ),
//
//                    ),
//                ),
            );

            return $metaboxes;
        }

        public function hooks(){
            global $pagenow;

//            parent::hooks();

            if(is_admin()){
                if($pagenow == 'nav-menus.php') {
                    add_filter( 'hidden_meta_boxes', array($this, 'remove_hidden_meta_boxes'), 10, 2 );
                    add_filter( 'templaza-framework/field/tz_layout/elements', array($this, 'prepare_layout_elements'), 10, 2 );

                    add_action('admin_init', array($this, 'add_meta_boxes'), 10, 2);
                    add_action('admin_footer', array($this, 'megamenu_enqueue'));
                    add_action('admin_footer', array($this, 'template'));

                }
                add_action('wp_ajax_templaza_megamenu_save_settings', array($this, 'save_settings'));
                add_action( 'pre_update_option_nav_menu_options', array( $this, 'update_nav_menu' ), 10, 3 );


                add_action('wp_nav_menu_item_custom_fields', array($this, 'megamenu_button'));


                add_filter( 'redux/'.$this -> opt_name .'/panel/template/header.tpl.php' , function($path){
                    return TEMPLAZA_FRAMEWORK_METABOXES_PATH.'/'.$this -> get_meta_box_name().'/tmpl/redux-panel/header.tpl.php';
                });
                add_filter( 'redux/'.$this -> opt_name .'/panel/template/footer.tpl.php' , function($path){
                    return TEMPLAZA_FRAMEWORK_METABOXES_PATH.'/'.$this -> get_meta_box_name().'/tmpl/redux-panel/footer.tpl.php';
                });

                add_filter( 'redux/'.$this -> opt_name .'/panel/template/header-stickybar.tpl.php' , function($path){
                    return TEMPLAZA_FRAMEWORK_METABOXES_PATH.'/'.$this -> get_meta_box_name().'/tmpl/redux-panel/header-stickybar.tpl.php';
                });
                add_filter( 'redux/'.$this -> opt_name .'/panel/template/menu-container.tpl.php' , function($path){
                    return TEMPLAZA_FRAMEWORK_METABOXES_PATH.'/'.$this -> get_meta_box_name().'/tmpl/redux-panel/menu-container.tpl.php';
                });
            }else {
                add_filter('wp_nav_menu_args', array($this, 'modify_nav_menu_args'), 99999);
                add_filter('wp_nav_menu_objects', array($this, 'setup_menu_items'), 99999, 2);
                add_filter( 'wp_nav_menu_objects', array( $this, 'add_widgets_to_menu' ), 99999, 2 );
                add_filter( 'templaza-framework/metabox/megamenu/nav_menu_objects_after', array( $this, 'set_descriptions_if_enabled' ), 8, 2 );
            }

            do_action('templaza-framework/metabox/'.$this -> get_meta_box_name().'/hooks');
        }

        public function megamenu_button() {
            echo '<p><button type="button" class="button button-primary tz_mm_launch"><i class="fas fa-box-open"></i> '.
                __('Menu Options', $this -> text_domain).'</button></p>';
        }

        public function prepare_layout_elements($elements){

            // Remove content area element
            $find   = trailingslashit(TEMPLAZA_FRAMEWORK_SHORTCODES_PATH.'/content_area');

            if(in_array($find, $elements)){
                $index  = array_search($find, $elements);
                if($index != false){
                    unset($elements[$index]);
                }
            }

            return $elements;
        }

        public function remove_hidden_meta_boxes($hidden, $screen ){
            if($screen -> base == 'nav-menus'){
                $index  = array_search($this -> prefix.'tz_megamenu-main', $hidden);
                array_splice($hidden, $index, 1);
            }
            return $hidden;
        }

        public function modify_nav_menu_args($args){

            if ( ! isset( $args['theme_location'] ) ) {
                return $args;
            }

            // internal action to use as a counter
            do_action('templaza-framework/metabox/'.$this -> get_meta_box_name()
                .'/megamenu_instance_counter_' . $args['theme_location']);

//            $num_times_called = did_action('templaza-framework/metabox/'.$this -> get_meta_box_name()
//                .'/megamenu_instance_counter_' . $args['theme_location']);
//
//            $meta_options = get_option( 'templaza_megamenu_settings' );
//            $current_theme_location = $args['theme_location'];
//
//            $settings  = isset($meta_options['tz_megamenu_meta'])?json_decode($meta_options['tz_megamenu_meta'], true):array();
//
//            $active_instance = isset( $settings['instances'][$current_theme_location] ) ? $settings['instances'][$current_theme_location] : 0;
//
//            if ( $active_instance != '0' && strlen( $active_instance ) ) {
//
//                if ( strpos( $active_instance, "," ) || is_numeric( $active_instance ) ) {
//
//                    $active_instances = explode( ",", $active_instance );
//
//                    if ( ! in_array( $num_times_called, $active_instances )) {
//                        return $args;
//                    }
//
//                } else if ( isset( $args['container_id'] ) && $active_instance != $args['container_id'] ) {
//
//                    return $args;
//
//                }
//            }
//
//            $locations = get_nav_menu_locations();
//
//            if ( isset ( $settings[ $current_theme_location ]['enabled'] ) && $settings[ $current_theme_location ]['enabled'] == true ) {
//
//                $args['templaza_megamenu_enable']   = $settings[ $current_theme_location ]['enabled'];
//
//                if ( ! isset( $locations[ $current_theme_location ] ) ) {
//                    return $args;
//                }
//
//                $menu_id = $locations[ $current_theme_location ];
//
//                if ( ! $menu_id ) {
//                    return $args;
//                }
//
//                $menu_settings = $settings[ $current_theme_location ];
//
//                $effect = isset( $menu_settings['effect'] ) ? $menu_settings['effect'] : 'disabled';
//
//                // convert Pro JS based effect to CSS3 effect
//                if ( $effect == 'fadeUp' ) {
//                    $effect = 'fade_up';
//                }
//
//                // as set on the main settings page
//                $vertical_behaviour = isset( $settings['mobile_behaviour'] ) ? $settings['mobile_behaviour'] : 'standard';
//
//                if ( isset( $menu_settings['mobile_behaviour'] ) ) {
//                    $vertical_behaviour = $menu_settings['mobile_behaviour'];
//                }
//
//                // as set on the main settings page
//                $second_click = isset( $settings['second_click'] ) ? $settings['second_click'] : 'go';
//
//                if ( isset( $menu_settings['second_click'] ) ) {
//                    $second_click = $menu_settings['second_click'];
//                }
//
//                $unbind = isset( $settings['unbind'] ) ? $settings['unbind'] : 'enabled';
//
//                if ( isset( $menu_settings['unbind'] ) ) {
//                    $unbind = $menu_settings['unbind'];
//                }
//
//                $event = 'hover_intent';
//
//                if ( isset( $menu_settings['event'] ) ) {
//                    if ( $menu_settings['event'] == 'hover' ) {
//                        $event = 'hover_intent';
//                    } elseif ( $menu_settings['event'] == 'hover_' ) {
//                        $event = 'hover';
//                    } else {
//                        $event = $menu_settings['event'];
//                    }
//                }
//
//                $mobile_force_width = 'false';
//
//
//                $effect_mobile = 'disabled';
//
//                if ( isset( $menu_settings['effect_mobile'] ) ) {
//                    $effect_mobile = $menu_settings['effect_mobile'];
//                }
//
//                $effect_speed_mobile = 200;
//
//                if ( isset( $menu_settings['effect_speed_mobile'] ) ) {
//                    $effect_speed_mobile = $menu_settings['effect_speed_mobile'];
//                }
//
//                if ( $effect_mobile == 'disabled' ) {
//                    $effect_speed_mobile = 0;
//                }
//
//                $hover_intent_params = apply_filters('templaza-framework/metabox/'.$this -> get_meta_box_name()
//                    .'/megamenu_javascript_localisation', // backwards compatiblity
//                    array(
//                        "timeout" => 300,
//                        "interval" => 100
//                    )
//                );
//
//                $wrap_attributes = apply_filters('templaza-framework/metabox/'.$this -> get_meta_box_name()
//                    .'/megamenu_wrap_attributes', array(
//                    "id" => '%1$s',
//                    "class" => '%2$s wsmenu-list',
//                ), $menu_id, $menu_settings, $settings, $current_theme_location );
//
//                $attributes = "";
//
//                foreach( $wrap_attributes as $attribute => $value ) {
//                    if ( strlen( $value ) ) {
//                        $attributes .= " " . $attribute . '="' . esc_attr( $value ) . '"';
//                    }
//                }
//
//                $sanitized_location = str_replace( apply_filters('templaza-framework/metabox/'.$this -> get_meta_box_name()
//                    .'/megamenu_location_replacements', array("-", " ") ), "-", $current_theme_location );
//
//            }

            $walker_file    = TEMPLAZA_FRAMEWORK_METABOXES_PATH.'/'.$this -> get_meta_box_name().'/classes/walker.class.php';

            if(file_exists($walker_file)) {
                require_once $walker_file;
            }

            $defaults = array(
                'walker' => new TemplazaFramework_Mega_Menu_Walker()
            );

            $args = array_merge( $args, apply_filters( 'templaza-framework/metabox/'.$this -> get_meta_box_name()
                .'/megamenu_nav_menu_args', $defaults, $args['theme_location'] ) );

            return $args;
        }

        public function add_widgets_to_menu($items, $args ){

            /* Checking */
            $args   = (array) $args;

            // If not header
            if(!isset($args['templaza_megamenu_html_data']) || (isset($args['templaza_megamenu_html_data'])
                    && !$args['templaza_megamenu_html_data'])){
                return $items;
            }

            $rolling_dummy_id = 999999999;
            $items_to_move  = array();

            $items      = apply_filters( "templaza-framework/metabox/megamenu/nav_menu_objects_before", $items, $args );

            $items      = array_values($items);
            $new_items  = $items;
            $next_order = $items[0] -> menu_order;

            foreach($items as $i => $item) {
                $new_items[$i] -> menu_order    = $next_order;
                if(isset($item -> templaza_megamenu_saved_layout) && $item -> templaza_megamenu_saved_layout){
                    $saved_layout   = $item -> templaza_megamenu_saved_layout;
                    $this -> tree_element($saved_layout, $item, $new_items, $rolling_dummy_id,
                        $next_order, $items_to_move);
                }
                else{
                    $next_order++;
                }

            }

            $items  = $new_items;

            if ( count( $items_to_move ) ) {
                foreach ( $items_to_move as $id => $new_parent ) {
                    $items_to_find[] = $id;
                }

                foreach ( $items as $index => $item ) {
                    if ( in_array( $item->ID, $items_to_find, true ) ) {
                        $item->menu_item_parent = $items_to_move[ $item->ID ]['new_parent'];
                        $item->menu_order       = $items_to_move[ $item->ID ]['new_order'];
                        $item -> templaza_moved  = true;
                    }
                }
            }

            $count  = count($items);
            for ($i = 0; $i < $count - 1; $i++)
            {
                for ($j = $i + 1; $j < $count; $j++){
                    if ($items[$i] -> menu_order >= $items[$j] -> menu_order){
                        $tmp          = $items[$i];
                        $items[$i]    = $items[$j];
                        $items[$j]    = $tmp;
                    }
                }
            }

            $items = apply_filters( "templaza-framework/metabox/megamenu/nav_menu_objects_after", $items, $args );

//            var_dump(wp_list_pluck($items, 'title')); die();
            return $items;
        }

        private function tree_element($elements, $item, &$items, &$rolling_dummy_id, &$next_order,
                                      &$items_to_move = array(), &$count = 0, $depth = 0, &$level = 0,
                                      &$shortcode_tmp = array()){
            foreach($elements as $element){

                $rolling_dummy_id++;
                $next_order++;
                $subitems       = is_array($element) && isset($element['elements']) && !empty($element['elements']);

                $layout = $element;
                if($subitems){
                    $layout['elements'] = array(array('type'=> '__megamenu_item'));
                }
                $shortcode_layout = $shortcode  = Functions::generate_option_to_shortcode(array($layout));

                while(preg_match_all('/' . get_shortcode_regex() . '/', $shortcode, $matches, PREG_SET_ORDER)){
                    $shortcode = do_shortcode($shortcode);
                }

                $menu_item_parent   = $item->ID;
                if(isset($shortcode_tmp['__level']) && $level > $shortcode_tmp['__level']){
                    $menu_item_parent   = $shortcode_tmp['__id'];
                }

                if(isset($shortcode_tmp['__tree']) && isset($shortcode_tmp['__tree'][$level - 1])){
                    $menu_item_parent   = $shortcode_tmp['__tree'][$level - 1];
                }

                $layout_item = array(
                    'menu_item_parent' => $menu_item_parent,
                    'type' => '__templaza_mega_item',
                    'title' => $element['type'],
                    'parent_submenu_type' => '',
                    'menu_order' => $next_order,
                    'depth' => $depth,
//                    'depth' => 0,
                    'ID' => "{$item->ID}-{$count}",
                    'templaza_shortcode_type' => $element['type'],
                    'templaza_megamenu_html'  => $shortcode,
                    'templaza_megamenu_layout'  => $shortcode_layout,
                    'db_id' => $rolling_dummy_id,
                );

                if($element['type'] != 'megamenu_menu_item') {
                    $items[] = (object)$layout_item;
                }

                if($element['type'] == 'megamenu_menu_item'){
                    $layout_item['title']   = $element['admin_label'];
                    $items_to_move[$element['menu_id']] = array(
                        'new_parent' => $menu_item_parent,
                        'new_order'  => $next_order,
                    );

                }

                if(!isset($shortcode_tmp['__tree'])){
                    $shortcode_tmp['__tree']   = array();
                }
                $shortcode_tmp['__tree'][$level]   = $rolling_dummy_id;

                $shortcode_tmp['__id']  = $rolling_dummy_id;
                $shortcode_tmp['__level']  = $level;
                $element['__level'] = $level;

                $count++;
                if($subitems){
                    $level++;
                    $this -> tree_element($element['elements'], $item, $items, $rolling_dummy_id,
                        $next_order, $items_to_move, $count, $depth, $level,$shortcode_tmp);
                }
                if(isset($shortcode_tmp['type']) && $element['type'] != $shortcode_tmp['type']){
                    $level  = $element['__level'];
                }
                $shortcode_tmp['type']  = $element['type'];

                if($level == 0){
                    $shortcode_tmp['__tree']    = array();
                }
            }
        }


        /**
         * If descriptions are enabled, create a new 'mega_description' property.
         * This is for backwards compatibility for users who have used filters
         * to display descriptions
         *
         * @param array $items
         * @param array $args
         * @return array
         */
        public function set_descriptions_if_enabled( $items, $args ) {

//            $settings = get_option( 'templaza_megamenu_settings' );

//            $descriptions = isset( $settings['descriptions'] ) ? $settings['descriptions'] : 'disabled';

//            if ($descriptions == 'enabled') {
            foreach ( $items as $item ) {
                if (  property_exists( $item, 'description' ) && strlen( $item->description )  ) {
                    $item->templaza_megamenu_description = $item->description;
                    $item->classes[] = 'has-description';
                }
            }
//            }

            return $items;
        }

        private function menu_order_of_next_sibling( $item_id, $menu_item_parent, $items ) {

            $get_order_of_next_item = false;

            foreach ( $items as $key => $item ) {

                if ( $menu_item_parent !== $item->menu_item_parent ) {
                    continue;
                }

//                if ( 'widget' === $item->type ) {
//                    continue;
//                }
                if ( '__templaza_mega_item' === $item->type ) {
                    continue;
                }

                if ( $get_order_of_next_item ) {
                    return $item->menu_order;
                }

                if ( $item->ID === $item_id ) {
                    $get_order_of_next_item = true;
                }

                if ( isset( $item->menu_order ) ) {
                    $rolling_last_menu_order = $item->menu_order;
                }
            }

            // there isn't a next sibling.
            return $rolling_last_menu_order + 1000;

        }


        /**
         * Return the locations that a specific menu ID has been tagged to.
         *
         * @param $menu_id int
         * @return array
         */
        public function get_tagged_theme_locations_for_menu_id( $menu_id ) {

            $locations = array();

            $nav_menu_locations = get_nav_menu_locations();

            foreach ( get_registered_nav_menus() as $id => $name ) {

                if ( isset( $nav_menu_locations[ $id ] ) && $nav_menu_locations[$id] == $menu_id )
                    $locations[$id] = $name;

            }

            return $locations;
        }
        /**
         * Get the current menu ID.
         *
         * Most of this taken from wp-admin/nav-menus.php (no built in functions to do this)
         *
         * @since 1.0
         * @return int
         */
        public function get_selected_menu_id() {

            $nav_menus = wp_get_nav_menus( array('orderby' => 'name') );

            $menu_count = count( $nav_menus );

            $nav_menu_selected_id = isset( $_REQUEST['menu'] ) ? (int) $_REQUEST['menu'] : 0;

            $add_new_screen = ( isset( $_GET['menu'] ) && 0 == $_GET['menu'] ) ? true : false;

            // If we have one theme location, and zero menus, we take them right into editing their first menu
            $page_count = wp_count_posts( 'page' );
            $one_theme_location_no_menus = ( 1 == count( get_registered_nav_menus() ) && ! $add_new_screen && empty( $nav_menus ) && ! empty( $page_count->publish ) ) ? true : false;

            // Get recently edited nav menu
            $recently_edited = absint( get_user_option( 'nav_menu_recently_edited' ) );
            if ( empty( $recently_edited ) && is_nav_menu( $nav_menu_selected_id ) )
                $recently_edited = $nav_menu_selected_id;

            // Use $recently_edited if none are selected
            if ( empty( $nav_menu_selected_id ) && ! isset( $_GET['menu'] ) && is_nav_menu( $recently_edited ) )
                $nav_menu_selected_id = $recently_edited;

            // On deletion of menu, if another menu exists, show it
            if ( ! $add_new_screen && 0 < $menu_count && isset( $_GET['action'] ) && 'delete' == $_GET['action'] )
                $nav_menu_selected_id = $nav_menus[0]->term_id;

            // Set $nav_menu_selected_id to 0 if no menus
            if ( $one_theme_location_no_menus ) {
                $nav_menu_selected_id = 0;
            } elseif ( empty( $nav_menu_selected_id ) && ! empty( $nav_menus ) && ! $add_new_screen ) {
                // if we have no selection yet, and we have menus, set to the first one in the list
                $nav_menu_selected_id = $nav_menus[0]->term_id;
            }

            return $nav_menu_selected_id;

        }

        /**
         * Setup the mega menu settings for each menu item
         *
         * @param array $items - All menu item objects
         * @param object $args
         * @return array
         */
        public function setup_menu_items($items, $args){
            $_args  = (array) $args;
            if ( ! isset( $_args['theme_location'] ) ) {
                return $items;
            }

            if(count($items)){

                $meta_options = get_option( 'templaza_megamenu_settings' );
                $current_theme_location = $_args['theme_location'];

                $settings  = isset($meta_options['tz_megamenu_meta'])?json_decode($meta_options['tz_megamenu_meta'], true):array();
//                if (!isset($settings[$current_theme_location]) ||
//                    (isset ( $settings[ $current_theme_location ]['enabled'] ) && (bool) $settings[ $current_theme_location ]['enabled'] == false) ) {
//                    return $items;
//                }

                // Hook to change menu id to menu slug of megamenu menu item element
                add_filter('templaza-framework/metabox/'.$this -> get_meta_box_name()
                    .'/element/each', function($element){
                    return $this -> change_to_menu_id($element);
                }, 10);

                foreach ( $items as $item ) {
                    $saved_settings = array_filter( (array) get_post_meta( $item->ID, '_templaza_megamenu_settings', true ) );
                    $item->templaza_megamenu_settings = $saved_settings;

//                    var_dump($item); die();
                    $megamenu_enable    = isset($saved_settings['megamenu_enable'])?filter_var($saved_settings['megamenu_enable'], FILTER_VALIDATE_BOOLEAN):false;

//                    if (isset ( $settings[ $current_theme_location ]['enabled'] ) && ((bool) $settings[ $current_theme_location ]['enabled']) == true ) {
                    if ($megamenu_enable) {
                        $saved_layout = array_filter((array)get_post_meta($item->ID, '_templaza_megamenu_layout', true));

                        $this -> tree_element_main($saved_layout);

                        $shortcode = Functions::generate_option_to_shortcode($saved_layout);

                        $item->templaza_megamenu_layout = $shortcode;
                        $item->templaza_megamenu_saved_layout = $saved_layout;
                    }
                }
            }

            return $items;
        }

        public function change_to_menu_id($element){
            if($element && $element['type'] == 'megamenu_menu_item' && isset($element['menu_slug'])){
                $menu   = get_posts(array(
                    'name'      => $element['menu_slug'],
                    'post_type' => 'nav_menu_item',
                    'numberposts' => 1
                ));

                if(count($menu) && $menu[0] -> post_name == $element['menu_slug']){
                    $element['menu_id'] = $menu[0] -> ID;
                    unset($element['menu_slug']);
                }
            }
            return $element;
        }

        public function change_to_menu_slug($element){
            if($element && isset($element['type']) &&
                $element['type'] == 'megamenu_menu_item' && isset($element['menu_id'])){
                $menu   = get_post($element['menu_id']);
                if($menu && $menu -> ID == $element['menu_id']) {
                    $element['menu_slug'] = $menu -> post_name;
                    unset($element['menu_id']);
                }
            }
            return $element;
        }

        public function update_nav_menu($value, $old_value, $option){
            $megamenu   = isset($_POST['_templaza_megamenu_layout'])?sanitize_text_field($_POST['_templaza_megamenu_layout']):false;

            $megamenu_settings = isset($_POST['_templaza_megamenu_settings'])?sanitize_text_field($_POST['_templaza_megamenu_settings']):false;

            if(!$megamenu && !$megamenu_settings){
                return;
            }

            $megamenu   = str_replace('\\', '', $megamenu);
            $megamenu_settings   = str_replace('\\', '', $megamenu_settings);

            $megamenu   = json_decode($megamenu, true);
            $megamenu_settings   = json_decode($megamenu_settings, true);

            if(!empty($megamenu) && is_array($megamenu) && count($megamenu)){

                // Hook to change menu id to menu slug of megamenu menu item element
                add_filter('templaza-framework/metabox/'.$this -> get_meta_box_name()
                    .'/element/each', function($element){
                    return $this -> change_to_menu_slug($element);
                }, 10);

                foreach ($megamenu as $menu_id => &$layout){
                    $this -> tree_element_main($layout);
                    update_post_meta($menu_id, '_templaza_megamenu_layout', $layout);
                }
            }

            if(!empty($megamenu_settings) && is_array($megamenu_settings) && count($megamenu_settings)){
                foreach ($megamenu_settings as $_menu_id => $setting){
                    update_post_meta($_menu_id, '_templaza_megamenu_settings', $setting);
                }
            }

        }

        public function tree_element_main(&$elements, $new_option = array()){
            if(!$elements){
                return;
            }
            do_action('templaza-framework/metabox/'.$this -> get_meta_box_name()
                .'/element/before', $elements);
            foreach ($elements as &$element){

//                $continue   = false;
//                if($element['type'] != 'megamenu_menu_item'){
//                    $continue   = true;
//                }
//
//
//                $continue   = apply_filters('templaza-framework/metabox/'.$this -> get_meta_box_name()
//                    .'/element/each/continue', $continue, $element, $elements);
                $subitems   = is_array($element) && isset($element['elements']) && !empty($element['elements']);

//                if($continue){
//                    continue;
//                }


//                if($element['type'] == 'megamenu_menu_item'){
//                    $menu   = get_post($element['menu_id']);
//                    if($menu) {
//                        $element['menu_slug'] = $menu -> post_name;
//                        unset($element['menu_id']);
//                    }
//                }


                $element = apply_filters('templaza-framework/metabox/'.$this -> get_meta_box_name()
                    .'/element/each', $element, $elements);

                if($subitems){
                    do_action('templaza-framework/metabox/'.$this -> get_meta_box_name()
                        .'/element/each/child/before', $element, $elements);
                    $this -> tree_element_main($element['elements'], $new_option);
                    do_action('templaza-framework/metabox/'.$this -> get_meta_box_name()
                        .'/element/each/child/after', $element, $elements);
                }
            }
            do_action('templaza-framework/metabox/'.$this -> get_meta_box_name()
                .'/element/after', $elements);

        }

        public function save_settings(){
            check_ajax_referer( 'templaza_megamenu_save_settings', 'nonce' );

            if ( isset( $_POST['menu'] ) && $_POST['menu'] > 0 && is_nav_menu( $_POST['menu'] ) && isset( $_POST['megamenu_meta'] ) ) {
                $submitted_settings = $_POST['megamenu_meta'];

                if(count($submitted_settings)){
                    $submitted_settings = array_shift($submitted_settings);
                }

                $submitted_settings['tz_megamenu_meta'] = is_string($submitted_settings['tz_megamenu_meta'])?stripslashes($submitted_settings['tz_megamenu_meta']):$submitted_settings['tz_megamenu_meta'];

                $submitted_settings = apply_filters('templaza-framework/metabox/'.$this -> get_meta_box_name()
                    .'/megamenu_submitted_settings_meta', $submitted_settings);

                if ( ! get_option( 'templaza_megamenu_settings' ) ) {
                    update_option( 'templaza_megamenu_settings', $submitted_settings );
                } else {
                    $existing_settings = get_option( 'templaza_megamenu_settings' );
                    $new_settings = array_merge( $existing_settings, $submitted_settings );

                    update_option( 'templaza_megamenu_settings', $new_settings );
                }

                do_action( 'templaza-framework/metabox/'.$this -> get_meta_box_name()
                    .'/megamenu_after_save_settings' );
                do_action( 'templaza-framework/metabox/'.$this -> get_meta_box_name()
                    .'/megamenu_delete_cache' );
            }

            wp_die();
        }

        public function megamenu_enqueue(){
            global $wp_query;

            // The menu id of the current menu being edited.
            $nav_menu_selected_id = isset( $_REQUEST['menu'] ) ? (int) $_REQUEST['menu'] : 0;


            // Get recently edited nav menu.
            $recently_edited = absint( get_user_option( 'nav_menu_recently_edited' ) );
            if ( empty( $recently_edited ) && is_nav_menu( $nav_menu_selected_id ) ) {
                $recently_edited = $nav_menu_selected_id;
            }
            // Use $recently_edited if none are selected.
            if ( empty( $nav_menu_selected_id ) && ! isset( $_GET['menu'] ) && is_nav_menu( $recently_edited ) ) {
                $nav_menu_selected_id = $recently_edited;
            }


            $data       = array();
            $settings   = array();

            if ( is_nav_menu( $nav_menu_selected_id ) ) {
                $menu_items  = wp_get_nav_menu_items( $nav_menu_selected_id, array( 'post_status' => 'any' ) );
                if($menu_items && count($menu_items)){

                    // Hook to change menu slug to menu id of megamenu menu item element
                    add_filter('templaza-framework/metabox/'.$this -> get_meta_box_name()
                        .'/element/each', function($element){
//                        if($element['type'] == 'megamenu_menu_item' && isset($element['menu_slug'])){
//                            $menu   = get_posts(array(
//                                'name'      => $element['menu_slug'],
//                                'post_type' => 'nav_menu_item',
//                                'numberposts' => 1
//                            ));
//
//                            if(count($menu) && $menu[0] -> post_name == $element['menu_slug']){
//                                $element['menu_id'] = $menu[0] -> ID;
//                                unset($element['menu_slug']);
//                            }
//                        }
//                        return $element;
                        return $this -> change_to_menu_id($element);
                    }, 10);
                    foreach ($menu_items as $menu_item){
                        if($mega_layout = get_post_meta($menu_item -> ID, '_templaza_megamenu_layout', true)) {
                            $mlayout    = get_post_meta($menu_item->ID, '_templaza_megamenu_layout', true);

                            // Change menu slug to menu id of megamenu menu item element
                            $this -> tree_element_main($mlayout);

                            $data[$menu_item->ID] = $mlayout;
                        }

                        if($mega_settings = get_post_meta($menu_item -> ID, '_templaza_megamenu_settings', true)) {
                            $settings[$menu_item->ID] = get_post_meta($menu_item->ID, '_templaza_megamenu_settings', true);
                        }
                    }
                }
            }

            if (!wp_script_is('templaza-metabox-megamenu-js')) {
                wp_register_script(
                    'templaza-metabox-megamenu-js',
                    Functions::get_my_url() . '/metaboxes/megamenu/megamenu.js',
                    array(  'redux-js', TEMPLAZA_FRAMEWORK_NAME.'__js'),
                    time(),
                    'all'
                );

                $data       = count($data)?json_encode($data):'';
                $settings   = count($settings)?json_encode($settings):'';

                $action = 'templaza_megamenu_save_settings';
                wp_localize_script('templaza-metabox-megamenu-js', 'templaza_metabox_megamenu',
                    array(
                        '_templaza_megamenu_layout' => $data,
                        '_templaza_megamenu_settings' => $settings,
                        'admin_ajax_url' => admin_url('admin-ajax.php'),
                        'admin_ajax_action' => $action,
                        'admin_ajax_nonce'=> esc_attr( wp_create_nonce($action)),
                        'l10nStrings'=> array(
                            'megamenu' => esc_html__('TZ Mega Menu', $this -> text_domain),
                            'menu_item' => esc_html__('Megamenu Menu Item', $this -> text_domain),
                        )
                    )
                );
                wp_enqueue_script('templaza-metabox-megamenu-js');
            }
            wp_enqueue_style(TEMPLAZA_FRAMEWORK_NAME.'__css');
        }

        public function render($post, $metabox){

            $menu_id                = $this -> get_selected_menu_id();
            $tagged_menu_locations  = $this -> get_tagged_theme_locations_for_menu_id($menu_id);

            if(count($tagged_menu_locations)){
                $args   = $metabox['args'];

                $_metabox   = null;
                if(isset($args['metabox']) && $args['metabox']){
                    $_metabox   = $args['metabox'];
                }

                if(!empty($_metabox) && isset($_metabox['sections']) && !empty($_metabox['sections'])) {
                    $sections   = array();
                    $sections   = apply_filters("templaza-framework/metabox/{$_metabox['id']}/sections/before", $sections, $_metabox);
                    $sections   = array_merge((array) $sections, (array) $_metabox['sections']);
                    $sections   = apply_filters("templaza-framework/metabox/{$_metabox['id']}/sections/after", $sections, $_metabox);


                    $menu_id = $this->get_selected_menu_id();
                    $tagged_menu_locations = $this->get_tagged_theme_locations_for_menu_id($menu_id);

                    // Get mega menu settings
                    $options        = get_option( 'templaza_megamenu_settings' , array());
                    $meta_options   = count($options)?$options['tz_megamenu_meta']:array();

                    // Set theme location assigned to tz_mega_menu field
                    if(count($sections)) {

                        $mdefault   = array();
                        if($this -> loop_fields && count($this -> loop_fields)){
                            $mfieldDefault   = array();
                            foreach($this -> loop_fields as $mfield){
                                if(isset($mfield['default'])){
                                    $mfieldDefault[$mfield['id']]    = $mfield['default'];
                                }
                            }
                            if(count($mfieldDefault) && count($tagged_menu_locations)){
                                foreach($tagged_menu_locations as $mlocation => $mlocationName){
                                    $mdefault[$mlocation]   = $mfieldDefault;
                                }
                            }
                        }

                        foreach($sections as $i => &$sec) {
                            $fields = $sec['fields'];
                            if(count($fields)) {
                                foreach($fields as &$field) {
                                    if($field['id'] == 'tz_megamenu_meta'){
                                        $field['group_fields']  = $tagged_menu_locations;
                                        $field['default']  = json_encode($mdefault);
                                    }
                                }
                                $sec['fields']  = $fields;
                            }
                        }
                    }

                    if(is_string($meta_options)){
                        $meta_options   = json_decode($meta_options, true);
                        foreach($meta_options as $mlocal => $mval){
                            if(!isset($tagged_menu_locations[$mlocal])){
                                unset($meta_options[$mlocal]);
                            }
                        }

                        if(count($tagged_menu_locations)){
                            foreach($tagged_menu_locations as $mlocation => $mlocationName){
                                if(!isset($meta_options[$mlocation])){
                                    if(isset($mdefault[$mlocation])) {
                                        $meta_options[$mlocation]  = $mdefault[$mlocation];
                                    }else{
                                        $meta_options[$mlocation]  = array();
                                    }
                                }
                            }
                        }

                        if(!empty($meta_options) && count($meta_options)) {
                            $options['tz_megamenu_meta'] = json_encode($meta_options);
                        }
                    }


                    $setting_args                       = $this -> post_type -> setting_args;
                    $setting_args                       = $setting_args[$this -> post_type -> get_post_type()];
                    $redux_args                         = $setting_args;

                    $redux_args['opt_name']             = $metabox['id'];
                    $redux_args['menu_type']            = 'hidden';
                    $redux_args['dev_mode']             = false;
                    $redux_args['ajax_save']            = false;
                    $redux_args['open_expanded']        = true;
                    $redux_args['show_import_export']   = false;


                    Redux::set_args($metabox['id'], $redux_args);
                    Redux::set_sections($metabox['id'], $sections);
                    Redux::init($metabox['id']);
                    \Templaza_API::load_my_fields($metabox['id']);

                    add_filter("redux/{$setting_args['opt_name']}/repeater", function($repeater_data) use($redux_args){
                        $repeater_data['opt_names'][]   = $redux_args['opt_name'];
                        return $repeater_data;
                    });
                    $redux  = \Redux::instance($metabox['id']);

                    // Set options
//                    var_dump(!empty($options));
//                    var_dump(!empty(array_values($options)));
//                    die();
//                    if(count($options)) {
                        $redux -> options   = $options;
//                    }

                    if(\version_compare(\Redux_Core::$version, '4.3.7', '<=')) {
                        $redux->_register_settings();
                    }else{
                        $redux -> options_class -> register();
                    }

                    $enqueue    = new Enqueue($redux);
                    $enqueue -> init();

                    ?>
                    <?php

                    echo '<div class="redux-container templaza-framework-options">';
                    echo '<div class="redux-main">';
                    foreach ($redux -> sections as $k => &$section) {

                        $section['class'] = isset($section['class']) ? ' ' . $section['class'] : '';
                        echo '<div id="metabox_'.$metabox['id'].'_' . $k . '_section_group' . '" class="redux-group-tab'
                            . esc_attr($section['class']) . '" data-rel="metabox_'.$metabox['id'].'_' . $k . '">';

                        do_action("redux/page/{$redux->args['opt_name']}/section/before", $section);
                        do_settings_sections( $redux->args['opt_name'] . $k . '_section_group' );
                        do_action("redux/page/{$redux->args['opt_name']}/section/after", $section);

                        echo '</div>';
                    }

                    echo '<a href="#" class="button button-primary button-micro megamenu-save-option" style="float:right;">'
                        .'<i class="fas fa-save"></i> '
                        .esc_html__('Save', $this -> text_domain).'</a>';
                    echo '<span class="spinner"></span>';

                    echo '</div>';
                    echo '</div>';
                }else{
                    $this -> render_fields($post, $metabox);
                }
            }else{
//                echo "<div style='padding: 15px;'>";
                echo '<p>' . esc_html__( 'Please assign this menu to a theme location to enable the Mega Menu settings.', $this -> text_domain ) . '</p>';
                echo '<p>' . esc_html__( "To assign this menu to a theme location, scroll to the bottom of this page and tag the menu to a 'Display location'.", $this -> text_domain ) . '</p>';
//                echo "</div>";
            }
        }
    }
}