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
        public function __construct($options = array())
        {
            $options = wp_parse_args( $options, array(
                'fetch_attachments'         => true,
            ) );

            if(count($options)){
                foreach($options as $name => $option){
                    $this -> {$name}    = $option;
                }
            }
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

            $id = $this->processed_menu_items[intval($item['post_id'])];

            foreach ( $item['postmeta'] as $meta ) {
                ${$meta['key']} = $meta['value'];
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
    }
}
