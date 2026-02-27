<?php
defined( 'ABSPATH' ) || exit;
$theme  = wp_get_theme();
?>
<div class="uk-card uk-card-body uk-card-default rounded-3">
	<h2>Custom Services</h2>
	<p>Need something more than the default theme options? Our custom work service for WordPress themes is designed to help you extend functionality, customize layouts, and implement specific requirements. We work closely with you to deliver solutions that fit your business goals.</p>

    <form class="templaza-support-email">
        <div class="uk-margin">
            <input class="support-object uk-input uk-border-rounded" placeholder="Subject" name="support-object"/>
        </div>
        <div class="uk-margin">
            <textarea rows="15" class="support-content uk-textarea  uk-border-rounded" name="support-content" placeholder="Your Message..."></textarea>
        </div>
        <div class="uk-alert-danger uk-hidden" data-uk-alert>
            <p></p>
        </div>
        <div class="uk-alert-success uk-hidden" data-uk-alert>
            <p></p>
        </div>
    </form>

	<span class="uk-button templaza-support-email-btn uk-button-default uk-button-large uk-margin-top uk-border-rounded uk-width-1-1"><?php echo esc_html__('Send Message', 'templaza-framework'); ?></span>
</div>
<div class="uk-card uk-card-body uk-card-default rounded-3">
	<h2><?php echo esc_html($theme->get('Name')); ?> Theme Support</h2>
	<p>Need help with your WordPress theme? Our support team offers dedicated assistance for theme setup, configuration, bug fixes, and general technical inquiries, ensuring a smooth and hassle-free experience. Feel free to contact us.</p>
	<a href="https://www.templaza.com/forums.html" target="_blank" class="uk-button uk-button-default uk-button-large uk-margin-top uk-border-pill uk-width-1-1"><?php echo esc_html__('Ask a question', 'templaza-framework'); ?></a>
</div>
<?php
if (file_exists(get_template_directory().'/templaza-framework/templates/support/default.php')) {
	include_once get_template_directory().'/templaza-framework/templates/support/default.php';
}