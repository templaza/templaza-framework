<?php

namespace TemPlazaFramework;

defined( 'ABSPATH' ) || exit;

use TemPlazaFramework\Core\Framework;
use TemPlazaFramework\Functions;
use ScssPhp\ScssPhp\Formatter\Compressed;
use TemPlazaFramework\Templates;

class TemPlazaFrameWork{

    private $widgets;
    protected $theme_options;
    protected $theme_support;
    protected static $instance;
    protected $template_init = array();

    private $gutenberg_blocks   = array();

    public static function instance(){

        if(static::$instance){
            return static::$instance;
        }

        require_once dirname(__FILE__).'/includes/autoloader.php';

        $instance   = new TemPlazaFrameWork();

        $instance -> hooks();

        $instance -> load_gutenberg_blocks();

        if(class_exists( 'woocommerce' )){
            require_once TEMPLAZA_FRAMEWORK_INCLUDES_PATH . '/helpers/woocommerce/register-product-brand.php';
            require_once TEMPLAZA_FRAMEWORK_INCLUDES_PATH . '/helpers/woocommerce/register-deal.php';
            require_once TEMPLAZA_FRAMEWORK_INCLUDES_PATH . '/helpers/woocommerce/register-variation.php';
            if ( get_option( 'templaza_variation_images' ) == 'yes' ) {
                require_once TEMPLAZA_FRAMEWORK_INCLUDES_PATH . '/helpers/woocommerce/variation-options.php';
            }
        }

        static::$instance   = $instance;
        return $instance;
    }

    public function hooks(){

        add_action('after_setup_theme', array($this, 'default_menu_locations'), 999);
        add_action('init', array($this, 'init'), 999);

        add_action('init', array($this, 'frontend_init'), 999);
        add_action( 'plugins_loaded', array( $this, 'tz_load_plugin_textdomain' ) );
        add_action('template_include', array($this, 'template_include'), 9999);
        add_action('wp_enqueue_scripts', array($this, 'enqueue_scripts'), 999);
        add_action('wp_head', array($this, 'wp_head'), 999);
        add_action('wp_footer', array($this, 'wp_footer'), 999);

        add_filter('register_sidebar_defaults', array($this, 'modify_sidebar'), 9999);
        add_filter('wp_kses_allowed_html', array($this, 'wpkses_post_tags'), 10, 2);

        // Register widgets
        add_action( 'widgets_init', array( $this, 'register_widgets' ) );

        add_action( 'admin_init', array($this, 'create_post_default') );

        do_action( 'templaza-framework/plugin/hooks', $this );
        add_filter('user_contactmethods', array($this, 'templaza_modify_contact_methods'));
        add_filter('upload_mimes', array($this, 'templaza_mime_types'));
        add_filter('allowed_options', array($this,'templaza_add_new_option_color'), 10, 1);
    }


    public function templaza_add_new_option_color($allowed_options) {

        $allowed_options['tzfrm_global_colors_group'] = true;
        return $allowed_options;
    }

