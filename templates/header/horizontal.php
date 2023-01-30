<?php

// No direct access.
defined('TEMPLAZA_FRAMEWORK') or exit();

use TemPlazaFramework\Functions;
use TemPlazaFramework\Templates;
use TemPlazaFramework\Menu;

$gb_options                 = Functions::get_theme_options();
$options                    = Functions::get_header_options();

$mode                       = isset($options['header-horizontal-menu-mode'])?$options['header-horizontal-menu-mode']:'left';
$block_1_type               = isset($options['header-block-1-type'])?$options['header-block-1-type']:'blank';
$block_1_custom             = isset($options['header-block-1-custom'])?$options['header-block-1-custom']:'';

$enable_offcanvas           = isset($options['enable-offcanvas'])?filter_var($options['enable-offcanvas'],FILTER_VALIDATE_BOOLEAN):false;
$offcanvas_animation        = isset($options['offcanvas-animation'])?$options['offcanvas-animation']:'st-effect-1';
$offcanvas_direction        = isset($options['offcanvas-direction'])?$options['offcanvas-direction']:'offcanvasDirLeft';
$offcanvas_togglevisibility = isset($options['offcanvas-togglevisibility'])?$options['offcanvas-togglevisibility']:'uk-display-block';

$navClass                   = ['nav', 'navbar-nav', 'templaza-nav', 'uk-flex', 'uk-visible@m'];
$navWrapperClass            = [ 'uk-margin-small-left', 'uk-margin-small-right', 'uk-visible@m'];

$dropdown_arrow             = isset($options['dropdown-arrow'])?filter_var($options['dropdown-arrow'], FILTER_VALIDATE_BOOLEAN):true;
$dropdown_animation_type    = isset($options['dropdown-animation-type'])?$options['dropdown-animation-type']:'fade';
$dropdown_animation_effect  = isset($options['dropdown-animation-effect'])?$options['dropdown-animation-effect']:'fade-down';
$dropdown_animation_effect  = $dropdown_animation_type === 'none'?'':$dropdown_animation_effect;
$dropdown_trigger           = isset($options['dropdown-trigger'])?$options['dropdown-trigger']:'hover';

$header_menu                = isset($options['header-menu'])?$options['header-menu']:'header';
$header_mobile_menu         = isset($options['header-mobile-menu'])?$options['header-mobile-menu']:'header';
$block_1_sidebar            = isset($options['header-block-1-sidebar'])?$options['header-block-1-sidebar']:'';
$block_2_sidebar            = isset($options['header-block-2-horizontal-sidebar'])?$options['header-block-2-horizontal-sidebar']:'';
$header_menu_level          = isset($options['header-menu-level'])?(int) $options['header-menu-level']:0;
$login_modals               = isset($gb_options['templaza-shop-account-login'])?$gb_options['templaza-shop-account-login']:'modal';
$header_cart                = isset($gb_options['templaza-shop-mini-cart'])?$gb_options['templaza-shop-mini-cart']:'';
$header_stack_search        = isset($options['stacked-divided-search'])?filter_var($options['stacked-divided-search'], FILTER_VALIDATE_BOOLEAN):true;
$header_stack_account       = isset($options['stacked-divided-account'])?filter_var($options['stacked-divided-account'], FILTER_VALIDATE_BOOLEAN):true;
$header_stack_cart          = isset($options['stacked-divided-cart'])?filter_var($options['stacked-divided-cart'], FILTER_VALIDATE_BOOLEAN):true;
$search_icon_type           = isset($options['search-icon-type'])?$options['search-icon-type']:'default';
$account_icon_type          = isset($options['account-icon-type'])?$options['account-icon-type']:'default';
$cart_icon_type             = isset($options['cart-icon-type'])?$options['cart-icon-type']:'default';
$search_icon = 'fas fa-search';
$account_icon = 'fas fa-user';
$cart_icon = 'fas fa-shopping-cart';
if($search_icon_type == 'fontawesome' ){
    $search_icon = isset($options['search-icon'])?$options['search-icon']:'';
    $search_icon_html = '<i class="'.$search_icon.'"></i>';
}elseif ($search_icon_type == 'custom'){
    $search_icon = isset($options['search-icon-custom'])?$options['search-icon-custom']:'';
    if($search_icon){
        $log_svg              = '';
        if(Functions::file_ext_exists($search_icon['url'], 'svg')){
            $log_svg  = ' data-uk-svg';
        }
        $search_icon_html = '<img src="'.$search_icon['url'].'" alt="'.esc_attr__('Search','templaza-framework').'" '.$log_svg.'/>';
    }
}
if($account_icon_type == 'fontawesome' ){
    $account_icon = isset($options['account-icon'])?$options['account-icon']:'';
    $account_icon_html = '<i class="'.$account_icon.'"></i>';
}elseif ($account_icon_type == 'custom'){
    $account_icon = isset($options['account-icon-custom'])?$options['account-icon-custom']:'';
    if($account_icon){
        $log_svg              = '';
        if(Functions::file_ext_exists($account_icon['url'], 'svg')){
            $log_svg  = ' data-uk-svg';
        }
        $account_icon_html = '<img src="'.$account_icon['url'].'" alt="'.esc_attr__('Account','templaza-framework').'" '.$log_svg.'/>';
    }
}
if($cart_icon_type == 'fontawesome' ){
    $cart_icon = isset($options['cart-icon'])?$options['cart-icon']:'';
    $cart_icon_html = '<i class="'.$account_icon.'"></i>';
}elseif ($cart_icon_type == 'custom'){
    $cart_icon = isset($options['cart-icon-custom'])?$options['cart-icon-custom']:'';
    if($account_icon){
        $log_svg              = '';
        if(Functions::file_ext_exists($cart_icon['url'], 'svg')){
            $log_svg  = ' data-uk-svg';
        }
        $cart_icon_html = '<img src="'.$cart_icon['url'].'" alt="'.esc_attr__('Cart','templaza-framework').'" '.$log_svg.'/>';
    }
}
$navClass[] = $dropdown_animation_effect;

