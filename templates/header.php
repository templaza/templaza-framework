<?php

defined('TEMPLAZA_FRAMEWORK') or exit();

use TemPlazaFramework\Functions;
use TemPlazaFramework\Templates;

$gb_options                 = Functions::get_theme_options();
$options                    = Functions::get_header_options();
$header         = isset($gb_options['enable-header'])?(bool) $gb_options['enable-header']:true;
$mode           = isset($options['header-mode'])?$options['header-mode']:'horizontal';
$template_layout= isset($gb_options['layout-theme'])?$gb_options['layout-theme']:'wide';

$content_classes = [];

if ($header && !empty($mode) && $mode == 'sidebar') {
    $sidebar_dir        = isset($options['header-sidebar-menu-mode'])?$options['header-sidebar-menu-mode']:'left';
    $content_classes[]  = 'has-sidebar';
    $content_classes[]  = 'sidebar-dir-' . $sidebar_dir;
}
$header_id      = Functions::get_header_id();
$footer_id      = Functions::get_footer_id();
$template_id    = Functions::get_template_id();

$container_class    = '';
$container_class   .= !empty($template_id)?' templaza-container-template__'.$template_id:'';
$container_class   .= !empty($header_id)?' templaza-container-header__'.$header_id:'';
$container_class   .= !empty($footer_id)?' templaza-container-footer__'.$footer_id:'';
$preloader_animation    = isset($gb_options['preloader-animation'])?$gb_options['preloader-animation']:'circle';
$id = 'templaza-content';
if($preloader_animation == 'charging'){
 $id='content-scroll';
}

?>

<div class="templaza-container<?php echo esc_attr($container_class);?>" >
    <?php Templates::load_my_layout('preloader'); ?>
    <?php
    if($header && $mode != 'sidebar') {
        Templates::load_my_header('header.offcanvas');
    }
    Templates::load_my_header('header.mobilemenu');
    ?>
    <div id="<?php echo esc_attr($id);?>"  class="templaza-content<?php echo (!empty($content_classes) ? ' ' . esc_attr(implode(' ', $content_classes)) : '');?>">
        <div id="js-scroll" data-scroll-container  class="templaza-layout templaza-layout-<?php echo esc_attr($template_layout);?>">
            <div id="smooth-content" class="templaza-wrapper" >
                <?php
                do_action('templaza-framework-header_open');
                ?>
