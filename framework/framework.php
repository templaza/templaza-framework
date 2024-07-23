<?php

namespace TemPlazaFramework\Core;

use Composer\Installers\VanillaInstaller;
use Matrix\Exception;
use TemPlazaFramework\Admin\Admin_Page_Function;
use TemPlazaFramework\Functions;
use TemPlazaFramework\Admin_Functions;
use TemPlazaFramework\Core\Fields;
use TemPlazaFramework\Helpers\HelperLicense;
use TemPlazaFramework\Media;
use TemPlazaFramework\Menu_Admin;
use TemPlazaFramework\Post_TypeFunctions;
use TemPlazaFramework\Template_Admin;
use TemPlazaFramework\Templates;
use \TemPlazaFramework\Admin\Admin_Page;
use TemPlazaFramework\Post_Formats_Ui;
use TemPlazaFramework\Enqueue;
use TemPlazaFramework\Import\Data_Importer;

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

        $this -> register_arguments();

        if(is_admin()) {
            $admin = new Admin_Page($this);
            $admin->init();

            // Import my info when import data from templaza framework
            require_once TEMPLAZA_FRAMEWORK_CORE_INCLUDES_PATH.'/classes/class-templaza-data_importer.php';
            if(class_exists('TemPlazaFramework\Import\Data_Importer')) {
                $data_importer = new Data_Importer();
            }
        }

        $this->init();

        $this -> hooks();
    }


    public function init(){

        if (!class_exists('Redux')) {
            return;
        }

        // Register arguments
//        $this -> register_arguments();
        $this -> __load_config();
        $this -> init_post_types();
        $this -> init_global_settings();
    }

