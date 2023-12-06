<?php

defined('TEMPLAZA_FRAMEWORK') or exit();

use TemPlazaFramework\Functions;

if(!class_exists('TemplazaFramework_ShortCode_Widget')){
    class TemplazaFramework_ShortCode_Widget extends TemplazaFramework_ShortCode {

        private $sidebar_registered;

        public function __construct($field_parent = array(), $value = '', $parent = ''){
            parent::__construct($field_parent, $value, $parent);

            $this -> sidebar_registered = 'templaza-framework__sidebar';

            require_once TEMPLAZA_FRAMEWORK_SHORTCODES_PATH.'/widget/classes/widget.php';

            $this -> hooks();
        }

        public function hooks(){

            add_action('admin_print_footer_scripts-post.php', array($this, 'admin_print_footer_scripts'));
            add_action('admin_print_footer_scripts-post-new.php', array($this, 'admin_print_footer_scripts'));

            add_action('admin_print_scripts-post.php', array($this, 'admin_print_scripts'));
            add_action('admin_print_scripts-post-new.php', array($this, 'admin_print_scripts'));
            add_action('admin_print_styles-post.php', array($this, 'admin_print_styles'));
            add_action('admin_print_styles-post-new.php', array($this, 'admin_print_styles'));

            add_action('admin_print_footer_scripts-nav-menus.php', array($this, 'admin_print_footer_scripts'));

            add_action('admin_print_scripts-nav-menus.php', array($this, 'admin_print_scripts'));
            add_action('admin_print_styles-nav-menus.php', array($this, 'admin_print_styles'));

            add_action( 'wp_ajax_templaza_shortcode_widget', array( $this, 'ajax_widget' ) );
            add_action( 'wp_ajax_templaza_shortcode_widget_edit', array( $this, 'ajax_widget_edit' ) );
            add_action( 'wp_ajax_templaza_shortcode_widget_clone', array( $this, 'ajax_widget_clone' ) );
            add_action( 'wp_ajax_templaza_shortcode_widget_delete', array( $this, 'ajax_widget_delete' ) );
            add_action( 'wp_ajax_templaza_shortcode_widget_save', array( $this, 'ajax_widget_save' ) );


            add_action( 'templaza-framework/shortcode/widget/after_widget_add', array( $this, 'clear_caches' ) );
            add_action( 'templaza-framework/shortcode/widget/after_widget_save', array( $this, 'clear_caches' ) );
            add_action( 'templaza-framework/shortcode/widget/after_widget_delete', array( $this, 'clear_caches' ) );

        }


        /**
         * Print the widgets.php scripts on the nav-menus.php page. Required for 4.8 Core Media Widgets.
         *
         * @since 2.3.7
         * @param string $hook page ID.
         */
        public function admin_print_scripts( $hook ) {
            do_action( 'admin_print_scripts-widgets.php' );
        }

        /**
         * Print the widgets.php scripts on the nav-menus.php page. Required for 4.8 Core Media Widgets.
         *
         * @since 2.3.7
         * @param string $hook page ID.
         */
        public function admin_print_styles( $hook ) {
            do_action( 'admin_print_styles-widgets.php' );
        }

        /**
         * Print the widgets.php scripts on the nav-menus.php page. Required for 4.8 Core Media Widgets.
         *
         * @since 2.3.7
         * @param string $hook page ID.
         */
        public function admin_print_footer_scripts(){
            do_action( 'admin_footer-widgets.php' );
        }

        public function register(){
            return array(
                'id'          => 'widget',
                'icon'        => 'el el-website',
                'title'       => __('Widget'),
                'param_title' => esc_html__('Widget Settings'),
                'desc'        => __('Load a widget.'),
                'admin_label' => true,
                'params'      => array(
                    array(
                        'id'       => 'widget',
                        'type'     => 'select',
//                        'ajax'     => true,
//                        'data'     => 'sidebars',
                        'data'     => 'callback',
                        'title'    => __( 'Widget', 'templaza-framework' ),
                        'subtitle' => __( 'Select Widget.', 'templaza-framework' ),
                        'desc'     => __( 'The widget will be add to framework sidebar first after save change.', 'templaza-framework' ),
                        'args'     => 'templaza_framework_shortcode_widget_get_widgets',
//                        'args'     => array('TemplazaFramework_Widget_Shortcode_Helper', 'get_widgets'),
//                        'options'  => array(
//                            '' => esc_html__('- Select Widget -', 'templaza-framework'),
////                            'recent-post-1' => 'Recent Post'
//                        ),
                        'default' => ''
                    ),
                    array(
                        'id'       => 'widget_heading',
                        'type'     => 'select',
                        'title'    => esc_html__('Widget Title HTML Element', 'templaza-framework'),
                        'subtitle' => esc_html__('Select Widget title HTML element from the list', 'templaza-framework'),
                        'options'  => array(
                            'h1'   => 'h1',
                            'h2'   => 'h2',
                            'h3'   => 'h3',
                            'h4'   => 'h4',
                            'h5'   => 'h5',
                            'h6'   => 'h6',
                        ),
                        'default'  => 'h3',
//                        'required' => array('title', 'not_empty_and', ''),
                        'required' => array('widget', 'not', ''),
                    ),
                    array(
                        'type'          => 'select',
                        'id'            => 'widget_heading_style',
                        'title'         => esc_html__('Widget Title Style',  'templaza-framework'),
                        'subtitle'      => esc_html__('Heading styles differ in font-size but may also come with a predefined color, size and font',  'templaza-framework'),
                        'options'       => array(
                            ''                  => esc_html__('None',  'templaza-framework'),
                            'heading-2xlarge'   => esc_html__('2XLarge',  'templaza-framework'),
                            'heading-xlarge'    => esc_html__('XLarge',  'templaza-framework'),
                            'heading-large'     => esc_html__('Large',  'templaza-framework'),
                            'heading-medium'    => esc_html__('Medium',  'templaza-framework'),
                            'heading-small'     => esc_html__('Small',  'templaza-framework'),
                            'h1'                => esc_html__('H1',  'templaza-framework'),
                            'h2'                => esc_html__('H2',  'templaza-framework'),
                            'h3'                => esc_html__('H3',  'templaza-framework'),
                            'h4'                => esc_html__('H4',  'templaza-framework'),
                            'h5'                => esc_html__('H5',  'templaza-framework'),
                            'h6'                => esc_html__('H6',  'templaza-framework'),
                        ),
                        'default'       => '',
                    ),
//                    array(
//                        'id'         => 'widget_id',
//                        'type'       => 'text',
////                        'title'      => __( 'Widget', 'templaza-framework' ),
////                        'subtitle'   => __( 'Select Sidebar.', 'templaza-framework' ),
//                        'attributes' => array(
//                            'type'   => 'hidden',
//                        ),
//                    ),
//                    array(
//                        'id'       => 'sidebar',
//                        'type'     => 'select',
//                        'data'     => 'sidebars',
//                        'title'    => __( 'Sidebar', 'templaza-framework' ),
//                        'subtitle' => __( 'Select Sidebar.', 'templaza-framework' ),
//                    ),
                )
            );
        }

        public function ajax_widget(){

            check_ajax_referer( 'templaza_shortcode_widget' );

            global $wp_registered_widget_controls;

            $id_base = sanitize_text_field( $_POST['id_base'] );
            $title = sanitize_text_field( $_POST['title'] );

            $widget_id = $this->_add_widget( $id_base, $title );

            if (!$wp_registered_widget_controls[$widget_id]) {
                $widget_number  = TemplazaFramework_Widget_Shortcode_Helper::get_widget_number_for_widget_id($widget_id);
                $callback   = TemplazaFramework_Widget_Shortcode_Helper::get_widget_by_id_base($id_base);
                wp_register_widget_control($widget_id, $title, $callback -> _get_form_callback(), $callback -> control_options,
                    array('number' => $widget_number));
//                wp_register_widget_control($widget_id, $title, array($callback, 'form_callback'),
//                    array('params' => array('number' => $widget_number)));
            }

            if ( ob_get_contents() ) ob_clean();

            wp_die(trim($this -> show_widget_ajax($widget_id, $id_base, $title)));
        }

        public function ajax_widget_edit(){
            check_ajax_referer( 'templaza_shortcode_widget_edit' );

            $widget_id  = sanitize_text_field($_POST['widget_id']);

            $title      = TemplazaFramework_Widget_Shortcode_Helper::get_name_for_widget_id($widget_id);
            $id_base    = TemplazaFramework_Widget_Shortcode_Helper::get_id_base_for_widget_id($widget_id);

            if ( ob_get_contents() ) ob_clean();

            wp_die(trim($this -> show_widget_ajax($widget_id, $id_base, $title)));

        }

        public function ajax_widget_clone(){
//            check_ajax_referer( 'templaza_shortcode_widget_clone' );

            if(ob_get_contents()) ob_end_clean();

            $saved          = false;
            $widget_id      = sanitize_text_field($_POST['widget_id']);
            $title          = TemplazaFramework_Widget_Shortcode_Helper::get_name_for_widget_id($widget_id);
            $id_base        = TemplazaFramework_Widget_Shortcode_Helper::get_id_base_for_widget_id($widget_id);
            $widget_number  = TemplazaFramework_Widget_Shortcode_Helper::get_widget_number_for_widget_id($widget_id);


//            var_dump($widget_instances);
//            var_dump($widget_instances);
//            die();

//            $number2 = next_widget_id_number( $id_base );
//            var_dump($number);
//            var_dump($number2);
//            die();
//            global $wp_registered_widgets;
//            require_once( ABSPATH . 'wp-admin/includes/widgets.php' );
//            $number = next_widget_id_number( $id_base );
//            $_new_widget_id = $id_base . '-' . $number;
//
//            if (!$wp_registered_widgets[$_new_widget_id]) {
//                $register_callback       = TemplazaFramework_Widget_Shortcode_Helper::get_widget_by_id_base($id_base);
//                wp_register_sidebar_widget($_new_widget_id, $title, array($register_callback, 'display_callback'),
//                    array('params' => array('number' => $number)));
//            }

            // Add new widget to sidebar
//            $new_widget_id      = $this->_add_widget( $id_base, $title );
//            $new_widget_number  = TemplazaFramework_Widget_Shortcode_Helper::get_widget_number_for_widget_id($new_widget_id);

            require_once( ABSPATH . 'wp-admin/includes/widgets.php' );
            $new_widget_number = next_widget_id_number( $id_base );
            $widget_instances = get_option('widget_' . $id_base, array());
//            if($wp_registered_widget_controls[$new_widget_id]
//                && is_callable( $wp_registered_widget_controls[$new_widget_id]['callback'] )) {
            if(isset($widget_instances[$widget_number])) {
                $widget_instances[$new_widget_number] = $widget_instances[$widget_number];
//                $this -> save_widget($id_base);
                $saved = update_option('widget_' . $id_base, $widget_instances);
            }
//            $this->add_widget_instance( $id_base, $next_id  );
            $new_widget_id = $this->add_widget_to_sidebar( $id_base, $new_widget_number );

//            var_dump($new_widget_id);
//            var_dump($new_widget_number);
//            die();


            global $wp_registered_widget_controls;

            if (!$wp_registered_widget_controls[$new_widget_id]) {
                $callback       = TemplazaFramework_Widget_Shortcode_Helper::get_widget_by_id_base($id_base);
//                var_dump($callback -> _get_form_callback()); die();
//                $callback -> _register_one($new_widget_number);
                wp_register_widget_control($new_widget_id, $title, $callback -> _get_form_callback(),
                    array('params' => array('number' => $new_widget_number)));
//                wp_register_widget_control($new_widget_id, $title, array($callback, 'form_callback'),
//                    array('params' => array('number' => $new_widget_number)));
            }

//            // Save Widget
//            $widget_instances = get_option('widget_' . $id_base, array());
////            if($wp_registered_widget_controls[$new_widget_id]
////                && is_callable( $wp_registered_widget_controls[$new_widget_id]['callback'] )) {
//            if(isset($widget_instances[$widget_number])) {
//                $widget_instances[$new_widget_number] = $widget_instances[$widget_number];
////                $this -> save_widget($id_base);
//                $saved = update_option('widget_' . $id_base, $widget_instances);
//            }


//            if (!$wp_registered_widgets[$new_widget_id]) {
//                $register_callback       = TemplazaFramework_Widget_Shortcode_Helper::get_widget_by_id_base($id_base);
//                wp_register_sidebar_widget($new_widget_id, $title, array($register_callback, 'display_callback'),
//                    array('params' => array('number' => $new_widget_number)));
//            }

//            global $wp_registered_widget_updates;
//
//            $control = $wp_registered_widget_updates[$id_base];
//
//            var_dump($control); die();


//            $saved  = $this -> save_widget($id_base);
//            require_once( ABSPATH . 'wp-admin/includes/widgets.php' );
//            $next_number = next_widget_id_number( $id_base );

//            $saved  = true;
//            $new_widget_id  = 'text-'.($widget_number+1);
////            $new_widget_id  = 'text-'.$number;
            if ($saved ) {
                $this->send_json_success( array(
                    'new_widget_id' => $new_widget_id,
//                    'next_number' => $next_number,
                    'message' => sprintf( __("Saved %s", 'templaza-framework'), $id_base )
                ) );
            }else{
                $this -> send_json_error(
                    array(
                        'new_widget_id' => $new_widget_id,
//                        'next_number' => $next_number,
                        'message' => sprintf( __("Failed to clone %s", 'templaza-framework'), $id_base )
                    )
                );
            }
        }

        /**
         * Deletes a widget
         *
         * @since 1.0
         */
        public function ajax_widget_delete() {

            check_ajax_referer( 'templaza_shortcode_widget_delete' );

            $widget_id = sanitize_text_field( $_POST['widget_id'] );

            $deleted = $this->delete_widget( $widget_id );
//
//            if ( $deleted ) {
//                $this->send_json_success( sprintf( __( "Deleted %s", "megamenu"), $widget_id ) );
//            } else {
//                $this->send_json_error( sprintf( __( "Failed to delete %s", "megamenu"), $widget_id ) );
//            }

        }

        /**
         * Save a widget
         *
         * @since 1.0
         */
        public function ajax_widget_save() {
            $widget_id = sanitize_text_field( $_POST['widget-id'] );
            $id_base = sanitize_text_field( $_POST['id_base'] );

            check_ajax_referer( 'templaza_shortcode_widget_save_' . $widget_id );

            $saved = $this->save_widget( $id_base );

            if ( $saved ) {
                $this->send_json_success( sprintf( __("Saved %s", 'templaza-framework'), $id_base ) );
            }else{
                $this -> send_json_error(sprintf( __("Failed to save %s", 'templaza-framework'), $id_base ));
            }
            wp_die();
        }

        public function _add_widget( $id_base, $title ) {

            require_once( ABSPATH . 'wp-admin/includes/widgets.php' );

            $next_id = next_widget_id_number( $id_base );

            $this->add_widget_instance( $id_base, $next_id  );

            $widget_id = $this->add_widget_to_sidebar( $id_base, $next_id );

            return $widget_id;

        }

        public function show_widget_ajax( $widget_id, $id_base, $title) {
            if(isset($_POST['action'])){
                $action = $_POST['action'];
                if($action == 'templaza_shortcode_widget_edit'){
                    check_ajax_referer( 'templaza_shortcode_widget_edit' );
                }else{
                    check_ajax_referer( 'templaza_shortcode_widget' );
                }
            }

            global $wp_registered_widget_controls;

            $control = $wp_registered_widget_controls[ $widget_id ];

            $widget_number = TemplazaFramework_Widget_Shortcode_Helper::get_widget_number_for_widget_id( $widget_id );

            $nonce = wp_create_nonce('templaza_shortcode_widget_save_' . $widget_id);

            if ( ob_get_contents() ) ob_clean(); // remove any warnings or output from other plugins which may corrupt the response
            ?>
            <div class="widget mt-3" title="<?php echo esc_attr( $title ); ?>" data-columns="2" id="<?php
            echo $widget_id; ?>" data-type="widget" data-id="<?php echo $widget_id; ?>">
                <div class="widget-top">
                    <div class="widget-title">
                        <h4><?php echo esc_html( $title ); ?></h4>
                    </div>
                </div>
                <div class="widget-inner widget-inside">
                    <form method='post'>
                        <input type="hidden" name="widget-id" class="widget-id" value="<?php echo esc_attr( $widget_id ); ?>" />
                        <input type='hidden' name="action" value="templaza_shortcode_widget_save" />
                        <input type='hidden' name="id_base" class="id_base" value="<?php echo esc_attr( $id_base ); ?>" />
                        <input type='hidden' name="_wpnonce" value="<?php echo esc_attr( $nonce ) ?>" />
                        <div class='widget-content'>
                            <?php
                            if ( is_callable( $control['callback'] ) ) {
                                call_user_func_array( $control['callback'], $control['params'] );
                            }
                            ?>

<!--                            <div class="widget-controls">-->
<!--                                <a class="delete" href="#delete">--><?php //_e("Delete", 'templaza-framework'); ?><!--</a>-->
<!--                                 | <a class='close' href='#close'>--><?php //_e("Close", 'templaza-framework'); ?><!--</a>-->
<!--                            </div>-->

<!--                            --><?php
//                            submit_button( __( 'Save', 'templaza-framework' ), 'button-primary alignright', 'savewidget', false );
//                            ?>
                        </div>
                    </form>
                </div>
            </div>

            <?php
        }

        /**
         * Deletes a widget from WordPress
         *
         * @since 1.0
         * @param string $widget_id e.g. meta-3
         */
        public function delete_widget( $widget_id ) {

            $this->remove_widget_from_sidebar( $widget_id );
            $this->remove_widget_instance( $widget_id );

            do_action( "templaza-framework/shortcode/widget/after_widget_delete" );

            return true;

        }

        /**
         * Saves a widget. Calls the update callback on the widget.
         * The callback inspects the post values and updates all widget instances which match the base ID.
         *
         * @since 1.0
         * @param string $id_base - e.g. 'meta'
         * @return bool
         */
        public function save_widget( $id_base ) {
            global $wp_registered_widget_updates;

            $control = $wp_registered_widget_updates[$id_base];

            if ( is_callable( $control['callback'] ) ) {

                call_user_func_array( $control['callback'], $control['params'] );

                do_action( "templaza-framework/shortcode/widget/after_widget_save" );

                return true;
            }

            return false;

        }

        /**
         * Send JSON response.
         *
         * Remove any warnings or output from other plugins which may corrupt the response
         *
         * @param string $json
         * @since 1.8
         */
        public function send_json_success( $json ) {
            if ( ob_get_contents() ) ob_clean();

            wp_send_json_success( $json );
        }

        /**
         * Send JSON response.
         *
         * Remove any warnings or output from other plugins which may corrupt the response
         *
         * @param string $json
         * @since 1.8
         */
        public function send_json_error( $json ) {
            if ( ob_get_contents() ) ob_clean();

            wp_send_json_error( $json );
        }


        public function enqueue() {
            if (!wp_script_is('templaza-shortcode-widget-js')) {

                wp_register_script(
                    'templaza-shortcode-widget-js',
                    \TemPlazaFramework\Functions::get_my_url() . '/shortcodes/widget/widget.js',
                    array( 'jquery', 'jquery-ui-tabs', 'wp-util', 'redux-js', TEMPLAZA_FRAMEWORK_NAME.'__js'),
                    time(),
                    'all'
                );
                $action = 'templaza_shortcode_widget_edit';
                wp_localize_script('templaza-shortcode-widget-js', 'templaza_shortcode_widget',
                    array(
                        'post_type' => $this -> parent -> args['post_type'],
                        'admin_ajax_url' => admin_url('admin-ajax.php'),
                        'ajax_action' => 'templaza_shortcode_widget',
                        'ajax_nonce'=> esc_attr( wp_create_nonce('templaza_shortcode_widget')),
                        'edit_ajax_action' => $action,
                        'add_ajax_nonce'=> esc_attr( wp_create_nonce('templaza_shortcode_widget_add')),
                        'edit_ajax_nonce'=> esc_attr( wp_create_nonce($action)),
                        'delete_ajax_action' => 'templaza_shortcode_widget_delete',
                        'delete_ajax_nonce'=> esc_attr( wp_create_nonce('templaza_shortcode_widget_delete')),
                        'clone_ajax_action' => 'templaza_shortcode_widget_clone',
                        'clone_ajax_nonce'=> esc_attr( wp_create_nonce('templaza_shortcode_widget_clone')),
                        'save_ajax_action' => 'templaza_shortcode_widget_save',
                        'save_ajax_nonce'=> esc_attr( wp_create_nonce('templaza_shortcode_widget_save')),
                    )
                );

                wp_enqueue_script('templaza-shortcode-widget-js');
            }
        }

        /**
         * Adds a new widget instance of the specified base ID to the database.
         *
         * @since 1.0
         * @param string $id_base
         * @param int $next_id
         * @param int $menu_item_id
         */
        private function add_widget_instance( $id_base, $next_id ) {

            $current_widgets = get_option( 'widget_' . $id_base );

            $current_widgets[$next_id]  = array();

//            $current_widgets[ $next_id ] = array(
//                "mega_menu_columns" => 2,
//                "mega_menu_parent_menu_id" => $menu_item_id
//            );

//            if ( $is_grid_widget ) {
//                $current_widgets[ $next_id ] = array(
//                    "mega_menu_is_grid_widget" => 'true'
//                );
//            }

            update_option( 'widget_' . $id_base, $current_widgets );

        }

        /**
         * Adds a widget to the Mega Menu widget sidebar
         *
         * @since 1.0
         */
        private function add_widget_to_sidebar( $id_base, $next_id ) {

            $widget_id = $id_base . '-' . $next_id;

            $sidebar_widgets = $this->get_mega_menu_sidebar_widgets();

            $sidebar_widgets[] = $widget_id;

            $this->set_mega_menu_sidebar_widgets( $sidebar_widgets );

            do_action( "templaza-framework/shortcode/widget/after_widget_add" );

            return $widget_id;

        }

        /**
         * Returns an unfiltered array of all widgets in our sidebar
         *
         * @since 1.0
         * @return array
         */
        public function get_mega_menu_sidebar_widgets() {

            $sidebar_widgets = wp_get_sidebars_widgets();

            if ( ! isset( $sidebar_widgets[$this -> sidebar_registered] ) ) {
                return false;
            }

            return $sidebar_widgets[$this -> sidebar_registered];

        }

        /**
         * Sets the sidebar widgets
         *
         * @since 1.0
         */
        private function set_mega_menu_sidebar_widgets( $widgets ) {

            $sidebar_widgets = wp_get_sidebars_widgets();

            $sidebar_widgets[$this -> sidebar_registered] = $widgets;

            wp_set_sidebars_widgets( $sidebar_widgets );

        }
        /**
         * Removes a widget from the Mega Menu widget sidebar
         *
         * @since 1.0
         * @return string The widget that was removed
         */
        private function remove_widget_from_sidebar($widget_id) {

            $widgets = $this->get_mega_menu_sidebar_widgets();

            $new_mega_menu_widgets = array();

            foreach ( $widgets as $widget ) {

                if ( $widget != $widget_id )
                    $new_mega_menu_widgets[] = $widget;

            }

            $this->set_mega_menu_sidebar_widgets($new_mega_menu_widgets);

            return $widget_id;

        }

        /**
         * Removes a widget instance from the database
         *
         * @since 1.0
         * @param string $widget_id e.g. meta-3
         * @return bool. True if widget has been deleted.
         */
        private function remove_widget_instance( $widget_id ) {

            $id_base = TemplazaFramework_Widget_Shortcode_Helper::get_id_base_for_widget_id( $widget_id );
            $widget_number = TemplazaFramework_Widget_Shortcode_Helper::get_widget_number_for_widget_id( $widget_id );

            // add blank widget
            $current_widgets = get_option( 'widget_' . $id_base );

            if ( isset( $current_widgets[ $widget_number ] ) ) {

                unset( $current_widgets[ $widget_number ] );

                update_option( 'widget_' . $id_base, $current_widgets );

                return true;

            }

            return false;

        }

        /**
         * Clear the cache when the Mega Menu is updated.
         *
         * @since 1.0
         */
        public function clear_caches() {

            // https://wordpress.org/plugins/widget-output-cache/
            if ( function_exists( 'menu_output_cache_bump' ) ) {
                menu_output_cache_bump();
            }

            // https://wordpress.org/plugins/widget-output-cache/
            if ( function_exists( 'widget_output_cache_bump' ) ) {
                widget_output_cache_bump();
            }

        }
    }

}

?>