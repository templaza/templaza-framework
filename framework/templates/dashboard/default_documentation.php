<?php
defined( 'ABSPATH' ) || exit;
$theme  = wp_get_theme();
?>
<span data-uk-icon="icon: file-text; ratio: 3"></span>
<h3><?php echo __('Documentation', $this -> text_domain); ?></h3>
<p><?php echo __('Documentation, help files, and video tutorials for beginners and professionals', $this -> text_domain); ?></p>
<a class="uk-button uk-button-default uk-border-pill uk-margin-top" target="_blank" href="https://document.templaza.com/<?php echo $theme -> get('TextDomain'); ?>">Read more</a>