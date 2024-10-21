<?php

// No direct access.
defined('TEMPLAZA_FRAMEWORK') or exit();

use TemPlazaFramework\Functions;
use TemPlazaFramework\Templates;
use TemPlazaFramework\Menu;

$gb_options                 = Functions::get_theme_options();
$options                    = Functions::get_header_options();

$header_menu                = isset($options['header-menu'])?$options['header-menu']:'header';
$header_menu_level          = isset($options['header-menu-level'])?(int) $options['header-menu-level']:0;
$enable_offcanvas           = isset($options['enable-offcanvas'])?filter_var($options['enable-offcanvas'], FILTER_VALIDATE_BOOLEAN):false;
$offcanvas_animation        = isset($options['offcanvas-animation'])?$options['offcanvas-animation']:'st-effect-1';
//$offcanvas_direction        = isset($options['offcanvas-direction'])?(bool) $options['offcanvas-direction']:true;
$offcanvas_direction        = isset($options['offcanvas-direction'])?$options['offcanvas-direction']:'offcanvasDirLeft';
$offcanvas_togglevisibility = isset($options['offcanvas-togglevisibility'])?$options['offcanvas-togglevisibility']:'uk-display-block';

$class                      = ['templaza-header', 'templaza-header-sticky'];
$stickyheader               = isset($options['sticky-desktop'])?$options['sticky-desktop']:'sticky';
$header_mobile_menu         = isset($options['header-mobile-menu'])?$options['header-mobile-menu']:'header';
$class[]                    = 'header-' . $stickyheader . '-desktop';
$stickyheadermobile         = isset($options['sticky-mobile'])?$options['sticky-mobile']:'static';
$class[]                    = 'header-' . $stickyheadermobile . '-mobile';
$stickyheadertablet         = isset($options['sticky-tablet'])?$options['sticky-tablet']:'static';
$class[]                    = 'header-' . $stickyheadermobile . '-tablet';

$navClass                   = ['nav', 'navbar-nav', 'templaza-nav', 'uk-flex', 'uk-visible@m'];
$navWrapperClass            = ['templaza-nav-wraper', 'uk-visible@m', 'px-2'];
$mode                       = isset($options['header-horizontal-menu-mode'])?$options['header-horizontal-menu-mode']:'left';
$sticky_mode                = isset($options['sticky-menu-mode'])?$options['sticky-menu-mode']:'left';
$block_1_type               = isset($options['header-block-1-type'])?$options['header-block-1-type']:'blank';
$block_1_sidebar            = isset($options['header-block-1-sidebar'])?$options['header-block-1-sidebar']:'';
$block_1_custom             = isset($options['header-block-1-custom'])?$options['header-block-1-custom']:'';

$sticky_width               = isset($options['sticky-max-width'])?$options['sticky-max-width']:'';

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
        $navWrapperClass[] = 'uk-margin-auto-right';
        break;
    case 'right':
        $navWrapperClass[] = 'uk-margin-auto-left';
        break;
    case 'center':
        $navWrapperClass[] = 'uk-margin-auto';
        break;
}

