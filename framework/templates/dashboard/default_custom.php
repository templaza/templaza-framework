<?php
defined( 'ABSPATH' ) || exit;
$theme  = wp_get_theme();
?>
<span data-uk-icon="icon: code; ratio: 3"></span>
<h3><?php echo sprintf(__('%s Customization', $this -> text_domain), $theme -> get('Name')); ?></h3>
<p><?php echo __('Hire an expert to help your business become more efficient through the deployment, development your website.', $this -> text_domain); ?></p>
<a class="uk-button uk-button-default uk-border-pill uk-margin-top" target="_blank" href="https://www.templaza.com/service.html">Get a quote</a>