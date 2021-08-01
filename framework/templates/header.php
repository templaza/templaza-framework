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
				    echo '<img src="'.get_template_directory_uri().'/assets/images/logo-admin.png'.'" alt="'.$theme->get('Name').'" />';
			    } else {
				    echo  wp_get_theme()->get('Name')? $theme->get('Name') .__(' theme dashboard', $this -> text_domain):__('TemPlaza Framework', $this -> text_domain);
			    } ?></h1>
            <div class="uk-text-meta">
                <span class="desc-meta"><?php echo sprintf(__("Version %s", $this -> text_domain),$theme->get('Version')); ?></span>
            </div>
        </div>
	    <?php
	    $this -> the_nav();
	    ?>
    </div>
</div>