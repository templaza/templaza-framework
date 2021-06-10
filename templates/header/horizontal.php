<?php

// No direct access.
defined('TEMPLAZA_FRAMEWORK') or exit();

use TemPlazaFramework\Functions;
use TemPlazaFramework\Templates;
use TemPlazaFramework\Menu;

$options                    = Functions::get_theme_options();

$mode                       = isset($options['header-horizontal-menu-mode'])?$options['header-horizontal-menu-mode']:'left';
$block_1_type               = isset($options['header-block-1-type'])?$options['header-block-1-type']:'blank';
$block_1_custom             = isset($options['header-block-1-custom'])?$options['header-block-1-custom']:'';

$enable_offcanvas           = isset($options['enable-offcanvas'])?(bool) $options['enable-offcanvas']:false;
$offcanvas_animation        = isset($options['offcanvas-animation'])?$options['offcanvas-animation']:'st-effect-1';
$offcanvas_direction        = isset($options['offcanvas-direction']) && (bool) $options['offcanvas-direction']?'offcanvasDirLeft':'offcanvasDirRight';
$offcanvas_togglevisibility = isset($options['offcanvas-togglevisibility'])?$options['offcanvas-togglevisibility']:'d-block';

//$class                      = ['templaza-header', 'templaza-horizontal-header', 'templaza-horizontal-' . $mode . '-header'];
$navClass                   = ['nav', 'navbar-nav', 'templaza-nav', 'd-none', 'd-lg-flex'];
$navWrapperClass            = ['align-self-center', 'px-2', 'd-none', 'd-lg-block'];

$dropdown_arrow             = isset($options['dropdown-arrow'])?(bool) $options['dropdown-arrow']:true;
//$dropdown_animation_ease    = isset($options['dropdown-animation-ease'])?$options['dropdown-animation-ease']:'linear';
$dropdown_animation_type    = isset($options['dropdown-animation-type'])?$options['dropdown-animation-type']:'fade';
$dropdown_animation_effect  = isset($options['dropdown-animation-effect'])?$options['dropdown-animation-effect']:'fade-down';
$dropdown_animation_effect  = $dropdown_animation_type == 'none'?'':$dropdown_animation_effect;
//$dropdown_animation_speed_1 = isset($options['dropdown-animation-speed-1'])?$options['dropdown-animation-speed-1']:300;
//$dropdown_animation_speed_2 = isset($options['dropdown-animation-speed-2'])?$options['dropdown-animation-speed-2']:300;
$dropdown_trigger           = isset($options['dropdown-trigger'])?$options['dropdown-trigger']:'hover';

$header_menu                = isset($options['header-menu'])?$options['header-menu']:'header';
$header_mobile_menu         = isset($options['header-mobile-menu'])?$options['header-mobile-menu']:'';
$block_1_sidebar            = isset($options['header-block-1-sidebar'])?$options['header-block-1-sidebar']:'';
$header_menu_level          = isset($options['header-menu-level'])?(int) $options['header-menu-level']:0;

$navClass[] = $dropdown_animation_effect;

// Get data attributes - them added from header shortcode
$menu_datas = Functions::get_attributes('header');
?>
<div class="d-flex flex-row justify-content-between">
    <?php if (!empty($header_mobile_menu)) { ?>
        <div class="d-flex d-lg-none justify-content-start">
            <div class="header-mobilemenu-trigger d-lg-none burger-menu-button align-self-center" data-offcanvas="#templaza-mobilemenu" data-effect="mobilemenu-slide">
                <button class="button" type="button"><span class="box"><span class="inner"></span></span></button>
            </div>
        </div>
    <?php } ?>
    <div class="header-left-section d-flex justify-content-between">
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
        echo '<div class="header-center-section d-none d-lg-block justify-content-center">';
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
        <div class="header-right-section d-flex justify-content-end">
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
            <?php if ($enable_offcanvas) { ?>
                <div class="header-offcanvas-trigger burger-menu-button align-self-center <?php echo $offcanvas_togglevisibility; ?>" data-offcanvas="#templaza-offcanvas" data-effect="<?php echo $offcanvas_animation; ?>" data-direction="<?php echo $offcanvas_direction; ?>" >
                    <button type="button" class="button">
                 <span class="box">
                    <span class="inner"></span>
                 </span>
                    </button>
                </div>
            <?php } ?>
            <?php if ($block_1_type != 'blank'): ?>
                <div class="header-right-block d-none d-lg-block align-self-center px-2">
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