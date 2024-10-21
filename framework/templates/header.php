<?php
/**
 * Base layout for all admin pages
 */
defined('TEMPLAZA_FRAMEWORK') or die;

$theme  = wp_get_theme();
?>
<div class="templaza-framework__header uk-card uk-card-default uk-card-body rounded-3">
    <div class="uk-flex-middle uk-grid" data-uk-grid>
        <div class="logo uk-width-auto@m uk-text-left@m uk-text-center">
            <h1 class="title uk-margin-small-bottom"><?php
			    if (file_exists(get_template_directory().'/assets/images/logo-admin.png')) {
				    echo '<img src="'.esc_url(get_template_directory_uri().'/assets/images/logo-admin.png').'" alt="'.esc_attr($theme->get('Name')).'" />';
			    } else {
				    echo  esc_html(wp_get_theme()->get('Name'))? esc_html($theme->get('Name')) .esc_html__(' theme dashboard', 'templaza-framework'):esc_html__('TemPlaza Framework', 'templaza-framework');
			    } ?></h1>
            <div class="uk-text-meta">
                <span class="desc-meta"><?php /* translators: %s - Version. */ echo sprintf(esc_html__("Version %s", 'templaza-framework'),esc_html($theme->get('Version'))); ?></span>
            </div>
        </div>
	    <?php
	    $this -> the_nav();
	    ?>
    </div>
</div>