    public function wp_head(){
        $options        = Functions::get_theme_options();

        // Add favicon
        $favicon    = isset($options['favicon'])?$options['favicon']:array();
        $favicon_url = Functions::get_theme_default_logo_url('favicon', '.ico');
        if(!empty($favicon) && isset($favicon['url']) && !empty($favicon['url'])){
            $favicon_url = $favicon['url'];
        }

        if(!empty($favicon_url)) {
            echo '<link rel="shortcut icon" href="' .esc_url($favicon_url). '" />';
        }

        // Add custom css files
        // phpcs:disable WordPress.WP.EnqueuedResources.NonEnqueuedStylesheet, WordPress.WP.EnqueuedResources.NonEnqueuedScript
        $customcssfiles = isset($options['customcss-files'])?$options['customcss-files']:'';
        $customcssfiles = !empty($customcssfiles)?trim($customcssfiles):$customcssfiles;
        if (!empty($customcssfiles)) {
            $customcssfiles = explode("\n", $customcssfiles);
            foreach ($customcssfiles as $customcssfile) {
                if (!empty($customcssfile)) {
                    echo "<link rel=\"stylesheet\" href=\"" .esc_url($customcssfile). "\"  type=\"text/css\" media=\"all\" />\n";
                }
            }
        }

        // Add custom js files
        $customjsfiles = isset($options['customjs-files'])?$options['customjs-files']:'';
        $customjsfiles = !empty($customjsfiles)?trim($customjsfiles):$customjsfiles;
        if (!empty($customjsfiles)) {
            $customjsfiles = explode("\n", $customjsfiles);
            foreach ($customjsfiles as $customjsfile) {
                if (!empty($customjsfile)) {
                    echo "<script type=\"text/javascript\" src=\"".esc_url($customjsfile)."\"></script>\n";
                }
            }
        }
        // phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped
        // Add tracking code
        $tracking_code  = isset($options['trackingcode-editor'])?$options['trackingcode-editor']:'';
        $tracking_code  = !empty($tracking_code)?trim($tracking_code):$tracking_code;
        if(!empty($tracking_code)){
            echo $tracking_code."\n";
        }

        // Add Custom CSS
        $customcss_editor   = isset($options['customcss-editor'])?$options['customcss-editor']:'';
        $customcss_editor   = !empty($customcss_editor)?trim($customcss_editor):$customcss_editor;
        if(!empty($customcss_editor)){
            echo "<style>$customcss_editor</style>\n";
        }

        $beforehead_editor  = isset($options['beforehead-editor'])?$options['beforehead-editor']:'';
        $beforehead_editor  = !empty($beforehead_editor)?trim($beforehead_editor):$beforehead_editor;
        if(!empty($beforehead_editor)){
            echo $beforehead_editor."\n";
        }
    }

    public function wp_footer() {
        $options        = Functions::get_theme_options();

        $beforebody_editor  = isset($options['beforebody-editor'])?$options['beforebody-editor']:'';
        $beforebody_editor  = !empty($beforebody_editor)?trim($beforebody_editor):$beforebody_editor;
        if(!empty($beforebody_editor)){
            echo $beforebody_editor."\n";
        }
    }

