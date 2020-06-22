<?php

namespace TemPlazaFramework\Core;

use TemPlazaFramework\Functions;
use TemPlazaFramework\Core\Fields;

defined( 'ABSPATH' ) || exit;

class Framework{

    protected $text_domain;
    public $theme;
    public $args        = array();
    public $sections    = array();
    public $ReduxFramework;
//    protected $page;

    public function __construct()
    {

    }

    public function init(){

        if(!$this -> text_domain) {
            $this->text_domain = Functions::get_my_text_domain();
        }

        if (!class_exists('ReduxFramework')) {
            return;
        }

//        add_action('admin_init', array($this, 'initSettings'));

        $this -> initSettings();

        add_action('admin_init', array($this, 'admin_init'));

//        $this -> enqueue_script();
//        $this -> enqueue_style();

//        add_action('templaza-framework-init');

//        add_filter( 'redux/redux_demo/panel/templates_path', array($this, 'redux_panel_path') );
    }

    public function admin_init(){

        if(!isset($_GET['page']) || (isset($_GET['page']) && $this -> args['page_slug'] != $_GET['page'])){
            return;
        }

        $this -> enqueue_script();
        $this -> enqueue_style();
    }

    public function initSettings() {
        // Just for demo purposes. Not needed per say.
        $this->theme = wp_get_theme();
        // Set the default arguments
        $this->setArguments();
//        // Set a few help tabs so you can see how it's done
//        $this->setHelpTabs();
        // Create the sections and fields
        $this->setSections();


        if (!isset($this->args['opt_name'])) { // No errors please
            return;
        }

        // Load custom fields
        if(!class_exists('Fields')){
            require_once TEMPLAZA_FRAMEWORK_FIELD_PATH.'/fields.php';
        }
        $fields = new Fields($this -> args, $this -> sections);
        $fields -> init();

        $this->ReduxFramework = new \ReduxFramework($this->sections, $this->args);
    }

    public function setArguments() {
        $theme = wp_get_theme(); // For use with some settings. Not necessary.
        $this->args = array(
            // TYPICAL -> Change these values as you need/desire
            'opt_name'          => 'tzfrm_'.basename(TEMPLATEPATH).'_opt',            // This is where your data is stored in the database and also becomes your global variable name.
            'display_name'      => $theme->get('Name'),     // Name that appears at the top of your panel
            'display_version'   => $theme->get('Version'),  // Version that appears at the top of your panel
            'menu_type'         => 'menu',                  //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
            'allow_sub_menu'    => true,                    // Show the sections below the admin menu item or not
            'menu_title'           => $theme->get('Name').__( ' Options', $this -> text_domain),
            'page_title'           => $theme->get('Name').__( ' Options',  $this -> text_domain),

            // You will need to generate a Google API key to use this feature.
            // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
            'google_api_key' => '', // Must be defined to add google fonts to the typography module

            'async_typography'  => true,                    // Use a asynchronous font on the front end or font string
            'admin_bar'         => true,                    // Show the panel pages on the admin bar
            'global_variable'   => '',                      // Set a different name for your global variable other than the opt_name
            'dev_mode'          => false,                    // Show the time the page took to load, etc
            'customizer'        => true,                    // Enable basic customizer support
            // OPTIONAL -> Give you extra features
            'page_priority'     => null,                    // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
            'page_parent'       => 'themes.php',            // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
            'page_permissions'  => 'manage_options',        // Permissions needed to access the options panel.
            'menu_icon'         => '',                      // Specify a custom URL to an icon
            'last_tab'          => '',                      // Force your panel to always open to a specific tab (by id)
            'page_icon'         => 'icon-themes',           // Icon displayed in the admin panel next to your menu_title
            'page_slug'         => 'tzfrm_options',              // Page slug used to denote the panel
            'save_defaults'     => true,                    // On load save the defaults to DB before user clicks save or not
            'default_show'      => false,                   // If true, shows the default value next to each field that is not the default value.
            'default_mark'      => '',                      // What to print by the field's title if the value shown is default. Suggested: *
            'show_import_export' => true,                   // Shows the Import/Export panel when not used as a field.

            // CAREFUL -> These options are for advanced use only
            'transient_time'    => 60 * MINUTE_IN_SECONDS,
            'output'            => true,                    // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
            'output_tag'        => true,                    // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head

            // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
            'database'              => '', // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
            'system_info'           => false, // REMOVE

            'class'             => 'templaza-framework-options',

            // HINTS
            'hints' => array(
                'icon'          => 'icon-question-sign',
                'icon_position' => 'right',
                'icon_color'    => 'lightgray',
                'icon_size'     => 'normal',
                'tip_style'     => array(
                    'color'         => 'light',
                    'shadow'        => true,
                    'rounded'       => false,
                    'style'         => '',
                ),
                'tip_position'  => array(
                    'my' => 'top left',
                    'at' => 'bottom right',
                ),
                'tip_effect'    => array(
                    'show'          => array(
                        'effect'        => 'slide',
                        'duration'      => '500',
                        'event'         => 'mouseover',
                    ),
                    'hide'      => array(
                        'effect'    => 'slide',
                        'duration'  => '500',
                        'event'     => 'click mouseleave',
                    ),
                ),
            )
        );
    }

