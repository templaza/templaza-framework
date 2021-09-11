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
    }
}
