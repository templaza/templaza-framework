<?php
/**
 * Base layout for all admin pages
 */
defined( 'ABSPATH' ) || exit;
$theme  = wp_get_theme();
?>
<div class="tzinst-footer uk-margin-medium-top" data-uk-grid>
    <div class="uk-width-expand@s">
        <strong><?php echo esc_html__("© TemPlaza.com", 'templaza-framework'); ?></strong> - Thank you for choosing <?php echo esc_html($theme -> get('Name')); ?>. We are honored and are fully dedicated to making your experience perfect.
    </div>
    <div class="uk-width-auto@s">
        <div class="uk-grid-small" data-uk-grid>
            <div>
                <a href="https://www.facebook.com/templaza" target="_blank" data-uk-icon="icon: facebook"></a>
            </div>
            <div>
                <a href="https://twitter.com/templazavn" target="_blank" data-uk-icon="icon: twitter"></a>
            </div>
            <div>
                <a href="https://dribbble.com/templaza" target="_blank" data-uk-icon="icon: dribbble"></a>
            </div>
            <div>
                <a href="https://github.com/templaza" target="_blank" data-uk-icon="icon: github"></a>
            </div>
            <div>
                <a href="https://www.behance.net/templaza" target="_blank" data-uk-icon="icon: behance"></a>
            </div>
        </div>
    </div>
</div>