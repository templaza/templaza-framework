<?php

defined('TEMPLAZA_FRAMEWORK') or exit();

use TemPlazaFramework\Functions;
use TemPlazaFramework\Templates;

$options        = Functions::get_theme_options();
$header         = isset($options['enable-header'])?(bool) $options['enable-header']:true;
$mode           = isset($options['header-mode'])?$options['header-mode']:'horizontal';
$template_layout= isset($options['layout-theme'])?$options['layout-theme']:'wide';

$content_classes = [];

if ($header && !empty($mode) && $mode == 'sidebar') {
    $sidebar_dir        = isset($options['header-sidebar-menu-mode'])?$options['header-sidebar-menu-mode']:'left';
    $content_classes[]  = 'has-sidebar';
    $content_classes[]  = 'sidebar-dir-' . $sidebar_dir;
}
?>

<div class="templaza-container">
    <?php Templates::load_my_layout('preloader'); ?>
    <?php
    if($header && $mode != 'sidebar') {
        Templates::load_my_header('header.offcanvas');
    }
    Templates::load_my_header('header.mobilemenu');
    ?>
    <div class="templaza-content<?php echo (!empty($content_classes) ? ' ' . implode(' ', $content_classes) : '');?>">
        <div class="templaza-layout templaza-layout-<?php echo $template_layout;?>" style="<?php echo Templates::get_layout_styles();?>">
            <div class="templaza-wrapper">
                <?php
                do_action('templaza-framework-header_open');
                ?>
