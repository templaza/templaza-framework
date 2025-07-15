<?php

defined('TEMPLAZA_FRAMEWORK') or exit();

use TemPlazaFramework\Functions;
use TemPlazaFramework\Templates;

$options    = Functions::get_theme_options();
$plugin_uri = Functions::get_my_url();
// phpcs:disable WordPress.WP.EnqueuedResourceParameters.NoExplicitVersion, WordPress.WP.EnqueuedResourceParameters.MissingVersion
wp_enqueue_style(TEMPLAZA_FRAMEWORK_THEME_DIR_NAME.'__tzfrm-fontawesome', $plugin_uri.'/assets/vendors/fontawesome/css/all.min.css',);

wp_enqueue_script( 'templaza-js__uikit', Functions::get_my_url().'/assets/js/vendor/uikit.min.js', array( 'jquery' ),'',true );
wp_enqueue_script( 'templaza-js__uikit-icons', Functions::get_my_url().'/assets/js/vendor/uikit-icons.min.js', array( 'jquery' ),'',true  );
wp_enqueue_script( 'templaza-js__megamenu', Functions::get_my_url().'/assets/js/vendor/jquery.templazamegamenu.js', array( 'jquery' ),'',true  );
wp_enqueue_script( 'templaza-js__mobilemenu', Functions::get_my_url().'/assets/js/vendor/jquery.templazamobilemenu.js', array( 'jquery' ),time(),true  );
wp_enqueue_script( 'templaza-js__offcanvas', Functions::get_my_url().'/assets/js/vendor/jquery.offcanvas.js', array( 'jquery' ),'',true  );
wp_enqueue_script( 'templaza-js__main', Functions::get_my_url().'/assets/js/main.js', array( 'jquery' ),time(),true  );

// Let's add the Smooth Scroll is enabled.
$enable_smooth_scroll         = isset($options['enable-smooth-scroll'])?(bool) $options['enable-smooth-scroll']:true;
if($enable_smooth_scroll) {
    $smooth_scroll_speed = isset($options['smooth-scroll-speed'])?$options['smooth-scroll-speed']:'300';
    wp_enqueue_script( 'templaza-js__smooth-scroll', Functions::get_my_url().'/assets/js/vendor/smooth-scroll.polyfills.min.js', array( 'jquery' ),'',true  );
    $smoothashell = '
			var scroll = new SmoothScroll(\'a[href*="#"]\', {
            speed: '.$smooth_scroll_speed.',
            header: ".templaza-header"
			});
		';

    wp_add_inline_script('templaza-js__smooth-scroll', $smoothashell);
}

Templates::load_my_layout('head.menus');
Templates::load_my_layout('head.preloader');
Templates::load_my_layout('post-type-style.advanced-product-style');
Templates::load_my_layout('post-type-style.woocommerce-style');