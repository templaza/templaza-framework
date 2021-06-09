<?php

// No direct access.
defined('TEMPLAZA_FRAMEWORK') or exit();

use TemPlazaFramework\Functions;
use TemPlazaFramework\Templates;
use TemPlazaFramework\Menu;

$options                    = Functions::get_theme_options();

$header_menu                = isset($options['header-menu'])?$options['header-menu']:'header';
$header_menu_level          = isset($options['header-menu-level'])?(int) $options['header-menu-level']:0;
$enable_offcanvas           = isset($options['enable-offcanvas'])?(bool) $options['enable-offcanvas']:false;
$offcanvas_animation        = isset($options['offcanvas-animation'])?$options['offcanvas-animation']:'st-effect-1';
//$offcanvas_direction        = isset($options['offcanvas-direction'])?(bool) $options['offcanvas-direction']:true;
$offcanvas_direction        = isset($options['offcanvas-direction']) && (bool) $options['offcanvas-direction']?'offcanvasDirLeft':'offcanvasDirRight';
$offcanvas_togglevisibility = isset($options['offcanvas-togglevisibility'])?$options['offcanvas-togglevisibility']:'d-block';

$class                      = ['templaza-header', 'templaza-header-sticky'];
$stickyheader               = isset($options['sticky-desktop'])?$options['sticky-desktop']:'sticky';
$header_mobile_menu         = isset($options['header-mobile-menu'])?$options['header-mobile-menu']:'header';
$class[]                    = 'header-' . $stickyheader . '-desktop';
$stickyheadermobile         = isset($options['sticky-mobile'])?$options['sticky-mobile']:'static';
$class[]                    = 'header-' . $stickyheadermobile . '-mobile';
$stickyheadertablet         = isset($options['sticky-tablet'])?$options['sticky-tablet']:'static';
$class[]                    = 'header-' . $stickyheadermobile . '-tablet';

$navClass                   = ['nav', 'navbar-nav', 'templaza-nav', 'd-none', 'd-lg-flex'];
$navWrapperClass            = ['templaza-nav-wraper', 'align-self-center', 'px-2', 'd-none', 'd-lg-block'];
$mode                       = isset($options['header-horizontal-menu-mode'])?$options['header-horizontal-menu-mode']:'left';
$sticky_mode                = isset($options['sticky-menu-mode'])?$options['sticky-menu-mode']:'left';
$block_1_type               = isset($options['header-block-1-type'])?$options['header-block-1-type']:'blank';
$block_1_sidebar            = isset($options['header-block-1-sidebar'])?$options['header-block-1-sidebar']:'';
$block_1_custom             = isset($options['header-block-1-custom'])?$options['header-block-1-custom']:'';


$dropdown_arrow             = isset($options['dropdown-arrow'])?(bool) $options['dropdown-arrow']:true;
$dropdown_animation_speed   = isset($options['dropdown-animation-speed'])?$options['dropdown-animation-speed']:300;
$dropdown_animation_ease    = isset($options['dropdown-animation-ease'])?$options['dropdown-animation-ease']:'linear';
$dropdown_animation_type    = isset($options['dropdown-animation-type'])?$options['dropdown-animation-type']:'fade';
$dropdown_animation_effect  = isset($options['dropdown-animation-effect'])?$options['dropdown-animation-effect']:'fade-down';
$dropdown_animation_effect  = $dropdown_animation_type == 'none'?'':$dropdown_animation_effect;
$dropdown_trigger           = isset($options['dropdown-trigger'])?$options['dropdown-trigger']:'hover';

$navClass[] = $dropdown_animation_effect;

switch ($mode) {
    case 'left':
        $navWrapperClass[] = 'mr-auto';
        break;
    case 'right':
        $navWrapperClass[] = 'ml-auto';
        break;
    case 'center':
        $navWrapperClass[] = 'mx-auto';
        break;
}

$attribs = $menu_datas = Functions::get_attributes('header');
$attribs    = join(' ', array_map(function($v, $k){
    return !empty($v)?$k . '="' . $v . '"':$k;
}, $attribs, array_keys($attribs)));
$attribs    = ' '.$attribs;
?>
<?php /* header starts*/ ?>
<div id="templaza-sticky-header" class="<?php echo implode(' ', $class); ?> d-none"<?php echo $attribs;?>>
    <div class="container d-flex flex-row justify-content-between">
        <?php if (!empty($header_mobile_menu)) { ?>
            <div class="d-flex d-lg-none justify-content-start">
                <div class="header-mobilemenu-trigger d-lg-none burger-menu-button align-self-center" data-offcanvas="#templaza-mobilemenu" data-effect="mobilemenu-slide">
                    <button class="button" type="button"><span class="box"><span class="inner"></span></span></button>
                </div>
            </div>
        <?php } ?>
        <div class="header-left-section d-flex justify-content-between">
            <?php
            Templates::load_my_layout('logo', true, false); ?>
            <?php
            if ($sticky_mode == 'left') {
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
        if ($sticky_mode == 'center') {
            echo '<div class="header-center-section d-flex justify-content-center">';
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
        <?php if ($block_1_type != 'blank' || $sticky_mode == 'right' || $enable_offcanvas): ?>
            <div class="header-right-section d-flex justify-content-end">
                <?php
                if ($sticky_mode == 'right') {
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
                    <div class="header-offcanvas-trigger burger-menu-button align-self-center <?php echo $offcanvas_togglevisibility; ?>" data-offcanvas="#templaza-offcanvas" data-effect="<?php echo $offcanvas_animation; ?>" data-direction="<?php echo $offcanvas_direction; ?>">
                        <button type="button" class="button">
                     <span class="box">
                        <span class="inner"></span>
                     </span>
                        </button>
                    </div>
                <?php } ?>
<!--                --><?php //if ($block_1_type != 'blank'): ?>
<!--                    <div class="header-right-block d-none d-lg-block align-self-center px-2">-->
<!--                        --><?php
//                        if ($block_1_type == 'sidebar' && is_active_sidebar($block_1_sidebar)){
//                            echo '<div class="header-block-item">';
//                            echo '<ul id="sidebar">';
//                            dynamic_sidebar($block_1_sidebar);
//                            echo '</ul>';
//                            echo '</div>';
//                        }
//                        if ($block_1_type == 'custom') {
//                            echo '<div class="header-block-item">';
//                            echo $block_1_custom;
//                            echo '</div>';
//                        }
//                        ?>
<!--                    </div>-->
<!--                --><?php //endif; ?>
            </div>
        <?php endif; ?>
    </div>
</div>
<?php /* header ends*/ ?>