    public function setSections() {

        $core_options   = array(
            'general.php'
        );
        $path           = TEMPLAZA_FRAMEWORK_OPTION_PATH.'/basic';
        $theme_options  = TEMPLAZA_FRAMEWORK_THEME_PATH_OPTION;

        // General
        require_once( $path.'/general.php' );

        if(file_exists($theme_options.'/general.php')){
            require_once $theme_options.'/general.php';
        }

        require_once( ABSPATH . 'wp-admin/includes/file.php' );
        // Include basic options
        if(is_dir($path)){
            $files  = Functions::list_files($path,'.php', 1, array('general.php'));
            if(count($files)){
                foreach($files as $file){
                    if(file_exists($file)){
                        $file_name      = basename($file);
                        $core_options[] = $file_name;

                        require_once $file;

                        if(file_exists($theme_options.'/'.$file_name)){
                            require_once $theme_options.'/'.$file_name;
                        }
                    }
                }
            }
        }

        // Require options from theme
        if(is_dir($theme_options)){
            $theme_files    = Functions::list_files($theme_options, '.php', 1, $core_options);
            if(count($theme_files)){
                foreach ($theme_files as $theme_file){
                    require_once $theme_file;
                }
            }
        }

    }

//    public function redux_panel_path($tmpPath){
//        return TEMPLAZA_FRAMEWORK_CORE_PATH.'/templates/redux-panel/';
//    }

    public function enqueue_script(){
//        wp_enqueue_script(TEMPLAZA_FRAMEWORK_NAME.'__js', Functions::get_my_frame_url().'/assets/vendors/core/core.js');
    }

    public function enqueue_style(){
        wp_enqueue_style(TEMPLAZA_FRAMEWORK_NAME.'__css', Functions::get_my_frame_url().'/assets/vendors/core/core.css');
        wp_enqueue_style(TEMPLAZA_FRAMEWORK_NAME.'__css-fontawesome', Functions::get_my_url().'/assets/vendors/fontawesome/css/all.min.css');
//        wp_enqueue_style(TEMPLAZA_FRAMEWORK_NAME.'__framework', Functions::get_my_frame_url().'/assets/css/framework.min.css');
        wp_enqueue_style(TEMPLAZA_FRAMEWORK_NAME.'__style', Functions::get_my_frame_url().'/assets/css/style.css');
//        wp_enqueue_style(TEMPLAZA_FRAMEWORK_NAME.'__templaza-options', Functions::get_my_frame_url().'/assets/css/templaza-options.css');
    }

//    protected function redux_init(){
//
//        $plgPath    = TEMPLAZA_FRAMEWORK_PLUGIN_DIR_PATH;
//        if ( !class_exists( 'ReduxFramework' ) && file_exists( $plgPath . '/redux-framework/ReduxCore/framework.php' ) ) {
//            require_once( $plgPath . '/redux-framework/ReduxCore/framework.php' );
//        }
//        if ( !isset( $redux_demo ) && file_exists( TEMPLAZA_FRAMEWORK_CORE_PATH. '/options/basic-config.php' ) ) {
//            require_once( TEMPLAZA_FRAMEWORK_CORE_PATH. '/options/basic-config.php' );
//        }
//
//        // Include basic options
//        $path = TEMPLAZA_FRAMEWORK_OPTION_PATH.'/basic';
//        if(is_dir($path)){
//            $files  = list_files($path, 1);
//            if(count($files)){
//                foreach($files as $file){
//                    if(file_exists($file)){
//                        require_once $file;
//                    }
//                }
//            }
//        }
//
//        // Read options by themes
//        $tmpOptionPath  = TEMPLAZA_FRAMEWORK_THEME_PATH_OPTION;
//        $tmpOptionPath  = trailingslashit($tmpOptionPath);
//        if(is_dir($tmpOptionPath)){
//            $files  = list_files($tmpOptionPath, 1);
//            if(count($files)){
//                foreach($files as $file){
//                    if(file_exists($file)){
//                        require_once $file;
//                    }
//                }
//            }
//        }
//
//    }

}