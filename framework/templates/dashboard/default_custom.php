<?php
defined( 'ABSPATH' ) || exit;
$theme  = wp_get_theme();
?>
<span data-uk-icon="icon: code; ratio: 3"></span>
<h3><?php /* translators: %s - Customization. */ echo sprintf(esc_html__('%s Customization', 'templaza-framework'), esc_html($theme -> get('Name'))); ?></h3>
<p><?php echo esc_html__('Hire an expert to help your business become more efficient through the deployment, development your website.', 'templaza-framework'); ?></p>
<a class="uk-button uk-button-default uk-border-pill uk-margin-top" target="_blank" href="https://www.templaza.com/service.html">Get a quote</a>