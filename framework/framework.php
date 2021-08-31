<?php

namespace TemPlazaFramework\Core;

use Composer\Installers\VanillaInstaller;
use TemPlazaFramework\Functions;
use TemPlazaFramework\Admin_Functions;
use TemPlazaFramework\Core\Fields;
use TemPlazaFramework\Media;
use TemPlazaFramework\Menu_Admin;
use TemPlazaFramework\Template_Admin;
use TemPlazaFramework\Templates;
use \TemPlazaFramework\Admin\Admin_Page;

defined( 'ABSPATH' ) || exit;

class Framework{

    protected $text_domain;
    protected $post_types   = array();

    public $theme;
    public $args        = array();
    public $sections    = array();
    public $ReduxFramework;

    public function __construct()
    {
        if (!$this->text_domain) {
            $this->text_domain = Functions::get_my_text_domain();
        }
        // Just for demo purposes. Not needed per say.
        if (!$this->theme) {
            $this->theme = wp_get_theme();
        }

        if (!class_exists('Redux')) {
            return;
        }

        if (file_exists(dirname(__FILE__) . '/includes/autoloader.php')) {
            require_once dirname(__FILE__) . '/includes/autoloader.php';
        }


        if(is_admin()) {
            $admin = new Admin_Page();
            $admin->init();
        }

        $this->init();

        $this -> hooks();
    }


    public function init(){

        if (!class_exists('Redux')) {
            return;
        }

        // Register arguments
        $this -> register_arguments();
        $this -> init_post_types();
        $this -> init_global_settings();

    }

    public function hooks(){

        add_filter('admin_body_class', array($this, 'admin_body_class'));

        add_action('admin_init', array($this, 'enqueue'));


        if(is_admin()) {
            add_action('admin_init', array($this, 'update_checker'));
            add_action('admin_menu', function(){
                $theme  = $this -> theme;

                add_menu_page(
                    _x( $theme->get('Name').' Options', 'templaza-framework', $this -> text_domain ),
                    _x( $theme->get('Name').' Options', 'templaza-framework', $this -> text_domain ),
                    'manage_options',
                    TEMPLAZA_FRAMEWORK,
                    '',
                    'dashicons-art'
                );

                remove_submenu_page(
                    TEMPLAZA_FRAMEWORK,
                    TEMPLAZA_FRAMEWORK
                );

            }, 9);

            add_action('in_admin_header', array($this, 'remove_admin_notices'), 1000);
            add_filter(TEMPLAZA_FRAMEWORK.'_admin_nav_tabs', array($this, 'admin_nav_tabs'), 1000);

            // Filter to remove redux adv
            add_filter("redux/{$this -> args['opt_name']}/localize", array($this, 'redux_localize'));


            $glb_args   = $this -> get_arguments();
            add_action('redux/options/'.$glb_args['opt_name'].'/saved', array($this, 'save_settings_to_file'));
        }

        do_action('templaza-framework/framework/hooks');
    }

    public function save_settings_to_file($options){
        $glb_args   = $this -> get_arguments();
        $opt_name   = $glb_args['opt_name'];

        $action = isset($_REQUEST['action'])?$_REQUEST['action']:'';
        if($action == $opt_name.'_ajax_save') {
            require_once(ABSPATH . '/wp-admin/includes/file.php');
            global $wp_filesystem;
            WP_Filesystem();

            $folder = TEMPLAZA_FRAMEWORK_THEME_PATH_TEMPLATE_OPTION . '/settings';
            if(!is_dir($folder)){
                mkdir($folder, FS_CHMOD_DIR, true);
            }

            $file = $folder . '/setting.json';
            $wp_filesystem->put_contents($file, json_encode($options));

            // Compile style.scss to templaza-style.css
            $dev_mode   = isset($options['dev-mode'])?filter_var($options['dev-mode'], FILTER_VALIDATE_BOOLEAN):false;

            if(!$dev_mode) {
                $css_path = \get_template_directory() . '/assets/css';
                Templates::compileSass(TEMPLAZA_FRAMEWORK_SCSS_PATH, $css_path, 'style.scss', 'templaza-style.css');
            }
        }
    }

