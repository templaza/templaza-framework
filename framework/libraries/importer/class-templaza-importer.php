<?php

defined( 'ABSPATH' ) || exit;

if( !class_exists( 'WP_Import')  && file_exists(__DIR__.'/wordpress-importer/class-wp-import.php')) {

    /** Functions missing in older WordPress versions. */
    if ( ! function_exists( 'wp_slash_strings_only' ) ) {
        require_once __DIR__ . '/wordpress-importer/compat.php';
    }

    /** WXR_Parser class */
    if(!class_exists('WXR_Parser')) {
        require_once __DIR__ . '/wordpress-importer/parsers/class-wxr-parser.php';
    }

    /** WXR_Parser_SimpleXML class */
    if(!class_exists('WXR_Parser_SimpleXML')) {
        require_once __DIR__ . '/wordpress-importer/parsers/class-wxr-parser-simplexml.php';
    }

    /** WXR_Parser_XML class */
    if(!class_exists('WXR_Parser_XML')) {
        require_once __DIR__ . '/wordpress-importer/parsers/class-wxr-parser-xml.php';
    }

    /** WXR_Parser_Regex class */
    if(!class_exists('WXR_Parser_Regex')) {
        require_once __DIR__ . '/wordpress-importer/parsers/class-wxr-parser-regex.php';
    }

    if ( ! class_exists( 'WP_Importer' ) ) {
        $class_wp_importer = ABSPATH . 'wp-admin/includes/class-wp-importer.php';
        if ( file_exists( $class_wp_importer ) )
            require $class_wp_importer;
    }

    require_once __DIR__.'/wordpress-importer/class-wp-import.php';
}

