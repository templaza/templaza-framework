<?php

defined( 'ABSPATH' ) || exit;

if(!defined('TEMPLAZA_FRAMEWORK_VERSION')){
    define('TEMPLAZA_FRAMEWORK_VERSION', '1.2.2');
}
if(!defined('TEMPLAZA_FRAMEWORK_PATH')){
    define('TEMPLAZA_FRAMEWORK_PATH', dirname( dirname(__FILE__)));
}
if(!defined('TEMPLAZA_FRAMEWORK_PLUGIN_DIR_PATH')){
    define('TEMPLAZA_FRAMEWORK_PLUGIN_DIR_PATH', dirname(TEMPLAZA_FRAMEWORK_PATH ));
}
if(!defined('TEMPLAZA_FRAMEWORK_THEME_DIR_NAME')) {
    define('TEMPLAZA_FRAMEWORK_THEME_DIR_NAME', basename(get_template_directory()));
}
if(!defined('TEMPLAZA_FRAMEWORK')){
    define('TEMPLAZA_FRAMEWORK', basename(TEMPLAZA_FRAMEWORK_PATH));
}
if(!defined('TEMPLAZA_FRAMEWORK_NAME')){
    define('TEMPLAZA_FRAMEWORK_NAME', TEMPLAZA_FRAMEWORK);
}
if(!defined('TEMPLAZA_FRAMEWORK_CORE_PATH')){
    define('TEMPLAZA_FRAMEWORK_CORE_PATH', TEMPLAZA_FRAMEWORK_PATH.'/framework');
}
if(!defined('TEMPLAZA_FRAMEWORK_CORE_INCLUDES_PATH')){
    define('TEMPLAZA_FRAMEWORK_CORE_INCLUDES_PATH', TEMPLAZA_FRAMEWORK_CORE_PATH.'/includes');
}
if(!defined('TEMPLAZA_FRAMEWORK_CORE_TEMPLATE')){
    define('TEMPLAZA_FRAMEWORK_CORE_TEMPLATE', TEMPLAZA_FRAMEWORK_CORE_PATH.'/templates');
}
if(!defined('TEMPLAZA_FRAMEWORK_INSTALLATION_API_DOMAIN')){
    define('TEMPLAZA_FRAMEWORK_INSTALLATION_API_DOMAIN', 'https://www.templaza.com');
}
if(!defined('TEMPLAZA_FRAMEWORK_CORE_SCSS_PATH')){
    define('TEMPLAZA_FRAMEWORK_CORE_SCSS_PATH', TEMPLAZA_FRAMEWORK_CORE_PATH.'/assets/scss');
}
if(!defined('TEMPLAZA_FRAMEWORK_LIBRARY_PATH')){
    define('TEMPLAZA_FRAMEWORK_LIBRARY_PATH', TEMPLAZA_FRAMEWORK_CORE_PATH.'/libraries');
}
if(!defined('TEMPLAZA_FRAMEWORK_PREFIX')){
    define('TEMPLAZA_FRAMEWORK_PREFIX', 'tzfrm');
}
if(!defined('TEMPLAZA_FRAMEWORK_OPTION_PATH')){
    define('TEMPLAZA_FRAMEWORK_OPTION_PATH', TEMPLAZA_FRAMEWORK_CORE_PATH.'/options');
}
if(!defined('TEMPLAZA_FRAMEWORK_FIELD_PATH')){
    define('TEMPLAZA_FRAMEWORK_FIELD_PATH', TEMPLAZA_FRAMEWORK_CORE_PATH.'/fields');
}
if(!defined('TEMPLAZA_FRAMEWORK_INCLUDES_PATH')){
    define('TEMPLAZA_FRAMEWORK_INCLUDES_PATH', TEMPLAZA_FRAMEWORK_PATH.'/includes');
}
if(!defined('TEMPLAZA_FRAMEWORK_SHORTCODES_PATH')){
    define('TEMPLAZA_FRAMEWORK_SHORTCODES_PATH', TEMPLAZA_FRAMEWORK_PATH.'/shortcodes');
}
if(!defined('TEMPLAZA_FRAMEWORK_METABOXES_PATH')){
    define('TEMPLAZA_FRAMEWORK_METABOXES_PATH', TEMPLAZA_FRAMEWORK_PATH.'/metaboxes');
}
if(!defined('TEMPLAZA_FRAMEWORK_GUTENBERG_BLOCK_PATH')){
    define('TEMPLAZA_FRAMEWORK_GUTENBERG_BLOCK_PATH', TEMPLAZA_FRAMEWORK_PATH.'/gutenberg-blocks');
}
if(!defined('TEMPLAZA_FRAMEWORK_SCSS_PATH')){
    define('TEMPLAZA_FRAMEWORK_SCSS_PATH', TEMPLAZA_FRAMEWORK_PATH.'/assets/scss');
}
if(!defined('TEMPLAZA_FRAMEWORK_TEMPLATE_PATH')){
    define('TEMPLAZA_FRAMEWORK_TEMPLATE_PATH', TEMPLAZA_FRAMEWORK_PATH.'/templates');
}
if(!defined('TEMPLAZA_FRAMEWORK_THEME_PATH')){
    define('TEMPLAZA_FRAMEWORK_THEME_PATH', get_template_directory().'/templaza-framework');
}
if(!defined('TEMPLAZA_FRAMEWORK_THEME_PATH_TEMPLATE_OPTION')){
    $theme      = wp_get_theme();
    define('TEMPLAZA_FRAMEWORK_THEME_PATH_TEMPLATE_OPTION', WP_CONTENT_DIR.'/uploads/templaza/theme/'
        .$theme -> get_template().'/options');
}
if(!defined('TEMPLAZA_FRAMEWORK_THEME_CSS_PATH')){
    define('TEMPLAZA_FRAMEWORK_THEME_CSS_PATH', TEMPLAZA_FRAMEWORK_THEME_PATH.'/css');
}
if(!defined('TEMPLAZA_FRAMEWORK_THEME_SCSS_PATH')){
    define('TEMPLAZA_FRAMEWORK_THEME_SCSS_PATH', TEMPLAZA_FRAMEWORK_THEME_PATH.'/scss');
}
if(!defined('TEMPLAZA_FRAMEWORK_THEME_PATH_OPTION')){
    define('TEMPLAZA_FRAMEWORK_THEME_PATH_OPTION', TEMPLAZA_FRAMEWORK_THEME_PATH.'/options');
}
if(!defined('TEMPLAZA_FRAMEWORK_THEME_PATH_THEME_OPTION')){
    define('TEMPLAZA_FRAMEWORK_THEME_PATH_THEME_OPTION', TEMPLAZA_FRAMEWORK_THEME_PATH.'/theme_options');
}
if(!defined('TEMPLAZA_FRAMEWORK_THEME_PATH_FIELDS')){
    define('TEMPLAZA_FRAMEWORK_THEME_PATH_FIELDS', TEMPLAZA_FRAMEWORK_THEME_PATH.'/fields');
}
if(!defined('TEMPLAZA_FRAMEWORK_THEME_PATH_TEMPLATE')){
    define('TEMPLAZA_FRAMEWORK_THEME_PATH_TEMPLATE', TEMPLAZA_FRAMEWORK_THEME_PATH.'/templates');
}
if(!defined('TEMPLAZA_FRAMEWORK_THEME_PATH_SHORTCODES')){
    define('TEMPLAZA_FRAMEWORK_THEME_PATH_SHORTCODES', TEMPLAZA_FRAMEWORK_THEME_PATH.'/shortcodes');
}
if(!defined('TEMPLAZA_FRAMEWORK_THEME_PATH_METABOXES')){
    define('TEMPLAZA_FRAMEWORK_THEME_PATH_METABOXES', TEMPLAZA_FRAMEWORK_THEME_PATH.'/metaboxes');
}
if(!defined('TEMPLAZA_FRAMEWORK_THEME_PATH_GUTENBERG_BLOCK')){
    define('TEMPLAZA_FRAMEWORK_THEME_PATH_GUTENBERG_BLOCK', TEMPLAZA_FRAMEWORK_THEME_PATH.'/gutenberg-blocks');
}