    public function admin_nav_tabs($nav_tabs){
        $nav_tabs[] = array(
            'label' => __('Settings', $this -> text_domain),
            'url'   => 'admin.php?page='.$this -> args['opt_name'].'_options',
        );

        return $nav_tabs;
    }
    public function remove_admin_notices(){
        global $pagenow;
        if(is_admin()) {
            $slugs  = Menu_Admin::get_submenu_slugs();
            if(($pagenow == 'admin.php' && isset($_GET['page'])
                && (in_array($_GET['page'], $slugs) || $_GET['page'] == $this -> args['opt_name'].'_options'))) {
                remove_all_actions('admin_notices');
                remove_all_actions('all_admin_notices');
            }
        }
    }

    public function init_post_types(){
        $path   = TEMPLAZA_FRAMEWORK_CORE_PATH.'/post-types';
        if(!$path || ($path && !is_dir($path))){
            return false;
        }

        require_once ( ABSPATH . '/wp-admin/includes/file.php' );

        $files  = list_files($path, 1);
        if(count($files)){
            foreach ($files as $file){
                $info = pathinfo($file);
                $file_name  = $info['filename'];

                $class_name = 'TemplazaFramework\Post_Type\\'.ucfirst($file_name);

                if(file_exists($file) && !class_exists($class_name)){
                    require_once $file;
                }
                if(class_exists($class_name)){
                    $post_type_obj  = new $class_name($this);
                    $this -> post_types[$file_name] = $post_type_obj;
                }
            }
        }
    }

    public function init_global_settings(){

        // Get arguments
        $args   = $this -> get_arguments();

        // Global settings
        if($sections = \Templaza_API::construct_sections('settings')) {
            $opt_name   = $args['opt_name'];
            if(count($sections)) {
                \Redux::set_args($opt_name, $args);

                \Redux::set_sections($opt_name, $sections);
                $path = TEMPLAZA_FRAMEWORK_CORE_PATH . '/extensions/';
                \Redux::set_extensions($opt_name, $path);
                \Templaza_API::load_my_fields($opt_name);
                \Redux::init($opt_name);

                $this -> load_settings($opt_name);
            }
        }
    }

    public function load_settings($opt_name = ''){
        $args       = $this -> get_arguments();
        $opt_name   = !empty($opt_name)?$opt_name:(isset($args['opt_name']) && !empty($args['opt_name'])?$args['opt_name']:'');

        if($redux = \Redux::instance($opt_name)){
            // Load default options
            $opt_file   = TEMPLAZA_FRAMEWORK_THEME_PATH_TEMPLATE_OPTION.'/settings/setting.json';
            if(!file_exists($opt_file)){
                $opt_file   = TEMPLAZA_FRAMEWORK_THEME_PATH_THEME_OPTION.'/settings/default.json';
            }
            if(file_exists($opt_file)){
                $options    = file_get_contents($opt_file);

                $options    = (!empty($options) && is_string($options))?json_decode($options, true):$options;
                $redux -> options   = $options;

            }
        }
    }

    public function admin_body_class($body_class){
        global $typenow, $pagenow, $page_title;

        $slugs  = Menu_Admin::get_submenu_slugs();

        $has_body_class = false;

        if($pagenow == 'nav-menus.php' || ($pagenow == 'admin.php' && isset($_GET['page'])
                && (in_array($_GET['page'], $slugs) || $_GET['page'] == $this -> args['opt_name'].'_options'))){
            $has_body_class = true;
        }

        $_body_class    = ' templaza-framework__body';

        if($has_body_class){
            $body_class .= $_body_class;
        }
        elseif($typenow && count($this -> post_types) && array_key_exists($typenow, $this -> post_types)){
            if($pagenow == 'post-new.php' || $pagenow == 'post.php') {
                $_body_class .= ' tzfrm-postype';
            }
            $body_class .= $_body_class;
        }
        return $body_class;
    }