// Get data attributes - them added from header shortcode
$menu_datas = Functions::get_attributes('header');
if($header_stack_search || $header_stack_account || $header_stack_cart){
    $header_icon = 'header-show-icon';
}else{
    $header_icon = '';
}
?>
<div class="uk-flex uk-flex-row uk-flex-between <?php echo esc_attr($header_icon);?>">
    <div class="uk-flex uk-hidden@m uk-flex-left uk-flex-middle">
        <div class="header-mobilemenu-trigger burger-menu-button" data-offcanvas="#templaza-mobilemenu" data-effect="mobilemenu-slide">
            <button class="button" type="button"><span class="box"><span class="inner"></span></span></button>
        </div>
    </div>
    <div class="header-left-section uk-flex uk-flex-between uk-flex-middle">
        <?php Templates::load_my_layout('logo'); ?>
        <?php
        if ($mode == 'left') {
            // header nav starts
            Menu::get_nav_menu(array(
                'theme_location'  => $header_menu,
                'menu_class'      => implode(' ', $navClass),
                'container_class' => implode(' ', $navWrapperClass),
                'menu_id'         => '',
                'depth'           => $header_menu_level, // Level
                'templaza_megamenu_html_data' => $menu_datas
            ));
            // header nav ends
        }
        ?>
        <?php
        if ($mode == 'right' && is_active_sidebar($block_2_sidebar)){
            echo '<div class="header-block-item uk-visible@m header-block-2-horizontal">';
            echo '<div class="sidebar">';
            dynamic_sidebar($block_2_sidebar);
            echo '</div>';
            echo '</div>';
        }
        ?>
    </div>
    <?php
    if ($mode == 'center') {
        echo '<div class="header-center-section uk-flex uk-flex-center uk-flex-middle uk-visible@m">';
        // header nav starts
          Menu::get_nav_menu(array(
              'theme_location'  => $header_menu,
              'menu_class'      => implode(' ', $navClass),
              'container_class' => implode(' ', $navWrapperClass),
              'menu_id'         => '',
              'depth'           => $header_menu_level, // Level
              'templaza_megamenu_html_data' => $menu_datas
          ));

        // header nav ends
        echo '</div>';
    }
    ?>
    <?php if ($block_1_type != 'blank' || $mode == 'right' || $mode == 'center' || $enable_offcanvas): ?>

        <div class="header-right-section uk-flex uk-flex-right uk-flex-middle">
            <?php
            if ($mode == 'right') {
                // header nav starts
                Menu::get_nav_menu(array(
                    'theme_location'  => $header_menu,
                    'menu_class'      => implode(' ', $navClass),
                    'container_class' => implode(' ', $navWrapperClass),
                    'menu_id'         => '',
                    'depth'           => $header_menu_level, // Level
                    'templaza_megamenu_html_data' => $menu_datas
                ));
                // header nav ends

            }
            Templates::load_my_layout('inc.icon', true, false);

            if ($block_1_type == 'social' || $block_1_type == 'contact') {
                ?>
            <div class="uk-visible@m">
                <?php Templates::load_my_layout('inc.' . $block_1_type);?>
            </div>
            <?php
            }
            ?>
            <?php
            if ($enable_offcanvas) { ?>
                <div class="header-offcanvas-trigger burger-menu-button <?php echo $offcanvas_togglevisibility; ?>" data-offcanvas="#templaza-offcanvas" data-effect="<?php echo $offcanvas_animation; ?>" data-direction="<?php echo $offcanvas_direction; ?>" >
                    <button type="button" class="button">
                 <span class="box">
                    <span class="inner"></span>
                 </span>
                    </button>
                </div>
            <?php } ?>
            <?php if ($block_1_type != 'blank' && in_array($block_1_type, array('sidebar', 'custom'))): ?>
                <div class="header-right-block uk-visible@m uk-margin-small-left uk-margin-small-right">
                    <?php
                    if ($block_1_type == 'sidebar' && is_active_sidebar($block_1_sidebar)){
                        echo '<div class="header-block-item">';
                        echo '<div class="sidebar">';
                        dynamic_sidebar($block_1_sidebar);
                        echo '</div>';
                        echo '</div>';
                    }
                    if ($block_1_type == 'custom') {
                        echo '<div class="header-block-item">';
                        echo $block_1_custom;
                        echo '</div>';
                    }
                    ?>
                </div>
            <?php endif; ?>
        </div>
    <?php endif; ?>
</div>