    public function tz_load_plugin_textdomain() {
        load_plugin_textdomain( 'wordpress-importer', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
        load_plugin_textdomain( 'templaza-framework', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
    }

    public function load_gutenberg_blocks(){
        $theme_path  = TEMPLAZA_FRAMEWORK_THEME_PATH_GUTENBERG_BLOCK;

        $core_path  = TEMPLAZA_FRAMEWORK_PATH.'/gutenberg-blocks';


        if(!is_dir($core_path) && !is_dir($theme_path)){
            return;
        }

        $folders        = glob($core_path.'/*', GLOB_ONLYDIR);
        $theme_folders  = glob($theme_path.'/*', GLOB_ONLYDIR);

        if((empty($folders) || (!empty($folders) && !count($folders))) &&
            (empty($theme_folders) || (!empty($theme_folders) && !count($theme_folders)))){
            return;
        }

        if(count($theme_folders)) {
            $folders = array_merge($folders, $theme_folders);
        }

        if(!empty($folders) && count($folders)){
            foreach ($folders as $folder){
                $block  = basename($folder);

                $block_path = $folder.'/'.$block.'.php';

                if(!file_exists($block_path)){
                    continue;
                }

                if(file_exists($block_path)){
                    require $block_path;
                }

                $block  = str_replace('-', '_', $block);
                $class  = 'TemplazaFramework_Gutenberg_'.ucfirst($block);

                if(class_exists($class) && !isset($this -> gutenberg_blocks[$class])){
                    $this -> gutenberg_blocks[$class]   = new $class();
                }
            }
        }
    }

    public function register_widgets(){

        $theme_path  = TEMPLAZA_FRAMEWORK_THEME_PATH.'/widgets';

        $core_path  = TEMPLAZA_FRAMEWORK_PATH.'/widgets';


        if(!is_dir($core_path) && !is_dir($theme_path)){
            return;
        }

        $folders        = glob($core_path.'/*', GLOB_ONLYDIR);
        $theme_folders  = glob($theme_path.'/*', GLOB_ONLYDIR);

        if((empty($folders) || (!empty($folders) && !count($folders))) &&
            (empty($theme_folders) || (!empty($theme_folders) && !count($theme_folders)))){
            return;
        }

        if(!empty($theme_folders) && count($theme_folders)) {
            $folders = array_merge($folders, $theme_folders);
        }

        if(!empty($folders) && count($folders)){
            foreach ($folders as $folder){
                $file_name  = basename($folder);
                $wd_name     = $file_name;

                $path = $folder.'/'.$wd_name.'.php';

                if(!file_exists($path)){
                    continue;
                }

                if(file_exists($path)){
                    require $path;
                }

                $wd_name = str_replace(array('_', '-'), ' ',$wd_name);
                $wd_name = !empty($wd_name)?ucwords($wd_name):$wd_name;
                $wd_name = !empty($wd_name)?str_replace(' ', '_', $wd_name):$wd_name;
                $class  = 'TemplazaFramework_Widget_'.$wd_name;

                if(class_exists($class) && !isset($this -> widgets[$class])){
                    $widget_obj = new $class();
                    register_widget( $widget_obj );
                    $this -> widgets[$file_name] = $widget_obj;
                }
            }
        }
    }

    public function modify_sidebar($defaults){
        if(!current_theme_supports('templaza-framework', true, false)){
            return $defaults;
        }
        ob_start();
        Templates::load_my_layout('sidebar.before_title', true, false);
        $before_title   = ob_get_contents();
        ob_end_clean();

        ob_start();
        Templates::load_my_layout('sidebar.after_title', true, false);
        $after_title   = ob_get_contents();
        ob_end_clean();

        ob_start();
        Templates::load_my_layout('sidebar.before_widget', true, false);
        $before_widget   = ob_get_contents();
        ob_end_clean();

        ob_start();
        Templates::load_my_layout('sidebar.after_widget', true, false);
        $after_widget   = ob_get_contents();
        ob_end_clean();

        $sidebar_args = array(
            'before_title'  => $before_title,
            'after_title'   => $after_title,
            'before_widget' => $before_widget,
            'after_widget'  => $after_widget,
        );

        $defaults    = wp_parse_args($sidebar_args, $defaults);

        $defaults    = apply_filters( 'templaza-framework/sidebar/register_sidebar_defaults', $defaults );

        return $defaults;
    }


    public function wpkses_post_tags( $tags, $context ) {
        if ( 'post' === $context ) {
            $tags['iframe'] = array(
                'src'             => true,
                'height'          => true,
                'width'           => true,
                'frameborder'     => true,
                'allowfullscreen' => true,
                'data-uk-responsive' => true,
                'data-uk-video' => true,
            );
            $tags['form'] = array(
                'action'         => true,
                'class'          => true,
                'id'             => true,
                'accept'         => true,
                'accept-charset' => true,
                'enctype'        => true,
                'method'         => true,
                'name'           => true,
                'data-formid'    => true,
                'target'         => true,
                'novalidate'     => true,
                'data-token'     => true,
            );
            $tags['input'] = array(
                'class' => true,
                'id'    => true,
                'name'  => true,
                'value' => true,
                'type'  => true,
                'placeholder'  => true,
                'step'  => true,
                'min'  => true,
                'max'  => true,
                'title'  => true,
                'size'  => true,
                'inputmode'  => true,
                'autocomplete'  => true,
                'checked'  => true,
            );
            $tags['select'] = array(
                'class' => true,
                'id'    => true,
                'name'  => true,
                'value' => true,
                'type'  => true,
                'placeholder'  => true,
                'data-placeholder'  => true,
                'title'  => true,
                'size'  => true,
                'data-allow-clear'  => true,
                'data-name'  => true,
            );
            $tags['option'] = array(
                'class' => true,
                'id'    => true,
                'name'  => true,
                'value' => true,
                'type'  => true,
                'data'  => true,
                'selected'  => true,
            );
        }

        return $tags;
    }
    public function enqueue_scripts(){
        if(!current_theme_supports('templaza-framework')){
            return;
        }

        $this -> init_template();
        Templates::load_my_layout('head');

        // Include preloader css
        $theme          = wp_get_theme();
        $theme_css_uri  = Functions::get_my_theme_css_uri();
        $preloader_css  = Templates::get_style('preloader', 'preloader');
        $widget_css     = Templates::get_style('widget', 'widget');

        wp_enqueue_style(TEMPLAZA_FRAMEWORK_THEME_DIR_NAME.'__tzfrm-preloader', $theme_css_uri.'/'.$preloader_css, array(), TEMPLAZA_FRAMEWORK_VERSION);
        wp_enqueue_style(TEMPLAZA_FRAMEWORK_THEME_DIR_NAME.'__tzfrm-preloader-custom', Functions::get_my_url() . '/assets/css/custom.css', array(), TEMPLAZA_FRAMEWORK_VERSION);
        wp_enqueue_style(TEMPLAZA_FRAMEWORK_THEME_DIR_NAME.'__tzfrm-widget', $theme_css_uri.'/'.$widget_css, array(), TEMPLAZA_FRAMEWORK_VERSION);

        if($google_link = Fonts::make_google_web_font_link()){
            wp_enqueue_style('templaza-google-font', $google_link, array(),TEMPLAZA_FRAMEWORK_VERSION);
        }

        $options    = Functions::get_global_settings();
        $header_options    = Functions::get_header_options();
        $dev_mode   = isset($options['dev-mode'])?filter_var($options['dev-mode'], FILTER_VALIDATE_BOOLEAN):false;

        $css_path   = \get_template_directory().'/assets/css';
        $scss_path  = TEMPLAZA_FRAMEWORK_THEME_SCSS_PATH;
        $scss_path  = is_dir($scss_path)?$scss_path:TEMPLAZA_FRAMEWORK_SCSS_PATH;
        $trans_name = 'templaza-'.$theme -> get_template().'-transients';
        $transient  = get_option($trans_name, array());

        $cur_sass_name  = Templates::get_sass_name_hash();
        $no_transient   = (!isset($transient['sass_code']) || (isset($transient['sass_code'])
                && $transient['sass_code'] != $cur_sass_name));
        $ver_time = '';
        if($dev_mode){
            if(!isset($transient['sass_code']) || (isset($transient['sass_code']) && !empty($transient['sass_code'])
                    && $cur_sass_name != $transient['sass_code'])){
                $transient['sass_code']    = $cur_sass_name;
                Templates::compileSass($scss_path, $css_path, 'style.scss', 'style.css', false);
                Templates::compileSass($scss_path, $css_path, 'style.scss', 'style.min.css', true);
                update_option($trans_name, $transient);
            }
            $ver_time = time();
        }

        if((!file_exists($css_path.'/style.min.css') || !file_exists($css_path.'/style.css'))
            || $no_transient) {
//            $cur_sass_name = Templates::get_sass_name_hash();
            $transient['sass_code']    = $cur_sass_name;
            if(!file_exists($css_path.'/style.css') || $no_transient) {
                Templates::compileSass($scss_path, $css_path, 'style.scss', 'style.css', false);
            }
            if(!file_exists($css_path.'/style.min.css') || $no_transient) {
                Templates::compileSass($scss_path, $css_path, 'style.scss', 'style.min.css', true);
            }
            update_option($trans_name, $transient);
        }

        $style_file = 'style.css';
        if(file_exists($css_path.'/style.min.css')){
            $style_file = 'style.min.css';
        }

        if(file_exists($css_path.'/'.$style_file)) {
            wp_enqueue_style(TEMPLAZA_FRAMEWORK_THEME_DIR_NAME . '__tzfrm',
                get_template_directory_uri() . '/assets/css/'.$style_file, array(), $theme->get('Version').$ver_time);
        }

        $inline_css = Templates::get_inline_styles();

        wp_add_inline_style(TEMPLAZA_FRAMEWORK_THEME_DIR_NAME.'__tzfrm', $inline_css);

        if(class_exists( 'woocommerce' )){
            $this -> woo_enqueue_scripts();
        }

        if(class_exists( 'Advanced_Product\Advanced_Product' )){
            $this -> advanced_enqueue_scripts();
        }
        wp_register_script( 'gsap-js', Functions::get_my_url().'/assets/js/vendor/gsap.min.js', array(), '3.13.0', true );
        wp_register_script( 'gsap-st', Functions::get_my_url().'/assets/js/vendor/ScrollTrigger.min.js', array('gsap-js'), '3.13.0', true );
        wp_register_script( 'gsap-smooth', Functions::get_my_url().'/assets/js/vendor/ScrollSmoother.min.js', array('gsap-st'), '3.13.0', true );
        wp_register_script( 'gsap-SplitText', Functions::get_my_url().'/assets/js/vendor/SplitText.min.js', array('gsap-smooth'), '3.13.0', true );
        wp_enqueue_script( 'gsap-js');
        wp_enqueue_script( 'gsap-st');
        wp_enqueue_script( 'gsap-smooth');
        wp_enqueue_script( 'gsap-SplitText');

        $cursor_enable   = isset($options['enable-cursor-effects'])?filter_var($options['enable-cursor-effects'], FILTER_VALIDATE_BOOLEAN):false;

        $cursor_eff   = isset($options['cursor-effects'])?$options['cursor-effects']:'';

        if($cursor_enable){
            wp_enqueue_script( 'gsap-js');
            wp_enqueue_script( 'gsap-st');
            if($cursor_eff){
                wp_register_style( 'templaza-cursor-'.$cursor_eff.'-style', Functions::get_my_url() . '/assets/css/cursor-effect/cursor-'.$cursor_eff.'.css', array(),TEMPLAZA_FRAMEWORK_VERSION );
                wp_enqueue_style('templaza-cursor-'.$cursor_eff.'-style');

                wp_register_script( 'templaza-cursor-'.$cursor_eff.'-script', Functions::get_my_url() . '/assets/js/cursor-effect/cursor-'.$cursor_eff.'.js', array('jquery'),TEMPLAZA_FRAMEWORK_VERSION,true );
                wp_enqueue_script( 'templaza-cursor-'.$cursor_eff.'-script');
            }
        }
        $preloader   = isset($options['preloader'])?filter_var($options['preloader'], FILTER_VALIDATE_BOOLEAN):false;
        $preloader_animation    = isset($options['preloader-animation'])?$options['preloader-animation']:'circle';
        $header_mode    = isset($header_options['header-mode'])?$header_options['header-mode']:'';

        if($preloader && $preloader_animation =='charging'){
            wp_enqueue_script( 'gsap-js');
            wp_enqueue_script( 'gsap-st');
            wp_enqueue_script( 'gsap-scroll', Functions::get_my_url().'/assets/js/vendor/smooth-scrollbar.js', array('gsap-js'), '3.13.0', true );
            wp_enqueue_script( 'templaza-preloader-script', Functions::get_my_url() . '/assets/js/preloader.js', array('jquery'), '3.13.0', true );
        }
        if($header_mode =='headeranimation'){
            wp_enqueue_script( 'templaza-headeranimation-script', Functions::get_my_url() . '/assets/js/headeranimation.js', array('gsap-js'), time(), true );
        }

        do_action('templaza-framework/plugin/enqueue_scripts', $this);
    }

    protected function advanced_enqueue_scripts(){
        wp_register_style( 'templaza-tiny-slider-style', Functions::get_my_url() . '/assets/css/tiny-slider.css', array(),TEMPLAZA_FRAMEWORK_VERSION );
        wp_register_script( 'templaza-tiny-slider-script', Functions::get_my_url() . '/assets/js/vendor/tiny-slider.js', array('jquery'),TEMPLAZA_FRAMEWORK_VERSION,true );
    }

    protected function woo_enqueue_scripts(){

        wp_register_script( 'templaza-woo-notify', Functions::get_my_url(). '/assets/js/woo/notify.min.js', array(), '1.0.0', true );
        wp_register_script( 'templaza-woo-swiper', Functions::get_my_url() . '/assets/js/woo/swiper.min.js', array( 'jquery' ), '5.3.8', true );

        wp_register_script( 'templaza-woo-viewport', Functions::get_my_url() . '/assets/js/woo/isInViewport.min.js', array('jquery'),TEMPLAZA_FRAMEWORK_VERSION,true );
        wp_enqueue_script( 'templaza-woo-viewport' );

        $admin_url = admin_url('admin-ajax.php');
        $templaza_ajax_url = array('url' => $admin_url);
        wp_localize_script('templaza-scripts', 'templaza_ajax_url', $templaza_ajax_url);

        wp_enqueue_script( 'templaza-woo-scripts', Functions::get_my_url() . '/assets/js/woo/woo-scripts.js', array(
            'jquery',
            'templaza-woo-viewport',
            'templaza-woo-swiper',
            'templaza-woo-notify',
            'imagesloaded',
        ), TEMPLAZA_FRAMEWORK_VERSION, true );

        $templaza_data = array(
            'direction'            => is_rtl() ? 'true' : 'false',
            'ajax_url'             => class_exists( 'WC_AJAX' ) ? \WC_AJAX::get_endpoint( '%%endpoint%%' ) : '',
            'nonce'                => wp_create_nonce( '_templaza_nonce' ),
            'search_content_type'  => get_option( 'header_search_type' ),
            'header_search_number' => get_option( 'header_search_number' ),
            'header_ajax_search'   => intval( get_option( 'header_search_ajax' ) ),
            'sticky_header'        => intval( get_option( 'header_sticky' ) ),
            'mobile_landscape'     => 2,
            'mobile_portrait'      => 2,
            'popup'                => get_option( 'newsletter_popup_enable' ),
            'popup_frequency'      => get_option( 'newsletter_popup_frequency' ),
            'popup_visible'        => get_option( 'newsletter_popup_visible' ),
            'popup_visible_delay'  => get_option( 'newsletter_popup_visible_delay' ),
        );

        $templaza_data = apply_filters( 'templaza_wp_script_data', $templaza_data );

        wp_localize_script(
            'templaza-woo-scripts', 'templazaData', $templaza_data
        );
    }

    public function default_menu_locations(){

        // Register menu locations
        $locations = array(
            'header' => __('Header Menu', 'templaza-framework'),
            'primary' => __('Primary Menu', 'templaza-framework'),
            'footer' => __('Footer Menu', 'templaza-framework'),
        );
        register_nav_menus($locations);
    }

    public function init(){
        global $_wp_theme_features;

        if(!current_theme_supports('templaza-framework')){
            return;
        }

        if(!class_exists('TemPlazaFrameWork\Core\Framework')) {
            require_once TEMPLAZA_FRAMEWORK_CORE_PATH . '/framework.php';
        }
        $core   = new Framework();

        do_action( 'templaza-framework/plugin/admin_init', $this, $core );

    }

    public function frontend_init(){
        if(!is_admin()){

            if(!current_theme_supports('templaza-framework')){
                return;
            }

            $this -> theme_options  = Functions::get_theme_options();

            $this -> load_template();

            if(file_exists(TEMPLAZA_FRAMEWORK_INCLUDES_PATH.'/helpers/woocommerce/woocommerce-load.php') && class_exists( 'woocommerce' )) {
                require_once TEMPLAZA_FRAMEWORK_INCLUDES_PATH . '/helpers/woocommerce/woocommerce-load.php';
            }
        }
    }

    public function load_my_header(){
        Templates::load_my_layout('colors');
        Templates::load_my_header();
    }
    public function theme_body_main($theme_file_name){
        if($theme_file_name) {
            add_filter('templaza-framework/shortcode/content_area/theme_file', function($file_name)use($theme_file_name){
                $file_name  = !empty($theme_file_name)?$theme_file_name:$file_name;
                return $file_name;
            });
        }
        $this -> display_body();
    }

    public function load_my_footer(){
        Templates::load_my_footer();
        Templates::load_my_layout('typography');
    }

    public function template_include($template){
        if ( is_embed() ) {
            return $template;
        }

        if(!current_theme_supports('templaza-framework')){
            return $template;
        }

        $base_path  = TEMPLAZA_FRAMEWORK_TEMPLATE_PATH;
        $theme_path = get_template_directory();
        $main_file  = TEMPLAZA_FRAMEWORK_THEME_PATH_TEMPLATE.'/main.php';

        $theme_file = $template;

        // Check file is the main in theme
        // Example: theme_name/single.php
        if(strpos($template, $theme_path.'/'.basename($template)) !== false){
            $theme_file = basename($theme_file);
            $theme_file = preg_replace('/\.php$/i', '', $theme_file);
        }

        // Is coming soon page
        $options    = Functions::get_theme_options();

        $coming_soon_dev_mode   = isset($options['miscellaneous-development-mode'])?filter_var($options['miscellaneous-development-mode'], FILTER_VALIDATE_BOOLEAN):false;
        if($coming_soon_dev_mode){
            $theme_file = 'comingsoon';
        }

        // Is 404 page
        if(is_404() && $theme_file != '404'){
            $theme_file = '404';
        }

        add_filter('templaza-framework/shortcode/content_area/theme_html', function($html) use ( $theme_file){
            if(!is_file($theme_file)){
                // Check file exists in sub folder

                if( !get_post_type()){
                    global $wp_query, $wp_taxonomies;
                    $queried_object = get_queried_object()->taxonomy;

                    if($queried_object){
                        $post_type = ( isset( $wp_taxonomies[$queried_object] ) ) ? $wp_taxonomies[$queried_object]->object_type[0] : array();
                    }
                }else{
                    $post_type = get_post_type();
                }

                $path       = Templates::load_my_layout('theme_pages.'.$theme_file.'.'.$post_type, false);
                if(!$path){
                    $path   = Templates::load_my_layout('theme_pages.'.$theme_file, false);
                }

            }else{
                $path   = $theme_file;
            }

            ob_start();
            require $path;
            $html    = ob_get_contents();
            ob_end_clean();

            return $html;
        });

        if (file_exists($main_file)) {
            return $main_file;
        }
        $main_file = $base_path . '/main.php';
        if (file_exists($main_file)) {
            return $main_file;
        }
        return $template;
    }

    protected function init_template(){

        if(!is_admin()){
            $header_options = Functions::get_header_options();
            $footer_options = Functions::get_footer_options();

            $this -> template_init['body']  = '';

            // Generate header layout if it exists
            if(!empty($header_options) && isset($header_options['h_layout'])) {
                $hlayout_shortcode = Functions::generate_option_to_shortcode($header_options['h_layout']);

                if (!empty($hlayout_shortcode)) {
                    do {
                        $hlayout_shortcode = trim(do_shortcode($hlayout_shortcode));
                    } while (preg_match_all('/' . get_shortcode_regex() . '/', $hlayout_shortcode, $matches, PREG_SET_ORDER));
                }

                $this->template_init['body'] = (!empty($hlayout_shortcode)) ? $hlayout_shortcode : '';
            }

            ob_start();
            $this -> load_my_header();
            $this -> template_init['header']    = ob_get_contents();
            ob_end_clean();

            // Generate body layout
            ob_start();
            Templates::load_my_layout('body', true, false);
            $this -> template_init['body']    .= ob_get_contents();
            ob_end_clean();

            // Generate footer layout if it exists
            if(!empty($footer_options) && isset($footer_options['f_layout'])) {
                $flayout_shortcode = Functions::generate_option_to_shortcode($footer_options['f_layout']);

                if (!empty($flayout_shortcode)) {
                    do {
                        $flayout_shortcode = trim(do_shortcode($flayout_shortcode));
                    } while (preg_match_all('/' . get_shortcode_regex() . '/', $flayout_shortcode, $matches, PREG_SET_ORDER));
                }

                $this->template_init['body'] .= (!empty($flayout_shortcode)) ? $flayout_shortcode : '';
            }

            ob_start();
            $this -> load_my_footer();
            $this -> template_init['footer']    = ob_get_contents();
            ob_end_clean();

        }
    }

    public function display_header(){
        if(isset($this -> template_init['header'])){
            echo $this -> template_init['header'];
        }
    }

    public function display_body(){
        if(isset($this -> template_init['body'])){
            echo $this -> template_init['body'];
        }
    }

    public function display_footer(){
        if(isset($this -> template_init['footer'])){
            echo $this -> template_init['footer'];
        }
        wp_dequeue_style('core-block-supports');
    }

    /**
     * Create post default
     * */
    public function create_post_default(){

        $default_theme_value = get_option( 'default_'.get_template().'' );
        if ( !empty($default_theme_value) ) {
            return $default_theme_value;
        }

        $post_types = array('templaza_header', 'templaza_footer');
        // phpcs:disable  WordPress.DB.SlowDBQuery.slow_db_query_meta_query
        foreach ($post_types as $ptype) {
            // Check data exists
            $args = array(
                'post_type'     => $ptype,
                'post_status'   => 'publish',
                'numberposts' => -1,
                'meta_query'    => array(
                    array(
                        'key'   => '__home',
                        'value' => 1,
                        'compare' => '='
                    )
                )
            );

            $pexists    = get_posts($args);
            if(!empty($pexists)){
                add_option( 'default_'.get_template().'', 1, '', 'yes' );
                $mkey       = '_' . $ptype . '__theme';
                $hthemes    = get_post_meta($pexists[0] -> ID, $mkey);
                if(!$hthemes || !in_array(get_template(), $hthemes)) {
                    add_post_meta($pexists[0]->ID, $mkey, get_template());
                }
                continue;
            }
            // Create post default
            $author = (int) get_current_user_id();

            $now    = gmdate('Y-m-d H:i:s');
            $postdata = array(
                'post_author'     => $author,
                'post_date'     => $now,
                'post_date_gmt' => $now,
                'post_title'    => esc_html__('Default', 'templaza-framework'),
                'post_status'   => 'publish',
                'post_name'     => 'default',
                'post_type'     => $ptype,
                'meta_input' => array(
                    '_'.$ptype.'' => 'default',
                    '_'.$ptype.'__theme' => get_template(),
                    '__home' => 1
                )
            );

            $post_id = wp_insert_post( $postdata, false,false );


            if(isset($post_id)){

                // Copy json file
                $source_file    = TEMPLAZA_FRAMEWORK_THEME_PATH_THEME_OPTION.'/'.$ptype.'/'.$postdata['post_name'].'.json';

                if(!file_exists($source_file)) {
                    $source_file = TEMPLAZA_FRAMEWORK_CORE_PATH . '/data-import/' . $ptype . '.json';
                }

                $dest_file      = TEMPLAZA_FRAMEWORK_THEME_PATH_TEMPLATE_OPTION.'/'.$ptype;
                if(!is_dir($dest_file)){
                    require_once(ABSPATH . '/wp-admin/includes/file.php');
                    mkdir($dest_file, 755, true);
                }
                $dest_file     .= '/'.$postdata['post_name'].'.json';
                if(file_exists($source_file) && !file_exists($dest_file)){
                    copy($source_file, $dest_file);
                }
            }
        }
    }
    public function templaza_modify_contact_methods($profile_fields)
    {
        $profile_fields['phone'] = esc_html__('Phone','templaza-framework');
        $profile_fields['job'] = esc_html__('Job','templaza-framework');
        $profile_fields['facebook'] = esc_html__('Facebook URL','templaza-framework');
        $profile_fields['twitter'] = esc_html__('Twitter URL','templaza-framework');
        $profile_fields['instagram'] = esc_html__('Instagram URL','templaza-framework');
        $profile_fields['dribbble'] = esc_html__('Dribbble URL','templaza-framework');
        $profile_fields['linkedin'] = esc_html__('Linkedin URL','templaza-framework');
        $profile_fields['pinterest'] = esc_html__('Pinterest URL','templaza-framework');
        $profile_fields['youtube'] = esc_html__('Youtube URL','templaza-framework');
        $profile_fields['vimeo'] = esc_html__('Vimeo URL','templaza-framework');
        $profile_fields['flickr'] = esc_html__('Flickr URL','templaza-framework');
        $profile_fields['tumblr'] = esc_html__('Tumblr URL','templaza-framework');
        $profile_fields['whatsapp'] = esc_html__('WhatsApp URL','templaza-framework');
        return $profile_fields;
    }
    public function templaza_mime_types( $mimes ){
        $mimes['svg'] = 'image/svg+xml';
        return $mimes;
    }

    protected function load_template(){
        add_action('wp_body_open', array($this, 'display_header'));
        add_action('templaza-framework_theme_body', array($this, 'display_body'));
        add_action('wp_footer', array($this, 'display_footer'));
    }

}