    public function update_checker(){
        require_once TEMPLAZA_FRAMEWORK_LIBRARY_PATH.'/plugin-updates/plugin-update-checker.php';
        $TemplazaFrameworkUpdateChecker = \Puc_v4_Factory::buildUpdateChecker(
            'https://github.com/templaza/templaza-framework/',
            TEMPLAZA_FRAMEWORK_PATH.'/'.TEMPLAZA_FRAMEWORK_NAME.'.php', //Full path to the main plugin file or functions.php.
            'templaza-framework'
        );

        //Set the branch that contains the stable release.
        $TemplazaFrameworkUpdateChecker->setBranch('master');

        //Optional: If you're using a private repository, specify the access token like this:
        $TemplazaFrameworkUpdateChecker->setAuthentication('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');
        $TemplazaFrameworkUpdateChecker ->clearCachedTranslationUpdates();
    }

    public function redux_localize($localize){
        // Remove Redux ads
        if(isset($localize['rAds'])) {
            unset($localize['rAds']);
        }
        return $localize;
    }

    public function get_arguments(){
        return $this -> args;
    }

    public function register_arguments() {
        $theme = wp_get_theme(); // For use with some settings. Not necessary.

        $core_file     = TEMPLAZA_FRAMEWORK_OPTION_PATH.'/config.php';
        if(file_exists($core_file)){
            require_once $core_file;
        }
        $core_file     = TEMPLAZA_FRAMEWORK_THEME_PATH_OPTION.'/config.php';
        if(file_exists($core_file)){
            require_once $core_file;
        }

        $this->args = array(
            // TYPICAL -> Change these values as you need/desire
            'opt_name'            => Functions::get_theme_option_name(),            // This is where your data is stored in the database and also becomes your global variable name.
            'display_name'        => sprintf(__( '%s Settings',  $this -> text_domain), $theme->get('Name')),     // Name that appears at the top of your panel
            'display_version'     => $theme->get('Version'),  // Version that appears at the top of your panel
            'menu_type'           => 'submenu',                  //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
            'allow_sub_menu'      => true,                    // Show the sections below the admin menu item or not
            'menu_title'          => __( 'Settings', $this -> text_domain),
            'page_title'          => sprintf(__( '%s Settings',  $this -> text_domain), $theme->get('Name')),

            // You will need to generate a Google API key to use this feature.
            // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
            'google_api_key'      => '', // Must be defined to add google fonts to the typography module

            'async_typography'    => true,                    // Use a asynchronous font on the front end or font string
            'admin_bar'           => false,                    // Show the panel pages on the admin bar
            'global_variable'     => '',                      // Set a different name for your global variable other than the opt_name
            'dev_mode'            => false,                    // Show the time the page took to load, etc
            'customizer'          => true,                    // Enable basic customizer support
            // OPTIONAL -> Give you extra features
            'page_priority'       => null,                    // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
            'page_parent'         => TEMPLAZA_FRAMEWORK,            // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
//            'page_parent'         => TEMPLAZA_FRAMEWORK.'_options',            // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
//            'page_parent'         => 'admin.php?page='.TEMPLAZA_FRAMEWORK,            // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
//            'page_parent'         => 'edit.php?post_type=templaza_style',            // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
            'page_permissions'    => 'manage_options',        // Permissions needed to access the options panel.
            'menu_icon'           => '',                      // Specify a custom URL to an icon
            'last_tab'            => '',                      // Force your panel to always open to a specific tab (by id)
            'page_icon'           => 'icon-themes',           // Icon displayed in the admin panel next to your menu_title
//            'page_slug'           => 'admin.php?page='.TEMPLAZA_FRAMEWORK.'_options',              // Page slug used to denote the panel
//            'page_slug'           => 'admin.php?page='.TEMPLAZA_FRAMEWORK.'_options',              // Page slug used to denote the panel
//            'page_slug'           => 'tzfrm_options',              // Page slug used to denote the panel
//            'page_slug'           => TEMPLAZA_FRAMEWORK,              // Page slug used to denote the panel
            'save_defaults'       => false,                    // On load save the defaults to DB before user clicks save or not
            'default_show'        => false,                   // If true, shows the default value next to each field that is not the default value.
            'default_mark'        => '',                      // What to print by the field's title if the value shown is default. Suggested: *
            'show_layout'         => false,                   // Shows the layout panel when not used as a field.
            'show_import_export'  => true,                   // Shows the Import/Export panel when not used as a field.
            'show_options_object' => true,                   // Shows Options Object panel when not used as a field.
            'hide_save'           => false,
            'hide_reset'          => false,
            'hide_expand'         => true,
            'ajax_save'           => true,

            'compiler'            => true,
            // Initiate the compiler hook

            // CAREFUL -> These options are for advanced use only
            'transient_time'      => 60 * MINUTE_IN_SECONDS,
            'output'              => true,                    // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
            'output_tag'          => true,                    // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
            'output_location'     => array( ' ' ),  // Output dynamic CSS.

            // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
            'database'            => '', // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
            'system_info'         => false, // REMOVE

            'class'               => 'templaza-framework-options',

            'footer_credit'         => __('Enjoyed '.$theme -> get('Name').'? Please leave us a ★★★★★ rating. We really appreciate your support'),
//            'footer_text' => '<p>This text is displayed below the options panel. It isn\'t required, but more info is always better! The footer_text field accepts all HTML.</p>',

            // HINTS
            'hints' => array(
                'icon'            => 'icon-question-sign',
                'icon_position'   => 'right',
                'icon_color'      => 'lightgray',
                'icon_size'       => 'normal',
                'tip_style'       => array(
                    'color'       => 'light',
                    'shadow'      => true,
                    'rounded'     => false,
                    'style'       => '',
                ),
                'tip_position'    => array(
                    'my'          => 'top left',
                    'at'          => 'bottom right',
                ),
                'tip_effect'      => array(
                    'show'        => array(
                        'effect'  => 'slide',
                        'duration'=> '500',
                        'event'   => 'mouseover',
                    ),
                    'hide'        => array(
                        'effect'  => 'slide',
                        'duration'=> '500',
                        'event'   => 'click mouseleave',
                    ),
                ),
            )
        );
    }

