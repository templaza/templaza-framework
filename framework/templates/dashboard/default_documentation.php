<?php
defined( 'ABSPATH' ) || exit;
$theme  = wp_get_theme();
?>
<span data-uk-icon="icon: file-text; ratio: 3"></span>
<h3><?php echo __('Documentation', 'templaza-framework'); ?></h3>
<p><?php echo __('Documentation, help files, and video tutorials for beginners and professionals', 'templaza-framework'); ?></p>
<a class="uk-button uk-button-default uk-border-pill uk-margin-top" target="_blank" href="https://document.templaza.com/<?php echo $theme -> get('Name'); ?>">Read more</a>