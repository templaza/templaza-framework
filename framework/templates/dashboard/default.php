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

                <ul class="uk-subnav uk-subnav-pill uk-margin-remove" data-uk-switcher="animation: uk-animation-fade">
                    <li class="uk-padding-remove uk-margin-remove"><a style="padding:15px !important;" class="uk-padding-small" href="#"><?php echo esc_html__('Active License From Themeforest', 'templaza-framework'); ?></a></li>
                    <li class="uk-padding-remove uk-margin-remove"><a style="padding:15px !important;" class="uk-padding-small" href="#"><?php echo esc_html__('Active License From TemPlaza', 'templaza-framework'); ?></a></li>
                </ul>
                <div class="uk-switcher">
                    <div>
                        <div class="uk-card uk-card-default uk-card-body rounded-3"><?php echo $this -> load_template('license');?></div>
                    </div>
                    <div>
                        <div class="uk-card uk-card-default uk-card-body rounded-3"><?php echo $this -> load_template('tzmembership');?></div>
                    </div>
                </div>
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