    public function enqueue(){
        wp_register_script(TEMPLAZA_FRAMEWORK_NAME.'__js', Functions::get_my_frame_url().'/assets/js/core.js',
            array('redux-js'), time(), true);
        wp_register_script(TEMPLAZA_FRAMEWORK_NAME.'_uikit_js', Functions::get_my_url().'/assets/js/vendor/uikit.min.js', array(), time(), true);
        wp_enqueue_script(TEMPLAZA_FRAMEWORK_NAME.'_uikit_js');
        wp_register_script(TEMPLAZA_FRAMEWORK_NAME.'_uikit_icon_js', Functions::get_my_url().'/assets/js/vendor/uikit-icons.min.js', array(), time(), true);
        wp_enqueue_script(TEMPLAZA_FRAMEWORK_NAME.'_uikit_icon_js');
        wp_register_style(TEMPLAZA_FRAMEWORK_NAME.'__css-core',
            Functions::get_my_frame_url().'/assets/vendors/core/core.css');
        wp_register_style(TEMPLAZA_FRAMEWORK_NAME.'__css-fontawesome',
            Functions::get_my_url().'/assets/vendors/fontawesome/css/all.min.css');
        wp_register_style(TEMPLAZA_FRAMEWORK_NAME.'__css',
            Functions::get_my_frame_url().'/assets/css/style.css',
            array(TEMPLAZA_FRAMEWORK_NAME.'__css-fontawesome'));
    }
}