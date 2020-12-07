<?php

defined('TEMPLAZA_FRAMEWORK') or exit();

use TemPlazaFramework\Enqueue;

if(!class_exists('TemplazaFramework_MetaBox_MegaMenu')){

    class TemplazaFramework_MetaBox_MegaMenu extends TemplazaFramework_MetaBox{

        public $layout_fields = array();
        public $template_html = '';

        public function __construct($post_type, &$framework = null)
        {
            parent::__construct($post_type, $framework);

//            add_action('')

            $opt_name                           = 'megamenu__layout';
//            $opt_name                           = 'menu-item[-1]';
            $sections                           = $this -> layout_fields;

            $setting_args                       = $this -> post_type -> setting_args;
            $setting_args                       = $setting_args[$this -> post_type -> get_post_type()];
            $redux_args                         = $setting_args;

            $redux_args['opt_name']             = $opt_name;
            $redux_args['menu_type']            = 'hidden';
            $redux_args['dev_mode']             = false;
            $redux_args['ajax_save']            = false;
            $redux_args['open_expanded']        = true;
            $redux_args['shortcode_section']    = false;
            $redux_args['show_import_export']   = false;
            \Templaza_API::load_my_fields($opt_name);

            Redux::set_args($opt_name, $redux_args);
            Redux::set_sections($opt_name, $sections);
            Redux::init($opt_name);

            add_filter("redux/{$opt_name}/repeater", function($repeater_data) use($redux_args){
                $repeater_data['opt_names'][]   = $redux_args['opt_name'];
                return $repeater_data;
            });
            $redux  = \Redux::instance($opt_name );

            // Set options
            $redux -> options   = array();
            $redux->_register_settings();

            ob_start();
            foreach ($redux -> sections as $k => $section) {

                $section['class'] = isset($section['class']) ? ' ' . $section['class'] : '';

                echo '<div id="metabox_'.$redux_args['opt_name'].'_' . $k . '_section_group' . '" class="redux-group-tab' . esc_attr($section['class']) . '" data-rel="metabox_'.$redux_args['opt_name'].'_' . $k . '">';

                do_action("redux/page/{$redux->args['opt_name']}/section/before", $section);
                do_settings_sections( $redux->args['opt_name'] . $k . '_section_group' );
                do_action("redux/page/{$redux->args['opt_name']}/section/after", $section);

                echo '</div>';
            }
//            $this -> template_html  = ob_get_contents();
//            $this -> template_html  = ob_get_contents();
            ob_end_clean();

//            $menu = get_term( $locations[$theme_location], 'nav_menu' );
            $menu_item_id   = 2580;
            $terms = get_the_terms( $menu_item_id, 'nav_menu' );
//            $menu_id = $terms[0]->term_id;
            $menu_id = 215;
            $menu_item = wp_get_nav_menu_object($menu_item_id);


            $items  = array();
//            var_dump(__METHOD__);
//            var_dump($_POST);
//            var_dump($_REQUEST);
//            var_dump($_GET);
//            var_dump($menu_item);
//            var_dump(array_keys($menu_items));

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
//            var_dump($nav_menu_selected_id);
//            var_dump(is_nav_menu( $nav_menu_selected_id ));
//            var_dump($recently_edited);
            $menu_items = wp_get_nav_menu_items($nav_menu_selected_id);
            if(count($menu_items)){
                foreach ($menu_items as $i => $item){
                    if(!isset($items[$i])){
                        $items[$i]  = array();
                    }
                    $items[$i]['ID']            = $item -> ID;
                    $items[$i]['title']         = $item -> post_title;
                    $items[$i]['admin_label']   = $item -> post_title;
//                    break;
                }
            }
//            var_dump($items);
//            var_dump($menu_id);
//            var_dump($menu_items);

//            $enqueue    = new Enqueue($redux);
//            $enqueue -> init();
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
            $metaboxes[] = array(
                'id'            => 'tz_megamenu',
                'title'         => __( 'TZ Mengamenu Options', $this -> text_domain ),
                'post_types'    => array('nav-menus' ),
//                'post_types'    => 'nav-menus',
//                'position'      => 'side', // normal, advanced, side
                'position'      => 'side', // normal, advanced, side
                'priority'      => 'high', // high, core, default, low - Priorities of placement
                'store_each'    => true, // Store value of each fields to each post meta
                'sections'      => array(
                    array(
                        'fields' => array(
                            array(
//                                'id'    => 'megamenu_layout',
                                'id'    => '_templaza_megamenu',
                                'type'  => 'text',
                                'class' => 'hide',
                                'default' => '{"2580": [{"type":"row","elements":[{"type":"column","elements":[{"type":"megamenu_menu_item", "title":"Megamenu Menu Item", "admin_label": "New Style 2020 - Single Portfolio", "params":{}}],"params":{"tz_customclass":"","tz_customid":"","background":{"background-color":"","background-repeat":"","background-size":"","background-attachment":"","background-position":"","background-image":"","media":{"id":"","height":"","width":"","thumbnail":""}},"text_color":"","link_color":{"regular":"","hover":"","active":""},"xs_colum_size":"","xs_visibility":"","sm_colum_size":"","sm_visibility":"","md_colum_size":"","md_visibility":"","lg_colum_size":"","lg_visibility":"","xl_colum_size":"","xl_visibility":""},"size":12,"id":"291601538988002"}],"params":{"test":"","tz_customclass":"","tz_customid":"","background":{"background-color":"","background-repeat":"","background-size":"","background-attachment":"","background-position":"","background-image":"","media":{"id":"","height":"","width":"","thumbnail":""}},"hideonxs":"","hideonsm":"","hideonmd":"","hideonlg":"","hideonxl":""},"id":"951601538987998"}]}',
//                                'title' => esc_html__('Mega Layout', $this -> text_domain),
//                                'subtitle' => __('This template style will be defined as the global default template style.', $this -> text_domain),
                                'attributes' => array(
                                    'type'         => 'hidden',
//                                    'readonly'     => 'readonly',
//                                    'autocomplete' => 'off',
//                                    'data-json' => array(
//                                        'example' => 'json'
//                                    )
                                ),
                            ),
                            array(
                                'id'    => 'templaza-style',
                                'type'  => 'select',
                                'data' => 'posts',
                                'title' => esc_html__('Templaza Style', $this -> text_domain),
                                'subtitle' => __('This template style will be defined as the global default template style.', $this -> text_domain),
                                'args'  => array(
                                    'post_type'      => 'templaza_style',
                                    'posts_per_page' => -1,
                                    'orderby'        => 'title',
                                    'order'          => 'ASC',
                                    'meta_key'       => '_templaza_style_theme',
                                    'meta_value'     => basename(get_template_directory()),
                                ),
                            ),
//                            array(
//                                'id'       => 'test-mega',
//                                'type'     => 'switch',
//                                'default'  => false,
//                                'title'    => esc_html__('Default', $this -> text_domain),
//                                'subtitle' => __('This template style will be defined as the global default template style.', $this -> text_domain),
//                            ),
//                            array(
//                                'id'           => 'megamenu_layout-2',
//                                'type'         => 'tz_layout',
//                                'default'      => '[{"type":"section","elements":[{"type":"row","elements":[{"type":"column","elements":[],"params":{"tz_customclass":"","tz_customid":"","background":{"background-color":"","background-repeat":"","background-size":"","background-attachment":"","background-position":"","background-image":"","media":{"id":"","height":"","width":"","thumbnail":""}},"text_color":"","link_color":{"regular":"","hover":"","active":""},"xs_colum_size":"","xs_visibility":"","sm_colum_size":"","sm_visibility":"","md_colum_size":"","md_visibility":"","lg_colum_size":"","lg_visibility":"","xl_colum_size":"","xl_visibility":""},"size":12,"id":"291601538988002"}],"params":{"test":"","tz_customclass":"","tz_customid":"","background":{"background-color":"","background-repeat":"","background-size":"","background-attachment":"","background-position":"","background-image":"","media":{"id":"","height":"","width":"","thumbnail":""}},"hideonxs":"","hideonsm":"","hideonmd":"","hideonlg":"","hideonxl":""},"id":"951601538987998"}],"params":{"tz_admin_label":"","title":"","layout_type":"container","custom_container_class":"","tz_customclass":"","tz_customid":"","background":{"background-color":"","background-repeat":"","background-size":"","background-attachment":"","background-position":"","background-image":"","media":{"id":"","height":"","width":"","thumbnail":""}},"text_color":"","link_color":{"regular":"","hover":"","active":""},"margin":{"units":"","margin-top":"","margin-right":"","margin-bottom":"","margin-left":""},"padding":{"units":"","padding-top":"","padding-right":"","padding-bottom":"","padding-left":""},"hideonxs":"","hideonsm":"","hideonmd":"","hideonlg":"","hideonxl":""},"id":"231601538987996"}]',
////                            'class'    => 'field-tz_layout-content',
//                                'title'    => esc_html__('Layout', $this -> text_domain),
////                            'subtitle' => __('This template style will be defined as the global default template style.', $this -> text_domain),
//                            ),
                        ),
                    ),
                ),
            );

            $this -> layout_fields  = array(
                array(
                    'fields' => array(
                        array(
                            'id'       => 'megamenu_layout',
                            'type'     => 'tz_layout',
//                            'show_section' => true,
//                            'default'  => '[{"type":"row","elements":[{"type":"column","elements":[],"params":{"tz_customclass":"","tz_customid":"","background":{"background-color":"","background-repeat":"","background-size":"","background-attachment":"","background-position":"","background-image":"","media":{"id":"","height":"","width":"","thumbnail":""}},"text_color":"","link_color":{"regular":"","hover":"","active":""},"xs_colum_size":"","xs_visibility":"","sm_colum_size":"","sm_visibility":"","md_colum_size":"","md_visibility":"","lg_colum_size":"","lg_visibility":"","xl_colum_size":"","xl_visibility":""},"size":12,"id":"291601538988002"}],"params":{"test":"","tz_customclass":"","tz_customid":"","background":{"background-color":"","background-repeat":"","background-size":"","background-attachment":"","background-position":"","background-image":"","media":{"id":"","height":"","width":"","thumbnail":""}},"hideonxs":"","hideonsm":"","hideonmd":"","hideonlg":"","hideonxl":""},"id":"951601538987998"}]',
//                            'default'  => '[{"type":"section","elements":[{"type":"row","elements":[{"type":"column","elements":[],"params":{"tz_customclass":"","tz_customid":"","background":{"background-color":"","background-repeat":"","background-size":"","background-attachment":"","background-position":"","background-image":"","media":{"id":"","height":"","width":"","thumbnail":""}},"text_color":"","link_color":{"regular":"","hover":"","active":""},"xs_colum_size":"","xs_visibility":"","sm_colum_size":"","sm_visibility":"","md_colum_size":"","md_visibility":"","lg_colum_size":"","lg_visibility":"","xl_colum_size":"","xl_visibility":""},"size":12,"id":"291601538988002"}],"params":{"test":"","tz_customclass":"","tz_customid":"","background":{"background-color":"","background-repeat":"","background-size":"","background-attachment":"","background-position":"","background-image":"","media":{"id":"","height":"","width":"","thumbnail":""}},"hideonxs":"","hideonsm":"","hideonmd":"","hideonlg":"","hideonxl":""},"id":"951601538987998"}],"params":{"tz_admin_label":"","title":"","layout_type":"container","custom_container_class":"","tz_customclass":"","tz_customid":"","background":{"background-color":"","background-repeat":"","background-size":"","background-attachment":"","background-position":"","background-image":"","media":{"id":"","height":"","width":"","thumbnail":""}},"text_color":"","link_color":{"regular":"","hover":"","active":""},"margin":{"units":"","margin-top":"","margin-right":"","margin-bottom":"","margin-left":""},"padding":{"units":"","padding-top":"","padding-right":"","padding-bottom":"","padding-left":""},"hideonxs":"","hideonsm":"","hideonmd":"","hideonlg":"","hideonxl":""},"id":"231601538987996"}]',
//                            'class'    => 'field-tz_layout-content',
//                            'class'    => 'fl_column-container',
                            'title'    => esc_html__('Layout', $this -> text_domain),
//                            'subtitle' => __('This template style will be defined as the global default template style.', $this -> text_domain),
                        ),
                    ),
                ),
            );

            return $metaboxes;
        }

        public function hooks(){
            global $pagenow;

//            var_dump(md5('admin'));
//            parent::hooks();

            if($pagenow == 'nav-menus.php') {
//                add_action('init', array($this, 'add_meta_boxes'), 10, 2);
                add_action('admin_init', array($this, 'add_meta_boxes'), 10, 2);
//                add_action('setup_theme', array($this, 'add_meta_boxes'), 10, 2);
//                add_action('after_setup_theme', array($this, 'add_meta_boxes'), 10, 2);
            }
//            add_action( 'save_post', array( $this, 'save_meta_box' ), 10, 2 );
//            add_action( 'wp_update_nav_menu', array( $this, 'update_nav_menu' ), 10, 2 );
            add_action( 'pre_update_option_nav_menu_options', array( $this, 'update_nav_menu' ), 10, 3 );

//            if(method_exists($this, 'enqueue')){
////                $this -> enqueue();
////            }
//
////            add_filter( 'page_attributes_meta_box', array($this, 'test'), 10, 2 );
//
//            add_action('admin_footer', array($this, 'template'));

            add_action('admin_footer', array($this, 'megamenu_enqueue'));
            add_action('admin_footer', array($this, 'template'));
        }

        public function update_nav_menu($value, $old_value, $option){

//            $nav_menu_option = (array) get_option( 'nav_menu_options' );
            var_dump(__METHOD__);
            var_dump(wp_get_nav_menus( array( 'fields' => 'ids' ) ));
            var_dump($value);
            var_dump($option);
            var_dump($_POST);
//            var_dump($_POST['tzfrm_metabox-tz_megamenu']);
            die();
////            var_dump($_GET);
//            var_dump($_REQUEST);
        }

        public function megamenu_enqueue(){
            if (!wp_script_is('templaza-metabox-megamenu-js')) {
                wp_enqueue_script(
                    'templaza-metabox-megamenu-js',
                    \TemPlazaFramework\Functions::get_my_url() . '/metaboxes/megamenu/megamenu.js',
                    array(  'redux-js', TEMPLAZA_FRAMEWORK_NAME.'__js'),
                    time(),
                    'all'
                );
            }
        }

        public function save_meta_box($post_id, $post)
        {

//            $metaboxes  = $this -> metaboxes;
//            if(count($metaboxes)) {
//                foreach ($metaboxes as $metabox) {
//                    $mt_key = $this->prefix . $metabox['id'];
//                }
//            }


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

//            var_dump($nav_menu_selected_id); die();

            $nav_menu_option = (array) get_option( 'nav_menu_options' );
            var_dump($nav_menu_option);
            $metaboxes  = $this -> metaboxes;
            if(count($metaboxes)){
                foreach ($metaboxes as $metabox){
                    $mt_key  = $this -> prefix.$metabox['id'];
                    var_dump($post_id);
                    var_dump($post_id);
                    var_dump(__METHOD__);
                    var_dump($mt_key);
                    var_dump(isset( $_POST[$mt_key] ));
                    var_dump(isset( $_GET[$mt_key] ));
                    var_dump(isset( $_REQUEST[$mt_key] ));
//                    var_dump($this -> can_save($post_id, $post));
                    die();
                    if ( isset( $_POST[$mt_key] ) ) {
                        $options    = $_POST[$mt_key];
                        if(isset($metabox['store_each']) && $metabox['store_each']){
                            foreach ($options as $key => $option){
                                update_post_meta($post_id, $key, $option);
                            }
                        }else {
                            update_post_meta($post_id, $mt_key, $options);
                        }
                    }
                }
            }

//            parent::save_meta_box($post_id, $post);

//            $mt_key  = $this -> prefix.'basic';
//            if ( isset( $_POST[$mt_key] ) ) {
//                $options    = $_POST[$mt_key];
//                if(isset($options['home']) && $options['home'] == 1){
//                    $this -> _disable_home_without_post_id($post_id);
//                }
//            }
        }

//        public function hooks()
//        {
//            parent::hooks(); // TODO: Change the autogenerated stub
//
//            add_filter("redux/options/{$this->prefix}templaza-options/wordpress_data/translate/post_type_value",
//                array($this, 'meta_box_basic_post_type_value'), 10, 2);
//
//
//            $post_type  = $this -> post_type -> get_post_type();
//
//            if(post_type_exists($post_type) && $this -> post_type ->  get_current_screen_post_type() == $post_type){
//                // Add header column to post type list
//                if(method_exists($this,'post_type_table_head')) {
//                    add_filter('manage_'.$post_type.'_posts_columns', array($this, 'post_type_table_head'));
//                }
//                // Add content column to post type list
//                if(method_exists($this,'post_type_table_content')) {
//                    add_action( 'manage_'.$post_type.'_posts_custom_column', array($this, 'post_type_table_content'), 10, 2 );
//                }
//                // Ordering column
//                if(method_exists($this,'post_type_table_sorting')) {
//                    add_filter( 'manage_edit-'.$post_type.'_sortable_columns', array($this, 'post_type_table_sorting' ) );
//                }
//                // Order by column added
//                if(method_exists($this,'post_type_orderby')) {
//                    add_filter( 'request', array($this, 'post_type_orderby' ) );
//                }
//                // Duplicate post action
//                add_action("templaza-framework/post-type/{$post_type}/duplicate", array($this, 'post_duplicate'), 11, 2);
//                // Set home for post type
//                add_action( 'admin_action_'.$post_type.'_set_default', array($this, 'post_type_set_default') );
//
////                // Duplicate post type
////                add_action( 'admin_action_'.$post_type.'_set_default', array($this, 'post_type_set_default') );
//
////                // Create duplicate action
////                add_filter('post_row_actions', array($this, 'duplicate_post_link'), 10, 2);
////                // Order by column added
////                if(method_exists($this,'restrict_manage_posts')) {
////                    add_action( 'restrict_manage_posts', array($this, 'restrict_manage_posts' ) );
////                }
//            }
//
//        }
//
//        /*
//         * Set home meta box field to 0
//         * @param string|int $new_post_id
//         * @param string|int $post_id
//         * */
//        public function post_duplicate($new_post_id, $post_id){
//            update_post_meta($new_post_id, 'home', 0);
//        }
//
//        /*
//         * Add columns for header custom post type in list page
//         * @param array $columns
//         * */
//        public function post_type_table_head($columns){
//            $columns = array(
//                "cb"                 => "<input type=\"checkbox\" />",
//                "title"              => esc_html__("Title", $this -> text_domain),
//                "home"             => esc_html__("Default",$this -> text_domain),
//                "date"               => esc_html__("Date",$this -> text_domain)
//            );
//            return $columns;
//        }
//
//        /*
//         * Add columns for content custom post type in list page
//         * @param string $column_name
//         * @param string $post_id
//         * */
//        public function post_type_table_content($column_name, $post_id ){
//            if ($column_name == 'home') {
//                $home   = get_post_meta($post_id,'home', true);
//                $action = $this -> post_type -> get_post_type().'_set_default';
//                $nonce  = wp_create_nonce( $action );
//                $href   = 'admin.php?action='.$action.'&post='.$post_id.'&_wpnonce='
//                    .$nonce.'" class="button button-micro'.($home?' disabled':'');
//                if($home){
//                    $href   = 'javascript:void();';
//                }
//                echo '<a href="'.$href.'" class="button button-micro'.($home?' disabled':'').'"'.($home?' disabled':'').'>';
//                if($home){
//                    echo '<span class="dashicons dashicons-star-filled featured"></span>';
//                }else{
//                    echo '<span class="dashicons dashicons-star-empty"></span>';
//                }
//                echo '</a>';
//            }
//        }
//
//        /*
//         * Sorting columns for custom post type in list page
//         * @param array $columns
//         * */
//        public function post_type_table_sorting($columns ){
//            $columns['home'] = 'home';
//            return $columns;
//        }
//
//        /*
//         * Order by query for custom post type in list page
//         * @param array $vars
//         * */
//        public function post_type_orderby( $vars ) {
//            if ( isset( $vars['orderby'] ) && 'home' == $vars['orderby'] ) {
//                $vars = array_merge( $vars, array(
//                    'meta_key' => 'home',
//                    'orderby' => 'meta_value'
//                ) );
//            }
//
//            return $vars;
//        }
//
//        /*
//         * Reset value of select field with data is post
//         * */
//        public function meta_box_basic_post_type_value($value, $post_type){
//            if(is_array($value)){
//                return array();
//            }else{
//                return '';
//            }
//        }
//
//        /*
//         * Action set home for custom post type in list page
//         * */
//        public function post_type_set_default(){
//            $post_type      = $this -> post_type -> get_post_type();
//            $nonce_name     = isset( $_GET['_wpnonce'] ) ? $_GET['_wpnonce'] : '';
//            $nonce_action   = $post_type.'_set_default';
//
//            // Check if nonce is valid.
//            if ( ! wp_verify_nonce( $nonce_name, $nonce_action ) ) {
//                wp_die('Security issue occure, Please try again!.');
//            }
//            $post_id    = isset($_GET['post'])?$_GET['post']:0;
//            if(!$post_id){
//                wp_die(__('Post or Page creation failed, could not find original post:', $this -> text_domain) . $post_id);
//            }
//
//            $this -> _disable_home_without_post_id($post_id);
//
//            // Set post by post_id to home
//            update_post_meta($post_id, 'home', 1);
//
//            wp_redirect(admin_url('edit.php?post_type='.$post_type));
//            exit;
//        }
//
//
//        /*
//         * Disable home for all posts without post_id
//         * @param string|int $post_id
//         * */
//        protected function _disable_home_without_post_id($post_id){
//            global $wpdb;
//
//            $subQuery   = 'SELECT post_id FROM (';
//            $subQuery  .= 'SELECT m.post_id FROM '.$wpdb -> prefix.'postmeta AS m ';
//            $subQuery  .= 'INNER JOIN '.$wpdb -> prefix.'posts AS p ON p.ID = m.post_id AND m.meta_key="_'.
//                $this -> post_type -> get_post_type().'_theme" AND m.meta_value="'.basename(get_template_directory()).'" ';
//            $subQuery  .= 'WHERE p.ID <> '.$post_id;
//            $subQuery  .= ' AND m.meta_key="_'.$this -> post_type -> get_post_type()
//                .'_theme" AND m.meta_value="'.basename(get_template_directory()).'" ';
//            $subQuery  .= ') AS post_id';
//
//            $query  = 'UPDATE '.$wpdb -> prefix.'postmeta SET meta_value=0 ';
//            $query .= 'WHERE meta_key="home" AND post_id IN('.$subQuery.')';
//            $wpdb ->query($query);
//        }
    }
}