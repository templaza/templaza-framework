<?php

// No direct access.
defined('TEMPLAZA_FRAMEWORK') or exit();

use TemPlazaFramework\Functions;
use TemPlazaFramework\Templates;
use TemPlazaFramework\Menu;

$gb_options                 = Functions::get_theme_options();
$options                    = Functions::get_header_options();

$blog_title                 = get_bloginfo();
$mode                       = isset($options['header-animation-menu-mode'])?$options['header-animation-menu-mode']:'left';
$block_1_type               = isset($options['header-block-1-type'])?$options['header-block-1-type']:'blank';
$block_1_custom             = isset($options['header-block-1-custom'])?$options['header-block-1-custom']:'';
$enable_offcanvas           = isset($options['enable-offcanvas'])?$options['enable-offcanvas']:'';
$offcanvas_animation        = isset($options['offcanvas-animation'])?$options['offcanvas-animation']:'st-effect-1';
$offcanvas_direction        = isset($options['offcanvas-direction'])?(bool) $options['offcanvas-direction']:true;
$offcanvas_togglevisibility = isset($options['offcanvas-togglevisibility'])?$options['offcanvas-togglevisibility']:'uk-display-block';
$sidebar_logo               = isset($options['sidebar-logo'])?$options['sidebar-logo']:false;
$class                      = ['templaza-header', 'templaza-sidebar-header', 'sidebar-dir-' . $mode, 'uk-height-1-1', 'has-sidebar'];
$navClass                   = ['nav', 'templaza-nav', 'uk-nav-sub', 'uk-padding-remove-left'];

$header_menu                = isset($options['header-menu'])?$options['header-menu']:'header';
$header_mobile_menu         = isset($options['header-mobile-menu'])?$options['header-mobile-menu']:'header';
$block_1_sidebar            = isset($options['header-block-1-sidebar'])?$options['header-block-1-sidebar']:'';
$header_menu_level          = isset($options['header-menu-level'])?(int) $options['header-menu-level']:0;
$header_absolute = isset($options['header-absolute'])?(bool) $options['header-absolute']:false;
$_tz_class = '';
if($header_absolute) {
    $_tz_class = 'header-absolute ';
}
$header_animation_designs = array(
    array(
        'enable' => true,
        'class' => '.templaza-header-animation',
        'options' => array(
            'headeranimation-padding',
        ),
    ),
);
$navClass    = ['templaza-mobile-menu','nav', 'templaza-nav'];
if (count($header_animation_designs)) {
    $styles = array();

    foreach ($header_animation_designs as $design) {
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
if($mode=='center'){
    ?>
    <div class="uk-flex uk-flex-row templaza-header-animation-center uk-flex-middle uk-position-relative templaza-header-animation <?php echo esc_attr($_tz_class);?>">
        <div class="header-burger-left">
            <div class="burger-menu">
                <span></span>
                <span></span>
            </div>
        </div>
        <div class="header-center uk-position-center">
            <?php Templates::load_my_layout('logo'); ?>
        </div>
    </div>
<?php
}else{
?>
<div class="uk-flex uk-flex-row uk-flex-between uk-flex-middle templaza-header-animation <?php echo esc_attr($_tz_class);?>">
    <div class="header-left">
        <?php Templates::load_my_layout('logo'); ?>
    </div>
    <div class="header-right">
        <div class="burger-menu">
            <span></span>
            <span></span>
        </div>
    </div>
</div>
<?php
}
?>