<?php

defined('TEMPLAZA_FRAMEWORK') or exit();

use TemPlazaFramework\Functions;
use TemPlazaFramework\Templates;

$options        = Functions::get_theme_options();

$theme_page_html    = apply_filters('templaza-framework/shortcode/content_area/theme_html', '');
$theme_page_html    = trim($theme_page_html);
// phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped
if(!empty($theme_page_html)){
    extract(shortcode_atts(array(
        'id'                  => '',
        'tz_id'                  => '',
        'tz_class'               => '',
        'section_type'           => 'default',
        'layout_type'            => 'container',
        'custom_container_class' => '',
    ), $atts));

    $theme_page_html    = trim($theme_page_html);
    if(!empty($theme_page_html)){
        $theme_page_html    = str_replace( ']]&gt;', ']]>', $theme_page_html );
?>
    <div<?php echo !empty($tz_id)?' id="'.esc_attr($tz_id).'"':''; ?> class="<?php
    echo esc_attr($tz_class); ?>">
    <?php echo $theme_page_html; ?>
    </div>
    <?php } ?>
<?php } ?>
