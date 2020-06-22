<?php

defined('TEMPLAZA_FRAMEWORK') or exit();

use TemPlazaFramework\Functions;
use TemPlazaFramework\Templates;

?>
<div class="templaza-container">
<?php
$options = Functions::get_theme_options();
$header  = isset($options['enable-header'])?(bool) $options['enable-header']:true;
$mode    = isset($options['header-mode'])?$options['header-mode']:'horizontal';

if (!$header) {
    return;
}

?>
<section class="templaza-section templaza-header-section">
    <div class="templaza-content">
        <?php
        Templates::load_my_header('header.' . $mode);
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
            Templates::load_my_header('header.sticky');
        }
        ?>
    </div>
<?php
if($header && $mode != 'sidebar') {
    Templates::load_my_header('header.offcanvas');
}
?>
</section>
