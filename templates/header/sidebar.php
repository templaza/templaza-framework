<?php

// No direct access.
defined('TEMPLAZA_FRAMEWORK') or exit();

use TemPlazaFramework\Functions;
use TemPlazaFramework\Templates;
use TemPlazaFramework\Menu;

$options    = Functions::get_theme_options();

$blog_title                 = get_bloginfo();
$mode                       = isset($options['header-sidebar-menu-mode'])?$options['header-sidebar-menu-mode']:'left';
$block_1_type               = isset($options['header-block-1-type'])?$options['header-block-1-type']:'blank';
$block_1_custom             = isset($options['header-block-1-custom'])?$options['header-block-1-custom']:'';
$enable_offcanvas           = isset($options['enable-offcanvas'])?$options['enable-offcanvas']:'';
$offcanvas_animation        = isset($options['offcanvas-animation'])?$options['offcanvas-animation']:'st-effect-1';
$offcanvas_direction        = isset($options['offcanvas-direction'])?(bool) $options['offcanvas-direction']:true;
$offcanvas_togglevisibility = isset($options['offcanvas-togglevisibility'])?$options['offcanvas-togglevisibility']:'uk-display-block';
$sidebar_logo               = isset($options['sidebar-logo'])?$options['sidebar-logo']:false;
$class                      = ['templaza-header', 'templaza-sidebar-header', 'sidebar-dir-' . $mode, 'uk-height-1-1', 'has-sidebar'];
$navClass                   = ['nav', 'templaza-nav', 'uk-nav-sub', 'uk-padding-remove-left'];
//$navWrapperClass            = ['align-self-center', 'px-2', 'd-none', 'd-lg-block'];

$header_menu                = isset($options['header-menu'])?$options['header-menu']:'header';
$header_mobile_menu         = isset($options['header-mobile-menu'])?$options['header-mobile-menu']:'header';
$block_1_sidebar            = isset($options['header-block-1-sidebar'])?$options['header-block-1-sidebar']:'';
$header_menu_level          = isset($options['header-menu-level'])?(int) $options['header-menu-level']:0;

?>
<div class="templaza-sidebar-content uk-height-1-1">
    <div class="templaza-sidebar-collapsable">
        <i class="fa"></i>
    </div>
    <?php if (!empty($sidebar_logo) && $sidebar_logo['url']) { ?>
        <div class="templaza-sidebar-collapsed-logo">
            <img src="<?php echo $sidebar_logo['url']; ?>" alt="<?php echo $blog_title; ?>" class="templaza-logo-sidebar" />
        </div>
    <?php } ?>
    <div class="templaza-sidebar-logo">
			<?php //if (!empty($header_mobile_menu)) { ?>
            <div class="uk-flex uk-flex-left uk-flex-middle templaza-sidebar-mobile-menu">
                <div class="header-mobilemenu-trigger burger-menu-button"
                     data-offcanvas="#templaza-mobilemenu" data-effect="mobilemenu-slide">
                    <button class="button" type="button"><span class="box"><span class="inner"></span></span>
                    </button>
                </div>
            </div>
        <?php //} ?>
        <?php Templates::load_my_layout('logo'); ?>
    </div>
    <div class="templaza-sidebar-menu">
        <?php
        Menu::get_nav_menu(array(
            'theme_location'  => $header_menu,
            'menu_class'      => implode(' ', $navClass),
//                'container_class' => implode(' ', $navWrapperClass),
            'menu_id'         => '',
            'depth'           => $header_menu_level, // Level
        ));
        ?>
    </div>
    <?php if ($block_1_type != 'blank'): ?>
        <div class="templaza-sidebar-block">
            <?php
            if ($block_1_type == 'sidebar' && is_active_sidebar($block_1_sidebar)){
                echo '<div class="header-block-item block-sidebar">';
                dynamic_sidebar($block_1_sidebar);
                echo '</div>';
            }
            if ($block_1_type == 'custom')
            {
                echo '<div class="header-block-item">';
                echo $block_1_custom;
                echo '</div>';
            }
            ?>
        </div>
    <?php endif; ?>
</div>