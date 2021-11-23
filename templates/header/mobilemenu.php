<?php

defined('TEMPLAZA_FRAMEWORK') or exit();

use TemPlazaFramework\Menu;
use TemPlazaFramework\Functions;
use TemPlazaFramework\Templates;

$options        = Functions::get_theme_options();

$header             = isset($options['enable-header'])?filter_var($options['enable-header'], FILTER_VALIDATE_BOOLEAN):true;
$header_mobile_menu = isset($options['header-mobile-menu'])?$options['header-mobile-menu']:'header';

if ($header) {

    $dir = 'left';
    $header_mode = isset($options['header-mode']) ? $options['header-mode'] : 'horizontal';
    $mode       = isset($options['header-sidebar-menu-mode']) ? $options['header-sidebar-menu-mode'] : 'left';
    $dir        = $header ? ($header_mode == 'sidebar' ? $mode : $dir) : $dir;

    // Get data attributes - them added from header shortcode
    $menu_datas = Functions::get_attributes('header');

    $header_mobile_menu_level   = isset($options['header-mobile-menu-level'])?(int) $options['header-mobile-menu-level']:0;

    $navClass                   = ['templaza-mobile-menu'];
//    $navWrapperClass                   = ['nav', 'navbar-nav', 'templaza-nav', 'd-none', 'd-lg-flex'];
    ?>
    <div class="templaza-mobilemenu uk-hidden d-init dir-<?php echo $dir; ?>" data-class-prefix="templaza-mobilemenu"
         id="templaza-mobilemenu">
        <div class="burger-menu-button active">
            <button aria-label="Mobile Menu Toggle" type="button" class="button close-offcanvas offcanvas-close-btn">
         <span class="box">
            <span class="inner"></span>
         </span>
            </button>
        </div>
        <?php
        Menu::get_nav_menu(array(
            'theme_location'  => $header_mobile_menu,
            'menu_class'      => implode(' ', $navClass),
//            'container_class' => implode(' ', $navWrapperClass),
            'menu_id'         => '',
            'depth'           => $header_mobile_menu_level, // Level
            'templaza_megamenu_html_data' => $menu_datas
        )); ?>
    </div>
    <?php
    $style = '.mobilemenu-slide.templaza-mobilemenu{visibility:visible;-webkit-transform:translate3d(' . ($dir == 'left' ? '-' : '') . '100%, 0, 0);transform:translate3d(' . ($dir == 'left' ? '-' : '') . '100%, 0, 0);}.mobilemenu-slide.templaza-mobilemenu-open .mobilemenu-slide.templaza-mobilemenu {visibility:visible;-webkit-transform:translate3d(0, 0, 0);transform:translate3d(0, 0, 0);}.mobilemenu-slide.templaza-mobilemenu::after{display:none;}';
//$document->addStyledeclaration($style);
}
?>