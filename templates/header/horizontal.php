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
$header_menu_level          = isset($options['header-menu-level'])?(int) $options['header-menu-level']:0;
$login_modals               = isset($gb_options['templaza-shop-account-login'])?$gb_options['templaza-shop-account-login']:'modal';
$login_icon                 = isset($gb_options['templaza-shop-account-icon'])?$gb_options['templaza-shop-account-icon']:'';
$header_cart                = isset($gb_options['templaza-shop-mini-cart'])?$gb_options['templaza-shop-mini-cart']:'';
$header_stack_search        = isset($options['stacked-divided-search'])?filter_var($options['stacked-divided-search'], FILTER_VALIDATE_BOOLEAN):true;
$header_stack_account       = isset($options['stacked-divided-account'])?filter_var($options['stacked-divided-account'], FILTER_VALIDATE_BOOLEAN):true;
$header_stack_cart          = isset($options['stacked-divided-cart'])?filter_var($options['stacked-divided-cart'], FILTER_VALIDATE_BOOLEAN):true;

$navClass[] = $dropdown_animation_effect;

// Get data attributes - them added from header shortcode
$menu_datas = Functions::get_attributes('header');
?>
<div class="uk-flex uk-flex-row uk-flex-between">
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
    <?php if ($block_1_type != 'blank' || $mode == 'right' || $enable_offcanvas): ?>
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
            ?>
            <?php if($header_stack_search){ ?>
                <div class="header-search uk-position-relative header-icon">
                    <span><i class="fas fa-search"></i></span>
                    <form method="get" class="searchform " action="<?php echo esc_url( home_url( '/' ) ); ?>">
                        <input type="text" class="field uk-input inputbox search-query uk-margin-remove-vertical" name="s" placeholder="<?php esc_attr_e( 'Search...', 'baressco');?>" />
                        <button type="submit" class="submit searchsubmit has-button-icon uk-position-right" name="submit" data-uk-icon="search"></button>
                    </form>
                </div>
            <?php } ?>
            <?php if($header_stack_cart && class_exists( 'woocommerce' )){ ?>
                <div class="header-cart header-icon">
                    <a href="<?php echo esc_url( wc_get_cart_url() ) ?>" data-toggle="<?php echo esc_attr($header_cart); ?>" data-target="cart-modal">
                        <i class="fas fa-shopping-cart"></i>
                        <span class="counter cart-counter"><?php echo esc_html(WC()->cart->get_cart_contents_count()); ?></span>
                    </a>
                </div>
            <?php } ?>
            <?php if($header_stack_account && class_exists( 'woocommerce' )){ ?>
                <div class="header-account header-icon">
                    <a class="account-icon" href="<?php echo esc_url( wc_get_account_endpoint_url( 'dashboard' ) ) ?>"
                       data-toggle="<?php echo esc_attr($login_modals);?>"
                       data-target="account-modal">
                        <i class="<?php echo esc_attr($login_icon)?>"></i>
                    </a>
                    <?php if ( is_user_logged_in() ) : ?>
                        <div class="account-links">
                            <ul>
                                <?php foreach ( wc_get_account_menu_items() as $endpoint => $label ) : ?>
                                    <li class="account-link--<?php echo esc_attr( $endpoint ); ?>">
                                        <a href="<?php echo esc_url( wc_get_account_endpoint_url( $endpoint ) ); ?>" class="underline-hover">
                                            <?php echo esc_html( $label ); ?>
                                        </a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>
                </div>
            <?php } ?>
            <?php if ($enable_offcanvas) { ?>
                <div class="header-offcanvas-trigger burger-menu-button <?php echo $offcanvas_togglevisibility; ?>" data-offcanvas="#templaza-offcanvas" data-effect="<?php echo $offcanvas_animation; ?>" data-direction="<?php echo $offcanvas_direction; ?>" >
                    <button type="button" class="button">
                 <span class="box">
                    <span class="inner"></span>
                 </span>
                    </button>
                </div>
            <?php } ?>
            <?php if ($block_1_type != 'blank'): ?>
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