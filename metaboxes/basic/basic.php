<?php

defined('TEMPLAZA_FRAMEWORK') or exit();

use TemPlazaFramework\Post_TypeFunctions;

if(!class_exists('TemplazaFramework_MetaBox_Basic')){
    class TemplazaFramework_MetaBox_Basic extends TemplazaFramework_MetaBox{

        public function register(){
            // Get all post types without templaza_style
            $tzfrm_post_types  = Post_TypeFunctions::getPostTypes();
            $metaboxes[] = array(
                'id'            => 'templaza-options',
                'title'         => __( 'Templaza Options', 'templaza-framework' ),
                'post_types'    => $tzfrm_post_types,
                'position'      => 'side', // normal, advanced, side
                'priority'      => 'default', // high, core, default, low - Priorities of placement
                'store_each'    => true, // Store value of each fields to each post meta
                'sections'      => array(
                    array(
                        'fields' => array(
                            array(
                                'id'       => 'templaza-style',
                                'type'     => 'select',
                                'data'     => 'callback',
                                'width'    => '100%',
                                'title'    => esc_html__('Templaza Style', 'templaza-framework'),
                                'subtitle' => __('This template style will be defined as the global default template style.', 'templaza-framework'),
                                'args'     => array('TemPlazaFramework\Functions', 'get_templaza_style_by_slug'),
                            ),
                        ),
                    ),
                ),
            );

            return $metaboxes;
        }

        public function get_select_data(){
               $args     = array(
                'post_type'      => 'templaza_style',
                'posts_per_page' => -1,
                'orderby'        => 'title',
                'order'          => 'ASC',
                'meta_key'       => '_templaza_style_theme',
                'meta_value'     => basename(get_template_directory()),
            );

           $tz_posts = \get_posts($args);
           if($tz_posts && count($tz_posts)){
               $data    = array();
               foreach($tz_posts as $_tz_post){
                   $data[$_tz_post -> post_name] = $_tz_post -> post_title;
               }
           }
           return $data;
        }

        public function hooks()
        {
            parent::hooks(); // TODO: Change the autogenerated stub

            add_filter("redux/options/{$this->prefix}templaza-options/wordpress_data/translate/post_type_value",
                array($this, 'meta_box_basic_post_type_value'), 10, 2);


            $post_type  = $this -> post_type -> get_post_type();

            if(post_type_exists($post_type) && $this -> post_type ->  get_current_screen_post_type() == $post_type){
                // Add header column to post type list
                if(method_exists($this,'post_type_table_head')) {
                    add_filter('manage_'.$post_type.'_posts_columns', array($this, 'post_type_table_head'));
                }

                // Ordering column
                if(method_exists($this,'post_type_table_sorting')) {
                    add_filter( 'manage_edit-'.$post_type.'_sortable_columns', array($this, 'post_type_table_sorting' ) );
                }
                // Order by column added
                if(method_exists($this,'post_type_orderby')) {
                    add_filter( 'request', array($this, 'post_type_orderby' ) );
                }
                // Duplicate post action
                add_action("templaza-framework/post-type/{$post_type}/duplicate", array($this, 'post_duplicate'), 11, 2);
                // Set home for post type
                add_action( 'admin_action_'.$post_type.'_set_default', array($this, 'post_type_set_default') );

            }

        }

        /*
         * Set home meta box field to 0
         * @param string|int $new_post_id
         * @param string|int $post_id
         * */
        public function post_duplicate($new_post_id, $post_id){
            update_post_meta($new_post_id, 'home', 0);
        }

        /*
         * Add columns for header custom post type in list page
         * @param array $columns
         * */
        public function post_type_table_head($columns){
            $columns = array(
                "cb"                 => "<input type=\"checkbox\" />",
                "title"              => esc_html__("Title", 'templaza-framework'),
                "date"               => esc_html__("Date",'templaza-framework')
            );
            return $columns;
        }

        /*
         * Add columns for content custom post type in list page
         * @param string $column_name
         * @param string $post_id
         * */
        public function post_type_table_content($column_name, $post_id ){
            if ($column_name == 'home') {
                $home   = get_post_meta($post_id,'home', true);
                $action = $this -> post_type -> get_post_type().'_set_default';
                $nonce  = wp_create_nonce( $action );
                $href   = 'admin.php?action='.$action.'&post='.$post_id.'&_wpnonce='
                    .$nonce.'" class="button button-micro'.($home?' disabled':'');
                if($home){
                    $href   = 'javascript:void();';
                }
                echo '<a href="'.$href.'" class="button button-micro'.($home?' disabled':'').'"'.($home?' disabled':'').'>';
                if($home){
                    echo '<span class="dashicons dashicons-star-filled featured"></span>';
                }else{
                    echo '<span class="dashicons dashicons-star-empty"></span>';
                }
                echo '</a>';
            }
        }

        /*
         * Sorting columns for custom post type in list page
         * @param array $columns
         * */
        public function post_type_table_sorting($columns ){
            $columns['home'] = 'home';
            return $columns;
        }

        /*
         * Order by query for custom post type in list page
         * @param array $vars
         * */
        public function post_type_orderby( $vars ) {
            if ( isset( $vars['orderby'] ) && 'home' == $vars['orderby'] ) {
                $vars = array_merge( $vars, array(
                    'meta_key' => 'home',
                    'orderby' => 'meta_value'
                ) );
            }

            return $vars;
        }

        /*
         * Reset value of select field with data is post
         * */
        public function meta_box_basic_post_type_value($value, $post_type){
            if(is_array($value)){
                return array();
            }else{
                return '';
            }
        }

        /*
         * Action set home for custom post type in list page
         * */
        public function post_type_set_default(){
            $post_type      = $this -> post_type -> get_post_type();
            $nonce_name     = isset( $_GET['_wpnonce'] ) ? $_GET['_wpnonce'] : '';
            $nonce_action   = $post_type.'_set_default';

            // Check if nonce is valid.
            if ( ! wp_verify_nonce( $nonce_name, $nonce_action ) ) {
                wp_die('Security issue occure, Please try again!.');
            }
            $post_id    = isset($_GET['post'])?$_GET['post']:0;
            if(!$post_id){
                wp_die(__('Post or Page creation failed, could not find original post:', 'templaza-framework') . $post_id);
            }

            $this -> _disable_home_without_post_id($post_id);

            // Set post by post_id to home
            update_post_meta($post_id, 'home', 1);

            wp_redirect(admin_url('edit.php?post_type='.$post_type));
            exit;
        }

        public function save_meta_box($post_id, $post)
        {
            parent::save_meta_box($post_id, $post);

            $mt_key  = $this -> prefix.'basic';
            if ( isset( $_POST[$mt_key] ) ) {
                $options    = $_POST[$mt_key];
                if(isset($options['home']) && $options['home'] == 1){
                    $this -> _disable_home_without_post_id($post_id);
                }
            }
        }

        /*
         * Disable home for all posts without post_id
         * @param string|int $post_id
         * */
        protected function _disable_home_without_post_id($post_id){
            global $wpdb;

            $subQuery   = 'SELECT post_id FROM (';
            $subQuery  .= 'SELECT m.post_id FROM '.$wpdb -> prefix.'postmeta AS m ';
            $subQuery  .= 'INNER JOIN '.$wpdb -> prefix.'posts AS p ON p.ID = m.post_id AND m.meta_key="_'.
                $this -> post_type -> get_post_type().'_theme" AND m.meta_value="'.basename(get_template_directory()).'" ';
            $subQuery  .= 'WHERE p.ID <> '.$post_id;
            $subQuery  .= ' AND m.meta_key="_'.$this -> post_type -> get_post_type()
                .'_theme" AND m.meta_value="'.basename(get_template_directory()).'" ';
            $subQuery  .= ') AS post_id';

            $query  = 'UPDATE '.$wpdb -> prefix.'postmeta SET meta_value=0 ';
            $query .= 'WHERE meta_key="home" AND post_id IN('.$subQuery.')';
            $wpdb ->query($query);
        }
    }
}