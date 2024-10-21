<?php
defined( 'ABSPATH' ) || exit;
$theme  = wp_get_theme();
?>
<span data-uk-icon="icon: file-text; ratio: 3"></span>
<h3><?php echo esc_html__('Documentation', 'templaza-framework'); ?></h3>
<p><?php echo esc_html__('Documentation, help files, and video tutorials for beginners and professionals', 'templaza-framework'); ?></p>
<a class="uk-button uk-button-default uk-border-pill uk-margin-top" target="_blank" href="https://docs.templaza.com/themes/<?php echo esc_attr(strtolower($theme -> get('Name'))); ?>">Read more</a>