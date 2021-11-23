<?php
defined('TEMPLAZA_FRAMEWORK') or exit();

use TemPlazaFramework\Functions;
use TemPlazaFramework\Templates;

//extract($atts);

//if(isset($tz_class)){
//    $tz_class   = 'templaza-header-section';
//}
?>
<?php

$options            = Functions::get_theme_options();
$mode               = isset($options['header-mode'])?$options['header-mode']:'horizontal';
$header             = isset($options['enable-header'])?filter_var($options['enable-header'], FILTER_VALIDATE_BOOLEAN):true;
$header_layout      = isset($options['header-layout'])?$options['header-layout']:'wide';
$template_layout    = isset($options['layout-theme'])?$options['layout-theme']:'wide';
$dropdown_trigger   = isset($options['dropdown-trigger'])?$options['dropdown-trigger']:'hover';

$menu_mode      = isset($options['header-'.$mode.'-menu-mode'])?$options['header-'.$mode.'-menu-mode']:($mode=='stacked'?'center':'left');

$class  = ['templaza-header','templaza-'.$mode.'-header'];
switch ($mode) {
    default:
    case 'horizontal':
    case 'stacked':
        $class[]    = 'templaza-' . $mode . '-' . $menu_mode . '-header';
        break;
    case 'sidebar':
        $class  = array_merge($class,['sidebar-dir-' . $menu_mode, 'uk-height-1-1', 'has-sidebar']);
        break;
}

$class  = implode(' ', $class);

// Add data attributes to use some places.
$attribs = array(
    'data-megamenu'               => '',
    'data-header-offset'          => 'true',
    'data-megamenu-class'         => '.has-megamenu',
    'data-megamenu-trigger'       => $dropdown_trigger,
//    'data-megamenu-submenu-class' => '.sub-menu',
    'data-megamenu-submenu-class' => '.nav-submenu',
    'data-megamenu-content-class' => '.megamenu-sub-menu',
);
Functions::add_attributes('header', $attribs);

$attribs    = join(' ', array_map(function($v, $k){
    return !empty($v)?$k . '="' . $v . '"':$k;
}, $attribs, array_keys($attribs)));
$attribs    = ' '.$attribs;

if($header){
?>
<div<?php echo isset($atts['tz_id'])?' id="'.$atts['tz_id'].'"':''; ?> class="<?php echo $atts['tz_class']; ?>">
    <header class="<?php echo $class; ?>"<?php
    echo $mode == 'horizontal'?$attribs:''; ?>>
        <?php Templates::load_my_header('header.' . $mode, false);?>
    </header>
    <?php
    $enable_sticky_menu = isset($options['enable-sticky'])?(bool) $options['enable-sticky']:false;
    if ($enable_sticky_menu) {
        Templates::load_my_header('header.sticky', false);
    }
    ?>
</div>
<?php } ?>
