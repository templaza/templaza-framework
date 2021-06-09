<?php

defined('TEMPLAZA_FRAMEWORK') or exit();

use TemPlazaFramework\Functions;
use TemPlazaFramework\Templates;

$options        = Functions::get_theme_options();

if(isset($content) && !empty($content)){
    $type = 'WP_Widget_Text';
    $args = array(
        'before_widget' => '<div class="widget widget-area %s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widgettitle">',
        'after_title'   => '</h3>',
    );
    $atts['text']   = $content;
?>
<div<?php echo isset($atts['tz_id'])?' id="'.$atts['tz_id'].'"':''; ?> class="<?php
echo isset($atts['tz_class'])?trim($atts['tz_class']):''; ?>">
    <?php
    the_widget( $type, $atts, $args );
    ?>
</div>
<?php } ?>