$attribs = $menu_datas = Functions::get_attributes('header');
$attribs    = join(' ', array_map(function($v, $k){
    return !empty($v)?$k . '="' . $v . '"':$k;
}, $attribs, array_keys($attribs)));
$attribs    = ' '.$attribs;
if(isset($sticky_width) && $sticky_width !='none'){
    $sticky_width = 'uk-container '.'uk-container-'.$sticky_width.'';
}else{
    $sticky_width = '';
}
$header_sticky_designs = array(
    array(
        'enable' => true,
        'class' => '.templaza-sticky-inner',
        'options' => array(
            'sticky-padding',
            'sticky-border',
        ),
    )
);
if (count($header_sticky_designs)) {
    $styles = array();

    foreach ($header_sticky_designs as $design) {
        $enable = isset($design['enable']) ? (bool)$design['enable'] : false;
        if ($enable) {
            $css_responsive = array(
                'desktop' => '',
                'tablet' => '',
                'mobile' => '',
            );
            $css = Templates::make_css_design_style($design['options'], $options,$important = true);
            if (!empty($css)) {
                if (is_array($css)) {
                    foreach ($css as $device => $stack_style) {
                        if (isset($css_responsive[$device]) && !empty($css_responsive[$device])) {
                            $stack_style .= $css_responsive[$device];
                        }
                        if (!empty($stack_style)) {
                            $stack_style = $design['class'] . '{' . $stack_style . '}';
                            Templates::add_inline_style($stack_style, $device);
                        }
                    }
                } else {
                    Templates::add_inline_style($design['class'] . '{' . $css . '}');
                }
            }
        }
    }
}
?>
<?php /* header starts*/ ?>
<div id="templaza-sticky-header" class="<?php echo esc_attr(implode(' ', $class)); ?> uk-hidden">
    <div class="templaza-sticky-inner  <?php echo esc_attr($sticky_width);?>" <?php echo wp_kses($attribs,'post');?>>
        <div class="uk-width uk-flex uk-flex-row uk-flex-between uk-flex-middle">
    <!--        --><?php //if (!empty($header_mobile_menu)) { ?>
                <div class="uk-flex uk-flex-left uk-hidden@m uk-flex-middle">
                    <div class="header-mobilemenu-trigger burger-menu-button uk-hidden@m" data-offcanvas="#templaza-mobilemenu" data-effect="mobilemenu-slide">
                        <button class="button" type="button"><span class="box"><span class="inner"></span></span></button>
                    </div>
                </div>
    <!--        --><?php //} ?>
            <div class="header-left-section uk-flex uk-flex-between uk-flex-middle">
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
                        'templaza_is_sticky'    => true,
                        'templaza_megamenu_html_data' => $menu_datas
                    ));
                    // header nav ends
                }
                ?>
            </div>
            <?php
            if ($sticky_mode == 'center') {
                echo '<div class="header-center-section uk-flex uk-flex-center uk-flex-middle">';
                // header nav starts
                Menu::get_nav_menu(array(
                    'theme_location'  => $header_menu,
                    'menu_class'      => implode(' ', $navClass),
                    'container_class' => implode(' ', $navWrapperClass),
                    'menu_id'         => '',
                    'depth'           => $header_menu_level, // Level
                    'templaza_is_sticky'    => true,
                    'templaza_megamenu_html_data' => $menu_datas
                ));
                // header nav ends
                echo '</div>';
            }
            ?>
            <?php if ($sticky_mode == 'left' || $sticky_mode == 'center' && $enable_offcanvas==false){
                ?>
            <div class="header-right-section uk-flex uk-flex-right uk-flex-middle">
                <?php
                Templates::load_my_layout('inc.icon',true,false);
                ?>
            </div>
            <?php
            } ?>

            <?php if ($sticky_mode == 'right' || $enable_offcanvas): ?>
                <div class="header-right-section uk-flex uk-flex-right uk-flex-middle">
                    <?php
                    if ($sticky_mode == 'right') {
                        // header nav starts
                        Menu::get_nav_menu(array(
                            'theme_location'  => $header_menu,
                            'menu_class'      => implode(' ', $navClass),
                            'container_class' => implode(' ', $navWrapperClass),
                            'menu_id'         => '',
                            'depth'           => $header_menu_level, // Level
                            'templaza_is_sticky'    => true,
                            'templaza_megamenu_html_data' => $menu_datas
                        ));
                        // header nav ends
                    }
                    ?>
                    <?php if ($enable_offcanvas) { ?>
                        <?php
                        Templates::load_my_layout('inc.icon',true,false);
                        ?>
                        <div class="header-offcanvas-trigger burger-menu-button <?php echo esc_attr($offcanvas_togglevisibility); ?>" data-offcanvas="#templaza-offcanvas" data-effect="<?php echo esc_attr($offcanvas_animation); ?>" data-direction="<?php echo esc_attr($offcanvas_direction); ?>">
                            <button type="button" class="button">
                         <span class="box">
                            <span class="inner"></span>
                         </span>
                            </button>
                        </div>
                    <?php } else{
                        Templates::load_my_layout('inc.icon',true,false);
                    }?>
                </div>
            <?php endif; ?>

        </div>
    </div>
</div>
<?php /* header ends*/ ?>