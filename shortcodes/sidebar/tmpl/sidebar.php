<?php

defined('TEMPLAZA_FRAMEWORK') or exit();

$sidebar    = isset($atts['sidebar'])?$atts['sidebar']:'';
if ($sidebar && is_active_sidebar($sidebar)){
    ?>
    <div<?php echo isset($atts['tz_id'])?' id="'.esc_attr($atts['tz_id']).'"':''; ?> class="<?php
    echo isset($atts['tz_class'])?esc_attr(trim($atts['tz_class'])):''; ?>">
        <aside id="widget-area-<?php echo esc_attr($atts['id']); ?>" class="widget-area">
        <?php dynamic_sidebar($sidebar); ?>
        </aside>
    </div>
    <?php
}
?>