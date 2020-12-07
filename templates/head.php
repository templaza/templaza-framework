<?php

defined('TEMPLAZA_FRAMEWORK') or exit();

use TemPlazaFramework\Functions;
use TemPlazaFramework\Templates;

$options    = Functions::get_theme_options();
$plugin_uri = Functions::get_my_url();

wp_enqueue_style(TEMPLAZA_FRAMEWORK_THEME_DIR_NAME.'__tzfrm-fontawesome', $plugin_uri.'/assets/vendors/fontawesome/css/all.min.css');

wp_enqueue_script( 'templaza-js__megamenu', Functions::get_my_url().'/assets/js/vendor/jquery.templazamegamenu.js', array( 'jquery' ) );
wp_enqueue_script( 'templaza-js__mobilemenu', Functions::get_my_url().'/assets/js/vendor/jquery.templazamobilemenu.js', array( 'jquery' ) );
wp_enqueue_script( 'templaza-js__offcanvas', Functions::get_my_url().'/assets/js/vendor/jquery.offcanvas.js', array( 'jquery' ) );
wp_enqueue_script( 'templaza-js__main', Functions::get_my_url().'/assets/js/main.js', array( 'jquery' ) );

// Let's add the Smooth Scroll is enabled.
$enable_smooth_scroll         = isset($options['enable-smooth-scroll'])?(bool) $options['enable-smooth-scroll']:true;
if($enable_smooth_scroll) {
    $smooth_scroll_speed = isset($options['smooth-scroll-speed'])?$options['smooth-scroll-speed']:'';
    wp_enqueue_script( 'templaza-js__smooth-scroll', Functions::get_my_url().'/assets/js/vendor/smooth-scroll.polyfills.min.js', array( 'jquery' ) );
    $smoothashell = '
			var scroll = new SmoothScroll(\'a[href*="#"]\', {
            speed: '.$smooth_scroll_speed.',
            header: ".templaza-header"
			});
		';

    wp_add_inline_script('templaza-js__smooth-scroll', $smoothashell);
}


// Add Favicon
add_action('wp_head', function() use($options){
    $favicon    = isset($options['favicon'])?$options['favicon']:array();
    if(count($favicon) && !empty($favicon['url'])) {
        echo '<link rel="shortcut icon" href="' .$favicon['url']. '" />';
    }
}, 3);

Templates::load_my_layout('head.custom');
Templates::load_my_layout('head.typography');