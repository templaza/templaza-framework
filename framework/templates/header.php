<?php
/**
 * Base layout for all admin pages
 */
defined('TEMPLAZA_FRAMEWORK') or die;

$theme  = wp_get_theme();
?>
<div class="templaza-framework__header">
    <h1 class="title"><?php echo  wp_get_theme()->get('Name')? $theme->get('Name')
            .__(' theme dashboard', $this -> text_domain):__('TemPlaza Framework', $this -> text_domain); ?></h1>
    <div class="sub-title">
        <span class="desc-meta"><?php echo sprintf(__("Version %s", $this -> text_domain),$theme->get('Version')); ?></span>
    </div>
</div>