if( class_exists( 'WP_Import') ) {
    class TemplazaFramework_Importer extends WP_Import {

        var $processed_parent_menu_items = array();
        protected $process_menu_items_alias = array();

        var $fetch_remote_file;

        public function __construct($options = array())
        {
            $options = wp_parse_args( $options, array(
                'fetch_attachments'         => true,
                'fetch_remote_file'         => false,
            ) );

            if(count($options)){
                foreach($options as $name => $option){
                    $this -> {$name}    = $option;
                }
            }

            // Constructor hook to load this class to use in others
            do_action('templaza-framework/import/constructor', $this);
        }

        /**
         * Get value of this class variables
         * @param string $name An optional of variable name
         * @return void|bool
         * */
        public function get($name){
            if(isset($this -> {$name})){
                return $this -> {$name};
            }
            return false;
        }

        function process_posts() {
            do_action('templaza-framework/import/before_import_posts', $this);
            parent::process_posts();
            do_action('templaza-framework/import/after_import_posts', $this);
        }

        function process_terms() {
            do_action('templaza-framework/import/before_import_terms', $this);
            parent::process_terms();
            do_action('templaza-framework/import/after_import_terms', $this);
        }
        protected function process_termmeta($term, $term_id) {
            do_action('templaza-framework/import/before_import_termmeta', $this);
            parent::process_termmeta($term, $term_id);
            do_action('templaza-framework/import/after_import_termmeta', $this);
        }

        /**
         * Attempt to create a new menu item from import data
         *
         * Fails for draft, orphaned menu items and those without an associated nav_menu
         * or an invalid nav_menu term. If the post type or term object which the menu item
         * represents doesn't exist then the menu item will not be imported (waits until the
         * end of the import to retry again before discarding).
         *
         * @param array $item Menu item details from WXR file
         */
        function process_menu_item( $item ) {
            parent::process_menu_item($item);

            if(!isset($item['post_id']) || empty($item['post_id'])) {
                return;
            }
            $post_id = intval($item['post_id']);

            if(!isset($this -> processed_menu_items[$post_id]) || empty($this -> processed_menu_items[$post_id])){
                return;
            }

            $id = $this->processed_menu_items[$post_id];
            $this -> process_menu_items_alias[$item['post_name']]   = $id;

            foreach ( $item['postmeta'] as $meta ) {
                ${$meta['key']} = $meta['value'];
            }

            if(isset($_menu_item_menu_item_parent) && $_menu_item_menu_item_parent
                && isset($this->processed_menu_items[$_menu_item_menu_item_parent])) {
                $__parent_id    = $this->processed_menu_items[$_menu_item_menu_item_parent];

                $__parent_layout    = get_post_meta($__parent_id, '_templaza_megamenu_layout', true);

                if(!empty($__parent_layout)) {

                    if (!isset($this->processed_parent_menu_items[$__parent_id])) {
                        $this->processed_parent_menu_items[$__parent_id] = array();
                    }

                    $index  = 0;
                    $this->process_menu_layout($__parent_layout, $id, intval($item['post_id']),
                        $this->processed_parent_menu_items[$__parent_id], $index);

                    update_post_meta($__parent_id, '_templaza_megamenu_layout', $__parent_layout);
                }

            }else{
                // Check missing menu id
                $missing_ids    = wp_list_pluck($this -> missing_menu_items, 'post_id');

                if(in_array($post_id, $missing_ids) && !empty($_templaza_megamenu_layout)){
                    $__menu_element    = unserialize($_templaza_megamenu_layout);

                    if(!empty($__menu_element)) {
                        $index  = 0;
                        $this->process_menu_layout($__menu_element, $id, intval($item['post_id']),
                            $this->processed_parent_menu_items[$id], $index);

                        $_templaza_megamenu_layout  = $__menu_element;
                    }
                }
            }

            // Update post meta for menu
            if(isset($_templaza_megamenu_layout) && !empty($_templaza_megamenu_layout)){
                if(is_string($_templaza_megamenu_layout)) {
                    $_templaza_megamenu_layout = unserialize($_templaza_megamenu_layout);
                }
                update_post_meta($id, '_templaza_megamenu_layout', $_templaza_megamenu_layout);
            }
            if(isset($_templaza_megamenu_settings) && !empty($_templaza_megamenu_settings)){
                if(is_string($_templaza_megamenu_settings)) {
                    $_templaza_megamenu_settings = unserialize($_templaza_megamenu_settings);
                }
                update_post_meta($id, '_templaza_megamenu_settings', $_templaza_megamenu_settings);
            }
        }

        public function process_menu_layout(&$elements, $new_id, $import_id, &$__parent_layout, &$index = 0){

            foreach($elements as &$element){

                $subitems           = is_array($element) && isset($element['elements']) && !empty($element['elements']);

                $is_megamenu_item   = $element['type'] == 'megamenu_menu_item';

                if($is_megamenu_item){
                    $is_menu_id     = isset($element['menu_id']) && is_numeric($element['menu_id'])
                        && (intval($element['menu_id']) == $import_id);
                    $is_menu_slug   = isset($element['menu_slug']) && is_numeric($element['menu_slug'])
                        && (intval($element['menu_slug']) == $import_id);

                    $id_index_exists = is_array($__parent_layout)?array_search($new_id, $__parent_layout):false;
                    $id_keys        = is_array($__parent_layout)?array_keys($__parent_layout):array();

                    if(($is_menu_slug || $is_menu_id) && !in_array($new_id, $__parent_layout) && !in_array($index, $id_keys)
                        && ($id_index_exists == false || ($id_index_exists != false && $id_index_exists != $index))){
                        if($is_menu_slug) {
                            $element['menu_slug']       = $new_id;
                        }elseif($is_menu_id){
                            $element['menu_id']       = $new_id;
                        }
                        $__parent_layout[$index] = $new_id;
                        return $elements;
                    }elseif(isset($element['menu_slug'])
                        && isset($this ->process_menu_items_alias[$element['menu_slug']])){

                        // Change menu_slug if it was changed
                        $__menu_item    = get_post($this ->process_menu_items_alias[$element['menu_slug']]);
                        if(!empty($__menu_item) && !is_wp_error($__menu_item)){
                            $element['menu_slug']   = $__menu_item -> post_name;
                        }
                    }
                    $index++;
                }

                if($subitems) {
                    $this -> process_menu_layout($element['elements'], $new_id, $import_id,
                        $__parent_layout,  $index);
                }

            }

            return $elements;
        }

        /**
         * Attempt to download a remote file attachment
         *
         * @param string $url URL of item to fetch
         * @param array $post Attachment details
         * @return array|WP_Error Local file location details on success, WP_Error otherwise
         */
        public function fetch_remote_file( $url, $post ) {
            if($this -> fetch_remote_file){
                return parent::fetch_remote_file($url, $post);
            }else {

                $postmeta   = isset($post['postmeta']) ?$post['postmeta']:array();

//                if(!empty($postmeta)){
//                    return parent::fetch_remote_file($url, $post);
//                }

                $uploads = wp_upload_dir( $post['upload_date'] );
                if ( ! ( $uploads && false === $uploads['error'] ) ) {
                    return new WP_Error( 'upload_dir_error', $uploads['error'] );
                }

                $file_name  = (isset($postmeta['_wp_attached_file']) && !empty($postmeta['_wp_attached_file']))?$postmeta['_wp_attached_file']:'';

                $file_name  = !empty($file_name)?$file_name:(!empty($post['attachment_url']) ? $post['attachment_url'] : $post['guid']);

                $file_name  = basename($file_name);

//                // Move the file to the uploads dir.
//                $file_name     = wp_unique_filename( $uploads['path'], $file_name );

//                var_dump($file_name);

                $new_file      = $uploads['path'] . "/$file_name";

                // Handle the upload like _wp_handle_upload() does.
                $wp_filetype     = wp_check_filetype_and_ext( $new_file, $file_name );

                $upload = array(
                    'file' => $new_file,
                    'url' => $uploads['url'] . "/$file_name",
                    'type' => $wp_filetype['type'],
                    'error' => false,
                );

//                var_dump($upload); die(__METHOD__);

                // keep track of the old and new urls so we can substitute them later
                $this->url_remap[$url] = $upload['url'];
                $this->url_remap[$post['guid']] = $upload['url']; // r13735, really needed?
//                // keep track of the destination if the remote url is redirected somewhere else
//                if ( isset($headers['x-final-location']) && $headers['x-final-location'] != $url )
//                    $this->url_remap[$headers['x-final-location']] = $upload['url'];

                return $upload;
            }

        }
    }
}
