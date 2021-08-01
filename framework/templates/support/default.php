<?php
defined( 'ABSPATH' ) || exit;
$theme  = wp_get_theme();
?>
<div class="uk-card uk-card-body uk-card-default rounded-3">
	<h2><?php echo $theme->get('Name'); ?> Support</h2>
	<p><?php echo $theme->get('Name'); ?> comes with 6 months of free support for every license you purchase. Support can be extended through subscription via ThemeForest (<a href="https://help.market.envato.com/hc/en-us/articles/207886473-Extending-and-Renewing-Item-Support" target="_blank">more information on support extension</a>). To access <?php echo $theme->get('Name'); ?> support, you must first setup an account by following these steps.</p>
	<a href="https://www.templaza.com/forums.html" target="_blank" class="uk-button uk-button-default uk-button-large uk-margin-top uk-border-pill uk-width-1-1"><?php echo __('Ask a question', $this->text_domain); ?></a>
</div>
<?php
if (file_exists(get_template_directory().'/templaza-framework/templates/support/default.php')) {
	include_once get_template_directory().'/templaza-framework/templates/support/default.php';
}