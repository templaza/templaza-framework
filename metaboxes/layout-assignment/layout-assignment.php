<?php

defined('TEMPLAZA_FRAMEWORK') or exit();

use TemPlazaFramework\Post_TypeFunctions;

if(!class_exists('TemplazaFramework_MetaBox_Layout_Assignment')){
    class TemplazaFramework_MetaBox_Layout_Assignment extends TemplazaFramework_MetaBox{

        public function register(){
            $metaboxes[] = array(
                'id'            => 'layout-assignment',
                'title'         => __( 'Default Layout', $this -> text_domain ),
                'post_types'    => array('templaza_header', 'templaza_footer'),
                'position'      => 'side', // normal, advanced, side
                'priority'      => 'default', // high, core, default, low - Priorities of placement
                'store_each'    => true, // Store value of each fields to each post meta
                'sections'      => array(
                    array(
                        'fields' => array(
                            array(
                                'id'       => '__home',
                                'type'     => 'switch',
                                'title'    => esc_html__('Default', $this -> text_domain),
//                                'subtitle' => __('This template style will be defined as the global default template style.', $this -> text_domain),
                            ),
                        ),
                    ),
                ),
            );
            $metaboxes[] = array(
                'id'            => 'header-layout-assign',
                'title'         => __( 'Template Assignment', $this -> text_domain ),
                'post_types'    => array('templaza_header'),
                'position'      => 'side', // normal, advanced, side
                'priority'      => 'default', // high, core, default, low - Priorities of placement
                'store_each'    => true, // Store value of each fields to each post meta
                'sections'      => array(
                    array(
                        'fields' => array(
                            array(
                                'id'       => '__h_template_assign',
                                'type'     => 'checkbox',
//                                'title'    => esc_html__('Default', $this -> text_domain),
//                                'subtitle' => __('This template style will be defined as the global default template style.', $this -> text_domain),
                                'data'     => 'callback',
                                'args'     => array('TemPlazaFramework\AdminHelper\Templaza_Style', 'get_items_by_slug'),
                            ),
                        ),
                    ),
                ),
            );
            $metaboxes[] = array(
                'id'            => 'footer-layout-assign',
                'title'         => __( 'Template Assignment', $this -> text_domain ),
                'post_types'    => 'templaza_footer',
                'position'      => 'side', // normal, advanced, side
                'priority'      => 'default', // high, core, default, low - Priorities of placement
                'store_each'    => true, // Store value of each fields to each post meta
                'sections'      => array(
                    array(
                        'fields' => array(
                            array(
                                'id'       => '__f_template_assign',
                                'type'     => 'checkbox',
//                                'title'    => esc_html__('Default', $this -> text_domain),
//                                'subtitle' => __('This template style will be defined as the global default template style.', $this -> text_domain),
                                'data'     => 'callback',
                                'args'     => array('TemPlazaFramework\AdminHelper\Templaza_Style', 'get_items_by_slug'),
                            ),
                        ),
                    ),
                ),
            );
            $metaboxes[] = array(
                'id'            => 'header-footer-assign',
                'title'         => __( 'Assignment', $this -> text_domain ),
                'post_types'    => 'templaza_style',
                'position'      => 'side', // normal, advanced, side
                'priority'      => 'default', // high, core, default, low - Priorities of placement
                'store_each'    => true, // Store value of each fields to each post meta
                'sections'      => array(
                    array(
                        'fields' => array(
                            array(
                                'id'       => '__header_assign',
                                'type'     => 'select',
                                'width'    => '100%',
                                'title'    => esc_html__('Header Assignment', $this -> text_domain),
//                                'subtitle' => __('This template style will be defined as the global default template style.', $this -> text_domain),
                                'data'     => 'callback',
                                'args'     => array('TemPlazaFramework\AdminHelper\Templaza_Header', 'get_items_by_slug'),
                            ),
                            array(
                                'id'       => '__footer_assign',
                                'type'     => 'select',
                                'width'    => '100%',
                                'title'    => esc_html__('Footer Assignment', $this -> text_domain),
//                                'subtitle' => __('This template style will be defined as the global default template style.', $this -> text_domain),
                                'data'     => 'callback',
                                'args'     => array('TemPlazaFramework\AdminHelper\Templaza_Footer', 'get_items_by_slug'),
                            ),
                        ),
                    ),
                ),
            );

            return $metaboxes;
        }

        public function hooks()
        {
            parent::hooks(); // TODO: Change the autogenerated stub

            if(is_user_logged_in() && is_admin()){
                add_filter('pre_trash_post', array($this, 'pre_trash_post'), 10, 2);
                add_filter('pre_delete_post', array($this, 'pre_delete_post'), 10, 3);
                add_filter('post_row_actions', array($this, 'post_row_actions'), 10, 2);

                $post_types = array('templaza_header', 'templaza_footer');
                $post_type  = $this -> post_type ->  get_current_screen_post_type();

                // Add header column to templaza style post type list
                if(method_exists($this,'post_type_templaza_style_table_head')) {
                    add_filter('manage_templaza_style_posts_columns', array($this, 'post_type_templaza_style_table_head'));
                }

                // Add header column to post type list
                add_filter('manage_posts_columns', array($this, 'post_type_table_head'), 10, 2);
                add_filter('manage_posts_custom_column', array($this,'post_type_table_content'), 10, 2);

                if(in_array($post_type, $post_types)){

                    // Ordering column
                    if(method_exists($this,'post_type_table_sorting')) {
                        add_filter( 'manage_edit-'.$post_type.'_sortable_columns', array($this,
                            'post_type_table_sorting' ) );
                    }
                    // Order by column added
                    if(method_exists($this,'post_type_orderby')) {
                        add_filter( 'request', array($this, 'post_type_orderby' ) );
                    }
                    // Duplicate post action
                    add_action("templaza-framework/post-type/{$post_type}/duplicate", array($this,
                        'post_duplicate'), 11, 2);

                    // Set home for post type
                    add_action( 'admin_action_'.$post_type.'_set_default', array($this, 'post_type_set_default') );

                }
            }

        }

        /*
         * Set home meta box field to 0
         * @param string|int $new_post_id
         * @param string|int $post_id
         * */
        public function post_duplicate($new_post_id, $post_id){
            update_post_meta($new_post_id, '__home', 0);
        }

        /*
         * Add columns for header custom post type in list page
         * @param array $columns
         * */
        public function post_type_table_head($columns, $post_type){
            $pos            = array_search('title', array_keys($columns)) + 1;

            $new_columns    = array();
            if($post_type == 'templaza_header' || $post_type == 'templaza_footer'){
                $new_columns    = array(
                    '__home' => esc_html__('Default', $this -> text_domain)
                );
                if($post_type == 'templaza_header'){
                    $new_columns['__h_template_assign'] = esc_html__('Template Assigned', $this -> text_domain);
                }elseif($post_type == 'templaza_footer'){
                    $new_columns['__f_template_assign'] = esc_html__('Template Assigned', $this -> text_domain);
                }
            }elseif($post_type == 'templaza_style'){
                $new_columns    = array(
                    '__header_assign' => esc_html__('Header Assigned', $this -> text_domain)
                );
            }

            if(!empty($new_columns)) {
                return array_merge(
                    array_slice($columns, 0, $pos),
                    $new_columns,
                    array_slice($columns, $pos)
                );
            }else{
                return $columns;
            }
        }

        /*
         * Add columns for content custom post type in list page
         * @param string $column_name
         * @param string $post_id
         * */
        public function post_type_table_content($column_name, $post_id ){
            global $post_type;
            switch($column_name){
                case '__home':
                    $home   = get_post_meta($post_id,'__home', true);
                    $action = $post_type.'_set_default';
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
                    break;
                case '__h_template_assign':
                case '__f_template_assign':
                    $assigned   = get_post_meta($post_id, $column_name);
                    $assigned   = array_filter($assigned);

                    if(!empty($assigned)) {
                        $args = array(
                            'post_type' => 'templaza_style',
                            'posts_per_page' => -1,
                            'post_name__in' => $assigned
                        );
                        $temp_assigned  = get_posts($args);

                        if(!empty($temp_assigned) && !is_wp_error($temp_assigned)){
                            $content    = '';
                            foreach ($temp_assigned as $i => $temp){
                                if($i > 0) {
                                    $content .= ', ';
                                }
                                $content    .= '<a href="post.php?action=edit&post='
                                    .$temp -> ID.'" target="_blank">'.$temp -> post_title.'</a>';
                            }
                            echo $content;
                        }
                    }
                    break;
                case '__header_assign':
                case '__footer_assign':
                    // Get post by post id
                    $post   = get_post($post_id);

                    $meta_key           = ($column_name == '__header_assign')?'__h_template_assign':'__f_template_assign';
                    $post_type_assigned = ($column_name == '__header_assign')?'templaza_header':'templaza_footer';

                    if(!empty($post) && !is_wp_error($post)) {
                        $posts_with_meta    = get_posts(
                            array(
                                'post_type'     => $post_type_assigned,
                                'numberposts'   => -1,
                                'meta_query'    => array(
                                    array(
                                        'key'   => $meta_key,
                                        'value' => $post -> post_name
                                    )
                                )
                            )
                        );
                        if(!empty($posts_with_meta) && !is_wp_error($posts_with_meta)) {
                            $content    = '';
                            foreach ($posts_with_meta as $i => $temp){
                                if($i > 0) {
                                    $content .= ', ';
                                }
                                $content    .= '<a href="post.php?action=edit&post='
                                    .$temp -> ID.'" target="_blank">'.$temp -> post_title.'</a>';
                            }
                            echo $content;
                        }
                    }
                    break;
            }
        }

        /*
         * Add columns for header custom post type in list page
         * @param array $columns
         * */
        public function post_type_templaza_style_table_head($columns){

            $pos            = array_search('title', array_keys($columns)) + 1;
            $new_columns    = array(
                '__header_assign' => esc_html__('Header Assigned', $this -> text_domain),
                '__footer_assign' => esc_html__('Footer Assigned', $this -> text_domain)
            );

            return array_merge(
                array_slice($columns, 0, $pos),
                $new_columns,
                array_slice($columns, $pos)
            );
        }
        /*
         * Add columns for content custom post type in list page
         * @param string $column_name
         * @param string $post_id
         * */
        public function post_type_templaza_style_table_content($column_name, $post_id ){
            if($column_name == '__header_assign'){
                // Get post by post id
                $post   = get_post($post_id);

                if(!empty($post) && !is_wp_error($post)) {
                    $posts_with_meta    = get_posts(
                        array(
                            'post_type'     => 'templaza_header',
                            'numberposts'   => -1,
                            'meta_query'    => array(
                                array(
                                    'key'   => '__h_template_assign',
                                    'value' => $post -> post_name
                                )
                            )
                        )
                    );
                    if(!empty($posts_with_meta) && !is_wp_error($posts_with_meta)) {
                        $content    = '';
                        foreach ($posts_with_meta as $i => $temp){
                            if($i > 0) {
                                $content .= ', ';
                            }
                            $content    .= '<a href="post.php?action=edit&post='
                                .$temp -> ID.'" target="_blank">'.$temp -> post_title.'</a>';
                        }
                        echo $content;
                    }
                }
            }
        }

        /*
         * Sorting columns for custom post type in list page
         * @param array $columns
         * */
        public function post_type_table_sorting($columns ){
            $columns['__home'] = '__home';
            return $columns;
        }

        /*
         * Order by query for custom post type in list page
         * @param array $vars
         * */
        public function post_type_orderby( $vars ) {
            if ( isset( $vars['orderby'] ) && '__home' == $vars['orderby'] ) {
                $vars = array_merge( $vars, array(
                    'meta_key' => '__home',
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
            $post_type      = $this -> post_type -> get_current_screen_post_type();
            $nonce_name     = isset( $_GET['_wpnonce'] ) ? $_GET['_wpnonce'] : '';
            $nonce_action   = $post_type.'_set_default';

            // Check if nonce is valid.
            if ( ! wp_verify_nonce( $nonce_name, $nonce_action ) ) {
                wp_die('Security issue occure, Please try again!.');
            }
            $post_id    = isset($_GET['post'])?$_GET['post']:0;
            if(!$post_id){
                wp_die(__('Post or Page creation failed, could not find original post:', $this -> text_domain) . $post_id);
            }

            $this -> _disable_home_without_post_id($post_id);

            // Set post by post_id to home
            update_post_meta($post_id, '__home', 1);

            wp_redirect(admin_url('edit.php?post_type='.$post_type));
            exit;
        }

        public function save_meta_box($post_id, $post)
        {
            parent::save_meta_box($post_id, $post);

            global $post_type;

            $mt_key  = $this -> prefix.'layout-assignment';

            if (in_array($post_type, array('templaza_header', 'templaza_footer')) && isset( $_POST[$mt_key] ) ) {
                $options    = $_POST[$mt_key];
                $home       = isset($options['__home'])?(int) $options['__home']:0;

                if($home){
                    $this -> _disable_home_without_post_id($post_id);
                }else{
                    // Check home exists
                    $meta_key   = ($post_type == 'templaza_header' || $post_type == 'templaza_footer')?'__home':'';
                    $args       = array(
                        'post_type'     => $post_type,
                        'numberposts'   => 1,
                        'meta_query'    => array(
                            'header_theme' => array(
                                'key'   => '_'.$post_type.'__theme',
                                'value' => get_template()
                            ),
                            'header_home' => array(
                                'key'   => $meta_key,
                                'value' => '1'
                            ),
                        )
                    );

                    $post_exists   = get_posts($args);

                    if(!is_wp_error($post_exists) && empty($post_exists)){
                        // Set post by post_id to home
                        update_post_meta($post_id, '__home', 1);
                    }
                }
            }
        }

        /**
         * Prepare field value to load data
         * @param string|int|array $value An optional of field value
         * @param string $name An optional of field name
         * @param object $post An optional of post
         * @return int|string|array
         * */
        public function prepare_field_value($value, $name, $post){
            if((($post -> post_type == 'templaza_header' &&
                $name == '__h_template_assign') || ($post -> post_type == 'templaza_footer' &&
                    $name == '__f_template_assign')) && !empty($value)){
                $value  = get_post_meta($post -> ID, $name);
                $new_value  = array();
                foreach ($value as $key){
                    $new_value[$key]    = 1;
                }
                if(!empty($new_value)){
                    return $new_value;
                }
            }
            if($post -> post_type == 'templaza_style' && ($name == '__header_assign' || $name == '__footer_assign')){
                $ptype      = ($name == '__header_assign')?'templaza_header':'templaza_footer';
                $meta_key   = ($name == '__header_assign')?'__h_template_assign':'__f_template_assign';
                // Get template assign
                $post_with_meta = get_posts(
                    array(
                        'post_type'     => $ptype,
                        'numberposts'   => -1,
                        'meta_query'    => array(
                            array(
                                'key'   => $meta_key,
                                'value' => $post -> post_name
                            )
                        )
                    )
                );
                if(!empty($post_with_meta) && !is_wp_error($post_with_meta)){
                    $value  = $post_with_meta[0] -> post_name;
                    return $value;
                }
            }

            return $value;
        }

        /**
         * Prepare field value update when save field value
         * @param string|int|array $value An optional of field value
         * @param string $name An optional of field name
         * @param int $post_id An optional of post
         * @return int|string|array
         * */
        public function prepare_field_value_update($value, $name, $post_id, $post){
            if((($post -> post_type = 'templaza_header' && $name == '__h_template_assign') ||
                    ($post -> post_type = 'templaza_footer' && $name == '__f_template_assign')) && !empty($value)){
                $value  = array_filter($value);
                if(!empty($value)) {
                    $value = array_keys($value);
                }
            }

            return $value;
        }

        /**
         * Before update field value, next the item
         * @param bool $result An optional of field value
         * @param string|int|array $value An optional of field value
         * @param string $name An optional of field name
         * @param int $post_id An optional of post
         * @param object $post An optional of post
         * @return bool
         * */
        public function before_update_field_value($result, $value, $name, $post_id, $post){
            global $post_type, $wpdb;

            if(($post -> post_type == 'templaza_style' || $post_type == 'templaza_style') &&
                ($name == '__header_assign' || $name == '__footer_assign')){

                // Remove other
                $meta_key       = ($name == '__header_assign')?'__h_template_assign':'__f_template_assign';
                $assign_ptype   = ($name == '__header_assign')?'templaza_header':'templaza_footer';

                $assign_post    = get_posts( array(
                    'name'        => $value,
                    'post_type'   => $assign_ptype,
                    'numberposts' => 1
                ));

                $query  = 'DELETE pm';
                $query .= ' FROM ' . $wpdb->postmeta.' AS pm';
                $query .= ' INNER JOIN '.$wpdb -> posts.' AS p ON p.ID = pm.post_id AND p.post_type="'.$assign_ptype.'"';
                $query .= ' WHERE (pm.meta_key="' . $meta_key . '"';
                $query .= ' AND pm.meta_value ="' . $post -> post_name . '")';
                $query .= ' AND (pm.meta_key="_' . $assign_ptype . '__theme" AND pm.meta_value ="'.get_template().'")';

                if(!empty($assign_post) && !is_wp_error($assign_post)) {
                    $query .= ' AND pm.post_id <> ' . $assign_post[0] -> ID;
                }

                $wpdb ->query($query);

                if(!empty($value) && !empty($assign_post) && !is_wp_error($assign_post)) {
                    $old_meta_value = get_post_meta($assign_post[0] -> ID, $meta_key, true);
                    $meta_exists    = '';
                    if(!empty($old_meta_value) && !is_wp_error($old_meta_value) && is_array($old_meta_value)){
                        $key    = array_search($post -> post_name, $old_meta_value);
                        $meta_exists   = $key != false?$old_meta_value[$key]:'';
                    }
                    if(!empty($meta_exists)){
                        // Update post meta
                        update_post_meta($assign_post[0] -> ID, $meta_key, $post -> post_name, $meta_exists);
                    }else {
                        add_post_meta($assign_post[0] -> ID, $meta_key, $post -> post_name);
                    }
                }

                $result = true;
                return $result;
            }elseif((($post -> post_type = 'templaza_header' && $name == '__h_template_assign') ||
                ($post -> post_type = 'templaza_footer' && $name == '__f_template_assign')) && !empty($value)){

                // Get current post meta
                $old_value = get_post_meta($post_id, $name);

                // Add post meta
                foreach ($value as $val) {
                    if (!in_array($val, $old_value)) {
                        add_post_meta($post_id, $name, $val);
                    }
                }

                // Remove value without in value
                $rvalue = array_diff($old_value, $value);
                if (count($rvalue)) {
                    foreach ($rvalue as $val) {
                        delete_post_meta($post_id, $name, $val);
                    }
                }

                // Remove value without post id
                $query  = 'DELETE pm';
                $query .= ' FROM ' . $wpdb->postmeta.' AS pm';
                $query .= ' INNER JOIN '.$wpdb -> posts.' AS p ON p.ID = pm.post_id AND p.post_type="'.$post_type.'"';
                $query .= ' WHERE (pm.meta_key="' . $name . '"';
                $query .= ' AND pm.meta_value IN("' . implode('","',$value ). '"))';

                $sub_query = '   SELECT pm2.post_id';
                $sub_query .= '   FROM (SELECT * FROM '.$wpdb ->postmeta.') AS pm2';
                $sub_query .= '   INNER JOIN '.$wpdb ->posts.' AS p2 ON p2.ID = pm2.post_id AND p2.post_type="'.$post_type.'"';
                $sub_query .= '   WHERE (pm2.meta_key="_' . $post_type . '__theme" AND pm2.meta_value ="'.get_template().'")';
                $sub_query .= '   AND pm2.post_id <> '.$post_id;
                $query .= ' AND pm.post_id IN('.$sub_query.')';

                $wpdb ->query($query);

                $result = true;
                return $result;
            }

            return $result;
        }

        /**
         * Deny trash post is home
         * @param bool|null $trash Whether to go forward with trashing.
         * @param WP_Post   $post  Post object.
         * @return bool|null
         * */
        public function pre_trash_post($trash, $post){
            if(!empty($post) && in_array($post -> post_type, array('templaza_header', 'templaza_footer'))){
                $is_home    = (bool) get_post_meta($post -> ID, '__home', true);
                if($is_home){
                    $trash  = false;
                }
            }

            return $trash;
        }

        /**
         * Deny delete post is home
         * @param bool|null $trash Whether to go forward with trashing.
         * @param WP_Post   $post  Post object.
         * @return bool|null
         * */
        public function pre_delete_post($delete, $post){
            if(!empty($post) && in_array($post -> post_type, array('templaza_header', 'templaza_footer'))){
                $is_home    = (bool) get_post_meta($post -> ID, '__home', true);
                if($is_home){
                    $delete  = false;
                }
            }

            return $delete;
        }

        /**
         * Deny trash action with field is protected
         * @param string[] $actions An array of row action links. Defaults are
         *                          'Edit', 'Quick Edit', 'Restore', 'Trash',
         *                          'Delete Permanently', 'Preview', and 'View'.
         * @param WP_Post  $post    The post object.
         * @return bool|null
         * */
        public function post_row_actions($actions, $post){
            if ( isset($actions['trash']) && !empty($post)
                && in_array($post -> post_type, array('templaza_header', 'templaza_footer'))) {
                $is_home    = (bool) get_post_meta($post -> ID, '__home', true);
                if($is_home){
                    unset($actions['trash']);
                }
            }

            return $actions;
        }

        /*
         * Disable home for all posts without post_id
         * @param string|int $post_id
         * */
        protected function _disable_home_without_post_id($post_id){
            global $wpdb;

            $post_type  = get_post_type($post_id);

            $query  = 'UPDATE '.$wpdb -> postmeta.' AS pm';
            $query .= ' INNER JOIN '.$wpdb -> posts.' AS p ON p.ID = pm.post_id AND p.post_type="'.$post_type.'"';
            $query .= ' SET pm.meta_value=0';
            $query .= ' WHERE (pm.meta_key="__home" AND pm.post_id <> '.$post_id.')';

            $sub_query = '   SELECT pm2.post_id';
            $sub_query .= '   FROM (SELECT * FROM '.$wpdb ->postmeta.') AS pm2';
            $sub_query .= '   INNER JOIN '.$wpdb ->posts.' AS p2 ON p2.ID = pm2.post_id AND p2.post_type="'.$post_type.'"';
            $sub_query .= '   WHERE (pm2.meta_key="_' . $post_type . '__theme" AND pm2.meta_value ="'.get_template().'")';
            $sub_query .= '   AND pm2.post_id <> '.$post_id;
            $query .= ' AND pm.post_id IN('.$sub_query.')';

            $wpdb ->query($query);
        }
    }
}