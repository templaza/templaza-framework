<?php

defined('TEMPLAZA_FRAMEWORK') or exit();

use TemPlazaFramework\Functions;
use TemPlazaFramework\Templates;

$options    = Functions::get_theme_options();
$sidebar    = isset($atts['sidebar'])?$atts['sidebar']:'';
if ($sidebar && is_active_sidebar($sidebar)){
    ?>
    <div<?php echo isset($atts['tz_id'])?' id="'.$atts['tz_id'].'"':''; ?> class="<?php
    echo isset($atts['tz_class'])?trim($atts['tz_class']):''; ?>">
        <aside id="widget-area-<?php echo $atts['id']; ?>" class="widget-area">
        <?php dynamic_sidebar($sidebar); ?>
        </aside>
    </div>
    <?php
}
?>