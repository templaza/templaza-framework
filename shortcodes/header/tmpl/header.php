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

$options        = Functions::get_theme_options();
$mode           = isset($options['header-mode'])?$options['header-mode']:'horizontal';
$header_layout  = isset($options['header-layout'])?$options['header-layout']:'wide';
$template_layout= isset($options['layout-theme'])?$options['layout-theme']:'wide';

$menu_mode      = isset($options['header-'.$mode.'-menu-mode'])?$options['header-'.$mode.'-menu-mode']:($mode=='stacked'?'center':'left');

$class  = ['templaza-'.$mode.'-header'];
switch ($mode) {
    default:
    case 'horizontal':
    case 'stacked':
        $class = array_merge($class,['templaza-' . $mode . '-' . $menu_mode . '-header']);
        break;
    case 'sidebar':
        $class  = array_merge($class,['sidebar-dir-' . $menu_mode, 'h-100', 'has-sidebar']);
        break;
}

$class  = implode(' ', $class);

if(isset($atts['tz_class'])){
    $class  .= ' '.trim($atts['tz_class']);
}

?>
<header<?php echo isset($atts['tz_id'])?' id="'.$atts['tz_id'].'"':''; ?> class="<?php echo $class; ?>">
<?php Templates::load_my_header('header.' . $mode, false);?>
</header>
<?php
$header_absolute = isset($options['header-absolute'])?(bool) $options['header-absolute']:false;
if ($header_absolute) {
    ?>
    <script type="text/javascript">
        jQuery(function($){
            $(document).ready(function(){
                $(".templaza-header-section").addClass("header-absolute");
            });
        });
    </script>
    <?php
}
$enable_sticky_menu = isset($options['enable-sticky'])?(bool) $options['enable-sticky']:false;
if ($enable_sticky_menu) {
    Templates::load_my_header('header.sticky', false);
}
?>