//    public function register_admin_menu(){
////        Menu_Admin::add_submenu_section('settings', array(
////            'label' => __('Settings', 'templaza-framework'),
////            'url'   => 'admin.php?page='.$this -> args['opt_name'].'_options',
////        ));
//    }

    public function hooks(){

        // Hooks for global_colors controller
        remove_action('wp_ajax_tzfrm_global_colors_ajax_save', array('Redux_AJAX_Save', 'save'));
        add_action( 'wp_ajax_tzfrm_global_colors_ajax_save', array($this, 'ajax_save_global_colors'));
        add_action( 'wp_ajax_nopriv_tzfrm_global_colors_ajax_save', array($this, 'ajax_save_global_colors'));
        add_action('wp_ajax_redux_link_options-tzfrm_global_colors', array($this, 'import_global_colors_options'));
        add_action('wp_ajax_nopriv_redux_link_options-tzfrm_global_colors', array($this, 'import_global_colors_options'));
        add_action( 'wp_ajax_redux_download_options-tzfrm_global_colors', array($this, 'ajax_download_option_global_colors'));
        add_action( 'wp_ajax_nopriv_redux_download_options-tzfrm_global_colors', array($this, 'ajax_download_option_global_colors'));

//        add_action('admin_menu', array($this, 'register_admin_menu'), 12);

        add_filter('admin_body_class', array($this, 'admin_body_class'));

        add_action('admin_init', array($this, 'enqueue'));

        if(is_admin()) {
            add_action('admin_init', array($this, 'update_checker'));
            add_action('admin_menu', function(){
                $theme  = $this -> theme;

                add_menu_page(
                    $theme->get('Name').esc_html__(' Options','templaza-framework'),
                    $theme->get('Name').esc_html__(' Options','templaza-framework'),
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

            // phpcs:disable WordPress.WP.AlternativeFunctions.unlink_unlink, WordPress.WP.AlternativeFunctions.file_system_operations_rmdir, WordPress.WP.AlternativeFunctions.rename_rename

            add_action('in_admin_header', array($this, 'remove_admin_notices'), 1000);
//            add_filter(TEMPLAZA_FRAMEWORK.'_admin_nav_tabs', array($this, 'admin_nav_tabs'), 1000);

            // Filter to remove redux adv
            add_filter("redux/{$this -> args['opt_name']}/localize", array($this, 'redux_localize'));

            $glb_args   = $this -> get_arguments();
            add_action('update_option_'.$glb_args['opt_name'], array($this, 'save_settings_to_file'),10,2);


            add_filter('upgrader_source_selection', array($this, 'theme_redownload_child_package'), 10, 4);

            add_action('templaza-framework/admin_notices', array($this, 'admin_notices'));
        }

        do_action('templaza-framework/framework/hooks');
    }

    /**
     * Re-download theme package if it has parent package
     * */
    public function theme_redownload_child_package($source, $remote_source, $upgrader, $hook_extra){
        global $pagenow;
        // phpcs:disable WordPress.Security.NonceVerification.Recommended,

        $action = isset($_GET['action'])?$_GET['action']:'';

        if($pagenow != 'update.php' || $action != 'upload-theme'){
            return $source;
        }

        $theme          = wp_get_theme() -> get_stylesheet();
        $packageInfo    = get_option('_'.TEMPLAZA_FRAMEWORK.'_'.$theme.'_package_theme', array());

        if(empty($packageInfo) || !isset($packageInfo['parent_theme'])){
            return $source;
        }

        $parent_pack_theme   = $packageInfo['parent_theme'];

        $parent_theme  = wp_get_theme($parent_pack_theme, $remote_source);

        // Check parent theme exists with new package uploaded
        if(!$parent_theme || is_wp_error($parent_theme) || !$parent_theme -> get('Version')){
            return $source;
        }

        if(!HelperLicense::is_authorised($theme)){
            return $source;
        }

        $purchase_code  = HelperLicense::get_purchase_code($theme);

        try {

            $step       = 1;
            $filePath   = $this -> download_package_file($packageInfo['parent_package'],
                $packageInfo['package'], $purchase_code, $step);

            if(!$filePath){
                return $source;
            }

            if(file_exists($filePath)) {

                global $wp_filesystem;

                if ( ! $wp_filesystem->wp_content_dir() ) {
                    return $source;
                }

                $upgrade_folder = $wp_filesystem->wp_content_dir() . 'upgrade/';

                // Clean up contents of upgrade directory beforehand.
                $upgrade_files = $wp_filesystem->dirlist($upgrade_folder);
                if (!empty($upgrade_files)) {
                    foreach ($upgrade_files as $file) {
                        $wp_filesystem->delete($upgrade_folder . $file['name'], true);
                    }
                }

                // We need a working directory - strip off any .tmp or .zip suffixes.
                $working_dir = $upgrade_folder . basename( basename( $filePath, '.tmp' ), '.zip' );

                // Clean up working directory.
                if ($wp_filesystem->is_dir($working_dir)) {
                    $wp_filesystem->delete($working_dir, true);
                }

                // Unzip package to working directory.
                $unzip_result = unzip_file($filePath, $working_dir);

                if($unzip_result) {
                    unlink($filePath);
                    // Get new theme
                    $new_theme  = wp_get_theme($theme, $working_dir);

                    if(!$new_theme -> get('Version')){
                        rmdir($working_dir);
                        return $source;
                    }

                    // Rename working dir
                    rename($working_dir, $remote_source);
                }
            }

        }catch (\Exception $exception){
        }

        return $source;
    }

    protected function download_package_file($produce, $type, $purchase_code, &$step){

        $postdata =array(
            'task'          => 'download.package',
            'produce'       => $produce,
            'purchase_code' => $purchase_code,
            'step'          => $step,
            'type'          => $type,
            'domain'        => get_site_url()
        );
        $url            = TEMPLAZA_FRAMEWORK_INSTALLATION_API_DOMAIN.'/index.php?option=com_tz_membership';

        try {

            set_time_limit(0);

            // Get package file from server with post data
            $response = wp_remote_post(
                $url,
                array(
                    'method' => 'POST',
//                            'timeout'  => 300,
                    'timeout' => 45,
                    'body' => $postdata
                )
            );

            if(is_wp_error($response)){
                return false;
            }

            $upgrade_folder = wp_upload_dir();

            $filePath   = $upgrade_folder['path'].'/'.$produce
                .'_'.$type.'.zip';

            $header = $response['headers']; // array of http header lines
            $body   = $response['body']; // use the content

            if($header['content-type'] == 'application/json'){
                $body   = json_decode($body);
                if($body -> code == 400 && $body -> success == false){
                    return false;
                }
            }

            if($step == 1 && file_exists($filePath)){
                unlink($filePath);
            }

            // Put multiple parts of package files to one file
            // phpcs:disable WordPress.WP.AlternativeFunctions.file_system_operations_file_put_contents
            file_put_contents($filePath, $body, FILE_APPEND);

            $file_part_count    = isset($header['files-part-count'])?(int) $header['files-part-count']:1;

            if(!$file_part_count || $file_part_count <= $step){
                return $filePath;
            }

            $step++;
            return $this->download_package_file($produce, $type, $purchase_code, $step);

        }catch (\Exception $exception){
            return false;
        }
//        return false;
    }

    public function admin_notices(){
        global $pagenow, $page;

        $pass   = Admin_Functions::check_system_requirement();
        // phpcs:disable WordPress.Security.NonceVerification.Recommended

        if(!$pass){
            $slugs  = Menu_Admin::get_submenu_slugs();
            if(($pagenow == 'admin.php' && isset($_GET['page'])
                    && (in_array($_GET['page'], $slugs)))) {
                return false;
            }
            ?>
            <div class="notice notice-error uk-text-danger">
                <div class="uk-padding-small uk-padding-remove-left"><?php
                    $file   = Admin_Page_Function::get_template_directory().'/sysinfo_notice.php';

                    if(file_exists($file)){
                        require_once $file;
                    }
                    ?>
                </div>
            </div>
            <?php
        }
    }

    /**
     * Store global colors options to json file
     * (Function used for global_colors controller)
     * */
    public function ajax_save_global_colors(){
        // phpcs:disable WordPress.Security.NonceVerification.Recommended, WordPress.Security.NonceVerification.Missing
        $return_array   = array(
            'status'   => false
        );
        if ( isset( $_POST['opt_name'] ) && ! empty( $_POST['opt_name'] ) && isset( $_POST['data'] ) && ! empty( $_POST['data'] ) ) {
            $post_data = wp_unslash( $_POST['data'] );

            $values = \Redux_Functions_Ex::parse_str( $post_data );
            $values = $values[ $_POST['opt_name'] ];

            if(( isset( $values['import_code'] ) && ! empty( $values['import_code'] ) ) || ( isset( $values['import_link'] ) && ! empty( $values['import_link'] ) ) ){
                $return_array['action'] = 'reload';
                $values = json_decode($values['import_code']);
            }
            // phpcs:disable WordPress.WP.AlternativeFunctions.file_system_operations_mkdir, WordPress.WP.AlternativeFunctions.file_system_operations_file_put_contents, WordPress.WP.AlternativeFunctions.json_encode_json_encode

            $folder = TEMPLAZA_FRAMEWORK_THEME_PATH_TEMPLATE_OPTION . '/global_colors';
            if(!is_dir($folder)){
                mkdir($folder, FS_CHMOD_DIR, true);
            }

            $file   = $folder.'/global_colors.json';

            if(file_exists($file)){
                unlink($file);
            }

            file_put_contents($file, json_encode($values), FS_CHMOD_FILE);

            $return_array   = array_merge($return_array, array(
                'status'    => 'success',
                'options'  => $values,
                'errors'   => null,
                'warnings' => null,
                'sanitize' => null,
            ));
        }

        if ( isset( $return_array ) ) {

            $redux = \Redux::instance( sanitize_text_field( wp_unslash( $_POST['opt_name'] ) ) );
            if ( 'success' === $return_array['status'] ) {
                if(!$redux -> transients){
                    $redux -> transients    = array();
                }
//                        $redux -> transients['last_save'] = time();
                $redux -> transients['last_save_mode'] = 'normal';
//                        $redux -> transients['changed_values'] = $values;
//                        $redux -> transients['last_compiler'] = time();
//                        $redux -> transients['last_import'] = time();
                if(!$redux -> transient_class){
                    $redux -> transient_class   = new \Redux_Transients($redux);
                }

                $panel = new \Redux_Panel( $redux );
                ob_start();
                $panel->notification_bar();
                $notification_bar = ob_get_contents();
                ob_end_clean();
                $return_array['notification_bar'] = $notification_bar;
            }

            // phpcs:ignore WordPress.NamingConventions.ValidHookName
            echo wp_json_encode( apply_filters( 'redux/options/' . $_POST['opt_name'] . '/ajax_save/response', $return_array ) );
        }

        die();
    }

    /**
     * Import global colors options.
     */
    public function link_options() {
        $opt_name       = TEMPLAZA_FRAMEWORK_PREFIX.'_global_colors';

        if ( ! isset( $_GET['secret'] ) || md5( md5( \Redux_Functions_Ex::hash_key() ) . '-' . $opt_name) !== $_GET['secret'] ) { // phpcs:ignore WordPress.Security.NonceVerification
            wp_die( 'Invalid Secret for options use' );
            exit;
        }

        $var    = array();
        if(isset($_GET['post_id']) && !empty($_GET['post_id'])){
            $style_id   = $_GET['post_id'];
            $var    = $this ->get_options_by_post_id($style_id);
        }
        $var['redux-backup'] = 1;

        if ( isset( $var['REDUX_imported'] ) ) {
            unset( $var['REDUX_imported'] );
        }

        echo wp_json_encode( $var );

        die();
    }

    /**
     * Export global colors options
     * */
    public function ajax_download_option_global_colors(){
        $opt_name   = TEMPLAZA_FRAMEWORK_PREFIX.'_global_colors';
        if ( ! isset( $_GET['secret'] ) || ! wp_verify_nonce( sanitize_key( wp_unslash( $_GET['secret'] ) ),
                'redux_io_' . $opt_name ) ) { // phpcs:ignore WordPress.Security.NonceVerification
            wp_die( esc_html__('Invalid Secret for options use', 'templaza-framework') );
            exit;
        }

        $options    = Functions::get_global_colors_options();

        $backup_options                 = $options;
        $backup_options['redux-backup'] = 1;

        if ( isset( $backup_options['REDUX_imported'] ) ) {
            unset( $backup_options['REDUX_imported'] );
        }

        // No need to escape this, as it's been properly escaped previously and through json_encode.
        $content = wp_json_encode( $backup_options );

        if ( isset( $_GET['action'] ) && 'redux_download_options-' . $opt_name === $_GET['action'] ) { // phpcs:ignore WordPress.Security.NonceVerification
            header( 'Content-Description: File Transfer' );
            header( 'Content-type: application/txt' );
            header( 'Content-Disposition: attachment; filename="redux_options_"' . $opt_name
                . '_backup_' . gmdate( 'd-m-Y' ) . '.json' );
            header( 'Content-Transfer-Encoding: binary' );
            header( 'Expires: 0' );
            header( 'Cache-Control: must-revalidate' );
            header( 'Pragma: public' );

            echo( $content ); // phpcs:ignore WordPress.Security.EscapeOutput

            exit;
        } else {
            header( 'Expires: Mon, 26 Jul 1997 05:00:00 GMT' );
            header( 'Last-Modified: ' . gmdate( 'D, d M Y H:i:s' ) . 'GMT' );
            header( 'Expires: Sat, 26 Jul 1997 05:00:00 GMT' );
            header( 'Cache-Control: no-store, no-cache, must-revalidate' );
            header( 'Cache-Control: post-check=0, pre-check=0', false );
            header( 'Pragma: no-cache' );

            // Can't include the type. Thanks old Firefox and IE. BAH.
            // header('Content-type: application/json');.
            echo( $content ); // phpcs:ignore WordPress.Security.EscapeOutput

            exit;
        }
    }

    public function save_settings_to_file($old_value, $options){
        $glb_args   = $this -> get_arguments();
        $opt_name   = $glb_args['opt_name'];

//        $action = isset($_REQUEST['action'])?$_REQUEST['action']:'';
//        if($action == $opt_name.'_ajax_save') {
            require_once(ABSPATH . '/wp-admin/includes/file.php');
            global $wp_filesystem;
            WP_Filesystem();

            $folder = TEMPLAZA_FRAMEWORK_THEME_PATH_TEMPLATE_OPTION . '/settings';
            if(!is_dir($folder)){
                mkdir($folder, FS_CHMOD_DIR, true);
            }

            $file = $folder . '/setting.json';

            if(file_exists($file)){
                unlink($file);
            }
            file_put_contents($file, json_encode($options), FS_CHMOD_FILE);
//        }
    }

    public function admin_nav_tabs($nav_tabs){
        $nav_tabs[] = array(
            'label' => __('Settings', 'templaza-framework'),
            'url'   => 'admin.php?page='.$this -> args['opt_name'].'_options',
        );

        return $nav_tabs;
    }
    public function remove_admin_notices(){
        global $pagenow, $post_type;
        if(is_admin()) {
            $my_post_types  = array_keys($this -> post_types);
            $slugs  = Menu_Admin::get_submenu_slugs();
            if((!empty($my_post_types) && in_array($post_type, $my_post_types))
                || ($pagenow == 'admin.php' && isset($_GET['page'])
                && (in_array($_GET['page'], $slugs) || $_GET['page'] == $this -> args['opt_name'].'_options'))) {
                remove_all_actions('admin_notices');
                remove_all_actions('all_admin_notices');

                // Create templaza framework admin_notices action
                add_action('admin_notices', function(){
                    do_action('templaza-framework/admin_notices');
                });
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

        $this -> __init_post_type_settings();

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
                // phpcs:disable WordPress.WP.AlternativeFunctions.file_get_contents_file_get_contents
                $options    = file_get_contents($opt_file);

                $options    = (!empty($options) && is_string($options))?json_decode($options, true):$options;

                if(!empty($options)) {
                    if(\version_compare(\Redux_Core::$version, '4.3.7', '<=')) {
                        if(method_exists($redux, 'set_options')) {
                            $redux->set_options($options);
                        }else{
                            update_option($opt_name, $options);
                        }
                    }else{
                        if(isset($redux->options_class) && !empty($redux->options_class)
                            && method_exists($redux->options_class, 'set')) {
                            $redux->options_class->set($options);
                        }else{
                            update_option($opt_name, $options);
                        }
                    }
                }
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
//        $TemplazaFrameworkUpdateChecker->setAuthentication('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');
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

        $this->args = array(
            // TYPICAL -> Change these values as you need/desire
            'opt_name'            => Functions::get_theme_option_name(),            // This is where your data is stored in the database and also becomes your global variable name.
            /* translators: %s - Settings. */
            'display_name'        => sprintf(__( '%s Settings',  'templaza-framework'), $theme->get('Name')),     // Name that appears at the top of your panel
            'display_version'     => $theme->get('Version'),  // Version that appears at the top of your panel
            'menu_type'           => 'submenu',                  //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
            'allow_sub_menu'      => true,                    // Show the sections below the admin menu item or not
            'menu_title'          => __( 'Settings', 'templaza-framework'),
            /* translators: %s - Settings. */
            'page_title'          => sprintf(__( '%s Settings',  'templaza-framework'), $theme->get('Name')),

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
            'flyout_submenus'     => false, // Disables the flyout submenus for submenus on the option panel.

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
            /* translators: %s - message. */
            'footer_credit'         => sprintf(__('Enjoyed %s ? Please leave us a ★★★★★ rating. We really appreciate your support', 'templaza-framework'), esc_html($theme -> get('Name'))),

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
            Functions::get_my_frame_url().'/assets/vendors/core/core.css',array(),Functions::get_my_version());
        wp_register_style(TEMPLAZA_FRAMEWORK_NAME.'__css-fontawesome',
            Functions::get_my_url().'/assets/vendors/fontawesome/css/all.min.css', array(), Functions::get_my_version());
        wp_register_style(TEMPLAZA_FRAMEWORK_NAME.'__css',
            Functions::get_my_frame_url().'/assets/css/style.css',
            array(TEMPLAZA_FRAMEWORK_NAME.'__css-fontawesome'), Functions::get_my_version());
    }

    protected function __load_config(){
        $core_file     = TEMPLAZA_FRAMEWORK_OPTION_PATH.'/config.php';
        if(file_exists($core_file)){
            require_once $core_file;
        }
        $core_file     = TEMPLAZA_FRAMEWORK_THEME_PATH_OPTION.'/config.php';
        if(file_exists($core_file)){
            require_once $core_file;
        }
    }

    protected function __init_post_type_settings(){
        $tzfrm_post_types  = Post_TypeFunctions::getPostTypes();
        if(count($tzfrm_post_types)){
            foreach ($tzfrm_post_types as $tzfrm_post_type){
                $tzfrm_post_type_obj  = get_post_type_object($tzfrm_post_type);
                $tzfrm_subsection   = array(
                    'id'    => $tzfrm_post_type.'-subsections',
                    /* translators: %s - message. */
                    'title' => sprintf(__('%s Options', 'templaza-framework'),esc_html($tzfrm_post_type_obj -> label)),
                    'subsection' => true,
                    'fields'     => array(
                        array(
                            'id'    => $tzfrm_post_type.'-archive-style',
                            'type'  => 'select',
                            /* translators: %s - Archive Style. */
                            'title' => sprintf(__('%s Archive Style', 'templaza-framework'), esc_html($tzfrm_post_type_obj -> label)),
                            'subtitle' => __('This template style will be defined as the global default template style.', 'templaza-framework'),
                            'data'     => 'callback',
                            'args'     => 'templaza_framework_get_templaza_style_by_slug',
                        ),
                        array(
                            'id'    => $tzfrm_post_type.'-single-style',
                            'type'  => 'select',
                            /* translators: %s - Single Style. */
                            'title' => sprintf(__('%s Single Style', 'templaza-framework'), esc_html($tzfrm_post_type_obj -> label)),
                            'subtitle' => __('This template style will be defined as the global default template style.', 'templaza-framework'),
                            'data'     => 'callback',
                            'args'     => 'templaza_framework_get_templaza_style_by_slug',
                        )
                    )
                );
                \Templaza_API::set_subsection('settings','settings', $tzfrm_subsection);
            }
        }
    }
}