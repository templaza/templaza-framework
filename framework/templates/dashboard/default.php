<?php

defined( 'ABSPATH' ) || exit;
// phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped
?>
<div id="tzinst-dashboard-widgets-wrap">
    <div class="uk-grid-match" data-uk-grid>
        <div class="uk-width-1-1">
            <div class="uk-card uk-card-default uk-card-body rounded-3"><?php echo $this -> load_template('theme');?></div>
        </div>
        <?php if(isset($this -> theme_config_registered) && !empty($this -> theme_config_registered)){ ?>
            <div id="tzinst-license" class="uk-width-1-1">
                <div class="uk-card uk-card-default uk-card-body rounded-3"><?php echo $this -> load_template('license');?></div>
            </div>
        <?php } ?>
        <div class="uk-width-1-1">
            <?php echo $this -> load_template('sysinfo'); ?>
        </div>
        <div class="uk-width-1-3@m uk-width-1-1">
            <div class="uk-card uk-card-default uk-card-body rounded-3"><?php echo $this -> load_template('support');?></div>
        </div>
        <div class="uk-width-1-3@m uk-width-1-1">
            <div class="uk-card uk-card-default uk-card-body rounded-3"><?php echo $this -> load_template('documentation');?></div>
        </div>
        <div class="uk-width-1-3@m uk-width-1-1">
            <div class="uk-card uk-card-default uk-card-body rounded-3"><?php echo $this -> load_template('custom');?></div>
        </div>
    </div>
</div>
